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

<div class="special-swiper-container overflow-hidden" id="special-swiper-container">
    <div class="swiper-wrapper">
        @foreach ($car_models as $model)
        <div class="swiper-slide gap-2">
            <!-- Card -->
            <a href="{{ route('car_rent.detail', ['id' => $model['id']]) }}" class="text-decoration-none text-dark">
                <div class="card shadow-sm" style="width: 18rem;">
                    <div class="position-relative card-img-container" style="overflow: hidden;">
                        <img src="{{ $model['img'] != '' ? Storage::url($model['img']) : 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg' }}"
                            class="card-img-top card-img-aspect" alt="{{ $model['name'] }}"
                            onerror="this.src='https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg'">
                        <div class="badge bg-opacity-25 text-danger position-absolute translate-middle p-2 rounded-pill"
                            style="bottom: 0px; left:50px; background-color:pink !important;">Big Deal
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="lokasi d-flex align-items-center">
                            <span class="fa-solid fa-location-dot me-2"></span>
                            <span class="text-start">{{ $model['lokasi'] }}</span>
                            <span style="position: relative; margin-left: auto;"
                                class="fa-regular fa-bookmark fs-2"></span>
                        </div>

                        <h3 class="mt-3 text-dark text-start">{{ $model['name'] }}</h3>
                    </div>
                </div>

            </a>
        </div>
        @endforeach
    </div>
</div>

@push('js')
<script>
    const spswiper = new Swiper('#special-swiper-container', {
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