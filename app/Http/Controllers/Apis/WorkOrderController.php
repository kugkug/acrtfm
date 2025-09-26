<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class WorkOrderController extends Controller
{
    public function save(Request $request): JsonResponse {
        try {
            $validated = validatorHelper()->validate('work-orders-save', $request);

            if(! $validated['status']) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validated['message']
                ]);
            }

            $work_order = WorkOrder::create($validated['validated']);

            return response()->json([
                'status' => 'success',
                'message' => 'Work Order saved successfully',
                'data' => $work_order
            ]);
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request): JsonResponse {
        try {
            $validated = validatorHelper()->validate('work-orders-update', $request);
            
            if(! $validated['status']) {
                return response()->json([
                    'status' => 'error',
                    'message' => $validated['message']
                ]);
            }
            
            $work_order = WorkOrder::where('id', $request->id)->first();
            $work_order->update($validated['validated']);

            return response()->json([
                'status' => 'success',
                'message' => 'Work Order updated successfully',
                'data' => $work_order
            ]);
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
            $work_order = WorkOrder::where('id', $id)->first();
            $work_order->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Work Order deleted successfully',
            ]);
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}