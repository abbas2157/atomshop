<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Products</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.products.create') }}" class="nav-link {{ (request()->segment(2) == 'products' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
            <a href="{{ route('admin.products.index') }}" class="nav-link {{ (request()->segment(2) == 'products' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('admin.products.index') }}" class="nav-link">All Feature Products</a>
            <a href="{{ route('admin.products.index') }}" class="nav-link">All Published Products</a>
        </nav>
        <label>Categories</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ (request()->segment(2) == 'categories' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('admin.categories.create') }}" class="nav-link {{ (request()->segment(2) == 'categories' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>
        <label>Brands</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.brands.index') }}" class="nav-link {{ (request()->segment(2) == 'brands' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('admin.brands.create') }}" class="nav-link {{ (request()->segment(2) == 'brands' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>
        <label>Colors</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.colors.index') }}" class="nav-link {{ (request()->segment(2) == 'colors' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('admin.colors.create') }}" class="nav-link {{ (request()->segment(2) == 'colors' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>
        <label>Memory</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.memory.index') }}" class="nav-link {{ (request()->segment(2) == 'memory' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('admin.memory.create') }}" class="nav-link {{ (request()->segment(2) == 'memory' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>
        
    </div>
</div>