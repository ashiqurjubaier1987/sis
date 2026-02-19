@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <section id="signInPage" class="page-section" tabindex="-1" aria-hidden="false" role="region" aria-label="Sign In Page">
        <div class="auth-card" id="signin-card">
            <img src="{{ asset('storage/' . \App\Support\Settings::get('app_logo')) }}" alt="Student Hub Logo"
                class="logo-small">
            <h2 class="mb-3">Welcome Back!</h2>
            <p class="subtitle">Sign in to access your personalized student dashboard and resources.</p>
            <form method="POST" action="{{ route('login') }}" id="registrationForm">
                @csrf
                <div class="mb-4 text-start">
                    {{-- <label for="signInEmail" class="form-label">Email/Mobile Address</label> --}}
                    <input type="text" name="login" id='signIn' class="form-control" placeholder="Email or Mobile Number(8801XXX....)"
                        value="{{ old('login') }}" aria-describedby="signInFeedback" required>

                    <div id="signInFeedback" class="invalid-feedback"></div>
                </div>
                <div class="mb-4 text-start">
                    <input type="password" name="password" id="signInPassword" class="form-control" placeholder="••••••••"
                        required autocomplete="current-password" aria-describedby="signInPasswordFeedback">
                    <div id="signInPasswordFeedback" class="invalid-feedback"></div>
                </div>
                <div class="d-grid mb-4">
                    <button type="submit" class="btn btn-primary" id="signInSubmitBtn">Sign In</button>
                </div>
            </form>
            <p class="text-center text-muted mb-4">
                Don't have an account? <a href="{{ route('/') }}" id="linkToRegister" class="link-text"
                    role="button">Register here</a>
            </p>
            <p class="text-center text-muted mb-4">
                <a href="{{ route('password.request') }}" id="linkToForgotPassword" class="link-text" role="button">Forgot
                    Password?</a>
            </p>
        </div>
    </section>
@endsection

{{-- @push('scripts')
    <script src="{{ asset('js/auth.js') }}"></script>
@endpush --}}
