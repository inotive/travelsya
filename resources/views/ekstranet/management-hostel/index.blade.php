@extends('ekstranet.layout',['title' => 'Daftar hostel',"url" => "#"])

@section('content-admin')
    <!--begin::Row-->
    <div class="row gy-3 ">
        <!--begin::Col-->
    @foreach($hostels as $hostel)
    @php
                $avg_rate = DB::table('hostel_ratings')
                    ->where('hostel_id', $hostel->id)
                    ->avg('rate');

                $total_review = DB::table('hostel_ratings')
                    ->where('hostel_id', $hostel->id)
                    ->count();
            @endphp

        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="card  card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body py-3 my-3">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="fw-bold text-primary">{{$hostel->name}}</h3>
                            <div class="row">
                                <div class="col-6"><h6 class="fw-medium">{{$hostel->city}}</h6></div>
                                <div class="col-6 d-flex justify-content-end">
                                    <div class="rating">
                                        @for($i=0;$i<$hostel->star;$i++)
                                            <div class="rating-label checked">
                                                <i class="ki-duotone ki-star fs-6"></i>                                                    </div>
                                        @endfor

                                    </div>
                                </div>
                                <div class="col-12">
                                    <p>{{$hostel->address}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <span class="badge badge-primary badge-rounded">({{ number_format($avg_rate, 1) }} / 5.0) dari {{$total_review}} Rating</span>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <span class="badge badge-{{$hostel->is_active == 1 ? 'success' : 'light text-dark'}}">{{$hostel->is_active == 1 ? 'Live' : 'Belum Aktif'}}</span>
                        </div>
                        <div class="row my-3 w-100 p-0 gy-4">
                            <div class="col-6">

                                <a href="{{route('partner.management.hostel.detail',$hostel->id)}}" class="btn btn-primary p-4 me-2 w-100">Detail hostel</a>
                            </div>
                            <div class="col-6">
                                <a href="{{route('partner.management.hostel.setting.hostel',$hostel->id)}}" class="btn btn-outline p-4 btn-outline btn-outline-secondary text-dark btn-active-light-secondary w-100">Profil hostel</a>
                            </div>
                            <div class="col-6">
                                <a href="{{route('partner.management.hostel.setting.photo',$hostel->id)}}" class="btn btn-outline p-4 btn-outline btn-outline-secondary text-dark btn-active-light-secondary w-100">Photo hostel ({{$hostel->hostelImage->count()}})</a>
                            </div>
                            <div class="col-6">

                                <a href="{{route('partner.management.hostel.setting.room',$hostel->id)}}" class="btn btn-outline p-4 btn-outline btn-outline-secondary text-dark btn-active-light-secondary w-100">Kamar Hostel ({{$hostel->hostelRoom->count()}})</a>
                            </div>
                        </div>

                    </div>
                </div>
                <!--end:: Body-->
            </div>
        </div>
        @endforeach
        <!--end::Col-->
    </div>
@endsection
