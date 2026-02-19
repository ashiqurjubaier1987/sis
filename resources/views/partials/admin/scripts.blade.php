<div>
    asdffds
</div>
<!-- Required Jquery -->
<script type="text/javascript" src="{{ asset('adminend/bower_components/jquery/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('adminend/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('adminend/bower_components/popper.js/js/popper.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('adminend/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- jquery slimscroll js -->
<script type="text/javascript" src="{{ asset('adminend/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}">
</script>
<!-- modernizr js -->
<script type="text/javascript" src="{{ asset('adminend/bower_components/modernizr/js/modernizr.js') }}"></script>
<script type="text/javascript" src="{{ asset('adminend/bower_components/modernizr/js/css-scrollbars.js') }}"></script>

<!-- Chart js -->
<script type="text/javascript" src="{{ asset('adminend/bower_components/chart.js/js/Chart.js') }}"></script>

<!-- Syntax highlighter prism js -->
<script type="text/javascript" src="{{ asset('adminend/pages/prism/custom-prism.js') }}"></script>
<!-- i18next.min.js -->
<script type="text/javascript" src="{{ asset('adminend/bower_components/i18next/js/i18next.min.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('adminend/bower_components/i18next-xhr-backend/js/i18nextXHRBackend.min.js') }}"></script>
<script type="text/javascript"
    src="{{ asset('adminend/bower_components/i18next-browser-languagedetector/js/i18nextBrowserLanguageDetector.min.js') }}">
</script>
<script type="text/javascript" src="{{ asset('adminend/bower_components/jquery-i18next/js/jquery-i18next.min.js') }}">
</script>

<!-- amchart js -->
<script src="{{ asset('adminend/pages/widget/amchart/amcharts.js') }}"></script>
<script src="{{ asset('adminend/pages/widget/amchart/serial.js') }}"></script>
<script src="{{ asset('adminend/pages/widget/amchart/light.js') }}"></script>

<script src="{{ asset('adminend/js/pcoded.min.js') }}"></script>
<script src="{{ asset('adminend/js/menu/menu-hori-fixed.js') }}"></script>
<script src="{{ asset('adminend/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('adminend/pages/dashboard/custom-dashboard.js') }}"></script>
<!-- Custom js -->
<script type="text/javascript" src="{{ asset('adminend/js/script.js') }}"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
@if (env('APP_ENV') === 'production')
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
@endif

<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-23581568-13');
</script>

@stack('scripts')
