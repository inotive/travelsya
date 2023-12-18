@extends('layouts.web')

@section('content-web')
    <!--begin::Container-->
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid mb-10" id="kt_content">
            <form action="{{ route('hotels.request', $hotelRoom->id) }}" class="d-flex flex-column"
                  method="post">
                @csrf
                <div class="row w-75 me-auto ms-auto mt-10">
                    <div class="col-7">
                        <div class="card">

                            <div class="card-header">
                                <h2 class="card-title fw-bold">Detail Pesanan</h2>
                            </div>
                            <div class="card-body">
                                {{-- @if (session()->get('user') != null)
                                <div class="">
                                    <label class="form-label fw-bold fs-6">Nama Lengkap</label>
                                    <input type="name" class="form-control"
                                        value="{{ session()->get('user')['data']['name'] }}">
                                </div>
                                <div class="mt-10">
                                    <label class="form-label fw-bold fs-6">Email Address</label>
                                    <input type="email" class="form-control"
                                        value="{{ session()->get('user')['data']['email'] }}">
                                </div>
                                <div class="mt-10">
                                    <label class="form-label fw-bold fs-6">Nomor Telepon</label>
                                    <input type="phone" class="form-control"
                                        value="{{ session()->get('user')['data']['phone'] }}">
                                </div>
                                @else
                                <div class="align-self-center">
                                    <a href="{{ route('login') }}">Login First</a>
                                </div>
                                @endif --}}

                                @auth
                                    <div class="">
                                        <label class="form-label fw-bold fs-6">Nama Lengkap</label>
                                        <input type="name" class="form-control" value="{{ Auth()->user()->name }}"
                                               name="nama_lengkap">
                                    </div>
                                    <div class="mt-10">
                                        <label class="form-label fw-bold fs-6">Email Address</label>
                                        <input type="email" class="form-control" value="{{ Auth()->user()->email }}"
                                               name="email">
                                    </div>
                                    <div class="mt-10">
                                        <label class="form-label fw-bold fs-6">Nomor Telepon</label>
                                        <input type="phone" class="form-control" value="{{ Auth()->user()->phone }}"
                                               name="no_telfon">
                                    </div>
                                @endauth

                                @guest
                                    <div class="align-self-center">
                                        <a href="{{ route('login') }}">Login First</a>
                                    </div>
                                @endguest
                            </div>

                        </div>
                    </div>
                    <div class="col-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12">
                                        <h3 class="fw-bold card-title">{{ $hotelRoom->hotel->name }}</h3>
                                    </div>
                                    <div class="col-12">
                                        <span class="">{{ $hotelRoom->hotel->address }}</span>
                                        @for ($j = 0; $j < $hotelRoom->hotel->rating_avg; $j++)
                                            <span class="card-text fa fa-star mt-3" style="color: orange;">
                                    </span>
                                        @endfor
                                    </div>
                                    @php
                                        $checkin = \Carbon\Carbon::parse($params['start']);
                                        $duration = $params['duration'];

                                        // Hitung tanggal checkout
                                        $checkout = $checkin->copy()->addDays($duration);
                                    @endphp
                                    <div class="col-12">
                                        <div class="bg-light rounded-2 mt-3 p-4">
                                            <i class="fa fa-calendar me-3"></i>
                                            {{-- {{ date('d M', $params['start']) }} -
                                            {{ date('d M', strtotime($params['start'])) }} --}}
                                            {{ date('d M', strtotime($params['start'])) }} -
                                            {{ $checkout->format('d M') }}
                                            {{ date('Y', strtotime($params['start'])) }} ({{ $params['duration'] }}
                                            Malam)
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <span>Tipe Kamar : </span>
                                        <span class="fw-bold mt-2">{{ $hotelRoom->name }}</span>
                                    </div>
                                    <div class="col-12">
                                        <div class="badge badge-success rounded-2 mt-3 p-4">
                                            Anda Memesan {{ $params['room'] }} Kamar, {{ $params['guest'] }} Tamu
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row gy-3">
                                    <div class="col-12 d-flex justify-content-between">
                                        <p>Biaya Kamar ({{ $params['room'] }} Kamar)</p>
                                        <h5>
                                            {{ General::rp($hotelRoom->sellingprice * $params['duration'] * $params['room']) }}
                                        </h5>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <p>Fee Admin</p>
                                        <h5>
                                            {{ General::rp($feeAdmin) }}
                                        </h5>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <p>Kode Unik</p>
                                        <h5>
                                            {{ General::rp($uniqueCode) }}
                                        </h5>
                                    </div>
                                    <div class="col-12 d-flex justify-content-between">
                                        <p>Grand Total</p>
                                        <h4>
                                            {{ General::rp($grandTotal) }}
                                        </h4>
                                    </div>
                                    {{-- <div class="col-12 d-flex justify-content-between">--}}
                                    {{-- <p>Extra Bed (0 Kasur)</p>--}}
                                    {{-- <h4>Rp. {{ $hotelRoom->extrabedprice ?? 0 }}</h4>--}}
                                    {{-- </div>--}}
                                    <div class="col-12">

                                        <input type="hidden" name="service" value="hotel">
                                        <input type="hidden" name="payment_method" value="xendit">
                                        <input type="hidden" name="hotel_id" value="{{ $hotelRoom->hotel->id }}">
                                        <input type="hidden" name="hostel_room_id" value="{{ $hotelRoom->id }}">
                                        {{-- <input type="hidden" name="start"
                                            value="{{ date('Y-m-d', $params['start']) }}"> --}}
                                        {{-- <input type="hidden" name="end"
                                            value="{{ date('Y-m-d', strtotime($params['start'])) }}">
                                        <input type="hidden" name="end"
                                            value="{{ date('Y-m-d', strtotime($params['start'])) }}">
                                        <input type="hidden" name="name"
                                            value="{{ session()->get('user') != null ? session()->get('user')['data']['name'] : '' }}">
                                        --}}
                                        <input type="hidden" name="start" value="{{ $params['start'] }}">
                                        <input type="hidden" name="end" value="{{ $checkout->format('d-m-Y') }}">
                                        <input type="hidden" name="name" value="{{ Auth()->user()->name }}">
                                        <input type="hidden" name="point" value="{{ $point }}">
                                        <input type="hidden" name="room" value="{{ $params['room'] }}">
                                        <input type="hidden" name="total_guest" value="{{ $params['guest'] }}">
                                        <input type="hidden" name="uniqueCode" value="{{ $uniqueCode }}">
                                        <button class="btn btn-lg w-100 text-white" style="background-color: #c02425">
                                            Lanjut Pembayaran
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--end::Post-->
    </div>
    <!--end::Container-->
@endsection

@push('add-style')
    <style>
        body {
            background-size: 100% 80px !important;
        }

        .card-hostel:hover {
            border: 1px solid #D9214E;
            cursor: pointer;
        }
    </style>
@endpush
