@extends('dashboards.admin.layout.app')
@section('title')
    <title>Admin Dashboard - {{ env('APP_NAME') ?? 'AtomShop' }}</title>
@endsection
@section('content')
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <div class="az-content-body-left">
                    <h2 class="az-content-title tx-24 mg-b-5">Hi, welcome back!</h2>
                    <p class="mg-b-20">Your product performance and management dashboard template.</p>
                    <div class="row row-sm mg-b-20">
                        <div class="col-sm-6 col-lg-4">
                            <div class="card card-dashboard-twentysix">
                                <div class="card-header">
                                    <h6 class="card-title">Customers</h6>
                                    <div class="chart-legend">
                                        <div><span class="bg-primary"></span> New</div>
                                        <div><span class="bg-teal"></span> Returning</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="pd-x-15">
                                        <h6>00 <span class="tx-success"><i class="icon ion-md-arrow-up"></i> 0.0%</span></h6>
                                        <label>Avg. Customers/Verified</label>
                                    </div>
                                    <div class="chart-wrapper">
                                        <div id="flotChart7" class="flot-chart" style="padding: 0px; position: relative;">
                                            <canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 363px; height: 120px;" width="726" height="240"></canvas><div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                                                <div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;">
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 90px; top: 105px; left: 83px; text-align: center;">Nov 20</div>
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 90px; top: 105px; left: 165px; text-align: center;">Nov 21</div>
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 90px; top: 105px; left: 247px; text-align: center;">Nov 22</div>
                                                </div>
                                                <div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;">
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 78px; left: 0px; text-align: right;">100</div>
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 59px; left: 0px; text-align: right;">200</div>
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 39px; left: 0px; text-align: right;">300</div>
                                                </div>
                                            </div>
                                            <canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 363px; height: 120px;" width="726" height="240"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="card card-dashboard-twentysix">
                                <div class="card-header">
                                    <h6 class="card-title">Sellers</h6>
                                    <div class="chart-legend">
                                        <div><span class="bg-primary"></span> New</div>
                                        <div><span class="bg-teal"></span> Returning</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="pd-x-15">
                                        <h6>00 <span class="tx-success"><i class="icon ion-md-arrow-up"></i> 0.0%</span></h6>
                                        <label>Avg. Sellers/Verified</label>
                                    </div>
                                    <div class="chart-wrapper">
                                        <div id="flotChart7" class="flot-chart" style="padding: 0px; position: relative;">
                                            <canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 363px; height: 120px;" width="726" height="240"></canvas><div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                                                <div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;">
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 90px; top: 105px; left: 83px; text-align: center;">Nov 20</div>
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 90px; top: 105px; left: 165px; text-align: center;">Nov 21</div>
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 90px; top: 105px; left: 247px; text-align: center;">Nov 22</div>
                                                </div>
                                                <div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;">
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 78px; left: 0px; text-align: right;">100</div>
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 59px; left: 0px; text-align: right;">200</div>
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 39px; left: 0px; text-align: right;">300</div>
                                                </div>
                                            </div>
                                            <canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 363px; height: 120px;" width="726" height="240"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <div class="card card-dashboard-twentysix">
                                <div class="card-header">
                                    <h6 class="card-title">Orders</h6>
                                    <div class="chart-legend">
                                        <div><span class="bg-primary"></span> New</div>
                                        <div><span class="bg-teal"></span> Returning</div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="pd-x-15">
                                        <h6>00 <span class="tx-success"><i class="icon ion-md-arrow-up"></i> 0.0%</span></h6>
                                        <label>Avg. Orders/Verified</label>
                                    </div>
                                    <div class="chart-wrapper">
                                        <div id="flotChart7" class="flot-chart" style="padding: 0px; position: relative;">
                                            <canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 363px; height: 120px;" width="726" height="240"></canvas><div class="flot-text" style="position: absolute; inset: 0px; font-size: smaller; color: rgb(84, 84, 84);">
                                                <div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; inset: 0px;">
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 90px; top: 105px; left: 83px; text-align: center;">Nov 20</div>
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 90px; top: 105px; left: 165px; text-align: center;">Nov 21</div>
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; max-width: 90px; top: 105px; left: 247px; text-align: center;">Nov 22</div>
                                                </div>
                                                <div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; inset: 0px;">
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 78px; left: 0px; text-align: right;">100</div>
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 59px; left: 0px; text-align: right;">200</div>
                                                    <div class="flot-tick-label tickLabel" style="position: absolute; top: 39px; left: 0px; text-align: right;">300</div>
                                                </div>
                                            </div>
                                            <canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 363px; height: 120px;" width="726" height="240"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-body card-dashboard-twentyfive mg-b-20">
                        <h6 class="card-title">Conversions</h6>
                        <div class="row row-sm">
                          <div class="col-6 col-sm-4 col-lg">
                            <label class="card-label">Conversion Rate</label>
                            <h6 class="card-value">0.81<small>%</small></h6>
                            <div class="chart-wrapper">
                              <div id="flotChart1" class="flot-chart" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 164.164px; height: 35px;" width="328" height="70"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 164.164px; height: 35px;" width="328" height="70"></canvas></div>
                            </div><!-- chart-wrapper -->
                          </div><!-- col -->
                          <div class="col-6 col-sm-4 col-lg">
                            <label class="card-label">Revenue</label>
                            <h6 class="card-value"><span>$</span>1,095,190</h6>
                            <div class="chart-wrapper">
                              <div id="flotChart2" class="flot-chart" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 164.164px; height: 35px;" width="328" height="70"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 164.164px; height: 35px;" width="328" height="70"></canvas></div>
                            </div><!-- chart-wrapper -->
                          </div><!-- col -->
                          <div class="col-6 col-sm-4 col-lg mg-t-20 mg-sm-t-0">
                            <label class="card-label">Unique Purchases</label>
                            <h6 class="card-value">53</h6>
                            <div class="chart-wrapper">
                              <div id="flotChart3" class="flot-chart" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 164.164px; height: 35px;" width="328" height="70"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 164.164px; height: 35px;" width="328" height="70"></canvas></div>
                            </div><!-- chart-wrapper -->
                          </div><!-- col -->
                          <div class="col-6 col-sm-4 col-lg mg-t-20 mg-lg-t-0">
                            <label class="card-label">Transactions</label>
                            <h6 class="card-value">31</h6>
                            <div class="chart-wrapper">
                              <div id="flotChart4" class="flot-chart" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 164.164px; height: 35px;" width="328" height="70"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 164.164px; height: 35px;" width="328" height="70"></canvas></div>
                            </div><!-- chart-wrapper -->
                          </div><!-- col -->
                          <div class="col-6 col-sm-4 col-lg mg-t-20 mg-lg-t-0">
                            <label class="card-label">Avg. Order Value</label>
                            <h6 class="card-value"><span>$</span>306.20</h6>
                            <div class="chart-wrapper">
                              <div id="flotChart5" class="flot-chart" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 164.164px; height: 35px;" width="328" height="70"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 164.164px; height: 35px;" width="328" height="70"></canvas></div>
                            </div><!-- chart-wrapper -->
                          </div><!-- col -->
                          <div class="col-6 col-sm-4 col-lg mg-t-20 mg-lg-t-0">
                            <label class="card-label">Quantity</label>
                            <h6 class="card-value">52</h6>
                            <div class="chart-wrapper">
                              <div id="flotChart6" class="flot-chart" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 164.164px; height: 35px;" width="328" height="70"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 164.164px; height: 35px;" width="328" height="70"></canvas></div>
                            </div><!-- chart-wrapper -->
                          </div><!-- col -->
                        </div><!-- row -->
                      </div>
                </div>
            </div>
        </div>
    </div>
@endsection
