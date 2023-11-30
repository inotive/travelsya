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
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_3">Detail Ruangan</a>
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
                                                <td class="text-center">{{ $booking->transaction->user->name ?? '' }} -
                                                    {{ $booking->transaction->user->phone ?? '' }}</td>
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

                                <div class="card-toolbar">
                                    <a class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#create">
                                        <i class="ki-duotone ki-plus fs-2"></i>Tambah Foto Ruangan</a>
                                </div>


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
                                                    <img src="{{ asset('storage/' . $roomimage->image) }}" class="rounded"
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

                        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                            <div class="card-body p-lg-20">
                                <!--begin::Layout-->
                                <div class="d-flex flex-column flex-xl-row">
                                    <!--begin::Content-->
                                    <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
                                        <!--begin::Invoice 2 content-->
                                        <div class="mt-n1">
                                            <!--begin::Top-->

                                            <div class="d-flex justify-content-between flex-column flex-sm-row mb-19">
                                                <div class="col-6">
                                                    @php
                                                        $image = $hotelrooms->hotelroomImage->first()->image ?? '';
                                                    @endphp
                                                    <a href="#">
                                                        <img alt="Logo" src="{{ asset('storage/' . $image) }}"
                                                            style="width: 200px" />
                                                    </a>
                                                    <!--end::Logo-->

                                                </div>
                                                <div class="col-6">
                                                    <div class="text-sm-end">

                                                        <!--begin::Logo-->
                                                        <h4>Room {{ $hotelrooms->name }}</h4>
                                                        <!--begin::Text-->
                                                        <div class="text-end fw-semibold fs-7 text-muted mt-7 me-0">
                                                            {{ $hotelrooms->hotel->address }}</div>
                                                        <!--end::Text-->
                                                    </div>

                                                </div>
                                            </div>
                                            <!--begin::Logo-->

                                            <!--end::Logo-->
                                            <!--begin::Action-->
                                            <!--end::Action--> <!--end::Top-->
                                            <!--begin::Wrapper-->
                                            <div class="m-0">
                                                <!--begin::Label-->
                                                <div class="fw-bold fs-3 text-gray-800 mb-2">
                                                    {{ $hotelrooms->hotel->name }}</div>
                                                <div class="fw-bold fs-6 text-gray-500 mb-8">{{ $hotelrooms->name }}
                                                </div>

                                                <!--end::Label-->
                                                <!--begin::Row-->
                                                <div class="row g-5 mb-11">
                                                    <!--end::Col-->
                                                    <div class="col-sm-6">
                                                        <!--end::Label-->
                                                        <div class="fw-semibold fs-7 text-gray-600 mb-1">Jumlah Kamar:
                                                        </div>
                                                        <!--end::Label-->
                                                        <!--end::Col-->
                                                        <div class="fw-bold fs-6 text-gray-800">
                                                            {{ $hotelrooms->totalroom ?? 0 }} Kamar</div>
                                                        <!--end::Col-->
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--end::Col-->
                                                    <div class="col-sm-6">
                                                        <!--end::Label-->
                                                        <div class="fw-semibold fs-7 text-gray-600 mb-1">Maksimal Extrabed:
                                                        </div>
                                                        <!--end::Label-->
                                                        <!--end::Text-->
                                                        <div class="fw-bold fs-6 text-gray-800">
                                                            {{ $hotelrooms->maxextrabed ?? 0 }} Bed</div>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                                <!--begin::Row-->
                                                <div class="row g-5 mb-12">
                                                    <!--end::Col-->
                                                    <div class="col-sm-6">
                                                        <!--end::Label-->
                                                        <div class="fw-semibold fs-7 text-gray-600 mb-1">Maksimal Penghuni
                                                            Kamar:</div>
                                                        <!--end::Label-->
                                                        <!--end::Text-->
                                                        <div class="fw-bold fs-6 text-gray-800">
                                                            {{ $hotelrooms->guest ?? 0 }} Orang</div> <!--end::Text-->
                                                        <!--end::Description-->
                                                        <!--end::Description-->
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--end::Col-->
                                                    <div class="col-sm-6">
                                                        <!--end::Label-->
                                                        <div class="fw-semibold fs-7 text-gray-600 mb-1">Luas Properti:
                                                        </div>
                                                        <!--end::Label-->
                                                        <!--end::Text-->
                                                        <div class="fw-bold fs-6 text-gray-800">
                                                            {{ $hotelrooms->roomsize ?? 0 }} m2</div>
                                                    </div>

                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Row-->
                                                <!--begin::Content-->
                                                <div class="d-flex justify-content-between flex-column flex-md-row">
                                                    <div class="flex-grow-1">
                                                        <!--begin::Table-->
                                                        <div class="table-responsive border-bottom mb-9">
                                                            <table class="table mb-3">
                                                                <thead>
                                                                    <tr class="border-bottom fs-6 fw-bold text-muted">
                                                                        <th class="min-w-175px pb-2">Harga Sewa</th>
                                                                        <th class="min-w-80px text-end pb-2">Rate</th>
                                                                        <th class="min-w-100px text-end pb-2">Amount</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr class="fw-bold text-gray-700 fs-5 text-end">
                                                                        <td class="d-flex align-items-center pt-6">
                                                                            <i class="ki-duotone ki-calendar fs-1 me-3">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                            </i>Permalam
                                                                        </td>
                                                                        <td class="pt-6">@currency($hotelrooms->price)</td>
                                                                        <td class="pt-6 text-dark fw-bolder">
                                                                            @currency($hotelrooms->sellingprice)
                                                                        </td>
                                                                    </tr>
                                                                    {{-- <tr class="fw-bold text-gray-700 fs-5 text-end">
                                                                        <td class="d-flex align-items-center">
                                                                            <i class="ki-duotone ki-calendar fs-1 me-3">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                            </i>Pertahun
                                                                        </td>
                                                                        <td class="pt-6">@currency($hotelrooms->rentprice_yearly)</td>
                                                                        <td class="pt-6 text-dark fw-bolder">
                                                                            @currency($hotelrooms->sellingrentprice_yearly)
                                                                        </td>
                                                                    </tr> --}}
                                                                    <tr class="fw-bold text-gray-700 fs-5 text-end">
                                                                        <td class="d-flex align-items-center">
                                                                            <i class="ki-duotone ki-price-tag fs-1 me-3">
                                                                                <span class="path1"></span>
                                                                                <span class="path2"></span>
                                                                                <span class="path3"></span>
                                                                            </i>Extrabed
                                                                        </td>
                                                                        <td class="pt-6">@currency($hotelrooms->extrabed_price)</td>
                                                                        <td class="pt-6 text-dark fw-bolder">
                                                                            @currency($hotelrooms->extrabed_sellingprice)
                                                                        </td>
                                                                    </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!--end::Table-->
                                                        <!--begin::Container-->
                                                        <!--end::Container-->
                                                    </div>
                                                    <div class="border-end d-none d-md-block mh-450px mx-9"></div>
                                                    <!--end::Separator-->
                                                    <!--begin::Content-->
                                                    <div class="mx-auto text-center pt-10" style="max-width: 500px;">
                                                        <!--begin::Total Amount-->
                                                        <div class="fs-3 fw-bold text-muted mb-3">Fasilitas</div>
                                                        <div class="row">
                                                            @foreach ($hotelrooms->hotelroomFacility as $facility)
                                                                <div class="col-4 mb-4">
                                                                    <div class="d-flex flex-column align-items-center">
                                                                        <img src="{{ asset('storage/' . $facility->facility->icon) }}"
                                                                            class="rounded" style="width: 25px"
                                                                            alt="{{ $facility->facility->name }}">
                                                                        <p class="mt-2">{{ $facility->facility->name }}
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <!--end::Total Amount-->
                                                        <div class="border-bottom w-100 my-7 my-lg-16"></div>
                                                    </div>
                                                </div>
                                                <!--end::Content-->
                                            </div>
                                            <!--end::Wrapper-->
                                        </div>
                                        <!--end::Invoice 2 content-->
                                    </div>
                                    <!--end::Content-->
                                    <!--begin::Sidebar-->
                                    <div class="m-0">
                                        <!--begin::Invoice 2 sidebar-->
                                        <!--end::Invoice 2 sidebar-->
                                    </div>
                                    <!--end::Sidebar-->
                                </div>
                                <!--end::Layout-->
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
        <!--end::details View-->
        <!--begin::Row-->

    </div>

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
                    <form id="kt_modal_new_target_form" class="form" method="post"
                        action="{{ route('partner.management.room.storehotelroomImage') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="hotel_id" value="{{ $hotelrooms->hotel->id }}">
                        <input type="hidden" name="hotel_room_id" value="{{ $hotelrooms->id }}">

                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Create Foto Ruangan</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="form-group">
                                <label class="font-weight-bold">Gambar Ruangan</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image">

                                <!-- error message untuk title -->
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <div class="row">
                                <div class="col-6">
                                    <button type="reset" id="kt_modal_new_target_cancel"
                                        class="btn btn-light me-3">Cancel
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                        <span class="indicator-label">Submit</span>
                                        <span class="indicator-progress">Please wait...
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </div>


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
