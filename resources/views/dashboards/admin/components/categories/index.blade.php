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
            <p class="mg-b-20">All categories list here to view, edit & delete</p>
            <div class="row row-sm mb-2">
                <div class="col-lg"></div>
                <div class="col-lg"></div>
                <div class="col-lg">
                    <form action="">
                        <div class="input-group">
                            <input type="text" value="{{ request()->q ?? '' }}" class="form-control" name="q" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" style="padding: 8px 20px;"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0">
                    <thead>
                        <tr>
                            <th width="40px">ID</th>
                            <th>Title</th>
                            <th width="60px">Status</th>
                            <th width="120px">Created On</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($categories->isNotEmpty())
                            @foreach($categories as $item)
                                <tr>
                                    <th >{{ $item->id ?? '' }}</th>
                                    <td>{{ $item->title ?? '' }}</td>
                                    <td>{{ $item->status ?? '' }}</td>
                                    <td>{{ $item->created_at->format('M d, Y') ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('admin.categories.edit',$item->id) }}">View</a> |
                                        <a href="{{ route('admin.categories.edit',$item->id) }}">Edit</a> | 
                                        <a href="javascript:;" id="delete-btn">Delete</a>
                                        <form id="delete-form" action="{{ route('admin.categories.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <th colspan="5">No data found</th>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mt-2">
                {!! $categories->withQueryString()->links('pagination::bootstrap-5') !!} 
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).on('click', '#delete-btn', function () {
        if (confirm('Are you sure you want to delete this category?')) {
            $('#delete-form').submit();
        }
    });
</script>
@endsection