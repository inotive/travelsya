@extends('ekstranet.layout', [
    'title' => 'Beranda',
    'url' => '#',
    'subTitle' => 'Edit Data',
])

@section('content-admin')
<div class="card">
    <div class="card-body">
        <form action="{{ route('partner.update.bus-travel', $bus->id) }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <div class="form-group">
                    <label class="required fs-6 fw-semibold mb-2">Bisnis Bus & Travel</label>
                    <select class="form-control" id="bus_travel_id" name="bus_travel_id">
                        <option value="">Pilih Bisnis Bus & Travel</option>
                        @foreach($bus_travel as $bt)
                            <option value="{{ $bt->id }}" {{ old('bus_travel_id', $bus->bus_travel_id) == $bt->id ? 'selected' : '' }}>
                                {{ $bt->business_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('bus_travel_id') <span class="text-danger mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="required fs-6 fw-semibold mb-2">Kategori</label>
                    <select class="form-control form-control-lg" name="kategori">
                        <option value="">Pilih Kategori</option>
                        <option value="bus" {{ old('kategori', $bus->kategori) == 'bus' ? 'selected' : '' }}>Bus</option>
                        <option value="travel" {{ old('kategori', $bus->kategori) == 'travel' ? 'selected' : '' }}>Travel</option>
                    </select>
                    @error('kategori') <span class="text-danger mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="required fs-6 fw-semibold mb-2">Nama</label>
                    <input type="text" class="form-control form-control-lg" name="name"
                        value="{{ old('name', $bus->name) }}" placeholder="Masukkan Nama" />
                    @error('name') <span class="text-danger mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="required fs-6 fw-semibold mb-2">Kelas</label>
                    <input class="form-control form-control-lg" name="class"
                        value="{{ old('class', $bus->class) }}" placeholder="Masukkan Kelas" />
                    @error('class') <span class="text-danger mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="required fs-6 fw-semibold mb-2">Status</label>
                    <select class="form-control" name="is_active">
                        <option value="">Pilih Status</option>
                        <option value="1" {{ old('is_active', $bus->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ old('is_active', $bus->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    @error('is_active') <span class="text-danger mt-1">{{ $message }}</span> @enderror
                </div>

                <div class="form-group">
                    <label class="required fs-6 fw-semibold mb-2">Jumlah Kursi</label>
                    <input type="number" class="form-control form-control-lg" name="number_seats"
                        value="{{ old('number_seats', $bus->number_seats) }}" placeholder="Masukkan Jumlah Kursi" />
                    @error('number_seats') <span class="text-danger mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Kelola Gambar -->
            <div class="col-md-12 mt-4">
                <label class="fs-6 fw-semibold mb-2">Kelola Gambar</label>

                @php
                    $additionalImages = is_array($bus->image) ? $bus->image : json_decode($bus->image, true) ?? [];
                @endphp

                <!-- Main Image Section -->
                <div class="mb-5 p-4 border rounded">
                    <h6 class="mb-3">Gambar Utama</h6>
                    @if($bus->main_image)
                        <div class="row">
                            <div class="col-md-4 col-sm-6 mb-4">
                                <div class="card h-100">
                                    <img src="{{ asset('storage/buses/main/' . $bus->main_image) }}"
                                         class="card-img-top"
                                         style="height: 150px; object-fit: contain; background-color: #f8f9fa;"
                                         alt="Gambar Utama">
                                    <div class="card-body text-center p-3">
                                        <p class="card-text text-muted text-truncate" title="{{ $bus->main_image }}">
                                            {{ $bus->main_image }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <label class="form-label">Ganti Gambar Utama</label>
                            <input type="file" class="form-control" name="main_image" accept="image/*">
                            <div class="form-text">Biarkan kosong jika tidak ingin mengganti gambar utama.</div>
                        </div>
                    @else
                        <p>Belum ada gambar utama. Silakan unggah.</p>
                        <input type="file" class="form-control" name="main_image" accept="image/*">
                    @endif
                </div>

                <!-- Additional Images Section -->
                <div class="mb-5 p-4 border rounded">
                    <h6 class="mb-3">Gambar Tambahan</h6>
                    <div class="row">
                        @if(count($additionalImages) > 0)
                            @foreach($additionalImages as $index => $img)
                                <div class="col-md-4 col-sm-6 mb-4 existing-image-card">
                                    <div class="card h-100">
                                        <img src="{{ asset('storage/buses/' . $img) }}"
                                             class="card-img-top"
                                             style="height: 150px; object-fit: contain; background-color: #f8f9fa;"
                                             alt="Image">
                                        <div class="card-body text-center p-3">
                                            <p class="card-text text-muted text-truncate" title="{{ $img }}">
                                                {{ $img }}
                                            </p>
                                            <button type="button"
                                                    class="btn btn-sm btn-danger delete-existing-image"
                                                    data-image-name="{{ $img }}">
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-12">
                                <p class="text-muted">Tidak ada gambar tambahan.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Add More Additional Images -->
                <div class="p-4 border rounded">
                    <h6 class="mb-3">Tambah Gambar Tambahan Baru</h6>
                    <div id="additional-images-container">
                        <!-- New image inputs will be appended here -->
                    </div>
                    <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-more-additional-images">
                        + Tambah Gambar Tambahan
                    </button>
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
                                    {{ in_array($facility->id, old('facilities', $selectedFacilities)) ? 'checked' : '' }}>
                                <label class="form-check-label" for="facility{{ $facility->id }}">
                                    {{ $facility->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('facilities') <span class="text-danger mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="form-group mt-4">
                <label class="required fs-6 fw-semibold mb-2">Deskripsi</label>
                <textarea class="form-control" name="deskripsi" required>{{ old('deskripsi', $bus->deskripsi) }}</textarea>
                @error('deskripsi') <span class="text-danger mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="form-group mt-4">
                <label class="required fs-6 fw-semibold mb-2">Peraturan atau Ketentuan</label>
                <textarea class="form-control" name="tos" required>{{ old('tos', $bus->tos) }}</textarea>
                @error('tos') <span class="text-danger mt-1">{{ $message }}</span> @enderror
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        // === Add More Additional Images ===
        $('#add-more-additional-images').click(function() {
            $('#additional-images-container').append(`
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="images[]" accept="image/*">
                    <button type="button" class="btn btn-danger remove-additional-image">Hapus</button>
                </div>
            `);
        });

        // === Remove New Additional Image Input ===
        $(document).on('click', '.remove-additional-image', function() {
            $(this).closest('.input-group').remove();
        });

        // === Delete Existing Additional Image ===
        $(document).on('click', '.delete-existing-image', function() {
            const imageName = $(this).data('image-name');
            const imageCard = $(this).closest('.existing-image-card');

            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Gambar ini akan ditandai untuk dihapus saat disimpan.",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonText: "Ya, Hapus",
                confirmButtonColor: '#d33',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Add hidden input to track deleted image
                    let removedImagesInput = $('input[name="removed_images"]');
                    if (removedImagesInput.length === 0) {
                        $('form').append('<input type="hidden" name="removed_images" value="">');
                        removedImagesInput = $('input[name="removed_images"]');
                    }

                    let removedImages = [];
                    if (removedImagesInput.val()) {
                        removedImages = JSON.parse(removedImagesInput.val());
                    }

                    if (!removedImages.includes(imageName)) {
                        removedImages.push(imageName);
                        removedImagesInput.val(JSON.stringify(removedImages));
                    }

                    // Remove the card from view
                    imageCard.fadeOut(300, function() {
                        $(this).remove();

                        // Check if no more images
                        if ($('.existing-image-card').length === 0) {
                            $('.row').first().html('<div class="col-12"><p class="text-muted">Tidak ada gambar tambahan.</p></div>');
                        }
                    });

                    Swal.fire('Ditandai!', 'Gambar akan dihapus saat Anda menyimpan perubahan.', 'success');
                }
            });
        });
    });
</script>
@endpush

<style>
    .card-img-top {
        height: 150px;
        object-fit: cover;
    }

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

