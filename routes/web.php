<?php

use App\Http\Controllers\Exec\AcController;
use App\Http\Controllers\Exec\AccountController;
use App\Http\Controllers\Exec\CustomerController;
use App\Http\Controllers\Exec\EdController;
use App\Http\Controllers\Exec\JbController;
use App\Http\Controllers\Exec\QuoteController;
use App\Http\Controllers\Exec\TechnicianController;
use App\Http\Controllers\Exec\WorkOrderController;
use App\Http\Controllers\Exec\WorkOrderStatementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModulesController;

Route::get('/', [ModulesController::class, 'login'])->name("login");
Route::get('/forgot-password', [ModulesController::class, 'forgotPassword'])->name("forgot-password");
Route::get('/register', [ModulesController::class, 'register'])->name("register");
Route::get('/company/register', [ModulesController::class, 'registerCompany'])->name("register-company");
Route::get('/technician/register', [ModulesController::class, 'registerTechnician'])->name("register-technician");



Route::get('/mobile-app', function() {
    return view('pages.mobile-app');
})->name("mobile-app");

Route::prefix('executor')->group(function () {
    Route::prefix('account')->group(function () {
        Route::post('/registration', [AccountController::class, 'registration'])->name("exec-account-registration");
        Route::post('/company-registration', [AccountController::class, 'registrationCompany'])->name("exec-company-registration");
        Route::post('/technician-registration', [AccountController::class, 'registrationTechnician'])->name("exec-technician-registration");
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
    Route::get('/tech-dispatch', [ModulesController::class, 'techDispatch'])->name("tech-dispatch");
    
    // Tech Dispatch Routes
    Route::prefix('tech-dispatch')->group(function () {
        Route::get('/customers', [ModulesController::class, 'techDispatchCustomers'])->name("tech-dispatch.customers");
        Route::get('/work-orders', [ModulesController::class, 'techDispatchWorkOrders'])->name("tech-dispatch.work-orders");
        Route::get('/quotes', [ModulesController::class, 'techDispatchQuotes'])->name("tech-dispatch.quotes");
        Route::get('/calendar', [ModulesController::class, 'techDispatchCalendar'])->name("tech-dispatch.calendar");
    });

    Route::prefix('customers')->group(function () {
        Route::get('/', [ModulesController::class, 'customers'])->name("customers");
        Route::get('/{id}/view', [ModulesController::class, 'view_customer'])->name("customers.view");
        Route::get('/new', [ModulesController::class, 'new_customer'])->name("customers.new");
        Route::get('/{id}/edit', [ModulesController::class, 'edit_customer'])->name("customers.edit");
    });

    Route::prefix('locations')->group(function () {
        Route::get('/{customer_id}/create', [ModulesController::class, 'create_location'])->name("locations.create");
        Route::get('/{id}/edit', [ModulesController::class, 'edit_location'])->name("locations.edit");
    });

    Route::prefix('equipments')->group(function () {
        Route::get('/{customer_id}/create', [ModulesController::class, 'create_equipment'])->name("equipments.create");
        Route::get('/{id}/edit', [ModulesController::class, 'edit_equipment'])->name("equipments.edit");
    });

    Route::prefix('work-orders')->group(function () {
        Route::get('/', [ModulesController::class, 'work_orders'])->name("work-orders");
        Route::get('/new', [ModulesController::class, 'new_work_order'])->name("work-orders.new");
        Route::get('/{id}/view', [ModulesController::class, 'view_work_order'])->name("work-orders.view");
        Route::get('/{id}/edit', [ModulesController::class, 'edit_work_order'])->name("work-orders.edit");
        Route::get('/{id}/statement', [WorkOrderStatementController::class, 'show'])->name('work-orders.statement.show');
        Route::post('/{id}/statement', [WorkOrderStatementController::class, 'store'])->name('work-orders.statement.store');
        Route::get('/{id}/statement/download', [WorkOrderStatementController::class, 'download'])->name('work-orders.statement.download');
    });

    Route::prefix('quotes')->group(function () {
        Route::get('/', [ModulesController::class, 'quotes'])->name("quotes");
        Route::get('/new', [ModulesController::class, 'new_quote'])->name("quotes.new");
        Route::get('/{id}/view', [ModulesController::class, 'view_quote'])->name("quotes.view");
        Route::get('/{id}/edit', [ModulesController::class, 'edit_quote'])->name("quotes.edit");
    });

    // Quotation E-Signature Routes
    Route::prefix('quotation')->group(function () {
        Route::get('/{id}/sign', [QuoteController::class, 'showQuotationForSignature'])->name("quotation.sign");
        Route::post('/{id}/signature', [QuoteController::class, 'saveSignature'])->name("quotation.save-signature");
        Route::post('/{id}/send-link', [QuoteController::class, 'sendSignatureLink'])->name("quotation.send-link");
        Route::get('/{id}/signed', [QuoteController::class, 'showSignedQuotation'])->name("quotation.signed");
        Route::get('/{id}/download', [QuoteController::class, 'downloadSignedQuotation'])->name("quotation.download");
    });

    Route::get('/technicians', [ModulesController::class, 'technicians'])->name("technicians");
    Route::post('/technicians/{id}/company-confirmation', [TechnicianController::class, 'updateCompanyConfirmation'])->name("technicians.company-confirmation");
        
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

        Route::prefix('accomplishment')->group(function () {
            Route::get('/{job_area_id}/add', [ModulesController::class, 'add_accomplishment'])->name("accomplishment-add");
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
            Route::post('/add', [JbController::class, 'add_accomplishment'])->name("exec-accomplishment-add");
            Route::post('/update', [JbController::class, 'update_accomplishment'])->name("exec-accomplishment-update");
            Route::post('/delete', [JbController::class, 'delete_accomplishment'])->name("exec-accomplishment-delete"); 
        });


        Route::prefix('customers')->group(function () {
            Route::post('/save', [CustomerController::class, 'save'])->name("exec-customers-save");
            Route::post('{id}/update', [CustomerController::class, 'update'])->name("exec-customers-update");
            Route::post('{id}/delete', [CustomerController::class, 'delete'])->name("exec-customers-delete");
        });

        Route::prefix('location')->group(function () {
            Route::post('/save', [CustomerController::class, 'save_location'])->name("exec-customers-save-location");
            Route::post('/{id}/update', [CustomerController::class, 'update_location'])->name("exec-customers-update-location");
            Route::post('/{id}/delete', [CustomerController::class, 'delete_location'])->name("exec-customers-delete-location");
        });

        Route::prefix('equipment')->group(function () {
            Route::post('/save', [CustomerController::class, 'save_equipment'])->name("exec-customers-save-equipment");
            Route::post('/{id}/update', [CustomerController::class, 'update_equipment'])->name("exec-customers-update-equipment");
            Route::post('/{id}/delete', [CustomerController::class, 'delete_equipment'])->name("exec-customers-delete-equipment");
        });


        Route::prefix('work-orders')->group(function () {
            Route::post('/save', [WorkOrderController::class, 'save'])->name("exec-work-orders-save");
            Route::post('/{id}/update', [WorkOrderController::class, 'update'])->name("exec-work-orders-update");
            Route::post('/{id}/delete', [WorkOrderController::class, 'delete'])->name("exec-work-orders-delete");

            Route::post('/add-photos', [WorkOrderController::class, 'add_photos'])->name("exec-work-orders-add-photos");
            Route::post('/{id}/fetch-photos', [WorkOrderController::class, 'fetch_photos'])->name("exec-work-orders-fetch-photos");
            Route::post('/{id}/delete-image', [WorkOrderController::class, 'delete_image'])->name("exec-work-orders-delete-image");

            Route::post('/{id}/add-note', [WorkOrderController::class, 'add_note'])->name("exec-work-orders-add-note");
            Route::post('/{id}/fetch-notes', [WorkOrderController::class, 'fetch_notes'])->name("exec-work-orders-fetch-notes");

            Route::get('/{id}/generate-quotation', [WorkOrderController::class, 'generate_quotation'])->name("exec-work-orders-generate-quotation");
        });
    });
});

Route::prefix('public/quotation')->middleware('signed')->group(function () {
    Route::get('/{id}/sign', [QuoteController::class, 'showQuotationForSignaturePublic'])->name('quotation.public-sign');
    Route::post('/{id}/signature', [QuoteController::class, 'saveSignature'])->name('quotation.public-save-signature');
    Route::get('/{id}/signed', [QuoteController::class, 'showSignedQuotationPublic'])->name('quotation.public-signed');
    Route::get('/{id}/download', [QuoteController::class, 'downloadSignedQuotationPublic'])->name('quotation.public-download');
});