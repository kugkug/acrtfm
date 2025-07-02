<?php

namespace App\Http\Controllers;

use App\Models\Airconditioner;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public $brands = [];

    public function __construct()
    {
        $this->brands = DB::table('airconditioners')->groupBy('brand')->pluck('brand');
    }

    public function index() {
        $data = [
            'title' => 'User',
            'header' => 'User',
        ];
        return view("admin.maintenance.users.index", $data);
    }

    public function create() {
        $data = [
            'title' => 'User Add',
            'header' => 'New - User Account',
        ];
        return view("admin.maintenance.users.create", $data);
    }

    public function store(Request $request) {
        $default['name'] = "Admin Acrftm";
        $default['email'] = "admin@acrtfm.com";
        $default['password'] = Hash::make('Mftr7548!@');

        User::create($default);
        return redirect("/");
    }

    public function edit($id) {
        $data = [
            'title' => 'User Edit',
            'header' => 'Edit - User Account',
        ];
        return view("admin.maintenance.users.edit", $data);
    }


    public function authenticate(Request $request) {
        
        $validated = $request->validate([            
            "email" => ['required', 'email'],
            "password" => 'required',
            
        ]);

        $validated['user_type'] = "admin";
        
        if (auth()->attempt($validated)) {
            
            $request->session()->regenerateToken();

            return redirect("/admin/dashboard");
        }

        return back()->withErrors(['email' => 'Login failed'])->onlyInput('email');
    }

    public function logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function admin_logout(Request $request) {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin');
    }

    public function block_user(Request $request) {
        try {
            
            User::where('id', $request->tech_id)->update(['status' => 'blocked']);
            
            return back();
        } catch (Exception $e){
            return back();
        }
    }

    public function activate_user(Request $request) {
        try {
            User::where('id', $request->tech_id)->update(['status' => 'active']);
            
            return back();
        } catch (Exception $e){
            return back();
        }
    }

    public function delete_user(Request $request) {
        try {
            User::where('id', $request->tech_id)->delete();
            
            return back();
        } catch (Exception $e){
            return back();
        }
    }

    public function make_admin(Request $request) {
        try {
            User::where('id', $request->tech_id)->update(['user_type' => 'admin']);
            
            return back();
        } catch (Exception $e){
            return back();
        }
    }

    public function make_user(Request $request) {
        try {
            User::where('id', $request->tech_id)->update(['user_type' => 'client']);
            
            return back();
        } catch (Exception $e){
            return back();
        }
    }

    public function dashboard() {
        $airconditioners = Airconditioner::orderBy('sku', 'asc')->simplePaginate(20);
        // $airconditioners = Airconditioner::orderBy('sku', 'asc')->paginate(20);
        $data = [
            'title' => '', 
            'header' => 'List of Airconditioners',
            'search_type' => '',
            'search_value' => '',
            'brand_name' => '',
            'brands' => $this->brands,
            'airconditions' => $airconditioners
        ];
        return view('admin.index', $data);
    }
}