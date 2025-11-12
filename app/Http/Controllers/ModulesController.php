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
    
    public function registerCompany() {
        $this->data['title'] = 'Register Company'; 
        $this->data['header'] = "Register Company";
        return view('pages.register-company', $this->data);
    }

    public function registerTechnician() {
        $this->data['title'] = 'Register Technician';
        $this->data['header'] = "Register Technician";
        return view('pages.register-technician', $this->data);
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
        $this->data['dashboard_data'] = globalHelper()->getDashboardData();
        $this->data['title'] = 'Tech Dispatch'; 
        $this->data['description'] = "Manage technical dispatch operations";
        $this->data['header'] = "Tech Dispatch";
        return view('pages.client.tech_dispatch.dashboard', $this->data);
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
        $this->data['right_panel'] = componentHelper()->rightPanel('quotes-index', []);
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
        $user = auth()->user();
        if ($user && $user->user_type === config('acrtfm.user_types.technician') && ! $user->isCompanyConfirmed()) {
            return redirect()->route('customers')->with('error', 'Company confirmation is required before you can add customers.');
        }

        $this->data['title'] = 'New Customer'; 
        $this->data['description'] = "Add a new customer";
        $this->data['header'] = "New Customer";
        $this->data['right_panel'] = componentHelper()->rightPanel('customers-new', []);
        return view('pages.client.tech_dispatch.customers.new', $this->data);
    }

    public function view_customer($id, Request $request) {
        $this->data['tab'] = $request->get('tab');
        $this->data['customer'] = globalHelper()->getCustomer($id);
        
        if (empty($this->data['customer'])) {
            return redirect()->route('customers');
        }
        $this->data['equipment_types'] = globalHelper()->getEquipmentTypes();
        $this->data['title'] = 'View Customer'; 
        $this->data['description'] = "View customer information";
        $this->data['header'] = "View Customer";
        $this->data['right_panel'] = componentHelper()->rightPanel('customers-view', ['id' => $id]);
        return view('pages.client.tech_dispatch.customers.view', $this->data);
    }

    public function edit_customer($id) {
        $this->data['customer'] = globalHelper()->getCustomer($id);
        if (empty($this->data['customer'])) {
            return redirect()->route('customers');
        }
        $this->data['title'] = 'Edit Customer'; 
        $this->data['description'] = "Edit customer information";
        $this->data['header'] = "Edit Customer";
        $this->data['right_panel'] = componentHelper()->rightPanel('customers-edit', ['id' => $id]);
        return view('pages.client.tech_dispatch.customers.edit', $this->data);
    }
    /**
     * End of Customers
     */

     
    /**
      * Start of Locations
    */

    public function create_location($customer_id) {
        $this->data['customer'] = globalHelper()->getCustomer($customer_id);
        if (empty($this->data['customer'])) {
            return redirect()->route('customers');
        }
        
        $this->data['title'] = 'Create Location'; 
        $this->data['description'] = "Create a new location";
        $this->data['header'] = "Create Location";
        $this->data['right_panel'] = componentHelper()->rightPanel('locations-create', ['id' => $customer_id]);
        return view('pages.client.tech_dispatch.locations.create', $this->data);
    }

    public function edit_location($id) {
        $this->data['location'] = globalHelper()->getLocation($id);
        if (empty($this->data['location'])) {
            return redirect()->route('locations');
        }
        $this->data['title'] = 'Edit Location'; 
        $this->data['description'] = "Edit location information";
        $this->data['header'] = "Edit Location";
        $this->data['right_panel'] = componentHelper()->rightPanel('locations-edit', ['id' => $id]);
        return view('pages.client.tech_dispatch.locations.edit', $this->data);
    }

    /**
     * End of Locations
     */

    /**
     * Start of Equipments
     */

    public function create_equipment($customer_id) {
        $this->data['customer'] = globalHelper()->getCustomer($customer_id);
        if (empty($this->data['customer'])) {
            return redirect()->route('customers');
        }
        $this->data['title'] = 'Create Equipment'; 
        $this->data['description'] = "Create a new equipment";
        $this->data['header'] = "Create Equipment";
        $this->data['equipment_types'] = globalHelper()->getEquipmentTypes();
        $this->data['right_panel'] = componentHelper()->rightPanel('equipments-create', ['id' => $customer_id]);
        return view('pages.client.tech_dispatch.equipments.create', $this->data);
    }

    public function edit_equipment($id) {
        $equipment = globalHelper()->getEquipment($id);

        if (empty($equipment)) {
            return redirect()->route('equipments');
        }
        $this->data['equipment'] = $equipment;
        $this->data['locations'] = globalHelper()->getCustomerLocations($equipment['customer_id']);
        $this->data['equipment_types'] = globalHelper()->getEquipmentTypes();
        $this->data['title'] = 'Edit Equipment'; 
        $this->data['description'] = "Edit equipment information";
        $this->data['header'] = "Edit Equipment";
        $this->data['right_panel'] = componentHelper()->rightPanel('equipments-edit', ['id' => $id]);
        return view('pages.client.tech_dispatch.equipments.edit', $this->data);
    }

    /**
     * End of Equipments
     */

    /**
     * Start of Work Orders
     */

    public function work_orders() {
        $this->data['title'] = 'Work Orders'; 
        $this->data['description'] = "Manage work orders";
        $this->data['header'] = "Work Orders";
        $this->data['work_orders'] = globalHelper()->getAllWorkOrders();
        
        $this->data['right_panel'] = (
            auth()->user()->user_type == config('acrtfm.user_types.company')) ? 
            componentHelper()->rightPanel('work-orders-index', []) : 
            componentHelper()->rightPanel('work-orders-technician-index', ['id' => auth()->user()->id]
        );
        
        if (auth()->user()->user_type == config('acrtfm.user_types.technician')) {
            return view('pages.client.tech_dispatch.technicians.work_orders', $this->data);
        } else {
            return view('pages.client.tech_dispatch.work_orders.index', $this->data);
        }
        
    }

    public function view_work_order($id) {
        $this->data['work_order'] = globalHelper()->getWorkOrder($id);
        if (empty($this->data['work_order'])) {
            return redirect()->route('work-orders');
        }
        $this->data['statement'] = globalHelper()->getWorkOrderStatement($id);
        $this->data['title'] = 'View Work Order'; 
        $this->data['description'] = "View work order information";
        $this->data['header'] = "View Work Order";
        $this->data['right_panel'] = componentHelper()->rightPanel('work-orders-view', ['id' => $id]);
        return view('pages.client.tech_dispatch.work_orders.view', $this->data);
    }

    public function new_work_order() {
        $user = auth()->user();
        if ($user && $user->user_type === config('acrtfm.user_types.technician') && ! $user->isCompanyConfirmed()) {
            return redirect()->route('work-orders')->with('error', 'Company confirmation is required before you can create work orders.');
        }

        $this->data['customers'] = globalHelper()->getCustomers();
        $this->data['priority_levels'] = config('acrtfm.priority_levels');
        $this->data['equipment_types'] = globalHelper()->getEquipmentTypes();
        $this->data['technicians'] = globalHelper()->getTechnicians();
        
        $this->data['title'] = 'New Work Order'; 
        $this->data['description'] = "Create a new work order";
        $this->data['header'] = "New Work Order";
        $this->data['right_panel'] = componentHelper()->rightPanel('work-orders-new', []);
        return view('pages.client.tech_dispatch.work_orders.new', $this->data);
    }
    
    public function edit_work_order($id) {
        $this->data['work_order'] = globalHelper()->getWorkOrder($id);
        $this->data['customers'] = globalHelper()->getCustomers();
        if (empty($this->data['work_order'])) {
            return redirect()->route('work-orders');
        }
        $this->data['title'] = 'Edit Work Order'; 
        $this->data['description'] = "Edit work order information";
        $this->data['header'] = "Edit Work Order";
        $this->data['right_panel'] = componentHelper()->rightPanel('work-orders-edit', ['id' => $id]);
        return view('pages.client.tech_dispatch.work_orders.edit', $this->data);
    }

    /**
     * End of Work Orders
     */

     /**
      * Quotes
      */
    public function new_quote() {
        $this->data['title'] = 'New Quote'; 
        $this->data['description'] = "Create a new quote";
        $this->data['header'] = "New Quote";
        $this->data['right_panel'] = componentHelper()->rightPanel('quotes-new', []);
        return view('pages.client.tech_dispatch.quotes.new', $this->data);
    }
    
    public function view_quote($id) {
        // $this->data['quote'] = globalHelper()->getQuote($id);
        if (empty($this->data['quote'])) {
            return redirect()->route('quotes');
        }
        $this->data['title'] = 'View Quote'; 
        $this->data['description'] = "View quote information";
        $this->data['header'] = "View Quote";
        $this->data['right_panel'] = componentHelper()->rightPanel('quotes-view', ['id' => $id]);
        return view('pages.client.tech_dispatch.quotes.view', $this->data);
    }

    public function technicians() {
        $this->data['technicians'] = globalHelper()->getTechnicians();
        $this->data['title'] = 'Technicians'; 
        $this->data['description'] = "View all technicians in the system";
        $this->data['header'] = "Technicians";
        return view('pages.client.tech_dispatch.technicians', $this->data);
    }
    
}