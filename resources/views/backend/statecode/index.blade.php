@extends('backend.layout.app')
@section('content')

        <ol class="breadcrumb bc-3" >
            <li>
                <a href="{{url('/admin')}}"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="{{url('statecodes')}}">State Codes</a>
            </li>
        </ol>

        <h3>Categories</h3>
        <br />
        <a href="{{url('admin/statecode/create')}}" class="btn btn-success">Add State Code</a>
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
                <th>State Name</th>
                <th>State Code</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($statecodes as $statecode)
            <tr>
                <td>{{$statecode->id}}</td>
                <td>{{$statecode->state_name}}</td>
                <td>{{$statecode->state_code}}</td>
                <td><a href="{{url('admin/statecode/'.$statecode->id)}}" class="btn btn-success">Action</a></td>
            </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>State Name</th>
                <th>State Code</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
@endsection
