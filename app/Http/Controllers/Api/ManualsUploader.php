<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Airconditioner;
use App\Models\Manual;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ManualsUploader extends Controller
{
    public function upload(Request $request) {

        try {
            
            $sku = $request->sku;   
            $label = $request->label; 
            $output = $request->output;
            $file = $request->file('file');

            
            $ac = Airconditioner::where('sku', $sku)->get()->toArray();
            if (count($ac) > 0) {
                foreach($ac as $_ac) {
                    $ac_info = $_ac;
                    
                    $ac_id = $ac_info['id'];
                    $orig_file = str_replace(".pdf", "", $output);
                    $filename = $ac_id."_". str_replace(" ", "_", $orig_file) .".pdf";

                    $manual_check = Manual::where('filename', $filename)->get()->toArray();
                    
                    if (count($manual_check) <= 0) {
                        $aFiles[] = [
                            'airconditioner_id' => $ac_id,
                            'original_filename' => $output,
                            'label' => $label,
                            'filename' => $filename,
                            'created_at' => Carbon::now(),
                        ];

                        $file->storeAs('', $filename, 'upload_manuals');
                    
                    }
                }
                
                if (count($aFiles) > 0) {
                    Manual::insert($aFiles);
                }
                return response()->json(['status' => 'ok', 'message' => 'Uploaded'], 200);
                // else {
                //     Log::info(['status' => 'error', 'message' => 'Existed', 'filename' => $filename]);
                //     return response()->json(['status' => 'ok', 'message' => 'Existed'], 200);           
                // }
            } else {
                Log::info(['status' => 'error', 'message' => 'Unknown', 'model' => $sku]);
                return response()->json(['status' => 'error', 'message' => 'Unknown'], 200);
            }
            
        } catch(Exception $e) {
            Log::info($e->getMessage());
            return response()->json(['status' => 'error'], 500);
        }
        
    }
}