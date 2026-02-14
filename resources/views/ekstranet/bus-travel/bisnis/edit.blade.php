@extends('ekstranet.layout', ['title' => 'Edit Bisnis Bus Travel', 'url' => route('partner.bisnis.bus-travel.index')])

@section('content-admin')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('partner.bisnis.bus-travel.update', $bus_travel->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-9 mb-8">
                <div class="col-md-12">
                    <label class="fs-6 fw-semibold mb-2">Logo</label>
                    @if ($bus_travel->image)
                        <img src="{{ asset('storage/bus-travel-images/' . $bus_travel->image) }}" class="mb-3" style="width:130px; height:100px; object-fit:contain;">
                    @endif
                    <input type="file" class="form-control" name="image" accept="image/jpeg,image/jpg,image/png" />
                    <div class="form-text">Format: JPG, JPEG, PNG. Kosongkan jika tidak ingin mengubah gambar.</div>
                </div>

                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Nama Bisnis</label>
                    <input class="form-control" placeholder="Masukkan nama usaha" name="business_name" value="{{ $bus_travel->business_name }}" required />
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Nomor Telepon</label>
                    <input type="number" class="form-control" placeholder="Masukkan nomor telepon..." name="phone" value="{{ $bus_travel->phone }}" required />
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Kota / Kabupaten</label>
                    <div class="dropdown w-100">
                        <button class="form-control text-start d-flex justify-content-between align-items-center"
                                type="button" id="cityDropdownBtn"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            <span id="selectedCityText">
                                {{ $cities->firstWhere('city_id', $bus_travel->city)->city_name ?? 'Pilih kota...' }}
                            </span>
                            <i class="bi bi-chevron-down ms-2"></i>
                        </button>

                        <ul class="dropdown-menu w-100 shadow-sm p-0" aria-labelledby="cityDropdownBtn"
                            id="cityDropdownList" style="max-height:260px; overflow-y:auto;">
                            <li class="p-2 border-bottom">
                                <input type="text" id="citySearchInput" class="form-control form-control-sm"
                                       placeholder="Cari kota..." onkeyup="filterCityDropdown()">
                            </li>
                            @foreach ($cities as $city)
                                <li>
                                    <a class="dropdown-item city-option {{ $bus_travel->city == $city->city_id ? 'active' : '' }}"
                                       data-value="{{ $city->city_id }}" href="#">
                                       {{ $city->city_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <input type="hidden" name="city" id="selectedCity" value="{{ $bus_travel->city }}">
                </div>

                <div class="col-12">
                    <label class="required form-label">Alamat</label>
                    <textarea name="address" cols="30" rows="5" class="form-control" required>{{ $bus_travel->address }}</textarea>
                </div>

                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Status</label>
                    <select class="form-control" name="is_active" required>
                        <option value="1" {{ $bus_travel->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $bus_travel->is_active == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <a href="{{ route('partner.bisnis.bus-travel.index') }}" class="btn btn-secondary w-100">Kembali</a>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function filterCityDropdown() {
        const input = document.getElementById('citySearchInput').value.toLowerCase();
        const items = document.querySelectorAll('#cityDropdownList .city-option');
        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(input) ? '' : 'none';
        });
    }

    document.querySelectorAll('.city-option').forEach(item => {
        item.addEventListener('click', function (e) {
            e.preventDefault();
            const cityName = this.textContent;
            const cityId = this.dataset.value;

            // Update UI
            document.getElementById('selectedCityText').textContent = cityName;
            document.getElementById('selectedCity').value = cityId;

            // Close dropdown
            bootstrap.Dropdown.getInstance(document.getElementById('cityDropdownBtn')).hide();
        });
    });
</script>

<style>
    .dropdown-menu .city-option.active {
        background-color: #f1faff;
        font-weight: 600;
    }

    .dropdown-menu .city-option:hover {
        background-color: #f9fafb;
    }

    #citySearchInput {
        border-radius: 4px;
        font-size: 14px;
    }
</style>
@endsection
