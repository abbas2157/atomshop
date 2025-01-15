@extends('dashboards.admin.layout.app')
@section('title')
    <title>Categories - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/admin/components/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Components</span>
                <span>Categories</span>
            </div>
            <h2 class="az-content-title">Categories</h2>
            <div class="az-content-label mg-b-5">List All</div>
            <p class="mg-b-20">All categories list here to edit & delete</p>
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Created On</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($categories->isNotEmpty())
                            @foreach($categories as $item)
                                <tr>
                                    <th>{{ $item->id ?? '' }}</th>
                                    <td>{{ $item->title ?? '' }}</td>
                                    <td>{{ $item->created_at->format('M d, Y') ?? '' }}</td>
                                    <td>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="4">No data found</th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection