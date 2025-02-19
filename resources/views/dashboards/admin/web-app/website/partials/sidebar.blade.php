<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>HomePage Sections</label>
        <label>Products</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.website.products.feature') }}" class="nav-link {{ (request()->segment(2) == 'website' && (request()->segment(3) == 'products') && (request()->segment(4) == 'feature')) ? 'active' : '' }}">Feature Section</a>
            <a href="{{ route('admin.website.products.feature.sync') }}" class="nav-link">Sync Section</a>
        </nav>
        <nav class="nav flex-column">
            <a href="{{ route('admin.website.products.web') }}" class="nav-link {{ (request()->segment(2) == 'website' && (request()->segment(3) == 'products') && (request()->segment(4) == 'web')) ? 'active' : '' }}">Web Products Section</a>
            <a href="{{ route('admin.website.products.web.sync') }}" class="nav-link">Sync Section</a>
        </nav>
        <label>Categories</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.website.categories') }}" class="nav-link {{ (request()->segment(2) == 'website' && (request()->segment(3) == 'categories')) ? 'active' : '' }}">Categories Section</a>
            <a href="{{ route('admin.website.categories.sync') }}" class="nav-link">Sync Section</a>
        </nav>
        <label>Brands</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.website.brands') }}" class="nav-link {{ (request()->segment(2) == 'website' && (request()->segment(3) == 'brands')) ? 'active' : '' }}">Brands Section</a>
            <a href="{{ route('admin.website.brands.sync') }}" class="nav-link">Sync Section</a>
        </nav>

        <label>Sliders</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.website.sliders') }}" class="nav-link {{ (request()->segment(2) == 'website' && (request()->segment(3) == 'sliders')) ? 'active' : '' }}">Sliders Section</a>
            <a href="{{ route('admin.website.sliders.sync') }}" class="nav-link">Sync Section</a>
        </nav>
    </div>
</div>
