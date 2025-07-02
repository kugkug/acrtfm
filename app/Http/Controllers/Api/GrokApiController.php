<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GrokApiController extends Controller
{
    public function ask_grok() {

        $grok = Http::get()
    }
}