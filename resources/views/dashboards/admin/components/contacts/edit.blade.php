@extends('dashboards.admin.layout.app')

@section('title')
    <title>Edit Contact - {{ env('APP_NAME') ?? '' }}</title>
@endsection

@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/admin/components/partials/sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Product Management</span>
                    <span>Contact</span>
                    <span>Edit</span>
                </div>
                <h2 class="az-content-title">Edit Contact</h2>
                <div class="az-content-label mg-b-5">Edit Contact</div>
                <p class="mg-b-20">Using this form you can edit Contact</p>
                <form method="POST" action="{{ route('admin.contacts.update', $contact->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="name" placeholder="Enter Contact name" value="{{ old('name', $contact->name) }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label>Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter Phone" value="{{ old('phone', $contact->phone) }}" required>
                            @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg mt-2">
                            <label>Subject <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="subject" placeholder="Enter Subject" value="{{ old('subject', $contact->subject) }}" required>
                            @error('subject')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg mt-2">
                            <label>Message <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="message" rows="4" placeholder="Enter your message" required>{{ old('message', $contact->message) }}</textarea>
                            @error('message')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success mt-3">Update Contact</button>
                </form>
            </div>
        </div>
    </div>
@endsection