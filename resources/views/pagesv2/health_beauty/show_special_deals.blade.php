@extends('layouts.app_v2')

@section('content')
@include('pagesv2.health_beauty.partials._second_nav')
<div class="container mb-5">
    <section class="special-deals mt-5">
        <div class="section-title" style="margin-bottom:25px;">
            <div class="subtitle text-capitalize mt-2">Menampilkan <span class="text-dark">{{ count($special_deals) }}</span>
                Hasil Pencarian
            </div>
            <div class="subtitle text-capitalize mt-2">Special Deals</div>
        </div>

        <div class="p-5 my-3">
            <div class="row g-6 g-lg-6">
                @foreach ($special_deals as $deal)
                <div class="col-12 col-lg-3 col-md-4 p-3 d-flex justify-content-center">
                    <a href="{{ route('health_beauty.detail', ['lokasi' => ($deal->clinic->kota->city_name ?? '-'), 'clinic' => $deal->clinic, 'id' => $deal->clinic_id]) }}"
                        class="text-decoration-none text-dark   ">
                        <div class="card" style="box-shadow: 0 10px 15px gray">
                            <img src="{{ asset('storage/' . (isset($deal->image) && isset($deal->image->image) ? $deal->image->image : 'images/not_found.jpg')) }}"
                            class="card-img-top" alt="{{ $deal->name }}"
                            onerror="this.src='https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg'">
                            <div class="card-body">
                            <div class="card-content">
                                <div class="w-100 d-flex flex-row align-items-center">
                                    <span class="fa-solid fa-location-dot me-2"></span>
                                    <span>{{ ucwords($deal->clinic->kota->city_name ?? '-') }}</span>
                                    <span style="margin-left:auto;" class="fa-regular fa-bookmark"></span>
                                </div>

                                    <h3 class="mt-3 text-dark">{{ ucwords($deal->name) }}</h3>

                                    <div class="rating d-flex align-items-center">
                                        <span class="bintang text-warning fs-2 fa fa-star checked me-2"></span>
                                        <span class="rating-number" style="position: relative; top: 1px;">{{ $deal->avgRating() }}
                                            ({{ number_format($deal->reviews->count()) }}
                                            ulasan)
                                        </span>
                                    </div>

                                    <div class="price mt-7">
                                        <span class="coret text-decoration-line-through">IDR
                                            {{ number_format($deal->unit_price, 0, ',', '.') }}</span>
                                        <span style="font-size: 1.5rem;" class="text-danger text-bold">IDR
                                            {{ number_format($deal->price, 0, ',', '.') }}</span>
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
