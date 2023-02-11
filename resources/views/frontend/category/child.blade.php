@extends('frontend.layout.app')
@section('content')

    <main class="main-content">

        <!--== Start Product Area Wrapper ==-->
        <div class="product-area section-space">
            <div class="container">
                <h2 class="section-title text-black text-center mt-n2"><a href="{{url('/collections')}}">All Categories > </a> {{$category->category_name}}</h2>
                <div class="row mb-n6">
                    @foreach($category->children as $childCategory)
                        <div class="col-sm-6 col-lg-2 mb-6">
                            <!--== Start Product Item ==-->
                            <div class="product-item">
                                <a class="product-item-thumb" href="{{url('/collections/' . $childCategory->category_slug)}}">
                                    <img src="{{asset($childCategory->category_image_thumb)}}" width="270" height="264" alt="{{$childCategory->category_name}}">
                                </a>
                                <div class="product-item-info text-center pb-6">
                                    <h4 class="product-item-title mb-2">
                                        <a href="{{url('/collections/' . $childCategory->category_slug)}}">
                                            {{$childCategory->category_name}}
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

