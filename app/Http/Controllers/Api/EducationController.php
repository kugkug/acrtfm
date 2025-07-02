<?php

declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
{
    public function list(Request $request): mixed {
        $is_playlist = false;
        if ($request->type == "fetch") {
            $search_by = $request->search_by;
            $search_text = $request->search_text;

            $request->session()->put('sess_search_by', $request->search_by);
            $request->session()->put('sess_search_text', $request->search_text);
        } else {
            $search_by = $request->session()->get('sess_search_by');
            $search_text = $request->session()->get('sess_search_text');
        }
        
        if ($search_by == "") {
            $educations = Education::orderBy('category', 'asc')
                ->orderBy('url', 'asc')
                ->paginate(15)->toArray();
        } elseif($search_by == "category_name") {
            $educations = Education::where('category', $search_text)                
                ->orderBy('url', 'asc')
                ->paginate(15)->toArray();
        } else if ($search_by == "presentor_name") {
            $educations = Education::where('presented_by', 'like', '%'.$search_text.'%')
            ->orderBy('url', 'asc')
            ->paginate(15)->toArray();
        } else if ($search_by == "playlist_name") {
            $educations = Education::where('playlist', $search_text)
            ->orderBy('id', 'asc')
            ->get()->toArray();

            $is_playlist = true;
        } else if ($search_by == "keyword") {
            $educations = Education::where('presented_by', 'like', '%'.$search_text.'%')
            ->orWhere('url', 'like', '%'.$search_text.'%')
            ->orderBy('url', 'asc')
            ->paginate(15)->toArray();
        }
        
        return Education::createVideosTable($educations, $request->type, $is_playlist);
    }
}