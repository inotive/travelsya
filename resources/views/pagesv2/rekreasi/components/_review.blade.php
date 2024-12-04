<div class="px-3 mb-3 d-flex flex-column mb-35px" id="review">
    <div class="section-title mb-4">
        <div class="w-100 title text-capitalize" style="font-size: calc(1rem + 0.85vw)">
            Review
        </div>
    </div>
    <div class="d-flex align-items-center flex-row mb-3">
        <span class="text-warning fs-2 bintang fa fa-star checked me-2"></span>
        <span class="rating-number fw-bold text-dark opacity-50"
            style="font-size: calc(1rem + 1.35vw)">{{ $detail->avgRating() }}/<small>5</small></span>
        <div class="d-flex flex-column ms-5 fs-5">
            <h3>
                @if ($detail->avgRating() > 4.7)
                    Memuaskan
                @elseif ($detail->avgRating() <= 4.7)
                    Bagus
                @elseif ($detail->avgRating() <= 3)
                    Cukup
                @elseif ($detail->avgRating() <= 2.5)
                    Kurang Bagus
                @endif
            </h3>
            <span class="opacity-75">Dari {{ number_format($detail->reviews->count()) }} review</span>
        </div>
    </div>
    <div class="d-flex
            flex-row gap-2 p-1 rounded-1 align-items-center mb-3">
        <div class="panah btn btn-gray-carousel rounded-circle" id="swiper-button-prev">
            <span class="chevron fa-solid fa-chevron-left"></span>
        </div>
        <div class="panah btn btn-gray-carousel rounded-circle" id="swiper-button-next">
            <span class="chevron fa-solid fa-chevron-right"></span>
        </div>
        <a href="javascript:" class="text-danger ms-auto fw-bold fs-2">Lihat
            Semua</a>
    </div>
    <div class="review-swiper-container overflow-hidden" id="review-swiper-container">
        <div class="swiper-wrapper">

            @if (count($detail->reviews) > 0)
                @foreach ($detail->reviews as $r)
                    <div class="swiper-slide gap-2">
                        <div class="card border" style="width: 18rem;">
                            <div class="card-body">
                                <div class="d-flex flex-row align-items-center mb-3">
                                    <div class="card-title d-flex align-items-center fs-2">
                                        <bold class="text-dark fw-bold">{{ round($r['rate'], 1) }}</bold>/<small
                                            class="opacity-75" style="font-size: 14px;">5</small>
                                    </div>
                                    <span
                                        class="opacity-75 ms-sm-auto">{{ \App\Helpers\General::getDateShortMonth($detail['created_at']) }}</span>
                                </div>
                                <div
                                    class="card-subtitle fs-6 opacity-75 fw-bold mb-1 text-capitalize d-flex align-items-start">
                                    {{ $r['user']['name'] ?? 'Invalid User' }}</div>
                                <span class="fs-6 opacity-75">{{ $r['comment'] }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

@push('js')
    <script>
        const spswiper = new Swiper('#review-swiper-container', {
            slidesPerView: 4, // Tampilkan 4 slide sekaligus
            spaceBetween: 10, // Jarak antar slide
            navigation: {
                nextEl: '#swiper-button-next',
                prevEl: '#swiper-button-prev',
            },
            autoplay: {
                delay: 3000,
            },
            loop: true, // Aktifkan loop jika diperlukan
            autoRun: true,
            slideToClickedSlide: true, // Untuk melompat ke slide yang di-klik
            breakpoints: {
                1500: {
                    slidesPerView: 5,
                },
                1200: {
                    slidesPerView: 4,
                },
                768: {
                    slidesPerView: 3, // Tampilkan 3 slide untuk layar lebih kecil
                },
                576: {
                    slidesPerView: 2, // Tampilkan 2 slide untuk layar sangat kecil
                },
            },
        });
    </script>
@endpush
