<div class="col-md-12">
    <form role="form" method="post" action="{{url('admin/product/update')}}" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$product->id}}">
        <div class="panel panel-primary" data-collapsed="0">
            <div class="panel-body">

                <div class="form-group">
                    <label for="category_id" class="col-sm-3 control-label">Category: </label>
                    <div class="col-sm-8">
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif>{{$category->category_name}}</option>
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
                        <input type="text" id="product_name" name="product_name" class="form-control" value="{{$product->product_name}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="product_slug" class="col-sm-3 control-label">Product Slug: </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="product_slug" name="product_slug" value="{!! $product->product_slug !!}"/>
                    </div>
                </div>

                <div class="form-group">
                    <label for="hsn_no" class="col-sm-3 control-label">HSN No: </label>
                    <div class="col-sm-8">
                        <input type="text" id="hsn_no" name="hsn_no" class="form-control" value="{{$product->hsn_no }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="product_summary" class="col-sm-3 control-label">Product Summary</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="product_summary" name="product_summary">{{$product->product_summary}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="product_details" class="col-sm-3 control-label">Product Details</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="product_details" name="product_details">{{$product->product_details}}</textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label for="product_mrp_price" class="col-sm-3 control-label">MRP Price: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="product_mrp_price" name="product_mrp_price" value="{{$product->product_mrp_price}}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="product_current_price" class="col-sm-3 control-label">Product Current Price: </label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" id="product_current_price" name="product_current_price" value="{{$product->product_current_price}}">
                    </div>
                </div>


                <div class="form-group">
                    <label for="stock_status" class="col-sm-3 control-label">Stock availability: </label>
                    <div class="col-sm-5">
                        <select class="form-control" id="stock_status" name="stock_status">
                            <option value="1" @if($product->stock_status == true) selected @endif>In Stock</option>
                            <option value="0" @if($product->stock_status == false) selected @endif>Out of Stock</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="status" class="col-sm-3 control-label">Status: </label>
                    <div class="col-sm-5">
                        <select class="form-control" id="status" name="status">
                            <option value="1" @if($product->status == true) selected @endif>ACTIVE</option>
                            <option value="0" @if($product->status == false) selected @endif>INACTIVE</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="uploadImage" class="col-sm-3 control-label">Product DP: </label>
                    <div class="col-sm-5">
                        @isset($product->productDPImage->image_thumb)<img src="{{asset($product->productDPImage->image_thumb)}}" width="75" height="75">@endisset
                    </div>
                </div>

                <div class="form-group">
                    <label for="upload" class="col-sm-3 control-label">Change Product DP: </label>
                    <div class="col-sm-5">
                        <input type="file" class="form-control" id="upload" name="upload">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-4">
                        <a href="{{url('admin/productdelete/'.$product->id)}}" class="text-danger"  onclick="return confirm('Are you sure?')">Delete Product</a>
                    </div>
                    <div class="col-sm-4">
                        <input type="submit" class="btn btn-success" value="Save">
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
