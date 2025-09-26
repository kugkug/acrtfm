<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerEquipment;
use App\Models\CustomerLocation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    public function save(Request $request): JsonResponse{
        try {

            $validated = validatorHelper()->validate('customers-save', $request);

            if(! $validated['status']) {
                return response()->json(['status' => false, 'message' => $validated['response']], 400);
            }

            $validated['validated']['created_by'] = auth()->user()->id;

            $customer = Customer::create($validated['validated']);
            
            return response()->json([
                'status' => true, 
                'message' => 'Customer save successful', 
                'data' => $customer,
            ], 200);
            
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update($id, Request $request): JsonResponse{
        try {
            $validated = validatorHelper()->validate('customers-update', $request);
            if(! $validated['status']) {
                return response()->json(['status' => false, 'message' => $validated['response']], 400);
            }

            $customer = Customer::where('id', $id)->update($validated['validated']);

            return response()->json([
                'status' => true,
                'message' => 'Customer update successful',
                'data' => $customer,
            ], 200);

        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function delete($id, Request $request): JsonResponse{
        try {
            $customer = Customer::where('id', $id)->first();
            $customer->delete();

            return response()->json([
                'status' => true,
                'message' => 'Customer delete successful',
            ], 200);
        }
        catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function save_location(Request $request): JsonResponse{
        try {
            $validated = validatorHelper()->validate('customers-save-location', $request);
            
            if(! $validated['status']) {
                return response()->json(['status' => false, 'message' => $validated['response']], 400);
            }

            $location = CustomerLocation::create($validated['validated']);

            return response()->json([
                'status' => true,
                'message' => 'Location save successful',
                'data' => $location,
            ], 200);
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update_location(Request $request): JsonResponse{
        try {
            $validated = validatorHelper()->validate('customers-update-location', $request);

            if(! $validated['status']) {
                return response()->json(['status' => false, 'message' => $validated['response']], 400);
            }

            $location = CustomerLocation::where('id', $request->id)->update($validated['validated']);
            if(! $location) {
                return response()->json(['status' => false, 'message' => 'Location not found'], 404);
            }

            return response()->json([
                'status' => true,
                'message' => 'Location update successful',
                'data' => $location,
            ], 200);
        }
        catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function delete_location(Request $request): JsonResponse{
        try {
            $location = CustomerLocation::where('id', $request->id)->first();
            $location->delete();

            return response()->json([
                'status' => true,
                'message' => 'Location delete successful',
            ], 200);
        }
        catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function save_equipment(Request $request): JsonResponse{
        try {
            $validated = validatorHelper()->validate('customers-save-equipment', $request);
            
            if(! $validated['status']) {
                return response()->json(['status' => false, 'message' => $validated['response']], 400);
            }

            $equipment = CustomerEquipment::create($validated['validated']);

            return response()->json([
                'status' => true,
                'message' => 'Equipment save successful',
                'data' => $equipment,
            ], 200);

        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function update_equipment(Request $request): JsonResponse{
        try {
            $validated = validatorHelper()->validate('customers-update-equipment', $request);

            if(! $validated['status']) {
                return response()->json(['status' => false, 'message' => $validated['response']], 400);
            }

            $equipment = CustomerEquipment::where('id', $request->id)->update($validated['validated']);
            
            return response()->json([
                'status' => true,
                'message' => 'Equipment update successful',
                'data' => $equipment,
            ], 200);

        }
        catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function delete_equipment(Request $request): JsonResponse{
        try {
            $equipment = CustomerEquipment::where('id', $request->id)->first();
            $equipment->delete();

            return response()->json([
                'status' => true,
                'message' => 'Equipment delete successful',
            ], 200);
        }
        catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }   
}