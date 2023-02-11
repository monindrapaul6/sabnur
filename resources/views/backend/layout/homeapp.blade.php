<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sundarini App Admin" />
    <meta name="author" content="" />

    <link rel="icon" href="{{asset('backend/images/favicon.ico')}}">

    <title>Aplus Website Admin</title>

    <link rel="stylesheet" href="{{asset('backend/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/font-icons/entypo/css/entypo.css')}}">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/neon-core.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/neon-theme.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/neon-forms.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/skins/purple.css')}}">

    <script src="{{asset('backend/js/jquery-1.11.3.min.js')}}"></script>

<!--[if lt IE 9]><script src="{{asset('backend/js/ie8-responsive-file-warning.js')}}"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="page-body page-fade">
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <div class="sidebar-menu">
        <div class="sidebar-menu-inner">
            <header class="logo-env">
                <!-- logo -->
                <div class="logo">
                    <a href="{{url('/admin')}}">
                        <img src="{{asset('/backend/images/aplus-logo-transparent.png')}}" width="120" alt="" />
                    </a>
                </div>
                <!-- logo collapse icon -->
                <div class="sidebar-collapse">
                    <a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>
                <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
                <div class="sidebar-mobile-menu visible-xs">
                    <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                        <i class="entypo-menu"></i>
                    </a>
                </div>
            </header>
            <ul id="main-menu" class="main-menu">
                <!-- add class "multiple-expanded" to allow multiple submenus to open -->
                <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
                <li>
                    <a href="{{url('/admin')}}">
                        <i class="entypo-gauge"></i>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Invoices</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/invoices')}}">
                                <span class="title">All Invoices</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/invoicereports')}}">
                                <span class="title">Invoice Reports</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Brands</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/brands')}}">
                                <span class="title">All Brands</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/brand/create')}}">
                                <span class="title">Create Brand</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Categories</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/categories')}}">
                                <span class="title">All Categories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/category/create')}}">
                                <span class="title">Add Category</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Products</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/products')}}">
                                <span class="title">All products</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/product/create')}}">
                                <span class="title">Add product</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Sliders</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/sliders')}}">
                                <span class="title">All Sliders</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/slider/create')}}">
                                <span class="title">Add Slider</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Offers</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/offers')}}">
                                <span class="title">All Offers</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/offer/create')}}">
                                <span class="title">Add Offer</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Contacts</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/contacts')}}">
                                <span class="title">All Contacts</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Bulk Orders</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/bulkorders')}}">
                                <span class="title">All Bulk Orders</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Franchises</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/franchises')}}">
                                <span class="title">All Franchises</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Distributors</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/distributors')}}">
                                <span class="title">All Distributors</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Galleries</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/galleries')}}">
                                <span class="title">All Galleries</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/gallery/create')}}">
                                <span class="title">Add Gallery</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Test Reports</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/testreports')}}">
                                <span class="title">All Test Reports</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/testreport/create')}}">
                                <span class="title">Add Test Report</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Tenders</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/tenders')}}">
                                <span class="title">All Tenders</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/tender/create')}}">
                                <span class="title">Add Tender</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Notices</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/notices')}}">
                                <span class="title">All Notices</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/notice/create')}}">
                                <span class="title">Add Notice</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Outlets</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/outlets')}}">
                                <span class="title">All Outlets</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/outlet/create')}}">
                                <span class="title">Add Outlet</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">About Timelines</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/abtls')}}">
                                <span class="title">All Timelines</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/abtl/create')}}">
                                <span class="title">Add Timeline</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Images</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/images')}}">
                                <span class="title">All Images</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/image/create')}}">
                                <span class="title">Add Image</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Fight Stories</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/stories')}}">
                                <span class="title">All Fight Stories</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/story/create')}}">
                                <span class="title">Add Fight Story</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Staffs</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/staffs')}}">
                                <span class="title">All Staffs</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/staff/create')}}">
                                <span class="title">Add Staff</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Site Reviews</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/reviews')}}">
                                <span class="title">All Site Reviews</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/review/create')}}">
                                <span class="title">Add Site Review</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Product Reviews</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/productreviews')}}">
                                <span class="title">All Product Reviews</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Press Releases</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/pressreleases')}}">
                                <span class="title">All Press Releases</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/pressrelease/create')}}">
                                <span class="title">Add Press Release</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">State Codes</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/statecodes')}}">
                                <span class="title">All State Codes</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/statecode/create')}}">
                                <span class="title">Add State Code</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Cod Zips</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/codzips')}}">
                                <span class="title">All Cod Zips</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/codzip/create')}}">
                                <span class="title">Add Cod Zip</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Charges</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/charges')}}">
                                <span class="title">All Charges</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/charge/create')}}">
                                <span class="title">Add Charge</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('admin/siteinfo')}}">
                        <i class="entypo-layout"></i>
                        <span class="title">Site Info</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/info')}}">
                        <i class="entypo-layout"></i>
                        <span class="title">Software Info</span>
                    </a>
                </li>
            </ul>

        </div>
    </div>
@yield('content')
<!-- Footer -->
    <footer class="main">
        &copy; 2020 <strong>Aplus Device Admin</strong> Admin by <a href="https://www.facebook.com/algoflow.in" target="_blank">Algoflow</a>
    </footer>
</div>
</div>

<!-- Imported styles on this page -->
<link rel="stylesheet" href="{{asset('backend/js/jvectormap/jquery-jvectormap-1.2.2.css')}}">
<link rel="stylesheet" href="{{asset('backend/js/rickshaw/rickshaw.min.css')}}">
<!-- Bottom scripts (common) -->
<script src="{{asset('backend/js/gsap/TweenMax.min.js')}}"></script>
<script src="{{asset('backend/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js')}}"></script>
<script src="{{asset('backend/js/bootstrap.js')}}"></script>
<script src="{{asset('backend/js/joinable.js')}}"></script>
<script src="{{asset('backend/js/resizeable.js')}}"></script>
<script src="{{asset('backend/js/neon-api.js')}}"></script>
<script src="{{asset('backend/js/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<!-- Imported scripts on this page -->
<script src="{{asset('backend/js/jvectormap/jquery-jvectormap-europe-merc-en.js')}}"></script>
<script src="{{asset('backend/js/jquery.sparkline.min.js')}}"></script>
<script src="{{asset('backend/js/rickshaw/vendor/d3.v3.js')}}"></script>
<script src="{{asset('backend/js/rickshaw/rickshaw.min.js')}}"></script>
<script src="{{asset('backend/js/raphael-min.js')}}"></script>
<script src="{{asset('backend/js/morris.min.js')}}"></script>
<script src="{{asset('backend/js/toastr.js')}}"></script>
<script src="{{asset('backend/js/neon-chat.js')}}"></script>
<!-- JavaScripts initializations and stuff -->
<script src="{{asset('backend/js/neon-custom.js')}}"></script>
<!-- Demo Settings -->
<script src="{{asset('backend/js/neon-demo.js')}}"></script>
</body>
</html>
