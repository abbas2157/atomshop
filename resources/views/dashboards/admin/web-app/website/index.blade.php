@extends('dashboards.admin.layout.app')
@section('title')
    <title>Website Settings - {{ env('APP_NAME') ?? '' }}</title> 
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/admin/web-app/website.partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Website & App</span>
                <span>Website</span>
            </div>
            <h2 class="az-content-title">Website</h2>
            <div class="az-content-label mg-b-5">Home Page</div>
            <p class="mg-b-20">All Home section will be edit from here</p>
            <div class="az-content-label mg-b-5">Home Page Categories</div>
            <div class="board-wrapper pt-2">
                <div class="board-portlet">
                  <ul id="portlet-card-list-category" class="portlet-card-list">
                    @foreach($categories as $item)
                        <li class="portlet-card" id="{{ $item->id ?? '' }}">
                            <p class="task-date">{{ $item->created_at->format('M d, Y') ?? '' }}</p>
                            <h4 class="task-title">{{ $item->title ?? '' }}</h4>
                            <div class="image-grouped">
                                <img src="{{ $item->category_picture ?? '' }}" alt="profile image">
                            </div>
                        </li>
                    @endforeach
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
  <script>
    $(function()
    {
      $("#portlet-card-list-category").sortable(
      {
        connectWith: "#portlet-card-list-category",
        items: ".portlet-card",
        update: function (event, ui) {
            const sortedIDs = $(this).sortable("toArray");
            const formData = new FormData();
            formData.append("categories_id", JSON.stringify(sortedIDs));
            $.ajax({
                url: "{{ route('admin.website.category') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
      });
    });
  </script>

@endsection