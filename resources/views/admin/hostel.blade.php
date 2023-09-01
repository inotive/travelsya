@extends('admin.layout',['title' => 'Hostel','url'=> '#'])

@section('content-admin')
<!--begin::Tables Widget 11-->
<div class="d-flex gap-10 flex-row-auto flex-wrap">
    @forelse($hostels as $hostel)
    <div class="card mb-5 mb-xl-8" style="width:48%;">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5 flex-column">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">{{$hostel->name}}</span>
            </h3>
            <div class="d-flex justify-content-between">
                <span>Bintang {{$hostel->star}}</span>
                <span>{{$hostel->hostelRoom->count()}} Room</span>
            </div>
            <div class="card-toolbar">
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <div class="d-flex flex-wrap gap-10 flex-row">
                <a href="{{route('admin.hostel.show',$hostel->id)}}" class="btn btn-primary flex-fill px-15">Detail Hotel</a>
                <a href="{{route('admin.hostel.edit',$hostel->id)}}" class="btn btn-primary flex-fill px-15">Setting Hotel</a>
                <a href="{{route('admin.hostel.image',$hostel->id)}}" class="btn btn-primary flex-fill px-15">Setting Hotel Photo</a>
                <a class="btn btn-primary flex-fill px-15">Setting Hotel Room</a>
            </div>
        </div>
        <!--begin::Body-->
    </div>
    @empty
    <div class="d-flex justify-content-center">
        <span>Not Found</span>
    </div>
    @endforelse
</div>
<!--end::Tables Widget 11-->




<!--begin::Modal - New Target-->
<div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                <form id="kt_modal_new_target_form" class="form" method="post" action="{{route('admin.management-fee.update')}}">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Update Fee Admin</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Category</label>
                            <input type="text" name="category" id="category" class="form-control form-control-solid"  placeholder="Category">
                            @error('category')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-solid"  placeholder="Name">
                            @error('name')
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
                            <label class="required fs-6 fw-semibold mb-2">Value</label>
                            <input type="text" name="value" id="value" class="form-control form-control-solid"  placeholder="Value">
                            @error('value')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Percent ?</label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Percent" name="is_percent" id="percent">
                                <option value="">Select percent...</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('is_percent')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button>
                        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end:Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - New Target-->
@endsection
