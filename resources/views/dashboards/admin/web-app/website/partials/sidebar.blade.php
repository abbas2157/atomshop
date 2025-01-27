<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Website Management</label>
        <label></label>
        <nav class="nav flex-column">
            <a href="" class="nav-link {{ (request()->segment(2) == 'website' && (request()->segment(3) == '')) ? 'active' : '' }}">Home Page</a>
        </nav>
    </div>
</div>