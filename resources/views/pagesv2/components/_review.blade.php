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
                    <div class="card border">
                        <div class="card-body">
                            <div class="d-flex flex-row align-items-center mb-3">
                                <div class="card-title d-flex align-items-center fs-2">5.0/<small
                                        class="opacity-75">5</small>
                                </div>
                                <span
                                    class="opacity-75 ms-sm-auto">{{ \App\Helpers\General::getDateShortMonth('2023-01-23') }}</span>
                            </div>
                            <div class="card-subtitle fs-5 opacity-75 fw-bold mb-1">Hayati Nur</div>
                            <span class="fs-5 opacity-75">Pelayanan nyaman banget... Next bakalan balek lg buat
                                treatment
                                disana</span>
                        </div>
                    </div>
                    <div class="card border">
                        <div class="card-body">
                            <div class="d-flex flex-row align-items-center mb-3">
                                <div class="card-title d-flex align-items-center fs-2">5.0/<small
                                        class="opacity-75">5</small>
                                </div>
                                <span
                                    class="opacity-75 ms-sm-auto">{{ \App\Helpers\General::getDateShortMonth('2023-01-23') }}</span>
                            </div>
                            <div class="card-subtitle fs-5 opacity-75 fw-bold mb-1">Hayati Nur</div>
                            <span class="fs-5 opacity-75">Pelayanan nyaman banget... Next bakalan balek lg buat
                                treatment
                                disana</span>
                        </div>
                    </div>
                    <div class="card border">
                        <div class="card-body">
                            <div class="d-flex flex-row align-items-center mb-3">
                                <div class="card-title d-flex align-items-center fs-2">4.0/<small
                                        class="opacity-75">5</small>
                                </div>
                                <span
                                    class="opacity-75 ms-sm-auto">{{ \App\Helpers\General::getDateShortMonth('2023-01-23') }}</span>
                            </div>
                            <div class="card-subtitle fs-5 opacity-75 fw-bold mb-1 text-capitalize">
                                {{ $r['user']['name'] ?? 'Invalid User' }}</div>
                            <span class="fs-5 opacity-75">{{ $r['comment'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="card-wrapper container-md d-flex justify-content-around gap-2">
                    <div class="card border">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center">5.0/<small>5</small></div>
                            <div class="card-subtitle">Hayati Nur</div>
                            <span>Pelayanan nyaman banget... Next bakalan balek lg buat treatment disana</span>
                        </div>
                    </div>
                    <div class="card border">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center">4.0/<small>5</small></div>
                            <div class="card-subtitle">Hayati Nur</div>
                            <span>Pelayanan nyaman banget... Next bakalan balek lg buat treatment disana</span>
                        </div>
                    </div>
                    <div class="card border">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center">5.0/<small>5</small></div>
                            <div class="card-subtitle">Hayati Nur</div>
                            <span>Pelayanan nyaman banget... Next bakalan balek lg buat treatment disana</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
