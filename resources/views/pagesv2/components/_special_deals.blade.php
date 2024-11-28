<div style="display: flex; gap: 10px; border-radius: 10px; align-items: center; flex-direction:row; margin-bottom:25px;">
    <button class="panah btn btn-gray-carousel rounded-circle" data-bs-target="#specialdealsCarouselControls"
        data-bs-slide="prev">
        <span class="chevron fa-solid fa-chevron-left"></span>
    </button>
    <button class="panah btn btn-gray-carousel rounded-circle" data-bs-target="#specialdealsCarouselControls"
        data-bs-slide="next">
        <span class="chevron fa-solid fa-chevron-right"></span>
    </button>
    <a href="#spesial_deals" class="text-danger text-decoration-none"
        style="font-size: 1.5rem; font-weight:700; margin-left:auto;">Lihat
        Semua</a>
</div>

<div id="specialdealsCarouselControls" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($special_deals as $key => $deals)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
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
                                        <span class="rating-number"
                                            style="position: relative; top: 1px;">{{ $deal->rate }}
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
</div>
