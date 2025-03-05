@extends('website.layout.app')
@section('title')
    <title>Verification Docs | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="About | Atomshop - Pay in steps">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection
@section('content')
<style>
   .verification-img {
    display: block;
    width: 220px;
    height: 100px;
    border: 1px solid #ddd;
    padding: 5px;
    background: #fff;
    border-radius: 5px;
    margin-bottom: 10px;
}
</style>
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('website') }}">Home</a>
                <a class="breadcrumb-item text-dark" href="{{ route('profile') }}">My Profile</a>
                <span class="breadcrumb-item active" >Verification Docs</span>
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
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Verification Docs</span></h5>
            @if(is_null(Auth::user()->customer) || Auth::user()->customer->verified == '0')
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Note !</strong> Get verified yourself immediately. Our agent will visite you soon.
                </div>
            @else
            <div class="bg-light px-4 py-2 mb-30">
                @if(!empty($user->customerVerification->id_card_front_side) && !empty($user->customerVerification->id_card_back_side))
                    <div class="row">
                        <div class="col-md-6">
                            <label>Customer Name</label>
                            <p>{{ $user->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <label>Customer Email</label>
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Customer Phone</label>
                            <p>{{ $user->phone }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>ID Card Front Side</label>
                            <img src="{{ asset($user->customerVerification->id_card_front_side) }}" class="verification-img">
                        </div>
                        <div class="col-md-6">
                            <label>ID Card Back Side</label>
                            <img src="{{ asset($user->customerVerification->id_card_back_side) }}" class="verification-img">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Selfie with Customer</label>
                            <img src="{{ asset($user->customerVerification->selfie_with_customer) }}" class="verification-img">
                        </div>
                        <div class="col-md-6">
                            <label>Address Found</label>
                            <p>{{ $user->customerVerification->address_found == '1' ? 'Yes' : 'No' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>House</label>
                            <p>{{ $user->customerVerification->house }}</p>
                        </div>
                        <div class="col-md-6">
                            <label>Customer Physical Meet</label>
                            <p>{{ $user->customerVerification->customer_physical_meet == '1' ? 'Yes' : 'No' }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Work</label>
                            <p>{{ $user->customerVerification->work }}</p>
                        </div>
                    </div>
                @else
                    <div class="text-center py-3">
                        <img src="{{ asset('web/img/loader.gif') }}" class="w-10" alt="Loader">
                    </div>
                @endif
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>

</script>
@endsection
