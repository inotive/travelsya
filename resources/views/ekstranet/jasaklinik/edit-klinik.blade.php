@extends('ekstranet.layout', ['title' => 'Edit Jasa Klinik', 'url' => ''])

@section('content-admin')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form id="clinic-form" action="{{ route('clinics.update', $clinic->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Tambahkan metode PUT untuk update -->
                
                <div class="mb-13 text-center">
                    <h1 class="mb-3">Edit Jasa</h1>
                </div>
               
                <div class="row g-9 mb-8">
                    

                    <!-- Nama Klinik -->
                    <div class="col-md-6">
                        <label for="name" class="form-label">Nama Klinik</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $clinic->name) }}" required>
                    </div>


                    <!-- Kategori Layanan -->
                    <div class="col-md-6">
                        <label for="categories_services_id" class="form-label">Kategori Layanan</label>
                        <select name="categories_services_id" id="categories_services_id" class="form-control" required>
                            <!-- Options will be dynamically loaded -->
                        </select>
                    </div>

                    @if(count($clinics) > 1)
                    <!-- edit clinic_id -->
                    <div class="col-md-6">
                        <label for="clinic_id" class="form-label">Nama Bisnis</label>
                        <select name="clinic_id" id="clinic_id" class="form-control" required>
                            @foreach ($clinics as $clinicItem)
                                <option value="{{ $clinicItem->id }}" {{ $clinic->clinic_id == $clinicItem->id ? 'selected' : '' }}>
                                    {{ $clinicItem->clinic_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                   @else
                   <input type="hidden" name="clinic_id" value="{{ $clinics->first()->id }}">
                   @endif

                    <!-- Harga -->
                    <div class="col-md-6">
                        <label for="price" class="form-label">Biaya</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $clinic->price) }}" required>
                    </div>

                     <!-- Durasi -->
                     <div class="col-md-3">
                        <label for="duration" class="form-label">Durasi </label>
                        <input type="text" class="form-control" id="duration" name="duration" value="{{ old('duration', $clinic->duration) }}" required>
                    </div>

                    <div class="col-md-3">
                        <label for="duration_type" class="form-label">Tipe Durasi</label>
                        <input type="text" class="form-control" id="duration_type" name="duration_type" value="{{ old('duration_type', $clinic->duration_type) }}" required>
                    </div>

                    
                    <!-- Tanggal Kadaluarsa -->
                    <div class="col-md-6">
                        <label for="expiry_date" class="form-label">Masa Berlaku(hari)</label>
                        <input type="number" class="form-control" id="expiry_date" name="expiry_date" value="{{ old('expiry_date', $clinic->expiry_date) }}" required>
                    </div>


                    
                    <div class="col-md-12">
                        <label for="image" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if($clinic->image)
                            <img src="{{ asset('storage/clinichaspackages/'.$clinic->image) }}" alt="Current Image" style="max-width: 200px; margin-top: 10px;">
                        @endif
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" id="description" rows="3" required>{{ old('description', $clinic->description) }}</textarea>
                    </div>

                     <!-- Rules -->
                     <div class="col-md-12">
                        <label for="rules" class="form-label">Peraturan</label>
                        <input type="text" name="rules" class="form-control" id="rules" value="{{ old('rules', $clinic->rules) }}" required>
                    </div>

                    <!-- Status Aktif -->
                    <div class="col-md-12">
                        <label for="is_active" class="form-label">Status Aktif</label>
                        <select name="is_active" class="form-control" required>
                            <option value="1" {{ $clinic->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $clinic->is_active == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <input type="hidden" name="specialist_id" value="1">

                <input type="hidden" name="unit_price" value="unit_price">

                <div class="text-center">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('clinics.list') }}" class="btn btn-light me-3">Batal</a>
                        </div>
                        <div class="col-6">
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Update</span>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Load categories on page load if a clinic is already selected
    var initialClinicId = $('#clinic_id').val();
    if (initialClinicId) {
        loadCategories(initialClinicId);
    }

    $('#clinic_id').change(function() {
        var clinicId = $(this).val();
        loadCategories(clinicId);
    });

    function loadCategories(clinicId) {
        if (clinicId) {
            $.ajax({
                url: '{{ route('get.categories.by.clinic') }}',
                type: 'GET',
                data: { clinic_id: clinicId },
                success: function(data) {
                    $('#categories_services_id').empty();
                    if (data.length > 0) {
                        $('#categories_services_id').append('<option value="">Pilih Kategori</option>');
                        $.each(data, function(key, category) {
                            var selected = category.id == {{ $clinic->categories_services_id }} ? 'selected' : '';
                            $('#categories_services_id').append('<option value="' + category.id + '" ' + selected + '>' + category.name + '</option>');
                        });
                    } else {
                        $('#categories_services_id').append('<option value="">Tidak ada kategori tersedia</option>');
                    }
                },
                error: function() {
                    $('#categories_services_id').empty().append('<option value="">Gagal memuat kategori</option>');
                }
            });
        } else {
            $('#categories_services_id').empty().append('<option value="">Pilih Kategori</option>');
        }
    }
});
</script>
