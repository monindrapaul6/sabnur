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
                        <select class="select-shoing" id="selectSorting">
                            <option data-display="Default Sorting" value="0">Default Sorting</option>
                            <option value="1">Featured</option>
                            <option value="2">Best Selling</option>
                            <option value="3">Price: low to high</option>
                            <option value="4">Price: high to low</option>
                        </select>
                    </div>

                    <script>
                        $(document).ready(function (){
                            $('#selectSorting').change(function (){
                                var selectSorting = $('#selectSorting').val();

                                alert(selectSorting);
                            });
                        })
                    </script>-->
                            <div class="row mb-n6">

                                @if(count($products) == 0)
                                <div class="col-lg-9 m-auto">
                                    <div class="error-content text-center">
                                        <h1>Products on the Way</h1>
                                        <p>We are updating products very soon!</p>
                                    </div>
                                </div>
                                @else

                                @foreach($products as $product)
                                <div class="col-6 col-sm-6 col-lg-6 col-xl-3 mb-6">
                                    <div class="product-item">
                                        <a class="product-item-thumb" href="{{url('/product/' . $product->product_slug)}}">
                                            @isset($product->productDPImage->image_thumb)<img src="{{asset($product->productDPImage->image_thumb)}}" width="270" height="264" alt="Image-HasTech">@endisset
                                        </a>
                                        @if($product->product_discount > 0)<span class="badges">{{$product->product_discount}}% Off</span>@endif
                                        <div class="product-item-info text-center pb-6">
                                            <h5 class="product-item-title mb-2">
                                                <a href="{{url('/product/' . $product->product_slug)}}">{{ mb_strimwidth($product->product_name, 0, 75)}}</a>
                                            </h5>
                                            <span class="productCondition mb-3 mb-lg-0 d-block">{{$product->product_condition}}</span>
                                            <div class="product-item-price">{{'Rs. ' . $product->product_current_price}} - <span class="price-old">{{'Rs. ' . $product->product_mrp_price}}</span></div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach

                                @endif
                                <div class="col-12">
                                    @if ($products->lastPage() > 1)
                                        <nav class="pagination-area mt-6 mb-6">
                                            <ul class="page-numbers justify-content-center">
                                            <li class="{{ ($products->currentPage() == 1) ? ' d-none' : '' }}">
                                                <a class="page-number prev" href="{{ $products->url(1) }}"><i class="icon-arrow-left"></i></a>
                                            </li>
                                            @for ($i = 1; $i <= $products->lastPage(); $i++)
                                                <li class="page-number {{ ($products->currentPage() == $i) ? ' active' : '' }}">
                                                    <a href="{{ $products->url($i) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                            <li class="{{ ($products->currentPage() == $products->lastPage()) ? ' d-none' : '' }}">
                                                <a class="page-number next" href="{{ $products->url($products->currentPage()+1) }}" ><i class="icon-arrow-right"></i></a>
                                            </li>
                                        </ul>
                                @endif
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
                        <div class="widget-item widget-item-one pb-5">
                            <h5 class="widget-two-title text-black">Category</h5>
                            <div class="widget-categories-list">
                                <a class="widget-category-item" href="{{ url('brand/' . $brand_slug . '/') }}">
                                    <strong>All {{$brand->brand_name}} Products</strong>
                                </a>
                                @foreach(\App\Models\Category::active()->where('category_slug', '!=', 'mobile')->orderby('category_name', 'asc')->get() as $allCategory)
                                    <a class="widget-category-item" href="{{ url('brand/' . $brand_slug . '/' . $allCategory->category_slug) }}">
                                        {{$allCategory->category_name}}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
@endsection




