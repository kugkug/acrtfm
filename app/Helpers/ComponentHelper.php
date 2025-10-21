<?php

    declare(strict_types=1);
    namespace App\Helpers;

    class ComponentHelper {

        public function rightPanel(string $type, array $data): string {

            switch ($type) {
                case 'job-sites':
                    $html ="<a href='".route('job-site-new')."' class='btn btn-success float-right btn-md btn-flat text-white'>
                                <i class='fa fa-plus'></i> New 
                            </a>";
                    break;
                case 'job-site-new':
                    $html ="<a href='".route('job-sites')."' class='btn btn-primary float-right btn-md btn-flat text-white'>
                                <i class='fa fa-undo'></i> Back
                            </a>";
                    break;
                case 'job-site-areas':
                    $html ="
                    <div class='d-none d-sm-none d-md-block d-lg-block d-xl-block'>
                        <div class='d-flex justify-content-end'>
                            <a href='".route('job-sites')."' class='btn btn-primary btn-md btn-flat mr-2'>
                                <i class='fa fa-undo'></i> Back to List
                            </a>
                            <a href='".route('job-sites-area-add', $data['id'])."' class='btn btn-success btn-md btn-flat mr-2 text-white'>
                                <i class='fa fa-plus'></i> Add New
                            </a>
                            <a href='#' class='btn btn-danger btn-md btn-flat' data-trigger='delete-job-site' data-id='".$data['id']."'>
                                <i class='fa fa-trash'></i> Delete
                            </a>
                        </div>
                    </div>
                    <div class='d-sm-block d-md-none d-lg-none d-xl-none'>
                        <div class='basic-dropdown float-right'>
                            <div class='dropleft'>
                                <button type='button' class='btn mb-1 btn-rounded btn-outline-info' data-toggle='dropdown'>
                                    <i class='fa fa-ellipsis-v'></i>
                                </button>
                                <div class='dropdown-menu'>
                                    <a class='dropdown-item mb-1 text-primary' href='".route('job-sites')."'>
                                        <i class='fa fa-undo'></i> Back to List
                                    </a>
                                    <a class='dropdown-item mb-1 text-success' href='".route('job-sites-area-add', $data['id'])."'> 
                                        <i class='fa fa-plus'></i> Add New
                                    </a> 
                                    <a class='dropdown-item text-danger' href='javascript:void(0);' 
                                        data-trigger='delete-job-site' data-id='".$data['id']."'
                                    >
                                        <i class='fa fa-trash'></i> Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
                    break;
                case 'job-site-area-view':
                    $html ="
                        <div class='d-none d-sm-none d-md-block d-lg-block d-xl-block'>
                            <div class='d-flex justify-content-end'>
                                <a href='".route('job-sites-areas', $data['site_id'])."' class='btn btn-primary btn-md btn-flat mr-2'>
                                    <i class='fa fa-undo'></i> Back to Areas
                                </a>
                                <a href='".route('accomplishment-add', $data['id'])."' class='btn btn-success btn-md btn-flat mr-2'>
                                    <i class='fa fa-plus'></i> Add Accomplishment
                                </a>
                                <a href='#' class='btn btn-danger btn-md btn-flat' data-trigger='delete-job-area' data-id='".$data['id']."'>
                                    <i class='fa fa-trash'></i> Delete Area
                                </a>
                            </div>
                        </div>
                        <div class='d-sm-block d-md-none d-lg-none d-xl-none'>
                            <div class='basic-dropdown float-right'>
                                <div class='dropleft'>
                                    <button type='button' class='btn mb-1 btn-rounded btn-outline-info' data-toggle='dropdown'>
                                        <i class='fa fa-ellipsis-v'></i>
                                    </button>
                                    <div class='dropdown-menu'>
                                        <a class='dropdown-item mb-1 text-primary' href='".route('job-sites-areas', $data['site_id'])."'>
                                            <i class='fa fa-undo'></i> Back to Areas
                                        </a>
                                        <a class='dropdown-item mb-1 text-success' href='".route('accomplishment-add', $data['id'])."'>
                                            <i class='fa fa-plus'></i> Add Accomplishment
                                        </a>
                                        <a class='dropdown-item text-danger' href='javascript:void(0);' data-trigger='delete-job-area' data-id='".$data['id']."'>
                                            <i class='fa fa-trash'></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
                    break;
                case 'job-site-area-add':
                    $html ="
                        <a href='".route('job-sites-areas', $data['id'])."' class='btn btn-primary btn-md btn-flat float-right'>
                            <i class='fa fa-undo'></i> Back
                        </a>
                    ";
                    break;
                case 'job-site-area-edit':
                    $html ="
                        <a href='".route('job-sites-areas', $data['id'])."' class='btn btn-primary btn-md btn-flat float-right'>
                            <i class='fa fa-undo'></i> Back
                        </a>
                    ";
                    break;
                case 'job-site-area-accomplishment':
                    $html ="
                        <div class='d-none d-sm-none d-md-block d-lg-block d-xl-block'>
                            <div class='d-flex justify-content-end'>
                                <a href='".route('job-site-area-view', $data['job_area_id'])."' class='btn btn-primary btn-md btn-flat mr-2'>
                                    <i class='fa fa-undo'></i> Back
                                </a>
                                <a href='#' class='btn btn-danger btn-md btn-flat' data-trigger='delete-accomplishment' data-id='".$data['id']."'>
                                    <i class='fa fa-trash'></i> Delete
                                </a>
                            </div>
                        </div>
                        <div class='d-sm-block d-md-none d-lg-none d-xl-none'>
                            <div class='basic-dropdown float-right'>
                                <div class='dropleft'>
                                    <button type='button' class='btn mb-1 btn-rounded btn-outline-info' data-toggle='dropdown'>
                                        <i class='fa fa-ellipsis-v'></i>
                                    </button>
                                    <div class='dropdown-menu'>
                                        <a class='dropdown-item mb-1 text-primary' href='".route('job-site-area-view', $data['job_area_id'])."'>
                                            <i class='fa fa-undo'></i> Back 
                                        </a>
                                        <a class='dropdown-item text-danger' href='javascript:void(0);' data-trigger='delete-accomplishment' data-id='".$data['id']."'>
                                            <i class='fa fa-trash'></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    ";
                    break;
                case 'accomplishment-add':
                    $html ="
                        <a href='".route('job-site-area-view', $data['job_area_id'])."' class='btn btn-primary btn-md btn-flat float-right'>
                            <i class='fa fa-undo'></i> Back
                        </a>
                    ";
                    break;

                case 'customers-index':
                    $html ="

                         <div class='d-none d-sm-none d-md-block d-lg-block d-xl-block'>
                            <div class='d-flex justify-content-end'>
                                <a href='".route('customers.new')."' class='btn btn-info btn-md btn-flat mr-2'>
                                    <i class='fa fa-user-plus'></i> Add Customer
                                </a>
                                <a href='".redirect()->back()->getTargetUrl()."' class='btn btn-primary btn-md btn-flat'>
                                    <i class='fa fa-undo'></i> Back
                                </a>
                            </div>
                        </div>
                        <div class='d-sm-block d-md-none d-lg-none d-xl-none'>
                            <div class='basic-dropdown float-right'>
                                <div class='dropleft'>
                                    <button type='button' class='btn mb-1 btn-rounded btn-outline-info' data-toggle='dropdown'>
                                        <i class='fa fa-ellipsis-v'></i>
                                    </button>
                                    <div class='dropdown-menu'>
                                        <a class='dropdown-item mb-1 text-info' href='".route('customers.new')."'>
                                            <i class='fa fa-user-plus'></i> Add Customer
                                        </a>
                                        <a class='dropdown-item mb-1 text-primary' href='".redirect()->back()->getTargetUrl()."'>
                                            <i class='fa fa-undo'></i> Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
                    break;
                case 'quotes-index':
                    $html ="
                        <div class='d-flex justify-content-end'>
                            <a href='".route('quotes.new')."' class='btn btn-info btn-md btn-flat mr-2'>
                                <i class='fa fa-plus'></i> Create Quote
                            </a>
                            <a href='".redirect()->back()->getTargetUrl()."' class='btn btn-primary btn-md btn-flat'>
                                <i class='fa fa-undo'></i> Back
                            </a>
                            </div>
                    ";
                    break;

                case 'work-orders-index':
                    $html ="
                        <div class='d-none d-sm-none d-md-block d-lg-block d-xl-block'>
                            <div class='d-flex justify-content-end'>
                                <a href='".route('work-orders.new')."' class='btn btn-info btn-md btn-flat mr-2'>
                                    <i class='fa fa-plus'></i> New Work Order
                                </a>
                                <a href='".redirect()->back()->getTargetUrl()."' class='btn btn-primary btn-md btn-flat'>
                                    <i class='fa fa-undo'></i> Back
                                </a>
                            </div>
                        </div>
                        <div class='d-sm-block d-md-none d-lg-none d-xl-none'>
                            <div class='basic-dropdown float-right'>
                                <div class='dropleft'>
                                    <button type='button' class='btn mb-1 btn-rounded btn-outline-info' data-toggle='dropdown'>
                                        <i class='fa fa-ellipsis-v'></i>
                                    </button>
                                
                                    <div class='dropdown-menu'>
                                        <a class='dropdown-item mb-1 text-info' href='".route('work-orders.new')."'>
                                            <i class='fa fa-plus'></i> New Work Order
                                        </a>
                                        <a class='dropdown-item mb-1 text-primary' href='".redirect()->back()->getTargetUrl()."'>
                                            <i class='fa fa-undo'></i> Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ";
                    break;
                
                default:  
                    $html ="
                        <a href='".redirect()->back()->getTargetUrl()."' class='btn btn-primary btn-md btn-flat float-right'>
                            <i class='fa fa-undo'></i> Back
                        </a>
                    ";
                    
            }

            return $html;
        }
    }