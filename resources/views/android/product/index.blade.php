@extends('android.layout.app')
@section('content')

    <style>
        .productImg{
            width: 80%;
            height: auto;
            border-radius: 6px;
        }
        h1{
            font-size: var(--font-size-base);
            color: #111111;
        }
        .starRating{
            color: #e38a03;
        }
        .starRating span{
            color: #666666;
            font-size: 13px;
            font-weight: 500;
        }
        .numRating{
            font-size: 13px;
            font-weight: 500;
            color: #111111;
        }
        .productCategory p{
            font-size: var(--font-size-sm);
            color: #111111;
            font-weight: 500;
        }
        .productCategory p a{
            color: #666666;
            text-decoration: none;
        }
        .productPrice .discountPrice{
            color: #f00000;
            font-size: 18px;
            font-weight: 400;
        }
        .productPrice .productCurrentPrice{
            font-size: var(--font-size-xl);
            color: var(--color-green);
        }
        .productPrice h4{
            color: #666666;
            font-size: 14px;
            text-decoration: line-through;
            font-weight: 400;
        }
        .productButtons{
            display: flex;
        }
        .productButtons .buynowBtn, .productButtons .addcartBtn{
            width: 96%;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 500;
            padding: 4px 8px;
            box-sizing: border-box;
        }
        .productButtons .buynowBtn{
            border: 2px solid var(--color-green);
            background-color: #fff;
            color: var(--color-green);
        }
        .productButtons .addcartBtn{
            border: 2px solid var(--color-green);
            background-color: var(--color-green);
            color: #fff;
        }
        .Details h5, .Reviews h5{
            font-size: 16px;
            color: #111111;
        }
        .Details p{
            font-size: 13px;
            font-weight: 400;
            color: #666666;
        }
        .Reviews .allratings img{
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }
        .Reviews .allratings h6{
            font-size: 14px;
            font-weight: 500;
            color: #111111;
            margin-bottom: 0;
        }
        .Reviews .allratings span{
            font-size: 12px;
            font-weight: 400;
            color: #999999;
        }
        .Reviews .allratings p{
            font-size: 14px;
            font-weight: 400;
            color: #333333;
        }
        .Reviews .allreviewLink a{
            text-align: center;
            color: var(--color-green);
            text-decoration: none;
        }
    </style>

    <div class="section" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-2 text-center">
                    <img src="{{isset($product->productDpImage->image_full) ? asset($product->productDPImage->image_thumb) : asset(\App\Models\Picture::getDefaultImage()->image_full) }}" class="productImg"/>
                </div>
                <div class="col-12 mt-3">
                    <h1>
                        {{$product->product_name}}

                    </h1>
                    <div class="starRating">
                        @for($i=1; $i<=5; $i++)
                            @if($i <= $product->rating)
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                </svg>
                            @endif
                        @endfor
                        <span>({{round($product->rating, 1)}})</span>
                    </div>
                    <div class="productCategory py-2">
                        <p>Category: <a href="{{url('/categories/' . $product->product_category->category_slug)}}">{{$product->product_category->category_name}}</a></p>
                    </div>

                    <div class="productPrice">
                        <div class="d-flex">
                            @if($product->product_discount > 0)<span class="discountPrice">{{'-' . $product->product_discount}}%</span>@endif
                            <h3 class="productCurrentPrice px-2">₹ {{number_format($product->product_current_price, 2)}}</h3>
                        </div>
                        <h4>MRP: ₹ {{number_format($product->product_mrp_price, 2)}}</h4>
                    </div>

                    @if($product->stock_status == false)
                        <h5>Sorry! Product is Out of Stock</h5>
                    @else
                        <div class="productButtons mt-5">
                            <input type="hidden" name="id" id="id" value="{{$product->id}}"/>
                            <input type="hidden" title="Quantity" name="quantity" id="quantity" value="1">
                            <div class="col-6">
                                <button class="buynowBtn" id="buynow">Buy Now</button>
                            </div>
                            <div class="col-6">
                                <button class="addcartBtn" id="cartnow">Add to Cart</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-5 Details">
                    <h5>Description</h5>
                    {!! $product->product_details !!}
                </div>
            </div>

            <div class="row">
                <div class="col-12 mt-3 Reviews">
                    <div class="d-inline-block mb-3">
                        <h5>What Customers Says</h5>
                        <div class="starRating">
                            @for($i=1; $i<=5; $i++)
                                @if($i <= $product->rating)
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                                    </svg>
                                @endif
                            @endfor
                            <span>({{round($product->rating, 1)}})</span>
                        </div>
                        <p class="numRating">({{$product->num_of_rating}} Ratings)</p>
                    </div>

                    <div class="allratings">

                        @foreach($product->productReviews as $review)
                            <div class="col-12 d-flex">
                                <div class="col-1">
                                    <img src="{{asset('android/images/user-icon.png')}}"/>
                                </div>
                                <div class="col-11 px-2">
                                    <h6>{{$review->reviewUser->name}}</h6>
                                    <span>{{$review->created_at}}</span>
                                    <p>{{$review->comment}}</p>
                                </div>
                            </div>
                        @endforeach

                        <div class="col-12 allreviewLink text-center">
                            <a href="{{url('/reviews')}}">See All Reviews</a>
                        </div>

                    </div>
                </div>
            </div>


        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#cartnow').click(function (e) {
                var id = $('#id').val();
                var quantity = $('#quantity').val();
                /*if(quantity > 1){
                    alert('Due to high demand you can order 1 quantity of this product.');
                }*/
                window.location.href = '{{url("cart/add/")}}'+'/'+id+'/'+quantity;
                return false;
            });
            $('#buynow').click(function (){
                var id = $('#id').val();
                var quantity = $('#quantity').val();

                varUrl = "{{url('checkout')}}" + '/?type=buynow&product_id=' + id + '&quantity=' + quantity;
                window.location.href = varUrl;
                return false;
            });
        });
    </script>
@endsection
