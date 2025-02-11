@extends('dashboards.admin.layout.app')
@section('title')
    <title>Home Page Sections - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('content')
<div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
    <div class="container">
        @include('dashboards/admin/web-app/app.partials/sidebar')
        <div class="az-content-body pd-lg-l-40 d-flex flex-column">
            <div class="az-content-breadcrumb">
                <span>Website & App</span>
                <span>Website</span>
            </div>
            <h2 class="az-content-title">Website</h2>
            <div class="az-content-label mg-b-5">Home Page</div>
            <p class="mg-b-20">All Home sections will be edit from here</p>
            @if(!empty($brands))
                <div class="az-content-label mg-b-5">Home Page Brands</div>
                <div class="board-wrapper pt-2">
                    <div class="board-portlet">
                        <ul id="portlet-card-list-brand" class="portlet-card-list">
                            @foreach($brands as $item)
                                <li class="portlet-card" id="{{ $item->id ?? '' }}">
                                    <h4 class="task-title">{{ $item->title ?? '' }}</h4>
                                    <div class="image-grouped">
                                        <img src="{{ $item->picture ?? '' }}" alt="profile image">
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
@section('js')
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
  <script>
    $(function()
    {
        $("#portlet-card-list-brand").sortable({
            connectWith: "#portlet-card-list-brand",
            items: ".portlet-card",
            update: function (event, ui) {
                const sortedIDs = $(this).sortable("toArray");
                const formData = new FormData();
                formData.append("brands_id", JSON.stringify(sortedIDs));
                $.ajax({
                    url: "{{ route('admin.app.brands.update') }}",
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
