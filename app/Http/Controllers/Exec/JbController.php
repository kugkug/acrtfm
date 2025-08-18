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
            $response_exec = $request->has('sub_id') ? 'job-sites-added' : 'job-sites-saved';

            $api_response = apiHelper()->post($request, route('api-job-sites-save'));            

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }
            
            $response_exec = $request->has('sub_id') ? 'job-sites-added' : 'job-sites-saved';

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                $response_exec,
                'Job Site saved successfully',
                'System Info',
                [
                    'id' => $request->has('sub_id') ? $request->sub_id : null
                ]
            );
        } catch(Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-job-site-update'));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'job-site-updated',
                'Job Site Area updated successfully',
                'System Info',
            );
            
        } catch(Exception $e) {
            logInfo($e->getTraceAsString());
            return globalHelper()->ajaxErrorResponse($e->getMessage());
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
                [
                    'id' => $request->site_id
                ]
            );
        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update_job_site_area(Request $request): JsonResponse {

        try {
            $api_response = apiHelper()->post($request, route('api-job-site-area-update'));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'job-site-area-updated',
                'Job Site Area updated successfully',
                'System Info',
            );

        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete_image(Request $request): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-job-site-image-delete'));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'job-site-image-deleted',
                'Job Site Image deleted successfully',
                'System Info',
            );
        } catch(Exception $e) {
            logInfo($e->getTraceAsString());
            return globalHelper()->ajaxErrorResponse($e->getMessage());
        }
    }

    public function delete_document(Request $request): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-job-site-document-delete'));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'job-site-document-deleted',
                'Job Site Document deleted successfully',
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