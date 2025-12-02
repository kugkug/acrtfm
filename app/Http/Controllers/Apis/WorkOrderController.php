<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;
use App\Models\WorkOrderNote;
use App\Models\WorkOrderPhoto;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class WorkOrderController extends Controller
{
    /**
     * Get work order with access control based on user type
     */
    private function getAuthorizedWorkOrder($id)
    {
        $query = WorkOrder::where('id', $id);
        
        // Filter by user type for access control
        if (auth()->user()->user_type == config('acrtfm.user_types.company')) {
            // Company users can only access work orders they created
            $query->where('created_by', auth()->user()->id);
        } else {
            // Technician users can only access work orders assigned to them
            $query->where('technician_id', auth()->user()->id);
        }
        
        return $query->first();
    }

    public function save(Request $request): JsonResponse {
        try {
            $user = auth()->user();
            if ($user && $user->user_type === config('acrtfm.user_types.technician') && ! $user->isCompanyConfirmed()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Company confirmation is required before you can create work orders.',
                ], 403);
            }

            $validated = validatorHelper()->validate('work-orders-save', $request);

            if(! $validated['status']) {
                return response()->json([
                    'status' => false,
                    'message' => $validated['response']
                ]);
            }

            $validated['validated']['created_by'] = auth()->user()->id;
            
            // Set default status to 'pending' if not provided
            if (empty($validated['validated']['status'])) {
                $validated['validated']['status'] = 'pending';
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
                    'status' => false,
                    'message' => $validated['response']
                ]);
            }
            
            $work_order = $this->getAuthorizedWorkOrder($request->id);
            
            if (! $work_order) {
                return response()->json([
                    'status' => false,
                    'message' => 'Work Order not found or access denied',
                ]);
            }
            
            $work_order->update($validated['validated']);

            return response()->json([
                'status' => 'success',
                'message' => 'Work Order updated successfully',
                'data' => $work_order
            ]);
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete($id, Request $request): JsonResponse {
        try {
            $work_order = $this->getAuthorizedWorkOrder($id);
            
            if (! $work_order) {
                return response()->json([
                    'status' => false,
                    'message' => 'Work Order not found or access denied',
                ]);
            }
            
            $work_order->delete();

            return response()->json([
                'status' => true,
                'message' => 'Work Order deleted successfully',
            ]);
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function add_photos(Request $request): JsonResponse {
        try {
            $work_order = $this->getAuthorizedWorkOrder($request->work_order_id);

            if (! $work_order) {
                return response()->json([
                    'status' => false,
                    'message' => 'Work Order not found or access denied',
                ]);
            }

            $workOrderPhotos = $request->workOrderPhotos;

            if (! $workOrderPhotos) {
                return response()->json([
                    'status' => false,
                    'message' => 'Work Order photos not found',
                ]);
            }

            foreach ($workOrderPhotos as $workOrderPhoto) {
                $original_name = $workOrderPhoto->getClientOriginalName();
                $ext = $workOrderPhoto->getClientOriginalExtension();
                $new_filename = $original_name.'.'.$ext;
                $size = $workOrderPhoto->getSize();

                $file = Storage::disk('s3')->put('work-orders', $workOrderPhoto);
                $url = Storage::disk('s3')->url($file);

                $workOrderPhoto = WorkOrderPhoto::create([
                    'work_order_id' => $work_order->id,
                    'name' => $original_name,
                    'url' => $url,
                    'type' => $ext,
                    'size' => $size,
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'Work Order photos added successfully',
                'worker_id' => $request->work_order_id,
            ]);
            
        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }        
    }

    public function fetch_photos($id, Request $request): JsonResponse {
        try {
            $work_order = $this->getAuthorizedWorkOrder($id);

            if (! $work_order) {
                return response()->json([
                    'status' => false,
                    'message' => 'Work Order not found or access denied',
        
                ]);
            }

            $work_order_photos = WorkOrderPhoto::where('work_order_id', $work_order->id)->get();

            return response()->json([
                'status' => true,
                'message' => 'Work Order photos fetched successfully',
                'data' => $work_order_photos
            ]);
        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete_image($id, Request $request): JsonResponse {
        try {
            $work_order_photo = WorkOrderPhoto::where('id', $id)->first();
            if (! $work_order_photo) {
                return response()->json([
                    'status' => false,
                    'message' => 'Work Order image not found',
                ]);
            }

            $work_order_id = $work_order_photo->work_order_id;
            $work_order_photo->delete();

            return response()->json([
                'status' => true,
                'message' => 'Work Order image deleted successfully',
                'work_order_id' => $work_order_id,
            ]);
        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function add_note($id, Request $request): JsonResponse {
        try {
            $validated = validatorHelper()->validate('work-orders-add-note', $request);

            if (! $validated['status']) {
                return response()->json([
                    'status' => false,
                    'message' => $validated['response']
                ]);
            }
            
            $work_order = $this->getAuthorizedWorkOrder($id);
            
            if (! $work_order) {
                return response()->json([
                    'status' => false,
                    'message' => 'Work Order not found or access denied',
                ]);
            }

            $work_order_note = WorkOrderNote::create([
                'work_order_id' => $work_order->id,
                'note' => $validated['validated']['note'],
                'note_type' => $validated['validated']['note_type'],
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Work Order note added successfully',
                'data' => $work_order_note,
                'work_order_id' => $work_order->id,
            ]);
        }
        catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function fetch_notes($id, Request $request): JsonResponse {
        try {
            $work_order = $this->getAuthorizedWorkOrder($id);

            if (! $work_order) {
                return response()->json([
                    'status' => false,
                    'message' => 'Work Order not found or access denied',
                ]);
            }

            $work_order_notes = WorkOrderNote::where('work_order_id', $work_order->id)
            ->orderBy('updated_at', 'desc')
            ->get();

            return response()->json([
                'status' => true,
                'message' => 'Work Order notes fetched successfully',
                'data' => $work_order_notes
            ]);
        } catch(\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}