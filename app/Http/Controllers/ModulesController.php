<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ModulesController extends Controller
{
    private $data = [];

    public function __construct() {
        $this->data = [
            'theme' => 'light',
            'root_url' => URL::current(),
        ];
    }

    public function login() {
        $this->data['title'] = 'Login'; 
        $this->data['header'] = "Login";
        
        return view('pages.login', $this->data);
    }

    public function forgotPassword() {
        $this->data['title'] = 'Forgot Password'; 
        $this->data['header'] = "Forgot Password";
        return view('pages.forgot-password', $this->data);
    }

    public function register() {
        $this->data['title'] = 'Register'; 
        $this->data['header'] = "Register";
        return view('pages.register', $this->data);
    }
    

    public function home() {
        $this->data['title'] = 'Home'; 
        $this->data['description'] = "How can we help you today?";
        $this->data['header'] = "Home";
        return view('pages.client.home', $this->data);
    }

    public function modelLookup() {
        $this->data['title'] = 'Model Lookup'; 
        $this->data['description'] = "Find a model";
        $this->data['header'] = "Model Lookup";
        return view('pages.client.model_lookup', $this->data);
    }

    public function education() {

        $this->data['title'] = 'Education'; 
        $this->data['description'] = "Watch educational videos";
        $this->data['header'] = "Education";


        $this->data['playlists'] = globalHelper()->getPlaylists();
        $this->data['categories'] = globalHelper()->getCategories();
        $this->data['presentors'] = globalHelper()->getPresentors();
        
        return view('pages.client.education', $this->data);
        // return view('pages.client.education_demo', $this->data)->with("root_url", URL::current());
        
    }

    public function askAi() {
        $this->data['title'] = 'Ask A.I.'; 
        $this->data['description'] = "Ask a question";
        $this->data['header'] = "Ask A.I.";
        return view('pages.client.ask_ai', $this->data);
    }

    public function techDispatch() {
        $this->data['title'] = 'Tech Dispatch'; 
        $this->data['description'] = "Manage technical dispatch operations";
        $this->data['header'] = "Tech Dispatch";
        return view('pages.client.tech_dispatch', $this->data);
    }

    public function techDispatchCustomers() {
        $this->data['title'] = 'Customers'; 
        $this->data['description'] = "Manage customer information and relationships";
        $this->data['header'] = "Customers";
        return view('pages.client.tech_dispatch.customers', $this->data);
    }

    public function techDispatchWorkOrders() {
        $this->data['title'] = 'Work Orders'; 
        $this->data['description'] = "Create, manage and track work orders";
        $this->data['header'] = "Work Orders";
        return view('pages.client.tech_dispatch.work_orders', $this->data);
    }

    public function techDispatchQuotes() {
        $this->data['title'] = 'Quotes'; 
        $this->data['description'] = "Generate and manage customer quotes";
        $this->data['header'] = "Quotes";
        return view('pages.client.tech_dispatch.quotes', $this->data);
    }

    public function techDispatchCalendar() {
        $this->data['title'] = 'Calendar'; 
        $this->data['description'] = "Schedule and manage appointments";
        $this->data['header'] = "Calendar";
        return view('pages.client.tech_dispatch.calendar', $this->data);
    }

    public function exploreManuals($model) {
        $this->data['ac_details'] = globalHelper()->getManuals($model);
        $this->data['title'] = 'Explore Manuals'; 
        $this->data['description'] = "Explore manuals";
        $this->data['right_panel'] = "<div class='float-right'><a href='".route('model-lookup')."' class='btn btn-success btn-md btn-flat' ><i class='fa fa-search'></i> Search Another</a></div>";
        $this->data['header'] = "Explore Manuals";
        $this->data['action_button'] = "<a href='#' class='btn btn-info btn-md btn-flat btn-block d-none' target='_blank' id='full-screen-btn'><i class='fa fa-expand'></i> Full Screen</a>";
        return view('pages.client.explore_manuals', $this->data);
    }

    public function videoPlaylist() {
        $this->data['title'] = 'Video Playlist'; 
        $this->data['description'] = "Browse and watch video playlists";
        $this->data['header'] = "Video Playlist";
        return view('pages.client.video_playlist', $this->data);
    }

    public function sharedEducation($id) {
        $this->data['education'] = globalHelper()->getSharedEducation($id);
        $this->data['title'] = 'Shared Educational Video'; 
        $this->data['description'] = "Shared Educational Video";
        $this->data['header'] = "Shared Educational Video";
        return view('pages.subs.shared_education', $this->data);
    }


    // Job Sites

    public function job_sites() {
        $this->data['title'] = 'Job Sites'; 
        $this->data['description'] = "List of job sites you have worked on";
        $this->data['header'] = "Job Sites";
        $this->data['right_panel'] = componentHelper()->rightPanel('job-sites', []);
        return view('pages.client.job-sites.list', $this->data);
    }

    public function job_sites_areas($id) {
        
        $job_site_areas = globalHelper()->getJobSiteAreas($id);
        if (empty($job_site_areas)) {
            return redirect()->route('job-sites');
        }
        
        $this->data['title'] = "Job Site Areas"; 
        $this->data['description'] = 'List of areas for ' . $job_site_areas['title'];
        $this->data['header'] = $job_site_areas['title'];
        $this->data['right_panel'] = componentHelper()->rightPanel('job-site-areas', ['id' => $id]);
        $this->data['job_site_areas'] = $job_site_areas;
        return view('pages.client.job-sites.subs', $this->data);
    }

    public function view_job_site($id) {
        $job_site_area = globalHelper()->getJobSiteArea($id);
        if (empty($job_site_area)) {
            return redirect()->route('job-sites');
        }
        
        $this->data['title'] = "Accomplishments"; 
        $this->data['description'] = '';
        $this->data['header'] = $job_site_area['title'];
        $this->data['right_panel'] = componentHelper()->rightPanel('job-site-area-view', ['id' => $job_site_area['id'], 'site_id' => $job_site_area['site']['id']]);
        $this->data['job_site_area'] = $job_site_area;
        return view('pages.client.job-sites.view', $this->data);
    }

    public function new_job_site() {
        $this->data['title'] = 'Add Job Sites'; 
        $this->data['description'] = "Add new job sites for your reference";
        $this->data['header'] = "Add Job Sites";
        $this->data['right_panel'] = componentHelper()->rightPanel('job-site-new', []);
        return view('pages.client.job-sites.new', $this->data);
    }

    public function job_site_add($site_id) {
        $job_site_area = globalHelper()->getJobSite($site_id);
        if (empty($job_site_area)) {
            return redirect()->route('job-sites');
        } 
        
        $this->data['title'] = 'Add Job Site'; 
        $this->data['description'] = "Add another job site for your reference";
        $this->data['header'] = "Add Job Site";
        $this->data['right_panel'] = componentHelper()->rightPanel('job-site-area-add', ['id' => $job_site_area['id']]);
        $this->data['job_site_area'] = $job_site_area;
        $this->data['sub_id'] = $site_id;
        return view('pages.client.job-sites.add', $this->data);
    }

    public function edit_job_site($id) {
        $this->data['title'] = 'Edit Job Site'; 
        $this->data['description'] = "Modify existing job site";
        $this->data['header'] = "Edit Job Site";
        $this->data['right_panel'] = componentHelper()->rightPanel('job-site-area-edit', ['id' => $id]);
        return view('pages.client.job-sites.edit', $this->data);
    }

    public function job_site_accomplishment($id) {
        $accomplishment = globalHelper()->getAccomplishment($id);
        if (empty($accomplishment)) {
            return redirect()->route('job-sites');
        } 
        
        $this->data['title'] = 'Accomplishment'; 
        $this->data['description'] = "Accomplishment";
        $this->data['header'] = "Accomplishment";
        $this->data['accomplishment'] = $accomplishment;
        $this->data['right_panel'] = componentHelper()->rightPanel('job-site-area-accomplishment', ['job_area_id' => $accomplishment['job_area_id'], 'id' => $id]);
        return view('pages.client.job-sites.accomplishment', $this->data);
    }
   
    public function profile() {
        $this->data['title'] = 'Profile'; 
        $this->data['description'] = "Profile";
        $this->data['header'] = "Profile";
        return view('pages.client.profile', $this->data);
    }  

    public function add_accomplishment($job_area_id) {
        $job_area = globalHelper()->getJobSiteArea($job_area_id); 
        if (empty($job_area)) {
            return redirect()->route('job-sites');
        } 

        $this->data['title'] = 'Add Accomplishment'; 
        $this->data['description'] = "Add new accomplishment";
        $this->data['header'] = "Add Accomplishment";
        $this->data['right_panel'] = componentHelper()->rightPanel('accomplishment-add', ['job_area_id' => $job_area_id]);
        $this->data['job_area'] = $job_area;
        return view('pages.client.job-sites.add_accomplishment', $this->data);
    }


    /**
     * Start Customers
     */    

    public function customers() {
        $this->data['customers'] = globalHelper()->getCustomers();
        $this->data['title'] = 'Customer Management'; 
        $this->data['description'] = "Manage your customers and their information";
        $this->data['header'] = "Customer Management";
        $this->data['right_panel'] = componentHelper()->rightPanel('customers-index', []);
        return view('pages.client.tech_dispatch.customers.index', $this->data);
    }

    public function new_customer() {
        $this->data['title'] = 'New Customer'; 
        $this->data['description'] = "Add a new customer";
        $this->data['header'] = "New Customer";
        $this->data['right_panel'] = componentHelper()->rightPanel('customers-new', []);
        return view('pages.client.tech_dispatch.customers.new', $this->data);
    }

    /**
     * End of Customers
     */
}