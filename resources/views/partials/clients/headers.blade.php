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
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/daterangepicker/daterangepicker.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"> 
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> 
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  	
    <title>{{ $title  !== "" ? $title : "Airconditions"}}</title>

</head>
<body class="layout-top-nav layout-fixed sidebar-collapse">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-light">

            <div class="container">
				<ul class="navbar-nav" style="margin-left: 5px; margin-right: 20px;">
					<li class="nav-item">
						<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				  	</li>
				</ul>
				<a href="/home" class="navbar-brand">
                    <img src="{{ asset('images/logo1.jpg') }}" alt="App LOGO" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light ">AC RTFM</span>
                </a>				

                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <!-- Messages Dropdown Menu -->
                    {{-- <li class="nav-item dropdown">
                      <a class="nav-link" href="discussions">
                        <i class="fas fa-comments"></i>
                      </a>
                    </li> --}}
                    <!-- Notifications Dropdown Menu -->
                    <li class="nav-item dropdown">
						
                      	<a class="nav-link" data-toggle="dropdown" href="#">
                        	<i class="fa fa-user"></i>
                      	</a>
                      	<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        
                        	<a href="/execute/client/logout" class="dropdown-item">
								<i class="fas fa-sign-out-alt"></i> Log Out
                        	</a>
                      	</div>
                    </li>
                </ul>
            </div>
        </nav>

        <aside class="main-sidebar sidebar-light-danger elevation-4">
          <!-- Brand Logo -->
          <a href="home" class="brand-link">
            <img src="{{ asset('images/logo1.jpg') }}" alt="AC RTFM Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AC RTFM</span>
          </a>
      
          <!-- Sidebar -->
          <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="" class="img-circle elevation-2" alt="">
              </div>
              <div class="info">
                <a href="#" class="d-block">Technician's Page</a>
              </div>
            </div>
      
            <!-- Sidebar Menu -->
            <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="/home" class="nav-link">
						<i class="fas fa-home nav-icon"></i>
						<p>Home</p>
					</a>
				</li>

				@foreach ($app_module_list as $module)
				<li class="nav-item">
					<a href="/{{ $module['url'] }}" class="nav-link">
						{!! $module['icon']  !!}
						<p>{{ $module['label'] }}</p>
					</a>
				</li>
				@endforeach

				
            </nav>
            <!-- /.sidebar-menu -->
          </div>
          <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper" style="min-height: 1156px;">
			
            <!-- Content Header (Page header) -->
            @if ($header != "")
              <div class="content-header">
                <div class="container">
                    <div class="row">
						<div class="col-xs-6 col-sm-6 col-md-6">
							<h5 class="m-0">
								@if ($title != "Home")
									<a href="/home">
										<i class="fas fa-arrow-circle-left text-primary"></i>
									</a> 
								@endif
								{{ ucwords(strtolower($header)) }}
							</h5>	
						</div><!-- /.col -->
                      	<div class="col-xs-6 col-sm-6 col-md-6">
							<ol class="breadcrumb float-sm-right">
								{{-- <li class="breadcrumb-item"><a href="home">Home</a></li> --}}

								@if (strtolower($header) == "discussions")
									<li style="width: 100%">
										<form class="form-inline ml-0 ml-md-3" action="/execute/client/search-comment" method="post">
											@csrf
											<div class="input-group">
												<input class="form-control " type="search" name="keyword" placeholder="Search.." aria-label="Search" value="{{ $keyword}}">
												<div class="input-group-append">
													<button class="btn btn-primary" type="submit">
														<i class="fas fa-search"></i>
													</button>
												</div>
											</div>
										</form>
									</li>
								@endif
							</ol>
                      	</div>
                    </div>
                </div>
              </div>
            @endif
        
            <!-- Main content -->
            <div class="content p-0">
              <div class="container p-0">
              
        
                