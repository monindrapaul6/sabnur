<!--== Start Product Tab Area Wrapper ==-->
<div class="product-area section-space">
    <div class="container">
        <span class="viewAll float-end"><a href="{{url('collections/most-sold-mobiles')}}">View All</a></span>
        <h2 class="mt-n2 mb-8">Products Most Viewed</h2>
        <div class="product-tab-content">

            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="product-audio-video" role="tabpanel" aria-labelledby="product-audio-video-tab">
                    <div class="swiper product-tab-two-slider swiper-button-style swiper-button-style10">
                        <div class="swiper-wrapper">
                            @foreach($mostviewproduts as $mostviewprodut)
                            <!--== Start Product Item ==-->
                            <div class="swiper-slide product-item">
                                <a class="product-item-thumb" href="{{url('product/' . $mostviewprodut->product_slug)}}">
                                    @isset($mostviewprodut->productDPImage->image_thumb)<img src="{{asset($mostviewprodut->productDPImage->image_thumb)}}" width="170" height="auto" alt="Image-HasTech">@endisset
                                </a>
                                @if($mostviewprodut->product_discount > 0)<span class="badges">{{'-' . $mostviewprodut->product_discount}}%</span>@endif
                                <div class="product-item-info text-center pb-6">
                                    <h5 class="product-item-title mb-2"><a href="{{url('product/' . $mostviewprodut->product_slug)}}">{{mb_strimwidth($mostviewprodut->product_name, 0, 75)}}</a></h5>
                                    <span class="productCondition">{{$mostviewprodut->product_condition}}</span>
                                    <div class="product-item-price">Rs. {{number_format($mostviewprodut->product_current_price, 2)}} <span class="price-old">Rs. {{number_format($mostviewprodut->product_mrp_price, 2)}}</span></div>
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
