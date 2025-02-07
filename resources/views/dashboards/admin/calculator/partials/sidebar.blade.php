<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Installment Calculator</label>
        <label></label>
        <nav class="nav flex-column">
            <a href="{{ route('admin.installment-calculator') }}" class="nav-link {{ (request()->segment(2) == 'installment-calculator') ? 'active' : '' }}">Settings</a>
        </nav>
    </div>
</div>