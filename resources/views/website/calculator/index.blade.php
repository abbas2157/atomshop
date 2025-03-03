@extends('website.layout.app')
@section('title')
    <title>Installment Calculator | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="Installment Calculator | Atomshop - Pay in steps" >
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container">
        <div class="row px-xl-5 mb-5">
            <div class="col-12">
                <div class="bg-light p-30">
                    <div class="mb-3">
                        <h4>Calculate, Order, We Source!</h4>
                    </div>
                    <div>
                        <p>
                            Get any product from the market with a flexible installment plan. Just follow these simple steps:
                        </p>
                        <ol>
                            <li><b>Choose Your Product </b> – Pick any product from the market that you want to buy.</li>
                            <li><b>Calculate Installments </b> – Use our Installment Calculator to plan your payment schedule.</li>
                            <li><b>Place Your Order</b> - Fill out the custom product order form with the details.</li>
                            <li><b>We Handle the Rest</b> – Our team will contact you to process and finalize your order!</li>
                        </ol>
                        <p>
                            🔹 A 5% sourcing agent fee applies for custom market sourcing.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
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