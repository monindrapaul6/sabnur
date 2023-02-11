@extends('backend.layout.app')
@section('content')
        <ol class="breadcrumb bc-3" >
            <li>
                <a href="{{url('admin/')}}"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="{{url('admin/invoices')}}">Invoices</a>
            </li>
        </ol>

        <h3>Invoices</h3>
        <br />
        <!--<div class="col-md-12 form-group" style="background-color: #c7dbff; display: inline-block; padding: 8px 0; z-index: 999">
            <form action="{{url('admin/invoices')}}">
            <div class="col-md-4">
                <label for="daterange">Date Range</label>
                <select name="daterange">
                    <option value="7days">Last 7 Days</option>
                    <option value="30days">Last 30 Days</option>
                    <option value="60days">Last 60 Days</option>
                </select>
            </div>
                <div class="col-md-4">
                    <label for="status">Status</label>
                    <select name="status">
                        <option value="">Select</option>
                        <option value="ORDER GENERATED">ORDER GENERATED</option>
                        <option value="ORDER PROCESSED">ORDER PROCESSED</option>
                        <option value="ORDER SHIPPED">ORDER SHIPPED</option>
                        <option value="ORDER DELIVERED">ORDER DELIVERED</option>
                    </select>
                </div>
            <div class="col-md-4">
                <input type="submit" class="btn-success" value="Filter Invoices">
            </div>
            </form>
        </div>-->
        <br>

        <script type="text/javascript">
            jQuery( document ).ready( function( $ ) {
                var $table4 = jQuery( "#table-1" );

                $table4.DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5',
                        'pdfHtml5'
                    ],
                    "order": [[ 0, "desc" ]]
                } );
            } );
        </script>
        <table class="table table-bordered datatable" id="table-1">
            <thead>
            <tr>
                <th>Id</th>
                <th>Invoice No</th>
                <th>Order No</th>
                <th>Order Date</th>
                <th>Customer Name</th>
                <th>Customer Mobile</th>
                <th>Address</th>
                <th>Product</th>
                <th>MRP</th>
                <th>Current Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{$invoice->id}}</td>
                <td>{{$invoice->invoice_no}}</td>
                <td>{{$invoice->order_no}}</td>
                <td>{{$invoice->created_at->format('d M Y')}}</td>
                <td>{{$invoice->invoice_address->name}}</td>
                <td>{{$invoice->invoice_address->contact_no}}</td>
                <td>{{$invoice->invoice_address->street . ', ' . $invoice->invoice_address->city . ', ' . $invoice->invoice_address->zip}}</td>
                <td>{{$invoice->invoiceProduct->product_name}}</td>
                <td>{{number_format($invoice->product_mrp_price, 2)}}</td>
                <td>{{number_format($invoice->product_current_price, 2)}}</td>
                <td>{{$invoice->product_quantity}}</td>
                <td>{{number_format($invoice->product_total_price, 2)}}</td>
                <td><span class="badge badge-primary">{{$invoice->order_status}}</span></td>
                <td><a href="{{url('admin/invoice/'.$invoice->id)}}" class="btn btn-success">Action</a></td>
            </tr>
            @endforeach

            </tbody>
            <tfoot>
            <tr>
            <tr>
                <th>Id</th>
                <th>Invoice No</th>
                <th>Order No</th>
                <th>Order Date</th>
                <th>Customer Name</th>
                <th>Customer Mobile</th>
                <th>Address</th>
                <th>Product</th>
                <th>MRP</th>
                <th>Current Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
        <br />
@endsection
