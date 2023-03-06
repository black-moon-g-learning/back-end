<li class="nav-item">
    <a id="category-{{ $id }}"
        class="nav-link {{ request()->fullUrl() == $route || str_contains(request()->fullUrl(), $route . '?page') ? 'active' : '' }}"
        href="{{ $route }}">
        <div
            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
            {{-- <i class="fa fa-tree text-primary text-sm opacity-10"></i> --}}
        </div>
        <span class="nav-link-text ms-1">{{ $name }}</span>
    </a>
</li>
