<!--== Start Brand Logo Area Wrapper ==-->
<div class="section mt-8">
    <div class="container">
        <!--<span class="viewAll float-end"><a href="#">View All</a></span>-->
        <h2 class="mt-n2 mb-8">Brands You Are Looking</h2>
        <div class="swiper brand-logo-two-slider-container swiper-button-style swiper-button-style8">
            <div class="swiper-wrapper px-3 py-3">
                @foreach($brands as $brand)
                    <div class="swiper-slide brand-logo-item">
                        <a href="{{url('brand/' . $brand->brand_slug)}}">
                            <img src="{{asset($brand->brand_image_thumb)}}" alt="{{$brand->brand_name}}">
                        </a>
                    </div>
                @endforeach
            </div>
            <!--== Start Swiper Navigation ==-->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</div>
<!--== End Brand Logo Area Wrapper ==-->
