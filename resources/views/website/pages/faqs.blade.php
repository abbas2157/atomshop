@extends('website.layout.app')
@section('title')
    <title>Faqs | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="Faqs | Atomshop - Pay in steps">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('website') }}">Home</a>
                <span class="breadcrumb-item active">Faqs</span>
            </nav>
        </div>
    </div>
    <div class="row px-xl-5 mb-5">
        <div class="col-12">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Faqs</span></h5>
            <div class="bg-light p-30">
                <div class="text-center mb-3">
                    <h4>Frequently Asked Questions (FAQs) – <b>AtomShop.pk</b></h4>
                </div>
                <div>
                    <h4><b>For Buyers</b></h4>
                    <h5>1. How can I purchase products on installments?</h5>
                    <p>
                        You can select any product on our website or app and choose the installment plan that suits you best. Alternatively, you can create your own custom installment plan based on your preferences. Follow the checkout process and provide the required details for approval.
                    </p>
                    <h5>2. What documents are required to apply for installments?</h5>
                    <p>
                        To apply for installments, you will need to provide the following documents:
                        <ul>
                            <li>A valid <b>CNIC</b></li>
                            <li>Two references (personal or professional)</li>
                            <li>Proof of income (salary slip, bank statement, or business proof)</li>
                            <li>A post-dated cheque (if required, based on the installment plan)</li>
                        </ul>
                        Specific requirements may vary depending on the product and financing plan.
                    </p>
                    <h5>3. Is there any upfront payment required?</h5>
                    <p>
                        Yes, a down payment may be required depending on the installment plan and product category.
                    </p>
                    <h5>4. How long does it take for installment approval?</h5>
                    <p>
                        Approval usually takes <b>24-48 hours</b>, depending on document verification and eligibility checks.
                    </p>
                    <h5>5. What happens if I miss an installment payment?</h5>
                    <p>
                        Missing payments may result in penalties, restrictions on future purchases, and legal action. Always ensure timely payments to maintain a good credit standing.
                    </p>
                    <h5>6. Can I select a product from the market that is not available on the website or app?</h5>
                    <p>
                        Yes! You can select a product from the market and use our <b>Custom Product Order Installment Calculator</b> to place an order through Atomshop.pk.
                    </p>
                    <h4><b>For Sellers</b></h4>
                    <h5>7. How can I start selling on Atomshop.pk?</h5>
                    <p>
                        You can sign up as a seller on our website, provide your business details, and choose a suitable plan to launch your installment shop.
                    </p>
                    <h5>8. What are the benefits of selling on Atomshop.pk?</h5>
                    <p>
                        Atomshop.pk provides a ready-to-use <b>SaaS platform</b>, marketing support, and access to a large customer base looking for installment-based shopping.
                    </p>
                    <h5>9. How do I receive payments for my sales?</h5>
                    <p>
                        Sellers receive payments directly into their registered bank accounts as per the agreed settlement terms.
                    </p>
                    <h5>10. Can I set my own installment plans?</h5>
                    <p>
                        Yes, sellers have the flexibility to set installment plans based on their business model and pricing strategy.
                    </p>
                    <h5>11. Is there a fee for using Atomshop.pk as a seller?</h5>
                    <p>
                        Yes, we charge a service fee based on the selected <b>SaaS plan</b>. Details are available in the seller registration section on our website.
                    </p>
                </div>
            </div>
        </div>

    </div>
    @include('website.home.partials.featured-start')
</div>
@endsection
