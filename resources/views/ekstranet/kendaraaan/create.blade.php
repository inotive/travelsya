@extends('ekstranet.layout', ['title' => 'Tambah Kendaraan', 'url' => ''])

@section('content-admin')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('partner.kendaraan.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">

                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Bisnis</label>
                            <select class="form-control" name="car_rental_id" id="car_rental_id" required>
                                <option value="">-- Pilih Bisnis --</option>
                                @foreach ($car_rentals as $car_rental)
                                    <option value="{{ $car_rental->id }}">{{ $car_rental->business_name }}</option>
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
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
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
                                    <option value="{{ $car_model->id }}">{{ $car_model->name }}</option>
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
                                <option value="manual">Manual</option>
                                <option value="automatic">Matic</option>
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
                                <option value="Lepas Kunci">Lepas Kunci</option>
                                <option value="Dengan Supir">Dengan Supir</option>
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
                                    aria-describedby="basic-addon1" required>
                                <input type="hidden" id="rental_price_per_day" name="rental_price_per_day">
                            </div>
                            @error('rental_price_per_day')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Durasi</label>
                            <input type="text" class="form-control" id="duration" name="duration" placeholder="Durasi" required>
                            @error('duration')
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
                                    <option value="{{ $year }}">{{ $year }}</option>
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
                            <input type="number" class="form-control" id="number_seats" name="number_seats"
                                placeholder="Jumlah Kursi" required>
                            @error('number_seats')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                            @error('status')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            @error('description')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-12 mt-4">
                            <label class="required fs-6 fw-semibold mb-2">Gambar Kendaraan</label>
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="image" accept="image/*" required>
                                {{-- <label class="input-group-text bg-primary text-white">Gambar Utama</label> --}}
                            </div>
                            {{-- <div id="additional-images"></div>
                            <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-more-images">+ Tambah Gambar</button> --}}
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <button type="reset" class="btn btn-light w-100" onclick="history.back()">Batal</button>
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
        
        // Handle adding additional images
        $('#add-more-images').click(function() {
            $('#additional-images').append(`
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="images[]" accept="image/*">
                    <label class="input-group-text bg-secondary text-white">Gambar Tambahan</label>
                    <button type="button" class="btn btn-danger remove-image">Hapus</button>
                </div>
            `);
        });
        
        // Handle removing additional images
        $(document).on('click', '.remove-image', function() {
            $(this).closest('.input-group').remove();
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
