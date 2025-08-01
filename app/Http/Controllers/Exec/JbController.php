<?php

namespace App\Http\Controllers\Exec;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JbController extends Controller
{
    public function save(Request $request): JsonResponse{
        try {
            $api_response = apiHelper()->post($request, route('api-jobs-save'));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'accomplishments-saved',
                'Job saved successfully',
                'System Info',
            );
        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}