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
                            <a href='".route('job-sites-add', $data['id'])."' class='btn btn-success btn-md btn-flat mr-2 text-white'>
                                <i class='fa fa-plus'></i> Add New 
                            </a>
                            <a href='#' class='btn btn-danger btn-md btn-flat' data-trigger='delete-job-site' data-sub-id='".$data['id']."'>
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
                                    <a class='dropdown-item mb-1 text-success' href='".route('job-sites-add', $data['id'])."'> 
                                        <i class='fa fa-plus'></i> Add New 
                                    </a> 
                                    <a class='dropdown-item text-danger' href='javascript:void(0);' data-trigger='delete-job-site' data-id='".$data['id']."'>
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
                                <a href='".route('job-sites-areas', $data['id'])."' class='btn btn-primary btn-md btn-flat mr-2'>
                                    <i class='fa fa-undo'></i> Back to Areas
                                </a>
                                <a href='".route('job-site-area-edit', $data['id'])."' class='btn btn-info btn-md btn-flat mr-2'>
                                    <i class='fa fa-edit'></i> Edit Area
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
                                        <a class='dropdown-item mb-1 text-primary' href='".route('job-sites-areas', $data['id'])."'>
                                            <i class='fa fa-undo'></i> Back to Areas
                                        </a>
                                        <a class='dropdown-item mb-1 text-info' href='".route('job-site-area-edit', $data['id'])."'> 
                                            <i class='fa fa-edit'></i> Edit
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
            }

            return $html;
        }

    }