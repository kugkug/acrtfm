<?php

declare(strict_types=1);

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TechnicianController extends Controller
{
    public function updateCompanyConfirmation(Request $request, int $id): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => ['required', 'in:yes,no,YES,NO,Yes,No'],
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => $validator->errors()->first(),
                ], 422);
            }

            $user = auth()->user();

            if (! $user || $user->user_type !== config('acrtfm.user_types.company')) {
                return response()->json([
                    'status' => false,
                    'message' => 'Unauthorized access.',
                ], 403);
            }

            $status = strtolower($validator->validated()['status']);

            $technician = User::where('id', $id)
                ->where('company_code', $user->company_code)
                ->where('user_type', config('acrtfm.user_types.technician'))
                ->first();

            if (! $technician) {
                return response()->json([
                    'status' => false,
                    'message' => 'Technician not found.',
                ], 404);
            }

            $technician->is_company_confirmed = $status;
            $technician->save();

            return response()->json([
                'status' => true,
                'message' => 'Technician confirmation updated successfully.',
                'data' => [
                    'technician_id' => $technician->id,
                    'is_company_confirmed' => $technician->is_company_confirmed,
                ],
            ], 200);
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());

            return response()->json([
                'status' => false,
                'message' => 'Unable to update technician confirmation.',
            ], 500);
        }
    }
}

