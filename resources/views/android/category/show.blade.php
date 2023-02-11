@extends('android.layout.app')
@section('content')

    <div class="section categoryDetails" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex mb-4">
                    <a href="{{url('categories')}}">
                        <img src="https://icons.veryicon.com/png/o/miscellaneous/eva-icon-fill/arrow-back-8.png" width="20px" height="20px"/>
                    </a>
                    <span class="px-2">
                        <img src="https://w7.pngwing.com/pngs/102/28/png-transparent-strawberry-juice-fruit-smoothie-strawberry-fruit-natural-foods-frutti-di-bosco-food-thumbnail.png" width="25" height="25"/>
                    </span>
                    <h5 class="mt-1">{{$category->category_name}}</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-12">

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
                            @if ($products->lastPage() > 1)
                                <div class="col-12 mt-4 d-inline-block">
                                    {!! $products->links('pagination::bootstrap-4') !!}
                                </div>
                            @endif
                    @endif
                </div>
            </div>

        </div>
    </div>

@endsection
