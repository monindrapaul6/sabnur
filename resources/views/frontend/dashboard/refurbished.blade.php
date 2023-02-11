<!--== Start Product Tab Area Wrapper ==-->
<div class="product-area section-space">
    <div class="container">
        <span class="viewAll float-end"><a href="{{url('collections/refurbished-mobile')}}">View All</a></span>
        <h2 class="mt-n2 mb-8">Products Most Sold</h2>
        <div class="swiper product-tab-two-slider swiper-button-style swiper-button-style10">
            <div class="swiper-wrapper">
            @foreach($newproducts as $newproduct)
                <!--== Start Product Item ==-->
                    <div class="swiper-slide product-item border">
                        <a class="product-item-thumb" href="{{url('product/' . $newproduct->product_slug)}}">
                            @isset($newproduct->productDPImage->image_thumb)<img src="{{asset($newproduct->productDPImage->image_thumb)}}" width="170" height="auto" alt="Image-HasTech">@endisset
                        </a>
                        @if($newproduct->product_discount > 0)<span class="badges">{{'-' . $newproduct->product_discount}}%</span>@endif
                        <div class="product-item-info text-center pb-6">
                            <h5 class="product-item-title mb-2"><a href="{{url('product/' . $newproduct->product_slug)}}">{{mb_strimwidth($newproduct->product_name, 0, 75)}}</a></h5>
                            <span class="productCondition">{{$newproduct->product_condition}}</span>
                            <div class="product-item-price">₹ {{number_format($newproduct->product_current_price, 2)}} <span class="price-old">₹ {{number_format($newproduct->product_mrp_price, 2)}}</span></div>
                        </div>
                    </div>
                    <!--== End Product Item ==-->
                @endforeach
            </div>
            <!--== Start Swiper Navigation ==-->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</div>
<!--== End Product Tab Area Wrapper ==-->
