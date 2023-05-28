@extends('admin.layout',['title' => 'Fee','url'=> '#'])

@section('content-admin')
<!--begin::Tables Widget 11-->
<div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">List Fee Admin</span>
        </h3>
        <div class="card-toolbar">
            <a class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#create">
            <i class="ki-duotone ki-plus fs-2"></i>New Fee Admin</a>
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
                            <th class="min-w-75px ps-4 rounded-start">Category</th>
                            <th class="min-w-125px">Name</th>
                            <th class="min-w-125px">Value</th>
                            <th class="min-w-125px">Percent</th>
                            <th class="min-w-150px text-end rounded-end"></th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach($fees as $fee)
                        <tr>
                            <td>
                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$fee->category}}</div>
                            </td>
                            <td>
                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$fee->name}}</div>
                            </td>
                            <td>
                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$fee->value}}</div>
                            </td>
                            <td>
                                <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{($fee->is_percent) ? "Yes" : "No"}}
                                </div>
                            </td>
                            <td class="text-end">
                                <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit"
                                    data-id="{{$fee->id}}" data-category="{{$fee->category}}" data-name="{{$fee->name}}" data-value="{{$fee->value}}" data-is_percent="{{$fee->is_percent}}" data-bs-toggle="modal" data-bs-target="#edit">
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
                                {{$fees->appends(request()->input())->links('vendor.pagination.bootstrap-5')}}
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
                <form id="kt_modal_new_target_form" class="form" method="post" action="{{route('admin.fee.store')}}">
                    @csrf
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Create Fee Admin</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                     <!--begin::Input group-->
                     <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Category</label>
                            <input type="text" name="category" class="form-control form-control-solid"  placeholder="Category">
                            @error('category')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Name</label>
                            <input type="text" name="name" class="form-control form-control-solid"  placeholder="Name">
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
                            <input type="text" name="value" class="form-control form-control-solid"  placeholder="Value">
                            @error('value')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Percent ?</label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Percent" name="is_percent" id="is_percent">
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
                <form id="kt_modal_new_target_form" class="form" method="post" action="{{route('admin.fee.update')}}">
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

@push('add-script')
<script>
 $(function() {
    $('#edit').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var category = button.data('category');
        var name = button.data('name');
        var value = button.data('value');
        var is_percent = button.data('is_percent');

        var modal = $(this);
        modal.find('#id').val(id);
        modal.find('#category').val(category);
        modal.find('#name').val(name);
        modal.find('#value').val(value);
        $(`#percent option[value=${is_percent}]`).attr('selected','selected');

    });
});
</script>
@endpush