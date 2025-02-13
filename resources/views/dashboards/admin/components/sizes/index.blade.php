@extends('dashboards.admin.layout.app')
@section('title')
    <title>Sizes - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/admin/components/partials/sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Product Management</span>
                    <span>Sizes</span>
                </div>
                <h2 class="az-content-title">Sizes</h2>
                <div class="az-content-label mg-b-5">List All</div>
                <p class="mg-b-20">All Sizes list here to view, edit & delete</p>
                <form action="">
                    <div class="row row-sm mb-2">
                        <div class="col-lg mt-2">
                            <select class="form-control" name="status">
                                <option selected disabled>Select Status</option>
                                <option value="inactive">Inactive</option>
                                <option value="active">Active</option>
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
                                    <a href="{{ route('admin.sizes.index') }}" class="btn btn-warning" type="submit" style="padding: 8px 20px; color:white;"><i class="far fa-arrow-alt-circle-left"></i></a>
                                </span>
                                <span class="input-group-btn" title="Create New">
                                    <a href="{{ route('admin.sizes.create') }}" class="btn btn-info" type="submit" style="padding: 8px 20px; color:white;"><i class="typcn typcn-document-add"></i></a>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered mg-b-0">
                        <thead>
                            <tr>
                                <th width="40px">ID</th>
                                <th>Title</th>
                                <th width="200px">Unit</th>
                                <th width="120px">Status</th>
                                <th width="120px">Created On</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($sizes->isNotEmpty())
                                @foreach($sizes as $item)
                                    <tr>
                                        <th>{{ $item->id ?? '' }}</th>
                                        <td>{{ $item->title ?? '' }}</td>
                                        <td>{{ config('website.units')[$item->unit] ?? '' }}</td>
                                        <td>{{ $item->status ?? '' }}</td>
                                        <td>{{ $item->created_at->format('M d, Y') ?? '' }}</td>
                                        <td>
                                            <a href="{{ route('admin.sizes.edit',$item->id) }}">View</a> |
                                            <a href="{{ route('admin.sizes.edit',$item->id) }}">Edit</a> |
                                            <a href="javascript:;" id="delete-btn">Delete</a>
                                            <form id="delete-form" action="{{ route('admin.sizes.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="7">No data found</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
                <div class="mt-2">
                    {!! $sizes->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).on('click', '#delete-btn', function () {
        if (confirm('Are you sure you want to delete this Color?')) {
            $('#delete-form').submit();
        }
    });
</script>
@endsection
