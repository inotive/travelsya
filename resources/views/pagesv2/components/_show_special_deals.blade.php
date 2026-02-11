<div class="section-title" style="margin-bottom:25px;">
    <div class="subtitle text-capitalize mt-2">Menampilkan <span class="text-dark">{{ $special_deals->count() }}</span>
        Special Deals
    </div>
    <div class="subtitle text-capitalize mt-2">{{ $section_title }}</div>
</div>

<div class="p-5 my-3">
    <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6">
        @foreach ($special_deals as $deal)
        <div class="col p-3">
            <a href="{{ route($route, ['lokasi' => $deal->lokasi, 'clinic' => $deal->name, 'id' => $deal->id]) }}"
                class="text-decoration-none text-dark   ">
                <div class="card" style="box-shadow: 0 10px 15px gray">
                    <img src="https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg&w=400&fit=max"
                        class="card-img-top" alt="...">
                    <div class="card-body">
                        <div class="card-content">
                            <div class="w-100 d-flex flex-row align-items-center">
                                <span class="fa-solid fa-location-dot me-2"></span>
                                <span>{{ ucwords($deal->lokasi) }}</span>
                                <span style="margin-left:auto;" class="fa-regular fa-bookmark"></span>
                            </div>

                            <h3 class="mt-3 text-dark">{{ ucwords($deal->name) }}</h3>

                            <div class="rating d-flex align-items-center">
                                <span class="bintang text-warning fs-2 fa fa-star checked me-2"></span>
                                <span class="rating-number" style="position: relative; top: 1px;">{{ str_replace(',',
                                    '.', $deal->rate) }}
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
            </a>
        </div>
        @endforeach
    </div>
</div>
