<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Models\JobSite;
use App\Models\JobArea;
use App\Models\JobAreaFile;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class JbController extends Controller
{
    public function fetch(Request $request): JsonResponse {
        try {
            $job_sites = JobSite::where('user_id', Auth::user()->id)->get();

            return response()->json([
                'status' => true,
                'message' => 'Job Sites fetched successfully',
                'data' => $job_sites
            ]);
        } catch(Exception $e) {
            logInfo($e->getMessage());
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
            $job_site_id = null;
            
            if ($request->has('sub_id')) {
                $job_site_id = $request->sub_id;
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

                $job_site = JobSite::create([
                    'title' => $title,
                    'description' => $description,
                    'user_id' => Auth::user()->id,
                ]);

                $job_site_id = $job_site->id;
            }

            if (! $sub_details_names) {
                return response()->json([
                    'status' => false,
                    'message' => 'Atleast one (1) job site is required',
                ]);
            }

            foreach($sub_details_names as $id => $sub_details_name) {
                $accomplishment_data = [];
                $accomplishment_images = [];

                $sub_details_description = $sub_details_descriptions[$id];
                $sub_details_accomplishment = $sub_details_accomplishments[$id];
                $sub_details_files = $request['subDetailsFiles_'.$id];

                $job_area_data = [
                    'job_site_id' => $job_site_id,
                    'title' => $sub_details_name,
                    'description' => $sub_details_description,
                    'accomplishments' => $sub_details_accomplishment,
                ];

                $job_area = JobArea::create($job_area_data);
                $job_area_id = $job_area->id;
                
                foreach($sub_details_files as $sub_details_file) {
                    
                    $original_name = $sub_details_file->getClientOriginalName();
                    $ext = $sub_details_file->getClientOriginalExtension();
                    $new_filename = $original_name.'.'.$ext;
                    $size = $sub_details_file->getSize();
                    
                    $file = Storage::disk('s3')->put('jobs', $sub_details_file);
                    $url = Storage::disk('s3')->url($file);
                    
                    $job_area_files[] = [
                        'job_area_id' => $job_area_id,
                        'name' => $original_name,
                        'url' => $url,
                        'type' => $ext,
                        'size' => $size,
                    ];
                }

                JobAreaFile::insert($job_area_files);
            }
            
            DB::commit();

            return response()->json([
                'status' => true,
                'message' => 'Job Sites saved successfully',
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
            $job_site = JobSite::where('id', $request->id)->first(); 
            $job_site->delete();
            $job_site->areas()->delete();

            return response()->json([
                'status' => true,
                'message' => 'Job Site deleted successfully',
            ]);
        } catch (Exception $e) {
            logInfo($e->getMessage());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request): JsonResponse {
        try {
            JobSite::where('id', $request->id)->update([
                'title' => $request->title,
                'description' => $request->description,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Job Site updated successfully',
            ]);
        } catch(Exception $e) {
            logInfo($e->getMessage());
            return globalHelper()->ajaxErrorResponse($e->getMessage());
        }
    }

    public function delete_job_site_area(Request $request): JsonResponse {
        try {
            $job_site_area = JobArea::where('id', $request->id)->first();
            $job_site_area->files()->delete();
            $job_site_area->delete();

            return response()->json([
                'status' => true,
                'message' => 'Job Site Area deleted successfully',
            ]);
        } catch(Exception $e) {
            logInfo($e->getMessage());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }   

    public function delete_image(Request $request): JsonResponse {
        try {
            $job_area_file = JobAreaFile::where('id', $request->id)->first();
            Storage::disk('s3')->delete($job_area_file->url);
            $job_area_file->delete();

            return response()->json([
                'status' => true,
                'message' => 'Job Site Image deleted successfully',
            ]);
        } catch(Exception $e) {
            logInfo($e->getMessage());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function delete_document(Request $request): JsonResponse {
        try {
            $job_area_file = JobAreaFile::where('id', $request->id)->first();
            Storage::disk('s3')->delete($job_area_file->url);
            $job_area_file->delete();

            return response()->json([
                'status' => true,
                'message' => 'Job Site Document deleted successfully',
            ]);
        } catch(Exception $e) {
            logInfo($e->getMessage());
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    

}