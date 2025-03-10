<div class="product-item bg-light mb-4">
    <div class="product-img position-relative overflow-hidden">
        <img class="img-fluid w-100 p--20"
            src="{{ asset($item->picture) }}" alt="{{ $item->title ?? '' }}">
        <div class="product-action">
            <a class="btn btn-outline-dark btn-square" href=""><i
                    class="far fa-heart"></i></a>
        </div>
    </div>
    <div class="text-center py-4">
        <a class="h6 text-decoration-none text-truncate"
            href="">{{ $item->title ?? '' }}</a>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 py-1">
                <div class="product-item-installment">Available On <b>Installment</b></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-8 pb-1">
                <div class="product-item-price">Advance : Rs. <b>{{ $item->formatted_price ?? '00.00' }}</b></div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 text-left">
                <div class="product-item-brand "><b>{{ $item->brand->title ?? '' }}</b></div>
            </div>
        </div>
    </div>
</div>
