@extends('dashboards.admin.layout.app')
@section('title')
    <title>Orders - {{ env('APP_NAME') ?? '' }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/admin/orders/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <form method="POST" action="{{ route('admin.orders.store') }}" enctype="multipart/form-data">
                @csrf
            @include('dashboards/admin/orders/partials/create-partial')
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @php
        $calculator = App\Models\InstallmentCalculator::first();
    @endphp
    <script>
        @if(is_null($calculator))
            var tenure_percentage = 4;
        @else
            var tenure_percentage = parseInt('{{ $calculator->per_month_percentage?? 0 }}');
        @endif
    </script>
    <script src="{!! asset('web/js/installment-calculator.js') !!}"></script>
@endsection
