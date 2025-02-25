@extends('website.layout.app')
@section('title')
    <title>Privacy Policy | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="Privacy Policy | Atomshop - Pay in steps">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="{{ route('website') }}">Home</a>
                <span class="breadcrumb-item active">Privacy Policy</span>
            </nav>
        </div>
    </div>
    <div class="row px-xl-5 mb-5">
        <div class="col-12">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Privacy Policy</span></h5>
            <div class="bg-light p-30">
                <div class="text-center mb-3">
                  <h4>Terms & Conditions – <b>AtomShop.pk</b></h4>
                </div>
                <div>
                  <p>
                    <b>AtomShop.pk</b> is an online marketplace facilitating installment-based purchases. By using this website, you agree to abide by the <b>terms</b> and <b>conditions</b> outlined below. If you disagree, please refrain from using the platform.
                  </p>
                  <h4>1. Acceptance of <b>Terms</b></h4>
                  <p>
                    By accessing <b>AtomShop.pk</b>, you acknowledge that this platform enables users to place orders for products on installments. This process requires <b>verification</b> and <b>approval</b> before fulfillment. The <b>terms</b> may change without prior notice, and continued use signifies acceptance.
                  </p>
                  <h4>2. Order Placement & <b>Verification</b></h4>
                  <ul>
                    <li>Customers must provide accurate information when placing an order.</li>
                    <li>Sellers on <b>AtomShop.pk</b> reserve the right to cancel any order after <b>verification</b>.</li>
                    <li>If an order is rejected, the customer is responsible for collecting all submitted documents.</li>
                    <li>One product can be purchased per <b>CNIC</b> at a time, subject to <b>approval</b>.</li>
                    <li>Post-dated cheques may be required in some cases.</li>
                  </ul>
                  <h4>3. <b>Eligibility</b></h4>
                  <ul>
                    <li>Users must be at least <b>18</b> years old and legally able to enter contracts in Pakistan.</li>
                    <li>Providing false or inaccurate information may lead to account <b>termination</b>.</li>
                  </ul>
                  <h4>4. Account <b>Security</b></h4>
                  <ul>
                    <li>Users are responsible for maintaining the confidentiality of their accounts.</li>
                    <li>Any unauthorized access should be reported immediately.</li>
                    <li><b>AtomShop.pk</b> is not liable for any loss resulting from account <b>misuse</b>.</li>
                  </ul>
                  <h4>5. Product Delivery & <b>Warranty</b></h4>
                  <ul>
                    <li>Delivery is subject to vendor timelines and market conditions.</li>
                    <li>Customers must sign a delivery note acknowledging receipt.</li>
                    <li><b>Warranty</b> claims must be made directly to the manufacturer or authorized service centers.</li>
                    <li><b>AtomShop.pk</b> does not provide insurance for any purchased items.</li>
                  </ul>
                  <h4>6. Pricing & <b>Availability</b></h4>
                  <ul>
                    <li>Prices and <b>availability</b> are subject to change without notice.</li>
                    <li>Once an order is locked, the agreed amount will not fluctuate based on market changes.</li>
                  </ul>
                  <h4>7. <b>Cancellations</b> & <b>Refunds</b></h4>
                  <ul>
                    <li>Sellers may cancel orders at their discretion after <b>verification</b>.</li>
                    <li>Customers must collect their documents upon order rejection.</li>
                    <li>Overpayments may be adjusted in future installments or refunded within <b>45</b> days upon request.</li>
                  </ul>
                  <h4>8. <b>Privacy</b> & <b>Data Security</b></h4>
                  <ul>
                    <li>Customer data is securely stored and accessed on a need-to-know basis.</li>
                    <li>Data may be shared with third-party <b>verification</b> agencies as required.</li>
                    <li><b>AtomShop.pk</b> will not access personal mobile data.</li>
                  </ul>
                  <h4>9. <b>Legal Compliance</b> & <b>Disputes</b></h4>
                  <ul>
                    <li>Transactions are governed by the laws of Pakistan.</li>
                    <li>Any <b>disputes</b> will be resolved in Pakistani courts.</li>
                    <li>Users should conduct due diligence before entering any agreement.</li>
                  </ul>
                  <h4>10. Customer <b>Support</b> & <b>Grievances</b></h4>
                  <p>
                    For complaints or inquiries, contact:
                    <b>Email:</b> support@atomshop.pk
                    <b>Phone:</b> 0300-8622866
                  </p>
                  <p>
                    By using <b>AtomShop.pk</b>, you acknowledge and agree to these <b>terms</b>.
                  </p>
                </div>
              </div>
        </div>

    </div>
    @include('website.home.partials.featured-start')
</div>
@endsection
