<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Orders Management</label>
        <label></label>
        <nav class="nav flex-column">
            <a href="{{ route('seller.orders.index') }}" class="nav-link {{ (request()->segment(2) == 'orders' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">All Orders</a>
        </nav>
    </div>
</div>
