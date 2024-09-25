@extends('ekstranet.layout', ['title' => 'Daftar Rekreasi - Tambah Rekreasi ', 'url' => '#'])

@section('content-admin')

<div class="card ">
    <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
        <!--begin:Form-->
        <form id="kt_modal_new_target_form" class="form" method="post" action="{{ route('addrecreation.store') }}">
            @csrf
            <!--begin::Heading-->
            <div class="mb-13 text-center">
                <h1 class="mb-3 mt-10">Tambah Rekreasi</h1>
            </div>
            <!--end::Heading-->

            <div class="row g-9 mb-8">

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Nama Paket / Pelayanan</label>
                    <input type="text" class="form-control form-control-lg" placeholder="Nama Paket" name="name" required>
                    @error('name')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Kategori Jasa</label>
                    <select name="category_recreation_id" class="form-select" aria-label="Default select example" required>
                        @foreach ($category as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                    </select>
                    @error('category_recreation_id')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Biaya</label>
                    <input class="form-control form-control-lg" type="number" placeholder="Rp." name="price" required />
                    @error('price')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="required fs-6 fw-semibold mb-2">Durasi</label>
                    <input class="form-control form-control-lg" type="number" id="duration" name="duration" required />
                    @error('duration')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-3">
                    <label class="required fs-6 fw-semibold mb-2">Tipe Durasi</label>
                    <select class="form-select" aria-label="Default select example" name="unit_price" required>
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
                    <textarea class="form-control form-control-lg" name="description" required></textarea>
                    @error('description')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Peraturan</label>
                    <textarea class="form-control form-control-lg" name="rules" required></textarea>
                    @error('rules')
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
@endsection
