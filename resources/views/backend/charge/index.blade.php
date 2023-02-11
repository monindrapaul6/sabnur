@extends('backend.layout.app')
@section('content')

        <ol class="breadcrumb bc-3" >
            <li>
                <a href="{{url('/admin')}}"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="{{url('charges')}}">Charges</a>
            </li>
        </ol>

        <h3>Charges</h3>
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
                <th>Shipping Charge</th>
                <th>Total Limit</th>
                <th>COD Charge</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($charges as $charge)
            <tr>
                <td>{{$charge->id}}</td>
                <td>{{number_format($charge->shipping_charge, 2)}}</td>
                <td>{{number_format($charge->shipping_total_limit, 2)}}</td>
                <td>{{number_format($charge->cod_charge, 2)}}</td>
                <td><a href="{{url('admin/charge/'.$charge->id)}}" class="btn btn-success">Action</a></td>
            </tr>
            @endforeach

            </tbody>
        </table>
@endsection
