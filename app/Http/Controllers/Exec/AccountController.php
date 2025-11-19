<?php

declare(strict_types=1);

namespace App\Http\Controllers\Exec;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function registration(Request $request): JsonResponse{
        try {
            $api_response = apiHelper()->post($request, route('api-technician-registration'));
            return response()->json($api_response, 200);
            if ($api_response['status'] == 'success') {
                return globalHelper()->ajaxSuccessResponse(
                    'scripts',
                    'success',
                    'login',
                    'Login successful',
                    'Login successful'
                );
            } else {
                return globalHelper()->ajaxErrorResponse('Account creation failed');
            }
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['error' => 'Account creation failed'], 500);
        }
    }

    public function registrationCompany(Request $request): JsonResponse{
        try {
            $api_response = apiHelper()->post($request, route('api-company-registration'));
            if(! $api_response['status']){
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }
            
            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'company-registration',
                'Company registration successful',
                'Company registration successful'
            );
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return globalHelper()->ajaxErrorResponse('Company registration failed');
        }
    }

    public function registrationTechnician(Request $request): JsonResponse{
        try {
            $api_response = apiHelper()->post($request, route('api-technician-registration')); 

            if(! $api_response['status']){
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'technician-registration',
                'Technician registration successful',
                'Technician registration successful'
            );
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return globalHelper()->ajaxErrorResponse('Technician creation failed');
        }
    }   
    public function login(Request $request): JsonResponse{
        try {
            $api_response = apiHelper()->post($request, route('api-account-login'));

            if(! $api_response['status']){
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'login',
                'Login successful',
                'Login successful'
            );
            
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return globalHelper()->ajaxErrorResponse('Login failed');
        }
    }

    public function logout(Request $request): JsonResponse{
        try {
            $api_response = apiHelper()->post($request, route('api-account-logout'));
            if(! $api_response['status']){
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'logout',
                'Logout successful',
                'Logout successful'
            );
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['error' => 'Logout failed'], 500);
        }
    }

    public function updateProfile(Request $request): JsonResponse{
        try {
            $api_response = apiHelper()->post($request, route('api-profile-update'));
            
            if(! $api_response['status']) {
                return globalHelper()->ajaxErrorResponse($api_response['message']);
            }

            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'profile-updated',
                'Profile updated successfully',
                'System Info',
            );
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return globalHelper()->ajaxErrorResponse($e->getMessage());
        }
    }
}