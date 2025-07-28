<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\Airconditioner;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AcController extends Controller
{
    public function search(Request $request): JsonResponse{
        try {
            $search_texts = explode("*", $request->search);
            if ($request->search == "")  {
                return response()->json( [
                        'status' => true,
                        'data' => [],
                    ], 200
                );
            }

            $data = [];
            
            if (sizeof($search_texts) > 1) {
                $data = Airconditioner::where('url', '<>', null)
                ->Where(function($query) use ($search_texts) {
                    foreach($search_texts as $search_text) {
                        $query->where('sku', 'like', '%'.$search_text.'%');
                    }
                })->with('manuals')
                ->orderBy('sku', 'asc')
                ->simplePaginate(50)->toArray();
                
            } else {
                $data = Airconditioner::where('sku', 'like',  '%'.$search_texts[0].'%')
                ->with('manuals')
                ->orderBy('sku', 'asc')
                ->simplePaginate(50)->toArray(); // wild card searching
            }

            return response()->json( [
                'status' => true,
                'data' => $data,
            ], 200
        );
        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return response()->json( [
                'status' => false,
                'message' => 'Search failed',
            ], 500
        );
        }
    }
}