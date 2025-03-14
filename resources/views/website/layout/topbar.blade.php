<div class="container-fluid">
    <div class="row bg-secondary py-1 px-xl-5">
        <div class="col-lg-6 d-none d-lg-block">
            <div class="d-inline-flex align-items-center h-100">
                <a class="text-body mr-3" href="{{ route('about-us') }}">About</a>
                <a class="text-body mr-3" href="{{ route('contact-us') }}">Contact</a>
                <a class="text-body mr-3" href="{{ route('faqs') }}">FAQs</a>
            </div>
        </div>
        <div class="col-lg-6 text-center text-lg-right">
            <div class="d-inline-flex align-items-center">
                <div class="btn-group mx-2">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">My Account</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        @guest
                            <a href="{{ route('login') }}" class="dropdown-item">Sign in</a>
                            <a href="{{ route('website.register') }}" class="dropdown-item">Sign up</a>
                        @endguest
                        @auth
                            <a href="{{ route('profile') }}" class="dropdown-item"> My Profile</a>
                            <a href="{{ route('profile.orders') }}" class="dropdown-item"> My Orders</a>
                            <a href="{{ route('website.logout') }}" class="dropdown-item">Logout</a>
                        @endauth
                    </div>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">EN</button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item" type="button">EN</button>
                        <button class="dropdown-item" type="button">UR</button>
                    </div>
                </div>
            </div>
            <div class="d-inline-flex align-items-center d-block d-lg-none">
                <a href="" class="btn px-0 ml-2">
                    <i class="fas fa-heart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle p--17">0</span>
                </a>
                <a href="{{ route('cart') }}" class="btn px-0 ml-2">
                    <i class="fas fa-shopping-cart text-dark"></i>
                    <span class="badge text-dark border border-dark rounded-circle p--18">0</span>
                </a>
            </div>
        </div>
    </div>
    <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
        <div class="col-lg-4">
            <a href="{{ route('website') }}" class="text-decoration-none">
                <span class="h1 text-uppercase text-primary bg-dark px-2">Atom</span>
                <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
            </a>
        </div>
        <div class="col-lg-4 col-6 text-left">
            <form action="{{ route('shop') }}" class="search-form">
                <div class="input-group">
                    <input type="text" class="form-control" name="q" placeholder="Search for products" value="{{ request()->q ?? '' }}">
                    <div class="input-group-append search-click">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-4 col-6 text-right">
            <p class="m-0">Customer Service</p>
            <h5 class="m-0">{{ config('website.mobile') ?? 'No Phone' }}</h5>
        </div>
    </div>
</div>
