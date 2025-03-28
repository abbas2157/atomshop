@extends('website.layout.app')
@section('title')
    <title>Quick Installment Calculator | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="Quick Installment Calculator | Atomshop - Pay in steps" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    @include('website.calculator.partials.installment-calculator')
    @include('website.partials.featured-start')
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