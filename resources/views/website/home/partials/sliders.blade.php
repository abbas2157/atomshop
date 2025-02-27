<!-- Carousel Start -->
<div class="container-fluid mb-3">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div id="header-carousel" class="carousel slide carousel-fade mb-30 mb-lg-0 d-none d-lg-block" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#header-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#header-carousel" data-slide-to="1"></li>
                    <li data-target="#header-carousel" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach($sliders as $slide)
                        <div class="carousel-item position-relative @if($loop->first) active @endif p--6" >
                            <img class="position-absolute w-100 h-100 p--7" src="{{ $slide->picture ?? '' }}"  alt="{{ $slide->title ?? 'Atomshop' }}">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3 p--8">
                                    <h1 class="display-4 text-white mb-3 animate__animated animate__fadeInDown">{{ $slide->title ?? 'Atomshop' }}</h1>
                                    <a class="btn btn-outline-light py-2 px-4 mt-3 animate__animated animate__fadeInUp" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="product-offer mb-30 p--9">
                <img class="img-fluid" src="{{ asset('sliders/Special-offer-2.jpg') }}" alt="Atomshop - Pay in steps">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Pay in Steps</h6>
                    <h3 class="text-white mb-3">Mobile, Laptop, Smart TV</h3>
                    {{-- <a href="" class="btn btn-primary">Shop Now</a> --}}
                </div>
            </div>
            <div class="product-offer mb-30 p--10">
                <img class="img-fluid" src="{{ asset('sliders/Special-offer.jpg') }}" alt="Atomshop - Pay in steps">
                <div class="offer-text">
                    <h6 class="text-white text-uppercase">Pay in Steps</h6>
                    <h3 class="text-white mb-3">Motorbikes, Electirc Scooty</h3>
                    {{-- <a href="" class="btn btn-primary">Shop Now</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Carousel End -->
