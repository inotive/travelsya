@extends('admin.layout',['title' => 'Daftar Hotel',"url" => "#"])

@section('content-admin')
    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-sm-6 col-md-6 col-lg-6">
            <div class="card  card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <div class="row">
                        <div class="col-12">
                            <h3 class="fw-bold text-primary">Hotel A</h3>
                        </div>
                        <div class="col-6">
                            <div class="rating">
                                <div class="rating-label checked">
                                    <i class="ki-duotone ki-star fs-6"></i>                                                    </div>
                                <div class="rating-label checked">
                                    <i class="ki-duotone ki-star fs-6"></i>                                                    </div>
                                <div class="rating-label checked">
                                    <i class="ki-duotone ki-star fs-6"></i>                                                    </div>
                                <div class="rating-label checked">
                                    <i class="ki-duotone ki-star fs-6"></i>                                                    </div>
                                <div class="rating-label checked">
                                    <i class="ki-duotone ki-star fs-6"></i>                                                    </div>
                            </div>
                        </div>

                        <div class="col-6 d-flex justify-content-end fw-medium">10 Rooms</div>
                        <div class="row my-3 w-100 p-0 gy-4">
                            <div class="col-6">
                                <a href="{{route('partner.management.hotel.detail')}}" class="btn btn-primary me-2 w-100">Detail Hotel</a>
                            </div>
                            <div class="col-6">
                                <a href="{{route('partner.management.hotel.setting.hotel')}}" class="btn btn-outline btn-outline btn-outline-secondary text-dark btn-active-light-secondary w-100">Setting Hotel</a>
                            </div>
                            <div class="col-6">
                                <a href="{{route('partner.management.hotel.setting.photo')}}" class="btn btn-outline btn-outline btn-outline-secondary text-dark btn-active-light-secondary w-100">Setting Hotel Photo</a>
                            </div>
                            <div class="col-6">
                                <a href="{{route('partner.management.hotel.setting.room')}}" class="btn btn-outline btn-outline btn-outline-secondary text-dark btn-active-light-secondary w-100">Setting Hotel Room</a>
                            </div>
                        </div>

                    </div>
                </div>
                <!--end:: Body-->
            </div>
        </div>
        <!--end::Col-->
    </div>
@endsection
