@extends('layouts.web')

@section('title', 'Ruangan Pribadi')

@section('content-web')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">

    <!--begin::Post-->
    <div class="content flex-row-fluid mb-10" id="kt_content">
        <div class="row justify-content-between">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body d-flex flex-column">
                        @auth
                        <div class="">
                            <label class="form-label fw-bold fs-6">Nama Lengkap</label>
                            <input type="name" class="form-control" value="{{ Auth()->user()->name }}">
                        </div>
                        <div class="mt-10">
                            <label class="form-label fw-bold fs-6">Email Address</label>
                            <input type="email" class="form-control" value="{{ Auth()->user()->email }}">
                        </div>
                        <div class="mt-10">
                            <label class="form-label fw-bold fs-6">Nomor Telepon</label>
                            <input type="phone" class="form-control" value="{{ Auth()->user()->phone }}">
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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-gray-900">{{ $hostelRoom->hostel->name }}</h4>
                        <p class="card-text mt-1 text-gray-500">{{ $hostelRoom->hostel->address }}</p>
                        <div>
                            @for ($j = 1; $j < $hostelRoom->hostel->star; $j++)
                                <span class="card-text fa fa-star" style="color: orange;"></span>
                                @endfor
                        </div>

                        @php
                        $checkin = \Carbon\Carbon::parse($params['start']);
                        $duration = $params['duration'];
                        $checkout = $checkin->copy()->addMonths($duration);

                        if($params['category'] == 'monthly') {
                        $sellingprice = $hostelRoom->sellingrentprice_monthly;
                        }

                        if($params['category'] == 'yearly') {
                        $sellingprice = $hostelRoom->sellingrentprice_yearly;
                        }
                        @endphp

                        <p class="card-text mt-4 text-gray-500"><span class="fa fa-calendar me-3"></span>
                            {{ date('d-m-Y', strtotime($params['start'])) }} - {{ $checkout->format('d-m-Y') }}
                            ({{ $params['duration'] }} Bulan)</p>
                        <p class="card-text mt-1 text-gray-500">Room : {{ $hostelRoom->name }} (Maks
                            {{ $hostelRoom->max_guest }} Tamu)</p>

                        {{-- @if ($params['guest'] > $hostelRoom->guest)
                        <p class="card-text mt-1 text-gray-500">Ekstrabed :
                            {{ (int) $params['guest'] - (int) $hostelRoom->guest }} Bed</p>
                        @endif --}}

                        {{-- <p class="card-text mt-1 text-gray-500">Anda memesan {{ $params['room'] }} Ruangan</p> --}}

                        <hr>

                        <table>
                            <tr>
                                <td>Room Price ({{ $params['duration'] }} Bulan) : </td>
                                <td>{{ General::rp($params['duration'] * (int) $sellingprice) }}</td>
                            </tr>
                            <tr>
                                <td>Extrabed :</td>
                                <td>{{ General::rp($params['duration'] * (int) $hostelRoom->extrabedprice) }}</td>
                            </tr>
                            <tr>
                                @php
                                $grandTotal = $params['duration'] * (int) $hostelRoom->extrabedprice +
                                $params['duration'] * (int) $sellingprice;
                                @endphp
                                <td>Grand Total :</td>
                                <td>{{ General::rp($grandTotal) }}</td>
                            </tr>
                        </table>
                        <div class="mt-10">
                            <form action="{{ route('hostel.request', $hostelRoom->id) }}" class="d-flex flex-column"
                                method="post">
                                @csrf
                                <input type="hidden" name="service" value="hostel">
                                <input type="hidden" name="payment_method" value="xendit">
                                <input type="hidden" name="hostel_room_id" value="{{ $hostelRoom->id }}">
                                <input type="hidden" name="start"
                                    value="{{ date('d-m-Y', strtotime($params['start'])) }}">
                                <input type="hidden" name="end" value="{{ $checkout->format('d-m-Y') }}">
                                <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                                <input type="hidden" name="duration" value="{{ $params['duration'] }}">
                                <input type="hidden" name="grand_total" value="{{ $grandTotal }}">
                                <input type="hidden" name="point" value="{{ $point }}">
                                <input type="hidden" name="category" value="{{ $params['category'] }}">
                                <button type="submit" class="btn btn-danger flex-fill">
                                    Lanjut ke pembayaran
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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