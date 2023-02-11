<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{!! isset($metaseo['meta_title']) ? $metaseo['meta_title'] : 'Aplus Device' !!}</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="{{ isset($metaseo['meta_description']) ? $metaseo['meta_description'] : '' }}">
    <meta name="keywords" content="{{ isset($metaseo['meta_keywords']) ? $metaseo['meta_keywords'] : '' }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('static/images/favicon.png')}}">
    <!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script type="text/javascript">
        (function e(){var e=document.createElement("script");e.type="text/javascript",e.async=true,e.src="//staticw2.yotpo.com/JBg3AgDdCuMqsalawmNHyo2tGOiPsu6CR8d2y9pt/widget.js";var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)})();
    </script>

    <meta name="keywords" content="{{ isset($metaseo['og_title']) ? $metaseo['og_title'] : '' }}">
    <meta name="og_description" content="{{ isset($metaseo['og_description']) ? $metaseo['og_description'] : '' }}">
    <meta name="og_image" content="{{ isset($metaseo['og_image']) ? asset($metaseo['og_image']) : '' }}">

    <!-- Font CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Work+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Vendor CSS (Bootstrap & Icon Font) -->
    <link rel="stylesheet" href="{{asset('static/css/bootstrap.min.css')}}">

    <!-- Plugins CSS (All Plugins Files) -->
    <link rel="stylesheet" href="{{asset('static/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('static/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('static/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('static/css/fancybox.min.css')}}">
    <link rel="stylesheet" href="{{asset('static/css/nice-select.css')}}">
    <!--<link rel="stylesheet" href="{{asset('static/css/range-slider.css')}}">-->

    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('static/css/style.css')}}">

    <link rel="stylesheet" href="{{asset('static/css/floating-wp.css')}}">
    <!--Floating WhatsApp javascript-->
    <script type="text/javascript" src="{{asset('static/js/floating-wp.js')}}"></script>
    <script>
        $(function() {
            $('#WAButton').floatingWhatsApp({
                phone: '918582819999', //WhatsApp Business phone number International format-
                //Get it with Toky at https://toky.co/en/features/whatsapp.
                headerTitle: 'Chat with us on WhatsApp!', //Popup Title
                popupMessage: 'Hello, how can we help you?', //Popup Message
                showPopup: true, //Enables popup display
                buttonImage: '<img src="{{asset('static/images/home/wp-icon.svg')}}" />', //Button Image
                //headerColor: 'crimson', //Custom header color
                //backgroundColor: 'crimson', //Custom background button color
                position: 'right',
                zIndex: '2000',
                size: '50px',
            });
        });
    </script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-185918049-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-185918049-1');
    </script>
    <!-- Meta Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '920370622702485');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=920370622702485&ev=PageView&noscript=1"
        /></noscript>
    <!-- End Meta Pixel Code -->

</head>
<body>
<div id="WAButton"></div>
<!--== Wrapper Start ==-->
<div class="wrapper @if(isset($is_home) == true) home-six-wrapper @else home-six-wrapper @endif">

    @include('frontend.common.header')

    @yield('content')

    @include('frontend.common.footer')

    @include('frontend.common.mobilesearch')

    @include('frontend.common.mobilesidebar')

</div>
<!--== Wrapper End ==-->

<!-- Vendors JS -->
<script src="{{asset('static/js/modernizr-3.11.7.min.js')}}"></script>
<!--<script src="{{asset('static/js/jquery-3.6.0.min.js')}}"></script>-->
<script src="{{asset('static/js/jquery-migrate-3.3.2.min.js')}}"></script>
<script src="{{asset('static/js/bootstrap.bundle.min.js')}}"></script>

<!-- Plugins JS -->
<script src="{{asset('static/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('static/js/fancybox.min.js')}}"></script>
<script src="{{asset('static/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('static/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('static/js/isotope.pkgd.min.js')}}"></script>
<!--<script src="{{asset('static/js/range-slider.js')}}"></script>-->
@if(isset($is_disableMainJs) == true)
    {{null}}
@else
<!-- Custom Main JS -->
<script src="{{asset('static/js/main.js')}}"></script>
@endif

</body>
</html>
