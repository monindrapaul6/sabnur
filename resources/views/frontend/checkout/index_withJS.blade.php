@extends('frontend.layout.app')
@section('content')

    <h1>Checkout</h1>

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
            <h3>Delivery Address</h3>
            <div>
                Default Address:
                <p id="setAddress"></p>
                <span id="changeAddress">Change</span>
            </div>
            @if(count($addresses) > 0)
                @foreach($addresses as $address)
                    <p>
                        <input type="radio" name="addressId" class="selectAddress" value="{{$address->id}}" id="{{'address' . $address->id}}" data-sample-id="{{$address->name . ' - ' . $address->zip}}">
                        <label for="{{'address' . $address->id}}">{{$address->name . ' - ' . $address->zip}}</label>
                    </p>
                @endforeach
                    <span class="selectAddressBtn">Deliver Here</span>
            @else
                <a href="{{url('/address/create')}}">Create address</a>
            @endif
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
                        <img src="{{ asset($cart->cart_product->product_dp->product_image_thumb) }}"><span class="imgspan">{{ $cart->product_quantity }}</span>
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
            <span id="selectProducts">Make Payment</span>
        </div>
        <div style="width: 100%; border-bottom: 1px solid #666666">
            <h3>Payment</h3>
            <p id="codPara" style="display: none">
                <input type="radio" name="paymentType" id="cod" value="COD"> <label for="cod">COD</label>
            </p>
            <p id="standardPara" style="display: none">
                <input type="radio" name="paymentType" id="standard" value="Standard"> <label for="standard">Standard</label>
            </p>
            <span id="makeOrder">Make Order</span>
            <button type="submit" id="submitBtn">Place Order</button>
            <h6 id="submitErrorMsg" style="display: none">Sorry your zip is not availabe</h6>
        </div>
    </div>

    <div style="width: 50%; float: left">
            <div class="col-8 col-sm-8 p-0 m-0 float-left">
                <input type="hidden" name="zip_available" id="zip_available" value="1">
                <input type="hidden" name="is_delivery" id="is_delivery" value="0">
                <input type="hidden" name="is_cod" id="is_cod" value="0">
                <input type="text" name="address_id" id="address_id" value="">
                <p>Price ({{$qty}} Items): Rs. {{ number_format($product_mrp_total, 2)}}
                    <input type="text" name="sub_total" id="sub_total" value="{{$product_mrp_total}}">
                </p>
                <p>
                    Discount: {{number_format($product_mrp_total - $product_current_total, 2)}}
                    <input type="text" name="discount" id="discount" value="{{$product_mrp_total - $product_current_total}}">
                </p>
                <!--<p>
                    Total Amount: {{number_format($product_current_total, 2)}}
                    <input type="text" name="total" id="total" value="{{$product_current_total}}">
                </p>-->
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
    <script type = "text/javascript">
        $(document).ready(function (){
            $('.selectAddressBtn').click(function (){
                /*var getAddressId = $('.selectAddress').val();*/
                var getAddress = $('.selectAddress').data("sample-id");
                var getAddressId = $('input[class=selectAddress]:checked', '#myForm').val();

                sessionStorage.setItem('address_id', getAddressId);
                sessionStorage.setItem('address', getAddress);
                sessionStorage.setItem('user_id', "{{Auth::user()->id}}");

                $('#address_id').val(sessionStorage.getItem('address_id'));
                $('#setAddress').html(sessionStorage.getItem('address'));
            });

            $('#selectProducts').click(function (){
                $.ajax({
                    url:'api/getdeliveryDetails',
                    data:{
                        'id': sessionStorage.getItem('address_id'),
                        'user_id': "{{Auth::user()->id}}"
                    },
                    type:'post',
                    success:  function (response) {
                        $('#zip_available').val(response.zip_available);
                        $('#is_delivery').val(response.is_delivery);
                        $('#is_cod').val(response.is_cod);

                        if(response.is_cod === 1){
                            $('#codPara').show();
                            $('#standardPara').show();
                        }
                        else {
                            $('#codPara').hide();
                            $('#standardPara').show();
                        }
                    },
                    statusCode: {
                        404: function() {
                            alert('web not found');
                        }
                    },
                    error:function(x,xs,xt){
                        window.open(JSON.stringify(x));
                    }
                });
            });
            $('#cod').click(function (){
                alert("COD");
            });
            $('#makeOrder').click(function (e){
                e.preventDefault();
                var paymentType = $('#paymentType').val();

                if(paymentType === undefined){
                    return false;
                }
                alert(paymentType);
            });
        });
    </script>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var SITEURL = '{{URL::to('')}}';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('body').on('click', '#standard', function(e){
            var totalAmount = $(this).attr("data-amount");
            var product_id =  $(this).attr("data-id");
            var totalAmount = 10000;
            var options = {
                "key": "{{ Config::get('custom.razor_key') }}",
                "amount": (totalAmount*100), // 2000 paise = INR 20
                "name": "Sundarini Naturals",
                "description": "Payment for Sundarini Naturals",
                "image": "{{asset('public/assets/public/images/products/thumb/default-product-sundarini.png')}}",
                "handler": function (response){
                    $.ajax({
                        url: "{{url('/')}}" + '/' + 'payment',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            invoice_id: "1",
                            razorpay_payment_id: "1",
                            totalAmount : 10000,
                            product_id : product_id,
                        },
                        success: function (msg) {
                            window.location.href = "{{url('/')}}" + '/' + 'success/' + {{"1"}};
                        }
                    });
                },
                "prefill": {
                    "contact": '+91 8013647571',
                    "email":   'customercare@sundarini.organic',
                },
                "theme": {
                    "color": "#626e13"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        });
    </script>

@endsection
