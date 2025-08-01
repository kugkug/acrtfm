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

Route::prefix('executor')->group(function () {
    Route::prefix('account')->group(function () {
        Route::post('/registration', [AccountController::class, 'registration'])->name("exec-account-registration");
        Route::post('/login', [AccountController::class, 'login'])->name("exec-account-login");
        Route::post('/logout', [AccountController::class, 'logout'])->name("exec-account-logout");
    });
});

Route::middleware(['auth:sanctum', 'web'])->group(function () {
    Route::get('/home', [ModulesController::class, 'home'])->name("home");
    Route::get('/model-lookup', [ModulesController::class, 'modelLookup'])->name("model-lookup");
    Route::get('/education', [ModulesController::class, 'education'])->name("education");
    Route::get('/ask-ai', [ModulesController::class, 'askAi'])->name("ask-ai");
        
    Route::get('/video-playlist', [ModulesController::class, 'videoPlaylist'])->name("video-playlist");

    Route::get('/shared/{id}/education', [ModulesController::class, 'sharedEducation'])->name("shared-education");
    
    Route::prefix('profile')->group(function () {
        Route::get('/', [ModulesController::class, 'profile'])->name("profile");
        
        Route::prefix('my-jobs')->group(function () {
            Route::get('/', [ModulesController::class, 'myJobs'])->name("my-jobs");
            Route::get('/new', [ModulesController::class, 'newJob'])->name("my-jobs-new");
            Route::get('/edit/{id}', [ModulesController::class, 'editJob'])->name("my-jobs-edit");
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

        Route::prefix('jobs')->group(function () {
            Route::post('/fetch', [JbController::class, 'fetch'])->name("exec-jobs-fetch");
            Route::post('/save', [JbController::class, 'save'])->name("exec-jobs-save");
        });
    });
});