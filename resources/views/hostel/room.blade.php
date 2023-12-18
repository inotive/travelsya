@extends('layouts.web')

@section('title', 'Daftar Ruangan Pribadi')

@section('content-web')
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <div class="content flex-row-fluid mb-10" id="kt_content">
        <div class="row card w-75 me-auto ms-auto mt-10" id="card-filter">
            <form action="{{ route('hostel.index') }}" method="get">
                <input type="hidden" name="duration" value="{{ $params['duration'] }}">
                <input type="hidden" name="category" value="{{ $params['category'] }}">
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
                                        <div class="input-group" id="js_datepicker_show_hostel"
                                            data-td-target-input="nearest" data-td-target-toggle="nearest">
                                            <input id="checkin" type="text" name="start" class="form-control"
                                                data-td-target="#js_datepicker_show_hostel"
                                                x-on:change="handleSelectCheckin"
                                                value="{{ $params['start'] ?? '' }}" />
                                            <span class="input-group-text" data-td-target="#js_datepicker_show_hostel"
                                                data-td-toggle="datetimepicker">
                                                <i class="ki-duotone ki-calendar fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label for="" class="form-label fw-bold fs-6">Durasi</label>
                                        <select name="duration" class="form-select">
                                            @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}" {{
                                                $params['duration']==$i ? 'selected' :'' }}>{{ $i }} Bulan
                                                </option>
                                                @endfor
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label fw-bold fs-6">Tipe Properti</label>
                                        <select name="property" id="property" class="form-select">
                                            <option value="" {{ $params['property']=='' ? 'selected' : '' }}>
                                                Semua</option>
                                            <option value="apartemen" {{ $params['property']=='apartemen' ? 'selected'
                                                : '' }}>Apartemen</option>
                                            <option value="villa" {{ $params['property']=='villa' ? 'selected' : '' }}>
                                                Villa</option>
                                            <option value="residence" {{ $params['property']=='residence' ? 'selected'
                                                : '' }}>Residence</option>
                                            <option value="rumah" {{ $params['property']=='rumah' ? 'selected' : '' }}>
                                                Rumah</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label fw-bold fs-6">Tipe Kamar</label>
                                        <select name="roomtype" id="roomtype" class="form-select">
                                            <option value="" {{ $params['roomtype']=='' ? 'selected' : '' }}>Semua
                                            </option>
                                            <option value="1BR" {{ $params['roomtype']=='1BR' ? 'selected' : '' }}>1BR
                                            </option>
                                            <option value="2BR" {{ $params['roomtype']=='2BR' ? 'selected' : '' }}>2BR
                                            </option>
                                            <option value="3BR+" {{ $params['roomtype']=='3BR' ? 'selected' : '' }}>3BR+
                                            </option>
                                        </select>
                                    </div>

                                    {{-- @php
                                    $checkin = \Carbon\Carbon::parse($params['start']);
                                    $duration = $params['duration'];

                                    // Hitung tanggal checkout
                                    $checkout = $checkin->copy()->addDays($duration);
                                    @endphp

                                    <div class="col-3">
                                        <label class="form-label fw-bold fs-6">Tanggal Checkout</label>
                                        <input type="text" class="form-control" name="end_date"
                                            value="{{ $checkout->format('d-m-Y') }}" />
                                    </div> --}}
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
                                {{-- <img src="https://service.travelsya.com/storage/hotel/image3.webp"
                                    style="max-width: 250px; max-height: 250px" alt=""> --}}
                                    @php
                                    $hostelImage = $hostelget->hostelImage->where('main', 1)->first();
                                    $image = $hostelImage !== null ? 'storage/media/hostel/' . $hostelImage->image : null;
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
                                        <div class="row g-5 mb-3">
                                            <div class="col-sm-6">
                                                <div class="fw-semibold fs-7 text-gray-700 mb-2">Checkin:</div>
                                                <span
                                                    class="badge badge-light-danger me-2">{{ $hostelget->checkin }}</span>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="fw-semibold fs-7 text-gray-700 mb-2">Checkout:</div>
                                                <span
                                                    class="badge badge-light-danger me-2">{{ $hostelget->checkout }}</span>
                                            </div>
                                        </div>
                                        <div class="separator"></div>
                                        <div class="row mt-1">
                                            <div class="col-md-2">
                                                <div class="fw-semibold text-gray-600 fs-7">Phone:</div>
                                            </div>
                                            <div class="col">
                                                <div class="fw-bold text-gray-800 fs-6">
                                                    {{ $hostelget->phone ?? '-' }}</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="fw-semibold text-gray-600 fs-7">Website:</div>
                                            </div>
                                            <div class="col">
                                                <div class="fw-bold text-gray-800 fs-6">
                                                    {!! isset($hostelget->website)
                                                        ? '<a href="' .
                                                            (str_starts_with($hostelget->website, 'http://') || str_starts_with($hostelget->website, 'https://')
                                                                ? $hostelget->website
                                                                : 'http://' . $hostelget->website) .
                                                            '" target="_blank" rel="noopener">' .
                                                            (str_starts_with($hostelget->website, 'http://') || str_starts_with($hostelget->website, 'https://')
                                                                ? substr($hostelget->website, strpos($hostelget->website, '://') + 3)
                                                                : $hostelget->website) .
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
                                                    {{ $hostelget->email ?? '-' }}</div>
                                            </div>
                                        </div>
                                        <div class="separator"></div>
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

        <div class="row card flex-row w-75 me-auto ms-auto mt-4 p-3">
            @foreach ($hostelget->hostelImage->where('main', '!=', 1)->take(3) as $hostelImage)
            <div class="col-4">
                <a class="d-block overlay" data-fslightbox="lightbox-basic"
                    href="{{ asset('storage/media/hostel/'.$hostelImage->image) }}">
                    <!--begin::Image-->
                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-150px"
                        style="background-image:url('{{ asset('storage/media/hostel/'.$hostelImage->image) }}')">
                    </div>
                    <!--end::Image-->

                    <!--begin::Action-->
                    <div class="overlay-layer card-rounded bg-dark bg-opacity-25 shadow">
                        <i class="bi bi-eye-fill text-white fs-3x"></i>
                    </div>
                    <!--end::Action-->
                </a>
            </div>
            @endforeach
        </div>


        <div class="row card w-75 me-auto ms-auto mt-10">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Peraturan Hostel</h3>
                        <ul class="mb-0">
                            @foreach ($hostelget->hostelRule as $rule)
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
                            class="path1"></span><span class="path2"></span><span class="path3"></span></i>
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
            @foreach ($hostelget->hostelRoom->sortBy('sellingprice') as $room)
            @php
            $startDate = date("Y-m-d", strtotime($params['start']));
            $endDate = date("Y-m-d", strtotime("+" . $params['duration'] . " month", strtotime($startDate)));
            $transactionCount = DB::table('detail_transaction_hostel')
            ->where('hostel_room_id', $room->id)->where('reservation_start', '<=', $startDate)->where('reservation_end',
                '>=', $endDate)
                ->sum('room');
                @endphp
                <div class="col-6">
                    <div class="card card-hostel mb-3">
                        <div class="row mb-2">
                            <div class="col-4">
                                @php
                                $i = 0;
                                @endphp
                                @foreach ($room->hostelroomImage as $roomImage)
                                @php
                                $i += 1;
                                @endphp
                                <a class="d-block overlay {{$i == 1 ? '' : 'd-none'}}"
                                    data-fslightbox="lightbox-basic-{{$room->id}}"
                                    href="{{ asset('storage/' . $roomImage->image) }}">
                                    <div class="overlay-wrapper bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-150px"
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
                                    <p class="card-text mt-1 text-gray-500">Maximal Penghuni : {{ $room->max_guest }}
                                        Orang</p>
                                    <p class="card-text mt-1 text-gray-500">
                                        <b class="text-danger">
                                            Tersisa {{ $room->totalroom - $transactionCount }} Unit
                                        </b>
                                    </p>
                                    <div class="d-flex align-items-center gap-2">
                                        @foreach ($room->hostelFacilities->unique() as $facility)
                                        <img src="{{ asset($facility->image) }}" alt="Fasilitas">
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            @if ($params['category'] == 'monthly')
                            <p class="fw-semibold d-block fs-2 text-danger">Rp.
                                {{ number_format($room->sellingrentprice_monthly, 0, ',', '.') }}</p>
                            @endif

                            @if ($params['category'] == 'yearly')
                            <p class="fw-semibold d-block fs-2 text-danger">Rp.
                                {{ number_format($room->sellingrentprice_yearly, 0, ',', '.') }}</p>
                            @endif

                            @guest
                            <a href="{{ route('login') }}" class="btn btn-danger px-4 py-2">Login Dulu</a>
                            @endguest

                            @auth
                            <a href="{{ route('hostel.checkout', ['idroom' => $room->id]) }}?start={{ $params['start'] }}&duration={{ $params['duration'] }}&category={{ $params['category'] }}"
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
<script src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}"></script>
<script>
    $(document).ready(function() {
        new tempusDominus.TempusDominus(document.getElementById("js_datepicker_show_hostel"), {
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