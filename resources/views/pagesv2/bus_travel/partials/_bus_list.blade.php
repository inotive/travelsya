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

    $categoryIcons = [
        'bus' => ['type' => 'fa', 'class' => 'fa-solid fa-bus text-danger'],
        'travel' => ['type' => 'fa', 'class' => 'fa-solid fa-truck-front text-danger']
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

    $renderCategoryIcon = function ($kategori) use ($categoryIcons) {
        $key = strtolower(trim($kategori));

        if (!isset($categoryIcons[$key])) {
            return '<i class="fa-regular fa-circle-question text-muted"></i>'; // fallback
        }

        $icon = $categoryIcons[$key];

        if ($icon['type'] === 'image') {
            return '<img src="' . e($icon['src']) . '" height="15" alt="' . e($kategori) . '">';
        }

        return '<i class="' . e($icon['class']) . '"></i>';
    };
@endphp

<div class="container">
    @if(isset($noDeparturesFound) && $noDeparturesFound)
        <div class="card shadow-sm mb-4">
            <div class="card-body text-center">
                <h4 class="text-danger mb-3">
                    <i class="fa-solid fa-triangle-exclamation me-2" style="color: #dc3545"></i>
                    Tidak ada keberangkatan
                </h4>
                <p class="mb-4">
                    Tidak ada keberangkatan dari <strong>{{ $kota_awal }}</strong> ke <strong>{{ $kota_tujuan }}</strong> pada <strong>{{ \Carbon\Carbon::parse($date_pergi)->format('d F Y') }}</strong>
                </p>
                <form id="refreshForm" action="{{ route('bus_travel.index') }}" method="GET">
                    <input type="hidden" name="kota_awal" value="{{ $kota_awal }}">
                    <input type="hidden" name="kota_tujuan" value="{{ $kota_tujuan }}">
                    <input type="hidden" name="jumlah_penumpang" value="{{ $jumlah_penumpang }}">
                    <input type="hidden" name="date_pergi" value="{{ $date_pergi }}">
                    <input type="hidden" name="is_pulang_pergi" value="{{ $is_pulang_pergi }}">
                    @if($date_pulang)
                        <input type="hidden" name="date_pulang" value="{{ $date_pulang }}">
                    @endif
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-rotate me-2"></i>
                        Cari Tanggal Lain
                    </button>
                </form>
            </div>
        </div>
    @else
        {{-- Alert for round trip tickets --}}
        @if($is_pulang_pergi == 1 && isset($pergi) && !empty($pergi))
            @php
                $firstDeparture = $pergi[0] ?? null;
            @endphp
            @if($firstDeparture)
                <div class="alert alert-info rounded-4 mb-4" role="alert">
                    <div class="d-flex align-items-center">
                        @if($firstDeparture['departure_point'] == $kota_tujuan && $firstDeparture['arrival_point'] == $kota_awal)
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
        @endif

        @foreach ($pergi as $p)
        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="d-flex">
                            <div class="title-card">
                                <div class="title-how text-capitalize fs-4 fw-bold mb-2">
                                    {{ $p['business_name'] ?? 'Invalid business' }}
                                    <span class="badge round p-2 badge-light-danger fs-5">
                                        <i class="fa-solid fa-calendar me-2 text-danger"></i>
                                        {{ $p['departure_date'] }}
                                    </span>
                                    <span class="badge round p-2 badge-light-danger fs-5">
                                        {!! $renderCategoryIcon($p['kategori']) !!}
                                        <span class="ms-1 text-capitalize">{{ $p['kategori'] }}</span>
                                    </span>
                                </div>
                                <div class="subtitle-how text-secondary-strong">
                                    {{ $p['name'] }} {{ $p['class'] }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 text-end">
                        <div>
                            <i class="fa-solid fa-star me-2 text-warning"></i>
                            <strong>{{ $p['avgRating'] }}/</strong>
                            <small>5</small>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-8">
                        <div class="d-flex mt-3">
                            <div class="d-flex flex-column">
                                <strong>{{ $p['departure_time'] }}</strong>
                                <div class="text-secondary-strong my-3">
                                    {{ $p['duration'] }} Jam
                                </div>
                                <strong>{{ $p['arrival_time'] }}</strong>
                            </div>
                            <div class="d-flex ms-3 flex-column justify-content-between">
                                <i class="fa-solid fa-circle-dot text-danger mt-1"></i>
                                <div class="lined"></div>
                                <i class="fa-solid fa-circle mb-1"></i>
                            </div>
                            <div class="d-flex ms-3 flex-column justify-content-between">
                                <strong class="text-truncate" style="max-width: 500px;">{{ $p['departure_point'] }} | {{ $p['titik_naik'] }}</strong>
                                <strong class="text-truncate" style="max-width: 500px;">{{ $p['arrival_point'] }} | {{ $p['titik_turun'] }}</strong>
                            </div>
                        </div>
                        <div class="d-flex text-secondary-strong mt-3 flex-wrap">
                            @if(!empty($p['facilities']))
                                @foreach ($p['facilities'] as $facility)
                                    <span class="ms-3 d-flex align-items-center">
                                        {!! $renderIcon($facility->facility->name) !!}
                                        <span class="ms-1">{{ $facility->facility->name }}</span>
                                    </span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-12 col-md-4 d-flex flex-column justify-content-end align-items-end">
                        <div class="text-secondary-strong mt-auto">
                            Mulai dari
                        </div>
                        <div class="price text-start">
                            <strong class="text-danger text-bold fs-3">IDR {{ number_format($p['price']) }}</strong>
                        </div>
                        <a href="{{ route('bus_travel.detail', ['departure_id' => $p['id'], 'kota_awal' => $p['departure_point'], 'kota_tujuan' => $p['arrival_point'], 'is_pulang_pergi' => $is_pulang_pergi, 'jumlah_penumpang' => $jumlah_penumpang, 'date_pergi' => $date_pergi ?? date('d-m-Y', strtotime(now())), 'date_pulang' => $date_pulang]) }}">
                            <button class="btn btn-danger mt-2 bg-main" style="margin-left: auto;">Pilih</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        {{-- Section for return trip (Kepulangan) --}}
        {{-- @if($is_pulang_pergi == 1 && !empty($pulang))
            <h3 class="text-center mb-4 mt-5">
                <span class="badge bg-success fs-5">Kepulangan</span>
                <br><small class="text-muted">Pilih tiket kepulangan dari {{ $kota_tujuan }} ke {{ $kota_awal }}</small>
            </h3>

            @foreach ($pulang as $p)
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="d-flex">
                                <div class="title-card">
                                    <div class="title-how text-capitalize fs-4 fw-bold mb-2">
                                        {{ $p['business_name'] ?? 'Invalid business' }}
                                        <span class="badge round p-2 badge-light-danger fs-5">
                                            <i class="fa-solid fa-calendar me-2 text-danger"></i>
                                            {{ $p['departure_date'] }}
                                        </span>
                                        <span class="badge round p-2 badge-light-danger fs-5">
                                            {!! $renderCategoryIcon($p['kategori']) !!}
                                            <span class="ms-1 text-capitalize">{{ $p['kategori'] }}</span>
                                        </span>
                                    </div>
                                    <div class="subtitle-how text-secondary-strong">
                                        {{ $p['name'] }} {{ $p['class'] }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 text-end">
                            <div>
                                <i class="fa-solid fa-star me-2 text-warning"></i>
                                <strong>{{ $p['avgRating'] }}/</strong>
                                <small>5</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-8">
                            <div class="d-flex mt-3">
                                <div class="d-flex flex-column">
                                    <strong>{{ $p['departure_time'] }}</strong>
                                    <div class="text-secondary-strong my-3">
                                        {{ $p['duration'] }} Jam
                                    </div>
                                    <strong>{{ $p['arrival_time'] }}</strong>
                                </div>
                                <div class="d-flex ms-3 flex-column justify-content-between">
                                    <i class="fa-solid fa-circle-dot text-danger mt-1"></i>
                                    <div class="lined"></div>
                                    <i class="fa-solid fa-circle mb-1"></i>
                                </div>
                                <div class="d-flex ms-3 flex-column justify-content-between">
                                    <strong class="text-truncate" style="max-width: 500px;">{{ $p['departure_point'] }} | {{ $p['titik_naik'] }}</strong>
                                    <strong class="text-truncate" style="max-width: 500px;">{{ $p['arrival_point'] }} | {{ $p['titik_turun'] }}</strong>
                                </div>
                            </div>
                            <div class="d-flex text-secondary-strong mt-3 flex-wrap">
                                @if(!empty($p['facilities']))
                                    @foreach ($p['facilities'] as $facility)
                                        <span class="ms-3 d-flex align-items-center">
                                            {!! $renderIcon($facility->facility->name) !!}
                                            <span class="ms-1">{{ $facility->facility->name }}</span>
                                        </span>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-12 col-md-4 d-flex flex-column justify-content-end align-items-end">
                            <div class="text-secondary-strong mt-auto">
                                Mulai dari
                            </div>
                            <div class="price text-start">
                                <strong class="text-danger text-bold fs-3">IDR {{ number_format($p['price']) }}</strong>
                            </div>
                            <a href="{{ route('bus_travel.detail', ['departure_id' => $p['id'], 'kota_awal' => $p['departure_point'], 'kota_tujuan' => $p['arrival_point'], 'is_pulang_pergi' => $is_pulang_pergi, 'jumlah_penumpang' => $jumlah_penumpang, 'date_pergi' => $date_pergi, 'date_pulang' => $date_pulang ?? date('d-m-Y', strtotime(now()))]) }}">
                                <button class="btn btn-success mt-2 bg-main" style="margin-left: auto;">Pilih</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif --}}
    @endif
</div>

<style>
    .text-muted-custom {
        color: #4e4e57 !important;
    }
</style>
