<nav class="floating-nav d-none d-xl-flex">
    <a href="{{ route('login') }}" class="nav-item {{ request()->routeIs('login') ? 'active' : '' }}">
        <i class="fas fa-user"></i> Sign In
    </a>

    <a href="{{ route('/') }}" class="nav-item {{ request()->routeIs('/') ? 'active' : '' }}">
        <i class="fas fa-user-plus"></i> Register
    </a>

    <a href="{{ route('password.request') }}" class="nav-item {{ request()->routeIs('password.request') ? 'active' : '' }}">
        <i class="fas fa-question-circle"></i> Forgot Password
    </a>

    {{-- <a href="{{ route('payment') }}" class="nav-item btn-payment"> --}}
    <a href="" class="nav-item btn-payment">
        <i class="fas fa-dollar-sign"></i> Payment
    </a>
</nav>
