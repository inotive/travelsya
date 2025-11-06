@extends('ekstranet.layout', ['title' => 'Edit Bisnis Bus Travel', 'url' => route('partner.bisnis.bus-travel.index')])

@section('content-admin')
<div class="card">
    <div class="card-body">
        <form id="kt_modal_new_target_form" class="form" method="post"
            action="{{ route('partner.bisnis.bus-travel.update', $bus_travel->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row g-9 mb-8">
                <div class="col-md-12">
                    <label class="fs-6 fw-semibold mb-2">Logo</label>
                    @if($bus_travel->image)
                        <img src="{{ asset('storage/bus-travel-images/' . $bus_travel->image) }}" style="width: 130px; height: 100px; object-fit: contain;" class="mb-3">
                    @endif
                    <input type="file" class="form-control" name="image" accept="image/jpeg,image/jpg,image/png" />
                    <div class="form-text">Format yang diperbolehkan: JPG, JPEG, PNG. Kosongkan jika tidak ingin mengubah gambar.</div>
                </div>
                <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Nama Bisnis</label>
                    <input class="form-control" placeholder="Masukan nama usaha" name="business_name" value="{{ $bus_travel->business_name }}" required />
                </div>
                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Nomor Telpon</label>
                    <input type="number" class="form-control" placeholder="Masukan nomor telepon... " name="phone" value="{{ $bus_travel->phone }}" required />
                </div>
                <div class="col-md-6">
                    <label class="required fs-6 fw-semibold mb-2">Kota / Kabupaten</label>
                    <select class="form-control" name="city" required>
                        @foreach($cities as $city)
                            <option value="{{ $city->city_id }}" {{ $bus_travel->city == $city->city_id ? 'selected' : '' }}>{{ $city->city_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12">
                    <label for="" class="required form-label">Alamat</label>
                    <textarea name="address" cols="30" rows="5" class="form-control" required>{{ $bus_travel->address }}</textarea>
                </div>
                 <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Status</label>
                    <select class="form-control" name="is_active" required>
                        <option value="1" {{ $bus_travel->is_active == 1 ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ $bus_travel->is_active == 0 ? 'selected' : '' }}>Tidak Aktif</option>
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
