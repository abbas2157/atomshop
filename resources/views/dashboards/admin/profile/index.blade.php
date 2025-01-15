@extends('dashboards.admin.layout.app')
@section('title')
    <title>Profile - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/admin/profile/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Profile</span>
                <span>{{ Auth::user()->name ?? '' }}</span>
            </div>
            <h2 class="az-content-title">Profile</h2>
            <div class="az-content-label mg-b-5">Personal Details</div>
            <p class="mg-b-20">Using this form you can update your details</p>
            <form method="POST" action="{{ route('admin.profile.perform') }}">
                @csrf
                <div class="row row-sm">
                    <div class="col-lg">
                        <label>Your Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name ?? '' }}" placeholder="Name" required>
                    </div>
                    <div class="col-lg">
                        <label>Your Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email ?? '' }}" placeholder="Name" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3">Update Profile</button>
            </form>
            <hr class="mg-y-40">
            <hr class="mg-y-40">
            <hr class="mg-y-40">
        </div>
    </div>
</div>
@endsection