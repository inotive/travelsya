@extends('layouts.web-remake', ['title' => 'Health & Beauty'])

@section('content-web')

        <div class="container d-flex justify-content-between align-items-center position-relative" style="top: -15px;">
            <a href="{{ url()->previous() }}" class="btn btn-outline-dark mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
            <form action="{{ url()->current() }}" method="GET" class="d-flex">
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><i class="bi bi-search"></i></span>
                    <input style="width: 310px; " type="search" name="search" value="{{ request()->query('search') }}" placeholder="Cari klinik kesehatan dan kecantikan disini" class="form-control" aria-label="Username" aria-describedby="basic-addon1">
                </div>
            </form>
        </div>
    

    <main>
        <section class="hero">
            <div class="hero-content">
                <h2 class="hawa text-white">Health and Beauty</h2>
                <h1 class="text-white">Cantik Sehat, Hidup Lebih Bahagia</h1>
            </div>

            <div class="search-box">
                <div class="button-group">
                    <button class="toggle-button active">Health</button>
                    <button class="toggle-button">Beauty</button>
                </div>

                <div class="search-container">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    <input type="text" placeholder="Mau treatment dimana?">
                </div>

                <div class="date-container">
                    <input type="text" placeholder="Pilihan tanggal">
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
                    @foreach ($clinics as $clinic)
                    @foreach ($clinic->clinicPackages as $package)
                    <!-- Repeat this card 5 times -->
                    
                    <div class="card" >
                        <div class="discount-tag-container" >
                            <span class="discount-tag">Big Deals</span>
                        </div>
                        <img class="gambar-treat" style="filter: brightness(0.7);" src="{{ asset('storage/clinichaspackages/' . $package->image) }}" alt="{{ $package->name }}">
                        <div class="card-content">
                            <div class="lokasi d-flex align-items-center">
                                <span class="fa-solid fa-location-dot me-2"></span>
                                <span style="position: relative; left: 240px;" class="fa-regular fa-bookmark"></span>
                                <span>{{ $clinic->city }}</span>
                            </div>

                            <h3 class="mt-3 text-dark">{{ $package->name }}</h3>

                            <div class="rating d-flex align-items-center">
                                <span class="bintang fa fa-star checked me-2"></span>
                                <span class="rating-number" style="position: relative; top: 1px;">4,8 (2rb ulasan)</span>
                            </div>

                            <div class="price mt-7">
                                <span class="coret text-decoration-line-through">{{ 'Rp '.number_format($package->price) }}</span>
                                <span>{{ 'Rp '.number_format($package->price) }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Repeat 4 more times -->
                    @endforeach
                    @endforeach
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
                        <img src="{{ asset('storage/images/treatment.png') }}" alt="Perawatan Kulit">
                        <h3 class="">Perawatan Kulit</h3>
                    </div>
                    <div class="category-card">
                        <img src="{{ asset('storage/images/treatment.png') }}" alt="Perawatan Kulit">
                        <h3 class="">Make Up</h3>
                    </div>
                    <div class="category-card">
                        <img src="{{ asset('storage/images/treatment.png') }}" alt="Perawatan Kulit">
                        <h3 class="">Perawatan Rambut</h3>
                    </div>
                    <div class="category-card">
                        <img src="{{ asset('storage/images/treatment.png') }}" alt="Perawatan Kulit">
                        <h3 class="">Health Care</h3>
                    </div>
                </div>

            </section>

            <section class="partners">
                <div class="section-header">
                    <h2>Kesehatan dan Kecantikan Terbaik!</h2>
                    <p>Saatnya segarkan penampilan kamu dengan mitra-mitra terbaik kami</p>
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
                    @foreach ($clinics as $clinic)
                        <div class="card me-5">
                            <img class="gambar-treat" src="{{ asset('storage/clinic/' . $clinic->image) }}" alt="{{ $clinic->name }}">   
                            <div class="partner-card">
                                <div class="d-flex align-items-center">
                                    <span style="position: absolute; right: 10px;" class="fa-regular fa-bookmark"></span>
                                    <span>{{ $clinic->category }}</span>
                                </div>
                                <h3 class="mt-3 text-dark">{{ $clinic->clinic_name }}</h3>
                            </div>
                        </div>    
                    @endforeach
                </div>
                
            </section>
        </div>
    </main>

    @include('layouts.include.home.script-health-and-beauty-remake')
@endsection