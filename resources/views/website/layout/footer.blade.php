<div class="container-fluid bg-dark text-secondary mt-5 pt-5">
    <div class="row px-xl-5 pt-5">
        <div class="col-lg-4 col-md-12 mb-5 pr-3 pr-xl-5">
            <h5 class="text-secondary text-uppercase mb-4">Get In Touch</h5>
            <p class="mb-4">Online shop with easy installment facility in Lahore, Pakistan. {{ config('website.tagline') ?? 'No Email' }}</p>
            <p class="mb-2"><i class="fa fa-map-marker-alt text-primary mr-3"></i> {{ config('website.address') ?? 'No Address' }}</p>
            <p class="mb-2"><i class="fa fa-envelope text-primary mr-3"></i>{{ config('website.email') ?? 'No Email' }}</p>
            <p class="mb-0"><i class="fa fa-phone-alt text-primary mr-3"></i>{{ config('website.mobile') ?? 'No Phone' }}</p>
        </div>
        <div class="col-lg-8 col-md-12">
            <div class="row">
                <div class="col-md-4 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Quick Shop</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="{{ route('website') }}"><i class="fa fa-angle-right mr-2"></i> Home</a>
                        <a class="text-secondary mb-2" href="{{ route('website') }}"><i class="fa fa-angle-right mr-2"></i> Shop</a>
                        <a class="text-secondary mb-2" href="{{ route('calculator') }}"><i class="fa fa-angle-right mr-2"></i> Installment Calculator</a>
                        <a class="text-secondary mb-2" href="{{ route('website') }}"><i class="fa fa-angle-right mr-2"></i> Contact</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Famous Categories</h5>
                    <div class="d-flex flex-column justify-content-start">
                        <a class="text-secondary mb-2" href="{{ route('shop') }}?category[]=1"><i class="fa fa-angle-right mr-2"></i>Mobile Phone</a>
                        <a class="text-secondary mb-2" href="{{ route('shop') }}?category[]=2"><i class="fa fa-angle-right mr-2"></i>Tables</a>
                        <a class="text-secondary mb-2" href="{{ route('shop') }}?category[]=3"><i class="fa fa-angle-right mr-2"></i>Laptops</a>
                        <a class="text-secondary mb-2" href="{{ route('shop') }}?category[]=4"><i class="fa fa-angle-right mr-2"></i>Smart TV</a>
                        <a class="text-secondary mb-2" href="{{ route('shop') }}?category[]=5"><i class="fa fa-angle-right mr-2"></i>Motorbikes</a>
                        <a class="text-secondary mb-2" href="{{ route('shop') }}?category[]=6"><i class="fa fa-angle-right mr-2"></i>Electric Scooty</a>
                    </div>
                </div>
                <div class="col-md-4 mb-5">
                    <h5 class="text-secondary text-uppercase mb-4">Newsletter</h5>
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
                        <a class="btn btn-primary btn-square" href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row border-top mx-xl-5 py-4 p--12" style="">
        <div class="col-md-6 px-xl-0">
            <p class="mb-md-0 text-center text-md-left text-secondary">
                &copy; <a class="text-primary" href="#">Atomshop.pk</a>. All Rights Reserved.
                <br>Distributed By: <a href="" target="_blank">ZAKA BROTHERS</a>
            </p>
        </div>
        <div class="col-md-6 px-xl-0 text-center text-md-right"> </div>
    </div>
</div>
