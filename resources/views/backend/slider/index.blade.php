@extends('backend.layout.app')
@section('content')

        <ol class="breadcrumb bc-3" >
            <li>
                <a href="{{url('/admin')}}"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                Sliders
            </li>
        </ol>

        <h3>Sliders</h3>
        <br />
        <a href="{{url('admin/slider/create')}}" class="btn btn-success">Add Slider</a>
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
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($sliders as $slider)
            <tr>
                <td>{{$slider->id}}</td>
                <td><img src="{{asset($slider->SliderPicture->image_thumb)}}" width="25" height="25"></td>
                <td><a href="{{url('admin/slider/'.$slider->id)}}" class="btn btn-success">Action</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
@endsection
