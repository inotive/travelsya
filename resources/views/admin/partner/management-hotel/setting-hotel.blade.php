@extends('admin.layout',['title' => 'Setting Hotel - Hotel A' ,"url" => "#"])

@section('content-admin')
   <!--begin::Tables Widget 11-->
<div class="d-flex flex-row-auto flex-wrap">
    <div class="row w-100">

        <!--begin::Tables Widget 11-->
        <div class="card mb-5 mb-xl-8">

            <!--begin::List widget 10-->
            <div class="card card-flush">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin:Form-->
                    <form id="kt_modal_new_target_form" class="form" method="post"
                        action="{{route('admin.hostel.update',$hostel->id)}}">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" value="{{$hostel->id}}">
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-8 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Nama Hostel</label>
                                <input type="text" name="name" id="name" class="form-control form-control-solid"
                                    placeholder="Masukan nama hostel" value="{{$hostel->name}}">
                                @error('name')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Bintang</label>
                                <input type="text" name="star" id="star" class="form-control form-control-solid"
                                    placeholder="Bintang" value="{{$hostel->star}}">
                                @error('star')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Nomor Telfon</label>
                                <input type="text" name="phone" id="phone" class="form-control form-control-solid"
                                    placeholder="Masukan nomor telfon" value="{{$hostel->phone}}">
                                @error('phone')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Email</label>
                                <input type="text" name="email" id="email" class="form-control form-control-solid"
                                    placeholder="Masukan email" value="{{$hostel->email}}">
                                @error('email')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Alamat</label>
                                <textarea type="text" name="address" id="address" class="form-control form-control-solid"
                                    placeholder="Masukan alamat">{{$hostel->address}}</textarea>
                                @error('address')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Check in</label>
                                <input type="time" name="checkin" id="checkin" class="form-control form-control-solid" value="{{$hostel->checkin}}">
                                @error('checkin')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Check out</label>
                                <input type="time" name="checkout" id="checkout" class="form-control form-control-solid" value="{{$hostel->checkout}}">
                                @error('checkout')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Website</label>
                                <input type="text" name="website" id="website" class="form-control form-control-solid"
                                    placeholder="Masukan alamat website berupa URL" value="{{$hostel->website}}">
                                @error('website')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Status</label>
                                <select class="form-select form-select-solid" name="is_active">
                                    <option value="1" {{$hostel->is_active == 1 ? "selected" : ''}}>Aktif</option>
                                    <option value="0" {{$hostel->is_active == 0 ? "selected" : ''}}>Tidak Aktif</option>
                                </select>
                                @error('is_active')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center d-flex flex-row-auto gap-5">
                            
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary flex-fill">
                                <span class="indicator-label">Simpan Data</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <a href="{{route('admin.hostel.show',$hostel->id)}}" type="reset" id="kt_modal_new_target_cancel"
                                class="btn btn-light flex-fill">Back</a>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
            </div>
            <!--end: Card Body-->
        </div>
        <!--end::List widget 10-->
    </div>
    <!--end::Tables Widget 11-->
</div>
</div>
<!--end::Tables Widget 11-->
@endsection
