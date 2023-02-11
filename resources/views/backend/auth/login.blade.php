<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Sundarini Admin Panel" />
    <meta name="author" content="" />

    <link rel="icon" href="{{asset('public/assets/admin/assets/images/favicon.ico')}}">

    <title>Aplus Device Login</title>

    <link rel="stylesheet" href="{{asset('backend/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/font-icons/entypo/css/entypo.css')}}">
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    <link rel="stylesheet" href="{{asset('backend/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/neon-core.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/neon-theme.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/neon-forms.css')}}">
    <link rel="stylesheet" href="{{asset('backend/css/custom.css')}}">

    <script src="{{asset('backend/js/jquery-1.11.3.min.js')}}"></script>

    <script src="{{asset('backend/js/jquery-1.11.3.min.js')}}"></script>

<!--[if lt IE 9]><script src="{{asset('backend/js/ie8-responsive-file-warning.js')}}"></script><![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body class="page-body login-page login-form-fall">


<!-- This is needed when you send requests via Ajax -->

<div class="login-container">

    <div class="login-header login-caret">

        <div class="login-content">

            <a href="{{url('/')}}">
                <img src="{{asset('backend/images/A-pluslogo.png')}}" width="120" alt="" />
            </a>
        </div>

    </div>

    <div class="login-progressbar">
        <div></div>
    </div>

    <div class="login-form">

        <div class="login-content">

            <form method="post" role="" id="" action="{{url('admin/postLogin')}}">
                @csrf
                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-user"></i>
                        </div>

                        <input type="text" class="form-control" name="mobile" id="mobile" placeholder="mobile" autocomplete="off" />
                    </div>

                </div>

                <div class="form-group">

                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="entypo-key"></i>
                        </div>

                        <input type="password" class="form-control" name="password" id="password" placeholder="Password" autocomplete="off" />
                    </div>

                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-login">
                        <i class="entypo-login"></i>
                        Login In
                    </button>
                </div>
            </form>

        </div>

    </div>

</div>


<!-- Bottom scripts (common) -->
<script src="{{asset('backend/js/gsap/TweenMax.min.js')}}"></script>
<script src="{{asset('backend/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js')}}"></script>
<script src="{{asset('backend/js/bootstrap.js')}}"></script>
<script src="{{asset('backend/js/joinable.js')}}"></script>
<script src="{{asset('backend/js/resizeable.js')}}"></script>
<script src="{{asset('backend/js/neon-api.js')}}"></script>
<script src="{{asset('backend/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('backend/js/neon-login.js')}}"></script>


</body>
</html>
