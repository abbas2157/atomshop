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
                <form method="POST" action="{{ route('seller.profile.business-info.perform') }}">
                    @csrf
                    <div class="row row-sm">
                        <div class="col-lg  mt-2">
                            <label>Business Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="business_name" value="{{ Auth::user()->seller->business_name ?? '' }}" placeholder="Business Name" required>        
                        </div>
                        <div class="col-lg mt-2">
                            <label>Investment Capacity <span class="text-danger">*</span></label>
                            <select name="investment_capacity" id="investment_capacity" class="form-control" required>
                                @php
                                    $investment_capacity = Auth::user()->seller->investment_capacity ?? '';
                                @endphp
                                <option value="2.5 Million" {{ $investment_capacity == '2.5 Million' ? 'selected' : '' }}>2.5 Million</option>
                                <option value="5.0 Million" {{ $investment_capacity == '5.0 Million' ? 'selected' : '' }}>5.0 Million</option>
                                <option value="10 Million" {{ $investment_capacity == '10 Million' ? 'selected' : '' }}>10 Million</option>
                                <option value="Other" {{ $investment_capacity == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-3">
                            <label>Do you have any previous experience in the installment business?</label>
                            <select name="previous_experience" id="previous_experience" class="form-control" required>
                                @php
                                    $previous_experience = Auth::user()->seller->previous_experience ?? '';
                                @endphp
                                <option value="1" {{ $previous_experience == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ $previous_experience == 0 ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-lg mt-2"></div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>City <span class="text-danger">*</span></label>
                            <select class="form-control" name="city_id" id="city_id">
                                <option value="">Select City</option>
                                @if($cities->isNotEmpty())
                                    @foreach($cities as $item)
                                        <option value="{{ $item->id }}" 
                                            {{ ($item->id == old('city_id', Auth::user()->seller->city_id ?? '')) ? 'selected' : '' }}>
                                            {{ $item->title }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-lg mt-2">
                            <label>Seller Area <span class="text-danger">*</span></label>
                            <select class="form-control" name="area_id" id="area_id">
                                <option value="">Select Area</option>
                                @if(isset($areas) && $areas->isNotEmpty())
                                    @foreach($areas as $item)
                                        <option value="{{ $item->id }}" 
                                            {{ ($item->id == old('area_id', Auth::user()->seller->area_id ?? '')) ? 'selected' : '' }}>
                                            {{ $item->title }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div> 
                    </div> 
                    <div class="row row-sm"> 
                        <div class="col-lg mt-2">
                            <label>Street Address<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" value="{{ Auth::user()->seller->address ?? '' }}" placeholder="Address" required>
                        </div>
                    </div> 
                    <button type="submit" class="btn btn-success mt-3">Update Seller</button>
                </form>
            </div>
        </div>
    </div>
@endsection
