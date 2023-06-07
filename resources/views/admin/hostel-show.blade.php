@extends('admin.layout',['title' => 'Manajemen Data','url'=> route('admin.hostel'),'breadcrumb'=>['Hostel']])

@section('content-admin')
<div class="d-flex justify-content-end">
    <button class="btn btn-primary mb-5 mb-xl-8">Edit Hotel</button>
</div>

<div class="row">
    <div class="col-md-8">
        <!--begin::Tables Widget 11-->
        <div class="card mb-5 mb-xl-8">
        
            <!--begin::List widget 10-->
            <div class="card card-flush">
                <!--begin::Body-->
                <div class="card-body d-flex flex-column gap-5">
                   <div class="d-flex justify-content-between">
                        <span class="card-label fw-bold fs-3 mb-1">{{$hostel->name}}</span>
                        <a class="align-self-center" href="{{$hostel->link}}">Link Website</a>
                   </div>
                   <div class="d-flex flex-column">
                    {{$hostel->address}}
                   </div>
                    <div class="d-flex justify-content-between">
                        <span class="card-label mb-1">{{$hostel->phone}}</span>
                        <span class="card-label mb-1">{{$hostel->email}}</span>
                    </div>
                </div>
                <!--end: Card Body-->
            </div>
            <!--end::List widget 10-->
        </div>
        <!--end::Tables Widget 11-->
    </div>
    <div class="col-md-4">
        <!--begin::Tables Widget 11-->
        <div class="card mb-5 mb-xl-8">
        
            <!--begin::List widget 10-->
            <div class="card card-flush">
                <!--begin::Body-->
                <div class="card-body">
                   <div class="d-flex flex-column gap-7">
                        <div class="d-flex justify-content-between">
                            <span>Check In</span>
                            <span>{{$hostel->checkin}}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Check Out</span>
                            <span>{{$hostel->checkout}}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span>Status</span>
                            <span>{{$hostel->is_active ? "Aktif" : "Tidak Aktif"}}</span>
                        </div>
                   </div>
                </div>
                <!--end: Card Body-->
            </div>
            <!--end::List widget 10-->
        </div>
        <!--end::Tables Widget 11-->
    </div>
</div>

<div class="card mb-5 mb-xl-8">

    <!--begin::List widget 10-->
    <div class="card card-flush">
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Nav-->
            <ul class="nav nav-pills nav-pills-custom row position-relative mx-0 mb-9">
                <!--begin::Item-->
                <li class="nav-item col-2 mx-0 p-0">
                    <!--begin::Link-->
                    <a class="nav-link active d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#hostel">
                        <!--begin::Subtitle-->
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">Hostel Photo</span>
                        <!--end::Subtitle-->
                        <!--begin::Bullet-->
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                        <!--end::Bullet-->
                    </a>
                    <!--end::Link-->
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item col-2 mx-0 p-0">
                    <!--begin::Link-->
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#room">
                        <!--begin::Subtitle-->
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">Room</span>
                        <!--end::Subtitle-->
                        <!--begin::Bullet-->
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                        <!--end::Bullet-->
                    </a>
                    <!--end::Link-->
                </li>
                <!--end::Item-->
                <!--begin::Bullet-->
                <span class="position-absolute z-index-1 bottom-0 w-100 h-4px bg-light rounded"></span>
                <!--end::Bullet-->
            </ul>
            <!--end::Nav-->
            <!--begin::Tab Content-->
            <div class="tab-content">
                <!--begin::Tap pane-->
                <div class="tab-pane fade show active" id="hostel">
                    <div class="d-flex flex-wrap gap-5">
                        @foreach($hostel->hostelImage as $image)
                        <div class="mb-10 p-10 " style="border:grey 1px solid;width:28%">
                            <img src="{{$image->image}}" alt="" class="w-100 mb-5">
                            <div class="d-flex flex-column gap-2">
                                <form action="{{route('admin.hostel.main-image')}}" method="post" class="d-flex flex-column">
                                    @csrf
                                    <input type="hidden" name="id" value="{{$image->id}}">
                                    <input type="hidden" name="hostelid" value="{{$hostel->id}}">
                                    <button class="flex-fill btn btn-sm btn-info">
                                        Set Primary
                                    </button>
                                </form>
                                <form action="" method="post" class="d-flex flex-column">
                                    <input type="hidden" name="id" value="{{$image->id}}">
                                    <button class="flex-fill btn btn-sm btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!--end::Tap pane-->
                <!--begin::Tap pane-->
                <div class="tab-pane fade show active" id="room">
                    <div class="row border-2">
                        <div class="col-md-4">
                            <img src="" alt="" class="w-100">
                            <div class="d-flex flex-column">
                                <form action="" method="post" class="">
                                    <input type="hidden" name="id">
                                    <button class="btn btn-info">
                                        Set Primary
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Tap pane-->
            </div>
            <!--end::Tab Content-->
        </div>
        <!--end: Card Body-->
    </div>
    <!--end::List widget 10-->
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
                            <input type="text" name="category" class="form-control form-control-solid"
                                placeholder="Category">
                            @error('category')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Name</label>
                            <input type="text" name="name" class="form-control form-control-solid" placeholder="Name">
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
                            <input type="text" name="value" class="form-control form-control-solid" placeholder="Value">
                            @error('value')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Percent ?</label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Percent" name="is_percent" id="is_percent">
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
                            <input type="text" name="category" id="category" class="form-control form-control-solid"
                                placeholder="Category">
                            @error('category')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-solid"
                                placeholder="Name">
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
                            <input type="text" name="value" id="value" class="form-control form-control-solid"
                                placeholder="Value">
                            @error('value')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Percent ?</label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Percent" name="is_percent" id="percent">
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
    $(function () {
        $('#edit').on('show.bs.modal', function (event) {
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
            $(`#percent option[value=${is_percent}]`).attr('selected', 'selected');

        });
    });

</script>
@endpush
