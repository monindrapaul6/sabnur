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
                                <a class="myaccount-nav-link active" href="{{url('account/orders')}}"> Orders</a>
                                <a class="myaccount-nav-link" href="{{url('account/address')}}">Address</a>
                                <a class="myaccount-nav-link" href="{{url('account/sell')}}">Sell Devices</a>
                                <a class="myaccount-nav-link" href="{{url('logout')}}">Logout</a>
                            </nav>
                        </div>
                        <div class="col-lg-9 col-md-8">
                            <div class="myaccount-content">
                                <h3>Orders</h3>
                                @foreach($orders as $order)
                                    <div class="col-12 mb-3 border">

                                        <div class="mb-3 bg-gray-light py-2 px-3 d-flex">
                                            <div class="col-2">
                                                Order placed<br/>
                                                {{$order->created_at->format('d M, Y')}}
                                            </div>
                                            <div class="col-2">
                                                Ship to<br/>
                                                <a href="{{url('account/address/' . $order->address_id)}}" class="text-primary">{{$order->order_address->name}}</a>
                                            </div>
                                            <div class="col-5">
                                                Total<br/>
                                                Rs. {{number_format($order->total, 2)}}
                                            </div>
                                            <div class="col-3">
                                                Order No # {{$order->order_no}}<br/>
                                                <a href="{{url('/account/order/' . $order->id)}}" class="text-primary">View order details</a>
                                            </div>
                                        </div>

                                        @foreach($order->orderInvoices as $invoice)
                                        <div class="d-flex">
                                            <div class="col-2 p-2">
                                                <a href="{{url('product/' . $invoice->invoiceProduct->product_slug)}}">
                                                    <img src="{{asset($invoice->invoiceProduct->productDPImage->image_thumb)}}"/>
                                                </a>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{url('product/' . $invoice->invoiceProduct->product_slug)}}" class="text-primary">
                                                    {{$invoice->invoiceProduct->product_name}}
                                                </a>
                                                <p>Quantity: {{$invoice->product_quantity}}</p>
                                            </div>
                                            <div class="col-4">
                                                <h6><span class="bg-success dot"></span> {{$order->order_status}}</h6>
                                                @if($order->order_status == 'ORDER DELIVERED')<p>On {{$order->created_at->format('d M, Y')}}</p>
                                                <p class="text-primary">
                                                    <i class="fa fa-star"></i> Rate & Review your Order
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
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
