<!--== Start New Arrivals ==-->
<div class="product-area section-space">
    <div class="container">
        <span class="viewAll float-end"><a href="{{url('collections/new-arrivals')}}">View All</a></span>
        <h2 class="mt-n2 mb-8">New Arrival Products</h2>
        <div class="product-tab-content">

            <div class="tab-content" id="myTabContent3">

                <div class="tab-pane fade show active" id="product-audio-video3" role="tabpanel" aria-labelledby="product-audio-video3-tab">
                    <div class="swiper product-tab-two-slider swiper-button-style swiper-button-style10">
                        <div class="swiper-wrapper">
                        @foreach($newarrivals as $newarrival)
                            <!--== Start Product Item ==-->
                                <div class="swiper-slide product-item">
                                    <a class="product-item-thumb" href="{{url('product/' . $newarrival->product_slug)}}">
                                        @isset($newarrival->productDPImage->image_thumb)<img src="{{asset($newarrival->productDPImage->image_thumb)}}" width="170" height="auto" alt="Image-HasTech">@endisset
                                    </a>
                                    @if($newarrival->product_discount > 0)<span class="badges">{{$newarrival->product_discount}}% Off</span>@endif
                                    <div class="product-item-info text-center pb-6">
                                        <h5 class="product-item-title mb-2"><a href="{{url('product/' . $newarrival->product_slug)}}">{{mb_strimwidth($newarrival->product_name, 0, 75)}}</a></h5>
                                        <span class="productCondition">{{$newarrival->product_condition}}</span>
                                        <div class="product-item-price">Rs. {{number_format($newarrival->product_current_price, 2)}} <span class="price-old">Rs. {{number_format($newarrival->product_mrp_price, 2)}}</span></div>
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
<!--== End New Arrivals ==-->
