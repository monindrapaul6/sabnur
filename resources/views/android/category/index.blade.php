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
                <h1 class="mb-4 text-center">Top Categories</h1>
                @foreach($categories as $category)
                    <div class="col-4 float-start category_thumb text-center">
                        <a class="product-item-thumb" href="{{url('/categories/' . $category->category_slug)}}">
                            <img src="{{asset($category->category_image_thumb)}}">
                            <h6 class="mt-2">{{$category->category_name}}</h6>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@endsection
