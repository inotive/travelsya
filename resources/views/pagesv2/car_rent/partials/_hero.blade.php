<section class="hero-wrapper position-relative" style="margin-bottom: 75px;">
    <img src="{{ asset('images/car_rent.jpg') }}" alt="travelsya sewa mobil" class="hero-img" height="100%"
        width="100%">
    <div class="hero-item-wrapper row position-absolute w-100 mx-auto">
        <div class="col-12 banner-title col-md-6">
            <span class="badge badge-custom-hero">Sewa Mobil</span>
            <h1 class="banner-text-title mt-3 text-white fw-bold">Rental Mobil Terdekat</h1>
        </div>
        <div class="col-12 col-md-6 banner-search">
            <div class="search-banner-wrapper w-500px">
                <div class="card card-body p-3">
                    <form action="{{ route('car_rent.show') }}" method="post">
                        @csrf

                        <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">

                            <!--begin::Radio-->
                            <label class="btn btn-link active" data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check" type="radio" name="category" value="Dengan Driver" checked required />
                                <!--end::Input-->
                                Dengan Supir
                            </label>
                            <!--end::Radio-->

                            <!--begin::Radio-->
                            <label class="btn btn-link" data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check" type="radio" name="category" value="Lepas Kunci" required />
                                <!--end::Input-->
                                Lepas Kunci
                            </label>
                            <!--end::Radio-->

                        </div>
                        <div class="input-group mb-3">
                            <select name="location" id="location" class="form-select select" data-control="select2"
                                    data-placeholder="Pilih Lokasi" autocomplete="on" required>
                                <option value="">Pilih Lokasi</option>
                                @foreach($near_location as $city)
                                    <option value="{{ $city }}">{{ $city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-transparent">
                                <i class="fa-solid fa-calendar-days"></i>
                            </span>
                            <input type="text" name="date" onfocus="(this.type='date')" class="form-control"
                                placeholder="Tanggal reservasi" aria-label="date" aria-describedby="basic-addon1"
                                style="width: 25%;" />
                            <input type="time" name="time" id="time" class="form-control"
                                placeholder="Tanggal reservasi" aria-label="time" aria-describedby="basic-addon1" />
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-transparent">
                                <i class="fa-solid fa-hourglass"></i>
                            </span>
                            <input type="number" name="duration" class="form-control" placeholder="Durasi sewa"
                                aria-label="date" aria-describedby="basic-addon1" />
                            <span class="input-group-text bg-transparent text-secondary">Durasi sewa 12 jam/hari</span>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 fw-semibold bg-main" id="search-button">Cari Sekarang</button>

                        {{-- <a href="{{ route('register') }}" class="btn btn-danger w-100 fw-semibold bg-main">Cari
                            Sekarang</a> --}}

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('js')
<script>
    // $(document).ready(function () {
    //     $("#time").datetimepicker({
    //         pickDate: false,
    //         timeFormat: 'h:i',
    //         showMeridian: false
    //     });
    // });
    
    document.addEventListener('DOMContentLoaded', function() {
        const searchForm = document.querySelector('form[action="{{ route('car_rent.show') }}"]');
        const searchButton = document.getElementById('search-button');
        const locationSelect = document.getElementById('location');
        
        // Reset dropdown location ketika halaman dimuat untuk mencegah pemilihan otomatis
        if (locationSelect) {
            // Hapus atribut selected dari semua option
            const options = locationSelect.querySelectorAll('option');
            options.forEach(option => {
                option.removeAttribute('selected');
            });
            
            // Set selectedIndex ke 0 (option pertama yaitu "Pilih Lokasi")
            locationSelect.selectedIndex = 0;
        }
        
        if (searchForm && searchButton && locationSelect) {
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
