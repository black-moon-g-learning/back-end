<li class="nav-item">
    <a class="nav-link {{ (request()->fullUrl() == $tab['route'])|| (str_contains(request()->fullUrl(),$tab['route'].'?page')) ? 'active' : '' }}" href="{{ $tab['route'] }}">
        <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
        </div>
        <span class="nav-link-text ms-1">{{ $tab['name'] }}</span>
    </a>
</li>
