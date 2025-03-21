@extends('dashboards.sellers.layout.app')
@section('title')
  <title>Seller Dashboard - {{ env('APP_NAME') ?? 'AtomShop' }}</title> 
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
                    <div class="az-content-header-right">
                        <div class="media">
                            <div class="media-body">
                                <label>Start Date</label>
                                <h6>{{ $previous_30_date ?? '' }}</h6>
                            </div>
                        </div>
                        <div class="media">
                            <div class="media-body">
                                <label>End Date</label>
                                <h6>{{ $today_date ?? '' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-sm mg-b-20 mg-lg-b-0">
                    <div class="col-lg-5 col-xl-4">
                        <div class="row row-sm">
                            <div class="col-md-6 col-lg-12 mg-b-20 mg-md-b-0 mg-lg-b-20">
                                <div class="card card-dashboard-five">
                                    <div class="card-header">
                                        <h6 class="card-title">Monthly Sale & Recovery</h6>
                                        <span class="card-text">Tells you where your Sale & Recovery (Last 30 Days)</span>
                                    </div>
                                    <div class="card-body row row-sm">
                                        <div class="col-6 d-sm-flex align-items-center">
                                            <div class="card-chart bg-primary">
                                                <i class="typcn typcn-shopping-cart fs-2 text-white"></i>
                                            </div>
                                            <div>
                                                <label>Monthly Sale</label>
                                                <h4>{{ number_format($total_sales ?? 0) }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-6 d-sm-flex align-items-center">
                                            <div class="card-chart bg-purple">
                                                <i class="typcn typcn-arrow-minimise-outline fs-2 text-white"></i>
                                            </div>
                                            <div>
                                                <label>Recovery</label>
                                                <h4>{{ number_format($total_recovery ?? 0) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4">
                        <div class="row row-sm">
                            <div class="col-md-6 col-lg-12 mg-b-20 mg-md-b-0 mg-lg-b-20">
                                <div class="card card-dashboard-five">
                                    <div class="card-header">
                                        <h6 class="card-title">Total Orders & Customers</h6>
                                        <span class="card-text">Tells you where your Order & Customers (Last 30 Days)</span>
                                    </div>
                                    <div class="card-body row row-sm">
                                        <div class="col-6 d-sm-flex align-items-center">
                                            <div class="card-chart bg-info">
                                                <i class="typcn typcn-th-list-outline fs-2 text-white"></i>
                                            </div>
                                            <div>
                                                <label>Monthly Orders</label>
                                                <h4>{{ number_format($orders->count()) }}</h4>
                                            </div>
                                        </div>
                                        <div class="col-6 d-sm-flex align-items-center">
                                            <div class="card-chart bg-purple">
                                                <i class="typcn typcn-business-card fs-2 text-white"></i>
                                            </div>
                                            <div>
                                                <label>Customers</label>
                                                <h4>{{ number_format($total_customers ?? 0) }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-sm mg-b-20">
                    <div class="col-lg-4">
                        <div class="card card-dashboard-pageviews">
                            <div class="card-header">
                                <h6 class="card-title">Order by Statuses</h6>
                                <p class="card-text">These counts are orders statuses.</p>
                            </div>
                            <div class="card-body">
                                @php
                                    $total_order =  $orders->count();
                                @endphp
                                <div class="az-list-item">
                                    <div>
                                        <h6>Pending Orders</h6>
                                        <a href="{{ route('seller.orders.index', ['status' => 'Pending']) }}">View pending orders</a>
                                    </div>
                                    <div>
                                        <h6 class="tx-primary">{{ number_format($orders->where('status', 'Pending')->count()) }}</h6>
                                        @php
                                            $pending = $orders->where('status', 'Pending')->count();
                                            $total_order =  $orders->count();
                                            $Pending_percetage = round(($pending/$total_order) * 100, 2);
                                        @endphp
                                        <span>{{ $Pending_percetage ?? 00.00 }}% (-100.00%)</span>
                                    </div>
                                </div>
                                <div class="az-list-item">
                                    <div>
                                        <h6>Varification Orders</h6>
                                        <a href="{{ route('seller.orders.index', ['status' => 'Varification']) }}">View varification orders</a>
                                    </div>
                                    <div>
                                        <h6 class="tx-primary">{{ number_format($orders->where('status', 'Varification')->count()) }}</h6>
                                        @php
                                            $Varification = $orders->where('status', 'Varification')->count();
                                            $total_order =  $orders->count();
                                            $Varification_percetage = round(($Varification/$total_order) * 100, 2);
                                        @endphp
                                        <span>{{ $Varification_percetage ?? 00.00 }}% (-100.00%)</span>
                                    </div>
                                </div>
                                <div class="az-list-item">
                                    <div>
                                        <h6>Processing Orders</h6>
                                        <a href="{{ route('seller.orders.index', ['status' => 'Processing']) }}">View Processing orders</a>
                                    </div>
                                    <div>
                                        <h6 class="tx-primary">{{ number_format($orders->where('status', 'Processing')->count()) }}</h6>
                                        @php
                                            $Processing = $orders->where('status', 'Processing')->count();
                                            $total_order =  $orders->count();
                                            $Processing_percetage = round(($Processing/$total_order) * 100, 2);
                                        @endphp
                                        <span>{{ $percetage ?? 00.00 }}% (-100.00%)</span>
                                    </div>
                                </div>
                                <div class="az-list-item">
                                    <div>
                                        <h6>Delivered Orders</h6>
                                        <a href="{{ route('seller.orders.index', ['status' => 'Delivered']) }}">View Delivered orders</a>
                                    </div>
                                    <div>
                                        <h6 class="tx-primary">{{ number_format($orders->where('status', 'Delivered')->count()) }}</h6>
                                        @php
                                            $Delivered = $orders->where('status', 'Delivered')->count();
                                            $total_order =  $orders->count();
                                            $Delivered_percetage = round(($Delivered/$total_order) * 100, 2);
                                        @endphp
                                        <span>{{ $Delivered_percetage ?? 00.00 }}% (-100.00%)</span>
                                    </div>
                                </div>
                                <div class="az-list-item">
                                    <div>
                                        <h6>Instalments Orders</h6>
                                        <a href="{{ route('seller.orders.index', ['status' => 'Instalments']) }}">View Instalments orders</a>
                                    </div>
                                    <div>
                                        <h6 class="tx-primary">{{ number_format($orders->where('status', 'Instalments')->count()) }}</h6>
                                        @php
                                            $Instalments = $orders->where('status', 'Instalments')->count();
                                            $total_order =  $orders->count();
                                            $Instalments_percetage = round(($Instalments/$total_order) * 100, 2);
                                        @endphp
                                        <span>{{ $Instalments_percetage ?? 00.00 }}% (-100.00%)</span>
                                    </div>
                                </div>
                                <div class="az-list-item">
                                    <div>
                                        <h6>Completed Orders</h6>
                                        <a href="{{ route('seller.orders.index', ['status' => 'Completed']) }}">View Completed orders</a>
                                    </div>
                                    <div>
                                        <h6 class="tx-primary">{{ number_format($orders->where('status', 'Completed')->count()) }}</h6>
                                        @php
                                            $Completed = $orders->where('status', 'Completed')->count();
                                            $total_order =  $orders->count();
                                            $Completed_percetage = round(($Completed/$total_order) * 100, 2);
                                        @endphp
                                        <span>{{ $Completed_percetage ?? 00.00 }}% (-100.00%)</span>
                                    </div>
                                </div>
                                <div class="az-list-item">
                                    <div>
                                        <h6>Cancelled Orders</h6>
                                        <a href="{{ route('seller.orders.index', ['status' => 'Cancelled']) }}">View Cancelled orders</a>
                                    </div>
                                    <div>
                                        <h6 class="tx-primary">{{ number_format($orders->where('status', 'Cancelled')->count()) }}</h6>
                                        @php
                                            $Cancelled = $orders->where('status', 'Cancelled')->count();
                                            $total_order =  $orders->count();
                                            $Cancelled_percetage = round(($Cancelled/$total_order) * 100, 2);
                                        @endphp
                                        <span>{{ $Cancelled_percetage ?? 00.00 }}% (-100.00%)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8 mg-t-20 mg-lg-t-0">
                        <div class="card card-dashboard-four">
                            <div class="card-header">
                            <h6 class="card-title">Order by Statuses</h6>
                            </div>
                            <div class="card-body row">
                                <div class="col-md-6 d-flex align-items-center">
                                    <div class="chart"><canvas id="chartDonut"></canvas></div>
                                </div>
                                <div class="col-md-6 col-lg-5 mg-lg-l-auto mg-t-20 mg-md-t-0">
                                    <div class="az-traffic-detail-item">
                                        <div>
                                            <span>Pending Orders</span>
                                            <span>{{ number_format($orders->where('status', 'Pending')->count()) }} <span>({{ $Pending_percetage ?? '00.00' }}%)</span></span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-purple wd-{{ $Pending_percetage ?? '0' }}p" role="progressbar" aria-valuenow="{{ $Pending_percetage ?? '0' }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="az-traffic-detail-item">
                                        <div>
                                            <span>Varification Orders</span>
                                            <span>{{ number_format($orders->where('status', 'Varification')->count()) }} <span>({{ $Varification_percetage ?? '0' }}%)</span></span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning wd-{{ $Varification_percetage ?? '0' }}p" role="progressbar" aria-valuenow="{{ $Varification_percetage ?? '0' }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="az-traffic-detail-item">
                                        <div>
                                            <span>Processing Orders</span>
                                            <span>{{ number_format($orders->where('status', 'Processing')->count()) }} <span>({{ $Processing_percetage ?? '0' }}%)</span></span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-info wd-{{ $Processing_percetage ?? '0' }}p" role="progressbar" aria-valuenow="{{ $Processing_percetage ?? '0' }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="az-traffic-detail-item">
                                        <div>
                                            <span>Delivered Orders</span>
                                            <span>{{ number_format($orders->where('status', 'Delivered')->count()) }} <span>({{ $Delivered_percetage ?? '0' }}%)</span></span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-primary wd-{{ $Delivered_percetage ?? '0' }}p" role="progressbar" aria-valuenow="{{ $Delivered_percetage ?? '0' }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="az-traffic-detail-item">
                                        <div>
                                            <span>Instalments Orders</span>
                                            <span>{{ number_format($orders->where('status', 'Instalments')->count()) }} <span>({{ $Instalments_percetage ?? '0' }}%)</span></span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-dark wd-{{ $Instalments_percetage ?? '0' }}p" role="progressbar" aria-valuenow="{{ $Instalments_percetage ?? '0' }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="az-traffic-detail-item">
                                        <div>
                                            <span>Completed Orders</span>
                                            <span>{{ number_format($orders->where('status', 'Completed')->count()) }} <span>({{ $Completed_percetage ?? '0' }}%)</span></span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-success wd-{{ $Completed_percetage ?? '0' }}p" role="progressbar" aria-valuenow="{{ $Completed_percetage ?? '0' }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <div class="az-traffic-detail-item">
                                        <div>
                                            <span>Cancelled Orders</span>
                                            <span>{{ number_format($orders->where('status', 'Cancelled')->count()) }} <span>({{ $Cancelled_percetage ?? '0' }}%)</span></span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-danger wd-{{ $Cancelled_percetage ?? '0' }}p" role="progressbar" aria-valuenow="{{ $Cancelled_percetage ?? '0' }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="az-content-body-left">
                    <div class="row row-sm mg-b-20 pt-4">
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                            <div class="card flex-fill mb-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Latest Customers <sub>(5)</sub></h5>
                                </div>
                                <table class="table az-table-reference my-0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th class="d-none d-xl-table-cell">Email</th>
                                            <th class="d-none d-xl-table-cell">Phone</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th class="d-none d-md-table-cell">Joined On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customers as $item)
                                            <tr>
                                                <td>{{ $item->name ?? '' }}</td>
                                                <td class="d-none d-xl-table-cell">{{ $item->email ?? '' }}</td>
                                                <td class="d-none d-xl-table-cell">{{ $item->phone ?? '' }}</td>
                                                <td>
                                                    {{ $item->customer->address ?? 'Not Found' }},
                                                    {{ $item->customer->area->title ?? '' }},
                                                    {{ $item->customer->city->title ?? '' }}
                                                </td>
                                                <td>
                                                    @if($item->status == 'support')
                                                        <label class="badge badge-info">{{ $item->status ?? '' }}</label>
                                                    @elseif($item->status == 'block')
                                                        <label class="badge badge-danger">{{ $item->status ?? '' }}</label>
                                                    @elseif($item->status == 'pending')
                                                        <label class="badge badge-warning">{{ $item->status ?? '' }}</label>
                                                    @elseif($item->status == 'active')
                                                        <label class="badge badge-success">{{ $item->status ?? '' }}</label>
                                                    @endif
                                                </td>
                                                <td class="d-none d-md-table-cell">{{ $item->created_at->format('M d, Y') ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex mt-2">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Latest Orders <sub>(5)</sub></h5>
                                </div>
                                <table class="table az-table-reference my-0">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th class="d-none d-xl-table-cell">Amounts</th>
                                            <th class="d-none d-xl-table-cell">Customer Detail</th>
                                            <th>Others</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->cart->product->title ?? '' }} <br>
                                                    @if (!is_null($item->cart->memory))
                                                        <b>Storage : </b>{{ $item->cart->memory->title ?? '' }} <br>
                                                    @endif
                                                    @if (!is_null($item->cart->color))
                                                        <b>Color : </b>{{ $item->cart->color->title ?? '' }} <br>
                                                    @endif
                                                    @if (!is_null($item->cart->size))
                                                        <b>Size : </b>{{ $item->cart->size->title ?? '' }} <br>
                                                    @endif
                                                </td>
                                                <td class="d-none d-xl-table-cell">
                                                    <b>Advance Amount : </b>Rs.
                                                    {{ number_format($item->cart->product_advance_price, 0) }} <br>
                                                    <b>Total Deal Amount : </b>Rs.
                                                    {{ number_format($item->cart->product_price, 0) }} <br>
                                                    <b>Installment Tenure : </b> {{ number_format($item->cart->tenure, 0) }}
                                                    Months<br>
                                                </td>
                                                <td class="d-none d-xl-table-cell">
                                                    <b>Name : </b> {{ $item->user->name ?? '' }} <br>
                                                    <b>Phone : </b> {{ $item->user->phone ?? '' }} <br>
                                                    <b>Portal :</b> {{ $item->portal ?? '' }}
                                                </td>
                                                <td>
                                                    <b>Status : </b> {{ $item->status ?? '' }} <br>
                                                    <b>Date : </b> {{ $item->created_at->format('M d, Y') ?? '' }} <br>
                                                    <b>Detail : </b> <a
                                                        href="{{ route('seller.orders.show', $item->uuid) }}">View Order</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{!! asset('assets/lib/chart.js/Chart.bundle.min.js') !!}"></script>
    <script src="{!! asset('assets/js/dashboard.sampledata.js') !!}"></script>
    <script>
        $(function(){
            'use strict'
            // Donut Chart
            var datapie = {
                labels: ['Pending', 'Varification', 'Processing', 'Delivered', 'Instalments', 'Completed', 'Cancelled'],
                datasets: [{
                    data: [ parseInt({{ $Pending_percetage ?? 0 }}),
                            parseInt({{ $Varification_percetage ?? 0 }}),
                            parseInt({{ $Processing_percetage ?? 0 }}),
                            parseInt({{ $Delivered_percetage ?? 0 }}),
                            parseInt({{ $Instalments_percetage ?? 0 }}),
                            parseInt({{ $Completed_percetage ?? 0 }}),
                            parseInt({{ $Cancelled_percetage ?? 0 }})
                        ],
                    backgroundColor: ['#6f42c1', '#ffc107','#0dcaf0','#3366ff','#1c273c','#3bb001','#dc3545']
                }]
            };

            var optionpie = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false,
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            };

            // For a doughnut chart
            var ctxpie= document.getElementById('chartDonut');
            var myPieChart6 = new Chart(ctxpie, {
                type: 'doughnut',
                data: datapie,
                options: optionpie
            });
        });
    </script>
@endsection
