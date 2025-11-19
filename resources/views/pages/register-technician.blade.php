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
                                <p class="text-center text-muted">Sign up for a new technician account</p>
                                    <form class="mt-5 mb-5 login-input">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="CompanyCode">Company Code </label>
                                                    <input type="text" class="form-control form-control-md override-input"  placeholder="ABC123" data-key="CompanyCode">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="CompanyName">First Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-md override-input"  placeholder="John" data="req" data-key="FirstName">
                                                    <div id="val-FirstName-error" class="invalid-feedback animated fadeInDown">Please provide a First Name</div>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="LastName">Last Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-md override-input"  placeholder="Doe" data="req" data-key="LastName">
                                                    <div id="val-LastName-error" class="invalid-feedback animated fadeInDown">Please provide a Last Name</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="PhoneNumber">Contact<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-md override-input"  placeholder="1234567890" data="req" data-key="PhoneNumber">
                                                    <div id="val-PhoneNumber-error" class="invalid-feedback animated fadeInDown">Please provide a Contact Phone</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="Email">Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control form-control-md override-input"  placeholder="you@example.com" data="req" data-key="Email">
                                                    <div id="val-Email-error" class="invalid-feedback animated fadeInDown">Please provide a Contact Email</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="Password">Password <span class="text-danger">*</span></label>
                                                    <div class="password-input-wrapper" style="position: relative;">
                                                        <input type="password" class="form-control form-control-md override-input" placeholder="******" data="req" data-key="Password" style="padding-right: 40px;">
                                                        <button type="button" class="password-toggle-btn" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 5px; color: #6c757d;">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <div id="val-Password-error" class="invalid-feedback animated fadeInDown">Please provide a Password</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="ConfirmPassword">Confirm Password <span class="text-danger">*</span></label>
                                                    <div class="password-input-wrapper" style="position: relative;">
                                                        <input type="password" class="form-control form-control-md override-input" placeholder="******" data="req" data-key="ConfirmPassword" style="padding-right: 40px;">
                                                        <button type="button" class="password-toggle-btn" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; padding: 5px; color: #6c757d;">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                    <div id="val-ConfirmPassword-error" class="invalid-feedback animated fadeInDown">Please provide a Confirm Password</div>
                                                </div>
                                            </div>
                                        </div>      
                                        
                                        <button class="btn btn-outline-info btn-block btn-flat" data-trigger="sign-up-submit-technician">Sign Up</button>
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