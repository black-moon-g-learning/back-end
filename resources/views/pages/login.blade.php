@extends('layouts.auth-master')

@section('content')
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                            <div class="card card-plain">
                                <div class="card-header pb-0 text-start">
                                    <h1 class="mt-5 text-black font-weight-bolder position-relative">G - learning</h1>
                                    <p class="text-black position-relative">The best app for kid to learn GEOGRAPHY.</p>
                                    <p>----------------------------------</p>
                                    <h4 class="font-weight-bolder">Log In</h4>
                                    <p class="mb-0">Enter your email and password to log in</p>
                                </div>
                                <div class="card-body">
                                    @if (isset(Session::get('errors')['account']))
                                        @include(
                                            'components.alert',
                                            $data = Session::get('errors')['account']
                                        )
                                    @endif
                                    @if (isset(Session::get('errors')['permission']))
                                        @include('components.alert', $data = Session::get('errors'))
                                    @endif
                                    <form method="POST" action={{ route('web.login.post') }} role="form">
                                        @csrf
                                        <div class="mb-3">
                                            <input type="text" name="username" class="form-control form-control-lg"
                                                placeholder="Email" aria-label="Email">
                                        </div>
                                        @if (isset(Session::get('errors')['username']))
                                            @include(
                                                'components.alert',
                                                $data = Session::get('errors')['username']
                                            )
                                        @endif
                                        <div class="mb-3">
                                            <input type="password" class="form-control form-control-lg"
                                                placeholder="Password" name="password" aria-label="Password">
                                        </div>
                                        @if (isset(Session::get('errors')['password']))
                                            @include(
                                                'components.alert',
                                                $data = Session::get('errors')['password']
                                            )
                                        @endif
                                        {{-- <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="rememberMe">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div> --}}
                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0">Login</button>
                                        </div>
                                    </form>
                                </div>
                                {{-- <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">
                                        Don't have an account?
                                        <a href="javascript:;" class="text-primary text-gradient font-weight-bold">Sign
                                            up</a>
                                    </p>
                                </div> --}}
                            </div>
                        </div>
                        <div
                            class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                            <div class="position-relative h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center overflow-hidden"
                                style="background-image: url('{{ asset('/img/login-1.png') }}');
          background-size: cover;">
                                <span class="mask opacity-6"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
