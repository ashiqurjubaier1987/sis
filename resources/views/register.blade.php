<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Vertical Horizon</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/adminend/bower_components/bootstrap/css/bootstrap.min.css') }}">
    <!-- Google Fonts - Inter (for a modern look) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Notification.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/notification.css') }}">
    <!-- Animate.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/adminend/bower_components/animate.css/css/animate.css') }}">
    <!-- Userend_custom_style.css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/userend_custom_style.css') }}">
</head>
<body>

    <!-- Background Animated Shapes -->
    <div class="bg-shape bg-shape-1"></div>
    <div class="bg-shape bg-shape-2"></div>
    <div class="bg-shape bg-shape-3"></div>
    <div class="bg-shape bg-shape-4"></div>
    <div class="bg-shape bg-shape-5"></div>
    <!-- Floating Navigation on Right Side (Desktop) -->
    <nav class="floating-nav d-none d-xl-flex">
        <a href="{{ url('auth/login') }}" id="navSignIn" class="nav-item " role="button">
            <i class="fas fa-user"></i> Sign In
        </a>
        <a href="{{ url('') }}" id="navRegister" class="nav-item active" role="button">
            <i class="fas fa-user-plus"></i> Register
        </a>
        <a href="{{ url('auth/forgot_password') }}" id="navForgotPassword" class="nav-item " role="button">
            <i class="fas fa-question-circle"></i> Forgot Password
        </a>
        <a href="{{ url('online_payment') }}" class="nav-item btn-payment" role="link">
            <i class="fas fa-dollar-sign"></i> Payment
        </a>
    </nav>

    <!-- Mobile Navigation Toggle Button (Bottom Right) -->
    <button class="mobile-toggle-btn d-xl-none" id="mobileToggleBtn" aria-label="Toggle Navigation">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Mobile Navigation Overlay -->
    <div class="mobile-nav-overlay" id="mobileNavOverlay">
        <a href="{{ url('auth/login') }}" id="mobileNavSignIn" class="nav-link-item" role="button">Sign In</a>
        <a href="{{ url('') }}" id="mobileNavRegister" class="nav-link-item" role="button">Register</a>
        <a href="{{ url('auth/forgot_password') }}" id="mobileNavForgotPassword" class="nav-link-item" role="button">Forgot Password</a>
        <a href="{{ url('online_payment') }}" class="nav-link-item" role="link">Payment</a>
    </div>   <!-- Register Page Section -->
    <section id="registerPage" class="page-section" tabindex="-1" aria-hidden="false" role="region" aria-label="Register Page">
        <div class="auth-card" id="register-card">
            <img src="{{ asset('assets/img/vh.jpg') }}" alt="Student Hub Logo" class="logo-small">
            <h2 class="mb-3">Join Vertical Horizon!</h2>
            <p class="subtitle">Create your account and unlock a world of learning opportunities.</p>
            

            <!-- Registration Video Link -->
            <div class="video-link-container mb-4">
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" rel="noopener noreferrer" aria-label="Watch registration tutorial video">
                    <i class="fas fa-play-circle"></i> Watch Registration Tutorial
                </a>
            </div>

            <!-- <form id="registrationForm"> -->
            <form action="{{ url('student_registration/process_registration') }}" method="post" accept-charset="utf-8" id="registrationForm" enctype="multipart/form-data">
                @csrf
                <!-- Progress Steps Indicator -->
                <div class="progress-steps-container">
                    <div class="progress-step-item active" data-step="0">
                        <span class="progress-step-number">1</span>
                        <span class="progress-step-text">Account</span>
                    </div>
                    <div class="progress-step-item" data-step="1">
                        <span class="progress-step-number">2</span>
                        <span class="progress-step-text">Personal</span>
                    </div>
                    <div class="progress-step-item" data-step="2">
                        <span class="progress-step-number">3</span>
                        <span class="progress-step-text">Parents</span>
                    </div>
                </div>

                <!-- Step 1: Account Details (Email, Password) -->
                <div class="form-step active" id="step1" role="tabpanel" aria-labelledby="dot1">
                    <h3 class="h5 mb-4 text-start text-dark">Step 1: Account Details</h3>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="registerEmail" class="form-label">Email Address</label>
                            <input type="email" name="email" id="registerEmail" class="form-control" placeholder="your@example.com" required autocomplete="email" aria-describedby="registerEmailFeedback">
                            <div id="registerEmailFeedback" class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="mobileNo" class="form-label">Mobile Number</label>
                            <input type="tel" name="mob_number" id="mobileNo" class="form-control" placeholder="8801711109999" required autocomplete="tel" aria-describedby="mobileNoFeedback">
                            <div id="mobileNoFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="mb-4 text-start">
                        <label for="registerPassword" class="form-label">Password</label>
                        <input type="password" name="password" id="registerPassword" class="form-control" placeholder="••••••••" required autocomplete="new-password" aria-describedby="registerPasswordFeedback">
                        <div id="registerPasswordFeedback" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-4 text-start">
                        <label for="registerConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirm" id="registerConfirmPassword" class="form-control" placeholder="••••••••" required autocomplete="new-password" aria-describedby="registerConfirmPasswordFeedback">
                        <div id="registerConfirmPasswordFeedback" class="invalid-feedback"></div>
                    </div>
                    <div class="d-grid">
                        <button type="button" class="btn btn-primary" id="nextStep1">Next <i class="fas fa-arrow-right ms-2"></i></button>
                    </div>
                </div>

                <!-- Step 2: Personal Details -->
                <div class="form-step" id="step2" role="tabpanel" aria-labelledby="dot2">
                    <h3 class="h5 mb-4 text-start text-dark">Step 2: Personal Details</h3>
                    <div class="row g-3 mb-4"> <!-- Use row and g-3 for gutter -->
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" name="first_name" id="firstName" class="form-control" placeholder="John" required autocomplete="given-name" aria-describedby="firstNameFeedback">
                            <div id="firstNameFeedback" class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" name="last_name" id="lastName" class="form-control" placeholder="Doe" required autocomplete="family-name" aria-describedby="lastNameFeedback">
                            <div id="lastNameFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <!-- <div class="col-md-6">
                            <label for="mobileNo" class="form-label">Mobile Number</label>
                            <input type="tel" name="mob_number" id="mobileNo" class="form-control" placeholder="8801711109999" required autocomplete="tel" aria-describedby="mobileNoFeedback">
                            <div id="mobileNoFeedback" class="invalid-feedback"></div>
                        </div> -->
                        <div class="col-md-6">
                            <label for="passportNo" class="form-label">Passport Number</label>
                            <input type="text" name="passport_number" id="passportNo" class="form-control" placeholder="e.g., G1234567" autocomplete="off" required aria-describedby="passportNoFeedback">
                            <div id="passportNoFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label d-block">Sex</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sex" id="sexMale" value="male" aria-describedby="sexFeedback">
                                <label class="form-check-label" for="sexMale">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sex" id="sexFemale" value="female" aria-describedby="sexFeedback">
                                <label class="form-check-label" for="sexFemale">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sex" id="sexOther" value="other" aria-describedby="sexFeedback">
                                <label class="form-check-label" for="sexOther">Other</label>
                            </div>
                            <div id="sexFeedback" class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" name="dob" id="dob" class="form-control" required autocomplete="bday" aria-describedby="dobFeedback">
                            <div id="dobFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="mb-4 text-start">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control" placeholder="123 Main St, City, Country" rows="3" required autocomplete="street-address" aria-describedby="addressFeedback"></textarea>
                        <div id="addressFeedback" class="invalid-feedback"></div>
                    </div>
                    <div class="mb-4 text-start">
                        <label for="school" class="form-label">School Name (Optional)</label>
                        <input type="text" name="school" id="school" class="form-control" placeholder="ABC High School" autocomplete="organization" aria-describedby="schoolFeedback">
                        <div id="schoolFeedback" class="invalid-feedback"></div>
                    </div>
                    <div class="row g-3 mb-4">
                        
                        <div class="col-md-6">
                            <label for="bloodGroup" class="form-label">Blood Group (Optional)</label>
                            <select name="bloog_group" id="bloodGroup" class="form-select form-control" aria-describedby="bloodGroupFeedback">
                                <option value="">Select Blood Group</option>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                            <div id="bloodGroupFeedback" class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="photoUpload" class="form-label">Upload Photo (Optional)</label>
                            <input type="file" name="photo" id="photoUpload" class="form-control" accept="image/*" aria-describedby="photoUploadFeedback">
                            <div id="photoUploadFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between gap-3">
                        <button type="button" class="btn btn-outline-secondary w-50" id="prevStep2"><i class="fas fa-arrow-left me-2"></i> Previous</button>
                        <button type="button" class="btn btn-primary w-50" id="nextStep2">Next <i class="fas fa-arrow-right ms-2"></i></button>
                    </div>
                </div>

                <!-- Step 3: Parents Details -->
                <div class="form-step" id="step3" role="tabpanel" aria-labelledby="dot3">
                    <h3 class="h5 mb-4 text-start text-dark">Step 3: Parents Details</h3>
                    <!-- <h4 class="h6 mb-3 text-start text-dark">Father's Information</h4> -->
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="fatherName" class="form-label">Father's Full Name</label>
                            <input type="text" name="father_name" id="fatherName" class="form-control" placeholder="Father's Name" required autocomplete="name" aria-describedby="fatherNameFeedback">
                            <div id="fatherNameFeedback" class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="fatherMobile" class="form-label">Father's Mobile Number</label>
                            <input type="tel" name="father_contact" id="fatherMobile" class="form-control" placeholder="+1 (555) 987-6543" required autocomplete="tel" aria-describedby="fatherMobileFeedback">
                            <div id="fatherMobileFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="mb-4 text-start">
                        <label for="fatherEmail" class="form-label">Father's Email Address (Optional)</label>
                        <input type="email" name="father_email" id="fatherEmail" class="form-control" placeholder="father@example.com" autocomplete="email" aria-describedby="fatherEmailFeedback">
                        <div id="fatherEmailFeedback" class="invalid-feedback"></div>
                    </div>

                    <!-- <h4 class="h6 mb-3 text-start text-dark mt-5">Mother's Information</h4> -->
                    <br>
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="motherName" class="form-label">Mother's Full Name</label>
                            <input type="text" name="mother_name" id="motherName" class="form-control" placeholder="Mother's Name" required autocomplete="name" aria-describedby="motherNameFeedback">
                            <div id="motherNameFeedback" class="invalid-feedback"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="motherMobile" class="form-label">Mother's Mobile Number</label>
                            <input type="tel" name="mother_contact" id="motherMobile" class="form-control" placeholder="+1 (555) 111-2222" required autocomplete="tel" aria-describedby="motherMobileFeedback">
                            <div id="motherMobileFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="mb-4 text-start">
                        <label for="motherEmail" class="form-label">Mother's Email Address (Optional)</label>
                        <input type="email" name="mother_email" id="motherEmail" class="form-control" placeholder="mother@example.com" autocomplete="email" aria-describedby="motherEmailFeedback">
                        <div id="motherEmailFeedback" class="invalid-feedback"></div>
                    </div>
                    <div class="d-flex justify-content-between gap-3" id="registrationButtonsContainer">
                        <button type="button" class="btn btn-outline-secondary w-50" id="prevStep3"><i class="fas fa-arrow-left me-2"></i> Previous</button>
                        <button type="submit" class="btn btn-primary w-50" id="submitRegistration">Complete Registration<i class="fas fa-check ms-2"></i></button>
                    </div>
                    <!-- New block for existing email message -->
                    <div id="existingEmailMessage" class="mt-4 p-3 bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-3" style="display: none;">
                        <p class="mb-2 fw-bold"><i class="fas fa-exclamation-triangle me-2"></i> This email is already registered!</p>
                        <p class="mb-3">Your details have been pre-filled. Please sign in or reset your password if you've forgotten it.</p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ url('auth/login') }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-user me-2"></i> Sign In</a>
                            <a href="{{ url('auth/forgot_password') }}" class="btn btn-outline-info btn-sm"><i class="fas fa-question-circle me-2"></i> Forgot Password</a>
                        </div>
                    </div>
                </div>
            </form>
            <p class="text-center text-muted mt-4">
                Already have an account? <a href="{{ url('auth/login') }}" id="linkToSignInFromRegister" class="link-text" role="button">Sign In here</a>
            </p>
        </div>
    </section>
        <p class="text-center text-muted mt-4">
        Powered By <a href="https://nastechbd.com/" target="_blank" id="linkToSignInFromRegister" class="link-text" role="button">NASTech Business Solution</a>
    </p>
    
    <!-- Bootstrap JS CDN (Bundle includes Popper) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

    <script type="text/javascript" src="{{ asset('assets/js/notification.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap-growl.min.js') }}"></script>

    

</body>
</html>    
<script>
      const BASE_URL = "{{ url('/') }}";
      const SITE_URL = "{{ url('index.php') }}";
    </script>
    <script src="{{ asset('assets/js/student_registration.js') }}"></script>