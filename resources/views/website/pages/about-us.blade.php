@extends('website.layout.app')
@section('title')
    <title>About | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="About | Atomshop - Pay in steps">
@endsection
@section('content')
<div class="container-fluid">
    <div class="login__signup__wrapper d-none">
      <div class="row d-flex align-items-center justify-content-center">
        <div class="col-lg-4">
          <form class="login-form" action="">
            <h2>Create new account</h2>
            <div class="input-floating-label">
              <input
                class="input"
                type="text"
                id="input"
                name="input"
                placeholder="username"
                value=""
              />
              <label for="input">Username</label>
              <span class="focus-bg"></span>
            </div>
            <div class="input-floating-label">
              <input
                class="input"
                type="password"
                id="input"
                name="input"
                placeholder="password"
              />
              <label for="input">Password</label>
              <span class="focus-bg"></span>
            </div>
            <a href="" class="forgot__link">Forgot password?</a>
            <button class="btn__submit">Sign up</button>
            <p class="other__link">
              Already have an account?
              <a href="login.html">Log in</a>
            </p>
          </form>
        </div>
      </div>
    </div>



    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('website') }}">Home</a>
                <span class="breadcrumb-item active">About Us</span>
            </nav>
        </div>
    </div>
    <div class="row px-xl-5 mb-5">
        <div class="col-12">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">About Us</span></h5>
            <div class="bg-light p-30">
                <div class="text-center mb-3">
                    <h4>About Us – AtomShop.pk</h4>
                </div>
                <div>
                    <p>
                        At <b>AtomShop.pk</b>, we make essential products <b>affordable and accessible </b> through <b>flexible installment plans</b>. 
                        No one should have to delay their needs due to financial barriers—that’s why we provide easy payment 
                        options for <b> appliances, electronics, and more</b>.
                    </p>
                    <p>
                        But we go beyond just selling products—we <b>empower individuals</b> through <b>AtomShop SAAS</b>, 
                        offering <b>training and digital tools</b> to help aspiring entrepreneurs <b>start their own businesses </b>
                        and earn a sustainable income.
                    </p>
                    <p>
                        <b>AtomShop.pk isn't just a marketplace—it's a platform for financial freedom and opportunity.</b>
                    </p>
                    <div class=" mb-2">
                        <h4>Our Vision</h4>
                    </div>
                    <p>
                        To create a future where <b>every Pakistani household has access to essential products, and aspiring entrepreneurs </b> have the tools to succeed.
                    </p>
                    <div class="mb-2">
                        <h4>Our Mission</h4>
                    </div>
                    <p>
                        To make products <b>financially accessible</b> while <b>empowering individuals</b> through <b>business training and digital selling tools</b>.
                    </p>
                    <ul>
                        <li><b>High-Quality Products</b></li>
                        <li><b>Easy Monthly Installments</b></li>
                        <li><b>24/7 Online Support</b></li>
                        <li><b>Business Opportunities with AtomShop SAAS</b></li>
                    </ul>
                    <div class="mb-2">
                        <h4>What We Do</h4>
                    </div>
                    <p>
                        We <b>offer flexible installment plans</b> to make everyday essentials <b>affordable</b>. 
                        We also help <b>entrepreneurs in Lahore</b> start their businesses through <b>AtomShop SAAS</b>, 
                        enabling them to <b>sell products, earn income, and uplift their communities</b>.
                    </p>
                    <div class="mb-2">
                        <h4>Our History</h4>
                    </div>
                    <p>
                        With <b>50,000+ satisfied customers</b>, we understand the needs of the people we serve. 
                        Our mission is to <b>continue breaking financial barriers and creating economic opportunities for all</b>.
                    </p>
                    <div class="mb-2">
                        <h4> Join AtomShop.pk—where affordability meets opportunity.</h4>
                    </div>
                    <p>This version is <b>sharp, direct, and impactful</b> while retaining all key messages. Let me know if you'd like any final refinements!</p>
                </div>
            </div>
        </div>
        
    </div>
    @include('website.home.partials.featured-start')
</div>
@endsection