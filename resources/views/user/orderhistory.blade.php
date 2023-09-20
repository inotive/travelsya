@extends('layouts.user')

@section('content-user')

<style>
.bg-gradient-merah{
background: rgb(255,238,241);
background: linear-gradient(270deg, rgba(255,238,241,1) 0%, rgba(255,255,255,1) 50%);

}

</style>

{{-- Containre --}}
<div class="container">
    {{-- Row --}}
    <div class="row">
        {{-- Kolom Kiri (Menu)--}}
        <div class="col-12 col-lg-3 offset-lg-1 mb-10">
            <div class="card">
                {{-- Card Bagian Body --}}
                <div class="card-body">
                    {{-- Nama User --}}
                    <div class="card-title mb-5">
                        <h3>
                        <b>
                        John Doe
                        </b>
                        </h3>
                    </div>
                    {{-- end Nama User --}}

                    {{-- Menu Item Start --}}

                    {{-- Bagian Poin --}}
                    <div class="group-point-ini-guys d-flex">
                        <div class="menu-item">
                    <div class="menu-link">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/coin.svg') }}" class="h-24px me-10"/>
                    </span>

                    <div class="ini-pemersatu">
                    <div class="text-gray-500 fs-8">Points Anda</div>
                    <span class=" fw-medium fs-4 menu-title">
                            <b>
                                1.384
                            </b>
                    </span>
                    </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Bagian Poin --}}

                    {{-- Start Bagian e-Wallet --}}
                    <div class="group-wallet-ini-guys d-flex">
                        <div class="menu-item">
                    <div class="menu-link">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/wallet.svg') }}" class="h-24px me-10"/>
                    </span>
                    <div class="ini-pemersatu">
                    <div class="text-gray-500 fs-8">e-Wallet</div>
                    <span class=" fw-medium fs-4 menu-title">
                            <b>
                                56.500
                            </b>
                    </span>
                    </div>
                            </div>
                        </div>
                    </div>

                    {{-- Separator --}}
                <div class="separator mb-3 border"></div>

                {{-- Menu Item Profil Saya --}}
                <div class="menu-item">
                    <a class="menu-link text-gray" href="#">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/user-nonactive.svg') }}" class="h-24px me-10"/>
                    </span>
                    <span class="menu-title text-gray-900">
                        Profil Saya
                    </span>
                    </a>
                </div>

                {{-- Menu Item Riwayat Pesanan --}}
                <div class="menu-item">
                    <a class="menu-link text-gray-900" href="#">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/clipboard-active.svg') }}" class="h-24px me-10"/>
                    </span>
                    <span class="menu-title fw-bold text-danger">
                        Riwayat Pesanan</b>
                    </span>
                    </div>
                </a>
                {{-- Menu Item Data Penumpang --}}
                <div class="menu-item" >
                    <a class="menu-link text-gray-900" href="#">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/users.svg') }}" class="h-24px me-10"/>
                    </span>
                    <span class="menu-title">
                        Data Penumpang
                    </span>
                    </a>
                </div>
                {{-- Menu Item Keamanan --}}
                <div class="menu-item" >
                    <a class="menu-link text-gray-900" href="#">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/lock.svg') }}" class="h-24px me-10"/>
                    </span>
                    <span class="menu-title">
                        Keamanan
                    </span>
                    </a>
                </div>
                {{-- Menu Item Kode Referral --}}
                <div class="menu-item" >
                    <a class="menu-link text-gray-900" href="#">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/clipboard.svg') }}" class="h-24px me-10"/>
                    </span>
                    <span class="menu-title">
                        Kode Referral
                    </span>
                    </a>
                </div>
                {{-- Menu Item --}}
                <div class="menu-item">
                    <a class="menu-link text-gray-900" href="#">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/credit-card.svg') }}" class="h-24px me-10"/>
                    </span>
                    <span class="menu-title">
                        Refund & Pembatalan
                    </span>
                    </a>
                </div>
                {{-- Menu Item Pusat Bantuan --}}
                <div class="menu-item" >
                    <a class="menu-link text-gray-900" href="#">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/headphones.svg') }}" class="h-24px me-10"/>
                    </span>
                    <span class="menu-title">
                        Pusat Bantuan
                    </span>
                    </a>
                </div>
                {{-- SEPARATOR --}}
                <div class="separator my-3 border"></div>
                {{-- Menu ITEm Logout --}}
                <div class="menu-item" >
                    <a class="menu-link text-gray-900" href="#">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/log-out.svg') }}" class="h-24px me-10"/>
                    </span>
                        Log out
                    </a>
                </div>
                </div>
            </div>
        </div>
        {{-- End Kolom Kiri --}}

        {{-- Kolom Kanan (Form Riwayat PEsanan) --}}
        <div class="col-12 col-lg-7">
            <div class="card">
                {{-- Card Head --}}
                <div class="card-header">
                    <div class="card-title">
                    <h1>
                        <b>
                        Riwayat Pesanan
                        </b>
                    </h1>
                    </div>
                </div>
                {{-- Card Body --}}
                <div class="card-body">
                    {{-- Row --}}
                    <div class="row">
                        {{-- kolom batas form --}}
                        <div class="col-12">
                            {{-- Opsi --}}
                            <div class="ini-opsi d-flex">
                                <div class="semua mr-3" style="margin-right: 8px">
                                    <a class="btn btn-light-danger py-1 text-bold px-4 border border-1 rounded-pill fw-bold border-danger">
                                        Semua
                                    </a>
                                </div>
                                <div class="pesanan-aktif" style="margin-right: 8px">
                                    <a class="btn btn-outline btn-outline-secondary py-1 text-bold px-4 border border-1 rounded-pill fw-bold text-gray-400 border-gray-400">
                                        Pesanan Aktif
                                    </a>
                                </div>
                                <div class="riwayat" style="margin-right: 8px">
                                    <a class="btn btn-outline btn-outline-secondary py-1 text-bold px-4 border border-1 rounded-pill fw-bold text-gray-400 border-gray-400 ">
                                        Riwayat
                                    </a>
                                </div>
                            </div>
                            {{-- End Opsi --}}

                        {{-- Card Pertama --}}
                        <div class="card border border-1 mt-5 d-flex bg-gradient-merah" style="margin-bottom: 8px;">
                            <div class="d-flex align-items-center">
                                <!--begin::User-->
                                <div class="d-flex" style="margin-left: 16px; margin-top:16px; margin-bottom: 8px;">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-40px me-5">
                                        <img src="{{ asset('assets/media/svg/profile-account/order-history/Frame5.svg') }}" alt="frame5">
                                    </div>
                                    <!--end::Avatar-->

                                    <!--begin::Info-->
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold" style="margin-bottom: 8px">MEISO KELAPA GADING</a>
                                        <span class="text-gray-400" style="margin-bottom: 6px">Reflexology 30 Menit</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </div>
                                {{-- Separator --}}
                                <div class="separator border border-1" style="margin-bottom: 8px; margin-left: 16px; margin-right: 16px;"></div>
                                <div class="bagian-bawah d-flex justify-content-between" style="margin-left: 16px; margin-bottom: 16px; margin-right: 16px;">
                                <div class="text fw-bold text-danger fs-8">Menunggu Pembayaran</div>
                                <img src="{{ asset('assets/media/svg/profile-account/order-history/down.svg') }}" alt="frame5" style="height: 18px; width: 18px;">
                                </div>
                        </div>

                        {{-- Card Kedua --}}
                        <div class="card border border-1 d-flex bg-gradient-merah" style="margin-bottom: 8px;">
                            <div class="d-flex align-items-center">
                                <!--begin::User-->
                                <div class="d-flex" style="margin-left: 16px; margin-top:16px; margin-bottom: 8px;">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-40px me-5">
                                        <img src="{{ asset('assets/media/svg/profile-account/order-history/Frame4.svg') }}" alt="frame4">
                                    </div>
                                    <!--end::Avatar-->

                                    <!--begin::Info-->
                                    <div class="info-full" style="margin-right: 16px">
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold" style="margin-bottom: 8px">SOEKARNO HATTA - DJUANDA</a>
                                        <span class="text-gray-400" style="margin-bottom: 6px">Citilink QG-513, Ekonomi</span>
                                        <span class="text-gray-400">Senin, 02 Des 2022 | 06:00 | 1j 30m</span>
                                    </div>
                                    <!--end::Info-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-column" style="margin-top: 12px">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold" style="margin-bottom: 8px">SOEKARNO HATTA - DJUANDA</a>
                                        <span class="text-gray-400" style="margin-bottom: 6px">Citilink QG-555, Ekonomi</span>
                                        <span class="text-gray-400">Senin, 02 Des 2022 | 18:00 | 1j 30m</span>
                                    </div>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </div>
                                {{-- Separator --}}
                                <div class="separator border border-1" style="margin-bottom: 8px; margin-left: 16px; margin-right: 16px;"></div>
                                <div class="bagian-bawah d-flex justify-content-between" style="margin-left: 16px; margin-bottom: 16px; margin-right: 16px;">
                                <div class="text fw-bold text-gray-400 fs-8">Selesai</div>
                                <img src="{{ asset('assets/media/svg/profile-account/order-history/down.svg') }}" alt="frame5" style="height: 18px; width: 18px;">
                                </div>
                        </div>

                        {{-- Card Ketiga --}}
                        <div class="card border border-1 d-flex bg-gradient-merah " style="margin-bottom: 8px;">
                            <div class="d-flex align-items-center">
                                <!--begin::User-->
                                <div class="d-flex" style="margin-left: 16px; margin-top:16px; margin-bottom: 8px;">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-40px me-5">
                                        <img src="{{ asset('assets/media/svg/profile-account/order-history/Frame3.svg') }}" alt="frame3">
                                    </div>
                                    <!--end::Avatar-->

                                    <!--begin::Info-->
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold" style="margin-bottom: 8px">YOGYAKARTA - JAKARTA</a>
                                        <span class="text-gray-400" style="margin-bottom: 6px">Bangunkarta 122, Eksekutif</span>
                                        <span class="text-gray-400">Senin, 02 Des 2022 | 14:00 | Cikarang</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </div>
                                {{-- Separator --}}
                                <div class="separator border border-1" style="margin-bottom: 8px; margin-left: 16px; margin-right: 16px;"></div>
                                <div class="bagian-bawah d-flex justify-content-between" style="margin-left: 16px; margin-bottom: 16px; margin-right: 16px;">
                                <div class="text fw-bold text-gray-400 fs-8">Selesai</div>
                                <img src="{{ asset('assets/media/svg/profile-account/order-history/down.svg') }}" alt="frame5" style="height: 18px; width: 18px;">
                                </div>
                        </div>

                        {{-- Card Empat --}}
                        <div class="card border border-1 d-flex bg-gradient-merah" style="margin-bottom: 8px;">
                            <div class="d-flex align-items-center">
                                <!--begin::User-->
                                <div class="d-flex" style="margin-left: 16px; margin-top:16px; margin-bottom: 8px;">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-40px me-5">
                                        <img src="{{ asset('assets/media/svg/profile-account/order-history/Frame1.svg') }}" alt="frame1">
                                    </div>
                                    <!--end::Avatar-->

                                    <!--begin::Info-->
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold" style="margin-bottom: 8px">Maca Villas and Spa Seminyak</a>
                                        <span class="text-gray-400" style="margin-bottom: 6px">1x Kamar Deluxe Double atau Ranjang Lain - Pemandangan Kota</span>
                                        <span class="text-gray-400">19 Feb 2022 - 22 Feb 2022</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </div>
                                {{-- Separator --}}
                                <div class="separator border border-1" style="margin-bottom: 8px; margin-left: 16px; margin-right: 16px;"></div>
                                <div class="bagian-bawah d-flex justify-content-between" style="margin-left: 16px; margin-bottom: 16px; margin-right: 16px;">
                                <div class="text fw-bold text-gray-400 fs-8">Selesai</div>
                                <img src="{{ asset('assets/media/svg/profile-account/order-history/down.svg') }}" alt="frame5" style="height: 18px; width: 18px;">
                                </div>
                        </div>

                        {{-- Card Kelima --}}
                        <div class="card border border-1 d-flex bg-gradient-merah" style="margin-bottom: 8px;">
                            <div class="d-flex align-items-center">
                                <!--begin::User-->
                                <div class="d-flex" style="margin-left: 16px; margin-top:16px; margin-bottom: 8px;">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-40px me-5">
                                        <img src="{{ asset('assets/media/svg/profile-account/order-history/Frame3.svg') }}" alt="frame3">
                                    </div>
                                    <!--end::Avatar-->

                                    <!--begin::Info-->
                                    <div class="d-flex flex-column">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold" style="margin-bottom: 8px">JAKARTA - YOGYAKARTA</a>
                                        <span class="text-gray-400" style="margin-bottom: 6px">Bangunkarta 122, Eksekutif</span>
                                        <span class="text-gray-400">Senin, 02 Des 2022 | 14:00 | Cikarang</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </div>
                                {{-- Separator --}}
                                <div class="separator border border-1" style="margin-bottom: 8px; margin-left: 16px; margin-right: 16px;"></div>
                                <div class="bagian-bawah d-flex justify-content-between" style="margin-left: 16px; margin-bottom: 16px; margin-right: 16px;">
                                <div class="text fw-bold text-gray-400 fs-8">Selesai</div>
                                <img src="{{ asset('assets/media/svg/profile-account/order-history/down.svg') }}" alt="frame5" style="height: 18px; width: 18px;">
                                </div>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Kolom Kanan --}}
    </div>
    {{-- End Row --}}
</div>
{{-- End Container --}}

@endsection
