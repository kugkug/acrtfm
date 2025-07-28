@include('partials.unauth.header')
<div class="login-form-bg h-100">
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="col-md-9">
                <div class="form-input-content">
                    <div class="card login-form mb-0 card-border-radius-0">
                        <div class="card-body pt-5">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <h1>{{ config('app.name') }}</h1>
                                </div>
                                <p class="text-center text-muted">Sign up to your account</p>
                                    <form class="mt-5 mb-5 login-input">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="FirstName">First Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-md"  placeholder="John" data="req" data-key="FirstName">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="LastName">Last Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-md"  placeholder="Doe" data="req" data-key="LastName">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="Email">Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control form-control-md"  placeholder="you@example.com" data="req" data-key="Email">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="PhoneNumber">Phone Number <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-md phone-number"  placeholder="1234567890" maxlength="12" data-mask="9999999999" data="req" data-key="PhoneNumber">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="CompanyName">Company Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-md"  placeholder="Company Name" data="req" data-key="Company">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="Password">Password <span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control form-control-md" placeholder="******" data="req" data-key="Password">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="ConfirmPassword">Confirm Password <span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control form-control-md" placeholder="******" data="req" data-key="ConfirmPassword">
                                                </div>
                                            </div>
                                        </div>      
                                        
                                        <button class="btn btn-outline-info btn-block btn-flat" data-trigger="sign-up-submit">Sign Up</button>
                                    </form>
                                    <p class="mt-5 login-form__footer">Have account <a href="{{route('login')}}" class="text-primary">Log In </a> now</p>
                                    </div>
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