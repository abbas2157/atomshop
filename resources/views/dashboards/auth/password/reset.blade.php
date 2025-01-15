<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="AtomShop - Pay in Steps">
        <meta name="author" content="AtomShop">
        <title>Forgot Password - {{ env('APP_NAME') ?? 'AtomShop' }}</title>
        <link href="{!! asset('assets/lib/ionicons/css/ionicons.min.css') !!}" rel="stylesheet">
        <link href="{!! asset('assets/lib/typicons.font/typicons.css') !!}" rel="stylesheet">
        <link href="{!! asset('assets/lib/typicons.font/typicons.css') !!}" rel="stylesheet">
        <link href="{!! asset('assets/css/style.css') !!}" rel="stylesheet">
    </head>
    <body class="az-body">
        <div class="az-signin-wrapper">
            <div class="az-card-signin">
                <h1 class="az-logo">atomshop</h1>
                <div class="az-signin-header">
                    <h2>Reset Password!</h2>
                    <h4>Please add password to continue</h4>
                    <form action="{{ route('password.reset.perform') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Password</label>
                            <input type="hidden" name="uuid" value="{{ $user->uuid ?? '' }}">
                            <input type="password" name="password" class="form-control" required placeholder="Enter your password">
                            @if ($errors->has('password'))
                                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required placeholder="Please renter your password">
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-az-primary btn-block">Reset Password</button>
                    </form>
                    @if ($errors->has('success'))
                        <div class="text-success text-left mt-3">{{ $errors->first('success') }}</div>
                    @endif
                    @if ($errors->has('error'))
                        <div class="text-danger text-left mt-3">{{ $errors->first('error') }}</div>
                    @endif
                </div>
                <div class="az-signin-footer">
                    <p>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                    <p>Don't have an account? <a href="">Create an Account</a></p>
                </div>
            </div>
        </div>
        <script src="{!! asset('assets/lib/jquery/jquery.min.js') !!}"></script>
        <script src="{!! asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
        <script src="{!! asset('assets/lib/ionicons/ionicons.js') !!}"></script>
        <script src="{!! asset('assets/js/scripts.js') !!}"></script>
        <script>
            $(function(){ 'use strict'});
        </script>
    </body>
</html>
