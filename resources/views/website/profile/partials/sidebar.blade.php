<h5 class="section-title position-relative text-uppercase mb-3">
    <span class="bg-secondary pr-3">Profile Menu</span>
</h5>
<div class="bg-light p-4 mb-30">
    <div class="d-flex align-items-center justify-content-between mb-1">
        <a href="{{ route('profile') }}" class="text-decoration-none text-{{ (request()->segment(1) == 'profile' && request()->segment(2) == '') ? 'primary' : 'muted' }}">My Profile</a>
        <span class="badge border font-weight-normal"><i class="fas fa-user text-{{ (request()->segment(1) == 'profile' && request()->segment(2) == '') ? 'primary' : 'muted' }}"></i></span>
    </div>
    <div class="d-flex align-items-center justify-content-between mb-1">
        <a href="{{ route('profile.password') }}" class="text-decoration-none text-{{ (request()->segment(1) == 'profile' && request()->segment(2) == 'password') ? 'primary' : 'muted' }}">Change Password</a>
        <span class="badge border font-weight-normal"><i class="fas fa-user text-{{ (request()->segment(1) == 'profile' && request()->segment(2) == 'password') ? 'primary' : 'muted' }}"></i></span>
    </div>
</div>
<h5 class="section-title position-relative text-uppercase mb-3">
    <span class="bg-secondary pr-3">Orders Menu</span>
</h5>
<div class="bg-light p-4 mb-30">
    <div class="d-flex align-items-center justify-content-between mb-1">
        <a href="{{ route('orders') }}" class="text-decoration-none text-{{ (request()->segment(1) == 'orders'  && request()->segment(2) == '') ? 'primary' : 'muted' }}">All Orders</a>
        <span class="badge border font-weight-normal"><i class="fas fa-cubes text-{{ (request()->segment(1) == 'orders' && request()->segment(2) == '') ? 'primary' : 'muted' }}"></i></span>
    </div>
</div>