@extends('ekstranet.layout', ['title' => 'Edit Jasa Klinik', 'url' => ''])

@section('content-admin')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form id="clinic-form" action="{{ route('clinics.update', $clinic->id ?? '') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Tambahkan metode PUT untuk update -->

                    <!--begin::Input group-->

                    <div class="row g-9 mb-8">
                        @if (count($clinics) > 1)
                            <!-- Klinik -->
                            <div class="col-md-12">
                                <label for="clinic_id" class="form-label required fs-6 fw-semibold mb-2">Klinik</label>
                                <select name="clinic_id" id="clinic_id" class="form-control" required>
                                    @foreach ($clinics as $clinicItem)
                                        <option value="{{ $clinicItem->id }}"
                                            {{ ($clinic->clinic_id ?? '') == $clinicItem->id ? 'selected' : '' }}>
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
                                <!-- Options will be dynamically loaded -->
                            </select>
                        </div>

                        <!-- Biaya -->
                        <div class="col-md-6">
                            <label for="price" class="form-label required fs-6 fw-semibold mb-2">Biaya</label>
                            <input type="number" class="form-control form-control-lg" id="price" name="price"
                                value="{{ old('price', $clinic->price ?? '') }}" required>
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

                        <!-- Unit Price (hidden) -->
                        <input type="hidden" name="unit_price" value="unit_price">

                        <!-- Existing Images -->
                        @if(isset($clinicImages) && count($clinicImages) > 0)
                        <div class="col-md-12 mt-4">
                            <label class="fs-6 fw-semibold mb-2">Gambar Yang Sudah Ada</label>
                            <div class="row">
                                @foreach($clinicImages as $image)
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img src="{{ Storage::url($image->image) }}" class="card-img-top" alt="Clinic Image">
                                        <div class="card-body text-center">
                                            @if($image->main == 1)
                                                <span class="badge bg-primary">Main Image</span>
                                            @else
                                                <span class="badge bg-secondary">Additional Image</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                        
                        <div id="data-id-service" data-variable="{{ $clinic->categories_services_id ?? '' }}"></div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-end mt-4">
                        <a href="{{ route('clinics.list') }}" class="btn btn-light me-3">
                            <span class="indicator-label">Cancel</span>
                        </a>
                        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                            <span class="indicator-label">Update</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
            </div>
        </div>
    </div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Load categories on page load
        loadCategories(); // Panggil fungsi untuk memuat semua kategori

        function loadCategories() {
            $.ajax({
                url: '{{ route('get.categories.by.clinic') }}', // Pastikan URL ini benar sesuai rute Laravel
                type: 'GET',
                success: function(data) {
                    const serviceClinicId = $("#data-id-service").attr("data-variable");
                    // console.info(serviceClinicId);
                    console.log("Categories Data:",
                        data); // Debug log untuk memeriksa data kategori yang diterima
                    $('#categories_services_id').empty();
                    if (data.length > 0) {
                        $('#categories_services_id').append(
                            '<option value="">Pilih Kategori</option>');
                        $.each(data, function(key, category) {
                            let option = $("<option>", {
                                value: category.id,
                                text: category.name
                            });

                            if(category.id == serviceClinicId) {
                                option.attr("selected", true);
                                console.info("true")
                            };

                            $("#categories_services_id").append(option);
                            // $('#categories_services_id').append('<option value="' + category
                            //     .id + `" ${category.id == clinicId ? 'selected' : ''} >` + category.name + '</option>');
                        });
                    } else {
                        $('#categories_services_id').append(
                            '<option value="">Tidak ada kategori tersedia</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error loading categories:",
                        error); // Debug log untuk melihat error
                    $('#categories_services_id').empty().append(
                        '<option value="">Gagal memuat kategori</option>');
                }
            });
        }
    });
</script>
