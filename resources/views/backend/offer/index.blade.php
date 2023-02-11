@extends('backend.layout.app')
@section('content')

        <ol class="breadcrumb bc-3" >
            <li>
                <a href="{{url('/admin')}}"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                Offers
            </li>
        </ol>

        <h3>Offers</h3>
        <br />
        <a href="{{url('admin/offer/create')}}" class="btn btn-success">Add Offer</a>
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
                <th>Offer Name</th>
                <th>Offer Value</th>
                <th>Offer Start</th>
                <th>Offer Expiry</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($offers as $offer)
            <tr>
                <td>{{$offer->id}}</td>
                <td>{{$offer->offer_name}}</td>
                <td>{{$offer->offer_value}}</td>
                <td>{{$offer->offer_start}}</td>
                <td>{{$offer->offer_expiry}}</td>
                <td>@if($offer->status == 'ACTIVE')<span class="badge badge-success">Active</span>@else<span class="badge badge-danger">Inactive</span>@endif</td>
                <td><a href="{{url('admin/offer/'.$offer->id)}}" class="btn btn-success">Action</a></td>
            </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
                <th>Id</th>
                <th>Offer Name</th>
                <th>Offer Value</th>
                <th>Offer Start</th>
                <th>Offer Expiry</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
@endsection
