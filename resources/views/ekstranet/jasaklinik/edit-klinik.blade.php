@extends('ekstranet.layout', ['title' => 'Edit Jasa Klinik', 'url' => ''])

@section('content-admin')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <!-- Perbaiki CSS - samakan dengan create -->
                <style>
                    .select2-container--open .select2-dropdown {
                        z-index: 9999 !important;
                        min-width: 200px !important;
                    }
                    .select2-dropdown {
                        z-index: 9999 !important;
                    }
                </style>
                
                <form id="clinic-form" action="{{ route('clinics.update', $clinic->id ?? '') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-9 mb-8">
                        @if (count($clinics) > 1)
                            <!-- Klinik -->
                            <div class="col-md-12">
                                <label for="clinic_id" class="form-label required fs-6 fw-semibold mb-2">Klinik</label>
                                <select name="clinic_id" id="clinic_id" class="form-control" required>
                                    @foreach ($clinics as $clinicItem)
                                        <option value="{{ $clinicItem->id }}"
                                            {{ ($clinic->clinic_id ?? '') == $clinicItem->id ? 'selected' : '' }}
                                            data-category="{{ $clinicItem->category }}">
                                            {{ $clinicItem->clinic_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="clinic_id" value="{{ $clinics->first()->id }}">
                        @endif

                        <!-- Nama Jasa -->
                        <div class="col-md-6">
                            <label for="name" class="form-label required fs-6 fw-semibold mb-2">Nama Jasa</label>
                            <input type="text" class="form-control form-control-lg" id="name" name="name"
                                value="{{ old('name', $clinic->name ?? '') }}" required>
                        </div>

                        <!-- Kategori -->
                        <div class="col-md-6">
                            <label for="categories_services_id" class="form-label required fs-6 fw-semibold mb-2">Kategori</label>
                            <select class="form-control" id="categories_services_id" name="categories_services_id" required>
                                <option value="">Pilih Kategori</option>
                            </select>
                        </div>

                        <!-- Biaya -->
                        <div class="col-md-6">
                            <label for="price" class="form-label required fs-6 fw-semibold mb-2">Biaya</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control form-control-lg" id="price" name="price"
                                    placeholder="Masukan biaya"
                                    value="{{ old('price', $clinic->price ?? '') }}" required>
                            </div>
                            @error('price')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Durasi -->
                        <div class="col-md-3">
                            <label for="duration" class="form-label required fs-6 fw-semibold mb-2">Durasi</label>
                            <input type="text" class="form-control form-control-lg" id="duration" name="duration"
                                value="{{ old('duration', $clinic->duration ?? '') }}" required>
                        </div>

                        <!-- Tipe Durasi -->
                        <div class="col-md-3">
                            <label for="duration_type" class="form-label required fs-6 fw-semibold mb-2">Tipe Durasi</label>
                            <select class="form-control form-control-lg" id="duration_type" name="duration_type" required>
                                <option value="menit"
                                    {{ old('duration_type', $clinic->duration_type ?? '') == 'menit' ? 'selected' : '' }}>Menit
                                </option>
                                <option value="jam"
                                    {{ old('duration_type', $clinic->duration_type ?? '') == 'jam' ? 'selected' : '' }}>Jam
                                </option>
                            </select>
                        </div>

                        <!-- Masa Berlaku -->
                        <div class="col-md-6">
                            <label for="expiry_date" class="form-label required fs-6 fw-semibold mb-2">Masa Berlaku (hari)</label>
                            <input type="number" class="form-control" id="expiry_date" name="expiry_date"
                                value="{{ old('expiry_date', $clinic->expiry_date ?? '') }}" required>
                        </div>

                        <!-- Specialist ID (hidden) -->
                        <input type="hidden" name="specialist_id" value="1">

                        <!-- Multiple Images -->
                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Gambar (Multiple)</label>
                            <input type="file" class="form-control form-control-lg" name="images[]" multiple accept="image/*" />
                            <small class="form-text text-muted">Anda dapat memilih beberapa gambar sekaligus</small>
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-12">
                            <label for="description" class="form-label required fs-6 fw-semibold mb-2">Deskripsi</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $clinic->description ?? '') }}</textarea>
                        </div>

                        <!-- Aturan -->
                        <div class="col-12">
                            <label class="required fs-6 fw-semibold mb-2">Peraturan</label>
                            <textarea name="rules" id="rules" cols="30" rows="2" class="form-control" required>{{ old('rules', $clinic->rules ?? '') }}</textarea>
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label for="is_active" class="form-label required fs-6 fw-semibold mb-2">Status Aktif</label>
                            <select class="form-control form-control-lg" id="is_active" name="is_active" required>
                                <option value="1" {{ old('is_active', $clinic->is_active ?? 1) == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_active', $clinic->is_active ?? 1) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>

                        <!-- Unit Price -->
                        <div class="col-md-6">
                            <label for="unit_price" class="form-label fs-6 fw-semibold mb-2">Harga Satuan (Unit Price)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control form-control-lg" id="unit_price" name="unit_price"
                                    placeholder="Masukan harga satuan"
                                    value="{{ old('unit_price', $clinic->unit_price ?? '') }}">
                            </div>
                            @error('unit_price')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Existing Images -->
                        @if(isset($clinicImages) && count($clinicImages) > 0)
                            <div class="col-md-12 mt-4">
                                <label class="fs-6 fw-semibold mb-2">Gambar Yang Sudah Ada</label>
                                <div class="row">
                                    @foreach($clinicImages as $image)
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <img src="{{ Storage::url($image->image) }}" class="card-img-top" alt="Clinic Image" style="height: 150px; object-fit: cover;">
                                            <div class="card-body text-center">
                                                @if($image->main == 1)
                                                    <span class="badge bg-primary">Main Image</span>
                                                @else
                                                    <span class="badge bg-secondary">Additional Image</span>
                                                @endif
                                                <div class="mt-2">
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input main-image-radio" type="radio" name="main_image_id" value="{{ $image->id }}" id="main_image_{{ $image->id }}" {{ $image->main == 1 ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="main_image_{{ $image->id }}">
                                                            Jadikan Utama
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="delete_images[]" value="{{ $image->id }}" id="delete_image_{{ $image->id }}">
                                                        <label class="form-check-label" for="delete_image_{{ $image->id }}">
                                                            Hapus gambar
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                        
                        <div id="data-id-service" data-variable="{{ $clinic->categories_services_id ?? '' }}" data-business-category="{{ $businessCategory ?? '' }}"></div>
                    </div>

                    <div class="text-center">
                        <div class="row">
                            <div class="col-6 mb-2">
                                <a href="{{ route('clinics.list') }}" class="btn btn-light w-100 me-3">
                                    <span class="indicator-label">Batal</span>
                                </a>
                            </div>
                            <div class="col-6">
                                <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary w-100">
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
    function formatRupiah(angka, prefix) {
        // Hapus semua karakter selain angka
        let number_string = angka.toString().replace(/[^,\d]/g, '');
        if (number_string === '') return '';
        
        // Split bagian desimal jika ada
        let split = number_string.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        
        // Tambahkan titik sebagai pemisah ribuan
        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        
        // Gabungkan kembali dengan bagian desimal jika ada
        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix === undefined ? rupiah : (rupiah ? prefix + ' ' + rupiah : '');
    }

    function parseRupiah(rupiah) {
        // Hapus semua karakter selain angka
        return parseInt(rupiah.replace(/[^\d]/g, ''));
    }

    $(document).ready(function() {
        // Format harga saat halaman dimuat
        let currentPrice = $('#price').val();
        if (currentPrice && /^\d+$/.test(currentPrice.trim())) {
            let numericValue = parseInt(currentPrice.replace(/[^\d]/g, ''), 10);
            $('#price').val(formatRupiah(numericValue));
        }
        
        // Format unit price saat halaman dimuat
        let currentUnitPrice = $('#unit_price').val();
        if (currentUnitPrice && /^\d+$/.test(currentUnitPrice.trim())) {
            let numericValue = parseInt(currentUnitPrice.replace(/[^\d]/g, ''), 10);
            $('#unit_price').val(formatRupiah(numericValue));
        }
        
        // Format harga saat input
        $('#price').on('input', function(e) {
            let oldValue = this.value;
            let numericValue = parseRupiah(oldValue);
            
            if (numericValue === 0 && oldValue.replace(/[^0-9]/g, '') === '') {
                $(this).val('');
                return;
            }
            
            let formatted = formatRupiah(numericValue);
            $(this).val(formatted);
        });
        
        // Format unit price saat input
        $('#unit_price').on('input', function(e) {
            let oldValue = this.value;
            let numericValue = parseRupiah(oldValue);
            
            if (numericValue === 0 && oldValue.replace(/[^0-9]/g, '') === '') {
                $(this).val('');
                return;
            }
            
            let formatted = formatRupiah(numericValue);
            $(this).val(formatted);
        });
        
        // Parse harga sebelum submit
        $('#clinic-form').on('submit', function(e) {
            let hargaValue = $('#price').val();
            if (hargaValue && hargaValue.trim() !== '') {
                let harga = parseRupiah(hargaValue);
                
                if (isNaN(harga) || harga <= 0) {
                    alert('Harga harus berupa angka yang valid dan lebih besar dari 0');
                    e.preventDefault();
                    return false;
                }
                
                $('#price').val(harga);
            } else {
                alert('Harga wajib diisi');
                e.preventDefault();
                return false;
            }
            
            // Parse unit price sebelum submit jika ada
            let unitPriceValue = $('#unit_price').val();
            if (unitPriceValue && unitPriceValue.trim() !== '') {
                let unitPrice = parseRupiah(unitPriceValue);
                
                if (isNaN(unitPrice) || unitPrice < 0) {
                    alert('Harga satuan harus berupa angka yang valid dan tidak negatif');
                    e.preventDefault();
                    return false;
                }
                
                $('#unit_price').val(unitPrice);
            }
        });

        // Inisialisasi Select2 untuk clinic_id (jika ada)
        @if (count($clinics) > 1)
            $('#clinic_id').select2({
                placeholder: "Pilih klinik...",
                allowClear: true
            }).on('change', function() {
                let selectedOption = $(this).find('option:selected');
                let businessCategory = selectedOption.data('category');
                
                if (businessCategory) {
                    loadCategoriesByBusinessCategory(businessCategory);
                } else {
                    loadCategories();
                }
            });
        @endif

        // Load categories saat halaman dimuat
        loadCategories();
    });

    // Fungsi untuk memuat kategori berdasarkan business category
    function loadCategoriesByBusinessCategory(businessCategory) {
        $.ajax({
            url: '{{ route('get.categories.by.clinic') }}',
            type: 'GET',
            data: {
                business_category: businessCategory
            },
            success: function(data) {
                populateCategories(data);
            },
            error: function(xhr, status, error) {
                console.error("Error loading categories:", error);
                $('#categories_services_id').empty().append('<option value="">Gagal memuat kategori</option>');
                initializeSelect2();
            }
        });
    }

    // Fungsi untuk memuat kategori (seperti di file create)
    function loadCategories() {
        let selectedCategory = $('#data-id-service').data('variable');
        let businessCategory = $('#data-id-service').data('business-category');
        
        $.ajax({
            url: '{{ route('get.categories.by.clinic') }}',
            type: 'GET',
            data: {
                business_category: businessCategory
            },
            success: function(data) {
                console.log("Categories Data:", data);
                populateCategories(data);
            },
            error: function(xhr, status, error) {
                console.error("Error loading categories:", error);
                $('#categories_services_id').empty().append('<option value="">Gagal memuat kategori</option>');
                initializeSelect2();
            }
        });
    }

    // Fungsi untuk populate categories (sama seperti di create)
    function populateCategories(data) {
        let selectedCategory = $('#data-id-service').data('variable');
        
        // Hancurkan Select2 yang sudah ada
        if ($('#categories_services_id').hasClass("select2-hidden-accessible")) {
            $('#categories_services_id').select2('destroy');
        }
        
        $('#categories_services_id').empty();
        
        if (data.length > 0) {
            $('#categories_services_id').append('<option value="">Pilih Kategori</option>');
            
            // Kelompokkan kategori berdasarkan tipe (sama seperti di create)
            const clinicCategories = data.filter(category => category.name === 'Clinic');
            const serviceCategories = data.filter(category => category.name === 'Service');
            const productCategories = data.filter(category => category.name === 'Product');
            const otherCategories = data.filter(category => 
                category.name !== 'Clinic' && 
                category.name !== 'Service' && 
                category.name !== 'Product'
            );
            
            // Function helper untuk menambahkan optgroup
            function addOptGroup(categories, label) {
                if (categories.length > 0) {
                    const group = $(`<optgroup label="${label}"></optgroup>`);
                    $.each(categories, function(key, category) {
                        let option = $("<option>", {
                            value: category.id,
                            text: category.name
                        });
                        
                        if(category.id == selectedCategory) {
                            option.attr("selected", true);
                        }
                        
                        group.append(option);
                    });
                    $('#categories_services_id').append(group);
                }
            }

            // Tambahkan semua optgroup
            addOptGroup(clinicCategories, 'Clinic');
            addOptGroup(serviceCategories, 'Service');
            addOptGroup(productCategories, 'Product');
            addOptGroup(otherCategories, 'Lainnya');
            
        } else {
            $('#categories_services_id').append('<option value="">Tidak ada kategori tersedia</option>');
        }
        
        initializeSelect2();
    }

    // Fungsi untuk inisialisasi Select2 (sama seperti di create)
    function initializeSelect2() {
        $('#categories_services_id').select2({
            placeholder: "Pilih atau ketik kategori baru...",
            allowClear: true,
            tags: true
        });
    }
    
    // Event listener for delete checkboxes to manage main image selection
    $(document).on('change', 'input[name="delete_images[]"]', function() {
        if (this.checked) {
            // If deleting the main image, uncheck the main image radio button for that image
            let imageId = $(this).val();
            let mainRadio = $('input[name="main_image_id"][value="' + imageId + '"]');
            if (mainRadio.is(':checked')) {
                // Reset main image selection to ensure a new one is selected or handled on server side
                mainRadio.prop('checked', false);
            }
        }
    });
</script>
@endpush