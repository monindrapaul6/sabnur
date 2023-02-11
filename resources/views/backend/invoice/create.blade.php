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
                            <label for="tax_rate" class="col-sm-3 control-label">Tax rate: </label>
                            <div class="col-sm-2">
                                <input type="text" class="form-control" id="tax_rate" name="tax_rate" value="{{old('tax_rate')}}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-sm-3 control-label">Status: </label>
                            <div class="col-sm-2">
                                <select name="status" id="status" class="form-control">
                                    <option value="ACTIVE" @if(old('status') == 'ACTIVE') selected @endif>ACTIVE</option>
                                    <option value="INACTIVE" @if(old('status') == 'INACTIVE') selected @endif>INACTIVE</option>
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
