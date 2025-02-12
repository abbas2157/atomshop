<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Profile</label>
        <nav class="nav flex-column">
            <a href="{{ route('seller.profile') }}" class="nav-link {{ (request()->segment(2) == 'profile' && (request()->segment(3) == '')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('seller.profile.change.password') }}" class="nav-link {{ (request()->segment(2) == 'profile' && (request()->segment(3) == 'change')) ? 'active' : '' }}">Change Password</a>
        </nav>

        <label>Seller</label>
        <nav class="nav flex-column">
            <a href="{{ route('seller.index') }}" class="nav-link {{ (request()->segment(2) == 'sellers' && (request()->segment(3) == '')) ? 'active' : '' }}">View & Edit</a>
        </nav>
        <label>Activity Logs</label>
        <nav class="nav flex-column">
            <a href="" class="nav-link">View Logs</a>
        </nav>
        <label>Account Settings</label>
        <nav class="nav flex-column">
            <a href="" class="nav-link">View & Edit</a>
        </nav>
        <label>Others</label>
        <nav class="nav flex-column">
            <a href="{!! route('logout') !!}" class="nav-link">Logout</a>
        </nav>
    </div>
</div>
