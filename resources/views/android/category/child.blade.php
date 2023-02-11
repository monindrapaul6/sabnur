@extends('android.layout.app')
@section('content')

    <div class="section" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-12 mt-2">
                    <img src="https://img.pikbest.com/backgrounds/20210806/plant-silhouette-farm-organic-fruit-web-banner_6080030.jpg!bwr800" class="img-fluid rounded"/>
                </div>
            </div>

            <div class="row categorySection">
                <div class="col-12 mt-3 mb-5">
                    <span class="position-absolute float-start start-0">
                        <a href="{{url('categories')}}">
                            <img src="https://cdn-icons-png.flaticon.com/512/93/93634.png" width="20px" height="20px"/>
                        </a>
                    </span>
                    <h1 class="mb-4 text-center">{{$category->category_name}}</h1>
                    @foreach($category->children as $childCategory)
                        <div class="col-4 float-start category_thumb text-center">
                            <a class="product-item-thumb" href="{{url('/categories/' . $childCategory->category_slug)}}">
                                <img src="{{asset($childCategory->category_image_thumb)}}">
                                <h6 class="mt-2">{{$childCategory->category_name}}</h6>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection
