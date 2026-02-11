@extends('layouts.app_v2_no_main_header')

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
                        <a href="{{ route('health_beauty.detail', ['lokasi' => $partner->kota->city_name ?? '-', 'clinic' => $partner->clinic_name, 'id' => $partner->id]) }}" class="card shadow-sm text-dark" style="width: 18rem;">
                            <div class="position-relative">
                                <img src="{{ (isset($partner->image) && isset($partner->image->image)) ? asset($partner->image->image) : asset('images/health_default.png') }}"
                                    class="card-img-top" style="object-fit: cover; height: 150px;" alt="{{ $partner->clinic_name }}" onerror="this.onerror=null;this.src='{{ asset('images/health_default.png') }}'">
                            </div>
                            <div class="card-body p-3">
                                <div class="text-dark lokasi d-flex align-items-center">
                                    <span class="text-dark ">{{ $partner->category }}</span>
                                </div>

                                <h3 class="mt-3 text-dark text-start" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $partner->clinic_name }}</h3>

                                <div class="price mt-3 text-start">
                                    @if($partner->packages && $partner->packages->count() > 0 && $partner->packages[0])
                                    <span style="font-size: 0.8rem" class="coret text-dark  text-decoration-line-through">IDR
                                        {{ number_format((float)$partner->packages[0]->unit_price ?? 120000, 0, ',', '.') }}</span>
                                    <span class="text-danger text-bold">IDR
                                        {{ number_format((float)$partner->packages[0]->price ?? 120000, 0, ',', '.') }}</span>
                                    @else
                                    <span style="font-size: 0.8rem" class="coret text-dark  text-decoration-line-through">IDR
                                        {{ number_format(0, 0, ',', '.') }}</span>
                                    <span class="text-danger text-bold">IDR
                                        {{ number_format(0, 0, ',', '.') }}</span>
                                    @endif
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
