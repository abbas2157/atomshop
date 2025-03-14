<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Order Management</label>
        <label></label>
        <nav class="nav flex-column">
            <a href="{{ route('seller.custom-orders.index') }}" class="nav-link {{ (request()->segment(2) == 'custom-orders' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('seller.custom-orders.create') }}" class="nav-link {{ (request()->segment(2) == 'custom-orders' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>
    </div>
</div>

