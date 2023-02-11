@extends('android.layout.app')
@section('content')

<div class="headerInfo">
        <div class="col-12">
            <div>
                <a href="{{url('/account/orders')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    <span>Order Details</span>
                </a>
            </div>
        </div>
    </div>

<div class="section" style="margin-top: 100px; margin-bottom: 100px;">
    <div class="container myOrderDetails">
        <div class="row">
            <div class="col-12 mt-3">
                <h3>View Order Details</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-2 border-bottom pb-3">
                <p>Order Date: <span>{{$order->created_at->format('d M, Y')}}</span></p>
                <p>Order No: <span>{{$order->order_no}}</span></p>
                <p>Total Amount: <span>Rs. 1000</span></p>
                @if($order->order_status == 'ORDER DELIVERED')
                <h5><a href="#" onclick='window.location.href="/invoice/{{$order->id}}/download"'>Download Invoice</a></h5>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3 border-bottom pb-3">
                <h4>Product Details</h4>
                
                @foreach($order->orderInvoices as $invoice)
                    <div class="d-flex py-2">
                        <div class="col-2">
                            <img src="{{asset($invoice->invoiceProduct->productDPImage->image_thumb)}}" class="img-fluid rounded">
                        </div>
                        <div class="col-6 px-2">
                            <h6>{{$invoice->invoiceProduct->product_name}}</h6>
                            <p>Qty: {{$invoice->product_quantity}}</p>
                            <p><strong>₹ {{number_format($invoice->product_total_price, 2)}}</strong></p>
                        </div>
                        <div class="col-4">
                            <h6>{{$invoice->order_status}}</h6>
                            @if($invoice->order_status == 'ORDER DELIVERED')<p>On {{$invoice->created_at->format('d M, Y')}}</p>@endif
                        </div>
                    </div>
                    @if($invoice->order_status == 'ORDER DELIVERED')
                    <div class="col-12 py-2 border mb-3 px-2">
                        <p>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                                <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                            </svg>
                            Rate & Review your Order
                        </p>
                    </div>
                    @endif
                @endforeach

            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3 border-bottom pb-3">
                <h4>Shipment Details</h4>
                <p><strong>{{$order->order_address->name}}</strong><br>
                    {{$order->order_address->street}}, {{$order->order_address->city}}, {{$order->order_address->state}},
                    {{$order->order_address->zip}}<br>
                    <strong>{{$order->order_address->contact_no}}</strong>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-3 paymentMode border-bottom pb-3">
                <h5>Payment Details</h5>
                <p>Sub Total: <span>₹ {{number_format($order->sub_total, 2)}}</span></p>
                <p>Discount: <span>{{$order->discount == 0 ? '₹ 0.00' : '-₹ ' . number_format($order->discount, 2)}}</span></p>
                <p>Delivery Charge: <span>₹ {{number_format($order->delivery_charge, 2)}}</span></p>
                @if($order->payment_mode == 'COD')
                    <p>COD Charge: <span>₹ {{number_format($order->cod_charge, 2)}}</span></p>
                @endif
                @if($order->special_discount !=0)
                    <p>Special Discount: <span>-₹ {{number_format($order->special_discount, 2)}}</span></p>
                @endif
                <p><strong>Total: <span>₹ {{number_format($order->total, 2)}}</span></strong></p>
            </div>
        </div>

        @if($order->order_status == 'ORDER DELIVERED')
        <div class="row">
            <div class="col-12 mt-3 paymentMode border-bottom pb-3">
                <h5>Review Your Order</h5>
                @if($invoice->invoiceUserFeedback($invoice->user_id))
                    <p>Rate: {{$invoice->invoiceUserFeedback($invoice->user_id)->rating}}</p>
                    <p>Description: {{$invoice->invoiceUserFeedback($invoice->user_id)->description}}</p>
                @else
                <form class="account-details-form mt-4" action="{{url('postFeedback')}}" method="post">
                    @csrf
                        <input type="hidden" name="invoice_id" value="{{$invoice->id}}">

                        <div class="single-input-item">
                            <label for="rating" class="required">Rating</label>
                            <select class="selectItem" name="rating" id="rating">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        </div>

                        <div class="single-input-item">
                            <label for="description" class="required">Description</label>
                            <textarea name="description" id="description" rows="6"></textarea>
                        </div>
                        <div class="single-input-item">
                            <button class="check-btn sqr-btn">Submit Rating</button>
                        </div>
                </form>
                @endif
            </div>
        </div>
        @endif
    </div>
</div>

@endsection