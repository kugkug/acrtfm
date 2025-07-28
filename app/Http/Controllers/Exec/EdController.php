<?php

namespace App\Http\Controllers\Exec;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EdController extends Controller
{
    public function educationSearch(Request $request): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-education-search'));
            
            if(! $api_response['status']){
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'education',
                '',
                '',
                $api_response['data']['data']
            );
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return globalHelper()->ajaxErrorResponse('Search failed');
        }
        
    }
}