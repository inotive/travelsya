@extends('ekstranet.layout', ['title' => 'Riwayat Booking', 'url' => '#'])

@section('content-admin')
    <div class="row g-5">
        <!--begin::Col-->
        <div class="col-lg-8">
            {{-- <div class="col-8 mb-1"> --}}
                <div class="card mb-4 flex-fill">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Reservasi</h3>
                            <hr class="mt-2 mb-4">
                        </div>
                        <!--begin::Body-->

                        <div class="d-flex flex-wrap flex-sm-nowrap p-3 m-5 mt-4">
                            <!--begin: Pic-->

                            {{-- <div class="me-5 mb-0">
                        <div class="symbol symbol-100px symbol-lg-150px symbol-fixed position-relative">
                            <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="image" />

                        </div>
                    </div> --}}
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="flex-grow-1">

                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <div class="d-flex align-items-center mb-2 mt-2">
                                            <a class="text-gray-900 text-hover-primary fs-3 fw-bold me-1">Nama</a>

                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap fw-semibold fs-3 mb-1 pe-1">
                                            <a class="d-flex align-items-center text-gray-700 text-hover-primary me-5 mb-2">

                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                </i>{{ $hotelbookdates->transaction->user->name }}</a>

                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Actions-->

                                    <!--end::Actions-->
                                </div>
                                @php
                                    $startdate = \Carbon\Carbon::parse($hotelbookdates->start);
                                    $enddate = \Carbon\Carbon::parse($hotelbookdates->end);
                                    $startdates = $startdate->Format('d F Y');
                                    $enddates = $enddate->Format('d F Y');
                                    
                                @endphp
                                <!--end::Title-->
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap flex-stack ">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column flex-grow-1 pe-12 ">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap mb-2">
                                            <!--begin::Stat-->
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">Tanggal Check
                                                In</a>

                                            <!--end::Stat-->
                                        </div>
                                        <div class="d-flex flex-wrap ">
                                            <a href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">{{ $startdates}}</a>
                                        </div>
                                        <!--end::Stats-->
                                    </div>

                                    <div class="d-flex flex-column flex-grow-1 pe-8 ">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap mb-2">
                                            <!--begin::Stat-->
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">Tanggal Check
                                                Out</a>

                                            <!--end::Stat-->
                                        </div>
                                        <div class="d-flex flex-wrap mt-1">
                                            <a href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">{{ $enddates}} (3 Malam)</a>
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Progress-->


                                    <!--end::Progress-->
                                </div>

                                <div class="d-flex flex-wrap flex-stack mt-5 ">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column flex-grow-1">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap mb-2">
                                            <!--begin::Stat-->
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">Jumlah Tamu</a>

                                            <!--end::Stat-->
                                        </div>
                                        <div class="d-flex flex-wrap ">
                                            <a href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">6
                                                Orang</a>
                                        </div>
                                        <!--end::Stats-->
                                    </div>

                                    <div class="d-flex flex-column flex-grow-1 pe-8 ">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap mb-2">
                                            <!--begin::Stat-->
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">Room</a>

                                            <!--end::Stat-->
                                        </div>
                                        <div class="d-flex flex-wrap mt-1">
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">{{$hotelbookdates->hotelroom->name}}</a>
                                        </div>
                                        <!--end::Stats-->
                                    </div>

                                    <!--end::Wrapper-->
                                    <!--begin::Progress-->


                                    <!--end::Progress-->
                                </div>
                                <!--end::Stats-->
                            </div>

                            <!--end::Info-->
                        </div>
                    </div>
                    <!--end:: Body-->
                {{-- </div> --}}
            </div>

            
                <div class="card mb-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Detail Pesanan</h3>
                            <hr class="mt-2 mb-4">
                        </div>
                        <!--begin::Body-->

                        <div class="d-flex flex-wrap flex-sm-nowrap p-3 m-5 mt-4">
                            <!--begin: Pic-->

                            <div class="me-5 mb-0">
                                <div class="symbol symbol-100px symbol-lg-200px symbol-fixed position-relative">
                                    <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="image" />

                                </div>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <!--end::Title-->
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap flex-stack ">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column flex-grow-1 pe-12 ">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-wrap mb-10">
                                            <!--begin::Stat-->
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">Indonesia
                                                Standard Double</a>
                                        </div>
                                        <div class="d-flex flex-wrap mb-10">
                                            <!--begin::Stat-->
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">Room
                                                Size: {{$hotelbookdates->hotelroom->roomsize}} sqft</a>
                                        </div>
                                        <div class="d-flex flex-wrap mb-10">
                                            <!--begin::Stat-->
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">Tersewa {{$hotelbookdates->hotelroom->count()}}
                                            </a>
                                        </div>

                                        <!--end::Stats-->
                                    </div>

                                </div>


                                <!--end::Stats-->
                            </div>

                            <!--end::Info-->
                        </div>
                        <!--end:: Body-->
                    </div>
                </div>
            
        </div>


        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-body w-100">
                    <div class="card-header">
                        <h3 class="card-title">Informasi Pembayaran</h3>
                        <hr class="mt-2 mb-4">
                    </div>
                    <!--begin::Body-->
                    <div class="card-body my-3">

                        <div class="row mb-5">
                            <!-- Tanggal Check In -->
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-2">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1 mb-2">Deluxe
                                        Room</a>
                                    <a href="#" class="text-gray-900 text-hover-primary fs-7 fw-bold me-1">2 Malam</a>
                                </div>
                            </div>

                            <!-- Tanggal Check Out -->
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-2">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">Rp.
                                        51231S</a>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Tanggal Check In -->
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-2">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1 mb-2">Biaya
                                        Penanganan</a>
                                    <a href="#" class="text-gray-900 text-hover-primary fs-7 fw-bold me-1">15 %</a>
                                </div>
                            </div>

                            <!-- Tanggal Check Out -->
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-2">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">Rp.
                                        51231S</a>

                                </div>
                            </div>
                        </div>
                        <hr style="color: #191717; background-color: #191717; height: 1px; border: none;">
                        <div class="row">
                            <!-- Tanggal Check In -->
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-2">
                                    <a href="#"
                                        class="text-gray-900 text-hover-primary fs-5 fw-bold me-1 mb-2">Total
                                        Diterima</a>
                                </div>
                            </div>

                            <!-- Tanggal Check Out -->
                            <div class="col-md-6">
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">Rp.
                                        51231S</a>

                                </div>
                            </div>
                        </div>
                        <hr style="color: #191717; background-color: #191717; height: 1px; border: none;">
                        <div class="row">
                            <!-- Tanggal Check In -->
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-2">
                                    <a href="#"
                                        class="text-gray-900 text-hover-primary fs-7 fw-bold me-1 mb-2">Metode
                                        Pembayaran</a>
                                </div>
                            </div>

                            <!-- Tanggal Check Out -->
                            <div class="col-md-6">
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-7 fw-bold me-1">{{ ucwords(strtolower(str_replace('_', ' ', $hotelbookdates->transaction->payment_method))) }}



                                    </a>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Tanggal Check In -->
                            <div class="col-md-6">
                                <div class="d-flex flex-column mb-2">
                                    <a href="#"
                                        class="text-gray-900 text-hover-primary fs-7 fw-bold me-1 mb-2">Channel
                                        Pembayaran</a>
                                </div>
                            </div>

                            <!-- Tanggal Check Out -->
                            <div class="col-md-6">
                                <div class="d-flex flex-column">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-7 fw-bold me-1">Bank
                                        BNI</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end:: Body-->
                </div>
            </div>
        </div>



        {{-- PERBATASAN --}}





    </div>

    </div>
@endsection
