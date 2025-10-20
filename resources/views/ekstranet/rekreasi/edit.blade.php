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

                <!-- Display Validation Errors -->
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Nama Paket</label>
                    <input type="text" class="form-control form-control-lg" value="{{ old('name', $recreation_has_packages->name) }}" placeholder="Nama Paket" name="name" required>
                    @error('name')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Harga</label>
                    <input class="form-control form-control-lg" value="{{ old('price', $recreation_has_packages->price) }}" type="text" id="harga" placeholder="Rp." name="price" required />
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
                                @if(old('recreation_id', $recreation_has_packages->recreation_id) == $recreation->id) selected @endif>
                                {{ $recreation->business_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Durasi</label>
                    <input class="form-control form-control-lg" value="{{ old('duration', $recreation_has_packages->duration) }}" type="number" name="duration" required />
                    @error('duration')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Tipe Durasi</label>
                    <select class="form-select" name="duration_unit" aria-label="Default select example" required>
                        <option value="Menit" {{ old('duration_unit', $recreation_has_packages->duration_unit) == 'Menit' ? 'selected' : '' }}>Menit</option>
                        <option value="Jam" {{ old('duration_unit', $recreation_has_packages->duration_unit) == 'Jam' ? 'selected' : '' }}>Jam</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Masa Berlaku</label>
                    <input class="form-control form-control-lg" id="expiry" type="number" value="{{ old('expiry_date', $recreation_has_packages->expiry_date) }}" name="expiry_date" required />
                    @error('expiry_date')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Tipe Masa Berlaku</label>
                    <select class="form-select" name="expiry_type" aria-label="Default select example" required>
                        <option value="Hari" {{ old('expiry_type', $recreation_has_packages->expiry_type) == 'Hari' ? 'selected' : '' }}>Hari</option>
                        <option value="Jam" {{ old('expiry_type', $recreation_has_packages->expiry_type) == 'Jam' ? 'selected' : '' }}>Jam</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Deskripsi</label>
                    <textarea class="form-control form-control-lg" name="description" required>{{ old('description', $recreation_has_packages->description) }}</textarea>
                    @error('description')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Peraturan</label>
                    <textarea class="form-control form-control-lg" name="rules" required>{{ old('rules', $recreation_has_packages->rules) }}</textarea>
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
                            <input class="form-check-input" type="radio" name="is_active" id="active" value="1" {{ old('is_active', $recreation_has_packages->is_active) == 1 ? 'checked' : '' }} required>
                            <label class="form-check-label fw-bold" for="active">Active</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="inactive" value="0" {{ old('is_active', $recreation_has_packages->is_active) == 0 ? 'checked' : '' }} required>
                            <label class="form-check-label fw-bold" for="inactive">Inactive</label>
                        </div>
                    </div>
                    @error('status')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <!-- Kelola Gambar -->
                <div class="col-md-12 mt-4">
                    <label class="fs-6 fw-semibold mb-2">Kelola Gambar</label>

                    @php
                        $mainImage = $recreation_has_packages->images->firstWhere('main', 1);
                        $additionalImages = $recreation_has_packages->images->where('main', 0);
                    @endphp

                    <!-- Main Image Section -->
                    <div class="mb-5 p-4 border rounded">
                        <h6 class="mb-3">Gambar Utama</h6>
                        @if($mainImage)
                            <div class="row">
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="card h-100">
                                        <img src="{{ asset('storage/' . $mainImage->image) }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="Gambar Utama" onerror="this.src='{{ asset('images/not_found.jpg') }}';">
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
                                            <img src="{{ asset('storage/' . $image->image) }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="Image" onerror="this.src='{{ asset('images/not_found.jpg') }}';">
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
                let hargaInput = document.getElementById('harga');
                if (hargaInput) {
                    // Remove formatting characters (Rp., commas, dots) to get clean number
                    let cleanPrice = hargaInput.value.replace(/[^\d]/g, '');
                    hargaInput.value = cleanPrice;
                }
                document.getElementById('kt_modal_new_target_form').submit();
            } else {
                // Re-enable button if cancelled
                submitButton.disabled = false;
                indicatorLabel.style.display = 'inline-block';
                indicatorProgress.style.display = 'none';
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
                    $('#kt_modal_new_target_form').append(`<input type="hidden" name="deleted_images[]" value="${imageId}">`);
                    // Remove the card from UI
                    imageCard.remove();
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
