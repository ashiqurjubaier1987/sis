@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    @php
        if ($mode === 'email') {
            $placeHolder = 'Email';
        } elseif ($mode === 'phone') {
            $placeHolder = 'Phone(8801XXXX....)';
        } else {
            $placeHolder = 'Email or Phone(8801XXXX....)';
        }
    @endphp
    <!-- Forgot Password Page Section -->
    <section id="forgotPasswordPage" class="page-section" tabindex="-1" aria-hidden="false" role="region"
        aria-label="Forgot Password Page">
        <div class="auth-card" id="forgotpassword-card">
            <img src="{{ asset('storage/' . \App\Support\Settings::get('app_logo')) }}" alt="Student Hub Logo"
                class="logo-small">
            <h2 class="mb-3">Forgot Password?</h2>
            <p class="subtitle">No worries! Enter your email/phone below and we'll send you a reset link.<br/> To your registered Email.</p>
            @if(session('success'))
                <div class="alert alert-success"><p>{{ session('success') }}</p></div>
            @endif
            <form method="POST" action="{{ route('password.process') }}" id="forgotPasswordForm">
                @csrf
                <div class="mb-4 text-start">
                    {{-- <label for="forgotLogin" class="form-label">login Address</label> --}}
                    <input type="text" name="login" id="forgotLogin" class="form-control"
                        placeholder="{{ $placeHolder }}" required autocomplete="login"
                        aria-describedby="forgotLoginFeedback">
                    <div id="forgotLoginFeedback" class="invalid-feedback"></div>
                </div>
                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-primary" id="forgotPasswordSubmitBtn">Reset Password</button>
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
