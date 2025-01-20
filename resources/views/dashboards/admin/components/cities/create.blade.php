@extends('dashboards.admin.layout.app')
@section('title')
    <title>Cities - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/admin/components/partials/area-management-sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Zone Management</span>
                    <span>Cities</span>
                    <span>Create</span>
                </div>
                <h2 class="az-content-title">Cities</h2>
                <div class="az-content-label mg-b-5">Create new</div>
                <p class="mg-b-20">Using this form you can add new City</p>
                <form method="POST" action="{{ route('admin.cities.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-sm">
                        <div class="col-lg">
                            <label>Country <span class="text-danger">*</span></label>
                            <select class="form-control" name="country" required>
                                <option value="Pakistan">Pakistan</option>
                            </select>
                            @if ($errors->has('country'))
                                <span class="text-danger text-left">{{ $errors->first('country') }}</span>
                            @endif
                        </div>
                        <div class="col-lg">
                            <label>Provice <span class="text-danger">*</span></label>
                            <select class="form-control" name="provice" required>
                                <option value="Punjab">Punjab</option>
                                <option value="Sindh">Sindh</option>
                                <option value="Balochistan">Balochistan</option>
                                <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                                <option value="Gilgit-Baltistan">Gilgit-Baltistan</option>
                            </select>
                            @if ($errors->has('provice'))
                                <span class="text-danger text-left">{{ $errors->first('provice') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row row-sm mt-2">
                        <div class="col-lg">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="Enter cities Title" value="{{ old('title') }}" required>
                            @if ($errors->has('title'))
                                <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="col-lg">
                            <label>Select status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Create City</button>
                </form>
                <hr class="mg-y-40">
                <hr class="mg-y-40">
                <hr class="mg-y-40">
            </div>
        </div>
    </div>
@endsection