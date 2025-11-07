@extends('ekstranet.layout', ['title' => 'Detail Profil Health & Beauty', 'url' => route('partner.management.clinic')])

@section('content-admin')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h4>{{ $clinic->clinic_name }}</h4>
                        <p><strong>Kategori:</strong> {{ $clinic->category }}</p>
                        <p><strong>Kota:</strong> {{ $clinic->kota->city_name ?? 'N/A' }}</p>
                        <p><strong>Alamat:</strong> {{ $clinic->address }}</p>
                        <p><strong>Telepon:</strong> {{ $clinic->phone }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Jam Buka:</strong> {{ \Carbon\Carbon::parse($clinic->open_time)->format('H:i') }}</p>
                        <p><strong>Jam Tutup:</strong> {{ \Carbon\Carbon::parse($clinic->close_time)->format('H:i') }}</p>
                        <p><strong>Status:</strong> 
                            <span class="badge {{ $clinic->is_active ? 'bg-success' : 'bg-danger' }}">
                                {{ $clinic->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </p>
                        <p><strong>Dibuat:</strong> {{ $clinic->created_at->format('d M Y H:i') }}</p>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h5>Deskripsi</h5>
                    <p>{{ $clinic->description }}</p>
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <a href="{{ route('partner.management.clinic') }}" class="btn btn-secondary">Kembali</a>
                    <a href="{{ route('partner.management.clinic.edit', $clinic->id) }}" class="btn btn-primary">Edit Profil</a>
                </div>
            </div>
        </div>
    </div>
@endsection