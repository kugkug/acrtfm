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
                    
                <p class="text-danger">
                    {{$message}}
                </p>
                <p class="mt-2">
                    <a href="/forgot-password">Forgot my password</a>
                  </p>
                <p>
                <p class="mt-2">
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