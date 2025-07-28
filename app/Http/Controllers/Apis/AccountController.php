<?php

declare(strict_types=1);

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function registration(Request $request): JsonResponse{
        try {
            if ($request->ConfirmPassword != $request->Password) {
                return response()->json(['error' => 'Password and Confirm Password do not match'], 400);
            }
            
            $validated = validatorHelper()->validate('account-registration', $request);
            
            return response()->json($validated, 200);
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['error' => 'Account creation failed'], 500);
        }
    }

    public function login(Request $request): JsonResponse{
        try {
            
            $validated = validatorHelper()->validate('account-login', $request);

            if (!auth()->guard()->attempt($validated['validated'])) {
                return response()->json(['status' => false, 'message' => 'Username or password is incorrect'], 404);
            }
            
            $user = auth()->guard()->user();
            $token = $user->createToken('auth_token')->plainTextToken;
            return response()->json([
                'status' => true,
                'user' => $user,
                'token' => $token
            ], 200);

        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['status' => false, 'message' => 'Login failed'], 500);
        }
    }

    public function logout(Request $request): JsonResponse{
        try {
            $validated = validatorHelper()->validate('account-logout', $request);
            return response()->json($validated, 200);
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['status' => false, 'message' => 'Logout failed'], 500);
        }
    }
}