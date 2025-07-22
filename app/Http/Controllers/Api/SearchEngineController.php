<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ManualAnalysis;
use Exception;
use GeminiAPI\Laravel\Facades\Gemini;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchEngineController extends Controller
{
    public function search(Request $request) {
        try {            
            $api_key = config('google.api_key');
            $cx = config('google.cx');
            $lr = config('google.lr');
            $file_type = config('google.file_type');
            $q = $request->search_query;

            $url = "https://www.googleapis.com/customsearch/v1?key=$api_key&cx=$cx&lr=$lr&fileType=$file_type&q=" . urlencode($q);
            
            $response = Http::get($url);

            return $response;
        } catch(Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function ask_ai(Request $request) {
        try {    
            $search_query = $request->search_query;
            $result = Gemini::generativeModel(model: 'gemini-2.0-flash')->generateContent($search_query);
            $ai_response = $result->text();
            
            $api_key = config('gemini.google_api_key');
            $cx = config('gemini.google_cx_id');
            $lr = config('gemini.google_language');
            $file_type = "pdf";

            $url = "https://www.googleapis.com/customsearch/v1?key=$api_key&cx=$cx&lr=$lr&fileType=$file_type&q=" . urlencode($search_query);
            
            $se_response = Http::get($url);

            return [
                'status' => true,
                'ai_response' => $ai_response,
                'se_response' => $se_response['items'],
            ];
        } catch(Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function ask_grok_api(Request $request) {
        try {
            $search_query = $request->search_query;
            $url = "https://api.x.ai/v1/chat/completions";
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . config('services.grok.api_key'),
                'Content-Type' => 'application/json'
            ])->post($url, [
                'model' => 'grok-3-latest',
                'stream' => false,
                'temperature' => 0,
                'search_parameters' => [
                    'mode'=> 'auto',
                ],
                'messages' => [
                    ['role' => 'user', 'content' => $search_query], 
                ],
            ]);
            return $response;
        } catch(Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }

    public function search_from_manual_analysis(Request $request) {
        try {
            // Search for the query in the summary, keywords, and full_text fields for more intelligent matching
            $search_query = $request->search_query;

            // Try to find the most relevant manual analysis using full-text search if available, otherwise fallback to LIKE
            $manual_analysis = ManualAnalysis::query()
                ->where(function($q) use ($search_query) {
                    $q->where('keywords', 'like', '%' . $search_query . '%')
                      ->orWhere('summary', 'like', '%' . $search_query . '%')
                      ->orWhere('full_text', 'like', '%' . $search_query . '%');
                })
                ->orderByRaw("CASE 
                    WHEN keywords LIKE ? THEN 1
                    WHEN summary LIKE ? THEN 2
                    WHEN full_text LIKE ? THEN 3
                    ELSE 4 END", 
                    [
                        '%' . $search_query . '%',
                        '%' . $search_query . '%',
                        '%' . $search_query . '%'
                    ])
                ->get();

            if ($manual_analysis->isEmpty()) {
                return [
                    'status' => false,
                    'message' => 'No relevant manual found for your query.'
                ];
            }

            // Prepare the best answer and related PDFs
            $best = $manual_analysis->first();
            $answer = $best->summary ?? $best->full_text ?? '';
            $related_pdfs = $manual_analysis->map(function($item) {
                return [
                    'filename' => $item->filename,
                    'file_path' => $item->file_path,
                    'model_number' => $item->model_number,
                    'brand' => $item->brand,
                    'type' => $item->type,
                ];
            });

            return [
                'status' => true,
                'answer' => $answer,
                'related_pdfs' => $related_pdfs,
            ];
        } catch(Exception $e) {
            return ['status' => false, 'message' => $e->getMessage()];
        }
    }
}