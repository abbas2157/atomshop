<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Orders Management</label>
        <label></label>
        <nav class="nav flex-column">
            <a href="{{ route('seller.orders.index') }}" class="nav-link {{ (request()->segment(1) == 'seller' && request()->segment(2) == 'orders' && request()->segment(3) == '') ? 'active show' : '' }}">View & Edit</a>
            <a href="{{ route('seller.orders.create') }}" class="nav-link {{ (request()->segment(1) == 'seller' && request()->segment(2) == 'orders' && request()->segment(3) == 'create') ? 'active show' : '' }}">Create new</a>
        </nav>
        <label></label>
        <nav class="nav flex-column">
            <a href="{{ route('seller.orders.index', ['status' => 'Pending']) }}" 
               class="nav-link {{ request()->status == 'Pending' ? 'active show' : '' }}">
                Pending Orders
            </a>
        </nav>
        <nav class="nav flex-column">
            <a href="{{ route('seller.orders.index', ['status' => 'Varification']) }}" 
               class="nav-link {{ request()->status == 'Varification' ? 'active show' : '' }}">
                Verification Orders
            </a>
        </nav>
        <nav class="nav flex-column">
            <a href="{{ route('seller.orders.index', ['status' => 'Processing']) }}" 
               class="nav-link {{ request()->status == 'Processing' ? 'active show' : '' }}">
                Processing Orders
            </a>
        </nav>
        <nav class="nav flex-column">
            <a href="{{ route('seller.orders.index', ['status' => 'Delivered']) }}" 
               class="nav-link {{ request()->status == 'Delivered' ? 'active show' : '' }}">
                Delivered Orders
            </a>
        </nav>
        <nav class="nav flex-column">
            <a href="{{ route('seller.orders.index', ['status' => 'Instalments']) }}" 
               class="nav-link {{ request()->status == 'Instalments' ? 'active show' : '' }}">
                Installments Orders
            </a>
        </nav>
        <nav class="nav flex-column">
            <a href="{{ route('seller.orders.index', ['status' => 'Completed']) }}" 
               class="nav-link {{ request()->status == 'Completed' ? 'active show' : '' }}">
                Completed Orders
            </a>
        </nav>
    </div>
</div>
