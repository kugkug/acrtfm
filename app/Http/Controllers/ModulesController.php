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

    public function myAccomplishments() {
        $this->data['title'] = 'Accomplishments'; 
        $this->data['description'] = "List of accomplishments you have achieved";
        $this->data['header'] = "Accomplishments";
        $this->data['right_panel'] = "<a href='".route('my-accomplishments-new')."' class='btn btn-success btn-md btn-flat btn-block ' ><i class='fa fa-plus'></i> Add New</a>";
        return view('pages.client.accomplishments.list', $this->data);
    }

    public function subAccomplishment($id) {
        $accomplishment_w_details = globalHelper()->getAccomplishmentDetails($id);
        $this->data['title'] = $accomplishment_w_details['title']; 
        $this->data['description'] = $accomplishment_w_details['description'];
        $this->data['header'] = $accomplishment_w_details['title'];
        $this->data['right_panel'] = "<a href='".route('my-accomplishments')."' class='btn btn-primary btn-md btn-flat btn-block ' ><i class='fa fa-undo'></i> Back to List</a>";
        $this->data['accomplishment'] = $accomplishment_w_details;
        return view('pages.client.accomplishments.subs', $this->data);
    }

    public function viewAccomplishment($id) {
        $accomplishment = globalHelper()->getAccomplishmentDetail($id);
        $this->data['title'] = $accomplishment['title']; 
        $this->data['description'] = $accomplishment['description'];
        $this->data['header'] = $accomplishment['title'];
        $this->data['right_panel'] = "<a href='".route('my-accomplishments-sub', $accomplishment['parent']['id'])."' class='btn btn-primary btn-md btn-flat btn-block ' ><i class='fa fa-undo'></i> Back to List</a>";
        $this->data['accomplishment'] = $accomplishment;
        return view('pages.client.accomplishments.view', $this->data);
    }

    public function newAccomplishment() {
        $this->data['title'] = 'Add Accomplishment'; 
        $this->data['description'] = "Add new accomplishment for your reference";
        $this->data['header'] = "Add Accomplishment";
        $this->data['right_panel'] = "<a href='".route('my-accomplishments')."' class='btn btn-primary btn-md btn-flat btn-block ' ><i class='fa fa-undo'></i> Back to List</a>";
        return view('pages.client.accomplishments.new', $this->data);
    }

    public function editAccomplishment($id) {
        $this->data['title'] = 'Edit Accomplishment'; 
        $this->data['description'] = "Modify existing accomplishment";
        $this->data['header'] = "Edit Accomplishment";
        $this->data['right_panel'] = "<a href='".route('my-accomplishments')."' class='btn btn-primary btn-md btn-flat btn-block ' ><i class='fa fa-undo'></i> Back to List</a>";
        return view('pages.client.accomplishments.edit', $this->data);
    }
   
    public function profile() {
        $this->data['title'] = 'Profile'; 
        $this->data['description'] = "Profile";
        $this->data['header'] = "Profile";
        return view('pages.client.profile', $this->data);
    }

   
}