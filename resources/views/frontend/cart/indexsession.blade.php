@extends('frontend.layout.app')
@section('content')

    <h1>Cart</h1>

    <?php $total = 0 ?>
    @if(session('cart'))
        @foreach(session('cart') as $id => $details)
            <?php $total += $details['product_current_price'] * $details['quantity'] ?>
            <div style="width: 100%; margin-bottom: 10px">
                    <img src="{{ $details['photo'] }}" width="100" height="100"/>
                    <h4>{{ strip_tags(htmlspecialchars_decode($details['name']))}}</h4>
                {{number_format($details['product_current_price'], 2)}}
                <div data-th="Quantity">
                    <input type="number" value="{{ $details['quantity'] }}" class="quantity" data-id="{{ $id }}" />
                </div>
                <div data-th="Subtotal">
                    <p>Rs. {{number_format($details['product_current_price'] * $details['quantity'], 2)}}</p>
                </div>
                <div>
                    <button data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                </div>
                <div>
                    <span class="remove-from-cart" data-id="{{ $id }}">Remove</span>
                </div>
            </div>
        @endforeach

        <button onclick='window.location.href="/checkout"'>Checkout</button>
    @else
        <h2>No Item in Cart</h2>
    @endif

    <div>
        <h3>Sub Total: Rs. {{number_format($total, 2)}}</h3>
    </div>

    <script type="text/javascript">
        $(".quantity").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            $.ajax({
                url: '{{ url('updateCart') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: ele.parents("div").find(".quantity").val()},
                success: function (response) {
                    window.location.reload();
                }
            });
        });
        $(".remove-from-cart").click(function (e) {
            e.preventDefault();
            var ele = $(this);
            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('removeCart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    </script>
@endsection
