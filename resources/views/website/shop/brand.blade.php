@extends('website.layout.app')
@section('title')
    <title>Atomshop - Shop</title>
    <meta content="Atomshop - Pay in steps" name="description">
@endsection
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('website') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('shop') }}">Shop</a>
                    <span class="breadcrumb-item active">{{ $brand->title ?? '' }}</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            @include('website.shop.partials.brand-filter')
            <!-- Shop Sidebar End -->

            <!-- Shop Product Start -->
            <div class="col-lg-9 col-md-8">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div>
                                <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                {{-- <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button> --}}
                            </div>
                            <div class="ml-2">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Latest</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Latest</a>
                                    </div>
                                </div>
                                <div class="btn-group ml-2">
                                    <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                        data-toggle="dropdown">Showing (18)</button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">18</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($products->isEmpty())
                        <p>No products found within this range.</p>
                    @endif
                    @foreach ($products as $item)
                        <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                            @include('website.partials.single-item')
                        </div>
                    @endforeach
                    <div class="col-12">
                        {{ $products->links('vendor.pagination.website') }}
                    </div>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
@endsection
@section('js')
<script src="{!! asset('web/js/shop.js') !!}"></script>
@endsection