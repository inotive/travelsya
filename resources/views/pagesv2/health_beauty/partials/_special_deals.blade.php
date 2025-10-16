<div
    style="display: flex; gap: 10px; border-radius: 10px; align-items: center; flex-direction:row; margin-bottom:25px;">
    <div class="panah btn btn-gray-carousel rounded-circle" id="swiper-button-prev">
        <span class="chevron fa-solid fa-chevron-left"></span>
    </div>
    <div class="panah btn btn-gray-carousel rounded-circle" id="swiper-button-next">
        <span class="chevron fa-solid fa-chevron-right"></span>
    </div>
    <a href="{{ route('health_beauty.show_special_deals') }}" class="text-danger text-decoration-none"
        style="font-size: 1.5rem; font-weight:700; margin-left:auto;">Lihat
        Semua</a>
</div>

@if($data && $data->count() > 0)
    <div class="special-swiper-container overflow-hidden" id="special-swiper-container">
        <div class="swiper-wrapper mb-4">
            @foreach ($data as $deal)
            <div class="swiper-slide gap-2">
                <!-- Card -->
                <a href="{{ route('health_beauty.detail', ['lokasi' => $deal->clinic->kota->city_name ?? '-', 'clinic' => $deal->clinic->clinic_name ?? 'Unknown', 'id' => $deal->clinic_id]) }}"
                    class="text-decoration-none text-dark">
                    <div class="card shadow-sm" style="width: 18rem;">
                        <div class="position-relative" style="height: 150px; overflow: hidden;">
                            <img src="{{ $deal->image ? asset('/storage/' . $deal->image->image) : asset('images/health_default.png') }}"
                                class="card-img-top" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $deal->name }}"
                                onerror="this.src='{{ asset('images/placeholder.jpg') }}'">
                            <div class="badge bg-opacity-25 text-danger position-absolute translate-middle p-2 rounded-pill"
                                style="bottom: 0px; left:50px; background-color:pink !important;">Big Deal
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="lokasi d-flex align-items-center">
                                <span class="fa-solid fa-location-dot me-2"></span>
                                <span class="text-start">{{ $deal->clinic->kota->city_name ?? '-' }}</span>
                            </div>

                            <h3 class="mt-3 text-dark text-start">{{ $deal->name }}</h3>

                            <div class="rating d-flex align-items-center text-start">
                                <span class="bintang text-warning fs-2 fa fa-star checked me-2"></span>
                                <span class="rating-number" style="position: relative; top: 1px;">{{ $deal->avgRating() }}
                                    ({{ number_format($deal->reviews->count()) }}
                                    ulasan)
                                </span>
                            </div>

                            <div class="price mt-3 text-start">
                                <span style="font-size: 0.8rem" class="coret text-decoration-line-through">IDR
                                    {{ number_format((float)$deal->unit_price, 0, ',', '.') }}</span>
                                <span class="text-danger text-bold">IDR
                                    {{ number_format((float)$deal->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                </a>
            </div>
            @endforeach
        </div>
    </div>
@else
    <div class="text-center py-5">
        <p class="text-muted">Belum ada penawaran khusus untuk kategori ini.</p>
    </div>
@endif

@push('js')
<script>
    $(document).ready(function(){
        const spswiper = new Swiper('#special-swiper-container', {
                slidesPerView: 4, // Tampilkan 4 slide sekaligus
                spaceBetween: 10, // Jarak antar slide
                navigation: {
                    nextEl: '#swiper-button-next',
                    prevEl: '#swiper-button-prev',
                },
                autoplay: {
                    delay: 5000,
                },
                loop: true, // Aktifkan loop jika diperlukan
                slideToClickedSlide: true, // Untuk melompat ke slide yang di-klik
                breakpoints: {
                    1500:{
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
    })
</script>
@endpush
