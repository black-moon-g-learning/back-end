<!DOCTYPE html>
<html lang="en">

<head>
    @include('head.meta')
    <!-- Nucleo Icons -->
    <link href={{ asset('css/nucleo-icons.css') }} rel="stylesheet" />
    <link href={{ asset('css/nucleo-svg.css') }} rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- CSS Files -->
    <link id="pagestyle" href={{ asset('css/argon-dashboard.css?v=2.0.4') }} rel="stylesheet" />
    <link href="{{ asset('/vendor/nucleo/css/nucleo.css') }}" rel="stylesheet">
    @yield('customCss')
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    @include('components.left-side')
    <main class="main-content position-relative border-radius-lg ">
        @include('components.top')
        @if (Session::has('errors'))
            <div class="col-md-12 form-group">
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('errors')['data'] }}
                </div>
            </div>
        @endif
        <div class="container-fluid py-4">
            @yield('content')
        </div>
    </main>
    @include('components.configurator')

    <!--   Core JS Files   -->
    <script src={{ asset('js/core/popper.min.js') }}></script>
    <script src={{ asset('js/core/bootstrap.min.js') }}></script>
    <script src={{ asset('js/plugins/perfect-scrollbar.min.js') }}></script>
    <script src={{ asset('js/plugins/smooth-scrollbar.min.js') }}></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src={{ asset('js/argon-dashboard.min.js?v=2.0.4') }}></script>
    @yield('customJs')
</body>

</html>
