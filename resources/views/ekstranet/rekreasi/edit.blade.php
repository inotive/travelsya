@extends('ekstranet.layout', ['title' => 'Daftar Rekreasi - Edit Rekreasi', 'url' => '#'])

@section('content-admin')

<div class="card ">
    <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
        <!--begin:Form-->
        <form id="kt_modal_new_target_form" class="form" method="post" action="{{ route('data-rekreasi.update', $recreation->id) }}">
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
                    <input type="text" class="form-control form-control-lg" value="{{ $recreation->name }}" placeholder="Nama Paket" name="name" required>
                    @error('name')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Kategori</label>
                    <select name="category_recreation_id" class="form-select" aria-label="Default select example" required>
                        @foreach ($category as $item)
                        <option value="{{ $item->id }}" {{ $recreation->category_recreation_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="required fs-6 fw-semibold mb-2">Durasi</label>
                    <input class="form-control form-control-lg" value="{{ $recreation->duration }}" type="number" name="duration" required />
                    @error('duration')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="required fs-6 fw-semibold mb-2">Tipe Durasi</label>
                    <select class="form-select" name="unit_price" aria-label="Default select example" required>
                        <option value="Menit">Menit</option>
                        <option value="Jam">Jam</option>
                    </select>
                    @error('duration')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="fs-6 fw-semibold mb-2">Latitude (Opsional).</label>
                    <input class="form-control form-control-lg" value="{{ $recreation->lat }}" type="number" step="any" name="lat" />
                    @error('lat')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="fs-6 fw-semibold mb-2">Longitude (Opsional).</label>
                    <input class="form-control form-control-lg" value="{{ $recreation->ltd }}" type="number" step="any" name="ltd" />
                    @error('ltd')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Masa Berlaku</label>
                    <input class="form-control form-control-lg" id="expiry" type="number" name="expiry" required />
                    @error('expiry')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Tipe Durasi</label>
                    <select class="form-select" name="expiryType" aria-label="Default select example" required>
                        <option value="Hari">Hari</option>
                        <option value="Jam">Jam</option>
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Deskripsi</label>
                    <textarea class="form-control form-control-lg" name="description" required>{{ $recreation->description }}</textarea>
                    @error('description')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Peraturan</label>
                    <textarea class="form-control form-control-lg" name="rules" required>{{ $recreation->rules }}</textarea>
                    @error('rules')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Harga</label>
                    <input class="form-control form-control-lg" value="{{ $recreation->price }}" type="number" placeholder="Rp." name="price" required />
                    @error('price')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Status</label>
                    <div class="d-flex align-items-center mt-4">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="radio" name="is_active" id="active" value="1" {{ $recreation->is_active == 1 ? 'checked' : '' }} required>
                            <label class="form-check-label fw-bold" for="active">Active</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="inactive" value="0" {{ $recreation->is_active == 0 ? 'checked' : '' }} required>
                            <label class="form-check-label fw-bold" for="inactive">Inactive</label>
                        </div>
                    </div>
                    @error('status')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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


@endsection
