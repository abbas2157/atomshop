<div class="product-item bg-light mb-4">
    <div class="product-img position-relative overflow-hidden">
        <img class="img-fluid w-100" style="height: 300px; object-fit: cover;"
            src="{{ asset($item->picture) }}" alt="{{ $item->title ?? '' }}">
        <div class="product-action">
            <a class="btn btn-outline-dark btn-square" href=""><i
                    class="fa fa-shopping-cart"></i></a>
            <a class="btn btn-outline-dark btn-square" href=""><i
                    class="far fa-heart"></i></a>
        </div>
    </div>
    <div class="text-center py-4">
        <a class="h6 text-decoration-none text-truncate"
            href="">{{ $item->title ?? '' }}</a>
        <div class="d-flex align-items-center justify-content-center mt-2">
            <h5>RS. {{ $item->formatted_price ?? '' }}</h5>
            <h6 class="text-muted ml-2"><del>RS. {{ $item->formatted_price ?? '' }}</del></h6>
        </div>
    </div>
</div>