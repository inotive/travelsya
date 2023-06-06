@extends('admin.layout',['title' => 'Detail Hotel - A',"url" => "#"])

@section('content-admin')
    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-xl-8 col-md-8">
            <div class="card ">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <div class="row gy-3">
                        <div class="col-12">
                            <h1 class="fw-bold text-primary">Hotel A</h1>
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
                        <div class="col-12  fw-medium">Jl. MT Haryono No.5, RW No.85, Damai, Kec. Balikpapan Kota, Kota Balikpapan, Kalimantan Timur 76114</div>
                        <div class="col-6  fw-medium"><span class="badge badge-info">0811-5555-6666</span></div>
                        <div class="col-6 d-flex justify-content-end  fw-medium">hotel@gmail.com</div>

                    </div>
                </div>
                <!--end:: Body-->
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-4 col-md-4">
            <div class="card  card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="fw-bold text-dark">Check IN</td>
                                <td class="text-center text-success fw-bold">20:00</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark">Check Out</td>
                                <td class="text-center text-danger fw-bold">20:00</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark">Status</td>
                                <td class="text-center text-danger fw-bold"><span class="badge badge-success">Live</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--end:: Body-->
            </div>
        </div>
        <!--end::Col-->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">Daftar Ruangan </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">Daftar Photo</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                            <div class="row">
                                @for($i = 1; $i< 10;$i++)
                                    <div class="col-4">
                                        <div class="card border border-light-subtle">
                                            <div class="card-body">
                                                <img src="{{asset('admin/assets/media/Rooms.jpg')}}" style="width: 100%; height: 150px;" alt="image">
                                                <div class="row my-3 gy-2">
                                                    <div class="col-6">
                                                        <h3 class="card-title fw-bolder">Room A</h3>
                                                    </div>
                                                    <div class="col-6 d-flex justify-content-end">
                                                        <span class="badge badge-info">Room {{$i}}</span>
                                                    </div>
                                                    <div class="col-12">
                                                        <h5 class="fw-bold text-primary">Rp. {{number_format(720000,0,',','.')}}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer py-2">
                                                <button class="btn btn-primary mb-3 w-100 btn-sm">Detail Room</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor

                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                            <div class="row">
                                <div class="col-4">
                                    <div class="card border border-light-subtle">
                                        <div class="card-body">
                                            <img src="{{asset('admin/assets/media/Rooms.jpg')}}" style="width: 100%; height: 150px;" alt="image">
                                        </div>
                                        <div class="card-footer py-2">
                                            <button class="btn btn-primary mb-3 w-100 btn-sm">Jadikan Foto Utama</button>
                                            <button class="btn btn-outline btn-outline btn-sm btn-outline-danger text-dark  w-100">Delete Photo</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
