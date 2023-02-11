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
                                <a class="myaccount-nav-link" href="{{url('account/orders')}}">Orders</a>
                                <a class="myaccount-nav-link" href="{{url('account/address')}}">Address</a>
                                <a class="myaccount-nav-link active" href="{{url('account/sell')}}">Sell Devices</a>
                                <a class="myaccount-nav-link" href="{{url('logout')}}">Logout</a>
                            </nav>
                        </div>
                        <div class="col-lg-9 col-md-8">
                            <div class="myaccount-content">
                                <h3>Sell Devices</h3>
                                @foreach($sells as $sell)
                                    <a href="{{url('account/sell/' . $sell->id)}}">
                                        <div class="col-12 mb-3 border">
                                            <div class="d-flex">
                                                <div class="col-2 p-2">
                                                    @isset($sell->selldeviceItem->device_image)<img src="{{asset($sell->selldeviceItem->device_image)}}"/>@endif
                                                </div>
                                                <div class="col-6">
                                                    {{$sell->selldeviceItem->device_name}}
                                                    <p>Variant: {{$sell->variant}}</p>
                                                </div>
                                                <div class="col-4">
                                                    <h5><span class="bg-success dot"></span> Sold On: {{$sell->created_at->format('d M, Y')}}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                                <!--Links-->
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
        font-size: 13px;
        line-height: 20px;
        font-weight: 500;
    }
    .dot {
        height: 15px;
        width: 15px;
        border-radius: 50%;
        display: inline-block;
    }
</style>
@endsection
