<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Smalot\PdfParser\Parser;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\Tokenization\WhitespaceTokenizer;

class AnalyzePdfs extends Command
{    
    protected $signature = 'app:analyze-pdfs {query : The search query or question}';
    
    protected $description = 'Analyze PDFs in the storage directory';

    public function handle()
    {
        $query = $this->argument('query');
        $pdfs = glob(public_path('manuals/*.pdf'));

        foreach ($pdfs as $pdfFile) {
            $this->info("Analyzing PDF: $pdfFile");
            $parser = new Parser();
            $pdf = $parser->parseFile($pdfFile);
            $text = $pdf->getText();

            // Split text into sentences
            $sentences = preg_split('/(?<=[.?!])\s+/', $text, -1, PREG_SPLIT_NO_EMPTY);

            // Prepare documents (sentences + query)
            $documents = $sentences;
            $documents[] = $query;

            // Vectorize
            $vectorizer = new TokenCountVectorizer(new WhitespaceTokenizer());
            $vectorizer->fit($documents);
            $vectorizer->transform($documents);

            // TF-IDF
            $tfIdf = new TfIdfTransformer($documents);
            $tfIdf->transform($documents);

            // Get query vector (last one)
            $queryVector = array_pop($documents);

            // Find best cosine similarity
            $bestScore = -1;
            $bestMatch = '';
            foreach ($documents as $i => $vector) {
                $score = $this->cosineSimilarity($queryVector, $vector);
                if ($score > $bestScore) {
                    $bestScore = $score;
                    $bestMatch = $sentences[$i];
                }
            }

            $this->info("Best match: " . $bestMatch);
            $this->info("Cosine similarity: " . round($bestScore, 4));
        }
    }

    // Helper function for cosine similarity
    private function cosineSimilarity($vecA, $vecB)
    {
        $dot = 0.0;
        $normA = 0.0;
        $normB = 0.0;
        foreach ($vecA as $i => $a) {
            $b = $vecB[$i] ?? 0;
            $dot += $a * $b;
            $normA += $a * $a;
            $normB += $b * $b;
        }
        return $normA && $normB ? $dot / (sqrt($normA) * sqrt($normB)) : 0.0;
    }
}