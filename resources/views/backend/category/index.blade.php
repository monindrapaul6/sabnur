@extends('backend.layout.app')
@section('content')

        <ol class="breadcrumb bc-3" >
            <li>
                <a href="{{url('/admin')}}"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="{{url('categories')}}">Categories</a>
            </li>
        </ol>

        <h3>Categories</h3>
        <br />
        <a href="{{url('admin/category/create')}}" class="btn btn-success">Add Category</a>
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
                <th>Parent Category</th>
                <th>Name</th>
                <th>Image</th>
                <th>Tax rate</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->parent_id == 0 ? null : $category->parent->category_name}}</td>
                <td>{{$category->category_name}}</td>
                <td><img src="{{asset($category->category_image_thumb)}}" width="25" height="25"></td>
                <td>{{$category->tax_rate}}</td>
                <td><a href="{{url('admin/category/'.$category->id)}}" class="btn btn-success">Action</a></td>
            </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>Parent Category</th>
                <th>Name</th>
                <th>Image</th>
                <th>Tax rate</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
@endsection
