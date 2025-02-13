<div class="container-fluid bg-dark text-secondary mt-5">
    <div class="row px-xl-5 pt-4">
        <div class="col-lg-4 col-md-12 mb-3 pr-3 pr-xl-5">
            <h5 class="text-secondary text-uppercase mb-2">Get In Touch</h5>
            <p class="mb-4">Online shop with easy installment facility in Lahore, Pakistan. {{ config('website.tagline') ?? 'No Email' }}</p>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i> {{ config('website.address') ?? 'No Address' }}</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{ config('website.email') ?? 'No Email' }}</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{ config('website.mobile') ?? 'No Phone' }}</p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <h5 class="text-secondary text-uppercase mb-2">Quick Shop</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="{{ route('website') }}"><i class="fa fa-angle-right mr-2"></i> Home</a>
                        <a class="text-secondary mb-2" href="{{ route('website') }}"><i class="fa fa-angle-right mr-2"></i> Shop</a>
                        <a class="text-secondary mb-2" href="{{ route('website') }}"><i class="fa fa-angle-right mr-2"></i> About Us</a>
                        <a class="text-secondary mb-2" href="{{ route('website') }}"><i class="fa fa-angle-right mr-2"></i> Contact</a>
                        <a class="text-secondary mb-2" href="{{ route('calculator') }}"><i class="fa fa-angle-right mr-2"></i> Installment Calculator</a>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <h5 class="text-secondary text-uppercase mb-2">Our Policies</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="{{ route('website') }}"><i class="fa fa-angle-right mr-2"></i> Privacy Policy</a>
                        <a class="text-secondary mb-2" href="{{ route('website') }}"><i class="fa fa-angle-right mr-2"></i> Return Policy</a>
                        <a class="text-secondary mb-2" href="{{ route('website') }}"><i class="fa fa-angle-right mr-2"></i> Refund Policy</a>
                        <a class="text-secondary mb-2" href="{{ route('website') }}"><i class="fa fa-angle-right mr-2"></i> Help</a>
                        <a class="text-secondary mb-2" href="{{ route('website') }}"><i class="fa fa-angle-right mr-2"></i> FAQs</a>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <h5 class="text-secondary text-uppercase mb-2">Newsletter</h5>
                    <p>Online shop with easy installment facility in Lahore, Pakistan.</p>
                    <form action="">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Your Email Address">
                            <div class="input-group-append">
                                <button class="btn btn-primary">Sign Up</button>
                            </div>
                        </div>
                    </form>
                    <h6 class="text-secondary text-uppercase mt-4 mb-3">Follow Us</h6>
                    <div class="d-flex">
                        <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="{{ config('website.social.facebook') ?? '' }}"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-primary btn-square mr-2" href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a class="btn btn-primary btn-square" href="{{ config('website.social.instagram') ?? '' }}"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
        <div class="col-md-6 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-secondary">
                &copy; <a class="text-primary" href="{{ route('website') }}">Atomshop.pk</a>. All Rights Reserved.
            </p>
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right"> </div>
    </div>
</div>