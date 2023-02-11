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
            <strong>Create Product</strong>
        </li>
    </ol>
    <h2>Create Product</h2>
    <br />
    <div class="row">
        <form role="form" method="post" action="{{url('admin/product/store')}}" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
            @csrf
            <div class="col-md-6">
                <div class="panel panel-primary" data-collapsed="0">
                    <div class="panel-body">

                        <div class="form-group">
                            <label for="category_id" class="col-sm-3 control-label">Category: </label>
                            <div class="col-sm-8">
                                @if ($errors->has('category_id'))
                                    <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                @endif
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="0">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" @if(old('category_id') == $category->id) selected @endif>{{$category->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                            <div class="form-group">
                                <label for="product_name" class="col-sm-3 control-label">Product Name: </label>
                                <div class="col-sm-8">
                                    @if ($errors->has('product_name'))
                                        <span class="text-danger">{{ $errors->first('product_name') }}</span>
                                    @endif
                                    <input type="text" id="product_name" name="product_name" class="form-control" value="{{old('product_name')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="hsn_no" class="col-sm-3 control-label">HSN No: </label>
                                <div class="col-sm-8">
                                    <input type="text" id="hsn_no" name="hsn_no" class="form-control" value="{{old('hsn_no')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="product_summary" class="col-sm-3 control-label">Product Summary</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="product_summary" name="product_summary">{{old('product_summary')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="product_details" class="col-sm-3 control-label">Product Details</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" id="product_details" name="product_details">{{old('product_details')}}</textarea>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="product_mrp_price" class="col-sm-3 control-label">MRP Price: </label>
                                <div class="col-sm-5">
                                    @if ($errors->has('product_mrp_price'))
                                        <span class="text-danger">{{ $errors->first('product_mrp_price') }}</span>
                                    @endif
                                    <input type="text" class="form-control" id="product_mrp_price" name="product_mrp_price" value="{{old('product_mrp_price')}}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="product_current_price" class="col-sm-3 control-label">Product Current Price: </label>
                                <div class="col-sm-5">
                                    @if ($errors->has('product_current_price'))
                                        <span class="text-danger">{{ $errors->first('product_current_price') }}</span>
                                    @endif
                                    <input type="text" class="form-control" id="product_current_price" name="product_current_price" value="{{old('product_current_price')}}">
                                </div>
                            </div>

                        <div class="form-group">
                            <label for="upload" class="col-sm-3 control-label">Product DP: </label>
                            <div class="col-sm-5">
                                <input type="file" class="form-control" id="upload" name="upload">
                            </div>
                        </div>

                            <div class="form-group">
                                <label for="stock_status" class="col-sm-3 control-label">Stock availability: </label>
                                <div class="col-sm-5">
                                    <select class="form-control" id="stock_status" name="stock_status">
                                        <option value="1">In Stock</option>
                                        <option value="0">Out of Stock</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-5">
                                    <input type="submit" class="btn btn-success" value="Save">
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
