@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <!-- Forgot Password Page Section -->
    <section id="forgotPasswordPage" class="page-section" tabindex="-1" aria-hidden="false" role="region"
        aria-label="Forgot Password Page">
        <div class="auth-card" id="forgotpassword-card">
            <img src="{{ asset('storage/' . \App\Support\Settings::get('app_logo')) }}" alt="Student Hub Logo"
                class="logo-small">
            <h2 class="mb-3">Reset Password?</h2>
            <p class="subtitle">Enter New Password</p>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="mb-4 text-start">
                    <input type="password" name="password" id="password" class="form-control"
                        placeholder="Password" required autocomplete="login"
                        aria-describedby="resetPasswordFeedback">
                    <div id="resetPasswordFeedback" class="invalid-feedback"></div>
                </div>

                <div class="mb-4 text-start">
                    <input type="password" name="password_confirmation" id="confirmPassword" class="form-control"
                        placeholder="Confirm Password" required autocomplete="login"
                        aria-describedby="confirmPasswordFeedback">
                    <div id="confirmPasswordFeedback" class="invalid-feedback"></div>
                </div>

                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-primary" id="resetPasswordSubmitBtn">Reset Password</button>
                </div>
            </form>
            <p class="text-center text-muted mb-4">
                Remembered your password? <a href="{{ route('login') }}" id="linkToSignInFromForgot" class="link-text"
                    role="button">Sign In here</a>
            </p>
        </div>
    </section>
@endsection

{{-- @push('scripts')
    <!-- <script src="{{ asset('js/auth.js') }}"></script> -->
@endpush --}}
