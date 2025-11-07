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
                        <label for="kebijakan_rental_mobil" class="form-label">Kebijakan Rental Mobil</label>
                        <textarea class="form-control" id="kebijakan_rental_mobil" name="kebijakan_rental_mobil" rows="3">{{ $carRental->kebijakan_rental_mobil }}</textarea>
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ $carRental->is_active ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_active">Aktif</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
