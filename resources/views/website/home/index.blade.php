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
    @include('website.home.partials.brands')
    @include('website.home.partials.recent-products')
@endsection
