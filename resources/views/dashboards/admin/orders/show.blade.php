@extends('dashboards.admin.layout.app')
@section('title')
    <title>Orders - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/admin/orders/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Orders Management</span>
                <span>Orders</span>
                <span>{{ $order->uuid ?? '' }}</span>
            </div>
            <h2 class="az-content-title">Orders</h2>
            <div class="az-content-label mg-b-5">All Order Details</div>
            <p class="mg-b-20">All Orders list here to view, edit & delete</p>
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0">
                    <thead>
                        <tr>
                            <th>Order No</th>
                            <th>Product Detail</th>
                            <th>Portal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td class="align-middle"> ORDER-{{ $order->id ?? '' }} </td>
                        <td class="align-middle"> 
                            <div class="row">
                                <div class="col-md-2 pt-1">
                                    <img src="{{ asset($order->cart->product->picture) }}" alt="" style="width: 50px;">
                                </div>
                                <div class="col-md-10">
                                    {{ $order->cart->product->title ?? '' }} <br>
                                    @if(!is_null($order->cart->memory))
                                        <b>Storage : </b>{{ $order->cart->memory->title ?? '' }} <br>
                                    @endif
                                    @if(!is_null($order->cart->color))
                                        <b>Color : </b>{{ $order->cart->color->title ?? '' }} <br>
                                    @endif
                                    @if(!is_null($order->cart->size))
                                        <b>Size : </b>{{ $order->cart->size->title ?? '' }} <br>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="align-middle text-center"> {{ $order->portal ?? '' }} </td>
                        <td class="align-middle text-center"> {{ $order->status ?? '' }} </td>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive mt-3">
                <table class="table table-bordered mg-b-0">
                    <thead>
                        <tr>
                            <th>Total Deal Amount</th>
                            <th>Advance Amount</th>
                            <th>Installment Tenure</th>
                            <th>Order Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <td class="align-middle  "> 
                            Rs. {{ number_format($order->cart->product_advance_price, 0) }}
                        </td>
                        <td class="align-middle "> 
                            Rs. {{ number_format($order->cart->product_price, 0) }}
                        </td>
                        <td class="align-middle "> 
                            {{ number_format($order->cart->tenure, 0) }} Months
                        </td>
                        <td>{{ $order->created_at->format('M d, Y') ?? '' }}</td>
                    </tbody>
                </table>
            </div>
            <div class="az-content-label mg-b-5 mt-4">Customer Details</div>
            <p class="mg-b-20">All Customer Details related to this order </p>
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0" >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th width="60px">Status</th>
                            <th width="120px">Join Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="align-middle">{{ $user->name ?? '' }}</td>
                            <td class="align-middle">{{ $user->email ?? '' }}</td>
                            <td class="align-middle">{{ $user->phone ?? '' }}</td>
                            <td>
                                {{ $user->customer->address ?? 'Not Found' }},
                                {{ $user->customer->area->title ?? '' }},
                                {{ $user->customer->city->title ?? '' }}
                            </td>
                            <td class="align-middle">
                                @if($user->status == 'support')
                                    <label class="badge badge-info">{{ $user->status ?? '' }}</label>
                                @elseif($user->status == 'block')
                                    <label class="badge badge-danger">{{ $user->status ?? '' }}</label>
                                @elseif($user->status == 'pending')
                                    <label class="badge badge-warning">{{ $user->status ?? '' }}</label>
                                @elseif($user->status == 'active')
                                    <label class="badge badge-success">{{ $user->status ?? '' }}</label>
                                @endif
                            </td>
                            <td class="align-middle">{{ $user->created_at->format('M d, Y') ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="az-content-label mg-b-5 mt-4">Installments Detail</div>
            <p class="mg-b-20">All Installments Details related to this order </p>
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0" >
                    <thead>
                        <tr>
                            <th>Sr No.</th>
                            <th>Installment Date</th>
                            <th>Amount</th>
                            <th width="120px">Payment Date</th>
                            <th width="60px">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr> <td colspan="5"  class="align-middle text-center"> No Date Found</td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    
</script>
@endsection