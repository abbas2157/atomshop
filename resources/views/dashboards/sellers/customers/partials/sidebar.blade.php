<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Customer</label>
        <nav class="nav flex-column">
            <a href="{{ route('seller.customers.index') }}" class="nav-link {{ (request()->segment(2) == 'customers' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('seller.customers.create') }}" class="nav-link {{ (request()->segment(2) == 'customers' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>

        <label>Seller</label>
        <nav class="nav flex-column">
            <a href="{{ route('seller.customers.index') }}" class="nav-link {{ (request()->segment(2) == 'customers' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('seller.customers.create') }}" class="nav-link {{ (request()->segment(2) == 'customers' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>

        
        <label>Seller</label>
        <nav class="nav flex-column">
            <a href="{{ route('seller.orders.index') }}" class="nav-link {{ (request()->segment(2) == 'orders' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('seller.orders.create') }}" class="nav-link {{ (request()->segment(2) == 'orders' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>
    </div>
</div>

