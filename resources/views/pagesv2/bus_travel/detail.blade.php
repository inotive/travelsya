@extends('layouts.app_v2')

@push('add-style')
    <style>
        /* @import url('https://fonts.googleapis.com/css?family=Chivo:300,300i,400,400i,700,700i,900,900i|Saira+Extra+Condensed:100,200,300,400,500,600,700,800|Saira:100,200,300,400,500,600,700,800');

                                                                                                                                            .timeline {
                                                                                                                                                border-left: 4px solid #004ffc;
                                                                                                                                                border-bottom-right-radius: 4px;
                                                                                                                                                border-top-right-radius: 4px;
                                                                                                                                                background: white;
                                                                                                                                                color: white;
                                                                                                                                                font-family: 'Chivo', sans-serif;
                                                                                                                                                margin: 50px auto;
                                                                                                                                                letter-spacing: 0.5px;
                                                                                                                                                position: relative;
                                                                                                                                                line-height: 1.4em;
                                                                                                                                                font-size: 1.03em;
                                                                                                                                                padding: 50px;
                                                                                                                                                list-style: none;
                                                                                                                                                text-align: left;
                                                                                                                                                font-weight: 100;
                                                                                                                                                max-width: 30%;

                                                                                                                                                h1 {
                                                                                                                                                    font-family: 'saira', sans-serif;
                                                                                                                                                    letter-spacing: 1.5px;
                                                                                                                                                    font-weight: 100;
                                                                                                                                                    font-size: 1.4em;
                                                                                                                                                }

                                                                                                                                                h2,
                                                                                                                                                h3 {
                                                                                                                                                    font-family: 'saira', sans-serif;
                                                                                                                                                    letter-spacing: 1.5px;
                                                                                                                                                    font-weight: 400;
                                                                                                                                                    font-size: 1.4em;
                                                                                                                                                }

                                                                                                                                                .event {
                                                                                                                                                    border-bottom: 1px dashed white;
                                                                                                                                                    padding-bottom: calc(50px * 0.5);
                                                                                                                                                    margin-bottom: 50px;
                                                                                                                                                    position: relative;
                                                                                                                                                }

                                                                                                                                                .event:last-of-type {
                                                                                                                                                    padding-bottom: 0;
                                                                                                                                                    margin-bottom: 0;
                                                                                                                                                    border: none;
                                                                                                                                                }

                                                                                                                                                .event:before,
                                                                                                                                                .event:after {
                                                                                                                                                    position: absolute;
                                                                                                                                                    display: block;
                                                                                                                                                    top: 0;
                                                                                                                                                }

                                                                                                                                                .event:before {
                                                                                                                                                    left: (((120px * 0.6) + 50px + 4px + 11px + (4px * 2)) * 1.5) * -1;
                                                                                                                                                    color: fade(white, 40%);
                                                                                                                                                    content: attr(data-date);
                                                                                                                                                    text-align: right;
                                                                                                                                                    font-weight: 100;
                                                                                                                                                    font-size: 0.9em;
                                                                                                                                                    min-width: 120px;
                                                                                                                                                    font-family: 'saira', sans-serif;
                                                                                                                                                }

                                                                                                                                                .event:after {
                                                                                                                                                    box-shadow: 0 0 0 4px fade(#004ffc, 100%);
                                                                                                                                                    left: (50px + 4px + (11px * 0.35)) * -1;
                                                                                                                                                    background: lighten(#252827, 5%);
                                                                                                                                                    border-radius: 50%;
                                                                                                                                                    height: 11px;
                                                                                                                                                    width: 11px;
                                                                                                                                                    content: "";
                                                                                                                                                    top: 5px;
                                                                                                                                                }
                                                                                                                                            } */

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
        }
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
        <span class="title fw-bold mb-35px">Rute Perjalanan</span>
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
                            <div class="text-secondary-strong my-3">
                                3 Jam
                            </div>
                            <strong>11:05</strong>
                        </div>
                        <div class="d-flex ms-3 flex-column justify-content-between lined">
                            <i class="fa-solid fa-circle-dot text-danger mt-1 z-index-1"></i>
                            <div></div>
                            <i class="fa-solid fa-circle mb-1 z-index-1"></i>
                        </div>
                        <div class="d-flex ms-3 flex-column justify-content-between">
                            <strong>Bukittinggi</strong>
                            <strong>11:05</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
