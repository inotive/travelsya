@extends('layouts.app_v2')

@section('content')
    @include('pagesv2.health_beauty.partials._second_nav')
    <div class="container mb-5">
        <section class="special-deals mt-5">
            <div class="section-title" style="margin-bottom:25px;">
                <div class="subtitle text-capitalize mt-2">Menampilkan <span class="text-dark">{{ $mitra->count() }}</span> hasil
                    pencarian
                </div>
                <div class="subtitle text-capitalize mt-2">Semua Mitra</div>
            </div>

            <div class="p-5 my-3">
                <div class="row g-6 g-lg-6 justify-content-center">
                    @foreach ($mitra as $partner)
                    <div class="col-12 col-md-4 col-lg-3 p-3 d-flex justify-content-center">
                        <a href="{{ route('health_beauty.detail', ['lokasi' => $partner->kota->city_name, 'clinic' => $partner['clinic_name'], 'id' => $partner['id']]) }}" class="card shadow-sm text-dark" style="width: 18rem;">
                            <div class="position-relative">
                                <img src="{{ $partner->image->image != null ? asset($partner->image->image) : 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg' }}"
                                    class="card-img-top" alt="{{ $partner->clinic_name }}">
                            </div>
                            <div class="card-body p-3">
                                <div class="text-dark lokasi d-flex align-items-center">
                                    <span class="text-dark ">{{ $partner->category }}</span>
                                    <span style="position: relative; margin-left: auto;" class="fa-regular text-dark  fa-bookmark fs-2"></span>
                                </div>

                                <h3 class="mt-3 text-dark text-start">{{ $partner->clinic_name }}</h3>

                                <div class="price mt-6 text-start">
                                    <span style="font-size: 0.8rem" class="coret text-dark  text-decoration-line-through">IDR
                                        {{ number_format($partner->packages[0]->unit_price ?? 120000, 0, ',', '.') }}</span>
                                    <span class="text-danger text-bold">IDR
                                        {{ number_format($partner->packages[0]->price ?? 120000, 0, ',', '.') }}</span>
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
