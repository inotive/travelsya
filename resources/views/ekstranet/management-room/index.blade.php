@extends('ekstranet.layout',['title' => 'Daftar Room',"url" => "#"])

@section('content-admin')


    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
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
                        <th class="text-center">Hunian</th>
                        <th class="text-center">Nama Room</th>
                        <th class="text-center">Room Rate</th>
                        <th class="text-center">Fix Rate</th>
                        <th class="text-center">Jumlah Ruangan</th>
                        <th class="text-center">Batas Penghuni</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($hotelRooms as $room)
                        <tr id="index_{{ $room->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $room->hotel->name }}</td>
                            <td class="text-center">SPOT ON {{ $room->name }}</td>

                            <td class="text-center">Rp. {{ number_format($room->price, 0, ',', '.') }}
                            </td>
                            <td class="text-center">Rp.
                                {{ number_format($room->sellingprice, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $room->totalroom ?? 0 }} Kamar</td>
                            <td class="text-center">{{ $room->guest ?? 0 }} Orang</td>
                    <td class="text-center">
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true" style="">
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="{{ route('partner.management.room.detailroomhotel', $room->id) }}" class="menu-link px-3" data-kt-customer-table-filter="delete_row">
                                    Detail Ruangan
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" class="menu-link px-3 text-warning" id="tombol-edit" data-id="{{ $room->id }}" data-bs-toggle="modal">
                                    Edit
                                </a>
                            </div>
                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="menu-item px-3">
                                <a href="javascript:void(0)" id="tombol-delete" data-id="{{ $room->id }}" data-bs-toggle="modal" class="menu-link px-3 text-danger">
                                    Delete
                                </a>
                            </div>
                            <!--end::Menu item-->
                        </div>
                        <!--begin::Menu-->
                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            Actions
                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                        </a>
                        <!--end::Menu-->
                    </td>
                </tr>
                @endforeach

                    <!-- Menampilkan data dari HostelRoom -->
                    @foreach ($hostelRooms as $room)
                        <tr id="index_{{ $room->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $room->hostel->name }}</td>
                            <td class="text-center">SPOT ON {{ $room->name }}</td>

                            <td class="text-center">Rp. {{ number_format($room->price, 0, ',', '.') }}
                            </td>
                            <td class="text-center">Rp.
                                {{ number_format($room->sellingprice, 0, ',', '.') }}</td>
                            <td class="text-center">{{ $room->totalroom ?? 0 }} Kamar</td>
                            <td class="text-center">{{ $room->guest ?? 0 }} Orang</td>
                            <td class="text-center">
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true" style="">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="{{ route('partner.management.room.detailroomhostel', $room->id) }}" class="menu-link px-3" data-kt-customer-table-filter="delete_row">
                                            Detail Ruangan
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="javascript:void(0)" class="menu-link px-3 text-warning" id="tombol-edit" data-id="{{ $room->id }}" data-bs-toggle="modal">
                                            Edit
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="javascript:void(0)" id="tombol-delete" data-id="{{ $room->id }}" data-bs-toggle="modal" class="menu-link px-3 text-danger">
                                            Delete
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--begin::Menu-->
                                <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
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
        <!--begin::Body-->
    </div>
    <!--end::Tables Widget 11-->


    {{-- modal --}}


    <!--begin::Modal - New Target-->

    <!--end::Modal - New Target-->


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
    </script>

@endpush


@endsection
