@php
    $facilityIcons = [
        'colokan usb' => ['type' => 'image', 'src' => asset('images/icon/usb.png')],
        'full ac' => ['type' => 'image', 'src' => asset('images/icon/ac.png')],
        'kursi recliner' => ['type' => 'image', 'src' => asset('images/icon/chair.png')],
        'alat pemadam' => ['type' => 'fa', 'class' => 'fa-solid fa-fire-extinguisher text-muted-custom'],
        'peraturan kursi 1 - 1' => ['type' => 'fa', 'class' => 'fa-solid fa-gear text-muted-custom'],
        'lampu baca' => ['type' => 'bootstrap', 'class' => 'bi bi-lamp-fill text-muted-custom'],
        'tv led' => ['type' => 'fa', 'class' => 'fa-solid fa-tv text-muted-custom'],
        'toilet' => ['type' => 'fa', 'class' => 'fa-solid fa-toilet text-muted-custom'],
        'wi-fi' => ['type' => 'fa', 'class' => 'fa-solid fa-wifi text-muted-custom'],
        'selimut dan bantal' => ['type' => 'fa', 'class' => 'fa-solid fa-bed text-muted-custom'],
        'bagasi bawah' => ['type' => 'fa', 'class' => 'fa-solid fa-suitcase-rolling text-muted-custom'],
        'rak bagasi atas' => ['type' => 'fa', 'class' => 'fa-solid fa-suitcase text-muted-custom'],
    ];


    // Small inline function to render the HTML
    $renderIcon = function ($name) use ($facilityIcons) {
        $key = strtolower(trim($name));

        if (!isset($facilityIcons[$key])) {
            return '<i class="fa-regular fa-circle-question text-muted"></i>'; // fallback
        }

        $icon = $facilityIcons[$key];

        if ($icon['type'] === 'image') {
            return '<img src="' . e($icon['src']) . '" height="15" alt="' . e($name) . '">';
        }

        return '<i class="' . e($icon['class']) . '"></i>';
    };

    $departureDateTime = \Carbon\Carbon::parse($date_pergi . ' ' . $departure->departure_time);
    $arrivalDateTime = $departureDateTime->copy()->addHours($departure->duration);

    $busImages = is_array($departure->busTravel->image) ? $departure->busTravel->image : json_decode($departure->busTravel->image, true);
@endphp

@extends('layouts.app_v2')

@section('content')
    @include('pagesv2.bus_travel.partials._second_nav')

    <div class="container my-5 mb-50">
        <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6" id="busDetailsTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="details-tab" data-bs-toggle="tab" href="#details_tab_pane" role="tab"
                    aria-controls="details_tab_pane" aria-selected="true">Detail</a>
            </li>
            {{-- <li class="nav-item" role="presentation">
                <a class="nav-link" id="tnc-tab" data-bs-toggle="tab" href="#tnc_tab_pane" role="tab"
                    aria-controls="tnc_tab_pane" aria-selected="false">Syarat & Ketentuan</a>
            </li> --}}
        </ul>

        @if($is_pulang_pergi == 1)
            <div class="alert alert-info rounded-4 mb-4" role="alert">
                <div class="d-flex align-items-center">
                    @if($departure->from->city_name == $kota_tujuan && $departure->to->city_name == $kota_awal)
                        <i class="fa-solid fa-arrow-right-arrow-left me-2 text-success fs-4"></i>
                        <div>
                            <h4 class="alert-heading mb-1">Tiket Kepulangan</h4>
                            <p class="mb-0">Anda sedang memilih tiket untuk kepulangan dari <strong>{{ $kota_tujuan }}</strong> ke <strong>{{ $kota_awal }}</strong> pada tanggal <strong>{{ \Carbon\Carbon::parse($date_pulang)->format('d M Y') }}</strong></p>
                        </div>
                    @else
                        <i class="fa-solid fa-arrow-right me-2 text-primary fs-4"></i>
                        <div>
                            <h4 class="alert-heading mb-1">Tiket Kepergian</h4>
                            <p class="mb-0">Anda sedang memilih tiket untuk kepergian dari <strong>{{ $kota_awal }}</strong> ke <strong>{{ $kota_tujuan }}</strong> pada tanggal <strong>{{ \Carbon\Carbon::parse($date_pergi)->format('d M Y') }}</strong></p>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <div class="tab-content" id="busDetailsTabContent">
            <div class="tab-pane fade show active" id="details_tab_pane" role="tabpanel" aria-labelledby="details-tab">
                <div class="card shadow-sm mb-35px">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                @if (!empty($busImages) && is_array($busImages))
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#galleryModal">
                                        <img src="/storage/buses/{{ $busImages[0] }}"
                                            class="object-fit-contain w-100" style="max-height: 270px" alt="{{ $departure->busTravel->name }}"
                                            onerror="this.src='https://images.unsplash.com/photo-1618805154647-7d89ac05926b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'">
                                    </a>
                                @else
                                    <img src="https://images.unsplash.com/photo-1618805154647-7d89ac05926b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                        class="object-fit-contain w-100" alt="Default Bus Image">
                                @endif
                            </div>
                            <div class="col-8 d-flex flex-column">
                                <div class="d-flex flex-row align-items-center">
                                    <div>
                                        <span
                                            class="fw-bold">{{ $departure->busTravel->busTravel->business_name ?? 'Invalid name' }}</span><br>
                                        <small>{{ $departure->busTravel->name }}</small>
                                    </div>
                                    <div class="ms-2">
                                        <span><i class="fa-solid fa-star text-warning"></i></span>
                                        <span class="ms-1"><span
                                                class="fw-bold">{{ number_format($departure->busTravel->avgRating()) }}</span>/5</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row p2">
                                    <div class="col-3 mb-4">
                                        <span><i class="fa-solid fa-suitcase"></i></span>
                                        <span class="ms-2">Kapasitas
                                            {{ number_format($departure->busTravel->number_seats) }}
                                            Kursi</span>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row p-2">
                                    @foreach ($departure->busTravel->facilities as $f)
                                        <div class="col-3">
                                            {!! $renderIcon($f->facility->name) !!}
                                            <span class="ms-2">{{ $f->facility->name }}</span>
                                        </div>
                                    @endforeach
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
                                    <strong>{{ $departureDateTime->format('H:i') }}</strong>
                                    <span>{{ $departureDateTime->format('d M') }}</span>
                                    <div class="text-secondary-strong my-5">
                                        {{ $departure->duration }} Jam
                                    </div>
                                    <strong>{{ $arrivalDateTime->format('H:i') }}</strong>
                                    <span>{{ $arrivalDateTime->format('d M') }}</span>
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
                                        <strong>{{ $departure->from->city_name }}</strong>
                                        <span>{{ $departure->titik_naik }}</span>
                                    </div>
                                    <div></div>
                                    <div class="d-flex flex-column">
                                        <strong>{{ $departure->to->city_name }}</strong>
                                        <span>{{ $departure->titik_turun }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-35px">
                    <span class="title fw-bold">Syarat dan Ketentuan</span>
                </div>
                <div class="card shadow mb-35px">
                    <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                        {!! nl2br(e($departure->busTravel->tos)) !!}
                    </div>
                </div>
                <div class="mb-35px">
                    <span class="title fw-bold">Deskripsi</span>
                </div>
                <div class="card shadow mb-35px" style="max-height: 300px; overflow-y: auto;">
                    <div class="card-body">
                        {!! nl2br(e($departure->busTravel->deskripsi)) !!}
                    </div>
                </div>
                <div class="mb-35px">
                    <span class="title fw-bold">Kamu Harus Tau</span>
                </div>
                <div class="card shadow mb-35px">
                    <div class="card-body">
                        <ul>
                            <li>E-tiket akan tersedia di halaman Your Orders dan dikirim ke emailmu setelah pembayaran
                                selesai</li>
                            <li>Sebelum naik, tunjukkan e-tiket ke petugas bus/travel untuk ditukar dengan tiket fisik
                            </li>
                            <li>Siapkan kartu identitas berlaku. Petugas bus/travel mungkin memerlukannya untuk
                                memverifikasi
                                penumpang</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <hr class="mb-35px" style="color: #777">
        <div class="card shadow rouded-4 mb-35px">
            <div class="card-body d-flex flex-row align-items-center justify-content-between">
                <span class="fs-2 text-danger">IDR {{ number_format($departure->price * $jumlah_penumpang, 0, ',', '.') }}</span>
                <button class="btn btn-danger" id="kursi_button" data-bs-toggle="modal"
                    data-bs-target="#modal_kursi">Pilih
                    Kursi</button>
            </div>
        </div>
        {{-- <div class="card shadow rouded-4 mb-35px">
            <div class="card-body">
                <form action="{{ route('bus_travel.order') }}" method="post"
                    class="d-flex flex-row align-items-center justify-content-between">
                    @csrf
                    <input type="text" name="departure_id" value="{{ $departure->id }}" hidden>
                    <input type="text" name="kota_awal" value="{{ $departure->from->id }}" hidden>
                    <input type="text" name="kota_tujuan" value="{{ $departure->to->id }}" hidden>
                    <input type="text" name="is_pulang_pergi" value="{{ $is_pulang_pergi }}" hidden>
                    <input type="text" name="jumlah_penumpang" value="{{ $jumlah_penumpang }}" hidden>
                    <input type="text" name="date_pergi" value="{{ $date_pergi }}" hidden>
                    <input type="text" name="date_pulang" value="{{ $date_pulang }}" hidden>

                    <span class="fs-2 text-danger">IDR {{ number_format($departure->price) }} X
                        {{ number_format($jumlah_penumpang) }}</span>
                    <button type="button" id="list_penumpang" class="btn btn-danger">Pesan</button>
                </form>
            </div>
        </div> --}}

        @include('pagesv2.bus_travel.partials.components._modal_kursi')
    </div>

    @if (!empty($busImages) && is_array($busImages))
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalLabel">Bus Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($busImages as $key => $image)
                                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                                    <img src="/storage/buses/{{ $image }}"
                                        class="d-block w-100 rounded-3 shadow-sm"
                                        style="max-height: 450px; object-fit: contain;" alt="Bus Image">
                                </div>
                            @endforeach
                        </div>
                        @if (count($busImages) > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        @endif
                    </div>

                    @if (count($busImages) > 1)
                    <div class="mt-3">
                        <ol class="carousel-indicators p-0">
                            @foreach ($busImages as $key => $image)
                                <li data-bs-target="#galleryCarousel" data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
    <style>
        .gallery-thumb {
            opacity: 0.7;
            transition: all 0.2s ease-in-out;
            border: 2px solid transparent;
        }
        .gallery-thumb:hover {
            opacity: 1;
            transform: scale(1.05);
        }
        .active-thumb {
            opacity: 1;
            border: 2px solid #dc3545; /* highlight selected thumb */
        }


    </style>


@endsection
