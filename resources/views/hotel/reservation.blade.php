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
                            @if(session()->get('user') != null)
                            <div class="">
                                <label class="form-label fw-bold fs-6">Nama Lengkap</label>
                                <input type="name" class="form-control" value="{{session()->get('user')['data']['name']}}">
                            </div>
                            <div class="mt-10">
                                <label class="form-label fw-bold fs-6">Email Address</label>
                                <input type="email" class="form-control" value="{{session()->get('user')['data']['email']}}">
                            </div>
                            <div class="mt-10">
                                <label class="form-label fw-bold fs-6">Nomor Telepon</label>
                                <input type="phone" class="form-control" value="{{session()->get('user')['data']['phone']}}">
                            </div>
                            @else
                                <div class="align-self-center">
                                    <a href="{{route('login.view')}}">Login First</a>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="col-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <h3 class="fw-bold card-title">{{$hotelRoom->hotel->name}}</h3>
                                </div>
                                <div class="col-12">
                                    <span class="">{{$hotelRoom->hotel->address}}</span>
                                    @for($j=0;$j < $hotelRoom->hotel->rating_avg; $j++) <span class="card-text mt-3 fa fa-star" style="color: orange;">
                                                </span>@endfor
                                </div>
                                <div class="col-12">
                                    <div class="bg-light p-4 rounded-2 mt-3">
                                        <i class="fa fa-calendar me-3"></i>
                                        {{date("d M",$params['start_date'])}} - {{date("d M",strtotime($params['end_date']))}} {{date("Y",$params['start_date'])}} ({{$params['duration']}} Malam)
                                    </div>
                                </div>
                                <div class="col-12">
                                    <span>Tipe Kamar : </span>
                                    <span class="mt-2 fw-bold">{{$hotelRoom->name}}</span>
                                </div>
                                <div class="col-12">
                                    <div class="badge badge-success p-4 rounded-2 mt-3">
Anda Memesan {{$params['room']}} Kamar , {{$params['guest']}} Tamu
                                    </div>
                                </div>
                            </div>




                        </div>
                        <div class="card-footer">
                            <div class="row gy-3">
                                <div class="col-12 d-flex justify-content-between">
                                    <p>Biaya Kamar (2 Kamar)</p>
                                    <h4>Rp. {{General::rp($hotelRoom->sellingprice * $params['duration'])}}</h4>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <p>Extra Bed (2 Kasur)</p>
                                    <h4>Rp. {{$hotelRoom->extrabedprice}}</h4>
                                </div>
                                <div class="col-12">
                                    <form action="{{route('hotels.request',$hotelRoom->id)}}" class="d-flex flex-column" method="post">
                                        @csrf
                                        <input type="hidden" name="service" value="hotel">
                                        <input type="hidden" name="payment_method" value="xendit">
                                        <input type="hidden" name="hostel_room_id" value="{{$hotelRoom->id}}">
                                        <input type="hidden" name="start" value="{{date('Y-m-d', $params['start_date'])}}">
                                        <input type="hidden" name="end" value="{{date('Y-m-d', strtotime($params['end_date']))}}">
                                        <input type="hidden" name="end" value="{{date('Y-m-d', strtotime($params['end_date']))}}">
                                        <input type="hidden" name="name" value="{{session()->get('user') != null ? session()->get('user')['data']['name'] : ''}}">
                                        <button class="btn btn-lg text-white w-100" style="background-color: #c02425">Lanjut Pembayaran</button>
                                    </form>
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


