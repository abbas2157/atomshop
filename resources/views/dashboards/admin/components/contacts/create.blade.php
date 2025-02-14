@extends('dashboards.admin.layout.app')
@section('title')
    <title>Contact - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/admin/components/partials/sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Product Management</span>
                    <span>Contact</span>
                    <span>Create</span>
                </div>
                <h2 class="az-content-title">Contact</h2>
                <div class="az-content-label mg-b-5">Create new</div>
                <p class="mg-b-20">Using this form you can add new Contact</p>
                <form method="POST" action="{{ route('admin.contacts.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row row-sm">
                    <div class="col-lg mt-2">
                            <label>Name<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Contact name" value="{{ old('name') }}" required>
                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label>Phone<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone"  value="{{ old('phone', $user->phone ?? '') }}" required> 
                            @if ($errors->has('phone'))
                                <span class="text-danger text-left">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Subject <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="subject" placeholder="Enter Subject" value="{{ old('subject') }}" required>
                            @error('subject')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg mt-2">
                            <label>Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="message" rows="4" placeholder="Enter your message" required>{{ old('message') }}</textarea>
                            @error('message')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Create Contact</button>
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
