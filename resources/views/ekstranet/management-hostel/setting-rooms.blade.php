@extends('ekstranet.layout', ['title' => 'Detail Hostel - ' . $hostel->name, 'url' => '#'])
@section('content-admin')
    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js') }}"></script>
    <script src="{{ url('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('//cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>

    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header pt-5">
            <div class="card-toolbar">
                <a class="btn btn-sm btn-light-primary"
                    href="{{ route('partner.management.hostel.setting.room.create', ['id' => $hostel->id]) }}">
                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Room</a>
            </div>
        </div>
        <!--end::Header-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->

                <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle"
                    id="kt_datatable_zero_configuration">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 ">
                            <th class="text-center">No.</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Sewa Bulanan</th>
                            <th class="text-center">Sewa Tahunan</th>
                            <th class="text-center">Jumlah Ruangan</th>
                            <th class="text-center">Batas Penghuni</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hostel->hostelRoom as $room)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $room->name }}</td>
                                <td class="text-center">@currency($room->sellingrentprice_monthly)</td>
                                <td class="text-center">@currency($room->sellingrentprice_yearly)</td>
                                <td class="text-center">{{ $room->totalroom ?? 0 }} Kamar</td>
                                <td class="text-center">{{ $room->max_guest ?? 0 }} Orang</td>
                                <td class="text-center">
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                        data-kt-menu="true" style="">
                                        <div class="menu-item px-3">
                                            <a href="{{ route('partner.management.room.detailroomhostel', $room->id) }}"
                                                class="menu-link px-3">
                                                Detail Room
                                            </a>
                                        </div>
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('partner.management.hostel.setting.room.edit', ['id' => $hostel->id, 'room_id' => $room->id]) }}"
                                                class="menu-link px-3 text-warning">
                                                Edit
                                            </a>
                                        </div>
                                        {{-- <div class="menu-item px-3">
                                    <a href="javascript:void(0)" class="menu-link px-3 text-warning" id="tombol-edit"
                                        data-id="{{ $room->id }}" data-hotel-id="{{ $room->hostel_id }}">
                                        Edit
                                    </a>
                                </div> --}}
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="javascript:void(0)" id="tombol-delete"
                                                onclick="confirmDelete({{ $room->id }})" data-bs-toggle="modal"
                                                class="menu-link px-3 text-danger">
                                                Delete
                                            </a>

                                            {{-- <a href="javascript:void(0);" class="btn btn-danger btn-sm"
                                    >Hapus</a> --}}
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
                        @endforeach


                    </tbody>
                </table>
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
    </div>

    {{-- MODAL Disini --}}
    {{-- @include('ekstranet.management-hotel.setting-room-delete')
@include('ekstranet.management-hotel.setting-room-edit') --}}
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

        function confirmDelete(id) {
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
                    // Jika pengguna mengklik Ya, kirimkan permintaan penghapusan
                    window.location = `delete/${id}`;
                }
            });
        }
    </script>
@endpush
