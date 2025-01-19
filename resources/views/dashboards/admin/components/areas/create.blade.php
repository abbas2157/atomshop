@extends('dashboards.admin.layout.app')
@section('title')
    <title>Areas - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/admin/components/partials/sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Components</span>
                    <span>Areas</span>
                    <span>Create</span>
                </div>
                <h2 class="az-content-title">Areas</h2>
                <div class="az-content-label mg-b-5">Create new</div>
                <p class="mg-b-20">Using this form you can add new Area</p>
                <form method="POST" action="{{ route('admin.areas.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-sm">  
                        <div class="col-lg">
                            <label>Title<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="Enter areas Title" value="{{ old('title') }}" required>
                            @if ($errors->has('title'))
                                <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="col-lg">
                            <label>lat<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="lat" placeholder="lat" value="{{ old('lat') }}" required>
                            @if ($errors->has('lat'))
                                <span class="text-danger text-left">{{ $errors->first('lat') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row row-sm mt-2">
                        <div class="col-lg-6">
                            <label>lng<span class="text-danger">*</span></label>
                            <input type="number" class="form-control" name="lng" placeholder="lng" value="{{ old('lng') }}" required>
                            @if ($errors->has('lng'))
                                <span class="text-danger text-left">{{ $errors->first('lng') }}</span>
                            @endif   
                        </div>
                        <div class="col-lg">
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
                    </div>    
                    <div class="row row-sm mt-2">
                        <div class="col-lg-6">
                            <label>Select status<span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Create Area</button>
                </form>
                <hr class="mg-y-40">
                <hr class="mg-y-40">
                <hr class="mg-y-40">
            </div>
        </div>
    </div>
@endsection