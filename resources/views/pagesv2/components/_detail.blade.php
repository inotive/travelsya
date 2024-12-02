<div class="px-3 mb-5">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#ringkasan">Ringkasan</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#highlight">Highlight</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#paket">Paket</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#review">Review</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#lokasi">Lokasi</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#deskripsi">Deskripsi</a>
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
                        {{ $clinic->clinic_name }}
                    </div>
                </div>
                <div class="rating d-flex align-items-center mb-25px">
                    <span class="bintang text-warning fs-1 fa fa-star checked me-2"></span>
                    <span class="rating-number fs-3 fw-bold">{{ $clinic->avgRating() }} / <small class="fs-6">5</small> <a href="#"
                            class="text-decoration-none text-dark opacity-50 text-capitalize">(Lihat {{ $clinic->reviews->count() }} Ulasan)</a>
                    </span>
                    @if ($clinic->transactions->count() > 0)
                    <span class="rating-number fs-3 custom-dot-before">{{ number_format($clinic->transactions->count()) }} terjual</span>
                    @endif
                </div>
                <div class="lokasi d-flex align-items-center mb-25px">
                    <span class="fa-solid fa-location-dot fs-1 me-2 text-dark opacity-50"></span>
                    <span class="fs-3">{{ $clinic['address'] }}, {{ $clinic->kota->city_name ?? 'Invalid city' }}</span>
                </div>
                <div class="lokasi d-flex align-items-center mb-25px">
                    <span class="fa-solid fa-clock fs-2 me-2 text-dark opacity-50"></span>
                    <span class="fs-3 me-2">Buka: Hari ini {{ $clinic['open'] ?? '00:00' }} - {{ $clinic['close'] ?? '00:00' }}</span>
                    <a href="javascript:" class="text-danger text-decoration-none fs-3 fw-bold">Lihat</a>
                </div>
            </div>
            <div class="card bg-danger bg-opacity-25 rounded-4 pd-3 mb-35px">
                <div class="card-body">
                    <div id="highlight" class="mb-3">
                        <h2>Highlight</h2>
                        @if ($clinic['highlight'])
                            {!! $clinic['highlight'] !!}
                        @else
                        <ul class="fs-3">
                            <li>perawatan lengkap tersedian untuk rambut, alis, bulu matara, kuku, dan tubuh</li>
                            <li>kami menggunakan produk berkualitas tinggi seperti Davines dan Olaplex</li>
                        </ul>
                        @endif
                        <a href="javascript:" class="text-danger text-decoration-none fs-3">Lihat Selengkapnya</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card d-flex flex-column align-items-center p-3 border boreder-dark">
                <span class="d-flex justify-content-space-between gap-2 align-items-center">
                    Mulai Dari <span class="text-danger fs-2 fw-bold">
                        IDR {{ number_format($clinic['packages'][0]['price']) }}
                    </span>
                </span>
            </div>
        </div>
    </div>
    <hr>
</div>

@include('pagesv2.components._detail_health_beauty_package')

<div class="px-3 mb-3 d-flex flex-column mb-35px" id="review">
    <div class="section-title mb-4">
        <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
            Review
        </div>
    </div>
    <div class="d-flex align-items-center flex-row mb-3">
        <span class="text-warning fs-2 bintang fa fa-star checked me-2"></span>
        <span class="rating-number fw-bold text-dark opacity-50"
            style="font-size: calc(1rem + 1.35vw)">{{ $clinic->avgRating() }}/<small>5</small></span>
        <div class="d-flex flex-column ms-5 fs-5">
            <h3>
                @if ($clinic->avgRating() > 4.7)
                    Memuaskan
                @elseif ($clinic->avgRating() <= 4.7)
                    Bagus
                @elseif ($clinic->avgRating() <= 3)
                    Cukup
                @elseif ($clinic->avgRating() <= 2.5)
                    Kurang Bagus
                @endif
            </h3>
            <span class="opacity-75">Dari {{ number_format($clinic->reviews->count()) }} review</span>
        </div>
    </div>
    <div class="d-flex
            flex-row gap-2 p-1 rounded-1 align-items-center mb-3">
        <button class="btn btn-gray-carousel btn-sm rounded-circle fs-2" data-bs-target="#reviewsCarouselControls"
            data-bs-slide="prev">
            <span class="chevron fa-solid fa-chevron-left"></span>
        </button>
        <button class="btn btn-gray-carousel btn-sm rounded-circle fs-2" data-bs-target="#reviewsCarouselControls"
            data-bs-slide="next">
            <span class="chevron fa-solid fa-chevron-right"></span>
        </button>
        <a href="javascript:" class="text-danger ms-auto fw-bold fs-2">Lihat
            Semua</a>
    </div>
    <div id="reviewsCarouselControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="card-wrapper container-md d-flex justify-content-around gap-2">
                    @if (count($clinic->reviews) > 0)
                        @foreach ($clinic->reviews as $r)
                        <div class="card border" style="min-width: 270px;">
                            <div class="card-body">
                                <div class="d-flex flex-row align-items-center mb-3">
                                    <div class="card-title d-flex align-items-center fs-2"><bold class="text-dark fw-bold">{{ round($r['rate'], 1) }}</bold>/<small
                                            class="opacity-75" style="font-size: 14px;">5</small>
                                    </div>
                                    <span
                                        class="opacity-75 ms-sm-auto">{{ \App\Helpers\General::getDateShortMonth('2023-01-23') }}</span>
                                </div>
                                <div class="card-subtitle fs-5 opacity-75 fw-bold mb-1 text-capitalize">
                                    {{ $r['user']['name'] ?? 'Invalid User' }}</div>
                                <span class="fs-5 opacity-75">{{ $r['comment'] }}</span>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<div class="px-3 mb-35px d-flex flex-column" id="lokasi">
    <div class="section-title mb-4">
        <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
            Lokasi
        </div>
    </div>
    <div class="card rounded-4 border">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1413.9929019501262!2d100.36971342405258!3d-0.30524640058500946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd538bd1ff164a7%3A0xcea33881870dc19!2sJam%20Gadang%20Bukittinggi!5e0!3m2!1sen!2sid!4v1732690647336!5m2!1sen!2sid"
            width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy" class="card-img-top-rounded"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        <div class="card-body d-flex flex-row aligh-items-center">
            <div class="d-flex flex-row align-items-center">
                <span class="fa-solid fa-location-dot fs-1 me-2 text-dark opacity-50 me-5"></span>
                <span class="fs-3 ms-5">{{ $clinic['address'] }}</span>
            </div>
            <div class="d-flex flex-column align-items-center ms-sm-auto me-5">
                <button class="bg-danger bg-opacity-25 rounded-circle border-0 p-4"><span
                        class="fa-solid fa-location-arrow fs-1 me-2 text-danger fw-bold"></span></button>
                <span class="fs-3 text-danger fw-bold">Lihat Peta</span>
            </div>
            <div class="d-flex flex-column align-items-center mx-5  ">
                <button class="bg-danger bg-opacity-25 rounded-circle border-0 p-4"><span
                        class="fa-solid fa-location-arrow fs-1 me-2 text-danger fw-bold"></span></button>
                <span class="fs-3 text-danger fw-bold">Lihat Peta</span>
            </div>
        </div>
    </div>
</div>

@if ($facility)
<div class="px-3 mb-35px d-flex flex-column fs-4" id="deskripsi">
    <div class="section-title mb-4">
        <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
            Fasilitas
        </div>
    </div>
    <div id="description" class="d-flex flex-row align-items-center">
        <span class="fa-solid fa-store"></span>
        <span class="ms-2">Roko Suvenir</span>
        <span class="fa-solid fa-camera ms-5"></span>
        <span class="ms-2">Spot Foto</span>
        <span class="fa-solid fa-utensils ms-5"></span>
        <span class="ms-2">Restoran/Food Court</span>
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
        {!! $clinic['description'] ?? 'Belum ada deskripsi' !!}

    </div>
</div>

@push('js')
<script>
    $(document).ready(function() {
            $("#list_paket").on("click", "#decrease_paket", function() {
                let id = $(this).attr("id_paket");
                let val_paket = parseInt($("#val_paket_" + id).val());
                let decrease_val = val_paket;
                if (val_paket - 1 >= 0) {
                    decrease_val = val_paket - 1;
                }
                $("#val_paket_" + id).val(decrease_val);
                $("#dummy_paket_" + id).text(decrease_val);
            })


            $("#list_paket").on("click", "#increase_paket", function() {
                let id = $(this).attr("id_paket");
                let val_paket = parseInt($("#val_paket_" + id).val());
                let increase_val = val_paket + 1;
                console.log(increase_val);

                $("#val_paket_" + id).val(increase_val);
                $("#dummy_paket_" + id).text(increase_val);
            })
        });
</script>
@endpush
