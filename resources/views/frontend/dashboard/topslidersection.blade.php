<!--== Start Hero Area Wrapper ==-->
<div class="hero-six-slider-area position-relative mb-10">
    <div class="swiper hero-six-slider-container">
        <div class="swiper-wrapper">
            @foreach($sliders as $slider)
            <div class="swiper-slide">
                <img src="{{asset($slider->SliderPicture->image_full)}}" style="border-radius: 3px"/>
            </div>
            @endforeach
        </div>
        <!--== Add Pagination ==-->
        <div class="hero-slide-six-pagination d-none d-lg-block"></div>
    </div>
</div>
<!--== End Hero Area Wrapper ==-->
<style>
    .swiper-slide img{
        width: 100%;
        height: auto;
        border-radius: 24px;
    }
</style>
