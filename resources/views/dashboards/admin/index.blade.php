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
                            @php
                                $totalSellersCount = DB::table('sellers')->count();
                            @endphp

                            <div class="col-md-3">
                                <div class="card card-dashboard-finance">
                                    <h6 class="card-title">Total Sellers</h6>
                                    <h2>{{ $totalSellersCount }}</h2>
                                    <span class="tx-12"><span class="tx-success tx-bold">0.0%</span> higher vs previous
                                        month</span>
                                </div>
                            </div>

                            @php
                                $verifiedSellersCount = DB::table('sellers')->where('verified', true)->count();
                            @endphp

                            <div class="col-md-3">
                                <div class="card card-dashboard-finance">
                                    <h6 class="card-title">Verified Sellers</h6>
                                    <h2>{{ $verifiedSellersCount }}</h2>
                                    <span class="tx-12"><span class="tx-success tx-bold">0.0%</span> higher vs previous
                                        month</span>
                                </div>
                            </div>
                            @php
                            $totalCustomersCount = DB::table('customers')->count();
                        @endphp
                            <div class="col-md-3">
                                <div class="card card-dashboard-finance">
                                    <h6 class="card-title">Total customer</h6>
                                    <h2><span>{{$totalCustomersCount}}</small></h2>
                                    <span class="tx-12"><span class="tx-success tx-bold">0.0%</span> higher vs previous
                                        month</span>
                                </div>
                            </div>
                            @php
                            $verifiedCustomersCount = DB::table('customers')->where('verified', true)->count();
                        @endphp
                            <div class="col-md-3">
                                <div class="card card-dashboard-finance">
                                    <h6 class="card-title">Verified Customer</h6>
                                    <h2><span>{{$verifiedCustomersCount}}</small></h2>
                                    <span class="tx-12"><span class="tx-success tx-bold">0.7%</span> higher vs previous
                                        month</span>
                                </div>
                            </div>
                        </div><!-- row -->
                    </div><!-- col-lg-12 -->
                </div><!-- row -->

            </div>
        </div>
    </div>
@endsection
