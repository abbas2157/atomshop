@extends('website.layout.app')
@section('title')
    <title>My Profile | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="About | Atomshop - Pay in steps">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('website') }}">Home</a>
                <a class="breadcrumb-item text-dark" href="{{ route('profile') }}">My Profile</a>
                <span class="breadcrumb-item active" >Reset Password</span>
            </nav>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-3 col-md-4">
            @include('website.profile.partials.sidebar')
        </div>
        <div class="col-lg-9 col-md-8">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Change Password</span></h5>
            @if(is_null(Auth::user()->customer) || Auth::user()->customer->verified == '0') 
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Note !</strong> Get verified yourself immediately. Our agent will visite you soon.
                </div>
            @endif
            <div class="bg-light px-4 py-2 mb-30">
                <form action="{{ route('profile.password.update') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ Auth::user()->uuid ?? '' }}" name="user_id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">Current Password</label>
                                <input type="password" class="form-control" id="password" name="current_password" placeholder="Enter Current Password" required>
                                @if ($errors->has('current_password'))
                                    <span class="text-danger text-left">{{ $errors->first('current_password') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password">New Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password" required>
                                @if ($errors->has('password'))
                                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="confirm_password">Confirm New Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Confirm New Password" required>
                                @if ($errors->has('confirm_password'))
                                    <span class="text-danger text-left">{{ $errors->first('confirm_password') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-primary mb-3">Update Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    $(document).ready(function () {
        @if ($errors->has('success'))
            Toastify({
                text: "<i class='fas fa-check-circle'></i> <b> Success </b> ! {{ $errors->first('success') }}",
                duration: 3000,
                gravity: "top",
                position: "right",
                escapeMarkup: false,
                backgroundColor: "linear-gradient(to right, #FFD333, #3D464D)",
            }).showToast();
        @endif
        @if ($errors->has('error'))
            Toastify({
                text: "<i class='fas fa-check-circle'></i> <b> Error </b> ! {{ $errors->first('error') }}",
                duration: 3000,
                gravity: "top",
                position: "right",
                escapeMarkup: false,
                backgroundColor: "linear-gradient(to right, #FF0000, #000000)",
            }).showToast();
        @endif
    });
</script>
@endsection
