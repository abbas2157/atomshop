@extends('website.layout.app')
@section('title')
    <title>Favorites | {{ config('website.name') ?? '' }} - {{ config('website.tagline') ?? '' }}</title>
    <meta name="description" content="Favorites | Atomshop">
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-12 mb-5">
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
                                <td colspan="5">
                                    <img  src="{{ asset('web/img/loader.gif') }}" class="w-10" alt="Loader">
                                </td>
                           </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
