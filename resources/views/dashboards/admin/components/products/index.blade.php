@extends('dashboards.admin.layout.app')
@section('title')
    <title>Products - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/admin/components/partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Product Management</span>
                <span>Products</span>
            </div>
            <h2 class="az-content-title">Products</h2>
            <div class="az-content-label mg-b-5">List All</div>
            <p class="mg-b-20">All products list here to view, edit & delete</p>
            <form action="">
                <div class="row row-sm mb-2">
                    <div class="col-lg mt-2">
                        <select class="form-control" name="category_id" required>
                            <option selected disabled>Select Category</option>
                            @if($categories->isNotEmpty())
                                @foreach($categories as $item)
                                    <option value="{{ $item->id ?? '' }}" {{ ($item->id == request()->category_id) ? 'selected' : '' }}>{{ $item->title ?? '' }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-lg mt-2">
                        <select class="form-control" name="brand_id" required>
                            <option selected disabled>Select Brand</option>
                            @if($brands->isNotEmpty())
                                @foreach($brands as $item)
                                    <option value="{{ $item->id ?? '' }}" {{ ($item->id == request()->category_id) ? 'selected' : '' }}>{{ $item->title ?? '' }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-lg mt-2">
                        <select class="form-control" name="status">
                            <option selected disabled>Select Status</option>
                            <option value="Closed" {{ ('Closed' == request()->status) ? 'selected' : '' }}>Closed</option>
                            <option value="Pending" {{ ('Pending' == request()->status) ? 'selected' : '' }}>Pending</option>
                            <option value="Published" {{ ('Published' == request()->status) ? 'selected' : '' }}>Published</option>
                            <option value="On hold" {{ ('On hold' == request()->status) ? 'selected' : '' }}>On hold</option>
                            <option value="Out of Stock" {{ ('Out of Stock' == request()->status) ? 'selected' : '' }}>Out of Stock</option>
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
                                <a href="{{ route('admin.products.index') }}" class="btn btn-warning" type="submit" style="padding: 8px 20px; color:white;"><i class="far fa-arrow-alt-circle-left"></i></a>
                            </span>
                            <span class="input-group-btn" title="Create New">
                                <a href="{{ route('admin.products.create') }}" class="btn btn-info" type="submit" style="padding: 8px 20px; color:white;"><i class="typcn typcn-document-add"></i></a>
                            </span>
                        </div>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table az-table-reference mg-b-0" style="width: 100%">
                    <thead>
                        <tr>
                            <th width="70px">PR No</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Brand</th>
                            <th width="60px">Status</th>
                            <th width="120px">Created On</th>
                            <th width="150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($products->isNotEmpty())
                            @foreach($products as $item)
                                <tr>
                                    <th>{{ $item->pr_number ?? '' }}</th>
                                    <td>{{ $item->title ?? '' }}</td>
                                    <td>{{ $item->category->title ?? '' }}</td>
                                    <td>{{ $item->brand->title ?? '' }}</td>
                                    <td>
                                        @if($item->status == 'Out of Stock')
                                            <label class="badge badge-info">{{ $item->status ?? '' }}</label>
                                        @elseif($item->status == 'On hold')
                                            <label class="badge badge-info">{{ $item->status ?? '' }}</label>
                                        @elseif($item->status == 'Closed')
                                            <label class="badge badge-danger">{{ $item->status ?? '' }}</label>
                                        @elseif($item->status == 'Pending')
                                            <label class="badge badge-warning">{{ $item->status ?? '' }}</label>
                                        @elseif($item->status == 'Published')
                                            <label class="badge badge-success">{{ $item->status ?? '' }}</label>
                                        @endif
                                    </td>
                                    <td>{{ $item->created_at->format('M d, Y') ?? '' }}</td>
                                    <td>
                                        <a href="{{ route('admin.products.edit',$item->id) }}">View</a> |
                                        <a href="{{ route('admin.products.edit',$item->id) }}">Edit</a> | 
                                        <a href="javascript:;" id="delete-btn">Delete</a>
                                        <form id="delete-form" action="{{ route('admin.products.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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
                {!! $products->withQueryString()->links('pagination::bootstrap-5') !!} 
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
    $(document).on('click', '#delete-btn', function () {
        if (confirm('Are you sure you want to delete this Product?')) {
            $('#delete-form').submit();
        }
    });
</script>
@endsection