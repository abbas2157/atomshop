<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Webs & App</label>
        <label>Sliders</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.sliders.index') }}" class="nav-link {{ (request()->segment(2) == 'sliders' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('admin.sliders.create') }}" class="nav-link {{ (request()->segment(2) == 'sliders' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>
    </div>
</div>