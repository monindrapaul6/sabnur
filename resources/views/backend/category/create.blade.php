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
            <strong>Create Category</strong>
        </li>
    </ol>
    <h2>Create Category</h2>
    <br />
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary" data-collapsed="0">
                <div class="panel-body">
                    <form method="post" action="{{url('admin/category/store')}}" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="parent_id" class="col-sm-3 control-label">Parent Category: </label>
                            <div class="col-sm-5">
                                <select class="form-control" id="parent_id" name="parent_id">
                                    <option value="0" @if(old('parent_id') == 0) selected @endif>This is Parent Category</option>
                                    @foreach($parentCategories as $parentCategory)
                                        <option value="{{$parentCategory->id}}" @if(old('parent_id') == $parentCategory->id) selected @endif>{{$parentCategory->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category_name" class="col-sm-3 control-label">Category Name: </label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="category_name" name="category_name" value="{{old('category_name')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="upload" class="col-sm-3 control-label">Category Image: </label>
                            <div class="col-sm-5">
                                <input type="file" id="upload" name="upload" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-sm-3 control-label">Status: </label>
                            <div class="col-sm-2">
                                <select name="status" id="status" class="form-control">
                                    <option value="1" @if(old('status') == true) selected @endif>ACTIVE</option>
                                    <option value="0" @if(old('status') == false) selected @endif>INACTIVE</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-5">
                                <input type="submit" class="btn btn-success" value="Create Category">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
