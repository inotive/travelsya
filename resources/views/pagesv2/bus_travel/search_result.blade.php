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
                                <input type="text" name="date_pergi" onfocus="(this.type='date')"
                                    class="form-control border-none max-w-150 py-0 border-right-2"
                                    placeholder="Tgl Berangkat" value="{{ $date_pergi }}" required />
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
    
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize the dropdowns
        updateDestinationDropdown();
        updateDepartureDropdown();
        
        // Add event listeners
        const kotaAwal = document.getElementById('kota_awal');
        const kotaTujuan = document.getElementById('kota_tujuan');
        
        if (kotaAwal) {
            kotaAwal.addEventListener('change', function() {
                updateDestinationDropdown();
            });
        }
        
        if (kotaTujuan) {
            kotaTujuan.addEventListener('change', function() {
                updateDepartureDropdown();
            });
        }
    });
    
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
</script>
@endpush
