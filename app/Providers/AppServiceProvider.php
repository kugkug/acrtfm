<?php

namespace App\Providers;

use App\Models\Manufacturer;
use App\Models\Modules;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Paginator::useBootstrap();

        $brand_logos = [];
        
        foreach(Manufacturer::all() as $brand_logo)
            $brand_logos[$brand_logo->brand] = $brand_logo->brand_logo;

            // View::share('title', 'Student Admin');
        View::share("app_brand_logos", $brand_logos);
        
        
        $db_module = [];
        $modified_module_list = [];
        $module_list = config('modules.module_list');
        // $db_module_list = Modules::get()->toArray();

        foreach(Modules::get()->toArray() as $module)
            $db_module[strtolower(str_replace(" ", "_", $module['identifier']))] = $module;

        // foreach($module_list as $module_info) {
        //     if (isset($db_module[strtolower(str_replace(" ", "_", $module_info['title']))])) {
        //         $modified_module_list[$db_module[strtolower(str_replace(" ", "_", $module_info['title']))]['identifier']] = $db_module[strtolower(str_replace(" ", "_", $module_info['title']))] ;
        //         // $this->modified_module_list[strtolower(str_replace(" ", "_", $module_info['title']))] = $db_module[strtolower(str_replace(" ", "_", $module_info['title']))] ;
        //     } else{
        //         $modified_module_list[strtolower(str_replace(" ", "_", $module_info['title']))] = $module_info;
        //     }
        // }
// // dd($module_list, $db_module_list);
//         // $brands = DB::table('airconditioners')->groupBy('brand')->pluck('brand');
        
//         foreach($db_module_list as $module)
//             $db_module[$module['identifier']] = $module;

//         foreach($module_list as $identifer => $module_info) {
//             if (isset($module_info[strtolower(str_replace(" ", "_", $module_info['title']))])) {
//                 $modified_module_list[$db_module[strtolower(str_replace(" ", "_", $module_info['title']))]['identifier']] = $db_module[strtolower(str_replace(" ", "_", $module_info['title']))];
//             } else{
//                 $modified_module_list[strtolower(str_replace(" ", "_", $module_info['title']))] = $module_info;
//             }
//         }

        View::share("app_module_list", $db_module);
    }
}