@extends('website.layout.app')
@section('title')
    <title>Atomshop - Pay in steps</title>
    <meta content="Atomshop - Pay in steps" name="description">
@endsection
@section('content')
    @include('website.home.partials.sliders')
    @include('website.home.partials.featured-start')
    @include('website.home.partials.categories')
    @include('website.home.partials.featured-products')
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $(".add-to-cart").click(function(e) {
                e.preventDefault();
                var product_id = $(this).data("id");
                console.log(product_id);
                $.ajax({
                    url: "{{ route('cart.store') }}",
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_id: product_id
                    },
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                        } else {
                            alert("Error: " + response.message);
                        }
                    },
                    error: function() {
                        alert("Something went wrong! Please try again.");
                    }
                });
            });
        });
    </script>
@endsection
