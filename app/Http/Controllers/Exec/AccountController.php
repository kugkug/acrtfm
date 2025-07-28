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
            $api_response = apiHelper()->post($request, route('api-account-registration'));
            return response()->json($api_response, 200);
            // if ($api_response['status'] == 'success') {
            //     return redirect()->route('login')->with('success', 'Account created successfully');
            // } else {
            //     return redirect()->route('register')->with('error', 'Account creation failed');
            // }
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['error' => 'Account creation failed'], 500);
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
}