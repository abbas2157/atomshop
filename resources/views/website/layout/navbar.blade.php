@php
    $website = App\Models\WebsiteSetup::select('categories')->first();
    $categories = [];
    if (!is_null($website)) {
        $categories = json_decode($website->categories);
    }
@endphp
<div class="container-fluid bg-dark mb-30">
    <div class="row px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn d-flex align-items-center justify-content-between bg-primary w-100 p--13" data-toggle="collapse"
                href="#navbar-vertical" >
                <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light p--14"
                id="navbar-vertical" >
                <div class="navbar-nav w-100">
                    @foreach ($categories as $item)
                        <a href="{{ route('category', $item->slug) }}" class="nav-item nav-link">{{ $item->title ?? '' }}</a>
                    @endforeach
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <span class="h1 text-uppercase text-dark bg-light px-2">Atom</span>
                    <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{ route('website') }}"
                            class="nav-item nav-link {{ request()->segment(1) == '' ? 'active' : '' }}">Home</a>
                        <a href="{{ route('shop') }}"
                            class="nav-item nav-link {{ request()->segment(1) == 'shop' ? 'active' : '' }}">Shop</a>
                        <a href="{{ route('calculator') }}"
                            class="nav-item nav-link {{ request()->segment(1) == 'installment-calculator' ? 'active' : '' }}">Installment
                            Calculator</a>
                            <a href="{{ route('contact-us') }}"
                            class="nav-item nav-link {{ request()->segment(1) == 'contact-us' ? 'active' : '' }}">
                            Contact</a>                    </div>
                    <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                        <a href="{{route('favorite')}}" class="btn px-0">
                            <i class="fas fa-heart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle favorite-count"
                                >0</span>
                        </a>
                        <a href="{{ route('cart') }}" class="btn px-0 ml-3 p--16">
                            <i class="fas fa-shopping-cart text-primary"></i>
                            <span class="badge text-secondary border border-secondary rounded-circle cart-count"
                                >0</span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
