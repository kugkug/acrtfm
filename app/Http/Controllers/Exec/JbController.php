<?php

namespace App\Http\Controllers\Exec;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JbController extends Controller
{
    public function fetch(Request $request): JsonResponse{
        try {
            $api_response = apiHelper()->post($request, route('api-job-sites-fetch'));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'job-sites-fetched',
                'Job Sites fetched successfully',
                'System Info',
                $api_response['data']
            );
        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }   

    public function save(Request $request): JsonResponse{
        try {
            $api_response = apiHelper()->post($request, route('api-job-sites-save'));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'job-sites-saved',
                'Job Site saved successfully',
                'System Info',
            );
        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete(Request $request): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-job-sites-delete'));
            
            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'job-sites-deleted',
                'Job Site deleted successfully',
                'System Info',
            );
        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }   
    }

    public function jobSiteDelete(Request $request, $sub_id): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-job-delete', $sub_id));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'sub-job-site-deleted',
                'Job Site deleted successfully',
                'System Info',
            );

            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete_job_site_area(Request $request): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-job-site-area-delete'));


        if(! $api_response['status']) {
            return globalHelper()->ajaxErrorResponse($api_response['message']);
        }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'job-site-area-deleted',
                'Job Site Area deleted successfully',
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