<!DOCTYPE html>
<html>
@inject('Common', 'App\Constants\Common')

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>G -learning</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Swiper slider-->
    <link rel="stylesheet" href="{{ asset('landing-page/vendor/swiper/swiper-bundle.min.css') }}">
    <!-- Modal Video-->
    <link rel="stylesheet" href="{{ asset('landing-page/vendor/modal-video/css/modal-video.min.css') }}">
    {{-- vendor/modal-video/css/modal-video.min.css --}}
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:400,600,800&amp;display=swap">
    <!-- Device Mockup-->
    <link rel="stylesheet" href="{{ asset('landing-page/css/device-mockups.css') }} ">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{ asset('landing-page/css/style.default.css') }} " id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{ asset('landing-page/css/custom.css') }} ">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{ asset('favicon.png') }} ">
</head>

<body>
    <!-- navbar-->
    <header class="header">
        <nav class="navbar navbar-light navbar-expand-lg fixed-top" id="navbar">
            <div class="container"><a class="navbar-brand" href="index.html"><img high="50" width="80"
                        src="{{ asset('favicon.png') }}" alt="" width="110"></a>
                <button class="navbar-toggler navbar-toggler-end" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link link-scroll active" href="#hero">Home <span
                                    class="sr-only">(current)</span></a></li>
                        <li class="nav-item"><a class="nav-link link-scroll" href="#about">About</a></li>
                        <li class="nav-item"><a class="nav-link link-scroll" href="#services">Services</a></li>
                        <li class="nav-item"><a class="nav-link link-scroll" href="#testimonials">Testimonials</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!-- Hero Section-->
    <section class="hero bg-top py-5" id="hero"
        style="background: url({{ asset('landing-page/img/banner-4.png') }}) no-repeat; background-size: 100% 80%">
        <div class="container py-5">
            <div class="row py-5">
                <div class="col-lg-5 py-5">
                    <h1>Download G - learning app </h1>
                    <p class="my-4 text-muted">For children (5-12) to learn and explore geography.</p>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item mb-2 mb-lg-0"><a href="{{ $Common::LINK_APK }}" download
                                style="width:250px" class="btn btn-success btn-lg px-5" href="#!">
                                <i class="fab fa-google-play me-3"></i>Install
                                now</a></li>
                        <li class="list-inline-item"><a style="width:250px" class="btn btn-success btn-lg px-4"
                                href="#!"><i class="fab fa-app-store me-3"></i>Comming soon!</a></li>
                    </ul>
                </div>
                <div class="col-lg-6 ml-auto">
                    <div class="device-wrapper mx-auto">
                        <div class="screen" style="display:flex">
                            <img class="img-fluid" src="{{ asset('img/app-image.png') }}"alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-center py-0" id="about"
        style="background: url(img/service-bg.svg) no-repeat; background-size: cover">
        <section class="about py-0">
            <div class="container">
                <p class="h6 text-uppercase text-primary">What is it all about?</p>
                <h2 class="mb-5">Learn geography easier by watch videos</h2>
                <div class="row pb-5 gy-4">
                    <div class="col-lg-4 col-md-6">
                        <!-- Services Item-->
                        <div class="card border-0 shadow rounded-lg py-4 text-start">
                            <div class="card-body p-5">
                                <svg class="svg-icon svg-icon-light" style="width:60px;height:60px;color:#ff904e">
                                    <use xlink:href="#document-saved-1"> </use>
                                </svg>
                                <h3 class="h4 my-4">Watch video</h3>
                                <p class="text-sm text-muted mb-0">For children (5-12) to learn and explore geography.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <!-- Services Item-->
                        <div class="card border-0 shadow rounded-lg py-4 text-start">
                            <div class="card-body p-5">
                                <svg class="svg-icon svg-icon-light" style="width:60px;height:60px;color:#39f8d2">
                                    <use xlink:href="#map-marker-1"> </use>
                                </svg>
                                <h3 class="h4 my-4">195 countries </h3>
                                <p class="text-sm text-muted mb-0">This App will help diversify the Geography knowledge
                                    of countries around the world.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <!-- Services Item-->
                        <div class="card border-0 shadow rounded-lg py-4 text-start">
                            <div class="card-body p-5">
                                <svg class="svg-icon svg-icon-light" style="width:60px;height:60px;color:#8190ff">
                                    <use xlink:href="#arrow-target-1"> </use>
                                </svg>
                                <h3 class="h4 my-4">Free in 7 days</h3>
                                <p class="text-sm text-muted mb-0">For children (5-12) to learn and explore geography.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="with-pattern-1 py-5" id="services">
            <div class="container py-5">
                <div class="row align-items-center mb-5 gy-5">
                    <div class="col-lg-6"><img class="img-fluid w-100 px-lg-5"
                            src="{{ asset('landing-page/img/objects.svg') }}" alt="">
                    </div>
                    <div class="col-lg-6">
                        <h2>App help diversify the Geography knowledge of countries</h2>
                        <p class="text-muted">The App will provide relevant knowledge about socio-geography.</p>
                        <button class="btn btn-primary js-modal-btn" data-video-id={{ $Common::VIDEO_SURVEY }}><i
                                class="fas fa-play-circle me-2"></i>Play video</button>
                    </div>
                </div>
                <div class="row align-items-center gy-5">
                    <div class="col-lg-6">
                        <h2>Make your own success as simple you clap</h2>
                        <p class="text-muted"> Here there will be 7 dozen, 1 each continent will include the countries
                            involved.</p>
                        <ul class="list-check">
                            <li class="text-muted mb-2">Learn knowledge through videos</li>
                            <li class="text-muted mb-2">Page Load Details (time, size, number of requests)</li>
                            <li class="text-muted mb-2">Play games to review knowledge</li>
                        </ul>
                        <button class="btn btn-primary js-modal-btn" data-video-id="{{ $Common::VIDEO_SURVEY }}"><i
                                class="fas fa-play-circle me-2"></i>Play video</button>
                    </div>
                    <div class="col-lg-6">
                        <div class="row gy-4">
                            <div class="col-lg-6 col-sm-6">
                                <!-- Services Item-->
                                <div class="card border-0 shadow rounded-lg text-start px-2">
                                    <div class="card-body px py-5">
                                        <svg class="svg-icon" style="width:40px;height:40px;color:#ff904e">
                                            <use xlink:href="#document-saved-1"> </use>
                                        </svg>
                                        <h3 class="h5 my-3">Watch video</h3>
                                        <p class="text-sm mb-0 text-muted">For children (5-12) to learn and explore
                                            geography.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <!-- Services Item-->
                                <div class="card border-0 shadow rounded-lg text-start px-2">
                                    <div class="card-body px py-5">
                                        <svg class="svg-icon" style="width:40px;height:40px;color:#39f8d2">
                                            <use xlink:href="#map-marker-1"> </use>
                                        </svg>
                                        <h3 class="h5 my-3">Track your move </h3>
                                        <p class="text-sm mb-0 text-muted">For children (5-12) to learn and explore
                                            geography</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <!-- Services Item-->
                                <div class="card border-0 shadow rounded-lg text-start px-2">
                                    <div class="card-body px py-5">
                                        <svg class="svg-icon" style="width:40px;height:40px;color:#8190ff">
                                            <use xlink:href="#arrow-target-1"> </use>
                                        </svg>
                                        <h3 class="h5 my-3">Free in 7 days</h3>
                                        <p class="text-sm mb-0 text-muted">For children (5-12) to learn and explore
                                            geography.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <!-- Services Item-->
                                <div class="card border-0 shadow rounded-lg text-start px-2">
                                    <div class="card-body px py-5">
                                        <svg class="svg-icon" style="width:40px;height:40px;color:#ff634b">
                                            <use xlink:href="#sorting-1"> </use>
                                        </svg>
                                        <h3 class="h5 my-3">Full Settings</h3>
                                        <p class="text-sm mb-0 text-muted">For children (5-12) to learn and explore
                                            geography</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <section class="p-0" id="testimonials"
        style="background: url({{ asset('landing-page/img/testimonials-bg.png') }}) no-repeat; background-size: 40% 100%; background-position: left center">
        <div class="container text-center">
            <p class="h6 text-uppercase text-primary">Services</p>
            <h2 class="mb-5">What Is Our Services?</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="swiper testimonials-slider">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide h-auto">
                                <div class="mx-3 mx-lg-5 my-5 pt-3">
                                    <div
                                        class="card shadow rounded-lg px-4 py-5 px-lg-5 with-pattern bg-white border-0">
                                        <div class="card-body index-forward pt-5 rounded-lg">
                                            <div class="testimonial-img"><img class="rounded-circle"
                                                    src="{{ asset('favicon.png') }}" alt=""
                                                    width="100" /></div>
                                            <p class="lead text-muted mb-5">
                                                {{ isset($package) ? $package->description : '' }}</p>
                                            <h5 class="mb-0">{{ isset($package) ? $package->name : '' }}</h5>
                                            <p class="text-primary mb-0 text-sm">
                                                {{ isset($package) ? $package->price : '' }} vnĐ</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="swiper-slide h-auto">
                                <div class="mx-3 mx-lg-5 my-5 pt-3">
                                    <div
                                        class="card shadow rounded-lg px-4 py-5 px-lg-5 with-pattern bg-white border-0">
                                        <div class="card-body index-forward pt-5 rounded-lg">
                                            <div class="testimonial-img"><img class="rounded-circle"
                                                    src="{{ asset('landing-page/img/avatar-2.png') }}" alt=""
                                                    width="100" /></div>
                                            <p class="lead text-muted mb-5">Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                                magna aliqua. Ut enim ad minim veniam.</p>
                                            <h5 class="mb-0">Frank Smith</h5>
                                            <p class="text-primary mb-0 text-sm">Tech Developer</p>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="swiper-slide h-auto">
                                <div class="mx-3 mx-lg-5 my-5 pt-3">
                                    <div
                                        class="card shadow rounded-lg px-4 py-5 px-lg-5 with-pattern bg-white border-0">
                                        <div class="card-body index-forward pt-5 rounded-lg">
                                            <div class="testimonial-img"><img class="rounded-circle"
                                                    src="{{ asset('landing-page/img/avatar-2.png') }}" alt=""
                                                    width="100" /></div>
                                            <p class="lead text-muted mb-5">Lorem ipsum dolor sit amet, consectetur
                                                adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                                magna aliqua. Ut enim ad minim veniam.</p>
                                            <h5 class="mb-0">Frank Smith</h5>
                                            <p class="text-primary mb-0 text-sm">Tech Developer</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </div>
    </section><a class="scroll-top-btn" id="scrollTop" href="#!"><i class="fas fa-long-arrow-alt-up"></i></a>
    <footer class="with-pattern-1 position-relative pt-5">
        <div class="container py-5">
            <div class="row gy-4">
                <div class="col-lg-3"><img class="mb-4" src="{{ asset('favicon.png') }}" alt=""
                        width="110">
                    <p class="text-muted">For children (5-12) to learn and explore geography.</p>
                </div>
                <div class="col-lg-2">
                    <h2 class="h5 mb-4">Quick Links</h2>
                    <div class="d-flex">
                        <ul class="list-unstyled d-inline-block me-4 mb-0">
                            <li class="mb-2"><a class="footer-link" href="#!">History</a></li>
                            <li class="mb-2"><a class="footer-link" href="#!">About us</a></li>
                            <li class="mb-2"><a class="footer-link" href="#!">Contact us</a></li>
                            <li class="mb-2"><a class="footer-link" href="#!">Services</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <h2 class="h5 mb-4">Services</h2>
                    <div class="d-flex">
                        <ul class="list-unstyled me-4 mb-0">
                            <li class="mb-2"><a class="footer-link" href="#!">History</a></li>
                            <li class="mb-2"><a class="footer-link" href="#!">About us</a></li>
                            <li class="mb-2"><a class="footer-link" href="#!">Contact us</a></li>
                            <li class="mb-2"><a class="footer-link" href="#!">Services</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5">
                    <h2 class="h5 mb-4">Contact Info</h2>
                    <ul class="list-unstyled me-4 mb-3">
                        <li class="mb-2 text-muted">99 To Hien Thanh - Son Tra - Da Nang. </li>
                        <li class="mb-2"><a class="footer-link" href="tel:0917459572">0917459572</a></li>
                        <li class="mb-2"><a class="footer-link"
                                href="mailto:010102tranvanhieu@gmail.com">010102tranvanhieu@gmail.com</a>
                        </li>
                    </ul>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a class="social-link" href="#!"><i
                                    class="fab fa-facebook-f"></i></a></li>
                        <li class="list-inline-item"><a class="social-link" href="#!"><i
                                    class="fab fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a class="social-link" href="#!"><i
                                    class="fab fa-linkedin-in"></i></a></li>
                        <li class="list-inline-item"><a class="social-link" href="#!"><i
                                    class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="copyrights">
            <div class="container text-center py-4">
                <p class="mb-0 text-muted text-sm">&copy; 2023, PNV student <a
                        href="https://www.passerellesnumeriques.org/vi/cac-trung-tam/vietnam/"
                        class="text-reset">Bootstrapious</a>.</p>
                <!-- If you want to remove the backlink, please purchase the Attribution-Free License. See details in readme.txt or license.txt. Thanks!-->
            </div>
        </div>
    </footer>
    <!-- JavaScript files-->
    <script src="{{ asset('landing-page/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('landing-page/vendor/modal-video/js/modal-video.js') }}"></script>
    <script src="{{ asset('landing-page/js/front.js') }}"></script>
    <script>
        // ------------------------------------------------------- //
        //   Inject SVG Sprite - 
        //   see more here 
        //   https://css-tricks.com/ajaxing-svg-sprite/
        // ------------------------------------------------------ //
        function injectSvgSprite(path) {

            var ajax = new XMLHttpRequest();
            ajax.open("GET", path, true);
            ajax.send();
            ajax.onload = function(e) {
                var div = document.createElement("div");
                div.className = 'd-none';
                div.innerHTML = ajax.responseText;
                document.body.insertBefore(div, document.body.childNodes[0]);
            }
        }
        // this is set to BootstrapTemple website as you cannot 
        // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
        // while using file:// protocol
        // pls don't forget to change to your domain :)
        injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
    </script>
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
</body>

</html>
