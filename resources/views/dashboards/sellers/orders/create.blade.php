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
        @include('dashboards/sellers/orders/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <form method="POST" action="{{ route('seller.orders.store') }}" enctype="multipart/form-data">
                @csrf
                @include('dashboards/sellers/orders/partials/create-partial')
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="{!! asset('assets/lib/select2/js/select2.min.js') !!}"></script>
    <script>
        @if(is_null($calculator))
            var tenure_percentage = 4;
        @else
            var tenure_percentage = parseInt('{{ $calculator->per_month_percentage?? 0 }}');
        @endif
    </script>
    <script src="{!! asset('assets/js/seller/order/create.js') !!}"></script>
@endsection
