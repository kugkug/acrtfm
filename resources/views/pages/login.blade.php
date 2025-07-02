
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('images/logo2.jpg') }}" type="image/x-icon">
  <title>ACRTFM | Log in</title>

  <link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/fontawesome-free/css/all.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('adminlte3.2/dist/css/adminlte.min.css') }}">

</head>

<body class="hold-transition login-page ">
    
<div class="login-box">
    <div class="login-logo">
        <a href="/"><b>ACRTFM</b> </a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">Sign in to start your session</p>
            <form action="/execute/client/login" method="POST">
                @csrf
                @error('email')
                    <p class="text-danger">
                        {{$message}}
                    </p>    
                @enderror
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-eye spn-link"></span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </form>
			<p class="mt-2">
				<a href="/forgot-password">Forgot my password</a>
			  </p>
			<p>
				<a href="/signup" class="text-center">Create a login</a>
			  </p>
        </div>
		
    </div>
</div>
<script src="{{ asset('adminlte3.2/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte3.2/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte3.2/dist/js/adminlte.js') }}"></script>
</body>
</html>

<script>
    $(document).ready(function() {
        $(".spn-link").on("click", function () {
            let eye = $(this);
            let parent = $(this).closest("div.input-group");
            let input = $(parent).find("input")[0];

            if (eye.hasClass("fa-eye")) {
                $(input).attr("type", "text");

                eye.removeClass("fa-eye").addClass("fa-eye-slash");
            } else {
                $(input).attr("type", "password");

                eye.removeClass("fa-eye-slash").addClass("fa-eye");
            }
        });
    });
</script>
