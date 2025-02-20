@extends('website.layout.app')
@section('title')
    <title>Login - Atomshop - Pay in steps</title>
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
                        <form class="login-form" id="login-form" action="{{ route('login.perform') }}" autocomplete="off" onsubmit="return false;">
                            @csrf
                            <h4 class="heading">Login</h4>
                            <p class="sub-text">Login to your atomshop.pk account</p>
                            <div class="input-floating-label">
                                <input class="input" type="text" id="email-input" name="email" placeholder="Enter email" autofocus autocomplete="off"/>
                                <label for="email-input">Email</label>
                                <span class="focus-bg"></span>
                                <span class="text-danger error" id="error-email"></span>
                            </div>
                            <div class="input-floating-label">
                                <input class="input" type="password" id="input-password" name="password" placeholder="password" autocomplete="new-password"/>
                                <label for="input-password">Password</label>
                                <span class="focus-bg"></span>
                                <span class="text-danger error" id="error-password"></span>
                            </div>
                            <a href="" class="forgot__link">Forgot password?</a>
                            <button class="btn__submit login" type="button">Login</button>
                            <p class="other__link"> Don't have an account? <a href="{{ route('website.register') }}">Sign up</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="{!! asset('web/js/login.js') !!}"></script>
@endsection