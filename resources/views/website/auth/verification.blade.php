@extends('website.layout.app')
@section('title')
    <title>Register Verification - Atomshop - Pay in steps</title>
    <meta content="Atomshop - Pay in steps" name="description">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="login__signup__wrapper">
                <div class="row d-flex align-items-center justify-content-center">
                   <div class="col-lg-4">
                        <form class="login-form" id="verification-form" action="{{ route('website.register.verification.perform') }}" autocomplete="off" onsubmit="return false;">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ request()->user ?? '' }}">
                            <h4 class="heading">Code Verification</h4>
                            <p class="sub-text">Enter code to verify atomshop.pk account</p>
                            <div class="input-floating-label">
                                <input class="input" type="text" id="code-input" name="code" placeholder="Enter code" autofocus autocomplete="off"/>
                                <label for="code-input">Code</label>
                                <span class="focus-bg"></span>
                            </div>
                            <a href="" class="forgot__link">Forgot password?</a>
                            <button class="btn__submit verification" type="button">Verify</button>
                            <p class="other__link"> Don't have an account? <a href="{{ route('website.register') }}">Sign up</a></p>
                            <p class="other__link">We have sent the code to your email. Please check and let us know if you have any questions or require any modifications.</p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="{!! asset('web/js/verification.js') !!}"></script>
@endsection