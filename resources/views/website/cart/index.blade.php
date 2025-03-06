@extends('website.layout.app')
@section('title')
    <title>Cart | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="Add To Cart | Atomshop - Pay in steps">
@endsection

@section('content')
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 mb-5">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>PR No</th>
                                <th>Product Title</th>
                                <th>Advance Amount</th>
                                <th>Total Deal Amount</th>
                                <th>Installment Tenure</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle cart-table">
                           <tr>
                                <td colspan="5">
                                    <img  src="{{ asset('web/img/loader.gif') }}" class="w-10" alt="Loader">
                                </td>
                           </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-4">
                <form class="mb-30">
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
                            <h6 class="sub-total">Rs. <span id="sub-total"> 00.00 </span></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">Rs. 00</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 class="cart-total">Rs. <span id="total"> 00.00 </span></h5>
                        </div>
                        <a href="{{ route('checkout') }}" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{!! asset('web/js/cart.js') !!}"></script>
@endsection
