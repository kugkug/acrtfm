<?php

declare(strict_types=1);
namespace App\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ApiHelper {
    const REQUEST_POST = 'POST';
    const REQUEST_GET = 'GET';
    const REQUEST_PUT = 'PUT';
    const REQUEST_DELETE = 'DELETE';
    
    public function execute(Request $request, string $url): array {
        $api_call = $request->create($url, self::REQUEST_POST);
        $response = Route::dispatch($api_call);
        
        return json_decode($response->getContent(), true);
    }

    public function post(Request $request, string $url): array {
        $api_call = $request->create($url, self::REQUEST_POST);
        $response = Route::dispatch($api_call);
        
        return json_decode($response->getContent(), true);
    }
}