@extends('backend.layout.app')
@section('content')

        <ol class="breadcrumb bc-3" >
            <li>
                <a href="{{url('/admin')}}"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="{{url('admin/products')}}">Products</a>
            </li>
        </ol>

        <h3>Products</h3>
        <br />
        <form action="" method="get">
            Select Category
            <select name="category_id">
                <option value="all">All</option>
                @foreach($categories as $category)
                <option value="{{$category->id}}" @if(app('request')->input('category_id') == $category->id) selected @endif>{{$category->category_name}}</option>
                @endforeach
            </select>
            <input type="submit" class="btn btn-success" value="View Products">
        </form>
        <br />

        <script type="text/javascript">
            jQuery( document ).ready( function( $ ) {
                var $table1 = jQuery( '#table-1' );

                // Initialize DataTable
                $table1.DataTable( {
                    "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                    "bStateSave": true
                });

                // Initalize Select Dropdown after DataTables is created
                $table1.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
                    minimumResultsForSearch: -1
                });
            } );
        </script>

        <table class="table table-bordered datatable" id="table-1">
            <thead>
            <tr>
                <th>Id</th>
                <th>Picture</th>
                <th>HSN No</th>
                <th>Name</th>
                <th>Category</th>
                <th>MRP</th>
                <th>Current Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{$product->id}}</td>
                <td>@if(isset($product->productDPImage->image_thumb))<img src="{{url($product->productDPImage->image_thumb)}}" width="75" height="auto">@endif</td>
                <td>{{$product->hsn_no}}</td>
                <td>{{ strip_tags(htmlspecialchars_decode($product->product_name))}}</td>
                <td>{{$product->product_category->category_name}}</td>
                <td>{{number_format($product->product_mrp_price, 2)}}</td>
                <td>{{number_format($product->product_current_price, 2)}}</td>
                <td><span class="badge {{$product->stock_status == true ? 'badge-success' : 'badge-danger'}}">{{$product->stock_status == true ? 'In Stock' : 'Out of Stock'}}</span></td>
                <td>@if($product->status == true)<span class="badge badge-success">ACTIVE</span>@else<span class="badge badge-danger">INACTIVE</span>@endif</td>
                <td>
                    <a href="{{url('admin/product/'.$product->id)}}" class="btn btn-info">Action</a>
                </td>
            </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>Picture</th>
                <th>HSN No</th>
                <th>Name</th>
                <th>Category</th>
                <th>MRP</th>
                <th>Current Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
@endsection
