@extends('ekstranet.layout', [
    'title' => 'Update Data Kendaraan',
    'url' => '#',
    'subTitle' => 'Edit Data',
])

@section('content-admin')

    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('partner.kendaraan.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">

                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Bisnis</label>
                            <select class="form-control" name="car_rental_id" id="car_rental_id" required>
                                <option value="">-- Pilih Bisnis --</option>
                                @foreach ($car_rentals as $car_rental)
                                    <option value="{{ $car_rental->id }}" {{ old('car_rental_id', $car->car_rental_id) == $car_rental->id ? 'selected' : '' }}>{{ $car_rental->business_name }}</option>
                                @endforeach
                            </select>
                            @error('car_rental_id')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Merk</label>
                            <select class="form-control" id="brand_id" name="brand_id" required>
                                <option value="">Pilih Merk</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $car->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Model</label>
                            <select class="form-control" id="car_model_id" name="car_model_id" required>
                                <option value="">Pilih Model</option>
                                @foreach ($car_models as $car_model)
                                    <option value="{{ $car_model->id }}" {{ old('car_model_id', $car->car_model_id) == $car_model->id ? 'selected' : '' }}>{{ $car_model->name }}</option>
                                @endforeach
                            </select>
                            @error('car_model_id')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Tipe</label>
                            <select class="form-control" id="category" name="category" required>
                                <option value="">Pilih Tipe</option>
                                <option value="manual" {{ old('category', $car->category) == 'manual' ? 'selected' : '' }}>Manual</option>
                                <option value="automatic" {{ old('category', $car->category) == 'automatic' ? 'selected' : '' }}>Matic</option>
                            </select>
                            @error('category')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Kategori Rental</label>
                            <select class="form-control" id="category_rent" name="category_rent" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Lepas Kunci" {{ old('category_rent', $car->category_rent) == 'Lepas Kunci' ? 'selected' : '' }}>Lepas Kunci</option>
                                <option value="Dengan Supir" {{ old('category_rent', $car->category_rent) == 'Dengan Supir' ? 'selected' : '' }}>Dengan Supir</option>
                            </select>
                            @error('category_rent')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Biaya Sewa</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">Rp</span>
                                <input type="text" class="form-control" id="rental_price_per_day_display"
                                    placeholder="Biaya Sewa" aria-label="rental_price_per_day_display"
                                    aria-describedby="basic-addon1" value="{{ old('rental_price_per_day_display', number_format($car->rental_price_per_day, 0, ',', '.')) }}" required>
                                <input type="hidden" id="rental_price_per_day" name="rental_price_per_day" value="{{ old('rental_price_per_day', $car->rental_price_per_day) }}">
                            </div>
                            @error('rental_price_per_day')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Tahun</label>
                            <select class="form-control" id="years" name="years" required>
                                <option value="">Pilih Tahun</option>
                                @php
                                    $currentYear = date('Y');
                                    $startYear = $currentYear - 20;
                                    $endYear = $currentYear;
                                @endphp

                                @for ($year = $endYear; $year >= $startYear; $year--)
                                    <option value="{{ $year }}" {{ old('years', $car->years) == $year ? 'selected' : '' }}>{{ $year }}</option>
                                @endfor
                            </select>
                            @error('years')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Jumlah Kursi</label>
                            <input type="number" class="form-control" id="number_seats" name="number_seats" value="{{ old('number_seats', $car->number_seats) }}"
                                placeholder="Jumlah Kursi" required>
                            @error('number_seats')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Durasi (Hari)</label>
                            <input type="number" class="form-control" name="duration" value="{{ old('duration', $car->duration) }}" placeholder="Contoh: 1" required min="1">
                            @error('duration')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Tempat Mengambil Mobil</label>
                            <input type="text" class="form-control" id="pickup_location" name="pickup_location" value="{{ old('pickup_location', $car->pickup_location ?? '') }}" placeholder="Tempat Mengambil Mobil" required>
                            @error('pickup_location')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="1" {{ old('status', $car->status) == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('status', $car->status) == '0' ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('status')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="5" maxlength="2000" required>{{ old('description', $car->description) }}</textarea>
                            <small class="form-text text-muted">Maksimal 2000 karakter</small>
                            @error('description')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Kelola Gambar -->
                        <div class="col-md-12 mt-4">
                            <label class="fs-6 fw-semibold mb-2">Kelola Gambar</label>

                            @php
                                // Safely handle the images relationship. If it's null, treat as an empty collection.
                                $images = $car->images ?? collect();
                                $mainImage = $images->firstWhere('main', 1);
                                $additionalImages = $images->where('main', 0);
                            @endphp

                            <!-- Main Image Section -->
                            <div class="mb-5 p-4 border rounded">
                                <h6 class="mb-3">Gambar Utama</h6>
                                @if($mainImage)
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 mb-4">
                                            <div class="card h-100">
                                                <img src="{{ Storage::url($mainImage->image_url) }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="Gambar Utama">
                                                <div class="card-body text-center p-3">
                                                    <p class="card-text text-muted text-truncate" title="{{ basename($mainImage->image_url) }}">{{ basename($mainImage->image_url) }}</p>
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
                                        @foreach($additionalImages as $image)
                                            <div class="col-md-4 col-sm-6 mb-4 existing-image-card">
                                                <div class="card h-100">
                                                    <img src="{{ Storage::url($image->image_url) }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="Image">
                                                    <div class="card-body text-center p-3">
                                                        <p class="card-text text-muted text-truncate" title="{{ basename($image->image_url) }}">{{ basename($image->image_url) }}</p>
                                                        <button type="button" class="btn btn-sm btn-danger delete-existing-image" data-image-id="{{ $image->id }}">Hapus</button>
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
                                <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-more-additional-images">+ Tambah Gambar Tambahan</button>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <a href="{{ route('partner.daftar.kendaraan') }}" class="btn btn-light w-100">Batal</a>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100">
                                    <span class="indicator-label">Simpan</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('add-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            // === Car Model Logic (Existing) ===
            var savedModelId = {{ old('car_model_id', $car->car_model_id) ?? 'null' }};
            var selectedBrandId = $('#brand_id').val();
            if (selectedBrandId) {
                loadCarModels(selectedBrandId, savedModelId);
            }
            $('#brand_id').on('change', function() {
                var brand_id = $(this).val();
                loadCarModels(brand_id);
            });
            function loadCarModels(brand_id, selectedModelId = null) {
                if (brand_id) {
                    $('#car_model_id').prop('disabled', false);
                    $('#car_model_id').empty().append('<option value="">Memuat model...</option>');
                    $.ajax({
                        url: '{{ url("/partner/get-model-kendaraan") }}',
                        type: 'GET',
                        data: { brand_id: brand_id },
                        success: function(response) {
                            $('#car_model_id').empty();
                            $('#car_model_id').append('<option value="">Pilih Model</option>');
                            if (response.models && response.models.length > 0) {
                                $.each(response.models, function(index, model) {
                                    var isSelected = (model.id == selectedModelId) ? 'selected' : '';
                                    $('#car_model_id').append('<option value="' + model.id + '" ' + isSelected + '>' + model.name + '</option>');
                                });
                            } else {
                                $('#car_model_id').append('<option disabled>Model tidak tersedia</option>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error fetching models:", error);
                            $('#car_model_id').empty().append('<option value="">Error memuat model</option>');
                            toastr.error("Terjadi kesalahan saat mengambil data model. Silakan coba lagi.");
                        }
                    });
                } else {
                    $('#car_model_id').prop('disabled', true);
                    $('#car_model_id').empty();
                    $('#car_model_id').append('<option value="">Pilih Model</option>');
                }
            }

            // === New Image Management Logic ===
            $('#add-more-additional-images').click(function() {
                $('#additional-images-container').append(`
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="additional_images[]" accept="image/*" required>
                        <button type="button" class="btn btn-outline-danger remove-additional-image">Hapus</button>
                    </div>
                `);
            });

            $(document).on('click', '.remove-additional-image', function() {
                $(this).closest('.input-group').remove();
            });

            $(document).on('click', '.delete-existing-image', function() {
                const imageId = $(this).data('image-id');
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
                        $('form').append(`<input type="hidden" name="deleted_images[]" value="${imageId}">`);
                        imageCard.remove();
                        Swal.fire('Ditandai!', 'Gambar akan dihapus saat Anda menyimpan perubahan.', 'success');
                    }
                });
            });
        });

        // === Price Formatting Logic (Existing) ===
        function formatRupiah(amount) {
            return amount.toString().replace(/[^0-9]/g, '')
                .replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        const rentalInput = document.getElementById('rental_price_per_day_display');
        const rentalRawInput = document.getElementById('rental_price_per_day');
        const rawRentalPrice = @json(old('rental_price_per_day', $car->rental_price_per_day));

        document.addEventListener('DOMContentLoaded', function () {
            if (rentalInput && rawRentalPrice) {
                const formattedValue = formatRupiah(rawRentalPrice);
                rentalInput.value = formattedValue;
                rentalRawInput.value = rawRentalPrice;
            }
        });

        rentalInput.addEventListener('keyup', function () {
            let value = rentalInput.value.replace(/[^0-9]/g, '');
            rentalInput.value = formatRupiah(value);
            rentalRawInput.value = value;
        });
    </script>
@endpush

<style>
    .active {
        background: #007bff;
        color: white;
    }

    .breadcrumb {
        margin-bottom: 20px;
    }

    .form-container {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 20px;
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

    .button-group {
        text-align: right;
        margin-top: 20px;
    }

    button {
        padding: 10px 20px;
        margin-left: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .primary {
        background: #007bff;
        color: white;
    }

    .set-main-image, .set-existing-main-image {
        border-radius: 0 !important;
        border: none;
    }

    .set-main-image:hover, .set-existing-main-image:hover {
        opacity: 0.9;
    }

    .card-img-top {
        height: 150px;
        object-fit: cover;
    }
</style>
