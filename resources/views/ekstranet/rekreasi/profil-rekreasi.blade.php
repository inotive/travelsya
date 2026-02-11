@extends('ekstranet.layout', ['title' => 'Profil Rekreasi', 'url' => '#'])

@section('content-admin')
    <div class="container">
        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form action="{{ route('partner.recreation.profile.update', $recreation->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama Bisnis --}}
                    <div class="mb-3">
                        <label for="business_name" class="form-label">Nama Bisnis</label>
                        <input type="text" class="form-control" id="business_name" name="business_name" value="{{ old('business_name', $recreation->business_name) }}">
                    </div>

                    {{-- Telepon --}}
                    <div class="mb-3">
                        <label for="phone" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $recreation->phone) }}">
                    </div>

                    {{-- Latitude & Longitude --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="latitude" class="form-label">Latitude</label>
                                <input type="text" class="form-control" id="latitude" name="lat" value="{{ old('lat', $recreation->lat ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="longitude" class="form-label">Longitude</label>
                                <input type="text" class="form-control" id="longitude" name="ltd" value="{{ old('ltd', $recreation->ltd ?? '') }}">
                            </div>
                        </div>
                    </div>

                    {{-- Kota / Kabupaten --}}
                    <div class="mb-3">
                        <label for="city" class="form-label">Kota / Kabupaten</label>
                        <select class="form-select" id="city" name="city">
                            <option selected disabled>Pilih Kota/Kabupaten</option>
                            @if(isset($cities))
                                @foreach($cities as $city)
                                    <option value="{{ $city->city_id }}" {{ old('city', $recreation->city) == $city->city_id ? 'selected' : '' }}>{{ $city->city_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    {{-- Kategori --}}
                    <div class="mb-3">
                        <label for="category_recreation_id" class="form-label">Kategori</label>
                        <select class="form-select" id="category_recreation_id" name="category_recreation_id">
                            <option selected disabled>Pilih Kategori</option>
                            @if(isset($categories))
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_recreation_id', $recreation->category_recreation_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    {{-- Gambar --}}
                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar Utama</label>
                        <input class="form-control" type="file" id="image" name="image">
                        <div class="form-text">Unggah gambar baru untuk mengganti gambar utama.</div>
                        @if($recreation->image)
                            <div class="mt-2">
                                <p>Gambar saat ini:</p>
                                <img src="{{ Storage::url($recreation->image->image) }}" alt="Gambar Rekreasi" style="max-width: 200px; border-radius: 8px;">
                            </div>
                        @endif
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="address" name="address" rows="3">{{ old('address', $recreation->address) }}</textarea>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $recreation->description) }}</textarea>
                    </div>

                    {{-- Jam Buka & Tutup --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="open" class="form-label">Jam Buka</label>
                                <input type="time" class="form-control" id="open" name="open" value="{{ old('open', $recreation->open) }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="close" class="form-label">Jam Tutup</label>
                                <input type="time" class="form-control" id="close" name="close" value="{{ old('close', $recreation->close) }}">
                            </div>
                        </div>
                    </div>

                    {{-- Status Aktif --}}
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', $recreation->is_active) ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Aktif</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
@endsection

