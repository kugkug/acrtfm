<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Smalot\PdfParser\Parser;
use App\Models\ManualAnalysis;
use GeminiAPI\Laravel\Facades\Gemini;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AnalyzePdfs extends Command
{    
    protected $signature = 'app:analyze-pdfs {--force : Force re-analysis of existing files} {--file= : Analyze specific file only}';
    
    protected $description = 'Analyze PDFs in the public/manuals directory and store analysis results';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Starting PDF analysis...');
        
        $manualsPath = public_path('manuals');
        if (!is_dir($manualsPath)) {
            $this->error('Manuals directory not found: ' . $manualsPath);
            return 1;
        }

        $pdfFiles = glob($manualsPath . '/*.pdf');
        
        if (empty($pdfFiles)) {
            $this->warn('No PDF files found in manuals directory');
            return 0;
        }

        $this->info('Found ' . count($pdfFiles) . ' PDF files to analyze');

        $force = $this->option('force');
        $specificFile = $this->option('file');

        if ($specificFile) {
            $specificFilePath = $manualsPath . '/' . $specificFile;
            if (!file_exists($specificFilePath)) {
                $this->error('File not found: ' . $specificFilePath);
                return 1;
            }
            $pdfFiles = [$specificFilePath];
        }

        $progressBar = $this->output->createProgressBar(count($pdfFiles));
        $progressBar->start();

        foreach ($pdfFiles as $pdfFile) {
            $filename = basename($pdfFile);
            
            // Check if already analyzed (unless force is used)
            if (!$force && ManualAnalysis::where('filename', $filename)->exists()) {
                $this->line("\nSkipping {$filename} (already analyzed)");
                $progressBar->advance();
                continue;
            }

            try {
                $this->analyzePdf($pdfFile);
                $progressBar->advance();
            } catch (\Exception $e) {
                Log::error("Error analyzing {$filename}: " . $e->getMessage());
                $this->error("\nError analyzing {$filename}: " . $e->getMessage());
                $progressBar->advance();
            }
        }

        $progressBar->finish();
        $this->newLine();
        $this->info('PDF analysis completed!');
        
        return 0;
    }

    private function analyzePdf($pdfFile)
    {
        $filename = basename($pdfFile);
        $this->line("\nAnalyzing: {$filename}");

        // Parse PDF
        $parser = new Parser();
        $pdf = $parser->parseFile($pdfFile);
        $text = $pdf->getText();

        if (empty(trim($text))) {
            $this->warn("No text content found in {$filename}");
            return;
        }

        // Extract metadata from filename
        $metadata = $this->extractMetadataFromFilename($filename);
        
        // Generate summary using AI
        $summary = $this->generateSummary($text, $metadata);
        
        // Extract keywords using AI
        $keywords = $this->extractKeywords($text, $metadata);
        
        // Extract model number and brand
        $modelNumber = $this->extractModelNumber($text, $filename);
        $brand = $this->extractBrand($text, $filename);
        $type = $this->extractType($text, $filename);

        // Store or update analysis
        ManualAnalysis::updateOrCreate(
            ['filename' => $filename],
            [
                'file_path' => $pdfFile,
                'summary' => $summary,
                'keywords' => $keywords,
                'metadata' => $metadata,
                'full_text' => Str::limit($text, 10000), // Store first 10k chars
                'model_number' => $modelNumber,
                'brand' => $brand,
                'type' => $type,
                'file_size' => filesize($pdfFile),
                'analyzed_at' => now(),
            ]
        );

        $this->info("✓ Analysis completed for {$filename}");
    }

    private function extractMetadataFromFilename($filename)
    {
        $metadata = [
            'original_filename' => $filename,
            'file_extension' => pathinfo($filename, PATHINFO_EXTENSION),
        ];

        // Extract information from filename patterns
        if (preg_match('/(\d+)_([A-Z_]+)_([A-Z0-9_-]+)_SPECSHEET/', $filename, $matches)) {
            $metadata['part_number'] = $matches[1] ?? null;
            $metadata['category'] = $matches[2] ?? null;
            $metadata['model_identifier'] = $matches[3] ?? null;
        }

        // Extract series information
        if (preg_match('/w_series/i', $filename)) {
            $metadata['series'] = 'W Series';
        }

        return $metadata;
    }

    private function generateSummary($text, $metadata)
    {
        $prompt = "Analyze this air conditioner manual text and provide a concise summary (2-3 sentences) focusing on the key specifications, features, and technical details. Include the model type, capacity, and main features.\n\nText: " . Str::limit($text, 2000);

        try {
            $result = Gemini::generativeModel(model: 'gemini-2.0-flash')->generateContent($prompt);
            return $result->text();
        } catch (\Exception $e) {
            // Fallback to basic text analysis
            return $this->generateBasicSummary($text);
        }
    }

    private function extractKeywords($text, $metadata)
    {
        $prompt = "Extract 10-15 relevant keywords from this air conditioner manual text. Focus on technical terms, model numbers, features, specifications, and common search terms. Return only the keywords separated by commas.\n\nText: " . Str::limit($text, 2000);

        try {
            $result = Gemini::generativeModel(model: 'gemini-2.0-flash')->generateContent($prompt);
            $keywords = array_map('trim', explode(',', $result->text()));
            return array_filter($keywords);
        } catch (\Exception $e) {
            // Fallback to basic keyword extraction
            return $this->extractBasicKeywords($text);
        }
    }

    private function extractModelNumber($text, $filename)
    {
        // Try to extract model number from text or filename
        $patterns = [
            '/\b([A-Z]{2,3}\d{2,3}[A-Z]?)\b/',
            '/\b(\d{2,3}[A-Z]{2,3}\d{2,3})\b/',
            '/\b([A-Z0-9]{6,12})\b/',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $text, $matches)) {
                return $matches[1];
            }
        }

        // Try from filename
        if (preg_match('/(\d{2,3}[A-Z]{2,3}\d{2,3})/', $filename, $matches)) {
            return $matches[1];
        }

        return null;
    }

    private function extractBrand($text, $filename)
    {
        $brands = ['Carrier', 'Bryant', 'Lennox', 'Trane', 'Rheem', 'Goodman', 'Amana', 'York', 'Rheem', 'Ruud'];
        
        foreach ($brands as $brand) {
            if (stripos($text, $brand) !== false || stripos($filename, $brand) !== false) {
                return $brand;
            }
        }

        return null;
    }

    private function extractType($text, $filename)
    {
        $types = [
            'air conditioner' => 'AC',
            'heat pump' => 'Heat Pump',
            'ductless' => 'Ductless',
            'mini split' => 'Mini Split',
            'package unit' => 'Package Unit',
        ];

        $textLower = strtolower($text . ' ' . $filename);
        
        foreach ($types as $keyword => $type) {
            if (strpos($textLower, $keyword) !== false) {
                return $type;
            }
        }

        return 'AC'; // Default
    }

    private function generateBasicSummary($text)
    {
        // Basic summary generation without AI
        $sentences = preg_split('/(?<=[.?!])\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);
        $relevantSentences = array_filter($sentences, function($sentence) {
            $keywords = ['specification', 'capacity', 'model', 'series', 'features', 'performance'];
            return array_any($keywords, function($keyword) use ($sentence) {
                return stripos($sentence, $keyword) !== false;
            });
        });

        return implode(' ', array_slice($relevantSentences, 0, 3));
    }

    private function extractBasicKeywords($text)
    {
        // Basic keyword extraction without AI
        $commonKeywords = [
            'air conditioner', 'heat pump', 'ductless', 'mini split', 'capacity', 'btu',
            'seer', 'efficiency', 'specifications', 'installation', 'maintenance',
            'cooling', 'heating', 'refrigerant', 'compressor', 'evaporator', 'condenser'
        ];

        $foundKeywords = [];
        foreach ($commonKeywords as $keyword) {
            if (stripos($text, $keyword) !== false) {
                $foundKeywords[] = $keyword;
            }
        }

        return $foundKeywords;
    }
}

// Helper function for array_any
if (!function_exists('array_any')) {
    function array_any($array, $callback) {
        foreach ($array as $item) {
            if ($callback($item)) {
                return true;
            }
        }
        return false;
    }
}