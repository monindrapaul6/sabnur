<!--== Start Product Categories Area Wrapper ==-->
<div class="product-categories-area">
    <div class="container">
        <div class="section-title d-flex justify-content-between mb-6 mb-xxl-8">
            <h2 class="title mt-n2 mb-0">New Categories</h2>
        </div>
        <div class="swiper product-categories-two-slider product-categories-two-items">
            <div class="swiper-wrapper">
                @foreach($topcategories as $topcategory)
                <!--== Start Product Categorie Item ==-->
                <a href="{{url('collections/' . $topcategory->category_slug)}}" class="swiper-slide product-category-item">
                    <div class="product-category-thumb">
                        <img src="{{asset($topcategory->category_image_thumb)}}" width="101" height="101" alt="{{$topcategory->category_name}}">
                    </div>
                    <h5 class="product-category-title">{{$topcategory->category_name}}</h5>
                </a>
                <!--== End Product Categorie Item ==-->
                @endforeach
            </div>
        </div>
    </div>
</div>
<!--== End Product Categories Area Wrapper ==-->
