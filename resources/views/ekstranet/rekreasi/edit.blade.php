@extends('ekstranet.layout', ['title' => 'Daftar Rekreasi - Edit Rekreasi', 'url' => '#'])

@section('content-admin')

<div class="card ">
    <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
        <!--begin:Form-->
        <form id="kt_modal_new_target_form" class="form" method="post" action="{{ route('data-rekreasi.update', $recreation_has_packages->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!--begin::Heading-->
            <div class="mb-13 text-center">
                <h1 class="mb-3 mt-10">Edit Rekreasi</h1>
            </div>
            <!--end::Heading-->

            <div class="row g-9 mb-8">

                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Nama Paket</label>
                    <input type="text" class="form-control form-control-lg" value="{{ $recreation_has_packages->name }}" placeholder="Nama Paket" name="name" required>
                    @error('name')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Harga</label>
                    <input class="form-control form-control-lg" value="@currency($recreation_has_packages->price)" type="text" id="harga" placeholder="Rp." name="price" required />
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
                            <option value="{{ $recreation->id }}"
                                @if($recreation_has_packages->recreation_id == $recreation->id) selected @endif>
                                {{ $recreation->business_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Durasi</label>
                    <input class="form-control form-control-lg" value="{{ $recreation_has_packages->duration }}" type="number" name="duration" required />
                    @error('duration')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Tipe Durasi</label>
                    <select class="form-select" name="unit_price" aria-label="Default select example" required>
                        <option value="Menit">Menit</option>
                        <option value="Jam">Jam</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Masa Berlaku</label>
                    <input class="form-control form-control-lg" id="expiry" type="number" value="{{ $recreation_has_packages->expiry_date }}" name="expiry" required />
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
                    <textarea class="form-control form-control-lg" name="description" required>{{ $recreation_has_packages->description }}</textarea>
                    @error('description')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Peraturan</label>
                    <textarea class="form-control form-control-lg" name="rules" required>{{ $recreation_has_packages->rules }}</textarea>
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
                            <input class="form-check-input" type="radio" name="is_active" id="active" value="1" {{ $recreation_has_packages->is_active == 1 ? 'checked' : '' }} required>
                            <label class="form-check-label fw-bold" for="active">Active</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="inactive" value="0" {{ $recreation_has_packages->is_active == 0 ? 'checked' : '' }} required>
                            <label class="form-check-label fw-bold" for="inactive">Inactive</label>
                        </div>
                    </div>
                    @error('status')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Existing Images -->
                @if(isset($recreation_has_packages->images) && count($recreation_has_packages->images) > 0)
                <div class="col-md-12 mt-4">
                    <label class="fs-6 fw-semibold mb-2">Gambar Yang Sudah Ada</label>
                    <div class="row">
                        @foreach($recreation_has_packages->images as $image)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="{{ $image->image }}" class="card-img-top" alt="Image">
                                <div class="card-body text-center">
                                    @if($image->main == 1)
                                        <span class="badge bg-primary">Gambar Utama</span>
                                    @else
                                        <span class="badge bg-secondary">Gambar Tambahan</span>
                                    @endif
                                    <!-- Hidden input to track existing images -->
                                    <input type="hidden" name="existing_images[]" value="{{ $image->id }}">
                                    <!-- Delete button for existing images -->
                                    <button type="button" class="btn btn-sm btn-danger mt-2 delete-existing-image" data-image-id="{{ $image->id }}">Hapus</button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Image Upload Section -->
                <div class="col-md-12 mt-4">
                    <label class="fs-6 fw-semibold mb-2">Tambah Gambar Baru</label>
                    
                    <!-- Main Image Upload -->
                    <div class="mb-4">
                        <h6>Gambar Utama</h6>
                        <div class="input-group mb-3">
                            <input type="file" class="form-control" name="main_image" accept="image/*">
                            <label class="input-group-text bg-primary text-white">Gambar Utama</label>
                        </div>
                        <div class="form-text">Mengunggah gambar utama baru akan menggantikan gambar utama lama.</div>
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
<script>
    document.getElementById('kt_modal_new_target_submit').addEventListener('click', function(event) {
        event.preventDefault();

        Swal.fire({
            title: "Apa kamu yakin ingin menyimpan perubahan?"
            , icon: "question"
            , showCancelButton: true
            , cancelButtonText: `Tidak jadi`
            , cancelButtonColor: '#d33'
            , confirmButtonText: "Ya"
            , confirmButtonColor: '#3085d6'
            , reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('kt_modal_new_target_form').submit();
            }
        });
    });

</script>

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
        
        // Handle deleting existing images
        $(document).on('click', '.delete-existing-image', function() {
            const imageId = $(this).data('image-id');
            const card = $(this).closest('.col-md-3');
            
            Swal.fire({
                title: "Apakah kamu yakin ingin menghapus gambar ini?",
                icon: "warning",
                showCancelButton: true,
                cancelButtonText: "Batal",
                confirmButtonText: "Ya, Hapus",
                confirmButtonColor: '#d33',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Add hidden input to mark image for deletion
                    $('#kt_modal_new_target_form').append(`<input type="hidden" name="deleted_images[]" value="${imageId}">`);
                    // Remove the card from UI
                    card.remove();
                }
            });
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
    });
</script>

@endsection
