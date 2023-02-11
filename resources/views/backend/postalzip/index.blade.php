@extends('backend.layout.app')
@section('content')

        <ol class="breadcrumb bc-3" >
            <li>
                <a href="{{url('/admin')}}"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="{{url('postalzips')}}">Postal Zips</a>
            </li>
        </ol>

        <form role="form" action="{{url('admin/zipcsv')}}" method="post" class="form-horizontal form-groups-bordered" enctype="multipart/form-data">
            @csrf
            <label for="file">Upload CSV File</label>
            <input type="file" name="file" id="file" accept="text/csv">
            <input type="submit" name="submit" class="btn btn-success" value="Upload Data">

            @if(Session::has('message'))
                <p >{{ Session::get('message') }}</p>
            @endif
        </form>

        <h3>Cod Zips</h3>
        <br />
        <a href="{{url('admin/postalzip/create')}}" class="btn btn-success">Add Postal Zip</a>
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
                <th>Zip Code</th>
                <th>Delivery</th>
                <th>COD</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($postalzips as $postalzip)
            <tr>
                <td>{{$postalzip->id}}</td>
                <td>{{$postalzip->zip_code}}</td>
                <td>{{$postalzip->is_delivery}}</td>
                <td>{{$postalzip->is_cod}}</td>
                <td><a href="{{url('admin/postalzip/'.$postalzip->id)}}" class="btn btn-success">Action</a></td>
            </tr>
            @endforeach
            </tbody>
        </table>
@endsection
