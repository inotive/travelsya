<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
     data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
     data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="">
            <img alt="Logo" src="{{asset('admin/assets/media/logo-travelsya.png')}}" class="app-sidebar-logo-default"/>
            <img alt="Logo" src="{{asset('admin/assets/media/logo-travelsya.png')}}"
                 class=" app-sidebar-logo-minimize"/>
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
        <!--begin::Minimized sidebar setup:
            if (isset($_COOKIE["sidebar_minimize_state"]) && $_COOKIE["sidebar_minimize_state"] === "on") {
                1. "src/js/layout/sidebar.js" adds "sidebar_minimize_state" cookie value to save the sidebar minimize state.
                2. Set data-kt-app-sidebar-minimize="on" attribute for body tag.
                3. Set data-kt-toggle-state="active" attribute to the toggle element with "kt_app_sidebar_toggle" id.
                4. Add "active" class to to sidebar toggle element with "kt_app_sidebar_toggle" id.
            }
        -->
        <div id="kt_app_sidebar_toggle"
             class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate"
             data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
             data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-double-left fs-2 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
        <!--end::Sidebar toggle-->
    </div>
    <!--end::Logo-->
    <!--begin::sidebar menu-->
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <!--begin::Menu wrapper-->
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
             data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto"
             data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
             data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px"
             data-kt-scroll-save-state="true">

            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu"
                 data-kt-menu="true" data-kt-menu-expand="false">
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Menu Utama</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <!--begin:Menu item-->
                <a href="{{route('partner.dashboard')}}"
                   class="menu-item {{(Request::segment(2)=="dashboard") ? 'here' : ''}} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-home fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </span>
                        <span class="menu-title">Dashboards</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
                <a href="{{route('partner.riwayat-booking')}}"
                   class="menu-item {{(Request::segment(2)=="riwayat-booking") ? 'here' : ''}} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                           <i class="fa-solid fa-receipt fs-3"></i>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Pemesanan (17)</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--begin:Menu item-->
                <a href="{{route('partner.riwayat-booking')}}"
                   class="menu-item menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                           <i class="fa-regular fa-thumbs-up fs-3"></i>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Review</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--begin:Menu item-->
                <!--begin:Menu item-->
                <a href="{{route('partner.riwayat-booking')}}"
                   class="menu-item {{(Request::segment(2)=="riwayat-booking") ? 'here' : ''}} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                           <i class="fa-regular fa-thumbs-up fs-3"></i>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Laporan</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Konfigurasi</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                <a href="{{route('partner.management.hotel')}}"
                   class="menu-item {{(Request::segment(2)=="management-hotel") ? 'here' : ''}} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-hotel fs-3"></i>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Hotel</span>
                    </span>
                    <!--end:Menu link-->
                </a>

                <a href="{{route('partner.management.hostel')}}"
                   class="menu-item {{(Request::segment(2)=="management-hostel") ? 'here' : ''}} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-hotel fs-3"></i>
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Hostel</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <a href="{{route('partner.management.room')}}"
                   class="menu-item {{(Request::segment(2)=="management-hotel") ? 'here' : ''}} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-color-swatch fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Rooms</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>
<!--end::Sidebar-->
