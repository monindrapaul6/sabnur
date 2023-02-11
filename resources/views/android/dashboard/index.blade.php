@extends('android.layout.app')
@section('content')

    <div class="section homePageSection" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="container">

            <!--category-->
            <div class="row categorySection">
                <div class="col-12 mt-3 mb-3">
                    <h1 class="mb-4 text-center">Top Categories</h1>
                    @foreach(\App\Models\Category::select('category_slug', 'category_name', 'category_image_thumb')->where('status', true)->get() as $category)
                        <div class="col-3 float-start category_thumb text-center">
                            <a class="product-item-thumb" href="{{url('/categories/' . $category->category_slug)}}">
                                <img src="{{asset($category->category_image_thumb)}}">
                                <h6 class="mt-2">{{$category->category_name}}</h6>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--category-->

            <!--main banner-->
            <div class="row">
                <div class="col-12 mt-2">
                    <img src="{{asset('android/images/temp/banner.png')}}" class="img-fluid rounded"/>
                </div>
            </div>
            <!--main banner-->

            <!--bulk-->
            <div class="row">
                <div class="col-12 mt-3 mb-3">
                    <img src="{{asset('android/images/temp/bulk.webp')}}" class="img-fluid rounded" onclick="alert('Buy in Bulk not ready'); return false;">
                </div>
            </div>
            <!--bulk-->

            <!--best selling products-->
            <div class="row">
                <div class="col-12">
                    <h5 class="mt-1">Best Selling Products</h5>
<?php $products = \App\Models\Product::select('product_name', 'product_slug', 'product_dp')->skip(0)->limit(4)->get();?>
                @if(count($products) == 0)
                        <div class="col-lg-9 m-auto">
                            <div class="text-center">
                                <h4>Products on the Way</h4>
                                <p>We are updating products very soon!</p>
                            </div>
                        </div>
                    @else
                        @foreach($products as $product)
                            <div class="col-4 float-start product-items px-2">
                                <a href="{{url('/product/' . $product->product_slug)}}">
                                    @isset($product->productDPImage->image_thumb)<img src="{{asset($product->productDPImage->image_thumb)}}" class="img-fluid rounded">@endisset
                                </a>
                                <h6>
                                    <a href="{{url('/product/' . $product->product_slug)}}">
                                        {{ mb_strimwidth($product->product_name, 0, 35, '..')}}
                                    </a>
                                </h6>
                                <button class="productPriceBtn">
                                    Rs. 1000.00
                                    <span class="float-end">
                                        <img src="{{asset('android/images/cart.svg')}}" width="15" height="15"/>
                                    </span>
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!--best selling products-->

            <!--banner-->
            <div class="row">
                <div class="col-12 d-flex">
                    <div class="col-6">
                        <img src="{{asset('android/images/temp/banner2.jpg')}}" class="img-fluid"/>
                    </div>
                    <div class="col-6">
                        <img src="{{asset('android/images/temp/banner3.jpg')}}" class="img-fluid"/>
                    </div>
                </div>
            </div>
            <!--banner-->

            <!--ad banner-->
            <div class="row">
                <div class="col-12">
                    <img src="{{asset('android/images/temp/banner5.jpg')}}" class="img-fluid" onclick="alert('Buy in Bulk not ready'); return false;">
                </div>
            </div>
            <!--ad banner-->

            <!--best selling products-->
            <div class="row">
                <div class="col-12">
                    <h5 class="mt-1">Best Selling Products</h5>
                    <?php $products = \App\Models\Product::select('product_name', 'product_slug', 'product_dp')->skip(0)->limit(4)->get();?>
                    @if(count($products) == 0)
                        <div class="col-lg-9 m-auto">
                            <div class="text-center">
                                <h4>Products on the Way</h4>
                                <p>We are updating products very soon!</p>
                            </div>
                        </div>
                    @else
                        @foreach($products as $product)
                            <div class="col-4 float-start product-items px-2">
                                <a href="{{url('/product/' . $product->product_slug)}}">
                                    @isset($product->productDPImage->image_thumb)<img src="{{asset($product->productDPImage->image_thumb)}}" class="img-fluid rounded">@endisset
                                </a>
                                <h6>
                                    <a href="{{url('/product/' . $product->product_slug)}}">
                                        {{ mb_strimwidth($product->product_name, 0, 35, '..')}}
                                    </a>
                                </h6>
                                <button class="productPriceBtn">
                                    Rs. 1000.00
                                    <span class="float-end">
                                        <img src="{{asset('android/images/cart.svg')}}" width="15" height="15"/>
                                    </span>
                                </button>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <!--best selling products-->

            <!--ad banner-->
            <div class="row">
                <div class="col-12">
                    <img src="{{asset('android/images/temp/banner6.jpg')}}" class="img-fluid" onclick="alert('Buy in Bulk not ready'); return false;">
                </div>
            </div>
            <!--ad banner-->

            <!--company-->
            <div class="row">
                <div class="col-12">
                    <div class="col-2">
                        <img src="{{asset('android/images/logo-grayscale.png')}}" class="img-fluid"/>
                    </div>
                    <div class="col-10">
                        <h5>Sabnur Plant & Nursery</h5>
                        <p>1no Rail Gate, Habra<br/>
                        North 24 Parganas, West Bengal - 743263</p>
                        <p>GSTIN: ABC000PNCYH</p>
                    </div>
                </div>
            </div>
            <!--company-->


        </div>
    </div>

@endsection
