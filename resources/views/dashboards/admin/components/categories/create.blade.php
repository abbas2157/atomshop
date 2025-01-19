@extends('dashboards.admin.layout.app')
@section('title')
    <title>Categories - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/admin/components/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Components</span>
                <span>Categories</span>
                <span>Create</span>
            </div>
            <h2 class="az-content-title">Categories</h2>
            <div class="az-content-label mg-b-5">Create new</div>
            <p class="mg-b-20">Using this form you can add new category</p>
            <form method="POST" action="{{ route('admin.categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row row-sm">
                    <div class="col-lg">
                        <label>Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Enter category title" value="{{ old('title') }}" required>
                        @if ($errors->has('title'))
                            <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="col-lg">
                        <label>Slug <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="slug" placeholder="Enter category slug" value="{{ old('slug') }}" required>
                        @if ($errors->has('slug'))
                            <span class="text-danger text-left">{{ $errors->first('slug') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row row-sm mt-2">
                    <div class="col-lg">
                        <label>Picture <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" accept="images/jpg,jpeg,png" class="custom-file-input" name="picture" id="customFile" required>
                            <label class="custom-file-label" for="customFile">Choose picture</label>
                        </div>
                        @if ($errors->has('picture'))
                            <span class="text-danger text-left">{{ $errors->first('picture') }}</span>
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
                <button type="submit" class="btn btn-success mt-3">Create category</button>
            </form>
            <hr class="mg-y-40">
            <hr class="mg-y-40">
            <hr class="mg-y-40">
        </div>
    </div>
</div>
@endsection