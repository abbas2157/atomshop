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
                    <span>Product Management</span>
                    <span>Categories</span>
                    <span>{{ $category->title ?? '' }}</span>
                    <span>Edit</span>
                </div>
                <h2 class="az-content-title">Categories</h2>
                <div class="az-content-label mg-b-5">Edit</div>
                <p class="mg-b-20">Using this form you can edit this category</p>
                <form method="POST" action="{{ route('admin.categories.update', $category->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" value="{{ $category->title ?? '' }}"
                                placeholder="Enter Category Title" value="{{ old('title') }}" required>
                            @if ($errors->has('title'))
                                <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="col-lg mt-2">
                            <label>Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="slug" value="{{ $category->slug ?? '' }}"
                                placeholder="Enter category slug" value="{{ old('slug') }}" required>
                            @if ($errors->has('slug'))
                                <span class="text-danger text-left">{{ $errors->first('slug') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Picture </label>
                            <div class="custom-file">
                                <input type="file" accept="images/jpg,jpeg,png" class="custom-file-input" name="picture"
                                    id="customFile">
                                <label class="custom-file-label" for="customFile">Choose picture</label>
                            </div>
                            @if ($errors->has('picture'))
                                <span class="text-danger text-left">{{ $errors->first('picture') }}</span>
                            @endif
                            @if ($category->picture)
                                <div class="row">
                                    <div class="col-md-6 mt-2">
                                        <img src="{{ asset($category->picture) }}" alt="" class="img-fluid"
                                            style="height: 50px; width:50px">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg mt-2">
                            <label>Select status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label class="form-control-label">App Home <span class="tx-danger">*</span></label>
                            <select id="app_home" class="form-control" name="app_home" required>
                                <option value="1" {{ old('app_home') == '1' ? 'selected' : '' }} {{ old('app_home', $category->app_home) == '1' ? 'selected' : '' }}>Yes, Show on app homepage</option>
                                <option value="0" {{ old('app_home') == '0' ? 'selected' : '' }} {{ old('app_home', $category->app_home) == '0' ? 'selected' : '' }}>No, Not show on app homepage</option>
                            </select>
                            @if ($errors->has('app_home'))
                                <span class="text-danger text-left">{{ $errors->first('app_home') }}</span>
                            @endif
                        </div>
                        <div class="col-lg mt-2">
                            <label class="form-control-label">Web Home <span class="tx-danger">*</span></label>
                            <select id="web_home" class="form-control" name="web_home" required>
                                <option value="1" {{ old('web_home') == '1'? 'selected' : '' }} {{ old('web_home', $category->web_home) == '1' ? 'selected' : '' }}>Yes, Show on web homepage</option>
                                <option value="0" {{ old('web_home') == '0' ? 'selected' : '' }} {{ old('web_home', $category->web_home) == '0' ? 'selected' : '' }}>No, Not show on web homepage</option>
                            </select>
                            @if ($errors->has('web_home'))
                                <span class="text-danger text-left">{{ $errors->first('web_home') }}</span>
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Update category</button>
                </form>
            </div>
        </div>
    </div>
@endsection
