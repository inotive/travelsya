@extends('layouts.web')

@section('title', 'Daftar Klinik Kecantikan & Kesehatan')

@section('content-web')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
  <div class="content flex-row-fluid mb-20" id="kt_content">
    
    <div class="row">

      <div class="col-3">
        <div class="card border-1 border-light">
            <form class="card-body h-100" method="GET" action="" id="searchForm">
                <input type="hidden" name="location" value="">
                <input type="hidden" name="start" value="">
                <input type="hidden" name="duration" value="">
                <input type="hidden" name="room" value="">
                <input type="hidden" name="guest" value="">
                <div class="row mb-4">
                    <div class="col-12">
                        <label for="" class="form-label">Urutan Harga</label>
                    </div>
                    <div class="col-12">
                        <!--begin::Radio group-->
                        <div class="btn-group w-100" data-kt-buttons="true"
                            data-kt-buttons-target="[data-kt-button]">
                            <!--begin::Radio-->
                            <label
                                class="btn btn-outline btn-color-muted btn-active-danger fs-9 "
                                data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check" type="radio" name="harga" value="tertinggi"  />

                                <!--end::Input-->
                                Harga Tertinggi
                            </label>
                            <!--end::Radio-->

                            <!--begin::Radio-->
                            <label
                                class="btn btn-outline btn-color-muted btn-active-danger fs-9"
                                data-kt-button="true">
                                <!--begin::Input-->

                                <input class="btn-check" type="radio" name="harga" value="terendah" />

                                <!--end::Input-->
                                Harga Terendah
                            </label>
                            <!--end::Radio-->
                        </div>
                        <!--end::Radio group-->
                    </div>
                </div>
                <div class="row gy-5">
                    <div class="col-12">
                        <label for="" class="form-label">Bintang</label>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input id="star1" class="form-check-input" type="checkbox" name="star[]" value="1"
                                id="flexCheckDefault"  />
                            <label class="form-check-label" for="star1">
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input id="star2" class="form-check-input" type="checkbox" name="star[]" value="2"
                                id="flexCheckDefault"  />
                            <label class="form-check-label" for="star2">
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input id="star3" class="form-check-input" type="checkbox" name="star[]" value="3"
                                id="flexCheckDefault"  />
                            <label class="form-check-label" for="star3">
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input id="star4" class="form-check-input" type="checkbox" name="star[]" value="4"
                                id="flexCheckDefault"  />
                            <label class="form-check-label" for="star4">
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-check">
                            <input id="star5" class="form-check-input" type="checkbox" name="star[]" value="5"
                                id="flexCheckDefault" />
                            <label class="form-check-label" for="star5">
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="w-100 btn-danger btn mb-2">Terapkan</button>
                       <a href="" class="w-100 btn btn-success">Reset</a>
                    </div>
                </div>
            </form>
        </div>
      </div>

      <div class="col-9">
        <div class="row gy-4">
          <div class="col-12">
              <div class="card">
                     
                    <!--begin::Radio group-->
                    <div class="btn-group w-60 " data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]" style="margin-right: 30px; margin-left: 30px; margin-top: 15px">

                        <!--begin::Radio-->
                        <label class="btn btn-outline btn-color-muted btn-active-success active" data-kt-button="true">
                            <!--begin::Input-->
                            <input class="btn-check" type="radio" name="category" value="health" required />
                            <!--end::Input-->
                            Health
                        </label>
                        <!--end::Radio-->

                        <!--begin::Radio-->
                        <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                            <!--begin::Input-->
                            <input class="btn-check" type="radio" name="category" value="beauty" required />
                            <!--end::Input-->
                            Beauty
                        </label>
                        <!--end::Radio-->

                    </div>
                    <!--end::Radio group-->

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
                                <span>Tanggal Pemesanan</span>
                            </label>
                            <input type="date" id="" class="form-control form-control-lg"
                                name="keyword" placeholder="Tanggal" value="" />
                        </div>

                          <div class="col-4">
                            <label class="fs-5 fw-semibold mb-2">
                              <span class="">Cari Klinik</span>
                          </label>
                          <input type="text" id="keyword" class="form-control form-control-lg"
                              name="keyword" placeholder="Nama klinik" value="" />
                          </div>
                          

                          <div class="col-12">
                              <button type="submit" class="w-100 btn-danger btn">Cari Data</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
        </div>


        @foreach ($clinics as $clinic)
            {{-- DATA REKREASI --}}
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body h-100">
                        <div class="row my-4">
                            <div class="col-4">
                               
                                <a class="d-block overlay" data-fslightbox="lightbox-basic-1"
                                    href="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                        style="background-image:url('https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
                                    </div>
                                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                        <i class="bi bi-eye-fill text-white fs-3x"></i>
                                    </div>
                                </a>
                                <div class="row mt-4">
  
                                  {{-- GAMBAR DARI REKREASI --}}
  
                                    <div class="col-4">
                                        <a class="d-block overlay" data-fslightbox="lightbox-basic-1"
                                           href="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                                            <!--begin::Image-->
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-75px"
                                                 style="background-image:url('https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
                                            </div>
                                            <!--end::Image-->
  
                                        <!--begin::Action-->
                                        <div
                                            class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                            <i class="bi bi-eye-fill text-white fs-3x"></i>
                                        </div>
                                        <!--end::Action-->
                                      </a>
                                    </div>
  
                                    <div class="col-4">
                                      <a class="d-block overlay" data-fslightbox="lightbox-basic-2"
                                         href="https://images.unsplash.com/photo-1507652313519-d4e9174996dd?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                                          <!--begin::Image-->
                                          <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-75px"
                                               style="background-image:url('https://images.unsplash.com/photo-1507652313519-d4e9174996dd?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
                                          </div>
                                          <!--end::Image-->
  
                                      <!--begin::Action-->
                                      <div
                                          class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                          <i class="bi bi-eye-fill text-white fs-3x"></i>
                                      </div>
                                      <!--end::Action-->
                                    </a>
                                    </div>
  
                                    <div class="col-4">
                                      <a class="d-block overlay" data-fslightbox="lightbox-basic-3"
                                         href="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
                                          <!--begin::Image-->
                                          <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-75px"
                                               style="background-image:url('https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
                                          </div>
                                          <!--end::Image-->
  
                                      <!--begin::Action-->
                                      <div
                                          class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                          <i class="bi bi-eye-fill text-white fs-3x"></i>
                                      </div>
                                      <!--end::Action-->
                                    </a>
                                    </div>
                                    {{-- BATAS GAMBAR DARI REKREASI --}}
  
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="row gy-4">
                                    <div class="col-12">
                                        <h3>{{ $clinic->clinic_name }}</h3>
                                    </div>
                                    <div class="col-12">
                                        <span class="badge badge-danger">
                                            {{ number_format(5,2) }}
                                        </span>
                                        <span class="badge badge-danger">({{ "100" }}
                                            Rating)</span>
                                    </div>
                                    <div class="col-12">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <span class="card-text fa fa-star" style="color: orange;"></span>
                                            @endfor
                                    </div>
                                    <div class="col-12">
                                        <p>{{ $clinic->address }}</p>
                                    </div>
                                    <div class="col-12">
                                        <h2 class="card-title text-danger">
                                            Rp
                                            {{ number_format(140000, 0, ',',
                                            '.') }}
                                            - Rp
                                            {{ number_format(1000000, 0, ',',
                                            '.') }}
                                        </h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <h3 class="mb-4">Fasilitas</h3>
                                <ul>
                                    @foreach ($packages as $pack)
                                        <li>{{ $pack->name }}</li>
                                    @endforeach
                                </ul>
  
                                <a href="{{ route('clinics.klinik', ['id' => $clinic->id]) }}"
                                    class="btn btn-danger d-block mt-10 text-white">Lihat Klinik</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
  
          {{-- BATAS DATA REKREASI --}}
        @endforeach

        

        

      </div>

    </div>


  </div>

</div>



<!--end::Container-->
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
    $(document).ready(function() {
        $("#card-filter").hide();
        $("#button-refilter").click(function() {
            $("#card-filter").toggle();
        })

        var today = new Date();

        new tempusDominus.TempusDominus(document.getElementById("js_datepicker_list_hotel"), {
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
                minDate: today,
            },
        });
    })

</script>
@endpush
