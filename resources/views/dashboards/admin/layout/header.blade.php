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
                <li class="nav-item active show">
                    <a href="{{ route('admin') }}" class="nav-link"><i class="typcn typcn-chart-area-outline"></i> Dashboard</a>
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
                        <h6>Aziana Pechon</h6>
                        <span>Premium Member</span>
                    </div>
                    <a href="" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-time"></i> Activity Logs</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a>
                    <a href="" class="dropdown-item"><i class="typcn typcn-power-outline"></i> Sign Out</a>
                </div>
            </div>
        </div>
    </div>
</div>