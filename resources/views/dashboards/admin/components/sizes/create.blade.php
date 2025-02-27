@extends('dashboards.admin.layout.app')
@section('title')
    <title>Sizes - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/admin/components/partials/sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Product Management</span>
                    <span>Sizes</span>
                    <span>Create</span>
                </div>
                <h2 class="az-content-title">Sizes</h2>
                <div class="az-content-label mg-b-5">Create new</div>
                <p class="mg-b-20">Using this form you can add new Size</p>
                <form method="POST" action="{{ route('admin.sizes.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-sm">
                    <div class="col-lg mt-2">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="Enter sizes Title" value="{{ old('title') }}" required>
                            @if ($errors->has('title'))
                                <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label>Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="slug" placeholder="Enter Slug" value="{{ old('slug') }}" required>
                            @if ($errors->has('slug'))
                                <span class="text-danger text-left">{{ $errors->first('slug') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg-6 mt-2">
                            <label>Unit <span class="text-danger">*</span></label>
                            <select class="form-control" name="unit">
                                @foreach($units as $key => $value)
                                    <option value="{{ $key }}">{{ $value }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('unit'))
                                <span class="text-danger text-left">{{ $errors->first('unit') }}</span>
                            @endif
                        </div>
                        <div class="col-lg mt-2">
                            <label>Select status<span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Create Size</button>
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
