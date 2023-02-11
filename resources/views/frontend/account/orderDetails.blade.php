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
                                <h3>Order Details</h3>

                                <div class="col-6 float-start">
                                    Order No: {{$order->order_no}}
                                </div>
                                @if($order->order_status == 'ORDER DELIVERED')
                                <div class="col-6 float-start text-end d-none">
                                    <a href="#" onclick='window.location.href="/invoice/{{$order->id}}/download"'>Download Invoice</a>
                                </div>
                                @endif

                                <div class="col-12 mb-3 d-md-flex border px-3 py-3">
                                    <div class="col-12 col-md-5">
                                        <h6>Delivery Address</h6>
                                        <p><strong>{{$order->order_address->name}}</strong><br>
                                        {{$order->order_address->street}}, {{$order->order_address->city}}, {{$order->order_address->state}},
                                            {{$order->order_address->zip}}<br>
                                        <strong>{{$order->order_address->contact_no}}</strong>
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-3">
                                        <h6>Ordered on</h6>
                                        <p>{{$order->created_at->format('d M, Y')}}</p>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <h6>Order Summary</h6>
                                        <table width="100%">
                                            <tr>
                                                <td width="60%">Sub Total</td>
                                                <td width="40%">₹ {{number_format($order->sub_total, 2)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Discount</td>
                                                <td>{{$order->discount == 0 ? '₹ 0.00' : '-₹ ' . number_format($order->discount, 2)}}</td>
                                            </tr>
                                            <tr>
                                                <td>Delivery Charge</td>
                                                <td>₹ {{number_format($order->delivery_charge, 2)}}</td>
                                            </tr>
                                            @if($order->payment_mode == 'COD')
                                            <tr>
                                                <td>COD Charge</td>
                                                <td>₹ {{number_format($order->cod_charge, 2)}}</td>
                                            </tr>
                                            @endif
                                            @if($order->special_discount !=0)
                                                <tr>
                                                    <td>Special Discount</td>
                                                    <td>-₹ {{number_format($order->special_discount, 2)}}</td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td><strong>Total</strong></td>
                                                <td><strong>₹ {{number_format($order->total, 2)}}</strong></td>
                                            </tr>
                                        </table>
                                    </div>

                                </div>
                                <div class="col-12 mb-3 border">
                                    @foreach($order->orderInvoices as $invoice)
                                        <div class="d-flex py-3">
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
                                                <p>₹ {{number_format($invoice->product_total_price, 2)}}</p>
                                            </div>
                                            <div class="col-4 px-2">
                                                <p>{{$invoice->invoice_no}}</p>
                                                <h6><span class="bg-success dot"></span> {{$invoice->order_status}}</h6>
                                                @if($invoice->order_status == 'ORDER DELIVERED')<p>On {{$invoice->created_at->format('d M, Y')}}</p>
                                                <p class="text-primary">
                                                    <i class="fa fa-star"></i> Rate & Review your Order
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                @if($order->order_status == 'ORDER DELIVERED YES')
                                <div class="col-12 pt-5">
                                    <h3>Review Your Order</h3>
                                    @if($invoice->invoiceUserFeedback($invoice->user_id))
                                        <p>Rate: {{$invoice->invoiceUserFeedback($invoice->user_id)->rating}}</p>
                                        <p>Description: {{$invoice->invoiceUserFeedback($invoice->user_id)->description}}</p>
                                    @else
                                    <form class="account-details-form mt-4" action="{{url('postFeedback')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="invoice_id" value="{{$invoice->id}}">

                                        <div class="single-input-item">
                                            <label for="rating" class="required">Rating</label>
                                            <select class="selectItem" name="rating" id="rating">
                                                <option value="5">5</option>
                                                <option value="4">4</option>
                                                <option value="3">3</option>
                                                <option value="2">2</option>
                                                <option value="1">1</option>
                                            </select>
                                        </div>

                                        <div class="single-input-item">
                                            <label for="description" class="required">Description</label>
                                            <textarea name="description" id="description" rows="6"></textarea>
                                        </div>
                                        <div class="single-input-item">
                                            <button class="check-btn sqr-btn">Submit Rating</button>
                                        </div>
                                    </form>
                                        @endif
                                </div>
                                    @endif

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
        .myaccount-content p, table{
            font-size: 14px;
            line-height: 24px;
        }
        .dot {
            height: 15px;
            width: 15px;
            border-radius: 50%;
            display: inline-block;
        }
    </style>
    @if(app('request')->input('ref') == 'success')
        <script>
            fbq('track', 'Purchase',
                {
                    content_ids: [@foreach($order->orderInvoices as $cartpixel)"{{$cartpixel->invoiceProduct->id}}"{{$loop->last ? null : ','}}@endforeach],
                    currency: 'INR',  // your currency string value goes here
                    num_items: {{count($order->orderInvoices)}}, // your number of tickets purchased value goes here
                    value: {{$order->total}}, // your total transaction value goes here
                }
            );
        </script>
    @endif
@endsection
