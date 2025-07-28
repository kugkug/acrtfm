<?php

namespace App\Http\Controllers\Exec;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AcController extends Controller
{
    public function search(Request $request): JsonResponse{
        try {
            $api_response = apiHelper()->post($request, route('api-model-lookup-search'));
            
            if(! $api_response['status']){
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'model-lookup',
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