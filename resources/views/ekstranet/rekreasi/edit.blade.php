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
                <h1 class="mb-3 mt-10">Tambah Rekreasi</h1>
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
                    <input class="form-control form-control-lg" value="{{ $recreation_has_packages->price }}" type="number" placeholder="Rp." name="price" required />
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
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top" alt="Image">
                                <div class="card-body text-center">
                                    @if($image->main == 1)
                                        <span class="badge bg-primary">Gambar Utama</span>
                                    @else
                                        <span class="badge bg-secondary">Gambar Tambahan</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Multiple Image Upload -->
                <div class="col-md-12 mt-4">
                    <label class="fs-6 fw-semibold mb-2">Tambah Gambar Baru</label>
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" name="images[]" accept="image/*">
                        <input type="hidden" name="main_image[]" value="1">
                        <label class="input-group-text bg-primary text-white">Gambar Utama</label>
                    </div>
                    <div id="additional-images"></div>
                    <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-more-images">+ Tambah Gambar</button>
                    <div class="form-text">Unggah gambar baru akan menambahkan ke gambar yang sudah ada. Gambar utama baru akan menggantikan gambar utama lama.</div>
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
