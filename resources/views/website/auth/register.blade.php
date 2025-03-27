@extends('website.layout.app')
@section('title')
    <title>Register - Atomshop - Pay in steps</title>
    <meta content="Atomshop - Pay in steps" name="description">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="login__signup__wrapper">
                <form class="login-form" id="register-form" action="" autocomplete="off" onsubmit="return false;">
                    @csrf
                    <h4 class="heading">Register</h4>
                    <p class="sub-text">Register to your atomshop.pk account</p>
                    <div class="input-floating-label">
                        <input class="input" type="text" id="input-name" name="name" placeholder="Name" />
                        <label for="input-name">Full Name</label>
                        <span class="focus-bg"></span>
                        <span class="text-danger error" id="error-name"></span>
                    </div>
                    <div class="input-floating-label">
                        <input class="input" type="text" id="input-email" name="email" placeholder="Enter Email" />
                        <label for="input-email">Email</label>
                        <span class="focus-bg"></span>
                        <span class="text-danger error" id="error-email"></span>
                    </div>
                    <div class="input-floating-label">
                        <input class="input" type="password" id="input-password" name="password"  placeholder="password" autocomplete="new-password"//>
                        <label for="input-password">Password</label>
                        <span class="focus-bg"></span>
                        <span class="text-danger error" id="error-password"></span>
                    </div>
                    <div class="input-floating-label">
                        <input class="input" type="tel" id="input-phone" name="phone" placeholder="Enter Phone Number" />
                        <label for="input-phone">Phone Number</label>
                        <span class="focus-bg"></span>
                        <span class="text-danger error" id="error-phone"></span>
                    </div>
                    <button class="btn__submit register" type="button">Sign up</button>
                    <h5 class="sub-text">Already have an account? </h5>
                    <p class="other__link"> If you have an account, <a href="{{ route('login') }}" class="underline-a text-primary"> Sign In </a> now and start shopping on easy installments!</p>
                    <p class="other__link">For any assistance, contact our support team at <a href="mail:support@atomshop.pk" class="underline-a text-primary"> support@atomshop.pk </a> or call us at <a href="tel:+923008622866" class="underline-a text-primary">+923008622866</a>.</p>
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
                <h5>Forgot Your Password? </h5>
                <p>No worries! Click on <a href="" class="underline-a text-primary"> Forgot Password </a> to reset your credentials and regain access to your account.</p>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script src="{!! asset('web/js/register.js') !!}"></script>
@endsection