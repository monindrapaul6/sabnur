@extends('frontend.layout.app')
@section('content')

    <h1>Invoice ID:</h1>

    <h6>Address</h6>
    <p>{{$invoice->invoice_address->zip}}</p>
    <p>{{$invoice->invoice_address->city}}</p>

    <h6>Products</h6>
    @foreach($invoice->invoice_orders as $order)
        <p>
            {{$order->order_product->product_name}} - {{$order->product_quantity}} - {{$order->product_total_price}}
        </p>
    @endforeach

    <h6>Payment Status: {{$invoice->payment_mode}}</h6>
    <h6>Is Paid: {{$invoice->is_paid == true ? "YES" : "NO"}}</h6>
    <h6>Status: {{$invoice->status}}</h6>

    <button id="makePaymentBtn">Make Payment</button>

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function (e){
            return makePayment();
        });

        $('#makePaymentBtn').click(function (e){
            return makePayment();
        });

        function makePayment (e){
            var SITEURL = '{{URL::to('/')}}';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var totalAmount = "{{$invoice->payment_amount}}";
            var options = {
                "key": "{{ Config::get('custom.razor_key') }}",
                "amount": (totalAmount * 100), // 2000 paise = INR 20
                "name": "Aplus Device",
                "description": "Payment for Aplus Device",
                "image": "{{asset('backend/images/A-pluslogo.png')}}",
                "handler": function (response){
                    $.ajax({
                        url: "{{url('/')}}" + '/makePayment',
                        type: 'post',
                        dataType: 'json',
                        data: {
                            invoice_id: "{{$invoice->id}}",
                            razorpay_payment_id: response.razorpay_payment_id,
                            totalAmount : totalAmount
                        },
                        success: function (msg) {
                            window.location.href = "{{url('/')}}" + '/invoice/' + {{$invoice->id}};
                        }
                    });
                },
                "prefill": {
                    "contact": '+91 8013647571',
                    "email":   'customercare@aplusdevice.com',
                },
                "theme": {
                    "color": "#626e13"
                }
            };
            var rzp1 = new Razorpay(options);
            rzp1.open();
            e.preventDefault();
        }
    </script>
@endsection
