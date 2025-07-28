
<!DOCTYPE html>
<html class="h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <meta name="_url" content="{!! URL::to('/') !!}" />
    <meta name="theme" content="{{ $theme }}">
    <title> {{ config('app.name') }} </title>

    <link rel="shortcut icon" href="{{ asset('assets/system/images/acrtfm_logo.png') }}" type="image/x-icon">

    <link
      href="{{ asset('assets/system/plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}"
      rel="stylesheet"
    />
    <link href="{{ asset('assets/system/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/system/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/system/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/system/plugins/toastr/css/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/system/plugins/jquery-asColorPicker-master/css/asColorPicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/system/select2/dist/css/select2.min.css') }}" rel="stylesheet">    
    <link href="{{ asset('assets/system/datetime-picker/jquery.datetimepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/system/plugins/sweetalert/css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/system/css/style.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/system/css/override.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('assets/acrtfm/css/styles.css') }}" type="text/css" rel="stylesheet">
    
</head>

<body class="h-100">
    @include('components.loader.full-loader')

    <div id="main-wrapper">

        <div class="nav-header">
            <div class="brand-logo">
                <a href="{{ route('home') }}">
                    <b class="logo-abbr"><img src="{{ asset('assets/system/images/acrtfm_logo.png') }}" alt=""> </b>
                    <span class="logo-compact"><img src="{{ asset('assets/system/images/acrtfm_logo.png') }}" alt=""></span>
                    <span class="brand-title">
                        <h1>{{ config('app.name') }}</h1>
                    </span>
                </a>
            </div>
        </div>

        <div class="header">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="toggle-icon"><i class="icon-menu"></i></span>
                    </div>
                </div>

                <div class="header-right">
                    <ul class="clearfix">
                        
                        <li class="icons">
                            <a href="javascript:void(0)" data-action="toggle-theme">
                                @if ($theme == 'light')
                                    <i class="fa fa-moon text-secondary fa-action"></i>
                                @else
                                    <i class="fa fa-sun text-warning fa-action"></i>
                                @endif
                            </a>
                        </li>
                        <li class="icons dropdown">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity"></span>
                                <img src="{{ asset('assets/system/images/logo.svg') }}" height="40" width="40" alt="UI">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="icon-envelope-open"></i> <span>Settings</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="icon-user"></i> <span>Profile</span>
                                            </a>
                                        </li>                                                                               
                                        <li><a href="javascript:void(0)" data-action="logout"><i class="icon-key"></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        @include('partials.auth.sidebar')

        <div class="content-body">  
            <div class="row page-titles mx-0">
                <div class="col-12">
                    <h1 class="">{{ $title }}</h1>
                    <p class="module-description">{{ $description }}</p>
                </div>
                <div class="col-6">
                    {{-- @include('components.right-panel') --}}
                    {{-- <x-right-panel 
                        xtype='{{ $panel_type }}'
                        xread='{{ $permissions[$panel_type]['read']  ?? false }}'
                        xwrite='{{ $permissions[$panel_type]['edit']  ?? false }}'
                        xdelete='{{ $permissions[$panel_type]['delete']  ?? false }}'
                    /> --}}
                </div>
            </div>
        