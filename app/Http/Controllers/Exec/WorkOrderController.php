<?php

namespace App\Http\Controllers\Exec;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WorkOrderController extends Controller
{
    public function save(Request $request): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-work-orders-save'));
            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'work-orders-saved',
                'Work Order saved successfully',
                'System Info',
            );  
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update($id, Request $request): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-work-orders-update', ['id' => $id]));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'toast',
                'success',
                'work-orders-updated',
                'Work Order updated successfully',
                'System Info',
            );
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete($id, Request $request): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-work-orders-delete', ['id' => $id]));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'work-orders-deleted',
                'Work Order deleted successfully',
                'System Info',
            );
        } catch (\Exception $e) {
                logInfo($e->getTraceAsString());
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }
    }