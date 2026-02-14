@extends('ekstranet.layout',['title' => 'Setting Hotel - '. $hostel->name ,"url" => "#"])

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
                        action="{{route('partner.management.hostel.setting.hostelupdate',$hostel->id)}}">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" value="{{$hostel->id}}">
                        <!--begin::Input group-->
                        <div class="row g-9 mb-4">
                            <div class="col-md-8 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Nama Hostel</label>
                                <input type="text" name="name" id="name" class="form-control form-control-solid"
                                    placeholder="Masukan nama hostel" value="{{$hostel->name}}" readonly>
                                @error('name')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-4 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Bintang</label>
                                <input type="text" name="star" id="star" class="form-control form-control-solid"
                                    placeholder="Bintang" value="{{$hostel->star}}" readonly>
                                @error('star')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-4">
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Nomor Telfon</label>
                                <input type="text" name="phone" id="phone" class="form-control form-control-solid"
                                    placeholder="Masukan nomor telfon" value="{{$hostel->phone}}" readonly>
                                @error('phone')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Email</label>
                                <input type="text" name="email" id="email" class="form-control form-control-solid"
                                    placeholder="Masukan email" value="{{$hostel->email}}" readonly>
                                @error('email')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-4">
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
                        <div class="row g-9 mb-4">
                        <div class="col-md-12 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Deskripsi Hotel</label>
                            <textarea type="text" name="description" id="description" class="form-control form-control-solid"
                                      placeholder="Masukan alamat">{{$hostel->description ?? '-'}}</textarea>
                            @error('address')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        </div>
                        <div class="row g-9 mb-4">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Latitude (Google Maps)</label>
                            <input type="text" name="ltd" id="email" class="form-control form-control-solid"
                                   placeholder="Masukan latitude" value="{{$hostel->lat}}" >
                            @error('email')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Long Latitude (Google Maps)</label>
                            <input type="text" name="long_ltd" id="email" class="form-control form-control-solid"
                                   placeholder="Masukan long latitude" value="{{$hostel->lon}}" >
                            @error('email')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        </div>
                        <!--begin::Input group-->
                        <div class="row g-9 mb-4">
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
                            <div class="col-md-12 fv-row mb-6">
                                <label class="required fs-6 fw-semibold mb-2">Website</label>
                                <input type="text" name="website" id="website" class="form-control form-control-solid"
                                    placeholder="Masukan alamat website berupa URL" value="{{$hostel->website}}" readonly>
                                @error('website')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Tipe</label>
                                <select class="form-select form-select-solid" name="property">
                                    <option value="apartemen" {{$hostel->property == 'apartemen' ? "selected" : ''}}>Apartemen</option>
                                    <option value="rumah" {{$hostel->property == 'rumah' ? "selected" : ''}}>Rumah</option>
                                    <option value="villa" {{$hostel->property == 'villa' ? "selected" : ''}}>Villa</option>
                                    <option value="residence" {{$hostel->property == 'residence' ? "selected" : ''}}>Residence</option>
                                </select>
                                @error('property')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div> --}}
                            <label class="d-flex align-items-center fs-5 fw-semibold mb-5">
                                <span class="required">Tipe Properti</span>

                                <span class="m2-1" data-bs-toggle="tooltip" title="Silahkan Dipilih Tipe Properti">
                                    <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                </span>
                            </label>
                            <div class="col-12">
                                <div class="mb-3">
                                    <div class="btn-group w-100 mb-5" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                        <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                                            <input class="btn-check" type="radio" name="property" value="Apartemen" {{ $hostel->property == 'Apartemen' ? 'checked' : '' }} />
                                            Apartemen
                                        </label>
                                        <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                                            <input class="btn-check" type="radio" name="property" value="Villa" {{ $hostel->property == 'Villa' ? 'checked' : '' }} />
                                            Villa
                                        </label>
                                        <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                                            <input class="btn-check" type="radio" name="property" value="Residence" {{ $hostel->property == 'Residence' ? 'checked' : '' }} />
                                            Residence
                                        </label>
                                        <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                                            <input class="btn-check" type="radio" name="property" value="Rumah" {{ $hostel->property == 'Rumah' ? 'checked' : '' }} />
                                            Rumah
                                        </label>
                                    </div>

                                @error('property')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>


                        <!--end::Input group-->
                        <!--begin::Input group-->
                        {{-- <div class="row g-9 mb-8">
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
                        </div> --}}
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center d-flex flex-row-auto gap-5">

                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary flex-fill">
                                <span class="indicator-label">Simpan Data</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <a href="{{route('partner.management.hostel',$hostel->id)}}" type="reset" id="kt_modal_new_target_cancel"
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
@push('add-script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var propertyValue = "{{ $hostel->property }}"; // Ambil nilai dari database

    var radioButtons = document.getElementsByName('property');
    for (var i = 0; i < radioButtons.length; i++) {
        if (radioButtons[i].value === propertyValue) {
            radioButtons[i].checked = true; // Pilih radio button yang sesuai dengan nilai dari database
            radioButtons[i].parentNode.classList.add('active'); // Tambahkan kelas "active" ke elemen label
        }
    }
});
</script>
@endpush
