@extends('admin.layout', ['title' => 'Users', 'url' => route('admin.user')])

@section('content-admin')
    <!--begin::Tables Widget 11-->
    @error('email')
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $message }} </strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @enderror

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
                <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle"
                    id="kt_datatable_zero_configuration">
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
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">
                                    {{ $i++ }}
                                </td>
                                <td>
                                    <div class="">{{ $user->email }}</div>
                                </td>
                                <td>
                                    <div class="">{{ $user->name }}</div>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}
                                </td>
                                <td class="text-center">
                                    {{-- <a onclick="return confirm('are you sure?')"
                                class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"> --}}
                                    {{-- <i class="ki-duotone ki-switch fs-2"> --}}
                                    {{-- <span class="path1"></span> --}}
                                    {{-- <span class="path2"></span> --}}
                                    {{-- </i> --}}
                                    {{-- </a> --}}
                                    <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit"
                                        data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#edit">
                                        <i class="ki-duotone ki-pencil fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <a href="{{ route('admin.user.delete', $user->id) }}"
                                        onclick="return confirm('are you sure?')"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
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
                    <form id="kt_modal_new_target_form_create" class="form" method="post"
                        action="{{ route('admin.user.create') }}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Create User</h1>
                            <!--end::Title-->
                            <!--begin::Description-->
                            <div class="text-muted fw-semibold fs-5">Only create mitra/admin role</div>
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
                            <input type="text" class="form-control form-control-solid" placeholder="Email" name="email"
                                required />
                            @error('email')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <!--begin::Col-->
                            <div class="col-md-12 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Name</label>
                                <!--begin::Input-->
                                <!--begin::Text-->
                                <input type="text" class="form-control form-control-solid" placeholder="Name"
                                    name="name" minlength="5" required />
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
                            <input type="password" class="form-control form-control-solid" placeholder="Password"
                                id="password_create" name="password" minlength="8" autocomplete="new-password" required />
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
                            <input type="password" class="form-control form-control-solid" placeholder="Password"
                                name="password_confirmation" id="password_confirmation_create" autocomplete="new-password" required />

                            <span id="passwordError" style="color: red;"></span>
                            @error('password_confirmation')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" id="submitButton" class="btn btn-primary">
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
                    <form class="form" method="post"
                        action="{{ route('admin.user.update') }}" id="passwordForm">
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
                            <input type="text" class="form-control form-control-solid" id="email"
                                placeholder="Email" name="email" required />
                            @error('email')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <!--begin::Col-->
                            <div class="col-md-12 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Name</label>
                                <!--begin::Input-->
                                <!--begin::Text-->
                                <input type="text" class="form-control form-control-solid" id="name"
                                    placeholder="Name" name="name" minlength="5" required />
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
                            <input type="password" class="form-control form-control-solid" placeholder="Password"
                                minlength="8" name="password" id="password_edit" />
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
                            <input type="password" class="form-control form-control-solid" placeholder="Password"
                                name="password_confirmation" id="password_confirmation_edit" />
                            <span id="passwordError_edit" style="color: red;"></span>
                            @error('password_confirmation')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="submitButton_edit" class="btn btn-primary">
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
    $(document).ready(function() {
    // Ambil elemen input password dan password_confirmation
    var passwordInput = $("#password_edit");
    var confirmPasswordInput = $("#password_confirmation_edit");

    // Ambil elemen pesan error dan tombol submit
    var passwordError = $("#passwordError_edit");
    var submitButton = $("#submitButton_edit");

    // Handler untuk setiap perubahan pada kedua input
    passwordInput.on('input', validatePasswordMatch);
    confirmPasswordInput.on('input', validatePasswordMatch);

    function validatePasswordMatch() {
        var password = passwordInput.val();
        var confirmPassword = confirmPasswordInput.val();

        if (password !== confirmPassword) {
            // Password tidak cocok, tampilkan pesan error
            passwordError.text("Password dan Confirm Password tidak cocok!");
            submitButton.prop("disabled", true);
            console.log(passwordError);
        } else {
            // Password cocok, hapus pesan error dan aktifkan tombol submit
            passwordError.text("");
            submitButton.prop("disabled", false);
        }
    }
});
</script>

<script>
    $(document).ready(function() {
    // Ambil elemen input password dan password_confirmation
    var passwordInput = $("#password_create");
    var confirmPasswordInput = $("#password_confirmation_create");

    // Ambil elemen pesan error dan tombol submit
    var passwordError = $("#passwordError");
    var submitButton = $("#submitButton");

    // Handler untuk setiap perubahan pada kedua input
    passwordInput.on('input', validatePasswordMatch);
    confirmPasswordInput.on('input', validatePasswordMatch);

    function validatePasswordMatch() {
        var password = passwordInput.val();
        var confirmPassword = confirmPasswordInput.val();

        if (password !== confirmPassword) {
            // Password tidak cocok, tampilkan pesan error
            passwordError.text("Password dan Confirm Password tidak cocok!");
            submitButton.prop("disabled", true);
        } else {
            // Password cocok, hapus pesan error dan aktifkan tombol submit
            passwordError.text("");
            submitButton.prop("disabled", false);
        }
    }
});
</script>

    <script>
        $(document).ready(function() {
            $('#kt_datatable_zero_configuration').DataTable({
                "scrollY": "500px",
                "scrollCollapse": true,
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">"
            });
        });
        $('.btn-edit').on('click', function() {
            const id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.user.edit') }}",
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
                    $(`#role option[value=${response.role}]`).attr('selected', 'selected');

                    console.log(response);
                }
            })
        });
    </script>
@endpush
