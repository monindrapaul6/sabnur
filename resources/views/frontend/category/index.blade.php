@extends('frontend.layout.app')
@section('content')

    <main class="main-content">

        <!--== Start Product Area Wrapper ==-->
        <div class="product-area section-space">
            <div class="container">
                <div class="row mb-n6">
                    @foreach($categories as $category)
                        <div class="col-sm-6 col-lg-2 mb-6">
                            <!--== Start Product Item ==-->
                            <div class="product-item">
                                <a class="product-item-thumb" href="{{url('/collections/' . $category->category_slug)}}">
                                    <img src="{{asset($category->category_image_thumb)}}" width="270" height="264" alt="Image-HasTech">
                                </a>
                                <div class="product-item-info text-center pb-6">
                                    <h4 class="product-item-title mb-2">
                                        <a href="{{url('/collections/' . $category->category_slug)}}">
                                            {{$category->category_name}}
                                        </a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>
@endsection

