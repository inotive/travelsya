@extends('layouts.app_v2')

@section('content')
@include('pagesv2.health_beauty.partials._second_nav')
<div class="container mb-5">
    <section class="special-deals mt-5">
        <div class="section-title" style="margin-bottom:25px;">
            <div class="subtitle text-capitalize mt-2">Menampilkan <span class="text-dark" id="deal-count">{{ count($special_deals) }}</span>
                Hasil Pencarian
            </div>
            <div class="subtitle text-capitalize mt-2">
                @if(strtolower($category) === 'spa_beauty')
                    Special Deals Spa dan Kecantikan
                @elseif(strtolower($category) === 'beauty' || strtolower($category) === 'kecantikan')
                    Special Deals Kecantikan
                @elseif(strtolower($category) === 'health' || strtolower($category) === 'kesehatan')
                    Special Deals Kesehatan
                @else
                    Special Deals {{ ucfirst($category ?? 'health') }}
                @endif
            </div>
        </div>

        <div class="p-5 my-3">
            <div class="row g-6 g-lg-6" id="special-deals-container">
                @foreach ($special_deals as $deal)
                <div class="col-12 col-lg-3 col-md-4 p-3 d-flex justify-content-center special-deal-item">
                    <a href="{{ route('health_beauty.detail', ['lokasi' => ($deal->clinic->kota->city_name ?? '-'), 'clinic' => $deal->clinic, 'id' => $deal->clinic_id]) }}"
                        class="text-decoration-none text-dark   ">
                        <div class="card" style="box-shadow: 0 10px 15px gray">
                            <div style="height: 200px; overflow: hidden;">
                                <img src="{{ asset('storage/' . (isset($deal->image) && isset($deal->image->image) ? $deal->image->image : 'images/not_found.jpg')) }}"
                                class="card-img-top" style="width: 100%; height: 100%; object-fit: cover;" alt="{{ $deal->name }}"
                                onerror="this.src='https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg'">
                            </div>
                            <div class="card-body">
                            <div class="card-content">
                                <div class="w-100 d-flex flex-row align-items-center">
                                    <span class="fa-solid fa-location-dot me-2"></span>
                                    <span>{{ ucwords($deal->clinic->kota->city_name ?? '-') }}</span>
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
                                            {{ number_format((float)$deal->unit_price, 0, ',', '.') }}</span>
                                        <span style="font-size: 1.5rem;" class="text-danger text-bold">IDR
                                            {{ number_format((float)$deal->price, 0, ',', '.') }}</span>
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

@push('js')
<script>
    // Ambil referensi ke input pencarian dari _second_nav
    const searchInput = document.querySelector('#find');
    
    if (searchInput) {
        let timeout; // Untuk debounce
        
        // Tambahkan event listener untuk setiap perubahan pada input
        searchInput.addEventListener('input', function(e) {
            clearTimeout(timeout);
            
            // Set timeout untuk mencegah terlalu banyak permintaan
            timeout = setTimeout(function() {
                performSearch();
            }, 500); // Delay 500ms setelah mengetik
        });
    }
    
    // Fungsi untuk melakukan pencarian
    function performSearch() {
        const searchValue = searchInput ? searchInput.value : '';
        const category = "{{ $category ?? 'health' }}"; // Ambil kategori dari view
        
        // Jika input kosong, tampilkan semua data
        if (searchValue.trim() === '') {
            // Kita perlu mengambil semua data kembali
            $.ajax({
                url: "{{ route('health_beauty.search_special_deals') }}",
                type: "POST",
                data: {
                    _token: '{{ csrf_token() }}',
                    category: category
                },
                success: function(response) {
                    updateDealList(response.special_deals);
                },
                error: function(xhr, status, error) {
                    console.error('Error during search:', error);
                }
            });
            return;
        }
        
        // Siapkan parameter pencarian
        const params = {
            search: searchValue,
            category: category,
            _token: '{{ csrf_token() }}'
        };
        
        // Lakukan AJAX request ke endpoint pencarian
        $.ajax({
            url: "{{ route('health_beauty.search_special_deals') }}",
            type: "POST",
            data: params,
            success: function(response) {
                updateDealList(response.special_deals);
            },
            error: function(xhr, status, error) {
                console.error('Error during search:', error);
            }
        });
    }
    
    // Fungsi untuk memperbarui tampilan daftar deal
    function updateDealList(deals) {
        const container = document.getElementById('special-deals-container');
        const countElement = document.getElementById('deal-count');
        
        // Perbarui jumlah deal yang ditampilkan
        countElement.textContent = deals.length;
        
        // Kosongkan container
        container.innerHTML = '';
        
        // Tambahkan item deal yang sesuai
        if (deals.length > 0) {
            deals.forEach(deal => {
                // Buat elemen untuk item deal
                const dealItem = createDealItem(deal);
                container.appendChild(dealItem);
            });
        } else {
            // Tampilkan pesan jika tidak ada hasil
            container.innerHTML = '<div class="col-12"><p class="text-center">Tidak ada hasil ditemukan</p></div>';
        }
    }
    
    // Fungsi untuk membuat elemen deal item
    function createDealItem(deal) {
        const colDiv = document.createElement('div');
        colDiv.className = 'col-12 col-lg-3 col-md-4 p-3 d-flex justify-content-center special-deal-item';
        
        let imageUrl = 'https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg';
        if (deal.image && deal.image.image) {
            imageUrl = "{{ asset('storage/') }}/" + deal.image.image;
        }
        
        // Format harga
        const formattedUnitPrice = new Intl.NumberFormat('id-ID').format(deal.unit_price);
        const formattedPrice = new Intl.NumberFormat('id-ID').format(deal.price);
        
        colDiv.innerHTML = `
            <a href="/health-beauty/detail/${deal.clinic.kota ? deal.clinic.kota.city_name.toLowerCase() : 'unknown'}/${deal.clinic.clinic_name ? encodeURIComponent(deal.clinic.clinic_name) : 'unknown'}/${deal.clinic_id}"
                class="text-decoration-none text-dark">
                <div class="card" style="box-shadow: 0 10px 15px gray">
                    <img src="${imageUrl}"
                        class="card-img-top" alt="${deal.name}"
                        onerror="this.src='https://images.unsplash.com/photo-1461988320302-91bde64fc8e4?ixid=2yJhcHBfaWQiOjEyMDd9&&fm=jpg'">
                    <div class="card-body">
                        <div class="card-content">
                            <div class="w-100 d-flex flex-row align-items-center">
                                <span class="fa-solid fa-location-dot me-2"></span>
                                <span>${deal.clinic.kota ? deal.clinic.kota.city_name : 'Unknown'}</span>
                            </div>
                            
                            <h3 class="mt-3 text-dark">${deal.name}</h3>
                            
                            <div class="rating d-flex align-items-center">
                                <span class="bintang text-warning fs-2 fa fa-star checked me-2"></span>
                                <span class="rating-number" style="position: relative; top: 1px;">${deal.avgRating ? deal.avgRating : 0}
                                    (${deal.total_reviews ? deal.total_reviews : 0} ulasan)
                                </span>
                            </div>
                            
                            <div class="price mt-7">
                                <span class="coret text-decoration-line-through">IDR ${formattedUnitPrice}</span>
                                <span style="font-size: 1.5rem;" class="text-danger text-bold">IDR ${formattedPrice}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        `;
        
        return colDiv;
    }
    
    // Tambahkan CSS untuk menjaga ukuran gambar tetap konsisten
    const style = document.createElement('style');
    style.innerHTML = `
        .special-deals .card-img-top {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        
        .special-deals .card-img-container {
            height: 150px;
            overflow: hidden;
        }
    `;
    document.head.appendChild(style);
</script>
@endpush
