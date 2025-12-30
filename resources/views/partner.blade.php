@extends('layouts.web')

@section('content-web')
    <div class="px-20">
        <div class="card"
            style="background:linear-gradient(to right, rgba(28, 50, 94, 0.9), rgba(245, 246, 252, 0)), url('https://images.unsplash.com/photo-1540541338287-41700207dee6?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') no-repeat center">
            <div class="card-body d-flex ps-xl-15">
                <div class="m-0">
                    <div class="position-relative fs-2x z-index-2 fw-bolder text-white mb-7">
                        <p>Partner Travelsya</p>
                        <span class="fs-1 fs-semibold">
                            Untuk memastikan kenyamanan pelanggan,
                            <br>Kami melakukan kerja sama dengan berbagai mitra
                            <br>di seluruh indonesia
                        </span>
                    </div>
                    <div class="mb-3">
                        <a href="{{ route('company.about') }}" class="btn btn-danger fw-bold me-2">Tentang Kami</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hotels -->
        @if($hotels->count() > 0)
        <div class="pt-10 pb-5">
            <h3 class="fs-2x fw-bold mb-5">Mitra Hotel</h3>
            <div class="row py-5" x-data>
                @foreach ($hotels as $hotel)
                    <div class="col-6 col-md-2">
                        <div class="card-xl-stretch me-md-6">
                            <a href="#" class="d-block overlay w-full" data-fslightbox="lightbox-hot-sales">
                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                    style="background-image: url('{{ $hotel->image ? asset('storage/' . $hotel->image) : asset('assets/media/avatars/blank.png') }}')">
                                </div>
                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                    <i class="bi bi-eye-fill fs-2x text-white"></i>
                                </div>
                            </a>
                            <div class="mt-5">
                                <div class="h-40px">
                                    <a href="#" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">
                                        {{ $hotel->name ?? 'N/A' }}
                                    </a>
                                </div>
                                <p class="fs-6 text-gray-600 text-dark mt-3">{{ $hotel->address ?? '-' }}</p>
                                <p class="fs-7 text-gray-800 text-dark mb-0">Email: {{ $hotel->email ?? '-' }}</p>
                                <p class="fs-7 text-gray-800 text-dark mb-0">Website: {{ $hotel->website ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Hostels -->
        @if($hostels->count() > 0)
        <div class="pt-5 pb-5">
            <h3 class="fs-2x fw-bold mb-5">Mitra Hostel</h3>
            <div class="row py-5" x-data>
                @foreach ($hostels as $hostel)
                    <div class="col-6 col-md-2">
                        <div class="card-xl-stretch me-md-6">
                            <a href="#" class="d-block overlay w-full" data-fslightbox="lightbox-hot-sales">
                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                    style="background-image: url('{{ $hostel->image ? asset('storage/' . $hostel->image) : asset('assets/media/avatars/blank.png') }}')">
                                </div>
                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                    <i class="bi bi-eye-fill fs-2x text-white"></i>
                                </div>
                            </a>
                            <div class="mt-5">
                                <div class="h-40px">
                                    <a href="#" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">
                                        {{ $hostel->name ?? 'N/A' }}
                                    </a>
                                </div>
                                <p class="fs-6 text-gray-600 text-dark mt-3">{{ $hostel->address ?? '-' }}</p>
                                <p class="fs-7 text-gray-800 text-dark mb-0">Email: {{ $hostel->email ?? '-' }}</p>
                                <p class="fs-7 text-gray-800 text-dark mb-0">Website: {{ $hostel->website ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Health & Beauty -->
        @if($clinics->count() > 0)
        <div class="pt-5 pb-5">
            <h3 class="fs-2x fw-bold mb-5">Mitra Health & Beauty</h3>
            <div class="row py-5" x-data>
                @foreach ($clinics as $clinic)
                    <div class="col-6 col-md-2">
                        <div class="card-xl-stretch me-md-6">
                            <a href="#" class="d-block overlay w-full" data-fslightbox="lightbox-hot-sales">
                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                    style="background-image: url('{{ $clinic->image ? asset('storage/' . $clinic->image->image) : asset('assets/media/avatars/blank.png') }}')">
                                </div>
                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                    <i class="bi bi-eye-fill fs-2x text-white"></i>
                                </div>
                            </a>
                            <div class="mt-5">
                                <div class="h-40px">
                                    <a href="#" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">
                                        {{ $clinic->clinic_name ?? 'N/A' }} <!-- clinic->name tidak ada, field nya clinic_name -->
                                    </a>
                                </div>
                                <p class="fs-6 text-gray-600 text-dark mt-3">{{ $clinic->address ?? '-' }}</p>
                                <p class="fs-7 text-gray-800 text-dark mb-0">Email: {{ $clinic->user_email ?? '-' }}</p>
                                <p class="fs-7 text-gray-800 text-dark mb-0">Telp: {{ $clinic->phone ?? $clinic->user_phone ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Rental Mobil -->
        @if($rentals->count() > 0)
        <div class="pt-5 pb-5">
            <h3 class="fs-2x fw-bold mb-5">Mitra Rental Mobil</h3>
            <div class="row py-5" x-data>
                @foreach ($rentals as $rental)
                    <div class="col-6 col-md-2">
                        <div class="card-xl-stretch me-md-6">
                            <a href="#" class="d-block overlay w-full" data-fslightbox="lightbox-hot-sales">
                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                    style="background-image: url('{{ $rental->image ? asset('storage/' . $rental->image) : asset('assets/media/avatars/blank.png') }}')">
                                </div>
                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                    <i class="bi bi-eye-fill fs-2x text-white"></i>
                                </div>
                            </a>
                            <div class="mt-5">
                                <div class="h-40px">
                                    <a href="#" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">
                                        {{ $rental->business_name ?? 'N/A' }} <!-- field name di CarRental adalah business_name -->
                                    </a>
                                </div>
                                <p class="fs-6 text-gray-600 text-dark mt-3">{{ $rental->address ?? '-' }}</p>
                                <p class="fs-7 text-gray-800 text-dark mb-0">Email: {{ $rental->user_email ?? '-' }}</p>
                                <p class="fs-7 text-gray-800 text-dark mb-0">Telp: {{ $rental->phone ?? $rental->user_phone ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Rekreasi -->
        @if($recreations->count() > 0)
        <div class="pt-5 pb-5">
            <h3 class="fs-2x fw-bold mb-5">Mitra Rekreasi</h3>
            <div class="row py-5" x-data>
                @foreach ($recreations as $recreation)
                    <div class="col-6 col-md-2">
                        <div class="card-xl-stretch me-md-6">
                            <a href="#" class="d-block overlay w-full" data-fslightbox="lightbox-hot-sales">
                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                    style="background-image: url('{{ $recreation->image ? asset('storage/' . $recreation->image->image) : asset('assets/media/avatars/blank.png') }}')">
                                </div>
                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                    <i class="bi bi-eye-fill fs-2x text-white"></i>
                                </div>
                            </a>
                            <div class="mt-5">
                                <div class="h-40px">
                                    <a href="#" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">
                                        {{ $recreation->business_name ?? 'N/A' }} <!-- field name di Recreation adalah business_name -->
                                    </a>
                                </div>
                                <p class="fs-6 text-gray-600 text-dark mt-3">{{ $recreation->address ?? '-' }}</p>
                                <p class="fs-7 text-gray-800 text-dark mb-0">Email: {{ $recreation->email ?? '-' }}</p>
                                <p class="fs-7 text-gray-800 text-dark mb-0">Website: {{ $recreation->website ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Bus & Travel -->
        @if($busTravels->count() > 0)
        <div class="pt-5 pb-5">
            <h3 class="fs-2x fw-bold mb-5">Mitra Bus & Travel</h3>
            <div class="row py-5" x-data>
                @foreach ($busTravels as $busTravel)
                    <div class="col-6 col-md-2">
                        <div class="card-xl-stretch me-md-6">
                            <a href="#" class="d-block overlay w-full" data-fslightbox="lightbox-hot-sales">
                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                    style="background-image: url('{{ $busTravel->image ? asset('storage/' . $busTravel->image) : asset('assets/media/avatars/blank.png') }}')">
                                </div>
                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
                                    <i class="bi bi-eye-fill fs-2x text-white"></i>
                                </div>
                            </a>
                            <div class="mt-5">
                                <div class="h-40px">
                                    <a href="#" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-base">
                                        {{ $busTravel->business_name ?? 'N/A' }} <!-- field name di BusTravels adalah business_name -->
                                    </a>
                                </div>
                                <p class="fs-6 text-gray-600 text-dark mt-3">{{ $busTravel->address ?? '-' }}</p>
                                <p class="fs-7 text-gray-800 text-dark mb-0">Email: {{ $busTravel->email ?? '-' }}</p>
                                <p class="fs-7 text-gray-800 text-dark mb-0">Website: {{ $busTravel->website ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        {{-- <div class="row py-15" x-data>
    <template x-for="data in $store.partnerhotel.data">
      <div class=" col-6 col-md-2">
        <div class="card-xl-stretch me-md-6">
          <a x-bind:href="data.image" class="d-block overlay w-full" data-fslightbox="lightbox-hot-sales">
            <div
              class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
              x-bind:style="`background-image: url(${data.image})`"
            ></div>
            <div class="overlay-layer card-rounded bg-dark bg-opacity-25">
              <i class="bi bi-eye-fill fs-2x text-white"></i>
            </div>
          </a>
          <div class="mt-5">
            <div class="h-40px">
              <a href="#" class="fs-4 text-dark fw-bold text-hover-primary text-dark lh-baseå" x-html="data.label"></a>
            </div>
            <p class="fs-6 text-gray-600 text-dark mt-3" x-html="data.address"></p>
            <p class="fs-7 text-gray-800 text-dark mt-3 mb-0">Telp: <span x-html="data.telp"></span></p>
            <p class="fs-7 text-gray-800 text-dark mb-0">Email: <span x-html="data.email"></span></p>
            <p class="fs-7 text-gray-800 text-dark mb-0">Website: <span x-html="data.website"></span></p>
          </div>
        </div>
      </div>
    </template>
  </div> --}}
    </div>
@endsection

@push('add-script')
    <script>
        var dummyPartnerHotel = [{
            id: 0,
            label: "Oval Kost",
            image: "../assets/media/partner/oval.png",
            address: "Jin. Mekar Sari RT.19 NO.67 Gn. Sari Ilir, Balikpapan, Kalimantan Timur",
            email: "ovalkost@gmail.com",
            telp: "+6282166888766",
            website: "www.ovalkost.com"
        }, {
            id: 1,
            label: "Hemra Hotel",
            image: "../assets/media/partner/hemra.png",
            address: "JI. MT Haryono No.5 No.85, Damai, Balikpapan, Kalimantan Timur",
            email: "-",
            telp: "0542-762290",
            website: "-"
        }, {
            id: 2,
            label: "Her Mandiri Guest House",
            image: "../assets/media/partner/her.png",
            address: "JI. Syarifuddin Yoes No.88, Sepinggan, Balikpapan, Kalimantan Timur",
            email: "-",
            telp: "0542-8514339",
            website: "-"
        }, {
            id: 3,
            label: "Hotel Ayu",
            image: "../assets/media/partner/ayu.png",
            address: "JI. P. Antasari, No.18 RT.001, Karang Rejo, Balikpapan, Kalimantan Timur",
            email: "-",
            telp: "0542-425290",
            website: "-"
        }, {
            id: 4,
            label: "Royal Suite",
            image: "../assets/media/partner/royal.png",
            address: "JI. Syarifuddin Yoes No.125, Sepinggan, Balikpapan, Kalimantan Timur",
            email: "-",
            telp: "+6282211852013",
            website: "www.royalsuitehotels.com"
        }, {
            id: 5,
            label: "De' Radja Guest House",
            image: "../assets/media/partner/de-radja.png",
            address: "-",
            email: "-",
            telp: "-",
            website: "-"
        }, {
            id: 6,
            label: "Radja",
            image: "../assets/media/partner/radja.png",
            address: "-",
            email: "-",
            telp: "-",
            website: "-"
        }, ]

        document.addEventListener("alpine:init", () => {
            Alpine.store("partnerhotel", {
                data: dummyPartnerHotel,
            });
        });
    </script>
@endpush
