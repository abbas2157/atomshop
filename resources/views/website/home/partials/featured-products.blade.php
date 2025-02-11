<!-- Products Start -->
@if(!empty($feature_products))
    <div class="container-fluid pt-2 pb-2">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Featured Products</span></h2>
        <div class="row px-xl-5">
            @foreach($feature_products as $item)
                <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-2">
                        <div class="product-img position-relative overflow-hidden text-center py-3">
                            <img class="img-fluid w-75" src="{{  $item->picture ?? '' }}" alt="{{ $item->title ?? '' }}">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
                            </div>
                        </div>
                        <div class="p-2">
                            <a class="text-decoration-none product-item-title" href="{{ route('website.product.detail', ['slug' => $item->slug]) }}">{{ $item->title }}</a>                            
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8 py-1">
                                    <div class="product-item-installment">Available On <b>Installment</b></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-8 pb-1">
                                    <div class="product-item-price">Advance : Rs. <b>{{ $item->price ?? '00.00' }}</b></div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 text-left">
                                    <div class="product-item-brand "><b>{{ $item->brand ?? '' }}</b></div>
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
