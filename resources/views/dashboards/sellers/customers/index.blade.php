@extends('dashboards.sellers.layout.app')
@section('title')
    <title>All Customers - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/sellers/customers/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Accounts Management</span>
                <span>Customers</span>
            </div>
            <h2 class="az-content-title">Customers</h2>
            <div class="az-content-label mg-b-5">List All</div>
            <p class="mg-b-20">All Customers list here to view, edit & delete</p>
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
                                <a href="{{ route('seller.customers.create') }}" class="btn btn-warning" type="submit" style="padding: 8px 20px; color:white;"><i class="far fa-arrow-alt-circle-left"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table az-table-reference mg-b-0" >
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th width="60px">Verified</th>
                            <th width="60px">Status</th>
                            <th width="120px">Joined On</th>
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($customers->isNotEmpty())
                            @foreach($customers as $item)
                                <tr>
                                    <td>{{ $item->name ?? '' }}</td>
                                    <td>{{ $item->email ?? '' }}</td>
                                    <td>{{ $item->phone ?? '' }}</td>
                                    <td>{{ $item->customer->address ?? '' }}, {{ $item->customer->area->title ?? '' }}, {{ $item->customer->city->title ?? '' }}</td>
                                    <td>
                                        @if($item->customer->verified == '1')
                                            <label class="badge badge-success">Verified</label>
                                        @else
                                            <label class="badge badge-danger">Not Verified</label>
                                        @endif
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
                                    <td>{{ $item->created_at->format('M d, Y') ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('seller.customers.edit',$item->uuid) }}">View</a> |
                                        <a href="{{ route('seller.customers.edit',$item->uuid) }}">Edit</a>
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
            <div class="mt-2">
                {!! $customers->withQueryString()->links('pagination::bootstrap-5') !!}
            </div>
        </div>
    </div>
</div>
@endsection
