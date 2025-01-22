<div class="az-header">
    <div class="container">
        <div class="az-header-left">
            <a href="{{ route('admin') }}" class="az-logo"><span></span> atomshop</a>
            <a href="" id="azMenuShow" class="az-header-menu-icon d-lg-none"><span></span></a>
        </div>
        <div class="az-header-menu">
            <div class="az-header-menu-header">
                <a href="{{ route('admin') }}" class="az-logo"><span></span> atomshop</a>
                <a href="" class="close">&times;</a>
            </div>
            <ul class="nav">
                <li class="nav-item {{ (request()->segment(1) == 'admin' && (request()->segment(2) == '')) ? 'active show' : '' }}">
                    <a href="{{ route('admin') }}" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
                </li>
                <li class="nav-item {{ (request()->segment(1) == 'admin' && (request()->segment(2) == 'categories' || request()->segment(2) == 'cities' || request()->segment(2) == 'areas' || request()->segment(2) == 'brands')) ? 'active show' : '' }}">
                    <a href="" class="nav-link with-sub"><i class="typcn typcn-th-large-outline"></i> Product Management</a>
                    <div class="az-menu-sub az-menu-sub-mega">
                        <div class="container">
                            <div>
                                <nav class="nav">
                                    <span>Products Management</span>
                                    <span>Products</span>
                                    <a href="{{ route('admin.products.index') }}" class="nav-link">All Products</a>
                                    <a href="{{ route('admin.products.create') }}" class="nav-link"> Create Product</a>
                                    <span class="mt-3">Categories</span>
                                    <a href="{{ route('admin.categories.index') }}" class="nav-link"> All Categories</a>
                                    <a href="{{ route('admin.categories.create') }}" class="nav-link">Create new</a>
                                    <span class="mt-3">Brands</span>
                                    <a href="{{ route('admin.brands.index') }}" class="nav-link">All Brands</a>
                                    <a href="{{ route('admin.brands.create') }}" class="nav-link">Create new</a>
                                </nav>
                                <nav class="nav">
                                    <span>Colors</span>
                                    <a href="{{ route('admin.colors.index') }}" class="nav-link"> All Colors</a>
                                    <a href="{{ route('admin.colors.create') }}" class="nav-link">Create new</a>
                                    <span class="mt-3">Memory</span>
                                    <a href="{{ route('admin.memory.index') }}" class="nav-link">Memory List</a>
                                    <a href="{{ route('admin.memory.create') }}" class="nav-link">Create new</a>
                                </nav>
                            </div>
                            <div>
                                <nav class="nav">
                                    <span>Zone Management</span>
                                    <span>Cities</span>
                                    <a href="{{ route('admin.cities.index') }}" class="nav-link"> All Cities</a>
                                    <a href="{{ route('admin.cities.create') }}" class="nav-link">Create new</a>
                                    <span class="mt-3">Areas</span>
                                    <a href="{{ route('admin.areas.index') }}" class="nav-link"> All Areas</a>
                                    <a href="{{ route('admin.areas.create') }}" class="nav-link">Create new</a>
                                </nav>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="az-header-right">
            <a href="" class="az-header-search-link"><i class="fas fa-search"></i></a>
            <div class="dropdown az-header-notification">
                <a href="" class="new"><i class="typcn typcn-bell"></i></a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header mg-b-20 d-sm-none">
                        <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <h6 class="az-notification-title">Notifications</h6>
                    <p class="az-notification-text">You have 2 unread notification</p>
                    <div class="az-notification-list">
                        <div class="media new">
                            <div class="az-img-user"><img src="{!! asset('assets/img/faces/face2.jpg') !!}" alt=""></div>
                            <div class="media-body">
                                <p>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</p>
                                <span>Mar 15 12:32pm</span>
                            </div>
                        </div>
                    </div>
                    <div class="dropdown-footer"><a href="">View All Notifications</a></div>
                </div>
            </div>
            <div class="dropdown az-profile-menu">
                <a href="" class="az-img-user"><img src="{!! asset('assets/img/faces/face1.jpg') !!}" alt=""></a>
                <div class="dropdown-menu">
                    <div class="az-dropdown-header d-sm-none">
                        <a href="" class="az-header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                    </div>
                    <div class="az-header-profile">
                        <div class="az-img-user">
                            <img src="{!! asset('assets/img/faces/face1.jpg') !!}" alt="">
                        </div>
                        <h6>{{ Auth::user()->name ?? '' }}</h6>
                        <span>{{ Auth::user()->role ?? '' }}</span>
                    </div>
                    <a href="{{ route('admin.profile') }}" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a>
                    <a href="{!! route('logout') !!}" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
                </div>
            </div>
        </div>
    </div>
</div>