@extends('ekstranet.layout', [
    'title' => 'Update Data Kendaraan',
    'url' => '#',
    'subTitle' => 'Edit Data',
])

@section('content-admin')
    {{-- FORM UPDATE --}}
    <div class="main-content">
        <div class="form-container">
            <h2>Form Update Data</h2>
            <form action="{{ route('partner.kendaraan.update', $car->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Merk</label>
                        <select class="form-select" id="brand_id" name="brand_id" data-control="select2"
                            data-placeholder="Pilih Merk" data-allow-clear="true">
                            <option value="" disabled {{ !$car->brand_id ? 'selected' : '' }}>Pilih Merk</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" {{ $brand->id == $car->brand_id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('brand_id')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" value="1">
                    </div>

                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Model</label>
                        <select class="form-select" id="car_model_id" name="car_model_id" data-control="select2"
                            data-placeholder="Pilih Model" data-allow-clear="true">
                            <option value="" disabled {{ !$car->car_model_id ? 'selected' : '' }}>Pilih Model</option>
                            @foreach ($car_models as $car_model)
                                <option value="{{ $car_model->id }}"
                                    {{ $car_model->id == $car->car_model_id ? 'selected' : '' }}>
                                    {{ $car_model->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('car_model_id')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" value="1">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Tipe</label>
                        <select class="form-control" id="category" name="category">
                            <option value="">Pilih Tipe</option>
                            <option value="manual" {{ $car->category == 'manual' ? 'selected' : '' }}>Manual</option>
                            <option value="automatic" {{ $car->category == 'automatic' ? 'selected' : '' }}>Matic</option>
                        </select>
                        @error('category')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" value="1">
                    </div>

                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Kategori Rental</label>
                        <select class="form-control" id="category_rent" name="category_rent">
                            <option value="">Pilih Kategori Rental</option>
                            <option value="Dengan Driver" {{ $car->category_rent == 'Dengan Driver' ? 'selected' : '' }}>
                                Dengan Driver</option>
                            <option value="Tidak Dengan Driver"
                                {{ $car->category_rent == 'Tidak Dengan Driver' ? 'selected' : '' }}>Tidak Dengan Driver
                            </option>
                        </select>
                        @error('category_rent')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" value="1">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Biaya Sewa</label>
                        <input class="form-control form-control-lg" id="rental_price_per_day_display"
                            placeholder="Masukkan Biaya Sewa"
                            value="{{ number_format($car->rental_price_per_day, 0, ',', '.') }}" />
                        <input type="hidden" id="rental_price_per_day" name="rental_price_per_day"
                            value="{{ $car->rental_price_per_day }}" />

                        @error('rental_price_per_day')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Durasi</label>
                        <input class="form-control form-control-lg" id="duration" placeholder="Berapa Lama Durasi"
                            name="duration" value="{{ $car->duration }}" />

                        @error('duration')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Tahun Kendaraan</label>
                        <select class="form-control" id="years" name="years">
                            <?php
                                for ($years = (int)date('Y'); 1900 <= $years; $years--): ?>
                            <option value="<?= $years ?>" <?= $car->years == $years ? 'selected' : '' ?>><?= $years ?>
                            </option>
                            <?php endfor; ?>
                        </select>
                        @error('policy_id')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" value="1">
                    </div>

                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Jumlah Kursi</label>
                        <input class="form-control form-control-lg" id="number_seats" placeholder="Masukkan Jumlah Kursi"
                            name="number_seats" value="{{ $car->number_seats }}" />

                        @error('number_seats')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="">Pilih Status</option>
                            <option value="1" {{ $car->status == 1 ? 'selected' : '' }}>Tersedia</option>
                            <option value="0" {{ $car->status == 0 ? 'selected' : '' }}>Tidak Tersedia</option>
                        </select>
                        @error('status')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" value="1">
                    </div>

                    <div class="form-group">
                        <label class="fs-6 fw-semibold mb-2">Gambar</label>
                        <input type="file" class="form-control" id="image" name="image_url"
                            value="{{ $car->image_url }}">

                        @error('image')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" value="1">
                    </div>
                </div>

                <div class="col-12 mb-4">
                    <label for="description" class="form-label required fs-6 fw-semibold mb-2">Peraturan</label>
                    <textarea name="description" id="description" cols="30" rows="5"
                        class="form-control">{{ $car->description }}</textarea>
                </div>

                @if(isset($car->images) && count($car->images) > 0)
                <div class="col-md-12 mb-4">
                    <label class="fs-6 fw-semibold mb-2">Gambar Yang Sudah Ada</label>
                    <div class="row">
                        @foreach($car->images as $image)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top" alt="Image">
                                <div class="card-body text-center">
                                    @if($image->main == 1)
                                        <span class="badge bg-primary">Gambar Utama</span>
                                    @else
                                        <span class="badge bg-secondary">Gambar Tambahan</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <div class="col-12 mb-4">
                    <label class="form-label fs-6 fw-semibold mb-2">Tambah Gambar Baru</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="images[]" accept="image/*">
                        <input type="hidden" name="main_image[]" value="1">
                        <label class="input-group-text bg-primary text-white">Gambar Utama</label>
                    </div>
                    <div id="additional-images"></div>
                    <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-more-images">+ Tambah Gambar</button>
                    <div class="form-text">Unggah gambar baru akan menambahkan ke gambar yang sudah ada. Gambar utama baru akan menggantikan gambar utama lama.</div>
                </div>

                <div class="button-group">
                    <button type="reset">Tutup</button>
                    <button type="submit" class="primary">Update Data</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('add-script')
    <script>
        $('#brand_id').on('change', function() {
            var brand_id = $(this).val();

            if (brand_id) {
                $('#car_model_id').prop('disabled', false);

                $.ajax({
                    url: '{{ url('/partner/get-model-kendaraan') }}',
                    type: 'GET',
                    data: {
                        brand_id: brand_id
                    },
                    success: function(response) {
                        $('#car_model_id').empty();

                        $('#car_model_id').append(
                            '<option selected disabled value="">Pilih Model</option>');

                        if (response.models.length > 0) {
                            $.each(response.models, function(index, model) {
                                $('#car_model_id').append('<option value="' + model.id + '">' +
                                    model.name + '</option>');
                            });
                        } else {
                            $('#car_model_id').append('<option disabled>Model tidak tersedia</option>');
                        }

                        @if ($car->car_model_id)
                            $('#car_model_id').val('{{ $car->car_model_id }}').trigger('change');
                        @endif
                    },
                    error: function() {
                        alert("Terjadi kesalahan saat mengambil data model.");
                    }
                });
            } else {
                $('#car_model_id').prop('disabled', true);
                $('#car_model_id').empty();
                $('#car_model_id').append('<option selected disabled value="">Pilih Model</option>');
            }
        });

        $(document).ready(function() {
            var selectedBrandId = $('#brand_id').val();
            if (selectedBrandId) {
                $('#brand_id').trigger('change');
            }
            
            // Handle adding additional images
            $('#add-more-images').click(function() {
                $('#additional-images').append(`
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="images[]" accept="image/*">
                        <input type="hidden" name="main_image[]" value="0">
                        <label class="input-group-text bg-secondary text-white">Gambar Tambahan</label>
                        <button type="button" class="btn btn-danger remove-image">Hapus</button>
                    </div>
                `);
            });
            
            // Handle removing additional images
            $(document).on('click', '.remove-image', function() {
                $(this).closest('.input-group').remove();
            });
        });

        function formatRupiah(amount) {
            return amount.toString().replace(/[^0-9]/g, '')
                .replace(/([0-9])([0-9]{3})$/, '$1.$2')
                .replace(/([0-9])([0-9]{3})\./g, '$1.$2.');
        }

        const rentalInput = document.getElementById('rental_price_per_day_display');
        const rentalRawInput = document.getElementById('rental_price_per_day');

        rentalInput.addEventListener('keyup', function() {
            let value = rentalInput.value;

            let formattedValue = formatRupiah(value);

            rentalInput.value = formattedValue;

            rentalRawInput.value = value.replace(/[^0-9]/g, '');
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
</style>
