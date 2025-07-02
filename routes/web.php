<?php

use App\Http\Controllers\AdminAcController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AirconditionerController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\SystemModulesController;
use App\Http\Controllers\TechnicianController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', [AirconditionerController::class, 'index']);

Route::get('/admin', function () {
    $data = [
        'title' => 'User',
        'header' => 'User',
    ];
    return view('admin.login', $data);
})->name('admin');

Route::get('/models/{brand}', [AirconditionerController::class, 'models']);

Route::group(['prefix' => 'admin'], function() {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('auth');
    Route::group(['prefix' => 'maintenance'], function() {
        Route::get('/manufacturers', [AdminController::class, 'manufacturers'])->middleware('auth');
        Route::get('/modules', [AdminController::class, 'modules'])->middleware('auth');
        Route::get('/missing', [AdminController::class, 'missing'])->middleware('auth');
        Route::get('/technicians', [AdminController::class, 'technicians'])->middleware('auth');
        Route::get('/bulk-upload', [AirconditionerController::class, 'bulk_upload'])->middleware('auth');
    });

});

Route::group(['prefix' => 'admin'], function() {
    Route::group(['prefix' => 'execute'], function() {
        Route::post('/manufacturers', [ManufacturerController::class, 'store'])->middleware('auth');
        Route::post('/modules', [SystemModulesController::class, 'store'])->middleware('auth');
        Route::post('/upload-pdf', [AdminAcController::class, 'upload'])->middleware('auth');
        Route::post('/upload-pdf-bulk', [AdminAcController::class, 'upload_bulk'])->middleware('auth');
        Route::post('/delete-pdf', [AdminAcController::class, 'delete'])->middleware('auth');
        Route::post('/block-user', [UserController::class, 'block_user'])->middleware('auth');
        Route::post('/activate-user', [UserController::class, 'activate_user'])->middleware('auth');
        Route::post('/delete-user', [UserController::class, 'delete_user'])->middleware('auth');

        Route::post('/make-admin', [UserController::class, 'make_admin'])->middleware('auth');
        Route::post('/make-user', [UserController::class, 'make_user'])->middleware('auth');

    });
});

Route::group(['prefix' => 'airconditioners'], function() {
    Route::get('/search', [AirconditionerController::class, 'show']);
});

Route::group(['prefix' => 'education'], function() {
    Route::get('/search', [EducationController::class, 'show']);
});

Route::group(['prefix' => 'execute'], function() {
    Route::get('/user-add', [UserController::class, 'store']);
    Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');
    Route::post('/login', [UserController::class, 'authenticate']);

    Route::get('/ac-edit/{id}', [AirconditionerController::class, 'edit']);
    Route::put('/ac-update/{id}', [AirconditionerController::class, 'update']);

    Route::get('/ac-add', [AirconditionerController::class, 'create']);
    Route::post('/ac-save', [AirconditionerController::class, 'store']);
    Route::post('/admin/logout', [UserController::class, 'admin_logout'])->middleware('auth');

    Route::group(['prefix' => 'client'], function() {
        Route::post('/register', [TechnicianController::class, 'register']);
        Route::post('/forgot-password', [TechnicianController::class, 'forgot_password']);
        Route::post('/reset-password', [TechnicianController::class, 'reset_password']);
        Route::post('/login', [TechnicianController::class, 'login']);
    });
    
    Route::group(['prefix' => 'client', 'middleware' => 'user_check'], function() {
        
        Route::get('/logout', [TechnicianController::class, 'logout'])->middleware("auth");
        Route::post('/post', [TechnicianController::class, 'post'])->middleware("auth");
        Route::post('/delete-post', [TechnicianController::class, 'delete_post'])->middleware("auth");
        Route::get('/posts', [TechnicianController::class, 'posts'])->middleware("auth");
        
        Route::post('/comment', [TechnicianController::class, 'comment'])->middleware("auth");
        Route::post('/rate-comment', [TechnicianController::class, 'rate_comment'])->middleware("auth");
        Route::get('/delete-comment', [TechnicianController::class, 'delete_comment'])->middleware("auth");
        Route::post('/search-comment', [TechnicianController::class, 'search_comment'])->middleware("auth");
        
    });
});

Route::get('/signup', [ModulesController::class, 'signup']);
Route::get('/forgot-password', [ModulesController::class, 'forgot_password']);
Route::get('/reset-password', [ModulesController::class, 'reset_password']);

Route::get('/', [ModulesController::class, 'login'])->name("login");
Route::group(['middleware' => ['auth', 'user_check']], function () {
    Route::get('/home', [ModulesController::class, 'index']);
    Route::get('/airconditioners', [ModulesController::class, 'airconditioners']);
    Route::get('/manufacturers', [ModulesController::class, 'manufacturers']);
    Route::get('/single', [ModulesController::class, 'single']);
    Route::get('/new-entry', [ModulesController::class, 'new_entry']);
    Route::get('/login', [ModulesController::class, 'login']);
    Route::get('/education', [ModulesController::class, 'educations']);
    Route::get('/discussions', [ModulesController::class, 'discussions']);
    Route::get('/discussions/my-posts', [ModulesController::class, 'my_posts']);
    Route::get('/ask-an-expert', [ModulesController::class, 'ask_an_expert']);
    Route::get('/interesting-finds', [ModulesController::class, 'coming_soon']);
    Route::get('/be-a-member', [ModulesController::class, 'signup']);
    Route::get('/ask-ai', [ModulesController::class, 'ask_ai']);
});

Route::get('/synch', [ModulesController::class, 'synchronize']);
Route::get('/airconditioners/search/model', [AirconditionerController::class, 'search_model']);
Route::get('/airconditioners/report/model', [AirconditionerController::class, 'report_model']);

Route::get('/airconditioners/search/manual', [AirconditionerController::class, 'search_manual']);
Route::post('/airconditioners/ask/ai', [AirconditionerController::class, 'exec_ask_ai']);

Route::get('/send-raw-email', [SendMailController::class, 'index']);

Route::get('/education/shared/{educ_id}', [ModulesController::class, 'shared_education']);