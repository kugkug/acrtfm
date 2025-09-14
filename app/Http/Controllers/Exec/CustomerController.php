<?php

namespace App\Http\Controllers\Exec;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{    
    public function save(Request $request)
    {
        try {
            $api_response = apiHelper()->post($request, route('api-customers-save'));
            
            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'customers-saved',
                'Customer saved successfully',
                'System Info',
                $api_response['data']
            );
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['error' => 'Customer save failed'], 500);
        }
    }
}