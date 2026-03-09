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

<link rel="stylesheet" type="text/css" href="{{ asset('adminend/css/jquery.mCustomScrollbar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('adminend/css/pcoded-horizontal.min.css') }}">

<!-- Switch component css -->
<link rel="stylesheet" type="text/css" href="{{ asset('adminend/bower_components/switchery/css/switchery.min.css') }}">

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('adminend/bower_components/select2/css/select2.min.css') }}">
<!-- Sweet Alert -->
<link rel="stylesheet" type="text/css" href="{{ asset('adminend/bower_components/sweetalert/css/sweetalert.css') }}">
<!-- Custom Style.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('adminend/css/style.css') }}">
<!-- sis-helper.css -->
<link rel="stylesheet" type="text/css" href="{{ asset('adminend/css/sis-helper.css') }}">


@stack('styles')