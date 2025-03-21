@extends('dashboards.sellers.layout.app')
@section('title')
    <title>Orders - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/sellers/orders/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Orders Management</span>
                <span>Orders</span>
                <span>{{ $order->uuid ?? '' }}</span>
            </div>
            <h2 class="az-content-title">Orders</h2>
            <div class="row">
                <div class="col-md-9">
                    <div class="az-content-label mg-b-5 pt-3">All Order Details</div>
                    <p class="mg-b-20">All Orders list here to view, edit & delete</p>
                </div>
                <div class="col-md-3">
                    <label>Change Status </label> 
                    <select class="form-control change_status" id="change_status" {{ ($user->customer->verified == '0') ? 'disabled' : '' }} {{ ($order->status == 'Cancelled') ? 'disabled' : '' }} style="cursor: pointer">
                        <option selected disabled>Change Status</option>
                        <option value="Pending" {{ ('Pending' == $order->status) ? 'selected' : '' }} {{ (in_array($order->status, ['Delivered','Instalments','Completed'])) ? 'disabled' : '' }}>Pending</option>
                        <option value="Varification" {{ ('Varification' == $order->status) ? 'selected' : '' }} {{ (in_array($order->status, ['Delivered','Instalments','Completed'])) ? 'disabled' : '' }}>Varification</option>
                        <option value="Processing" {{ ('Processing' == $order->status) ? 'selected' : '' }} {{ (in_array($order->status, ['Delivered','Instalments','Completed'])) ? 'disabled' : '' }}>Processing</option>
                        <option value="Delivered" {{ ('Delivered' == $order->status) ? 'selected' : '' }} {{ (in_array($order->status, ['Instalments','Completed'])) ? 'disabled' : '' }}>Delivered</option>
                        <option value="Instalments" {{ ('Instalments' == $order->status) ? 'selected' : '' }} {{ (in_array($order->status, ['Completed'])) ? 'disabled' : '' }}>Instalments</option>
                        <option value="Completed" {{ ('Completed' == $order->status) ? 'selected' : '' }} >Completed</option>
                        <option value="Cancelled" {{ ('Cancelled' == $order->status) ? 'selected' : '' }} >Cancelled</option>
                    </select>
                </div>
            </div>
            @if($user->customer->verified == '0') 
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Note !</strong> Until Customer is not verified. You can't change order status.
                </div>
            @endif
            @if($order->status == 'Cancelled') 
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Note !</strong> This Order is cancelled. Please see order change history below for reason.
                </div>
            @endif
            <div class="table-responsive">
                <table class="table az-table-reference mg-b-0">
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
                        <td class="align-middle text-center"> 
                            @if($order->status == 'Pending')
                                <label class="badge badge-purple">Pending</label>
                            @elseif($order->status == 'Varification')
                                <label class="badge badge-warning">Varification</label>
                            @elseif($order->status == 'Processing')
                                <label class="badge badge-info">Processing</label>
                            @elseif($order->status == 'Delivered')
                                <label class="badge badge-primary">Delivered</label>
                            @elseif($order->status == 'Instalments')
                                <label class="badge badge-dark">Instalments</label>
                            @elseif($order->status == 'Completed')
                                <label class="badge badge-success">Completed</label>
                            @elseif($order->status == 'Cancelled')
                                <label class="badge badge-danger">Cancelled</label>
                            @endif
                        </td>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive mt-3">
                <table class="table az-table-reference mg-b-0">
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
                            Rs. {{ number_format($order->total_deal_price, 0) }}
                        </td>
                        <td class="align-middle "> 
                            Rs. {{ number_format($order->advance_price, 0) }}
                        </td>
                        <td class="align-middle "> 
                            {{ number_format(floatval($order->instalment_tenure), 0) }} Months
                        </td>
                        <td>{{ $order->created_at->format('M d, Y') ?? '' }}</td>
                    </tbody>
                </table>
            </div>
            <div class="az-content-label mg-b-5 mt-4">Customer Details</div>
            <p class="mg-b-20">All Customer Details related to this order </p>
            <div class="table-responsive">
                <table class="table az-table-reference mg-b-0" >
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
                                @if($user->customer->verified == '1')
                                    <label class="badge badge-info">Verified</label>
                                @elseif($user->customer->verified == '0')
                                    <label class="badge badge-danger">No Verified</label>
                                @endif
                            </td>
                            <td class="align-middle">{{ $user->created_at->format('M d, Y') ?? '' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            @include('dashboards/sellers/orders/partials/instalment')
            @include('dashboards/sellers/orders/partials/change-history')
        </div>
    </div>
</div>
@include('dashboards/sellers/orders/partials/modal/delivered')
@include('dashboards/sellers/orders/partials/modal/instalment')
@include('dashboards/sellers/orders/partials/modal/pay-instalment')
@include('dashboards/sellers/orders/partials/modal/cancelled-status')
@endsection
@section('js')
<script>
    var ORDER_ID = "{{ $order->uuid ?? '' }}";
    var CURRENT_STATUS = "{{ $order->status ?? '' }}";
</script>

<script src="{!! asset('assets/js/seller/order/order.js') !!}"></script>
@endsection