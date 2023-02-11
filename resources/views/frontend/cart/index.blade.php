@extends('frontend.layout.applight')
@section('content')
     <main class="main-content">

            @if(count($carts) > 0)

            <div class="product-area section-space">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="col-12 mb-10">
                                <h3>Shopping Cart</h3>
                            </div>
                            @foreach($carts as $cart)
                            <div class="col-12 d-flex mb-10 border-bottom pb-5">
                                <div class="col-2">
                                    <a href="{{url('product/' . $cart['product_slug'])}}">
                                        @if($cart['product_dp'] != null)
                                            <img class="w-100" src="{{$cart['product_dp']}}" alt="Image" width="96" height="96">
                                        @endif
                                    </a>
                                </div>
                                <div class="col-7 col-md-8 px-2">
                                    <h6>{{$cart['product_name']}}</h6>
                                    <span class="amount">₹ {{number_format($cart['product_current'], 2)}}</span>
                                    <div class="d-flex py-3">
                                        <select class="quantity" id="{{'quantity' . $cart['id']}}" data-id="{{ $cart['id'] }}">
                                            <option value="1" {{$cart['product_quantity'] == 1 ? 'selected' : null}}>1</option>
                                            <!--<option value="2" {{$cart['product_quantity'] == 2 ? 'selected' : null}}>2</option>
                                            <option value="3" {{$cart['product_quantity'] == 3 ? 'selected' : null}}>3</option>
                                            <option value="4" {{$cart['product_quantity'] == 4 ? 'selected' : null}}>4</option>
                                            <option value="5" {{$cart['product_quantity'] == 5 ? 'selected' : null}}>5</option>-->
                                        </select>
                                        <span class="px-5 remove-from-cart" data-id="{{ $cart['id'] }}"><i class="fa fa-trash-o"></i></span>
                                    </div>
                                </div>
                                <div class="col-3 col-md-2 text-end">
                                    @if($cart['special_discount'] == 0)
                                        <span class="product-total">₹ {{number_format($cart['product_total'], 2)}}</span>
                                    @else
                                        <del class="product-total d-block">₹ {{number_format($cart['product_total'], 2)}}</del>
                                        <span class="product-total text-primary">₹ {{number_format($cart['special_total'], 2)}}</span>
                                        <span class="badge bg-success text-wrap">{{$getoffer->offer_name}} Applied</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                            <div class="col-12 text-end">
                                @if(Auth::user() == null)
                                    <button class="btn btn-link col-12 col-md-2" onclick='window.location.href="/login?target=cart"'>Checkout <i class="fa fa-angle-right"></i> </button>
                                @else
                                    <button class="btn btn-link col-12 col-md-2" onclick='window.location.href="/checkout"'>Checkout <i class="fa fa-angle-right"></i> </button>
                                @endif
                            </div>
                        </div>
                        <style>
                            .amount{
                                font-size: 13px;
                                font-weight: 600;
                            }
                            .quantity{
                                font-size: 13px;
                                font-weight: 600;
                                margin-right: 20px;
                            }
                            .remove-from-cart {
                                cursor: pointer;
                                border-left: 1px solid #CCCCCC;
                            }
                            .product-total{
                                font-size: 15px;
                                font-weight: 600;
                            }
                        </style>
                        <div class="col-lg-4">
                            <div class="grand-total-wrap mt-10 mt-lg-0">
                                <div class="grand-total-content">
                                    <h5>Price @if(count($carts) > 1)
                                            ({{ count($carts) }} Items)
                                        @else
                                            ({{ count($carts) }} item)
                                        @endif <span>₹ {{number_format($mrp_total, 2)}}</span>
                                    </h5>
                                    <h5 class="mt-2">Discount <span class="text-success">- ₹ {{number_format($mrp_total - $current_total, 2)}}</span></h5>
                                    @if($specialdiscount != 0)<h5 class="mt-2">{{$getoffer->offer_name}} <span class="text-success">- ₹ {{number_format($specialdiscount, 2)}}</span></h5>@endif
                                    <div class="grand-total mt-4">
                                        <h4>Total <span>₹ {{number_format($current_total - $specialdiscount, 2)}}</span></h4>
                                    </div>
                                    @if(($mrp_total - $current_total + $specialdiscount) >0)
                                    <div class="grand-total mt-4">
                                        <h6 class="text-success">You will save ₹ {{number_format($mrp_total - $current_total + $specialdiscount, 2)}} on this order</h6>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @else
                <div class="page-not-found-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9 m-auto">
                                <div class="error-content text-center">
                                    <h1>No Item in Cart</h1>
                                    <button class="btn btn-primary" onclick='window.location.href="/"'>Start Shopping</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </main>
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
    </script>
@endsection
