@extends('frontend.layout.applight')
@section('content')

    <main class="main-content">

        <!--== Start My Account Wrapper ==-->
        <div class="account-area section-space">
            <div class="container">
                <div class="myaccount-page-wrapper">
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <nav class="myaccount-tab-menu nav nav-tabs">
                                <a class="myaccount-nav-link" href="{{url('/account')}}">Dashboard</a>
                                <a class="myaccount-nav-link" href="{{url('account/orders')}}"> Orders</a>
                                <a class="myaccount-nav-link" href="{{url('account/address')}}">Address</a>
                                <a class="myaccount-nav-link active" href="{{url('account/sell')}}">Sell Devices</a>
                                <a class="myaccount-nav-link" href="{{url('logout')}}">Logout</a>
                            </nav>
                        </div>
                        <div class="col-lg-9 col-md-8">
                            <div class="myaccount-content">
                                <h3>Sell Details</h3>

                                <div class="col-6 float-start">
                                    ID: {{$sell->id}}
                                </div>

                                <div class="col-12 mb-3 d-flex border px-3 py-3">
                                    <div class="col-2">
                                        @isset($sell->selldeviceItem->device_image)
                                            <img src="{{asset($sell->selldeviceItem->device_image)}}"/>
                                        @endisset
                                    </div>
                                    <div class="col-3">
                                        <h4>{{$sell->selldeviceItem->device_name}}</h4>
                                        <p><strong>IMEI No: {{$sell->device_imei}}</strong></p>
                                    </div>
                                    <div class="col-4">
                                        <h5>Customer Details</h5>
                                        <p><strong>{{$sell->selldeviceUser->name}}</strong><br>
                                            <strong>{{$sell->selldeviceUser->mobile}}</strong>
                                        </p>
                                    </div>
                                    <div class="col-3">
                                        Sold on <br/>
                                        {{$sell->created_at->format('d M, Y')}}
                                    </div>

                                </div>
                                <div class="col-12 mb-3 border">
                                    <div class="d-flex py-3  px-2">
                                        <div class="col-4">
                                            <p>Variant: {{$sell->variant}}</p>
                                            <p>Device Age: {{$sell->device_age}}</p>
                                            <p>Can Make Call: {{$sell->is_makecall}}</p>
                                            <p>Scratch on Display: {{$sell->is_scratchdisplay}}</p>
                                            <p>Can Make Call: {{$sell->is_makecall}}</p>
                                            <p>Can Make Call: {{$sell->is_makecall}}</p>
                                            <p>Can Make Call: {{$sell->is_makecall}}</p>
                                        </div>
                                        <div class="col-4">
                                            <h5>Functional Problems</h5>
                                            <p>Touch: {{ json_decode($sell->functional_problems)->Touch }}</p>
                                            <p>Camera Rear: {{ json_decode($sell->functional_problems)->CameraRear }}</p>
                                            <p>Front Camera: {{ json_decode($sell->functional_problems)->FrontCamera }}</p>
                                            <p>Bluetooth: {{ json_decode($sell->functional_problems)->Bluetooth }}</p>
                                            <p>Wifi: {{ json_decode($sell->functional_problems)->Wifi }}</p>
                                            <p>Flash Torch: {{ json_decode($sell->functional_problems)->FlashTorch }}</p>
                                            <p>Speaker: {{ json_decode($sell->functional_problems)->Speaker }}</p>
                                            <p>Earpiece: {{ json_decode($sell->functional_problems)->Earpiece }}</p>
                                            <p>Earphone Jack: {{ json_decode($sell->functional_problems)->EarphoneJack }}</p>
                                            <p>Power Button: {{ json_decode($sell->functional_problems)->PowerButton }}</p>
                                            <p>Volume Button: {{ json_decode($sell->functional_problems)->VolumeButton }}</p>
                                        </div>
                                        <div class="col-4">
                                            <h5>Accessories Available</h5>
                                            <p>
                                                @if($sell->accessories_available == null)
                                                    No Accessory Provided
                                                @else
                                                    @foreach(json_decode($sell->accessories_available, true) as $accessory)
                                                        {{$accessory}}@unless($loop->last),@endunless
                                                    @endforeach
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--== End My Account Wrapper ==-->
    </main>
    <style>
        .myaccount-content{
            font-size: 16px;
            font-weight: 500;
        }
        .myaccount-content p{
            line-height: 20px;
        }
        .dot {
            height: 15px;
            width: 15px;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
@endsection
