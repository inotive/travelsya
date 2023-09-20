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
                    <a class="menu-link text-gray-900" href="#">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/user-nonactive.svg') }}" class="h-24px me-10"/>
                    </span>
                    <span class="menu-title">
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
                    <span class="menu-title text-danger fw-bold">
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
                        Maca Villas and Spa Seminyak
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
                        <div class="row" style="margin-bottom: 24px;">
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

                        {{-- Bagian Image & Detail--}}
                        <div class="row" style="margin-bottom: 24px">
                            <div class="col-12">
                            <div class="card border border-1">
                                <div class="card-body">
                                <img class="img-fluid" src="{{ url('https://cf.bstatic.com/xdata/images/hotel/max1024x768/270953844.jpg?k=6501b596647e6b7d96f194d6c0775882cfd8b1294879d9e97ade7691b0bf3429&o=&hp=1') }}" alt="gambar-hotel">
                                <div class="text fs-4 fw-bold text-danger">

                                </div>

                                    {{-- Detail Kamar --}}
                                    <div class="card border mt-5" style="background:  #FFEEF1">
                                    <div class="m-2 fs-4 fw-bold">
                                        Detail Kamar
                                    </div>
                                    </div>
                                    <div class="card border mt-2">
                                        <div class="d-flex m-5 flex-column">
                                            <div class="d-flex justify-content-between">
                                                <div class="text">
                                                    Jenis Produk
                                                </div>
                                                <div class="text fw-bold text-end">
                                                    Hotel
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="text">
                                                    Nama Hotel
                                                </div>
                                                <div class="text fw-bold text-end">
                                                    Maca Villas and Spa Seminyak
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="text">
                                                    Tipe Room
                                                </div>
                                                <div class="text fw-bold text-end">
                                                    Deluxe
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="text">
                                                    Jumlah Room
                                                </div>
                                                <div class="text fw-bold text-end">
                                                    2
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <div class="text">
                                                    Room Size
                                                </div>
                                                <div class="text fw-bold text-end">
                                                    100m2
                                                </div>
                                            </div>
                                            {{-- <div class="d-flex justify-content-between">
                                                <div class="text">
                                                    Facilities
                                                </div>
                                                <div class="text fw-bold text-end">
                                                    Wifi | Breakfast | Shower
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>

                                    {{-- Detail Fasilitas --}}
                                    <div class="card border mt-5" style="background:  #FFEEF1">
                                    <div class="m-2 fs-4 fw-bold">
                                        Detail Fasilitas
                                    </div>
                                    </div>
                                    <div class="card border mt-2">
                                        <div class="d-flex justify-content-between m-5">
                                            <div class="text">
                                                Wifi <br>
                                                Shower <br>
                                                Breakfast<br>
                                                Dinner
                                            </div>
                                            <div class="text text-end fw-bold">
                                                <div class="text-success">
                                                    Ya <br>
                                                    Ya <br>
                                                    Ya <br>
                                                </div>
                                                <div class="text-danger">
                                                    Tidak
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Detail Tamu --}}
                                    <div class="card border mt-5" style="background:  #FFEEF1">
                                    <div class="m-2 fs-4 fw-bold">
                                        Detail Pemesan
                                    </div>
                                    </div>
                                    <div class="card border mt-2">
                                        <div class="d-flex justify-content-between m-5">
                                            <div class="kiri">
                                                Nama <br>
                                                Email <br>
                                                Jumlah Tamu<br>
                                            </div>
                                            <div class="kanan text-end fw-bold">
                                                Frederick Octo Ramadani <br>
                                                octofrederick@gmail.com<br>
                                                2 Dewasa<br>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Detail Pembayaran --}}
                                    <div class="card border mt-5" style="background:  #FFEEF1">
                                        <div class="m-2 fs-4 fw-bold">
                                            Detail Pembayaran
                                        </div>
                                    </div>
                                    <div class="card border mt-2">
                                        <div class="d-flex justify-content-between m-5">
                                            <div class="kiri">
                                                Metode Pembayaran <br>
                                                Pembayaran<br>
                                                Status
                                            </div>
                                            <div class="kanan text-end fw-bold">
                                                Bank Transfer <br>
                                                BCA Transfer<br>
                                                <div class="text-success">
                                                    Sukses
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            </div>
                        </div>

                        <div class="row" style="margin-bottom: 16px">
                            {{-- Kolom Kiri (Map)Map --}}
                            <div class="col-12 col-lg-9 col-md-9 mb-5 mb-lg-0 mb-md-0">
                                <div class="card border border-1">
                                {{-- Judul/header --}}
                                <div class="d-flex justify-content-between" style="margin: 24px 24px 24px 24px;">
                                <h3 class="fw-bold">
                                    Lokasi
                                </h3>
                                <a href="https://maps.app.goo.gl/W6jC3hgz8v7ocsi16" target="_blank" class="text-danger fw-bold block">
                                    Buka di Map
                                </a>
                                </div>
                                {{-- Link Map --}}
                                {{-- <img src="{{ url('https://cf.bstatic.com/xdata/images/hotel/max1024x768/270953844.jpg?k=6501b596647e6b7d96f194d6c0775882cfd8b1294879d9e97ade7691b0bf3429&o=&hp=1') }}" style="margin-bottom: 16px; margin-left:24px; margin-right:24px; height:167px;"> --}}
                                {{-- Lokasi --}}
                                <div class="d-flex" style="margin-bottom: 24px; margin-left: 24px; margin-right: 24px;">
                                    <img src="{{ asset('assets/media/svg/profile-account/order-history/map.svg') }}" style="width: 20px; height:20px; margin-right: 16px;"/>
                                    <div class="text-gray-400 fs-8">
                                        Jl. Budi Karya, Benua Melayu Darat, Kecamatan Pontianak Selatan, Kota Pontianak, Kalimantan Barat
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
