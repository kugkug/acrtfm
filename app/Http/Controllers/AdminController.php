<?php

namespace App\Http\Controllers;

use App\Models\Airconditioner;
use App\Models\MissingModel;
use App\Models\Modules;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public $brands = [];
    public $modified_module_list = [];
    

    public function __construct()
    {
        
        $db_module = [];
        $module_list = config('modules.module_list');

        $this->brands = DB::table('airconditioners')->groupBy('brand')->pluck('brand')->toArray();
        sort($this->brands);
        foreach(Modules::get()->toArray() as $module)
            $this->modified_module_list[strtolower(str_replace(" ", "_", $module['title']))] = $module;

        // foreach($module_list as $module_info) {
        //     if (isset($db_module[strtolower(str_replace(" ", "_", $module_info['title']))])) {
        //         $this->modified_module_list[strtolower(str_replace(" ", "_", $module_info['title']))] = $db_module[strtolower(str_replace(" ", "_", $module_info['title']))] ;
        //     } else{
        //         $this->modified_module_list[strtolower(str_replace(" ", "_", $module_info['title']))] = $module_info;
        //     }
        // }
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

    public function technicians() {
        $tech = User::paginate(5);
        $data = [
            'title' => '', 
            'header' => 'Technicians',
            'techs' => $tech,
        ];
        return view('admin.pages.'.__FUNCTION__, $data);
    }

    public function manufacturers() {
        $data = [
            'title' => '', 
            'header' => 'Manufacturers',
            'brands' => $this->brands,
        ];
        return view('admin.pages.'.__FUNCTION__, $data);
    }

    public function missing() {
        $missing = MissingModel::orderBy('created_at', 'desc')->paginate(10);
        $data = [
            'title' => '', 
            'header' => 'Missing Model',
            'missing' => $missing,
        ];
        return view('admin.pages.'.__FUNCTION__, $data);
    }

    public function modules() {
        

        $data = [
            'title' => '', 
            'header' => 'Modules',
            'module_list' => $this->modified_module_list,
        ];
        return view('admin.pages.'.__FUNCTION__, $data);
    }
}