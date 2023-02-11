<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Admin Panel" />
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

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>

    <!--[if lt IE 9]><script src="{{asset('backend/js/ie8-responsive-file-warning.js')}}"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="https://cdn.tiny.cloud/1/sqhluka7387mo7g05nfaql5ohc4ilv1ou3ehye90iz45bxfo/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
        tinymce.init({
            selector: 'textarea#product_name, textarea#product_details, textarea#product_summary, textarea#description, textarea#blog_details',
            menubar: false,
        });
    </script>

</head>
<body class="page-body">
<script>
    $("document").ready(function(){
        $("div.alert").delay(3000).fadeOut(300);
    });
</script>
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
                        <img src="{{asset('backend/images/aplus-logo-transparent.png')}}" width="120" alt="" />
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
                <li>
                    <a href="{{url('admin/invoices')}}">
                        <i class="entypo-layout"></i>
                        <span class="title">Invoices</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/categories')}}">
                        <i class="entypo-layout"></i>
                        <span class="title">Categories</span>
                    </a>
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
                <li>
                    <a href="{{url('admin/contacts')}}">
                        <i class="entypo-layout"></i>
                        <span class="title">Contacts</span>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/images')}}">
                        <i class="entypo-layout"></i>
                        <span class="title">Images</span>
                    </a>
                </li>
                <li class="has-sub">
                    <a href="#">
                        <i class="entypo-layout"></i>
                        <span class="title">Customers</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/customers')}}">
                                <span class="title">All Customers</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/customer/create')}}">
                                <span class="title">Add Customer</span>
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
                        <span class="title">Postal Zips</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{url('admin/postalzips')}}">
                                <span class="title">All postal Zips</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{url('admin/postalzip/create')}}">
                                <span class="title">Add Postal Zip</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{url('admin/sliders')}}">
                        <i class="entypo-layout"></i>
                        <span class="title">Sliders</span>
                    </a>
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
                <li>
                    <a href="{{url('admin/charges')}}">
                        <i class="entypo-layout"></i>
                        <span class="title">Charges</span>
                    </a>
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

    <div class="main-content">

        <div class="row">

            <!-- Profile Info and Notifications -->



            <!-- Raw Links -->
            <div class="col-md-6 col-sm-4 clearfix hidden-xs">

                <ul class="list-inline links-list pull-right">
                    <li>
                        <a href="{{url('admin/logout')}}">
                            Log Out <i class="entypo-logout right"></i>
                        </a>
                    </li>
                </ul>

            </div>

        </div>

        <hr />
    @yield('content')
        <!-- Footer -->
        <footer class="main">
            &copy; 2023 <strong>Sabnur Nursery & Plant Admin</strong> Admin by <a href="https://www.facebook.com/algoflow.in" target="_blank">Algoflow</a>
        </footer>
    </div>
</div>

<!-- Imported styles on this page -->
<link rel="stylesheet" href="{{asset('backend/js/datatables/datatables.css')}}">
<link rel="stylesheet" href="{{asset('backend/js/select2/select2-bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('backend/js/select2/select2.css')}}">

<!-- Bottom scripts (common) -->
<script src="{{asset('backend/js/gsap/TweenMax.min.js')}}"></script>
<script src="{{asset('backend/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js')}}"></script>
<script src="{{asset('backend/js/bootstrap.js')}}"></script>
<script src="{{asset('backend/js/joinable.js')}}"></script>
<script src="{{asset('backend/js/resizeable.js')}}"></script>
<script src="{{asset('backend/js/neon-api.js')}}"></script>


<!-- Imported scripts on this page -->

<script src="{{asset('backend/js/datatables/datatables.js')}}"></script>
<script src="{{asset('backend/js/select2/select2.min.js')}}"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript" src="{{asset('backend/js/bootstrap-datepicker.js')}}"></script>

<!-- JavaScripts initializations and stuff -->
<script src="{{asset('backend/js/neon-custom.js')}}"></script>


<!-- Demo Settings -->
<script src="{{asset('backend/js/neon-demo.js')}}"></script>

</body>
</html>
