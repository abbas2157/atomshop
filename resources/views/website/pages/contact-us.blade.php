@extends('website.layout.app')

@section('title')
    <title>Contact Us | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="Contact Us | Atomshop - Get in touch with us">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('website') }}">Home</a>
                <span class="breadcrumb-item active">Contact Us</span>
            </nav>
        </div>
    </div>
    <div class="row px-xl-5 mb-5">
        <div class="col-md-6">
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Contact Us</span>
            </h5>
            <div class="bg-light p-30">
                <div class="text-center mb-3">
                    <h4>Contact Us – AtomShop.pk</h4>
                </div>
                <div>
                    <h4>Contact Atomshop</h4>
                    <p class="mb-5 mt-2">
                        Atomshop.pk Team is always available for their customers, suppliers, and sellers. <br> <br>
                        <b>Mobile Number : </b> <a href="tel:+923008622866" class="text-decoration-none">+923008622866</a> <br>
                        <b>For Customers:</b> <a href="mailto:support@atomshop.pk" class="text-decoration-none">support@atomshop.pk</a> <br>
                        <b>For Sellers:</b> <a href="mailto:sellers@atomshop.pk" class="text-decoration-none"> sellers@atomshop.pk </a> <br> <br>
                        <b>Office Address : </b> 206- Nasheman Iqbal Cooperative Housing Society, Phase 1, Lahore, Pakistan</p>
                    </p>
                    <h6 class="text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex">
                        <a class="btn btn-primary btn-square mr-2" href="{{ config('website.social.facebook') ?? '' }}"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary btn-square" href="{{ config('website.social.instagram') ?? '' }}"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Send Us a Message</span>
            </h5>
            <div class="bg-light p-30">
                <form action="{{ route('contact.send') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="phone" class="form-control" id="phone" name="phone" placeholder="Enter your phone" required>
                    </div>

                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="subject" class="form-control" id="subject" name="subject" placeholder="Enter your subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" id="message" name="message" rows="4" placeholder="Enter your message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
    @include('website.home.partials.featured-start')
</div>
@endsection
