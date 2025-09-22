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
            return globalHelper()->ajaxErrorResponse($e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        try {
            $api_response = apiHelper()->post($request, route('api-customers-update', ['id' => $id]));
            
            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'toast',
                'success',
                'customer-updated',
                'Customer successfully updated',
                'System Info',
            );
        }
        catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return globalHelper()->ajaxErrorResponse($e->getMessage());
        }
    }

    public function delete($id, Request $request)
    {
        try {
            $api_response = apiHelper()->post($request, route('api-customers-delete', ['id' => $id]));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'customers-deleted',
                'Customer deleted successfully',
                'System Info',
            );
        }
        catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return globalHelper()->ajaxErrorResponse($e->getMessage());
        }
    }

    public function save_location(Request $request)
    {
        try {
            $api_response = apiHelper()->post($request, route('api-customers-save-location'));
        
            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'customer-location-saved',
                'Location saved successfully',
                'System Info',
                ['id' => $request->CustomerId]
            );

        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return globalHelper()->ajaxErrorResponse($e->getMessage());
        }
    }

    public function update_location($id, Request $request)
    {
        try {
            $api_response = apiHelper()->post($request, route('api-customers-update-location', ['id' => $id]));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'toast',
                'success',
                'customer-location-updated',
                'Location updated successfully',
                'System Info',
            );
        }
        catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return globalHelper()->ajaxErrorResponse($e->getMessage());
        }
    }

    public function delete_location($id, Request $request)
    {
        try {
            $api_response = apiHelper()->post($request, route('api-customers-delete-location', ['id' => $id]));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'customer-location-deleted',
                'Location deleted successfully',
                'System Info',
            );
            
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return globalHelper()->ajaxErrorResponse($e->getMessage());
        }
    }

    public function save_equipment(Request $request)
    {
        try {
            $api_response = apiHelper()->post($request, route('api-customers-save-equipment'));

            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }
            
            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'customer-equipment-saved',
                'Equipment saved successfully',
                'System Info',
                ['id' => $request->CustomerId]
            );
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return globalHelper()->ajaxErrorResponse($e->getMessage());
        }
    }
}