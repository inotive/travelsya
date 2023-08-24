@extends('layouts.web')

@section('content-web')

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">

        <!--begin::Post-->
        <div class="content flex-row-fluid mb-10" id="kt_content">
            {{-- <div class="row justify-content-between mb-5">
                <div class="col-md-6">
                    <h2 class="fw-bold mt-10 text-gray-900">Hasil pencarian di {{ $params['location'] }}, Indonesia</h2>
                    <span class="fw-semibold d-block fs-6 mt-n1 text-gray-400">{{ date('d M Y', $params['start_date']) }} -
                        {{ date('d M Y', $params['end_date']) }} | {{ $params['guest'] }} Tamu | {{ $params['room'] }}
                        Kamar</span>
                </div>
                <div class="col-md-6 align-self-center text-end"><button class="btn btn-danger"
                        id="button-refilter">Pencarian</button></div>
            </div> --}}
            <div class="row card w-75 me-auto ms-auto mt-10" id="card-filter">
                <form action="{{ route('hostel.index') }}" method="get">
                    <div class="row card-body justify-content-center">
                        <div class="col-md-6">
                            <!--begin::Input-->
                            <select name="city" id="city" class="form-control">
                                @foreach ($cities as $city)
                                    <option value="{{ $city }}"
                                        {{ $params['location'] == $city ? 'selected' : '' }}>{{ $city }}</option>
                                @endforeach
                            </select>
                            <!--end::Input-->
                        </div>
                        <div class="col-md-6 mb-5">
                            <!--begin::Input-->
                            <input type="text" name="date" class="form-control js-daterangepicker"
                                id="js-daterangepicker">
                            <!--end::Input-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Input-->
                            <select name="room" id="kamar" class="form-control">
                                @for ($i = 1; $i < 5; $i++)
                                    <option value="{{ $i }}" {{ $params['room'] == $i ? 'selected' : '' }}>
                                        {{ $i }} Kamar</option>
                                @endfor
                            </select>
                            <!--end::Input-->
                        </div>
                        <div class="col-md-6">
                            <!--begin::Input-->
                            <select name="guest" id="tamu" class="form-control">
                                @for ($j = 1; $j < 5; $j++)
                                    <option value="{{ $j }}" {{ $params['guest'] == $j ? 'selected' : '' }}>
                                        {{ $j }} Tamu</option>
                                @endfor
                            </select>
                            <!--end::Input-->
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-danger mt-10 py-4">Cari Hostel</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row w-75 me-auto ms-auto mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-between">
                            <div class="col-md-4">
                                <div class="d-flex flex-row gap-5">
                                    <img src="{{ $hostelget['hostelImage'][0]['image'] }}" width="200" alt="">
                                    <div class="d-flex flex-column align-items-end gap-4">
                                        @foreach ($hostelget['hostelImage'] as $image)
                                            <img src="{{ $image['image'] }}" width="100" alt="">
                                            <img src="{{ $image['image'] }}" width="100" alt="">
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex flex-column gap-4">
                                    <h4 class="card-title text-gray-900">{{ $hostelget['name'] }}</h4>
                                    <p class="card-text mt-1 text-gray-500">{{ $hostelget['address'] }}</p>
                                    <p class="card-text mt-1 text-gray-500">{{ $hostelget['kecamatan'] }},
                                        {{ $hostelget['city'] }}</p>


                                    <p class="fw-semibold d-block fs-2 text-danger">
                                        {{ General::rp($hostelget['price_avg']) }}</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="d-flex flex-column align-items-center gap-20">
                                    <div>
                                        @for ($j = 0; $j < $hostelget['rating_avg']; $j++)
                                            <span class="card-text fa fa-star" style="color: orange;"></span>
                                        @endfor
                                        @if ($hostelget['rating_avg'] == 0)
                                            @for ($j = 0; $j < 4; $j++)
                                                <span class="card-text fa fa-star" style="color: orange;"></span>
                                            @endfor
                                        @endif
                                    </div>
                                    <p class="card-text mt-auto text-gray-500">{{ $hostelget['phone'] }}</p>

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

            <div class="row w-75 justify-content-between me-auto ms-auto mt-5">
                @foreach ($hostelget['hostelRoom'] as $hostel)
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="row justify-content-between">
                                    <div class="col-md-5">
                                        <div class="d-flex flex-row gap-5">
                                            <img src="{{ $hostel['image_1'] }}" width="200" alt="">
                                            <div class="d-flex flex-column align-items-end gap-4">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="d-flex flex-column">
                                            <h4 class="card-title text-gray-900">{{ $hostel['name'] }}</h4>
                                            <p class="card-text mt-1 text-gray-500">{{ $hostel['furnish'] }}</p>
                                            <p class="card-text text-gray-500">{{ $hostel['roomtype'] }}</p>
                                            <p class="card-text mt-1 text-gray-500">Maximal Penghuni :
                                                {{ $hostel['guest'] }} Orang</p>
                                            <div class="d-flex mt-4 flex-row flex-wrap gap-4">
                                                @foreach ($hostel['facilities'] as $fac)
                                                    <div class="d-flex flex-column align-items-center">
                                                        <span class="{{ $fac['icon'] }}"></span>
                                                        <span>{{ $fac['name'] }}</span>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between flex-row">
                                <p class="fw-semibold d-block fs-2 text-danger">{{ General::rp($hostel['sellingprice']) }}
                                </p>
                                {{-- <a href="{{route('hostel.checkout',$hostel['id'])."?start=".$_GET['start']."&duration=".$_GET['duration']."&room=".$_GET['room']."&guest=".$_GET['guest']}}" class="btn btn-danger">
                            Pesan Kamar
                        </a> --}}
                                <a href="{{ route('hostel.checkout', ['idroom' => $hostel['id'], 'start' => $_GET['start'], 'duration' => $_GET['duration'], 'room' => $_GET['room'], 'guest' => $_GET['guest']]) }}"
                                    class="btn btn-danger">
                                    Pesan Kamar
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
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
