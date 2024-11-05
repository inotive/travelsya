@extends('admin.layout', ['title' => 'Daftar Bantuan', 'url' => ''])

@section('content-admin')
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header pt-5">
            <div class="card-toolbar">
                <a class="btn btn-sm btn-light-primary" href="{{ route('admin.help.create') }}">
                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Bantuan</a>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->

                <table class="table-row-dashed table-striped table-bordered table align-middle"
                    id="kt_datatable_zero_configuration">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 ">
                            <th class="text-center">No.</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Judul</th>
                            <th class="text-center">Dibuat Oleh</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($helps as $help)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $help->categories }}</td>
                                <td class="text-center">{{ $help->title }}</td>
                                <td class="text-center">User {{ $help->createdBy->name }}</td>


                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <td class="text-center">
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                        data-kt-menu="true" style="">
                                        <!--begin::Menu item-->
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.help.edit', $help->id) }}"
                                                class="menu-link px-3 text-warning" id="btn-edit-post"
                                                {{-- data-id="{{ $help->id }}" --}}>
                                                Edit
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 text-danger" data-bs-toggle="modal"
                                                data-kt-customer-table-filter="delete_row" data-id="{{ $help->id }}"
                                                id="deleteBtn">
                                                Delete
                                            </a>
                                        </div>
                                        {{-- <button type="button" class="btn btn-danger" data-id="{{ $help->id }}"
                                            id="deleteBtn">Delete</button> --}}

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
                            <div class="modal fade" id="kt_modal_delete_customer{{ $help->id }}" tabindex="-1"
                                aria-hidden="true">
                                <!-- Konten modal penghapusan -->
                                {{-- <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.help.destroy', $help->id) }}" method="POST"
                                        id="kt_modal_delete_customer_form">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-header d-flex justify-content-center">
                                            <h2 class="fw-bold text-center mt-2">Delete rule</h2>
                                            <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary"
                                                data-bs-dismiss="modal">
                                                <i class="ki-duotone ki-cross fs-1"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body py-10 px-lg-17">
                                            <p class="text-center">Anda yakin ingin menghapus data Peraturan
                                                {{ $help->title }}?
                                            </p>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="button" class="btn btn-light me-3"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                        </form> --}}
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

    <!--begin::Body-->
    </div>
@endsection

@push('add-script')
    <script>
        $('body').on('click', '#deleteBtn', function() {

            let help_id = $(this).data('id');
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

                    console.log('test');

                    $.ajax({
                        url: `helps/${help_id}`,
                        type: "DELETE",
                        cache: false,
                        data: {
                            "_token": token
                        },
                        success: function(response) {
                            location.reload();
                        },
                        error: function(error) {
                            location.reload();

                        }
                    });
                }
            });
        });

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
    </script>
@endpush
