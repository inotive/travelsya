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
                                <input class="btn-check" type="radio" name="is_pulang_pergi" value="0" id="hero_sekali_jalan" checked required />
                                <!--end::Input-->
                                Sekali Jalan
                            </label>
                            <!--end::Radio-->

                            <!--begin::Radio-->
                            <label class="btn btn-link" data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check" type="radio" name="is_pulang_pergi" value="1" id="hero_pulang_pergi" required />
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
                                placeholder="Tanggal Berangkat" required />
                        </div>

                        {{-- Return Date Field (Hidden by default) --}}
                        <div class="input-group mb-3" id="hero_date_pulang_wrapper">
                            <span class="input-group-text bg-transparent">
                                <i class="fa-solid fa-calendar"></i>
                            </span>
                            <input type="text" name="date_pulang" id="hero_date_pulang" onfocus="(this.type='date')" class="form-control"
                                placeholder="Tanggal Pulang" />
                        </div>

                        <div class="input-group mb-4">
                            <span class="input-group-text bg-transparent">
                                <i class="fa-solid fa-chair"></i>
                            </span>
                            <input type="number" name="jumlah_penumpang" class="form-control"
                                placeholder="Jumlah Kursi" required />
                        </div>
                        <button type="submit" class="btn btn-danger w-100 fw-semibold bg-main">Cari Sekarang</button>

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

    /* Hero Return Date Field Animation */
    #hero_date_pulang_wrapper {
        max-height: 0;
        opacity: 0;
        overflow: hidden;
        margin-bottom: 0 !important;
        transition: all 0.3s ease;
    }

    #hero_date_pulang_wrapper.visible {
        max-height: 100px;
        opacity: 1;
        margin-bottom: 1rem !important;
    }
</style>

<script>
    // Pass route data from PHP to JavaScript
    const routeData = @json($routeData ?? []);

    function swapCities() {
        const kotaAwal = document.getElementById('kota_awal');
        const kotaTujuan = document.getElementById('kota_tujuan');

        // Store the current values
        const kotaAwalValue = kotaAwal.value;
        const kotaTujuanValue = kotaTujuan.value;

        // Temporarily set to empty to force re-population of all cities
        kotaAwal.value = "";
        kotaTujuan.value = "";

        // Update both dropdowns to show all cities
        updateDestinationDropdown();
        updateDepartureDropdown();

        // Set the swapped values
        kotaAwal.value = kotaTujuanValue;
        kotaTujuan.value = kotaAwalValue;
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

    // ========================================
    // PULANG PERGI FUNCTIONALITY
    // ========================================
    function handleHeroTripTypeChange() {
        const pulangPergiRadio = document.getElementById('hero_pulang_pergi');
        const datePulangWrapper = document.getElementById('hero_date_pulang_wrapper');
        const datePulangInput = document.getElementById('hero_date_pulang');

        const isPulangPergi = pulangPergiRadio.checked;

        if (isPulangPergi) {
            // Show return date field
            datePulangWrapper.classList.add('visible');
            datePulangInput.setAttribute('required', 'required');
        } else {
            // Hide return date field
            datePulangWrapper.classList.remove('visible');
            datePulangInput.removeAttribute('required');
            datePulangInput.value = '';
        }
    }

    // Add event listeners when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        const kotaAwal = document.getElementById('kota_awal');
        const kotaTujuan = document.getElementById('kota_tujuan');
        const sekaliJalanRadio = document.getElementById('hero_sekali_jalan');
        const pulangPergiRadio = document.getElementById('hero_pulang_pergi');

        if (kotaAwal) {
            kotaAwal.addEventListener('change', updateDestinationDropdown);
        }

        if (kotaTujuan) {
            kotaTujuan.addEventListener('change', updateDepartureDropdown);
        }

        // Listen to trip type changes
        if (sekaliJalanRadio) {
            sekaliJalanRadio.addEventListener('change', handleHeroTripTypeChange);
            sekaliJalanRadio.addEventListener('click', handleHeroTripTypeChange);
        }

        if (pulangPergiRadio) {
            pulangPergiRadio.addEventListener('change', handleHeroTripTypeChange);
            pulangPergiRadio.addEventListener('click', handleHeroTripTypeChange);
        }

        // Set initial state
        handleHeroTripTypeChange();
    });

    document.getElementById('myButton').addEventListener('click', function() {
        document.getElementById('myIcon').classList.toggle('rotated');
    });
</script>
