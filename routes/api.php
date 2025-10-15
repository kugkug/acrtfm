<?php

use App\Http\Controllers\Apis\AcController;
use App\Http\Controllers\Apis\AccountController;
use App\Http\Controllers\Apis\CustomerController;
use App\Http\Controllers\Apis\EdController;
use App\Http\Controllers\Apis\JbController;
use App\Http\Controllers\Apis\WorkOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('account')->group(function () {
    Route::post('/registration', [AccountController::class, 'registration'])->name("api-account-registration");
    Route::post('/login', [AccountController::class, 'login'])->name("api-account-login");
    Route::post('/logout', [AccountController::class, 'logout'])->name("api-account-logout");
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('model-lookup')->group(function () {
        Route::post('/search', [AcController::class, 'search'])->name("api-model-lookup-search");
    });

    Route::prefix('education')->group(function () {
        Route::post('/search', [EdController::class, 'educationSearch'])->name("api-education-search");
        Route::post('/paginate', [EdController::class, 'educationPaginate'])->name("api-education-paginate");
    });

    Route::prefix('job-sites')->group(function () {
        Route::post('/fetch', [JbController::class, 'fetch'])->name("api-job-sites-fetch");
        Route::post('/save', [JbController::class, 'save'])->name("api-job-sites-save");
        Route::post('/update', [JbController::class, 'update'])->name("api-job-site-update");
        Route::post('/delete', [JbController::class, 'delete'])->name("api-job-sites-delete");
        
        Route::post('/update-area', [JbController::class, 'update_job_site_area'])->name("api-job-site-area-update");   
        Route::post('/delete-image', [JbController::class, 'delete_image'])->name("api-job-site-image-delete");
        Route::post('/delete-document', [JbController::class, 'delete_document'])->name("api-job-site-document-delete");
        Route::post('/delete-area', [JbController::class, 'delete_job_site_area'])->name("api-job-site-area-delete");
    });

    Route::prefix('accomplishment')->group(function () {
        Route::post('/add', [JbController::class, 'add_accomplishment'])->name("api-accomplishment-add");
        Route::post('/update', [JbController::class, 'update_accomplishment'])->name("api-accomplishment-update");
        Route::post('/delete', [JbController::class, 'delete_accomplishment'])->name("api-accomplishment-delete");
    });

    Route::prefix('customers')->group(function () {
        Route::post('/save', [CustomerController::class, 'save'])->name("api-customers-save");
        Route::post('{id}/update', [CustomerController::class, 'update'])->name("api-customers-update");
        Route::post('{id}/delete', [CustomerController::class, 'delete'])->name("api-customers-delete");
    });

    Route::prefix('location')->group(function () {
        Route::post('/save', [CustomerController::class, 'save_location'])->name("api-customers-save-location");
        Route::post('/{id}/update', [CustomerController::class, 'update_location'])->name("api-customers-update-location");
        Route::post('/{id}/delete', [CustomerController::class, 'delete_location'])->name("api-customers-delete-location");
    });

    Route::prefix('equipment')->group(function () {
        Route::post('/save', [CustomerController::class, 'save_equipment'])->name("api-customers-save-equipment");
        Route::post('/{id}/update', [CustomerController::class, 'update_equipment'])->name("api-customers-update-equipment");
        Route::post('/{id}/delete', [CustomerController::class, 'delete_equipment'])->name("api-customers-delete-equipment");
    });

    Route::prefix('work-orders')->group(function () {
        Route::post('/save', [WorkOrderController::class, 'save'])->name("api-work-orders-save");
        Route::post('/{id}/update', [WorkOrderController::class, 'update'])->name("api-work-orders-update");
        Route::post('/{id}/delete', [WorkOrderController::class, 'delete'])->name("api-work-orders-delete");
   
        Route::post('/add-photos', [WorkOrderController::class, 'add_photos'])->name("api-work-orders-add-photos");
        Route::post('/{id}/fetch-photos', [WorkOrderController::class, 'fetch_photos'])->name("api-work-orders-fetch-photos");
        Route::post('/{id}/delete-image', [WorkOrderController::class, 'delete_image'])->name("api-work-orders-delete-image");

        Route::post('/{id}/add-note', [WorkOrderController::class, 'add_note'])->name("api-work-orders-add-note");
        Route::post('/{id}/fetch-notes', [WorkOrderController::class, 'fetch_notes'])->name("api-work-orders-fetch-notes");
    });
});