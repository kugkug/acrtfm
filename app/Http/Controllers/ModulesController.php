<?php

namespace App\Http\Controllers;

use App\Models\Airconditioner;
use App\Models\Discussion;
use App\Models\Education;
use App\Models\PasswordResetToken;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class ModulesController extends Controller
{
    public $brands = [];
    public $categories = [];
    public $presentors = [];
    public $playlists = [];
    public $headers = [];
    public $userinfo = [];
    public function __construct() {
        $this->brands = DB::table('airconditioners')->groupBy('brand')->pluck('brand')->toArray();
        sort($this->brands);
        $this->categories = DB::table('educations')->groupBy('category')->pluck('category')->sortBy('category');
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
        sort($this->presentors);
        
        $playlists = DB::table('educations')->groupBy('playlist')->pluck('playlist');
        foreach($playlists as $playlist) {
            
            if (!empty($playlist) && ! in_array(trim($playlist), $this->playlists)) {
                $this->playlists[] = trim($playlist);
            }
        }
        sort($this->playlists);
    }

    

    public function index() {
        $data = [
            'title' => 'Home',
            'header' => 'How can we help?'
        ];
        return view('pages.index', $data)->with("root_url", URL::current());
    }

    public function airconditioners() {
        $airconditioners = Airconditioner::orderBy('sku', 'asc')->simplePaginate(20);
        // $airconditioners = Airconditioner::orderBy('sku', 'asc')->paginate(20);

        $data = [
            'title' => '', 
            'header' => $this->headers['model_lookup']['title'] ?? "Manufacturers",
            'search_type' => '',
            'search_value' => '',
            'brand_name' => '',
            'brands' => $this->brands,
            'airconditions' => $airconditioners
        ];
        // return view("pages.airconditioners", $data);
        return view("clients.index", $data)->with("root_url", URL::current());
    }

    public function manufacturers() {
        // $airconditioners = Airconditioner::orderBy('sku', 'asc')->simplePaginate(20);
        //  Airconditioner::orderBy('sku', 'asc')->paginate(20);
        $airconditioners =[];
        $data = [
            'title' => '', 
            'header' => $this->headers['manufacturers']['title'] ?? "Manufacturers",
            'search_type' => '',
            'search_value' => '',
            'brand_name' => '',
            'brands' => $this->brands,
            'airconditions' => $airconditioners
        ];
        // return view("pages.airconditioners", $data);
        return view("clients.manufacturers", $data)->with("root_url", URL::current());
    }

    public function educations() {
        
        $educations = Education::orderBy('url', 'asc')->simplePaginate(12);

        $data = [
            'title' => '', 
            'header' => $this->headers['education']['title'] ?? "Educational Videos",
            'search_type' => '',
            'search_value' => '',
            'category_name' => '',
            'presentor_name' => '',
            'keyword' => '',
            'categories' => $this->categories,
            'presentors' => $this->presentors,
            'playlists' => $this->playlists,
            'educations' => $educations
        ];
        return view('clients.educations', $data)->with("root_url", URL::current());
    }

    public function shared_education($educ_id) {

        $user = Auth::user();

        if ($user) {
            $video = Education::find($educ_id);
            $url = explode("](", $video->url);
            $title = ltrim($url[0], '[');
            
            if (isset($url[1])) {
                $link = rtrim($url[1], ')');
                $link = str_replace('"', "", $link);
                $ytlink = explode("embed/", $url[1]);
                $ytlinkid = explode("?si=", $ytlink[1]);

                $watch_link = $ytlink[0] ."embed/". $ytlinkid[0] . "?autoplay=1&mute=1";
                $iframe = "<iframe class='w-100 iframe' src='".$watch_link."' 
                    allow='autoplay;' frameborder='0' allowfullscreen='' 
                    title='".$title."' style='border-color: rgb(51, 105, 30);'></iframe>";
                $data = [
                    'title' => '', 
                    'header' => $title ?? "Shared Video",
                    'video_title' => $title,
                    'video' => $iframe,
                ];
                
                return view('clients.shared_video', $data)->with("root_url", URL::current());
            }
        } else {
            $video = Education::find($educ_id);
            $url = explode("](", $video->url);
            $title = ltrim($url[0], '[');

            if (isset($url[1])) {
                $link = rtrim($url[1], ')');
                $link = str_replace('"', "", $link);
                $ytlink = explode("embed/", $url[1]);
                $ytlinkid = explode("?si=", $ytlink[1]);

                $watch_link = $ytlink[0] ."embed/". $ytlinkid[0] . "?autoplay=1&mute=1";
                $iframe = "<iframe class='w-100 iframe' src='".$watch_link."' 
                    allow='autoplay;' frameborder='0' allowfullscreen='' 
                    title='".$title."' style='border-color: rgb(51, 105, 30);'></iframe>";
                $data = [
                    'title' => '', 
                    'header' => $title ?? "Shared Video",
                    'video_title' => $video->title,
                    'video' => $iframe,
                ];
                
                return view('clients.shared_video_guest', $data)->with("root_url", URL::current());
            }
        }
    }

    public function discussions(Request $request) {

        $data = [
            'title' => '', 
            'header' => $this->headers['discussions']['title'] ?? "Discussions",
            'keyword' => ''
        ];

        return view("clients.discussions", $data)->with("root_url", URL::current());
    }

    public function my_posts(Request $request) {

        
        $posts = Discussion::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')->paginate(10);
        if ($posts) {
            $formatted_post = Discussion::formatDiscussions($posts);
            
            $data = [
                'title' => '', 
                'header' => $this->headers['discussions']['title'] ?? "Discussions",
                'posts' => $formatted_post,
            ];

            return view("clients.discussions", $data)->with("root_url", URL::current());
        } else {
            return view("clients.discussions", [])->with("root_url", URL::current());
        }
    }

    public function ask_ai() {
        $data = [
            'title' => '', 
            'header' => $this->headers['model_lookup']['title'] ?? "Ask Ai",
            'search_type' => '',
            'search_value' => '',
            'brand_name' => '',
            'brands' => $this->brands,
        ];
        // return view("pages.airconditioners", $data);
        return view("clients.ask_ai", $data)->with("root_url", URL::current());
    }


    public function single() {
        $data = [
            'title' => '',
            'header' => 'Aircondition Info'
        ];
        return view('pages.aircondition', $data)->with("root_url", URL::current());
    }
    
    public function new_entry() {
        $data = [
            'title' => '', 
            'header' => 'New - Aircondition'
        ];
        return view('pages.new-entry', $data)->with("root_url", URL::current());
    }

    public function login() {
        $data = [
            'title' => '', 
            'header' => "Login",
        ];
        return view('pages.login', $data)->with("root_url", URL::current());
    }

    public function signup() {
        $data = [
            'title' => 'Register', 
            'header' => 'Register',
        ];
        return view('pages.signup', $data)->with("root_url", URL::current());
    }

    public function forgot_password() {
        $data = [
            'title' => 'Forgot Password', 
            'header' => 'Forgot Password',
        ];
        return view('pages.forgot_password', $data)->with("root_url", URL::current());
    }

    public function reset_password(Request $request) {
        $token = $request->input('token');
        
        $user_token = PasswordResetToken::where('token', $token)
        ->where('is_enabled', 1)
        ->orderBy('created_at', 'desc')
        ->get()->first();

        if ($user_token) {
            
            Session::put('user_email', $user_token->email);
            
            $created_at = Carbon::parse($user_token->created_at);
            $now = Carbon::parse(Carbon::now());

            // These will return 10
            $diffHours = $now->diffInHours($created_at);
            
            if ($diffHours < 24) {
                $data = [
                    'title' => 'Reset Password', 
                    'header' => 'Reset Password',
                ];
                return view('pages.reset_password')->with("root_url", URL::current());
            } else {
                return view('pages.reset_password_error')->with("message", "Token expired, please try to reset your password again to get another link.");    
            }
        } else {
            return view('pages.reset_password_error')->with("message", "Invalid token, please try to reset your password again to get another link.");
        }
    }

    public function ask_an_expert() {
        $data = [
            'title' => '', 
            'header' => ''
        ];
        return view('partials.clients.coming-soon', $data)->with("root_url", URL::current());
    }

    public function coming_soon() {
        $data = [
            'title' => '', 
            'header' => ''
        ];
        return view('partials.clients.coming-soon', $data)->with("root_url", URL::current());
    }


    public function synchronize() {
        $data = [
            'title' => '', 
            'header' => ''
        ];
        return view('admin.synch', $data)->with("root_url", URL::current());
    }

    public function my_jobs() {
        $data = [
            'title' => 'My Jobs', 
            'header' => 'My Jobs'
        ];
        return view('clients.my_jobs', $data)->with("root_url", URL::current());
    }
}