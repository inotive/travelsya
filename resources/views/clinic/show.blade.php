@extends('layouts.web')

@section('content-web')
    <!--begin::Container-->
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">

      <div class="content flex-row-fluid mb-10" id="kt_content">

        <div class="row card w-75 me-auto ms-auto mt-10" id="card-filter">
          <div class="row gy-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body h-100">
                        <form method="GET" action="{{ route('recreations.index') }}" class="row g-4">
                            <div class="col-4">
                                <label class="form-label fw-bold fs-6">Pilih Lokasi</label>
                                <select name="location" id="location" class="form-select form-select-lg">
                                    <option value="balikpapan">Balikpapan</option>
                                    <option value="samarinda">Samarinda</option>
                                </select>
  
                            </div>
                            <div class="col-4">
                              <label class="fs-5 fw-semibold mb-2">
                                <span class="required">Jenis Tindakan</span>
                            </label>
                            <select name="type" id="type" class="form-select form-select-lg">
                          
                              <option value="beauty">Klinik Kecantikan</option>
                              <option value="teeth">Klinik Gigi</option>
                              <option value="general">Klinik Umum</option>
                          </select>
                            </div>
  
                            <div class="col-4">
                              <label class="fs-5 fw-semibold mb-2">
                                <span class="required">Cari Klinik</span>
                            </label>
                            <input type="text" id="keyword" class="form-control form-control-lg"
                                name="keyword" placeholder="Masukan kata kunci" value="" />
                            </div>
                            
  
                            <div class="col-12">
                                <button type="submit" class="w-100 btn-danger btn">Cari Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
          </div>
  
        </div>


        <div class="row card w-75 me-auto ms-auto mt-10">
          <div class="col-md-12">
              <div class="card">
                  <div class="card-body">
                      <div class="row">
                          <div class="col-4">
                            
                             
                              <a class="d-block overlay" data-fslightbox="lightbox-basic"
                                  href="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                                  <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                      style="background-image:url('https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
                                  </div>
                                  <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                      <i class="bi bi-eye-fill text-white fs-3x"></i>
                                  </div>
                              </a>

                          </div>
                          <div class="col-8 d-flex flex-column">
                            
                              <div class="row">
                                  <div class="col-12">
                                      <div class="d-flex justify-content-between">
                                          <h1 class="fw-bold">Klinik Kecantikan Aurem Derm</h1>
                                          <div class="badge badge-primary">Balikpapan</div>
                                      </div>
                                      <p style="font-size: 13px">Komplek Balikpapan Super Blok, Ruko Blok C No. 19-25, Jl. Jendral Sudirman, Damai, Kec. Balikpapan Kota, Kota Balikpapan, Kalimantan Timur 76114</p>

                                      <div id="bintang" class="mb-1">
                                          @for ($i = 1; $i <= 5; $i++)
                                              <span class="card-text fa fa-star" style="color: orange;"></span>
                                          @endfor
                                      </div>
                                     

                                      <div class="separator"></div>
                                      <div class="row mt-1">
                                          <div class="col-md-2">
                                              <div class="fw-semibold text-gray-600 fs-7">Phone:</div>
                                          </div>
                                          <div class="col">
                                              <div class="fw-bold text-gray-800 fs-6">
                                                  {{ "08987654345" ?? '-' }}</div>
                                          </div>
                                      </div>
                                      <div class="row">
                                          <div class="col-md-2">
                                              <div class="fw-semibold text-gray-600 fs-7">Website:</div>
                                          </div>

                                          @php
                                              $website = "www.calmspa.com";
                                          @endphp


                                          <div class="col">
                                              <div class="fw-bold text-gray-800 fs-6">
                                                  {!! isset($website)
                                                      ? '<a href="' .
                                                          (str_starts_with($website, 'http://') || str_starts_with($website, 'https://')
                                                              ? $website
                                                              : 'http://' . $website) .
                                                          '" target="_blank" rel="noopener">' .
                                                          (str_starts_with($website, 'http://') || str_starts_with($website, 'https://')
                                                              ? substr($website, strpos($website, '://') + 3)
                                                              : $website) .
                                                          '</a>'
                                                      : '-' !!}
                                              </div>
                                          </div>
                                      </div>
                                      <div class="row mb-1">
                                          <div class="col-md-2">
                                              <div class="fw-semibold text-gray-600 fs-7">Email:</div>
                                          </div>
                                          <div class="col">
                                              <div class="fw-bold text-gray-800 fs-6">
                                                  {{ "spa@gmail.com" ?? '-' }}</div>
                                          </div>
                                      </div>
                                      <div class="separator"></div>
                                      <span class="badge badge-danger mt-4 mb-2">
                                          {{  number_format(5,2,'.','') }}
                                      </span>
                                      <span class="badge badge-danger">({{100}} Rating)</span>
                                      <p>{{ "Klinik Kecantikan Aurem Derm adalah tempat yang sempurna untuk relaksasi dan pemulihan diri. Dengan layanan pijat profesional, aromaterapi, dan fasilitas sauna, Anda akan merasakan ketenangan maksimal. Nikmati suasana yang damai, perawatan tubuh menyeluruh, dan lingkungan yang indah untuk menyegarkan pikiran dan tubuh Anda." ?? '' }}</p>
                                  </div>
                              </div>
                              <div class="row mt-auto">
                                  <div class="col-12">
                                      <h2 class="mt-15 fw-bold d-flex align-self-end" style="color: #c02425">
                                          {{ General::rp(140000) }} -
                                          {{ General::rp(1000000) }}</h2>
                                  </div>
                              </div>

                          </div>
                      </div>
                  </div>
              </div>


             
          </div>
        </div>

        @php
            $avg_rate = 5;
            $rating = array_fill(0, 100, 5);
            $ratingCount = count($rating);

        @endphp

        <div class="row card flex-row w-75 me-auto ms-auto mt-4 p-3">
          <div class="card-body">
              @if (count($rating) == null)
                  <h3 class="text-centers">Belum ada review</h3>
              @else
                  <div id="kt_carousel_2_carousel" class="carousel carousel-custom slide" data-bs-ride="carousel"
                       data-bs-interval="8000">
                      <!--begin::Heading-->
                      <div class="d-flex align-items-center justify-content-between flex-wrap">
                          <!--begin::Label-->
                          <div class="d-flex align-items-center justify-content-center">
                              <div class="card shadow-sm ms-5 bg-light" style="width: 73px; height: 55px;">
                                  <div class="row align-items-center justify-content-center text-center">
                                      <div class="d-flex align-items-center">
                                          <div class="rating-label checked mt-5 me-2">
                                              <i class="ki-duotone ki-star fs-1"></i>
                                          </div>
                                          <div class="fs-6 fw-bold d-flex mt-5">
                                              {{ number_format($avg_rate, 1) }}
                                          </div>
                                          <div class="fs-6 fw-bold d-flex mt-5">
                                              / 5
                                          </div>
                                      </div>
                                  </div>


                              </div>
                              <div class="col ms-3">
                                  <div class="fw-bold fs-5">
                                      @if ($avg_rate >= 1 && $avg_rate < 2)
                                          Sangat Kurang
                                      @elseif ($avg_rate >= 2 && $avg_rate < 3)
                                          Kurang
                                      @elseif ($avg_rate >= 3 && $avg_rate < 4)
                                          Cukup
                                      @elseif ($avg_rate >= 4 && $avg_rate < 5)
                                          Baik
                                      @elseif ($avg_rate == 5)
                                          Sangat Baik
                                      @else
                                          Nilai tidak valid
                                      @endif
                                  </div>
                                  <div class="fs-8 fw-light-grey-500">
                                      Dari {{ $ratingCount }} Review
                                  </div>
                              </div>
                          </div>
                          {{-- <span class="fs-4 fw-bold m-5 pe-2">Review</span> --}}
                          <!--end::Label-->

                          <!--begin::Carousel Indicators-->
                          {{-- <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet">
                              @foreach ($rating->chunk(3) as $groupIndex => $chunk)
                                  <li data-bs-target="#kt_carousel_2_carousel" data-bs-slide-to="{{ $groupIndex }}"
                                      class="ms-1 @if ($groupIndex === 0) active @endif"></li>
                              @endforeach

                          </ol> --}}
                          <!--end::Carousel Indicators-->
                      </div>
                      <!--end::Heading-->

                      <!--begin::Carousel-->
                      <div class="carousel-inner pt-8">
                          <!--begin::Item-->
                          {{-- @foreach ($rating->chunk(3) as $chunk)
                              <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                  <div class="d-flex flex-wrap">
                                      @foreach ($chunk as $ratingItem)
                                          <div class="col-md-4 card shadow-sm mb-3">
                                              <div class="m-4">
                                                  <div class="row">
                                                      <div class="d-flex justify-content-start align-items-center">
                                                          <div class="d-flex align-items-center justify-content-center">
                                                              <div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px"
                                                                   data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                                                   data-kt-menu-placement="bottom-end">
                                                                  <div class="symbol symbol-50px">
                                                                      <div
                                                                          class="symbol-label fs-2 fw-bold bg-grey text-danger">
                                                                          {{ substr($ratingItem->name, 0, 1) }}
                                                                      </div>
                                                                  </div>
                                                              </div>
                                                              <div class="col ms-5">
                                                                  <div class="fs-6 fw-bold d-flex">
                                                                      {{ $ratingItem->name ?? '_' }}
                                                                  </div>
                                                                  <div class="fs-6 fw-light-grey-500">
                                                                      {{ \Carbon\Carbon::parse($ratingItem->created)->diffForHumans() ?? 0 }}
                                                                  </div>

                                                              </div>
                                                          </div>
                                                          <div class="rating-label checked mb-5 ms-15">
                                                              <i class="ki-duotone ki-star fs-1"></i>
                                                          </div>
                                                          <div class="fs-6 fw-bold d-flex mb-5 ms-1">
                                                              {{ $ratingItem->rate }}
                                                          </div>
                                                      </div>

                                                  </div>

                                                  <div class="col-12 mt-4">
                                                      <div class="fs-6 fw-light-grey-800">
                                                          {{ $ratingItem->comment }}
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      @endforeach
                                  </div>
                              </div>
                          @endforeach --}}
                          <!--end::Item-->
                      </div>
                      <!--end::Carousel-->
                  </div>
              @endif
          </div>

        </div>



        <div class="row card flex-row w-75 me-auto ms-auto mt-4 p-3">
          {{-- DAFTAR GAMBAR DARI TEMPAT SPA --}}
        
            <div class="col-4">
                <a class="d-block overlay" data-fslightbox="lightbox-basic"
                   href="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-150px"
                         style="background-image:url('https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
                    </div>
                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                        <i class="bi bi-eye-fill text-white fs-3x"></i>
                    </div>
                </a>
            </div>

            <div class="col-4">
              <a class="d-block overlay" data-fslightbox="lightbox-basic"
                 href="https://images.unsplash.com/photo-1507652313519-d4e9174996dd?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                  <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-150px"
                       style="background-image:url('https://images.unsplash.com/photo-1507652313519-d4e9174996dd?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
                  </div>
                  <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                      <i class="bi bi-eye-fill text-white fs-3x"></i>
                  </div>
              </a>
            </div>

            <div class="col-4">
              <a class="d-block overlay" data-fslightbox="lightbox-basic"
                 href="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                  <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-150px"
                       style="background-image:url('https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
                  </div>
                  <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                      <i class="bi bi-eye-fill text-white fs-3x"></i>
                  </div>
              </a>
            </div>






        </div>


        {{-- SECTION KHUSUS PERATURAN --}}
        {{-- <div class="row card w-75 me-auto ms-auto mt-10">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <h3>Peraturan</h3>

                <ul class="mb-0">
                  <li>Peraturan 1</li>
                  <li>Peraturan 2</li>
                  <li>Peraturan 3</li>
                  <li>Peraturan 4</li>
                </ul>
              </div>
            </div>
          </div>
        </div> --}}
        {{-- SECTION KHUSUS PERATURAN --}}


        @guest
        {{-- <div class="row w-75 me-auto ms-auto mt-5">
          <div class="col-12">
             <!--begin::Alert-->
            <div class="alert alert-dismissible bg-light-warning d-flex flex-column flex-sm-row mb-10 p-5">
            <!--begin::Icon-->
              <i class="ki-duotone ki-notification-bing fs-2hx text-dark mb-sm-0 mb-5 me-4"><span
              class="path1"></span><span class="path2"></span><span
              class="path3"></span></i>
            <!--end::Icon-->

              <!--begin::Wrapper-->
              <div class="d-flex flex-column pe-sm-10 pe-0">
              <!--begin::Title-->
              <h4 class="fw-semibold">Anda Belum Login</h4>
              <!--end::Title-->

              <!--begin::Content-->
              <span>Harap login terlebih dahulu untuk melakukan pemesanan kamar. <a
              href="{{ route('login') }}" class="d-inline-block fw-bold">Login
              Disini</a></span>
              <!--end::Content-->
              </div>
              <!--end::Wrapper-->

                <!--begin::Close-->
                <button type="button"
                class="position-absolute position-sm-relative m-sm-0 btn btn-icon ms-sm-auto end-0 top-0 m-2"
                data-bs-dismiss="alert">
                <i class="ki-duotone ki-cross fs-1 text-primary"><span
                class="path1"></span><span
                class="path2"></span></i>
                </button>
                <!--end::Close-->
                </div>
          <!--end::Alert-->
          </div>
        </div> --}}
        @endguest


        <div class="row w-75 me-auto ms-auto mt-5">
          <div class="col-6">
            <div class="card card-hostel mb-3">
              <div class="row mb-2">
                <div class="col-5">
                  <a class="d-block overlay p-2"
                    data-fslightbox="lightbox-basic-1"
                    href="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                    <div
                    class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-150px "
                    style="background-image:url('https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
                    </div>
                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                      <i class="bi bi-eye-fill text-white fs-3x"></i>
                    </div>
                  </a>
                </div>


                <div class="col">
                  <div class="row mt-5 px-2">
                      <h4 class="card-title text-gray-900">Treatment Wajah Laser A</h4>
                      
                      <p class=" text-gray-500" style="margin-top: 1rem; max-width: 250px;">
                        Pada pake ini kamu akan mendapatkan treatment A, treatment B dan treatment C.
                      </p>
                    

                      <p class="card-text mt-1 text-gray-500">
                    <b class="text-danger">
                      Tersisa
                      10


                      
                    </b>
                    </p>
                  <div class="d-flex align-items-center gap-2">
                  
                      <img src="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                      alt="facility" width="30" class="me-1">


                  </div>
                  </div>
                  </div>
                  </div>
                  <div class="card-footer d-flex justify-content-between">
                  <p class="fw-semibold d-block fs-2 text-danger">Rp.
                  {{ number_format(850000, 0, ',', '.') }}</p>
                  {{-- @guest
                      <a href="{{ route('login') }}" class="btn btn-danger px-4 py-2">Login Dulu</a>
                  @endguest --}}
                
                      <a
                      href="{{ route("clinics.reservasi") }}"
                      class="btn btn-danger px-4">Pesan Treatment</a>
                  </div>
                  </div>
                  </div>
                 









              </div>

            </div>

          </div>
        </div>





      </div>
    </div>
      
    




@endsection

@push('add-style')
                <style>
                body {
                background-size: 100% 80px !important;
                }

                .card-hostel:hover {
                border: 1px solid #D9214E;
                cursor: pointer;
                }
                </style>
@endpush

@push('add-script')
                <script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
                <script>
                    var todayShowHotel = new Date();

                    new tempusDominus.TempusDominus(document.getElementById("js_datepicker_show_hotel"), {
                        display: {
                            viewMode: "calendar",
                            components: {
                                date: true,
                                hours: false,
                                minutes: false,
                                seconds: false
                            }
                        },
                        localization: {
                            locale: "id",
                            format: "dd-MM-yyyy",
                        },
                        restrictions: {
                            minDate: todayShowHotel,
                        },
                    });
                </script>

               
@endpush
