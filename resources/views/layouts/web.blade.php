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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
        .main {

            grid-area: main;
            padding: 0;
            overflow-x: scroll;
            overflow-y: hidden;
        }



        .items {
            width: 100%;
            overflow-x: scroll;
            overflow-y: hidden;
            white-space: nowrap;
            transition: all 0.2s;
            transform: scale(0.98);
            will-change: transform;
            user-select: none;
            cursor: pointer;
        }

        .items.active {
            background: rgba(255, 255, 255, 0.3);
            cursor: grabbing;
            cursor: -webkit-grabbing;
            transform: scale(1);
        }
    </style>
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
                    <div id="kt_content_container" class=" container-xxl ">

                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="d-block w-100" src="https://fastly.picsum.photos/id/861/1200/400.jpg?hmac=oEEp9Zqn58JvH4Jr3KtUz1MIhsZl__Xh-W8RZIqv4a4" alt="First slide">
                                </div>
                                <div class="carousel-item">
                                    <img class="d-block w-100" src="https://fastly.picsum.photos/id/786/1200/400.jpg?hmac=ev4yUlckhUn0mZu3CHH6cS7-LtNb-EyDuABsTHBZkGY" alt="Second slide">
                                </div>

                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Toolbar-->
                <div id="kt_content_container" class="container-xxl mb-30">

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

                                <!--begin::Table widget 2-->
                                <div class="card mb-10">
                                    <!--begin::Body-->
                                    <div class="card-body pt-2">
                                        <div class="row">
                                            <div class="col-md-7">
                                                <div class="col-md-12">
                                                    <ul class="nav nav-pills nav-pills-custom mb-3 main-menu">
                                                        <!--begin::Item-->
                                                        <li class="nav-item mb-3 me-3 me-lg-6 ">
                                                            <!--begin::Link-->
                                                            <a class="nav-link d-flex justify-content-between flex-column active flex-center overflow-hidden" data-bs-toggle="pill" href="#semua">
                                                                <!--begin::Icon-->
                                                                <div class="nav-icon">
                                                                </div>
                                                                <!--end::Icon-->

                                                                <!--begin::Subtitle-->
                                                                <span class=" nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                    Semua
                                                                </span>
                                                                <!--end::Subtitle-->

                                                                <!--begin::Bullet-->
                                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                                <!--end::Bullet-->
                                                            </a>
                                                            <!--end::Link-->
                                                        </li>
                                                        <!--begin::Item-->
                                                        <li class="nav-item mb-3 me-3 me-lg-6 li-main-menu">
                                                            <!--begin::Link-->
                                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden" data-bs-toggle="pill" href="#penginapan">
                                                                <!--begin::Icon-->
                                                                <div class="nav-icon">
                                                                </div>
                                                                <!--end::Icon-->

                                                                <!--begin::Subtitle-->
                                                                <span class=" nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                    Penginapan
                                                                </span>
                                                                <!--end::Subtitle-->

                                                                <!--begin::Bullet-->
                                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                                <!--end::Bullet-->
                                                            </a>
                                                            <!--end::Link-->
                                                        </li>
                                                        <li class="nav-item mb-3 me-3 me-lg-6 li-main-menu">
                                                            <!--begin::Link-->
                                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden" data-bs-toggle="pill" href="#transportasi">
                                                                <!--begin::Icon-->
                                                                <div class="nav-icon">
                                                                </div>
                                                                <!--end::Icon-->

                                                                <!--begin::Subtitle-->
                                                                <span class=" nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                    Transportasi
                                                                </span>
                                                                <!--end::Subtitle-->

                                                                <!--begin::Bullet-->
                                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                                <!--end::Bullet-->
                                                            </a>
                                                            <!--end::Link-->
                                                        </li>
                                                        <li class="nav-item mb-3 me-3 me-lg-6 li-main-menu">
                                                            <!--begin::Link-->
                                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden" data-bs-toggle="pill" href="#topuptagihan">
                                                                <!--begin::Icon-->
                                                                <div class="nav-icon">
                                                                </div>
                                                                <!--end::Icon-->

                                                                <!--begin::Subtitle-->
                                                                <span class=" nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                    Topup & Tagihan
                                                                </span>
                                                                <!--end::Subtitle-->

                                                                <!--begin::Bullet-->
                                                                <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                                <!--end::Bullet-->
                                                            </a>
                                                            <!--end::Link-->
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-12 ">
                                                    <div class="tab-content main">
                                                        <div class="tab-pane fade show active" id="semua">

                                                            <div class="nav nav-pills nav-pills-custom mb-3 items">
                                                                <div class="d-flex flex-nowrap">
                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link d-flex justify-content-between flex-column active flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#hotel">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pesawat">
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
                                                                    </div>
                                                                    <!--end::Item-->
                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#kai">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#bustravel">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#rekreasi">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#mobil">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#hostel">

                                                                            <!--begin::Icon-->
                                                                            <div class=" nav-icon">
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
                                                                    </div>
                                                                    <!--end::Item-->
                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6 ">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pln">
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
                                                                    </div>
                                                                    <!--end::Item-->
                                                                </div>
                                                                <div class="d-flex flex-nowrap">
                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link @if(last(request()->segments()) == 'bpjs') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#bpjs">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link @if(last(request()->segments()) == 'pdam') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pdam">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#transferbank">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#ewallet">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link @if(last(request()->segments()) == 'pulsa') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pulsa">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link @if(last(request()->segments()) == 'data') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#data">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link @if(last(request()->segments()) == 'tv-internet') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#tvinernet">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pajak">
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
                                                                    </div>
                                                                    <!--end::Item-->
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="tab-pane fade" id="penginapan">
                                                            <ul class="nav nav-pills nav-pills-custom mb-3">
                                                                <!--begin::Item-->
                                                                <div class="nav-item mb-3 me-3 me-lg-6">
                                                                    <!--begin::Link-->
                                                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#hotel">
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
                                                                </div>
                                                                <!--end::Item-->
                                                                <!--begin::Item-->
                                                                <div class="nav-item mb-3 me-3 me-lg-6">
                                                                    <!--begin::Link-->
                                                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#hostel">

                                                                        <!--begin::Icon-->
                                                                        <div class=" nav-icon">
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
                                                                </div>
                                                                <!--end::Item-->

                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane fade" id="transportasi">
                                                            <ul class="nav nav-pills nav-pills-custom mb-3">
                                                                <!--begin::Item-->
                                                                <div class="nav-item mb-3 me-3 me-lg-6">
                                                                    <!--begin::Link-->
                                                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pesawat">
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
                                                                </div>
                                                                <!--end::Item-->
                                                                <!--begin::Item-->
                                                                <div class="nav-item mb-3 me-3 me-lg-6">
                                                                    <!--begin::Link-->
                                                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#kai">
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
                                                                </div>
                                                                <!--end::Item-->
                                                                <!--begin::Item-->
                                                                <div class="nav-item mb-3 me-3 me-lg-6">
                                                                    <!--begin::Link-->
                                                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#bustravel">
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
                                                                </div>
                                                                <!--end::Item-->
                                                                <!--begin::Item-->
                                                                <div class="nav-item mb-3 me-3 me-lg-6">
                                                                    <!--begin::Link-->
                                                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#mobil">
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
                                                                </div>
                                                                <!--end::Item-->
                                                            </ul>
                                                        </div>
                                                        <div class="tab-pane fade" id="topuptagihan">
                                                            <div class="nav nav-pills nav-pills-custom mb-3 items">

                                                                <div class="d-flex flex-nowrap">

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6 ">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pln">
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
                                                                    </div>
                                                                    <!--end::Item-->
                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link @if(last(request()->segments()) == 'bpjs') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#bpjs">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link @if(last(request()->segments()) == 'pdam') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pdam">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#transferbank">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#ewallet">
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
                                                                    </div>
                                                                    <!--end::Item-->
                                                                </div>
                                                                <div class="d-flex flex-nowrap">
                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link @if(last(request()->segments()) == 'pulsa') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pulsa">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link @if(last(request()->segments()) == 'data') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#data">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link @if(last(request()->segments()) == 'tv-internet') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#tvinernet">
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
                                                                    </div>
                                                                    <!--end::Item-->

                                                                    <!--begin::Item-->
                                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                                        <!--begin::Link-->
                                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pajak">
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
                                                                    </div>
                                                                    <!--end::Item-->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <!--begin::Tab Content-->
                                                <div class="tab-content">
                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade show active form-menu" id="hotel">
                                                        <div class="">
                                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">Cari dan book hotel untuk hari spesialmu!</h2>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <!--begin::Input-->
                                                                    <select name="lokasi" id="lokasi" class="form-control">
                                                                        <option value="Jakarta">Jakarta</option>
                                                                        <option value="Jakarta">Bandung</option>
                                                                    </select>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <div class="col-md-6 mb-5">
                                                                    <!--begin::Input-->
                                                                    <input type="text" class="form-control js-daterangepicker">
                                                                    <!--end::Input-->
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <!--begin::Input-->
                                                                    <select name="lokasi" id="kamar" class="form-control">
                                                                        @for($i=1;$i<5;$i++) <option value="1">{{$i}} Kamar</option>
                                                                            @endfor
                                                                    </select>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <!--begin::Input-->
                                                                    <select name="lokasi" id="tamu" class="form-control">
                                                                        @for($i=1;$i<5;$i++) <option value="1">{{$i}} Tamu</option>
                                                                            @endfor
                                                                    </select>
                                                                    <!--end::Input-->
                                                                </div>
                                                            </div>
                                                            <div class="text-end">
                                                                <button class="btn btn-danger py-4 mt-10">Cari Hotel</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!--end::Tap pane-->
                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade form-menu" id="pesawat">
                                                        <!--begin::Table container-->
                                                        Pesawat
                                                        <!--end::Table container-->
                                                    </div>
                                                    <!--end::Tap pane-->

                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade form-menu " id="kai">
                                                        <!--begin::Table container-->
                                                        <div class="table-responsive">
                                                            KAI
                                                        </div>
                                                        <!--end::Table container-->
                                                    </div>
                                                    <!--end::Tap pane-->

                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade form-menu " id="bustravel">
                                                        <!--begin::Table container-->
                                                        Bus & Travel
                                                        <!--end::Table container-->
                                                    </div>
                                                    <!--end::Tap pane-->

                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade form-menu " id="rekreasi">
                                                        <!--begin::Table container-->
                                                        Rekreasi
                                                        <!--end::Table container-->
                                                    </div>
                                                    <!--end::Tap pane-->

                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade form-menu " id="mobil">
                                                        <!--begin::Table container-->
                                                        Rental Mobil
                                                        <!--end::Table container-->
                                                    </div>
                                                    <!--end::Tap pane-->
                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade form-menu " id="hostel">
                                                        <!--begin::Table container-->
                                                        <div class="">
                                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">Cari dan book hotel untuk hari spesialmu!</h2>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <!--begin::Input-->
                                                                    <select name="lokasi" id="lokasi" class="form-control">
                                                                        <option value="Jakarta">Jakarta</option>
                                                                        <option value="Jakarta">Bandung</option>
                                                                    </select>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <div class="col-md-6 mb-5">
                                                                    <!--begin::Input-->
                                                                    <input type="text" class="form-control js-daterangepicker">
                                                                    <!--end::Input-->
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <!--begin::Input-->
                                                                    <select name="lokasi" id="kamar" class="form-control">
                                                                        @for($i=1;$i<5;$i++) <option value="1">{{$i}} Kamar</option>
                                                                            @endfor
                                                                    </select>
                                                                    <!--end::Input-->
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <!--begin::Input-->
                                                                    <select name="lokasi" id="tamu" class="form-control">
                                                                        @for($i=1;$i<5;$i++) <option value="1">{{$i}} Tamu</option>
                                                                            @endfor
                                                                    </select>
                                                                    <!--end::Input-->
                                                                </div>
                                                            </div>
                                                            <div class="text-end">
                                                                <button class="btn btn-danger py-4 mt-10">Cari Hotel</button>
                                                            </div>

                                                        </div>
                                                        <!--end::Table container-->
                                                    </div>
                                                    <!--end::Tap pane-->
                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade form-menu " id="pln">
                                                        <!--begin::Table container-->
                                                        <div class="">
                                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">PLN Prabayar dan Pascabayar</h2>
                                                            <label class="fs-5 fw-semibold mb-2">
                                                                <span class="required">No Meter PLN</span>
                                                            </label>

                                                            <!--begin::Input-->
                                                            <input type="text" id="notelp" class="form-control mb-10" name="notelp" placeholder="" value="" />
                                                            <!--end::Input-->
                                                            <div class="text-end">
                                                                <button class="btn btn-danger py-4 ">Checkout</button>
                                                            </div>

                                                        </div>
                                                        <!--end::Table container-->
                                                    </div>
                                                    <!--end::Tap pane-->
                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade form-menu " id="bpjs">
                                                        <!--begin::Table container-->
                                                        <div class="">
                                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">Nikmati fitur BPJS</h2>
                                                            <label class="fs-5 fw-semibold mb-2">
                                                                <span class="required">No BPJS</span>
                                                            </label>

                                                            <!--begin::Input-->
                                                            <input type="text" id="notelp" class="form-control mb-10" name="notelp" placeholder="" value="" />
                                                            <!--end::Input-->
                                                            <div class="text-end">
                                                                <button class="btn btn-danger py-4 ">Checkout</button>
                                                            </div>

                                                        </div>
                                                        <!--end::Table container-->
                                                    </div>
                                                    <!--end::Tap pane-->
                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade form-menu " id="pdam">
                                                        <!--begin::Table container-->
                                                        <div class="">
                                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">PDAM</h2>
                                                            <label class="fs-5 fw-semibold mb-2">
                                                                <span class="required">No Langganan</span>
                                                            </label>

                                                            <!--begin::Input-->
                                                            <input type="text" id="notelp" class="form-control mb-10" name="notelp" placeholder="" value="" />
                                                            <!--end::Input-->
                                                            <div class="text-end">
                                                                <button class="btn btn-danger py-4 ">Checkout</button>
                                                            </div>

                                                        </div>
                                                        <!--end::Table container-->
                                                    </div>
                                                    <!--end::Tap pane-->
                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade form-menu " id="transferbank">
                                                        <!--begin::Table container-->
                                                        Transfer bank
                                                        <!--end::Table container-->
                                                    </div>
                                                    <!--end::Tap pane-->
                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade form-menu " id="ewallet">
                                                        <!--begin::Table container-->
                                                        e-wallet
                                                        <!--end::Table container-->
                                                    </div>
                                                    <!--end::Tap pane-->
                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade form-menu " id="pulsa">
                                                        <div class="">
                                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">Pulsa dengan harga terbaik</h2>
                                                            <label class="fs-5 fw-semibold mb-2">
                                                                <span class="required">No Ponsel</span>
                                                            </label>

                                                            <!--begin::Input-->
                                                            <input type="text" id="notelp" class="form-control mb-10" name="notelp" placeholder="" value="" />
                                                            <!--end::Input-->
                                                            <div class="text-end">
                                                                <button class="btn btn-danger py-4 ">Checkout</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!--end::Tap pane-->
                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade form-menu " id="data">
                                                        <!--begin::Table container-->
                                                        <div class="">
                                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">Paket Internet dengan harga terbaik</h2>
                                                            <label class="fs-5 fw-semibold mb-2">
                                                                <span class="required">No Ponsel</span>
                                                            </label>

                                                            <!--begin::Input-->
                                                            <input type="text" id="notelp" class="form-control mb-10" name="notelp" placeholder="" value="" />
                                                            <!--end::Input-->
                                                            <div class="text-end">
                                                                <button class="btn btn-danger py-4 ">Checkout</button>
                                                            </div>

                                                        </div>
                                                        <!--end::Table container-->
                                                    </div>
                                                    <!--end::Tap pane-->
                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade form-menu " id="tvinernet">
                                                        <!--begin::Table container-->
                                                        <div class="">
                                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">Bayar tagihan jadi lebih mudah</h2>
                                                            <label class="fs-5 fw-semibold mb-2">
                                                                <span class="required">No Tagihan</span>
                                                            </label>

                                                            <!--begin::Input-->
                                                            <input type="text" id="notelp" class="form-control mb-10" name="notelp" placeholder="" value="" />
                                                            <!--end::Input-->
                                                            <div class="text-end">
                                                                <button class="btn btn-danger py-4 ">Checkout</button>
                                                            </div>

                                                        </div>
                                                        <!--end::Table container-->
                                                    </div>
                                                    <!--end::Tap pane-->
                                                    <!--begin::Tap pane-->
                                                    <div class="tab-pane fade form-menu " id="pajak">
                                                        <div class="">
                                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">Orang bijak bayar pajak</h2>
                                                            <label class="fs-5 fw-semibold mb-2">
                                                                <span class="required">No NPWP/KTP</span>
                                                            </label>

                                                            <!--begin::Input-->
                                                            <input type="text" id="notelp" class="form-control mb-10" name="notelp" placeholder="" value="" />
                                                            <!--end::Input-->
                                                            <div class="text-end">
                                                                <button class="btn btn-danger py-4 ">Checkout</button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <!--end::Tap pane-->
                                                </div>
                                                <!--end::Tab Content-->
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Card Body-->
                                </div>
                                <!--end::Table widget 2-->

                            </div>
                            <!--end::Table widget 2-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                    <div class="row">
                        <h2 class="fw-bold mb-3 mt-4">Yang Paling Populer</h2>
                        <div class="col-md-6">
                            <p class="fs-4 text-gray-700 mb-10">Hotel yang paling sering dikunjungi saat liburan</p>
                        </div>
                        <div class="col-md-6 text-end">
                            <a href="#" class="text-danger fs-4 fw-bold">Lihat Semua</a>
                        </div>

                    </div>


                    <div class="row justify-content-between">
                        <div class="col-md-3">
                            <div class="card">
                                <img class="card-img-top" src="../assets/media/stock/food/img-2.jpg" alt="Card image cap">
                                <div class="card-body p-5">
                                    <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">Golden Boutique Hotel Melawai Blok M</span>
                                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-1">Tanah Abang, Jakarta</span>
                                    <span class="text-gray-400 fw-semibold d-block mt-5">Mulai dari <s>750,000</s></span>
                                    <span class="text-danger text-end fw-bold fs-1 mt-2">IDR 570,000</span>
                                    <span class="text-gray-600 cursor-pointer d-block  mt-5 text-align-center">
                                        <span class="fa fa-star fs-4" style="color: red;"></span> 4,3 <span class="text-gray-400">(436)</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img class="card-img-top" src="../assets/media/stock/food/img-2.jpg" alt="Card image cap">
                                <div class="card-body p-5">
                                    <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">Golden Boutique Hotel Melawai Blok M</span>
                                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-1">Tanah Abang, Jakarta</span>
                                    <span class="text-gray-400 fw-semibold d-block mt-5">Mulai dari <s>750,000</s></span>
                                    <span class="text-danger text-end fw-bold fs-1 mt-2">IDR 570,000</span>
                                    <span class="text-gray-600 cursor-pointer d-block  mt-5 text-align-center">
                                        <span class="fa fa-star fs-4" style="color: red;"></span> 4,3 <span class="text-gray-400">(436)</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img class="card-img-top" src="../assets/media/stock/food/img-2.jpg" alt="Card image cap">
                                <div class="card-body p-5">
                                    <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">Golden Boutique Hotel Melawai Blok M</span>
                                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-1">Tanah Abang, Jakarta</span>
                                    <span class="text-gray-400 fw-semibold d-block mt-5">Mulai dari <s>750,000</s></span>
                                    <span class="text-danger text-end fw-bold fs-1 mt-2">IDR 570,000</span>
                                    <span class="text-gray-600 cursor-pointer d-block  mt-5 text-align-center">
                                        <span class="fa fa-star fs-4" style="color: red;"></span> 4,3 <span class="text-gray-400">(436)</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <img class="card-img-top" src="../assets/media/stock/food/img-2.jpg" alt="Card image cap">
                                <div class="card-body p-5">
                                    <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">Golden Boutique Hotel Melawai Blok M</span>
                                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-1">Tanah Abang, Jakarta</span>
                                    <span class="text-gray-400 fw-semibold d-block mt-5">Mulai dari <s>750,000</s></span>
                                    <span class="text-danger text-end fw-bold fs-1 mt-2">IDR 570,000</span>
                                    <span class="text-gray-600 cursor-pointer d-block  mt-5 text-align-center">
                                        <span class="fa fa-star fs-4" style="color: red;"></span> 4,3 <span class="text-gray-400">(436)</span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- @yield('content-web') -->
                </div>
                <!--end::Row-->
                <div class="bg-white mt-20">
                    <div class="container-xxl py-10">
                        <div class="row">
                            <h2 class="fw-bold mb-3 mt-4">Jelajahi Sudut Kota</h2>
                            <p class="fs-4 text-gray-700 mb-10">Ada berbagai pilihan destinasi liburan dengan harga spesial lho, jangan sampai kelewatan</p>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100">
                            </div>
                            <div class="col-md-2">
                                <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100">
                            </div>
                            <div class="col-md-2">
                                <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100">
                            </div>
                            <div class="col-md-2">
                                <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100">
                            </div>
                            <div class="col-md-2">
                                <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100">
                            </div>
                            <div class="col-md-2">
                                <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100">
                            </div>
                        </div>
                    </div>

                </div>



                <!--begin::Footer-->
                <div class="footer py-4 d-flex flex-lg-column text-white" style="background-color:#C02425" id="kt_footer">
                    <!--begin::Container-->
                    <div class=" container-xxl ">
                        <div class="row py-10">
                            <div class="col-md-3">
                                Logo travelsya
                                <p>Kalimantan Timur, Balikpapan</p>
                                <p>Indonesia</p>
                                <p>cs@travelsya.com</p>
                                <p>+62 811 223 3445</p>

                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col md-4">
                                        <p class="fw-bold fs-5">Layanan</p>
                                        <p>Booking Hotel</p>
                                        <p>Tiket Pesawat</p>
                                        <p>Tiket Kereta Api</p>
                                        <p>Tiket Bus & Travel</p>
                                        <p>Tiket Rekreasi</p>
                                        <p>Rental Mobil</p>
                                        <p>Booking Hostel</p>
                                        <p>Bayar PLN</p>
                                    </div>
                                    <div class="col md-4">
                                        <p class="fw-bold fs-5">&nbsp;</p>
                                        <p>Bayar BPJS</p>
                                        <p>Bayar PDAM</p>
                                        <p>Transfer Bank</p>
                                        <p>Top up Ewallet</p>
                                        <p>Pulsa & Data</p>
                                        <p>TV Berbayar</p>
                                        <p>Bayar Pajak</p>
                                    </div>
                                    <div class="col md-4">
                                        <p class="fw-bold fs-5">Dukungan</p>
                                        <p>Tentang Kami</p>
                                        <p>Layanan Pelanggan</p>
                                        <p>Kebijakan Privasi</p>
                                        <p>Syarat & Ketentuan</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <p class="fw-bold fs-5">Download Aplikasi</p>
                                <img alt="" src="{{asset('assets/media/products-categories/download-apps.png')}}" class="w-200px" />

                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <!--begin::Copyright-->

                            <div class="text-start order-2 order-md-1">
                                <span class="fw-semibold me-1 ">Copyright @ 2023&copy; right reserved</span>
                                <!-- <a href="https://keenthemes.com/" target="_blank"
                                        class="text-gray-800 text-hover-primary">Keenthemes</a> -->
                            </div>
                            <!--end::Copyright-->
                        </div>
                    </div>

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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->

    @stack('add-script')

    <script>
        $('.js-daterangepicker').daterangepicker();

        const slider = document.querySelector('.items');
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mousemove', (e) => {
            if (!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 3; //scroll-fast
            slider.scrollLeft = scrollLeft - walk;
            console.log(walk);
        });

        $(".main-menu li").on('click', function() {
            console.log('oke');
            $('.form-menu').removeClass('show active')
        })
    </script>
</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/metronic8/demo2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Mar 2023 06:14:47 GMT -->

</html>