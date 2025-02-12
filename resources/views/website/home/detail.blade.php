@extends('website.layout.app')
@section('title')
    <title>{{ $product['title'] ?? '' }} | Atomshop - Pay in steps</title>
    <meta content="Atomshop - Pay in steps" name="description">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('website') }}"> Home </a>
                    <a class="breadcrumb-item text-dark" href="{{ route('website') }}"> Shop </a>
                    <a class="breadcrumb-item text-dark" href=""> {{ $product['category']['title'] ?? '' }} </a>
                    <a class="breadcrumb-item text-dark" href=""> {{ $product['brand']['title'] ?? '' }} </a>
                    <span class="breadcrumb-item active"> {{ $product['title'] ?? '' }}</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel " class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light p-30">
                        <div class="carousel-item text-center active">
                            <img class="w-75 h-75" src="{{ asset($product['picture'] ?? '') }}" alt="Image">
                        </div>
                        @foreach ($product['gallery'] as $item)
                            <div class="carousel-item text-center">
                                <img class="w-75 h-75" src="{{ asset($item['url'] ?? '') }}" alt="Image">
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{ $product['detail_page_title'] ?? '' }}</h3>
                    <div class="mb-2">
                        <div><b>Category : </b>{{ $product['category']['title'] ?? '' }}</div>
                        <div><b>Brand : </b>{{ $product['brand']['title'] ?? '' }}</div>
                    </div>
                    <h3 class="font-weight-semi-bold mb-2">Rs. <span class="variation-price">{{ number_format($product['variation_price']) }}</span></h3>
                    <p class="mb-2">{!! nl2br($product['short_description']) ?? '' !!}</p>
                    @if(!empty($product['memories']))
                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Choose Memory :</strong>
                        @foreach ($product['memories'] as $item)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input variation-memory" value="{{ $item['id'] ?? '' }}" {{ $item['active'] ? 'checked' : '' }} id="size-{{ $item['id'] ?? '' }}" name="memory">
                                <label class="custom-control-label" for="size-{{ $item['id'] ?? '' }}">{{ $item['title'] ?? '' }}</label>
                            </div>
                        @endforeach
                    </div>
                    @endif
                    @if(!empty($product['colors']))
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Choose Color :</strong>
                        @foreach ($product['colors'] as $item)
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" {{ $item['active'] ? 'checked' : '' }} id="color-{{ $item['id'] ?? '' }}" name="color">
                                <label class="custom-control-label" for="color-{{ $item['id'] ?? '' }}">{{ $item['title'] ?? '' }}</label>
                            </div>
                        @endforeach
                    </div>
                    @endif
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3 add-to-cart" data-id="{{ $product['id'] ?? '' }}" ><i class="fa fa-shopping-cart mr-1"></i> Add To Cart</button>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark " data-toggle="tab"
                            href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-3">Installment Calculator</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade " id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p>{!! $product['long_description'] ?? '' !!}</p>
                        </div>
                        <div class="tab-pane fade show active" id="tab-pane-3">
                            @php
                                $calculator = App\Models\InstallmentCalculator::first();
                            @endphp
                            @include('website.home.partials.installment')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Products Start -->
    <div class="container-fluid py-5">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You May Also Like</span></h2>
        <div class="row px-xl-5">
            @foreach($products as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    @include('website.partials.single-item')
                </div>
            @endforeach
        </div>
    </div>
    <!-- Products End -->
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    var total = parseInt("{{ $product['variation_price'] ?? 0 }}");
    console.log(total);
    @if(is_null($calculator)) 
        var total_tenure_percentage = 4;
    @else 
        var total_tenure_percentage = parseInt('{{ $calculator->per_month_percentage?? 0 }}');
    @endif
    var memories = [];
    @if(!empty($product['memories']))
        memories =  JSON.parse('{{ json_encode($product['memories']) }}'.replace(/&quot;/g, '"'));
    @endif
</script>
<script src="{!! asset('web/js/shop.js') !!}"></script>
@endsection