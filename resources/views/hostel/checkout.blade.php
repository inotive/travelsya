@extends('layouts.web')

@section('content-web')

<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">

    <!--begin::Post-->
    <div class="content flex-row-fluid mb-10" id="kt_content">
        <div class="row justify-content-between">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body d-flex flex-column">
                        @if((session()->get('user')))
                        <h4>Detail Pesanan</h4>
                        <div class="mt-10">
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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-gray-900">{{$hostelRoom->hostel->name}}</h4>
                        <p class="card-text text-gray-500 mt-1">{{$hostelRoom->hostel->address}}</p>
                        <div>
                            @for($j=0;$j < $hostelRoom->hostel->star; $j++) <span class="card-text fa fa-star" style="color: orange;"></span>@endfor 
                        </div>
                        <p class="card-text text-gray-500 mt-4"><span class="fa fa-calendar me-3"></span> {{date('d-m-Y', $params['start_date'])}} - {{$params['end_date']}} ({{$params['duration']}} Bulan)</p>
                        <p class="card-text text-gray-500 mt-1">Room : {{$hostelRoom->name}} (Maks {{$hostelRoom->guest}} Tamu)</p>

                        @if($params['guest'] > $hostelRoom->guest)
                        <p class="card-text text-gray-500 mt-1">Ekstrabed : {{(int)$params['guest'] - (int)$hostelRoom->guest}} Bed</p>
                        @endif

                        <p class="card-text text-gray-500 mt-1">Anda memesan {{$params['room']}} Ruangan</p>

                        <hr>

                        <table>
                            <tr>
                                <td>Room Price ({{$params['duration']}} Bulan) : </td>
                                <td>{{General::rp($params['duration']*(int)$hostelRoom->sellingprice)}}</td>
                            </tr>
                            <tr>
                                <td>Extrabed :</td>
                                <td>{{General::rp($params['duration']*(int)$hostelRoom->extrabedprice)}}</td>
                            </tr>
                            <tr>
                                <td>Grand Total :</td>
                                <td>{{General::rp($params['duration']*(int)$hostelRoom->extrabedprice+$params['duration']*(int)$hostelRoom->sellingprice)}}</td>
                            </tr>
                        </table>
                        <div class= "mt-10">
                            <form action="{{route('hostel.request',$hostelRoom->id)}}" class="d-flex flex-column" method="post">
                                @csrf
                                <input type="hidden" name="service" value="hostel">
                                <input type="hidden" name="payment_method" value="xendit">
                                <input type="hidden" name="hostel_room_id" value="{{$hostelRoom->id}}">
                                <input type="hidden" name="start" value="{{date('Y-m-d', $params['start_date'])}}">
                                <input type="hidden" name="end" value="{{date('Y-m-d', strtotime($params['end_date']))}}">
                                <input type="hidden" name="end" value="{{date('Y-m-d', strtotime($params['end_date']))}}">
                                <input type="hidden" name="name" value="{{session()->get('user')['data']['name']}}">
                                <button type="submit" class="btn btn-danger flex-fill">
                                    Lanjut ke pembayaran
                                </button>
                            </form>
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

    .card-hostel:hover{
        border: 1px solid #D9214E;
        cursor: pointer;
    }



</style>
@endpush