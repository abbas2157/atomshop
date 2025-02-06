@extends('dashboards.admin.layout.app')
@section('title')
    <title>Sliders - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/admin/components/partials/sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Web & App</span>
                    <span>Slider</span>
                    <span>Create</span>
                </div>
                <h2 class="az-content-title">Sliders</h2>
                <div class="az-content-label mg-b-5">Create new</div>
                <p class="mg-b-20">Using this form you can edit Slider</p>
                <form method="POST" action="{{ route('admin.sliders.update', $slider->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="Enter Slider title" value="{{ $slider->title ?? '' }}" required>
                            @if ($errors->has('title'))
                                <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="col-lg mt-2">
                            <label>Description <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="description" rows="5">{{ $slider->description }}</textarea>
                            @if ($errors->has('description'))
                                <span class="text-danger text-left">{{ $errors->first('description') }}</span>
                            @endif         
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Picture <span class="text-danger">*</span></label>
                            <div class="custom-file">
                                <input type="file" accept="images/jpg,jpeg,png" class="custom-file-input" name="picture" id="customFile" >
                                <label class="custom-file-label" for="customFile">Choose picture</label>
                            </div>
                            @if ($errors->has('picture'))
                                <span class="text-danger text-left">{{ $errors->first('picture') }}</span>
                            @endif  
                        </div>
                        <div class="col-lg mt-2">
                            <label>Select status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option value="active" {{ ($slider->status == 'active') ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ ($slider->status == 'inactive') ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Update Slider</button>
                </form>
            </div>
        </div>
    </div>
@endsection