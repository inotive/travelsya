<div class="section-title" style="margin-bottom:25px;">
    <div class="subtitle text-capitalize mt-2">Menampilkan <span class="text-dark">{{ '1200' }}</span> hasil pencarian
    </div>
    <div class="subtitle text-capitalize mt-2">{{ $section_subtitle }}</div>
</div>

<div class="p-5 my-3">
    <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6">
        <div class="col p-3">
            <a href="{{ route('health_beauty.detail', ['lokasi' => 'jakarta', 'clinic' => 'lorem']) }}"
                class="text-decoration-none">
                <div class="card" style="box-shadow: 0 10px 15px gray">
                    <img src="https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg&w=400&fit=max"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="card-content">
                            <div class="w-100 d-flex flex-row align-items-center">
                                <span class="fa-solid fa-location-dot me-2"></span>
                                <span>Jakarta</span>
                                <span style="margin-left:auto;" class="fa-regular fa-bookmark"></span>
                            </div>

                            <h3 class="mt-3 text-dark">Spesial deals</h3>

                            <div class="rating d-flex align-items-center">
                                <span class="bintang text-warning fs-2 fa fa-star checked me-2"></span>
                                <span class="rating-number" style="position: relative; top: 1px;">4,8 (2rb
                                    ulasan)</span>
                            </div>

                            <div class="price mt-7">
                                <span class="coret text-decoration-line-through">IDR 250.000</span>
                                <span style="font-size: 1.5rem;" class="text-danger text-bold">IDR 175.000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>