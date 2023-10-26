@extends('admin.layout', ['title' => 'Mitra', 'url' => route('admin.mitra')])

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

                <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle"
                    id="kt_datatable_zero_configuration">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 ">
                            <th class="text-center">No.</th>
                            <th class="text-center">Logo</th>
                            <th class="text-center">Vendor</th>
                            <th class="text-center">Hotel atau Hostel</th>
                            <th class="text-center">No.Telp</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $user->image) }}" class="rounded" style="width: 150px">
                                </td>
                                <td>
                                    <p>{{ $user->name }}</p>
                                    <p style="font-size : 9px;">{{ $user->email }}</p>
                                </td>
                                <td class="text-center">
                                    @foreach ($user->hostel as $hostel)
                                        <span class="badge badge-info">{{ $hostel->name }}</span>
                                    @endforeach
                                    @foreach ($user->hotel as $hotel)
                                        <span class="badge badge-info">{{ $hotel->name }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">{{ $user->phone ?? 'Belum Ada' }}</td>
                                <td class="text-center">

                                    @if ($user->is_active)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-warning btn-sm p-2" data-id="{{ $user->id }}"
                                        data-bs-toggle="modal" data-bs-target="#edit-mitra" id="btn-edit">Edit
                                    </button>
                                    {{-- <div class="menu-item px-3">
                                        <a href="javascript:void(0)" class="menu-link px-3 text-warning"
                                           id="tombol-edit" data-id="{{ $hotel->id }}" data-bs-toggle="modal">
                                            Edit
                                        </a>
                                    </div> --}}
                                    <button class="btn btn-danger btn-sm p-2" data-id="{{ $user->id }}"
                                        id="tombol-delete" data-bs-toggle="modal" data-bs-target="">Delete
                                    </button>
                                </td>
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
                        @foreach ($vendors as $vendor)
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
    {{-- <div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
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
                    <form id="kt_modal_new_target_form" class="form" method="post"
                        action="{{ route('admin.mitra.update') }}">
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
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="text-danger mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
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
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel
                            </button>
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
    </div> --}}
    <!--end::Modal - New Target-->

    <!--begin::Modal - New Target-->
    <div class="modal fade" id="create" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin:Form-->
            <form id="kt_modal_new_target_form" class="form" method="post" action="{{ route('admin.mitra.store') }}"
                enctype="multipart/form-data">
                @csrf
                <!--begin::Modal content-->
                <div class="modal-content rounded">
                    <!--begin::Modal header-->
                    <div class="modal-header justify-content-between">
                        <!--begin::Title-->
                        <h1 class="mb-3">Tambah Mitra Baru</h1>
                        <!--end::Title-->
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
                    <div class="modal-body scroll-y">
                        <input type="hidden" name="id" id="id">
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Logo</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Image input-->
                                <div class="image-input image-input-outline m-5" data-kt-image-input="true">
                                    <!--begin::Image preview wrapper-->
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url('')">
                                    </div>
                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                        title="Change image">
                                        <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span
                                                class="path2"></span></i>

                                        <!--begin::Inputs-->
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="image_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                        title="Cancel image">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                        title="Remove image">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                    <!--end::Remove button-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Hint-->
                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-12">
                                <label class=" required fs-6 fw-semibold mb-2">Nama User</label>
                                <input class="form-control form-control-lg" id="name" name="name"
                                    placeholder="Masukan nama perusahaan" required />
                            </div>
                            <div class="col-md-6">
                                <label class=" required fs-6 fw-semibold mb-2">Email</label>
                                <input class="form-control form-control-lg" id="email" name="email"
                                    placeholder="Masukan nama email" required />
                            </div>
                            <div class="col-md-6">
                                <label class=" required fs-6 fw-semibold mb-2">Password</label>
                                <input class="form-control form-control-lg" id="password" name="password"
                                    type="password" placeholder="Masukan nama email" required />
                            </div>
                            <div class="col-md-12">
                                <label class=" required fs-6 fw-semibold mb-2">Nomor Telfon</label>
                                <input class="form-control form-control-lg" id="phone" name="nomor_telfon"
                                    placeholder="Masukan nomor telfon" required />
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->

                        <div class="row g-9 mb-8">
                        </div>
                        <!--end::Input group-->


                        <!--end:Form-->
                    </div>
                    <!--end::Modal body-->

                    <div class="modal-footer">
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel
                            </button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </div>

                </div>
                <!--end::Modal content-->
            </form>
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - New Target-->

    {{-- edit --}}

    <div class="modal fade" id="edit-mitra" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin:Form-->
            <form id="updateForm" class="form" method="post" {{-- action="{{route('admin.mitra.store')}}"  --}} enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" id="user_id">

                <!--begin::Modal content-->
                <div class="modal-content rounded">
                    <!--begin::Modal header-->
                    <div class="modal-header justify-content-between">
                        <!--begin::Title-->
                        <h1 class="mb-3">Edit Mitra</h1>
                        <!--end::Title-->
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
                    <div class="modal-body scroll-y">
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-semibold fs-6">Logo</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Image input-->
                                <div class="image-input image-input-outline m-5" data-kt-image-input="true">
                                    <!--begin::Image preview wrapper-->
                                    <div class="image-input-wrapper w-125px h-125px image-preview" style=""></div>
                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Change image">
                                        <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span
                                                class="path2"></span></i>

                                        <!--begin::Inputs-->
                                        <input type="file" name="image" id="image-file"
                                            accept=".png, .jpg, .jpeg" />
                                        <input type="hidden" name="image_remove" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Cancel image">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span
                                        class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                        data-bs-dismiss="click" title="Remove image">
                                        <i class="ki-outline ki-cross fs-3"></i>
                                    </span>
                                    <!--end::Remove button-->
                                </div>
                                <!--end::Image input-->
                                <!--begin::Hint-->
                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-12">
                                <label class=" required fs-6 fw-semibold mb-2">Nama User</label>
                                <input class="form-control form-control-lg" id="edit-name" name="name"
                                    placeholder="Masukan nama perusahaan" required />
                            </div>
                            <div class="col-md-6">
                                <label class=" required fs-6 fw-semibold mb-2">Email</label>
                                <input class="form-control form-control-lg" id="edit-email" name="email"
                                    placeholder="Masukan nama email" required />
                            </div>
                            <div class="col-md-6">
                                <label class=" required fs-6 fw-semibold mb-2">Password</label>
                                <input class="form-control form-control-lg" id="edit-password" name="password"
                                    type="password" placeholder="Masukan Password Baru" />

                                <div class="fs-7 fw-semibold text-muted">Kosongkan Jika Tidak Ingin Merubah Password Lama
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class=" required fs-6 fw-semibold mb-2">Nomor Telfon</label>
                                <input class="form-control form-control-lg" id="edit-phone" name="phone"
                                    placeholder="Masukan nomor telfon" required />
                            </div>
                        </div>
                        <!--begin::Heading-->
                        <div class="mb-3">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-5 fw-semibold">
                                <span class="required">Status</span>


                            </label>
                            <!--end::Label-->

                            <!--begin::Description-->
                            <!--end::Description-->
                        </div>
                        <!--end::Heading-->

                        <!--begin::Radio group-->
                        <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                            <!--begin::Radio-->
                            <label class="btn btn-outline btn-color-muted btn-active-success input-is_active-1"
                                data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check input-is_active-1" id="is_active-edit-1" type="radio"
                                    name="is_active-edit" checked="checked" value="1" />
                                <!--end::Input-->
                                Aktif
                            </label>
                            <!--end::Radio-->
                            <!--begin::Radio-->
                            <label class="btn btn-outline btn-color-danger btn-active-success input-is_active-2"
                                data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check input-is_active-2" id="is_active-edit-2" type="radio"
                                    name="is_active-edit" value="0" />
                                <!--end::Input-->
                                Tidak Aktif
                            </label>
                            <!--end::Radio-->
                        </div>
                        <!--end::Radio group-->
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                        </div>
                        <!--end::Input group-->


                        <!--end:Form-->
                    </div>
                    <!--end::Modal body-->

                    <div class="modal-footer">
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel
                            </button>
                            <button type="submit" id="update" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </div>

                </div>
                <!--end::Modal content-->
            </form>
        </div>
        <!--end::Modal dialog-->
    </div>
@endsection

@push('add-script')
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
        $(function() {
            $('#edit').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var active = button.data('active');
                var id = button.data('id');
                var modal = $(this);
                modal.find('#id').val(id);
                $(`#active option[value=${active}]`).attr('selected', 'selected');
            });
        });

        // Ajax Edit Mitra

        $('body').on('click', '#btn-edit', function() {
            let user_id = $(this).data('id');

            $.ajax({
                url: `mitra/${user_id}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    $('#user_id').val(response.data.id);
                    $('#edit-name').val(response.data.name);
                    $('#edit-email').val(response.data.email);
                    $('#edit-password').val(response.data.password);
                    $('#edit-phone').val(response.data.phone);
                    $('#is_active-edit').val(response.data.is_active);
                    var is_active = response.data.is_active;
                    if (is_active == 1) {
                        $(".input-is_active-1").addClass("active");
                    } else if (is_active == 0) {
                        $(".input-is_active-2").addClass("active");
                    }

                    $('#edit-mitra').modal('show');

                    var imageUrl = '{{ asset('storage') }}/' + response.data.image;

                    // Tambahkan gambar pratinjau ke dalam elemen
                    $('.image-input-wrapper').css('background-image', `url(${imageUrl})`);
                    $('.image-input-wrapper').show();


                }
            });
        });

        $('#update').click(function(e) {
            e.preventDefault();
            // alert(asu);
            // Define variables
            let user_id = $('#user_id').val();
            let is_active = $('input[name="is_active-edit"]:checked').val();
            // let name = $('#edit-name').val();
            // let image = $('#image-file')[0].files[0];
            // let email = $('#edit-email').val();
            // let password = $('#edit-password').val();
            // let phone = $('#edit-phone').val();
            // let is_active = $('#is_active-edit').val();
            // let token = $("meta[name='csrf-token']").attr("content");
            // alert($user_id);
            // Create FormData object
            let formData = new FormData($('#updateForm')[0]);

            formData.append('is_active', is_active);

            // Ajax request
            $.ajax({
                url: `mitra/update/${user_id}`,
                type: "POST",
                cache: false,
                data: formData, // Change this to POST if your server handles updates with POST requests
                processData: false,
                contentType: false,


                success: function(response) {
                    $('#edit-mitra').modal('hide');
                    location.reload();
                },
                error: function(error) {
                    if (error.responseJSON && error.responseJSON.name && error.responseJSON.name[0]) {
                        // Show alert
                        $('#alert-edit-name').removeClass('d-none').addClass('d-block');
                        $('#alert-edit-image').removeClass('d-none').addClass('d-block');
                        $('#alert-edit-is_active').removeClass('d-none').addClass('d-block');


                        // Add message to alert
                        $('#alert-edit-name').html(error.responseJSON.name[0]);
                        $('#alert-edit-image').html(error.responseJSON.name[0]);
                        $('#alert-edit-is_active').html(error.responseJSON.name[0]);

                    }
                }
            });
        });


        // SwalFire Delete


        $('body').on('click', '#tombol-delete', function() {
            let user_id = $(this).data('id');
            let token = $("meta[name='csrf-token']").attr("content");

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Apakah anda yakin ingin menghapus data ini?",
                icon: 'error',
                showCancelButton: true,
                cancelButtonText: 'Kembali',
                confirmButtonText: 'Ya, Hapus!',
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: 'btn btn-secondary text-white'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `mitra/${user_id}/delete`,
                        type: "DELETE",
                        cache: false,
                        data: {
                            "_token": token
                        },
                        success: function(response) {
                            // Remove post on table
                            $(`#index_${user_id}`).remove();

                            // Tampilkan toast dari controller
                            toastr.success('Data berhasil dihapus.'); // Menggunakan toastr.js
                        },
                        error: function(response) {
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endpush
