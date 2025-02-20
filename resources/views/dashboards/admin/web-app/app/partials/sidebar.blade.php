<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>HomePage App Sections</label>
        <label>Products</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.app.products.feature') }}" class="nav-link {{ (request()->segment(2) == 'app' && (request()->segment(3) == 'products') && (request()->segment(4) == 'feature')) ? 'active' : '' }}">Feature Section</a>
            <a href="{{ route('admin.app.products.feature.sync') }}" class="nav-link">Sync Section</a>
        </nav>
        <nav class="nav flex-column">
            <a href="{{ route('admin.app.products.app') }}" class="nav-link {{ (request()->segment(2) == 'app' && (request()->segment(3) == 'products') && (request()->segment(4) == 'app')) ? 'active' : '' }}">App Poducts Section</a>
            <a href="{{ route('admin.app.products.app.sync') }}" class="nav-link">Sync Section</a>
        </nav>
        <label>Categories</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.app.categories') }}" class="nav-link {{ (request()->segment(2) == 'app' && (request()->segment(3) == 'categories')) ? 'active' : '' }}">Categories Section</a>
            <a href="{{ route('admin.app.categories.sync') }}" class="nav-link">Sync Section</a>
        </nav>
        <label>Brands</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.app.brands') }}" class="nav-link {{ (request()->segment(2) == 'app' && (request()->segment(3) == 'brands')) ? 'active' : '' }}">Brands Section</a>
            <a href="{{ route('admin.app.brands.sync') }}" class="nav-link">Sync Section</a>
        </nav>

        <label>Sliders</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.app.sliders') }}" class="nav-link {{ (request()->segment(2) == 'app' && (request()->segment(3) == 'sliders')) ? 'active' : '' }}">Sliders Section</a>
            <a href="{{ route('admin.app.sliders.sync') }}" class="nav-link">Sync Section</a>
        </nav>
    </div>
</div>
