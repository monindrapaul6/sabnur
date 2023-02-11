@extends('android.layout.app')
@section('content')

    <style>
        .cartItems .cartItem{
            border-bottom: 1px solid #e7e7e7;
            margin-bottom: 15px;
        }
        .cartItems .cartItem .quantity{
            font-size: 12px;
            font-weight: 500;
            color: #111111;
            border: 1px solid #b4b4b4;
            background-color: transparent;
            border-radius: 3px;
            padding: 2px 4px;
            width: 100%;
            text-align: center;
            margin-top: 6px;
        }
        .cartItems .cartItem .cartProductDetails{
            padding: 0 12px;
            box-sizing: border-box;
        }
        .cartItems .cartItem .cartProductDetails h4{
            font-size: 14px;
            font-weight: 500;
            color: #111111;
        }
        .cartItems .cartItem .cartPrice{
            display: flex;
        }
        .cartItems .cartItem .cartPrice span{
            font-size: 13px;
            color: #999999;
            text-decoration: line-through;
        }
        .cartItems .cartItem .cartPrice h6{
            font-size: 17px;
            color: #333333;
            font-weight: 500;
            margin: 0 10px;
        }
        .cartItems .cartItem .cartPrice p{
            font-size: 14px;
            font-weight: 400;
            color: var(--color-green);
        }
        .cartItems .cartItem .cartBtns{
            display: flex;
            border-top: 1px solid #f4f4f4;
        }
        .cartItems .cartItem .cartBtns button{
            background-color: transparent;
            font-size: 13px;
            font-weight: 500;
            color: #666666;
            border: 0;
        }
        /*global*/
        .starRating{
            color: #e38a03;
        }
        .starRating span{
            color: #999999;
            font-size: 12px;
            font-weight: 500;
        }
        /*global*/
        .cartItems .cartPriceDetails h5{
            font-size: 16px;
            color: #111111;
            font-weight: 500;
        }
        .cartItems .cartPriceDetails h3{
            font-size: 20px;
            color: #111111;
            font-weight: 500;
        }
        .cartItems .cartPriceDetails .cartPriceItem{
            font-size: 14px;
            font-weight: 500;
            color: #000;
        }
        .cartItems .cartPriceDetails .cartPriceItem span{
            font-size: 14px;
            font-weight: 400;
            color: #111111;
        }
        .cartItems .cartPriceDetails .saveAmount p{
            color: var(--color-green);
            font-size: 13px;
        }
        .placeOrderBtn{
            background-color: var(--color-green);
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            border-radius: 6px;
            padding: 6px 26px;
            border: 0;
        }
        .offerApplied{
            color: var(--color-green);
            font-size: 13px;
        }
        .textDanger{
            font-size: 13px;
            font-weight: 500;
            color: #c8123d;
        }



        .Checkout .AddressSection h4, .Checkout .cartItems h4{
            font-size: 15px;
            font-weight: 500;
            color: #111111;
        }
        .Checkout .AddressSection h5{
            font-size: 14px;
            font-weight: 500;
            color: #111111;
            margin-bottom: 8px;
        }
        .Checkout .AddressSection p{
            font-size: 12px;
            font-weight: 400;
            color: #111111;
            margin: 5px 0;
        }
        .Checkout .AddressSection button{
            width: 100%;
            font-size: 13px;
            font-weight: 600;
            background-color: #c8123d;
            color: #fff;
            border-radius: 6px;
            padding: 8px 0;
            border: 0;
        }
        .changeBtn{
            border: 1px solid var(--color-green);
            font-size: 14px;
            font-weight: 600;
            color: var(--color-green);
            padding: 4px 12px;
            background-color: transparent;
            border-radius: 4px;
        }
        .Checkout label{
            font-size: 14px;
            font-weight: 500;
        }
    </style>

    <div class="section" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="container Checkout">

            <!--address-->
            <div class="row AddressSection mb-3">
                <div class="col-12 shadow py-3">
                    <?php
                    $getAddress = Auth::user()->userDefaultAddress;
                    ?>
                    @if(isset($getAddress))
                        <h4>Deliver to:</h4>
                        <div class="col-12 mt-2">
                            <h5>{{$getAddress->name}}</h5>
                            <p>{{$getAddress->street . ', ' . $getAddress->city . ', ' . $getAddress->locality . ', ' . $getAddress->city . ', ' . $getAddress->state . ' - ' . $getAddress->zip}}</p>
                            <p><strong>{{$getAddress->contact_no}}</strong></p>
                        </div>
                        <input type="hidden" class="selectAddress" value="{{$getAddress->id}}">
                    @else
                        <div class="col-12 text-center mt-3 py-3">
                            <button onclick='window.location.href="/account/address/create?targetUrl=checkout"' style="cursor: pointer"> + Add New Address</button>
                        </div>
                    @endif
                </div>
            </div>
            <!--address-->

            <!--items-->
            <div class="row cartItems">
                <h4>Items:</h4>
                @foreach($carts as $cart)
                    <div class="col-12 mt-2 cartItem shadow py-3">
                        <div class="d-flex">
                            <div class="col-2">
                                @if($cart['product_dp'] != null)
                                    <a href="{{url('product/' . $cart['product_slug'])}}">
                                        <img src="{{$cart['product_dp']}}" class="img-fluid rounded">
                                    </a>
                                @else
                                    <img src="{{asset(\App\Models\Picture::getDefaultImage()->image_thumb)}}" class="img-fluid rounded"/>
                                @endif
                                <div class="quantity mt-1">Qty: {{$cart['product_quantity']}}</div>
                            </div>
                            <div class="col-10 cartProductDetails">
                                <h4>{{$cart['product_name']}}</h4>
                                <div class="cartPrice">
                                    <span>₹ {{number_format($cart['product_mrp'], 2)}}</span>
                                    <h6>₹ {{number_format($cart['product_current'], 2)}}</h6>
                                    <p>{{$cart['product_discount']}}% off</p>
                                </div>
                                <div class="offerApplied">Welocome Offer Applied</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!--items-->

            <!--price-->
            <div class="row cartItems">
                <div class="col-12 cartPriceDetails">
                    <h5>Price Details</h5>
                    <input type="hidden" name="zip_available" id="zip_available" value="1">
                    <input type="hidden" name="is_delivery" id="is_delivery" value="0">
                    <input type="hidden" name="is_cod" id="is_cod" value="0">
                    <div class="cartPriceItem d-flex">
                        <div class="col-6">
                            Price @if($qty > 1)
                                ({{ $qty }} Items)
                            @else
                                ({{ $qty }} item)
                            @endif
                        </div>
                        <div class="col-6 text-end">
                            ₹ {{ number_format($product_mrp_total, 2)}}
                        </div>
                    </div>
                    <div class="cartPriceItem d-flex">
                        <div class="col-6">
                            Discount
                        </div>
                        <div class="col-6 text-end">
                            - ₹ {{number_format($discount, 2)}}
                        </div>
                    </div>

                    <div class="cartPriceItem d-flex">
                        <div class="col-6">
                            Delivery Charges
                        </div>
                        <div class="col-6 text-end">
                            <div style="color: var(--color-green)">
                                @if($shipping_charge == 0)
                                    FREE
                                @else
                                    ₹ {{number_format($shipping_charge, 2)}}
                                @endif
                            </div>
                        </div>
                    </div>

                    @if($specialdiscount != 0)
                        <div class="cartPriceItem d-flex">
                            <div class="col-6">
                                {{$getoffer->offer_name}}
                            </div>
                            <div class="col-6 text-end">
                                <span style="color: var(--color-green)">- ₹ {{number_format($specialdiscount, 2)}}</span>
                            </div>
                        </div>
                    @endif

                    <div class="cartPriceItem d-flex">
                        <div class="col-6">
                            Total Amount
                        </div>
                        <div class="col-6 text-end">
                            ₹ {{number_format($total, 2)}}
                            <input type="hidden" name="sub_total" value="{{$sub_total}}"/>
                            <input type="hidden" name="total" id="total" value="{{$total}}">
                        </div>
                    </div>
                    <div class="col-12">
                        @if($discount >0)
                            <div class="saveAmount mt-4">
                                <p>You will save ₹ {{number_format($discount, 2)}} on this order</p>
                            </div>
                        @endif
                    </div>
                    <div class="col-12 py-3">
                        <div id="changeAddDiv" style="display: none">
                            <span class="textDanger mb-2">Sorry we are unable to deliver on your address</span>
                            <button class="changeBtn" onclick='window.location.href="/account/address?targetUrl=checkout"' style="cursor: pointer"> Change Address</button>
                        </div>
                    </div>
                    <div class="col-12 d-flex border-top border-bottom py-2">
                        <div class="col-6">
                            <h3>₹ {{number_format($total, 2)}}</h3>
                        </div>
                        <div class="col-6 text-end">
                            <button class="placeOrderBtn" id="makePayment" style="display: none">Make Payment</button>
                        </div>
                    </div>

                    <div class="col-12 border-top border-bottom py-2" id="paymentOptn" style="display: none">
                        <div class="billing-info mb-4">
                            <p id="codPara" class="d-flex" style="display: none">
                                <label for="cod">
                                    <input type="radio" name="paymentType" class="paymentType" id="cod" value="COD">
                                    Cash On Delivery
                                </label>
                            </p>
                            <p id="standardPara" class="d-flex" style="display: none">
                                <input type="hidden" id="order_id" value="">

                                <label for="standard">
                                    <input type="radio" name="paymentType" class="paymentType" id="standard" value="Standard">
                                    Credit Card/Debit Card/UPI/Net Banking/Wallet & other mode of payments
                                </label>
                            </p>
                        </div>

                        <div class="col-12">
                            <button class="placeOrderBtn" style="display: none" id="placeOrder">
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
            </div>
            <!--price-->

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
                    url:'/api/getdeliveryDetails',
                    data:{
                        'id': $('input[class=selectAddress]').val(),
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
                            'paymentType' : "COD",
                            'type' : "{{app('request')->input('type') == 'buynow' ? 'buynow' : 'cart'}}"
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
                                type: "{{app('request')->input('type') == 'buynow' ? 'buynow' : 'cart'}}",
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
