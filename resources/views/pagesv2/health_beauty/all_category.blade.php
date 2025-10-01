@extends('layouts.app_v2')

@section('content')
    @include('pagesv2.health_beauty.partials._second_nav')
    <div class="container mb-5">
        <section class="special-deals mt-5">
            <div class="section-title" style="margin-bottom:25px;">
                <div class="subtitle text-capitalize mt-2">Menampilkan <span class="text-dark">{{ $categories->count() }}</span> hasil
                    pencarian
                </div>
                <div class="subtitle text-capitalize mt-2">Semua Kategori</div>
            </div>

            <div class="p-5 my-3">
                <div class="row g-6 g-lg-6 justify-content-center">
                    @foreach ($categories as $category)
                    <div class="col-12 col-lg-3 col-md-4 p-3 d-flex justify-content-center">
                        <a href="{{ route('health_beauty.category', ['id' => $category->id]) }}" class="card shadow-sm rounded-4 d-flex flex-row align-items-center" style="width: 18rem;">
                            <img src="{{ $category->img ?? asset('images/placeholder.jpg') }}"
                                class="card-img-top card-img-bottom" alt="{{ $category->name }}">
                            <div class="d-flex flex-column w-100 align-items-center" style="z-index: 1; position: absolute;">
                                <div class="carousel-tab">
                                    <h3 class="text-light fw-bold">{{ $category->name }}</h3>
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
