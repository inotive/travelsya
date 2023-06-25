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
                    <div class="row card-body justify-content-center">
                        <div class="col-md-3">
                            <!--begin::Input-->
                            <select name="city" id="city" class="form-control">
                                {{--              @foreach($cities as $city)--}}
                                {{--              <option value="{{$city}}" {{($params['city']==$city) ? 'selected' : '' }}>{{$city}}</option>--}}
                                {{--              @endforeach--}}
                                <option value="">Balikpapan</option>
                                <option value="">Bontang</option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <div class="col-md-3 mb-5">
                            <!--begin::Input-->
                            <input type="text" name="date" class="form-control js-daterangepicker"
                                   id="js-daterangepicker">
                            <!--end::Input-->
                        </div>
                        <div class="col-md-2">
                            <!--begin::Input-->
                            <select name="room" id="kamar" class="form-control">
                                @for($i=1;$i<5;$i++)
                                    <option value="{{$i}}">{{$i}} Kamar</option>
                                @endfor
                            </select>
                            <!--end::Input-->
                        </div>
                        <div class="col-md-2">
                            <!--begin::Input-->
                            <select name="guest" id="tamu" class="form-control">
                                @for($j=1;$j<5;$j++)
                                    <option value="{{$j}}">{{$j}} Tamu</option>
                                @endfor
                            </select>
                            <!--end::Input-->
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-danger py-4 w-100">Cari Hotel</button>
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
                                    <img src="https://service.travelsya.com/storage/hotel/image3.webp"
                                         style="max-width: 250px; max-height: 250px" alt="">
                                </div>
                                <div class="col-8 d-flex flex-column ">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-between">
                                                <h1 class="fw-bold">OVAL GUEST HOUSE</h1>
                                                <div id="bintang">
                                                    @for($j=0;$j < rand(3,4); $j++)
                                                        <span class="card-text fa fa-star" style="color: orange;">
                                                       </span>
                                                    @endfor
                                                </div>
                                            </div>
                                            <p style="font-size: 13px">Jln. Mekar Sari RT. 19 NO. 67 Gn. Sari Ilir, Balikpapan</p>
                                            <div class="badge badge-primary">Balikpapan Tengah</div>
                                        </div>

                                    </div>
                                    <div class="row mt-auto">
                                        <div class="col-12">
                                            <h2 class="mt-15 fw-bold d-flex align-self-end" style="color: #c02425">Rp. {{number_format(123123,0,',','.')}} - Rp. {{number_format(323123,0,',','.')}}</h2>
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
            <div class="row w-75 me-auto ms-auto mt-10">
                @for($i =0; $i< 4;$i++)
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
                                        <h4 class="card-title text-gray-900">Tipe Kamar  {{$i}}</h4>
                                        <p class="card-text text-gray-500 mt-1">Ukuran Kamar : 1{{$i}} m2</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                <p class="fw-semibold d-block fs-2 text-danger">{{"Rp " .
                  number_format(132000,0,',','.')}}</p>
                                <a href="{{route('reservation.hotel')}}" class="btn btn-danger px-4 py-2">Pesan Kamar</a>
                            </div>
                        </div>
                    </div>
                @endfor


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
