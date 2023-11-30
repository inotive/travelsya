@extends('layouts.user')

@section('content-user')
    <style>
        .bg-gradient-merah {
            background: rgb(255, 238, 241);
            background: linear-gradient(270deg, rgba(255, 238, 241, 1) 0%, rgba(255, 255, 255, 1) 50%);

        }
    </style>

    {{-- Containre --}}
    <div class="container">
        {{-- Row --}}
        <div class="row">
            {{-- Kolom Kiri (Menu) --}}
            @include('user.user-navigation')
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
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a id="pills-semua-tab" data-bs-toggle="pill" data-bs-target="#pills-semua"
                                            role="tab" aria-controls="pills-semua" aria-selected="true"
                                            class="nav-link btn btn-light-danger py-1 text-bold px-4 border border-1 rounded-pill fw-bold border-danger active">
                                            Semua
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="pills-aktif-tab" data-bs-toggle="pill" data-bs-target="#pills-aktif"
                                            role="tab" aria-controls="pills-aktif" aria-selected="false"
                                            class="nav-link btn btn-light-danger py-1 text-bold px-4 border border-1 rounded-pill fw-bold border-danger">
                                            Pesanan Aktif
                                        </a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a id="pills-riwayat-tab" data-bs-toggle="pill" data-bs-target="#pills-riwayat"
                                            role="tab" aria-controls="pills-riwayat" aria-selected="false"
                                            class="nav-link btn btn-light-danger py-1 text-bold px-4 border border-1 rounded-pill fw-bold border-danger">
                                            Riwayat
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade pills-semua active show" id="pills-semua" role="tabpanel"
                                        aria-labelledby="pills-semua-tab" tabindex="0">
                                        {{-- Card Pertama Revisi --}}
                                        @foreach ($all_transactions as $all)
                                            @php
                                                if ($all->service_id == 8 ) {
                                                    $route = route('profile.order-detail.hotel', $all->id);
                                                } elseif ( $all->service_id == 7){
                                                    $route = route('profile.order-detail.hostel', $all->id);
                                                } elseif ($all->service_id == 12 || $all->service_id == 1 || $all->service_id == 11) {
                                                    $route = route('profile.order-detail.listrik-voucher', $all->id);
                                                } else {
                                                    $route = route('profile.order-detail.listrik', $all->id);
                                                }
                                            @endphp
                                            <div class="card border border-1 mt-5 bg-gradient-merah cursor-pointer"
                                                style="" onclick="window.location.href = '{{ $route }}';">
                                                <div class="d-flex justify-content-between m-5">
                                                    <div class="text-gray-400 fw-bold">
                                                        {{ Str::ucfirst($all->service) }}
                                                    </div>
                                                    @php

                                                        if ($all->status == 'PENDING') {
                                                            $text_color = 'badge badge-warning';
                                                            $text = 'Menunggu Pembayaran';
                                                        }

                                                        if ($all->status == 'PAID') {
                                                            $text_color = 'badge badge-success';
                                                            $text = 'Lunas';
                                                        }

                                                        if ($all->status == 'Transaksi Gagal') {
                                                            $text_color = 'badge badge-danger';
                                                            $text = 'Transaksi Gagal';
                                                        }

                                                        if ($all->status == 'EXPIRED') {
                                                            $text_color = 'badge badge-danger';
                                                            $text = 'Transaksi Kadaluarsa';
                                                        }

                                                    @endphp
                                                    <div class="{{ $text_color }} fw-bold">
                                                        {{ Str::ucfirst($text) }}
                                                    </div>
                                                </div>
                                                <div class="separator border border-1"
                                                    style="margin-bottom: 16px; margin-left: 16px; margin-right: 16px;">
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center m-5">
                                                    <div class="kiri d-flex">
                                                        @if ($all->service_id == 8)
                                                            <div class="symbol symbol-40px">
                                                                <img src="{{ asset('assets/media/products-categories/icon-hotel.png') }}"
                                                                    alt="frame5">
                                                            </div>
                                                        @elseif($all->service_id == 7)
                                                            <div class="symbol symbol-40px">
                                                                <img src="{{ asset('assets/media/products-categories/icon-hostel.png') }}"
                                                                    alt="frame5">
                                                            </div>
                                                        @elseif($all->service_id == 3)
                                                            <div class="symbol symbol-40px">
                                                                <img src="{{ asset('assets/media/products-categories/icon-pln.png') }}"
                                                                    alt="frame5">
                                                            </div>
                                                        @elseif ($all->service_id == 1 || $all->service_id == 2)
                                                            <div class="symbol symbol-40px">
                                                                <img src="{{ asset('assets/media/products-categories/icon-pulsa.png') }}"
                                                                    alt="frame5">
                                                            </div>
                                                        @elseif ($all->service_id == 11)
                                                            <div class="symbol symbol-40px">
                                                                <img src="{{ asset('assets/media/products-categories/icon-wallet.png') }}"
                                                                    alt="frame5">
                                                            </div>
                                                        @else
                                                            <div class="symbol symbol-40px">
                                                                <img src="{{ asset('assets/media/products-categories/icon-bpjs.png') }}"
                                                                    alt="frame5">
                                                            </div>
                                                        @endif
                                                        <div class="d-flex flex-column" style=" margin-left: 16px">
                                                            <a href="#"
                                                                class="text-gray-900 text-hover-primary fs-6 fw-bold"
                                                                style="margin-bottom: 8px">
                                                                @if (in_array($all->service_id, [11]))
                                                                    {{ $all->name_topup }}
                                                                @endif

                                                                @if (in_array($all->service_id, [7]))
                                                                    {{ $all->name_hostel }}
                                                                @endif

                                                                @if (in_array($all->service_id, [8]))
                                                                    {{ $all->name_hotel }}
                                                                @endif
                                                            </a>
                                                            <span class="text-gray-400" style="margin-bottom: 6px">
                                                                {{ $all->no_inv }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="kanan">
                                                        <div class="panah">
                                                            <img src="{{ asset('assets/media/svg/profile-account/order-history/down.svg') }}"
                                                                alt="frame5" style="height: 18px; width: 18px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $originalDate = $all->created_at;
                                                    $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $originalDate);
                                                    $formattedDate = $date->format('l, d M Y H:i') . ' WITA';
                                                @endphp
                                                <div class="separator border border-1"
                                                    style="margin-bottom: 16px; margin-left: 16px; margin-right: 16px;">
                                                </div>
                                                <div class="bagian-bawah-kiri d-block"
                                                    style="margin-left: 16px; margin-bottom: 16px; margin-right: 16px;">
                                                    <div class="text-gray-400 fs-8">{{ $formattedDate }}</div>
                                                    <div style="margin-top: 8px;" class="text fs-4 fw-bold">IDR
                                                        {{ number_format($all->total, 0, ',', '.') }}</div>
                                                </div>
                                            </div>
                                        @endforeach

                                        {{-- Card Kedua Revisi --}}
                                        {{-- <div class="card border border-1 mt-5 bg-gradient-merah" style="">
                                        <div class="d-flex justify-content-between m-5">
                                            <div class="text-gray-400 fw-bold">Hotel</div>
                                            <div class="text-danger fw-bold">Menunggu Pembayaran</div>
                                        </div>
                                        <div class="separator border border-1"
                                            style="margin-bottom: 16px; margin-left: 16px; margin-right: 16px;"></div>
                                        <div class="d-flex justify-content-between align-items-center m-5">
                                            <div class="kiri d-flex">
                                                <div class="symbol symbol-40px">
                                                    <img src="{{ asset('assets/media/svg/profile-account/order-history/Frame1.svg') }}"
                                                        alt="frame5">
                                                </div>
                                                <div class="d-flex flex-column" style=" margin-left: 16px">
                                                    <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold"
                                                        style="margin-bottom: 8px">MACA VILLAS and SPA Seminyak</a>
                                                    <span class="text-gray-400" style="margin-bottom: 6px">2 Superior
                                                        Room | 2 Night</span>
                                                </div>
                                            </div>
                                            <div class="kanan">
                                                <div class="panah">
                                                    <img src="{{ asset('assets/media/svg/profile-account/order-history/down.svg') }}"
                                                        alt="frame5" style="height: 18px; width: 18px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="separator border border-1"
                                            style="margin-bottom: 16px; margin-left: 16px; margin-right: 16px;"></div>
                                        <div class="d-flex justify-content-between">
                                            <div class="bagian-bawah-kiri d-block"
                                                style="margin-left: 16px; margin-bottom: 16px; margin-right: 16px;">
                                                <div class="text-gray-400 fs-8">Menunggu Pembayaran</div>
                                                <div style="margin-top: 8px;" class="text fs-4 fw-bold">IDR 218,999
                                                </div>
                                            </div>
                                            <div class="bagian-bawah-kanan" style="margin-right: 16px">
                                                <a href="#" class="btn btn-danger">
                                                    Bayar
                                                </a>
                                            </div>
                                        </div>
                                    </div> --}}
                                    </div>
                                    <div class="tab-pane fade pills-aktif" id="pills-aktif" role="tabpanel"
                                        aria-labelledby="pills-aktif-tab" tabindex="0">
                                        {{-- Card Kedua Revisi --}}
                                        {{-- <div class="card border border-1 mt-5 bg-gradient-merah" style="">
                                        <div class="d-flex justify-content-between m-5">
                                            <div class="text-gray-400 fw-bold">Hotel</div>
                                            <div class="text-danger fw-bold">Menunggu Pembayaran</div>
                                        </div>
                                        <div class="separator border border-1"
                                            style="margin-bottom: 16px; margin-left: 16px; margin-right: 16px;"></div>
                                        <div class="d-flex justify-content-between align-items-center m-5">
                                            <div class="kiri d-flex">
                                                <div class="symbol symbol-40px">
                                                    <img src="{{ asset('assets/media/svg/profile-account/order-history/Frame1.svg') }}"
                                                        alt="frame5">
                                                </div>
                                                <div class="d-flex flex-column" style=" margin-left: 16px">
                                                    <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold"
                                                        style="margin-bottom: 8px">MACA VILLAS and SPA Seminyak</a>
                                                    <span class="text-gray-400" style="margin-bottom: 6px">2 Superior
                                                        Room | 2 Night</span>
                                                </div>
                                            </div>
                                            <div class="kanan">
                                                <div class="panah">
                                                    <img src="{{ asset('assets/media/svg/profile-account/order-history/down.svg') }}"
                                                        alt="frame5" style="height: 18px; width: 18px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="separator border border-1"
                                            style="margin-bottom: 16px; margin-left: 16px; margin-right: 16px;"></div>
                                        <div class="d-flex justify-content-between">
                                            <div class="bagian-bawah-kiri d-block"
                                                style="margin-left: 16px; margin-bottom: 16px; margin-right: 16px;">
                                                <div class="text-gray-400 fs-8">Menunggu Pembayaran</div>
                                                <div style="margin-top: 8px;" class="text fs-4 fw-bold">IDR 218,999
                                                </div>
                                            </div>
                                            <div class="bagian-bawah-kanan" style="margin-right: 16px">
                                                <a href="#" class="btn btn-danger">
                                                    Bayar
                                                </a>
                                            </div>
                                        </div>
                                    </div> --}}
                                        @foreach ($pending_transactions as $pending)
                                            @php
                                                if ($pending->service_id == 7 || $pending->service_id == 8) {
                                                    $routePending = route('profile.order-detail.hotel', $pending->id);
                                                } elseif ($pending->service_id == 12 || $pending->service_id == 1 || $pending->service_id == 11) {
                                                    $routePending = route('profile.order-detail.listrik-voucher', $pending->id);
                                                } else {
                                                    $routePending = route('profile.order-detail.listrik', $pending->id);
                                                }
                                            @endphp
                                            <div class="card border border-1 mt-5 bg-gradient-merah cursor-pointer"
                                                style="" onclick="window.location.href = '{{ $routePending }}';">
                                                <div class="d-flex justify-content-between m-5">
                                                    <div class="text-gray-400 fw-bold">
                                                        {{ Str::ucfirst($pending->service) }}
                                                    </div>
                                                    <div class="badge badge-warning fw-bold">
                                                        Menunggu Pembayaran
                                                    </div>
                                                </div>
                                                <div class="separator border border-1"
                                                    style="margin-bottom: 16px; margin-left: 16px; margin-right: 16px;">
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center m-5">
                                                    <div class="kiri d-flex">
                                                        <div class="symbol symbol-40px">
                                                            <img src="{{ asset('assets/media/svg/profile-account/order-history/Frame1.svg') }}"
                                                                alt="frame5">
                                                        </div>

                                                        <div class="d-flex flex-column" style=" margin-left: 16px">
                                                            <a href="#"
                                                                class="text-gray-900 text-hover-primary fs-6 fw-bold"
                                                                style="margin-bottom: 8px">
                                                                @if (in_array($pending->service_id, [11]))
                                                                    {{ $pending->name_topup }}
                                                                @endif

                                                                @if (in_array($pending->service_id, [7]))
                                                                    {{ $pending->name_hostel }}
                                                                @endif

                                                                @if (in_array($pending->service_id, [8]))
                                                                    {{ $pending->name_hotel }}
                                                                @endif
                                                            </a>
                                                            <span class="text-gray-400" style="margin-bottom: 6px">
                                                                {{ $pending->no_inv }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="kanan">
                                                        <div class="panah">
                                                            <img src="{{ asset('assets/media/svg/profile-account/order-history/down.svg') }}"
                                                                alt="frame5" style="height: 18px; width: 18px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $originalDate = $pending->created_at;
                                                    $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $originalDate);
                                                    $formattedDate = $date->format('l, d M Y H:i') . ' WITA';
                                                @endphp
                                                <div class="separator border border-1"
                                                    style="margin-bottom: 16px; margin-left: 16px; margin-right: 16px;">
                                                </div>
                                                <div class="bagian-bawah-kiri d-block"
                                                    style="margin-left: 16px; margin-bottom: 16px; margin-right: 16px;">
                                                    <div class="text-gray-400 fs-8">{{ $formattedDate }}</div>
                                                    <div style="margin-top: 8px;" class="text fs-4 fw-bold">IDR
                                                        {{ number_format($pending->total, 0, ',', '.') }}</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade pills-riwayat" id="pills-riwayat" role="tabpanel"
                                        aria-labelledby="pills-riwayat-tab" tabindex="0">
                                        {{-- Card Pertama Revisi --}}
                                        {{-- <div class="card border border-1 mt-5 bg-gradient-merah" style="">
                                        <div class="d-flex justify-content-between m-5">
                                            <div class="text-gray-400 fw-bold">Hotel</div>
                                            <div class="text-success fw-bold">Selesai</div>
                                        </div>
                                        <div class="separator border border-1"
                                            style="margin-bottom: 16px; margin-left: 16px; margin-right: 16px;"></div>
                                        <div class="d-flex justify-content-between align-items-center m-5">
                                            <div class="kiri d-flex">
                                                <div class="symbol symbol-40px">
                                                    <img src="{{ asset('assets/media/svg/profile-account/order-history/Frame5.svg') }}"
                                                        alt="frame5">
                                                </div>
                                                <div class="d-flex flex-column" style=" margin-left: 16px">
                                                    <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold"
                                                        style="margin-bottom: 8px">MEISO KELAPA GADING</a>
                                                    <span class="text-gray-400" style="margin-bottom: 6px">Reflexology
                                                        30 Menit</span>
                                                </div>
                                            </div>
                                            <div class="kanan">
                                                <div class="panah">
                                                    <img src="{{ asset('assets/media/svg/profile-account/order-history/down.svg') }}"
                                                        alt="frame5" style="height: 18px; width: 18px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="separator border border-1"
                                            style="margin-bottom: 16px; margin-left: 16px; margin-right: 16px;"></div>
                                        <div class="bagian-bawah-kiri d-block"
                                            style="margin-left: 16px; margin-bottom: 16px; margin-right: 16px;">
                                            <div class="text-gray-400 fs-8">Minggu, 01 Des 2022 14:00 WIB</div>
                                            <div style="margin-top: 8px;" class="text fs-4 fw-bold">IDR 218,999</div>
                                        </div>
                                    </div> --}}
                                        @foreach ($history_transactions as $history)
                                            @php
                                                if ($history->service_id == 7 || $history->service_id == 8) {
                                                    $routeHistory = route('profile.order-detail.hotel', $history->id);
                                                } elseif ($history->service_id == 12 || $history->service_id == 1 || $history->service_id == 11) {
                                                    $routeHistory = route('profile.order-detail.listrik-voucher', $history->id);
                                                } else {
                                                    $routeHistory = route('profile.order-detail.listrik', $history->id);
                                                }
                                            @endphp
                                            <div class="card border border-1 mt-5 bg-gradient-merah cursor-pointer"
                                                onclick="window.location.href = '{{ $routeHistory }}';" style="">
                                                <div class="d-flex justify-content-between m-5">
                                                    <div class="text-gray-400 fw-bold">
                                                        {{ Str::ucfirst($history->service) }}
                                                    </div>
                                                    <div class="text-success fw-bold">
                                                        Berhasil
                                                    </div>
                                                </div>
                                                <div class="separator border border-1"
                                                    style="margin-bottom: 16px; margin-left: 16px; margin-right: 16px;">
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center m-5">
                                                    <div class="kiri d-flex">
                                                        <div class="symbol symbol-40px">
                                                            <img src="{{ asset('assets/media/svg/profile-account/order-history/Frame1.svg') }}"
                                                                alt="frame5">
                                                        </div>
                                                        <div class="d-flex flex-column" style=" margin-left: 16px">
                                                            <a href="#"
                                                                class="text-gray-900 text-hover-primary fs-6 fw-bold"
                                                                style="margin-bottom: 8px">
                                                                @if (in_array($history->service_id, [11]))
                                                                    {{ $history->name_topup }}
                                                                @endif

                                                                @if (in_array($history->service_id, [7]))
                                                                    {{ $history->name_hostel }}
                                                                @endif

                                                                @if (in_array($history->service_id, [8]))
                                                                    {{ $history->name_hotel }}
                                                                @endif
                                                            </a>
                                                            <span class="text-gray-400" style="margin-bottom: 6px">
                                                                {{ $history->no_inv }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="kanan">
                                                        <div class="panah">
                                                            <img src="{{ asset('assets/media/svg/profile-account/order-history/down.svg') }}"
                                                                alt="frame5" style="height: 18px; width: 18px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $originalDate = $history->created_at;
                                                    $date = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $originalDate);
                                                    $formattedDate = $date->format('l, d M Y H:i') . ' WITA';
                                                @endphp
                                                <div class="separator border border-1"
                                                    style="margin-bottom: 16px; margin-left: 16px; margin-right: 16px;">
                                                </div>
                                                <div class="bagian-bawah-kiri d-block"
                                                    style="margin-left: 16px; margin-bottom: 16px; margin-right: 16px;">
                                                    <div class="text-gray-400 fs-8">{{ $formattedDate }}</div>
                                                    <div style="margin-top: 8px;" class="text fs-4 fw-bold">IDR
                                                        {{ number_format($history->total, 0, ',', '.') }}</div>
                                                </div>
                                            </div>
                                        @endforeach
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
