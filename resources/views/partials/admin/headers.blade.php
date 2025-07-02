<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <meta name="_url" content="{!! URL::to('/') !!}" />
    <link rel="shortcut icon" href="{{ asset('images/logo2.jpg') }}" type="image/x-icon">
    

    <link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/fontawesome-free/css/all.min.css') }} ">
	  <link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/confirm/css/jquery-confirm.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/daterangepicker/daterangepicker.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"> 
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> 


  	<link rel="stylesheet" href="{{ asset('adminlte3.2/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  	
    <title>{{ $title  !== "" ? $title : "Airconditions"}}</title>

</head>
<body class="sidebar-mini layout-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-light bg-info">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
              </li>
            </ul>
        
            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <form action="/execute/admin/logout" method="POST" class="form-inline ml-0 ml-md-3">
                    @csrf
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                    
                </form>
              
            </ul> 
          </nav>
          @include('partials.admin.sidebar')

          <div class="content-wrapper" style="min-height: 1156px;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
              <div class="container-fluid">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    <h1 class="m-0">{{ ucwords(strtolower($header)) }}</h1>
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    {{-- <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol> --}}
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
        
            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">


        