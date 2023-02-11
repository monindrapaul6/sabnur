<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="initial-scale=1, width=device-width" />

    <link rel="stylesheet" href="{{asset('/android/css/global.css')}}" />
    <link rel="stylesheet" href="{{asset('/android/css/login.css')}}" />
    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>
<body>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-12 mt-4 text-center">
                <img src="{{asset('android/images/logo.png')}}" width="135" height="135">
            </div>
            <div class="col-12 text-center mt-3">
                <h1>Sabnur Plant & Nursery</h1>
            </div>
        </div>
    </div>
</div>

<div class="section mt-3">
    <div class="container">
        <div class="row">

            <div id="numberDiv">
                <div class="col-12 px-5 mt-5">
                    <h4 class="title">Enter your mobile number to continue</h4>
                    <div class="mobileOtp mt-3">
                        <span>+91</span>
                        <input type="text" placeholder="eg. 98300 *****" id="mobile">
                        <div id="sign-in-button"></div>
                    </div>
                    <div class="mt-3">
                        <button class="submitOtpBtn" onclick="sendOTP()" id="sendOtpDiv">
                            <span id="loadingMsg" style="display: none">
                                <img src="/static/images/loader.gif" width="20" height="20" class="mr-3"/>
                                Sending OTP..
                            </span>
                            <span id="unloadingMsg">
                                Continue
                            </span>
                        </button>
                    </div>
                </div>
            </div>

            <div id="otpDiv" style="display: none">
                <div class="col-12 px-5 mt-5">
                    <p>Otp sent to <span id="otpDivNumber"></span></p>
                    <h4 class="title">Enter your OTP</h4>
                    <div class="mobileOtp mt-3">
                        <input type="text" placeholder="eg. 12345" id="verification" maxlength="6" minlength="6">
                    </div>
                    <div class="mt-3">
                        <button class="submitOtpBtn" onclick="verify();">Verify</button>
                    </div>
                    <div class="mt-3">
                        <button class="resendOtpBtn" onclick="resendOTP('12');" style="cursor: pointer">Resend</button>
                        <div id="recaptcha-container-resend"></div>
                    </div>
                </div>
            </div>

            <span class="text-danger" id="errorMsg" style="display: none"></span>
            <div id="recaptcha-container"></div>


        </div>
    </div>
</div>

<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mt-5 mb-3">
                <img src="{{asset('android/images/flower.png')}}" class="img-fluid"/>
            </div>
        </div>
    </div>
</div>

<div class="section position-fixed bottom-0 col-12">
    <div class="container">
        <div class="row">
            <div class="col-12 footerPart px-0">
                <span>Copyright 2023 Sabnur Nursey</span>
            </div>
        </div>
    </div>
</div>


<!-- Firebase App (the core Firebase SDK) is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
<script>
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
        apiKey: "AIzaSyBX76O6TO7f836uk4MzvWxIjBF_UKSvD_A",
        authDomain: "aplus-device-c4f6a.firebaseapp.com",
        projectId: "aplus-device-c4f6a",
        storageBucket: "aplus-device-c4f6a.appspot.com",
        messagingSenderId: "688192204454",
        appId: "1:688192204454:web:46f24bcb67f365f76d0e67",
        measurementId: "G-PBRCWFDWW6"
    };
    firebase.initializeApp(firebaseConfig);
</script>
<script type="text/javascript">
    window.onload = function () {
        render();
    };
    function render() {
        /*window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
        recaptchaVerifier.render();*/
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('sign-in-button', {
            'size': 'invisible',
            'callback': (response) => {
                onSignInSubmit();
            }
        });
    }
    function sendOTP() {
        var getNumber = $("#mobile").val();
        if(getNumber === ""){
            alert("please enter mobile");
            return false;
        }
        $('#errorMsg').hide();
        $('#loadingMsg').show();
        $('#unloadingMsg').hide();
        $("#sendOtpDiv").prop('disabled', false); // enable button

        this.sendOtpMessage(getNumber)
    }

    function resendOTP(){
        $('#errorMsg').hide();
        var getNumber = $("#mobile").val();
        $('#verification').val('');
        this.sendOtpMessage(getNumber);
    }

    function sendOtpMessage(getNumber){
        var number = '+91' + getNumber;
        firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
            window.confirmationResult = confirmationResult;
            coderesult = confirmationResult;
            //console.log(coderesult);
            $("#otpDivNumber").text(getNumber);
            $("#otpDiv").show();
            $("#numberDiv").hide();
            $("#mobile").prop('readonly', true);
        }).catch(function (error) {
            $("#successAuth").hide();
            $("#errorMsg").text(error.message);
            $("#error").show();
            $('#otpDiv').show();
            $("#numberDiv").hide();
        });
    }

    function verify() {
        var targetUrl = "{{app('request')->input('target')}}";
        var code = $("#verification").val();
        coderesult.confirm(code).then(function (result) {
            var user = result.user.phoneNumber;
            console.log(result);
            $("#errorMsg").hide();
            $.ajax({
                url: "{{url('/api/firebaselogin')}}",
                type: 'post',
                dataType: 'json',
                data: {
                    mobile: result.user.phoneNumber,
                    token: result.user._lat
                },
                success: function (response) {
                    window.location.href = '/oathlogin?fid=' + response.success.user.firebase_id + '&mobile=' + response.success.user.mobile + '&targetUrl=' + targetUrl;
                },
                error: function (result){
                    console.log(result);
                }
            });
        }).catch(function (error) {
            $("#errorMsg").text(error.code === 'auth/invalid-verification-code' ? 'OTP is incorrect' : error.message);
            $("#errorMsg").show();
        });
    }
</script>

</body>
</html>
