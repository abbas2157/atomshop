@extends('website.layout.app')
@section('title')
    <title>Atomshop - Pay in steps</title>
    <meta content="Atomshop - Pay in steps" name="description">
@endsection
@section('content')
    @include('website.home.partials.sliders')
    @include('website.home.partials.featured-start')
    @include('website.home.partials.categories')
    @include('website.home.partials.featured-products')
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-6 mt-2">
                <a href="{{ route('brand','apple') }}">
                    <img class="img-fluid" src="{{ asset('sliders/apple.png') }}" alt="Atomshop - Pay in steps">
                </a> 
            </div>
            <div class="col-lg-6 mt-2">
                <a href="{{ route('category','mobile-phone') }}">
                    <img class="img-fluid" src="{{ asset('sliders/android.png') }}" alt="Atomshop - Pay in steps">
                </a>
            </div>
        </div>
    </div>
    @include('website.home.partials.recent-products')
    @include('website.home.partials.brands')
@endsection
