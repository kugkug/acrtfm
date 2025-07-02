<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use GeminiAPI\Laravel\Facades\Gemini;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SearchEngineController extends Controller
{
    public function search(Request $request) {
        try {            
            $api_key = "AIzaSyAzD7Sl2Wf4JdQp5ucvdQYb2siGzmm1mn8";
            $cx = "f24a78313d83b40cb";
            $lr = "lang_en";
            $file_type = "pdf";
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
}