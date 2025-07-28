<?php

use App\Http\Controllers\Exec\AcController;
use App\Http\Controllers\Exec\AccountController;
use App\Http\Controllers\Exec\EdController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModulesController;

Route::get('/', [ModulesController::class, 'login'])->name("login");
Route::get('/forgot-password', [ModulesController::class, 'forgotPassword'])->name("forgot-password");
Route::get('/register', [ModulesController::class, 'register'])->name("register");

Route::prefix('executor')->group(function () {
    Route::prefix('account')->group(function () {
        Route::post('/registration', [AccountController::class, 'registration'])->name("exec-account-registration");
        Route::post('/login', [AccountController::class, 'login'])->name("exec-account-login");
        Route::post('/logout', [AccountController::class, 'logout'])->name("exec-account-logout");
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/home', [ModulesController::class, 'home'])->name("home");
    Route::get('/model-lookup', [ModulesController::class, 'modelLookup'])->name("model-lookup");
    Route::get('/education', [ModulesController::class, 'education'])->name("education");
    Route::get('/ask-ai', [ModulesController::class, 'askAi'])->name("ask-ai");

    Route::get('/explore/{model}/manuals', [ModulesController::class, 'exploreManuals'])->name("explore-manuals");

    Route::prefix('executor')->group(function () {
        Route::prefix('model-lookup')->group(function () {
            Route::post('/search', [AcController::class, 'search'])->name("exec-model-lookup-search");
        });

        Route::prefix('education')->group(function () {
            Route::post('/search', [EdController::class, 'educationSearch'])->name("exec-education-search");
        });
    });
});