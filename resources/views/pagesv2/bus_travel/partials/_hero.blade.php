<section class="hero-wrapper position-relative" style="margin-bottom: 75px;">
    <img src="{{ asset('images/bus_travel.jpg') }}" alt="travelsya rekreasi" class="hero-img" height="100%"
        width="100%">
    <div class="hero-item-wrapper row position-absolute w-100 mx-auto">
        <div class="col-12 banner-title col-md-6">
            <span class="badge badge-custom-hero">Bus & Travel</span>
            <h1 class="banner-text-title mt-3 text-white fw-bold">Transportasi darat nyaman, aman, dan terjangkau</h1>
        </div>
        <div class="col-12 col-md-6 banner-search">
            <div class="search-banner-wrapper w-500px">
                <div class="card card-body p-3">
                    <form action="{{ route('bus_travel.search') }}" method="post" id="heroSearchForm">
                        @csrf

                        <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">

                            <!--begin::Radio-->
                            <label class="btn btn-link active" data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check" type="radio" name="is_pulang_pergi" value="0" checked required />
                                <!--end::Input-->
                                Sekali Jalan
                            </label>
                            <!--end::Radio-->

                            <!--begin::Radio-->
                            <label class="btn btn-link" data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check" type="radio" name="is_pulang_pergi" value="1" required />
                                <!--end::Input-->
                                Pulang Pergi
                            </label>
                            <!--end::Radio-->

                        </div>
                        <div class="input-grouped position-relative">
                            <div class="input-group">
                                <span
                                    class="input-group-text bg-transparent border-radius-bottom-left-none border-bottom-none">
                                    <i class="fa-solid fa-bus"></i>
                                </span>
                                <select name="kota_awal" id="kota_awal" class="form-control border-bottom-none border-left-none" required>
                                    <option value="">Pilih kota berangkat</option>
                                    @foreach ($city as $c)
                                    <option value="{{ $c }}">{{ $c }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <hr class="hr-line my-0">
                            <div class="d-flex wrapper-search">
                                <button type="button" onclick="swapCities()" class="input-group-text bg-white" id="myButton">
                                    <i class="bi bi-arrow-down-up" id="myIcon"></i>
                                </button>
                            </div>

                            <div class="input-group mb-3">
                                <span
                                    class="input-group-text bg-transparent border-radius-top-left-none border-top-none">
                                    <i class="fa-solid fa-location-dot"></i>
                                </span>
                                <select name="kota_tujuan" id="kota_tujuan" class="form-control border-left-none border-top-none" required>
                                    <option value="">Pilih kota tujuan</option>
                                    @foreach ($city as $c)
                                    <option value="{{ $c }}">{{ $c }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text bg-transparent">
                                <i class="fa-solid fa-calendar-days"></i>
                            </span>
                            <input type="text" name="date_pergi" onfocus="(this.type='date')" class="form-control"
                                placeholder="Tanggal reservasi" required />
                        </div>
                        <div class="input-group mb-4">
                            <span class="input-group-text bg-transparent">
                                <i class="fa-solid fa-chair"></i>
                            </span>
                            <input type="number" name="jumlah_penumpang" class="form-control"
                                placeholder="Jumlah Kursi" required />
                        </div>
                        <button type="submit" class="btn btn-danger w-100 fw-semibold bg-main">Cari Sekarang</button>

                    {{-- <a href="{{ route('register') }}" class="btn btn-danger w-100 fw-semibold bg-main">Cari
                        Sekarang</a> --}}

                    </form>
            </div>
        </div>
    </div>
</section>

<style>
    #myIcon {
        transition: transform 0.3s ease-in-out;
    }

    #myIcon.rotated {
        transform: rotate(180deg);
    }

</style>

<script>
    // Pass route data from PHP to JavaScript
    const routeData = @json($routeData ?? []);

    function swapCities() {
        const kotaAwal = document.getElementById('kota_awal');
        const kotaTujuan = document.getElementById('kota_tujuan');

        // Store the current values
        const tempValue = kotaAwal.value;

        // Swap the values
        kotaAwal.value = kotaTujuan.value;
        kotaTujuan.value = tempValue;

        // Update dropdowns after swap
        updateDestinationDropdown();
        updateDepartureDropdown();
    }

    function updateDestinationDropdown() {
        const kotaAwal = document.getElementById('kota_awal');
        const kotaTujuan = document.getElementById('kota_tujuan');
        const selectedDeparture = kotaAwal.value;

        // Store current destination value
        const currentDestination = kotaTujuan.value;

        // Clear destination options
        kotaTujuan.innerHTML = '<option value="">Pilih kota tujuan</option>';

        // If no departure selected, show all cities
        if (!selectedDeparture || !routeData.departures || !routeData.departures[selectedDeparture]) {
            @foreach ($city as $c)
                kotaTujuan.innerHTML += '<option value="{{ $c }}"' + (currentDestination === "{{ $c }}" ? ' selected' : '') + '>{{ $c }}</option>';
            @endforeach
            return;
        }

        // Add only valid destinations for the selected departure
        const validDestinations = routeData.departures[selectedDeparture];
        kotaTujuan.innerHTML += '<option value="">Pilih kota tujuan</option>';
        validDestinations.forEach(destination => {
            kotaTujuan.innerHTML += '<option value="' + destination + '"' + (currentDestination === destination ? ' selected' : '') + '>' + destination + '</option>';
        });
    }

    function updateDepartureDropdown() {
        const kotaAwal = document.getElementById('kota_awal');
        const kotaTujuan = document.getElementById('kota_tujuan');
        const selectedDestination = kotaTujuan.value;

        // Store current departure value
        const currentDeparture = kotaAwal.value;

        // Clear departure options
        kotaAwal.innerHTML = '<option value="">Pilih kota berangkat</option>';

        // If no destination selected, show all cities
        if (!selectedDestination || !routeData.destinations || !routeData.destinations[selectedDestination]) {
            @foreach ($city as $c)
                kotaAwal.innerHTML += '<option value="{{ $c }}"' + (currentDeparture === "{{ $c }}" ? ' selected' : '') + '>{{ $c }}</option>';
            @endforeach
            return;
        }

        // Add only valid departures for the selected destination
        const validDepartures = routeData.destinations[selectedDestination];
        kotaAwal.innerHTML += '<option value="">Pilih kota berangkat</option>';
        validDepartures.forEach(departure => {
            kotaAwal.innerHTML += '<option value="' + departure + '"' + (currentDeparture === departure ? ' selected' : '') + '>' + departure + '</option>';
        });
    }

    // Add event listeners when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        const kotaAwal = document.getElementById('kota_awal');
        const kotaTujuan = document.getElementById('kota_tujuan');

        if (kotaAwal) {
            kotaAwal.addEventListener('change', updateDestinationDropdown);
        }

        if (kotaTujuan) {
            kotaTujuan.addEventListener('change', updateDepartureDropdown);
        }
    });

    document.getElementById('myButton').addEventListener('click', function() {
        document.getElementById('myIcon').classList.toggle('rotated');
    });
</script>
