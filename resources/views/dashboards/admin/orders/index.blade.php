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
            </div>
            <h2 class="az-content-title">Orders</h2>
            <div class="az-content-label mg-b-5">List All</div>
            <p class="mg-b-20">All Orders list here to view, edit & delete</p>
            <form action="">
                <div class="row row-sm mb-2">
                    <div class="col-lg mt-2">
                        <select class="form-control" name="status">
                            <option selected disabled>Select Status</option>
                            <option value="Pending" {{ ('Pending' == request()->status) ? 'selected' : '' }}>Pending</option>
                            <option value="Varification" {{ ('Varification' == request()->status) ? 'selected' : '' }}>Varification</option>
                            <option value="Processing" {{ ('Processing' == request()->status) ? 'selected' : '' }}>Processing</option>
                            <option value="Delivered" {{ ('Delivered' == request()->status) ? 'selected' : '' }}>Delivered</option>
                            <option value="Instalments" {{ ('Instalments' == request()->status) ? 'selected' : '' }}>Instalments</option>
                            <option value="Completed" {{ ('Completed' == request()->status) ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="col-lg mt-2">
                        <select class="form-control" name="portal">
                            <option selected disabled>Select Portal</option>
                            <option value="App" {{ ('App' == request()->portal) ? 'selected' : '' }}>App</option>
                            <option value="Web" {{ ('Web' == request()->portal) ? 'selected' : '' }}>Web</option>
                        </select>
                    </div>
                    <div class="col-lg mt-2">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" style="padding: 8px 20px; color:white;"><i class="fa fa-search"></i></button>
                            </span>
                            <span class="input-group-btn" title="Clear Search">
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-warning" type="submit" style="padding: 8px 20px; color:white;"><i class="far fa-arrow-alt-circle-left"></i></a>
                            </span>
                            {{-- <span class="input-group-btn" title="Create New">
                                <a href="{{ route('admin.orders.create') }}" class="btn btn-info" type="submit" style="padding: 8px 20px; color:white;"><i class="typcn typcn-document-add"></i></a>
                            </span> --}}
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table az-table-reference mg-b-0">
                    <thead>
                        <tr>
                            <th width="300px">Product Detail</th>
                            <th width="250px">Amounts</th>
                            <th width="200px">Customer Detail</th>
                            <th>Others</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($orders->isNotEmpty())
                            @foreach ($orders as $item)
                                <tr>
                                    <td class="align-middle"> 
                                        <div class="row">
                                            <div class="col-md-3 pt-1">
                                                <img src="{{ asset($item->cart->product->picture) }}" alt="" style="width: 50px;">
                                            </div>
                                            <div class="col-md-9">
                                                {{ $item->cart->product->title ?? '' }} <br>
                                                @if(!is_null($item->cart->memory))
                                                    <b>Storage : </b>{{ $item->cart->memory->title ?? '' }} <br>
                                                @endif
                                                @if(!is_null($item->cart->color))
                                                    <b>Color : </b>{{ $item->cart->color->title ?? '' }} <br>
                                                @endif
                                                @if(!is_null($item->cart->size))
                                                    <b>Size : </b>{{ $item->cart->size->title ?? '' }} <br>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <b>Advance Amount : </b>Rs. {{ number_format($item->cart->product_advance_price, 0) }} <br>
                                        <b>Total Deal Amount : </b>Rs. {{ number_format($item->cart->product_price,0) }} <br>
                                        <b>Installment Tenure : </b> {{ number_format($item->cart->tenure,0) }} Months<br>
                                    </td>

                                    <td class="align-middle">
                                        <b>Name : </b> {{ $item->user->name ?? '' }} <br>
                                        <b>Phone : </b> {{ $item->user->phone ?? '' }} <br>
                                        <b>Portal :</b> {{ $item->portal ?? '' }}
                                    </td>
                                    <td class="align-middle">
                                        <b>Status : </b> {{ $item->status ?? '' }} <br>
                                        <b>Date : </b> {{ $item->created_at->format('M d, Y') ?? '' }} <br>
                                        <b>Detail : </b> <a href="{{ route('admin.orders.show',$item->uuid) }}">View Order</a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="align-middle text-center">
                                    No Order Found
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                {!! $orders->withQueryString()->links('pagination::bootstrap-5') !!} 
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).on('click', '#delete-btn', function () {
        if (confirm('Are you sure you want to delete this Brand?')) {
            $('#delete-form').submit();
        }
    });
</script>
@endsection