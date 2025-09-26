<div class="section-title" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center;">
        <h2 class="text-dark" style="position: relative; top: 3px;">{{ $section_title }}</h2>
    </div>
    <div class="subtitle text-capitalize mt-2">{{ $section_subtitle }}</div>
</div>

<div style="display: flex; gap: 10px; border-radius: 10px; align-items: center; flex-direction:row; margin-bottom:25px;">
    <div class="panah btn btn-gray-carousel rounded-circle" id="category-button-prev">
        <span class="chevron fa-solid fa-chevron-left"></span>
    </div>
    <div class="panah btn btn-gray-carousel rounded-circle" id="category-button-next">
        <span class="chevron fa-solid fa-chevron-right"></span>
    </div>
    <a href="{{ route('rekreasi.category', ['id' => 'all']) }}" class="text-danger text-decoration-none"
        style="font-size: 1.5rem; font-weight:700; margin-left:auto;">Lihat
        Semua</a>
</div>

<div class="categories-swiper-container overflow-hidden">
    <div class="swiper-wrapper">
        @foreach ($categorises as $category)
            <div class="swiper-slide gap-2">
                <!-- Card -->
                <a href="{{ route('rekreasi.category', ['id' => $category['id']]) }}" class="card shadow-sm rounded-4 d-flex flex-row align-items-center"
                    style="width: 18rem;">
                    <img src="{{ Storage::url(Str::after($category['image'], 'public/')) }}"
                        class="card-img-top" alt="{{ $category['name'] }}"
                        onerror="this.src='https://images.unsplash.com/photo-1521289594125-e8e32a214a2b?q=80&w=3787&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'">
                    <div class="d-flex flex-column w-100 align-items-center" style="z-index: 1; position: absolute;">
                        <div class="carousel-tab">
                            <h3 class="text-light fw-bold">{{ $category['name'] }}</h3>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>


@push('js')
    <script>
        const cswiper = new Swiper('.categories-swiper-container', {
            slidesPerView: 4, // Tampilkan 4 slide sekaligus
            spaceBetween: 20, // Jarak antar slide
            navigation: {
                nextEl: '#category-button-next',
                prevEl: '#category-button-prev',
            },
            loop: true, // Aktifkan loop jika diperlukan
            slideToClickedSlide: true, // Untuk melompat ke slide yang di-klik
            autoplay: {
                delay: 5000,
            },
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
