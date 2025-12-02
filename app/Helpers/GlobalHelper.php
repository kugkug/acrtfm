<?php

declare(strict_types=1);
namespace App\Helpers;

use App\Mail\AxoMailer;
use App\Models\Accomplishment;
use App\Models\AccomplishmentDetail;
use App\Models\Airconditioner;
use App\Models\Communication;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\CustomerEquipment;
use App\Models\CustomerLocation;
use App\Models\Education;
use App\Models\EquipmentType;
use App\Models\Extension;
use App\Models\JobAccomplishment;
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
use App\Models\WorkOrder;
use App\Models\WorkOrderStatement;

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

    public function generateCompanyCode() {
        try {
            $code = '';
            $characters = config('acrtfm.companycodematrix');
            for ($i = 0; $i < 6; $i++) {
                $code .= $characters[random_int(0, strlen($characters) - 1)];
            }
            return Carbon::now()->format('ymd') . $code;
            
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return '';
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

    public function getJobSite($site_id) {
        try {
            $job_site = JobSite::where('id', $site_id)->first();
            if ($job_site) {
                return $job_site->toArray();
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
            ->with('site')
            ->with('accomplishments')
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

    public function getAccomplishment($id) {
        try {
            $accomplishment = JobAccomplishment::where('id', $id)
            ->with('files')
            ->first();
            return $accomplishment->toArray();
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    public function getEquipmentTypes() {
        try {
            return EquipmentType::all()->toArray();
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    /**
     * Start of Customers
     */

    public function getCustomers() {
        try {
            if (auth()->user()->user_type == config('acrtfm.user_types.company')) {
                return Customer::where('created_by', Auth::user()->id)->get()->toArray();
            } else {
                return Customer::where('technician_id', Auth::user()->id)->get()->toArray();
            }
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    public function getCustomer($id) {
        try {
            return Customer::where('id', $id)
            ->with('locations')
            ->with('equipments')
            ->first()->toArray();
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    public function getCustomerLocations($id) {
        try {
            $location = CustomerLocation::where('customer_id', $id)->get();
            return $location->toArray();
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }
    
    public function getLocation($id) {
        try {
            $location = CustomerLocation::where('id', $id)->first();
            if ($location) {
                return $location->toArray();
            }
            
            return [];
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    public function getEquipment($id) {
        try {   
            $equipment = CustomerEquipment::where('id', $id)
            ->with('equipment_type')
            ->with('location')
            ->first();
            if ($equipment) {
                return $equipment->toArray();
            }
            
            return [];

        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    public function getAllWorkOrders($status = null) {
        try {            
            $query = WorkOrder::with('customer');
            
            // Filter by user type
            if (auth()->user()->user_type == config('acrtfm.user_types.company')) {
                // Company users see only work orders they created
                $query->where('created_by', auth()->user()->id);
            } else {
                // Technician users see only work orders assigned to them
                $query->where('technician_id', auth()->user()->id);
            }
            
            // Filter by status if provided
            if ($status !== null && $status !== '') {
                // Map filter values to actual status values
                $statusMap = [
                    'active' => 'in_progress',
                    'completed' => 'completed',
                    'pending' => 'pending',
                ];
                
                if (isset($statusMap[$status])) {
                    $query->where('status', $statusMap[$status]);
                }
            }
            
            $work_orders = $query->get();
            
            if ($work_orders) {
                return $work_orders->toArray();
            }

            return [];

        } catch (\Exception $e) {
            logInfo($e->getTraceAsString());
            return [];
        }
    }

    public function getWorkOrder($id) {
        try {
            $query = WorkOrder::where('id', $id);
            
            // Filter by user type for access control (only if authenticated)
            if (auth()->check()) {
                if (auth()->user()->user_type == config('acrtfm.user_types.company')) {
                    // Company users can only view work orders they created
                    $query->where('created_by', auth()->user()->id);
                } else {
                    // Technician users can only view work orders assigned to them
                    $query->where('technician_id', auth()->user()->id);
                }
            }
            
            $work_order = $query->with('customer')
                ->with('photos')
                ->with('notes')
                ->with('statement')
                ->first();
                
            if ($work_order) {
                return $work_order->toArray();
            }

            return [];
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    public function getWorkOrderStatement(int $work_order_id): array
    {
        try {
            $query = WorkOrderStatement::where('work_order_id', $work_order_id);
            
            // Filter by user access to the work order (only if authenticated)
            if (auth()->check()) {
                $query->whereHas('workOrder', function($q) {
                    if (auth()->user()->user_type == config('acrtfm.user_types.company')) {
                        // Company users can only view statements for work orders they created
                        $q->where('created_by', auth()->user()->id);
                    } else {
                        // Technician users can only view statements for work orders assigned to them
                        $q->where('technician_id', auth()->user()->id);
                    }
                });
            }
            
            $statement = $query->with('customer')->first();
            if ($statement) {
                return $statement->toArray();
            }

            return [];
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }

    public function getTechnicians() {
        try {
            $company_code = Auth::user()->company_code;
            $technicians = User::where('company_code', $company_code)->where('user_type', config('acrtfm.user_types.technician'))->get()->toArray();
            if ($technicians) {
                return $technicians;
            }

            return [];
        } catch (\Exception $e) {   
            logInfo($e->getMessage());
            return [];
        }
    }

    public function getDashboardData() {
        try {
            $dashboard_data = [];


            $work_orders = WorkOrder::all();

            $status_counts = [
                'active' => 0,
                'completed' => 0,
                'pending' => 0
            ];

            foreach ($work_orders as $wo) {
                $status = strtolower($wo->status ?? '');
                
                $status_counts[$status] = isset($status_counts[$status]) ? $status_counts[$status] + 1 : 1;
            }

            $dashboard_data['active_jobs'] = $status_counts['active'];
            $dashboard_data['completed'] = $status_counts['completed'];
            $dashboard_data['pending'] = $status_counts['pending'];
            $dashboard_data['technicians'] = count($this->getTechnicians()) ?? 0;
            
            return $dashboard_data;
        } catch (\Exception $e) {
            logInfo($e->getMessage());
            return [];
        }
    }
}