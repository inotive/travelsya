@extends('layouts.web')

@section('content-web')

    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
        <!--begin::Post-->
        <div class="content flex-row-fluid mb-10" id="kt_content">
            <div class="row">
                <div class="col-3">
                    <div class="card border-1 border-light ">
                        <div class="card-body h-100">
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="" class="form-label">Urutan Harga</label>
                                </div>
                                <div class="col-12">
                                    <!--begin::Radio group-->
                                    <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                        <!--begin::Radio-->
                                        <label class="btn btn-outline btn-color-muted  active fs-9" data-kt-button="true">
                                            <!--begin::Input-->
                                            <input class="btn-check" type="radio" name="method" value="1"/>
                                            <!--end::Input-->
Harga Tertinggi
                                        </label>
                                        <!--end::Radio-->

                                        <!--begin::Radio-->
                                        <label class="btn btn-outline btn-color-muted btn-active-danger  fs-9" data-kt-button="true">
                                            <!--begin::Input-->
                                            <input class="btn-check" type="radio" name="method" checked="checked" value="2"/>
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
                                    <button class="w-100 btn-danger btn">Terapkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9">
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
                                            <button class="w-100 btn-danger btn">Cari Data</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body h-100">
                                    <div class="row my-4">
                                        <div class="col-3">
                                            <img src="https://service.travelsya.com/storage/hotel/image3.webp" alt="" height="200" width="200">
                                        </div>
                                        <div class="col-6">
                                            <div class="row gy-4">
                                                <div class="col-12"><h3>OVAL GUEST HOUSE</h3></div>
                                                <div class="col-12">
                                                    <span class="badge badge-danger">4.4</span>
                                                    <span class="badge badge-danger">(123 Rating)</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="card-text fa fa-star" style="color: orange;"></span>
                                                    <span class="card-text fa fa-star" style="color: orange;"></span>
                                                    <span class="card-text fa fa-star" style="color: orange;"></span>
                                                </div>
                                                <div class="col-12">
                                                    <p>Jln. Mekar Sari RT. 19 NO. 67 Gn. Sari Ilir, Balikpapan</p>
                                                </div>
                                                <div class="col-12">
                                                    <h2 class=" card-title text-danger">Rp 124.000 - Rp 324.000 </h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <h3 class="mb-4">Fasilitas</h3>
                                            <span class="me-2"><i class="fas fa-bath fs-3"></i></span>
                                            <span class="me-2"><i class="fas fa-wifi fs-3"></i></span>
                                            <a href="{{route('hotels.room')}}" class="btn btn-danger text-white mt-10 d-block">Lihat Room</a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row my-4">
                                        <div class="col-3">
                                            <img src="https://service.travelsya.com/storage/hotel/image3.webp" alt="" height="200" width="200">
                                        </div>
                                        <div class="col-6">
                                            <div class="row gy-4">
                                                <div class="col-12"><h3>OVAL GUEST HOUSE</h3></div>
                                                <div class="col-12">
                                                    <span class="badge badge-danger">4.4</span>
                                                    <span class="badge badge-danger">(123 Rating)</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="card-text fa fa-star" style="color: orange;"></span>
                                                    <span class="card-text fa fa-star" style="color: orange;"></span>
                                                    <span class="card-text fa fa-star" style="color: orange;"></span>
                                                </div>
                                                <div class="col-12">
                                                    <p>Jln. Mekar Sari RT. 19 NO. 67 Gn. Sari Ilir, Balikpapan</p>
                                                </div>
                                                <div class="col-12">
                                                    <h2 class=" card-title text-danger">Rp 124.000 - Rp 324.000 </h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <h3 class="mb-4">Fasilitas</h3>
                                            <span class="me-2"><i class="fas fa-bath fs-3"></i></span>
                                            <span class="me-2"><i class="fas fa-wifi fs-3"></i></span>
                                            <a class="btn btn-danger text-white mt-10 d-block">Lihat Room</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
{{--            <div class="row justify-content-between mb-5">--}}
{{--                <div class="col-md-6">--}}
{{--                    <h2 class="fw-bold text-gray-900 mt-10">Hasil pencarian di {{$params['location']}}, Indonesia</h2>--}}
{{--                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-n1">{{date('d M Y',$params['start_date'])}} - {{date('d M Y',$params['end_date'])}} | {{$params['guest']}}  Tamu | {{$params['room']}} Kamar</span>--}}
{{--                </div>--}}
{{--                <div class="col-md-6 align-self-center text-end"><button class="btn btn-danger" id="button-refilter">Pencarian</button></div>--}}
{{--            </div>--}}
{{--            <div class="row card w-75 me-auto ms-auto mt-10" id="card-filter">--}}
{{--                <form action="{{route('hostel.index')}}" method="get">--}}
{{--                    <div class="row card-body justify-content-center">--}}
{{--                        <div class="col-md-6">--}}
{{--                            <!--begin::Input-->--}}
{{--                            <select name="city" id="city" class="form-control">--}}
{{--                                @foreach($cities as $city)--}}
{{--                                    <option value="{{$city}}" {{($params['location'] == $city) ? 'selected' : '' }}>{{$city}}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            <!--end::Input-->--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6 mb-5">--}}
{{--                            <!--begin::Input-->--}}
{{--                            <input type="text" name="date" class="form-control js-daterangepicker" id="js-daterangepicker">--}}
{{--                            <!--end::Input-->--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <!--begin::Input-->--}}
{{--                            <select name="room" id="kamar" class="form-control">--}}
{{--                                @for($i=1;$i<5;$i++)--}}
{{--                                    <option value="{{$i}}" {{($params['room'] == $i) ? 'selected' : '' }}>{{$i}} Kamar</option>--}}
{{--                                @endfor--}}
{{--                            </select>--}}
{{--                            <!--end::Input-->--}}
{{--                        </div>--}}
{{--                        <div class="col-md-6">--}}
{{--                            <!--begin::Input-->--}}
{{--                            <select name="guest" id="tamu" class="form-control">--}}
{{--                                @for($j=1;$j<5;$j++) <option value="{{$j}}" {{($params['guest'] == $j) ? 'selected' : '' }}>{{$j}} Tamu</option>--}}
{{--                                @endfor--}}
{{--                            </select>--}}
{{--                            <!--end::Input-->--}}
{{--                        </div>--}}

{{--                        <div class="text-end">--}}
{{--                            <button type="submit" class="btn btn-danger py-4 mt-10">Cari Hotel</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <div class="row mt-5 ">--}}
{{--                <div class="card">--}}
{{--                    <div class="card-body">--}}
{{--                        <div class="row justify-content-between">--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="d-flex flex-row gap-5">--}}
{{--                                    <img src="{{$hostelget['hostelImage'][0]['image']}}" width="200" alt="">--}}
{{--                                    <div class="d-flex flex-column gap-4 align-items-end">--}}
{{--                                        @foreach($hostelget['hostelImage'] as $image)--}}
{{--                                            <img src="{{$image['image']}}" width="100" alt="">--}}
{{--                                            <img src="{{$image['image']}}" width="100" alt="">--}}
{{--                                        @endforeach--}}

{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="d-flex flex-column gap-4">--}}
{{--                                    <h4 class="card-title text-gray-900">{{$hostelget['name']}}</h4>--}}
{{--                                    <p class="card-text text-gray-500 mt-1">{{$hostelget['address']}}</p>--}}
{{--                                    <p class="card-text text-gray-500 mt-1">{{$hostelget['kecamatan']}}, {{$hostelget['city']}}</p>--}}


{{--                                    <p class="fw-semibold d-block fs-2 text-danger">{{General::rp($hostelget['price_avg'])}}</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="d-flex flex-column align-items-center gap-20">--}}
{{--                                    <div>--}}
{{--                                        @for($j=0;$j < $hostelget['rating_avg']; $j++) <span class="card-text fa fa-star" style="color: orange;"></span>@endfor--}}
{{--                                        @if($hostelget['rating_avg'] == 0)--}}
{{--                                            @for($j=0;$j < 4; $j++) <span class="card-text fa fa-star" style="color: orange;"></span>@endfor--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                    <p class="card-text text-gray-500 mt-auto">{{$hostelget['phone']}}</p>--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="row mt-5 justify-content-between">--}}
{{--                @foreach($hostelget['hostelRoom'] as $hostel)--}}
{{--                    <div class="col-md-5">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="row justify-content-between">--}}
{{--                                    <div class="col-md-5">--}}
{{--                                        <div class="d-flex flex-row gap-5">--}}
{{--                                            <img src="{{$hostel['image_1']}}" width="200" alt="">--}}
{{--                                            <div class="d-flex flex-column gap-4 align-items-end">--}}

{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                    <div class="col-md-5">--}}
{{--                                        <div class="d-flex flex-column">--}}
{{--                                            <h4 class="card-title text-gray-900">{{$hostel['name']}}</h4>--}}
{{--                                            <p class="card-text text-gray-500 mt-1">{{$hostel['furnish']}}</p>--}}
{{--                                            <p class="card-text text-gray-500">{{$hostel['roomtype']}}</p>--}}
{{--                                            <div class="d-flex flex-row flex-wrap mt-4 gap-4">--}}
{{--                                                @foreach($hostel['facilities'] as $fac)--}}
{{--                                                    <div class="d-flex flex-column align-items-center">--}}
{{--                                                        <span class="{{$fac['icon']}}"></span>--}}
{{--                                                        <span>{{$fac['name']}}</span>--}}
{{--                                                    </div>--}}
{{--                                                @endforeach--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="card-footer d-flex flex-row justify-content-between">--}}
{{--                                <p class="fw-semibold d-block fs-2 text-danger">{{General::rp($hostel['sellingprice'])}}</p>--}}
{{--                                <a href="{{route('hostel.checkout',$hostel['id'])."?start=".$_GET['start']."&duration=".$_GET['duration']."&room=".$_GET['room']."&guest=".$_GET['guest']}}" class="btn btn-danger">--}}
{{--                                    Pesan Kamar--}}
{{--                                </a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
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

        .card-hostel:hover{
            border: 1px solid #D9214E;
            cursor: pointer;
        }



    </style>
@endpush
@push('add-script')
    <script>
        $(document).ready(function() {

            $("#card-filter").hide();
            $("#button-refilter").click( function(){
                $("#card-filter").toggle();
            })
        })
    </script>
@endpush
