<!-- Favicon icon -->
<link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
<!-- Preload critical icon font -->
<link rel="preload" href="{{ asset('adminend/icon/feather/fonts/feather.woff') }}" as="font" type="font/woff" crossorigin>

<!-- Google font-->
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800&display=swap" rel="stylesheet">

<!-- Required Fremwork -->
<link rel="stylesheet" type="text/css" href="{{ asset('adminend/bower_components/bootstrap/css/bootstrap.min.css') }}">
<!-- themify-icons line icon -->
<link rel="stylesheet" type="text/css" href="{{ asset('adminend/icon/themify-icons/themify-icons.css') }}">
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="{{ asset('adminend/icon/icofont/css/icofont.css') }}">
<!-- feather Awesome -->
<link rel="stylesheet" type="text/css" href="{{ asset('adminend/icon/feather/css/feather.css') }}">
<!-- Syntax highlighter Prism css -->
<link rel="stylesheet" type="text/css" href="{{ asset('adminend/pages/prism/prism.css') }}">
<!-- Style.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('adminend/css/style.css') }}">

<link rel="stylesheet" type="text/css" href="{{ asset('adminend/css/jquery.mCustomScrollbar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('adminend/css/pcoded-horizontal.min.css') }}">

@stack('styles')