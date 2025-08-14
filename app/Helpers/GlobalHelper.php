<?php

declare(strict_types=1);
namespace App\Helpers;

use App\Mail\AxoMailer;
use App\Models\Accomplishment;
use App\Models\AccomplishmentDetail;
use App\Models\Airconditioner;
use App\Models\Communication;
use App\Models\Contact;
use App\Models\Education;
use App\Models\Extension;
use App\Models\JobArea;
use App\Models\JobSite;
use App\Models\Keyword;
use App\Models\Message;
use App\Models\Otp;
use App\Models\PhoneNumber;
use App\Models\Playlist;
use App\Models\Role;
use App\Models\SettingExtension;
use App\Models\Tag;
use App\Models\Theme;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use jessedp\Timezones\Timezones;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\CssSelector\Node\FunctionNode;
use Twilio\Rest\Client;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GlobalHelper {

    private $guzzle_client;
    private $twilio_client;
    public function __construct() {
        $this->guzzle_client = new GuzzleClient();
    }

    public function ajaxSuccessResponse(
        string $type="toast", 
        string $toast_type='success',
        string $exec='', 
        string $message='',
        string $title='System Info',
        array $data=[]
    ): JsonResponse {
        
        if ($type == 'toast') {
            $response = responseHelper()->toastrResponse($message, $toast_type, $title);
        } else if ($type == 'scripts') {
            $response = responseHelper()->scriptResponse($exec, $data, $message, $toast_type, $title);
        }
        
        return response()->json($response, 200);
    }

    public function ajaxErrorResponse(string $message='', string $url='', string $title='System Error'): JsonResponse {
        $response = responseHelper()->toastrResponse($message, 'error', $title);
        return response()->json($response, 200);
    }

    public function logInfo(string $message): void {
        Log::channel('info')->info($message);
    }

    public function getProfile() {
        $profile = User::where('id', Auth::user()->id)->with('profile')->first();
        
        return $profile->toArray();
    }

    public function getProfileViaEmail($email) {
        try {
            $user = User::where('email', $email)->first();
            
            return $user->toArray();
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    // public function getEmailDetails($type, $data=[]) {

    //     switch ($type) {
    //         case 'otp':
    //             $user_id = $data['id'];
    //             $otp_data = $this->generateOtp($user_id);
    //             $data['otp'] = $otp_data['otp'] ?? '';
    //             $data['verification_url'] = config('app.url') . '/verify-otp?token=' . $otp_data['token'];
    //             return [
    //                 'subject' => 'OTP Verification - AxoCall',
    //                 'view' => 'mail.otp',
    //                 'data' => $data,
    //             ];
    //         case 'reset_password':
    //             return [
    //                 'subject' => 'Reset Password - AxoCall',
    //                 'view' => 'mail.reset_password',
    //                 'data' => $data,
    //             ];
    //         default:
    //             return [
    //                 'subject' => 'OTP Verification - AxoCall',
    //                 'view' => 'mail.otp',
    //             ];
    //     }
    // }

    // public function generateOtp($user_id) {

    //     try {
    //     $otp = rand(100000, 999999);
    //     $token = md5(random_bytes(32).$otp);
    //     $otp_expiration = now()->addMinutes(5);

    //     $otp_data = [
    //         'user_id' => $user_id,
    //         'otp' => $otp,
    //         'expires_at' => $otp_expiration,
    //         'type' => 'otp',
    //         'token' => $token,
    //     ];

    //     $otp = Otp::create($otp_data);

    //     return $otp;
    //     } catch (\Exception $e) {
    //         logInfo($e->getMessage());
    //         return [];
    //     }
    // }

    // public function sendOtp($data) {
    //     try {

    //         $recipient = $data['email'];
    //         $profile = $this->getProfileViaEmail($recipient);
    //         $emailDetails = $this->getEmailDetails('otp', $profile);
            
    //         Mail::to("$recipient")->send(new AxoMailer($emailDetails));

    //         return [
    //             'status' => true,
    //             'message' => 'OTP sent successfully',
    //             'js' => 'location = "'.$emailDetails['data']['verification_url'].'"',
    //         ];
    //     } catch (\Exception $e) {   
    //         logInfo($e->getMessage());
    //         return [
    //             'status' => false,
    //             'message' => 'Failed to send OTP',
    //         ];
    //     }
    // }


    // public function getTimezones() {
    //     try {
    //         $timezones = Timezones::toArray();
    //         $timezones_list = [];
    //         foreach ($timezones as $timezone) {
                
    //             foreach ($timezone as $timezone_key => $timezone_value) {
    //                 $timezones_list[$timezone_key] = $timezone_key;
    //             }
    //         }
            
    //         return $timezones_list;
    //     } catch (\Exception $e) {
    //         logInfo($e->getMessage());
    //         return [];
    //     }
    // }

    // public function getTheme() {
    //     try {
    //         $theme = Theme::where('user_id', Auth::user()->id)->first();
    //         return $theme->theme ?? 'light';
    //     } catch (\Exception $e) {
    //         logInfo($e->getMessage());
    //         return 'light';
    //     }
    // }

    public function generatePassword() {
        try {
            return Str::password(8, true,true,true,false);
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return '';
        }
    }


    public function getManuals(string $model) {
        try {
            $airconditioner = Airconditioner::where('sku', $model)
            ->with('manuals')
            ->first();
            return $airconditioner->toArray();
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    public function getPlaylists() {
        try {
            $playlists = [];
            $playlis_list = DB::table('educations')->groupBy('playlist')->pluck('playlist');
            foreach($playlis_list as $playlist) {
            
                if (!empty($playlist) && ! in_array(trim($playlist), $playlists)) {
                    $playlists[] = trim($playlist);
                }
            }
            sort($playlists);
            return $playlists;
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    public function getCategories() {
        try {
            return DB::table('educations')->groupBy('category')->pluck('category')->sortBy('category');
            
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    public function getPresentors() {
        try {
            $presentors = [];
            $presentor_list = DB::table('educations')->groupBy('presented_by')->pluck('presented_by');
            foreach($presentor_list as $presentor) {
                if (!empty($presentor) && ! in_array(trim($presentor), $presentors)) {
                    $presentors[] = trim($presentor);
                }
            }
            sort($presentors);
            
            return $presentors;
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    public function getSharedEducation($id) {
        try {
            $education = Education::where('id', $id)->first();
            return $education->toArray();
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    public function getJobSites() {
        try {
            $job_sites = JobSite::where('user_id', Auth::user()->id)->get();
            if ($job_sites) {
                return $job_sites->toArray();
            }

            return [];
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    public function getJobSiteAreas($id) {
        try {
            $job_site = JobSite::where('id', $id)->with('areas')->first();
            if ($job_site) {
                return $job_site->toArray();
            }

            return [];
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    public function getJobSiteArea($id) {
        try {
            $job_area = JobArea::where('id', $id)
            ->with('files')
            ->with('site')
            ->first();
            if ($job_area) {  
                return $job_area->toArray();
            }

            return [];
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }
}