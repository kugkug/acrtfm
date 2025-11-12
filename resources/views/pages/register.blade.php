@include('partials.unauth.header')

<div class="login-form-bg h-100">
    <div class="container h-100">

        <div class="row justify-content-center h-100">
            <div class="col-md-5">
                <div class="form-input-content">
                    <div class="card login-form my-4 card-border-radius-0">
                        <div class="card-body pt-5">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <h1 class="mb-3">
                                        <i class="fa fa-building"></i>
                                    </h1>
                                    <p class="text-muted">Sign Up as Company</p>
                                    <a href="{{route('register-company')}}" class="btn btn-outline-info btn-block btn-flat">Continue</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-2"></div>

            <div class="col-md-5">
                <div class="form-input-content">
                    <div class="card login-form my-4 card-border-radius-0">
                        <div class="card-body pt-5">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <h1 class="mb-3">
                                        <i class="fa fa-user-cog"></i>
                                    </h1>
                                    <p class="text-muted">Sign Up as Technician</p>
                                    <a href="{{route('register-technician')}}" class="btn btn-outline-info btn-block btn-flat">Continue</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <a href="{{route('login')}}" class="btn btn-outline-primary btn-block btn-flat mb-3">Back to Login</a>
                </div>
            </div>
        </div>

       

    </div>
</div>

@include('partials.unauth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/unauth.js') }}"></script>