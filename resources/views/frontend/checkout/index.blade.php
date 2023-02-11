@extends('frontend.layout.applight')
@section('content')

        <main class="main-content">
            <!--<form action="{{url('/checkoutPost')}}" method="post" id="myForm">
            @csrf-->
            <!--== Start Checkout Area Wrapper ==-->
            <div class="section-space shop-checkout-area">
                <div class="container">
                    <!--<div class="row">
                        <div class="col-lg-12">
                            <div class="checkout-coupon-wrap mb-8 mb-lg-10 pb-lg-2">
                                <p class="cart-page-title">Have a coupon? <a class="checkout-coupon-active" href="#/">Click here to enter your code</a></p>
                                <form class="checkout-coupon-content" action="#">
                                    <p>If you have a coupon code, please apply it below.</p>
                                    <input type="text" placeholder="Coupon code">
                                    <button type="submit">Apply coupon</button>
                                </form>
                            </div>
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col-lg-7 px-0">

                            <!--Logged in-->
                            @include('frontend.checkout.loggedIn')
                            <!--Logged in-->

                            <!--address-->
                            @include('frontend.checkout.address')
                            <!--address-->

                            <div class="billing-info-wrap bg-white shadow px-4 py-2 mb-3">
                                <h4>Order Summary
                                    @isset(Auth::user()->userDefaultAddress)<img src="{{asset('static/images/checkmark.png')}}" width="14" height="14" class="pl-3"/>@endisset
                                </h4>

                                <div class="row">
                                    @foreach($carts as $cart)
                                        <div class="col-12 mt-3 pb-3 d-flex cartItem">
                                            <div class="col-2">
                                                @if($cart['product_dp'] != null)
                                                    <img src="{{ $cart['product_dp'] }}" class="img-fluid rounded"/>
                                                @endif
                                            </div>
                                            <div class="col-4" style="text-align: right">
                                                <strong>{{$cart['product_name']}}</strong>
                                            </div>
                                            <div class="col-3" style="text-align: right">
                                                <span class="d-block">₹ {{number_format($cart['product_current'], 2)}}</span>
                                                Quantity: <strong>{{$cart['product_quantity']}}</strong>
                                            </div>
                                            <div class="col-3" style="text-align: right">
                                                @if($cart['special_discount'] == 0)
                                                <strong>₹ {{ number_format($cart['product_total'], 2) }}</strong>
                                                @else
                                                    <del class="d-block">₹ {{ number_format($cart['product_total'], 2) }}</del>
                                                    <span class="product-total text-primary">₹ {{number_format($cart['special_total'], 2)}}</span>
                                                    <span class="badge bg-success text-wrap">{{$getoffer->offer_name}} Applied</span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    <style>
                                        .cartItem{
                                            font-size: 14px; font-weight: 500;
                                        }
                                    </style>

                                    <span class="btn btn-primary" id="makePayment" style="display: none">Make Payment</span>
                                        <div id="changeAddDiv" style="display: none">
                                            <span class="text-danger mb-2">Sorry we are unable to deliver on your address</span>
                                            <div class="col-12 bg-gray-light py-3 text-center" onclick='window.location.href="/account/address?targetUrl=checkout"' style="cursor: pointer"> Change Address</div>
                                        </div>
                                </div>
                            </div>


                            <div class="billing-info-wrap bg-white shadow px-4 py-2 mb-3">
                                <h4>Payment
                                    <img id="paymentIcon" src="{{asset('static/images/checkmark.png')}}" width="14" height="14" class="pl-3" style="display: none"/>
                                </h4>
                                <div class="row">
                                    <div class="col-12" id="paymentOptn" style="display: none">
                                        <div class="billing-info mb-4">
                                            <p id="codPara" style="display: none">
                                                <input type="radio" name="paymentType" class="paymentType" id="cod" value="COD">
                                                <label for="cod">Cash On Delivery</label>
                                            </p>
                                            <p id="standardPara" style="display: none">
                                                <input type="hidden" id="order_id" value="">
                                                <input type="radio" name="paymentType" class="paymentType" id="standard" value="Standard">
                                                <label for="standard">Credit Card/Debit Card/UPI/Net Banking/Wallet & other mode of payments</label>
                                            </p>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" style="display: none" id="placeOrder">
                                        <span id="loadingMsg">
                                            <img src="/static/images/loader.gif" width="20" height="20" class="mr-3"/>
                                            Placing Order..
                                        </span>
                                        <span id="unloadingMsg">
                                            Place Order
                                        </span>
                                    </button>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-5">
                            <div class="your-order-area mt-10 mt-lg-0">
                                <div class="your-order-wrap">
                                    <div class="your-order-info-wrap">
                                        <input type="hidden" name="zip_available" id="zip_available" value="1">
                                        <input type="hidden" name="is_delivery" id="is_delivery" value="0">
                                        <input type="hidden" name="is_cod" id="is_cod" value="0">

                                        <div class="your-order-subtotal border-top-0">
                                            <h3>Price @if($qty > 1)
                                                    ({{ $qty }} Items)
                                                @else
                                                    ({{ $qty }} item)
                                                @endif
                                                <span>Rs. {{ number_format($product_mrp_total, 2)}}</span>
                                            </h3>
                                        </div>

                                        <div class="your-order-subtotal">
                                            <h3>Discount
                                                <span class="text-success"> - Rs. {{number_format($discount, 2)}}</span>
                                            </h3>
                                        </div>

                                        <div class="your-order-subtotal">
                                            <h3>Delivery Charge
                                                @if($shipping_charge == 0)
                                                    <span class="text-success">FREE</span>
                                                @else
                                                    <span>Rs. {{number_format($shipping_charge, 2)}}</span>
                                                @endif
                                            </h3>
                                        </div>

                                        @if($specialdiscount != 0)
                                        <div class="your-order-subtotal">
                                            <h3>{{$getoffer->offer_name}}
                                                <span class="text-success"> - Rs. {{number_format($specialdiscount, 2)}}</span>
                                            </h3>
                                        </div>
                                        @endif

                                        <div class="your-order-total">
                                            <h3>Total <span>Rs. {{number_format($total, 2)}} </span></h3>
                                            <input type="hidden" name="sub_total" value="{{$sub_total}}"/>
                                            <input type="hidden" name="total" id="total" value="{{$total}}">
                                        </div>
                                    </div>
                                    <div class="payment-condition">
                                        <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="{{url('privacy-policy')}}">privacy policy</a>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--</form>-->
        </main>

        <script>
            fbq('track', 'InitiateCheckout', {
                content_ids: [@foreach($carts as $cartpixel)"{{$cartpixel['product_id']}}"{{$loop->last ? null : ','}}@endforeach],
            });
        </script>

        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script type = "text/javascript">
        $(document).ready(function (){
            $('#loadingMsg').hide();
            $('#unloadingMsg').show();
            $('#makePayment').hide();

            var primaryId = "{{isset(Auth::user()->userDefaultAddress) ? Auth::user()->userDefaultAddress->id : 'null'}}";

            if(primaryId === 'null') {
                return false;
            }
            else{
                $('#makePayment').show();
            }

            $('#makePayment').click(function (){
                $.ajax({
                    url:'api/getdeliveryDetails',
                    data:{
                        'id': $('input[class=selectAddress]:checked').val(),
                        'user_id': "{{Auth::user()->id}}"
                    },
                    type:'post',
                    success:  function (response) {
                        $('#makePayment').hide();
                        $('#paymentIcon').show();

                        if(response.is_delivery === 0){
                            $('#makePayment').hide();
                            $('#changeAddDiv').show();
                            $('#paymentOptn').hide();
                            $('#placeOrder').hide();
                        }
                        else{
                            $('#paymentOptn').show();
                            $('#placeOrder').show();
                        }

                        if(response.is_cod === 1){
                            $('#codPara').show();
                            $('#standardPara').show();
                        }
                        else {
                            $('#codPara').hide();
                            $('#standardPara').show();
                        }
                    },
                    error:function(x,xs,xt){
                        window.open(JSON.stringify(x));
                    }
                });
            });

            $('#standard').click(function (){
                var totalValue = $('#total').val();
                $.ajax({
                    url:'/api/createOrder',
                    data:{
                        'amount' : totalValue
                    },
                    type:'post',
                    beforeSend: function() {
                        $('#loadingMsg').show();
                        $('#unloadingMsg').hide();
                        $("#placeOrder").prop('disabled', true); // disable button
                    },
                    success:  function (response) {
                        $('#order_id').val(response.id)
                        $('#loadingMsg').hide();
                        $('#unloadingMsg').show();
                        $("#placeOrder").prop('disabled', false); // enable button
                    },
                    error:function(x,xs,xt){
                        window.open(JSON.stringify(x));
                    }
                });
            })

            $('#placeOrder').click(function (e){
                e.preventDefault();

                var paymentType = $('input[class=paymentType]:checked').val();

                if(paymentType === 'Standard'){
                    return makePayment();
                }

                if(paymentType === 'COD'){
                    $.ajax({
                        url:'/api/createInvoice',
                        data:{
                            'user_id': "{{Auth::user()->id}}",
                            'paymentType' : "COD"
                        },
                        type:'post',
                        beforeSend: function() {
                            $('#loadingMsg').show();
                            $('#unloadingMsg').hide();
                            $("#placeOrder").prop('disabled', true);
                        },
                        success:  function (response) {
                            window.location.href = "{{url('/')}}" + '/account/order/' + response.order_id + '?ref=success';
                            $('#loadingMsg').hide();
                            $('#unloadingMsg').show();
                            $("#placeOrder").prop('disabled', false); // enable button
                        },
                        error:function(x,xs,xt){
                            window.open(JSON.stringify(x));
                        }
                    });
                }

            });

            function makePayment (e){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                var totalAmount = "{{$total}}";
                var options = {
                    "key": "{{ Config::get('razorpay.key') }}",
                    "amount": (totalAmount * 100), // 2000 paise = INR 20
                    "name": "Aplus Device",
                    "description": "Payment for Aplus Device",
                    "image": "{{asset('backend/images/A-pluslogo.png')}}",
                    "order_id": $('#order_id').val(),
                    "handler": function (response){
                        /*alert(response.razorpay_payment_id);
                        alert(response.razorpay_order_id);
                        alert(response.razorpay_signature);*/
                        $.ajax({
                            url: "{{url('/')}}" + '/api/createInvoice',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                user_id: "{{Auth::user()->id}}",
                                paymentType: "Standard",
                                razorpay_order_id: response.razorpay_order_id,
                                razorpay_payment_id: response.razorpay_payment_id,
                                razorpay_signature: response.razorpay_signature,
                                totalAmount : totalAmount
                            },
                            success: function (response) {
                                window.location.href = "{{url('/')}}" + '/account/order/' + response.order_id + '?ref=success';
                            }
                        });
                    },
                    "prefill": {
                        "contact": "{{Auth::user()->mobile}}",
                        "email":   "{{isset(Auth::user()->email) ? Auth::user()->email : 'info@aplusdevice.com'}}",
                    },
                    "theme": {
                        "color": "#626e13"
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
                e.preventDefault();
            }
        });
    </script>
@endsection
