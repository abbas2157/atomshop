<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Orders Management</label>
        <label></label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.orders.index') }}" class="nav-link {{ (request()->segment(1) == 'admin' && request()->segment(2) == 'orders' && request()->segment(3) == '') ? 'active show' : '' }}">View & Edit</a>
            <a href="{{ route('admin.orders.create') }}" class="nav-link {{ (request()->segment(1) == 'admin' && request()->segment(2) == 'orders' && request()->segment(3) == 'create') ? 'active show' : '' }}">Create new</a>
        </nav>
    </div>
</div>
