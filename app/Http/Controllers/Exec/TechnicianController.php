<?php

declare(strict_types=1);

namespace App\Http\Controllers\Exec;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function updateCompanyConfirmation(int $id, Request $request): RedirectResponse
    {
        $request->merge(['status' => strtolower((string) $request->input('status'))]);

        $request->validate([
            'status' => ['required', 'in:yes,no'],
        ]);

        try {
            $apiResponse = apiHelper()->post($request, route('api-technicians-company-confirmation', ['id' => $id]));

            if (! ($apiResponse['status'] ?? false)) {
                return redirect()
                    ->route('technicians')
                    ->with('error', $apiResponse['message'] ?? 'Failed to update technician access.');
            }

            return redirect()
                ->route('technicians')
                ->with('success', $apiResponse['message'] ?? 'Technician access updated successfully.');
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());

            return redirect()
                ->route('technicians')
                ->with('error', 'Unable to update technician access at this time.');
        }
    }
}

