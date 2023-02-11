@extends('frontend.layout.app')
@section('content')

<main class="main-content">

    <!--== Start Product Area Wrapper ==-->
    <div class="product-area section-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-xl-9 order-0 order-lg-1">
                    <!--== Start Product Top Bar Area Wrapper ==-->
                    <!--<div class="shop-top-bar">
                        <select class="select-shoing">
                            <option data-display="Default Sorting">Default Sorting</option>
                            <option value="1">Featured</option>
                            <option value="2">Best Selling</option>
                            <option value="3">Price: low to high</option>
                            <option value="4">Price: high to low</option>
                        </select>
                    </div>-->
                            <div class="row mb-n6">

                                @foreach($products as $product)
                                <div class="col-6 col-sm-6 col-lg-6 col-xl-3 mb-6">
                                    <div class="product-item">
                                        <a class="product-item-thumb" href="{{url('/product/' . $product->product_slug)}}">
                                            @isset($product->productDPImage->image_thumb)<img src="{{asset($product->productDPImage->image_thumb)}}" width="270" height="264" alt="Image-HasTech">@endisset
                                        </a>
                                        @if($product->product_discount > 0)<span class="badges">{{'-' . $product->product_discount}}%</span>@endif
                                        <div class="product-item-info text-center pb-6">
                                            <h5 class="product-item-title mb-2">
                                                <a href="{{url('/product/' . $product->product_slug)}}">{{$product->product_name}}</a>
                                            </h5>
                                            <span class="productCondition mb-3 mb-lg-0 d-block">{{$product->product_condition}}</span>
                                            <div class="product-item-price">{{'Rs. ' . $product->product_current_price}} - <span class="price-old">{{'Rs. ' . $product->product_mrp_price}}</span></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                <div class="col-12">
                                    <!--<div class="product-showing-count">
                                        Showing <span>1–9</span> of <span>10</span> results
                                    </div>-->
                                    <!--<nav class="pagination-area mt-6 mb-6">
                                        <ul class="page-numbers justify-content-center">
                                            <li>
                                                <a class="page-number active" href="#">1</a>
                                            </li>
                                            <li>
                                                <a class="page-number" href="#">2</a>
                                            </li>
                                            <li>
                                                <a class="page-number next" href="shop.html">
                                                    <i class="icon-arrow-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>-->
                                </div>
                            </div>

                </div>
                <div class="col-lg-4 col-xl-3 order-1 order-lg-0">
                    <!--== Start Sidebar Area Wrapper ==-->
                    <div class="sidebar-area mt-10 mt-lg-0">

                        <div class="widget-item widget-item-one">
                            <h3 class="widget-two-title text-black">Product Filter</h3>

                            <form action="{{url('search')}}" method="get">
                                <input type="hidden" name="q" value="{{$query}}">
                                <div class="widget-filter-size">
                                    <h4 class="filter-size-title">Filter By Brand</h4>
                                    @foreach(\App\Models\Brand::active()->get() as $brand)
                                    <div class="filter-form-check">
                                        <input class="filter-form-check-input" name="brand" type="checkbox" id="{{$brand->id}}" value="{{$brand->id}}"
                                               @if (in_array($brand->id, explode(',', request()->input('brand'))))
                                               checked
                                            @endif
                                        >
                                        <label class="filter-form-check-label" for="{{$brand->id}}">{{$brand->brand_name}}</label>
                                    </div>
                                    @endforeach
                                </div>
                                <!--<div class="widget-price-filter pe-0">
                                    <h4 class="filter-price-title">Filter By Price</h4>
                                    <div class="slider-range" id="slider-range"></div>
                                    <div class="slider-labels">
                                        <p>Price:</p>
                                        <div class="caption">
                                            <span id="slider-range-value1"></span>
                                            <input type="hidden" name="min" id="min" value="0">
                                        </div>
                                        <span> - </span>
                                        <div class="caption">
                                            <span id="slider-range-value2"></span>
                                            <input type="hidden" name="max" id="max" value="0">
                                        </div>
                                    </div>
                                </div>-->
                                <div class="widget-filter-size mt-3">
                                    <button type="submit" id="filter" class="btn product-banner-eight-btn">Filter Result <i class="icon fa fa-arrow-right"></i></button>
                                </div>
                            </form>

                        </div>
                    <!--<link rel="stylesheet" href="{{asset('static/css/range-slider.css')}}">
                    <script src="{{asset('static/js/range-slider.js')}}"></script>-->
                        <script>
                            function getIds(checkboxName) {
                                let checkBoxes = document.getElementsByName(checkboxName);
                                let ids = Array.prototype.slice.call(checkBoxes)
                                    .filter(ch => ch.checked==true)
                                    .map(ch => ch.value);
                                return ids;
                            }

                            function filterResults () {
                                let brandIds = getIds("brand");

                                let href = '/search/?';

                                if(brandIds.length) {
                                    href += 'brand=' + brandIds;
                                }

                                document.location.href=href;
                            }

                            document.getElementById("filter").addEventListener("click", filterResults);
                        </script>

                        <!--new products-->

                        <!--<div class="widget-item mb-0 p-0">
                            <div class="widget-banner product-banner-eight-item" data-bg-img="assets/images/shop/banner/20.png">
                                <h5 class="product-banner-eight-desc text-primary">Sparing Sales</h5>
                                <h2 class="product-banner-eight-title mt-n2">Mexi Phone With EMI</h2>
                                <a class="btn product-banner-eight-btn" href="shop.html">Shop Now <i class="icon fa fa-arrow-right"></i></a>
                                <img class="ms-1" src="assets/images/shop/banner/21.png" width="225" height="201" alt="Image-HasTech">
                            </div>
                        </div>-->
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection




