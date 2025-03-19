@extends('website.layout.app')
@section('title')
    <title>Login - Atomshop - Pay in steps</title>
    <meta content="Atomshop - Pay in steps" name="description">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="login__signup__wrapper">
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
                    <h5 class="sub-text">New to Atomshop.pk? </h5>
                    <p class="other__link"> If you don’t have an account yet, <a href="{{ route('website.register') }}" class="underline-a text-primary"> Sign Up </a> now and start shopping on easy installments!</p>
                    <p class="other__link">For any assistance, contact our support team at support@atomshop.pk or call us at 0300-8622866.</p>
                </form>
            </div>
        </div>
        <div class="col-md-7">
            <div class="bg-light px-5 py-4">
                <h3>Sign In</h3>
                <h5>Sign In to Your Atomshop.pk Account</h5>
                <p>Welcome back to Atomshop.pk! Sign in to access your account, manage your installment plans, track your orders, and explore exclusive deals.</p>
                <h5>Why Sign In?</h5>
                <ul class="">
                    <li>View and manage your installment purchases.</li>
                    <li>Track your order history and delivery status.</li>
                    <li>Update your profile and payment details.</li>
                    <li>Access exclusive discounts and offers.</li>
                    <li>Get personalized recommendations based on your shopping preferences.</li>
                </ul>
                <h5>How to Sign In?</h5>
                <ol class="">
                    <li>Enter your registered email or phone number.</li>
                    <li>Provide your secure password.</li>
                    <li>Click on the Sign In button to access your dashboard.</li>
                </ol>
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