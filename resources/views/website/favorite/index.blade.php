@extends('website.layout.app')
@section('title')
    <title>Favorites | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="Favorites | Atomshop">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12 mb-5">
                <div class="bg-light mb-30">
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>SR No</th>
                                    <th>Product Title</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                    <th>Add to Cart</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle favorites-table">
                                <tr>
                                    <td colspan="5" class="align-middle text-center">
                                        <div class="text-center py-3">
                                            No product found. Please add some products.
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('website.home.partials.featured-start')
    </div>
@endsection
@section('js')
@endsection
