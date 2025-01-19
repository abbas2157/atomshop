@extends('dashboards.admin.layout.app')
@section('title')
    <title>Cities - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/admin/components/partials/sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Components</span>
                    <span>Cities</span>
                    <span>Create</span>
                </div>
                <h2 class="az-content-title">Cities</h2>
                <div class="az-content-label mg-b-5">Create new</div>
                <p class="mg-b-20">Using this form you can add new City</p>
                <form method="POST" action="{{ route('admin.cities.update', $city->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row row-sm">
                        <div class="col-lg-6 mt-2">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" value="{{ $city->title ?? '' }}" placeholder="Enter cities Title" value="{{ old('title') }}" required>
                            @if ($errors->has('title'))
                                <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label>Provice <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="provice" value="{{ $city->provice ?? '' }}" placeholder="Enter cities provice" value="{{ old('provice') }}" required>
                            @if ($errors->has('provice'))
                                <span class="text-danger text-left">{{ $errors->first('provice') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label>country <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="country" value="{{ $city->country ?? '' }}" placeholder="Enter cities country" value="{{ old('country') }}" required>
                            @if ($errors->has('country'))
                                <span class="text-danger text-left">{{ $errors->first('country') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label>Select status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option value="active" {{ ($city->status == 'active') ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ ($city->status == 'inactive') ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Update City</button>
                </form>
                <hr class="mg-y-40">
                <hr class="mg-y-40">
                <hr class="mg-y-40">
            </div>
        </div>
    </div>
@endsection