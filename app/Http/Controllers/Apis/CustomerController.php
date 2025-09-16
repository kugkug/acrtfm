<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\Customer;
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
}