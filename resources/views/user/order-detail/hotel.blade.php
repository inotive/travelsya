@extends('layouts.user')

@section('content-user')

<style>
.bg-gradient-merah{
background: rgb(255,238,241);
background: linear-gradient(270deg, rgba(255,238,241,1) 0%, rgba(255,255,255,1) 50%);

}

</style>

{{-- Container --}}
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
                    <a class="menu-link text-gray" href="{{ route('user.profile') }}">
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
                    <a class="menu-link text-gray-900" href="{{ route('user.orderHistory') }}">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/clipboard-active.svg') }}" class="h-24px me-10"/>
                    </span>
                    <span class="menu-title fw-bold text-danger">
                        Riwayat Pesanan</b>
                    </span>
                    </div>
                </a>
                {{-- Menu Item Refund Dan Pembatalan --}}
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
                    <a class="menu-link text-gray-900" href="{{ route('user.help') }}">
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
                    <a class="menu-link text-gray-900" id="kt_docs_sweetalert_basic" href="#">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/log-out.svg') }}" class="h-24px me-10"/>
                    </span>
                        Log out
                        @include('user.logout')
                    </a>
                </div>
                </div>
            </div>
        </div>
        {{-- End Kolom Kiri --}}

        {{-- Kolom Kanan (Form Detail PEsanan) --}}
        <div class="col-12 col-lg-7">
            <div class="card">
                {{-- Card Head --}}
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{-- <div class="card-title"> --}}
                    <div class="d-flex align-items-center">
                    <div class="image-back">
                    <img src="{{ asset('assets/media/svg/profile-account/order-history/down-2.svg') }}" alt="down" style="margin-right: 16px; margin-bottom: 8px;">
                    </div>
                    <div class="h1 fw-bold">
                        Rincian Pesanan
                    </div>
                    </div>
                    <a href="#" class="btn btn-outline btn-outline-danger border border-danger fw-bold" style="padding: 12px 16px 12px 16px; border: 1px;">
                        Berikan Review
                    </a>
                    {{-- </div> --}}
                </div>
                {{-- Card Body --}}
                <div class="card-body">
                    {{-- Row --}}
                    <div class="row">
                        {{-- kolom batas form --}}
                        <div class="col-12">

                        {{-- Bagian checkin checkout --}}
                        <div class="row">
                            <div class="col-12 col-lg-6 col-md-6 mb-4 mb-lg-0">
                                <div class="card border border-1 text-center" style="background: #f4f4f4;">
                                    <div class="info-wrapper-grup" style="padding: 10px 16px 10px 16px;">
                                    <span class="text-gray-400 fs-8" style="margin-bottom: 6px">Checkin</span><br>
                                    <span class="text fs-6 fw-bold" style="margin-bottom: 6px">19 Feb 2022</span><br>
                                    <span class="text fs-8" style="margin-bottom: 6px">10:00 AM</span><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 col-md-6">
                                <div class="card border border-1 text-center" style="background: #f4f4f4;">
                                    <div class="info-wrapper-grup" style="padding: 10px 16px 10px 16px;">
                                    <span class="text-gray-400 fs-8" style="margin-bottom: 6px">Checkout</span><br>
                                    <span class="text fs-6 fw-bold" style="margin-bottom: 6px">19 Feb 2022</span><br>
                                    <span class="text fs-8" style="margin-bottom: 6px">10:00 AM</span><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-12 m-0">
                        {{-- Card-Hotel --}}
                        <div class="card border border-1 mt-5 mb-5">
                            <div style="height: 250px; background: url('https://dynamic-media-cdn.tripadvisor.com/media/photo-o/05/53/0a/5f/maca-villas-spa.jpg?w=700&h=-1&s=1') center/cover no-repeat; border-radius: 8px"></div>
                            <div class="fw-bold fs-4 m-5">
                                Maca Villas And Spa Seminyak
                            </div>
                        </div>
                        </div>
                        {{-- Kolom Kiri --}}
                        <div class="col-12 col-lg-9 col-md-9 mb-5 mb-lg-0 mb-md-0">
                            {{-- Informasi Ruangan --}}
                            <div class="card border border-1 mb-5">
                                <div class="fs-4 fw-bold m-5 mb-0">
                                    Informasi Ruangan
                                </div>
                                    <div class="m-5 d-flex align-items-center">
                                        <div class="symbol symbol-75px">
                                            <img src="{{ url('https://cdn.idntimes.com/content-images/post/20171020/31709655-6d2e73fbe766fd067d3199028adf384f.jpg') }}" alt="">
                                        </div>
                                        <div class="text" style="margin-left: 16px">
                                            <div class="fs-6 fw-bold mb-2">
                                                2x Superior Room
                                            </div>
                                            <div class="fs-8 text-gray-400">
                                                City View | 1x Double Room | 100m2
                                            </div>
                                        </div>
                                    </div>
                                <div class="separator border border-1"></div>
                                <div class="fs-8 text-gray-400 m-5 mb-2">
                                    Benefits
                                </div>
                                <div class="fs-6 m-5 mt-0">
                                    Parking, Wifi, Bathroom, Breakfast
                                </div>
                            </div>
                            {{-- Informasi Tamu --}}
                            <div class="card border border-1 mb-5">
                                <div class="fs-4 fw-bold m-5 mb-0">
                                    Informasi Tamu
                                </div>
                                    <div class="m-5">
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Kepala Tamu</div>
                                            <div class="fs-8 fw-bold">Frederick Octo Ramadani</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Total Tamu</div>
                                            <div class="fs-8 fw-bold">3 Tamu</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Nomor Telepon</div>
                                            <div class="fs-8 fw-bold">081280043549</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Alamat Email</div>
                                            <div class="fs-8 fw-bold">octofrederick@gmail.com</div>
                                        </div>
                                    </div>
                            </div>
                            {{-- Lokasi Hotel --}}
                            <div class="card border border-1 mb-5">
                                {{-- Judul/header --}}
                                <div class="d-flex justify-content-between m-5">
                                    <h3 class="fw-bold">
                                        Lokasi
                                    </h3>
                                    <a href="https://maps.app.goo.gl/W6jC3hgz8v7ocsi16" target="_blank" class="text-danger fw-bold block">
                                        Buka di Map
                                    </a>
                                </div>
                                <div class="d-flex m-5">
                                    <img src="{{ asset('assets/media/svg/profile-account/order-history/map.svg') }}" style="width: 20px; height:20px; margin-right: 16px;"/>
                                    <div class="text-gray-400 fs-8">
                                        Jl. Budi Karya, Benua Melayu Darat, Kecamatan Pontianak Selatan, Kota Pontianak, Kalimantan Barat
                                    </div>
                                </div>
                            </div>
                            {{-- Rincian Pembaayaran --}}
                            <div class="card border border-1 mb-5">
                                <div class="fs-4 fw-bold m-5 mb-0">
                                    Rincian Pembayaran
                                </div>
                                    <div class="m-5">
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Status Transaksi</div>
                                            <div class="fs-8 fw-bold text-success">Selesai</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Tanggal Transaksi</div>
                                            <div class="fs-8 fw-bold">04 Jan 2023 12:04 WIB</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Metode Pembayaran</div>
                                            <div class="fs-8 fw-bold">Virtual Account BCA</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Biaya Hotel</div>
                                            <div class="fs-8 fw-bold">Rp 1.780.000</div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                        {{-- Kolom Kanan --}}
                        <div class="col-12 col-lg-3 col-md-3">
                            <div class="card border border-1">
                                <div class="text-center" style="margin-top: 24px; margin-bottom: 24px;">
                                    <div class="pembungkus mx-sm-10" style="margin-bottom: 24px;">
                                        <img src="{{ asset('assets/media/svg/profile-account/order-history/frame-1.svg') }}" style="width: 48px; height:48px; margin-bottom: 8px;"/>
                                        <div class="text fs-8">E-tiket</div>
                                    </div>
                                    <div class="pembungkus mx-sm-10" style="margin-bottom: 24px;">
                                        <img src="{{ asset('assets/media/svg/profile-account/order-history/frame-2.svg') }}" style="width: 48px; height:48px; margin-bottom: 8px;"/>
                                        <div class="text fs-8">Bukti Pembayaran</div>
                                    </div>
                                    <div class="pembungkus mx-sm-10">
                                        <img src="{{ asset('assets/media/svg/profile-account/order-history/frame-3.svg') }}" style="width: 48px; height:48px; margin-bottom: 8px;"/>
                                        <div class="text fs-8">Hapus Riwayat</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-12">
                                {{-- Total BIaya --}}
                                <div class="card" style="background: #FFEEF1">
                                <div class="pembungkus d-flex justify-content-between">
                                <div class="text fs-4 fw-semibold" style="margin: 16px;">
                                    Total Biaya
                                </div>
                                <div class="text fs-4 fw-bold" style="margin: 16px">
                                    IDR 218,999
                                </div>
                                </div>
                                </div>
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