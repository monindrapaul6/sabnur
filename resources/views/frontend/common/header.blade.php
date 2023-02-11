<!--== Start Header Wrapper ==-->
<header class="header-wrapper">
    <!--<div class="header-top d-none d-md-block">
        <div class="container">
            <div class="header-top-area">
                <div class="header-top-info">
                    <a href="{{url('categories')}}">World Wide Completely Free Returns and Free Shipping</a>
                </div>
                <div class="header-top-action-area">
                    <div class="header-info-dropdown">
                        <button type="button" class="btn-info dropdown-toggle" id="dropdownLang" data-bs-toggle="dropdown" aria-expanded="false">English</button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownLang">
                            <li class="dropdown-item active">English</li>
                            <li class="dropdown-item">Français</li>
                        </ul>
                    </div>
                    <div class="header-info-dropdown">
                        <button type="button" class="btn-info dropdown-toggle" id="dropdownCurrency" data-bs-toggle="dropdown" aria-expanded="false">USD</button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownCurrency">
                            <li class="dropdown-item active">USD</li>
                            <li class="dropdown-item">EUR</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>-->
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
                        <input class="form-control" type="text" id="q" name="q" placeholder="Search Products" autocomplete="off">
                        <button type="submit" class="btn-src">
                            <i class="icon-magnifier"></i>
                        </button>
                    </form>

                    <div class="floatingLiveSearch border shadow ms-3" id="floatingLive" style="display: none">

                        <h5>Products</h5>
                        <hr/>
                        <div id="resultitems"></div>
                    </div>

                    <style>
                        .floatingLiveSearch{
                            position: absolute;
                            z-index: 1999;
                            width: 500px;
                            background-color: #fff;
                            padding: 25px 15px;
                            /*height: 550px;*/
                            max-height: 550px;
                            overflow: scroll;
                        }
                        .floatingLiveSearch .floatingLiveSearchItem h6{
                            color: #111111;
                            font-size: 12px;
                            font-weight: 500;
                        }
                        .floatingLiveSearch .floatingLiveSearchItem strong{
                            color: #000;
                            font-size: 12px;
                            font-weight: 600;
                        }
                    </style>

                    <script type="text/javascript">
                        $(document).ready(function (){
                            $('#floatingLive').hide();
                            $('#q').on('keyup',function(){
                                $value=$(this).val();
                                var strlength = $(this).val().length;

                                if(strlength > 2) {
                                    $('#floatingLive').show();
                                    $.ajax({
                                        type: 'get',
                                        url: '{{URL::to('api/livesearch')}}',
                                        data: {'q': $value},
                                        success: function (data) {
                                            $('#resultitems').html(data);
                                        }
                                    });
                                }
                                else{
                                    $('#resultitems').html('');
                                    $('#floatingLive').hide();
                                }

                            });
                        });
                        $('body').click(function() {
                            $('#resultitems').html('');
                            $('#floatingLive').hide();
                        });
                    </script>
                    <script type="text/javascript">
                        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                    </script>


                </div>
                <div class="col-auto d-flex justify-content-end align-items-center">
                    @auth
                        <a href="{{url('account')}}" class="header-action-account">{{Auth::user()->name}} </a>
                    @else
                        <a href="{{url('login')}}" class="header-action-account">Login / SignUp</a>
                @endauth
                <!--<a class="header-action-wishlist" href="shop-wishlist.html">
                            <i class="icon-heart"></i>
                        </a>
                        <button class="header-action-cart" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithCartSidebar" aria-controls="offcanvasWithCartSidebar">
                            <i class="cart-icon icon-handbag"></i>
                            <span class="cart-count">6</span>
                        </button>-->
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
                            <span class="cart-count">{{App\Models\Cart::cartCount()}}</span>
                        </a>
                        <button class="btn-menu d-xl-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-four-area d-none d-xl-block">
        <div class="container">
            <div class="header-four-inner-area">
                <div class="row align-items-center justify-content-between">
                    <div class="col-auto d-flex">
                        <!--<div class="vertical-menu vertical-menu-two">
                            <button class="vmenu-btn"><i class="icon fa fa-list-ul"></i> All Categories <i class="icon fa fa-angle-down"></i></button>
                            <ul class="vmenu-content vmenu-content-none">
                                @foreach(\App\Models\Category::active()->get() as $maincategory)
                                    <li class="vmenu-item"><a href="{{url('category/' . $maincategory->category_slug)}}"> <span class="icon"><img src="{{asset('static/images/home/vm8.png')}}" alt="Icon"></span> {{$maincategory->category_name}}</a></li>
                                @endforeach

                            </ul>
                        </div>-->
                        <div class="header-navigation d-none d-lg-block ps-xl-4 ps-xxl-10">
                            <ul class="main-nav">
                                <li class="main-nav-item"><a class="main-nav-link" href="{{url('collections/refurbished-mobile')}}"><img src="https://static.thenounproject.com/png/3576958-200.png" width="18" height="18"/> Refurbished Phones</a></li>
                                <li class="main-nav-item"><a class="main-nav-link" href="{{url('collections/open-box-mobile')}}"><img src="https://cdn-icons-png.flaticon.com/512/86/86165.png" width="18" height="18"/> Open Box Phones</a></li>
                                <li class="main-nav-item"><a class="main-nav-link" href="{{url('collections/brand-new-mobile')}}"><img src="https://cdn-icons-png.flaticon.com/512/65/65680.png" width="18" height="18"/> Brand New Devices</a></li>
                                <li class="main-nav-item"><a class="main-nav-link" href="{{url('collections/accessories')}}"><img src="https://cdn-icons-png.flaticon.com/512/114/114734.png" width="18" height="18"/> Accessories</a></li>
                                <li class="main-nav-item"><a class="main-nav-link" href="{{url('collections/best-deals')}}"><img src="https://www.pngitem.com/pimgs/m/151-1516452_days-to-ico-special-offers-offer-icon-png.png" width="18" height="18"/> Best Deals</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="header-action">
                            <div class="phone-item-action phone-item-action--two">
                                <div class="phone-item-icon">
                                    <img src="{{asset('static/images/phone2.png')}}" alt="Icon" width="32" height="36">
                                </div>
                                <div class="phone-item-content">
                                    <span>Call Us 24/7</span> <a href="tel:+918582819999">+91 8582819999</a>
                                </div>
                            </div>
                            <button class="btn-search-menu d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#AsideOffcanvasSearch" aria-controls="AsideOffcanvasSearch">
                                        <span class="search-icon">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M12.5 11H11.71L11.43 10.73C12.41 9.59 13 8.11 13 6.5C13 2.91 10.09 0 6.5 0C2.91 0 0 2.91 0 6.5C0 10.09 2.91 13 6.5 13C8.11 13 9.59 12.41 10.73 11.43L11 11.71V12.5L16 17.49L17.49 16L12.5 11ZM6.5 11C4.01 11 2 8.99 2 6.5C2 4.01 4.01 2 6.5 2C8.99 2 11 4.01 11 6.5C11 8.99 8.99 11 6.5 11Z"/>
                    </svg>
                  </span>
                            </button>
                            <button class="btn-menu d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--== End Header Wrapper ==-->
