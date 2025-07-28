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

            
            $educations = [];
            if ($search_type == "") {
                $educations = Education::orderBy('category', 'asc')->paginate(15)->toArray();
            } else if ($search_type == "category") {
                $educations = Education::where('category', $search_text)->orderBy('category', 'asc')->paginate(15)->toArray();
            } else if ($search_type == "presentor") {
                $educations = Education::where('presented_by', $search_text)->orderBy('presented_by', 'asc')->paginate(15)->toArray();
            } else if ($search_type == "keyword") {
                $educations = Education::where('presented_by', 'like', '%'.$search_text.'%')
                ->orWhere('url', 'like', '%'.$search_text.'%')
                ->orderBy('url', 'asc')->paginate(15)->toArray();   
            } else if ($search_type == "playlist") {
                $educations = Education::where('playlist', $search_text)->orderBy('category', 'asc')->get()->toArray();
            } 

            return response()->json(['status' => true, 'message' => 'Search successful', 'data' => $educations]);
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function educationPaginate(Request $request): JsonResponse {
        try {
            $is_playlist = false;
            $search_type = $request->input('search_type');
            $search_text = $request->input('search_text');

            if ($search_type == "") {
                $educations = Education::offset($request->input('page') * 15)->limit(15)->orderBy('category', 'asc')->get()->toArray();
            } else if ($search_type == "category") {
                $educations = Education::where('category', $search_text)->offset($request->input('page') * 15)->limit(15)->orderBy('category', 'asc')->get()->toArray();
            } else if ($search_type == "presentor") {
                $educations = Education::where('presented_by', $search_text)->offset($request->input('page') * 15)->limit(15)->orderBy('presented_by', 'asc')->get()->toArray();
            } else if ($search_type == "playlist") {
                $educations = Education::where('playlist', $search_text)->offset($request->input('page') * 15)->limit(15)->orderBy('category', 'asc')->get()->toArray();
            } else if ($search_type == "keyword") {
                $educations = Education::where('presented_by', 'like', '%'.$search_text.'%')
                ->orWhere('url', 'like', '%'.$search_text.'%')
                ->orderBy('url', 'asc')->get()->toArray();
            }

            return response()->json(['status' => true, 'message' => 'Search successful', 'data' => $educations]);
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            logInfo($e->getTraceAsString());
            return response()->json(['status' => false, 'message' => 'Failed to fetch'], 500);
        }
    }
}