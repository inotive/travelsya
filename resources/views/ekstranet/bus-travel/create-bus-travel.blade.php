@extends('ekstranet.layout', [
    'title' => 'Beranda',
    'url' => '#',
    'subTitle' => 'Tambah Data',
])

@section('content-admin')
    {{-- FORM CREATE --}}
    <div class="card">
        <div class="card-body">
            <!--begin:Form-->
            <form action="{{ route('partner.store.bus-travel') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Bisnis Bus & Travel</label>
                        <select class="form-control" id="bus_travel_id" name="bus_travel_id">
                            <option value="">Pilih Bisnis Bus & Travel</option>
                            @foreach($bus_travel as $bt)
                                <option value="{{ $bt->id }}" {{ old('bus_travel_id') == $bt->id ? 'selected' : '' }}>
                                    {{ $bt->business_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('bus_travel_id')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Kategori</label>
                        <select class="form-control form-control-lg" id="kategori" name="kategori">
                            <option value="">Pilih Kategori</option>
                            <option value="bus" {{ old('kategori') == 'bus' ? 'selected' : '' }}>Bus</option>
                            <option value="travel" {{ old('kategori') == 'travel' ? 'selected' : '' }}>Travel</option>
                        </select>
                        @error('kategori')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Nama</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name"
                               value="{{ old('name') }}" placeholder="Masukkan Nama" />
                        @error('name')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Kelas</label>
                        <input class="form-control form-control-lg" id="duration" placeholder="Masukkan Kelas"
                               name="class" value="{{ old('class') }}" />
                        @error('class')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Status</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="">Pilih Status</option>
                            <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('is_active')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Jumlah Kursi</label>
                        <input type="number" class="form-control form-control-lg" id="number_seats"
                               placeholder="Masukkan Jumlah Kursi" name="number_seats" value="{{ old('number_seats') }}" />
                        @error('number_seats')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Image Upload Section -->
                <div class="col-md-12 mt-4">
                    <label class="required fs-6 fw-semibold mb-2">Gambar Bus/Travel</label>

                    <!-- Main Image Upload -->
                    <div class="mb-4 p-4 border rounded">
                        <h6 class="required mb-3">Gambar Utama</h6>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="main_image" accept="image/*" required>
                            <label class="input-group-text bg-primary text-white">Pilih Gambar Utama</label>
                        </div>
                        @error('main_image')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Additional Images Upload -->
                    <div class="p-4 border rounded">
                        <h6 class="mb-3">Gambar Tambahan (Opsional)</h6>
                        <div id="additional-images-container">
                            <!-- New fields will be appended here -->
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-more-additional-images">
                            + Tambah Gambar Tambahan
                        </button>
                        @error('images.*')
                            <span class="text-danger mt-1 d-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group mt-4">
                    <label class="fs-6 fw-semibold mb-2">Fasilitas Bus</label>
                    <div class="row">
                        @foreach ($facilities as $facility)
                            <div class="col-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="facilities[]"
                                           value="{{ $facility->id }}" id="facility{{ $facility->id }}"
                                           {{ in_array($facility->id, old('facilities', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="facility{{ $facility->id }}">
                                        {{ $facility->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('facilities')
                        <span class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label class="required fs-6 fw-semibold mb-2">Deskripsi</label>
                    <textarea class="form-control" name="deskripsi" required placeholder="Masukkan Deskripsi">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mt-4">
                    <label class="required fs-6 fw-semibold mb-2">Peraturan atau Ketentuan</label>
                    <textarea class="form-control" name="tos" required placeholder="Masukkan Peraturan atau Ketentuan">{{ old('tos') }}</textarea>
                    @error('tos')
                        <span class="text-danger mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div class="row mt-5">
                    <div class="col">
                        <a href="{{ route('partner.daftar.bus-travel') }}" class="btn btn-secondary w-100">Kembali</a>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary w-100">
                            <span class="indicator-label">Simpan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('add-script')
<script>
    $(document).ready(function() {
        // --- Add More Additional Images ---
        $('#add-more-additional-images').click(function() {
            $('#additional-images-container').append(`
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="images[]" accept="image/*">
                    <button type="button" class="btn btn-danger remove-additional-image">Hapus</button>
                </div>
            `);
        });

        // --- Remove Additional Image Input ---
        $(document).on('click', '.remove-additional-image', function() {
            $(this).closest('.input-group').remove();
        });
    });
</script>
@endpush

<style>
    .form-row {
        display: flex;
        margin-bottom: 15px;
    }

    .form-group {
        flex: 1;
        margin-right: 15px;
    }

    .form-group:last-child {
        margin-right: 0;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    select,
    input,
    textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    textarea {
        height: 100px;
    }
</style>
