<div class="container mb-5">
    <section class="special-deals mt-5">

        @include('pagesv2.rekreasi.components._detail_header');

        <div class="px-3 mb-5">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link text-dark active" aria-current="page" href="#ringkasan">Ringkasan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#highlight">Highlight</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#paket">Paket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#review">Review</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#lokasi">Lokasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="#deskripsi">Deskripsi</a>
                </li>
            </ul>
            <hr>
        </div>

        <div class="px-3 mb-35px">
            <div class="row">
                <div class="col-9">
                    <div id="ringkasan" class="mb-35px">
                        <div class="section-title mb-4">
                            <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 1.35vw)">
                                {{ $detail->business_name }}
                            </div>
                        </div>
                        <div class="rating d-flex align-items-center mb-25px">
                            <span class="bintang text-warning fs-1 fa fa-star checked me-2"></span>
                            <span class="rating-number fs-3 fw-bold">{{ $detail->avgRating() }} / <small
                                    class="fs-6">5</small> <a href="#review"
                                    class="text-decoration-none text-dark opacity-50 text-capitalize">(Lihat
                                    {{ $detail->reviews->count() }} Ulasan)</a>
                            </span>
                            <span class="rating-number fs-3 custom-dot-before">{{ $detail->booked->count() }}
                                terjual</span>
                        </div>
                        <div class="lokasi d-flex align-items-center mb-25px">
                            <span class="fa-solid fa-location-dot fs-1 me-2 text-dark opacity-50"></span>
                            <span class="fs-3">{{ $detail->address }}.</span>
                        </div>
                        <div class="lokasi d-flex align-items-center mb-25px">
                            <span class="fa-solid fa-clock fs-2 me-2 text-dark opacity-50"></span>
                            <span class="fs-3 me-2">Buka: {{ $detail->open }} - {{ $detail->close }}</span>
                            <a href="#" class="text-danger text-decoration-none fs-3 fw-bold">Lihat</a>
                        </div>
                    </div>
                    <div class="card bg-danger bg-opacity-25 rounded-4 pd-3 mb-35px">
                        <div class="card-body">
                            <div id="highlight" class="mb-3">
                                <h2>Highlight</h2>
                                <div class="fs-3">
                                    {!! $detail->highlight ?? 'Belum ada highlight' !!}
                                </div>
                                <a href="#" class="text-danger text-decoration-none fs-3">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card d-flex flex-column align-items-center p-3 border boreder-dark">
                        <span class="d-flex justify-content-space-between gap-2 align-items-center">
                            @if($detail->recreationPackages->isNotEmpty())
                                Mulai Dari <span class="text-danger fs-2 fw-bold">
                                    IDR {{ number_format($detail->recreationPackages->first()->price) }}
                                </span>
                            @else
                                <span class="text-muted">Harga tidak tersedia</span>
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            <hr>
        </div>

        @include('pagesv2.rekreasi.components._detail_recreation_package')

        @include('pagesv2.rekreasi.components._review')

        @if ($detail->lat && $detail->ltd)
            <div class="px-3 mb-35px d-flex flex-column" id="lokasi">
                <div class="section-title mb-4">
                    <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
                        Lokasi
                    </div>
                </div>

                <div class="card rounded-4 border">
                    <iframe
                        src="https://www.google.com/maps?q={{ $detail['lat'] }}, {{ $detail['ltd'] }}&z=12&output=embed"></iframe>
                    <div class="card-body d-flex flex-row aligh-items-center">
                        <div class="d-flex flex-row align-items-center">
                            <span class="fa-solid fa-location-dot fs-1 me-2 text-dark opacity-50 me-5"></span>
                            <span class="fs-3 ms-5">{{ $detail['address'] }}</span>
                        </div>
                        <div class="d-flex flex-column align-items-center ms-sm-auto me-5">
                            <button class="bg-danger bg-opacity-25 rounded-circle border-0 p-4"
                                onclick="openMap({{ $detail['lat'] }}, {{ $detail['ltd'] }})"><span
                                    class="fa-solid fa-location-arrow fs-1 me-2 text-danger fw-bold"></span></button>
                            <span class="fs-3 text-danger fw-bold">Lihat Peta</span>
                        </div>
                        <div class="d-flex flex-column align-items-center mx-5  ">
                            <button class="bg-danger bg-opacity-25 rounded-circle border-0 p-4"
                                onclick="getDirection({{ $detail['lat'] }}, {{ $detail['ltd'] }})"><span
                                    class="fa-solid fa-route fs-1 me-2 text-danger fw-bold"></span></button>
                            <span class="fs-3 text-danger fw-bold">Lihat Peta</span>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="px-3 mb-35px d-flex flex-column fs-4" id="deskripsi">
            <div class="section-title mb-4">
                <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
                    Deskripsi
                </div>
            </div>
            <div id="description" class="opacity-75">
                {{ $detail->description }}

            </div>
        </div>

    </section>
</div>

@push('js')
    <script>
        function showMap(latitude, longitude) {
            const mapUrl = `https://www.google.com/maps?q=${latitude},${longitude}`;
            window.open(mapUrl, '_blank');
        }


        $("#list_paket").on("click", "#increase_paket", function() {
            let id = $(this).attr("id_paket");
            let val_paket = parseInt($("#val_paket_" + id).val());
            let increase_val = val_paket + 1;
            console.log(increase_val);

            $("#val_paket_" + id).val(increase_val);
            $("#dummy_paket_" + id).text(increase_val);
        });


        function openMap(latitude, longitude) {
            // Event untuk membuka lokasi di tab baru
            const mapUrl = `https://www.google.com/maps?q=${latitude},${longitude}`;
            window.open(mapUrl, '_blank');
        }

        function getDirection(latitude, longitude) {
            // Event untuk mendapatkan rute
            const directionsUrl = `https://www.google.com/maps/dir/?api=1&destination=${latitude},${longitude}`;
            window.open(directionsUrl, '_blank');
        }
    </script>
@endpush
