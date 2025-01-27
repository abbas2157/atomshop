@extends('dashboards.admin.layout.app')
@section('title')
    <title>Colors - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/admin/components/partials/sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Product Management</span>
                    <span>Colors</span>
                    <span>{{ $colors->title ?? '' }}</span>
                    <span>Edit</span>
                </div>
                <h2 class="az-content-title">colors</h2>
                <div class="az-content-label mg-b-5">Create new</div>
                <p class="mg-b-20">Using this form you can edit this colors</p>
                <form method="POST" action="{{ route('admin.colors.update', $colors->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row row-sm">
                        <div class="col-lg-6 mt-2">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" value="{{ $colors->title ?? '' }}" placeholder="Enter colors title" value="{{ old('title') }}" required>
                            @if ($errors->has('title'))
                                <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label>Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="slug" value="{{ $colors->slug ?? '' }}" placeholder="Enter colors slug" value="{{ old('slug') }}" required>
                            @if ($errors->has('slug'))
                                <span class="text-danger text-left">{{ $errors->first('slug') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label>code <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="code" value="{{ $colors->code ?? '' }}" placeholder="Enter colors code" value="{{ old('code') }}" required>
                            @if ($errors->has('code'))
                                <span class="text-danger text-left">{{ $errors->first('slug') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label>Select status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option value="active" {{ ($colors->status == 'active') ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ ($colors->status == 'inactive') ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Update color</button>
                </form>
            </div>
        </div>
    </div>
@endsection