@extends('dashboards.admin.layout.app')
@section('title')
    <title>Areas - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/admin/components/partials/area-management-sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Zone Management</span>
                    <span>Areas</span>
                    <span>Create</span>
                </div>
                <h2 class="az-content-title">Areas</h2>
                <div class="az-content-label mg-b-5">Create new</div>
                <p class="mg-b-20">Using this form you can add new Area</p>
                <form method="POST" action="{{ route('admin.areas.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Select City<span class="text-danger">*</span></label>
                            <select class="form-control" name="city_id" required>
                                <option selected disabled>Select City</option>
                                @if($cities->isNotEmpty())
                                    @foreach($cities as $item)
                                        <option value="{{ $item->id ?? '' }}" {{ ($item->id == old('city_id')) ? 'selected' : '' }}>{{ $item->title ?? '' }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @if ($errors->has('city_id'))
                                <span class="text-danger text-left">{{ $errors->first('city_id') }}</span>
                            @endif
                        </div>
                        <div class="col-lg mt-2">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="Enter areas Title" value="{{ old('title') }}" required>
                            @if ($errors->has('title'))
                                <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Latitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="lat" placeholder="Enter Latitude" value="{{ old('lat') }}" required>
                            @if ($errors->has('lat'))
                                <span class="text-danger text-left">{{ $errors->first('lat') }}</span>
                            @endif
                        </div>
                        <div class="col-lg mt-2">
                            <label>Longitude <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="lng" placeholder="Enter Longitude" value="{{ old('lng') }}" required>
                            @if ($errors->has('lng'))
                                <span class="text-danger text-left">{{ $errors->first('lng') }}</span>
                            @endif   
                        </div>
                    </div>    
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Select status<span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-lg"></div>
                    </div>
                    <div class="az-content-label mg-b-5 mt-5">Create new</div>
                    <p class="mg-b-20">Using this form you can add new Seller</p>
                    <div class="col-lg-6 mt-2">
                        <label>Select Sellers<span class="text-danger">*</span></label>
                        <select class="form-control select2" name="seller_ids[]" multiple required>
                            <option disabled>Select Sellers</option>
                            @foreach($sellers as $seller)
                            <option value="{{ $seller->id }}" {{ collect(old('seller_ids'))->contains($seller->id) ? 'selected' : '' }}>
                                {{ $seller->name }}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->has('seller_ids'))
                            <span class="text-danger text-left">{{ $errors->first('seller_ids') }}</span>
                        @endif
                    </div>
                <button type="submit" class="btn btn-success mt-3">Create Area</button>
            </form>                
            </div>
        </div>
    </div>
@endsection