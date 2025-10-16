@extends('layouts.app_v2')

@section('content')
    @include('pagesv2.health_beauty.partials._second_nav')
    <div class="container mb-5">
        <section class="special-deals mt-5">
            <div class="section-title" style="margin-bottom:25px;">
                <div class="subtitle text-capitalize mt-2">Menampilkan <span class="text-dark">{{ $packages->count() }}</span> hasil
                    pencarian
                </div>
                <div class="subtitle text-capitalize mt-2">Kategori {{ $category['name'] }}</div>
            </div>

            <div class="p-5 my-3">
                <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6">
                    @foreach ($packages as $p)
                    <div class="col p-3">
                        <a href="{{ route('rekreasi.detail', ['id' => $p['recreation_id'], 'date' => \Carbon\Carbon::now()->addDay()->format('Y-m-d')]) }}"
                            class="text-decoration-none text-dark   ">
                            <div class="card" style="box-shadow: 0 10px 15px gray">
                                <img src="{{ optional($p->image)->image ? Storage::url(Str::after($p->image->image, 'public/')) : 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg&w=400&fit=max' }}"
                                    onerror="this.src='https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg&w=400&fit=max'"
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <div class="card-content">
                                        <div class="w-100 d-flex flex-row align-items-center">
                                            <span class="fa-solid fa-location-dot me-2"></span>
                                            <span>{{ $p->recreation->kota->city_name ?? 'Lokasi tidak ditemukan' }}</span>
                                            <span style="margin-left:auto;" class="fa-regular fa-bookmark"></span>
                                        </div>

                                        <h3 class="mt-3 text-dark">{{ ucwords($p->name) }}</h3>

                                        <div class="rating d-flex align-items-center">
                                            <span class="bintang text-warning fs-2 fa fa-star checked me-2"></span>
                                            <span class="rating-number" style="position: relative; top: 1px;">{{ $p->avgRating() }}
                                                ({{ $p->reviews->count() }}
                                                ulasan)
                                            </span>
                                        </div>

                                        <div class="price mt-7">
                                            <span class="coret text-decoration-line-through">IDR
                                                {{ number_format((float)$p->unit_price, 0, ',', '.') }}</span>
                                            <span style="font-size: 1.5rem;" class="text-danger text-bold">IDR
                                                {{ number_format((float)$p->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>

        </section>
    </div>

@endsection
