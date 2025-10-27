@extends('ekstranet.layout', ['title' => 'Semua Health & Beauty', 'url' => ''])

@section('content-admin')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1>Daftar Health & Beauty</h1>
            <a href="{{ route('clinics.create') }}" class="btn btn-primary">Tambah Health & Beauty</a>
        </div>
        
        @if($clinics->count() > 0)
            <!--begin::Row-->
            <div class="row gy-3">
                @foreach($clinics as $clinic)
                    @php
                        $avg_rate = $clinic->avgRating();
                        $total_review = $clinic->reviews->count();
                    @endphp
                    <!--begin::Col-->
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="card">
                            <!--begin::Body-->
                            <div class="card-body my-3 py-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="fw-bold text-primary">{{ $clinic->clinic_name }}</h3>
                                        <div class="row">
                                            <div class="col-6"><h6 class="fw-medium">{{ $clinic->kota->city_name ?? 'N/A' }}</h6></div>
                                            <div class="col-6 d-flex justify-content-end">
                                                <div class="rating">
                                                    @for($i = 0; $i < 5; $i++)
                                                        <div class="rating-label {{ $i < floor($avg_rate) ? 'checked' : '' }}">
                                                            <i class="ki-duotone ki-star fs-6">
                                                                <span class="path1"></span>
                                                                <span class="path2"></span>
                                                            </i>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <p>{{ $clinic->address ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <span class="badge badge-primary badge-rounded">({{ number_format($avg_rate, 1) }} / 5.0) dari {{ $total_review }} Rating</span>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        <span class="badge badge-{{ $clinic->is_active == 1 ? 'success' : 'light text-dark' }}">{{ $clinic->is_active == 1 ? 'Live' : 'Belum Aktif' }}</span>
                                    </div>
                                    <div class="row my-3 w-100 p-0 gy-4">
                                        <div class="col-6">
                                            <a href="{{ route('partner.management.clinic.edit', $clinic->id) }}" class="btn btn-outline p-4 btn-outline btn-outline-secondary text-dark btn-active-light-secondary w-100">Profil Health & Beauty</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('partner.clinic.paket') }}?clinic_id={{ $clinic->id }}" class="btn btn-outline p-4 btn-outline btn-outline-secondary text-dark btn-active-light-secondary w-100">Paket Health & Beauty</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end:: Body-->
                        </div>
                    </div>
                    <!--end::Col-->
                @endforeach
            </div>
            <!--end::Row-->
        @else
            <div class="text-center py-5">
                <h4>Anda belum memiliki bisnis Health & Beauty</h4>
                <p>Yuk tambah bisnis Health & Beauty pertama Anda!</p>
                <a href="{{ route('clinics.create') }}" class="btn btn-primary">Tambah Health & Beauty</a>
            </div>
        @endif
    </div>
@endsection