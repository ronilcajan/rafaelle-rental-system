@php
    $url = Request::segment(1);
@endphp
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item {{ $url == 'rents' ? 'active' : null }}">
            <a class="nav-link" href="{{ route('rents') }}">
                <i class="ti-layers-alt menu-icon"></i>
                <span class="menu-title">Rents</span>
            </a>
        </li>

        <li class="nav-item {{ $url == 'property' ? 'active' : null }}">
            <a class="nav-link" data-toggle="collapse" href="#property" aria-expanded="false" aria-controls="property">
                <i class="ti-home menu-icon"></i>
                <span class="menu-title">Property</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ $url == 'property' ? 'show' : null }}" id="property">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('property') }}"> List </a>
                    </li>
                </ul>
            </div>
        </li>

        <li class="nav-item {{ $url == 'tenants' ? 'active' : null }}">
            <a class="nav-link" data-toggle="collapse" href="#tenants" aria-expanded="false" aria-controls="tenants">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Tenants</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ $url == 'tenants' ? 'show' : null }}" id="tenants">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('tenants') }}"> List </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item {{ $url == 'owners' ? 'active' : null }}">
            <a class="nav-link" data-toggle="collapse" href="#owners" aria-expanded="false" aria-controls="owners">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Owners</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ $url == 'owners' ? 'show' : null }}" id="owners">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('owners') }}"> List </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('users') }}"> List </a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('settings') }}">
                <i class="ti-settings menu-icon"></i>
                <span class="menu-title">Settings</span>
            </a>
        </li>
    </ul>
</nav>
