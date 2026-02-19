<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection('title')
            @yield('title') | {{ $settings['app_name'] }}
        @else
            {{ $settings['app_name'] }}
        @endif
    </title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('adminend/bower_components/bootstrap/css/bootstrap.min.css') }}">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    {{-- App Styles --}}
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
    <link rel="stylesheet" href="{{ asset('adminend/bower_components/animate.css/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userend_custom_style.css') }}">

    @stack('styles')
</head>

<body>

    {{-- Background --}}
    @include('partials.auth._background')

    {{-- Desktop Nav --}}
    @include('partials.auth._floating-nav')

    {{-- Mobile Nav --}}
    @include('partials.auth._mobile-nav')

    {{-- Page Content --}}
    <main class="container-fluid">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.auth._footer')


    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"
        integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/notification.js') }}"></script>
    <script src="{{ asset('js/bootstrap-growl.min.js') }}"></script>
    <script src="{{ asset('js/userend_custom.js') }}"></script>

    @stack('scripts')
    {{-- Flash messages --}}
    @include('partials._flash')
</body>

</html>
