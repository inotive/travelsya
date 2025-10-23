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
                            <!-- Trip Type Selector -->
                            <div class="btn-group btn-group-sm mb-3 trip-type-selector" role="group" aria-label="Trip Type">
                                <input type="radio" class="btn-check" name="is_pulang_pergi" id="sekali_jalan" autocomplete="off" value="0"
                                    {{ old('is_pulang_pergi', $is_pulang_pergi ?? 0) == 0 ? 'checked' : '' }}>
                                <label class="btn" for="sekali_jalan">Sekali Jalan</label>

                                <input type="radio" class="btn-check" name="is_pulang_pergi" id="pulang_pergi" autocomplete="off" value="1"
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
                                    value="{{ $is_pulang_pergi == 1 ? $date_pulang : '' }}" />

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

                {{-- @if (isset($debug) || isset($is_pulang_pergi))
                    <div class="alert alert-danger mt-3">
                        <strong>Data terkirim</strong><br>
                        <pre>{{ json_encode([
                            'is_pulang_pergi' => $is_pulang_pergi ?? null,
                            'kota_awal' => $kota_awal ?? null,
                            'kota_tujuan' => $kota_tujuan ?? null,
                            'date_pergi' => $date_pergi ?? null,
                            'date_pulang' => $date_pulang ?? null,
                            'jumlah_penumpang' => $jumlah_penumpang ?? null,
                        ], JSON_PRETTY_PRINT) }}</pre>
                    </div>
                @endif --}}
                {{-- End Error/Success messages --}}

            </div>
        </div>
    </div>

    @include('pagesv2.bus_travel.partials._filter_search')

    @include('pagesv2.bus_travel.partials._bus_list')
@endsection

<script>
console.log('=== SCRIPT STARTING ===');

document.addEventListener('DOMContentLoaded', function() {
    console.log('=== DOM CONTENT LOADED ===');

    const routeData = @json($routeData ?? []);
    const kotaAwal = document.getElementById('kota_awal');
    const kotaTujuan = document.getElementById('kota_tujuan');
    const sekaliJalanRadio = document.getElementById('sekali_jalan');
    const pulangPergiRadio = document.getElementById('pulang_pergi');
    const datePulangInput = document.getElementById('date_pulang_input');

    console.log('Elements found:');
    console.log('- sekaliJalanRadio:', sekaliJalanRadio);
    console.log('- pulangPergiRadio:', pulangPergiRadio);
    console.log('- datePulangInput:', datePulangInput);

    // ========================================
    // PULANG PERGI FUNCTIONALITY - FRESH START
    // ========================================

    function handleTripTypeChange() {
        const isPulangPergi = pulangPergiRadio.checked;

        console.log('Trip type changed. Pulang Pergi?', isPulangPergi);
        console.log('Current classes:', datePulangInput.className);

        if (isPulangPergi) {
            // Show return date field
            datePulangInput.classList.add('visible');
            datePulangInput.setAttribute('required', 'required');
            console.log('Added visible class. Classes now:', datePulangInput.className);
        } else {
            // Hide return date field
            datePulangInput.classList.remove('visible');
            datePulangInput.removeAttribute('required');
            datePulangInput.value = '';
            console.log('Removed visible class. Classes now:', datePulangInput.className);
        }
    }

    // Listen to BOTH change AND click events on BOTH radio buttons
    sekaliJalanRadio.addEventListener('change', function() {
        console.log('Sekali Jalan CHANGE event');
        handleTripTypeChange();
    });
    sekaliJalanRadio.addEventListener('click', function() {
        console.log('Sekali Jalan CLICK event');
        handleTripTypeChange();
    });

    pulangPergiRadio.addEventListener('change', function() {
        console.log('Pulang Pergi CHANGE event');
        handleTripTypeChange();
    });
    pulangPergiRadio.addEventListener('click', function() {
        console.log('Pulang Pergi CLICK event');
        handleTripTypeChange();
    });

    // Also listen on the LABELS (since Bootstrap uses labels for styling)
    const sekaliJalanLabel = document.querySelector('label[for="sekali_jalan"]');
    const pulangPergiLabel = document.querySelector('label[for="pulang_pergi"]');

    if (sekaliJalanLabel) {
        sekaliJalanLabel.addEventListener('click', function() {
            console.log('Sekali Jalan LABEL clicked');
            setTimeout(handleTripTypeChange, 10);
        });
    }

    if (pulangPergiLabel) {
        pulangPergiLabel.addEventListener('click', function() {
            console.log('Pulang Pergi LABEL clicked');
            setTimeout(handleTripTypeChange, 10);
        });
    }

    // Run on page load to set initial state
    console.log('Page loaded. Initial state check...');
    setTimeout(function() {
        handleTripTypeChange();
    }, 100);

    // ========================================
    // CITY DROPDOWN FUNCTIONALITY
    // ========================================

    function updateDestinationDropdown() {
        const selectedDeparture = kotaAwal.value;
        const currentDestination = kotaTujuan.value;
        kotaTujuan.innerHTML = '<option value="">Pilih kota tujuan</option>';

        if (!selectedDeparture || !routeData.departures || !routeData.departures[selectedDeparture]) {
            @foreach ($city as $c)
                kotaTujuan.innerHTML += `<option value="{{ $c }}" ${currentDestination === "{{ $c }}" ? 'selected' : ''}>{{ $c }}</option>`;
            @endforeach
            return;
        }

        routeData.departures[selectedDeparture].forEach(destination => {
            kotaTujuan.innerHTML += `<option value="${destination}" ${currentDestination === destination ? 'selected' : ''}>${destination}</option>`;
        });
    }

    function updateDepartureDropdown() {
        const selectedDestination = kotaTujuan.value;
        const currentDeparture = kotaAwal.value;
        kotaAwal.innerHTML = '<option value="">Pilih kota berangkat</option>';

        if (!selectedDestination || !routeData.destinations || !routeData.destinations[selectedDestination]) {
            @foreach ($city as $c)
                kotaAwal.innerHTML += `<option value="{{ $c }}" ${currentDeparture === "{{ $c }}" ? 'selected' : ''}>{{ $c }}</option>`;
            @endforeach
            return;
        }

        routeData.destinations[selectedDestination].forEach(departure => {
            kotaAwal.innerHTML += `<option value="${departure}" ${currentDeparture === departure ? 'selected' : ''}>${departure}</option>`;
        });
    }

    if (kotaAwal) kotaAwal.addEventListener('change', updateDestinationDropdown);
    if (kotaTujuan) kotaTujuan.addEventListener('change', updateDepartureDropdown);
    if (kotaAwal && kotaAwal.value) updateDestinationDropdown();
});
</script>

<style>
.trip-type-selector .btn {
    background: transparent !important;
    border: none !important;
    font-size: 1rem;
    font-weight: 500;
    color: #6c757d;
    transition: all 0.2s ease-in-out;
    padding: 0.25rem 0.75rem;
}
.trip-type-selector .btn:hover {
    color: #dc3545;
    font-weight: 600;
}
.trip-type-selector .btn-check:checked + .btn {
    color: #dc3545;
    font-weight: 700;
}
.trip-type-selector .btn + .btn {
    margin-left: 0.5rem;
}

/* Return Date Field - Simple Approach */
#date_pulang_input {
    width: 0;
    max-width: 0;
    padding: 0;
    border: none;
    margin: 0;
    transition: all 0.3s ease;
    overflow: hidden;
    opacity: 0;
}

#date_pulang_input.visible {
    width: 150px;
    max-width: 150px;
    padding: 0.375rem 0.75rem;
    border: 1px solid #ced4da;
    opacity: 1;
}
</style>

