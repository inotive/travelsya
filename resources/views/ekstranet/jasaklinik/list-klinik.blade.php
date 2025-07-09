@extends('ekstranet.layout', ['title' => 'Daftar Jasa Kecantikan', 'url' => ''])

@section('content-admin')
    <!--begin::Tables Widget 11-->
    <div class="card mb-5 mb-xl-8">
        <div class="card-header">
            <div class="card-toolbar">
                <a class="btn btn-sm btn-light-primary" href="{{ route('clinics.create') }}">
                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Jasa Kecantikan</a>
            </div>
        </div>
        <!--begin::Body-->
        <div class="card-body py-3">

            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table id="clinicTable" class="table-row-dashed fs-6 gy-5 table-bordered table align-middle">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama Jasa</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Masa Berlaku</th>
                            <th class="text-center">Biaya</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clinics as $clinic)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">
                                    <div class="d-flex flex-column justify-content-center align-items-center gap-2">
                                        {{ $clinic->name }}
                                        <div class="d-flex justify-content-center align-items-center"
                                            style="width: 125px; height: auto; border: 1px solid #ddd; border-radius: 5px; overflow: hidden;">
                                            <a href="{{ asset('/storage/' . ($clinic->images->first()->image ?? '') ) }}"
                                                target="_blank">
                                                <img src="{{ asset('/storage/' . ($clinic->images->first()->image ?? '') ) }}"
                                                    alt="Dokumentasi" style="width: 100%; height: auto; object-fit: cover;">
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{ $clinic->categoriesService->name ?? 'Kategori tidak ditemukan' }}
                                </td>
                                <td class="text-center">{{ $clinic->expiry_date }} Hari</td>
                                <td class="text-center">{{ 'Rp ' . number_format($clinic->price) }} / {{ $clinic->duration }} Menit</td>
                                <td class="text-center">
                                    @if ($clinic->is_active === 1)
                                        <span class="badge badge-success">Aktif</span>
                                    @elseif ($clinic->is_active === 0)
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                        data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <a href="{{ route('clinics.edit', $clinic->id) }}"
                                                class="menu-link px-3 text-warning">
                                                Edit
                                            </a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 text-danger" data-bs-toggle="modal"
                                                data-kt-customer-table-filter="delete_row"
                                                data-bs-target="#kt_modal_delete_customer{{ $clinic->id }}">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                    <a href="#"
                                        class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        Aksi
                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                    </a>
                                </td>
                            </tr>
                            <div class="modal fade" id="kt_modal_delete_customer{{ $clinic->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <div class="modal-content">
                                        <form action="{{ route('clinics.destroy', $clinic->id) }}" method="POST"
                                            id="kt_modal_delete_customer_form_{{ $clinic->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h2 class="fw-bold">DELETE KLINIK</h2>
                                                <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary"
                                                    data-bs-dismiss="modal">
                                                    <i class="ki-duotone ki-cross fs-1"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body py-10 px-lg-17">
                                                <p>Anda yakin ingin menghapus klinik dengan nama
                                                    <strong>{{ $clinic->name }}</strong>?
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
            </div>
            <!--end::Table container-->
            <div class="d-flex justify-content-center mt-4">
                {{ $clinics->links() }}
            </div>
        </div>
        <!--end::Body-->
    </div>
    <!--end::Tables Widget 11-->
    @push('add-script')
        <script>
            $(document).ready(function() {

                $('#clinicTable').DataTable({
                    "scrollY": "500px"
                    , "scrollCollapse": true
                    , "language": {
                        "lengthMenu": "_MENU_"
                        , }
                    , "dom": "<'row'" +
                        "<'col-sm-6 d-flex align-items-center justify-content-start'l>" +
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
@endsection
