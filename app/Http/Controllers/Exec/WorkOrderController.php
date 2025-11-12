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

    /** Add Photos */

    public function add_photos(Request $request): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-work-orders-add-photos'));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'work-orders-photos-added',
                'Work Order photos added successfully',
                'System Info',
                [
                    'id' => $api_response['worker_id'],
                ]
            );
        }
        catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function fetch_photos($id, Request $request): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-work-orders-fetch-photos', ['id' => $id]));

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'work-orders-photos-fetched',
                'Work Order photos fetched successfully',
                'System Info',
                $api_response['data']
            );
            
        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete_image($id, Request $request): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-work-orders-delete-image', ['id' => $id]));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'work-orders-image-deleted',
                'Work Order image deleted successfully',
                'System Info',
                [
                    'id' => $api_response['work_order_id'],
                ]
            );
        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function add_note($id, Request $request): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-work-orders-add-note', ['id' => $id]));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'work-orders-note-added',
                'Work Order note added successfully',
                'System Info',
                [
                    'id' => $api_response['work_order_id'],
                ]
            );
        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function fetch_notes($id, Request $request): JsonResponse {
        try {
            $api_response = apiHelper()->post($request, route('api-work-orders-fetch-notes', ['id' => $id]));

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'work-orders-notes-fetched',
                'Work Order notes fetched successfully',
                'System Info',
                $api_response['data']
            );
        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function generate_quotation($id) {
        try {
            $work_order = globalHelper()->getWorkOrder($id);
            
            if (empty($work_order)) {
                return redirect()->route('work-orders')->with('error', 'Work Order not found');
            }

            $pdf = \PDF::loadView('pdf.quotation', ['work_order' => $work_order]);
            
            $filename = 'quotation_WO-' . str_pad($work_order['id'], 6, '0', STR_PAD_LEFT) . '_' . date('Ymd') . '.pdf';
            
            return $pdf->download($filename);
        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            return redirect()->back()->with('error', 'Failed to generate quotation: ' . $e->getMessage());
        }
    }
}