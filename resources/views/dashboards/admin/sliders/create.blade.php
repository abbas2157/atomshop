@extends('dashboards.admin.layout.app')
@section('title')
    <title>Sliders - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/admin/sliders/partials/sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Web & App</span>
                    <span>Slider</span>
                    <span>Create</span>
                </div>
                <h2 class="az-content-title">Sliders</h2>
                <div class="az-content-label mg-b-5">Create new</div>
                <p class="mg-b-20">Using this form you can add new Slider</p>
                <form method="POST" action="{{ route('admin.sliders.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="title" placeholder="Enter slider title" value="{{ old('title') }}" required>
                            @if ($errors->has('title'))
                                <span class="text-danger text-left">{{ $errors->first('title') }}</span>
                            @endif
                        </div>
                        <div class="col-lg mt-2">
                            <label>Tagline <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="tagline" rows="5"></textarea>
                            @if ($errors->has('tagline'))
                                <span class="text-danger text-left">{{ $errors->first('tagline') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Select Action <span class="text-danger">*</span></label>
                            <select class="form-control" name="action">
                                @foreach ($routes as $route)
                                    <option value="{{ url($route) }}">{{ $route ?? '' }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('action'))
                                <span class="text-danger text-left">{{ $errors->first('action') }}</span>
                            @endif
                        </div>
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

                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Select status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-lg mt-2">
                            <label>Select portal <span class="text-danger">*</span></label>
                            <select class="form-control" name="portal">
                                <option value="web">Web</option>
                                <option value="app">App</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Create Slider</button>
                </form>
            </div>
        </div>
    </div>
@endsection
