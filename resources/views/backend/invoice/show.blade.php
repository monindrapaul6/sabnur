@extends('backend.layout.app')
@section('content')

        <ol class="breadcrumb bc-3" >
            <li>
                <a href="{{url('/')}}"><i class="fa-home"></i>Home</a>
            </li>
            <li>
                <a href="{{url('admin/invoices')}}">Invoices</a>
            </li>
            <li class="active">
                <strong>{{$invoice->invoice_no}}</strong>
            </li>
        </ol>

        <h2>Invoice No: {{$invoice->invoice_no}}</h2>
        <br />
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-primary" data-collapsed="0">
                    <div class="panel-body">
                        <div class="form-group">
                            Order No: <strong>{{$invoice->order_no}}</strong>
                        </div>
                        <div class="form-group">
                            Order Date: <strong>{{$invoice->created_at->format('d M Y')}}</strong>
                        </div>
                        <div class="form-group">
                            Name: <strong>{{$invoice->invoice_address->name}}</strong>
                        </div>
                        <div class="form-group">
                            Mobile: <strong>{{$invoice->invoice_address->contact_no}}</strong>
                        </div>
                        <div class="form-group">
                            Email: <strong>{{$invoice->invoice_address->email}}</strong>
                        </div>
                        <div class="form-group">
                            Address: {{$invoice->invoice_address->street}}<br>
                                     {{$invoice->invoice_address->city}}<br>
                                     {{$invoice->invoice_address->locality}}<br>
                                     {{$invoice->invoice_address->state}}<br>
                                     {{$invoice->invoice_address->zip}}<br>
                                     {{$invoice->invoice_address->country}}<br>
                                     {{$invoice->invoice_address->landmark}}
                        </div>
                        <div class="form-group">
                            <a href="{{url('invoice/'.$invoice->id)}}" target="_blank" class="btn btn-success">View Invoice</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="panel panel-primary" data-collapsed="0">
                    <div class="panel-body">

                        <div class="form-group" style="display: inline-block">
                            <div class="col-2" style="float: left; margin-right: 12px;">
                                @isset($invoice->invoiceProduct->productDPImage->image_thumb)
                                    <img src="{{asset($invoice->invoiceProduct->productDPImage->image_thumb)}}" width="75px" height="75px">
                                @endif
                            </div>
                            <div class="col-8" style="float: left">
                                <strong>{{strip_tags(htmlspecialchars_decode($invoice->invoiceProduct->product_name))}}</strong><br>
                                MRP Price: Rs. {{number_format($invoice->product_mrp_price, 2)}}<br>
                                Current Price: Rs. {{number_format($invoice->product_current_price, 2)}}<br>
                                Qty: {{$invoice->product_quantity}}<br>
                                @if($invoice->special_discount != 0)Welcome offer {{$invoice->special_discount}}<br/>@endif
                                Total: <strong>Rs. {{number_format($invoice->product_total_price, 2)}}</strong>
                            </div>
                        </div>

                        <div class="form-group">
                            Status: @if($invoice->status == false)<span class="badge badge-danger">INACTIVE</span>@else<span class="badge badge-success">ACTIVE</span>@endif
                        </div>
                        <form action="{{url('admin/invoice/update')}}" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{$invoice->id}}">
                            <div class="form-group">
                                Payment Status:
                                <select name="is_paid" id="is_paid" class="bg-transparent border-0">
                                    <option value="1" @if($invoice->is_paid == true) selected @endif>Paid</option>
                                    <option value="0" @if($invoice->is_paid == false) selected @endif>Not Paid</option>
                                </select>
                            </div>
                            <div class="form-group">
                                Order Status:
                                <select class="form-control" name="order_status">
                                    <option value="ORDER GENERATED" @if($invoice->order_status == 'ORDER GENERATED') selected @endif>ORDER GENERATED</option>
                                    <option value="ORDER PROCESSED" @if($invoice->order_status == 'ORDER PROCESSED') selected @endif>ORDER PROCESSED</option>
                                    <option value="ORDER SHIPPED" @if($invoice->order_status == 'ORDER SHIPPED') selected @endif>ORDER SHIPPED</option>
                                    <option value="ORDER DELIVERED" @if($invoice->order_status == 'ORDER DELIVERED') selected @endif>ORDER DELIVERED</option>
                                </select>
                            </div>
                            <div class="form-group">
                                AWB No:
                                <input type="text" name="courier_awb_code" value="{{$invoice->courier_awb_code}}" class="form-control">
                            </div>
                            <div class="form-group">
                                Courier Name:
                                <input type="text" name="courier_courier_name" value="{{$invoice->courier_courier_name}}" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
@endsection
