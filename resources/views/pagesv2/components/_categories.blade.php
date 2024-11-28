<div class="section-title" style="margin-bottom: 25px;">
    <div style="display: flex; align-items: center;">
        <h2 class="text-dark" style="position: relative; top: 3px;">{{ $section_title }}</h2>
    </div>
    <div class="subtitle text-capitalize mt-2">{{ $section_subtitle }}</div>
</div>

<div style="display: flex; gap: 10px; border-radius: 10px; align-items: center; flex-direction:row; margin-bottom:25px;">
    <button class="panah btn btn-gray-carousel rounded-circle" data-bs-target="#categoriesCarouselControls"
        data-bs-slide="prev">
        <span class="chevron fa-solid fa-chevron-left"></span>
    </button>
    <button class="panah btn btn-gray-carousel rounded-circle" data-bs-target="#categoriesCarouselControls"
        data-bs-slide="next">
        <span class="chevron fa-solid fa-chevron-right"></span>
    </button>
    <a href="#spesial_deals" class="text-danger text-decoration-none"
        style="font-size: 1.5rem; font-weight:700; margin-left:auto;">Lihat
        Semua</a>
</div>

<div id="categoriesCarouselControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($categorises as $key => $categories)
            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                <div class="card-wrapper container-md d-flex justify-content-around gap-2">
                    @foreach ($categories as $category)
                        <div class="card shadow-sm rounded-4 d-flex flex-row align-items-center">
                            <img src="{{ $category->img != '' ? $category->img : 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg' }}"
                                class="rounded-4 img-fluid" alt="...">
                            <div class="d-flex flex-column w-100 align-items-center"
                                style="z-index: 1; position: absolute;">
                                <div class="carousel-tab">
                                    <h3 class="text-light fw-bold">{{ $category->name }}</h3>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
