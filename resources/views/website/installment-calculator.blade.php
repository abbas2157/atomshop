@extends('website.layout.app')
@section('title')
    <title>Installment Calculator | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="Installment Calculator | Atomshop - Pay in steps" >
@endsection
@section('content')
    @include('website.partials.installment-calculator')
    @include('website.partials.featured-start')
@endsection