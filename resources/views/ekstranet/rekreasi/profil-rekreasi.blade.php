@extends('ekstranet.layout', ['title' => 'Profil Rekreasi', 'url' => '#'])

@section('content-admin')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('partner.recreation.profile.update', $recreation->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="business_name" class="form-label">Nama Bisnis</label>
                        <input type="text" class="form-control" id="business_name" name="business_name" value="{{ $recreation->business_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $recreation->phone }}">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="address" name="address" rows="3">{{ $recreation->address }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ $recreation->description }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="open" class="form-label">Jam Buka</label>
                        <input type="time" class="form-control" id="open" name="open" value="{{ $recreation->open }}">
                    </div>

                    <div class="mb-3">
                        <label for="close" class="form-label">Jam Tutup</label>
                        <input type="time" class="form-control" id="close" name="close" value="{{ $recreation->close }}">
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ $recreation->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Aktif</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
