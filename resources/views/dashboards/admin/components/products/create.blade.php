@extends('dashboards.admin.layout.app')
@section('title')
    <title>Products - {{ env('APP_NAME') ?? '' }}</title>
@endsection
@section('css')
<link href="{!! asset('assets/lib/select2/css/select2.min.css') !!}" rel="stylesheet">
<link href="{!! asset('assets/lib/quill/quill.snow.css') !!}" rel="stylesheet">
<link href="{!! asset('assets/lib/quill/quill.bubble.css') !!}" rel="stylesheet">
<link href="{!! asset('assets/lib/line-awesome/css/line-awesome.min.css') !!}" rel="stylesheet">
<style>
    .ck-editor__editable {
        min-height: 200px;
    }
</style>
@endsection
@section('content')
    <div class="az-content pd-y-20 pd-lg-y-30 pd-xl-y-40">
        <div class="container">
            @include('dashboards/admin/components/partials/sidebar')
            <div class="az-content-body pd-lg-l-40 d-flex flex-column">
                <div class="az-content-breadcrumb">
                    <span>Product Management</span>
                    <span>Products</span>
                    <span>Create</span>
                </div>
                <h2 class="az-content-title">Products</h2>
                <div class="az-content-label mg-b-5">Create new</div>
                <p class="mg-b-20">Using this form you can add new product</p>
                <form id="product-form-name" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div id="product-form">
                        <h3>Product Information</h3>
                        @include('dashboards/admin/components/products/create-partials/product-information')
                        <h3>Prices & Variations</h3>
                        @include('dashboards/admin/components/products/create-partials/prices-variations')
                        <h3>Product Description</h3>
                        @include('dashboards/admin/components/products/create-partials/product-description')
                        <h3>Product Images</h3>
                        @include('dashboards/admin/components/products/create-partials/product-images')
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{!! asset('assets/lib/jquery-steps/jquery.steps.min.js') !!}"></script>
    <script src="{!! asset('assets/lib/parsleyjs/parsley.min.js') !!}"></script>
    <script src="{!! asset('assets/lib/select2/js/select2.min.js') !!}"></script>
    <script src="{!! asset('assets/lib/quill/quill.min.js') !!}"></script>
    <script src="{!! asset('assets/js/product/create.js') !!}"></script>
@endsection
