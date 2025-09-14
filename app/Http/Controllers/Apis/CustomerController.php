<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\Customer;
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
            return response()->json(['status' => false, 'message' => 'Customer save failed'], 500);
        }
    }
}