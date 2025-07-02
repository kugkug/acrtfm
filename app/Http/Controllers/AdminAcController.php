<?php

namespace App\Http\Controllers;

use App\Models\Airconditioner;
use App\Models\Manual;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AdminAcController extends Controller
{
    public function upload(Request $request) {

        try {
            $ac_id = $request->ac_id; 
            $labels = $request->labels; 
            $files = $request->file('files');
            $aFiles = [];

            $x = 0;
            foreach($files as $file){
                $label = $labels[$x];
                if ($label == "") {
                    return response()->json(['status' => 'error', 'message' => 'Please complete the fields!'], 500);
                }
                $orig = str_replace("'", "", $file->getClientOriginalName());
                $orig_file = str_replace(".pdf", "", $orig);
                $ext = $file->getClientOriginalExtension();
                $filename = $ac_id."_". str_replace(" ", "_", $orig_file) .".".$ext;
                $file->storeAs('', $filename, 'upload_manuals');

                $aFiles[] = [
                    'airconditioner_id' => $ac_id,
                    'original_filename' => $orig,
                    'label' => $label,
                    'filename' => $filename,
                    'created_at' => Carbon::now(),
                ];
                $x++;
            }

            return $aFiles;
            Manual::insert($aFiles);

            return response()->json(['status' => 'ok', 'message' => 'location.reload();'], 200);
        } catch(Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 'error'], 500);
        }
        
    }

    public function upload_bulk(Request $request) {

        try {
            // $model_numbers = array_map(function($model_number) {
            //     return "'".$model_number."'";

            // }, explode(",", $request->model_numbers));
            
            $model_numbers = explode(",", $request->model_numbers);

            $models = DB::table('airconditioners')
                ->whereIn('sku', $model_numbers)
                ->get();

            $labels = $request->labels; 
            $files = $request->file('files');
            $aFiles = [];

            $x = 0;
            foreach($files as $file) {
                $label = $labels[$x];

                if ($label == "") {
                    return response()->json(['status' => 'error', 'message' => 'Please complete the fields!'], 500);
                }
                
                foreach($models as $model) {
                    $orig = str_replace("'", "", $file->getClientOriginalName());
                    $orig_file = str_replace(".pdf", "", $orig);
                    $ext = $file->getClientOriginalExtension();
                    $filename = str_replace(" ", "_", $orig_file) .".".$ext;
                    $file->storeAs('', $filename, 'upload_manuals');

                    $aFiles[] = [
                        'airconditioner_id' => $model->id,
                        'original_filename' => $orig,
                        'label' => $label,
                        'filename' => $filename,
                        'created_at' => Carbon::now(),
                    ];
                }
                $x++;
            }
            // return $aFiles;
            Manual::insert($aFiles);

            // return response()->json(['status' => 'ok', 'message' => 'location.reload();'], 200);
            return response()->json(['status' => 'ok'], 200);
        } catch(Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 'error'], 500);
        }
    }

    public function delete(Request $request) {

        try {
            $manual_id = $request->manual_id; 
            
            Manual::find($manual_id)->delete();

            return response()->json('location.reload();', 200);
        } catch(Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 'error'], 500);
        }
        
    }
}