<?php

use App\Http\Controllers\Exec\AcController;
use App\Http\Controllers\Exec\AccountController;
use App\Http\Controllers\Exec\EdController;
use App\Http\Controllers\Exec\JbController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModulesController;

Route::get('/', [ModulesController::class, 'login'])->name("login");
Route::get('/forgot-password', [ModulesController::class, 'forgotPassword'])->name("forgot-password");
Route::get('/register', [ModulesController::class, 'register'])->name("register");



Route::get('/mobile-app', function() {
    return view('pages.mobile-app');
})->name("mobile-app");

Route::prefix('executor')->group(function () {
    Route::prefix('account')->group(function () {
        Route::post('/registration', [AccountController::class, 'registration'])->name("exec-account-registration");
        Route::post('/login', [AccountController::class, 'login'])->name("exec-account-login");
        Route::post('/logout', [AccountController::class, 'logout'])->name("exec-account-logout");
    });
});

Route::middleware(['auth:sanctum', 'web'])->group(function () {
    Route::get('/troubleshooter', function() {
        return view('pages.troubleshooter');
    })->name("troubleshooter");

    Route::get('/troubleshooter-calculator', function() {
        return view('pages.nitrogen_calculator');
    })->name("nitrogen-calculator");
    
    Route::get('/home', [ModulesController::class, 'home'])->name("home");
    Route::get('/model-lookup', [ModulesController::class, 'modelLookup'])->name("model-lookup");
    Route::get('/education', [ModulesController::class, 'education'])->name("education");
    Route::get('/ask-ai', [ModulesController::class, 'askAi'])->name("ask-ai");
        
    Route::get('/video-playlist', [ModulesController::class, 'videoPlaylist'])->name("video-playlist");

    Route::get('/shared/{id}/education', [ModulesController::class, 'sharedEducation'])->name("shared-education");
    
    Route::prefix('profile')->group(function () {
        Route::get('/', [ModulesController::class, 'profile'])->name("profile");
        
        Route::prefix('job-sites')->group(function () {
            Route::get('/', [ModulesController::class, 'job_sites'])->name("job-sites");
            
            Route::get('/{area_id}/add', [ModulesController::class, 'job_site_add'])->name("job-sites-area-add");
            Route::get('/{area_id}/areas', [ModulesController::class, 'job_sites_areas'])->name("job-sites-areas");

            Route::get('/{area_id}/view', [ModulesController::class, 'view_job_site'])->name("job-site-area-view");
            Route::get('/{area_id}/edit', [ModulesController::class, 'edit_job_site'])->name("job-site-area-edit");
            Route::get('/new', [ModulesController::class, 'new_job_site'])->name("job-site-new");

            Route::get('/{accomplishment_id}/accomplishment', [ModulesController::class, 'job_site_accomplishment'])->name("job-site-area-accomplishment");
        });
    });

    Route::get('/explore/{model}/manuals', [ModulesController::class, 'exploreManuals'])->name("explore-manuals");

    Route::prefix('executor')->group(function () {
        Route::prefix('model-lookup')->group(function () {
            Route::post('/search', [AcController::class, 'search'])->name("exec-model-lookup-search");
        });

        Route::prefix('education')->group(function () {
            Route::post('/search', [EdController::class, 'educationSearch'])->name("exec-education-search");
            Route::post('/paginate', [EdController::class, 'educationPaginate'])->name("exec-education-paginate");
        });

        Route::prefix('job-sites')->group(function () {
            Route::post('/fetch', [JbController::class, 'fetch'])->name("exec-job-sites-fetch");
            Route::post('/save', [JbController::class, 'save'])->name("exec-job-sites-save");
            Route::post('/update', [JbController::class, 'update'])->name("exec-job-site-update");
            Route::post('/delete', [JbController::class, 'delete'])->name("exec-job-sites-delete");
            
            Route::post('/update-area', [JbController::class, 'update_job_site_area'])->name("exec-job-site-area-update");
            Route::post('/delete-image', [JbController::class, 'delete_image'])->name("exec-job-site-image-delete");
            Route::post('/delete-document', [JbController::class, 'delete_document'])->name("exec-job-site-document-delete");
            Route::post('/delete-area', [JbController::class, 'delete_job_site_area'])->name("exec-job-site-area-delete");


        });

        Route::prefix('accomplishment')->group(function () {
            Route::post('/update', [JbController::class, 'update_accomplishment'])->name("exec-accomplishment-update");
            Route::post('/delete', [JbController::class, 'delete_accomplishment'])->name("exec-accomplishment-delete"); 
        });
    });
});