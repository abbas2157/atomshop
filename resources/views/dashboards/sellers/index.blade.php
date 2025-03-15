@extends('dashboards.sellers.layout.app')
@section('title')
  <title>Seller Dashboard - {{ env('APP_NAME') ?? 'AtomShop' }}</title> 
@endsection
@section('content')
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <div class="az-content-body-left">
                  <h2 class="az-dashboard-title">Hi, welcome back!</h2>
                  <p class="az-dashboard-text">Your web analytics dashboard template.</p>
                    <div class="row row-sm mg-b-20">
                        <div class="col-xl-6 col-xxl-7">
                            <div class="card flex-fill w-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Orders</h5>
                                </div>
                                <div class="card-body py-3">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card text-white bg-warning">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5 class="card-title">Pending</h5>
                                                        </div>
                                                    </div>
                                                    <h1 class="mt-1 mb-3">{{ $orders['pending'] }}</h1>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card text-white bg-primary">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5 class="card-title">Processing</h5>
                                                        </div>
                                                    </div>
                                                    <h1 class="mt-1 mb-3">{{ $orders['processing'] }}</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="card text-white bg-success">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5 class="card-title">Delivered</h5>
                                                        </div>
                                                    </div>
                                                    <h1 class="mt-1 mb-3">{{ $orders['delivered'] }}</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="card text-white bg-danger">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5 class="card-title">Instalments</h5>
                                                        </div>
                                                    </div>
                                                    <h1 class="mt-1 mb-3">{{ $orders['instalments'] }}</h1>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-1">
                                            <div class="card text-white bg-secondary">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <h5 class="card-title">Completed</h5>
                                                        </div>
                                                    </div>
                                                    <h1 class="mt-1 mb-3">{{ $orders['Completed'] }}</h1>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-xxl-5 d-flex">
                            <div class="card flex-fill w-100">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Orders</h5>
                                </div>
                                <div class="card-body py-3">
                                    <div class="w-100">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col mt-0">
                                                                <h5 class="card-title">Total Customers</h5>
                                                            </div>
                                                        </div>
                                                        <h1 class="mt-1 mb-3">{{ $customers['total'] }}</h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col mt-0">
                                                                <h5 class="card-title">Verified Customers</h5>
                                                            </div>
                                                        </div>
                                                        <h1 class="mt-1 mb-3">{{ $customers['verified'] }}</h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-sm mg-b-20 pt-4">
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                            <div class="card flex-fill mb-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Latest Customers</h5>
                                </div>
                                <table class="table az-table-reference  my-0">
                                    <thead>
                                        <tr>
                                            <th>NAME</th>
                                            <th class="d-none d-xl-table-cell">E-MAIL</th>
                                            <th class="d-none d-xl-table-cell">Phone</th>
                                            <th>STATUS</th>
                                            <th class="d-none d-md-table-cell">Created On</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($lastcustomer as $item)
                                            <tr>
                                                <td>{{ $item->name ?? '' }}</td>
                                                <td class="d-none d-xl-table-cell">{{ $item->email ?? '' }}</td>
                                                <td class="d-none d-xl-table-cell">{{ $item->phone ?? '' }}</td>
                                                <td><span class="badge bg-success">{{ $item->status ?? '' }}</span></td>
                                                <td class="d-none d-md-table-cell">{{ $item->created_at ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Upcoming Instalments</h5>
                                </div>
                                <table class="table az-table-reference my-0">
                                    <thead>
                                        <tr>
                                            <th>Instalment Month</th>
                                            <th class="d-none d-xl-table-cell">Amount</th>
                                            <th class="d-none d-xl-table-cell">Order</th>
                                            <th>Status</th>
                                            <th class="d-none d-md-table-cell">Type</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($lastInstalments as $tittle)
                                        <tr>
                                            <td>{{ $tittle->month }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $tittle->installment_price }}</td>
                                            <td class="d-none d-xl-table-cell">{{ optional($tittle->order->cart->product)->title }}</td>
                                            <td><span class="badge {{ $tittle->status == 'Paid' ? 'bg-success' : 'bg-danger' }}">{{ $tittle->status }}</span></td>
                                            <td class="d-none d-xl-table-cell">{{ $tittle->type }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-12 col-lg-12 col-xxl-12 d-flex mt-2">
                            <div class="card flex-fill">
                                <div class="card-header">
                                    
                                    <h5 class="card-title mb-0">Latest ORDERS</h5>
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
                                        @foreach ($lastOrders as $item)
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
