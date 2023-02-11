@extends('frontend.layout.app')
@section('content')

    <!--== Start Divider Area ==-->
    <div class="divider-area section-space">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-9 d-flex border shadow rounded sellDeviceDetails">
                    <div class="col-3 col-md-4 px-2 py-3 text-center">
                        <img src="{{asset($device->device_image)}}" width="150" height="auto"/>
                    </div>
                    <div class="col-9 col-md-8 px-2 py-3">
                        <h2>{{$device->device_name}}</h2>
                        <p>Get highest price ever on <span>Aplus Device</span></p>
                        @if ($errors->has('variantDetails'))
                            <span class="text-danger">{{ $errors->first('variantDetails') }}</span>
                        @endif
                        <h6>Choose a variant</h6>
                        <div class="deviceVariants mt-3">
                            <?php
                            $str_arr = preg_split ("/\,/", $device->variants);
                            ?>
                            @foreach($str_arr as $variant)
                                <label for="{{$variant}}">
                                    <input type="radio" class="variantClass" name="variant" id="{{$variant}}" value="{{$variant}}"> {{$variant}}
                                </label>
                            @endforeach
                        </div>
                        <div class="mt-5">
                            <button class="btn btn-primary" id="getValButton">Get Value</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#getValButton').attr('disabled', true);
            var sss = null;
            $('.variantClass').click(function (){
                var sss = $(this).val();
                if(sss !== null) {
                    $('#getValButton').attr('disabled', false);
                    $('#variantVal').html(sss);
                    $('#variantDetails').val(sss);
                }
            });
            $('#getValButton').click(function (){
                $('#sellDetailsDiv').show();
                window.location.href="#deviceInfo";
            })
        });
    </script>
    <!--== Stop Divider Area ==-->
    <!--== Start Divider Area ==-->
    <form action="{{url('sellproduct')}}" method="post">
        @csrf
        <input type="hidden" name="device_slug" value="{{$device->device_slug}}"/>
        <div class="divider-area" id="sellDetailsDiv" style="display: block">
            <div class="container">
                <div class="row justify-content-center" id="deviceInfo">
                    <div class="col-12 col-md-9 py-5 px-0 d-md-flex">
                        <div class="col-lg-3 d-none d-md-block py-3 text-center border shadow rounded">
                            <img src="{{asset($device->device_image)}}" style="width: 150px; height: auto"/>
                            <h5 class="mt-3">{{$device->device_name}}</h5>
                            <p>Variant: <span id="variantVal"></span></p>
                            <input type="hidden" name="variantDetails" id="variantDetails" value="">
                        </div>
                        <div class="col-lg-9 py-3 px-4 border shadow rounded sellBoxDet">
                            <h4>Please tell us few things about your device</h4>
                            <p class="text-primary mb-5">We will justify the condition of your device</p>

                            <div class="deviceSellItems">
                                @if ($errors->has('device_age'))
                                    <span class="text-danger">{{ $errors->first('device_age') }}</span>
                                @endif
                                <h5>1. Age of Your Device</h5>
                                <label for="less than 3 months"><input type="radio" name="device_age" id="less than 3 months" value="less than 3 months"> less than 3 months</label>
                                <label for="3 - 6 months"><input type="radio" name="device_age" id="3 - 6 months" value="3 - 6 months"> 3 - 6 months</label>
                                <label for="6 - 12 months"><input type="radio" name="device_age" id="6 - 12 months" value="6 - 12 months"> 6 - 12 months</label>
                                <label for="greater than 12 months"><input type="radio" name="device_age" id="greater than 12 months" value="greater than 12 months"> greater than 12 months</label>
                            </div>

                            <div class="deviceSellItems">
                                @if ($errors->has('is_makecall'))
                                    <span class="text-danger">{{ $errors->first('is_makecall') }}</span>
                                @endif
                                <h5>2. Are you able to make calls?</h5>
                                <label for="YES"><input type="radio" name="is_makecall" id="YES" value="YES"> YES</label>
                                <label for="NO"><input type="radio" name="is_makecall" id="NO" value="NO"> NO</label>
                            </div>

                            <div class="deviceSellItems">
                                @if ($errors->has('is_scratchdisplay'))
                                    <span class="text-danger">{{ $errors->first('is_scratchdisplay') }}</span>
                                @endif
                                <h5>3. Scratch on Display?</h5>
                                <label for="None"><input type="radio" name="is_scratchdisplay" id="None" value="None"> None</label>
                                <label for="Minor (less than 2 scratches)"><input type="radio" name="is_scratchdisplay" id="Minor (less than 2 scratches)" value="Minor (less than 2 scratches)"> Minor (less than 2 scratches)</label>
                                <label for="Major (grater than 2 scratches)"><input type="radio" name="is_scratchdisplay" id="Major (grater than 2 scratches)" value="Major (grater than 2 scratches)"> Major (grater than 2 scratches)</label>
                            </div>

                            <div class="deviceSellItems">
                                @if ($errors->has('is_scratchbody'))
                                    <span class="text-danger">{{ $errors->first('is_scratchbody') }}</span>
                                @endif
                                <h5>4. Scratches/Dents on Body?</h5>
                                <label for="NoneDents"><input type="radio" name="is_scratchbody" id="NoneDents" value="None"> None</label>
                                <label for="MinorDents"><input type="radio" name="is_scratchbody" id="MinorDents" value="Minor"> Minor</label>
                                <label for="MajorDents"><input type="radio" name="is_scratchbody" id="MajorDents" value="Major"> Major</label>
                            </div>

                            <div class="deviceSellItems">
                                <h5>5. Functional Problems: Select the parts not working</h5>
                                <label for="Touch"><input type="checkbox" name="Touch" value="YES" id="Touch"> Touch</label>
                                <label for="CameraRear"><input type="checkbox" name="CameraRear" id="CameraRear" value="YES"> Camera (Rear)</label>
                                <label for="FrontCamera"><input type="checkbox" name="FrontCamera" id="FrontCamera" value="YES"> Front Camera</label>
                                <label for="Bluetooth"><input type="checkbox" name="Bluetooth" id="Bluetooth" value="YES"> Bluetooth</label>
                                <label for="Wifi"><input type="checkbox" name="Wifi" id="Wifi" value="YES"> Wifi</label>
                                <label for="FlashTorch"><input type="checkbox" name="FlashTorch" id="FlashTorch" value="YES"> Flash/Torch</label>
                                <label for="Speaker"><input type="checkbox" name="Speaker" id="Speaker" value="YES"> Speaker</label>
                                <label for="Earpiece"><input type="checkbox" name="Earpiece" id="Earpiece" value="YES"> Earpiece</label>
                                <label for="EarphoneJack"><input type="checkbox" name="EarphoneJack" id="EarphoneJack" value="YES"> Earphone Jack</label>
                                <label for="PowerButton"><input type="checkbox" name="PowerButton" id="PowerButton" value="YES"> Power Button</label>
                                <label for="VolumeButton"><input type="checkbox" name="VolumeButton" id="VolumeButton" value="YES"> Volume Button</label>
                            </div>

                            <div class="deviceSellItems">
                                <h5>6. Accessories Available (Check Boxes)</h5>
                                <label for="Bill Original"><input type="checkbox" name="accessories_available[]" value="Bill Original" id="Bill Original"> Bill Original None</label>
                                <label for="Box"><input type="checkbox" name="accessories_available[]" value="Box" id="Box"> Box</label>
                                <label for="USB Cable & Adapter"><input type="checkbox" name="accessories_available[]" value="USB Cable & Adapter" id="USB Cable & Adapter"> USB Cable & Adapter</label>
                            </div>

                            <hr/>

                            <div class="deviceSellItems">
                                <h5>Enter Your Name</h5>
                                <input type="text" name="name" id="name" value="">
                            </div>

                            <div class="deviceSellItems">
                                @if ($errors->has('device_imei'))
                                    <span class="text-danger">{{ $errors->first('device_imei') }}</span>
                                @endif
                                <h5>Enter Device IMEI</h5>
                                <input type="text" name="device_imei" id="device_imei" value="">
                            </div>

                            <div class="deviceSellItems">
                                <button class="btn btn-primary col-12" type="submit" id="submitBtn2">Submit</button>
                                <input type="hidden" name="device_id" id="device_id" value="{{$device->id}}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--== Stop Divider Area ==-->

<script>
    $(document).ready(function () {
        $('#submitBtn').click(function (e){
            $.ajax({
                type: "post",
                url: "{{url('/api/sellproduct')}}",
                data: {
                    device_id: $('#device_id').val(),
                    variant: $('input[name=variant]:checked').val(),
                    device_age: $('input[name=device_age]:checked').val(),
                    is_makecall: $('input[name=is_makecall]:checked').val(),
                    is_scratchdisplay: $('input[name=is_scratchdisplay]:checked').val(),
                    is_scratchbody: $('input[name=is_scratchbody]:checked').val(),
                    Touch: $('#Touch').val(),
                    CameraRear: $('#CameraRear').val(),
                    FrontCamera: $('#FrontCamera').val(),
                    Bluetooth: $('#Bluetooth').val(),
                    Wifi: $('#Wifi').val(),
                    FlashTorch: $('#FlashTorch').val(),
                    Speaker: $('#Speaker').val(),
                    Earpiece: $('#Earpiece').val(),
                    EarphoneJack: $('#EarphoneJack').val(),
                    PowerButton: $('#PowerButton').val(),
                    VolumeButton: $('#VolumeButton').val(),
                    accessories_available: $('input[name^=accessories_available]').val(),
                    device_imei: $('#device_imei').val()
                },
                success: function (response){
                    //console.log(response);
                    if(response.status === 200){
                        window.location.href = '/sellproduct/' + response.device.device_slug
                    }
                    if(response.status === 404){
                        alert('No Device Found');
                        return false;
                    }
                },
                error: function (response) {
                    console.log(response);
                }
            })
        });
    });
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


<script>
    $(document).ready(function (){
        /*var otp = null;
        $('#mobile').blur(function (){
            $('#otpDiv').show();
            otp = '111111';
        });
        $('#otp').blur(function (){
            var getOtp = $('#otp').val();
            if(getOtp === otp) {
                $('#is_mobile_verified').val(1);
                $('#otpMsg').html('OTP Verified');
                $('#submitBtn').prop('disabled', false);
            }
            else{
                $('#otpMsg').html('Invalid otp');
            }
        });*/
        $('#device_imei').blur(function (){
            //alert('IMEI Should check with 3rd Party API');
        })
    });
</script>
@endsection
