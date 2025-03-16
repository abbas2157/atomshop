@extends('website.layout.app')
@section('title')
    <title>Checkout | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="Add To Cart | Atomshop - Pay in steps">
@endsection
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('website') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('cart') }}">Cart</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Checkout Start -->
    <div class="container-fluid">
        <form action="{{ route('checkout.perform') }}" method="POST">
            @csrf
            <div class="row px-xl-5">
                <div class="col-lg-8">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Customer Information</span></h5>
                    @if (is_null(Auth::user()->customer) || Auth::user()->customer->verified == '0')
                        <div class="alert alert-warning" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <strong>Note !</strong> Get verified yourself immediately. Our agent will visite you soon.
                        </div>
                    @endif
                    <div class="bg-light p-30 mb-5">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Full Name (پورا نام)</label>
                                <input class="form-control" type="text" name="name" placeholder="Enter full name"
                                    value="{{ Auth::user()->name ?? '' }}" @auth readonly @endauth required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No (موبائل نمبر)</label>
                                <input class="form-control" type="text" name="phone" placeholder="+92 300 1122333"
                                    value="{{ Auth::user()->phone ?? '' }}" @auth readonly @endauth required>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail (ای میل ایڈریس)</label>
                                <input class="form-control" name="email" type="text" placeholder="example@email.com"
                                    value="{{ Auth::user()->email ?? '' }}" @auth readonly @endauth required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>Select City (شہر منتخب کریں)</label>
                                <select class="custom-select" name="city_id" required>
                                    @if ($cities->isNotEmpty())
                                        @foreach ($cities as $item)
                                            <option value="{{ $item->id ?? '' }}"
                                                {{ !is_null(Auth::user()->customer) && Auth::user()->customer->city_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->title ?? '' }}</option>
                                        @endforeach
                                    @else
                                        <option value="0">No City Found</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Select Area</label>
                                <select class="custom-select select2" name="area_id" id="area_id" required>
                                    @if ($areas->isNotEmpty())
                                        @foreach ($areas as $item)
                                            <option value="{{ $item->id ?? '' }}" data-city-id="{{ $item->city_id }}"
                                                {{ !is_null(Auth::user()->customer) && Auth::user()->customer->area_id == $item->id ? 'selected' : '' }}>
                                                {{ $item->title ?? '' }}</option>
                                        @endforeach
                                    @else
                                        <option value="0">No Area Found</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Address Line (پتہ)</label>
                                <input class="form-control" name="address" required type="text" placeholder="123 Street"
                                    value="{{ !is_null(Auth::user()->customer) ? Auth::user()->customer->address : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order
                            Total</span></h5>
                    <div class="bg-light p-30 mb-5">
                        <div class="border-bottom">
                            <h6 class="mb-3">Products</h6>
                            @php
                                $total = 0;
                            @endphp
                            @if ($cart->isNotEmpty())
                                @foreach ($cart as $item)
                                    <div class="d-flex justify-content-between">
                                        <p>{{ $item->product->title ?? '' }}</p>
                                        <p>Rs. {{ number_format($item->product->price * $item->quantity, 0) }}</p>
                                    </div>
                                    <input type="hidden" name="cart_id[]" value="{{ $item->id ?? '' }}">
                                    @php
                                        $total += $item->product->price * $item->quantity;
                                    @endphp
                                @endforeach
                            @else
                                <div class="text-center py-3">
                                    <img src="{{ asset('web/img/loader.gif') }}" class="w-10" alt="Loader">
                                </div>
                            @endif
                        </div>
                        <div class="border-bottom pt-3 pb-2">
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Shipping</h6>
                                <h6 class="font-weight-medium">Rs. 0</h6>
                            </div>
                        </div>
                        <div class="pt-2 mb-5">
                            <div class="d-flex justify-content-between mt-2">
                                <h5>Total</h5>
                                <h5>Rs. {{ number_format(($total),0) }}</h5>
                            </div>
                        </div>
                        <div class="pt-2">
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">My Profile</h6>
                                <h6 class="font-weight-medium"><a href="{{ route('profile') }}">Edit</a></h6>
                            </div>
                        </div>
                        <div class="pt-3 pb-2 mb-2">
                            <div class="d-flex justify-content-between">
                                <h6 class="font-weight-medium">Remove Products</h6>
                                <h6 class="font-weight-medium"><a href="{{ route('cart') }}">Edit</a></h6>
                            </div>
                        </div>
                        @if((is_null(Auth::user()->customer)) || is_null(Auth::user()->customer->address))
                            <div class="alert alert-warning" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Note !</strong> Please update city, area & address in your profile before order place. <a href="{{ route('profile') }}"> My Profile</a>
                            </div>
                        @endif
                        @if($cart->isNotEmpty())
                            <button class="btn btn-block btn-primary font-weight-bold py-3" {{ ((is_null(Auth::user()->customer)) || is_null(Auth::user()->customer->address)) ? 'disabled' : '' }} type="submit">Place Order</button>
                        @endif
                    </div>

                </div>
            </div>
        </form>
        @include('website.home.partials.featured-start')
    </div>
    <!-- Checkout End -->
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
             var areaSelect = $('select[name="area_id"]');
             var allAreaOptions = areaSelect.find('option').clone();
             areaSelect.select2();
             $('select[name="city_id"]').on('change', function() {
                 var cityId = $(this).val();
                 areaSelect.empty().append(allAreaOptions.filter('[data-city-id="' + cityId + '"]'));
                 areaSelect.val(areaSelect.find('option:first').val()).trigger('change').select2();
             });
             $('select[name="city_id"]').trigger('change');
         });
    </script>
@endsection
