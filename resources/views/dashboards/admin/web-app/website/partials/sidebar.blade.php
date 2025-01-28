<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>HomePage Sections</label>
        <label>Products</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.website.products.feature') }}" class="nav-link {{ (request()->segment(2) == 'website' && (request()->segment(3) == 'products') && (request()->segment(4) == 'feature')) ? 'active' : '' }}">Feature Section</a>
        </nav>
        <label></label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.website.categories') }}" class="nav-link {{ (request()->segment(2) == 'website' && (request()->segment(3) == 'categories')) ? 'active' : '' }}">Categories Section</a>
            <a href="{{ route('admin.website.brands') }}" class="nav-link {{ (request()->segment(2) == 'website' && (request()->segment(3) == 'brands')) ? 'active' : '' }}">Brands Section</a>
        </nav>
    </div>
</div>