@extends('admin.layout',['title' => 'Setting Hotel - Hotel A' ,"url" => "#"])

@section('content-admin')
<!--begin::Row-->
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-8">
        <div class="card  mb-xl-8">
            <!--begin::Body-->
            <div class="card-body my-3">
                <div class="row">
                    <div class="col-12">
                        <!--begin::Alert-->
                        <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column pe-0 pe-sm-10">
                                <!--begin::Title-->
                                <h4 class="fw-bold">Room Information</h4>
                                <!--end::Title-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Alert-->
                    </div>
                </div>
                <div class="row gy-4">
                    <form action="{{route('partner.management.hotel.setting.room.post')}}" method="post">
                        @csrf
                        <input type="hidden" name="hostelid" value="{{$id}}">

                        <div class="col-12">
                            <label class="form-label">Room Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Nama Hotel">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Room Price</label>
                            <input type="text" name="price" class="form-control" placeholder="Masukan Nama Hotel">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Room Selling Price</label>
                            <input type="text" name="sellingprice" id="roomSellingPrice" class="form-control"
                                placeholder="Masukan Nama Hotel">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Number of Rooms</label>
                            <input type="text" name="totalroom" class="form-control" placeholder="Masukan Nama Hotel">
                        </div>

                        <div class="col-12">
                            <!--begin::Alert-->
                            <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <!--begin::Title-->
                                    <h4 class="fw-bold">Room Size</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->
                        </div>
                        <div class="col-12">
                            <label class="form-label">Size (m2)</label>
                            <input type="text" name="roomsize" class="form-control"
                                placeholder="Masukan total ukuran kamar dalam bentuk m2 (pxl)">
                        </div>
                        <div class="col-12">
                            <!--begin::Alert-->
                            <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <!--begin::Title-->
                                    <h4 class="fw-bold">Room Occupancy Policyze</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->
                        </div>
                        <div class="col-6">
                            <label class="form-label">Max Occopuncy</label>
                            <input type="text" name="guest" class="form-control"
                                placeholder="Masukan total ukuran kamar dalam bentuk m2 (pxl)">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Max Extra Bed</label>
                            <input type="number" name="maxextrabed" class="form-control" placeholder="Masukan nomor telfon">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Extra Bed Charge</label>
                            <input type="number" name="extrabedprice" class="form-control" placeholder="Masukan Email">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Extra Selling Charge</label>
                            <input type="number" name="email" class="form-control" disabled>
                        </div>
                        <div class="col-12">
                            <!--begin::Alert-->
                            <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <!--begin::Title-->
                                    <h4 class="fw-bold">Room Additional Information</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->
                        </div>
                        <div class="col-6 d-flex justify-content-around">
                            <div class="form-check me-3">
                                <input class="form-check-input" type="checkbox" name="breakfastIncluded"
                                    id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Breakfast Included
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="wifiIncluded"
                                    id="flexCheckDefault" />
                                <label class="form-check-label" for="flexCheckDefault">
                                    Wifi Included
                                </label>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!--end:: Body-->
            <div class="card-footer d-flex justify-content-between">
                <button type="submit" class="btn btn-primary w-50">Simpan Data</button>
                <a href="{{route('partner.management.hotel')}}"
                    class="btn btn-outline btn-outline btn-outline-secondary me-3 text-dark btn-active-light-secondary w-50">Back</a>
            </div>
        </div>
    </div>
    <!--end::Col-->
    <div class="col-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Number of Rooms</h5>
            </div>
            <div class="card-body">
                @for($i = 0; $i < 15; $i++) <div class="d-flex mb-7 bg-light-info p-5 rounded">
                    <!--begin::Section-->
                    <div class="d-flex align-items-center flex-wrap flex-grow-1 mt-n2 mt-lg-n1">
                        <!--begin::Title-->
                        <div class="d-flex flex-column flex-grow-1 my-lg-0 my-2 pe-3">
                            <a href="#" class="fs-5 text-gray-800 text-hover-primary fw-bold">Room Suite - {{$i}}</a>

                            </span>
                        </div>
                        <!--end::Title-->

                        <!--begin::Info-->
                        <div class="text-end py-lg-0 py-2">
                            <span class="text-gray-800 fw-bolder fs-7">Rp. 256.000</span>

                            <span class="text-gray-400 fs-7 fw-semibold d-block">Selling Price</span>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Section-->
            </div>
            @endfor

        </div>
    </div>
</div>
</div>
@endsection
