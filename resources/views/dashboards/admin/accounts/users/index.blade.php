@extends('dashboards.admin.layout.app')
@section('title')
    <title>Users - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/admin/accounts/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Accounts Management</span>
                <span>Users</span>
            </div>
            <h2 class="az-content-title">Users</h2>
            <div class="az-content-label mg-b-5">List All</div>
            <p class="mg-b-20">All Users list here to view, edit & delete</p>
            <form action="">
                <div class="row row-sm mb-2">
                    <div class="col-lg mt-2">
                        <select class="form-control" name="role">
                            <option selected disabled>Select Role</option>
                            <option value="customer" {{ ('customer' == request()->role) ? 'selected' : '' }}>Customer</option>
                            <option value="vendor" {{ ('seller' == request()->role) ? 'selected' : '' }}>Seller</option>
                            <option value="admin" {{ ('admin' == request()->role) ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                    <div class="col-lg mt-2">
                        <select class="form-control" name="status">
                            <option selected disabled>Select Status</option>
                            <option value="active" {{ ('active' == request()->role) ? 'selected' : '' }}>Active</option>
                            <option value="block" {{ ('block' == request()->role) ? 'selected' : '' }}>Block</option>
                            <option value="pending" {{ ('pending' == request()->role) ? 'selected' : '' }}>Pending</option>
                            <option value="support" {{ ('support' == request()->role) ? 'selected' : '' }}>Support</option>
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
                                <a href="{{ route('admin.users.index') }}" class="btn btn-warning" type="submit" style="padding: 8px 20px; color:white;"><i class="far fa-arrow-alt-circle-left"></i></a>
                            </span>
                            <span class="input-group-btn" title="Create New">
                                <a href="{{ route('admin.users.create') }}" class="btn btn-info" type="submit" style="padding: 8px 20px; color:white;"><i class="typcn typcn-document-add"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered mg-b-0">
                    <thead>
                        <tr>
                            <th width="50px">ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th width="60px">Role</th>
                            <th width="60px">Status</th>
                            <th width="120px">Created On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($users->isNotEmpty())
                            @foreach($users as $item)
                                <tr>
                                    <th>{{ $item->id ?? '' }}</th>
                                    <td>{{ $item->name ?? '' }}</td>
                                    <td>{{ $item->email ?? '' }}</td>
                                    <td>{{ $item->phone ?? '' }}</td>
                                    <td>
                                        @if($item->role == 'seller')
                                            <label class="badge badge-info">{{ $item->role ?? '' }}</label>
                                        @elseif($item->role == 'admin')
                                            <label class="badge badge-warning">{{ $item->role ?? '' }}</label>
                                        @elseif($item->role == 'customer')
                                            <label class="badge badge-success">{{ $item->role ?? '' }}</label>
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
                {!! $users->withQueryString()->links('pagination::bootstrap-5') !!} 
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