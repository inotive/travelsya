@extends('layouts.web-remake', ['title' => 'Detail Health & Beauty'])

@section('content-web')


<div class="container d-flex justify-content-between align-items-center position-relative" style="top: -15px;">
    <a href="{{ url()->previous() }}" class="btn btn-outline-dark mb-3"><i class="bi bi-arrow-left"></i> Kembali</a>
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

<main class="bg-white">
    <section class="hero bg-white" >
       
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="image-gallery mb-4">
                        <div class="row g-2 m-2">
                            <div class="col-md-6 ">
                                <img src="{{ asset('storage/images/hero-doktergigi.png') }}" class="img-fluid" alt="Main Clinic Image" style="height: 100%">
                            </div>
                            <div class="col-md-6">
                                <div class="row g-2 ps-3 pb-3">
                                    <div class="col-6 ps-3 pe-3">
                                        <img src="{{ asset('storage/images/kursi-doktergigi.png') }}" class="img-fluid " alt="Clinic Image 1">
                                    </div>
                                    <div class="col-6 ps-3 pe-3">
                                        <img src="{{ asset('storage/images/anak-kecil-diperiksa-dokter.png') }}" class="img-fluid " alt="Clinic Image 2">
                                    </div>
                                </div>
                                <div class="row g-2 ps-3 pt-3">
                                    <div class="col-6 ps-3 pe-3">
                                        <img src="{{ asset('storage/images/pov-diperiksa.png') }}" class="img-fluid " alt="Clinic Image 3">
                                    </div>
                                    <div class="col-6 ps-3 pe-3">
                                        <img src="{{ asset('storage/images/sikat-gigi.png') }}" class="img-fluid " alt="Clinic Image 4">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>


    </section>
        


    <div class="container mt-4">

        <div class="button-group">
            <button class="toggle-button active" data-category="/">Ringkasan</button>
            <button class="toggle-button" data-category="#">Highlight</button>
            <button class="toggle-button" data-category="#">Paket</button>
            <button class="toggle-button" data-category="/">Review</button>
            <button class="toggle-button" data-category="#">Lokasi</button>
            <button class="toggle-button" data-category="#">Deskripsi</button>
        </div>

        <div class="row">
            <div class="col-md-9">            
                <h1 class="card-title fs-1 fw-bold mt-3">Audy Dental Clinic Balikpapan</h1>
                <div class="d-flex align-items-center mb-3">
                    <i class="fas fa-star text-warning" style="width: 18px; height: 18px; margin-right: 7px;"></i>
                    <span class="text-dark fs-5 fw-bold me-3">4.8/5</span>
                        <small class="text-muted">(Lihat 2.303 ulasan)</small>
                    <span class="mx-2 text-muted">•</span>
                        <small class="text-muted">(Lihat 2.905 Terjual)</small>
                </div>
                    <p class="mb-2 fs-5"><i class="fas fa-map-marker-alt text-muted me-4"></i>Jl. Soekarno Hatta No.28, Batu Ampar, Kec. Balikpapan Utara, Kota Balikpapan, Kalimantan Timur</p>
                    <p class="fs-5"><i class="fas fa-clock text-muted me-2"></i> Buka Hari ini: 09:00 - 20:00 WIB <a class="fs-5" href="#" style="color: #C02425; font-weight: bold;">Lihat</a> </p> 
               
               
            </div>

            <div class="col-md-3">
                <div class="card-paket p-3 shadow-sm rounded " style="margin: 5px; margin-right: 20px;">
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fs-5 fw-bold">Mulai dari</span>
                        <span class="fs-4 fw-bold" style="color: #C02425;">IDR 230.000</span>
                    </div>
                    <button class="btn" style="background-color: #C02425; color: white; width: 100%; margin-top: 1rem;">Lihat Paket</button>                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">

        <div class="card p-2 shadow-sm rounded mt-5 mb-5 " style="background-color: #ffeaeadc; ">
            <h3 class="m-3">Highlight</h3>

            <span class="fs-5"><span class="mx-2 text-muted">•</span>Lorem ipsum dolor sit amet consectetur adipisicing elit</span>
            <span class="fs-5"><span class="mx-2 text-muted">•</span>Lorem ipsum dolor sit amet consectetur adipisicing elit</span>

            <a href="#" class="fs-5 m-3" style="color: #C02425; font-weight: bold;">Baca Selengkapnya</a>
        </div>

            </div>
        </div>
        <hr>

        <h1 class="fs-2 fw-bold mt-6">Paket</h1>
{{-- card pink --}}
        <div class="card p-3 shadow-sm rounded mt-5 mb-5 " style="background-color: #ffeaeadc; ">

            {{-- card 1 --}}
            <div class="card p-2 shadow-sm rounded m-3"> 
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="fs-5 fw-bold m-3">Perawatan Syaraf Gigi</h3>
                    <i class="fas fa-chevron-up me-3"></i>
                </div>
                <ul class="list-inline">
                    <li class="list-inline-item fs-5 m-3"><i class="fas fa-money-bill-alt me-2 text-muted"></i>Tidak bisa refund</li>
                    <li class="list-inline-item fs-5 m-3"><i class="fas fa-calendar-alt me-2 text-muted"></i>Pesan tiket untuk hari ini</li>
                    <li class="list-inline-item fs-5 m-3"><i class="fas fa-clock me-2 text-muted" style="font-size: 18px;" data-fa-transform="rotate-0"></i>Berlaku hingga 30 hari sejak dibeli</li>
                    <li class="list-inline-item fs-5 m-3"><i class="fas fa-clock me-2 text-muted" style="font-size: 18px;" data-fa-transform="rotate-0"></i>Reservasi paling lambat 1 hari sebelumnya</li>

                </ul>
                
                <a href="#" class="fs-5 m-3" style="color: #C02425; font-weight: bold;">Detail</a>

                <hr class="m-3" style="border: none; border-top: 4px dashed #ccc; margin: 20px 0;">

                <span class="fs-5 m-3">Masa berlaku : 26 Sep 2024 - 15 Okt 2024</span>

                <h3 class="fs-5 fw-bold m-3">Jumlah Tiket</h3>

                <div class="card p-2 rounded m-3" style="outline: 2px solid #d6d6d6;">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span class="fs-3 m-3">Adult</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="fs-3 fw-bold m-3" style="color: #C02425;">IDR 230.000</span>
                            <span class="fs-6 text-muted me-3">/pax</span>
                            <span class="fs-3 fw-bold m-3" style="color: #C02425;"><i class="fas fa-minus-circle ms-3"></i></span>
                            <span class="fs-3 fw-bold m-3">1</span>
                            <span class="fs-3 fw-bold m-3" style="color: #C02425;"><i class="fas fa-plus-circle me-3"></i></span>
                        </div>
                    </div>
                </div>

                <hr class="m-3">

                <span class="fs-5 m-3 text-muted">Total (1 pax)</span>

                <div class="d-flex justify-content-between align-items-center m-3"> 
                    <span class="fs-3 fw-bold m-3">IDR 230.000</span>

                   <button class="btn m-3" style="background-color: #C02425; color: white;">Pesan</button>
                </div>
            </div>
            {{-- end card 1 --}}

            {{-- card 2 --}}
            <div class="card p-2 shadow-sm rounded m-3">

                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="fs-5 fw-bold m-3">Perawatan Syaraf Gigi</h3>
                    <i class="fas fa-chevron-down me-3"></i>
                </div>
                <ul class="list-inline">
                    <li class="list-inline-item fs-5 m-3"><i class="fas fa-money-bill-alt me-2 text-muted"></i>Tidak bisa refund</li>
                    <li class="list-inline-item fs-5 m-3"><i class="fas fa-calendar-alt me-2 text-muted"></i>Pesan tiket untuk hari ini</li>
                    <li class="list-inline-item fs-5 m-3"><i class="fas fa-clock me-2 text-muted" style="font-size: 18px;" data-fa-transform="rotate-0"></i>Berlaku hingga 30 hari sejak dibeli</li>
                    <li class="list-inline-item fs-5 m-3"><i class="fas fa-clock me-2 text-muted" style="font-size: 18px;" data-fa-transform="rotate-0"></i>Reservasi paling lambat 1 hari sebelumnya</li>

                </ul>

                <a href="#" class="fs-5 m-3" style="color: #C02425; font-weight: bold;">Detail</a>

                <hr class="m-3" style="border: none; border-top: 4px dashed #ccc; margin: 20px 0;">

                <div class="d-flex justify-content-between align-items-center m-3"> 
                    <span class="fs-3 fw-bold m-3" style="color: #C02425">IDR 230.000</span>

                   <button class="btn m-3" style="background-color: #C02425; color: white;">Pilih Paket</button>
                </div>

            </div>
            {{-- end card 2 --}}

              {{-- card 2 --}}
              <div class="card p-2 shadow-sm rounded m-3">

                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="fs-5 fw-bold m-3">Perawatan Syaraf Gigi</h3>
                    <i class="fas fa-chevron-down me-3"></i>
                </div>
                <ul class="list-inline">
                    <li class="list-inline-item fs-5 m-3"><i class="fas fa-money-bill-alt me-2 text-muted"></i>Tidak bisa refund</li>
                    <li class="list-inline-item fs-5 m-3"><i class="fas fa-calendar-alt me-2 text-muted"></i>Pesan tiket untuk hari ini</li>
                    <li class="list-inline-item fs-5 m-3"><i class="fas fa-clock me-2 text-muted" style="font-size: 18px;" data-fa-transform="rotate-0"></i>Berlaku hingga 30 hari sejak dibeli</li>
                    <li class="list-inline-item fs-5 m-3"><i class="fas fa-clock me-2 text-muted" style="font-size: 18px;" data-fa-transform="rotate-0"></i>Reservasi paling lambat 1 hari sebelumnya</li>

                </ul>

                <a href="#" class="fs-5 m-3" style="color: #C02425; font-weight: bold;">Detail</a>

                <hr class="m-3" style="border: none; border-top: 4px dashed #ccc; margin: 20px 0;">

                <div class="d-flex justify-content-between align-items-center m-3"> 
                    <span class="fs-3 fw-bold m-3" style="color: #C02425">IDR 230.000</span>

                   <button class="btn m-3" style="background-color: #C02425; color: white;">Pilih Paket</button>
                </div>

            </div>
            {{-- end card 3 --}}

        </div> {{-- card pink --}}


        <h1 class="fs-1 fw-bold mt-6">Review</h1>
            <div class="d-flex align-items-center">
                <h1 class="fw-bold">
                    <i class="fas fa-star text-warning" style="width: 24px; height: 24px"></i>
                    4.8 
                    <span class="text-muted fs-4 me-3">/5</span>
                </h1>
                <ul class="list-unstyled m-3">
                    <li class="fs-3 fw-bold ms-3">Bagus</li>
                    <li class="fs-6 text-muted ms-3">Dari 2.500 review</li>
                </ul>
            </div>

            <section class="categories">
                
                <div style="display: flex; gap: 10px; padding: 5px; border-radius: 10px;" class="mb-3">
                    <button class="panah btn btn-outline-primary" onclick="document.querySelector('.category-grid').scrollLeft -= 200;">
                        <span class="chevron fa-solid fa-chevron-left"></span>
                    </button>
                    <button class="panah btn btn-outline-primary" onclick="document.querySelector('.category-grid').scrollLeft += 200;">
                        <span class="chevron fa-solid fa-chevron-right"></span>
                    </button>
                </div>
                
                <div class="category-grid">
                    
                    <div class="category-card shadow-sm m-3">

                        <div class="d-flex justify-content-between align-items-center m-3"> 
                        <h1 class="fw-bold m-3">
                            5.0 
                            <span class="text-muted fs-4 me-3">/5</span>
                        </h1>    
                        <span class="text-muted fs-4 m-3">23 Jan 2024</span>
                        </div>

                        <span class="fw-bold fs-4 m-3">Hayati Nur</span>
                        <p class="text-muted fs-5 m-3">Pelayanan nyaman banget.. Next bakalan balik lg buat treatment disini</p>

                    </div> 

                    <div class="category-card shadow-sm m-3">

                        <div class="d-flex justify-content-between align-items-center m-3"> 
                        <h1 class="fw-bold m-3">
                            5.0 
                            <span class="text-muted fs-4 me-3">/5</span>
                        </h1>    
                        <span class="text-muted fs-4 m-3">23 Jan 2024</span>
                        </div>

                        <span class="fw-bold fs-4 m-3">Hayati Nur</span>
                        <p class="text-muted fs-5 m-3">Pelayanan nyaman banget.. Next bakalan balik lg buat treatment disini</p>

                    </div> 

                    <div class="category-card shadow-sm m-3">

                        <div class="d-flex justify-content-between align-items-center m-3"> 
                        <h1 class="fw-bold m-3">
                            5.0 
                            <span class="text-muted fs-4 me-3">/5</span>
                        </h1>    
                        <span class="text-muted fs-4 m-3">23 Jan 2024</span>
                        </div>

                        <span class="fw-bold fs-4 m-3">Hayati Nur</span>
                        <p class="text-muted fs-5 m-3">Pelayanan nyaman banget.. Next bakalan balik lg buat treatment disini</p>

                    </div> 

                    <div class="category-card shadow-sm m-3">

                        <div class="d-flex justify-content-between align-items-center m-3"> 
                        <h1 class="fw-bold m-3">
                            5.0 
                            <span class="text-muted fs-4 me-3">/5</span>
                        </h1>    
                        <span class="text-muted fs-4 m-3">23 Jan 2024</span>
                        </div>

                        <span class="fw-bold fs-4 m-3">Hayati Nur</span>
                        <p class="text-muted fs-5 m-3">Pelayanan nyaman banget.. Next bakalan balik lg buat treatment disini</p>

                    </div> 

                
                </div>
            </section>
        
            <h1 class="fs-1 fw-bold mt-6">Lokasi</h1>
            
            <div class="card shadow-sm m-3">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7977.69760954408!2d116.87280659999999!3d-1.2631277!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df147bb7ffa3dbd%3A0x4bfd129991937999!2sInotive%20Technology%20%7C%20Jasa%20Pembuatan%20Website%20%26%20Aplikasi%20Mobile%20Kalimantan%20Timur%20%7C%20Konsultan%20IT%20%7C%20Digitalisasi%20Bisnis!5e0!3m2!1sid!2sid!4v1729491666575!5m2!1sid!2sid" width="1141" height="100" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <div class="card bg-white m-3 pt-6" style="height: 100px">
                   <div class="row">
                    <div class="col-9">
                        <span class="fw-bold fs-5 ms-5"> <i class="fas fa-map-marker-alt text-muted"></i> Jl. Soekarno Hatta No.28, Batu Ampar, Kec. Balikpapan Utara, Kota Balikpapan, Kalimantan Timur</span>
                    </div>
                    <div class="col-1 d-flex justify-content-center">
                        <ul class="list-unstyled ms-3">
                            <li class=" mb-2" style="">
                                <div class="panah ms-4" style="color: #C02425; width: 35px; height: 35px; display: flex; justify-content: center; align-items: center;">
                                    <i class="fas fa-map" style="height: 15px; width: 15px;"></i>
                                </div>
                            </li>
                            <li class="">
                                <div class="" style="color: #C02425; display: flex; flex-direction: column; align-items: center;">
                                    <span class="fs-6">Lihat Peta</span>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class="col-2 d-flex justify-content-center">
                        <ul class="list-unstyled">
                            <li class="mb-2" style="">
                                <div class="panah ms-12" style="color: #C02425; width: 35px; height: 35px; display: flex; justify-content: center; align-items: center;">
                                    <i class="fas fa-route" style="height: 15px; width: 15px;"></i>
                                </div>
                            </li>
                            <li class="">
                                <div class="" style="color: #C02425; display: flex; flex-direction: column; align-items: center;">
                                    <span class="fs-6">Panduan ke Lokasi</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                            

                    </div>
                </div>

            </div>
            {{-- end card --}}


            <h1 class="fs-1 fw-bold mt-9">Deskripsi</h1>

            <div class="container m-3">
                <span class=" fs-5 text-muted">
                AUDY Dental telah dipercaya melayani pasien di Indonesia selama lebih dari 15 tahun dengan 40 cabang yang tersebar di Jabodetabek, Karawang, Bandung, Surabaya, Semarang, dan Bali. Dengan berbagai keunggulan demi memberikan kenyamanan selama prosedur perawatan gigi dan mulut di AUDY Dental. <br>
                Segera cek daftar paket lengkapnya dan pesan sekarang dengan harga terjangkau di Travelsya!
                </span>
            </div>

    </div>
           
</main>

@include('layouts.include.home.detail-health-and-beauty')

@endsection



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterButtons = document.querySelectorAll('.toggle-button');
        const cards = document.querySelectorAll('.card');
        const partnerCards = document.querySelectorAll('.partner-grid .card');

        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                const category = this.getAttribute('data-category');
                
                // Remove 'active' class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add 'active' class to clicked button
                this.classList.add('active');

                // Filter cards in card-grid
                cards.forEach(card => {
                    if (category === 'all' || card.getAttribute('data-category') === category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Filter cards in partner-grid
                partnerCards.forEach(card => {
                    if (category === 'all' || card.getAttribute('data-category') === category) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    });
</script>