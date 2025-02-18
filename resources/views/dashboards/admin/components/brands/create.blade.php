@extends('dashboards.admin.layout.app')
@section('title')
    <title>Brands - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/admin/components/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Product Management</span>
                <span>Brands</span>
                <span>Create</span>
            </div>
            <h2 class="az-content-title">Brands</h2>
            <div class="az-content-label mg-b-5">Create new</div>
            <p class="mg-b-20">Using this form you can add new brand</p>
            <form method="POST" action="{{ route('admin.brands.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row row-sm">
                    <div class="col-lg mt-2">
                        <label>Select category <span class="text-danger">*</span></label>
                        <select class="form-control" name="category_id" required>
                            <option selected disabled>Select category</option>
                            @if($categories->isNotEmpty())
                                @foreach($categories as $item)
                                    <option value="{{ $item->id ?? '' }}" {{ ($item->id == old('category_id')) ? 'selected' : '' }}>{{ $item->title ?? '' }}</option>
                                @endforeach
                            @endif
                        </select>
                        @if ($errors->has('category_id'))
                            <span class="text-danger text-left">{{ $errors->first('category_id') }}</span>
                        @endif
                    </div>
                    <div class="col-lg mt-2">
                        <label>Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="title" placeholder="Enter brand title" value="{{ old('title') }}" required>
                        @if ($errors->has('title'))
                            <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                        @endif
                    </div>
                    <div class="col-lg mt-2">
                        <label>Slug <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="slug" placeholder="Enter brand slug" value="{{ old('slug') }}" required>
                        @if ($errors->has('slug'))
                            <span class="text-danger text-left">{{ $errors->first('slug') }}</span>
                        @endif
                    </div>
                </div>
                <div class="row row-sm">
                    <div class="col-lg mt-2">
                        <label>Picture <span class="text-danger">*</span></label>
                        <div class="custom-file">
                            <input type="file" accept="images/jpg,jpeg,png" class="custom-file-input" name="picture" id="customFile" required>
                            <label class="custom-file-label" for="customFile">Choose picture</label>
                        </div>
                        @if ($errors->has('picture'))
                            <span class="text-danger text-left">{{ $errors->first('picture') }}</span>
                        @endif
                    </div>
                    <div class="col-lg mt-2">
                        <label>Select status <span class="text-danger">*</span></label>
                        <select class="form-control" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="col-lg"></div>
                </div>
                <div class="row row-sm">
                    <div class="col-lg mt-2">
                        <label class="form-control-label">App Home <span class="tx-danger">*</span></label>
                        <select id="app_home" class="form-control" name="app_home" required>
                            <option value="1" {{ old('app_home') == 1 ? 'selected' : '' }}>Yes, Show on app homepage</option>
                            <option value="0" {{ old('app_home') == 0 ? 'selected' : '' }}>No, Not show on app homepage</option>
                        </select>
                        @if ($errors->has('app_home'))
                            <span class="text-danger text-left">{{ $errors->first('app_home') }}</span>
                        @endif
                    </div>
                    <div class="col-lg mt-2">
                        <label class="form-control-label">Web Home <span class="tx-danger">*</span></label>
                        <select id="web_home" class="form-control" name="web_home" required>
                            <option value="1" {{ old('web_home') == 1 ? 'selected' : '' }}>Yes, Show on web homepage</option>
                            <option value="0" {{ old('web_home') == 0 ? 'selected' : '' }}>No, Not show on web homepage</option>
                        </select>
                        @if ($errors->has('web_home'))
                            <span class="text-danger text-left">{{ $errors->first('web_home') }}</span>
                        @endif
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3">Create brand</button>
            </form>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).on('click', '#delete-btn', function () {

    });
</script>
@endsection
