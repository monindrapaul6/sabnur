@extends('frontend.layout.app')
@section('content')

    <h1>Checkout</h1>

    <form action="{{url('/checkoutPost')}}" method="post">
        @csrf
    <div style="width: 50%; float: left">
    <h3>Address</h3>

    @if(count($addresses) > 0)
        @foreach($addresses as $address)
            <p>
                <input type="radio" name="address_id" class="selectAddress" value="{{$address->id}}" id="{{'address' . $address->id}}">
                <label for="{{'address' . $address->id}}">{{$address->name . ' - ' . $address->zip}}</label>
            </p>
        @endforeach
    @else
        <a href="{{url('/address/create')}}">Create address</a>
    @endif

    <h3>Products</h3>
    <?php $mrp_total = 0 ; $total = 0; $discount = 0; ?>
    @foreach($products as $details)
        <?php $total += $details['product_current_price'] * $details['quantity'] ?>
            <?php $mrp_total += $details['product_mrp_price'] * $details['quantity'] ?>
        <div class="col-12 p-0 mx-0 mt-0 mb-3 d-inline-block">
            <div class="col-2 p-0 m-0 float-left">
                <img src="{{ asset($details['photo']) }}"><span class="imgspan">{{ $details['quantity'] }}</span>
            </div>
            <div class="col-7 col-sm-7 py-0 pl-5 pr-0 m-0 float-left">
                {{ strip_tags(htmlspecialchars_decode($details['name']))}}


                ID: <input type="text" name="ids[]" id="ids" value="{{ $details['id']  }}">
                P NAME: <input type="text" name="product_name[]" id="product_name" value="{!! $details['name']  !!}">
                MRP: <input type="text" name="product_mrp_price" id="product_mrp_price" value="{{ $details['product_mrp_price'] }}">
                CURRENT: <input type="text" name="product_current_price[]" id="product_current_price" value="{{ $details['product_current_price']  }}">
                QTY: <input type="text" name="quantity[]" id="quantity" value="{{ $details['quantity']  }}">
                TOTAL: <input type="text" name="total[]" id="total" value="{{ $details['product_current_price'] * $details['quantity']  }}">


            </div>
            <div class="col-3 col-sm-3 p-0 m-0 float-right text-right">
                Rs. {{ number_format($details['product_current_price'] * $details['quantity'], 2) }}
            </div>
        </div>
    @endforeach
    </div>

    <div style="width: 50%; float: left">
            <div class="col-8 col-sm-8 p-0 m-0 float-left">
                <input type="text" name="zip_available" id="zip_available" value="1"> IS zip_available
                <input type="text" name="is_delivery" id="is_delivery" value="0"> IS DELIVERY
                <input type="text" name="is_cod" id="is_cod" value="0"> IS COD
                <p>Price (2 Items): Rs. {{ number_format($mrp_total, 2)}}
                    <input type="text" name="sub_total" id="sub_total" value="{{$mrp_total}}">
                </p>
                <p>
                    Discount: {{number_format($mrp_total - $total, 2)}}
                    <input type="text" name="discount" id="discount" value="{{$mrp_total - $total}}">
                </p>
                <p>
                    Delivery Charge: {{number_format($deliverycharge, 2)}}
                    <input type="text" name="delivery_charge" id="delivery_charge" value="0">
                </p>
                <p>
                    <strong>
                        Total Amount: {{number_format($total + $deliverycharge, 2)}}
                        <input type="text" name="total" id="total" value="{{$total + $deliverycharge}}">
                    </strong>
                </p>
            </div>
            <button type="submit" id="submitBtn">Place Order</button>
            <h6 id="submitErrorMsg" style="display: none">Sorry your zip is not availabe</h6>
    </div>
    </form>
    <script type = "text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.selectAddress').click(function(){
            //we will send data and recive data fom our AjaxController
            //alert("im just clicked click me");
            $.ajax({
                url:'getdeliveryDetails',
                data:{
                    'id': $(this).val()
                },
                type:'post',
                success:  function (response) {
                    //alert(response.zip_available);
                    $('#zip_available').val(response.zip_available);
                    $('#is_delivery').val(response.is_delivery);
                    $('#is_cod').val(response.is_cod);
                    if(response.zip_available === 0){
                        $('#submitBtn').hide();
                        $('#submitErrorMsg').show();
                    }
                    if(response.is_delivery === 0){
                        $('#submitBtn').hide();
                        $('#submitErrorMsg').show();
                    }
                    else{
                        $('#submitBtn').show();
                        $('#submitErrorMsg').hide();
                    }
                },
                statusCode: {
                    404: function() {
                        alert('web not found');
                    }
                },
                error:function(x,xs,xt){
                    window.open(JSON.stringify(x));
                    //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
                }
            });
        });
    </script>

@endsection
