<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Cities</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.cities.index') }}" class="nav-link {{ (request()->segment(2) == 'cities' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('admin.cities.create') }}" class="nav-link {{ (request()->segment(2) == 'cities' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>
        <label>areas</label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.areas.index') }}" class="nav-link {{ (request()->segment(2) == 'areas' && (request()->segment(3) !== 'create')) ? 'active' : '' }}">View & Edit</a>
            <a href="{{ route('admin.areas.create') }}" class="nav-link {{ (request()->segment(2) == 'areas' && (request()->segment(3) == 'create')) ? 'active' : '' }}">Create new</a>
        </nav>
    </div>
</div>