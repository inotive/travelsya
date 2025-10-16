@extends('layouts.app_v2')

@section('content')
    @include('pagesv2.bus_travel.partials._second_nav')

    <div class="container my-5 mb-50">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form id="mainSearchForm" action="{{ route('bus_travel.search') }}" method="POST">
                    @csrf
                    <div class="row justify-content-between">
                        <div class="col-12 col-md-10">
                            <div class="btn-group btn-group-sm mb-3 trip-type-selector" role="group" aria-label="Trip Type">
                                <input type="hidden" name="is_pulang_pergi" id="is_pulang_pergi_input" value="{{ old('is_pulang_pergi', $is_pulang_pergi ?? 0) }}">

                                <input type="radio" class="btn-check" name="trip_type" id="sekali_jalan" autocomplete="off" value="0"
                                    {{ old('is_pulang_pergi', $is_pulang_pergi ?? 0) == 0 ? 'checked' : '' }}>
                                <label class="btn" for="sekali_jalan">Sekali Jalan</label>

                                <input type="radio" class="btn-check" name="trip_type" id="pulang_pergi" autocomplete="off" value="1"
                                    {{ old('is_pulang_pergi', $is_pulang_pergi ?? 0) == 1 ? 'checked' : '' }}>
                                <label class="btn" for="pulang_pergi">Pulang Pergi</label>
                            </div>

                            <div class="input-group">
                                <span class="input-group-text bg-light border-none">
                                    <i class="fa-solid fa-search"></i>
                                </span>
                                <select name="kota_awal" id="kota_awal" class="form-control border-none max-w-120 py-0"
                                    placeholder="Kota Awal" required>
                                    <option value="">Kota Awal</option>
                                    @foreach ($city as $c)
                                        <option value="{{ $c }}" {{ $kota_awal == $c ? 'selected' : '' }}>
                                            {{ $c }}</option>
                                    @endforeach
                                </select>
                                <span class="input-group-text border-none bg-light">
                                    <i class="fa-solid fa-arrow-right"></i>
                                </span>
                                <select name="kota_tujuan" id="kota_tujuan" class="form-control border-none border-right-2 max-w-120 py-0"
                                    placeholder="Kota Tujuan" required>
                                    <option value="">Kota Tujuan</option>
                                    @foreach ($city as $c)
                                        <option value="{{ $c }}"
                                            {{ $kota_tujuan == $c ? 'selected' : '' }}>{{ $c }}</option>
                                    @endforeach
                                </select>

                                {{-- Departure Date --}}
                                <input type="text" name="date_pergi" onfocus="(this.type='date')"
                                    class="form-control border-none max-w-150 py-0 border-right-2"
                                    placeholder="Tgl Berangkat" value="{{ $date_pergi }}" required />

                                {{-- Return Date (Conditionally Visible) --}}
                                <input type="text" name="date_pulang" id="date_pulang_input" onfocus="(this.type='date')"
                                    class="form-control border-none max-w-150 py-0 border-right-2"
                                    placeholder="Tgl Pulang"
                                    value="{{ $is_pulang_pergi == 1 ? $date_pulang : '' }}"
                                    style="display: {{ old('is_pulang_pergi', $is_pulang_pergi ?? 0) == 1 ? 'block' : 'none' }};" />

                                <input type="number" name="jumlah_penumpang" min="1"
                                    class="form-control border-none py-0 max-w-50 pe-0" placeholder="Jumlah Tiket"
                                    value="{{ $jumlah_penumpang }}" required />
                                <div class="d-flex align-items-center">Kursi</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 d-flex align-items-center justify-content-end">
                            <button type="submit" class="btn btn-sm btn-light-danger">Cari</button>
                        </div>
                    </div>
                </form>
                {{-- Error/Success messages remain here --}}
                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <strong>Terjadi kesalahan saat mengirim formulir:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger mt-3">
                        <strong>Error:</strong> {{ session('error') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- End Error/Success messages --}}

            </div>
        </div>
    </div>

    @include('pagesv2.bus_travel.partials._filter_search')

    @include('pagesv2.bus_travel.partials._bus_list')
@endsection

@push('scripts')
<script>
    // Pass route data from PHP to JavaScript
    const routeData = @json($routeData ?? []);

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
        validDepartures.forEach(departure => {
            kotaAwal.innerHTML += '<option value="' + departure + '"' + (currentDeparture === departure ? ' selected' : '') + '>' + departure + '</option>';
        });
    }

    // New logic for Pulang Pergi / Sekali Jalan selector
    function setupTripTypeToggle() {
        const sekaliJalanRadio = document.getElementById('sekali_jalan');
        const pulangPergiRadio = document.getElementById('pulang_pergi');
        const datePulangInput = document.getElementById('date_pulang_input');
        const isPulangPergiHiddenInput = document.getElementById('is_pulang_pergi_input');

        function toggleReturnDate() {
            if (pulangPergiRadio.checked) {
                // Round Trip (Pulang Pergi) selected
                datePulangInput.style.display = 'block';
                datePulangInput.required = true;
                isPulangPergiHiddenInput.value = 1;
            } else {
                // One Way (Sekali Jalan) selected
                datePulangInput.style.display = 'none';
                datePulangInput.required = false;
                datePulangInput.value = ''; // Clear return date when switching to one-way
                isPulangPergiHiddenInput.value = 0;
            }
        }

        sekaliJalanRadio.addEventListener('change', toggleReturnDate);
        pulangPergiRadio.addEventListener('change', toggleReturnDate);

        // Initial check on load to set the correct state
        toggleReturnDate();
    }


    // Add event listeners when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        const kotaAwal = document.getElementById('kota_awal');
        const kotaTujuan = document.getElementById('kota_tujuan');

        // Initialize dropdowns based on existing selections
        if (kotaAwal && kotaAwal.value) {
            updateDestinationDropdown();
        }

        // Add event listeners for future changes
        if (kotaAwal) {
            kotaAwal.addEventListener('change', updateDestinationDropdown);
        }

        if (kotaTujuan) {
            kotaTujuan.addEventListener('change', updateDepartureDropdown);
        }

        // Setup the trip type toggle
        setupTripTypeToggle();
    });
</script>
@endpush

@push('styles')
<style>

    /* Base label styling */
    .trip-type-selector .btn {
        background: transparent !important;
        border: none !important;
        font-size: 1rem; /* same as kota awal/tujuan font size */
        font-weight: 500;
        color: #6c757d; /* subtle text color */
        transition: all 0.2s ease-in-out;
        padding: 0.25rem 0.75rem;
    }

    /* Hover effect */
    .trip-type-selector .btn:hover {
        color: #dc3545; /* matches your red accent */
        font-weight: 600;
    }

    /* Active (checked) state */
    .trip-type-selector .btn-check:checked + .btn {
        color: #dc3545;
        font-weight: 700;
    }

    /* Slight spacing between options */
    .trip-type-selector .btn + .btn {
        margin-left: 0.5rem;
    }
</style>
@endpush

