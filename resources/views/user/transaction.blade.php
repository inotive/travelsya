@extends('layouts.web')

@section('content-web')

<div id="kt_content_container" class="container-xxl">
    <div class="row mb-20">
        <div class="col-md-4">
            @include('layouts.include.menu-user')
        </div>
        <div class="col-md-8">
            <!--begin::details View-->
            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                <!--begin::Card header-->
                <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h2 class="fw-bold m-0 fs-1">Riwayat Pesanan</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->

                <!--begin::Card body-->
                <div class="card-body p-9">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-pills nav-pills-custom mb-3 main-menu">
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6 ">
                                    <!--begin::Link-->
                                    <a class="nav-link d-flex justify-content-between flex-column active flex-center overflow-hidden py-3" data-bs-toggle="pill" href="#semua">
                                        <!--begin::Icon-->
                                        <div class="nav-icon">
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Subtitle-->
                                        <span class=" nav-text text-gray-700 fw-bold fs-6 lh-1">
                                            Semua
                                        </span>
                                        <!--end::Subtitle-->

                                        <!--begin::Bullet-->
                                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6 li-main-menu">
                                    <!--begin::Link-->
                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden py-3" data-bs-toggle="pill" href="#aktif">
                                        <!--begin::Icon-->
                                        <div class="nav-icon">
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Subtitle-->
                                        <span class=" nav-text text-gray-700 fw-bold fs-6 lh-1">
                                            Pesanan Aktif
                                        </span>
                                        <!--end::Subtitle-->

                                        <!--begin::Bullet-->
                                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <li class="nav-item mb-3 me-3 me-lg-6 li-main-menu">
                                    <!--begin::Link-->
                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden py-3" data-bs-toggle="pill" href="#riwayat">
                                        <!--begin::Icon-->
                                        <div class="nav-icon">
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Subtitle-->
                                        <span class=" nav-text text-gray-700 fw-bold fs-6 lh-1">
                                            Riwayat
                                        </span>
                                        <!--end::Subtitle-->

                                        <!--begin::Bullet-->
                                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-12">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="semua">
                                    <div class="card card-bordered mb-3">
                                        <div class="card-body py-5">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="p-3 bg-secondary rounded-circle bg-opacity-20 me-5">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-rekreasi.png')}}" class="w-35px" />
                                                </div>
                                                <div class="">

                                                    <h3 class="fw-bold mb-3">Meiso Kelapa gading</h3>
                                                    <p class="text-gray-500">Reflelxiology 30 menit</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer py-5 d-flex justify-content-between">
                                            <span class="fs-5 text-danger fw-bold">Menunggu Pembayaran</span>
                                            <a href="#">
                                                <i class="fa fa-chevron-right fa-lg text-dark"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card card-bordered mb-3">
                                        <div class="card-body py-5">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="p-3 bg-secondary rounded-circle bg-opacity-20 me-5">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-plan.png')}}" class="w-35px" />
                                                </div>
                                                <div class="">
                                                    <h3 class="fw-bold mb-3">SOEKARNO HATTA - JUANDA</h3>
                                                    <p class="text-gray-500">Citilink CTL-9129, EKONOMI</p>
                                                    <p class="text-gray-500">Senin, 02 Des 2023 | 06.00 | 1j 30m</p>
                                                    <h3 class="fw-bold mb-3">JUANDA - SOEKARNO HATTA</h3>
                                                    <p class="text-gray-500">Citilink CTL-929, EKONOMI</p>
                                                    <p class="text-gray-500">Senin, 02 Des 2023 | 16.00 | 1j 30m</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer py-5 d-flex justify-content-between">
                                            <span class="fw-bold text-gray-500">Selesai</span>
                                            <a href="#">
                                                <i class="fa fa-chevron-right fa-lg text-dark"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="card card-bordered mb-3">
                                        <div class="card-body py-5">
                                            <div class="d-flex align-items-start mb-3">
                                                <div class="p-3 bg-secondary rounded-circle bg-opacity-20 me-5">
                                                    <img alt="" src="{{asset('assets/media/products-categories/icon-hotel.png')}}" class="w-35px" />
                                                </div>
                                                <div class="">
                                                    <h3 class="fw-bold mb-3">MACCA VILLAS AND SPA SEMINYAK</h3>
                                                    <p class="text-gray-500">1x Kamar Deluxe Double atau Ranjang Lain - Pemandangan Kota</p>
                                                    <p class="text-gray-500">12 Feb 2023 - 20 Feb 2023</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer py-5 d-flex justify-content-between">
                                            <span class="fw-bold text-gray-500">Selesai</span>
                                            <a href="#">
                                                <i class="fa fa-chevron-right fa-lg text-dark"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::details View-->
        </div>
    </div>
</div>
@endsection

@push('add-style')
<style>
    body {
        background-size: 100% 80px !important;
    }

    .menu-user a:hover {
        color: blue !important;
    }

    .menu-user a.active {
        color: blue !important;
    }
</style>
@endpush