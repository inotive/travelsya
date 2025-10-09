@extends('ekstranet.layout', ['title' => 'Tambah Jasa Klinik', 'url' => ''])

@section('content-admin')
    <div class="container">
        <!-- Tampilkan error validasi -->
        @if($errors->any())
            <div class="alert alert-danger">
                <h4>Terjadi Kesalahan:</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <!-- Tambahkan CSS khusus untuk memperbaiki tampilan dropdown Select2 -->
                <style>
                    .select2-container--open .select2-dropdown {
                        z-index: 9999 !important;
                        min-width: 200px !important;
                    }
                    .select2-dropdown {
                        z-index: 9999 !important;
                    }
                </style>
                
                <form id="clinic-form" action="{{ route('clinics.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Klinik</label>
                            <select class="form-control" name="clinic_id" id="clinic_id" required>
                                <option value="">Pilih Klinik</option>
                                @php
                                    $userClinics = \App\Models\Clinic::where('user_id', Auth::id())->get();
                                @endphp
                                @foreach ($userClinics as $clinic)
                                    <option value="{{ $clinic->id }}" 
                                        {{ old('clinic_id') == $clinic->id ? 'selected' : '' }}
                                        data-category="{{ $clinic->category }}">
                                        {{ $clinic->clinic_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('clinic_id')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Nama Jasa</label>
                            <input class="form-control form-control-lg" placeholder="Masukan nama jasa" name="name"
                                value="{{ old('name') }}" required />
                            @error('name')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6" id="category-field" style="display: block;">
                            <label class="required fs-6 fw-semibold mb-2">Kategori</label>
                            <select class="form-control" name="categories_services_id" id="categories_services_id" required>
                                <option value="">Pilih Kategori</option>
                                <optgroup label="Service">
                                    @foreach ($categories->where('name', 'Service') as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('categories_services_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Product">
                                    @foreach ($categories->where('name', 'Product') as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('categories_services_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Lainnya">
                                    @foreach ($categories->whereNotIn('name', ['Service', 'Product']) as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('categories_services_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('categories_services_id')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Biaya</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input id="harga" class="form-control form-control-lg" placeholder="Masukan biaya"
                                    name="price" value="{{ old('price') }}" required />
                            </div>
                            @error('price')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="required fs-6 fw-semibold mb-2">Durasi</label>
                            <input type="number" class="form-control form-control-lg" placeholder="Masukan durasi" 
                                name="duration" value="{{ old('duration') }}" min="1" required />
                            @error('duration')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="required fs-6 fw-semibold mb-2">Tipe Durasi</label>
                            <select class="form-control form-control-lg" name="duration_type" required>
                                <option value="menit" {{ old('duration_type', 'menit') == 'menit' ? 'selected' : '' }}>Menit</option>
                                <option value="jam" {{ old('duration_type') == 'jam' ? 'selected' : '' }}>Jam</option>
                            </select>
                            @error('duration_type')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Masa Berlaku (hari)</label>
                            <input type="number" class="form-control" name="expiry_date" 
                                value="{{ old('expiry_date', 30) }}" min="1" required />
                            @error('expiry_date')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Spesialis</label>
                            <select class="form-control" name="specialist_id" id="specialist_id" required>
                                <option value="">Pilih Spesialis</option>
                                @foreach ($spesialis as $specialist)
                                    <option value="{{ $specialist->id }}"
                                        {{ old('specialist_id', 1) == $specialist->id ? 'selected' : '' }}>
                                        {{ $specialist->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('specialist_id')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Image Upload Section -->
                        <div class="col-md-12 mt-4">
                            <label class="required fs-6 fw-semibold mb-2">Gambar Jasa Klinik</label>
                            
                            <!-- Multiple Images Upload -->
                            <div>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="images[]" multiple accept="image/*">
                                    <label class="input-group-text bg-primary text-white">Unggah Gambar</label>
                                </div>
                                <small class="form-text text-muted">Anda dapat memilih beberapa gambar sekaligus</small>
                                
                                <!-- Preview for images -->
                                <div id="image-preview" class="mt-2"></div>
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="description" class="required form-label">Deskripsi</label>
                            <textarea name="description" cols="30" rows="3" class="form-control" 
                                required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label class="required fs-6 fw-semibold mb-2">Peraturan</label>
                            <textarea name="rules" cols="30" rows="2" class="form-control" 
                                required>{{ old('rules') }}</textarea>
                            @error('rules')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="fs-6 fw-semibold mb-2">Harga Satuan (Unit Price)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input id="unit_price" class="form-control form-control-lg" placeholder="Masukan harga satuan" 
                                    name="unit_price" value="{{ old('unit_price') }}" />
                            </div>
                            @error('unit_price')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Status</label>
                            <select class="form-control" name="is_active" required>
                                <option value="1" {{ old('is_active', 1) == 1 ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                            @error('is_active')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        
                    </div>
                    <!--end::Input group-->

                    <!--begin::Actions-->
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
                    <!--end::Actions-->
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
            let split = number_string.split(',');
            let sisa = split[0].length % 3;
            let rupiah = split[0].substr(0, sisa);
            let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // Tambahkan titik jika ribuan ada
            if (ribuan) {
                let separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix === undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
        }

        function parseRupiah(rupiah) {
            // Hapus semua karakter selain angka
            return parseInt(rupiah.replace(/[^\d]/g, ''));
        }

        // Format harga saat input
        $('#harga').on('input', function() {
            let input = $(this).val();
            // Simpan posisi kursor
            let start = this.selectionStart;
            let end = this.selectionEnd;
            
            // Format nilai
            let formatted = formatRupiah(input);
            $(this).val(formatted);
            
            // Pertahankan posisi kursor
            this.setSelectionRange(start, end);
        });

        // Format harga saat halaman dimuat jika ada nilai old
        @if(old('price'))
            $('#harga').val(formatRupiah('{{ old('price') }}', 'Rp '));
        @endif

        $(document).ready(function() {
            
            // Inisialisasi Select2 untuk klinik
            $('#clinic_id').select2({
                placeholder: "Pilih klinik...",
                allowClear: true
            }).on('change', function() {
                // Saat klinik dipilih, cek kategori bisnis dan atur field kategori
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
                    
                    // Load categories for other business types
                    if (businessCategory) {
                        loadCategoriesByBusinessCategory(businessCategory);
                    } else {
                        // Jika tidak ada kategori bisnis, muat semua kategori
                        loadCategoriesByBusinessCategory(null);
                    }
                }
            });

            // Fungsi untuk memuat kategori berdasarkan jenis bisnis
            function loadCategoriesByBusinessCategory(businessCategory) {
                $.ajax({
                    url: '{{ route('get.categories.by.clinic') }}',
                    type: 'GET',
                    data: {
                        business_category: businessCategory
                    },
                    success: function(data) {
                        console.log("Categories Data:", data);
                        $('#categories_services_id').empty();
                        if (data.length > 0) {
                            $('#categories_services_id').append('<option value="">Pilih Kategori</option>');
                            
                            // Kelompokkan kategori berdasarkan tipe
                            const clinicCategories = data.filter(category => category.name === 'Clinic');
                            const serviceCategories = data.filter(category => category.name === 'Service');
                            const productCategories = data.filter(category => category.name === 'Product');
                            const otherCategories = data.filter(category => 
                                category.name !== 'Clinic' && 
                                category.name !== 'Service' && 
                                category.name !== 'Product'
                            );
                            
                            // Tambahkan optgroup untuk Clinic
                            if (clinicCategories.length > 0) {
                                const clinicGroup = $('<optgroup label="Clinic"></optgroup>');
                                $.each(clinicCategories, function(key, category) {
                                    let option = $("<option>", {
                                        value: category.id,
                                        text: category.name
                                    });
                                    clinicGroup.append(option);
                                });
                                $('#categories_services_id').append(clinicGroup);
                            }
                            
                            // Tambahkan optgroup untuk Service
                            if (serviceCategories.length > 0) {
                                const serviceGroup = $('<optgroup label="Service"></optgroup>');
                                $.each(serviceCategories, function(key, category) {
                                    let option = $("<option>", {
                                        value: category.id,
                                        text: category.name
                                    });
                                    serviceGroup.append(option);
                                });
                                $('#categories_services_id').append(serviceGroup);
                            }
                            
                            // Tambahkan optgroup untuk Product
                            if (productCategories.length > 0) {
                                const productGroup = $('<optgroup label="Product"></optgroup>');
                                $.each(productCategories, function(key, category) {
                                    let option = $("<option>", {
                                        value: category.id,
                                        text: category.name
                                    });
                                    productGroup.append(option);
                                });
                                $('#categories_services_id').append(productGroup);
                            }
                            
                            // Tambahkan optgroup untuk kategori lainnya
                            if (otherCategories.length > 0) {
                                const otherGroup = $('<optgroup label="Lainnya"></optgroup>');
                                $.each(otherCategories, function(key, category) {
                                    let option = $("<option>", {
                                        value: category.id,
                                        text: category.name
                                    });
                                    otherGroup.append(option);
                                });
                                $('#categories_services_id').append(otherGroup);
                            }
                        }
                        // Inisialisasi ulang Select2 setelah memuat opsi
                        $('#categories_services_id').select2({
                            placeholder: "Pilih atau ketik kategori baru...",
                            tags: true,
                            allowClear: true,
                            dropdownParent: $('#categories_services_id').parent()
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Error loading categories:", error);
                        $('#categories_services_id').empty().append('<option value="">Gagal memuat kategori</option>');
                        
                        // Inisialisasi ulang Select2 meskipun terjadi error
                        $('#categories_services_id').select2({
                            placeholder: "Pilih atau ketik kategori baru...",
                            tags: true,
                            allowClear: true,
                            dropdownParent: $('#categories_services_id').parent()
                        });
                    }
                });
            }

            // Inisialisasi Select2 untuk spesialis
            $('#specialist_id').select2({
                placeholder: "Pilih spesialis...",
                allowClear: true
            });
            
            // Preview for images  
            $(document).on('change', 'input[name="images[]"]', function() {
                var files = this.files;
                
                if (files.length > 0) {
                    for (let i = 0; i < files.length; i++) {
                        let file = files[i];
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#image-preview').append(
                                '<div class="image-preview-item d-inline-block m-1">' +
                                '<img src="' + e.target.result + '" class="img-thumbnail" width="100" style="object-fit:cover; height:100px;">' +
                                '</div>'
                            );
                        }
                        reader.readAsDataURL(file);
                    }
                }
            });

            // Validasi form sebelum submit
            $('#clinic-form').on('submit', function() {
                // Parse harga sebelum submit
                let harga = parseRupiah($('#harga').val());
                $('#harga').val(harga);
                
                // Jika field kategori disembunyikan (untuk bisnis Spa & Kecantikan), 
                // pastikan tidak diperlukan validasi
                if ($('#category-field').is(':hidden')) {
                    $('#categories_services_id').removeAttr('required');
                }
            });
        });
    </script>
@endpush