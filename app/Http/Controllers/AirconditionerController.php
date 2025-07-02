<?php

namespace App\Http\Controllers;

use App\Models\Airconditioner;
use App\Models\MissingModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

class AirconditionerController extends Controller
{
    public $brands = [];
    /**
     * Display a listing of the resource.
     */

    public function __construct()
    {
        $this->brands = DB::table('airconditioners')->groupBy('brand')->pluck('brand');
    }
    public function index()
    {
        $airconditioners = Airconditioner::orderBy('sku', 'asc')->simplePaginate(20);
        // $airconditioners = Airconditioner::orderBy('sku', 'asc')->paginate(20);
        $data = [
            'title' => '', 
            'header' => 'List of Air Conditioners', 
            'search_type' => '',
            'search_value' => '',
            'brand_name' => '',
            'brands' => $this->brands,
            'airconditions' => $airconditioners
        ];
        return view("clients.index", $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'ACRFTM - New', 
            'brands' => $this->brands,
            'header' => 'New - Aircondition'
        ];
        return view("admin.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $url = "";
            $validated = $request->validate([
                "sku" => ['required'],
                "brand" => ['required'],
                "url" => ['sometimes'],
            ]);

            $search = Airconditioner::where('sku', $validated['sku'])->get()->first();

            if ($search)
                return back()->with("error_message", "SKU Already Exists");    

            if ($request->model_link !== null)
                $url .= "[".$validated['sku']."](".$request->model_link.")\n";

            if ($request->installation_manual !== null)
                $url .= "[Installation Manual](".$request->installation_manual.")\n";

            if ($request->operation_manual !== null)
                $url .= "[Operation Manual](".$request->operation_manual.")\n";

            if ($request->parts_manual !== null)
                $url .= "[Parts Manual](".$request->parts_manual.")\n";
            
            if ($request->service_manual !== null)
                $url .= "[Service Manual](".$request->service_manual.")\n";
            
            if ($request->m_p_troubleshooter !== null)
                $url .= "[M&P Troubleshooter](".$request->m_p_troubleshooter.")\n";


            $ac_data = [
                'sku' => $validated['sku'],
                'brand' => $validated['brand'],
                "url" => $url,
            ];

            Airconditioner::create($ac_data);
            return back()->with("message", "AC Model Successfully Added");
        } catch (ValidationException $ve) {
            return back()->with("error_message", $ve->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $search_type = $request->search_by;
        $brand_name = $request->brand_name;
        $table_search = $request->table_search;

        $data = Airconditioner::where('brand', $brand_name)
        ->where('sku', 'like', '%'.$table_search.'%')
        ->orderBy('brand', 'asc')->simplePaginate(20)->appends(request()->query()); // wild card searching
 

        $data = [
            'title' => '', 
            'header' => 'List of Air Conditioners', 
            'search_type' => $search_type,
            'search_value' => $table_search,
            'brand_name' => $brand_name,
            'brands' => $this->brands,
            'airconditions' => $data
        ];
        // return view("clients.index", $data);
        return view("clients.manufacturers", $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $airconditioner = Airconditioner::where('id', $id)
        ->with('manuals')
        ->get(); // wild card searching 
        $data = [
            'title' => 'ACRFTM - Edit', 
            'header' => 'Edit - Aircondition', 
            'aircondition' => $airconditioner,
            'id' => $id,
        ];
        return view("admin.edit", $data);
    }

    public function bulk_upload()
    {
        // $airconditioner = Airconditioner::where('id', $id)
        // ->with('manuals')
        // ->get(); // wild card searching 
        $data = [
            'title' => 'ACRFTM - Group Upload', 
            'header' => 'Group Upload - Aircondition', 
            'aircondition' => [],
        ];
        return view("admin.bulk-upload", $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Airconditioner $ac, $id)
    {
        $validated = $request->validate([
            "sku" => ['required'],
            "brand" => ['required'],
            "url" => ['required'],
        ]);

        $ac->where('id', $id)->update($validated);

        return back()->with("message", "Successfully Updated");
    }


    public function models($brand)
    {
        $data = Airconditioner::where('brand', $brand)->orderBy('sku', 'asc')->simplePaginate(20)->appends(request()->query()); // wild card searching

        $data = [
            'title' => '', 
            'header' => $brand,
            'airconditions' => $data
        ];
        return view("clients.models", $data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function search_model(Request $request) {
        $data = [];
        $search_texts = explode("*", $request->search);

        if ($request->search == "") 
            return [];
        
        if (sizeof($search_texts) > 1) {
            $data = Airconditioner::where('url', '<>', null)
            ->Where(function($query) use ($search_texts) {
                foreach($search_texts as $search_text) {
                    $query->where('sku', 'like', '%'.$search_text.'%');
                }
            })
            ->with('manuals')
            ->orderBy('sku', 'asc')
            ->simplePaginate(100);
            
        } else {

            $data = Airconditioner::where('sku', 'like',  '%'.$search_texts[0].'%')->with('manuals')->orderBy('sku', 'asc')->simplePaginate(100); // wild card searching
        }
        
        return response()->json($data);
    }

    public function search_manual(Request $request) {
        try {
            $api_request = $request->create('/api/search-manuals', 'GET');
            $api_response = Route::dispatch($api_request);

            $json_response = json_decode($api_response->getContent(), true);

            return $json_response['items'];
        } catch (Exception $e) {
            return ['message' => $e->getMessage()];
        }
        
        // if ($request->search == "") 
        //     return [];
        
        // if (sizeof($search_texts) > 1) {
        //     $data = Airconditioner::where('url', '<>', null)
        //     ->Where(function($query) use ($search_texts) {
        //         foreach($search_texts as $search_text) {
        //             $query->where('sku', 'like', '%'.$search_text.'%');
        //         }
        //     })
        //     ->with('manuals')
        //     ->orderBy('sku', 'asc')
        //     ->simplePaginate(100);
            
        // } else {

        //     $data = Airconditioner::where('sku', 'like',  '%'.$search_texts[0].'%')->with('manuals')->orderBy('sku', 'asc')->simplePaginate(100); // wild card searching
        // }
        
        // return response()->json($data);
    }

    public function exec_ask_ai(Request $request) {
        try {
            $api_request = $request->create('/api/ask-grok-api', 'POST');
            $api_response = Route::dispatch($api_request);
            $api_response = json_decode($api_response->getContent(), true);
            return [
                'content' => $api_response['choices'][0]['message']['content'],
                'citations' => $api_response['citations'],
            ];
        } catch (Exception $e) {
            return ['message' => $e->getMessage()];
        }
    }

    
    public function report_model(Request $request) {

        try {
            $missing_model = $request->sku;
            $missing_brand = ($request->brand != "new_brand") ? $request->brand : $request->missing_brand;
            $link = $request->link;
            $pdf_link = $request->pdf_link;

            
            if ($missing_model == "" || $missing_brand == "") {
                return response()->json(['status' => 'error', 'message' => "toastr.error('Please complete the required fields.')"]);
            }
            
            // if (MissingModel::where('sku', strtoupper($missing_model))->get()->first()) {
            //     return response()->json(['status' => 'error', 'message' => "toastr.error('Model was already reported!')"]);
            // }
                
            // MissingModel::create([
            //     'sku' => strtoupper($missing_model),
            //     'brand' => strtoupper($missing_brand),
            //     'link' => addslashes($link),
            //     'pdf' => addslashes($pdf_link),
            // ]);

            $param = "sku=".strtoupper($missing_model)."&brand=".strtoupper($missing_brand)."&link=".addslashes($link)."&pdf=".addslashes($pdf_link);
            $endpoint = "http://127.0.0.1/sheets-to-php/?type=missing&" . $param;
            $client = new \GuzzleHttp\Client();
            
            $response = $client->request('GET', $endpoint, []);
            
            $statusCode = $response->getStatusCode();
            $content = $response->getBody();
            
            return response()->json(
                ['status' => 'ok']);
        } catch(Exception $e) {
            return response()->json([$e->getMessage()]);
        }

        
        // $search_texts = explode("*", $request->search);

        // if ($request->search == "") 
        //     return [];
        
        // if (sizeof($search_texts) > 1) {
        //     $data = Airconditioner::where('url', '<>', null)
        //     ->Where(function($query) use ($search_texts) {
        //         foreach($search_texts as $search_text) {
        //             $query->where('sku', 'like', '%'.$search_text.'%');
        //         }
        //     })
        //     ->orderBy('sku', 'asc')
        //     ->simplePaginate(100);

        // } else {

        //     $data = Airconditioner::where('sku', 'like',  '%'.$search_texts[0].'%')->orderBy('sku', 'asc')->simplePaginate(100); // wild card searching
        // }
            
        // return response()->json($data);
    }
}