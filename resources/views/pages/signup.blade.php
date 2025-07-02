
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('images/logo2.jpg') }}" type="image/x-icon">
  <title>ACRTFM | Registration</title>

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
            <p class="login-box-msg">Register a new membership</p>
            <form action="/execute/client/register" method="POST">		
                @csrf
                @error('error_msg')
                    <p class="text-danger">
                        {{$message}}
                    </p>    
                @enderror
				<div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Firstname" name="fname" value="{{ old('fname') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
				<div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Lastname" name="lname" value="{{ old('lname') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
				<div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Contact: (+1) ---- --- --" name="contact" value="{{ old('contact') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Company Name" name="company" value="{{ old('company') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
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
				
                <div class="row">
					<div class="col-12">
					  	<div class="icheck-primary">
							<label for="remember">
								<input type="checkbox" id="chkHvac">
								I am a HVAC professional.
							</label>
					  	</div>
					</div>

                    <div class="col-12">
                        <div class="icheck-primary">
                          <label for="remember">
                              <input type="checkbox" id="chkTnc">
                              Agree to <a href="#" data-toggle="modal" data-target="#modal-tnc">Terms and Conditions</a>
                          </label>
                        </div>
                  </div>
				</div>
				<div class="row mt-2 mb-2">
					<div class="col-12">
						<button type="submit" class="btn btn-primary btn-block" id="btn-register" disabled>Register</button>
					</div>
				</div>
            </form>
			<p class="mb-0">
				<a href="/" class="text-center">Go to Login</a>
			</p>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-tnc" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Terms and Conditions</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body modal-tnc-body">
            <p>Terms of Use</p>

            <ol>
                <li>
                    <p>Introduction</p>
                    <p>Welcome to ACRTFM.COM, an information website providing general information and guidance on HVAC-related topics. By accessing and using our website, you agree to be bound by these Terms of Use, which may be updated from time to time.</p>
                </li>

                <li>
                    <p>Disclaimer of Liability</p>
                    <p>The information provided on this website is for general purposes only and is not intended to be taken as professional advice. We do not guarantee the accuracy, completeness, or reliability of the information. We disclaim all liability for any damages or losses arising from the use of our website, including but not limited to:</p>
                    <p> - Any reliance on the information provided</p>
                    <p> - Any errors, omissions, or inaccuracies</p>
                    <p> - Any damages resulting from the use of our website</p>
                </li>

                <li>
                    <p>User Responsibility</p>
                    <p>You, the user, are solely responsible for:</p>

                    <p>- Verifying the accuracy of the information provided</p>
                    <p>- Following the instructions and guidelines of the manufacturer or relevant authorities</p>
                    <p>- Using the information in a safe and responsible manner</p>
                </li>

                <li>
                    <p>Eligibility to Use the Website</p>
                    <p> To use our website, you must be a trained HVAC professional. By using our website, and/or any program or application related to our website, you represent and warrant that you have the necessary training, qualifications, and expertise to use the information and resources provided.</p>
                </li>

                <li>
                    <p>Assumption of Risk</p>
                    <p>By using our website, and/or any program or application related to our website, you take full responsibility for your actions and assume all risk associated with the use of our website. You agree to hold harmless ACRTFM.COM, its officers, directors, employees, agents, and affiliates from any claims, damages, or losses arising from your use of our website.</p>
                </li>

                <li>
                    <p>Third-Party Information</p>
                    <p>Our website may contain information from third-party sources, including but not limited to manufacturers, suppliers, and other websites. We do not endorse or guarantee the accuracy of this information.</p>
                </li>

                <li>
                    <p>Intellectual Property </p>
                    <p>The content on our website, including but not limited to text, images, and graphics, is protected by copyright and intellectual property laws. You may not reproduce, modify, or distribute our content without our prior written consent.</p>
                </li>

                <li>
                    <p>Governing Law</p>
                    <p>These Terms of Use shall be governed by and construed in accordance with the laws of the United States of America. Any disputes arising from the use of our website shall be resolved through binding arbitration.</p>
                </li>

                <li>
                    <p>Changes to Terms of Use </p>
                    <p>We reserve the right to update these Terms of Use from time to time. Your continued use of our website constitutes acceptance of any changes.</p>

                    <br />
                    <p>By using our website, you acknowledge that you have read, understood, and agree to be bound by these Terms of Use.</p>
                </li>
            </ol>            
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<script src="{{ asset('adminlte3.2/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte3.2/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('adminlte3.2/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('adminlte3.2/dist/js/adminlte.js') }}"></script>

<script src="{{ asset('scripts/registration.js') }}"></script>

</body>
</html>
