@extends('backend.layout.app')
@section('content')
    <ol class="breadcrumb bc-3" >
        <li>
            <a href="{{url('/admin')}}"><i class="fa-home"></i>Home</a>
        </li>
        <li>
            <a href="{{url('admin/products')}}">Products</a>
        </li>
        <li class="active">
            <strong>{{ strip_tags(htmlspecialchars_decode($product->product_name))}}</strong>
        </li>
    </ol>
    <script src="{{asset('backend/js/jquery-1.11.3.min.js')}}"></script>

    <div class="row">
        <div class="col-md-8">
            <div class="panel minimal minimal-gray">
                <div class="panel-heading">
                    <div class="panel-title">
                        <h4>{{ strip_tags(htmlspecialchars_decode($product->product_name))}}</h4>
                    </div>
                    <div class="panel-options">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#general" data-toggle="tab">General</a>
                            </li>
                            <li>
                                <a href="#pictures" data-toggle="tab">Pictures</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane active" id="general">
                            <h4>Update Product Information</h4>
                            @include('backend.product.general')
                        </div>
                        <div class="tab-pane" id="pictures">
                            <h4>Update Product Pictures</h4>
                            @include('backend.product.pictures')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
