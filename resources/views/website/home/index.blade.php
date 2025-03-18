@extends('website.layout.app')
@section('title')
    <title>Atomshop - Pay in steps</title>
    <meta name="description" content="Atomshop is online shop with easy installment facility in Pakistan. - Pay in steps">
@endsection
@section('content')
    @include('website.home.partials.sliders')
    @include('website.home.partials.featured-start')
    @include('website.home.partials.categories')
    @include('website.home.partials.featured-products')
    <div class="container-fluid mb-3">
        <div class="row px-xl-5">
            <div class="col-lg-6 mt-2">
                <a href="{{ route('brand','apple') }}">
                    <img class="img-fluid" src="{{ asset('sliders/apple.png') }}" alt="Atomshop - Pay in steps">
                </a> 
            </div>
            <div class="col-lg-6 mt-2">
                <a href="{{ route('category','mobile-phone') }}">
                    <img class="img-fluid" src="{{ asset('sliders/android.png') }}" alt="Atomshop - Pay in steps">
                </a>
            </div>
        </div>
    </div>
    @include('website.home.partials.recent-products')
    @include('website.home.partials.brands')
    <div class="container-fluid pt-2 pb-2">
        <div class="row px-xl-5 mb-5">
            <div class="col-12">
                <div class="bg-light p-30">
                    <div class="mb-3">
                        <h1>Atomshop.pk</h1>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
