@extends('layouts.user')

@section('content-user')

{{-- Containre --}}
<div class="container">
    {{-- Row --}}
    <div class="row">

        @include('user.user-navigation')

        {{-- Kolom Kanan (Form Edit Profile) --}}
        <div class="col-12 col-lg-7">
            <div class="card">
                <div class="card-header">
                    <div class="card-title text fw-bold fs-1">
                        Pusat Bantuan
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Pusat --}}
                        <div class="col-12">

                            {{-- <div class="text fw-bold fs-2 mb-5">
                                Artikel Terkait
                            </div> --}}

                            {{-- Accordion --}}
                            <div class="accordion" id="kt_accordion_1">
                                @foreach ($helps as $key => $help)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="kt_accordion_1_header_{{ $key }}">
                                        <button
                                            class="accordion-button fs-4 fw-semibold {{ $key == 0 ? '' : 'collapsed' }}"
                                            type="button" data-bs-toggle="collapse"
                                            data-bs-target="#kt_accordion_1_body_{{ $key }}"
                                            aria-expanded="{{ $key == 0 ? 'true' : 'false' }}"
                                            aria-controls="kt_accordion_1_body_{{ $key }}">
                                            {{ $help->title }}
                                        </button>
                                    </h2>
                                    <div id="kt_accordion_1_body_{{ $key }}"
                                        class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}"
                                        aria-labelledby="kt_accordion_1_header_{{ $key }}"
                                        data-bs-parent="#kt_accordion_1">
                                        <div class="accordion-body">
                                            {!! $help->content !!}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            {{-- <div class="accordion-item">
                                <h2 class="accordion-header" id="kt_accordion_1_header_2">
                                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_2"
                                        aria-expanded="false" aria-controls="kt_accordion_1_body_2">
                                        Dokumen Penerbangan Selama Periode PPKM
                                    </button>
                                </h2>
                                <div id="kt_accordion_1_body_2" class="accordion-collapse collapse"
                                    aria-labelledby="kt_accordion_1_header_2" data-bs-parent="#kt_accordion_1">
                                    <div class="accordion-body">
                                        Ini Isi
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="kt_accordion_1_header_3">
                                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#kt_accordion_1_body_3"
                                        aria-expanded="false" aria-controls="kt_accordion_1_body_3">
                                        Cara Checkin Online
                                    </button>
                                </h2>
                                <div id="kt_accordion_1_body_3" class="accordion-collapse collapse"
                                    aria-labelledby="kt_accordion_1_header_3" data-bs-parent="#kt_accordion_1">
                                    <div class="accordion-body">
                                        Ini Isi
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- ENd Accordion --}}

                        {{-- <br><br><br> --}}

                        {{-- Accordion-2 --}}
                        {{-- @foreach ($helps as $help)
                        <div class="accordion accordion-flush" id="kt_accordion_2">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="kt_accordion_2_header_{{ $help->id }}">
                                    <button class="accordion-button fs-4 fw-semibold collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#kt_accordion_2_body_{{ $help->id }}"
                                        aria-expanded="false" aria-controls="kt_accordion_2_body_{{ $help->id }}">
                                        {{ $help->title }}
                                    </button>
                                </h2>
                                <div id="kt_accordion_2_body_{{ $help->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="kt_accordion_2_header_{{ $help->id }}"
                                    data-bs-parent="#kt_accordion_2">
                                    <div class="accordion-body">
                                        {!! $help->content !!}
                                        <div class="list-group list-group-flush">
                                            <a href="#" class="list-group-item list-group-item-action">Cara Reschedule
                                                Tiket Pesawat</a>
                                            <a href="#" class="list-group-item list-group-item-action">Dokumen
                                                perjalanan penerbangan selama periode PPKM</a>
                                            <a href="#" class="list-group-item list-group-item-action">Cara Membatalkan
                                                Dan Refund Tiket Pesawat</a>
                                            <a href="#" class="list-group-item list-group-item-action">Cara Koreksi Nama
                                                Penumpang Pesawat</a>
                                            <a href="#" class="list-group-item list-group-item-action">Informasi Terbaru
                                                Kebijakan Maskapai Terkait Coronavirus</a>
                                            <a href="#" class="list-group-item list-group-item-action">Cara Checkin
                                                Online</a>
                                            <a href="#" class="list-group-item list-group-item-action">Refund PayLater
                                                Akibat COVID-19</a>
                                            <a href="#" class="list-group-item list-group-item-action">Konfirmasi dan
                                                Verifikasi Pembayaran</a>
                                            <a href="#" class="list-group-item list-group-item-action">Cara Cek Status
                                                Refund</a>
                                            <a href="#" class="list-group-item list-group-item-action">Janji Refund
                                                Travelsya</a>
                                            <a href="#" class="list-group-item list-group-item-action">Ketentuan Refund
                                                dan Reschedule Kereta Api Selama Periode PPKM</a>
                                            <a href="#" class="list-group-item list-group-item-action">Cara Memesan
                                                Tiket Di Travelsya</a>
                                            <a href="#" class="list-group-item list-group-item-action">Cara Hacking
                                                Pesawat Boeing 737-8 Max</a>
                                            <a href="#" class="list-group-item list-group-item-action">Apakah Benar
                                                Prabowo Yang Menang Pilpres?</a>
                                            <a href="#" class="list-group-item list-group-item-action">10 Fakta
                                                Mengejutkan Yang Bakal Buat Kamu Ketar Ketir</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach --}}
                        {{-- ENd Accordion --}}

                        {{-- Info Penting Lainnya --}}

                        {{-- <div class="text fw-bold fs-2 mt-10 mb-5">
                            Info Penting Lainnya
                        </div>
                        <div class="mb-5 hover-scroll-x">
                            <div class="d-grid">
                                <ul class="nav nav-tabs flex-nowrap text-nowrap">
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                            data-bs-toggle="tab" href="#kt_tab_pane_1">tiket PayLater Powered By
                                            IndoDana</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                            data-bs-toggle="tab" href="#kt_tab_pane_2">tiket FLEXI</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link btn btn-active-light btn-color-gray-600 btn-active-color-primary rounded-bottom-0"
                                            data-bs-toggle="tab" href="#kt_tab_pane_3">Pencocokan Travelsya x Blibli</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade" id="kt_tab_pane_1" role="tabpanel">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="d-flex">
                                            <div class="image">
                                                <img src="{{ asset('assets/media/svg/products-categories/icon-wallet.png') }}"
                                                    alt="" style="margin-right: 20px">
                                            </div>
                                            <div class="pembungkus">
                                                <div class="text fw-bold fs-4 mb-2">
                                                    Informasi Tiket PayLater By IndoDana
                                                </div>
                                                <div class="text">
                                                    Butuh healing secepatnya tapi budget liburan belum cukup? Amankan
                                                    pemesanan kamu tanpa perlu membayar penuh secara langsung dengan
                                                    tiket PayLater by Indodana!
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/media/svg/profile-account/order-history/Frame1.svg') }}"
                                                alt="" class="image" style="margin-right: 20px">
                                            <div class="pembungkus">
                                                <div class="text fw-bold fs-4 mb-2">
                                                    Tiket FLEXI Hotel
                                                </div>
                                                <div class="text">
                                                    Mau nginep di hotel, tapi bingung nentuin tanggal yang pas? Tenang,
                                                    karena ada tiket FLEXI yang bisa menjadi solusi atas kegalauan kamu.
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/media/svg/profile-account/order-history/Frame5.svg') }}"
                                                alt="" class="image" style="margin-right: 20px">
                                            <div class="pembungkus">
                                                <div class="text fw-bold fs-4 mb-2">
                                                    Tiket FLEXI To Do
                                                </div>
                                                <div class="text">
                                                    Butuh liburan dan hiburan, tapi bingung nentuin tanggal yang pas
                                                    biar aman? Dengan tiket FLEXI, beli tiket To Do di tiket.com nggak
                                                    perlu galau soal tanggal lagi.
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/media/svg/profile-account/order-history/Frame1.svg') }}"
                                                alt="" class="image" style="margin-right: 20px">
                                            <div class="pembungkus">
                                                <div class="text fw-bold fs-4 mb-2">
                                                    Bla Bla 1
                                                </div>
                                                <div class="text">
                                                    Ini Isi
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="d-flex">
                                            <img src="{{ asset('assets/media/svg/profile-account/order-history/Frame5.svg') }}"
                                                alt="" class="image" style="margin-right: 20px">
                                            <div class="pembungkus">
                                                <div class="text fw-bold fs-4 mb-2">
                                                    Bla Bla
                                                </div>
                                                <div class="text">
                                                    Ini Isi
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
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
