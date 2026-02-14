@extends('layouts.web-remake', ['title' => 'Cari Klinik Kecantikan & Kesehatan'])

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
        <section>
            <div class="container mt-4">
                
                <span class="text-muted m-3 fs-3">Menampilkan 
                    <span class="fw-bold text-dark fs-3">120</span> hasil pencarian
                </span>

                <div class="d-flex justify-content-between">

                <h1 class="m-3">Health</h1>
                
                <ul class="list-inline">
                    <li class="list-inline-item filter-item" style="border: 1px solid #ccc; padding: 8px; border-radius: 20px;" onclick="setActive(this)">
                        <span class="fs-5 me-2"> 
                            <i class="fas fa-filter me-2 ms-2" style="color: #ccc"></i>Filter
                        </span>
                    </li>
                    <li class="list-inline-item date-item" style="border: 1px solid #ccc; padding: 8px; border-radius: 20px;" onclick="setActive(this)">
                        <span class="fs-5 me-2"> 
                            <i class="fas fa-calendar me-2 ms-2" style="color: #ccc"></i>Tanggal
                        </span>
                    </li>
                    <li class="list-inline-item price-item" style="border: 1px solid #ccc; padding: 8px; border-radius: 20px;" onclick="setActive(this)">
                        <span class="fs-5 me-2"> 
                            <i class="fas fa-money-bill me-2 ms-2 " style="color: #ccc"></i>Harga
                        </span>
                    </li>
                    <li class="list-inline-item sort-item" style="border: 1px solid #ccc; padding: 8px; border-radius: 20px;" onclick="setActive(this)">
                        <span class="fs-5 me-2"> 
                            <i class="bi bi-filter fs-3 me-2 ms-2 " style="color: #ccc"></i>Urutkan
                        </span>
                    </li>
                </ul>
               
            </div>

            {{-- card --}}
            <div class="row m-3" style="padding-bottom: 70px">
            @for ($i = 0; $i < 8; $i++)
            
            <div class="col-3"> 
                <div class="card">
                    <div class="discount-tag-container">
                        <span class="discount-tag">Big Deals</span>
                    </div>
                    <img class="gambar-treat" style="filter: brightness(0.7);" src="{{ asset('storage/images/dokter.jpg') }}" alt="Image">
                    <div class="card-content">
                        <div class="lokasi d-flex align-items-center">
                            <span class="fa-solid fa-location-dot me-2"></span>
                            <span>Balikpapan</span>
                            <span style="margin-left: auto;" class="fa-regular fa-bookmark"></span>
                        </div>

                        <h3 class="mt-3 text-dark">Klinik Pratama</h3>

                        <div class="rating d-flex align-items-center">
                            <span class="bintang fa fa-star checked me-2"></span>
                            <span class="rating-number" style="position: relative; top: 1px;">4,8 (2rb ulasan)</span>
                        </div>

                        <div class="price mt-3">
                            <span class="coret text-decoration-line-through">{{ 'Rp '.number_format(200000) }}</span>
                            <span>{{ 'Rp '.number_format(100000) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endfor

        </div>
        </div>
        
        </section>
    </main>


    
@include('layouts.include.home.search-health-and-beauty')
@endsection

<script>
    function setActive(element) {
        // Menghapus kelas 'active' dari semua item
        const items = document.querySelectorAll('.list-inline-item');
        items.forEach(item => {
            item.classList.remove('active');
            item.style.backgroundColor = ''; // Reset background color
            item.style.color = 'ccc'; // Reset text color
            
            // Reset icon color to original
            const icon = item.querySelector('i');
            if (icon) {
                icon.style.color = '#ccc'; // Reset icon color
            }
        });

        // Menambahkan kelas 'active' pada elemen yang diklik
        element.classList.add('active');
        element.style.backgroundColor = '#c41e3a'; // Ganti dengan warna latar belakang yang diinginkan
        element.style.color = '#fff'; // Ganti dengan warna teks yang diinginkan
        
        // Change icon color to white
        const activeIcon = element.querySelector('i');
        if (activeIcon) {
            activeIcon.style.color = '#fff'; // Change icon color to white
        }
    }
</script>

