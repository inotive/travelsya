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
                                    <h2 class="text-gray-900 text-hover-primary fs-3 fw-bold me-1">Nama Pelanggan</h2>
                                </div>
                                <div class="d-flex flex-wrap fw-semibold fs-3 mb-1 pe-1">
                                    <h1 class="d-flex align-items-center me-5 mb-2">
                                        {{ $healthbeautybookdates->transaction->user->name }}
                                    </h1>
                                </div>
                            </div>
                        </div>
                        @php
                        $orderDate = \Carbon\Carbon::parse($healthbeautybookdates->created_at);
                        $expireDate = \Carbon\Carbon::parse($healthbeautybookdates->expire_on);
                        $orderDates = $orderDate->Format('d F Y');
                        $expireDates = $expireDate->Format('d F Y');
                        @endphp
                        <div class="d-flex flex-wrap flex-stack">
                            <div class="d-flex flex-column flex-grow-1 pe-12 ">
                                <div class="d-flex flex-wrap ">
                                    <p href="#" class="fw-medium">
                                        Tanggal Pemesanan
                                    </p>
                                </div>
                                <div class="d-flex flex-wrap">
                                    <p  class="fw-bold">
                                        {{ $orderDates}}
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex flex-column flex-grow-1 pe-8 ">
                                <div class="d-flex flex-wrap ">
                                    <p href="#" class="fw-medium">
                                        Tanggal Kedaluwarsa
                                    </p>
                                </div>
                                <div class="d-flex flex-wrap mt-1">
                                    <p href="#" class="fw-bold">
                                        {{ $expireDates}}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap flex-stack mt-5 ">
                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex flex-wrap ">
                                    <p class="fw-medium">
                                        Jumlah Tiket
                                    </p>
                                </div>
                                <div class="d-flex flex-wrap ">
                                    <p class="fw-bold">
                                        {{ $healthbeautybookdates->total_ticket }} Tiket
                                    </p>
                                </div>
                            </div>

                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                <div class="d-flex flex-wrap ">
                                    <p class="fw-medium">Paket</p>
                                </div>
                                <div class="d-flex flex-wrap mt-1">
                                    <p class="fw-bold">
                                        {{$healthbeautybookdates->package->name}}
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
                                    {{$healthbeautybookdates->package->name}}
                                </p>
                            </div>
                        </div>

                        <div class="col-md-6 text-end">
                            <div class="d-flex flex-column mb-2">
                                <h5 class="fw-bold">
                                    {{  General::rp($healthbeautybookdates->rent_price) }}
                                </h5>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-2">
                                <p  class="fw-medium mb-2">
                                    Biaya Admin</p>
                            </div>
                        </div>

                        <div class="col-md-6 text-end">
                            <div class="d-flex flex-column mb-2">
                                <h5 class="fw-bold ">
                                    {{ General::rp($healthbeautybookdates->fee_admin) }}
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
                                    {{ General::rp($healthbeautybookdates->transaction->total) }}
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
                                    {{ ucwords($healthbeautybookdates->transaction->payment) }}
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