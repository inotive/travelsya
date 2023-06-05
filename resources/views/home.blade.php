@extends('layouts.web')

@section('content-web')
@include('layouts.include.carousel')

<!-- start::Menubar -->
@include('layouts.include.home.menu-bar')
<!-- end::Menubar -->

<!--end::Toolbar-->
<div id="kt_content_container" class="container-xxl mb-30">

    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-xl-12 mb-xl-12">

            <!--begin::Table widget 2-->
            <div class="card h-md-100">
                <!--begin::Header-->
                <div class="card-header align-items-center border-0">
                </div>
                <!--end::Header-->

                <!--begin::Table widget 2-->
                <div class="card mb-10">
                    <!--begin::Body-->
                    <div class="card-body pt-2">
                        <div class="row">
                            <div class="col-md-7">
                                <div class="col-md-12">
                                    <ul class="nav nav-pills nav-pills-custom mb-3 main-menu">
                                        <!--begin::Item-->
                                        <li class="nav-item mb-3 me-3 me-lg-6 ">
                                            <!--begin::Link-->
                                            <a class="nav-link d-flex justify-content-between flex-column active flex-center overflow-hidden" data-bs-toggle="pill" href="#semua">
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
                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden" data-bs-toggle="pill" href="#penginapan">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class=" nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    Penginapan
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
                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden" data-bs-toggle="pill" href="#transportasi">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class=" nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    Transportasi
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
                                            <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden" data-bs-toggle="pill" href="#topuptagihan">
                                                <!--begin::Icon-->
                                                <div class="nav-icon">
                                                </div>
                                                <!--end::Icon-->

                                                <!--begin::Subtitle-->
                                                <span class=" nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                    Topup & Tagihan
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
                                <div class="col-md-12 ">
                                    <div class="tab-content main">
                                        <div class="tab-pane fade show active" id="semua">

                                            <div class="nav nav-pills nav-pills-custom mb-3 items">
                                                <div class="d-flex flex-nowrap">
                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link d-flex justify-content-between flex-column active flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#hotel">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-hotel.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class=" nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                Hotel
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pesawat">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-plan.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                Pesawat
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#kai">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-kai.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                Kereta Api
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#bustravel">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-bus.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                Bus & Travel
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#rekreasi">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-rekreasi.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                Rekreasi
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#mobil">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-mobil.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                Rental Mobil
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#hostel">

                                                            <!--begin::Icon-->
                                                            <div class=" nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-hostel.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                Hostel
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6 ">
                                                        <!--begin::Link-->
                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pln">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-pln.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                PLN
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->
                                                </div>
                                                <div class="d-flex flex-nowrap">
                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link @if(last(request()->segments()) == 'bpjs') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#bpjs">
                                                            <!--begin::Icon-->
                                                            <div class=" nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-bpjs.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                BPJS
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link @if(last(request()->segments()) == 'pdam') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pdam">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-pdam.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                PDAM
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#transferbank">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-transfer.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                Transfer Bank
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#ewallet">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-wallet.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                E-Wallet
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link @if(last(request()->segments()) == 'pulsa') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pulsa">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-pulsa.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                Pulsa
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link @if(last(request()->segments()) == 'data') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#data">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-pulsa.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                Data
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link @if(last(request()->segments()) == 'tv-internet') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#tvinernet">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-tv.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                TV - Internet
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pajak">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-pajak.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                Pajak
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->
                                                </div>
                                            </div>

                                        </div>
                                        <div class="tab-pane fade" id="penginapan">
                                            <ul class="nav nav-pills nav-pills-custom mb-3">
                                                <!--begin::Item-->
                                                <div class="nav-item mb-3 me-3 me-lg-6">
                                                    <!--begin::Link-->
                                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#hotel">
                                                        <!--begin::Icon-->
                                                        <div class="nav-icon">
                                                            <img alt="" src="{{asset('assets/media/products-categories/icon-hotel.png')}}" class="w-50px" />
                                                        </div>
                                                        <!--end::Icon-->

                                                        <!--begin::Subtitle-->
                                                        <span class=" nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                            Hotel
                                                        </span>
                                                        <!--end::Subtitle-->

                                                        <!--begin::Bullet-->
                                                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                        <!--end::Bullet-->
                                                    </a>
                                                    <!--end::Link-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="nav-item mb-3 me-3 me-lg-6">
                                                    <!--begin::Link-->
                                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#hostel">

                                                        <!--begin::Icon-->
                                                        <div class=" nav-icon">
                                                            <img alt="" src="{{asset('assets/media/products-categories/icon-hostel.png')}}" class="w-50px" />
                                                        </div>
                                                        <!--end::Icon-->

                                                        <!--begin::Subtitle-->
                                                        <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                            Hostel
                                                        </span>
                                                        <!--end::Subtitle-->

                                                        <!--begin::Bullet-->
                                                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                        <!--end::Bullet-->
                                                    </a>
                                                    <!--end::Link-->
                                                </div>
                                                <!--end::Item-->

                                            </ul>
                                        </div>
                                        <div class="tab-pane fade" id="transportasi">
                                            <ul class="nav nav-pills nav-pills-custom mb-3">
                                                <!--begin::Item-->
                                                <div class="nav-item mb-3 me-3 me-lg-6">
                                                    <!--begin::Link-->
                                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pesawat">
                                                        <!--begin::Icon-->
                                                        <div class="nav-icon">
                                                            <img alt="" src="{{asset('assets/media/products-categories/icon-plan.png')}}" class="w-50px" />
                                                        </div>
                                                        <!--end::Icon-->

                                                        <!--begin::Subtitle-->
                                                        <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                            Pesawat
                                                        </span>
                                                        <!--end::Subtitle-->

                                                        <!--begin::Bullet-->
                                                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                        <!--end::Bullet-->
                                                    </a>
                                                    <!--end::Link-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="nav-item mb-3 me-3 me-lg-6">
                                                    <!--begin::Link-->
                                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#kai">
                                                        <!--begin::Icon-->
                                                        <div class="nav-icon">
                                                            <img alt="" src="{{asset('assets/media/products-categories/icon-kai.png')}}" class="w-50px" />
                                                        </div>
                                                        <!--end::Icon-->

                                                        <!--begin::Subtitle-->
                                                        <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                            Kereta Api
                                                        </span>
                                                        <!--end::Subtitle-->

                                                        <!--begin::Bullet-->
                                                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                        <!--end::Bullet-->
                                                    </a>
                                                    <!--end::Link-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="nav-item mb-3 me-3 me-lg-6">
                                                    <!--begin::Link-->
                                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#bustravel">
                                                        <!--begin::Icon-->
                                                        <div class="nav-icon">
                                                            <img alt="" src="{{asset('assets/media/products-categories/icon-bus.png')}}" class="w-50px" />
                                                        </div>
                                                        <!--end::Icon-->

                                                        <!--begin::Subtitle-->
                                                        <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                            Bus & Travel
                                                        </span>
                                                        <!--end::Subtitle-->

                                                        <!--begin::Bullet-->
                                                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                        <!--end::Bullet-->
                                                    </a>
                                                    <!--end::Link-->
                                                </div>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <div class="nav-item mb-3 me-3 me-lg-6">
                                                    <!--begin::Link-->
                                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#mobil">
                                                        <!--begin::Icon-->
                                                        <div class="nav-icon">
                                                            <img alt="" src="{{asset('assets/media/products-categories/icon-mobil.png')}}" class="w-50px" />
                                                        </div>
                                                        <!--end::Icon-->

                                                        <!--begin::Subtitle-->
                                                        <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                            Rental Mobil
                                                        </span>
                                                        <!--end::Subtitle-->

                                                        <!--begin::Bullet-->
                                                        <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                        <!--end::Bullet-->
                                                    </a>
                                                    <!--end::Link-->
                                                </div>
                                                <!--end::Item-->
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade" id="topuptagihan">
                                            <div class="nav nav-pills nav-pills-custom mb-3 items">

                                                <div class="d-flex flex-nowrap">

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6 ">
                                                        <!--begin::Link-->
                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pln">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-pln.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                PLN
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link @if(last(request()->segments()) == 'bpjs') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#bpjs">
                                                            <!--begin::Icon-->
                                                            <div class=" nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-bpjs.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                BPJS
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link @if(last(request()->segments()) == 'pdam') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pdam">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-pdam.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                PDAM
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#transferbank">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-transfer.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                Transfer Bank
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#ewallet">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-wallet.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                E-Wallet
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->
                                                </div>
                                                <div class="d-flex flex-nowrap">
                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link @if(last(request()->segments()) == 'pulsa') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pulsa">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-pulsa.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                Pulsa
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link @if(last(request()->segments()) == 'data') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#data">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-pulsa.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                Data
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link @if(last(request()->segments()) == 'tv-internet') active @endif d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#tvinernet">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-tv.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                TV - Internet
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->

                                                    <!--begin::Item-->
                                                    <div class="nav-item mb-3 me-3 me-lg-6">
                                                        <!--begin::Link-->
                                                        <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-125px h-125px py-6" data-bs-toggle="pill" href="#pajak">
                                                            <!--begin::Icon-->
                                                            <div class="nav-icon">
                                                                <img alt="" src="{{asset('assets/media/products-categories/icon-pajak.png')}}" class="w-50px" />
                                                            </div>
                                                            <!--end::Icon-->

                                                            <!--begin::Subtitle-->
                                                            <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                                                Pajak
                                                            </span>
                                                            <!--end::Subtitle-->

                                                            <!--begin::Bullet-->
                                                            <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                                            <!--end::Bullet-->
                                                        </a>
                                                        <!--end::Link-->
                                                    </div>
                                                    <!--end::Item-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <!--begin::Tab Content-->
                                <div class="tab-content">
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade show active form-menu" id="hotel">
                                        <div class="">
                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">Cari dan book hotel untuk hari spesialmu!</h2>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <!--begin::Input-->
                                                    <select name="lokasi" id="lokasi" class="form-control">
                                                        <option value="Jakarta">Jakarta</option>
                                                        <option value="Jakarta">Bandung</option>
                                                    </select>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-md-6 mb-5">
                                                    <!--begin::Input-->
                                                    <input type="text" class="form-control js-daterangepicker">
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-md-6">
                                                    <!--begin::Input-->
                                                    <select name="lokasi" id="kamar" class="form-control">
                                                        @for($i=1;$i<5;$i++) <option value="1">{{$i}} Kamar</option>
                                                            @endfor
                                                    </select>
                                                    <!--end::Input-->
                                                </div>
                                                <div class="col-md-6">
                                                    <!--begin::Input-->
                                                    <select name="lokasi" id="tamu" class="form-control">
                                                        @for($i=1;$i<5;$i++) <option value="1">{{$i}} Tamu</option>
                                                            @endfor
                                                    </select>
                                                    <!--end::Input-->
                                                </div>

                                            </div>
                                            <div class="text-end">
                                                <button class="btn btn-danger py-4 mt-10">Cari Hotel</button>
                                            </div>

                                        </div>
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade form-menu" id="pesawat">
                                        <!--begin::Table container-->
                                        Pesawat
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->

                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade form-menu " id="kai">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            KAI
                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->

                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade form-menu " id="bustravel">
                                        <!--begin::Table container-->
                                        Bus & Travel
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->

                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade form-menu " id="rekreasi">
                                        <!--begin::Table container-->
                                        Rekreasi
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->

                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade form-menu " id="mobil">
                                        <!--begin::Table container-->
                                        Rental Mobil
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade form-menu " id="hostel">
                                        <!--begin::Table container-->
                                        <div class="">

                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">Cari dan book hotel untuk hari spesialmu!</h2>
                                            <form action="{{route('hostel.index')}}" method="get">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <select name="city" id="city" class="form-control">
                                                            @foreach($cities as $city)
                                                            <option value="{{$city}}">{{$city}}</option>
                                                            @endforeach
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="col-md-6 mb-5">
                                                        <!--begin::Input-->
                                                        <input type="text" name="date" class="form-control js-daterangepicker">
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <select name="room" id="kamar" class="form-control">
                                                            @for($i=1;$i<5;$i++) <option value="{{$i}}">{{$i}} Kamar</option>
                                                                @endfor
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="col-md-6">
                                                        <!--begin::Input-->
                                                        <select name="guest" id="tamu" class="form-control">
                                                            @for($i=1;$i<5;$i++) <option value="{{$i}}">{{$i}} Tamu</option>
                                                                @endfor
                                                        </select>
                                                        <!--end::Input-->
                                                    </div>

                                                </div>
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-danger py-4 mt-10">Cari Hotel</button>
                                                </div>
                                            </form>

                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade form-menu " id="pln">
                                        <!--begin::Table container-->
                                        <div class="">
                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">PLN Prabayar dan Pascabayar</h2>
                                            <label class="fs-5 fw-semibold mb-2">
                                                <span class="required">No Meter PLN</span>
                                            </label>

                                            <!--begin::Input-->
                                            <input type="text" id="" class="form-control mb-10" name="notelp" placeholder="" value="" />
                                            <!--end::Input-->
                                            <div class="text-end">
                                                <button class="btn btn-danger py-4 ">Checkout</button>
                                            </div>

                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade form-menu " id="bpjs">
                                        <!--begin::Table container-->
                                        <div class="">
                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">Nikmati fitur BPJS</h2>
                                            <label class="fs-5 fw-semibold mb-2">
                                                <span class="required">No BPJS</span>
                                            </label>

                                            <!--begin::Input-->
                                            <input type="text" id="" class="form-control mb-10" name="notelp" placeholder="" value="" />
                                            <!--end::Input-->
                                            <div class="text-end">
                                                <button class="btn btn-danger py-4 ">Checkout</button>
                                            </div>

                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade form-menu " id="pdam">
                                        <!--begin::Table container-->
                                        <div class="">
                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">PDAM</h2>
                                            <label class="fs-5 fw-semibold mb-2">
                                                <span class="required">No Langganan</span>
                                            </label>

                                            <!--begin::Input-->
                                            <input type="text" id="" class="form-control mb-10" name="notelp" placeholder="" value="" />
                                            <!--end::Input-->
                                            <div class="text-end">
                                                <button class="btn btn-danger py-4 ">Checkout</button>
                                            </div>

                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade form-menu " id="transferbank">
                                        <!--begin::Table container-->
                                        Transfer bank
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade form-menu " id="ewallet">
                                        <!--begin::Table container-->
                                        e-wallet
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade form-menu " id="pulsa">
                                        <div class="">
                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">Pulsa dengan harga terbaik</h2>
                                            <form action="{{route("cart")}}" method="post">
                                                @csrf
                                                <input type="text" name="service" id="service" value="pulsa" hidden>
                                                <label class="fs-5 fw-semibold mb-2">
                                                    <span class="required">No Ponsel</span>
                                                </label>

                                                <!--begin::Input-->
                                                <input type="text" id="notelp" class="form-control mb-5 notelp" data-cat="pulsa" name="notelp" placeholder="" value="" />
                                                <!--end::Input-->
                                                <!--begin::Input-->
                                                <select name="pricelist" id="row-pricelist-pulsa" class="form-control mb-10">
                                                    <option value="0">Nominal Pulsa</option>
                                                </select>
                                                <!--end::Input-->
                                                <div class="text-end">
                                                    <button class="btn btn-danger py-4 ">Checkout</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade form-menu " id="data">
                                        <!--begin::Table container-->
                                        <div class="">
                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">Paket Internet dengan harga terbaik</h2>
                                            <form action="{{route("cart")}}" method="post">
                                                @csrf
                                                <input type="text" name="service" id="service" value="data" hidden>
                                                <label class="fs-5 fw-semibold mb-2">
                                                    <span class="required">No Ponsel</span>
                                                </label>

                                                <!--begin::Input-->
                                                <input type="text" id="" class="form-control mb-5 notelp" data-cat="data" name="notelp" placeholder="" value="" />
                                                <!--end::Input-->
                                                <!--begin::Input-->
                                                <select name="pricelist" id="row-pricelist-data" class="form-control mb-10">
                                                    <option value="0">Paket Data</option>
                                                </select>
                                                <!--end::Input-->
                                                <div class="text-end">
                                                    <button class="btn btn-danger py-4 ">Checkout</button>
                                                </div>
                                            </form>

                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade form-menu " id="tvinernet">
                                        <!--begin::Table container-->
                                        <div class="">
                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">Bayar tagihan jadi lebih mudah</h2>
                                            <label class="fs-5 fw-semibold mb-2">
                                                <span class="required">No Tagihan</span>
                                            </label>

                                            <!--begin::Input-->
                                            <input type="text" id="" class="form-control mb-10" name="notelp" placeholder="" value="" />
                                            <!--end::Input-->
                                            <div class="text-end">
                                                <button class="btn btn-danger py-4 ">Checkout</button>
                                            </div>

                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade form-menu " id="pajak">
                                        <div class="">
                                            <h2 class="fw-bold text-gray-900 m-0 mb-10">Orang bijak bayar pajak</h2>
                                            <label class="fs-5 fw-semibold mb-2">
                                                <span class="required">No NPWP/KTP</span>
                                            </label>

                                            <!--begin::Input-->
                                            <input type="text" id="" class="form-control mb-10" name="notelp" placeholder="" value="" />
                                            <!--end::Input-->
                                            <div class="text-end">
                                                <button class="btn btn-danger py-4 ">Checkout</button>
                                            </div>

                                        </div>
                                    </div>
                                    <!--end::Tap pane-->
                                </div>
                                <!--end::Tab Content-->
                            </div>
                        </div>
                    </div>
                    <!--end: Card Body-->
                </div>
                <!--end::Table widget 2-->

            </div>
            <!--end::Table widget 2-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
    <div class="row">
        <h2 class="fw-bold mb-3 mt-4">Yang Paling Populer</h2>
        <div class="col-md-6">
            <p class="fs-4 text-gray-700 mb-10">Hotel yang paling sering dikunjungi saat liburan</p>
        </div>
        <div class="col-md-6 text-end">
            <a href="#" class="text-danger fs-4 fw-bold">Lihat Semua</a>
        </div>

    </div>


    <div class="row justify-content-between">
        @foreach($hostelPopulers as $key => $hostel)
        @if($key == 4)
        @break
        @endif
        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top h-200px" src="{{(count($hostel['hostel_image']) > 0) ? $hostel['hostel_image'][0]['image'] : '../assets/media/stock/food/img-2.jpg'}}" alt="Card image cap">
                <div class="card-body p-5">
                    <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">{{$hostel['name']}}</span>
                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-1">Tanah Abang, {{$hostel['city']}}</span>
                    <span class="text-gray-400 fw-semibold d-block mt-5">Mulai dari <s>{{$hostel['price_avg']}}</s></span>
                    <span class="text-danger text-end fw-bold fs-1 mt-2">IDR {{$hostel['price_avg']}}</span>
                    <span class="text-gray-600 cursor-pointer d-block  mt-5 text-align-center">
                        <span class="fa fa-star fs-4" style="color: red;"></span> {{$hostel['rating_avg']}} <span class="text-gray-400">({{$hostel['rating_count']}})</span>
                    </span>
                </div>
            </div>
        </div>
        <!-- <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="../assets/media/stock/food/img-2.jpg" alt="Card image cap">
                <div class="card-body p-5">
                    <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">Golden Boutique Hotel Melawai Blok M</span>
                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-1">Tanah Abang, Jakarta</span>
                    <span class="text-gray-400 fw-semibold d-block mt-5">Mulai dari <s>750,000</s></span>
                    <span class="text-danger text-end fw-bold fs-1 mt-2">IDR 570,000</span>
                    <span class="text-gray-600 cursor-pointer d-block  mt-5 text-align-center">
                        <span class="fa fa-star fs-4" style="color: red;"></span> 4,3 <span class="text-gray-400">(436)</span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="../assets/media/stock/food/img-2.jpg" alt="Card image cap">
                <div class="card-body p-5">
                    <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">Golden Boutique Hotel Melawai Blok M</span>
                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-1">Tanah Abang, Jakarta</span>
                    <span class="text-gray-400 fw-semibold d-block mt-5">Mulai dari <s>750,000</s></span>
                    <span class="text-danger text-end fw-bold fs-1 mt-2">IDR 570,000</span>
                    <span class="text-gray-600 cursor-pointer d-block  mt-5 text-align-center">
                        <span class="fa fa-star fs-4" style="color: red;"></span> 4,3 <span class="text-gray-400">(436)</span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <img class="card-img-top" src="../assets/media/stock/food/img-2.jpg" alt="Card image cap">
                <div class="card-body p-5">
                    <span class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">Golden Boutique Hotel Melawai Blok M</span>
                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-1">Tanah Abang, Jakarta</span>
                    <span class="text-gray-400 fw-semibold d-block mt-5">Mulai dari <s>750,000</s></span>
                    <span class="text-danger text-end fw-bold fs-1 mt-2">IDR 570,000</span>
                    <span class="text-gray-600 cursor-pointer d-block  mt-5 text-align-center">
                        <span class="fa fa-star fs-4" style="color: red;"></span> 4,3 <span class="text-gray-400">(436)</span>
                    </span>
                </div>
            </div>
        </div> -->
        @endforeach
    </div>

</div>
<!--end::Row-->
<div class="bg-white mt-20">
    <div class="container-xxl py-10">
        <div class="row">
            <h2 class="fw-bold mb-3 mt-4">Jelajahi Sudut Kota</h2>
            <p class="fs-4 text-gray-700 mb-10">Ada berbagai pilihan destinasi liburan dengan harga spesial lho, jangan sampai kelewatan</p>
        </div>
        <div class="row">
            <div class="col-md-2">
                <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100">
            </div>
            <div class="col-md-2">
                <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100">
            </div>
            <div class="col-md-2">
                <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100">
            </div>
            <div class="col-md-2">
                <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100">
            </div>
            <div class="col-md-2">
                <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100">
            </div>
            <div class="col-md-2">
                <img src="https://fastly.picsum.photos/id/352/300/200.jpg?hmac=uE24cIWqkmFTjbnCcvGEkIF6iCPiJtS2N2lbaa0ku9w" alt="..." class="img-thumbnail w-100">
            </div>
        </div>
    </div>

</div>
@endsection

@push('add-script')
<script src="{{asset('assets/js/custom/noTelp.js')}}"></script>

<script>
    $(document).ready(function() {
        var today = new Date(); 
        $('.js-daterangepicker').daterangepicker({
minDate:today,
});
        const {
            getOperator
        } = window.NoTelp;
        $('.notelp').on('keyup', function(e) {
            var cat = $(this).data('cat');
            var notelp = e.target.value;
            var operatorTelp1 = getOperator(notelp);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            if (operatorTelp1.valid) {
                $.ajax({
                    url: "{{ url('/ajax/ppob') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        operator: operatorTelp1.operator,
                        category: cat
                    },
                    success: function(response) {

                        if (response.message != 'Unauthorized') {
                            if (cat == "pulsa")
                                $('#row-pricelist-pulsa').html('');

                            if (cat == "data")
                                $('#row-pricelist-data').html('');


                            $.each(response, function(key, val) {
                                if (cat == "pulsa") {

                                    $('#row-pricelist-pulsa').append(
                                        `<option value="${val.id}">${val.description} - ${val.price}</option>`
                                    )
                                }
                                if (cat == "data") {

                                    $('#row-pricelist-data').append(
                                        `<option value="${val.id}">${val.description} - ${val.price}</option>`
                                    )
                                }

                            });
                        } else {
                            `<option value=0>Login First</option>`
                        }
                    }
                })
            }
        })

    })
</script>
@endpush