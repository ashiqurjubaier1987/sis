{{-- <button class="mobile-toggle-btn d-xl-none" id="mobileToggleBtn">
    <i class="fas fa-bars"></i>
</button> --}}
<!-- Mobile Navigation Toggle Button (Bottom Right) -->
<button class="mobile-toggle-btn d-xl-none" id="mobileToggleBtn" aria-label="Toggle Navigation">
    <i class="fas fa-bars"></i>
</button>

<!-- Mobile Navigation Overlay -->
<div class="mobile-nav-overlay" id="mobileNavOverlay">
    <a href="{{ route('login') }}" id="mobileNavSignIn" class="nav-link-item" role="button">Sign In</a>
    <a href="{{ route('/') }}" id="mobileNavRegister" class="nav-link-item" role="button">Register</a>
    <a href="{{ route('password.request') }}" id="mobileNavForgotPassword" class="nav-link-item" role="button">Forgot Password</a>
    {{-- <a href="<?php echo site_url('online_payment') ?>" class="nav-link-item" role="link">Payment</a> --}}
</div>
