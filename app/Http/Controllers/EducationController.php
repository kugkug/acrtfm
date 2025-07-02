<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $categories = [];
    public $presentors = [];
    public $headers = [];

    public function __construct() {
        $this->categories = DB::table('educations')->groupBy('category')->pluck('category');
        $this->headers = Session::get("app_module_list");

        $presentors = DB::table('educations')->groupBy('presented_by')->pluck('presented_by');
        $temp_presentor = "";
        foreach($presentors as $presentor) 
            $temp_presentor .= $presentor.",";
        
        foreach(explode(",", $temp_presentor) as $temp) {
            if (!empty($temp) && ! in_array(trim($temp), $this->presentors)) {
                $this->presentors[] = trim($temp);
            }
        }
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $keyword = $request->keyword;
        $category_name = $request->category_name;
        $presentor_name = $request->presentor_name;
        $playlist_name = $request->playlist_name;
        $search_type = $request->search_type;
        

        if ($search_type == "") {
            $educations = Education::orderBy('category', 'asc')
            ->orderBy('url', 'asc')
            ->simplePaginate(12)->appends(request()->query()); // wild card searching
        } else if ($search_type == "category") {
            $educations = Education::where('category', $category_name)
            ->orderBy('url', 'asc')
            ->simplePaginate(12)->appends(request()->query()); // wild card searching
        } else if ($search_type == "presentor") {
            $educations = Education::where('presented_by', 'like', '%'.$presentor_name.'%')
            ->orderBy('url', 'asc')
            ->simplePaginate(12)->appends(request()->query()); // wild card searching
        } else if ($search_type == "keyword") {
            // dd($keyword);
            $educations = Education::where('presented_by', 'like', '%'.$keyword.'%')
            ->orWhere('url', 'like', '%'.$keyword.'%')
            ->orderBy('url', 'asc')
            ->simplePaginate(12)->appends(request()->query()); // wild card searching
        }

        $data = [
            'title' => '', 
            'header' => $this->headers['education']['title'] ?? "Educational Videos",
            'search_type' => $search_type,
            'search_value' => '',
            'category_name' => $category_name,
            'presentor_name' => $presentor_name,
            'playlist_name' => $playlist_name,
            'keyword' => $keyword,
            'categories' => $this->categories,
            'presentors' => $this->presentors,
            'educations' => $educations
        ];
        // return view("clients.index", $data);
        return view('clients.educations', $data)->with("root_url", URL::current());
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Education $education)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Education $education)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $education)
    {
        //
    }
}