<div class="az-content-left az-content-left-components">
    <div class="component-item">
        <label>Instalment Management</label>
        <label></label>
        <nav class="nav flex-column">
            <a href="{{ route('seller.instalment.index') }}" class="nav-link {{ request('status') == null && !request('upcoming') ? 'active' : '' }}">All Instalments</a>
            <a href="{{ route('seller.instalment.index', ['upcoming' => true]) }}" class="nav-link {{ request('upcoming') ? 'active' : '' }}">Upcoming Instalments</a>
            <a href="{{ route('seller.instalment.index', ['status' => 'Paid']) }}" class="nav-link {{ request('status') == 'Paid' ? 'active' : '' }}">Paid Instalments</a>
            <a href="{{ route('seller.instalment.index', ['status' => 'Unpaid']) }}" class="nav-link {{ request('status') == 'Unpaid' ? 'active' : '' }}">Unpaid Instalments</a>
        </nav>
    </div>
</div>

