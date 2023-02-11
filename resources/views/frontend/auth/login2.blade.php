@extends('frontend.layout.app')
@section('content')

    <main class="main-content">

        <!--== Start Login Wrapper ==-->
        <div class="login-register-area section-space">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <div class="login-register-content">
                            <div class="login-register-title mb-30">
                                <h3>Login</h3>
                            </div>
                            <div class="login-register-style login-register-pr">
                                <div id="numberDiv">
                                    <h6>Please Enter Your 10 Digit Mobile Number</h6>
                                    <div class="login-register-input d-flex">
                                        <div class="px-2 py-2">+91</div>
                                        <input type="text" id="mobile" placeholder="Enter 10 Digit Mobile Number">
                                        <div id="sign-in-button"></div>
                                    </div>
                                    <div class="btn-register">
                                        <button type="button" class="btn-register-now" onclick="sendOTP()" id="sendOtpDiv">
                                            <span id="loadingMsg" style="display: none">
                                                <img src="/static/images/loader.gif" width="20" height="20" class="mr-3"/>
                                                Sending OTP..
                                            </span>
                                            <span id="unloadingMsg">
                                                Request OTP
                                            </span>
                                        </button>
                                    </div>
                                </div>

                                <div id="otpDiv" style="display: none">
                                    <h6>OTP sent to <span class="text-primary" id="otpDivNumber"></span></h6>
                                    <div class="login-register-input">
                                        <input type="text" id="verification" placeholder="Enter Your OTP">
                                        <div class="forgot">
                                            <span class="text-primary" onclick="resendOTP('12');" style="cursor: pointer">Resend OTP</span>
                                            <div id="recaptcha-container-resend"></div>
                                        </div>
                                    </div>
                                    <div class="btn-register">
                                        <button class="btn-register-now" onclick="verify();">Submit OTP</button>
                                    </div>
                                </div>
                                <span class="text-danger" id="errorMsg" style="display: none"></span>

                                <div id="recaptcha-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End Login Wrapper ==-->
    </main>

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
                    url: "{{url('/api/login')}}",
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

@endsection
