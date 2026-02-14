@extends('ekstranet.layout', ['title' => 'Riwayat Booking', 'url' => '#'])

@section('content-admin')
<div class="row g-5">
    <div class="col-lg-8">
        <div class="card mb-4 flex-fill">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Reservasi</h3>
                    <hr class="mt-2 mb-4">
                </div>

                <div class="d-flex flex-wrap flex-sm-nowrap p-3 m-5 mt-4">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-5">
                            <div class="d-flex flex-column">
                                <div class="d-flex align-items-center mb-2 mt-2">
                                    <h2 class="text-gray-900 text-hover-primary fs-3 fw-bold me-1">Nama Tamu</h2>
                                </div>
                                <div class="d-flex flex-wrap fw-semibold fs-3 mb-1 pe-1">
                                    <h1 class="d-flex align-items-center me-5 mb-2">
                                        {{ $hotelbookdates->transaction->user->name }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                        @php
                        $startdate = \Carbon\Carbon::parse($hotelbookdates->reservation_start);
                        $enddate = \Carbon\Carbon::parse($hotelbookdates->reservation_end);
                        $startdates = $startdate->Format('d F Y');
                        $enddates = $enddate->Format('d F Y');
                        $diffInDays = $startdate->diffInDays($enddate);
                        @endphp
                        <div class="d-flex flex-wrap flex-stack">
                            <div class="d-flex flex-column flex-grow-1 pe-12 ">
                                <div class="d-flex flex-wrap ">
                                    <p href="#" class="fw-medium">
                                        Tanggal Check In
                                    </p>
                                </div>
                                <div class="d-flex flex-wrap">
                                    <p  class="fw-bold">
                                        {{ $startdates}}
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex flex-column flex-grow-1 pe-8 ">
                                <div class="d-flex flex-wrap ">
                                    <p href="#" class="fw-medium">
                                        Tanggal Check Out
                                    </p>
                                </div>
                                <div class="d-flex flex-wrap mt-1">
                                    <p href="#" class="fw-bold">
                                        {{ $enddates}} ({{ $diffInDays }} Malam)
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap flex-stack mt-5 ">
                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex flex-wrap ">
                                    <p class="fw-medium">
                                        Jumlah Tamu
                                    </p>
                                </div>
                                <div class="d-flex flex-wrap ">
                                    <p class="fw-bold">
                                        {{ $hotelbookdates->guest }} Orang
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                <div class="d-flex flex-wrap ">
                                    <p class="fw-medium">Room</p>
                                </div>
                                <div class="d-flex flex-wrap mt-1">
                                    <p class="fw-bold">
                                        {{$hotelbookdates->hotelRoom->name}}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Pesanan</h3>
                    <hr class="mt-2 mb-4">
                </div>
                <div class="d-flex flex-wrap flex-sm-nowrap p-3 m-5 mt-4">
                    <div class="me-5 mb-0">
                        <div class="symbol symbol-100px symbol-lg-200px symbol-fixed position-relative">
                            @php
                            $hotelImage = optional($hotelbookdates->hotel->hotelImage->where('main', 1)->first())->image;
                            $image = $hotelImage !== null ? 'storage/' . $hotelImage : null;
                        @endphp

                        <img src="{{ asset($image ?: 'assets/media/logos/logo-square.png') }}" alt="image" />
                            {{-- <img src="{{ asset('storage/media/hotel/'.$hotelbookdates->hotel->hotelImage->where('main', 1)->first()->image) }}"
                                alt="image" /> --}}
                                {{-- <img src="{{ optional('storage/z'. $hotelbookdates->hotel->hotelImage->where('main', 1)->first())->image }}"
     alt="image" /> --}}
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex flex-wrap flex-stack ">
                            <div class="d-flex flex-column flex-grow-1 pe-12 ">
                                <div class="d-flex flex-wrap mb-4">
                                    <h4 class="fw-medium">
                                        {{ ucwords($hotelbookdates->hotelRoom->name)}}
                                    </h4>
                                </div>
                                <div class="d-flex flex-wrap mb-4">
                                    <p class="fw-light">
                                        Room  Size: {{$hotelbookdates->hotelRoom->roomsize}} m2</p>
                                </div>
                                <div class="d-flex flex-wrap mb-4">
                                    <p class="fw-medium text-danger">Tersewa
                                        {{$hotelbookdates->count()}} Kali
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body w-100 p-0">
                <div class="card-header">
                    <h3 class="card-title">Informasi Pembayaran</h3>
                    <hr class="mt-2 mb-4">
                </div>
                <div class="card-body my-3">
                    <div class="row mb-5">
                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <p class="fw-medium mb-2">
                                    {{$hotelbookdates->hotelRoom->name}}
                                </p>
                                <p class="fs-7 fw-bold me-1">
                                    ({{ $diffInDays }} Malam)
                                </p>
                            </div>
                        </div>

                        @php
                            $bayar = $diffInDays * $hotelbookdates->rent_price * $hotelbookdates->room;
                            $totalBiayaPenanganan = $bayar * 15 / 100;
                            $biayaPenanganan = $totalBiayaPenanganan + $hotelbookdates->fee_admin + $hotelbookdates->kode_unik;
                            $grandTotal = $bayar - $biayaPenanganan;
                        @endphp

                        <div class="col-md-6 text-end">
                            <div class="d-flex flex-column mb-2">
                                <h5 class="fw-bold">
                                    {{  General::rp($bayar) }}
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <p  class="fw-medium mb-2">
                                    Biaya Penanganan</p>
                                <p href="#" class="text-gray-900 text-hover-primary fs-7 fw-bold me-1">
                                    15 %
                                </p>
                            </div>
                        </div>

                        <div class="col-md-6 text-end">
                            <div class="d-flex flex-column mb-2">
                                <h5 class="fw-bold ">
                                    {{ General::rp($biayaPenanganan) }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <hr style="color: #191717; background-color: #191717; height: 1px; border: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <p  class="fw-medium mb-2">
                                    Total Diterima
                                </p>
                            </div>
                        </div>

                        <div class="col-md-6 text-end">
                            <div class="d-flex flex-column">
                                <h5 class="fw-bold">
                                    {{ General::rp($grandTotal) }}
                                </h5>
                            </div>
                        </div>
                    </div>
                    <hr style="color: #191717; background-color: #191717; height: 1px; border: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <a href="#" class="text-gray-900 text-hover-primary fs-7 fw-bold me-1 mb-2">Metode
                                    Pembayaran</a>
                            </div>
                        </div>

                        <div class="col-md-6 text-end">
                            <div class="d-flex flex-column">
                                <a href="#" class="text-gray-900 text-hover-primary fs-7 fw-bold me-1">
                                    {{ ucwords($hotelbookdates->transaction->payment_method) }}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <a href="#" class="text-gray-900 text-hover-primary fs-7 fw-bold me-1 mb-2">Channel
                                    Pembayaran</a>
                            </div>
                        </div>

                        <div class="col-md-6 text-end">
                            <div class="d-flex flex-column">
                                <a href="#" class="text-gray-900 text-hover-primary fs-7 fw-bold me-1">
                                    {{ ucwords($hotelbookdates->transaction->payment_channel) }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
