@extends('layouts.web')

@section('title', 'Daftar Ruangan Pribadi')

@section('content-web')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content flex-row-fluid mb-10" id="kt_content">
        <div class="row card w-75 me-auto ms-auto mt-10" id="card-filter">
            <form action="{{ route('hostel.index') }}" method="get">
                <input type="hidden" name="duration" value="{{ $params['duration'] }}">
                <input type="hidden" name="property" value="{{ $params['property'] }}">
                <input type="hidden" name="roomtype" value="{{ $params['roomtype'] }}">
                <input type="hidden" name="furnish" value="{{ $params['furnish'] }}">
                <div class="row gy-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body h-100">
                                <div class="row g-4">
                                    <div class="col-12">
                                        <label class="form-label fw-bold fs-6">Pilih Lokasi</label>
                                        <select name="location" id="location" class="form-select select"
                                            data-control="select2" data-placeholder="Pilih Lokasi" autocomplete="on">

                                            @foreach ($cities as $city)
                                            <option value="{{ $city->city }}" {{ $params['location']==$city->city ?
                                                'selected' : '' }}>
                                                {{ $city->city }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label fw-bold fs-6">Tanggal Check-in</label>
                                        <div class="input-group" id="js_datepicker" data-td-target-input="nearest"
                                            data-td-target-toggle="nearest">
                                            <input id="checkin" type="text" name="start" class="form-control"
                                                data-td-target="#js_datepicker" x-on:change="handleSelectCheckin"
                                                value="{{ $params['start'] ?? '' }}" />
                                            <span class="input-group-text" data-td-target="#js_datepicker"
                                                data-td-toggle="datetimepicker">
                                                <i class="ki-duotone ki-calendar fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                    </div>

                                    @php
                                    $checkin = \Carbon\Carbon::parse($params['start']);
                                    $duration = $params['duration'];

                                    // Hitung tanggal checkout
                                    $checkout = $checkin->copy()->addDays($duration);
                                    @endphp

                                    <div class="col-3">
                                        <label class="form-label fw-bold fs-6">Tanggal Checkout</label>
                                        <input type="text" class="form-control" name="end_date"
                                            value="{{ $checkout->format('d-m-Y') }}" />
                                    </div>
                                    {{-- <div class="col-3">
                                        <label class="form-label fw-bold fs-6">Total Kamar</label>
                                        <select name="room" id="room" class="form-select">
                                            @for ($i = 1; $i <= 11; $i++) <option value="{{ $i }}" {{
                                                $params['room']==$i ? 'selected' : '' }}>
                                                {{ $i }}</option>
                                                @endfor
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label fw-bold fs-6">Total Tamu</label>
                                        <select name="guest" id="guest" class="form-select">
                                            @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}" {{
                                                $params['guest']==$i ? 'selected' : '' }}>
                                                {{ $i }}</option>
                                                @endfor
                                        </select>
                                    </div> --}}
                                    <div class="col-12">
                                        <button class="w-100 btn-danger btn">Ubah Pesanan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row card w-75 me-auto ms-auto mt-10">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <img src="https://service.travelsya.com/storage/hotel/image3.webp"
                                    style="max-width: 250px; max-height: 250px" alt="">
                            </div>
                            <div class="col-8 d-flex flex-column">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h1 class="fw-bold mt-0">{{ $hostelget->name }}</h1>
                                            <div class="badge badge-primary">{{ $hostelget->city }}</div>
                                        </div>
                                        <p style="font-size: 13px" class="mt-5">{{ $hostelget->address }}</p>

                                        <div id="bintang ">
                                            @for ($j = 1; $j <= floor($hostelget->rating_avg); $j++)
                                                <span class="card-text fa fa-star" style="color: orange;"></span>
                                                @endfor
                                        </div>

                                        <span class="badge badge-danger mt-4">
                                            ({{ floor($hostelget->rating_avg) }} Rating)
                                        </span>
                                    </div>
                                </div>
                                <div class="row mt-auto">
                                    <div class="col-12">
                                        <h2 class="mt-15 fw-bold d-flex align-self-end" style="color: #c02425">
                                            {{ General::rp($hostelget->price_avg) }}
                                        </h2>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @guest
        <div class="row w-75 me-auto ms-auto mt-5">
            <div class="col-12">
                <!--begin::Alert-->
                <div class="alert alert-dismissible bg-light-warning d-flex flex-column flex-sm-row mb-10 p-5">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-notification-bing fs-2hx text-dark mb-sm-0 mb-5 me-4"><span
                            class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                    <!--end::Icon-->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column pe-sm-10 pe-0">
                        <!--begin::Title-->
                        <h4 class="fw-semibold">Anda Belum Login</h4>
                        <!--end::Title-->

                        <!--begin::Content-->
                        <span>Harap login terlebih dahulu untuk melakukan pemesanan kamar. <a role="button"
                                class="d-inline-block fw-bold" data-toggle="modal" data-target="#exampleModal">Login
                                Disini</a></span>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Close-->
                    <button type="button"
                        class="position-absolute position-sm-relative m-sm-0 btn btn-icon ms-sm-auto end-0 top-0 m-2"
                        data-bs-dismiss="alert">
                        <i class="ki-duotone ki-cross fs-1 text-primary"><span class="path1"></span><span
                                class="path2"></span></i>
                    </button>
                    <!--end::Close-->
                </div>
                <!--end::Alert-->
            </div>
        </div>
        @endguest

        <div class="row w-75 me-auto ms-auto mt-5">
            @foreach ($hostelget->hostelRoom as $room)
            <div class="col-6">
                <div class="card card-hostel mb-3">
                    <div class="row mb-2">
                        <div class="col-4">
                            <div class="img-fluid rounded-1 w-150px h-150px m-3"
                                style="background-image:url('https://service.travelsya.com/storage/kamar/Lnw9eol8C1F759cRDf16qgdLBnsMgKLqjngpfw3H.jpg');background-position: center; ">
                            </div>
                        </div>
                        <div class="col">
                            <div class="row mt-5 px-2">
                                <h4 class="card-title text-gray-900">Kamar {{ $room->name }}</h4>
                                <p class="card-text mt-1 text-gray-500">Ukuran Kamar : {{ $room->roomsize }} m2
                                </p>
                                <p class="card-text mt-1 text-gray-500">Maximal Penghuni : {{ $room->guest }}
                                    Orang</p>
                                <p class="card-text mt-1 text-gray-500">
                                    <b class="text-danger">
                                        Tersisa 2 Kamar
                                    </b>
                                </p>
                                <div>
                                    <span class="me-2"><i class="fas fa-bath fs-3"></i></span>
                                    <span class="me-2"><i class="fas fa-wifi fs-3"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <p class="fw-semibold d-block fs-2 text-danger">Rp.
                            {{ number_format($room->sellingprice, 0, ',', '.') }}</p>
                        @guest
                        <a href="#" class="btn btn-danger px-4 py-2" data-toggle="modal"
                            data-target="#exampleModal">Pesan Kamar</a>
                        @endguest
                        @auth
                        <a href="{{ route('hostel.checkout', ['idroom' => $room->id]) }}?location={{ $params['location'] }}&start={{ $params['start'] }}&duration={{ $params['duration'] }}&room={{ $params['room'] }}&guest={{ $params['guest'] }}"
                            class="btn btn-danger px-4 py-2">Pesan
                            Kamar</a>
                        @endauth
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <!--end::Post-->

    <!-- Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login Terlebih Dahulu</h5>
                </div>
                <div class="modal-body">
                    <div class="row gy-4">
                        <div class="col-12">
                            <label for="" class="form-label">Email</label>
                            <input type="text" class="form-control form-control-lg" placeholder="Masukan Email Anda">
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">Password</label>
                            <input type="password" class="form-control form-control-lg"
                                placeholder="Masukan Password Anda">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-lg btn-light">Kembali</button>
                    <a href="{{ route('hotels.reservation.example') }}" class="btn btn-lg text-white"
                        style="background-color: #c02425">Login</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal-->
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

@push('add-script')
<script>
    $(document).ready(function() {

            // $("#card-filter").hide();
            // $("#button-refilter").click(function() {
            //     $("#card-filter").toggle();
            // })

            var today = new Date();
            var start = new Date("{{ date('m/d/Y', strtotime($_GET['start'])) }}");
            var end = new Date(
                "{{ date('m/d/Y', strtotime($_GET['start'] . ' +' . $_GET['duration'] . ' month')) }}");
            $('.js-daterangepicker').daterangepicker({
                minDate: today,
                startDate: start,
                endDate: end
            });
        })
</script>
@endpush