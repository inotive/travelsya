@extends('ekstranet.layout', ['title' => 'Detail Room - ' . $hotelrooms->hotel->name . ' - Tipe Kamar - ' . $hotelrooms->name, 'url' => '#'])

@section('content-admin')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Navbar-->
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-5 bg-primary text-white" style="border: 2px solid black; border-radius: 10px;">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap">
                    <!--begin: Pic-->

                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1 d-flex flex-column"> <!-- Tambahkan kelas "flex-column" di sini -->
                        <!--begin::Title-->
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <!--begin::User-->
                            <div class="d-flex flex-column">
                                <!--begin::Name-->
                                <div class="d-flex align-items-center mb-2">
                                    <a href="#"
                                        class="text-gray-100 text-hover-primary fs-1 fw-bold me-1">{{ $hotelrooms->hotel->name }}</a>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <a href="#"
                                        class="text-gray-100 text-hover-primary fs-2 fw-semibold me-1">{{ $hotelrooms->name }}
                                        Room</a>
                                </div>
                                <!--end::Name-->
                                <!--begin::Info-->

                                <!--end::Info-->
                            </div>
                            <!--end::User-->
                            <!--begin::Actions-->
                            <div class="d-flex my-4 flex-column mt-15 m-5">

                                <span class="fw-semibold fs-7 ">Terdapat {{ $hotelrooms->totalroom }} Ruangan Pada Tipe
                                    Kamar Ini</span>
                                <!--begin::Menu-->

                                <!--end::Menu-->
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Stats-->

                        <!--end::Stats-->
                    </div>
                    <!--end::Info-->
                </div>

                <!--end::Details-->
                <!--begin::Navs-->

                <!--begin::Navs-->
            </div>
        </div>
        <!--end::Navbar-->
        <!--begin::details View-->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">Riwayat Transaksi
                                ({{ $hotelrooms->hotelbookdate->count() }}) </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">Foto Ruangan
                                ({{ $hotelrooms->hotelroomimage->count() }})</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                            <div class="row">
                                <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle"
                                    id="kt_datatable_zero_configuration">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800 ">
                                            <th class="text-center">Customer</th>
                                            <th class="text-center">Code Booking</th>
                                            <th class="text-center">Check In</th>
                                            <th class="text-center">Check Out</th>
                                            <th class="text-center">Tipe Kamar</th>
                                            <th class="text-center">Jumlah Ruangan & Menginap</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hotelrooms->hotelbookDate as $booking)
                                            @php
                                                $startdate = \Carbon\Carbon::parse($booking->start);
                                                $enddate = \Carbon\Carbon::parse($booking->end);
                                                $startdates = $startdate->Format('d F Y');
                                                $enddates = $enddate->Format('d F Y');
                                                
                                            @endphp
                                            <tr>
                                                <td class="text-center">{{ $booking->transaction->user->name }} -
                                                    {{ $booking->transaction->user->phone }}</td>
                                                <td class="text-center">CTH123</td>
                                                <td class="text-center">{{ $startdates }}
                                                </td>
                                                <td class="text-center">{{ $enddates }}</td>
                                                <td class="text-center">{{ $booking->hotelroom->name }}</td>
                                                <td class="text-center">1 Kamar | 8 Malam</td>



                                                <td class="text-center">
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true" style="">

                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0)" class="menu-link px-3 text-warning"
                                                                id="" data-id="" data-bs-toggle="modal">
                                                                Cetak
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->

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

                                            </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>


                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                            <div class="row">


                                <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle"
                                    id="kt_datatable_zero_configuration_1">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800 ">
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Image</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hotelrooms->hotelroomimage as $roomimage)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <img src="{{ asset($roomimage->image) }}" class="rounded"
                                                        style="width: 150px">
                                                </td>

                                                <td class="text-center">
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true" style="">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0)" class="menu-link px-3 text-warning"
                                                                id="btn-edit-image" data-bs-target="#modal-edit-image"
                                                                data-bs-toggle="modal" data-id="{{ $roomimage->id }}">
                                                                Edit
                                                            </a>
                                                        </div>
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0)" id="tombol-delete"
                                                                class="menu-link px-3 text-danger" data-bs-toggle="modal"
                                                                data-id="{{ $roomimage->id }}">
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
                                            {{-- <div class="modal fade" id="kt_modal_delete_image{{ $image->id }}" --}}
                                            <!-- Konten modal penghapusan -->

                                            </td>
                                            </tr>
                                        @endforeach
                                        @include('ekstranet.management-room.edit-image-room-hotel')
                                    </tbody>
                                </table>



                            </div>
                        </div>




                    </div>
                </div>
            </div>

        </div>
        <!--end::details View-->
        <!--begin::Row-->

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

        $('body').on('click', '#tombol-delete', function() {

            let hotel_room_images_id = $(this).data('id');
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

                    // Menggunakan metode ajax() untuk mengirim permintaan DELETE
                    $.ajax({
                        url: `destroyimage/${hotel_room_images_id}/`,
                        type: "DELETE",
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
    </script>
@endpush
