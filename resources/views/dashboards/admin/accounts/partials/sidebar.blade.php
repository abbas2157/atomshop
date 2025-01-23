<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Accounts Management</label>
        <label></label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ (request()->segment(2) == 'users' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">All Users</a>
        </nav>
        <label>Suppliers</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.suppliers.index') }}" class="nav-link {{ (request()->segment(2) == 'suppliers' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('admin.suppliers.create') }}" class="nav-link {{ (request()->segment(2) == 'suppliers' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>
        <label>Customers</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.customers.index') }}" class="nav-link {{ (request()->segment(2) == 'customers' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('admin.customers.create') }}" class="nav-link {{ (request()->segment(2) == 'customers' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>
    </div>
</div>