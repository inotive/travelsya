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
                <div class="modal-body">
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
                            <label for="from_route_id" class="form-label required">Dari</label>
                            <select class="form-select" name="from_route_id" id="from_route_id" required>
                                <option value="">Pilih Rute Asal</option>
                                @foreach ($routes as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="to_route_id" class="form-label required">Tujuan</label>
                            <select class="form-select" name="to_route_id" id="to_route_id" required>
                                <option value="">Pilih Rute Tujuan</option>
                                @foreach ($routes as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="duration" class="form-label required">Durasi (Jam)</label>
                            <input type="number" class="form-control" name="duration" id="duration" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label required">Harga (Rp)</label>
                            <input type="number" class="form-control" name="price" id="price" min="1000" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label required">Hari Operasional</label>
                            <div class="d-flex flex-wrap">
                                <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="0" id="day0">
                                    <label class="form-check-label" for="day0">Minggu</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="1" id="day1">
                                    <label class="form-check-label" for="day1">Senin</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="2" id="day2">
                                    <label class="form-check-label" for="day2">Selasa</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="3" id="day3">
                                    <label class="form-check-label" for="day3">Rabu</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="4" id="day4">
                                    <label class="form-check-label" for="day4">Kamis</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="5" id="day5">
                                    <label class="form-check-label" for="day5">Jumat</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                    <input class="form-check-input" type="checkbox" name="days[]" value="6" id="day6">
                                    <label class="form-check-label" for="day6">Sabtu</label>
                                </div>
                            </div>
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
                <div class="modal-body">
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
                            <label for="edit_from_route_id" class="form-label required">Dari</label>
                            <select class="form-select" name="from_route_id" id="edit_from_route_id" required>
                                <option value="">Pilih Rute Asal</option>
                                @foreach ($routes as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_to_route_id" class="form-label required">Tujuan</label>
                            <select class="form-select" name="to_route_id" id="edit_to_route_id" required>
                                <option value="">Pilih Rute Tujuan</option>
                                @foreach ($routes as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_duration" class="form-label required">Durasi (Jam)</label>
                            <input type="number" class="form-control" name="duration" id="edit_duration" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit_price" class="form-label required">Harga (Rp)</label>
                            <input type="number" class="form-control" name="price" id="edit_price" min="1000" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label required">Hari Operasional</label>
                            <div class="d-flex flex-wrap">
                                <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                    <input class="form-check-input edit-day" type="checkbox" name="days[]" value="0" id="edit_day0">
                                    <label class="form-check-label" for="edit_day0">Minggu</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                    <input class="form-check-input edit-day" type="checkbox" name="days[]" value="1" id="edit_day1">
                                    <label class="form-check-label" for="edit_day1">Senin</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                    <input class="form-check-input edit-day" type="checkbox" name="days[]" value="2" id="edit_day2">
                                    <label class="form-check-label" for="edit_day2">Selasa</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                    <input class="form-check-input edit-day" type="checkbox" name="days[]" value="3" id="edit_day3">
                                    <label class="form-check-label" for="edit_day3">Rabu</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                    <input class="form-check-input edit-day" type="checkbox" name="days[]" value="4" id="edit_day4">
                                    <label class="form-check-label" for="edit_day4">Kamis</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                    <input class="form-check-input edit-day" type="checkbox" name="days[]" value="5" id="edit_day5">
                                    <label class="form-check-label" for="edit_day5">Jumat</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid me-5 mb-2">
                                    <input class="form-check-input edit-day" type="checkbox" name="days[]" value="6" id="edit_day6">
                                    <label class="form-check-label" for="edit_day6">Sabtu</label>
                                </div>
                            </div>
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
document.addEventListener('DOMContentLoaded', function() {
    console.log('Modal script loaded');

    // Edit Modal Handler
    const editModal = document.getElementById('editDepartureModal');
    if (editModal) {
        editModal.addEventListener('show.bs.modal', function (event) {
            console.log('Edit modal opening...');
            const button = event.relatedTarget;

            if (button) {
                const id = button.getAttribute('data-id');
                const busId = button.getAttribute('data-bus');
                const fromRouteId = button.getAttribute('data-from');
                const toRouteId = button.getAttribute('data-to');
                const departureTime = button.getAttribute('data-time');
                const duration = button.getAttribute('data-duration');
                const price = button.getAttribute('data-price');
                const days = button.getAttribute('data-days');

                console.log('Extracted data:', {id, busId, fromRouteId, toRouteId, departureTime, duration, price, days});

                // Set form values
                document.getElementById('edit_departure_id').value = id || '';
                document.getElementById('edit_from_route_id').value = fromRouteId || '';
                document.getElementById('edit_to_route_id').value = toRouteId || '';
                document.getElementById('edit_duration').value = duration || '';
                document.getElementById('edit_price').value = price || '';

                // Handle date and time parsing
                if (departureTime) {
                    console.log('Raw departure_time:', departureTime);
                    let departureDate = '';
                    let timeOnly = '';

                    if (departureTime.includes(' ')) {
                        const parts = departureTime.split(' ');
                        departureDate = parts[0];

                        if (parts[1]) {
                            const timeParts = parts[1].split(':');
                            if (timeParts.length >= 2) {
                                timeOnly = timeParts[0] + ':' + timeParts[1];
                            }
                        }
                        console.log('Parsed from string:', {departureDate, timeOnly});
                    } else {
                        if (departureTime.includes(':')) {
                            const timeParts = departureTime.split(':');
                            if (timeParts.length >= 2) {
                                timeOnly = timeParts[0] + ':' + timeParts[1];
                                departureDate = new Date().toISOString().split('T')[0];
                            }
                        }
                        console.log('Parsed as time only:', {departureDate, timeOnly});
                    }

                    console.log('Final datetime values:', {departureDate, timeOnly});

                    const dateField = document.getElementById('edit_departure_date');
                    const timeField = document.getElementById('edit_departure_time');

                    if (dateField && departureDate) {
                        dateField.value = departureDate;
                        console.log('Date field set to:', dateField.value);
                    }
                    if (timeField && timeOnly) {
                        timeField.value = timeOnly;
                        console.log('Time field set to:', timeField.value);
                    }

                    setTimeout(() => {
                        console.log('Field values after setting:', {
                            dateValue: dateField ? dateField.value : 'field not found',
                            timeValue: timeField ? timeField.value : 'field not found'
                        });
                    }, 50);
                }

                // Handle days checkboxes
                const dayCheckboxes = document.querySelectorAll('.edit-day');
                dayCheckboxes.forEach(cb => cb.checked = false); // Clear all first

                if (days) {
                    const dayArray = days.split(',');
                    dayArray.forEach(day => {
                        const checkbox = document.getElementById('edit_day' + day.trim());
                        if (checkbox) {
                            checkbox.checked = true;
                        }
                    });
                    console.log('Set days:', dayArray);
                }

                console.log('Edit modal population complete');
            }
        });
    }

    // Delete Modal Handler
    const deleteModal = document.getElementById('deleteDepartureModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            console.log('Delete modal opening...');
            const button = event.relatedTarget;

            if (button) {
                const id = button.getAttribute('data-id');
                console.log('Delete ID:', id);

                document.getElementById('delete_departure_id').value = id || '';

                console.log('Delete modal population complete');
            }
        });
    }

    // Form validation for create modal
    const createForm = document.querySelector('#createDepartureModal form');
    if (createForm) {
        createForm.addEventListener('submit', function(e) {
            const fromRoute = document.getElementById('from_route_id').value;
            const toRoute = document.getElementById('to_route_id').value;

            if (fromRoute === toRoute && fromRoute !== '') {
                e.preventDefault();
                alert('Rute asal dan tujuan tidak boleh sama!');
                return false;
            }
        });
    }

    // Form validation for edit modal
    const editForm = document.querySelector('#editDepartureModal form');
    if (editForm) {
        editForm.addEventListener('submit', function(e) {
            const fromRoute = document.getElementById('edit_from_route_id').value;
            const toRoute = document.getElementById('edit_to_route_id').value;

            if (fromRoute === toRoute && fromRoute !== '') {
                e.preventDefault();
                alert('Rute asal dan tujuan tidak boleh sama!');
                return false;
            }
        });
    }
});
</script>
