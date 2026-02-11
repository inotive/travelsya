@extends('admin.layout', ['title' => 'Daftar Tipe Kendaraan', 'url' => ''])

@section('content-admin')
    {{-- Session messages will be handled by Toastr in JavaScript --}}

    <!--begin::Tables Widget 11-->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header pt-5">
            <div class="card-toolbar">
                <a class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#create">
                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Tipe Kendaraan</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table table-bordered table-hover fs-6 gy-5 align-middle"
                    id="kt_datatable_zero_configuration">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th class="text-center" style="width: 10%;">No.</th>
                            <th class="text-center" style="width: 20%;">Merek</th>
                            <th class="text-center" style="width: 30%;">Tipe Kendaraan</th>
                            <th class="text-center" style="width: 20%;">Gambar</th>
                            <th class="text-center" style="width: 20%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carModels as $carModel)
                            <tr id="index_{{ $carModel->id }}">
                                <td class="text-center" style="width: 10%;">{{ $loop->iteration }}</td>
                                <td class="text-center" style="width: 20%;">{{ $carModel->brand ? $carModel->brand->name : '-' }}</td>
                                <td class="text-start" style="width: 30%;">
                                    <div class="d-flex flex-column">
                                        <span class="fw-bold">{{ $carModel->name }}</span>
                                    </div>
                                </td>
                                <td class="text-center" style="width: 20%;">
                                    @if($carModel->image)
                                        <img src="{{ asset('storage/' . $carModel->image) }}" alt="{{ $carModel->name }}"
                                             style="width: 50px; height: 50px; object-fit: cover;" class="rounded">
                                    @else
                                        <div class="symbol symbol-50px">
                                            <div class="symbol-label bg-light-info text-info fs-6 fw-bold">
                                                {{ substr($carModel->name, 0, 1) }}
                                            </div>
                                        </div>
                                    @endif
                                </td>
                                <td class="text-center" style="width: 20%;">
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                        data-kt-menu="true" style="">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.car-model.show', $carModel->id) }}"
                                               class="menu-link px-3 text-primary">
                                                Detail
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#modal-edit"
                                                class="menu-link px-3 text-warning" id="btn-edit-car-model"
                                                data-id="{{ $carModel->id }}" data-name="{{ $carModel->name }}"
                                                data-image="{{ $carModel->image }}" data-brand-id="{{ $carModel->brand_id }}">
                                                Edit
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 text-danger" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_delete_car_model{{ $carModel->id }}">
                                                Delete
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--begin::Menu-->
                                    <a href="#"
                                        class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        Actions
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                    </a>
                                    <!--end::Menu-->
                                </td>
                            </tr>
                            <div class="modal fade" id="kt_modal_delete_car_model{{ $carModel->id }}" tabindex="-1"
                                aria-hidden="true">
                                <!-- Konten modal penghapusan -->
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.car-model.destroy', $carModel->id) }}" method="POST"
                                            id="kt_modal_delete_car_model_form">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h2 class="fw-bold">DELETE Tipe Kendaraan</h2>
                                                <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary"
                                                    data-bs-dismiss="modal">
                                                    <i class="ki-duotone ki-cross fs-1"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body py-10 px-lg-17">
                                                <p>Anda yakin ingin menghapus data Tipe Kendaraan dengan nama {{ $carModel->name }}?
                                                </p>
                                            </div>
                                            <div class="modal-footer d-flex justify-content-center">
                                                <button type="button" class="btn btn-light me-3"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--end::Body-->
    </div>
    <!--end::Tables Widget 11-->

    {{-- Modal Create --}}
    <div class="modal fade" id="create" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <form id="kt_modal_new_car_model_form" class="form" method="post"
                        action="{{ route('admin.car-model.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Create Tipe Kendaraan</h1>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-12">
                                <label class="required fs-6 fw-semibold mb-2">Gambar Tipe Kendaraan</label>
                                <div id="create-image-preview" class="mb-3"></div>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" required accept="image/*" id="create-image-input">
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">Format yang didukung: JPG, PNG, GIF, SVG. Maksimal 2MB</div>
                            </div>
                            <div class="col-md-6">
                                <label class="required fs-6 fw-semibold mb-2">Nama Tipe</label>
                                <input class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    placeholder="Masukan nama tipe" name="name" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="required fs-6 fw-semibold mb-2">Merek</label>
                                <select class="form-select form-select-solid @error('brand_id') is-invalid @enderror"
                                    name="brand_id">
                                    <option value="">Pilih Merek</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="row">
                                <div class="col-6">
                                    <button type="reset" id="kt_modal_new_car_model_cancel"
                                        class="btn btn-light me-3">Cancel
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" id="kt_modal_new_car_model_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div class="modal fade" id="modal-edit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <form id="kt_modal_edit_car_model_form" class="form" method="post"
                        action="" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Edit Tipe Kendaraan</h1>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-12">
                                <label class="fs-6 fw-semibold mb-2">Gambar Tipe Kendaraan</label>
                                <div id="current-image" class="mb-3"></div>
                                <div id="edit-image-preview" class="mb-3"></div>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" accept="image/*" id="edit-image-input">
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">Format yang didukung: JPG, PNG, GIF, SVG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar.</div>
                            </div>
                            <div class="col-md-6">
                                <label class="required fs-6 fw-semibold mb-2">Nama Tipe</label>
                                <input class="form-control form-control-lg @error('name') is-invalid @enderror"
                                    id="edit-name" placeholder="Masukan nama tipe" name="name" />
                                @error('name')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="required fs-6 fw-semibold mb-2">Merek</label>
                                <select class="form-select form-select-solid @error('brand_id') is-invalid @enderror"
                                    name="brand_id" id="edit-brand-id">
                                    <option value="">Pilih Merek</option>
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                @error('brand_id')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="row">
                                <div class="col-6">
                                    <button type="reset" id="kt_modal_edit_car_model_cancel"
                                        class="btn btn-light me-3">Cancel
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" id="kt_modal_edit_car_model_submit" class="btn btn-primary">
                                        <span class="indicator-label">Update</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('add-script')
        <style>
            @media (max-width: 768px) {
                #kt_datatable_zero_configuration {
                    font-size: 0.875rem;
                }
                #kt_datatable_zero_configuration th,
                #kt_datatable_zero_configuration td {
                    padding: 0.5rem 0.25rem;
                    white-space: nowrap;
                }
                #kt_datatable_zero_configuration .table-responsive {
                    overflow-x: auto;
                }
            }

            #kt_datatable_zero_configuration {
                table-layout: fixed;
            }

            #kt_datatable_zero_configuration th,
            #kt_datatable_zero_configuration td {
                vertical-align: middle;
            }

            /* Custom Toastr styling for admin theme */
            .toast-top-right {
                top: 80px !important;
                right: 20px !important;
            }

            .toast-success {
                background-color: #1bc5bd !important;
                border-left: 4px solid #0bb7af !important;
            }

            .toast-error {
                background-color: #f64e60 !important;
                border-left: 4px solid #f1416c !important;
            }

            .toast-warning {
                background-color: #ffa800 !important;
                border-left: 4px solid #ff8c00 !important;
            }

            .toast-info {
                background-color: #3699ff !important;
                border-left: 4px solid #0d6efd !important;
            }

            .toast {
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
                border-radius: 0.5rem !important;
                font-family: 'Inter', sans-serif !important;
            }
        </style>
        <script>
            // Setup AJAX to include CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Custom Toastr configuration for this page
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "4000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "tapToDismiss": true
            };

            $(document).ready(function() {
                $('#kt_datatable_zero_configuration').DataTable({
                    "scrollY": "500px",
                    "scrollCollapse": true,
                    "scrollX": true,
                    "responsive": true,
                    "autoWidth": false,
                    "columnDefs": [
                        { "width": "10%", "targets": 0 },
                        { "width": "20%", "targets": 1 },
                        { "width": "30%", "targets": 2 },
                        { "width": "20%", "targets": 3 },
                        { "width": "20%", "targets": 4 }
                    ],
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

                // Edit button click handler
                $(document).on('click', '#btn-edit-car-model', function() {
                    var id = $(this).data('id');
                    var name = $(this).data('name');
                    var image = $(this).data('image');
                    var brandId = $(this).data('brand-id');

                    // Set form action
                    $('#kt_modal_edit_car_model_form').attr('action', '{{ route("admin.car-model.index") }}/' + id);
                    $('#kt_modal_edit_car_model_form').data('car-model-id', id);

                    // Store original values for reset functionality
                    $('#kt_modal_edit_car_model_form').data('original-name', name);
                    $('#kt_modal_edit_car_model_form').data('original-image', image);
                    $('#kt_modal_edit_car_model_form').data('original-brand-id', brandId);

                    // Set default values from database
                    $('#edit-name').val(name);
                    $('#edit-brand-id').val(brandId);

                    // Clear previous preview
                    $('#edit-image-preview').empty();
                    $('#edit-image-input').val('');

                    // Show current image if exists
                    if (image) {
                        $('#current-image').html('<img src="{{ asset("storage/") }}/' + image + '" style="width: 100px; height: 100px; object-fit: cover;" class="rounded">');
                    } else {
                        $('#current-image').html('<div class="symbol symbol-100px"><div class="symbol-label bg-light-info text-info fs-2 fw-bold">' + name.charAt(0) + '</div></div>');
                    }
                });

                // Image preview for create modal
                $('#create-image-input').on('change', function(e) {
                    var file = e.target.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#create-image-preview').html(
                                '<div class="text-center">' +
                                '<img src="' + e.target.result + '" style="width: 150px; height: 150px; object-fit: cover;" class="rounded border">' +
                                '<div class="mt-2"><small class="text-muted">Preview gambar yang dipilih</small></div>' +
                                '</div>'
                            );
                        };
                        reader.readAsDataURL(file);
                    } else {
                        $('#create-image-preview').empty();
                    }
                });

                // Image preview for edit modal
                $('#edit-image-input').on('change', function(e) {
                    var file = e.target.files[0];
                    if (file) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#edit-image-preview').html(
                                '<div class="text-center">' +
                                '<img src="' + e.target.result + '" style="width: 150px; height: 150px; object-fit: cover;" class="rounded border">' +
                                '<div class="mt-2"><small class="text-muted">Preview gambar baru yang dipilih</small></div>' +
                                '</div>'
                            );
                        };
                        reader.readAsDataURL(file);
                    } else {
                        $('#edit-image-preview').empty();
                    }
                });

                // Clear previews when modals are closed
                $('#create').on('hidden.bs.modal', function() {
                    $('#create-image-preview').empty();
                    $('#create-image-input').val('');
                });

                // Close create modal when cancel is clicked
                $('#kt_modal_new_car_model_cancel').on('click', function() {
                    $('#create').modal('hide');
                });

                $('#modal-edit').on('hidden.bs.modal', function() {
                    $('#edit-image-preview').empty();
                    $('#edit-image-input').val('');
                });

                // Reset edit form to original database values
                $('#kt_modal_edit_car_model_cancel').on('click', function() {
                    var originalName = $('#kt_modal_edit_car_model_form').data('original-name');
                    var originalImage = $('#kt_modal_edit_car_model_form').data('original-image');
                    var originalBrandId = $('#kt_modal_edit_car_model_form').data('original-brand-id');

                    // Reset to original values
                    $('#edit-name').val(originalName);
                    $('#edit-brand-id').val(originalBrandId);
                    $('#edit-image-input').val('');
                    $('#edit-image-preview').empty();

                    // Reset current image display
                    if (originalImage) {
                        $('#current-image').html('<img src="{{ asset("storage/") }}/' + originalImage + '" style="width: 100px; height: 100px; object-fit: cover;" class="rounded">');
                    } else {
                        $('#current-image').html('<div class="symbol symbol-100px"><div class="symbol-label bg-light-info text-info fs-2 fw-bold">' + originalName.charAt(0) + '</div></div>');
                    }

                    // Close the modal
                    $('#modal-edit').modal('hide');
                });

                // AJAX form submission for create
                $('#kt_modal_new_car_model_form').on('submit', function(e) {
                    e.preventDefault();

                    var name = $('input[name="name"]').val().trim();
                    var brandId = $('select[name="brand_id"]').val();
                    var imageFile = $('input[name="image"]')[0].files[0];

                    // Validation
                    if (name === '') {
                        toastr.error('Nama Tipe Kendaraan harus diisi!');
                        return false;
                    }

                    if (brandId === '') {
                        toastr.error('Merek harus dipilih!');
                        return false;
                    }

                    if (!imageFile) {
                        toastr.error('Gambar Tipe Kendaraan harus diisi!');
                        return false;
                    }

                    // Show loading state
                    var submitBtn = $('#kt_modal_new_car_model_submit');
                    var originalText = submitBtn.find('.indicator-label').text();
                    submitBtn.prop('disabled', true);
                    submitBtn.find('.indicator-label').text('Creating...');

                    // Prepare form data
                    var formData = new FormData();
                    formData.append('name', name);
                    formData.append('brand_id', brandId);
                    formData.append('image', imageFile);

                    // AJAX request
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.success) {
                                // Show success message
                                showAlert('success', response.message);

                                // Add new row to table
                                addTableRow(response.data);

                                // Close modal
                                $('#create').modal('hide');

                                // Reset form
                                $('#kt_modal_new_car_model_form')[0].reset();
                                $('#create-image-preview').empty();
                            } else {
                                showAlert('error', response.message || 'Terjadi kesalahan saat menambahkan data');
                            }
                        },
                        error: function(xhr) {
                            var errorMessage = 'Terjadi kesalahan saat menambahkan data';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                                var errors = xhr.responseJSON.errors;
                                var errorMessages = [];
                                for (var field in errors) {
                                    errorMessages.push(errors[field][0]);
                                }
                                errorMessage = errorMessages.join('<br>');
                            }
                            showAlert('error', errorMessage);
                        },
                        complete: function() {
                            // Reset button state
                            submitBtn.prop('disabled', false);
                            submitBtn.find('.indicator-label').text(originalText);
                        }
                    });
                });

                // AJAX form submission for edit
                $('#kt_modal_edit_car_model_form').on('submit', function(e) {
                    e.preventDefault();

                    var name = $('#edit-name').val().trim();
                    var brandId = $('#edit-brand-id').val();
                    var imageFile = $('#edit-image-input')[0].files[0];
                    var carModelId = $(this).data('car-model-id');

                    // Validation
                    if (name === '') {
                        toastr.error('Nama Tipe Kendaraan harus diisi!');
                        return false;
                    }

                    if (brandId === '') {
                        toastr.error('Merek harus dipilih!');
                        return false;
                    }

                    // Show loading state
                    var submitBtn = $('#kt_modal_edit_car_model_submit');
                    var originalText = submitBtn.find('.indicator-label').text();
                    submitBtn.prop('disabled', true);
                    submitBtn.find('.indicator-label').text('Updating...');

                    // Prepare form data
                    var formData = new FormData();
                    formData.append('_method', 'PUT');
                    formData.append('name', name);
                    formData.append('brand_id', brandId);
                    if (imageFile) {
                        formData.append('image', imageFile);
                    }

                    // AJAX request
                    $.ajax({
                        url: $(this).attr('action'),
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            if (response.success) {
                                // Show success message
                                showAlert('success', response.message);

                                // Update table row data
                                updateTableRow(carModelId, response.data);

                                // Close modal
                                $('#modal-edit').modal('hide');

                                // Reset form
                                $('#kt_modal_edit_car_model_form')[0].reset();
                                $('#edit-image-preview').empty();
                                $('#current-image').empty();
                            } else {
                                showAlert('error', response.message || 'Terjadi kesalahan saat memperbarui data');
                            }
                        },
                        error: function(xhr) {
                            var errorMessage = 'Terjadi kesalahan saat memperbarui data';
                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                                var errors = xhr.responseJSON.errors;
                                var errorMessages = [];
                                for (var field in errors) {
                                    errorMessages.push(errors[field][0]);
                                }
                                errorMessage = errorMessages.join('<br>');
                            }
                            showAlert('error', errorMessage);
                        },
                        complete: function() {
                            // Reset button state
                            submitBtn.prop('disabled', false);
                            submitBtn.find('.indicator-label').text(originalText);
                        }
                    });
                });
            });

            // Helper function to show alerts using Toastr
            function showAlert(type, message) {
                if (type === 'success') {
                    toastr.success(message);
                } else if (type === 'error') {
                    toastr.error(message);
                } else if (type === 'warning') {
                    toastr.warning(message);
                } else if (type === 'info') {
                    toastr.info(message);
                } else {
                    toastr.info(message);
                }
            }

            // Helper function to add new table row
            function addTableRow(data) {
                var table = $('#kt_datatable_zero_configuration').DataTable();
                var rowCount = table.rows().count();
                var newRowNumber = rowCount + 1;

                // Create image HTML
                var imageHtml;
                if (data.image) {
                    imageHtml = '<img src="{{ asset("storage/") }}/' + data.image + '" alt="' + data.name + '" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">';
                } else {
                    imageHtml = '<div class="symbol symbol-50px"><div class="symbol-label bg-light-info text-info fs-6 fw-bold">' + data.name.charAt(0) + '</div></div>';
                }

                // Create new row HTML
                var newRow = '<tr id="index_' + data.id + '">' +
                    '<td class="text-center" style="width: 10%;">' + newRowNumber + '</td>' +
                    '<td class="text-center" style="width: 20%;">' + data.brand_name + '</td>' +
                    '<td class="text-start" style="width: 30%;">' +
                        '<div class="d-flex flex-column">' +
                            '<span class="fw-bold">' + data.name + '</span>' +
                        '</div>' +
                    '</td>' +
                    '<td class="text-center" style="width: 20%;">' + imageHtml + '</td>' +
                    '<td class="text-center" style="width: 20%;">' +
                        '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true" style="">' +
                            '<div class="menu-item px-3">' +
                                '<a href="{{ route("admin.car-model.show", "") }}/' + data.id + '" class="menu-link px-3 text-primary">Detail</a>' +
                            '</div>' +
                            '<div class="menu-item px-3">' +
                                '<a href="" data-bs-toggle="modal" data-bs-target="#modal-edit" class="menu-link px-3 text-warning" id="btn-edit-car-model" data-id="' + data.id + '" data-name="' + data.name + '" data-image="' + (data.image || '') + '" data-brand-id="' + data.brand_id + '">Edit</a>' +
                            '</div>' +
                            '<div class="menu-item px-3">' +
                                '<a href="#" class="menu-link px-3 text-danger" data-bs-toggle="modal" data-bs-target="#kt_modal_delete_car_model' + data.id + '">Delete</a>' +
                            '</div>' +
                        '</div>' +
                        '<a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions <i class="ki-duotone ki-down fs-5 ms-1"></i></a>' +
                    '</td>' +
                '</tr>';

                // Add row to table
                table.row.add($(newRow)).draw();
            }

            // Helper function to update table row
            function updateTableRow(carModelId, data) {
                var row = $('#index_' + carModelId);

                // Update name
                row.find('td:nth-child(3) .fw-bold').text(data.name);

                // Update brand name
                row.find('td:nth-child(2)').text(data.brand_name);

                // Update image
                var imageCell = row.find('td:nth-child(4)');
                if (data.image) {
                    imageCell.html('<img src="{{ asset("storage/") }}/' + data.image + '" alt="' + data.name + '" style="width: 50px; height: 50px; object-fit: cover;" class="rounded">');
                } else {
                    imageCell.html('<div class="symbol symbol-50px"><div class="symbol-label bg-light-info text-info fs-6 fw-bold">' + data.name.charAt(0) + '</div></div>');
                }

                // Update data attributes for edit button
                var editButton = row.find('#btn-edit-car-model');
                editButton.attr('data-name', data.name);
                editButton.attr('data-image', data.image);
                editButton.attr('data-brand-id', data.brand_id);
            }

            document.addEventListener("DOMContentLoaded", function() {
                // Handle session messages with Toastr
                @if(session('success'))
                    toastr.success('{{ session('success') }}');
                @endif

                @if(session('error'))
                    toastr.error('{{ session('error') }}');
                @endif

                @if(session('warning'))
                    toastr.warning('{{ session('warning') }}');
                @endif

                @if(session('info'))
                    toastr.info('{{ session('info') }}');
                @endif

                @if ($errors->any() || session('openModal'))
                    var myModal = new bootstrap.Modal(document.getElementById('create'));
                    myModal.show();
                @endif
            });
        </script>
    @endpush
@endsection
