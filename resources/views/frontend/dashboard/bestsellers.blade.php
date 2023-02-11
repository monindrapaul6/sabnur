<!--== Start Product Tab Area Wrapper ==-->
<div class="product-area section-space">
    <div class="container">
        <span class="viewAll float-end"><a href="{{url('collections/best-selling-mobiles')}}">View All</a></span>
        <h2 class="mt-n2 mb-8">Bestseller Products</h2>
        <div class="product-tab-content">

            <div class="tab-content" id="myTabContent3">

                <div class="tab-pane fade show active" id="product-audio-video3" role="tabpanel" aria-labelledby="product-audio-video3-tab">
                    <div class="swiper product-tab-two-slider swiper-button-style swiper-button-style10">
                        <div class="swiper-wrapper">
                        @foreach($bestsellers as $bestseller)
                            <!--== Start Product Item ==-->
                                <div class="swiper-slide product-item">
                                    <a class="product-item-thumb" href="{{url('product/' . $bestseller->product_slug)}}">
                                        @isset($bestseller->productDPImage->image_thumb)<img src="{{asset($bestseller->productDPImage->image_thumb)}}" width="170" height="auto" alt="Image-HasTech">@endisset
                                    </a>
                                    @if($bestseller->product_discount > 0)<span class="badges">{{$bestseller->product_discount}}% Off</span>@endif
                                    <div class="product-item-info text-center pb-6">
                                        <h5 class="product-item-title mb-2"><a href="{{url('product/' . $bestseller->product_slug)}}">{{mb_strimwidth($bestseller->product_name, 0, 75)}}</a></h5>
                                        <span class="productCondition">{{$bestseller->product_condition}}</span>
                                        <div class="product-item-price">Rs. {{number_format($bestseller->product_current_price, 2)}} <span class="price-old">Rs. {{number_format($bestseller->product_mrp_price, 2)}}</span></div>
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
        </div>
    </div>
</div>
<!--== End Product Tab Area Wrapper ==-->
