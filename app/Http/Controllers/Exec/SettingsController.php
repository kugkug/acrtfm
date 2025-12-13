<?php

namespace App\Http\Controllers\Exec;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function toggleTheme(Request $request): JsonResponse
    {
        try {
            $theme = $request->input('Theme', 'light');
            
            // Validate theme value
            if (!in_array($theme, ['light', 'dark'])) {
                return globalHelper()->ajaxErrorResponse('Invalid theme value');
            }

            $user = auth()->user();
            if (!$user) {
                return globalHelper()->ajaxErrorResponse('User not authenticated');
            }

            // Update user theme
            $user->theme = $theme;
            $user->save();

            // Return success response with script to apply theme
            return globalHelper()->ajaxSuccessResponse(
                'scripts',
                'success',
                'theme-toggled',
                'Theme updated successfully',
                'System Info',
                ['theme' => $theme]
            );
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return globalHelper()->ajaxErrorResponse($e->getMessage());
        }
    }
}
