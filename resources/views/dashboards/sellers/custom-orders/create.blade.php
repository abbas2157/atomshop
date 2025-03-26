@extends('dashboards.sellers.layout.app')
@section('title')
    <title>Orders - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('css')
    <link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
</style>
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/sellers/custom-orders/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Orders Management</span>
                <span>Custom</span>
            </div>
            <h2 class="az-content-title">Custom Orders</h2>
            <div class="az-content-label mg-b-5">Create new one</div>
            <p class="mg-b-20">All Custom Orders will start from here.</p>
            <form method="POST" action="{{ route('seller.custom-orders.store') }}" enctype="multipart/form-data">
                @csrf
                @include('dashboards/sellers/custom-orders/partials/create-partial')
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="{!! asset('assets/lib/select2/js/select2.min.js') !!}"></script>
    <script>
        var tenure_percentage = 5;
    </script>
    <script src="{!! asset('assets/js/seller/order/custom-order.js') !!}"></script>
@endsection
