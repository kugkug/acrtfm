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
            // return response()->json($api_response);
            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            $type = $request->search_type == "playlist" ? "education-playlist" : "education";
            
            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                $type,
                '',
                '',
                $api_response['data']
            );
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            logInfo($e->getTraceAsString());
            
            return globalHelper()->ajaxErrorResponse('Search failed');
        }
    }

    public function educationPaginate(Request $request): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-education-paginate'));
            
            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'education-paginate',
                '',
                '',
                [
                    "data" => $api_response['data'],
                    "current_page" => $request->input('page'),
                    "total" => $request->input('page_total'),
                ]
            );
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            logInfo($e->getTraceAsString());
            
            return globalHelper()->ajaxErrorResponse('Paginate failed');
        }
    }
}