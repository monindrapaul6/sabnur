@extends('frontend.layout.applight')
@section('content')

    <!--<div class="col-12 d-inline-block">
    <form action="{{url('/checkoutPost')}}" method="post" id="myForm">
        @csrf
    <div style="width: 50%; float: left">
        <div style="width: 100%; border-bottom: 1px solid #666666">
            <h3>Login</h3>
            <p>
                {{Auth::user()->name}}: {{Auth::user()->mobile}}
            </p>
        </div>
        <div style="width: 100%; border-bottom: 1px solid #666666">
            <div>
                Default Address:
            </div>
            @if(count($addresses) > 0)
                @foreach($addresses as $address)
                    <p>
                        <input type="radio" name="address_id" class="selectAddress" value="{{$address->id}}" id="{{'address' . $address->id}}"
                               {{$address->is_primary == true ? 'checked' : null}}>
                        <label for="{{'address' . $address->id}}">{{$address->name . ' - ' . $address->zip}}</label>
                    </p>
                @endforeach
            @else
                <a href="{{url('/address/create')}}">Create address</a>
            @endif
            <span class="btn btn-primary" id="selectAddress">Deliver Here</span>
        </div>
        <div style="width: 100%; border-bottom: 1px solid #666666">
            <h3>Order Summary</h3>
            <?php
            $product_mrp_total = 0;
            $product_current_total = 0;
            $discount = 0;
            $sub_total = 0;
            $total = 0;
            $qty = 0;
            ?>
            @foreach($carts as $cart)
                <?php $product_mrp_total += $cart->cart_product->product_mrp_price * $cart->product_quantity ?>
                <?php $product_current_total += $cart->cart_product->product_current_price * $cart->product_quantity ?>
                <?php $qty = $qty + $cart->product_quantity;?>

                <input type="hidden" name="ids[]" value="{{$cart->product_id}}">
                <input type="hidden" name="quantity[]" value="{{$cart->product_quantity}}">
                <input type="hidden" name="product_total_price[]" value="{{$cart->cart_product->product_current_price * $cart->product_quantity}}">

                <div class="col-12 p-0 mx-0 mt-0 mb-3 d-inline-block">
                    <div class="col-2 p-0 m-0 float-left">
                        @isset($cart->cart_product->productDPImage->image_thumb)
                        <img src="{{ asset($cart->cart_product->productDPImage->image_thumb) }}"><span class="imgspan">{{ $cart->product_quantity }}</span>
                        @endif
                    </div>
                    <div class="col-7 col-sm-7 py-0 pl-5 pr-0 m-0 float-left">
                        {{$cart->cart_product->product_name}}
                    </div>
                    <div class="col-3 col-sm-3 p-0 m-0 float-right text-right">
                        {{$cart->cart_product->product_current_price . 'x'. $cart->product_quantity}} => Rs. {{ number_format($cart->cart_product->product_current_price * $cart->product_quantity, 2) }}
                    </div>
                </div>
            @endforeach
            <?php
            $total = $product_current_total +  $shipping_charge;
            ?>
            <span class="btn btn-primary" id="makePayment" style="display: none">Make Payment</span>
        </div>
        <div style="width: 100%; border-bottom: 1px solid #666666">
            <h3>Payment</h3>
            <p id="codPara" style="display: none">
                <input type="radio" name="paymentType" class="paymentType" id="cod" value="COD"> <label for="cod">COD</label>
            </p>
            <p id="standardPara" style="display: none">
                <input type="radio" name="paymentType" class="paymentType" id="standard" value="Standard"> <label for="standard">Standard</label>
            </p>
            <button class="btn btn-primary" style="display: none" id="placeOrder">Place Order</button>
            <h6 id="submitErrorMsg" style="display: none">Sorry your zip is not availabe</h6>
        </div>
    </div>

    <div style="width: 50%; float: left">
            <div class="col-8 col-sm-8 p-0 m-0 float-left">
                <input type="hidden" name="zip_available" id="zip_available" value="1">
                <input type="hidden" name="is_delivery" id="is_delivery" value="0">
                <input type="hidden" name="is_cod" id="is_cod" value="0">
                <p>Price ({{$qty}} Items): Rs. {{ number_format($product_mrp_total, 2)}}
                    <input type="text" name="sub_total" id="sub_total" value="{{$product_mrp_total}}">
                </p>
                <p>
                    Discount: {{number_format($product_mrp_total - $product_current_total, 2)}}
                    <input type="text" name="discount" id="discount" value="{{$product_mrp_total - $product_current_total}}">
                </p>
                <p>
                    Delivery Charge: {{ $shipping_charge == 0 ? 'FREE' : number_format($shipping_charge, 2)}}
                    <input type="text" name="delivery_charge" id="delivery_charge" value="{{$shipping_charge}}">
                </p>
                <p>
                    Total: {{ $total }}
                    <input type="hidden" name="sub_total" value="{{$product_current_total}}"/>
                    <input type="text" name="total" id="total" value="{{$total}}">
                </p>
            </div>
    </div>
    </form>
    </div>-->

        <main class="main-content">
            <form action="{{url('/checkoutPost')}}" method="post" id="myForm">
            @csrf
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
                        <div class="col-lg-7">
                            <div class="billing-info-wrap border-bottom">
                                <h3>Login</h3>
                                <div class="row">
                                    <div class="col-12">
                                        <img src="{{asset('static/images/checkmark.png')}}" width="25px" height="25px" class="float-end"/>
                                        <div class="billing-info mb-4">
                                            {{Auth::user()->name}}: <strong>{{Auth::user()->mobile}}</strong>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="billing-info-wrap border-bottom mt-3">
                                <h3>Select Address</h3>

                                <div class="row">
                                    @if(count($addresses) > 0)
                                        @foreach($addresses as $address)
                                    <div class="col-12">
                                        <div class="billing-info mb-4">
                                            <input type="radio" name="address_id" class="selectAddress" value="{{$address->id}}" id="{{'address' . $address->id}}"
                                                {{$address->is_primary == true ? 'checked' : null}}>
                                            <label for="{{'address' . $address->id}}">{{$address->name . ' - ' . $address->zip}}</label>
                                        </div>
                                    </div>
                                        @endforeach
                                    @else
                                        <a href="{{url('/address/create')}}">Create address</a>
                                    @endif
                                        <span class="btn btn-primary" id="selectAddress">Deliver Here</span>
                                </div>
                            </div>

                            <div class="billing-info-wrap border-bottom mt-3 pb-3">
                                <h3>Order Summary</h3>

                                <div class="row">
                                    <?php
                                    $product_mrp_total = 0;
                                    $product_current_total = 0;
                                    $discount = 0;
                                    $sub_total = 0;
                                    $total = 0;
                                    $qty = 0;
                                    ?>
                                        @foreach($carts as $cart)
                                            <?php $product_mrp_total += $cart->cart_product->product_mrp_price * $cart->product_quantity ?>
                                            <?php $product_current_total += $cart->cart_product->product_current_price * $cart->product_quantity ?>
                                            <?php $qty = $qty + $cart->product_quantity;?>

                                            <input type="hidden" name="ids[]" value="{{$cart->product_id}}">
                                            <input type="hidden" name="quantity[]" value="{{$cart->product_quantity}}">
                                            <input type="hidden" name="product_total_price[]" value="{{$cart->cart_product->product_current_price * $cart->product_quantity}}">
                                    <div class="col-12 mt-3 pb-3 d-flex">
                                        <div class="col-2">
                                            @isset($cart->cart_product->productDPImage->image_thumb)
                                                <img src="{{ asset($cart->cart_product->productDPImage->image_thumb) }}"/>
                                            @endif
                                        </div>
                                        <div class="col-4" style="text-align: right">
                                            <strong>{{$cart->cart_product->product_name}}</strong>
                                        </div>
                                        <div class="col-3" style="text-align: right">
                                            <!--Price: Rs. {{number_format($cart->cart_product->product_current_price, 2)}}-->
                                            Quantity: <strong>{{$cart->product_quantity}}</strong>
                                        </div>
                                        <div class="col-3" style="text-align: right">
                                            <strong>Rs. {{ number_format($cart->cart_product->product_current_price * $cart->product_quantity, 2) }}</strong>
                                        </div>
                                    </div>

                                        @endforeach
                                        <?php
                                        $total = $product_current_total +  $shipping_charge;
                                        ?>

                                        <span class="btn btn-primary" id="makePayment" style="display: none">Make Payment</span>
                                </div>
                            </div>

                            <div class="billing-info-wrap border-bottom mt-3">
                                <h3>Payment</h3>

                                <div class="row">

                                    <div class="col-12">
                                        <div class="billing-info mb-4">
                                            <p id="codPara" style="display: none">
                                                <input type="radio" name="paymentType" class="paymentType" id="cod" value="COD">
                                                <label for="cod">Cash On Delivery</label>
                                            </p>
                                            <p id="standardPara" style="display: none">
                                                <input type="radio" name="paymentType" class="paymentType" id="standard" value="Standard">
                                                <label for="standard">Credit Card/Debit Card/UPI/Net Banking/Wallet & other mode of payments</label>
                                            </p>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary" style="display: none" id="placeOrder">Place Order</button>
                                    <h6 id="submitErrorMsg" style="display: none">Sorry your zip is not availabe</h6>
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
                                            <input type="hidden" name="sub_total" id="sub_total" value="{{$product_mrp_total}}">
                                        </div>

                                        <div class="your-order-subtotal">
                                            <h3>Discount
                                                <span class="text-success"> - Rs. {{number_format($product_mrp_total - $product_current_total, 2)}}</span>
                                            </h3>
                                            <input type="hidden" name="discount" id="discount" value="{{$product_mrp_total - $product_current_total}}">
                                        </div>

                                        <div class="your-order-subtotal">
                                            <h3>Delivery Charge
                                                @if($shipping_charge == 0)
                                                    <span class="text-success">FREE</span>
                                                @else
                                                    <span>Rs. {{number_format($shipping_charge, 2)}}</span>
                                                @endif
                                            </h3>
                                            <input type="hidden" name="delivery_charge" id="delivery_charge" value="{{$shipping_charge}}">

                                        </div>

                                        <div class="your-order-total">
                                            <h3>Total <span>Rs. {{number_format($total, 2)}} </span></h3>
                                            <input type="hidden" name="sub_total" value="{{$product_current_total}}"/>
                                            <input type="hidden" name="total" id="total" value="{{$total}}">
                                        </div>
                                    </div>
                                    <div class="payment-condition">
                                        <p>Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="shop-checkout.html">privacy policy</a>.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </main>


    <script type = "text/javascript">
        $(document).ready(function (){
            $('#placeOrder').hide();
            $('#makePayment').hide();

            $('input:radio[name="address_id"]').change(function(){
                $('#makePayment').hide();
                $('#selectAddress').show();
                $('#placeOrder').hide();
                $('#codPara').hide();
                $('#standardPara').hide();
            });

            $('#selectAddress').click(function (){
                $('#makePayment').show();
                $('#selectAddress').hide();
                $('#placeOrder').hide();
                $('#codPara').hide();
                $('#standardPara').hide();
                $('#cod').prop('checked', false);
                $('#standard').prop('checked', false);
            });

            $('#makePayment').click(function (){
                $('#makePayment').hide();
                $.ajax({
                    url:'api/getdeliveryDetails',
                    data:{
                        'id': $('input[class=selectAddress]:checked').val(),
                        'user_id': "{{Auth::user()->id}}"
                    },
                    type:'post',
                    success:  function (response) {
                        $('#zip_available').val(response.zip_available);
                        $('#is_delivery').val(response.is_delivery);
                        $('#is_cod').val(response.is_cod);

                        if(response.is_delivery === 0){
                            alert('Sorry we donot deliver to this zip code');
                            return false;
                        }

                        if(response.is_cod === 1){
                            $('#codPara').show();
                            $('#standardPara').show();
                        }
                        else {
                            $('#codPara').hide();
                            $('#standardPara').show();
                        }
                        $('#placeOrder').show();
                    },
                    error:function(x,xs,xt){
                        window.open(JSON.stringify(x));
                    }
                });
            });
        });
    </script>
@endsection
