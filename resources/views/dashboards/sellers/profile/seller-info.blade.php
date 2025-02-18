@extends('dashboards.sellers.layout.app')
@section('title')
    <title>Seller - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/sellers/profile/partials/sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Profile</span>
                    <span>Seller</span>
                    <span>{{ Auth::user()->name ?? '' }}</span>
                </div>
                <h2 class="az-content-title">Business Information</h2>
                <div class="az-content-label mg-b-5">Personal Details</div>
                <p class="mg-b-20">Using this form you can update your details</p>
                <form method="POST" action="{{ route('seller.profile.seller-info.perform') }}">
                    @csrf
                    <div class="row row-sm">
                        <div class="col-lg  mt-2">
                            <label>Seller name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" value="{{ Auth::user()->seller->name ?? '' }}" placeholder="Seller Name" required>        
                        </div>
                        <div class="col-lg  mt-2">
                            <label>CNIC Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="cnic_number" value="{{ Auth::user()->seller->cnic_number ?? '' }}" placeholder="CNIC Number" required>        
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Seller Website <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="website" value="{{ Auth::user()->seller->website ?? '' }}" placeholder="Seller website link" required>
                        </div>
                        <div class="col-lg mt-2"></div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Update Seller</button>
                </form>
            </div>
        </div>
    </div>
@endsection
