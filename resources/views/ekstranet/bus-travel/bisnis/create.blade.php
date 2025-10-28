<!-- TIDAK DIPAKAI -->

@extends('ekstranet.layout', ['title' => 'Tambah Bisnis Bus Travel', 'url' => route('partner.bisnis.bus-travel.index')])

@section('content-admin')
<div class="card">
    <div class="card-body">
        <form id="kt_modal_new_target_form" class="form" method="post"
            action="{{ route('partner.bisnis.bus-travel.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-9 mb-8">
                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Logo</label>
                    <input type="file" class="form-control" name="image" accept="image/jpeg,image/jpg,image/png" required />
                    <div class="form-text">Format yang diperbolehkan: JPG, JPEG, PNG</div>
                </div>
                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Nama Bisnis</label>
                    <input class="form-control" placeholder="Masukan nama usaha" name="business_name" required />
                </div>
                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Nomor Telpon</label>
                    <input type="number" class="form-control" placeholder="Masukan nomor telepon... " name="phone" required />
                </div>
                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Kota / Kabupaten</label>
                    <select class="form-control" name="city" required>
                        @foreach($cities as $city)
                            <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label for="" class="required form-label">Alamat</label>
                    <textarea name="address" cols="30" rows="5" class="form-control" required></textarea>
                </div>
                 <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Status</label>
                    <select class="form-control" name="is_active" required>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <a href="{{ route('partner.bisnis.bus-travel.index') }}" class="btn btn-secondary w-100">Kembali</a>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary w-100">
                        <span class="indicator-label">Simpan</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
