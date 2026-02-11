@extends('ekstranet.layout', ['title' => 'Semua Rental Mobil', 'url' => '#'])

@section('content-admin')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1>Daftar Rental Mobil</h1>
        </div>
        
        @if($carRentals->count() > 0)
            <!--begin::Row-->
            <div class="row gy-3">
                @foreach($carRentals as $carRental)
                    @php
                        $avg_rate = $carRental->avgRating();
                        $total_review = $carRental->reviews->count();
                    @endphp
                    <!--begin::Col-->
                    <div class="col-sm-6 col-md-6 col-lg-6">
                        <div class="card">
                            <!--begin::Body-->
                            <div class="card-body my-3 py-3">
                                <div class="row">
                                    <div class="col-12">
                                        <h3 class="fw-bold text-primary">{{ $carRental->business_name }}</h3>
                                        <div class="row">
                                            <div class="col-6"><h6 class="fw-medium">{{ $carRental->kota ? $carRental->kota->city_name : 'N/A' }}</h6></div>
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
                                                <p>{{ $carRental->address ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <span class="badge badge-primary badge-rounded">({{ number_format($avg_rate, 1) }} / 5.0) dari {{ $total_review }} Rating</span>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end">
                                        <span class="badge badge-{{ $carRental->is_active == 1 ? 'success' : 'light text-dark' }}">{{ $carRental->is_active == 1 ? 'Live' : 'Belum Aktif' }}</span>
                                    </div>
                                    <div class="row my-3 w-100 p-0 gy-4">
                                        <div class="col-6">
                                            <a href="{{ route('partner.car_rental.profile', $carRental->id) }}" class="btn btn-outline p-4 btn-outline btn-outline-secondary text-dark btn-active-light-secondary w-100">Profil Rental Mobil</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="{{ route('partner.daftar.kendaraan') }}?business_id={{ $carRental->id }}" class="btn btn-outline p-4 btn-outline btn-outline-secondary text-dark btn-active-light-secondary w-100">Daftar Kendaraan</a>
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
                <h4>Anda belum memiliki bisnis Rental Mobil</h4>
                <p>Yuk tambah bisnis Rental Mobil pertama Anda!</p>
                <a href="#" class="btn btn-primary">Tambah Rental Mobil</a>
            </div>
        @endif
    </div>
@endsection
