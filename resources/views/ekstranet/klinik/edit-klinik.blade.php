@extends('ekstranet.layout', ['title' => 'Edit Jasa Klinik', 'url' => ''])

@section('content-admin')
<div class="container">
    <div class="card">
        <div class="card-body">
            <form id="clinic-form" action="{{ route('clinics.update', $clinic->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Tambahkan metode PUT untuk update -->
                
                <div class="mb-13 text-center">
                    <h1 class="mb-3">Edit Jasa Kecantikan</h1>
                </div>

                <div class="row g-9 mb-8">
                    <!-- Clinic ID -->
                    <input type="hidden" name="clinic_id" value="{{ $clinic->clinic_id }}">

                    <!-- Nama Klinik -->
                    <div class="col-md-4">
                        <label for="name" class="form-label">Nama Klinik</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $clinic->name) }}" required>
                    </div>

                    <!-- Spesialis -->
                    <div class="col-md-4">
                        <label for="specialist_id" class="form-label">Spesialis</label>
                        <select name="specialist_id" class="form-control" required>
                            @foreach ($spesialis as $specialist)
                                <option value="{{ $specialist->id }}" {{ $clinic->specialist_id == $specialist->id ? 'selected' : '' }}>
                                    {{ $specialist->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Kategori Layanan -->
                    <div class="col-md-4">
                        <label for="categories_services_id" class="form-label">Kategori Layanan</label>
                        <select name="categories_services_id" class="form-control" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $clinic->categories_services_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Rules -->
                    <div class="col-md-6">
                        <label for="rules" class="form-label">Peraturan</label>
                        <input type="text" name="rules" class="form-control" id="rules" value="{{ old('rules', $clinic->rules) }}" required>
                    </div>

                    <!-- Durasi -->
                    <div class="col-md-6">
                        <label for="duration" class="form-label">Durasi </label>
                        <input type="text" class="form-control" id="duration" name="duration" value="{{ old('duration', $clinic->duration) }}" required>
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" id="description" rows="3" required>{{ old('description', $clinic->description) }}</textarea>
                    </div>

                    <!-- Tanggal Kadaluarsa -->
                    <div class="col-md-6">
                        <label for="expiry_date" class="form-label">Tanggal Kadaluarsa</label>
                        <input type="date" class="form-control" id="expiry_date" name="expiry_date" value="{{ old('expiry_date', $clinic->expiry_date) }}" required>
                    </div>

                    <!-- Unit Harga -->
                    <div class="col-md-6">
                        <label for="unit_price" class="form-label">Unit Harga</label>
                        <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ old('unit_price', $clinic->unit_price) }}" required>
                    </div>

                    <!-- Harga -->
                    <div class="col-md-6">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" class="form-control" id="price" name="price" value="{{ old('price', $clinic->price) }}" required>
                    </div>

                    <!-- Status Aktif -->
                    <div class="col-md-6">
                        <label for="is_active" class="form-label">Status Aktif</label>
                        <select name="is_active" class="form-control" required>
                            <option value="1" {{ $clinic->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ $clinic->is_active == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="text-center">
                    <div class="row">
                        <div class="col-6">
                            <a href="{{ route('clinics.index') }}" class="btn btn-light me-3">Cancel</a>
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
