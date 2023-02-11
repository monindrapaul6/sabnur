@extends('frontend.layout.app')
@section('content')
    <!--== Start Divider Area ==-->
    <div class="divider-area" id="sellDetailsDiv" style="display: block">
        <div class="container">
            <div class="row justify-content-center" id="deviceInfo">
                <div class="col-12 col-md-9 py-5 px-0 d-md-flex">
                    <div class="col-lg-3 py-3 d-none d-md-block text-center border shadow rounded">
                        <img src="{{asset($sellDevice->selldeviceItem->device_image)}}" style="width: 150px; height: auto"/>
                        <h5 class="mt-3">{{$sellDevice->selldeviceItem->device_name}}</h5>
                        <p>Variant: {{$sellDevice->variant}}</p>
                    </div>
                    <div class="col-lg-9 py-3 px-4 border shadow rounded sellBoxDet">
                        <h4>Enter Your Contact Details</h4>
                        <p class="text-success mb-5">Submit your contact details for our team to connect with you</p>

                        <div id="numberDiv" class="deviceSellItems">
                            <h5>Enter Mobile Number</h5>
                            <input type="text" id="mobile" name="mobile" value="" placeholder="Enter 10 Digit Mobile Number">
                            <div id="sign-in-button"></div>
                            <span class="text-danger" id="senderrorMsg" style="display: none"></span>

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

                        <div id="otpDiv" style="display: none" class="deviceSellItems">
                            <h6>OTP sent to <span class="text-primary" id="otpDivNumber"></span> <span id="changeNumber" style="text-decoration: underline; cursor: pointer">(Change Number)</span></h6>
                            <div class="d-flex">
                                <input type="text" id="verification" placeholder="Enter Your OTP">
                                <div class="forgot mx-3">
                                    <span class="text-primary" onclick="resendOTP();" style="cursor: pointer">Resend OTP</span>
                                    <div id="recaptcha-container-resend"></div>
                                </div>
                            </div>
                            <div class="btn-register">
                                <button class="btn-register-now" onclick="verify();">Submit OTP</button>
                            </div>
                        </div>
                        <span class="text-success" id="otpMsg" style="display: none"></span>
                        <span class="text-danger" id="otpMsgError" style="display: none"></span>

                        <div id="submitDiv" style="display: none">
                            <form action="{{url('sellproductOtp')}}" method="post">
                                @csrf
                                <input type="hidden" name="selldevice_id" value="{{$sellDevice->id}}"/>
                                <input type="hidden" name="is_mobile_verified" id="is_mobile_verified" value="0">
                                <input type="hidden" id="fid" name="fid" value="">
                                <input type="hidden" id="mobileNum" name="mobileNum" value="">

                                <div class="deviceSellItems" style="display: block">
                                    <button class="btn btn-info col-12" type="submit" id="submitBtn">Submit</button>
                                </div>
                            </form>
                        </div>

                        <div id="recaptcha-container"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--== Stop Divider Area ==-->

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
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('sign-in-button', {
                'size': 'invisible',
                'callback': (response) => {
                    onSignInSubmit();
                }
            });
        }

        function sendOTP() {
            $('#loadingMsg').show();
            var getNumber = $("#mobile").val();
            if (getNumber.length !== 10) {
                $("#senderrorMsg").show();
                $('#senderrorMsg').text('Please enter correct mobile number');
                $('#loadingMsg').hide();
                return false;
            }
            this.sendOtpMessage(getNumber)
        }
        function sendOtpMessage(getNumber){
            var number = '+91' + getNumber;
            firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier).then(function (confirmationResult) {
                window.confirmationResult = confirmationResult;
                coderesult = confirmationResult;
                //console.log(coderesult);
                $("#otpDivNumber").text(getNumber);
                $("#otpDiv").show();
                $('#numberDiv').hide();
                $("#senderrorMsg").hide();
                $('#loadingMsg').hide();
            }).catch(function (error) {
                $('#numberDiv').show();
                $("#otpDiv").hide();
                $("#senderrorMsg").show();
                $("#senderrorMsg").text('Something went wrong');
            });
        }

        function resendOTP(){
            $('#errorMsg').hide();
            var getNumber = $("#mobile").val();
            this.sendOtpMessage(getNumber);
        }

        function verify() {
            $('#loadingMsg').show();
            var code = $("#verification").val();
            coderesult.confirm(code).then(function (result) {
                var user = result.user.phoneNumber;
                $.ajax({
                    url: "{{url('/api/login')}}",
                    type: 'post',
                    dataType: 'json',
                    data: {
                        mobile: result.user.phoneNumber,
                        token: result.user._lat
                    },
                    success: function (response) {
                        $('#fid').val(response.success.user.firebase_id);
                        $('#mobileNum').val(response.success.user.mobile);
                    },
                    error: function (result){
                        console.log(result);
                    }
                });
                //console.log(result);
                $("#senderrorMsg").hide();
                $('#is_mobile_verified').val(1);
                $('#otpMsg').text('OTP verified');
                $('#otpMsg').show();
                $('#otpMsgError').text();
                $('#otpMsgError').hide();
                $('#submitBtn').prop('disabled', false);
                $('#loadingMsg').hide();
                $('#submitDiv').show();
                $('#custmobileNum').val(user);
            }).catch(function (error) {
                $('#is_mobile_verified').val(0);
                $('#submitBtn').prop('disabled', true);
                $('#otpMsg').text();
                $('#otpMsg').hide();
                $('#otpMsgError').text('OTP is invalid');
                $('#fid').val("");
                $('#mobileNum').val("");
                $('#otpMsgError').show();
                $('#loadingMsg').hide();
                $('#submitDiv').hide();
            });
        }

        $('#changeNumber').click(function (){
            $('#is_mobile_verified').val(0);
            $('#mobile').val("");
            $('#fid').val("");
            $('#mobileNum').val("");
            $('#otpDiv').hide();
            $('#numberDiv').show();
            $('#otpDiv').hide();
            $('#verification').val("");
            $('#otpMsg').hide();
            $('#otpMsgError').hide();
            $('#submitDiv').hide();
        })
    </script>

    <style>
        .deviceVariants label{
            background: #fff;
            padding: 4px 6px;
            border-radius: 6px;
            font-size: 15px;
            color: #111111;
            font-weight: 500;
            box-shadow: 0px 0px 4px 4px #e6e6e6;
            margin: 4px;
        }
        .deviceSellItems{
            margin-bottom: 25px;
        }
        .deviceSellItems label{
            background: #f5f5f5;
            padding: 6px 8px;
            border-radius: 6px;
            font-size: 16px;
            margin: 4px;
        }
        .deviceSellItems input[type=text]{
            width: 350px;
            padding: 2px 4px;
        }
    </style>
@endsection
