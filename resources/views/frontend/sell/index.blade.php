@extends('frontend.layout.app')
@section('content')

    <main class="main-content">

        <!--== Start Divider Area ==-->
        <div class="divider-area section-space" style="background-color: #1e6dd4; background-image: url('http://www.nokiaservicecenterinchennai.in/images/nokia-mobile-service-banner.jpg'); background-repeat: no-repeat; background-size: cover;">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 d-none d-sm-block">
                        <div class="col-11 col-sm-9 bg-white py-4 px-0" style="border-radius: 12px">
                            <h6 class="mb-3 px-3">Sell Your Device</h6>
                            <hr/>
                            <div class="px-3">
                                <p>
                                    <select name="category_id" id="category_id" class="sellDeviceItem">
                                        <option value="0">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </p>
                                <p>
                                    <select name="brand_id" id="brand_id" class="sellDeviceItem">
                                        <option>Select Brand</option>
                                    </select>
                                </p>
                                <p>
                                    <select name="device_slug" id="device_slug" class="sellDeviceItem">
                                        <option>Select Model</option>
                                    </select>
                                </p>
                                <p>
                                    <button class="btn btn-primary col-12" id="submitBtn">Sell Now</button>
                                </p>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function () {
                                $('#submitBtn').attr('disabled', true);
                                $('#category_id').on('change', function () {
                                    var idCategory = this.value;
                                    $("#brand_id").html('');
                                    $.ajax({
                                        url: "{{url('api/fetch-brands')}}",
                                        type: "POST",
                                        data: {
                                            category_id: idCategory,
                                            _token: '{{csrf_token()}}'
                                        },
                                        dataType: 'json',
                                        success: function (result) {

                                            console.log(result);
                                            $('#brand_id').html('<option value="0">Select Brand</option>');
                                            $.each(result, function (key, value) {
                                                $("#brand_id").append('<option value="' + value
                                                    .brand_id + '">' + value.brand_name + '</option>');
                                            });
                                            $('#device_slug').html('<option value="">Select Model</option>');
                                        }
                                    });
                                });

                                $('#brand_id').on('change', function () {
                                    var idBrand = this.value;
                                    $("#device_slug").html('');
                                    $.ajax({
                                        url: "{{url('api/fetch-models')}}",
                                        type: "POST",
                                        data: {
                                            brand_id: idBrand,
                                            _token: '{{csrf_token()}}'
                                        },
                                        dataType: 'json',
                                        success: function (res) {
                                            $('#device_slug').html('<option value="0">Select Model</option>');
                                            $.each(res, function (key, value) {
                                                $("#device_slug").append('<option value="' + value
                                                    .device_slug + '">' + value.device_name + '</option>');
                                            });
                                        }
                                    });
                                });
                                $('#device_slug').on('change', function () {
                                    var xxx = $('#device_slug').val();
                                    if(xxx !== '0'){
                                        $('#submitBtn').attr('disabled', false);
                                    }
                                    else {
                                        $('#submitBtn').attr('disabled', true);
                                        //alert('Please select model number');
                                    }
                                    return false;
                                });
                                $('#submitBtn').click(function (e){
                                    $.ajax({
                                        type: "post",
                                        url: "{{url('/api/sell')}}",
                                        data: {
                                            device_slug: $('#device_slug').val()
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
                    </div>
                    <div class="col-12 col-lg-8 text-center text-lg-start">
                        <h2 class="divider-title text-white mt-n2">Sale Your Old Mobile at Best Rate Ever.</h2>
                        <p class="divider-desc">Want to sell your old phones try Aplus, best rates ever</p>
                    </div>
                </div>
            </div>
        </div>
        <!--== Stop Divider Area ==-->

        <!--== Start Divider Area ==-->
        <div class="divider-area section-space d-block d-md-none">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-11 py-4 px-0" style="border-radius: 12px">
                        <h6 class="mb-3 px-3">Sell Your Device</h6>
                        <hr/>
                        <div class="px-3">
                            <p>
                                <select name="Mcategory_id" id="Mcategory_id" class="sellDeviceItem">
                                    <option value="0">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </p>
                            <p>
                                <select name="Mbrand_id" id="Mbrand_id" class="sellDeviceItem">
                                    <option>Select Brand</option>
                                </select>
                            </p>
                            <p>
                                <select name="Mdevice_slug" id="Mdevice_slug" class="sellDeviceItem">
                                    <option>Select Model</option>
                                </select>
                            </p>
                            <p>
                                <button class="btn btn-primary col-12" id="MsubmitBtn">Sell Now</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function () {
                    $('#MsubmitBtn').attr('disabled', true);
                    $('#Mcategory_id').on('change', function () {
                        var MidCategory = this.value;
                        $("#Mbrand_id").html('');
                        $.ajax({
                            url: "{{url('api/fetch-brands')}}",
                            type: "POST",
                            data: {
                                category_id: MidCategory,
                                _token: '{{csrf_token()}}'
                            },
                            dataType: 'json',
                            success: function (result) {
                                console.log(result);
                                $('#Mbrand_id').html('<option value="0">Select Brand</option>');
                                $.each(result, function (key, value) {
                                    $("#Mbrand_id").append('<option value="' + value
                                        .brand_id + '">' + value.brand_name + '</option>');
                                });
                                $('#Mdevice_slug').html('<option value="">Select Model</option>');
                            }
                        });
                    });

                    $('#Mbrand_id').on('change', function () {
                        var MidBrand = this.value;
                        $("#Mdevice_slug").html('');
                        $.ajax({
                            url: "{{url('api/fetch-models')}}",
                            type: "POST",
                            data: {
                                brand_id: MidBrand,
                                _token: '{{csrf_token()}}'
                            },
                            dataType: 'json',
                            success: function (res) {
                                $('#Mdevice_slug').html('<option value="0">Select Model</option>');
                                $.each(res, function (key, value) {
                                    $("#Mdevice_slug").append('<option value="' + value
                                        .device_slug + '">' + value.device_name + '</option>');
                                });
                            }
                        });
                    });
                    $('#Mdevice_slug').on('change', function () {
                        var xxx = $('#Mdevice_slug').val();
                        if(xxx !== '0'){
                            $('#MsubmitBtn').attr('disabled', false);
                        }
                        else {
                            $('#MsubmitBtn').attr('disabled', true);
                            //alert('Please select model number');
                        }
                        return false;
                    });
                    $('#MsubmitBtn').click(function (e){
                        $.ajax({
                            type: "post",
                            url: "{{url('/api/sell')}}",
                            data: {
                                device_slug: $('#Mdevice_slug').val()
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
        </div>
        <!--== Stop Divider Area ==-->

    </main>
@endsection
