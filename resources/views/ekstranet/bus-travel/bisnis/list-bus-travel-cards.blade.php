@extends('ekstranet.layout', ['title' => 'Semua Bisnis Bus & Travel', 'url' => '#'])

@section('content-admin')
    <div class="row gy-3">
        @foreach($bus_travels as $travel)
            @php
                // Dummy rating for now - you can implement actual rating later
                $avg_rate = 0;
                $total_review = 0;
            @endphp

            <div class="col-sm-6 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-body my-3 py-3">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="fw-bold text-primary">{{ $travel->business_name }}</h3>
                                <div class="row">
                                    <div class="col-6">
                                        <h6 class="fw-medium">{{ $travel->cityDetail->city_name ?? '-' }}</h6>
                                    </div>
                                    <div class="col-12">
                                        <p>{{ $travel->address }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <span class="badge badge-primary badge-rounded">
                                    ({{ number_format($avg_rate, 1) }} / 5.0) dari {{ $total_review }} Rating
                                </span>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <span class="badge badge-{{ $travel->is_active == 1 ? 'success' : 'light text-dark' }}">
                                    {{ $travel->is_active == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>
                            <div class="row my-3 w-100 p-0 gy-4">
                                <div class="col-6">
                                    <a href="{{ route('partner.bisnis.bus-travel.edit', $travel->id) }}"
                                       class="btn btn-primary p-4 me-2 w-100">
                                        Profil Bisnis
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('partner.daftar.bus-travel', ['business_id' => $travel->id]) }}"
                                       class="btn btn-outline p-4 btn-outline btn-outline-secondary text-dark btn-active-light-secondary w-100">
                                        Daftar Bus & Travel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        @if($bus_travels->isEmpty())
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center py-10">
                        <i class="ki-duotone ki-bus fs-5x text-muted mb-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <h3 class="text-muted">Belum Ada Bisnis Bus & Travel</h3>
                        <p class="text-muted">Silakan tambahkan bisnis bus & travel Anda terlebih dahulu</p>
                        <a href="{{ route('partner.bisnis.bus-travel.create') }}" class="btn btn-primary mt-3">
                            <i class="ki-duotone ki-plus fs-2"></i>
                            Tambah Bisnis Bus & Travel
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
