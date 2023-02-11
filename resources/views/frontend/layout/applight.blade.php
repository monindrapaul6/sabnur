<!DOCTYPE html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{!! isset($metaseo->meta_title) ? $metaseo->meta_title : 'Aplus Device' !!}</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="{{ isset($metaseo->meta_description) ? $metaseo->meta_description : '' }}">
    <meta name="keywords" content="{{ isset($metaseo->meta_keywords) ? $metaseo->meta_keywords : '' }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('static/images/favicon.png')}}">
    <!--<script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="keywords" content="{{ isset($metaseo->og_title) ? $metaseo->og_title : '' }}">
    <meta name="og_description" content="{{ isset($metaseo->og_description) ? $metaseo->og_description : '' }}">
    <meta name="og_image" content="{{ isset($metaseo->og_image) ? asset($metaseo->og_image) : '' }}">

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
    <link rel="stylesheet" href="{{asset('static/css/range-slider.css')}}">

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
<div class="wrapper">
    <!--== Start Header Wrapper ==-->
    <header class="header-wrapper">
        <div class="header-middle d-none d-xl-block">
            <div class="container">
                <div class="row align-items-center justify-content-between align-items-center">
                    <div class="col-auto">
                        <div class="header-logo-area">
                            <a href="{{url('/')}}">
                                <img class="logo-main" src="{{asset('/static/images/aplus-logo-transparent.png')}}" width="182" height="31" alt="Aplus Device Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <form class="header-search-box header-search-box-two ms-3" action="{{url('search')}}" method="get">
                            <input class="form-control" type="text" id="search" name="q" placeholder="Search Products">
                            <div class="header-search-box-categories">
                            </div>
                            <button type="submit" class="btn-src">
                                <i class="icon-magnifier"></i>
                            </button>
                        </form>
                    </div>
                    <div class="col-auto d-flex justify-content-end align-items-center">
                        @auth
                            <a href="{{url('account')}}" class="header-action-account" style="border-right: 0">{{Auth::user()->name}} </a>
                    @else
                            <a href="{{url('login')}}" class="header-action-account">Login / SignUp</a>
                    @endauth
                            <a class="header-action-cart" href="{{url('cart')}}">
                                <i class="cart-icon icon-handbag"></i>
                                <span class="cart-count">{{App\Models\Cart::cartCount()}}</span>
                            </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-middle d-xl-none">
            <div class="container">
                <div class="row align-items-center justify-content-between align-items-center">
                    <div class="col-auto">
                        <div class="header-logo-area">
                            <a href="{{url('/')}}">
                                <img class="logo-main" src="{{asset('/static/images/aplus-logo-transparent.png')}}" width="182" height="31" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="header-action d-flex justify-content-end align-items-center">
                            <button class="btn-search-menu d-xl-none me-lg-4 me-xl-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasSearch" aria-controls="AsideOffcanvasSearch">
                                <i class="search-icon icon-magnifier"></i>
                            </button>
                            @auth
                                <a href="{{url('account')}}" class="header-action-account d-none d-xl-block">{{Auth::user()->name}}</a>
                                <a href="{{url('account')}}" class="header-action-user me-lg-4 me-xl-0 d-xl-none">
                                    <i class="icon icon-user"></i>
                                </a>
                        @else
                                <a href="{{url('login')}}" class="header-action-account d-none d-xl-block">Login / SignUp</a>
                                <a href="{{url('login')}}" class="header-action-user me-lg-4 me-xl-0 d-xl-none">
                                    <i class="icon icon-user"></i>
                                </a>
                                @endauth
                            <!--<a class="header-action-wishlist" href="shop-wishlist.html">
                                <i class="icon-heart"></i>
                            </a>
                            <button class="header-action-cart" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithCartSidebar" aria-controls="offcanvasWithCartSidebar">
                                <i class="cart-icon icon-handbag"></i>
                                <span class="cart-count">01</span>
                            </button>-->
                            <a class="header-action-cart" href="{{url('cart')}}">
                                <i class="cart-icon icon-handbag"></i>
                                <span class="cart-count">@auth{{App\Models\Cart::cartCount()}}@else 0 @endauth</span>
                            </a>
                            <button class="btn-menu d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--== End Header Wrapper ==-->

    @yield('content')


    <!--== Start Footer Area Wrapper ==-->
    <footer class="footer-area footer-two-area bg-img" data-bg-img="{{asset('static/images/bg-footer.jpg')}}">
        <div class="container">
            <!--== Start Footer Bottom ==-->
            <div class="footer-bottom-two">
                <p class="copyright">
                    © APLUS DEVICE - All Rights Reserved 2022
                </p>
            </div>
            <!--== End Footer Bottom ==-->
        </div>
    </footer>
    <!--== End Footer Area Wrapper ==-->
    <!--== Scroll Top Button ==-->
    <div class="scroll-to-top"><span class="fa fa-angle-double-up"></span></div>

    <!--== Start Aside Search Menu ==-->
    <aside class="aside-search-box-wrapper offcanvas offcanvas-top" data-bs-scroll="true" tabindex="-1" id="AsideOffcanvasSearch">
        <div class="offcanvas-header">
            <h5 class="d-none" id="offcanvasTopLabel">Aside Search</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close">×</button>
        </div>
        <div class="offcanvas-body">
            <div class="container pt--0 pb--0">
                <div class="search-box-form-wrap">
                    <div class="search-note">
                        <p>Start typing and press Enter to search</p>
                    </div>
                    <form action="{{url('search')}}" method="get">
                        <div class="search-form position-relative">
                            <label for="search-input" class="visually-hidden">Search</label>
                            <input id="search-input" name="q" type="search" class="form-control" placeholder="Search entire store…">
                            <button class="search-button" type="button"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </aside>
    <!--== End Aside Search Menu ==-->

    <!--== Start Side Menu ==-->
    <aside class="aside-side-menu-wrapper off-canvas-area offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions">
        <div class="sidemenu-top">
            <div class="header-top-info">
                <a href="{{url('categories')}}"><span>India's best company </span>for Used Mobiles & Devices</a>
            </div>
        </div>
        <div class="offcanvas-header" data-bs-dismiss="offcanvas">
            <h5>Menu</h5>
            <button type="button" class="btn-close">×</button>
        </div>
        <div class="offcanvas-body">
            <!-- Start Mobile Menu Wrapper -->
            <div class="res-mobile-menu">
                <nav id="offcanvasNav" class="offcanvas-menu">
                    <ul>
                        <li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('categories')}}">Shop</a></li>
                        <li><a href="{{url('sell')}}">Sell Device</a></li>
                        <li class="vmenu-menu-item"><a href="javascript:void(0)">All Departments</a>
                            <ul class="vmenu-content">
                                @foreach(\App\Models\Category::active()->get() as $maincategory)
                                    <li class="vmenu-item"><a href="{{url('category/' . $maincategory->category_slug)}}"> <span class="icon"><img src="{{asset('static/images/home/vm8.png')}}" alt="Icon"></span> {{$maincategory->category_name}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- End Mobile Menu Wrapper -->
        </div>
    </aside>
    <!--== Start Side Menu ==-->

</div>
<!--== Wrapper End ==-->

<!-- Vendors JS -->
<script src="{{asset('static/js/modernizr-3.11.7.min.js')}}"></script>
<script src="{{asset('static/js/jquery-migrate-3.3.2.min.js')}}"></script>
<script src="{{asset('static/js/bootstrap.bundle.min.js')}}"></script>

<!-- Plugins JS -->
<script src="{{asset('static/js/swiper-bundle.min.js')}}"></script>
<script src="{{asset('static/js/fancybox.min.js')}}"></script>
<script src="{{asset('static/js/jquery.nice-select.min.js')}}"></script>
<script src="{{asset('static/js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('static/js/isotope.pkgd.min.js')}}"></script>
<script src="{{asset('static/js/range-slider.js')}}"></script>

<!-- Custom Main JS -->
@if(isset($is_disableMainJs) == true) null @else <script src="{{asset('static/js/main.js')}}"></script> @endif


</body>
</html>
