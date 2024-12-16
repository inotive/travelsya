@extends('layouts.app_v2')

@push('add-style')
<style>
    /* @import url('https://fonts.googleapis.com/css?family=Chivo:300,300i,400,400i,700,700i,900,900i|Saira+Extra+Condensed:100,200,300,400,500,600,700,800|Saira:100,200,300,400,500,600,700,800');

        .timeline {
            position: relative;
            margin-top: 15px;
            margin: 0;
        }

        .timeline::after {
            content: '';
            position: absolute;
            width: 2px;
            background-color: #ddd;
            top: 0;
            bottom: 0;
            left: 10px;
        }

        .timeline-row {
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 10px 6px;
            position: relative;
            background-color: inherit;
        }

        .timeline-row::after {
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: white;
            border: 2px solid #ff9f55;
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }

        .timeline-time {
            font-size: 16px;
            font-weight: bold;
            margin-left: 15px;
        }

        .timeline-location {
            flex-grow: 1;
            padding-left: 10px;
        }

        .timeline-location:first-child {
            border-left: none;
            padding-left: 0;
        }*/
</style>
@endpush

@section('content')
@include('pagesv2.bus_travel.partials._second_nav')

<div class="container my-5 mb-50">
    <div class="btn-group w-100 mb-35px" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">

        <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#health_tab">Detail</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#beauty_tab">Syarat & Ketentuan</a>
            </li>
        </ul>

    </div>

    <div class="card shadow-sm mb-35px">
        <div class="card-body">
            <div class="row">
                <div class="col-4">
                    <img src="" class="object-fit-contain w-100" alt="..."
                        onerror="this.src='https://images.unsplash.com/photo-1618805154647-7d89ac05926b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'">
                </div>
                <div class="col-8 d-flex flex-column">
                    <div class="d-flex flex-row align-items-center">
                        <div>
                            <span class="fw-bold">Cititrans</span><br>
                            <small>Shuttle Toyota Hiace</small>
                        </div>
                        <div class="ms-2">
                            <span><i class="fa-solid fa-star text-warning"></i></span>
                            <span class="ms-1"><span class="fw-bold">4.8</span>/5</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row p-2">
                        <div class="col-3">
                            <span><i class="fa-solid fa-suitcase"></i></span>
                            <span class="ms-2">Kapasitas 8 Kursi</span>
                        </div>
                        <div class="col-3">
                            <span><i class="fa-solid fa-user"></i></span>
                            <span class="ms-2">Peraturan kuris 1-1</span>
                        </div>
                        <div class="col-3">
                            <span><i class="fa-solid fa-user"></i></span>
                            <span class="ms-2">Full AC</span>
                        </div>
                        <div class="col-3">
                            <span><i class="fa-solid fa-user"></i></span>
                            <span class="ms-2">Kursi recliner</span>
                        </div>
                        <div class="col-3">
                            <span><i class="fa-solid fa-suitcase"></i></span>
                            <span class="ms-2">Colokan USB</span>
                        </div>
                        <div class="col-3">
                            <span><i class="fa-solid fa-user"></i></span>
                            <span class="ms-2">Lampu baca</span>
                        </div>
                        <div class="col-3">
                            <span><i class="fa-solid fa-user"></i></span>
                            <span class="ms-2">Alat pemadam</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-35px">
        <span class="title fw-bold">Rute Perjalanan</span>
    </div>
    <div class="card shadow-sm rounded-4 overflow-hidden mb-35px">
        <div class="rounded-circle position-absolute"
            style="background-color: #FFEEF1; width:100px; height:100px; top: -50px; right: -40px;">
        </div>
        <div class="rounded-circle position-absolute"
            style="background-color: #FFBDBE; width:25px; height:25px; top: 35px; right: -10px;">
        </div>
        <div class="card">
            <div class="card-body p-5">
                <div class="d-flex mt-3">
                    <div class="d-flex flex-column">
                        <strong>08:00</strong>
                        <span>12 Des</span>
                        <div class="text-secondary-strong my-5">
                            3 Jam
                        </div>
                        <strong>11:05</strong>
                        <span>12 Des</span>
                    </div>
                    <div class="d-flex ms-3 flex-column justify-content-between lined">
                        <i class="fa-solid fa-circle-dot text-danger mt-1 z-index-1"></i>
                        <div></div>
                        <div></div>
                        <div></div>
                        <i class="fa-solid fa-circle mb-1 z-index-1"></i>
                    </div>
                    <div class="d-flex ms-3 flex-column justify-content-between">
                        <div class="d-flex flex-column">
                            <strong>Padang</strong>
                            <span>Bypass Padang</span>
                        </div>
                        <div></div>
                        <div class="d-flex flex-column">
                            <strong>Bukittinggi</strong>
                            <span>Terminal Aur Kuning</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-35px">
        <span class="title fw-bold">Kamu Harus Tau</span>
    </div>
    <div class="card shadow mb-35px">
        <div class="card-body">
            <ul>
                <li>E-tiket akan tersedia di halaman Your Orders dan dikirim ke emailmu setelah pembayaran selesai</li>
                <li>Sebelum naik, tunjukkan e-tiket ke petugas bus/travel untuk ditukar dengan tiket fisik</li>
                <li>Siapkan kartu identitas berlaku. Petugas bus/travel mungkin memerlukannya untuk memverifikasi
                    penumpang</li>
            </ul>
        </div>
    </div>
    <hr class="mb-35px" style="border-top: 2px dashed #777;">
    <div class="card shadow rouded-4 mb-35px">
        <div class="card-body d-flex flex-row align-items-center justify-content-between">
            <span class="fs-2 text-danger">IDR 230.000</span>
            <button class="btn btn-danger" id="kursi_button" data-bs-toggle="modal" data-bs-target="#modal_kursi">Pilih
                Kursi</button>
        </div>
    </div>

    @include('pagesv2.bus_travel.partials.components._modal_kursi')
</div>
@endsection