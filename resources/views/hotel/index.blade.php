@extends('layouts.web')

@section('content-web')
<!--begin::Container-->
<div id="" class="row">
  <img class="d-block w-100 h-300px" src="//placehold.it/1200x300" alt="First slide">
</div>
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
  <!--begin::Post-->
  <div class="content flex-row-fluid mb-10" id="kt_content">
    <div class="row justify-content-between mb-5">
      <div class="col-md-6">
{{--        <h2 class="fw-bold text-gray-900 mt-10">Hasil pencarian di {{$params['city']}}, Indonesia</h2>--}}
{{--        <span class="text-gray-400 fw-semibold d-block fs-6 mt-n1">{{date('d M Y',$params['start_date'])}} - {{date('d M--}}
{{--          Y',$params['end_date'])}} | {{$params['guest']}} Tamu | {{$params['room']}} Kamar</span>--}}
      </div>
      <div class="col-md-6 align-self-center text-end"><button class="btn btn-danger" id="button-refilter">Pencarian</button></div>
    </div>
    <div class="row card w-75 me-auto ms-auto mt-10" id="card-filter">
      <form action="{{route('hostel.index')}}" method="get">
        <div class="row card-body justify-content-center">
          <div class="col-md-6">
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
          <div class="col-md-6 mb-5">
            <!--begin::Input-->
            <input type="text" name="date" class="form-control js-daterangepicker" id="js-daterangepicker">
            <!--end::Input-->
          </div>
          <div class="col-md-6">
            <!--begin::Input-->
            <select name="room" id="kamar" class="form-control">
                @for($i=1;$i<5;$i++)
                    <option value="{{$i}}">{{$i}} Kamar</option>
                @endfor
{{--                @for($i=1;$i<5;$i++)--}}
{{--                <option value="{{$i}}" {{($params['room']==$i) ? 'selected' : '' }}>{{$i}} Kamar</option>--}}
{{--              @endfor--}}
            </select>
            <!--end::Input-->
          </div>
          <div class="col-md-6">
            <!--begin::Input-->
            <select name="guest" id="tamu" class="form-control">
                @for($j=1;$j<5;$j++)
                    <option value="{{$j}}">{{$j}} Tamu</option>
                @endfor
{{--                @for($j=1;$j<5;$j++)--}}
{{--                <option value="{{$j}}" {{($params['guest']==$j) ? 'selected' : '' }}>{{$j}} Tamu</option>--}}
{{--              @endfor--}}
            </select>
            <!--end::Input-->
          </div>
          <div class="text-end">
            <button type="submit" class="btn btn-danger py-4 mt-10">Cari Hotel</button>
          </div>
        </div>
      </form>
    </div>
    <div class="row mt-10 justify-content-center">
      <div class="col-md-3">
        <div class="card">
          <div class="card-header py-5">
            <h3 class="fw-bold text-gray-900">Hasil Sort</h3>
            <span class="text-gray-400 fw-semibold d-block  mt-n1">Hasil pencarian berdasarkan:</span>
          </div>
          <div class="card-body form-inline">
            <input type="radio" class="form-check-input me-3 sortprice" value="highestprice"
              name="sortprice"><label>Harga Tertinggi</label></br></br>
            <input type="radio" class="form-check-input me-3 sortprice" value="lowestprice"
              name="sortprice"><label>Harga Terendah</label></br></br>
            <input type="radio" class="form-check-input me-3 sortprice" value="review" name="sortprice"><label>Nilai
              Review</label></br></br>
          </div>
        </div>
        <div class="card mt-5">
          <div class="card-header py-5">
            <h3 class="fw-bold text-gray-900">Hasil Filter</h3>
            <span class="text-gray-400 fw-semibold d-block  mt-n1">Penampilkan hostel berdasarkan filter</span>
          </div>
          <div class="card-body form-inline">
            <div>
              <h4 class="fw-bold text-gray-900">Rating Star</h4>
              <div class="card-body form-inline">
                <input type="radio" class="form-check-input me-3 mb-2 rate" value="5" name="rate"><span
                  class="fa fa-star" style="color: orange;"></span><span class="fa fa-star"
                  style="color: orange;"></span><span class="fa fa-star" style="color: orange;"></span><span
                  class="fa fa-star" style="color: orange;"></span><span class="fa fa-star"
                  style="color: orange;"></span></br>
                <input type="radio" class="form-check-input me-3 mb-2 rate" value="4" name="rate"><span
                  class="fa fa-star" style="color: orange;"></span><span class="fa fa-star"
                  style="color: orange;"></span><span class="fa fa-star" style="color: orange;"></span><span
                  class="fa fa-star" style="color: orange;"></span></br>
                <input type="radio" class="form-check-input me-3 mb-2 rate" value="3" name="rate"><span
                  class="fa fa-star" style="color: orange;"></span><span class="fa fa-star"
                  style="color: orange;"></span><span class="fa fa-star" style="color: orange;"></span></br>
                <input type="radio" class="form-check-input me-3 mb-2 rate" value="2" name="rate"><span
                  class="fa fa-star" style="color: orange;"></span><span class="fa fa-star"
                  style="color: orange;"></span></br>
                <input type="radio" class="form-check-input me-3 mb-2 rate" value="1" name="rate"><span
                  class="fa fa-star" style="color: orange;"></span></br>
              </div>

            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6" id="listhostel">
          @for($i = 0; $i <100; $i++)
              <a href="{{route('hotels.show')}}" class="card card-hostel mb-3">
                  <div class="row no-gutters">
                      <div class="col-auto">
                          <div class="img-fluid rounded-1 w-150px h-200px"
                               style="background-image:url('');background-position: center;">
                          </div>
                      </div>
                      <div class="col align-self-center">
                          <div class="row px-2">
                              <h4 class="card-title text-gray-900">Hotel A</h4>
                              <div>
                                  @for($j=0;$j < 4; $j++) <span class="card-text fa fa-star" style="color: orange;">
                    </span>@endfor
                              </div>
                              <p class="card-text text-gray-500 mt-1">Balikpapan Utara, Balikpapan</p>
                              <div class="text-gray-400 fw-semibold d-block fs-6"> <s>{{"Rp " .
                    number_format(132000,0,',','.')}}</s></div>
                              <p class="fw-semibold d-block fs-2 text-danger">{{"Rp " .
                  number_format(132000,0,',','.')}}</p>
                          </div>
                      </div>
                  </div>
              </a>
          @endfor


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
