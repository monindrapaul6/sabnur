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
    </style>

    <div class="section" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="container cartItems">
            @if(count($carts) > 0)
                <div class="row">

                    @foreach($carts as $cart)
                    <div class="col-12 mt-2 cartItem">
                        <div class="d-flex">
                            <div class="col-2">
                                @if($cart['product_dp'] != null)
                                    <a href="{{url('product/' . $cart['product_slug'])}}">
                                        <img src="{{$cart['product_dp']}}" class="img-fluid rounded">
                                    </a>
                                @else
                                    <img src="{{asset(\App\Models\Picture::getDefaultImage()->image_thumb)}}" class="img-fluid rounded"/>
                                @endif
                                <select class="quantity" id="{{'quantity' . $cart['id']}}" data-id="{{ $cart['id'] }}">
                                    <option value="1" {{$cart['product_quantity'] == 1 ? 'selected' : null}}>1</option>
                                    <option value="2" {{$cart['product_quantity'] == 2 ? 'selected' : null}}>2</option>
                                    <option value="3" {{$cart['product_quantity'] == 3 ? 'selected' : null}}>3</option>
                                    <option value="4" {{$cart['product_quantity'] == 4 ? 'selected' : null}}>4</option>
                                    <option value="5" {{$cart['product_quantity'] == 5 ? 'selected' : null}}>5</option>
                                </select>
                            </div>
                            <div class="col-10 cartProductDetails">
                                <h4>{{$cart['product_name']}}</h4>
                                <div class="starRating">
                                    @for($i=1; $i<=5; $i++)
                                        @if($i <= $cart['product_rating'])
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                                <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                            </svg>
                                        @endif
                                    @endfor
                                    <span>({{$cart['product_num_rating']}})</span>
                                </div>
                                <div class="cartPrice">
                                    <span>₹ {{number_format($cart['product_mrp'], 2)}}</span>
                                    <h6>₹ {{number_format($cart['product_current'], 2)}}</h6>
                                    <p>{{$cart['product_discount']}}% off</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 cartBtns py-2">
                            <div class="col-12 text-end">
                                <button class="remove-from-cart" data-id="{{ $cart['id'] }}">
                                    Remove
                                </button>
                            </div>
                            <!--<div class="col-6 text-end">
                                <button id="buynowfast" class="">
                                    Buy this now
                                </button>
                            </div>-->
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="row cartPriceDetails">
                    <div class="col-12">
                        <h5>Price Details</h5>
                        <div class="cartPriceItem d-flex">
                            <div class="col-6">
                                Price @if(count($carts) > 1)
                                    ({{ count($carts) }} Items)
                                @else
                                    ({{ count($carts) }} item)
                                @endif
                            </div>
                            <div class="col-6 text-end">
                                ₹ {{number_format($mrp_total, 2)}}
                            </div>
                        </div>
                        <div class="cartPriceItem d-flex">
                            <div class="col-6">
                                Discount
                            </div>
                            <div class="col-6 text-end">
                                - ₹ {{number_format($mrp_total - $current_total, 2)}}
                            </div>
                        </div>

                        <div class="cartPriceItem d-flex">
                            <div class="col-6">
                                Delivery Charges
                            </div>
                            <div class="col-6 text-end">
                                <span style="color: var(--color-green)">FREE Delivery</span>
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
                                ₹ {{number_format($current_total - $specialdiscount, 2)}}
                            </div>
                        </div>
                        <div class="col-12">
                            @if(($mrp_total - $current_total + $specialdiscount) >0)
                                <div class="saveAmount mt-4">
                                    <p>You will save ₹ {{number_format($mrp_total - $current_total + $specialdiscount, 2)}} on this order</p>
                                </div>
                            @endif
                        </div>
                        <div class="col-12 d-flex border-top border-bottom py-2">
                            <div class="col-6">
                                <h3>₹ {{number_format($current_total - $specialdiscount, 2)}}</h3>
                            </div>
                            <div class="col-6 text-end">
                                @if(Auth::user() == null)
                                    <button class="placeOrderBtn" onclick='window.location.href="/login?target=cart"'>Place Order</button>
                                @else
                                    <button class="placeOrderBtn" onclick='window.location.href="/checkout"'>Place Order</button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-lg-9 m-auto py-5">
                        <div class="error-content text-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/2038/2038854.png" width="150" height="auto"/>
                            <h4 class="mt-4">Cart is empty</h4>
                            <button class="btn btn-primary" onclick='window.location.href="/categories"'>Start Shopping</button>
                        </div>
                    </div>
                </div>
            @endif


            <script type="text/javascript">
                $('.quantity').change(function (e) {
                    e.preventDefault();
                    var ele = $(this);
                    $.ajax({
                        url: '{{ url('updateCart') }}',
                        method: "patch",
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: ele.attr("data-id"),
                            /*quantity: ele.parents("div").find(".quantity" + ele.attr("data-id").val())*/
                            quantity: $('#quantity' + ele.attr("data-id")).val()
                        },
                        success: function (response) {
                            window.location.reload();
                        }
                    });
                });
                $(".remove-from-cart").click(function (e) {
                    e.preventDefault();
                    var ele = $(this);
                    if(confirm("Are you sure")) {
                        $.ajax({
                            url: '{{ url('removeCart') }}',
                            method: "DELETE",
                            data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                            success: function (response) {
                                //console.log(response);
                                window.location.reload();
                            }
                        });
                    }
                });
                $('#buynowfast').click(function (){
                    var id = $('#id').val();
                    var quantity = $('#quantity').val();

                    varUrl = "{{url('checkout')}}" + '/?type=buynow&product_id=' + id + '&quantity=' + quantity;
                    window.location.href = varUrl;
                    return false;
                });
            </script>


@endsection




