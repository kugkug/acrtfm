<?php

use App\Http\Controllers\Apis\AcController;
use App\Http\Controllers\Apis\AccountController;
use App\Http\Controllers\Apis\EdController;
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
    });
});