@extends('frontend.layout.app')
@section('content')

    <h4>Invoice No: {{$invoice->id}}</h4>

    <h6>Address</h6>
    <p>{{$invoice->invoice_address->name}}</p>
    <p>{{$invoice->invoice_address->contact_no}}</p>
    <p>{{$invoice->invoice_address->street}}</p>
    <p>{{$invoice->invoice_address->city}}</p>
    <p>{{$invoice->invoice_address->state}}</p>
    <p>{{$invoice->invoice_address->zip}}</p>

    <hr/>

    <h6>Products</h6>

    @foreach($invoice->invoice_orders as $order)
        <p>
            {{$order->order_product->product_name}} => Qty. {{$order->product_quantity}} => {{$order->product_total_price}}
        </p>
    @endforeach

    <hr/>

    <h4>Total: {{$invoice->total}}</h4>

    <hr/>

    <h5>Status: <span class="{{$invoice->status == 'ACTIVE' ? 'btn btn-primary' : 'btn btn-danger'}}">{{$invoice->status}}</span></h5>
    <hr/>

    <h5>Order Status: {{$invoice->order_status}}</h5>

    @if($invoice->status == 'INACTIVE')
    <button class="btn btn-primary" onclick="alert('Payment Gateway Implementation')">Pay Now</button>
    <hr/>
    @endif

    @if($invoice->order_status == 'ORDER DELIVERED')
    <h5>Download Invoice</h5>
    <button class="btn btn-success" onclick='window.location.href="/invoice/{{$invoice->id}}/download"'>Click Here</button>
    <hr/>
    @endif

    <h4>Rate & Review</h4>
    @if($invoice->invoiceUserFeedback($invoice->user_id))
        <p>Rate: {{$invoice->invoiceUserFeedback($invoice->user_id)->rating}}</p>
        <p>Description: {{$invoice->invoiceUserFeedback($invoice->user_id)->description}}</p>
    @else
    <form action="{{url('postFeedback')}}" method="post">
        @csrf
        <input type="hidden" name="invoice_id" value="{{$invoice->id}}">

        <p>
            <label for="rating">Rating</label>
            <select name="rating" id="rating">
                <option value="5">5</option>
                <option value="4">4</option>
                <option value="3">3</option>
                <option value="2">2</option>
                <option value="1">1</option>
            </select>
        </p>
        <p>
            <label for="description">description</label>
            <textarea name="description" id="description"></textarea>
        </p>
        <p>
            <button type="submit" class="btn btn-primary">Submit Rating</button>
        </p>
    </form>
    @endif
@endsection
