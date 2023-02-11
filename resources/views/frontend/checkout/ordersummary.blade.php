<div class="billing-info-wrap border-bottom mt-3 pb-3">
    <h3>Order Summary</h3>

    <div class="row">
        <?php
        $product_mrp_total = 0;
        $product_current_total = 0;
        $discount = 0;
        $sub_total = 0;
        $total = 0;
        $qty = 0;
        ?>
        @foreach($carts as $cart)
            <?php $product_mrp_total += $cart->cart_product->product_mrp_price * $cart->product_quantity ?>
            <?php $product_current_total += $cart->cart_product->product_current_price * $cart->product_quantity ?>
            <?php $qty = $qty + $cart->product_quantity;?>

            <input type="hidden" name="ids[]" value="{{$cart->product_id}}">
            <input type="hidden" name="quantity[]" value="{{$cart->product_quantity}}">
            <input type="hidden" name="product_total_price[]" value="{{$cart->cart_product->product_current_price * $cart->product_quantity}}">
            <div class="col-12 mt-3 pb-3 d-flex">
                <div class="col-2">
                    @isset($cart->cart_product->productDPImage->image_thumb)
                        <img src="{{ asset($cart->cart_product->productDPImage->image_thumb) }}"/>
                    @endif
                </div>
                <div class="col-4" style="text-align: right">
                    <strong>{{$cart->cart_product->product_name}}</strong>
                </div>
                <div class="col-3" style="text-align: right">
                <!--Price: Rs. {{number_format($cart->cart_product->product_current_price, 2)}}-->
                    Quantity: <strong>{{$cart->product_quantity}}</strong>
                </div>
                <div class="col-3" style="text-align: right">
                    <strong>Rs. {{ number_format($cart->cart_product->product_current_price * $cart->product_quantity, 2) }}</strong>
                </div>
            </div>

        @endforeach
        <?php
        $total = $product_current_total +  $shipping_charge;
        ?>

        <span class="btn btn-primary" id="makePayment" style="display: none">Make Payment</span>
    </div>
</div>
