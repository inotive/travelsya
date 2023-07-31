@extends('layouts.web')

@section('content-web')
    <!--begin::Container-->
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid mb-10" id="kt_content">
            {{--            <div class="row justify-content-between mb-5">--}}
            {{--                <div class="col-md-6">--}}
            {{--                    --}}{{--        <h2 class="fw-bold text-gray-900 mt-10">Hasil pencarian di {{$params['city']}}, Indonesia</h2>--}}
            {{--                    --}}{{--        <span class="text-gray-400 fw-semibold d-block fs-6 mt-n1">{{date('d M Y',$params['start_date'])}} - {{date('d M--}}
            {{--                    --}}{{--          Y',$params['end_date'])}} | {{$params['guest']}} Tamu | {{$params['room']}} Kamar</span>--}}
            {{--                </div>--}}
            {{--                <div class="col-md-6 align-self-center text-end"><button class="btn btn-danger" id="button-refilter">Pencarian</button></div>--}}
            {{--            </div>--}}
            <div class="row card w-75 me-auto ms-auto mt-10" id="card-filter">
                <form action="{{route('hostel.index')}}" method="get">
{{--                    <div class="row card-body justify-content-center">--}}
{{--                        <div class="col-md-3">--}}
{{--                            <!--begin::Input-->--}}
{{--                            <select name="city" id="city" class="form-control">--}}
{{--                                @foreach($cities as $city)--}}
{{--                                <option value="{{$city}}" {{($params['location']==$city) ? 'selected' : '' }}>{{$city}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <!--end::Input-->--}}
{{--                        </div>--}}
{{--                        <div class="col-md-3 mb-5">--}}
{{--                            <!--begin::Input-->--}}
{{--                            <input type="text" name="date" class="form-control js-daterangepicker"--}}
{{--                                   id="js-daterangepicker">--}}
{{--                            <!--end::Input-->--}}
{{--                        </div>--}}
{{--                        <div class="col-md-2">--}}
{{--                            <!--begin::Input-->--}}
{{--                            <select name="room" id="kamar" class="form-control">--}}
{{--                                @for($i=1;$i<5;$i++)--}}
{{--                                    <option value="{{$i}}">{{$i}} Kamar</option>--}}
{{--                                @endfor--}}
{{--                            </select>--}}
{{--                            <!--end::Input-->--}}
{{--                        </div>--}}
{{--                        <div class="col-md-2">--}}
{{--                            <!--begin::Input-->--}}
{{--                            <select name="guest" id="tamu" class="form-control">--}}
{{--                                @for($j=1;$j<5;$j++)--}}
{{--                                    <option value="{{$j}}">{{$j}} Tamu</option>--}}
{{--                                @endfor--}}
{{--                            </select>--}}
{{--                            <!--end::Input-->--}}
{{--                        </div>--}}
{{--                        <div class="col-md-2">--}}
{{--                            <button type="submit" class="btn btn-danger py-4 w-100">Cari Hotel</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="row gy-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body h-100">
                                    <div class="row g-4">
                                        <div class="col-12">
                                            <label class="form-label fw-bold fs-6">Pilih Lokasi</label>
                                            <select name="location" id="location" class="form-select select" data-control="select2" data-placeholder="Pilih Lokasi" autocomplete="on">
                                                <optgroup label="Kota"></optgroup>
                                                <template x-for="data in $store.hotel.cities">
                                                    <option x-bind:value="data.name" x-text="data.label"></option>
                                                </template>
                                                <optgroup label="Hotel"></optgroup>
                                                <template x-for="data in $store.hotel.hotels">
                                                    <option x-bind:value="data.name" x-text="data.label"></option>
                                                </template>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label fw-bold fs-6">Tanggal Check-in</label>
                                            <div class="input-group" id="js_datepicker" data-td-target-input="nearest" data-td-target-toggle="nearest">
                                                <input id="checkin" type="text" name="start" class="form-control" data-td-target="#js_datepicker" x-on:change="handleSelectCheckin"/>
                                                <span class="input-group-text" data-td-target="#js_datepicker" data-td-toggle="datetimepicker">
                                                    <i class="ki-duotone ki-calendar fs-2">
                                                      <span class="path1"></span>
                                                      <span class="path2"></span>
                                                    </i>
                                                  </span>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label fw-bold fs-6">Tanggal Checkout</label>
                                            <input type="text" class="form-control" name="end_date" />
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label fw-bold fs-6">Total Kamar</label>
                                            <select name="room" id="room" class="form-select" x-on:change="handleSelectRoom">
                                                <template x-for="data in [ ...Array(totalRoom).keys() ]" key="data">
                                                    <option x-bind:value="data" x-text="data === 0 ? `Pilih Jumlah Kamar` : `${data} Kamar`">-</option>
                                                </template>
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <label class="form-label fw-bold fs-6">Total Tamu</label>
                                            <select name="guest" id="guest" class="form-select">
                                                <template x-for="data in [ ...Array(totalGuest).keys() ]" key="data">
                                                    <option x-bind:value="data" x-text="data === 0 ? `Pilih Jumlah Tamu` : `${data} Tamu`">-</option>
                                                </template>
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
            <div class="row w-75 me-auto ms-auto mt-10">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">
{{--                                    <img src="{{$hotelget['hostelImage'] != null ? $hostelget['hostelImage'][0]['image'] : 'https://service.travelsya.com/storage/hotel/image3.webp'}}"--}}
{{--                                         style="max-width: 250px; max-height: 250px" alt="">--}}
                                    <img src="https://service.travelsya.com/storage/hotel/image3.webp"
                                         style="max-width: 250px; max-height: 250px" alt="">
                                </div>
                                <div class="col-8 d-flex flex-column ">
{{--                                    <div class="row">--}}
{{--                                        <div class="col-12">--}}
{{--                                            <div class="d-flex justify-content-between">--}}
{{--                                                <h1 class="fw-bold">{{$hotelget->name}}</h1>--}}
{{--                                                <div id="bintang">--}}

{{--                                                    @for($j=0;$j < $hotelget->rating_avg; $j++)--}}
{{--                                                        <span class="card-text fa fa-star" style="color: orange;">--}}
{{--                                                       </span>--}}
{{--                                                    @endfor--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                            <p style="font-size: 13px">{{$hotelget->address}}</p>--}}
{{--                                            <div class="badge badge-primary">{{$hotelget->city}}</div>--}}
{{--                                        </div>--}}

{{--                                    </div>--}}
{{--                                    <div class="row mt-auto">--}}
{{--                                        <div class="col-12">--}}
{{--                                            <h2 class="mt-15 fw-bold d-flex align-self-end" style="color: #c02425">{{General::rp($hotelget->minprice)}} - {{General::rp($hotelget->maxprice)}}</h2>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between">
                                                <h1 class="fw-bold">OVAL GUEST HOUSE</h1>
                                                <div class="badge badge-primary">Balikpapan</div>
                                            </div>
                                            <p style="font-size: 13px">Jln. Mekar Sari RT. 19 NO. 67 Gn. Sari Ilir, Balikpapan</p>

                                            <div id="bintang ">
                                                @for($j=0;$j < 5; $j++)
                                                    <span class="card-text fa fa-star" style="color: orange;">
                                                       </span>
                                                @endfor
                                            </div>

                                            <span class="badge badge-danger mt-4">4.4</span>
                                            <span class="badge badge-danger">(123 Rating)</span>

                                        </div>

                                    </div>
                                    <div class="row mt-auto">
                                        <div class="col-12">
                                            <h2 class="mt-15 fw-bold d-flex align-self-end" style="color: #c02425">Rp 124.000 - Rp 324.000 </h2>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    {{--          @foreach($hotels as $hostel)--}}
                    {{--        <a class="card card-hostel mb-3">--}}
                    {{--          <div class="row no-gutters">--}}
                    {{--            <div class="col-auto">--}}
                    {{--              <div class="img-fluid rounded-1 w-150px h-200px"--}}
                    {{--                style="background-image:url('{{$hostel['hostel_image'][0]['image']}}');background-position: center;">--}}
                    {{--              </div>--}}
                    {{--            </div>--}}
                    {{--            <div class="col align-self-center">--}}
                    {{--              <div class="row px-2">--}}
                    {{--                <h4 class="card-title text-gray-900">{{$hostel['name']}}</h4>--}}
                    {{--                <div>--}}
                    {{--                  @for($j=0;$j < $hostel['rating_avg']; $j++) <span class="card-text fa fa-star" style="color: orange;">--}}
                    {{--                    </span>@endfor--}}
                    {{--                </div>--}}
                    {{--                <p class="card-text text-gray-500 mt-1">{{$hostel['kecamatan']}}, {{$hostel['city']}}</p>--}}
                    {{--                <div class="text-gray-400 fw-semibold d-block fs-6"> <s>{{"Rp " .--}}
                    {{--                    number_format($hostel['price_avg']-($hostel['price_avg']*0.5),0,',','.');}}R</s></div>--}}
                    {{--                <p class="fw-semibold d-block fs-2 text-danger">{{"Rp " .--}}
                    {{--                  number_format($hostel['price_avg'],0,',','.');}}</p>--}}
                    {{--              </div>--}}
                    {{--            </div>--}}
                    {{--          </div>--}}
                    {{--        </a>--}}
                    {{--        @endforeach--}}
                </div>
            </div>
            <div class="row w-75 me-auto ms-auto my-5">
                <div class="col-12">
                    <!--begin::Alert-->
                    <div class="alert alert-dismissible bg-light-warning d-flex flex-column flex-sm-row p-5 mb-10">
                        <!--begin::Icon-->
                        <i class="ki-duotone ki-notification-bing fs-2hx text-dark me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                        <!--end::Icon-->

                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column pe-0 pe-sm-10">
                            <!--begin::Title-->
                            <h4 class="fw-semibold">Anda Belum Login</h4>
                            <!--end::Title-->

                            <!--begin::Content-->
                            <span>Harap login terlebih dahulu untuk melakukan pemesanan kamar. <a role="button" class="d-inline-block fw-bold" data-toggle="modal" data-target="#exampleModal" >Login Disini</a></span>
                            <!--end::Content-->
                        </div>
                        <!--end::Wrapper-->

                        <!--begin::Close-->
                        <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                            <i class="ki-duotone ki-cross fs-1 text-primary"><span class="path1"></span><span class="path2"></span></i>
                        </button>
                        <!--end::Close-->
                    </div>
                    <!--end::Alert-->
                </div>
            </div>
            <div class="row w-75 me-auto ms-auto">
{{--                @foreach($hotelget->hotelRoom as $room)--}}
{{--                    <div class="col-6">--}}
{{--                        <div class="card card-hostel mb-3">--}}
{{--                            <div class="row mb-2">--}}
{{--                                <div class="col-4">--}}
{{--                                    <div class="img-fluid rounded-1 w-150px h-150px m-3"--}}
{{--                                         style="background-image:url('{{$room['image_1'] != null ? $room['image_1'] : "https://service.travelsya.com/storage/kamar/Lnw9eol8C1F759cRDf16qgdLBnsMgKLqjngpfw3H.jpg"}}');background-position: center; ">--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col">--}}
{{--                                    <div class="row px-2 mt-5">--}}
{{--                                        <h4 class="card-title text-gray-900">{{$room->name}}</h4>--}}
{{--                                        <p class="card-text text-gray-500 mt-1">Ukuran Kamar : {{$room->roomsize}} m2</p>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card-footer d-flex justify-content-between">--}}
{{--                                <p class="fw-semibold d-block fs-2 text-danger">{{General::rp($room->sellingprice)}}</p>--}}
{{--                                <a href="{{route('hotels.reservation',$room['id'])."?start=".$_GET['start']."&duration=".$_GET['duration']."&room=".$_GET['room']."&guest=".$_GET['guest']}}" class="btn btn-danger px-4 py-2">Pesan Kamar</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
                <div class="col-6">
                    <div class="card card-hostel mb-3">
                        <div class="row mb-2">
                            <div class="col-4">
                                <div class="img-fluid rounded-1 w-150px h-150px m-3"
                                     style="background-image:url('https://service.travelsya.com/storage/kamar/Lnw9eol8C1F759cRDf16qgdLBnsMgKLqjngpfw3H.jpg');background-position: center; ">
                                </div>
                            </div>
                            <div class="col">
                                <div class="row px-2 mt-5">
                                    <h4 class="card-title text-gray-900">Kamar 2</h4>
                                    <p class="card-text text-gray-500 mt-1">Ukuran Kamar : 12 m2</p>
                                    <p class="card-text text-gray-500 mt-1">Maximal Penghuni : 1 Orang</p>
                                    <p class="card-text text-gray-500 mt-1"><b class="text-danger">Tersisa 2 Kamar </b></p>
                                    <div>
                                        <span class="me-2"><i class="fas fa-bath fs-3"></i></span>
                                        <span class="me-2"><i class="fas fa-wifi fs-3"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <p class="fw-semibold d-block fs-2 text-danger">Rp. 131.123</p>
                            <a href="{{route('hotels.reservation.example')}}" class="btn btn-danger px-4 py-2" data-toggle="modal" data-target="#exampleModal">Pesan Kamar</a>
                        </div>
                    </div>
                </div>
                        <div class="col-6">
                            <div class="card card-hostel mb-3">
                                <div class="row mb-2">
                                    <div class="col-4">
                                        <div class="img-fluid rounded-1 w-150px h-150px m-3"
                                             style="background-image:url('https://service.travelsya.com/storage/kamar/Lnw9eol8C1F759cRDf16qgdLBnsMgKLqjngpfw3H.jpg');background-position: center; ">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row px-2 mt-5">
                                            <h4 class="card-title text-gray-900">Kamar 1</h4>
                                            <p class="card-text text-gray-500 mt-1">Ukuran Kamar : 12 m2</p>
                                            <p class="card-text text-gray-500 mt-1">Maximal Penghuni : 1 Orang</p>
                                            <p class="card-text text-gray-500 mt-1"><b class="text-danger">Tersisa 5 Kamar </b></p>
                                            <div>
                                                <span class="me-2"><i class="fas fa-bath fs-3"></i></span>
                                                <span class="me-2"><i class="fas fa-wifi fs-3"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <p class="fw-semibold d-block fs-2 text-danger">Rp. 131.123</p>
                                    <a role="button" class="btn btn-light px-4 py-2" disabled>Kapasitas Tidak Mencukupi</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="card card-hostel mb-3">
                                <div class="row mb-2">
                                    <div class="col-4">
                                        <div class="img-fluid rounded-1 w-150px h-150px m-3"
                                             style="background-image:url('https://service.travelsya.com/storage/kamar/Lnw9eol8C1F759cRDf16qgdLBnsMgKLqjngpfw3H.jpg');background-position: center; ">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row px-2 mt-5">
                                            <h4 class="card-title text-gray-900">Kamar 1</h4>
                                            <p class="card-text text-gray-500 mt-1">Ukuran Kamar : 12 m2</p>
                                            <p class="card-text text-gray-500 mt-1">Maximal Penghuni : 1 Orang</p>
                                            <div>
                                                <span class="me-2"><i class="fas fa-bath fs-3"></i></span>
                                                <span class="me-2"><i class="fas fa-wifi fs-3"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-between">
                                    <p class="fw-semibold d-block fs-2 text-danger">Rp. 131.123</p>
                                    <a role="button" class="btn btn-light px-4 py-2" disabled>Sedang Terisi Full</a>
                                </div>
                            </div>
                        </div>


            </div>
        </div>
        <!--end::Post-->
        <!-- Modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="password" class="form-control form-control-lg" placeholder="Masukan Password Anda">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-lg btn-light" >Kembali</button>
                        <a href="{{route('hotels.reservation.example')}}" class="btn btn-lg text-white"  style="background-color: #c02425">Login</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                <input type="password" class="form-control form-control-lg" placeholder="Masukan Password Anda">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-lg text-white"  style="background-color: #c02425">Register</button>
                        <button class="btn btn-lg text-white"  style="background-color: #c02425">Login</button>
                    </div>
                </div>
            </div>
        </div>
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

{{--@push('add-script')--}}
{{--<script>--}}
{{--  $(document).ready(function () {--}}

{{--    $("#card-filter").hide();--}}
{{--    $("#button-refilter").click(function () {--}}
{{--      $("#card-filter").toggle();--}}
{{--    })--}}
{{--    var today = new Date();--}}
{{--    var start = new Date("{{date('m/d/Y',$params['start_date'])}}");--}}
{{--    var end = new Date("{{date('m/d/Y',$params['end_date'])}}");--}}
{{--    $('.js-daterangepicker').daterangepicker({--}}
{{--      minDate: today,--}}
{{--      startDate: start,--}}
{{--      endDate: end--}}
{{--    });--}}

{{--    var optionsort = '';--}}
{{--    var optionrate = '';--}}

{{--    $(".sortprice").on('click', function () {--}}
{{--      optionsort = $('input[name="sortprice"]:checked').val();--}}
{{--      $.ajaxSetup({--}}
{{--        headers: {--}}
{{--          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')--}}
{{--        }--}}
{{--      });--}}
{{--      $.ajax({--}}
{{--        url: "{{ url('/ajax/hostel') }}",--}}
{{--        type: "POST",--}}
{{--        dataType: 'json',--}}
{{--        data: {--}}
{{--          optionsort: optionsort,--}}
{{--          optionrate: optionrate,--}}
{{--          city: '{{$params['city']}}',--}}
{{--          category: '{{$params['category']}}',--}}
{{--          name: '{{$params['name']}}'--}}
{{--            },--}}
{{--        success: function (response) {--}}
{{--          $("#listhostel").html('');--}}
{{--          $.each(response, function (key, hostel) {--}}
{{--            $("#listhostel").append(`<a class="card card-hostel mb-3"><div class="row no-gutters"><div class="col-auto"><div class="img-fluid rounded-1 w-150px h-200px"style="background-image:url('${hostel.hostel_image[0].image}');background-position: center;"></div></div><div class="col align-self-center"><div class="row px-2"><h4 class="card-title text-gray-900">${hostel.name}</h4><div><span class="card-text fa fa-star" style="color: orange;"></span></div><p class="card-text text-gray-500 mt-1">${hostel.kecamatan}, ${hostel.city}</p><div class="text-gray-400 fw-semibold d-block fs-6"> <s>${hostel.price_avg - (hostel.price_avg * 0.5)}</s></div><p class="fw-semibold d-block fs-2 text-danger">${hostel.price_avg}</p></div></div></div></a>`);--}}
{{--          })--}}
{{--        }--}}
{{--      })--}}
{{--    })--}}
{{--    $(".rate").on('click', function () {--}}
{{--      optionrate = $('input[name="rate"]:checked').val();--}}
{{--      $.ajaxSetup({--}}
{{--        headers: {--}}
{{--          'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')--}}
{{--        }--}}
{{--      });--}}
{{--      $.ajax({--}}
{{--        url: "{{ url('/ajax/hostel') }}",--}}
{{--        type: "POST",--}}
{{--        dataType: 'json',--}}
{{--        data: {--}}
{{--          optionsort: optionsort,--}}
{{--          optionrate: optionrate,--}}
{{--          city: '{{$params['city']}}',--}}
{{--          category: '{{$params['category']}}',--}}
{{--          name: '{{$params['name']}}'--}}

{{--            },--}}
{{--        success: function (response) {--}}
{{--          console.log(response)--}}
{{--          $("#listhostel").html('');--}}
{{--          $.each(response, function (key, hostel) {--}}
{{--            $("#listhostel").append(`<a class="card card-hostel mb-3"><div class="row no-gutters"><div class="col-auto"><div class="img-fluid rounded-1 w-150px h-200px"style="background-image:url('${hostel.hostel_image[0].image}');background-position: center;"></div></div><div class="col align-self-center"><div class="row px-2"><h4 class="card-title text-gray-900">${hostel.name}</h4><div><span class="card-text fa fa-star" style="color: orange;"></span></div><p class="card-text text-gray-500 mt-1">${hostel.kecamatan}, ${hostel.city}</p><div class="text-gray-400 fw-semibold d-block fs-6"> <s>${hostel.price_avg - (hostel.price_avg * 0.5)}</s></div><p class="fw-semibold d-block fs-2 text-danger">${hostel.price_avg}</p></div></div></div></a>`);--}}
{{--          })--}}
{{--        }--}}
{{--      })--}}
{{--    })--}}
{{--  })--}}
{{--</script>--}}
{{--@endpush--}}
