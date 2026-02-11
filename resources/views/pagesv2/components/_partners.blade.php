<div class="section-title" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center;">
        <h2 class="text-dark" style="position: relative; top: 3px;">{{ $section_title }}</h2>
    </div>
    <div class="subtitle text-capitalize mt-2">{{ $section_subtitle }}</div>
</div>

<div
    style="display: flex; gap: 10px; border-radius: 10px; align-items: center; flex-direction:row; margin-bottom:25px;">
    {{-- <button class="panah btn btn-gray-carousel rounded-circle" id="carousel-control-prev"
        data-target="#specialdealsCarouselControls" href="#specialdealsCarouselControls" data-slide="prev">
        <span class="chevron fa-solid fa-chevron-left"></span>
    </button>
    <button class="panah btn btn-gray-carousel rounded-circle" id="carousel-control-next"
        data-target="#specialdealsCarouselControls" href="#specialdealsCarouselControls" data-slide="next">
        <span class="chevron fa-solid fa-chevron-right"></span>
    </button> --}}
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

<div class="partner-swiper-container overflow-hidden">
    <div class="swiper-wrapper">
        @foreach($partners as $partner)
        <div class="swiper-slide gap-2">
            <!-- Card -->
            <div class="card shadow-sm" style="width: 18rem;">
                <div class="position-relative">
                    <img src="{{ (isset($partner->image) && isset($partner->image->image)) ? asset($partner->image->image) : 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg' }}"
                        class="card-img-top" alt="{{ $partner->clinic_name }}">
                </div>
                <div class="card-body p-3">
                    <div class="lokasi d-flex align-items-center">
                        <span>{{ $partner->category }}</span>
                        <span style="position: relative; margin-left: auto;" class="fa-regular fa-bookmark fs-2"></span>
                    </div>

                    <h3 class="mt-3 text-dark text-start">{{ $partner->clinic_name }}</h3>

                    <div class="price mt-6 text-start">
                        <span style="font-size: 0.8rem" class="coret text-decoration-line-through">IDR
                            @if($partner->packages && $partner->packages->count() > 0 && $partner->packages[0])
                                {{ number_format((float)($partner->packages[0]->unit_price ?? 120000), 0, ',', '.') }}
                            @else
                                {{ number_format(0, 0, ',', '.') }}
                            @endif
                        <span class="text-danger text-bold">IDR
                            @if($partner->packages && $partner->packages->count() > 0 && $partner->packages[0])
                                {{ number_format((float)($partner->packages[0]->price ?? 120000), 0, ',', '.') }}
                            @else
                                {{ number_format(0, 0, ',', '.') }}
                            @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- <div id="specialdealsCarouselControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($special_deals as $key => $deals)
        <div class="carousel-item active">
            <div class="card-wrapper container-md d-flex justify-content-around gap-2">
                @foreach ($deals as $deal)
                <div class="card rounded-4 shadow-sm">
                    <div class="position-relative">
                        <img src="{{ $deal->img != '' ? $deal->img : 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg' }}"
                            class="card-img-top-rounded img-fluid" alt="...">
                        <div class="badge bg-opacity-25 text-danger position-absolute translate-middle p-2 rounded-pill"
                            style="bottom: 25px; left:50px; background-color:pink !important;">Big Deal
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card-content">
                            <div class="lokasi d-flex align-items-center">
                                <span class="fa-solid fa-location-dot me-2"></span>
                                <span>{{ $deal->lokasi }}</span>
                                <span style="position: relative; margin-left: auto;"
                                    class="fa-regular fa-bookmark fs-2"></span>
                            </div>

                            <h3 class="mt-3 text-dark">{{ $deal->name }}</h3>

                            <div class="rating d-flex align-items-center">
                                <span class="bintang text-warning fs-2 fa fa-star checked me-2"></span>
                                <span class="rating-number" style="position: relative; top: 1px;">{{ $deal->rate }}
                                    (2rb
                                    ulasan)
                                </span>
                            </div>

                            <div class="price mt-7">
                                <span class="coret text-decoration-line-through">IDR
                                    {{ number_format($deal->origin_price, 0, ',', '.') }}</span>
                                <span style="font-size: 1.5rem;" class="text-danger text-bold">IDR
                                    {{ number_format($deal->cut_price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
</div> --}}

@push('js')
<script>
    $(document).ready(function(){

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
                1500: {
                    slidesPerView: 5,
                },
                1200: {
                    slidesPerView: 4,
                },
                768: {
                    slidesPerView: 4, // Tampilkan 3 slide untuk layar lebih kecil
                },
                576: {
                    slidesPerView: 3, // Tampilkan 2 slide untuk layar sangat kecil
                },
                320: {
                    slidesPerView: 2, // Tampilkan 2 slide untuk layar sangat kecil
                },
            },
        });
    });
</script>

@endpush
