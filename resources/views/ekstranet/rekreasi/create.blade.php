@extends('ekstranet.layout', ['title' => 'Daftar Rekreasi - Tambah Rekreasi ', 'url' => '#'])

@section('content-admin')
<div class="container">
    <div class="card">
        <div class="card-body">
            <!--begin:Form-->
            <form id="kt_modal_new_target_form" class="form" method="post" action="{{ route('addrecreation.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-9 mb-8">

                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Nama Paket / Pelayanan</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Nama Paket" name="name" required>
                    @error('name')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Harga</label>
                    <input class="form-control form-control-lg" type="number" placeholder="Rp." name="price" required />
                    @error('price')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label for="recreation_id" class="required fs-6 fw-semibold mb-2">Pilih Bisnis</label>
                    <select name="recreation_id" id="recreation_id" class="form-control form-control-lg" required>
                        <option value="">Pilih Bisnis</option>
                        @foreach($recreations as $recreation)
                            <option value="{{ $recreation->id }}">{{ $recreation->business_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Durasi</label>
                    <input class="form-control form-control-lg" type="number" id="duration" name="duration" placeholder="Durasi" required />
                    @error('duration')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Tipe Durasi</label>
                    <select class="form-select" aria-label="Default select example" name="unit_price" required>
                        <option value="Menit">Menit</option>
                        <option value="Jam">Jam</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Masa Berlaku</label>
                    <input class="form-control form-control-lg" id="expiry" type="number" name="expiry" placeholder="Masa Berlaku" required />
                    @error('expiry')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Tipe Durasi</label>
                    <select class="form-select" name="expiry_type" aria-label="Default select example" required>
                        @foreach ($expiryTypes as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Deskripsi</label>
                    <textarea class="form-control form-control-lg" name="description" placeholder="Deskripsi" required></textarea>
                    @error('description')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Peraturan</label>
                    <textarea class="form-control form-control-lg" placeholder="Peraturan" name="rules" required></textarea>
                    @error('rules')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <!-- Multiple Image Upload -->
                <div class="col-md-12 mt-4">
                    <label class="required fs-6 fw-semibold mb-2">Gambar Rekreasi</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="images[]" accept="image/*" required>
                        <input type="hidden" name="main_image[]" value="1">
                        <label class="input-group-text bg-primary text-white">Gambar Utama</label>
                    </div>
                    <div id="additional-images"></div>
                    <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-more-images">+ Tambah Gambar</button>
                </div>
            </div>

            <!--begin::Actions-->
            <div class="text-center">
                <div class="row">
                    <div class="col-6 mb-2">
                        <button type="reset" class="btn btn-light w-100" onclick="history.back()">Cancel</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
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
</script>
@endsection
