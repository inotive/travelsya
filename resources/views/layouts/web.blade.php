<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <title>Traveslya -</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="K" />
    <link rel="canonical" href="" />
    <link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" /> <!--end::Fonts-->

    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->


    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    @stack('add-style')

</head>
<!--end::Head-->

<!--begin::Body-->

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;

        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }

            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }

            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->

    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header  align-items-stretch mb-5 mb-lg-10" data-kt-sticky="true" data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                    @include('layouts.include.header')
                </div>
                <!--end::Header-->




                <!--begin::Toolbar-->
                <div class="toolbar py-5 pb-lg-15" id="kt_toolbar">
                    <!--begin::Container-->
                    <div id="kt_toolbar_container" class=" container-xxl  d-flex flex-stack flex-wrap">


                        <!--begin::Page title-->
                        <div class="page-title d-flex flex-column me-3">
                            <!--begin::Title-->
                            <h1 class="d-flex text-white fw-bold my-1 fs-3">
                                Home
                            </h1>
                            <!--end::Title-->

                        </div>
                        <!--end::Page title-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Toolbar-->
                <div id="kt_content_container" class="container-xxl ">
                    <!--begin::Row-->
                    <div class="row gx-5 gx-xl-8 mb-5 mb-xl-8">
                        <!--begin::Col-->
                        <div class="col-xl-12">

                            <!--begin::Tiles Widget 2-->
                            <div class="card h-200px bgi-no-repeat bgi-size-contain card-xl-stretch mb-5 mb-xl-8" style='background-position: right; background-image:url("{{asset('assets/media/svg/misc/taieri.svg")')}}'>

                                <!--begin::Body-->
                                <div class="card-body d-flex flex-column justify-content-between">
                                    <!--begin::Title-->
                                    <h2 class="fw-bold mb-5">Travelsya</h2>
                                    <!--end::Title-->
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Tiles Widget 2-->

                        </div>
                        <!--end::Col-->
                    </div>

                    <!--begin::Row-->
                    <div class="row gy-5 g-xl-10">
                        <!--begin::Col-->
                        <div class="col-xl-12 mb-xl-12">

                            <!--begin::Table widget 2-->
                            <div class="card h-md-100">
                                <!--begin::Header-->
                                <div class="card-header align-items-center border-0">
                                </div>
                                <!--end::Header-->

                                <!--begin::Body-->
                                <div class="card-body pt-2">
                                    <!--begin::Nav-->
                                    <ul class="nav nav-pills nav-pills-custom mb-3 text-center justify-content-center">
                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_1">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-hotel.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class=" nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    Hotel
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_1">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-plan.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    Pesawat
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_1">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-kai.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    Kereta Api
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_1">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-bus.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    Bus & Travel
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_1">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-rekreasi.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    Rekreasi
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_1">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-mobil.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    Rental Mobil
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_1">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-hostel.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    Hostel
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link @if(last(request()->segments()) == 'pln') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" href="{{route('product.pln')}}">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-pln.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    PLN
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link @if(last(request()->segments()) == 'bpjs') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" href="{{route('product.bpjs')}}">
                                                <!--begin::Icon-->
                                                <div class=" nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-bpjs.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    BPJS
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link @if(last(request()->segments()) == 'pdam') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" href="{{route('product.pdam')}}">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-pdam.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    PDAM
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_1">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-transfer.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    Transfer Bank
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_1">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-wallet.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    E-Wallet
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link @if(last(request()->segments()) == 'pulsa') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" href="{{route('product.pulsa')}}">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-pulsa.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    Pulsa
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link @if(last(request()->segments()) == 'data') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" href="{{route('product.data')}}">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-pulsa.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    Data
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link @if(last(request()->segments()) == 'tv-internet') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" href="{{route('product.tvInternet')}}">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-tv.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    TV - Internet
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->

                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6">
                                            <!--begin::Link-->
                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-5" data-bs-toggle="pill" href="#kt_stats_widget_2_tab_1">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-pajak.png')}}" class="w-50px" />
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    Pajak
                                                </span>
                                                <!--end::Subtitle-->

                                                <!--begin::Bullet-->
                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                <!--end::Bullet-->
                                            </a>
                                            <!--end::Link-->
                                        </li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Nav-->
                                </div>
                                <!--end: Card Body-->
                            </div>
                            <!--end::Table widget 2-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    @yield('content-web')
                </div>
                <!--end::Row-->




                <!--begin::Footer-->
                <div class="footer py-4 d-flex flex-lg-column " id="kt_footer">
                    <!--begin::Container-->
                    <div class=" container-xxl  d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">2023&copy;</span>
                            <!-- <a href="https://keenthemes.com/" target="_blank"
                                class="text-gray-800 text-hover-primary">Keenthemes</a> -->
                        </div>
                        <!--end::Copyright-->

                        <!--begin::Menu-->
                        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                            <li class="menu-item"><a href="https://keenthemes.com/" target="_blank" class="menu-link px-2">About</a></li>

                            <li class="menu-item"><a href="https://devs.keenthemes.com/" target="_blank" class="menu-link px-2">Support</a></li>

                            <li class="menu-item"><a href="https://1.envato.market/EA4JP" target="_blank" class="menu-link px-2">Purchase</a></li>
                        </ul>
                        <!--end::Menu-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up"><span class="path1"></span><span class="path2"></span></i>
    </div>
    <!--end::Scrolltop-->

    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/index.html";
    </script>

    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
    <!--end::Global Javascript Bundle-->

    <!--begin::Vendors Javascript(used for this page only)-->
    <script src="assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/map.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <!--end::Vendors Javascript-->

    <!--begin::Custom Javascript(used for this page only)-->
    <script src="{{asset('assets/js/widgets.bundle.js')}}"></script>
    <script src="{{asset('assets/js/custom/widgets.js')}}"></script>
    <script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
    <script src="{{asset('assets/js/custom/utilities/modals/create-campaign.js')}}"></script>
    <script src="{{asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->

    @stack('add-script')

</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/metronic8/demo2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Mar 2023 06:14:47 GMT -->

</html>