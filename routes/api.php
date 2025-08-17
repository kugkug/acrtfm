<?php

use App\Http\Controllers\Apis\AcController;
use App\Http\Controllers\Apis\AccountController;
use App\Http\Controllers\Apis\EdController;
use App\Http\Controllers\Apis\JbController;
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
        
        Route::post('/delete-image', [JbController::class, 'delete_image'])->name("api-job-site-image-delete");
        Route::post('/delete-document', [JbController::class, 'delete_document'])->name("api-job-site-document-delete");
        Route::post('/delete-area', [JbController::class, 'delete_job_site_area'])->name("api-job-site-area-delete");
    });
});