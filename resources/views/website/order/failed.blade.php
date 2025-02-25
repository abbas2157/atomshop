@extends('website.layout.app')
@section('title')
    <title>Order Success | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="Add To Cart | Atomshop - Pay in steps">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('website') }}">Home</a>
                <a class="breadcrumb-item text-dark" href="{{ route('cart') }}">Order</a>
                <span class="breadcrumb-item active"> Success </span>
            </nav>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12">
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Order Confirmation</span>
            </h5>
            <div class="bg-light p-30 mb-5">
                <div class="text-center">
                    <img class="w-10" src="{{ asset('order/failed.png') }}" alt="Order Success">
                    <h4>Order has not been submitted. Something went wrong.</h4>
                    <a href="{{ route('website') }}" class="btn btn-primary px-3" > Go to home</a>
                </div>
            </div>
        </div>
    </div>
    @include('website.home.partials.featured-start')
</div>
@endsection
@section('js')
@endsection
