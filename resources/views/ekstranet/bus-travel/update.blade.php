@extends('ekstranet.layout', [
    'title' => 'Beranda',
    'url' => '#',
    'subTitle' => 'Edit Data',
])

@section('content-admin')
    {{-- FORM CREATE --}}
    <div class="card ">
        <div class="card-body">
            <!--begin:Form-->
            <form action="{{ route('partner.update.bus-travel', $bus->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Bisnis Bus & Travel</label>
                        <select class="form-control" id="bus_travel_id" name="bus_travel_id">
                            <option value="">Pilih Bisnis Bus & Travel</option>
                            @foreach($bus_travel as $bt)
                                <option value="{{ $bt->id }}"  {{ old('bus_travel_id', $bus->bus_travel_id) == $bt->id ? 'selected' : '' }}>{{ $bt->business_name }}</option>
                            @endforeach
                        </select>

                        @error('bus_travel_id')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Nama</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name', $bus->name) }}"
                            placeholder="Masukkan Nama" />

                        @error('name')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Kelas</label>
                        <input class="form-control form-control-lg" id="duration" placeholder="Masukkan Kelas"
                            name="class" value="{{ old('class', $bus->class) }}" />

                        @error('class')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Status</label>
                        <select class="form-control" id="is_active" name="is_active">
                            <option value="">Pilih Status</option>
                            <option value="1" {{ old('is_active', $bus->is_active) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active', $bus->is_active) == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>

                        @error('is_active')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Jumlah Kursi</label>
                        <input class="form-control form-control-lg" id="number_seats" placeholder="Masukkan Jumlah Kursi"
                            name="number_seats" value="{{ old('number_seats', $bus->number_seats) }}" />

                        @error('number_seats')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <!-- Existing Images -->
                @if($bus->image)
                    <div class="col-md-12 mt-4">
                        <label class="fs-6 fw-semibold mb-2">Gambar Yang Sudah Ada</label>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <img src="{{ Storage::url('buses/' . $bus->image) }}" class="card-img-top" alt="Image">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="form-row">
                    <div class="form-group">
                        <label class="fs-6 fw-semibold mb-2">Gambar</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*">

                        @error('image')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <input type="hidden" value="1">
                    </div>
                </div>

                <div class="button-group">
                    <button type="reset" class="btn btn-secondary">Kembali</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('add-script')
@endpush

<style>
    .active {
        background: #007bff;
        color: white;
    }

    .breadcrumb {
        margin-bottom: 20px;
    }

    .form-container {
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 20px;
    }

    .form-row {
        display: flex;
        margin-bottom: 15px;
    }

    .form-group {
        flex: 1;
        margin-right: 15px;
    }

    .form-group:last-child {
        margin-right: 0;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    select,
    input,
    textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    textarea {
        height: 100px;
    }

    .button-group {
        text-align: right;
        margin-top: 20px;
    }

    button {
        padding: 10px 20px;
        margin-left: 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .primary {
        background: #007bff;
        color: white;
    }
</style>
