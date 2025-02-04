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
            <div class="card card-dashboard-seven">
                <div class="card-header">
                  <div class="row row-sm">
                    <div class="col-6 col-md-4 col-xl">
                      <div class="media">
                        <div><i class="icon ion-ios-calendar"></i></div>
                        <div class="media-body">
                          <label>Start Date</label>
                          <div class="date">
                            <span>Sept 01, 2018</span> <a href=""><i class="icon ion-md-arrow-dropdown"></i></a>
                          </div>
                        </div>
                      </div><!-- media -->
                    </div>
                    <div class="col-6 col-md-4 col-xl">
                      <div class="media">
                        <div><i class="icon ion-ios-calendar"></i></div>
                        <div class="media-body">
                          <label>End Date</label>
                          <div class="date">
                            <span>Sept 30, 2018</span> <a href=""><i class="icon ion-md-arrow-dropdown"></i></a>
                          </div>
                        </div>
                      </div><!-- media -->
                    </div>
                    <div class="col-6 col-md-4 col-xl mg-t-15 mg-md-t-0">
                      <div class="media">
                        <div><i class="icon ion-logo-usd"></i></div>
                        <div class="media-body">
                          <label>Sales Measure</label>
                          <div class="date">
                            <span>Revenue</span> <a href=""><i class="icon ion-md-arrow-dropdown"></i></a>
                          </div>
                        </div>
                      </div><!-- media -->
                    </div>
                    <div class="col-6 col-md-4 col-xl mg-t-15 mg-xl-t-0">
                      <div class="media">
                        <div><i class="icon ion-md-person"></i></div>
                        <div class="media-body">
                          <label>Customer Type</label>
                          <div class="date">
                            <span>All Customers</span> <a href=""><i class="icon ion-md-arrow-dropdown"></i></a>
                          </div>
                        </div>
                      </div><!-- media -->
                    </div>
                    <div class="col-md-4 col-xl mg-t-15 mg-xl-t-0">
                      <div class="media">
                        <div><i class="icon ion-md-stats"></i></div>
                        <div class="media-body">
                          <label>Transaction Type</label>
                          <div class="date">
                            <span>All Transactions</span> <a href=""><i class="icon ion-md-arrow-dropdown"></i></a>
                          </div>
                        </div>
                      </div><!-- media -->
                    </div>
                  </div><!-- row -->
                </div><!-- card-header -->
                <div class="card-body">
                  <div class="row row-sm">
                    <div class="col-6 col-lg-3">
                      <label class="az-content-label">Total Quantity</label>
                      <h2>00,00</h2>
                      <div class="desc up">
                        <i class="icon ion-md-stats"></i>
                        <span><strong>0.00%</strong> (30 days)</span>
                      </div>
                    </div><!-- col -->
                    <div class="col-6 col-lg-3">
                      <label class="az-content-label">Total Cost</label>
                      <h2><span>Rs. </span>00,00</h2>
                      <div class="desc up">
                        <i class="icon ion-md-stats"></i>
                        <span><strong>0.00%</strong> (30 days)</span>
                      </div>
                    </div><!-- col -->
                    <div class="col-6 col-lg-3 mg-t-20 mg-lg-t-0">
                      <label class="az-content-label">Total Revenue</label>
                      <h2><span>Rs. </span>00,00</h2>
                      <div class="desc down">
                        <i class="icon ion-md-stats"></i>
                        <span><strong>0.00%</strong> (30 days)</span>
                      </div>
                    </div><!-- col -->
                    <div class="col-6 col-lg-3 mg-t-20 mg-lg-t-0">
                      <label class="az-content-label">Total Profit</label>
                      <h2><span>Rs. </span>00,00</h2>
                      <div class="desc up">
                        <i class="icon ion-md-stats"></i>
                        <span><strong>0.00%</strong> (30 days)</span>
                      </div>
                    </div><!-- col -->
                  </div><!-- row -->
                </div><!-- card-body -->
            </div>
            <div class="row row-sm">
                <div class="col-sm-6 col-lg-3">
                  <div class="card card-dashboard-donut">
                    <div class="card-header">
                      <h6 class="card-title mg-b-10">Gross Profit Margin</h6>
                      <p class="mg-b-0 tx-12 tx-gray-500">The profit you make on each dollar of sales... <a href="">Learn more</a></p>
                    </div><!-- card-header -->
                    <div class="card-body">
                      <div class="az-donut-chart chart1">
                        <div class="slice one"></div>
                        <div class="slice two"></div>
                        <div class="chart-center">
                          <span></span>
                        </div>
                      </div>
                    </div><!-- card-body -->
                  </div><!-- card -->
                </div>
                <div class="col-sm-6 col-lg-3 mg-t-20 mg-sm-t-0">
                  <div class="card card-dashboard-donut">
                    <div class="card-header">
                      <h6 class="card-title mg-b-10">Net Profit Margin</h6>
                      <p class="mg-b-0 tx-12 tx-gray-500">Measures your business at generating prof... <a href="">Learn more</a></p>
                    </div><!-- card-header -->
                    <div class="card-body">
                      <div class="az-donut-chart chart2">
                        <div class="slice one"></div>
                        <div class="slice two"></div>
                        <div class="chart-center">
                          <span></span>
                        </div>
                      </div>
                    </div><!-- card-body -->
                  </div><!-- card -->
                </div>
                <div class="col-lg-6">
                    <div class="row row-sm">
                      <div class="col-sm-6">
                        <div class="card card-dashboard-finance">
                          <h6 class="card-title">Total Income</h6>
                          <h2><span>Rs. </span>00,00<small>.00</small></h2>
                          <span class="tx-12"><span class="tx-success tx-bold">0.0%</span> higher vs previous month</span>
                        </div>
                      </div><!-- col -->
                      <div class="col-sm-6 mg-t-20 mg-sm-t-0">
                        <div class="card card-dashboard-finance">
                          <h6 class="card-title">Total Expenses</h6>
                          <h2><span>Rs. </span>00,00<small>.00</small></h2>
                          <span class="tx-12"><span class="tx-danger tx-bold">0.0%</span> higher vs previous month</span>
                        </div>
                      </div><!-- col -->
                      <div class="col-sm-6 mg-t-20">
                        <div class="card card-dashboard-finance">
                          <h6 class="card-title">Accounts Receivable</h6>
                          <h2><span>Rs. </span>00,00<small>.00</small></h2>
                          <span class="tx-12"><span class="tx-success tx-bold">0.0%</span> higher vs previous month</span>
                        </div>
                      </div><!-- col -->
                      <div class="col-sm-6 mg-t-20">
                        <div class="card card-dashboard-finance">
                          <h6 class="card-title">Accounts Payable</h6>
                          <h2><span>$</span>8,216<small>.00</small></h2>
                          <span class="tx-12"><span class="tx-success tx-bold">0.7%</span> higher vs previous month</span>
                        </div>
                      </div><!-- col -->
                    </div><!-- row -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection