@extends('dashboards.admin.layout.app')
@section('title')
    <title>Admin Dashboard - {{ env('APP_NAME') ?? 'AtomShop' }}</title>
@endsection
@section('content')
<div class="az-content az-content-dashboard">
    <div class="container">
        <div class="az-content-body">
            <div class="az-dashboard-one-title">
                <div>
                    <h2 class="az-dashboard-title">Hi, welcome back!</h2>
                    <p class="az-dashboard-text">Your web analytics dashboard template.</p>
                </div>
                <div>
                    <label class="tx-13">All Sales (Offline)</label>
                    <h5>00,00</h5>
                </div>
            </div>

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="row row-sm">
                        <div class="col-md-3">
                            <div class="card card-dashboard-finance">
                                <h6 class="card-title">Total Seller</h6>
                                <h2><span>Rs. </span>00,00<small>.00</small></h2>
                                <span class="tx-12"><span class="tx-success tx-bold">0.0%</span> higher vs previous month</span>
                            </div>
                        </div><!-- col -->

                        <div class="col-md-3">
                            <div class="card card-dashboard-finance">
                                <h6 class="card-title">Verified Seller</h6>
                                <h2><span>Rs. </span>00,00<small>.00</small></h2>
                                <span class="tx-12"><span class="tx-danger tx-bold">0.0%</span> higher vs previous month</span>
                            </div>
                        </div><!-- col -->

                        <div class="col-md-3">
                            <div class="card card-dashboard-finance">
                                <h6 class="card-title">Total customer</h6>
                                <h2><span>Rs. </span>00,00<small>.00</small></h2>
                                <span class="tx-12"><span class="tx-success tx-bold">0.0%</span> higher vs previous month</span>
                            </div>
                        </div><!-- col -->

                        <div class="col-md-3">
                            <div class="card card-dashboard-finance">
                                <h6 class="card-title">Verified Customer</h6>
                                <h2><span>$</span>8,216<small>.00</small></h2>
                                <span class="tx-12"><span class="tx-success tx-bold">0.7%</span> higher vs previous month</span>
                            </div>
                        </div><!-- col -->
                    </div><!-- row -->
                </div><!-- col-lg-12 -->
            </div><!-- row -->

        </div>
    </div>
</div>
@endsection
