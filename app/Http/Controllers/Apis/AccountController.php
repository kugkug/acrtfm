<?php

declare(strict_types=1);

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

    public function registrationCompany(Request $request): JsonResponse{
        try {

            $validated = validatorHelper()->validate('company-registration', $request);

            if(! $validated['status']){
                return response()->json([
                    'status' => false,
                    'message' => $validated['response']
                ]);
            }

            unset($validated['validated']['password_confirmation']);
            
            $validated['validated']['company_code'] = globalHelper()->generateCompanyCode();
            $validated['validated']['user_type'] = config('acrtfm.user_types.company');
            $validated['validated']['name'] = $validated['validated']['company'];

            $user = User::create($validated['validated']);

            if(! $user){
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to create user'
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'user' => $user
            ], 200);    

            return response()->json($validated, 200);
        }
        catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function registrationTechnician(Request $request): JsonResponse{
        try {

            $validated = validatorHelper()->validate('technician-registration', $request);

            if(! $validated['status']){
                return response()->json([
                    'status' => false,
                    'message' => $validated['response']
                ]);
            }

            unset($validated['validated']['password_confirmation']);
            $validated['validated']['contact'] = $validated['validated']['phone'];
            $validated['validated']['user_type'] = config('acrtfm.user_types.technician');
            $validated['validated']['name'] = $validated['validated']['first_name'] . ' ' . $validated['validated']['last_name'];

            unset($validated['validated']['phone']);
            $user = User::create($validated['validated']);

            if(! $user) {
                return response()->json(['status' => false, 'message' => 'Failed to create user'], 500);
            }

            return response()->json(['status' => true, 'message' => 'User created successfully', 'user' => $user], 200);    
        }
        catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
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
            $user = auth()->guard()->user();
            $user->tokens()->delete();
            return response()->json(['status' => true, 'message' => 'Logout successful'], 200);
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['status' => false, 'message' => 'Logout failed'], 500);
        }
    }

    public function updateProfile(Request $request): JsonResponse{
        try {
            $validated = validatorHelper()->validate('profile-update', $request);
            
            if(! $validated['status']) {
                return response()->json([
                    'status' => false,
                    'message' => $validated['response']
                ], 400);
            }

            $user = auth()->user();
            
            // For company users: update name when company name changes
            if ($user->user_type === config('acrtfm.user_types.company')) {
                if (isset($validated['validated']['company'])) {
                    $validated['validated']['name'] = $validated['validated']['company'];
                }
            }
            
            // Update name if first_name or last_name changed (for other user types)
            if (isset($validated['validated']['first_name']) || isset($validated['validated']['last_name'])) {
                $first_name = $validated['validated']['first_name'] ?? $user->first_name ?? '';
                $last_name = $validated['validated']['last_name'] ?? $user->last_name ?? '';
                $validated['validated']['name'] = trim($first_name . ' ' . $last_name);
            }

            $user->update($validated['validated']);

            return response()->json([
                'status' => true,
                'message' => 'Profile updated successfully',
                'data' => $user->fresh()
            ], 200);
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}