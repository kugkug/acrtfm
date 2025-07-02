<?php

namespace App\Http\Controllers;

use App\Models\Modules;
use Exception;
use Illuminate\Http\Request;

class SystemModulesController extends Controller
{
    public function store(Request $request) {
        try {
            $validated = $request->validate([     
                "title" => ['required','max:255'],
                "label" => ['required','max:255'],
                "id" => ['required']
            ]);

            return Modules::updateOrCreate(['id' => strtolower($validated['id'])], $validated);
        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 400);
        }
    }
}