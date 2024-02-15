<style>

    .main-accordion {
        display: block;
        background-color: #C02425;
        height: 3rem;
    }

    .menu-item.here .menu-title.custom, .menu-item.here .menu-arrow {
        color: gray !important;
     } 
     
</style>

<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="#">
            <img alt="Logo" src="{{asset('admin/assets/media/logo-travelsya.png')}}" class="app-sidebar-logo-default" />
            <img alt="Logo" src="{{asset('admin/assets/media/logo-travelsya.png')}}" class=" app-sidebar-logo-minimize" />
        </a>
        <!--end::Logo image-->
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
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
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <!--begin::Menu-->
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Menu Utama</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                @if(auth()->user()->role == 1)
                    <!--begin:Menu item-->
                    <a href="{{route('partner.dashboard')}}" class="menu-item {{(Request::segment(2)=="dashboard") ? 'here' : ''}} menu-accordion">
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
                    <a href="{{route('partner.riwayat-booking')}}" class="menu-item {{(Request::segment(2)=="riwayat-booking") ? 'here' : ''}} menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-color-swatch fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Riwayat Booking</span>
                    </span>
                        <!--end:Menu link-->
                    </a>
                @endif
                @if(auth()->user()->role == 0)
                    <!--begin:Menu item-->
                    <a href="{{route('admin.dashboard')}}" class="menu-item {{(Request::segment(2)=="dashboard") ? 'here' : ''}} menu-accordion">
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
                        <span class="menu-title">Dashboard</span>
                    </span>
                        <!--end:Menu link-->
                    </a>
                    <!--end:Menu item-->
                <!--begin:Menu item-->
                <a href="{{route('admin.customer')}}" class="menu-item {{(Request::segment(2)=="customer") ? 'here' : ''}} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-address-book fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span>
                        <span class="menu-title">Customer</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                    <!--begin:Menu item-->
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion{{(Request::segment(2)=="transaction") ? 'here show' : ''}}">
                        <!--begin:Menu link-->
                        <span class="menu-link {{(Request::segment(2)=="transaction") ? 'main-accordion' : ''}}" >
                         @if (Request::segment(2)=="transaction")
                        <span class="menu-icon">
                            <i class="fas fa-clipboard-list fs-2" style="color: white;">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title custom" style="color: white;">Laporan</span>
                        @else
                        <span class="menu-icon">
                            <i class="fas fa-clipboard-list fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title custom">Laporan</span>
                        @endif
                        <span class="menu-arrow"></span>
                    </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->

                            @if (Request::segment(2)=="transaction")
                                <div class="menu-item" style="background-color: #C02425; margin-top: 0.2rem; border-radius: 0.5rem;">
                                    <!--begin:Menu link-->
                                    <a class="menu-link menu-tr {{(Request::segment(2)=="transaction") ? 'active-link-tr custom' : ''}}" href="{{route('admin.transaction')}}" >
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot" style="background-color: white;"></span>
                                    </span>

                                    <span class="menu-title" style="color: white;">Riwayat Transaksi</span>
     
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                            @else
                                <div class="menu-item" style="">
                                    <!--begin:Menu link-->
                                    <a class="menu-link menu-tr" href="{{route('admin.transaction')}}" >
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    
                                    <span class="menu-title custom">Riwayat Transaksi</span>
                                    
                                    </a>
                                    <!--end:Menu link-->
                                </div>
                            @endif

                           
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                <!--end:Menu item-->

                @endif

                <!--begin:Menu item-->
                <div class="menu-item pt-5">
                    <!--begin:Menu content-->
                    <div class="menu-content">
                        <span class="menu-heading fw-bold text-uppercase fs-7">Konfigurasi</span>
                    </div>
                    <!--end:Menu content-->
                </div>
                <!--end:Menu item-->
                @if(auth()->user()->role == 0)
                <!--begin:Menu item-->
                <a href="{{route('admin.user')}}" class="menu-item {{(Request::segment(2)=="user") ? 'here' : ''}} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-users fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">User Travelsya</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
                    <!--begin:Menu item-->
                    @if (Route::currentRouteName()=='admin.mitra' || Route::currentRouteName()=='admin.hotel.index' || Route::currentRouteName()=='admin.hostel.index')
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Route::currentRouteName()=='admin.mitra' || Route::currentRouteName()=='admin.hotel.index' || Route::currentRouteName()=='admin.hostel.index'  ? 'here show' : '' }} "  style="background-color: white;">
                    @else
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ Route::currentRouteName()=='admin.mitra' || Route::currentRouteName()=='admin.hotel.index' || Route::currentRouteName()=='admin.hostel.index'  ? 'here show' : '' }} ">
                    @endif
                    
                        <!--begin:Menu link-->

                       
                            <span class="menu-link {{ Route::currentRouteName()=='admin.mitra' || Route::currentRouteName()=='admin.hotel.index' || Route::currentRouteName()=='admin.hostel.index'  ? 'main-accordion' : '' }}">
                            <span class="menu-icon {{ Route::currentRouteName()=='admin.mitra' || Route::currentRouteName()=='admin.hotel.index' || Route::currentRouteName()=='admin.hostel.index'  ? 'main-accordion' : '' }}">
                                 <i class="fas fa-users fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>

                            @if (Route::currentRouteName()=='admin.mitra' || Route::currentRouteName()=='admin.hotel.index' || Route::currentRouteName()=='admin.hostel.index')
                                <span class="menu-title main-accordion" style="color: white !important;">Mitra</span>
                            @else
                                <span class="menu-title custom">Mitra</span>
                            @endif


                          
                            <span class="menu-arrow {{ Route::currentRouteName()=='admin.mitra' || Route::currentRouteName()=='admin.hotel.index' || Route::currentRouteName()=='admin.hostel.index'  ? 'main-accordion' : '' }}"></span>
                        
                    </span>
                        <!--end:Menu link-->
                        <!--begin:Menu sub-->
                        <div class="menu-sub menu-sub-accordion">
                            <!--begin:Menu item-->
                            <div class="menu-item initial menu-hover">
                                <!--begin:Menu link-->
                                @if (Route::currentRouteName()=='admin.mitra')
                                    <a class="menu-link" href="{{route('admin.mitra')}}" style="background-color: #C02425;">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot" style="background-color: white !important;"></span>
                                        </span>
                                            <span class="menu-title" style="color: white !important;">Semua Mitra</span>
                                    </a>
                                @else
                                    <a class="menu-link" href="{{route('admin.mitra')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                            <span class="menu-title custom">Semua Mitra</span>
                                    </a>
                                @endif
                               
                               
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item initial menu-hover">
                                <!--begin:Menu link-->

                                @if (Route::currentRouteName()=='admin.hotel.index')
                                    <a class="menu-link" href="{{route('admin.hotel.index')}}" style="background-color: #C02425;">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot" style="background-color: white !important;"></span>
                                        </span>
                                            <span class="menu-title" style="color: white !important;">Hotel</span>
                                    </a>
                                @else
                                    <a class="menu-link" href="{{route('admin.hotel.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                            <span class="menu-title custom">Hotel</span>
                                    </a>
                                @endif

                          
                                
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                            <!--begin:Menu item-->
                            <div class="menu-item initial menu-hover">
                                <!--begin:Menu link-->

                                @if (Route::currentRouteName()=='admin.hostel.index')
                                    <a class="menu-link" href="{{route('admin.hostel.index')}}" style="background-color: #C02425;">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"  style="background-color: white !important;"></span>
                                        </span>
                                            <span class="menu-title" style="color: white !important;">Hostel</span>
                                    </a>
                                @else
                                    <a class="menu-link" href="{{route('admin.hostel.index')}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                            <span class="menu-title custom">Hostel</span>
                                    </a>
                                @endif

                               
                                <!--end:Menu link-->
                            </div>
                            <!--end:Menu item-->
                        </div>
                        <!--end:Menu sub-->
                    </div>
                    <!--end:Menu item-->
                <!--begin:Menu item-->
                <a href="{{route('admin.point')}}" class="menu-item {{(Request::segment(2)=="point") ? 'here' : ''}} menu-accordion">

                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-coins fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Point</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <a href="{{route('admin.product')}}" class="menu-item {{(Request::segment(2)=="product") ? 'here' : ''}} menu-accordion">

                        <!--begin:Menu link-->
                        <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-money-bill-alt fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Produk</span>
                    </span>
                        <!--end:Menu link-->
                    </a>
                    <!--end:Menu item-->
                    <!--begin:Menu item-->
                    <a href="{{route('admin.facility.index')}}" class="menu-item {{(Request::segment(2)=="facility") ? 'here' : ''}} menu-accordion">

                        <!--begin:Menu link-->
                        <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-money-bill-alt fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Fasilitas Hotel</span>
                    </span>
                        <!--end:Menu link-->
                    </a>
                    <a href="{{route('admin.ads.index')}}" class="menu-item {{(Request::segment(2)=="ads") ? 'here' : ''}} menu-accordion">

                        <!--begin:Menu link-->
                        <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-money-check-alt fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Iklan</span>
                    </span>
                        <!--end:Menu link-->
                    </a>
                    <a href="{{route('admin.help.index')}}" class="menu-item {{(Request::segment(2)=="help") ? 'here' : ''}} menu-accordion">

                        <!--begin:Menu link-->
                        <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-solid fa-circle-info fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Bantuan</span>
                    </span>
                        <!--end:Menu link-->
                    </a>
                    <!--end:Menu item-->
                <!--begin:Menu item-->
                <a href="{{route('admin.management-fee')}}" class="menu-item {{(Request::segment(2)=="management-fee") ? 'here' : ''}} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-money-check-alt fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Biaya Admin</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <a href="{{route('admin.city-management.index')}}" class="menu-item {{(Request::segment(2)=="management-city") ? 'here' : ''}} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-city"></i>
                        </span>
                        <span class="menu-title">Kelola Kota</span>
                    </span>
                    <!--end:Menu link-->
                </a>
                <!--end:Menu item-->
                @endif
                @if(auth()->user()->role == 1)
                    <a href="{{route('partner.management.hotel')}}" class="menu-item {{(Request::segment(2)=="management-hotel") ? 'here' : ''}} menu-accordion">
                        <!--begin:Menu link-->
                        <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-color-swatch fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>
                        <span class="menu-title">Hotel</span>
                    </span>
                        <!--end:Menu link-->
                    </a>


                    </a>
                <!--end:Menu item-->
                @endif

            </div>
            <!--end::Menu-->
        </div>
        <!--end::Menu wrapper-->
    </div>
    <!--end::sidebar menu-->
</div>
<!--end::Sidebar-->
