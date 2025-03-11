<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon.png') }}">
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
                    <h2>Forgot Password!</h2>
                    <h4>Please add email to continue</h4>
                    <form action="{{ route('password.send-email') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="Enter your email">
                            @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-az-primary btn-block">Send Email</button>
                    </form>
                    @if ($errors->has('success'))
                        <div class="text-success text-left mt-3">{{ $errors->first('success') }}</div>
                    @endif
                    @if ($errors->has('error'))
                        <div class="text-danger text-left mt-3">{{ $errors->first('error') }}</div>
                    @endif
                </div>
                <div class="az-signin-footer">
                    <p>Already have an account? <a href="{{ route('portal.login') }}">Sign In</a></p>
                    {{-- <p>Don't have an account? <a href="">Create an Account</a></p> --}}
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
