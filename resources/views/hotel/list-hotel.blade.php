@extends('layouts.web')

@section('title', 'Daftar Hotel')

@section('content-web')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <!--begin::Post-->
    <div class="content flex-row-fluid mb-10" id="kt_content">
        <div class="row">
            <div class="col-3">
                <div class="card border-1 border-light">
                    <form class="card-body h-100" method="GET" action="" id="searchForm">
                        <input type="hidden" name="location" value="{{ $request['location']}}">
                        <input type="hidden" name="start" value="{{ $request['start'] ?? ''}}">
                        <input type="hidden" name="duration" value="{{ $request['duration']}}">
                        <input type="hidden" name="room" value="{{ $request['room']}}">
                        <input type="hidden" name="guest" value="{{ $request['guest']}}">
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
                                        class="btn btn-outline btn-color-muted btn-active-danger fs-9 {{ ($request['harga'] ?? null) === 'tertinggi' ? 'active' : ''}}"
                                        data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="harga" value="tertinggi" {{
                                            ($request['harga'] ?? null)==='tertinggi' ? 'checked' : '' }} />

                                        <!--end::Input-->
                                        Harga Tertinggi
                                    </label>
                                    <!--end::Radio-->

                                    <!--begin::Radio-->
                                    <label
                                        class="btn btn-outline btn-color-muted btn-active-danger fs-9 {{ ($request['harga'] ?? null) === 'terendah' ? 'active' : ''}}"
                                        data-kt-button="true">
                                        <!--begin::Input-->

                                        <input class="btn-check" type="radio" name="harga" value="terendah" {{
                                            ($request['harga'] ?? null)==='terendah' ? 'checked' : '' }} />

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

                            {{-- @foreach ($facilities as $facility)
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" name="facility[]" type="checkbox"
                                        value="{{ $facility->id }}" id="flexCheckDefault" {{ ($request['facility'] ??
                                        null)==$facility->id ? 'checked' : ''}} />
                                    <label class="form-check-label" for="star1">
                                        {{ $facility->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach --}}

                            @foreach ($facilities as $facility)
                            <div class="col-12">
                                <div class="form-check">
                                    <input id="facility{{ $facility->id }}" class="form-check-input" name="facility[]"
                                        type="checkbox" value="{{ $facility->id }}" id="flexCheckDefault" {{
                                        in_array($facility->id,
                                    $request['facility'] ?? []) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="facility{{ $facility->id }}">
                                        {{ $facility->name }}
                                    </label>
                                </div>
                            </div>
                            @endforeach

                            {{-- <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    <label class="form-check-label" for="star1">
                                        Breakfast
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    <label class="form-check-label" for="star1">
                                        Breakfast
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                    <label class="form-check-label" for="star1">
                                        Breakfast
                                    </label>
                                </div>
                            </div> --}}


                            <div class="col-12">
                                <label for="" class="form-label">Bintang</label>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input id="star1" class="form-check-input" type="checkbox" name="star[]" value="1"
                                        id="flexCheckDefault" {{ (isset($_GET['star']) && in_array(1, $_GET['star']))
                                        ? 'checked' : '' }} />
                                    <label class="form-check-label" for="star1">
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input id="star2" class="form-check-input" type="checkbox" name="star[]" value="2"
                                        id="flexCheckDefault" {{ (isset($_GET['star']) && in_array(2, $_GET['star']))
                                        ? 'checked' : '' }} />
                                    <label class="form-check-label" for="star2">
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input id="star3" class="form-check-input" type="checkbox" name="star[]" value="3"
                                        id="flexCheckDefault" {{ (isset($_GET['star']) && in_array(3, $_GET['star']))
                                        ? 'checked' : '' }} />
                                    <label class="form-check-label" for="star3">
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input id="star4" class="form-check-input" type="checkbox" name="star[]" value="4"
                                        id="flexCheckDefault" {{ (isset($_GET['star']) && in_array(4, $_GET['star']))
                                        ? 'checked' : '' }} />
                                    <label class="form-check-label" for="star4">
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input id="star5" class="form-check-input" type="checkbox" name="star[]" value="5"
                                        id="flexCheckDefault" {{ (isset($_GET['star']) && in_array(5, $_GET['star']))
                                        ? 'checked' : '' }} />
                                    <label class="form-check-label" for="star5">
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                        <span class="card-text fa fa-star" style="color: orange;"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="w-100 btn-danger btn mb-2">Terapkan</button>
                               <a href="/hotels?location={{ $request['location']}}&start={{ $request['start']}}&duration={{ $request['duration']}}&room={{ $request['room']}}&guest={{ $request['guest']}}" class="w-100 btn btn-success">Reset</a>
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
                                <form method="GET" action="{{ route('hotels.index') }}" class="row g-4">
                                    <div class="col-12">
                                        <label class="form-label fw-bold fs-6">Pilih Lokasi</label>
                                        <select name="location" id="location" class="form-select select"
                                            data-control="select2" data-placeholder="Pilih Lokasi" autocomplete="on">
                                            <optgroup label="Kota"></optgroup>
                                            @foreach ($citiesHotel as $city)
                                            <option value="{{ $city->city }}" {{ $request['location']==$city->city ?
                                                'selected' : '' }}>
                                                {{ $city->city }}</option>
                                            @endforeach

                                            {{-- <optgroup label="Hotel"></optgroup>
                                            @foreach ($listHotel as $hotel)
                                            <option value="{{ $hotel->name }}" {{ $request['location']==$hotel->name ?
                                                'selected' : '' }}>
                                                {{ $hotel->name }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label fw-bold fs-6">Tanggal Check-in</label>
                                        <div class="input-group" id="js_datepicker_list_hotel"
                                            data-td-target-input="nearest" data-td-target-toggle="nearest">
                                            <input id="checkin" type="text" name="start" class="form-control"
                                                data-td-target="#js_datepicker_list_hotel"
                                                x-on:change="handleSelectCheckin"
                                                value="{{ $request['start'] ?? '' }}" />
                                            <span class="input-group-text" data-td-target="#js_datepicker_list_hotel"
                                                data-td-toggle="datetimepicker">
                                                <i class="ki-duotone ki-calendar fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                    {{-- <input type="hidden" name="duration" value="{{ $request['duration'] }}">
                                    @php
                                    $checkin = \Carbon\Carbon::parse($request['start']);
                                    $duration = $request['duration'];


                                    // Hitung tanggal checkout

                                    $checkout = $checkin->copy()->addDays($duration);
                                    @endphp
                                    <div class="col-3">
                                        <label class="form-label fw-bold fs-6">Tanggal Checkout</label>
                                        <input type="text" class="form-control" name="end_date"
                                            value="{{ $checkout->format('d-m-Y') }}" />
                                    </div> --}}

                                    <div class="col-3">
                                        <label for="" class="form-label fw-bold fs-6">Durasi</label>
                                        <select name="duration" class="form-select">
                                            @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}" {{
                                                $request['duration']==$i ? 'selected' :'' }}>{{ $i }} Malam
                                                </option>
                                                @endfor
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label fw-bold fs-6">Total Kamar</label>
                                        <select name="room" id="room" class="form-select">
                                            @for ($i = 1; $i <= 11; $i++) <option value="{{ $i }}" {{
                                                $request['room']==$i ? 'selected' : '' }}>
                                                {{ $i }}</option>
                                                @endfor
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label fw-bold fs-6">Total Tamu</label>
                                        <select name="guest" id="guest" class="form-select">
                                            @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}" {{
                                                $request['guest']==$i ? 'selected' : '' }}>
                                                {{ $i }}</option>
                                                @endfor
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="w-100 btn-danger btn">Cari Data</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($hotels as $hotel)
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body h-100">
                                <div class="row my-4">
                                    <div class="col-4">
                                        @php
                                        $image = $hotel->hotelImage->where('main', 1)->first()->image ?? '';
                                        @endphp
                                        <a class="d-block overlay" data-fslightbox="lightbox-basic-{{$hotel->id}}"
                                            href="{{ asset('storage/'. $image) }}">
                                            <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                                style="background-image:url('{{ asset('storage/'.$hotel->hotelImage->where('main', 1)->first()?->image ) }}')">
                                            </div>
                                            <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                <i class="bi bi-eye-fill text-white fs-3x"></i>
                                            </div>
                                        </a>
                                        <div class="row mt-4">
                                            @foreach ($hotel->hotelImage->where('main','!=',1)->take(3) as $hotelImage)
                                                <div class="col-4">
                                                    <a class="d-block overlay" data-fslightbox="lightbox-basic-{{$hotel->id}}"
                                                       href="{{ asset('storage/'. $hotelImage?->image) }}">
                                                        <!--begin::Image-->
                                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-75px"
                                                             style="background-image:url('{{ asset('storage/'. $hotelImage?->image) }}')">
                                                        </div>
                                                        <!--end::Image-->

                                                    <!--begin::Action-->
                                                    <div
                                                        class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                                        <i class="bi bi-eye-fill text-white fs-3x"></i>
                                                    </div>
                                                    <!--end::Action-->
                                                </a>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="row gy-4">
                                            <div class="col-12">
                                                <h3>{{ $hotel->name }}</h3>
                                            </div>
                                            <div class="col-12">
                                                <span class="badge badge-danger">
                                                    {{ number_format($hotelDetails[$hotel->id]['result_rating'],2) }}
                                                </span>
                                                <span class="badge badge-danger">({{
                                                    $hotelDetails[$hotel->id]['total_rating'] }}
                                                    Rating)</span>
                                            </div>
                                            <div class="col-12">
                                                @for ($i = 1; $i <= $hotel->star; $i++)
                                                    <span class="card-text fa fa-star" style="color: orange;"></span>
                                                    @endfor
                                            </div>
                                            <div class="col-12">
                                                <p>{{ $hotel->address }}</p>
                                            </div>
                                            <div class="col-12">
                                                <h2 class="card-title text-danger">
                                                    Rp
                                                    {{ number_format($hotelDetails[$hotel->id]['min_price'], 0, ',',
                                                    '.') }}
                                                    - Rp
                                                    {{ number_format($hotelDetails[$hotel->id]['max_price'], 0, ',',
                                                    '.') }}
                                                </h2>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <h3 class="mb-4">Fasilitas</h3>
                                        <ul>
                                            @foreach ($hotel->hotelroomFacility->groupBy('facility.name') as $facility)
                                            <li>{{ $facility->first()->facility->name }}</li>
                                            @endforeach
                                        </ul>

                                        <a href="{{ route('hotels.room', ['id_hotel' => $hotel->id]) }}?location={{ $request['location'] }}&start={{ $request['start'] }}&duration={{ $request['duration'] }}&room={{ $request['room'] }}&guest={{ $request['guest'] }}"
                                            class="btn btn-danger d-block mt-10 text-white">Lihat Room</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="mt-4">
                    {{ $hotels->links() }}
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
@push('add-script')
<script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#card-filter").hide();
        $("#button-refilter").click(function() {
            $("#card-filter").toggle();
        })

        var today = new Date();

        new tempusDominus.TempusDominus(document.getElementById("js_datepicker_list_hotel"), {
            display: {
                viewMode: "calendar",
                components: {
                    date: true,
                    hours: false,
                    minutes: false,
                    seconds: false
                }
            },
            localization: {
                locale: "id",
                format: "dd-MM-yyyy",
            },
            restrictions: {
                minDate: today,
            },
        });
    })

</script>
@endpush
