<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Accounts Management</label>
        <label></label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ (request()->segment(2) == 'users' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">All Users</a>
        </nav>
        <label>Sellers</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.sellers.index') }}" class="nav-link {{ (request()->segment(2) == 'sellers' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('admin.sellers.create') }}" class="nav-link {{ (request()->segment(2) == 'sellers' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>
        <label>Customers</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.customers.index') }}" class="nav-link {{ (request()->segment(2) == 'customers' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('admin.customers.create') }}" class="nav-link {{ (request()->segment(2) == 'customers' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>
    </div>
</div>