@extends('admin.layout',['title' => 'Mitra','url' => route('admin.mitra')])

@section('content-admin')
<!--begin::Tables Widget 11-->
<div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">List Mitra</span>
        </h3>
        <div class="card-toolbar">
            <a class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#create">
            <i class="ki-duotone ki-plus fs-2"></i>New Mitra</a>
        </div>
    </div>
    <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="min-w-75px rounded-start">Vendor User</th>
                                <th class="min-w-125px">Email</th>
                                <th class="min-w-125px">Hostel Name</th>
                                <th class="min-w-125px">City</th>
                                <th class="min-w-125px">Category</th>
                                <th class="min-w-125px">Hostel Room</th>
                                <th class="min-w-125px">Status</th>
                                <th class="min-w-150px text-end rounded-end"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach($vendors as $vendor)
                            <tr>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$vendor->user->name}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$vendor->user->email}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$vendor->name}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$vendor->city}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$vendor->category}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{$vendor->hostelRoom->count()}}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">
                                        {{($vendor->is_active) ? "active" : 'in-active' }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit"
                                        data-id="{{$vendor->id}}" data-active="{{$vendor->is_active}}" data-bs-toggle="modal" data-bs-target="#edit">
                                        <i class="ki-duotone ki-pencil fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td>
                                  {{$vendors->appends(request()->input())->links('vendor.pagination.bootstrap-5')}}
                              </td>
                            </tr>
                          </tfoot>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
</div>
<!--end::Tables Widget 11-->


{{-- modal --}}
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
                <form id="kt_modal_new_target_form" class="form" method="post" action="{{route('admin.mitra.update')}}">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Update Mitra</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Vendor User</label>
                            <select class="form-select form-select-solid" id="user_id" name="user_id">
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Active</label>
                            <select class="form-select form-select-solid" id="active" name="active">
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('active')
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

<!--begin::Modal - New Target-->
<div class="modal fade" id="create" tabindex="-1" aria-hidden="true">
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
                <form id="kt_modal_new_target_form" class="form" method="post" action="{{route('admin.mitra.store')}}">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Create Mitra</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-12 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Name Hostel</label>
                            <input class="form-control form-control-solid" id="name" name="name" required/>
                                
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
                            <label class="required fs-6 fw-semibold mb-2">Vendor User</label>
                            <select class="form-select form-select-solid" id="user_id" name="user_id">
                                @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Active</label>
                            <select class="form-select form-select-solid" id="active" name="active">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                            @error('active')
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
                            <label class="required fs-6 fw-semibold mb-2">City</label>
                            <input class="form-control form-control-solid" id="city" name="city" required/>
                                
                            @error('city')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">category</label>
                            <input class="form-control form-control-solid" id="category" name="category" required/>
                                
                            @error('category')
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

@push('add-script')
<script>
 $(function() {
    $('#edit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var active = button.data('active');
        var id = button.data('id');
        var modal = $(this);
        modal.find('#id').val(id);
        $(`#active option[value=${active}]`).attr('selected','selected');
    });
});
</script>
@endpush