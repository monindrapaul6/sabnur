@extends('backend.layout.app')
@section('content')

        <ol class="breadcrumb bc-3" >
            <li>
                <a href="{{url('/admin')}}"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="{{url('admin/categories')}}">Categories</a>
            </li>
            <li class="active">
                <strong>{{$category->category_name}}</strong>
            </li>
        </ol>

        <script src="{{asset('backend/js/jquery-1.11.3.min.js')}}"></script>

        <div class="row">
            <div class="col-md-8">
                <div class="panel minimal minimal-gray">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>{{$category->category_name}}</h4>
                        </div>
                        <div class="panel-options">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#general" data-toggle="tab">General</a>
                                </li>
                                </li>
                                <li>
                                    <a href="#seo" data-toggle="tab">SEO</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="general">
                                <h4>Update Category Information</h4>
                                @include('backend.category.general')
                            </div>
                            <div class="tab-pane" id="seo">
                                <h4>SEO</h4>
                                @include('backend.category.seo')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
