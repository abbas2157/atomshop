@extends('dashboards.admin.layout.app')
@section('title')
    <title>Contacts - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/admin/components/partials/sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Product Management</span>
                    <span>Contacts</span>
                </div>
                <h2 class="az-content-title">Contacts</h2>
                <div class="az-content-label mg-b-5">List All</div>
                <p class="mg-b-20">All Contacts list here to view, edit & delete</p>
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
                                    <a href="{{ route('admin.contacts.index') }}" class="btn btn-warning" type="submit" style="padding: 8px 20px; color:white;"><i class="far fa-arrow-alt-circle-left"></i></a>
                                </span>
                                <span class="input-group-btn" title="Create New">
                                    <a href="{{ route('admin.contacts.create') }}" class="btn btn-info" type="submit" style="padding: 8px 20px; color:white;"><i class="typcn typcn-document-add"></i></a>
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
                                <th>Name</th>
                                <th width="200px">Phone</th>
                                <th width="120px">Subject</th>
                                <th width="120px">Message</th>
                                <th width="120px">Created On</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($contacts->isNotEmpty())
                                @foreach($contacts as $item)
                                    <tr>
                                        <th>{{ $item->id ?? '' }}</th>
                                        <td>{{ $item->name ?? '' }}</td>
                                        <td>{{ $item->phone ?? '' }}</td>
                                        <td>{{ $item->subject ?? '' }}</td>
                                        <td>{{ $item->message ?? '' }}</td>
                                        <td>{{ $item->created_at->format('M d, Y') ?? '' }}</td>
                                        <td>
                                            <a href="{{ route('admin.contacts.edit',$item->id) }}">View</a> |
                                            <a href="{{ route('admin.contacts.edit',$item->id) }}">Edit</a> |
                                            <a href="javascript:;" id="delete-btn">Delete</a>
                                            <form id="delete-form" action="{{ route('admin.contacts.destroy', $item->id) }}" method="POST">
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
                    {!! $contacts->withQueryString()->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script>
    $(document).on('click', '#delete-btn', function () {
        if (confirm('Are you sure you want to delete this Contact?')) {
            $('#delete-form').submit();
        }
    });
</script>
@endsection
