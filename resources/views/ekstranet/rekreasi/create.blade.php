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
                    <input class="form-control form-control-lg" type="text" id="harga" placeholder="Rp." name="price" required />
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
                    <select class="form-select" aria-label="Default select example" name="duration_unit" required>
                        <option value="Menit">Menit</option>
                        <option value="Jam">Jam</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="expiry_date" class="required fs-6 fw-semibold mb-2">Masa Berlaku</label>
                    <input class="form-control form-control-lg" id="expiry_date" type="number" name="expiry_date" placeholder="Masa Berlaku" required />
                    @error('expiry_date')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Tipe Masa Berlaku</label>
                    <select class="form-select" name="expiry_type" aria-label="Default select example" required>
                        <option value="Hari">Hari</option>
                        <option value="Jam">Jam</option>
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

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Status</label>
                    <div class="d-flex align-items-center mt-4">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="radio" name="is_active" id="active" value="1" checked required>
                            <label class="form-check-label fw-bold" for="active">Active</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="inactive" value="0" required>
                            <label class="form-check-label fw-bold" for="inactive">Inactive</label>
                        </div>
                    </div>
                    @error('status')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                
                <!-- Image Upload Section -->
                <div class="col-md-12 mt-4">
                    <label class="required fs-6 fw-semibold mb-2">Gambar Rekreasi</label>
                    
                    <!-- Main Image Upload -->
                    <div class="mb-4">
                        <h6>Gambar Utama</h6>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="main_image" accept="image/*">
                            <label class="input-group-text bg-primary text-white">Gambar Utama</label>
                        </div>
                    </div>
                    
                    <!-- Additional Images Upload -->
                    <div>
                        <h6>Gambar Tambahan</h6>
                        <div id="additional-images-container">
                            <div class="input-group mb-3">
                                <input type="file" class="form-control" name="additional_images[]" accept="image/*">
                                <label class="input-group-text bg-secondary text-white">Gambar Tambahan</label>
                                <button type="button" class="btn btn-danger remove-additional-image">Hapus</button>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-more-additional-images">+ Tambah Gambar Tambahan</button>
                    </div>
                </div>
            </div>

            <!--begin::Actions-->
            <div class="text-center">
                <div class="row">
                    <div class="col-6 mb-2">
                        <button type="reset" class="btn btn-light w-100" onclick="history.back()">Batal</button>
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
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Handle adding additional images
        $('#add-more-additional-images').click(function() {
            $('#additional-images-container').append(`
                <div class="input-group mb-3">
                    <input type="file" class="form-control" name="additional_images[]" accept="image/*">
                    <label class="input-group-text bg-secondary text-white">Gambar Tambahan</label>
                    <button type="button" class="btn btn-danger remove-additional-image">Hapus</button>
                </div>
            `);
        });
        
        // Handle removing additional images
        $(document).on('click', '.remove-additional-image', function() {
            // Make sure at least one additional image field remains
            if ($('#additional-images-container .input-group').length > 1) {
                $(this).closest('.input-group').remove();
            } else {
                // Clear the file input if it's the last one
                $(this).closest('.input-group').find('input[type="file"]').val('');
            }
        });

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


        $('#harga').on('input', function () {
            let input = $(this).val();
            let formatted = formatRupiah(input, 'Rp. ');
            $(this).val(formatted);
        });

        // Add submit handler to clean price
        $('#kt_modal_new_target_form').on('submit', function() {
            let hargaInput = $('#harga');
            if (hargaInput.length) {
                let cleanPrice = hargaInput.val().replace(/[^\d]/g, '');
                hargaInput.val(cleanPrice);
            }
        });
    });
</script>
@endsection
