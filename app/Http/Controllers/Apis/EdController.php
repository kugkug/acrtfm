<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EdController extends Controller
{
    public function educationSearch(Request $request): JsonResponse {
        try {
            $is_playlist = false;
            $search_type = $request->input('search_type');
            $search_text = $request->input('search_text');

            if ($search_type == "") {
                $educations = Education::orderBy('category', 'asc')->paginate(15)->toArray();

                return response()->json(['status' => true, 'message' => 'Search successful', 'data' => $educations]);
            }

            return response()->json(['status' => true, 'message' => 'Search successful', 'data' => $request->all()]);
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }
}