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
                        <div class="col-md-6" id="category-field" style="display: block;">
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

                        <!-- Kelola Gambar -->
                        <div class="col-md-12 mt-4">
                            <label class="fs-6 fw-semibold mb-2">Kelola Gambar</label>
                            
                            @php
                                $mainImage = $clinicImages->firstWhere('main', 1);
                                $additionalImages = $clinicImages->where('main', 0);
                            @endphp

                            <!-- Main Image Section -->
                            <div class="mb-5 p-4 border rounded">
                                <h6 class="mb-3">Gambar Utama</h6>
                                @if($mainImage)
                                    <div class="row">
                                        <div class="col-md-4 col-sm-6 mb-4">
                                            <div class="card h-100">
                                                <img src="{{ Storage::url($mainImage->image) }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="Gambar Utama" onerror="this.src='{{ asset('images/not_found.jpg') }}';">
                                                <div class="card-body text-center p-3">
                                                    <p class="card-text text-muted text-truncate" title="{{ basename($mainImage->image) }}">{{ basename($mainImage->image) }}</p>
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
                                            <div class="col-md-4 col-sm-6 mb-4">
                                                <div class="card h-100">
                                                    <img src="{{ Storage::url($image->image) }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="Image" onerror="this.src='{{ asset('images/not_found.jpg') }}';">
                                                    <div class="card-body text-center p-3">
                                                        <p class="card-text text-muted text-truncate" title="{{ basename($image->image) }}">{{ basename($image->image) }}</p>
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
        
        // Format harga saat input (from rekreasi)
        $('#price').on('input', function () {
            let input = $(this).val();
            let formatted = formatRupiah(input, 'Rp. ');
            $(this).val(formatted);
        });
        
        // Format harga saat input (from rekreasi)
        $('#price').on('input', function () {
            let input = $(this).val();
            let formatted = formatRupiah(input, 'Rp. ');
            $(this).val(formatted);
        });
        
        // Handle submit with confirmation dialog
        document.getElementById('kt_modal_new_target_submit').addEventListener('click', function(event) {
            event.preventDefault();
            
            // Show loading indicator
            const submitButton = this;
            submitButton.disabled = true;
            const indicatorLabel = submitButton.querySelector('.indicator-label');
            const indicatorProgress = submitButton.querySelector('.indicator-progress');
            indicatorLabel.style.display = 'none';
            indicatorProgress.style.display = 'inline-block';

            Swal.fire({
                title: "Apa kamu yakin ingin menyimpan perubahan?",
                icon: "question",
                showCancelButton: true,
                cancelButtonText: "Tidak jadi",
                cancelButtonColor: '#d33',
                confirmButtonText: "Ya",
                confirmButtonColor: '#3085d6',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Format the price value before submitting
                    let hargaInput = document.getElementById('price');
                    if (hargaInput) {
                        // Remove formatting characters (Rp., commas, dots) to get clean number
                        let cleanPrice = hargaInput.value.replace(/[^\d]/g, '');
                        hargaInput.value = cleanPrice;
                    }
                    
                    // Parse unit price sebelum submit jika ada
                    let unitPriceValue = $('#unit_price').val();
                    if (unitPriceValue && unitPriceValue.trim() !== '') {
                        let unitPrice = parseRupiah(unitPriceValue);
                        
                        if (isNaN(unitPrice) || unitPrice < 0) {
                            alert('Harga satuan harus berupa angka yang valid dan tidak negatif');
                            submitButton.disabled = false;
                            indicatorLabel.style.display = 'inline-block';
                            indicatorProgress.style.display = 'none';
                            return false;
                        }
                        
                        $('#unit_price').val(unitPrice);
                    }
                    
                    document.getElementById('clinic-form').submit();
                } else {
                    // Re-enable button if cancelled
                    submitButton.disabled = false;
                    indicatorLabel.style.display = 'inline-block';
                    indicatorProgress.style.display = 'none';
                }
            });
        });

        // Inisialisasi Select2 untuk clinic_id (jika ada)
        @if (count($clinics) > 1)
            $('#clinic_id').select2({
                placeholder: "Pilih klinik...",
                allowClear: true
            }).on('change', function() {
                let selectedOption = $(this).find('option:selected');
                let businessCategory = selectedOption.data('category');
                
                // Check if business category is Spa & Kecantikan (adjust the condition as needed)
                if (businessCategory && (businessCategory.toLowerCase().includes('spa') || businessCategory.toLowerCase().includes('kecantikan'))) {
                    // Hide category field for Spa & Kecantikan business
                    $('#category-field').hide();
                    // Make categories_services_id field not required
                    $('#categories_services_id').removeAttr('required');
                    // Set default value for Spa & Kecantikan (you may want to adjust this based on your business logic)
                    $('#categories_services_id').val(''); // Clear any existing selection
                } else {
                    // Show category field for other businesses
                    $('#category-field').show();
                    // Make categories_services_id field required
                    $('#categories_services_id').attr('required', 'required');
                    
                    if (businessCategory) {
                        loadCategoriesByBusinessCategory(businessCategory);
                    } else {
                        loadCategories();
                    }
                }
            });
        @endif

        // Load categories saat halaman dimuat
        loadCategories();
        
        // On page load, check the initial clinic category and hide/show category field accordingly
        $(document).ready(function() {
            let initialClinicOption = $('#clinic_id option:selected');
            let initialBusinessCategory = initialClinicOption.data('category');
            
            // Check if business category is Spa & Kecantikan (adjust the condition as needed)
            if (initialBusinessCategory && (initialBusinessCategory.toLowerCase().includes('spa') || initialBusinessCategory.toLowerCase().includes('kecantikan'))) {
                // Hide category field for Spa & Kecantikan business
                $('#category-field').hide();
                // Make categories_services_id field not required
                $('#categories_services_id').removeAttr('required');
                // Set default value for Spa & Kecantikan (you may want to adjust this based on your business logic)
                $('#categories_services_id').val(''); // Clear any existing selection
            } else {
                // Show category field for other businesses
                $('#category-field').show();
                // Make categories_services_id field required
                $('#categories_services_id').attr('required', 'required');
            }
        });
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
    
    // Format Rupiah function (from rekreasi)
    function formatRupiah(angka, prefix) {
        angka = angka.toString().replace(/[^,\d]/g, '');
        const split = angka.split(',');
        const sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        const ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            const separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix !== undefined ? prefix + rupiah : rupiah;
    }
    
    // Handle adding additional images
    $('#add-more-additional-images').click(function() {
        $('#additional-images-container').append(`
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="additional_images[]" accept="image/*" required>
                <button type="button" class="btn btn-outline-danger remove-additional-image">Hapus</button>
            </div>
        `);
    });
    
    // Handle removing newly added images
    $(document).on('click', '.remove-additional-image', function() {
        $(this).closest('.input-group').remove();
    });
    
    // Handle deleting existing images
    $(document).on('click', '.delete-existing-image', function() {
        const imageId = $(this).data('image-id');
        const imageCard = $(this).closest('.col-md-4'); // Adjusted selector
        
        Swal.fire({
            title: "Apakah kamu yakin ingin menghapus gambar ini?",
            text: "Gambar ini akan dihapus secara permanen.",
            icon: "warning",
            showCancelButton: true,
            cancelButtonText: "Batal",
            confirmButtonText: "Ya, Hapus",
            confirmButtonColor: '#d33',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Add hidden input to mark image for deletion
                $('#clinic-form').append(`<input type="hidden" name="deleted_images[]" value="${imageId}">`);
                // Remove the card from UI
                imageCard.remove();
            }
        });
    });
    
    // Validasi form sebelum submit
    $('#clinic-form').on('submit', function() {
        // Jika field kategori disembunyikan (untuk bisnis Spa & Kecantikan), 
        // pastikan tidak diperlukan validasi
        if ($('#category-field').is(':hidden')) {
            $('#categories_services_id').removeAttr('required');
        }
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush