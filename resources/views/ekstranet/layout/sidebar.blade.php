@php use App\Models\Clinic; @endphp
@php use App\Models\Hotel; @endphp
@php use App\Models\Hostel; @endphp
@php use App\Models\DetailTransactionHotel; @endphp
@php use App\Models\DetailTransactionHostel; @endphp
@php use App\Models\DetailTransactionRecreation; @endphp
@php use App\Models\DetailTransactionCarRental; @endphp
@php use App\Models\DetailTransactionBus; @endphp
@php use App\Models\DetailTransactionHealthBeauty; @endphp
@php use App\Models\BusTravels; @endphp
@php use App\Models\Recreation; @endphp
@php use App\Models\CarRental; @endphp
@php use Carbon\Carbon; @endphp
<style>
    .menu-item {
        margin: 0.2rem 0;
    }

    .active-link {
        color: white;
    }

    .main-accordion {
        display: block;
        background-color: #C02425;
        height: 3rem;
    }

    .menu-item.here .menu-title.custom,
    .menu-item.here .menu-arrow {
        color: gray !important;
    }

    /* --- Custom styles for Pemesanan dropdown (Full Red Theme) --- */

    /* Dropdown container background */
    .menu-item.pemesanan-menu .menu-sub-accordion {
        background-color: #C02425 !important;
        /* Red background */
        padding: 0;
    }

    /* Default state for all links within the dropdown */
    .menu-item.pemesanan-menu .menu-sub-accordion .menu-item .menu-link {
        background-color: transparent !important;
    }

    /* Default state for text and bullets in dropdown */
    .menu-item.pemesanan-menu .menu-sub-accordion .menu-item .menu-link .menu-title {
        color: #f8f9fa;
        /* A light, off-white color for inactive items */
    }

    .menu-item.pemesanan-menu .menu-sub-accordion .menu-item .menu-link .menu-bullet .bullet-dot {
        background-color: #f8f9fa;
        /* Matching off-white */
    }

    /* Hover state for links in dropdown */
    .menu-item.pemesanan-menu .menu-sub-accordion .menu-item .menu-link:hover .menu-title {
        color: white !important;
    }

    .menu-item.pemesanan-menu .menu-sub-accordion .menu-item .menu-link:hover .menu-bullet .bullet-dot {
        background-color: white !important;
    }

    /* Active state for a link in the dropdown */
    .menu-item.pemesanan-menu .menu-sub-accordion .menu-item .menu-link.active .menu-title {
        color: white !important;
        font-weight: bold;
        /* Make it stand out more */
    }

    .menu-item.pemesanan-menu .menu-sub-accordion .menu-item .menu-link.active .menu-bullet .bullet-dot {
        background-color: white !important;
    }
</style>


<!--begin::Sidebar-->
<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px"
    data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!--begin::Logo-->
    <div class="app-sidebar-logo px-6" id="kt_app_sidebar_logo">
        <!--begin::Logo image-->
        <a href="">
            <img alt="Logo" src="{{ asset('assets/media/logos/new-logo-1.png') }}" class="logo-default h-50px" />
        </a>
        <!--end::Logo image-->
        <!--begin::Sidebar toggle-->
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
            data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">

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
                <a href="{{ route('partner.dashboard') }}"
                    class="menu-item {{ Request::segment(2) == 'dashboard' ? 'here' : '' }} menu-accordion">
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
                @php

                    $clinic = Clinic::where('user_id', Auth::id())->get();
                    $hotel = Hotel::where('user_id', Auth::id())->get();
                    $hostel = Hostel::where('user_id', Auth::id())->get();
                    $carRentals = CarRental::where('user_id', Auth::id())->get();
                    $recreations = Recreation::where('user_id', Auth::id())->get();
                    $busTravels = BusTravels::where('user_id', Auth::id())->get();

                    $bookingHotel = DetailTransactionHotel::with('transaction')
                        ->whereHas('transaction', function ($q) {
                            $q->where('status', 'PAID');
                        })
                        ->whereIn('hotel_id', $hotel->pluck('id'))
                        ->where('detail_transaction_hotel.reservation_end', '>=', Carbon::now())
                        ->count();

                    $bookingHostel = DetailTransactionHostel::with('transaction')
                        ->whereIn('hostel_id', $hostel->pluck('id'))
                        ->whereHas('transaction', function ($q) {
                            $q->where('status', 'PAID');
                        })
                        ->where('detail_transaction_hostel.reservation_end', '>=', Carbon::now())
                        ->count();

                    $bookingCarRental = DetailTransactionCarRental::with('transaction')
                        ->whereHas('transaction', function ($q) {
                            $q->where('status', 'PAID');
                        })
                        ->whereIn('car_rental_id', $carRentals->pluck('id'))
                        ->where('end', '>=', Carbon::now())
                        ->count();

                    $bookingRecreation = DetailTransactionRecreation::with('transaction')
                        ->whereHas('transaction', function ($q) {
                            $q->where('status', 'PAID');
                        })
                        ->whereIn('recreation_id', $recreations->pluck('id'))
                        ->where('expire_on', '>=', Carbon::now())
                        ->count();

                    // Assuming there's a DetailTransactionBus model and similar logic
$bookingBus = 0;
if (class_exists(DetailTransactionBus::class)) {
    $bookingBus = DetailTransactionBus::with('transaction')
        ->whereHas('transaction', function ($q) {
            $q->where('status', 'PAID');
        })
        ->whereIn('bus_travel_id', $busTravels->pluck('id'))
        // Add appropriate date condition for bus bookings
        ->count();
}

$bookingClinic = DetailTransactionHealthBeauty::with('transaction')
    ->whereHas('transaction', function ($q) {
        $q->where('status', 'PAID');
    })
    ->whereIn('clinic_id', $clinic->pluck('id'))
    // Add appropriate date condition for clinic bookings
    ->count();

$totalPemesanan =
    $bookingHotel +
    $bookingHostel +
    $bookingCarRental +
    $bookingRecreation +
    $bookingBus +
    $bookingClinic;

$isPemesananActive = in_array(Request::segment(2), [
    'riwayat-booking',
    'riwayat-booking-recreation',
    'riwayat-booking-car-rental',
    'riwayat-booking-bus-travel',
                    ]);
                @endphp

                <div data-kt-menu-trigger="click"
                    class="menu-item menu-accordion pemesanan-menu {{ $isPemesananActive ? 'here show' : '' }}">
                    <!--begin:Menu link-->
                    <span class="menu-link {{ $isPemesananActive ? 'main-accordion' : '' }}">
                        <span class="menu-icon">
                            <i class="far fa-calendar fs-3"></i>
                        </span>
                        <span class="menu-title">Pemesanan ({{ $totalPemesanan }})</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <!--end:Menu link-->
                    <div class="menu-sub menu-sub-accordion">
                        @if (count($hotel) > 0 || count($hostel) > 0)
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(2) == 'riwayat-booking' ? 'active' : '' }}"
                                    href="{{ route('partner.riwayat-booking') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Hotel & Hostel</span>
                                </a>
                            </div>
                            <!--end:Menu item-->
                        @endif
                        @if (count($recreations) > 0)
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(2) == 'riwayat-booking-recreation' ? 'active' : '' }}"
                                    href="{{ route('partner.riwayat-booking.recreation') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Rekreasi</span>
                                </a>
                            </div>
                            <!--end:Menu item-->
                        @endif
                        @if (count($carRentals) > 0)
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(2) == 'riwayat-booking-car-rental' ? 'active' : '' }}"
                                    href="{{ route('partner.riwayat-booking.car-rental') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Sewa Mobil</span>
                                </a>
                            </div>
                            <!--end:Menu item-->
                        @endif
                        @if (count($busTravels) > 0)
                            <!--begin:Menu item-->
                            <div class="menu-item">
                                <a class="menu-link {{ Request::segment(2) == 'riwayat-booking-bus-travel' ? 'active' : '' }}"
                                    href="{{ route('partner.riwayat-booking.bus-travel') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title">Bus & Travel</span>
                                </a>
                            </div>
                            <!--end:Menu item-->
                        @endif
                    </div>
                </div>
                <a href="{{ route('partner.review') }}"
                    class="menu-item {{ Request::segment(2) == 'review' ? 'here' : '' }} menu-accordion">
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
                <a href="{{ route('partner.laporan.semua') }}"
                    class="menu-item {{ Request::segment(2) == 'laporan' ? 'here' : '' }} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-receipt fs-3"></i>
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
                </div>
                {{-- Daftar Rekreasi --}}
                <a href="{{ route('partner.daftar-rekreasi') }}"
                    class="menu-item {{ Request::segment(2) == 'daftar-rekreasi' ? 'here' : '' }} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-umbrella-beach"></i>
                        </span>
                        <span class="menu-title">Daftar Rekreasi</span>
                    </span>

                </a>
                <a href="{{ route('clinics.list') }}"
                    class="menu-item {{ Request::segment(2) == 'clinics' ? 'here' : '' }} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-receipt fs-3"></i>
                        </span>
                        <span class="menu-title">Health & Beauty</span>
                    </span>
                    <!--end:Menu link-->
                </a>

                {{-- Bisnis Health & Beauty --}}
                <a href="{{ route('partner.health-beauty.index') }}"
                    class="menu-item {{ Request::segment(2) == 'health-beauty' ? 'here' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-spa fs-3"></i>
                        </span>
                        <span class="menu-title">Bisnis Health & Beauty</span>
                    </span>
                </a>

                <a href="{{ route('partner.daftar.kendaraan') }}"
                    class="menu-item {{ Request::segment(2) == 'daftar-kendaraan' ? 'here' : '' }} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-car-side fs-3"></i>
                        </span>
                        <span class="menu-title">Daftar kendaraan</span>
                    </span>
                    <!--end:Menu link-->
                </a>

                <a href="{{ route('partner.daftar.bus-travel') }}"
                    class="menu-item {{ Request::segment(2) == 'daftar-bus-travel' ? 'here' : '' }} menu-accordion">
                    <!--begin:Menu link-->
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fas fa-bus fs-3"></i>
                        </span>
                        <span class="menu-title">Bus & Travel</span>
                    </span>
                    <!--end:Menu link-->
                </a>


                @if (count($hotel) > 0)
                    @if (Request::segment(2) === 'management-hotel' || request()->query('category') === 'hotel')
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion here show"
                            style="background-color: white;">
                        @else
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                    @endif


                    <span
                        class="menu-link {{ Request::segment(2) === 'management-hotel' || request()->query('category') === 'hotel' ? 'main-accordion' : '' }}">
                        <span
                            class="menu-icon {{ Request::segment(2) === 'management-hotel' || request()->query('category') === 'hotel' ? 'main-accordion' : '' }}">
                            <i class="fa-solid fa-hotel fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </span>

                        @if (Request::segment(2) === 'management-hotel' || request()->query('category') === 'hotel')
                            <span class="menu-title main-accordion" style="color: white !important;">Hotel
                                ({{ count($hotel) }})</span>
                        @else
                            <span class="menu-title custom">Hotel ({{ count($hotel) }})</span>
                        @endif



                        <span
                            class="menu-arrow {{ Request::segment(2) === 'management-hotel' || request()->query('category') === 'hotel' ? 'main-accordion' : '' }}"></span>

                    </span>

                    <div class="menu-sub menu-sub-accordion">
                        <!--begin:Menu item-->
                        <div class="menu-item initial menu-hover">
                            <!--begin:Menu link-->
                            @if (Request::segment(2) === 'management-hotel')
                                <a class="menu-link" href="{{ route('partner.management.hotel') }}"
                                    style="background-color: #C02425;">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"
                                            style="background-color: white !important;"></span>
                                    </span>
                                    <span class="menu-title" style="color: white !important;">Semua Hotel</span>
                                </a>
                            @else
                                <a class="menu-link" href="{{ route('partner.management.hotel') }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title custom">Semua Hotel</span>
                                </a>
                            @endif
                        </div>

                        <div class="menu-item initial menu-hover">
                            <!--begin:Menu link-->
                            @if (request()->query('category') === 'hotel')
                                <a class="menu-link"
                                    href="{{ route('partner.management.room', ['category' => 'hotel']) }}"
                                    style="background-color: #C02425;">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"
                                            style="background-color: white !important;"></span>
                                    </span>
                                    <span class="menu-title" style="color: white !important;">Daftar Kamar
                                        Hotel</span>
                                </a>
                            @else
                                <a class="menu-link"
                                    href="{{ route('partner.management.room', ['category' => 'hotel']) }}">
                                    <span class="menu-bullet">
                                        <span class="bullet bullet-dot"></span>
                                    </span>
                                    <span class="menu-title custom">Daftar Kamar Hotel</span>
                                </a>
                            @endif
                        </div>

                    </div>

            </div>
            @endif

            @if (count($hostel) > 0)
                @if (Request::segment(2) === 'management-hostel' || request()->query('category') === 'hostel')
                    <div data-kt-menu-trigger="click" class="menu-item menu-accordion here show"
                        style="background-color: white;">
                    @else
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
                @endif


                <span
                    class="menu-link {{ Request::segment(2) === 'management-hostel' || request()->query('category') === 'hostel' ? 'main-accordion' : '' }}">
                    <span
                        class="menu-icon {{ Request::segment(2) === 'management-hostel' || request()->query('category') === 'hostel' ? 'main-accordion' : '' }}">
                        <i class="fa-solid fa-hotel fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </span>

                    @if (Request::segment(2) === 'management-hostel' || request()->query('category') === 'hostel')
                        <span class="menu-title main-accordion" style="color: white !important;">Hostel
                            ({{ count($hostel) }})</span>
                    @else
                        <span class="menu-title custom">Hostel ({{ count($hostel) }})</span>
                    @endif



                    <span
                        class="menu-arrow {{ Request::segment(2) === 'management-hostel' || request()->query('category') === 'hostel' ? 'main-accordion' : '' }}"></span>

                </span>

                <div class="menu-sub menu-sub-accordion">
                    <!--begin:Menu item-->
                    <div class="menu-item initial menu-hover">
                        <!--begin:Menu link-->
                        @if (Request::segment(2) === 'management-hostel')
                            <a class="menu-link" href="{{ route('partner.management.hostel') }}"
                                style="background-color: #C02425;">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"
                                        style="background-color: white !important;"></span>
                                </span>
                                <span class="menu-title" style="color: white !important;">Semua Hostel</span>
                            </a>
                        @else
                            <a class="menu-link" href="{{ route('partner.management.hostel') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title custom">Semua Hostel</span>
                            </a>
                        @endif
                    </div>


                    <div class="menu-item initial menu-hover">
                        <!--begin:Menu link-->
                        @if (request()->query('category') === 'hostel')
                            <a class="menu-link"
                                href="{{ route('partner.management.room', ['category' => 'hostel']) }}"
                                style="background-color: #C02425;">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"
                                        style="background-color: white !important;"></span>
                                </span>
                                <span class="menu-title" style="color: white !important;">Daftar Kamar Hostel</span>
                            </a>
                        @else
                            <a class="menu-link"
                                href="{{ route('partner.management.room', ['category' => 'hostel']) }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title custom">Daftar Kamar Hostel</span>

                            </a>
                        @endif
                    </div>

                </div>

        </div>
        @endif


    </div>
    <!--end::Menu-->
</div>
<!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
</div>
<!--end::Sidebar-->
