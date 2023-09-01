@extends('admin.layout',['title' => 'Setting Hostel - '.$hostel->name ,"url" => "#"])

@section('content-admin')
<!--begin::Row-->
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-12">
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
                <form action="{{route('partner.management.hotel.setting.room.post')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="hostel_id" value="{{$hostel->id}}">
                    <div class="row gy-5">


                        <div class="col-12">
                            <label class="form-label">Room Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Masukan Kamar" >
                        </div>
                        <div class="col-6">
                            <label class="form-label">Room Price</label>
                            <input type="text" name="price" class="form-control" placeholder="Masukan Harga">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Room Selling Price</label>
                            <input type="text" name="sellingprice" id="roomSellingPrice" class="form-control"
                                   placeholder="" disabled>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Furnish</label>
                            <select  class="form-control" name="roomtype" id="roomtype">
                                <option value="studio">Studio</option>
                                <option value="1br">1BR</option>
                                <option value="2br">2BR</option>
                                <option value="3br+">3BR+</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Room Type</label>
                            <select  class="form-control" name="furnish" id="furnish">
                                <option value="fullfurnished">Full Furnished</option>
                                <option value="unfurnished+">Unfurnished</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Number of Rooms</label>
                            <input type="text" name="totalroom" class="form-control" placeholder="Masukan Total Ruangan">
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
                                   placeholder="Masukan Maximal Jumlah Tamu Yang Bisa Menginap">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Max Extra Bed</label>
                            <input type="number" name="maxextrabed" class="form-control" placeholder="Masukan Maksimal Extra Bed">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Extra Bed Charge</label>
                            <input type="number" name="extrabedprice" class="form-control" placeholder="Masukan Biaya Extra Bed">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Extra Selling Charge</label>
                            <input type="number" name="" class="form-control" disabled>
                        </div>
                        <div class="col-12">
                            <!--begin::Alert-->
                            <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <!--begin::Title-->
                                    <h4 class="fw-bold">Image</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->
                        </div>
                        <div class="col-6">
                            <label class="form-label">Image</label>
                            <input type="file" name="image" class="form-control">
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

                        {{--                    </div>--}}
                    </div>
                    <!--end:: Body-->
                </form>
                <div class="card-footer d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-50">Simpan Data</button>
                    <a href="{{route('partner.management.hotel')}}"
                    class="btn btn-outline btn-outline btn-outline-secondary me-3 text-dark btn-active-light-secondary w-50">Back</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
