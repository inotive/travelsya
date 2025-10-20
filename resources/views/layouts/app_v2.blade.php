<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->

<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    @include('layouts.partials.head')
    <style>
        .nav-line-tabs .nav-item .nav-link.active,
        .nav-line-tabs .nav-item.show .nav-link,
        .nav-line-tabs .nav-item .nav-link:hover:not(.disabled) {
            color: #f2416c !important;
            background: #fbcfda !important;
            padding: calc(0.55rem + 1px) calc(1.25rem + 1px) !important;
            border-radius: 50rem !important;
            border-bottom: none !important;
            font-weight: var(--bs-btn-font-weight) !important;
        }

        .nav-line-tabs .nav-item .nav-link {
            padding: calc(0.55rem + 1px) calc(1.25rem + 1px) !important;
            color: #000 !important;
        }

        .nav-line-tabs .nav-item a {
            margin: 0 !important;
            font-weight: var(--bs-btn-font-weight) !important;
        }

        .row-cols-lg-4 .tab-content {
            flex: unset !important;
            width: 100% !important;
        }
        
        .header-image {
            border-radius: 0px;
            background: linear-gradient(to right, rgba(44, 4, 4, 0.73), rgba(245, 246, 252, 0.52)),
                url("https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2532&q=80") no-repeat center center;
            background-size: cover;
            border-bottom-left-radius: 4em;
            border-bottom-right-radius: 4em;
        }
    </style>
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
                <div id="kt_header" class="header  align-items-stretch mb-0" data-kt-sticky="true"
                    data-kt-sticky-name="header" data-kt-sticky-offset="{default: '200px', lg: '300px'}">
                    @include('layouts.partials.header')
                </div>
                <!--end::Header-->
                @yield('content')
                <!--begin::Footer-->
                @include('layouts.partials.footer')
                <!--end::Footer-->
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
    <div class="floating-container">
        <div class="floating-button">+</div>
        <div class="element-container">

            <a style="text-decoration: none" target="_blank" href="https://telp:05428795954">
                <span class="float-element tooltip-left">
                    <i class="fa-solid fa-phone text-white fs-1 material-icons"></i>
                </span>
            </a>

            <span class="float-element">
                <a target="_blank" href="https://mailto:cs@travelsya.com">
                    <i class="fa-solid fa-envelope text-white fs-1 material-icons"></i>
                </a>
            </span>
            <span class="float-element">
                <a target="_blank"
                    href="https://api.whatsapp.com/send?phone=628115417708&text=Halo%20min%2C%20mau%20nanya%20nih">
                    <i class="fa-brands fa-whatsapp text-white fs-1 material-icons"></i>
                </a>
            </span>
        </div>
    </div>
    <!--begin::Javascript-->
    @include('layouts.partials.foot')

    @stack('js')

    <script>
        $('.js-daterangepicker').daterangepicker();

        $(".main-menu li").on('click', function() {
            $('.form-menu').removeClass('show active')
        })
    </script>
</body>

<!--end::Body-->

</html>
