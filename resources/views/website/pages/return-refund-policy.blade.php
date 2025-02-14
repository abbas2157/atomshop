@extends('website.layout.app')
@section('title')
    <title>Return and Refund Policy | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="Return and Refund Policy | Atomshop - Pay in steps">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('website') }}">Home</a>
                <span class="breadcrumb-item active">Return and Refund Policy</span>
            </nav>
        </div>
    </div>
    <div class="row px-xl-5 mb-5">
        <div class="col-12">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Return and Refund Policy</span></h5>
            <div class="bg-light p-30">
                <div class="text-center mb-3">
                    <h4>Return and Refund Policy – <b>AtomShop.pk</b></h4>
                </div>
                <div>
                    <h4><b>Return Policy</b></h4>
                    <ul>
                        <li>Returns are accepted only if you receive the <b>wrong item</b> or a <b>non-functional product</b> at the time of delivery.</li>
                        <li>Items must be <b>unused, unscratched, and in original packaging</b> with an <b>invoice</b> for return requests.</li>
                        <li>Check your item at delivery; claims after that will not be entertained.</li>
                        <li>Certain products <b>(ACs, UPS, Burners, etc.)</b> must be checked within <b>5 working days</b> for any complaints.</li>
                        <li>If a product is defective after delivery, claim through the <b>manufacturer’s warranty</b>.</li>
                        <li>Refunds, if approved, are processed within <b>7-10 business days</b>; shipping costs are <b>non-refundable</b>.</li>
                    </ul>
                    <h4><b>No Exchanges & Cancellations</b></h4>
                    <ul>
                        <li><b>No replacements or exchanges</b>; check items at delivery.</li>
                        <li>Orders can be canceled <b>before shipment only</b>.</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
    @include('website.home.partials.featured-start')
</div>
@endsection
