@extends('layouts.web')

@section('content-web')
    <!--begin::Container-->
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid mb-10" id="kt_content">
            {{-- <div class="row justify-content-between mb-5"> --}}
            {{-- <div class="col-md-6"> --}}
            {{-- --}}{{-- <h2 class="fw-bold text-gray-900 mt-10">Hasil pencarian di {{$params['city']}}, Indonesia
                </h2> --}}
            {{-- --}}{{-- <span class="text-gray-400 fw-semibold d-block fs-6 mt-n1">{{date('d M
                    Y',$params['start_date'])}} - {{date('d M --}}
            {{-- --}}{{-- Y',$params['end_date'])}} | {{$params['guest']}} Tamu | {{$params['room']}}
                    Kamar</span> --}}
            {{-- </div> --}}
            {{-- <div class="col-md-6 align-self-center text-end"><button class="btn btn-danger"
                    id="button-refilter">Pencarian</button></div> --}}
            {{-- </div> --}}
            <div class="row card w-75 me-auto ms-auto mt-10" id="card-filter">
                <form action="{{ route('hotels.index') }}" method="get">
                    {{-- <div class="row card-body justify-content-center"> --}}
                    {{-- <div class="col-md-3"> --}}
                    {{--
                        <!--begin::Input--> --}}
                    {{-- <select name="city" id="city" class="form-control"> --}}
                    {{-- @foreach ($cities as $city) --}}
                    {{-- <option value="{{$city}}" {{($params['location']==$city) ? 'selected' : '' }}>{{$city}}
                            </option> --}}
                    {{-- @endforeach --}}
                    {{-- </select> --}}
                    {{--
                        <!--end::Input--> --}}
                    {{--
                    </div> --}}
                    {{-- <div class="col-md-3 mb-5"> --}}
                    {{--
                        <!--begin::Input--> --}}
                    {{-- <input type="text" name="date" class="form-control js-daterangepicker" --}} {{--
                            id="js-daterangepicker"> --}}
                    {{--
                        <!--end::Input--> --}}
                    {{--
                    </div> --}}
                    {{-- <div class="col-md-2"> --}}
                    {{--
                        <!--begin::Input--> --}}
                    {{-- <select name="room" id="kamar" class="form-control"> --}}
                    {{-- @for ($i = 1; $i < 5; $i++) --}} {{-- <option value="{{$i}}">{{$i}} Kamar</option> --}}
                    {{-- @endfor --}}
                    {{-- </select> --}}
                    {{--
                        <!--end::Input--> --}}
                    {{--
                    </div> --}}
                    {{-- <div class="col-md-2"> --}}
                    {{--
                        <!--begin::Input--> --}}
                    {{-- <select name="guest" id="tamu" class="form-control"> --}}
                    {{-- @for ($j = 1; $j < 5; $j++) --}} {{-- <option value="{{$j}}">{{$j}} Tamu</option> --}}
                    {{-- @endfor --}}
                    {{-- </select> --}}
                    {{--
                        <!--end::Input--> --}}
                    {{--
                    </div> --}}
                    {{-- <div class="col-md-2"> --}}
                    {{-- <button type="submit" class="btn btn-danger py-4 w-100">Cari Hotel</button> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    <div class="row gy-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body h-100">
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-6">Pilih Lokasi</label>
                                            <select name="location" id="location" class="form-select select"
                                                data-control="select2" data-placeholder="Pilih Lokasi" autocomplete="on">
                                                <optgroup label="Kota"></optgroup>
                                                {{-- <template x-for="data in $store.hotel.cities">
                                                <option x-bind:value="data.name" x-text="data.label"></option>
                                            </template> --}}

                                                @foreach ($citiesHotel as $city)
                                                    <option value="{{ $city->city }}"
                                                        {{ $request['location'] == $city->city ? 'selected' : '' }}>
                                                        {{ $city->city }}</option>
                                                @endforeach

                                                {{-- <optgroup label="Hotel"></optgroup>
                                                @foreach ($listHotel as $hotel)
                                                    <option value="{{ $hotel->name }}"
                                                        {{ $request['location'] == $hotel->name ? 'selected' : '' }}>
                                                        {{ $hotel->name }}</option>
                                                @endforeach --}}
                                                {{-- <template x-for="data in $store.hotel.hotels">
                                                <option x-bind:value="data.name" x-text="data.label"></option>
                                            </template> --}}
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label fw-bold fs-6">Tanggal Check-in</label>
                                            <div class="input-group" id="js_datepicker_show_hotel"
                                                data-td-target-input="nearest" data-td-target-toggle="nearest">
                                                <input id="checkin" type="text" name="start" class="form-control"
                                                    data-td-target="#js_datepicker_show_hotel"
                                                    x-on:change="handleSelectCheckin"
                                                    value="{{ $request['start'] ?? '' }}" />
                                                <span class="input-group-text" data-td-target="#js_datepicker_show_hotel"
                                                    data-td-toggle="datetimepicker">
                                                    <i class="ki-duotone ki-calendar fs-2">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                    </i>
                                                </span>
                                            </div>
                                        </div>
                                        <input type="hidden" name="duration" value="{{ $request['duration'] }}">
                                        {{-- @php
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
                                                @for ($i = 1; $i <= 31; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ $request['duration'] == $i ? 'selected' : '' }}>
                                                        {{ $i }} Malam
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label fw-bold fs-6">Total Kamar</label>
                                            <select name="room" id="room" class="form-select">
                                                @for ($i = 1; $i <= 11; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ $request['room'] == $i ? 'selected' : '' }}>
                                                        {{ $i }}</option>
                                                @endfor
                                                {{-- <template x-for="data in [ ...Array(totalRoom).keys() ]"
                                                    key="data">
                                                    <option x-bind:value="data"
                                                        x-text="data === 0 ? `Pilih Jumlah Kamar` : `${data} Kamar`">-
                                                    </option>
                                                </template> --}}
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label fw-bold fs-6">Total Tamu</label>
                                            <select name="guest" id="guest" class="form-select">
                                                @for ($i = 1; $i <= 31; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ $request['guest'] == $i ? 'selected' : '' }}>
                                                        {{ $i }}</option>
                                                @endfor
                                                {{-- <template x-for="data in [ ...Array(totalGuest).keys() ]"
                                                    key="data">
                                                    <option x-bind:value="data"
                                                        x-text="data === 0 ? `Pilih Jumlah Tamu` : `${data} Tamu`">-
                                                    </option>
                                                </template> --}}
                                            </select>
                                        </div>
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
                                    {{-- <img
                                    src="{{$hotelget['hostelImage'] != null ? $hostelget['hostelImage'][0]['image'] : 'https://service.travelsya.com/storage/hotel/image3.webp'}}"
                                    --}} {{-- style="max-width: 250px; max-height: 250px" alt=""> --}}
                                    {{-- <img src="https://service.travelsya.com/storage/hotel/image3.webp"
                                    style="max-width: 250px; max-height: 250px" alt=""> --}}
                                    @php
                                        $hotelImage = $detailHotel->hotelImage->where('main', 1)->first();
                                        $image = $hotelImage !== null ? 'storage/' . $hotelImage->image : null;
                                    @endphp

                                    <a class="d-block overlay" data-fslightbox="lightbox-basic"
                                        href="{{ asset($image ?: 'assets/media/logos/logo-square.png') }}">
                                        <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-175px"
                                            style="background-image:url('{{ asset($image ?: 'assets/media/logos/logo-square.png') }}')">
                                        </div>
                                        <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                            <i class="bi bi-eye-fill text-white fs-3x"></i>
                                        </div>
                                    </a>

                                </div>
                                <div class="col-8 d-flex flex-column">
                                    {{-- <div class="row"> --}}
                                    {{-- <div class="col-12"> --}}
                                    {{-- <div class="d-flex justify-content-between"> --}}
                                    {{-- <h1 class="fw-bold">{{$hotelget->name}}</h1> --}}
                                    {{-- <div id="bintang"> --}}

                                    {{-- @for ($j = 0; $j < $hotelget->rating_avg; $j++) --}}
                                    {{-- <span class="card-text fa fa-star" style="color: orange;"> --}}
                                    {{-- </span> --}}
                                    {{-- @endfor --}}
                                    {{-- </div> --}}
                                    {{-- </div> --}}
                                    {{-- <p style="font-size: 13px">{{$hotelget->address}}</p> --}}
                                    {{-- <div class="badge badge-primary">{{$hotelget->city}}</div> --}}
                                    {{-- </div> --}}

                                    {{-- </div> --}}
                                    {{-- <div class="row mt-auto"> --}}
                                    {{-- <div class="col-12"> --}}
                                    {{-- <h2 class="mt-15 fw-bold d-flex align-self-end" style="color: #c02425">
                                            {{General::rp($hotelget->minprice)}} - {{General::rp($hotelget->maxprice)}}
                                        </h2> --}}
                                    {{-- </div> --}}
                                    {{-- </div> --}}

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between">
                                                <h1 class="fw-bold">{{ $detailHotel->name }}</h1>
                                                <div class="badge badge-primary">{{ $detailHotel->city }}</div>
                                            </div>
                                            <p style="font-size: 13px">{{ $detailHotel->address }}</p>

                                            <div id="bintang " class="mb-1">
                                                @for ($j = 0; $j <= $star_rating; $j++)
                                                    <span class="card-text fa fa-star" style="color: orange;"></span>
                                                @endfor
                                            </div>
                                            <div class="row g-5 mb-3">
                                                <div class="col-sm-6">
                                                    <div class="fw-semibold fs-7 text-gray-700 mb-2">Checkin:</div>
                                                    <span
                                                        class="badge badge-light-danger me-2">{{ $detailHotel->checkin }}</span>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="fw-semibold fs-7 text-gray-700 mb-2">Checkout:</div>
                                                    <span
                                                        class="badge badge-light-danger me-2">{{ $detailHotel->checkout }}</span>
                                                </div>
                                            </div>
                                            <div class="separator"></div>
                                            <div class="row mt-1">
                                                <div class="col-md-2">
                                                    <div class="fw-semibold text-gray-600 fs-7">Phone:</div>
                                                </div>
                                                <div class="col">
                                                    <div class="fw-bold text-gray-800 fs-6">
                                                        {{ $detailHotel->phone ?? '-' }}</div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="fw-semibold text-gray-600 fs-7">Website:</div>
                                                </div>
                                                <div class="col">
                                                    <div class="fw-bold text-gray-800 fs-6">
                                                        {!! isset($detailHotel->website)
                                                            ? '<a href="' .
                                                                (str_starts_with($detailHotel->website, 'http://') || str_starts_with($detailHotel->website, 'https://')
                                                                    ? $detailHotel->website
                                                                    : 'http://' . $detailHotel->website) .
                                                                '" target="_blank" rel="noopener">' .
                                                                (str_starts_with($detailHotel->website, 'http://') || str_starts_with($detailHotel->website, 'https://')
                                                                    ? substr($detailHotel->website, strpos($detailHotel->website, '://') + 3)
                                                                    : $detailHotel->website) .
                                                                '</a>'
                                                            : '-' !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-1">
                                                <div class="col-md-2">
                                                    <div class="fw-semibold text-gray-600 fs-7">Email:</div>
                                                </div>
                                                <div class="col">
                                                    <div class="fw-bold text-gray-800 fs-6">
                                                        {{ $detailHotel->email ?? '-' }}</div>
                                                </div>
                                            </div>
                                            <div class="separator"></div>
                                            <span class="badge badge-danger mt-4 mb-2">
                                                {{  number_format($result_rating,2,'.','') }}
                                            </span>
                                            <span class="badge badge-danger">({{$total_rating}} Rating)</span>
                                            <p>{{ $detailHotel->description ?? '' }}</p>
                                        </div>
                                    </div>
                                    <div class="row mt-auto">
                                        <div class="col-12">
                                            <h2 class="mt-15 fw-bold d-flex align-self-end" style="color: #c02425">
                                                {{ General::rp($min_price) }} -
                                                {{ General::rp($max_price) }}</h2>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    {{-- @foreach ($hotels as $hostel) --}}
                    {{-- <a class="card card-hostel mb-3"> --}}
                    {{-- <div class="row no-gutters"> --}}
                    {{-- <div class="col-auto"> --}}
                    {{-- <div class="img-fluid rounded-1 w-150px h-200px" --}} {{--
                                style="background-image:url('{{$hostel['hostel_image'][0]['image']}}');background-position: center;">
                                --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- <div class="col align-self-center"> --}}
                    {{-- <div class="row px-2"> --}}
                    {{-- <h4 class="card-title text-gray-900">{{$hostel['name']}}</h4> --}}
                    {{-- <div> --}}
                    {{-- @for ($j = 0; $j < $hostel['rating_avg']; $j++) <span
                                        class="card-text fa fa-star" style="color: orange;"> --}}
                    {{-- </span>@endfor --}}
                    {{-- </div> --}}
                    {{-- <p class="card-text text-gray-500 mt-1">{{$hostel['kecamatan']}},
                                    {{$hostel['city']}}</p> --}}
                    {{-- <div class="text-gray-400 fw-semibold d-block fs-6"> <s>{{"Rp " . --}}
                    {{--
                                        number_format($hostel['price_avg']-($hostel['price_avg']*0.5),0,',','.');}}R</s>
                                </div> --}}
                    {{-- <p class="fw-semibold d-block fs-2 text-danger">{{"Rp " . --}}
                    {{-- number_format($hostel['price_avg'],0,',','.');}}</p> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- </div> --}}
                    {{-- </a> --}}
                    {{-- @endforeach --}}
                </div>
            </div>
            {{-- @php
                use Carbon\Carbon;
                Carbon::setLocale('id');
                $formatted_created_at = Carbon::parse($rating->created_at)->diffForHumans();

            @endphp --}}
            <div class="row card flex-row w-75 me-auto ms-auto mt-4 p-3">
                <div class="card-body">
                    @if (count($rating) == null)
                        <h3 class="text-centers">Belum ada review</h3>
                    @else
                        <div id="kt_carousel_2_carousel" class="carousel carousel-custom slide" data-bs-ride="carousel"
                             data-bs-interval="8000">
                            <!--begin::Heading-->
                            <div class="d-flex align-items-center justify-content-between flex-wrap">
                                <!--begin::Label-->
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="card shadow-sm ms-5 bg-light" style="width: 73px; height: 55px;">
                                        <div class="row align-items-center justify-content-center text-center">
                                            <div class="d-flex align-items-center">
                                                <div class="rating-label checked mt-5 me-2">
                                                    <i class="ki-duotone ki-star fs-1"></i>
                                                </div>
                                                <div class="fs-6 fw-bold d-flex mt-5">
                                                    {{ number_format($avg_rate, 1) }}
                                                </div>
                                                <div class="fs-6 fw-bold d-flex mt-5">
                                                    / 5
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="col ms-3">
                                        <div class="fw-bold fs-5">
                                            @if ($avg_rate >= 1 && $avg_rate < 2)
                                                Sangat Kurang
                                            @elseif ($avg_rate >= 2 && $avg_rate < 3)
                                                Kurang
                                            @elseif ($avg_rate >= 3 && $avg_rate < 4)
                                                Cukup
                                            @elseif ($avg_rate >= 4 && $avg_rate < 5)
                                                Baik
                                            @elseif ($avg_rate == 5)
                                                Sangat Baik
                                            @else
                                                Nilai tidak valid
                                            @endif
                                        </div>
                                        <div class="fs-8 fw-light-grey-500">
                                            Dari {{ $rating->count() }} Review
                                        </div>
                                    </div>
                                </div>
                                {{-- <span class="fs-4 fw-bold m-5 pe-2">Review</span> --}}
                                <!--end::Label-->

                                <!--begin::Carousel Indicators-->
                                <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet">
                                    @foreach ($rating->chunk(3) as $groupIndex => $chunk)
                                        <li data-bs-target="#kt_carousel_2_carousel" data-bs-slide-to="{{ $groupIndex }}"
                                            class="ms-1 @if ($groupIndex === 0) active @endif"></li>
                                    @endforeach

                                </ol>
                                <!--end::Carousel Indicators-->
                            </div>
                            <!--end::Heading-->

                            <!--begin::Carousel-->
                            <div class="carousel-inner pt-8">
                                <!--begin::Item-->
                                @foreach ($rating->chunk(3) as $chunk)
                                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                        <div class="d-flex flex-wrap">
                                            @foreach ($chunk as $ratingItem)
                                                <div class="col-md-4 card shadow-sm mb-3">
                                                    <div class="m-4">
                                                        <div class="row">
                                                            <div class="d-flex justify-content-start align-items-center">
                                                                <div class="d-flex align-items-center justify-content-center">
                                                                    <div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px"
                                                                         data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                                                         data-kt-menu-placement="bottom-end">
                                                                        <div class="symbol symbol-50px">
                                                                            <div
                                                                                class="symbol-label fs-2 fw-bold bg-grey text-danger">
                                                                                {{ substr($ratingItem->name, 0, 1) }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col ms-5">
                                                                        <div class="fs-6 fw-bold d-flex">
                                                                            {{ $ratingItem->name ?? '_' }}
                                                                        </div>
                                                                        <div class="fs-6 fw-light-grey-500">
                                                                            {{ \Carbon\Carbon::parse($ratingItem->created)->diffForHumans() ?? 0 }}
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="rating-label checked mb-5 ms-15">
                                                                    <i class="ki-duotone ki-star fs-1"></i>
                                                                </div>
                                                                <div class="fs-6 fw-bold d-flex mb-5 ms-1">
                                                                    {{ $ratingItem->rate }}
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="col-12 mt-4">
                                                            <div class="fs-6 fw-light-grey-800">
                                                                {{ $ratingItem->comment }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                                <!--end::Item-->
                            </div>
                            <!--end::Carousel-->
                        </div>
                    @endif
                </div>

            </div>
            @if($detailHotel->hotelImage->where('main', '!=', 1)->count() != 0)
                <div class="row card flex-row w-75 me-auto ms-auto mt-4 p-3">
                    @foreach ($detailHotel->hotelImage->where('main', '!=', 1)->take(3) as $hotelImage)
                        <div class="col-4">
                            <a class="d-block overlay" data-fslightbox="lightbox-basic"
                               href="{{ asset('storage/' . $hotelImage->image) }}">
                                <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-150px"
                                     style="background-image:url('{{ asset('storage/' . $hotelImage->image) }}')">
                                </div>
                                <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                                    <i class="bi bi-eye-fill text-white fs-3x"></i>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif


                    <div class="row card w-75 me-auto ms-auto mt-10">
                    <div class="col-md-12">
                    <div class="card">
                    <div class="card-body">
                    <h3>Peraturan Hotel</h3>
                    <ul class="mb-0">
                    @foreach ($detailHotel->hotelRule as $rule)
                    <li>{{ $rule->description }}</li>
                @endforeach
                </ul>
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
                    class="path1"></span><span class="path2"></span><span
                    class="path3"></span></i>
                    <!--end::Icon-->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column pe-sm-10 pe-0">
                    <!--begin::Title-->
                    <h4 class="fw-semibold">Anda Belum Login</h4>
                    <!--end::Title-->

                    <!--begin::Content-->
                    <span>Harap login terlebih dahulu untuk melakukan pemesanan kamar. <a
                    href="{{ route('login') }}" class="d-inline-block fw-bold">Login
                    Disini</a></span>
                    <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Close-->
                    <button type="button"
                    class="position-absolute position-sm-relative m-sm-0 btn btn-icon ms-sm-auto end-0 top-0 m-2"
                    data-bs-dismiss="alert">
                    <i class="ki-duotone ki-cross fs-1 text-primary"><span
                    class="path1"></span><span
                    class="path2"></span></i>
                    </button>
                    <!--end::Close-->
                    </div>
                    <!--end::Alert-->
                    </div>
                    </div>
                @endguest

                <div class="row w-75 me-auto ms-auto mt-5">
                {{-- @foreach ($hotelget->hotelRoom as $room) --}}
                {{-- <div class="col-6"> --}}
                {{-- <div class="card card-hostel mb-3"> --}}
                {{-- <div class="row mb-2"> --}}
                {{-- <div class="col-4"> --}}
                {{-- <div class="img-fluid rounded-1 w-150px h-150px m-3" --}} {{--
                                style="background-image:url('{{$room['image_1'] != null ? $room['image_1'] : "
                                https://service.travelsya.com/storage/kamar/Lnw9eol8C1F759cRDf16qgdLBnsMgKLqjngpfw3H.jpg"}}');background-position:
                                center; "> --}}
                {{--                                    </div> --}}
                {{--                                </div> --}}
                {{--                                <div class=" col"> --}}
                {{-- <div class="row px-2 mt-5"> --}}
                {{-- <h4 class="card-title text-gray-900">{{$room->name}}</h4> --}}
                {{-- <p class="card-text text-gray-500 mt-1">Ukuran Kamar : {{$room->roomsize}} m2
                                    </p> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- <div class="card-footer d-flex justify-content-between"> --}}
                {{-- <p class="fw-semibold d-block fs-2 text-danger">{{General::rp($room->sellingprice)}}
                            </p> --}}
                {{-- <a href="{{route('hotels.reservation',$room['id'])." ?start=".$_GET['start']."
                                &duration=".$_GET['duration']." &room=".$_GET['room']." &guest=".$_GET['guest']}}"
                                class="btn btn-danger px-4 py-2">Pesan Kamar</a> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- </div> --}}
                {{-- @endforeach --}}

                @php
                    $transactionRoom = [];
                @endphp
                @foreach ($detailHotel->hotelRoom->sortBy('sellingprice') as $room)
                @php
                    // Validate and sanitize input
                    $startDate = isset($_GET['start']) ? \Carbon\Carbon::parse($_GET['start'])->format('Y-m-d') : \Carbon\Carbon::today()->format('Y-m-d');
                    $duration = isset($_GET['duration']) ? intval($_GET['duration']) : 0;

                    // Calculate end date based on start date and duration
                    $endDate = \Carbon\Carbon::parse($startDate)
                        ->addDays($duration)
                        ->format('Y-m-d');

                    $roomCount = DB::table('detail_transaction_hotel')
                        ->where('hotel_room_id', $room->id)
                        ->where(function ($query) use ($startDate, $endDate) {
                            $query->whereBetween('reservation_start', [$startDate, $endDate])->orWhereBetween('reservation_end', [$startDate, $endDate]);
                        })
                        ->count();

                    // dd($roomCount);

                    // $transactionRoom = DB::table('detail_transaction_hotel')
                    //     ->where('hotel_room_id', $room->id)
                    //     ->whereBetween('reservation_start', [$startDate, $endDate])
                    //     ->orWhereBetween('reservation_end', [$startDate, $endDate])
                    //     ->sum('room');

                    //             $transactionCount = DB::table('detail_transaction_hotel')
                    // ->where('hotel_room_id', $room->id)->where('reservation_start', '<=', $startDate)->where('reservation_end',
                    //     '>=', $endDate)
                    //     ->sum('room');

                    // dd($transactionCount);

                @endphp
                <div class="col-6">
                <div class="card card-hostel mb-3">
                <div class="row mb-2">
                <div class="col-4">
                {{-- <a class="d-block overlay" data-fslightbox="lightbox-basic-1"
                                    href="{{ asset('storage/'.$room->hotelroomImage->first()->image) }}"> --}}
                {{-- <div
                                        class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-150px"
                                        --}} {{--
                                        style="background-image:url('{{ asset('storage/'.$room->hotelroomImage->first()->image) }}')">
                                        --}}
                {{-- </div> --}}
                {{-- <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow"> --}}
                {{-- <i class="bi bi-eye-fill text-white fs-3x"></i> --}}
                {{-- </div> --}}
                {{-- </a> --}}
                @php
                    $i = 0;
                @endphp
                @foreach ($room->hotelroomImage as $roomImage)
                @php
                    $i += 1;
                @endphp
                <a class="d-block overlay {{ $i == 1 ? '' : 'd-none' }}"
                data-fslightbox="lightbox-basic-{{ $room->id }}"
                href="{{ asset('storage/' . $roomImage->image) }}">
                <div
                class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-150px"
                style="background-image:url('{{ asset('storage/' . $roomImage->image) }}')">
                </div>
                <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                <i class="bi bi-eye-fill text-white fs-3x"></i>
                </div>
                </a>
                @endforeach
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
                Tersisa
                {{ $room->totalroom - $roomCount }}
                Kamar
                </b>
                </p>
                <div class="d-flex align-items-center gap-2">
                @foreach ($room->hotelroomFacility->groupBy('facility.name') as $facility)
                <img src="{{ asset('/storage/'.$facility->first()->facility->icon) }}"
                alt="facility" width="30" class="me-1">
                @endforeach
                </div>
                </div>
                </div>
                </div>
                <div class="card-footer d-flex justify-content-between">
                <p class="fw-semibold d-block fs-2 text-danger">Rp.
                {{ number_format($room->sellingprice, 0, ',', '.') }}</p>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-danger px-4 py-2">Login Dulu</a>
                @endguest
                @auth
                    @if ($room->totalroom - $roomCount == 0)
                    <span class="badge badge-secondary badge-lg  px-4 py-2">Kamar Penuh</span>
                @else
                    <a
                    href="{{ route('hotels.reservation', ['idroom' => $room->id]) }}?location={{ $request['location'] }}&start={{ $request['start'] }}&duration={{ $request['duration'] }}&room={{ $request['room'] == 0 ? 1 : $request['room'] }}&guest={{ $request['guest'] == 0 ? 1 : $request['guest'] }}"
                    class="btn btn-danger px-4 py-2">Pesan
                    Kamar</a>
                    @endif
                @endauth
                </div>
                </div>
                </div>
                @endforeach
                </div>
                </div>
                <!--end::Post-->

                <!-- Modal-->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel"
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
                <input type="text" class="form-control form-control-lg"
                placeholder="Masukan Email Anda">
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
                {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                <input type="text" class="form-control form-control-lg"
                                    placeholder="Masukan Email Anda">
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Password</label>
                                <input type="password" class="form-control form-control-lg"
                                    placeholder="Masukan Password Anda">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-lg text-white" style="background-color: #c02425">Register</button>
                        <button class="btn btn-lg text-white" style="background-color: #c02425">Login</button>
                    </div>
                </div>
            </div>
        </div> --}}
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
                    var todayShowHotel = new Date();

                    new tempusDominus.TempusDominus(document.getElementById("js_datepicker_show_hotel"), {
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
                            minDate: todayShowHotel,
                        },
                    });
                </script>

                {{-- <script>
        --}}
                {{--  $(document).ready(function () { --}}

                {{--    $("#card-filter").hide(); --}}
                {{--    $("#button-refilter").click(function () { --}}
                {{--      $("#card-filter").toggle(); --}}
                {{--    }) --}}
                {{--    var today = new Date(); --}}
                {{--    var start = new Date("{{date('m/d/Y',$params['start_date'])}}"); --}}
                {{--    var end = new Date("{{date('m/d/Y',$params['end_date'])}}"); --}}
                {{--    $('.js-daterangepicker').daterangepicker({ --}}
                {{--      minDate: today, --}}
                {{--      startDate: start, --}}
                {{--      endDate: end --}}
                {{--    }); --}}

                {{--    var optionsort = ''; --}}
                {{--    var optionrate = ''; --}}

                {{--    $(".sortprice").on('click', function () { --}}
                {{--      optionsort = $('input[name="sortprice"]:checked').val(); --}}
                {{--      $.ajaxSetup({ --}}
                {{--        headers: { --}}
                {{--          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') --}}
                {{--        } --}}
                {{--      }); --}}
                {{--      $.ajax({ --}}
                {{--        url: "{{ url('/ajax/hostel') }}", --}}
                {{--        type: "POST", --}}
                {{--        dataType: 'json', --}}
                {{--        data: { --}}
                {{--          optionsort: optionsort, --}}
                {{--          optionrate: optionrate, --}}
                {{--          city: '{{$params['city']}}', --}}
                {{--          category: '{{$params['category']}}', --}}
                {{--          name: '{{$params['name']}}' --}}
                {{--            }, --}}
                {{--        success: function (response) { --}}
                {{--          $("#listhostel").html(''); --}}
                {{--          $.each(response, function (key, hostel) { --}}
                {{--            $("#listhostel").append(`<a class="card card-hostel mb-3"><div class="row no-gutters"><div class="col-auto"><div class="img-fluid rounded-1 w-150px h-200px"style="background-image:url('${hostel.hostel_image[0].image}');background-position: center;"></div></div><div class="col align-self-center"><div class="row px-2"><h4 class="card-title text-gray-900">${hostel.name}</h4><div><span class="card-text fa fa-star" style="color: orange;"></span></div><p class="card-text text-gray-500 mt-1">${hostel.kecamatan}, ${hostel.city}</p><div class="text-gray-400 fw-semibold d-block fs-6"> <s>${hostel.price_avg - (hostel.price_avg * 0.5)}</s></div><p class="fw-semibold d-block fs-2 text-danger">${hostel.price_avg}</p></div></div></div></a>`); --}}
                {{--          }) --}}
                {{--        } --}}
                {{--      }) --}}
                {{--    }) --}}
                {{--    $(".rate").on('click', function () { --}}
                {{--      optionrate = $('input[name="rate"]:checked').val(); --}}
                {{--      $.ajaxSetup({ --}}
                {{--        headers: { --}}
                {{--          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') --}}
                {{--        } --}}
                {{--      }); --}}
                {{--      $.ajax({ --}}
                {{--        url: "{{ url('/ajax/hostel') }}", --}}
                {{--        type: "POST", --}}
                {{--        dataType: 'json', --}}
                {{--        data: { --}}
                {{--          optionsort: optionsort, --}}
                {{--          optionrate: optionrate, --}}
                {{--          city: '{{$params['city']}}', --}}
                {{--          category: '{{$params['category']}}', --}}
                {{--          name: '{{$params['name']}}' --}}

                {{--            }, --}}
                {{--        success: function (response) { --}}
                {{--          console.log(response) --}}
                {{--          $("#listhostel").html(''); --}}
                {{--          $.each(response, function (key, hostel) { --}}
                {{--            $("#listhostel").append(`<a class="card card-hostel mb-3"><div class="row no-gutters"><div class="col-auto"><div class="img-fluid rounded-1 w-150px h-200px"style="background-image:url('${hostel.hostel_image[0].image}');background-position: center;"></div></div><div class="col align-self-center"><div class="row px-2"><h4 class="card-title text-gray-900">${hostel.name}</h4><div><span class="card-text fa fa-star" style="color: orange;"></span></div><p class="card-text text-gray-500 mt-1">${hostel.kecamatan}, ${hostel.city}</p><div class="text-gray-400 fw-semibold d-block fs-6"> <s>${hostel.price_avg - (hostel.price_avg * 0.5)}</s></div><p class="fw-semibold d-block fs-2 text-danger">${hostel.price_avg}</p></div></div></div></a>`); --}}
                {{--          }) --}}
                {{--        } --}}
                {{--      }) --}}
                {{--    }) --}}
                {{--  }) --}}
                {{--
    </script> --}}
            @endpush)
