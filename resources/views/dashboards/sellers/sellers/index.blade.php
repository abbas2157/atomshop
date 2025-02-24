@extends('dashboards.sellers.layout.app')
@section('title')
    <title>All Sellers - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/sellers/customers/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Accounts Management</span>
                <span>Sellers</span>
            </div>
            <h2 class="az-content-title">Sellers</h2>
            <div class="az-content-label mg-b-5">List All</div>
            <p class="mg-b-20">All Sellers list here to view, edit & delete</p>
            <form action="">
                <div class="row row-sm mb-2">
                    <div class="col-lg mt-2">
                        <select class="form-control" name="status">
                            <option selected disabled>Select Status</option>
                            <option value="active">Active</option>
                            <option value="block">Block</option>
                            <option value="pending">Pending</option>
                            <option value="support">Support</option>
                        </select>
                    </div>
                    <div class="col-lg mt-2">
                        <div class="input-group">
                            <input type="text" value="{{ request()->q ?? '' }}" class="form-control" name="q" placeholder="Search for...">
                        </div>
                    </div>
                    <div class="col-lg mt-2">
                        <div class="input-group">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" style="padding: 8px 20px; color:white;"><i class="fa fa-search"></i></button>
                            </span>
                            <span class="input-group-btn" title="Clear Search">
                                <a href="{{ route('seller.sellers') }}" class="btn btn-warning" type="submit" style="padding: 8px 20px; color:white;"><i class="far fa-arrow-alt-circle-left"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0" >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Area</th>
                            <th>City</th>
                            <th>Address</th>
                            <th width="60px">Status</th>
                            {{-- <th width="120px">Joined On</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @if(!empty($orders))
                        @foreach($orders as $item)
                                <tr>
                                    <td>{{ $item['seller']->user->name ?? '' }}</td>
                                    <td>{{ $item['seller']->user->email ?? '' }}</td>
                                    <td>{{ $item['seller']->area->title ?? '' }}</td>
                                    <td>{{ $item['seller']->city->title ?? '' }}</td>
                                    <td>{{ $item['seller']->address ?? '' }}</td>
                                    <td>
                                        @if($item['order']->status == 'Pending')
                                            <label class="badge badge-warning">{{ $item['order']->status ?? '' }}</label>
                                        @elseif($item['order']->status == 'Purchased')
                                            <label class="badge badge-success">{{ $item['order']->status ?? '' }}</label>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="10">No data found</th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- <div class="mt-2">
                {!! $orders->withQueryString()->links('pagination::bootstrap-5') !!} 
            </div>             --}}
        </div>
    </div>
</div>
@endsection
