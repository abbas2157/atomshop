<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Categories</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ (request()->segment(2) == 'categories' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('admin.categories.create') }}" class="nav-link {{ (request()->segment(2) == 'categories' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>
        <label>Brands</label>
        <nav class="nav flex-column">
            <a href="" class="nav-link">View & Edit</a>
            <a href="" class="nav-link">Create new</a>
        </nav>
    </div>
</div>