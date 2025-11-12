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
                                <p class="text-center text-muted">Sign up for a new company account</p>
                                    <form class="mt-5 mb-5 login-input">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="CompanyName">Company Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-md override-input"  placeholder="ABC Company" data="req" data-key="CompanyName">
                                                    <div id="val-CompanyName-error" class="invalid-feedback animated fadeInDown">Please provide a Company Name</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="CompanyAddress">Company Address </label>
                                                    <input type="text" class="form-control form-control-md override-input"  placeholder="Company Address" data-key="CompanyAddress">
                                                    <div id="val-CompanyAddress-error" class="invalid-feedback animated fadeInDown">Please provide a Company Address</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="ContactPerson">Contact Person <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-md override-input"  placeholder="John Doe" data="req" data-key="ContactPerson">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="Contact">Contact Phone<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-md override-input"  placeholder="" data="req" data-key="Contact">
                                                    <div id="val-ContactPhone-error" class="invalid-feedback animated fadeInDown">Please provide a Contact Phone</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="Email">Contact Email <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control form-control-md override-input"  placeholder="you@example.com" data="req" data-key="Email">
                                                    <div id="val-ContactEmail-error" class="invalid-feedback animated fadeInDown">Please provide a Contact Email</div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="Password">Password <span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control form-control-md override-input" placeholder="******" data="req" data-key="Password">
                                                    <div id="val-Password-error" class="invalid-feedback animated fadeInDown">Please provide a Password</div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="ConfirmPassword">Confirm Password <span class="text-danger">*</span></label>
                                                    <input type="password" class="form-control form-control-md override-input" placeholder="******" data="req" data-key="ConfirmPassword">
                                                    <div id="val-ConfirmPassword-error" class="invalid-feedback animated fadeInDown">Please provide a Confirm Password</div>
                                                </div>
                                            </div>
                                        </div>      
                                        
                                        <button class="btn btn-outline-info btn-block btn-flat" data-trigger="sign-up-submit-company">Sign Up</button>
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