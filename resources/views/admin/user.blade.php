@extends('admin.layout',['title' => 'Users','url' => route('admin.user')])

@section('content-admin')
<!--begin::Tables Widget 11-->
<div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Daftar User Login</span>
        </h3>
        <div class="card-toolbar">
            <a class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#create">
            <i class="ki-duotone ki-plus fs-2"></i>Tambah Data User</a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->
            <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle" id="kt_datatable_zero_configuration">
                <!--begin::Table head-->
                <thead>
                    <tr class="fw-bold text-muted bg-light">
                        <th class="ps-4 rounded-start">No</th>
                        <th class="min-w-125px">Email</th>
                        <th class="min-w-125px">Name</th>
                        <th class="min-w-125px">Tanggal Di Tambahkan</th>
                        <th class="min-w-200px text-center"> Aksi</th>
                    </tr>
                </thead>
                <!--end::Table head-->
                <!--begin::Table body-->
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @foreach($users as $user)
                    <tr>
                        <td class="text-center">
                            {{$i++}}
                        </td>
                        <td>
                            <div class="">{{$user->email}}</div>
                        </td>
                        <td>
                            <div class="">{{$user->name}}</div>
                        </td>
                        <td>
                            {{\Carbon\Carbon::parse($user->created_at)->format('d M Y')}}
                        </td>
                        <td class="text-center">
{{--                            <a onclick="return confirm('are you sure?')" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">--}}
{{--                                <i class="ki-duotone ki-switch fs-2">--}}
{{--                                    <span class="path1"></span>--}}
{{--                                    <span class="path2"></span>--}}
{{--                                </i>--}}
{{--                            </a>--}}
                            <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit" data-id="{{$user->id}}" data-bs-toggle="modal" data-bs-target="#edit">
                                <i class="ki-duotone ki-pencil fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </a>
                            <a href="{{route('admin.delete',$user->id)}}" onclick="return confirm('are you sure?')" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                <i class="ki-duotone ki-trash fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
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
                <form id="kt_modal_new_target_form" class="form" method="post" action="{{route('admin.create')}}">
                    @csrf
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Create User</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="text-muted fw-semibold fs-5">Only create vendor/admin role</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Email</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" placeholder="Email" name="email" required/>
                        @error('email')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Role</label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Role" name="role">
                                <option value="">Select user...</option>
                                <option value="0">Admin</option>
                                <option value="1">Vendor</option>
                            </select>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Name</label>
                            <!--begin::Input-->
                                <!--begin::Text-->
                                <input type="text" class="form-control form-control-solid" placeholder="Name" name="name" required/>
                                <!--end::Text-->
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Password</span>
                        </label>
                        <!--end::Label-->
                        <input type="password" class="form-control form-control-solid" placeholder="Password" name="password" required/>
                        @error('password')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Password Confirmation</span>
                        </label>
                        <!--end::Label-->
                        <input type="password" class="form-control form-control-solid" placeholder="Password" name="password_confirmation" required/>
                        @error('password_confirmation')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
                <form id="kt_modal_new_target_form" class="form" method="post" action="{{route('admin.update')}}">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Edit User</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Email</span>
                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" id="email" placeholder="Email" name="email" required/>
                        @error('email')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Role</label>
                            <select class="form-select form-select-solid" id="role" name="role">
                                <option value="0">Admin</option>
                                <option value="1">Vendor</option>
                            </select>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Name</label>
                            <!--begin::Input-->
                                <!--begin::Text-->
                                <input type="text" class="form-control form-control-solid" id="name" placeholder="Name" name="name" required/>
                                <!--end::Text-->
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Password</span>
                        </label>
                        <!--end::Label-->
                        <input type="password" class="form-control form-control-solid" placeholder="Password" name="password"/>
                        @error('password')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                            <span class="required">Password Confirmation</span>
                        </label>
                        <!--end::Label-->
                        <input type="password" class="form-control form-control-solid" placeholder="Password" name="password_confirmation"/>
                        @error('password_confirmation')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
    $('.btn-edit').on('click', function(){
        const id = $(this).data('id');
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            url: "{{ route('admin.edit') }}",
                type: "POST",
                dataType: 'json',
                data: {
                    id: id
                },
                success: function(response) {

                    $('#id').val(response.id)
                    $('#email').val(response.email)
                    $('#name').val(response.name)
                    $(`#role option`).removeAttr('selected');
                    $(`#role option[value=${response.role}]`).attr('selected','selected');

                    console.log(response);
                }
        })
    });
</script>
@endpush
