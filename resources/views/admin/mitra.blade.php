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

                    <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle" id="kt_datatable_zero_configuration">
                        <thead>
                        <tr class="fw-bold fs-6 text-gray-800 ">
                            <th class="text-center">No.</th>
                            <th class="text-center">Vendor</th>
                            <th class="text-center">Email Login</th>
                            <th class="text-center">Hotel or Hostel</th>
                            <th class="text-center">No.Telp</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($vendors as $vendor)
                            <tr>
                                <td class="text-center">{{$loop->iteration}}</td>
                                <td class="text-center">{{$vendor->user->name}}</td>
                                <td class="text-center">{{$vendor->user->email}}</td>
                                <td class="text-center"><span class="badge badge-info">{{$vendor->name}}</span></td>
                                <td class="text-center">{{$vendor->user->phone}}</td>
                                <td class="text-center">
                                    @if($vendor->is_active == 1)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td><button class="btn btn-warning btn-sm p-2" data-id="{{$vendor->id}}" data-active="{{$vendor->is_active}}" data-bs-toggle="modal" data-bs-target="#edit">Edit Data</button></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{-- <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="rounded-start">No</th>
                                <th class="w-75px rounded-start">Image</th>
                                <th class="min-w-75px rounded-start">Mitra</th>
                                <th class="min-w-75px rounded-start">Phone</th>
                                <th class="min-w-125px">Alamat</th>
                                <th class="min-w-125px">Email Login</th>
                                <th class="min-w-150px text-end rounded-end"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach($vendors as $vendor)
                            <tr>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$loop->iteration}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6"><img class="img-thumbnail" src="{{count($vendor->hostelImage) >0 ? $vendor->hostelImage[0]->image : 'not found'}}" alt="">{{count($vendor->hostelImage) >0 ? '': 'not found'}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$vendor->user->name}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$vendor->user->phone}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{substr($vendor->address,0,24)}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$vendor->user->email}}</div>
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm btn-edit"
                                        data-id="{{$vendor->id}}" data-active="{{$vendor->is_active}}" data-bs-toggle="modal" data-bs-target="#edit">
                                        <i class="ki-duotone ki-pencil fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                </td>
                                <td class="text-end">
                                    <form action="{{route('admin.mitra.destroy')}}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{$vendor->id}}">
                                    <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit">
                                        <i class="ki-duotone ki-trash fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </button >
                                    </form>
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
                    </table> --}}
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
    $(document).ready( function () {
        $('#kt_datatable_zero_configuration').DataTable({
            "scrollY": "500px",
            "scrollCollapse": true,
            "language": {
                "lengthMenu": "Show _MENU_",
            },
            "dom":
                "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +

                "<'table-responsive'tr>" +

                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });
    } );
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
