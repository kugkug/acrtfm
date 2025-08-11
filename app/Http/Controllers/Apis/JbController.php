<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\Accomplishment;
use App\Models\AccomplishmentDetail;
use App\Models\AccomplishmentFile;
use App\Models\AccomplishmentPhoto;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JbController extends Controller
{
    public function fetch(Request $request): JsonResponse {
        try {
            $accomplishment = Accomplishment::where('user_id', auth()->user()->id)->get();

            return response()->json([
                'status' => true,
                'message' => 'Accomplishments fetched successfully',
                'data' => $accomplishment
            ]);
        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function save(Request $request): JsonResponse {
        DB::beginTransaction();
        try {
            $sub_details_names = $request->subDetailsName;
            $sub_details_descriptions = $request->subDetailsDescription;
            $sub_details_accomplishments = $request->subDetailsAccomplishments;
            $accomplishment_id = null;
            
            if ($request->has('sub_id')) {
                $accomplishment_id = $request->sub_id;
            } else {
                $title = $request->title;
                $description = $request->description;

                $validate = Validator::make([
                    'title' => $title,
                    'description' => $description,
                ], [
                    'title' => 'required|string|max:255',
                    'description' => 'sometimes|string|max:255',
                ]);
    
                if ($validate->fails()) {
                    return response()->json([
                        'status' => false,
                        'message' => $validate->errors()->first(),
                    ]);
                }

                $accomplishment = Accomplishment::create([
                    'title' => $title,
                    'description' => $description,
                    'user_id' => auth()->user()->id,
                ]);

                $accomplishment_id = $accomplishment->id;
            }

            if (! $sub_details_names) {
                return response()->json([
                    'status' => false,
                    'message' => 'Atleast one (1) accomplishment is required',
                ]);
            }

            foreach($sub_details_names as $id => $sub_details_name) {
                $accomplishment_data = [];
                $accomplishment_images = [];

                $sub_details_description = $sub_details_descriptions[$id];
                $sub_details_accomplishment = $sub_details_accomplishments[$id];
                $sub_details_files = $request['subDetailsFiles_'.$id];

                $accomplishment_data = [
                    'accomplishment_id' => $accomplishment_id,
                    'title' => $sub_details_name,
                    'description' => $sub_details_description,
                    'accomplishment' => $sub_details_accomplishment,
                ];

                $accomplishment_detail = AccomplishmentDetail::create($accomplishment_data);
                $accomplishment_detail_id = $accomplishment_detail->id;
                
                foreach($sub_details_files as $sub_details_file) {
                    
                    $original_name = $sub_details_file->getClientOriginalName();
                    $ext = $sub_details_file->getClientOriginalExtension();
                    $new_filename = $original_name.'.'.$ext;
                    
                    // Storage::disk('accomplishment_files')->put($new_filename, file_get_contents($sub_details_file));
                    $file = Storage::disk('s3')->putFileAs('jobs', $sub_details_file, $new_filename);
                    $filename = Storage::disk('s3')->url($file);
                    
                    $accomplishment_images[] = [
                        'accomplishment_details_id' => $accomplishment_detail_id,
                        'filename' => $filename,
                        'filetype' => $ext,
                    ];
                }

                AccomplishmentFile::insert($accomplishment_images);
            }
            
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Accomplishments saved successfully',
            ]);
            
        } catch (Exception $e) {
            DB::rollBack();
            logInfo($e->getMessage());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete(Request $request): JsonResponse {
        try {
            $accomplishment = AccomplishmentDetail::where('id', $request->id)->first(); 
            $accomplishment->delete();
            $accomplishment->files()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Accomplishment deleted successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}