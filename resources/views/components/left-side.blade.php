@php
    $tabs = [
        [
            'name' => 'Dashboard',
            'route' => route('web.dashboard'),
        ],
        [
            'name' => 'Continents',
            'route' => route('web.continents'),
        ],
        [
            'name' => 'Countries',
            'route' => route('web.countries'),
        ],
        [
            'name' => 'Topics',
            'route' => route('web.topics'),
        ],
        [
            'name' => 'Level',
            'route' => route('web.levels'),
        ],
        [
            'name' => ' Service',
            'route' => route('web.services'),
        ],
        [
            'name' => 'Users',
            'route' => route('web.users'),
        ],
        [
            'name' => 'Payment history',
            'route' => route('web.users-payment'),
        ],
        [
            'name' => 'Have you heard before?',
            'route' => route('web.information'),
        ],
    ];
@endphp

<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header ">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html "
            target="_blank">
            <img src="{{ asset('favicon.png') }}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">G-learning Dashboard</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @php
                $index = 0;
            @endphp
            @foreach ($tabs as $tab)
                @include('components.tab', [
                    'name' => $tab['name'],
                    'route' => $tab['route'],
                    'id' => $index,
                ])
                @php
                    $index++;
                @endphp
            @endforeach
        </ul>
    </div>
</aside>
