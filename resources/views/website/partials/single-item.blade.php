<div class="product-item bg-light mb-2">
    <div class="product-img position-relative overflow-hidden text-center py-3">
        <img class="img-fluid w-75" src="{{ $item->product_picture ?? '' }}" alt="{{ $item->title ?? '' }}">
        <div class="product-action">
            <a class="btn btn-outline-dark btn-square add-to-cart" data-id="{{ $item->id }}" href="javascript:void(0)"><i class="fa fa-shopping-cart"></i></a>
            <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
        </div>
    </div>
    <div class="p-2">
        <a class="text-decoration-none product-item-title" href="{{ route('website.product.detail', ['slug' => $item->slug]) }}">{{ $item->title }}</a>                            
        <div class="row mt-2">
            <div class="col-lg-8 col-md-8 col-sm-8 pb-1">
                <div class="product-item-price py-1">Rs. {{ $item->price ?? '' }}</div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 text-left">
                <div class=""><img class="img-fluid w-50" src="{{  $item->brand->brand_picture ?? '' }}" alt="{{ $item->brand->title ?? '' }}"></div>
            </div>
        </div>
    </div>
</div>