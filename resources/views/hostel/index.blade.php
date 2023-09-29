@extends('layouts.web')

@section('title', 'Daftar Hostel')

@section('content-web')
<!--begin::Container-->
{{-- <div id="" class="row">
    <img class="d-block w-100 h-300px" src="//placehold.it/1200x300" alt="First slide">
</div> --}}
{{-- <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">

    <!--begin::Post-->
    <div class="content flex-row-fluid mb-10" id="kt_content">
        <div class="row justify-content-between mb-5">
            <div class="col-md-6">
                <h2 class="fw-bold mt-10 text-gray-900">Hasil pencarian di {{ $params['location'] }}, Indonesia</h2>
                <span class="fw-semibold d-block fs-6 mt-n1 text-gray-400">{{ date('d M Y', strtotime($params['start']))
                    }}
                    -
                    {{ date('d M Y', strtotime($params['start'] . ' +' . $params['duration'] . ' month')) }} |
                    {{ $params['guest'] }} Tamu |
                    {{ $params['room'] }}
                    Kamar</span>
            </div>
            <div class="col-md-6 align-self-center text-end"><button class="btn btn-danger"
                    id="button-refilter">Pencarian</button></div>
        </div>
        <div class="row card w-75 me-auto ms-auto mt-10" id="card-filter">
            <form action="{{ route('hostel.index') }}" method="get">
                <div class="row card-body justify-content-center">
                    <div class="col-md-6">
                        <!--begin::Input-->
                        <select name="location" id="city" class="form-control">
                            @foreach ($cities as $city)
                            <option value="{{ $city }}" {{ $params['location']==$city ? 'selected' : '' }}>{{ $city }}
                            </option>
                            @endforeach
                        </select>
                        <!--end::Input-->
                    </div>
                    <div class="col-md-6 mb-5">
                        <!--begin::Input-->
                        <input type="text" name="start" class="form-control js-daterangepicker" id="js-daterangepicker">
                        <!--end::Input-->
                    </div>
                    <div class="col-md-6">
                        <!--begin::Input-->
                        <select name="room" id="kamar" class="form-control">
                            @for ($i = 1; $i < 5; $i++) <option value="{{ $i }}" {{ $params['room']==$i ? 'selected'
                                : '' }}>
                                {{ $i }} Kamar</option>
                                @endfor
                        </select>
                        <!--end::Input-->
                    </div>
                    <div class="col-md-6">
                        <!--begin::Input-->
                        <select name="guest" id="tamu" class="form-control">
                            @for ($j = 1; $j < 5; $j++) <option value="{{ $j }}" {{ $params['guest']==$j ? 'selected'
                                : '' }}>
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
        <div class="row justify-content-center mt-10">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header py-5">
                        <h3 class="fw-bold text-gray-900">Hasil Sort</h3>
                        <span class="fw-semibold d-block mt-n1 text-gray-400">Hasil pencarian berdasarkan:</span>
                    </div>
                    <div class="card-body form-inline">
                        <input type="radio" class="form-check-input sortprice me-3" value="highestprice"
                            name="sortprice"><label>Harga Tertinggi</label></br></br>
                        <input type="radio" class="form-check-input sortprice me-3" value="lowestprice"
                            name="sortprice"><label>Harga Terendah</label></br></br>
                        <input type="radio" class="form-check-input sortprice me-3" value="review"
                            name="sortprice"><label>Nilai Review</label></br></br>
                    </div>
                </div>
                <div class="card mt-5">
                    <div class="card-header py-5">
                        <h3 class="fw-bold text-gray-900">Hasil Filter</h3>
                        <span class="fw-semibold d-block mt-n1 text-gray-400">Penampilkan hostel berdasarkan
                            filter</span>
                    </div>
                    <div class="card-body form-inline">
                        <div>
                            <h4 class="fw-bold text-gray-900">Rating Star</h4>
                            <div class="card-body form-inline">
                                <input type="radio" class="form-check-input rate mb-2 me-3" value="5" name="rate"><span
                                    class="fa fa-star" style="color: orange;"></span><span class="fa fa-star"
                                    style="color: orange;"></span><span class="fa fa-star"
                                    style="color: orange;"></span><span class="fa fa-star"
                                    style="color: orange;"></span><span class="fa fa-star"
                                    style="color: orange;"></span></br>
                                <input type="radio" class="form-check-input rate mb-2 me-3" value="4" name="rate"><span
                                    class="fa fa-star" style="color: orange;"></span><span class="fa fa-star"
                                    style="color: orange;"></span><span class="fa fa-star"
                                    style="color: orange;"></span><span class="fa fa-star"
                                    style="color: orange;"></span></br>
                                <input type="radio" class="form-check-input rate mb-2 me-3" value="3" name="rate"><span
                                    class="fa fa-star" style="color: orange;"></span><span class="fa fa-star"
                                    style="color: orange;"></span><span class="fa fa-star"
                                    style="color: orange;"></span></br>
                                <input type="radio" class="form-check-input rate mb-2 me-3" value="2" name="rate"><span
                                    class="fa fa-star" style="color: orange;"></span><span class="fa fa-star"
                                    style="color: orange;"></span></br>
                                <input type="radio" class="form-check-input rate mb-2 me-3" value="1" name="rate"><span
                                    class="fa fa-star" style="color: orange;"></span></br>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" id="listhostel">
                @foreach ($hostels as $hostel)
                <div class="card card-hostel mb-3">
                    <div class="row no-gutters">
                        <div class="col-auto">
                            <div class="img-fluid rounded-1 w-150px h-200px"
                                style="background-image:url('{{ count($hostel['hostelImage']) != null ? $hostel['hostelImage'][0]['image'] : '' }}');background-position: center;">
                            </div>
                        </div>
                        <div class="col align-self-center">
                            <div class="row justify-content-between pe-10">
                                <div class="col-md-6">
                                    <h4 class="card-title text-gray-900">{{ $hostel['name'] }}</h4>

                                    <div>
                                        @for ($j = 0; $j < $hostel['rating_avg']; $j++) <span
                                            class="card-text fa fa-star" style="color: orange;"></span>
                                            @endfor
                                            @if ($hostel['rating_avg'] == 0)
                                            @for ($j = 0; $j < 4; $j++) <span class="card-text fa fa-star"
                                                style="color: orange;"></span>
                                                @endfor
                                                @endif
                                    </div>
                                    <p class="card-text mt-1 text-gray-500">{{ $hostel['kecamatan'] }},
                                        {{ $hostel['city'] }}</p>

                                    <p class="fw-semibold d-block fs-2 text-danger">
                                        {{ General::rp($hostel['price_avg']) }}</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-column gap-20">
                                        <div class="d-flex justify-content-between flex-row">
                                            @foreach ($hostel['facilities'] as $fac)
                                            <div class="d-flex flex-column align-items-center">
                                                <span class="{{ $fac['icon'] }}"></span>
                                                <span>{{ $fac['name'] }}</span>
                                            </div>
                                            @endforeach
                                        </div>
                                        <a href="{{ route('hostel.room', $hostel['id']) . '?start=' . $_GET['start'] . '&duration=' . $_GET['duration'] . '&room=' . $_GET['room'] . '&guest=' . $_GET['guest'] }}"
                                            class="btn btn-danger flex-fill">
                                            Lihat
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!--end::Post-->
</div> --}}
<!--end::Container-->

<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <!--begin::Post-->
    <div class="content flex-row-fluid mb-10" id="kt_content">
        <div class="row">
            <div class="col-3">
                <div class="card border-1 border-light">
                    <form class="card-body h-100" method="GET" action="">
                        <input type="hidden" name="location" value="{{ $params['location']}}">
                        <input type="hidden" name="start" value="{{ $params['start']}}">
                        <input type="hidden" name="duration" value="{{ $params['duration']}}">
                        {{-- <input type="hidden" name="room" value="{{ $params['room']}}"> --}}
                        {{-- <input type="hidden" name="guest" value="{{ $params['guest']}}"> --}}
                        <input type="hidden" name="property" value="{{ $params['property'] }}">
                        <input type="hidden" name="roomtype" value="{{ $params['roomtype'] }}">
                        <input type="hidden" name="furnish" value="{{ $params['furnish'] }}">
                        <div class="row mb-4">
                            <div class="col-12">
                                <label for="" class="form-label">Urutan Harga</label>
                            </div>
                            <div class="col-12">
                                <!--begin::Radio group-->
                                <div class="btn-group w-100" data-kt-buttons="true"
                                    data-kt-buttons-target="[data-kt-button]">
                                    <!--begin::Radio-->
                                    <label
                                        class="btn btn-outline btn-color-muted btn-active-danger fs-9 {{ ($params['harga'] ?? null) === 'tertinggi' ? 'active' : ''}}"
                                        data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="harga" value="tertinggi" {{
                                            ($params['harga'] ?? null)==='tertinggi' ? 'checked' : '' }} />
                                        <!--end::Input-->
                                        Harga Tertinggi
                                    </label>
                                    <!--end::Radio-->

                                    <!--begin::Radio-->
                                    <label
                                        class="btn btn-outline btn-color-muted btn-active-danger fs-9 {{ ($params['harga'] ?? null) === 'terendah' ? 'active' : ''}}"
                                        data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="harga" value="terendah" {{
                                            ($params['harga'] ?? null)==='terendah' ? 'checked' : '' }} />
                                        <!--end::Input-->
                                        Harga Terendah
                                    </label>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Radio group-->
                            </div>
                        </div>
                        <div class="row gy-5">
                            <div class="col-12">
                                <label for="" class="form-label">Fasilitas</label>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Wifi
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Breakfast
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Breakfast
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Breakfast
                                    </label>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="" class="form-label">Bintang</label>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="star" value="1"
                                        id="flexCheckDefault" {{ ($params['star'] ?? null)==1 ? 'checked' : '' }} />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="star" value="2"
                                        id="flexCheckDefault" {{ ($params['star'] ?? null)==2 ? 'checked' : '' }} />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="star" value="3"
                                        id="flexCheckDefault" {{ ($params['star'] ?? null)==3 ? 'checked' : '' }} />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="star" value="4"
                                        id="flexCheckDefault" {{ ($params['star'] ?? null)==4 ? 'checked' : '' }} />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="star" value="5"
                                        id="flexCheckDefault" {{ ($params['star'] ?? null)==5 ? 'checked' : '' }} />
                                    <label class="form-check-label" for="flexCheckDefault">
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="w-100 btn-danger btn">Terapkan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-9">
                <div class="row gy-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body h-100">
                                <form method="GET" action="{{ route('hostel.index') }}" class="row g-4">
                                    <input type="hidden" name="property" value="{{ $params['property'] }}">
                                    <input type="hidden" name="roomtype" value="{{ $params['roomtype'] }}">
                                    <input type="hidden" name="furnish" value="{{ $params['furnish'] }}">
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
                                    <input type="hidden" name="duration" value="{{ $params['duration'] }}">
                                    @php
                                    $checkin = \Carbon\Carbon::parse($params['start']);
                                    $duration = $params['duration'];

                                    // Hitung tanggal checkout
                                    $checkout = $checkin->copy()->addMonths($duration);
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
                                        <button type="submit" class="w-100 btn-danger btn">Cari Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($hostels as $hostel)
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body h-100">
                                <div class="row my-4">
                                    <div class="col-3">
                                        <img src="https://service.travelsya.com/storage/hotel/image3.webp" alt=""
                                            height="200" width="200">
                                    </div>
                                    <div class="col-6">
                                        <div class="row gy-4">
                                            <div class="col-12">
                                                <h3>{{ $hostel->name }}</h3>
                                            </div>
                                            <div class="col-12">
                                                {{-- <span class="badge badge-danger">
                                                    {{ $hostelDetails[$hostel->id]['result_rating'] }}
                                                </span> --}}
                                                <span class="badge badge-danger">
                                                    ({{ floor($hostel->rating_avg) }} Rating)
                                                </span>
                                            </div>
                                            <div class="col-12">
                                                @for ($j = 1; $j <= $hostel->star; $j++)
                                                    <span class="card-text fa fa-star" style="color: orange;"></span>
                                                    @endfor
                                            </div>
                                            <div class="col-12">
                                                <p>{{ $hostel->address ?? 'Jln. Mekar Sari RT. 19 NO. 67 Gn. Sari Ilir,
                                                    Balikpapan' }}
                                                </p>
                                            </div>
                                            <div class="col-12">
                                                <h2 class="card-title text-danger">
                                                    {{ General::rp($hostel->price_avg) }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <h3 class="mb-4">Fasilitas</h3>
                                        <span class="me-2"><i class="fas fa-bath fs-3"></i></span>
                                        <span class="me-2"><i class="fas fa-wifi fs-3"></i></span>
                                        <a href="{{ route('hostel.room', $hostel->id) . '?location=' . $_GET['location'] . '&start=' . $_GET['start'] . '&duration=' . $_GET['duration'] . '&property=' . $_GET['property'] . '&roomtype=' . $_GET['roomtype'] . '&furnish=' . $_GET['furnish'] }}"
                                            class="btn btn-danger d-block mt-10 text-white">
                                            Lihat
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

{{-- @push('add-style')
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

            $("#card-filter").hide();
            $("#button-refilter").click(function() {
                $("#card-filter").toggle();
            })
            var today = new Date();
            var start = new Date("{{ date('m/d/Y', strtotime($params['start'])) }}");
            var end = new Date(
                "{{ date('m/d/Y', strtotime($params['start'] . ' +' . $params['duration'] . ' month')) }}");
            $('.js-daterangepicker').daterangepicker({
                minDate: today,
                startDate: start,
                endDate: end
            });

            var optionsort = '';
            var optionrate = '';

            $(".sortprice").on('click', function() {
                optionsort = $('input[name="sortprice"]:checked').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/hostel/ajax') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        optionsort: optionsort,
                        optionrate: optionrate,
                        city: '{{ $params['location'] }}',
                        name: '{{ $params['location'] }}'
                    },
                    success: function(response) {
                        $("#listhostel").html('');
                        console.log(response);
                        $.each(response, function(key, hostel) {
                            $("#listhostel").append(
                                `<a class="card card-hostel mb-3"><div class="row no-gutters"><div class="col-auto"><div class="img-fluid rounded-1 w-150px h-200px"style="background-image:url('${(hostel.hostel_image.length == 0) ?"" : hostel.hostel_image[0].image }');background-position: center;"></div></div><div class="col align-self-center"><div class="row px-2"><h4 class="card-title text-gray-900">${hostel.name}</h4><div><span class="card-text fa fa-star" style="color: orange;"></span></div><p class="card-text text-gray-500 mt-1">${hostel.kecamatan}, ${hostel.city}</p><div class="text-gray-400 fw-semibold d-block fs-6"> <s>${hostel.price_avg-(hostel.price_avg*0.5)}</s></div><p class="fw-semibold d-block fs-2 text-danger">${hostel.price_avg}</p></div></div></div></a>`
                            );
                        })
                    }
                })
            })
            $(".rate").on('click', function() {
                optionrate = $('input[name="rate"]:checked').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('/hostel/ajax') }}",
                    type: "POST",
                    dataType: 'json',
                    data: {
                        optionsort: optionsort,
                        optionrate: optionrate,
                        city: '{{ $params['location'] }}',
                        name: '{{ $params['location'] }}'

                    },
                    success: function(response) {
                        console.log(response)
                        $("#listhostel").html('');
                        $.each(response, function(key, hostel) {
                            $("#listhostel").append(
                                `<a class="card card-hostel mb-3"><div class="row no-gutters"><div class="col-auto"><div class="img-fluid rounded-1 w-150px h-200px"style="background-image:url('${hostel.hostel_image[0].image}');background-position: center;"></div></div><div class="col align-self-center"><div class="row px-2"><h4 class="card-title text-gray-900">${hostel.name}</h4><div><span class="card-text fa fa-star" style="color: orange;"></span></div><p class="card-text text-gray-500 mt-1">${hostel.kecamatan}, ${hostel.city}</p><div class="text-gray-400 fw-semibold d-block fs-6"> <s>${hostel.price_avg-(hostel.price_avg*0.5)}</s></div><p class="fw-semibold d-block fs-2 text-danger">${hostel.price_avg}</p></div></div></div></a>`
                            );
                        })
                    }
                })
            })
        })
</script>
@endpush --}}