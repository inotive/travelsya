<div class="section-title" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center;">
        <h2 class="text-dark" style="position: relative; top: 3px;">{{ $section_title }}</h2>
    </div>
    <div class="subtitle text-capitalize mt-2">{{ $section_subtitle }}</div>
</div>

<div style="display: flex; gap: 10px; border-radius: 10px; align-items: center; flex-direction:row; margin-bottom:25px;">
    <div class="panah btn btn-gray-carousel rounded-circle" id="swiper-button-prev">
        <span class="chevron fa-solid fa-chevron-left"></span>
    </div>
    <div class="panah btn btn-gray-carousel rounded-circle" id="swiper-button-next">
        <span class="chevron fa-solid fa-chevron-right"></span>
    </div>
    <a href="{{ route('rekreasi.category', ['id' => 'all']) }}" class="text-danger text-decoration-none"
        style="font-size: 1.5rem; font-weight:700; margin-left:auto;">Lihat
        Semua</a>
</div>

<div class="partner-container overflow-hidden" id="special-swiper-container">
    <div class="swiper-wrapper">
        @foreach ($partners as $partner)
            <div class="swiper-slide gap-2">
                <!-- Card -->
                <a href="{{ route('rekreasi.detail', ['id' => $partner['id'], 'date' => \Carbon\Carbon::now()->addDay()->format('Y-m-d')]) }}"
                    class="text-decoration-none text-dark">
                    <div class="card shadow-sm" style="width: 18rem;">
                        <div class="position-relative">
                            <img src="{{ $partner['img'] }}" class="card-img-top"
                                alt="{{ $partner['business_name'] }}"
                                style="aspect-ratio: 1/1; object-fit: cover;"
                                onerror="this.src='https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg'">
                            <div class="badge bg-opacity-25 text-danger position-absolute translate-middle p-2 rounded-pill"
                                style="bottom: 0px; left:50px; background-color:pink !important;">
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="lokasi d-flex align-items-center">
                                <span class="fa-solid fa-location-dot me-2"></span>
                                <span class="text-start">{{ $partner['lokasi'] }}</span>
                            </div>

                            <h3 class="mt-3 text-dark text-start">{{ $partner['business_name'] }}</h3>

                            <div class="rating d-flex align-items-center text-start">
                                <span class="bintang text-warning fs-2 fa fa-star checked me-2"></span>
                                <span class="rating-number" style="position: relative; top: 1px;">{{ $partner['rate'] }}
                                    ({{ number_format((float) $partner['rating_count']) }}
                                    ulasan)
                                </span>
                            </div>

                            <div class="price mt-3 text-start">
                                <span style="font-size: 0.8rem" class="coret text-decoration-line-through">IDR
                                    {{-- {{ number_format($partner['origin_price'], 0, ',', '.') }}</span> --}}
                                    {{-- {{ dd($partner['origin_price']) }} --}}
                                    {{ number_format((float) ($partner['origin_price'] ?? 0), 0, ',', '.') }}</span>
                                <span class="text-danger text-bold">IDR
                                    {{ number_format((float) ($partner['cut_price'] ?? 0), 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>

@push('js')
    <script>
        const pswiper = new Swiper('.partner-swiper-container', {
            slidesPerView: 4, // Tampilkan 4 slide sekaligus
            spaceBetween: 50, // Jarak antar slide
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
