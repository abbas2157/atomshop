<!-- Products Start -->
@if(!empty($feature_products))
    <div class="container-fluid pt-2 pb-2">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2>
        <div class="row px-xl-5">
            @foreach($feature_products as $item)
                <div class="col-lg-2 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-2">
                        <div class="product-img position-relative overflow-hidden text-center py-3">
                            <img class="img-fluid w-75" src="{{  $item->picture ?? '' }}" alt="{{ $item->title ?? '' }}">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square add-to-cart" data-id="{{ $item->id }}" href="javascript:void(0)"><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                        <div class="p-2">
                            <a class="text-decoration-none product-item-title" href="{{ route('website.product.detail', ['slug' => $item->slug]) }}">{{ $item->title }}</a>                            
                            <div class="row mt-2">
                                <div class="col-lg-8 col-md-8 col-sm-8 pb-1">
                                    <div class="product-item-price">Rs. {{ $item->price ?? '' }}</div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 text-left">
                                    <div class="product-item-price "><img class="img-fluid w-50" src="{{  $item->brand_img ?? '' }}" alt="{{ $item->brand ?? '' }}"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
<!-- Products End -->
