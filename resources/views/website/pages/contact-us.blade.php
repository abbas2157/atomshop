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
                    <h4>Contact Directly</h4>
                    <p><b>Mobile:</b> 0300 8622866</p>

                    <h4>Head Office</h4>
                    <p>206- Nasheman Iqbal Cooperative Housing Society, Phase 1, Lahore</p>

                    <h4>Email</h4>
                    <p>Atomshop.pk Team is always available for their customers, suppliers, and sellers.
                    </p>
                    <p><b>For Customers:</b> support@atomshop.pk</p>
                    <p><b>For Sellers:</b> sellers@atomshop.pk</p>
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
