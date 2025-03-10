@extends('website.layout.app')
@section('title')
    <title>My Profile | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="About | Atomshop - Pay in steps">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('website') }}">Home</a>
                <a class="breadcrumb-item text-dark" href="{{ route('profile') }}">My Profile</a>
                <span class="breadcrumb-item active" >Orders</span>
            </nav>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-3 col-md-4">
            @include('website.profile.partials.sidebar')
        </div>
        <div class="col-lg-9 col-md-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">All Orders</span></h5>
            @if(is_null(Auth::user()->customer) || Auth::user()->customer->verified == '0')
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Note !</strong> Get verified yourself immediately. Our agent will visite you soon.
                </div>
            @endif
            <div class="bg-light mb-30">
                <div class="table-responsive mb-3">
                    <table class="table table-bordered mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th>PR No</th>
                                <th>Product Title</th>
                                <th>Amounts</th>
                                <th>Portal</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="align-middle cart-table">
                            @if($orders->isNotEmpty())
                                @foreach ($orders as $item)
                                    <tr>
                                        <td class="align-middle text-center">{{ $item->cart->product->pr_number ?? '' }}</td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-2 pt-2">
                                                    <img src="{{ asset($item->cart->product->picture) }}" alt="" style="width: 50px;">
                                                </div>
                                                <div class="col-md-10">
                                                    {{ $item->cart->product->title ?? '' }} <br>
                                                    @if(!is_null($item->cart->memory))
                                                        <b>Storage : </b>{{ $item->cart->memory->title ?? '' }} <br>
                                                    @endif
                                                    @if(!is_null($item->cart->color))
                                                        <b>Color : </b>{{ $item->cart->color->title ?? '' }} <br>
                                                    @endif
                                                    @if(!is_null($item->cart->size))
                                                        <b>Size : </b>{{ $item->cart->size->title ?? '' }} <br>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <b>Advance Amount : </b>Rs. {{ number_format($item->advance_price, 0) }} <br>
                                            <b>Total Deal Amount : </b>Rs. {{ number_format($item->total_deal_price,0) }} <br>
                                            <b>Installment Tenure (Months) : </b> {{ $item->instalment_tenure ?? '' }} <br>
                                        </td>
                                        <td class="align-middle text-center">{{ $item->portal ?? '' }}</td>
                                        <td class="align-middle text-center">
                                            {{ $item->status ?? '' }}
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8" class="align-middle text-center">
                                        <div class="text-center py-3">
                                            <img src="{{ asset('web/img/loader.gif') }}" class="w-10" alt="Loader">
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $orders->links('vendor.pagination.website') }}
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>

</script>
@endsection
