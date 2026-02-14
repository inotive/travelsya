<!-- Create Departure Modal -->
<div class="modal fade" id="createDepartureModal" tabindex="-1" aria-labelledby="createDepartureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDepartureModalLabel">Tambah Jadwal Keberangkatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('partner.bus.departures.store') }}" method="POST">
                @csrf
                <input type="hidden" name="redirect_url" value="{{ Request::url() }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required">Bus</label>
                        <select class="form-select select2-bus" name="bus_travel_has_bus_id" id="bus_travel_has_bus_id" required>
                            <option value="">Pilih Bus</option>
                            @foreach ($allBuses as $id => $name)
                                <option value="{{ $id }}" {{ (isset($defaultBusId) && $defaultBusId == $id) ? 'selected' : '' }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="departure_date" class="form-label required">Tanggal Keberangkatan</label>
                            <input type="date" class="form-control" name="departure_date" id="departure_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="departure_time" class="form-label required">Waktu Keberangkatan</label>
                            <input type="time" class="form-control" name="departure_time" id="departure_time" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="from_city_id" class="form-label required">Dari</label>
                            <select class="form-select select2-city" name="from_city_id" id="from_city_id" required>
                                <option value="">Pilih Kota Asal</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="to_city_id" class="form-label required">Tujuan</label>
                            <select class="form-select select2-city" name="to_city_id" id="to_city_id" required>
                                <option value="">Pilih Kota Tujuan</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="titik_naik" class="form-label required">Titik Naik</label>
                            <input type="text" class="form-control" name="titik_naik" id="titik_naik" required>
                        </div>
                        <div class="col-md-6">
                            <label for="titik_turun" class="form-label required">Titik Turun</label>
                            <input type="text" class="form-control" name="titik_turun" id="titik_turun" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="duration" class="form-label required">Durasi (Jam)</label>
                            <input type="number" class="form-control" name="duration" id="duration" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label required">Harga (Rp)</label>
                            <input type="text" class="form-control" name="price" id="price" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Departure Modal -->
<div class="modal fade" id="editDepartureModal" tabindex="-1" aria-labelledby="editDepartureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDepartureModalLabel">Edit Jadwal Keberangkatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('partner.bus.departures.update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="edit_departure_id">
                <input type="hidden" name="redirect_url" value="{{ Request::url() }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required">Bus</label>
                        <p id="edit_bus_name" class="form-control-plaintext fw-bolder"></p>
                        <input type="hidden" name="bus_travel_has_bus_id" id="edit_bus_travel_has_bus_id">
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_departure_date" class="form-label required">Tanggal Keberangkatan</label>
                            <input type="date" class="form-control" name="departure_date" id="edit_departure_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_departure_time" class="form-label required">Waktu Keberangkatan</label>
                            <input type="time" class="form-control" name="departure_time" id="edit_departure_time" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_from_city_id" class="form-label required">Dari</label>
                            <select class="form-select select2-city-edit" name="from_city_id" id="edit_from_city_id" required>
                                <option value="">Pilih Kota Asal</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_to_city_id" class="form-label required">Tujuan</label>
                            <select class="form-select select2-city-edit" name="to_city_id" id="edit_to_city_id" required>
                                <option value="">Pilih Kota Tujuan</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_titik_naik" class="form-label required">Titik Naik</label>
                            <input type="text" class="form-control" name="titik_naik" id="edit_titik_naik" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_titik_turun" class="form-label required">Titik Turun</label>
                            <input type="text" class="form-control" name="titik_turun" id="edit_titik_turun" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_duration" class="form-label required">Durasi (Jam)</label>
                            <input type="number" class="form-control" name="duration" id="edit_duration" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_price" class="form-label required">Harga (Rp)</label>
                            <input type="text" class="form-control" name="price" id="edit_price" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Create Departure Modal for index2 -->
<div class="modal fade" id="createDepartureModalIndex2" tabindex="-1" aria-labelledby="createDepartureModalIndex2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDepartureModalIndex2Label">Tambah Jadwal Keberangkatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('partner.bus.departures.store') }}" method="POST">
                @csrf
                <input type="hidden" name="redirect_url" value="{{ Request::url() }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="index2_bus_travel_has_bus_id" class="form-label required">Bus</label>
                        <select class="form-select select2-bus-index2" name="bus_travel_has_bus_id" id="index2_bus_travel_has_bus_id" required>
                            <option value="">Pilih Bus</option>
                            @foreach ($allBuses as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="index2_departure_date" class="form-label required">Tanggal Keberangkatan</label>
                            <input type="date" class="form-control" name="departure_date" id="index2_departure_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="index2_departure_time" class="form-label required">Waktu Keberangkatan</label>
                            <input type="time" class="form-control" name="departure_time" id="index2_departure_time" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="index2_from_city_id" class="form-label required">Dari</label>
                            <select class="form-select select2-city-index2" name="from_city_id" id="index2_from_city_id" required>
                                <option value="">Pilih Kota Asal</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="index2_to_city_id" class="form-label required">Tujuan</label>
                            <select class="form-select select2-city-index2" name="to_city_id" id="index2_to_city_id" required>
                                <option value="">Pilih Kota Tujuan</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="index2_titik_naik" class="form-label required">Titik Naik</label>
                            <input type="text" class="form-control" name="titik_naik" id="index2_titik_naik" required>
                        </div>
                        <div class="col-md-6">
                            <label for="index2_titik_turun" class="form-label required">Titik Turun</label>
                            <input type="text" class="form-control" name="titik_turun" id="index2_titik_turun" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="index2_duration" class="form-label required">Durasi (Jam)</label>
                            <input type="number" class="form-control" name="duration" id="index2_duration" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label for="index2_price" class="form-label required">Harga (Rp)</label>
                            <input type="text" class="form-control" name="price" id="index2_price" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Departure Modal for index2 -->
<div class="modal fade" id="editDepartureModalIndex2" tabindex="-1" aria-labelledby="editDepartureModalIndex2Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDepartureModalIndex2Label">Edit Jadwal Keberangkatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('partner.bus.departures.update') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="edit_index2_departure_id">
                <input type="hidden" name="redirect_url" value="{{ Request::url() }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_index2_bus_travel_has_bus_id" class="form-label required">Bus</label>
                        <select class="form-select select2-bus-edit-index2" name="bus_travel_has_bus_id" id="edit_index2_bus_travel_has_bus_id" required>
                            <option value="">Pilih Bus</option>
                            @foreach ($allBuses as $id => $name)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_index2_departure_date" class="form-label required">Tanggal Keberangkatan</label>
                            <input type="date" class="form-control" name="departure_date" id="edit_index2_departure_date" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_index2_departure_time" class="form-label required">Waktu Keberangkatan</label>
                            <input type="time" class="form-control" name="departure_time" id="edit_index2_departure_time" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_index2_from_city_id" class="form-label required">Dari</label>
                            <select class="form-select select2-city-edit-index2" name="from_city_id" id="edit_index2_from_city_id" required>
                                <option value="">Pilih Kota Asal</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_index2_to_city_id" class="form-label required">Tujuan</label>
                            <select class="form-select select2-city-edit-index2" name="to_city_id" id="edit_index2_to_city_id" required>
                                <option value="">Pilih Kota Tujuan</option>
                                @foreach ($cities as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_index2_titik_naik" class="form-label required">Titik Naik</label>
                            <input type="text" class="form-control" name="titik_naik" id="edit_index2_titik_naik" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_index2_titik_turun" class="form-label required">Titik Turun</label>
                            <input type="text" class="form-control" name="titik_turun" id="edit_index2_titik_turun" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_index2_duration" class="form-label required">Durasi (Jam)</label>
                            <input type="number" class="form-control" name="duration" id="edit_index2_duration" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_index2_price" class="form-label required">Harga (Rp)</label>
                            <input type="text" class="form-control" name="price" id="edit_index2_price" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Departure Modal -->
<div class="modal fade" id="deleteDepartureModal" tabindex="-1" aria-labelledby="deleteDepartureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteDepartureModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('partner.bus.departures.delete') }}" method="POST">
                @csrf
                <input type="hidden" name="id" id="delete_departure_id">
                <input type="hidden" name="redirect_url" value="{{ Request::url() }}">
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus jadwal keberangkatan ini?</p>
                    <p class="text-danger">Perhatian: Jadwal yang sudah dipesan tidak dapat dihapus.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Function to format number with thousand separators (dots)
function formatRupiah(angka) {
    if (!angka) return '';
    let num = angka.toString().replace(/\D/g, '');
    return num.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

// Function to unformat number (remove dots to get actual number)
function unformatRupiah(rupiah) {
    if (!rupiah) return '';
    return rupiah.toString().replace(/\./g, '');
}

// Initialize Select2 for all modals
function initializeSelect2() {
    // Create modal - Bus select
    if ($('.select2-bus').length && !$('.select2-bus').hasClass('select2-hidden-accessible')) {
        $('.select2-bus').select2({
            dropdownParent: $('#createDepartureModal'),
            placeholder: 'Pilih Bus',
            allowClear: true,
            width: '100%'
        });
    }

    // Create modal - City selects
    if ($('.select2-city').length && !$('.select2-city').hasClass('select2-hidden-accessible')) {
        $('.select2-city').select2({
            dropdownParent: $('#createDepartureModal'),
            placeholder: 'Pilih Kota',
            allowClear: true,
            width: '100%'
        });
    }

    // Edit modal - City selects
    if ($('.select2-city-edit').length && !$('.select2-city-edit').hasClass('select2-hidden-accessible')) {
        $('.select2-city-edit').select2({
            dropdownParent: $('#editDepartureModal'),
            placeholder: 'Pilih Kota',
            allowClear: true,
            width: '100%'
        });
    }

    // Index2 Create modal - Bus select
    if ($('.select2-bus-index2').length && !$('.select2-bus-index2').hasClass('select2-hidden-accessible')) {
        $('.select2-bus-index2').select2({
            dropdownParent: $('#createDepartureModalIndex2'),
            placeholder: 'Pilih Bus',
            allowClear: true,
            width: '100%'
        });
    }

    // Index2 Create modal - City selects
    if ($('.select2-city-index2').length && !$('.select2-city-index2').hasClass('select2-hidden-accessible')) {
        $('.select2-city-index2').select2({
            dropdownParent: $('#createDepartureModalIndex2'),
            placeholder: 'Pilih Kota',
            allowClear: true,
            width: '100%'
        });
    }

    // Index2 Edit modal - Bus select
    if ($('.select2-bus-edit-index2').length && !$('.select2-bus-edit-index2').hasClass('select2-hidden-accessible')) {
        $('.select2-bus-edit-index2').select2({
            dropdownParent: $('#editDepartureModalIndex2'),
            placeholder: 'Pilih Bus',
            allowClear: true,
            width: '100%'
        });
    }

    // Index2 Edit modal - City selects
    if ($('.select2-city-edit-index2').length && !$('.select2-city-edit-index2').hasClass('select2-hidden-accessible')) {
        $('.select2-city-edit-index2').select2({
            dropdownParent: $('#editDepartureModalIndex2'),
            placeholder: 'Pilih Kota',
            allowClear: true,
            width: '100%'
        });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('Modal script loaded');
    const allBuses = @json($allBuses);

    // Initialize Select2 on page load
    initializeSelect2();

    // Reinitialize Select2 when modals are shown
    $('#createDepartureModal').on('shown.bs.modal', function() {
        initializeSelect2();
    });

    $('#editDepartureModal').on('shown.bs.modal', function() {
        initializeSelect2();
    });

    $('#createDepartureModalIndex2').on('shown.bs.modal', function() {
        initializeSelect2();
    });

    $('#editDepartureModalIndex2').on('shown.bs.modal', function() {
        initializeSelect2();
    });

    // Edit Modal Handler
    const editModal = document.getElementById('editDepartureModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (event) {
            console.log('Edit modal opening...');
            const button = event.relatedTarget;

            if (button) {
                const id = button.getAttribute('data-id');
                const busId = button.getAttribute('data-bus');
                const fromCityId = button.getAttribute('data-from');
                const toCityId = button.getAttribute('data-to');
                const titikNaik = button.getAttribute('data-titik-naik');
                const titikTurun = button.getAttribute('data-titik-turun');
                const departureDate = button.getAttribute('data-tanggal');
                const departureTime = button.getAttribute('data-time');
                const duration = button.getAttribute('data-duration');
                const price = button.getAttribute('data-price');

                console.log('Extracted data:', {id, busId, fromCityId, toCityId, titikNaik, titikTurun, departureTime, duration, price});

                // Set form values
                document.getElementById('edit_departure_id').value = id || '';
                const busName = allBuses[busId];
                document.getElementById('edit_bus_travel_has_bus_id').value = busId || '';
                document.getElementById('edit_bus_name').textContent = busName || 'Bus tidak ditemukan';

                // Set Select2 values
                $('#edit_from_city_id').val(fromCityId).trigger('change');
                $('#edit_to_city_id').val(toCityId).trigger('change');

                document.getElementById('edit_titik_naik').value = titikNaik || '';
                document.getElementById('edit_titik_turun').value = titikTurun || '';
                document.getElementById('edit_duration').value = duration || '';
                document.getElementById('edit_price').value = price ? formatRupiah(price) : '';

                // Handle date and time parsing
                if (departureTime) {
                    let parsedDate = '';
                    let timeOnly = '';

                    if (departureTime.includes(' ')) {
                        const parts = departureTime.split(' ');
                        parsedDate = parts[0];
                        if (parts[1]) {
                            const timeParts = parts[1].split(':');
                            if (timeParts.length >= 2) {
                                timeOnly = timeParts[0] + ':' + timeParts[1];
                            }
                        }
                    } else {
                        if (departureTime.includes(':')) {
                            const timeParts = departureTime.split(':');
                            if (timeParts.length >= 2) {
                                timeOnly = timeParts[0] + ':' + timeParts[1];
                                parsedDate = departureDate;
                            }
                        }
                    }

                    const dateField = document.getElementById('edit_departure_date');
                    const timeField = document.getElementById('edit_departure_time');

                    if (dateField && parsedDate) dateField.value = parsedDate;
                    if (timeField && timeOnly) timeField.value = timeOnly;
                }

                console.log('Edit modal population complete');
            }
        });
    }

    // Delete Modal Handler
    const deleteModal = document.getElementById('deleteDepartureModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (button) {
                const id = button.getAttribute('data-id');
                document.getElementById('delete_departure_id').value = id || '';
            }
        });
    }

    // Form validation for create modal
    const createForm = document.querySelector('#createDepartureModal form');
    if (createForm) {
        createForm.addEventListener('submit', function(e) {
            const priceField = document.getElementById('price');
            if (priceField) {
                priceField.value = unformatRupiah(priceField.value);
            }

            const fromCity = document.getElementById('from_city_id').value;
            const toCity = document.getElementById('to_city_id').value;

            if (fromCity === toCity && fromCity !== '') {
                e.preventDefault();
                alert('Kota asal dan tujuan tidak boleh sama!');
                return false;
            }
        });
    }

    // Format price input as user types
    const priceInput = document.getElementById('price');
    if (priceInput) {
        priceInput.addEventListener('input', function(e) {
            const value = e.target.value;
            const unformatted = unformatRupiah(value);
            const formatted = formatRupiah(unformatted);
            e.target.value = formatted;
        });
    }

    // Format edit price input as user types
    const editPriceInput = document.getElementById('edit_price');
    if (editPriceInput) {
        editPriceInput.addEventListener('input', function(e) {
            const value = e.target.value;
            const unformatted = unformatRupiah(value);
            const formatted = formatRupiah(unformatted);
            e.target.value = formatted;
        });
    }

    // Form validation for edit modal
    const editForm = document.querySelector('#editDepartureModal form');
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            const priceField = document.getElementById('edit_price');
            if (priceField) {
                priceField.value = unformatRupiah(priceField.value);
            }

            const fromCity = document.getElementById('edit_from_city_id').value;
            const toCity = document.getElementById('edit_to_city_id').value;

            if (fromCity === toCity && fromCity !== '') {
                e.preventDefault();
                alert('Kota asal dan tujuan tidak boleh sama!');
                return false;
            }
        });
    }

    // Edit Modal Handler for index2 modal
    const editModalIndex2 = document.getElementById('editDepartureModalIndex2');
    if (editModalIndex2) {
        editModalIndex2.addEventListener('show.bs.modal', function (event) {
            console.log('Edit modal index2 opening...');
            const button = event.relatedTarget;

            if (button) {
                const id = button.getAttribute('data-id');
                const busId = button.getAttribute('data-bus');
                const fromCityId = button.getAttribute('data-from');
                const toCityId = button.getAttribute('data-to');
                const titikNaik = button.getAttribute('data-titik-naik');
                const titikTurun = button.getAttribute('data-titik-turun');
                const departureDate = button.getAttribute('data-tanggal');
                const departureTime = button.getAttribute('data-time');
                const duration = button.getAttribute('data-duration');
                const price = button.getAttribute('data-price');

                console.log('Extracted data for index2:', {id, busId, fromCityId, toCityId, titikNaik, titikTurun, departureTime, duration, price});

                // Set form values
                document.getElementById('edit_index2_departure_id').value = id || '';

                // Set Select2 values for index2
                $('#edit_index2_bus_travel_has_bus_id').val(busId).trigger('change');
                $('#edit_index2_from_city_id').val(fromCityId).trigger('change');
                $('#edit_index2_to_city_id').val(toCityId).trigger('change');

                document.getElementById('edit_index2_titik_naik').value = titikNaik || '';
                document.getElementById('edit_index2_titik_turun').value = titikTurun || '';
                document.getElementById('edit_index2_duration').value = duration || '';
                document.getElementById('edit_index2_price').value = price ? formatRupiah(price) : '';

                // Handle date and time parsing
                if (departureTime) {
                    let parsedDate = '';
                    let timeOnly = '';

                    if (departureTime.includes(' ')) {
                        const parts = departureTime.split(' ');
                        parsedDate = parts[0];
                        if (parts[1]) {
                            const timeParts = parts[1].split(':');
                            if (timeParts.length >= 2) {
                                timeOnly = timeParts[0] + ':' + timeParts[1];
                            }
                        }
                    } else {
                        if (departureTime.includes(':')) {
                            const timeParts = departureTime.split(':');
                            if (timeParts.length >= 2) {
                                timeOnly = timeParts[0] + ':' + timeParts[1];
                                parsedDate = departureDate;
                            }
                        }
                    }

                    const dateField = document.getElementById('edit_index2_departure_date');
                    const timeField = document.getElementById('edit_index2_departure_time');

                    if (dateField && parsedDate) dateField.value = parsedDate;
                    if (timeField && timeOnly) timeField.value = timeOnly;
                }

                console.log('Edit modal index2 population complete');
            }
        });
    }

    // Form validation for create modal index2
    const createFormIndex2 = document.querySelector('#createDepartureModalIndex2 form');
    if (createFormIndex2) {
        createFormIndex2.addEventListener('submit', function(e) {
            const priceField = document.getElementById('index2_price');
            if (priceField) {
                priceField.value = unformatRupiah(priceField.value);
            }

            const fromCity = document.getElementById('index2_from_city_id').value;
            const toCity = document.getElementById('index2_to_city_id').value;

            if (fromCity === toCity && fromCity !== '') {
                e.preventDefault();
                alert('Kota asal dan tujuan tidak boleh sama!');
                return false;
            }
        });
    }

    // Format index2 price input as user types
    const index2PriceInput = document.getElementById('index2_price');
    if (index2PriceInput) {
        index2PriceInput.addEventListener('input', function(e) {
            const value = e.target.value;
            const unformatted = unformatRupiah(value);
            const formatted = formatRupiah(unformatted);
            e.target.value = formatted;
        });
    }

    // Format edit index2 price input as user types
    const editIndex2PriceInput = document.getElementById('edit_index2_price');
    if (editIndex2PriceInput) {
        editIndex2PriceInput.addEventListener('input', function(e) {
            const value = e.target.value;
            const unformatted = unformatRupiah(value);
            const formatted = formatRupiah(unformatted);
            e.target.value = formatted;
        });
    }

    // Form validation for edit modal index2
    const editFormIndex2 = document.querySelector('#editDepartureModalIndex2 form');
    if (editFormIndex2) {
        editFormIndex2.addEventListener('submit', function(e) {
            const priceField = document.getElementById('edit_index2_price');
            if (priceField) {
                priceField.value = unformatRupiah(priceField.value);
            }

            const fromCity = document.getElementById('edit_index2_from_city_id').value;
            const toCity = document.getElementById('edit_index2_to_city_id').value;

            if (fromCity === toCity && fromCity !== '') {
                e.preventDefault();
                alert('Kota asal dan tujuan tidak boleh sama!');
                return false;
            }
        });
    }
});
</script>
