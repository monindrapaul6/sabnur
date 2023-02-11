@extends('frontend.layout.app')
@section('content')

<h4>Invoices</h4>

@foreach($invoices as $invoice)
    <div class="col-6 border">
        <a href="{{url('invoice/' . $invoice->id)}}">
            <h5>Invoice id: {{$invoice->id}}</h5>
            <p>Total: Rs. {{$invoice->total}}</p>
            <p class="{{$invoice->status == 'ACTIVE' ? 'btn bg-success' : 'btn bg-danger'}}">{{$invoice->status}}</p>
        </a>
    </div>
@endforeach

@endsection
