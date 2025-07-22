<?php

use App\Http\Controllers\Api\DiscussionController;
use App\Http\Controllers\Api\EducationController;
use App\Http\Controllers\Api\ManualsUploader;
use App\Http\Controllers\Api\PlaylistHistoryController;
use App\Http\Controllers\Api\SearchEngineController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['web'], 'prefix' => 'education'], function() {
    Route::get('list', [EducationController::class, 'list'])->name('api_educatoin_list');
});

Route::group(['middleware' => ['web'], 'prefix' => 'playlist_history'], function() {
    Route::post('/save', [PlaylistHistoryController::class, 'save']);
    Route::get('/fetch/{$user_id}', [PlaylistHistoryController::class, 'fetch']);
});

Route::group(['middleware' => ['web'], 'prefix' => 'discussion'], function() {
    Route::get('list', [DiscussionController::class, 'list'])->name('api_discussion_list');
});

Route::post('manuals-upload', [ManualsUploader::class, 'upload']);
Route::get('search-manuals', [SearchEngineController::class, 'search']);
Route::get('ask-ai', [SearchEngineController::class, 'ask_ai']);
Route::post('ask-grok-api', [SearchEngineController::class, 'ask_grok_api']);
Route::post('search-from-manual-analysis', [SearchEngineController::class, 'search_from_manual_analysis']);