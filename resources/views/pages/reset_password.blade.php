
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('images/logo2.jpg') }}" type="image/x-icon">
  <title>ACRTFM | Forgot Password</title>

  <link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/fontawesome-free/css/all.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte3.2/dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>

<body class="hold-transition login-page ">
    
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>ACRTFM</b> </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Please enter youre desired password.</p>
            <form action="/execute/client/reset-password" method="POST">		
                @csrf
                @error('error_msg')
                    <p class="text-danger">
                        {{$message}}
                    </p>    
                @enderror

                @if(session()->has('message'))
                    <p class="text-success">
                        {{ session()->get('message') }}
                    </p>
                @endif
				
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" value="{{ old('password') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-eye spn-link"></span>
                        </div>
                    </div>
                </div>
				<div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-eye spn-link"></span>
                        </div>
                    </div>
                </div>

				<div class="row mt-2 mb-2">
					<div class="col-12">
						<button type="submit" class="btn btn-primary btn-block" id="btn-change-password">Change Password</button>
					</div>
				</div>
            </form>
			<p class="mb-0">
				<a href="/" class="text-center">Go to Login</a>
			</p>
        </div>
    </div>
</div>

<script src="{{ asset('adminlte3.2/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte3.2/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte3.2/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('adminlte3.2/dist/js/adminlte.js') }}"></script>

<script src="{{ asset('scripts/registration.js') }}"></script>

</body>
</html>
