@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    /* Custom styling untuk Select2 agar sesuai dengan gaya halaman */
    .select2-container--default .select2-selection--single {
        border: none;
        border-radius: 0;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        background-color: #fff;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 1.5;
        padding-left: 0;
        padding-right: 0;
        color: #212529;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(1.5em + 0.75rem + 2px);
        top: 0;
    }
    
    /* Gaya khusus untuk dropdown lokasi */
    #location + .select2-container {
    }
    
    /* Gaya untuk hasil pencarian Select2 */
    .select2-results__option {
        padding: 0.375rem 0.75rem;
    }
    
    /* Gaya untuk opsi yang dipilih */
    .select2-container--default .select2-results__option--selected {
        background-color: #f8f9fa;
    }
    
    /* Gaya untuk opsi yang dihover */
    .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
        background-color: #f2416c;
        color: white;
    }
</style>
@endpush

<div class="container mb-5">
    <section class="cars mt-5">
        <div class="card border mb-5">
    <form action="{{ route('car_rent.show') }}" method="post">
        @csrf
        <div class="card-body d-flex align-items-center">
            <div class="input-group flex-grow-1 flex-nowrap bg-light rounded">
                <span class="input-group-text bg-transparent border-0">
                    <i class="fa-solid fa-search"></i>
                </span>
                <select name="category" id="category" class="form-select bg-transparent border-0 shadow-none" style="width: 200px; flex-shrink: 0;">
                    <option value="">Semua Cara Rental</option>
                    <option @if (isset($category) && $category=='Dengan Supir' ) selected @endif value="Dengan Supir">Dengan Supir</option>
                    <option @if (isset($category) && $category=='Lepas Kunci' ) selected @endif value="Lepas Kunci">Lepas Kunci</option>
                </select>
                <select name="location" id="location" class="form-select bg-transparent border-0 shadow-none" style="max-width: 220px;" data-placeholder="Pilih Lokasi" autocomplete="on" required>
                    <option value="">Pilih Lokasi</option>
                    @if(isset($near_location))
                        @foreach($near_location as $city)
                            <option value="{{ $city }}" @if (isset($location) && $location==$city) selected @endif>{{ $city }}</option>
                        @endforeach
                    @endif
                </select>
                @if(isset($brands) && $brands->count() > 0)
                <select name="brand_id" id="brand_id" class="form-select bg-transparent border-0 shadow-none" style="max-width: 220px;" data-placeholder="Pilih Merek">
                    <option value="">Semua Merek</option>
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id }}" @if (isset($brand_id) && $brand_id==$brand->id) selected @endif>{{ $brand->name }}</option>
                    @endforeach
                </select>
                @endif
                <input type="text" name="date" id="date" onfocus="(this.type='date')" class="form-control bg-transparent border-0 shadow-none" value="{{ isset($date) && $date != '' ? $date : date('Y-m-d') }}" placeholder="tanggal sewa">
                <input type="time" name="time" id="time" class="form-control bg-transparent border-0 shadow-none" value="{{ isset($time) && $time != '' ? $time : date('H:i', strtotime(now())) }}" style="width: 140px; flex-shrink: 0;">
                <input type="number" name="duration" class="form-control bg-transparent border-0 shadow-none" id="duration" value="{{ isset($duration) ? $duration : 1 }}" placeholder="durasi" style="width: 90px; flex-shrink: 0;">
                <span class="input-group-text bg-transparent border-0">Hari</span>
            </div>
            <button type="submit" class="btn btn-danger ms-3">Cari</button>
        </div>
    </form>
</div>

        <div class="d-flex justify-content-between align-items-center p-5 mb-25px">
            <div>
                <h4>Hasil Pencarian</h4>
                <p class="text-muted">{{ $cars->count() }} mobil ditemukan</p>
            </div>
        </div>

        <div class="card shadow-sm rounded-4 overflow-hidden"
            style="background: linear-gradient(to right, rgba(255, 150, 150, 0.5), white)">
            <div class="rounded-circle bg-danger position-absolute opacity-25"
                style="width:100px; height:100px; top: -50px; right: -40px;">
            </div>
            <div class="rounded-circle bg-danger position-absolute"
                style="width:25px; height:25px; top: 35px; right: -10px;">
            </div>
            <div class="card-body d-flex flex-column justify-content-start" style="z-index: 10;">
                <span class="card-title fw-bold my-2">Paket Reguler</span>
                <span>Cari tau mudahnya cara memesan Sewa mobil di Travelsya</span>
            </div>
        </div>

        <div class="p-5 my-3">
            <div class="row row-cols-4 row-cols-lg-4 g-6 g-lg-6" id="car_brands">
                @forelse ($cars as $car)
                <div class="card shadow mb-1 w-100">
                    <div class="card-body d-flex flex-row">
                        <div class="card-img-container" style="width: 150px; height: 100px; overflow: hidden;">
                            <img src="{{ $car->image_url ? Storage::url($car->image_url) : 'https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg' }}" 
                                 class="card-img-aspect card-img-top"
                                 alt="{{ $car->brand->name }}"
                                 onerror="this.src='https://thumb.ac-illust.com/b1/b170870007dfa419295d949814474ab2_t.jpeg'">
                        </div>
                        <div class="d-flex flex-column ms-5">
                            <span class="fw-bold mb-3">{{ $car->brand->name }}</span>
                            <div class="d-flex flex-row align-items-center">
                                <span class="fa-solid fa-user-group ms-5"></span>
                                <span class="ms-2">{{ $car->number_seats }} Penumpang</span>
                                <span class="fa-solid fa-gears ms-5"></span>
                                <span class="ms-2">{{ $car->category }}</span>
                                @if (strtolower($car->category_rent) == 'dengan driver')
                                <span class="fa-solid fa-user ms-5"></span>
                                @else
                                <span class="fa-solid fa-user-slash ms-5"></span>
                                @endif
                                <span class="ms-2" id="passage_number">{{ $car->category_rent }}</span>
                                <span class="fa-solid fa-building ms-5"></span>
                                <span class="ms-2">{{ count($car->vendor) }} Penyedia</span>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-end ms-sm-auto">
                            <span class="mb-3">Mulai dari</span>
                            <span class="mb-2"><span class="text-danger fs-5 fw-bold">IDR
                                    {{ number_format($car->rental_price_per_day, 0, ',', '.') }}</span> /
                                hari</span>
                            <!-- name, luggage, seats, id_brand, id_city -->
                            <button class="btn btn-danger py-1" id="provider_button-{{ $car->id }}"
                                data-bs-toggle="modal" data-bs-target="#providers-{{ $car->id }}-{{ strtolower(str_replace(' ', '_', $category ?? 'semua')) }}">Pilih
                                Mobil</button>
                        </div>
                    </div>
                </div>
                @include('pagesv2.car_rent.components._vendor_modal', ['car' => $car, 'type_transmission' => strtolower(str_replace(' ', '_', $category ?? 'semua')), 'category' => $category, 'lokasi' => $location, 'model' => $car->car_model_id ?? '', 'date' => $date.' '.$time, 'duration' => $duration])
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h4>Tidak ada mobil yang tersedia</h4>
                        <p>Silakan coba ubah kriteria pencarian Anda</p>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>



</div>

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Inisialisasi Select2 pada dropdown lokasi
        $('#location').select2({
            placeholder: "Pilih Lokasi",
            allowClear: true,
            width: '100%'
        });
        
        // Inisialisasi Select2 pada dropdown merek
        $('#brand_id').select2({
            placeholder: "Pilih Merek",
            allowClear: true,
            width: '100%'
        });
        
        // Reset dropdown location ketika halaman dimuat
        const locationSelect = document.getElementById('location');
        if (locationSelect && !locationSelect.value) {
            locationSelect.selectedIndex = 0;
        }
        
        // Tambahkan event listener untuk form submit
        const searchForm = document.querySelector('form[action="{{ route('car_rent.show') }}"]');
        const searchButton = searchForm ? searchForm.querySelector('button[type="submit"]') : null;
        
        if (searchForm && searchButton) {
            searchForm.addEventListener('submit', function(e) {
                // Validasi field kota
                if (!locationSelect.value) {
                    e.preventDefault();
                    alert('Silakan pilih lokasi terlebih dahulu');
                    locationSelect.focus();
                    return false;
                }
                
                // Nonaktifkan tombol selama proses submit
                searchButton.disabled = true;
                searchButton.innerHTML = 'Mencari...';
            });
        }
    });
</script>
@endpush