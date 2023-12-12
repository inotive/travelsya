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
                                        <h2 class="text-gray-900 text-hover-primary fs-3 fw-bold me-1">Nama</h2>
                                    </div>
                                    <div class="d-flex flex-wrap fw-semibold fs-3 mb-1 pe-1">
                                        <h2 class="d-flex align-items-center text-gray-700 text-hover-primary me-5 mb-2">
                                            {{ $hostelbookdates->transaction->user->name }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            @php
                                $startdate = \Carbon\Carbon::parse($hostelbookdates->reservation_start);
                                $enddate = \Carbon\Carbon::parse($hostelbookdates->reservation_end);
                                $startdates = $startdate->Format('d F Y');
                                $enddates = $enddate->Format('d F Y');
                                $diffInDays = $startdate->diffInDays($enddate);
                            @endphp
                            <div class="d-flex flex-wrap flex-stack">
                                <div class="d-flex flex-column flex-grow-1 pe-12 ">
                                    <div class="d-flex flex-wrap mb-2">
                                        <h5 href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">
                                            Tanggal Check In
                                        </h5>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <h5 href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">
                                            {{ $startdates }}
                                        </h5>
                                    </div>
                                </div>

                                <div class="d-flex flex-column flex-grow-1 pe-8 ">
                                    <div class="d-flex flex-wrap mb-2">
                                        <h5 href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">
                                            Tanggal Check Out
                                        </h5>
                                    </div>
                                    <div class="d-flex flex-wrap mt-1">
                                        <h5 href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">
                                            {{ $enddates }} ({{ $diffInDays }} Malam)
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap flex-stack mt-5 ">
                                <div class="d-flex flex-column flex-grow-1">
                                    <div class="d-flex flex-wrap mb-2">
                                        <h5 class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">
                                            Jumlah Tamu
                                        </h5>
                                    </div>
                                    <div class="d-flex flex-wrap ">
                                        <h5 class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">
                                            {{ $hostelbookdates->guest }} Orang
                                        </h5>
                                    </div>
                                </div>

                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <div class="d-flex flex-wrap mb-2">
                                        <h5 class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">Room</h5>
                                    </div>
                                    <div class="d-flex flex-wrap mt-1">
                                        <h5 class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">
                                            {{ $hostelbookdates->hostelRoom->name }}
                                        </h5>
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
                                $hotelImage = optional($hostelbookdates->hostel->hostelImage->where('main', 1)->first())->image;
                                $image = $hotelImage !== null ? 'storage/media/hostel/' . $hotelImage : null;
                            @endphp

                            <img src="{{ asset($image ?: 'assets/media/logos/logo-square.png') }}" alt="image" />

                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex flex-wrap flex-stack ">
                                <div class="d-flex flex-column flex-grow-1 pe-12 ">
                                    <div class="d-flex flex-wrap mb-4">
                                        <h4 class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">
                                            Indonesia Standard {{ ucwords($hostelbookdates->hostelRoom->bed_type) }}
                                        </h4>
                                    </div>
                                    <div class="d-flex flex-wrap mb-4">
                                        <a class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">Room
                                            Size: {{ $hostelbookdates->hostelRoom->roomsize }} sqft</a>
                                    </div>
                                    <div class="d-flex flex-wrap mb-4">
                                        <a class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">Tersewa
                                            {{ $hostelbookdates->count() }} Kali
                                        </a>
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
                                    <a href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1 mb-2">
                                        {{ $hostelbookdates->hostelRoom->name }}
                                    </a>
                                    <a href="#" class="text-gray-900 text-hover-primary fs-7 fw-bold me-1">
                                        ({{ $diffInDays }} Malam)
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6 text-end">
                                <div class="d-flex flex-column mb-2">
                                    @php
                                        $bayar = $diffInDays * $hostelbookdates->rent_price * $hostelbookdates->room;
                                        $totalBiayaPenanganan = $bayar * 15 / 100;
                                        $biayaPenanganan = $totalBiayaPenanganan + $hostelbookdates->fee_admin;
                                        $grandTotal = $bayar - $biayaPenanganan;

                                    @endphp
                                    <a href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">
                                        {{ General::rp($bayar) }}
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-2">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1 mb-2">
                                        Biaya Penanganan</a>
                                    <a href="#" class="text-gray-900 text-hover-primary fs-7 fw-bold me-1">
                                        15 %
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6 text-end">
                                <div class="d-flex flex-column mb-2">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">
                                        {{ General::rp($biayaPenanganan) }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr style="color: #191717; background-color: #191717; height: 1px; border: none;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-2">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1 mb-2">
                                        Total Diterima
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-6 text-end">
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">
                                        {{ General::rp($grandTotal) }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <hr style="color: #191717; background-color: #191717; height: 1px; border: none;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-2">
                                    <a href="#"
                                        class="text-gray-900 text-hover-primary fs-7 fw-bold me-1 mb-2">Metode
                                        Pembayaran</a>
                                </div>
                            </div>

                            <div class="col-md-6 text-end">
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-7 fw-bold me-1">
                                        {{ ucwords($hostelbookdates->transaction->payment_method) }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-2">
                                    <a href="#"
                                        class="text-gray-900 text-hover-primary fs-7 fw-bold me-1 mb-2">Channel
                                        Pembayaran</a>
                                </div>
                            </div>

                            <div class="col-md-6 text-end">
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-7 fw-bold me-1">
                                        {{ ucwords($hostelbookdates->transaction->payment_channel) }}
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
