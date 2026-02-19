@extends('layouts.auth')

@section('title', 'Register')

@section('content')
    <section id="registerPage" class="page-section" tabindex="-1" aria-hidden="false" role="region" aria-label="Register Page">
        <div class="auth-card" id="register-card" role="form" aria-labelledby="registrationCardTitle">

            <img src="{{ asset('storage/' . \App\Support\Settings::get('app_logo')) }}" alt="Student Hub Logo"
                class="logo-small">

            <h2 class="mb-3">Join Vertical Horizon!</h2>
            <p class="subtitle">Create your account and unlock a world of learning opportunities.</p>



            {{-- Duplicate account message --}}
            @if (session('auth_error'))
                <div class="alert alert-danger">
                    {{ session('auth_error') }}
                    <div class="mt-2">
                        <a href="{{ route('login') }}">Sign In</a> |
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>
                </div>
            @endif

            <!-- Registration Video Link (kept) -->
            <div class="video-link-container mb-4">
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target="_blank" rel="noopener noreferrer">
                    <i class="fas fa-play-circle"></i> Watch Registration Tutorial
                </a>
            </div>

            <form method="POST" action="{{ route('student.register') }}" id="registrationForm">
                @csrf

                <!--Account Details (Email, Password, Mobile, Photo ID) -->
                <div class="form-step active" id="step1" role="tabpanel" aria-labelledby="dot1">
                    <div class="row g-3 mb-4">
                        {{-- EMAIL --}}
                        <div class="col-md-6">
                            <label for="registerEmail" class="form-label visually-hidden">Email</label>
                            <input type="email" name="email" id="registerEmail" value="{{ old('email') }}"
                                class="form-control @error('email') is-invalid @enderror" autocomplete="email"
                                placeholder="Email" required aria-describedby="registerEmailFeedback">
                            <div id="registerEmailFeedback" class="invalid-feedback">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        {{-- MOBILE NUMBER --}}
                        <div class="col-md-6">
                            <label for="registerPhone" class="form-label visually-hidden">Mobile Number</label>
                            <input type="tel" name="phone" id="registerPhone" value="{{ old('phone') }}"
                                class="form-control @error('phone') is-invalid @enderror" autocomplete="tel"
                                placeholder="Mobile Number" required aria-describedby="registerPhoneFeedback">
                            <div id="registerPhoneFeedback" class="invalid-feedback">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        {{-- PHOTO ID NUMBER --}}
                        <div class="col-md-12">
                            <label for="photoIdNumber" class="form-label visually-hidden">Photo ID Number</label>
                            <input type="text" name="photo_id_number" id="photoIdNumber"
                                value="{{ old('photo_id_number') }}"
                                class="form-control @error('photo_id_number') is-invalid @enderror" autocomplete="off"
                                placeholder="Photo ID Number" required aria-describedby="photoIdNumberFeedback">
                            <div id="photoIdNumberFeedback" class="invalid-feedback">
                                @error('photo_id_number')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        {{-- PASSWORD --}}
                        <div class=" col-md-6 mb-3">
                            <label for="registerPassword" class="visually-hidden">Password</label>
                            <div class="position-relative">
                                <input type="password" name="password" id="registerPassword" class="form-control pe-5"
                                    autocomplete="new-password" placeholder="Password" required
                                    aria-describedby="registerPasswordFeedback">

                                <span class="toggle-password position-absolute end-0 top-50 translate-middle-y me-3"
                                    data-target="registerPassword" style="cursor: pointer;" aria-label="Show password">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                            <div id="registerPasswordFeedback" class="invalid-feedback"></div>
                        </div>

                        {{-- CONFIRM PASSWORD --}}
                        <div class="col-md-6 mb-4">
                            <label for="registerConfirmPassword" class="visually-hidden">Confirm Password</label>
                            <div class="position-relative">
                                <input type="password" name="password_confirmation" id="registerConfirmPassword"
                                    class="form-control pe-5" autocomplete="new-password" placeholder="Confirm Password"
                                    required aria-describedby="registerConfirmPasswordFeedback">

                                <span class="toggle-password position-absolute end-0 top-50 translate-middle-y me-3"
                                    data-target="registerConfirmPassword" style="cursor:pointer;"
                                    aria-label="Show password">
                                    <i class="fa fa-eye"></i>
                                </span>
                            </div>
                            <div id="registerConfirmPasswordFeedback" class="invalid-feedback"></div>
                        </div>
                    </div>
                    @if ($enable_otp_registration === 'true')
                        {{-- OTP VERIFICATION SECTION --}}
                        <div id="otpSection" class="mt-4" style="display: none;">
                            <div class="row g-3 mb-3">
                                <div class="col-md-8">
                                    <input type="text" id="otp" class="form-control" placeholder="Enter OTP"
                                        autocomplete="one-time-code">
                                </div>

                                <div class="col-md-4 d-grid">
                                    <button type="button" class="btn btn-success" id="verifyOtpBtn">
                                        Verify OTP
                                    </button>
                                    <div class="justify-content-center align-items-center border border-success text-success rounded"
                                        id="otpSuccessMsg" style="display: none">✅ Phone number verified</div>
                                </div>
                            </div>

                            <div class="text-center">
                                <div id="timerResendBtn" class="text-muted small" style="display:none;">
                                    Resend OTP in <span id="resendCounter">60</span>s
                                </div>
                                <button type="button" class="btn btn-primary w-50" id="resendOtpBtn"
                                    style="display: none;">
                                    Resend OTP
                                </button>
                            </div>


                            {{-- <div class="text-success mt-2 text-center" id="otpSuccessMsg" style="display:none;">
                            ✅ Phone number verified
                        </div> --}}
                        </div>
                    @endif



                    <div class="d-grid">
                        {{-- <button type="submit" class="btn btn-primary w-100">
                            <span class="visually-hidden">Create Account</span>Create Account
                        </button> --}}
                        @if ($enable_otp_registration === 'false')
                            <button type="submit" class="btn btn-primary w-100 mt-3" id="finalRegisterBtn">
                                Create Account
                            </button>
                        @else
                            <button type="button" class="btn btn-primary w-100" id="sendOtpBtn" style="display: block">
                                Send OTP
                            </button>
                            <button type="submit" class="btn btn-primary w-100 mt-3" id="finalRegisterBtn" disabled
                                style="display: none;">
                                Create Account
                            </button>
                        @endif
                    </div>

                    <!-- New block for existing email/phone/photoId message -->
                    <div id="existingAccountMessage"
                        class="mt-4 p-3 bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-3"
                        style="display: none;">
                        <p class="mb-2 fw-bold">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            This account is already registered!
                        </p>
                        <p class="mb-3">
                            Please sign in or reset your password.
                        </p>
                        <div class="d-flex justify-content-center gap-3">
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-user me-2"></i> Sign In
                            </a>
                            <a href="{{ route('password.request') }}" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-question-circle me-2"></i> Forgot Password
                            </a>
                        </div>
                    </div>

                </div>
            </form>

            <p class="text-center text-muted mt-4">
                Already have an account?
                <a href="{{ route('login') }}" class="link-text">Sign In here</a>
            </p>

        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
@endpush
