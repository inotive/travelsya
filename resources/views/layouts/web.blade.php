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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- begin:: Style swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
{{--    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.3/dist/cdn.min.js"></script>--}}
    <!-- end:: Style swiper -->

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

        .menu-user a:hover {
            color: #C02425 !important;
        }

        .menu-user a.active {
            color: #C02425 !important;
        }

        /* .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
        } */
    </style>
    @stack('add-style')
    @vite(['resources/js/app.js'])
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




                @yield('content-web')



                <!--begin::Footer-->
                <div class="footer py-4 d-flex flex-lg-column text-white " style="background-color:#C02425;" id="kt_footer">
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
                                        <a href="/partner-hotel" class="text-white"><p>Partner</p></a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-Tn2m0TIpgVyTzzvmxLNuqbSJH3JP8jm+Cy3hvHrW7ndTDcJ1w5mBiksqDBb8GpE2ksktFvDB/ykZ0mDpsZj20w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
    @include('sweetalert::alert')

    @stack('add-script')

    <script>
        $('.js-daterangepicker').daterangepicker();

        // const slider = document.querySelector('.items');
        // let isDown = false;
        // let startX;
        // let scrollLeft;

        // slider.addEventListener('mousedown', (e) => {
        //     isDown = true;
        //     slider.classList.add('active');
        //     startX = e.pageX - slider.offsetLeft;
        //     scrollLeft = slider.scrollLeft;
        // });
        // slider.addEventListener('mouseleave', () => {
        //     isDown = false;
        //     slider.classList.remove('active');
        // });
        // slider.addEventListener('mouseup', () => {
        //     isDown = false;
        //     slider.classList.remove('active');
        // });
        // slider.addEventListener('mousemove', (e) => {
        //     if (!isDown) return;
        //     e.preventDefault();
        //     const x = e.pageX - slider.offsetLeft;
        //     const walk = (x - startX) * 3;
        //     slider.scrollLeft = scrollLeft - walk;
        // });

        $(".main-menu li").on('click', function() {
            $('.form-menu').removeClass('show active')
        })
    </script>
</body>
<!--end::Body-->

<!-- Mirrored from preview.keenthemes.com/metronic8/demo2/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Mar 2023 06:14:47 GMT -->

</html>
