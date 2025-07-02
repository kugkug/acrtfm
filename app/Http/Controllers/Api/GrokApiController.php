<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GrokApiController extends Controller
{
    public function ask_grok() {

        $grok = Http::get("https://api.x.ai/v1/chat/completions", [
            'model' => 'grok-3-latest',
            'stream' => false,
            'temperature' => 0,
            'messages' => [
                ['role' => 'user', 'content' => 'Hello, how are you?']
            ]
        ]);
    }
}