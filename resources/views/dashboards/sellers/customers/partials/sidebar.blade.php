<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Customer</label>
        <nav class="nav flex-column">
            <a href="{{ route('seller.customers') }}" class="nav-link {{ (request()->segment(1) == 'seller' && (request()->segment(2) == 'customers')) ? 'active' : '' }}">All Customer</a>
        </nav>

        <label>Seller</label>
        <nav class="nav flex-column">
            <a href="{{ route('seller.sellers') }}" class="nav-link {{ (request()->segment(1) == 'seller' && (request()->segment(2) == 'sellers')) ? 'active' : '' }}">All Seller</a>
        </nav>
    </div>
</div>

