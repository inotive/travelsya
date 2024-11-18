@extends('layouts.web-remake', ['title' => 'Recreation'])

@section('content-web')

<div class="container d-flex justify-content-between align-items-center position-relative" style="top: -15px;">
    <a href="{{ url()->previous() }}" class="btn btn-outline-dark mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>
    <form action="{{ url()->current() }}" method="GET" class="d-flex">
        <div class="position-relative" style="width: 350px;">
            <!-- Search Icon -->
            <i class="bi bi-search position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%);"></i>

            <!-- Search Input -->
            <input
                type="search"
                name="search"
                value="{{ request()->query('search') }}"
                placeholder="Cari klinik kesehatan dan kecantikan disini"
                class="form-control rounded-pill"
                aria-label="Search"
                style="padding-left: 40px; border: 1px solid #ccc; box-shadow: none;"
            >
        </div>
    </form>
</div>



<main>
    <section class="hero">
        <div class="hero-content">
            <h2 class="hawa text-white">Rekreasi</h2>
            <h1 class="text-white">Waktu Santai Bersama Keluarga.</h1>
        </div>

        <div class="search-box">

            <div class="search-container">
                <i class="fa-solid fa-location-crosshairs search-box-icon-location"></i>
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" placeholder="Mau rekreasi dimana?">
            </div>

            <div class="date-container">
                <input id="date-picker" type="text" placeholder="Tanggal reservasi">
                <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                    <line x1="16" y1="2" x2="16" y2="6"></line>
                    <line x1="8" y1="2" x2="8" y2="6"></line>
                    <line x1="3" y1="10" x2="21" y2="10"></line>
                </svg>
            </div>

            <button class="search-button">Cari Sekarang</button>
        </div>
    </section>

    <div class="container">
        <section class="special-deals">
            <div class="section-header">
                <div style="display: flex; align-items: center;">
                    <span style="font-size: 28px; margin-right: 10px; color: red;" class="fa-solid fa-tags"></span>
                    <h2 class="text-dark" style="position: relative; top: 3px;">Special Deals</h2>
                </div>
                <p class="mt-4">Jelajahi kategori-kategori kami untuk kebahagiaan maksimal</p>
            </div>

            <div style="display: flex; gap: 10px; padding: 5px; border-radius: 10px;" class="mb-3">
                <button class="panah btn btn-outline-primary" onclick="document.querySelector('.card-grid').scrollLeft -= 300;">
                    <span class="chevron fa-solid fa-chevron-left"></span>
                </button>
                <button class="panah btn btn-outline-primary" onclick="document.querySelector('.card-grid').scrollLeft += 300;">
                    <span class="chevron fa-solid fa-chevron-right"></span>
                </button>
            </div>

            <div class="card-grid">
                <!-- Repeat this card 5 times -->
                {{-- @foreach ($recreation_list as $recreation) --}}

                @forelse($recreation_list as $recreation)
                <div class="card">
                    <div class="discount-tag-container">
                        <span class="discount-tag">Big Deals</span>
                    </div>
                    <img class="gambar-treat" style="filter: brightness(0.7);" src="{{ asset('storage/images/transstudio.png') }}" alt="Massage treatment">
                    <div class="card-content">
                        <div class="lokasi d-flex align-items-center">
                            <span class="fa-solid fa-location-dot me-2"></span>
                            <span style="position: relative; left: 240px;" class="fa-regular fa-bookmark"></span>
                            <span>{{ $recreation->city_name }}</span>
                        </div>

                        <h3 class="mt-3 text-dark">{{ $recreation->name }}</h3>

                        <div class="rating d-flex align-items-center">
                            <span class="bintang fa fa-star checked me-2"></span>
                            <span class="rating-number" style="position: relative; top: 1px;">4,8 (2rb ulasan)</span>
                        </div>

                        <div class="price mt-7">
                            <span class="coret text-decoration-line-through">IDR 200.000</span>
                            <span>{{ 'IDR ' .number_format($recreation->price) }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center">Tidak ada data</p>
                @endforelse

                {{-- @endforeach --}}

                <!-- Repeat 4 more times -->
            </div>
        </section>

        <section class="categories">
            <div class="section-header">
                <h2>Kebutuhan Kesehatan dan Kecantikan</h2>
                <p>Jelajahi kategori-kategori kami untuk kebahagiaan maksimal</p>
            </div>

            <div style="display: flex; gap: 10px; padding: 5px; border-radius: 10px;" class="mb-3">
                <button class="panah btn btn-outline-primary" onclick="document.querySelector('.category-grid').scrollLeft -= 200;">
                    <span class="chevron fa-solid fa-chevron-left"></span>
                </button>
                <button class="panah btn btn-outline-primary" onclick="document.querySelector('.category-grid').scrollLeft += 200;">
                    <span class="chevron fa-solid fa-chevron-right"></span>
                </button>
            </div>

            <div class="category-grid">
                <div class="category-card">
                    <img src="{{ asset('storage/images/transstudio.png') }}" alt="image">
                    <h3 class="">Trans Studio</h3>
                </div>
                <div class="category-card">
                    <img src="{{ asset('storage/images/museum.png') }}" alt="image">
                    <h3 class="">Museum</h3>
                </div>
                <div class="category-card">
                    <img src="{{ asset('storage/images/safari.png') }}" alt="image">
                    <h3 class="">Safari</h3>
                </div>
                <div class="category-card">
                    <img src="{{ asset('storage/images/atraksi.png') }}" alt="image">
                    <h3 class="">Atraksi</h3>
                </div>
                <div class="category-card">
                    <img src="{{ asset('storage/images/pentas.png') }}" alt="image">
                    <h3 class="">Pentas</h3>
                </div>
            </div>

        </section>

        <section class="partners">
            <div class="section-header">
                <h2>Tempat bermain terbaik di Jakarta</h2>
                <p>Menghabiskan waktu luang bersama keluarga jadi semakin seru</p>
            </div>

            <div style="display: flex; gap: 10px; padding: 5px; border-radius: 10px;" class="mb-3">
                <button class="panah btn btn-outline-primary" onclick="document.querySelector('.partner-grid').scrollLeft -= 200;">
                    <span class="chevron fa-solid fa-chevron-left"></span>
                </button>
                <button class="panah btn btn-outline-primary" onclick="document.querySelector('.partner-grid').scrollLeft += 200;">
                    <span class="chevron fa-solid fa-chevron-right"></span>
                </button>
            </div>

            <div class="partner-grid d-flex flex-row flex-nowrap overflow-auto">
                <!-- Repeat this 5 times -->
                @forelse ($recreation_list as $item)
                <div class="card me-5">
                    <img class="gambar-treat" src="{{ asset('storage/images/atraksi.png') }}" alt="Massage treatment">
                    <div class="partner-card">
                        <div class="d-flex align-items-center">
                            <span style="position: absolute; left: 278px;" class="fa-regular fa-bookmark"></span>
                            <span>{{ $item->city_name }}</span>
                        </div>

                        <h3 class="mt-3 text-dark">{{ $item->name }}</h3>

                        <div class="price mt-7">
                            <span class="coret text-decoration-line-through">IDR 200.000</span>
                            <span>{{ 'IDR ' .number_format($item->price) . '' }}</span>
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-center">Tidak ada data</p>
                @endforelse


            </div>

        </section>
    </div>
</main>

@include('recreation.include.include-style')
@include('recreation.include.include-script')
<script>
    flatpickr("#date-picker", {
        dateFormat: "Y-m-d"
    });

</script>
@endsection
