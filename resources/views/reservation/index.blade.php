@extends('layouts.web')

@section('content-web')
    <!--begin::Container-->
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid mb-10" id="kt_content">
            <div class="row w-75 me-auto ms-auto mt-10">
                <div class="col-7">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title fw-bold">Detail Pesanan</h2>
                        </div>
                        <div class="card-body">
                            <div class="row g-5">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Nama Pemesan</label>
                                        <input type="text" class="form-control" value="Customer A">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Email Address</label>
                                        <input type="text" class="form-control" value="Customer A">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="" class="form-label">Nomor Telfon</label>
                                        <input type="text" class="form-control" value="0812123131">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <h3 class="fw-bold card-title">OVAL GUEST HOUSE</h3>
                                </div>
                                <div class="col-12">
                                    <span class="">Jln. Mekar Sari RT. 19 NO. 67 Gn. Sari Ilir, Balikpapan</span>
                                    @for($j=0;$j < rand(3,4); $j++) <span class="card-text mt-3 fa fa-star" style="color: orange;">
                                                </span>@endfor
                                </div>
                                <div class="col-12">
                                    <div class="bg-light p-4 rounded-2 mt-3">
                                        <i class="fa fa-calendar me-3"></i>
                                        22 Juni - 24 Juni, 2023 (2 Malam)
                                    </div>
                                </div>
                                <div class="col-12">
                                    <span>Tipe Kamar : </span>
                                    <span class="mt-2 fw-bold">Kamar Standart 1</span>
                                </div>
                                <div class="col-12">
                                    <div class="badge badge-success p-4 rounded-2 mt-3">
Anda Memesan 2 Kamar , 6 Tamu
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="card-footer">
                            <div class="row gy-3">
                                <div class="col-12 d-flex justify-content-between">
                                    <p>Biaya Kamar (2 Kamar)</p>
                                    <h4>Rp. {{number_format(123123*2,0,',','.')}}</h4>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <p>Extra Bed (2 Kasur)</p>
                                    <h4>Rp. {{number_format(50000*2,0,',','.')}}</h4>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-lg text-white w-100" style="background-color: #c02425">Lanjut Pembayaran</button>
                                </div>
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
