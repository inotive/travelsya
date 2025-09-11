@extends('ekstranet.layout', [
    'title' => 'Beranda',
    'url' => '#',
    'subTitle' => 'Tambah Data',
])

@section('content-admin')
    {{-- FORM CREATE --}}
    <div class="card ">
        <div class="card-body">
            <!--begin:Form-->
            <form action="{{ route('partner.store.bus-travel') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-row">
                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Bisnis Bus & Travel</label>
                        <select class="form-control" id="bus_travel_id" name="bus_travel_id">
                            <option value="">Pilih Bisnis Bus & Travel</option>
                            @foreach($bus_travel as $bt)
                                <option value="{{ $bt->id }}"  {{ old('bus_travel_id') == $bt->id ? 'selected' : '' }}>{{ $bt->business_name }}</option>
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
                        <input type="text" class="form-control form-control-lg" id="name" name="name" value="{{ old('name') }}"
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
                            name="class" value="{{ old('class') }}" />

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
                            <option value="1" {{ old('is_active') == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>

                        @error('is_active')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="required fs-6 fw-semibold mb-2">Jumlah Kursi</label>
                        <input type="number" class="form-control form-control-lg" id="number_seats" placeholder="Masukkan Jumlah Kursi"
                            name="number_seats" value="{{ old('number_seats') }}" />

                        @error('number_seats')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="fs-6 fw-semibold mb-2">Gambar</label>
                        <input
                            type="file"
                            class="form-control"
                            id="images"
                            name="images[]"
                            accept="image/*"
                            multiple>

                        @error('image')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label class="fs-6 fw-semibold mb-2">Fasilitas Bus</label>
                    <div class="row">
                        @foreach ($facilities as $facility)
                            <div class="col-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="facilities[]"
                                        value="{{ $facility->id }}" id="facility{{ $facility->id }}">
                                    <label class="form-check-label" for="facility{{ $facility->id }}">
                                        {{ $facility->name }}
                                    </label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @error('facilities')
                        <span class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <br>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Peraturan atau Ketentuan</label>
                    <textarea class="form-control" id="tos" name="tos" rows="3" placeholder="Masukkan Peraturan atau Ketentuan"></textarea>
                </div>

                <div class="row mt-5">
                    <div class="col">
                        <input
                            id="backButton"
                            class="btn btn-secondary"
                            action="action"
                            onclick="window.history.go(-1); return false;"
                            type="button"
                            value="Kembali"
                        />
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                    </div>
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

<script>
      document.getElementById('backButton').addEventListener('click', function() {
        window.history.back();
      });
</script>
