@extends('ekstranet.layout',['title' => 'Daftar Hostel',"url" => "#"])

@section('content-admin')
    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
    @foreach($hostels as $hostel)

        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="card  card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <div class="row ">
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
                            <span class="badge badge-primary badge-rounded">(4.7 / 5.0) dari 21 Rating</span>
                        </div>
                        <div class="col-6 d-flex justify-content-end">
                            <span class="badge badge-{{$hostel->is_active == 1 ? 'success' : 'light text-dark'}}">{{$hostel->is_active == 1 ? 'Live' : 'Belum Aktif'}}</span>
                        </div>
                        <div class="row my-4 w-100">
                            <div class="col-6">
                                <a href="{{route('partner.management.hostel.detail',$hostel->id)}}" class="btn btn-primary me-2 w-100 mb-4">Detail Hostel</a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-outline btn-outline btn-outline-secondary text-dark btn-active-light-secondary w-100">Profil Hostel</a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-outline btn-outline btn-outline-secondary text-dark btn-active-light-secondary w-100">Photo Hostel (4)</a>
                            </div>
                            <div class="col-6">
                                <a href="#" class="btn btn-outline btn-outline btn-outline-secondary text-dark btn-active-light-secondary w-100">Kamar Hostel (16)</a>
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
