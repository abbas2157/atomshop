@extends('dashboards.sellers.layout.app')
@section('title')
    <title>All Instalments - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/sellers/instalment/partials/sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Instalments Management</span>
                    <span>Instalments</span>
                </div>
                <h2 class="az-content-title">Instalments</h2>
                <div class="az-content-label mg-b-5">List All</div>
                <p class="mg-b-20">All Instalments list here to view, edit & delete</p>
                <form action="{{ route('seller.instalment.index') }}" method="GET">
                    <div class="row row-sm mb-2">
                        <div class="col-lg mt-2">
                            <select class="form-control" name="order_id">
                                <option selected disabled>Select Order</option>
                                @foreach ($allOrderIds as $order_id)
                                    <option value="{{ $order_id }}"
                                        {{ request('order_id') == $order_id ? 'selected' : '' }}>OR- {{ $order_id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg mt-2">
                            <select class="form-control" name="portal">
                                <option selected disabled>Select Portal</option>
                                <option value="App" {{ 'App' == request()->portal ? 'selected' : '' }}>App</option>
                                <option value="Web" {{ 'Web' == request()->portal ? 'selected' : '' }}>Web</option>
                            </select>
                        </div>
                        <div class="col-lg mt-2">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit"
                                        style="padding: 8px 20px; color:white;"><i class="fa fa-search"></i></button>
                                </span>
                                <span class="input-group-btn" title="Clear Search">
                                    <a href="{{ route('seller.instalment.index') }}" class="btn btn-warning" type="submit"
                                        style="padding: 8px 20px; color:white;"><i
                                            class="far fa-arrow-alt-circle-left"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="totalPaid" class="form-label"><strong>Total Paid:</strong></label>
                        <input type="text" class="form-control" id="totalPaid" value="Rs. {{ number_format($totalPaid, 0) }}" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="totalUnpaid" class="form-label"><strong>Total Unpaid:</strong></label>
                        <input type="text" class="form-control" id="totalUnpaid" value="Rs. {{ number_format($totalUnpaid, 0) }}" readonly>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table az-table-reference mg-b-0">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Month</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Receipt</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($instalments->isNotEmpty())
                                @foreach ($instalments as $instalment)
                                    <tr>
                                        <td>{{ $instalment->order->user->name ?? 'N/A' }}</td>
                                        <td>{{ $instalment->month }}</td>
                                        <td>Rs. {{ number_format($instalment->installment_price, 0) }}</td>
                                        <td>{{ $instalment->payment_method ?? 'N/A' }}</td>
                                        <td><span
                                                class="badge {{ $instalment->status == 'Paid' ? 'bg-success' : 'bg-danger' }}">{{ $instalment->status }}</span>
                                        </td>
                                        <td>
                                            @if ($instalment->receipet)
                                                <a href="{{ asset($instalment->receipet) }}" target="_blank">View
                                                    Receipt</a>
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No Instalments Found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>
                <div class="mt-2">
                    {!! $instalments->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
