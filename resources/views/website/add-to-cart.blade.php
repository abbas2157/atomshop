@extends('website.layout.app')
@section('title')
    <title>Add To Cart| {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="Add To Cart | Atomshop - Pay in steps">
@endsection
@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <meta name="csrf-token" content="{{ csrf_token() }}">

                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartItems as $cart)
                            <tr>
                                <td class="align-middle">
                                    <img src="{{ asset('img/' . $cart->product->image) }}" alt=""
                                        style="width: 50px;">
                                    {{ $cart->product->title }}
                                </td>
                                <td class="align-middle">${{ $cart->product->price }}</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus" data-id="{{ $cart->id }}">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $cart->quantity }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus" data-id="{{ $cart->id }}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle total-price">${{ $cart->product->price * $cart->quantity }}</td>
                                <td class="align-middle">
                                    <button class="btn btn-sm btn-danger remove-item" data-id="{{ $cart->id }}">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 class="sub-total">$
                                {{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 class="cart-total">$
                                {{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) + 10 }}</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            let updating = false;
            $(".btn-plus, .btn-minus").off('click').on('click', function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();
                if (updating) return;
                updating = true;

                let $btn = $(this);
                let id = $btn.data("id");
                let $quantityInput = $btn.closest("tr").find("input");
                let newQuantity = parseInt($quantityInput.val()) + ($btn.hasClass("btn-plus") ? 1 : -1);
                if (newQuantity < 1) newQuantity = 1;

                $.ajax({
                    url: "/update-cart/" + id,
                    type: "POST",
                    data: {
                        quantity: newQuantity,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            $quantityInput.val(newQuantity);
                            $btn.closest("tr").find(".total-price").text("$" + response
                                .total_price);
                            $(".cart-total").text("$" + response.cart_total);
                            $(".sub-total").text("$" + response.subtotal);
                        }
                    },
                    complete: function() {
                        updating = false;
                    }
                });
            });

            $(".remove-item").off('click').on('click', function(event) {
                event.preventDefault();
                event.stopImmediatePropagation();
                let $btn = $(this);
                let id = $btn.data("id");

                $.ajax({
                    url: "/remove-cart/" + id,
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            $btn.closest("tr").remove();
                            $(".cart-total").text("$" + response.cart_total);
                            $(".sub-total").text("$" + response.subtotal);
                        }
                    }
                });
            });
        });
    </script>
@endsection
