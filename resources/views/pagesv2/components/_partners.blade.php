<div class="section-title" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center;">
        <h2 class="text-dark" style="position: relative; top: 3px;">{{ $section_title }}</h2>
    </div>
    <div class="subtitle text-capitalize mt-2">{{ $section_subtitle }}</div>
</div>

<div
    style="display: flex; gap: 10px; padding: 5px; border-radius: 10px; align-items: center; flex-direction:row; margin-bottom:25px;">
    <button class="panah btn btn-gray-carousel rounded-circle" data-bs-target="#partnersCarouselControls"
        data-bs-slide="prev">
        <span class="chevron fa-solid fa-chevron-left"></span>
    </button>
    <button class="panah btn btn-gray-carousel rounded-circle" data-bs-target="#partnersCarouselControls"
        data-bs-slide="next">
        <span class="chevron fa-solid fa-chevron-right"></span>
    </button>
    <a href="#spesial_deals" class="text-danger text-decoration-none"
        style="font-size: 1.5rem; font-weight:700; margin-left:auto;">Lihat
        Semua</a>
</div>

<div id="partnersCarouselControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($partners as $key => $partner)
            <div class="carousel-item {{ $key == 0 ? 'active' : 0 }}">
                <div class="card-wrapper container-md d-flex justify-content-around gap-2">
                    @foreach ($partner as $p)
                        <div class="card shadow-sm rounded-4">
                            <img src="{{ $p->img != '' ? $p->img : 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg' }}"
                                class="card-img-top-rounded" alt="...">
                            <div class="card-body">
                                <div class="card-content">
                                    <div class="lokasi d-flex align-items-center">
                                        <span class="fa-solid fa-location-dot me-2"></span>
                                        <span>{{ $p->lokasi }}</span>
                                        <span style="position: relative; margin-left: auto;"
                                            class="fa-regular fa-bookmark fs-2"></span>
                                    </div>

                                    <h3 class="mt-3 text-dark">{{ $p->name }}</h3>

                                    <div class="price mt-7">
                                        <span class="coret text-decoration-line-through">IDR
                                            {{ number_format($p->origin_price, 0, ',', '.') }}</span>
                                        <span style="font-size: 1.5rem;" class="text-danger text-bold">IDR
                                            {{ number_format($p->cut_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>
