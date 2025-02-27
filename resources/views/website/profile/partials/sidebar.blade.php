<h5 class="section-title position-relative text-uppercase mb-3">
    <span class="bg-secondary pr-3">Profile Menu</span>
</h5>
<div class="bg-light p-4 mb-30">
    <div class="d-flex align-items-center justify-content-between mb-1">
        <a href="{{ route('profile') }}" class="text-decoration-none text-{{ (request()->segment(1) == 'profile' && request()->segment(2) == '') ? 'primary' : 'muted' }}">My Profile</a>
        <span class="badge border font-weight-normal"><i class="fas fa-user text-{{ (request()->segment(1) == 'profile' && request()->segment(2) == '') ? 'primary' : 'muted' }}"></i></span>
    </div>
    <div class="d-flex align-items-center justify-content-between mb-1">
        <a href="{{ route('profile.verification') }}" class="text-decoration-none text-{{ (request()->segment(1) == 'profile' && request()->segment(2) == 'verification') ? 'primary' : 'muted' }}">Verification Docs</a>
        <span class="badge border font-weight-normal"><i class="fas fa-user-check text-{{ (request()->segment(1) == 'profile' && request()->segment(2) == 'verification') ? 'primary' : 'muted' }}" style="font-size: 78%; !important"></i></span>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('profile.password') }}" class="text-decoration-none text-{{ (request()->segment(1) == 'profile' && request()->segment(2) == 'password') ? 'primary' : 'muted' }}">Change Password</a>
        <span class="badge border font-weight-normal"><i class="fas fa-key text-{{ (request()->segment(1) == 'profile' && request()->segment(2) == 'password') ? 'primary' : 'muted' }}"></i></span>
    </div>
</div>
<h5 class="section-title position-relative text-uppercase mb-3">
    <span class="bg-secondary pr-3">Orders Menu</span>
</h5>
<div class="bg-light p-4 mb-30">
    <div class="d-flex align-items-center justify-content-between mb-1">
        <a href="{{ route('profile.orders') }}" class="text-decoration-none text-{{ (request()->segment(1) == 'profile'  && request()->segment(2) == 'orders') ? 'primary' : 'muted' }}">All Orders</a>
        <span class="badge border font-weight-normal"><i class="fas fa-cubes text-{{ (request()->segment(1) == 'profile' && request()->segment(2) == 'orders') ? 'primary' : 'muted' }}"></i></span>
    </div>
    <div class="d-flex align-items-center justify-content-between mb-1">
        <a href="{{ route('profile.installments') }}" class="text-decoration-none text-{{ (request()->segment(1) == 'profile'  && request()->segment(2) == 'installments') ? 'primary' : 'muted' }}">All Installments</a>
        <span class="badge border font-weight-normal" style="font-size: 90%; !important"><i class="fas fa-receipt text-{{ (request()->segment(1) == 'profile' && request()->segment(2) == 'installments') ? 'primary' : 'muted' }}"></i></span>
    </div>
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('profile.payments.history') }}" class="text-decoration-none text-{{ (request()->segment(1) == 'profile'  && request()->segment(2) == 'payments' && request()->segment(3) == 'history') ? 'primary' : 'muted' }}">Payment History</a>
        <span class="badge border font-weight-normal"><i class="fas fa-credit-card text-{{ (request()->segment(1) == 'profile' && request()->segment(2) == 'payments' && request()->segment(3) == 'history') ? 'primary' : 'muted' }}"></i></span>
    </div>
</div>
<h5 class="section-title position-relative text-uppercase mb-3">
    <span class="bg-secondary pr-3">Other Menu</span>
</h5>
<div class="bg-light p-4 mb-30">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('profile.favorite') }}" class="text-decoration-none text-{{ (request()->segment(1) == 'profile' && request()->segment(2) == 'favorite') ? 'primary' : 'muted' }}">Favorites</a>
        <span class="badge border font-weight-normal"><i class="fas fa-heart text-{{ (request()->segment(1) == 'profile' && request()->segment(2) == 'favorite') ? 'primary' : 'muted' }}"></i></span>
    </div>
</div>