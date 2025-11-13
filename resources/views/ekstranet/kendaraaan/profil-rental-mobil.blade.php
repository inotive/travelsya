@extends('ekstranet.layout', ['title' => 'Profil Rental Mobil', 'url' => '#'])

@section('content-admin')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('partner.car_rental.profile.update', $carRental->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="business_name" class="form-label">Nama Bisnis</label>
                        <input type="text" class="form-control" id="business_name" name="business_name" value="{{ $carRental->business_name }}">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Telepon</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ $carRental->phone }}">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" id="address" name="address" rows="3">{{ $carRental->address }}</textarea>
                    </div>

                    <div class="mb-3">
                        <label for="city" class="form-label">Kota / Kabupaten</label>
                        <select class="form-select" id="city" name="city">
                            <option selected disabled>Pilih Kota/Kabupaten</option>
                            @if(isset($cities))
                                @foreach($cities as $city)
                                    <option value="{{ $city->city_id }}" {{ old('city', $carRental->city) == $city->city_id ? 'selected' : '' }}>{{ $city->city_name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="kebijakan_rental_mobil" class="form-label">Kebijakan Rental Mobil</label>
                        <textarea class="form-control" id="kebijakan_rental_mobil" name="kebijakan_rental_mobil" rows="3">{{ $carRental->kebijakan_rental_mobil }}</textarea>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ $carRental->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Aktif</label>
                    </div>

                    <div class="d-flex">
                        <a href="{{ route('partner.car_rental.all') }}" class="btn btn-secondary me-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
