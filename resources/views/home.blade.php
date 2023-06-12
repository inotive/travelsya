@extends('layouts.web')

@section('content-web')
@include('layouts.include.carousel')

<!-- start::Menubar -->
<!-- <div id="home-menu-bar"></div> -->
@include('layouts.include.home.menu-bar')
<!-- end::Menubar -->

<!--end::Toolbar-->
<div id="kt_content_container" class="container-xl mb-30">
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
                                                              <img alt="" src="{{asset('assets/media/products-categories/icon-plane.png')}}" class="w-50px" />
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
                                                          <img alt="" src="{{asset('assets/media/products-categories/icon-plane.png')}}" class="w-50px" />
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
  @include('layouts.include.home.favorite-hotel')
  
  @include('layouts.include.home.explore-city')
</div>
@endsection

@push('add-script')
<script src="{{asset('assets/js/custom/noTelp.js')}}"></script>

<script>
  var dummyMenus = [
    {
      id: 0,
      isActive: true,
      code: "hotel",
      label: "Hotel",
      image: "../assets/media/products-categories/icon-hotel.png",
      imageHeader: "https://images.unsplash.com/photo-1564501049412-61c2a3083791?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2532&q=80",
      titleHeader: "Cari dan book Hotel untuk hari spesialmu!",
      classImage: "w-40px"
    },{
      id: 1,
      isActive: false,
      code: "plane",
      label: "Pesawat",
      image: "../assets/media/products-categories/icon-plane.png",
      imageHeader: "https://plus.unsplash.com/premium_photo-1679758630312-a3d601c411d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2064&q=80",
      titleHeader: "",
      classImage: "w-40px"
    },{
      id: 2,
      isActive: false,
      code: "train",
      label: "Kereta Api",
      image: "../assets/media/products-categories/icon-kai.png",
      imageHeader: "",
      titleHeader: "",
      classImage: "w-40px"
    },{
      id: 3,
      isActive: false,
      code: "bus",
      label: "Bus & Travel",
      image: "../assets/media/products-categories/icon-bus.png",
      imageHeader: "",
      titleHeader: "",
      classImage: "w-40px"
    },{
      id: 4,
      isActive: false,
      code: "attraction",
      label: "Rekreasi",
      image: "../assets/media/products-categories/icon-rekreasi.png",
      imageHeader: "",
      titleHeader: "",
      classImage: "w-40px"
    },{
      id: 5,
      isActive: false,
      code: "rent-car",
      label: "Rental Mobil",
      image: "../assets/media/products-categories/icon-mobil.png",
      imageHeader: "",
      titleHeader: "",
      classImage: "w-40px"
    },{
      id: 6,
      isActive: true,
      code: "hostel",
      label: "Hostel",
      image: "../assets/media/products-categories/icon-hostel.png",
      imageHeader: "https://plus.unsplash.com/premium_photo-1661963540233-94097ba21f27?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2062&q=80",
      titleHeader: "Cari dan book Hostel untuk harian, mingguan, bulanan disini!",
      classImage: "w-40px"
    },{
      id: 7,
      isActive: false,
      code: "pln",
      label: "PLN",
      image: "../assets/media/products-categories/icon-pln.png",
      imageHeader: "",
      titleHeader: "",
      classImage: "w-30px"
    },{
      id: 8,
      isActive: true,
      code: "bpjs",
      label: "BPJS",
      image: "../assets/media/products-categories/icon-bpjs.png",
      imageHeader: "https://images.unsplash.com/photo-1528642474498-1af0c17fd8c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1769&q=80",
      titleHeader: "Bayar BPJS sekarang lebih mudah melalui Travelsya!",
      classImage: "w-30px"
    },{
      id: 9,
      isActive: true,
      code: "pdam",
      label: "PDAM",
      image: "../assets/media/products-categories/icon-pdam.png",
      imageHeader: "https://images.unsplash.com/photo-1526599256864-6bedb9d7dfb5?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1771&q=80",
      titleHeader: "Bayar PDAM sekarang lebih mudah melalui Travelsya!",
      classImage: "w-40px"
    },{
      id: 10,
      isActive: false,
      code: "bank-transfer",
      label: "Transfer Bank",
      image: "../assets/media/products-categories/icon-transfer.png",
      imageHeader: "",
      titleHeader: "",
      classImage: "w-40px"
    },{
      id: 11,
      isActive: false,
      code: "e-wallet",
      label: "E-Wallet",
      image: "../assets/media/products-categories/icon-wallet.png",
      imageHeader: "",
      titleHeader: "",
      classImage: "w-40px"
    },{
      id: 12,
      isActive: true,
      code: "pulsa",
      label: "Pulsa & Data",
      image: "../assets/media/products-categories/icon-pulsa.png",
      imageHeader: "https://plus.unsplash.com/premium_photo-1664195539623-e25ce8e8d64b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80",
      titleHeader: "Isi pulsa dan paket datamu disini!",
      classImage: "w-40px"
    },{
      id: 13,
      isActive: true,
      code: "tv",
      label: "TV Berbayar",
      image: "../assets/media/products-categories/icon-tv.png",
      imageHeader: "https://images.unsplash.com/photo-1595935736128-db1f0a261263?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2971&q=80",
      titleHeader: "Bayar TV kabel sekarang lebih mudah melalui Travelsya!",
      classImage: "w-30px"
    },{
      id: 14,
      isActive: true,
      code: "pajak",
      label: "Pajak",
      image: "../assets/media/products-categories/icon-pajak.png",
      imageHeader: "https://images.unsplash.com/photo-1598432439250-0330f9130e14?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1770&q=80",
      titleHeader: "Bayar Pajak sekarang lebih mudah melalui Travelsya!",
      classImage: "w-30px"
    }
  ]

  var dummyCities = [
    {
      id: 0,
      name: 'balikpapan',
      label: 'Balikpapan'
    },{
      id: 1,
      name: 'bontang',
      label: 'Bontang'
    },{
      id: 2,
      name: 'samarinda',
      label: 'Samarinda'
    },{
      id: 3,
      name: 'sangatta',
      label: 'Sangatta'
    },{
      id: 4,
      name: 'tenggarong',
      label: 'Tenggarong'
    },{
      id: 5,
      name: 'banjarmasin',
      label: 'Banjarmasin'
    }
  ]

  var dummyExploreCities = [
    {
      id: 0,
      label: "Welcome to Bali",
      image: "https://service.travelsya.com/bahan/kota_1.png"
    },
    {
      id: 1,
      label: "Welcome to Yogyakarta",
      image: "https://service.travelsya.com/bahan/kota_2.png"
    },
    {
      id: 2,
      label: "Welcome to Jakarta",
      image: "https://service.travelsya.com/bahan/kota_3.png"
    },
    {
      id: 3,
      label: "Welcome to Surabaya",
      image: "https://service.travelsya.com/bahan/kota_4.png"
    },
    {
      id: 4,
      label: "Welcome to Bandung",
      image: "https://service.travelsya.com/bahan/kota_5.png"
    },
  ]

  var dummyFavoriteHotel = [
    {
      id: 0,
      label: "Hotel Mulia Jakarta",
      city: "Jakarta",
      image: "https://www.kayak.co.id/rimg/himg/ec/0f/60/ice-122686-64795234_3XL-516024.jpg",
      price: 1300000,
      realPrice: 825000,
      rate: 3,
      totalRate: 12
    },
    {
      id: 1,
      label: "Hotel Mulia Jakarta",
      city: "Jakarta",
      image: "https://www.kayak.co.id/rimg/himg/ec/0f/60/ice-122686-64795234_3XL-516024.jpg",
      price: 1300000,
      realPrice: 825000,
      rate: 3,
      totalRate: 12
    },
    {
      id: 2,
      label: "Hotel Mulia Jakarta",
      city: "Jakarta",
      image: "https://www.kayak.co.id/rimg/himg/ec/0f/60/ice-122686-64795234_3XL-516024.jpg",
      price: 1300000,
      realPrice: 825000,
      rate: 3,
      totalRate: 12
    },
    {
      id: 3,
      label: "Hotel Mulia Jakarta",
      city: "Jakarta",
      image: "https://www.kayak.co.id/rimg/himg/ec/0f/60/ice-122686-64795234_3XL-516024.jpg",
      price: 1300000,
      realPrice: 825000,
      rate: 3,
      totalRate: 12
    }
  ]

  document.addEventListener('alpine:init', () => {
    Alpine.data('menubar', () => ({
      menus: dummyMenus,
      mode: {}, 
      handleClickMenu(data) {
        this.mode = data
      },
    })),
    Alpine.data('hotel', () => ({
      cities: dummyCities
    })),
    Alpine.data('explorecity', () => ({
      exploreCities: dummyExploreCities
    })),
    Alpine.data('favoritehotel', () => ({
      favoriteHotel: dummyFavoriteHotel
    }))
  })

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