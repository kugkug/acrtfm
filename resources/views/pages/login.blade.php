@include('partials.unauth.header')

<div class="login-form-bg h-100">
    <div class="container h-100">
    
        <div class="row justify-content-center h-100">
            <div class="col-xl-6">
                <div class="form-input-content">
                    <div class="card login-form mb-0 card-border-radius-0">
                        <div class="card-body pt-5">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <h1>{{ config('app.name') }}</h1>
                                </div>
                                <p class="text-center text-muted">Sign up to your account</p>
                            </div>
                            <form class="mt-5 mb-5 login-input">
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" data="req" data-key="Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" data="req" data-key="Password">
                                </div>
                                <button class="btn btn-outline-info btn-block btn-flat" data-trigger="login-submit">Sign In</button>
                            </form>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="login-form__footer"><a href="{{route('forgot-password')}}" class="text-primary">Forgot Password</a></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="login-form__footer">Dont have account? <a href="{{route('register')}}" class="text-primary">Sign Up</a> now</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.unauth.footer')

<script src="{{ asset('assets/acrtfm/js/modules/unauth.js') }}"></script>