@extends('dashboards.admin.layout.app')
@section('title')
    <title>Change Password - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/admin/profile/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Profile</span>
                <span>Password</span>
            </div>
            <h2 class="az-content-title">Change Password</h2>
            <div class="az-content-label mg-b-5">Personal Details</div>
            <p class="mg-b-20">Using this form you can update your password</p>
            <form method="POST" action="{{ route('admin.profile.change.password') }}">
                @csrf
                <div class="row row-sm">
                    <div class="col-lg">
                        <label>Current password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="current_password" placeholder="********" required>
                        @if ($errors->has('current_password'))
                            <span class="text-danger text-left">{{ $errors->first('current_password') }}</span>
                        @endif
                    </div>
                    <div class="col-lg">
                        <label>New password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="new_password" placeholder="********" required>
                        @if ($errors->has('new_password'))
                            <span class="text-danger text-left">{{ $errors->first('new_password') }}</span>
                        @endif
                    </div>
                    <div class="col-lg">
                        <label>Retype new password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="confirm_new_password" placeholder="********" required>
                        @if ($errors->has('confirm_new_password'))
                            <span class="text-danger text-left">{{ $errors->first('confirm_new_password') }}</span>
                        @endif
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