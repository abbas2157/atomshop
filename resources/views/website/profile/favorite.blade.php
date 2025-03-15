@extends('website.layout.app')
@section('title')
    <title>Favorite | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
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
                    <span class="breadcrumb-item active">Favorite</span>
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
                <h5 class="section-title position-relative text-uppercase mb-3"><span
                        class="bg-secondary pr-3">Favorite</span></h5>
                @if (is_null(Auth::user()->customer) || Auth::user()->customer->verified == '0')
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
                                    <th>SR No</th>
                                    <th>Product Title</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                    <th>Add to Cart</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle favorites-table">
                                <tr>
                                    <td colspan="5">
                                        <div class="text-center py-3">
                                            <img  src="{{ asset('web/img/loader.gif') }}" class="w-10" alt="Loader">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script></script>
@endsection
