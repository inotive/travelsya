@extends('layouts.web')

@section('title', 'Daftar Klinik Kecantikan & Kesehatan')


                <div
                    class="card border-transparent header-image"
                    data-bs-theme="light"
                    style=""
                    x-bind:style="`background:linear-gradient(to right, rgba(44, 4, 4, 0.73), rgba(245, 246, 252, 0.52)), url(${$store.menubar.selected.imageHeader}) no-repeat center center`">
                    <div class="card-body d-flex ps-xl-20">
                        <div class="m-0">
                            <div class="position-relative fs-2x z-index-2 fw-bold text-white mb-2">
                                <button class="btn btn-icon btn-rounded btn-color-white bg-white bg-opacity-15 bg-hover-opacity-25 fw-semibold mb-5 "onclick="history.back();">
                                    <i class="las la-angle-left"></i>
                                </button>
                                <div>
                                    <span class="me-2">Heath & Beauty</span>
                                    <br/><span class="fs-3 text-gray-300 me-2">Cari klinik kecantikan dan kesehatan di lokasimu!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
  <div class="content flex-row-fluid mb-20" id="kt_content">
    
    <div class="row">

      
        <div class="card border-1 border-light">
            <form class="card-body h-100" method="GET" action="" id="searchForm">
                <input type="hidden" name="location" value="">
                <input type="hidden" name="start" value="">
                <input type="hidden" name="duration" value="">
                <input type="hidden" name="room" value="">
                <input type="hidden" name="guest" value="">
                
               
            </form>
        </div>
      

      <div class="col-12">
        <div class="row gy-4">
          <div class="col-12">
              <div class="card">
                     
                    <!--begin::Radio group-->
                    <div class="btn-group w-60 " data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]" style="margin-right: 30px; margin-left: 30px; margin-top: 15px">

                        <!--begin::Radio-->
                        <label class="btn btn-outline btn-danger active" data-kt-button="true">
                            <!--begin::Input-->
                            <input class="btn-check" type="radio" name="category" value="health" required />
                            <!--end::Input-->
                            Health
                        </label>
                        <!--end::Radio-->

                        <!--begin::Radio-->
                        <label class="btn btn-outline btn-danger" data-kt-button="true">
                            <!--begin::Input-->
                            <input class="btn-check" type="radio" name="category" value="beauty" required />
                            <!--end::Input-->
                            Beauty
                        </label>
                        <!--end::Radio-->

                    </div>
                    <!--end::Radio group-->

                  <div class="card-body h-100">
                      <form method="GET" action="" class="row g-4">
                          <div class="col-6">
                              <label class="form-label fw-bold fs-6">Pilih Lokasi</label>
                              <select name="location" id="location" class="form-select form-select-lg">
                                  <option value="balikpapan">Balikpapan</option>
                                  <option value="samarinda">Samarinda</option>
                              </select>

                          </div>
                          
                          <div class="col-6">
                            <label class="fs-5 fw-semibold mb-2">
                                <span>Tanggal Pemesanan</span>
                            </label>
                            <input type="date" id="" class="form-control form-control-lg"
                                name="keyword" placeholder="Tanggal" value="" />
                        </div>

                          

                          <div class="col-12">
                              <button type="submit" class="w-100 btn-danger btn">Cari Sekarang</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
        </div>



        {{-- recreation count --}}
 
        <h5 class="mt-10">Menampilkan {{ $clinics->count() }} Klinik Kesehatan</h5>
 
 <div id="results" class="mt-4">
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach ($clinics as $clinic)
    @if ($clinic->clinicPackages->isNotEmpty())
    <div class="col">
        <a href="{{ route('clinics.klinik', ['id' => $clinic->id]) }}">
            <div class="card shadow h-100">
                <img src="https://images.unsplash.com/photo-1540555700478-4be289fbecef?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="card-img-top" alt="...">
                <div class="card-body d-flex flex-column">
                    
                    <!-- Akses data paket klinik pertama -->
                    @php
                        $package = $clinic->clinicPackages->first();
                    @endphp
                    <h4 class="card-title">{{ $package->name }}</h4>
                    <p class="card-text flex-grow-1">{{ $package->description }}</p>
                    <div class="d-flex justify-content-between align-items-center mt-auto">
                        <h4 style="color: rgb(255, 0, 0);">{{ 'Rp '.number_format($package->price) }}</h4>
                        <span class="card-text" style="color: rgb(255, 0, 0);">
                            <i class="fa fa-star"></i>&nbsp;(5)
                        </span>
                    </div>

                </div>
            </div>
        </a>
    </div>
    @endif
@endforeach

    </div>
</div>





      </div>

    </div>


  </div>

</div>



<!--end::Container-->

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
