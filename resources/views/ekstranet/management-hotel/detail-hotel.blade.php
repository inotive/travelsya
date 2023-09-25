@extends('ekstranet.layout', ['title' => 'Detail Hotel - ' . $hotel->name, 'url' => '#'])

@section('content-admin')
    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">  
        <!--begin::Col-->
        <div class="col-xl-8 col-md-8">
            <div class="card ">
                <!--begin::Body-->

                <div class="d-flex flex-wrap flex-sm-nowrap p-3 m-5 mt-4">
                    <!--begin: Pic-->

                    <div class="me-5 mb-0">
                        <div class="symbol symbol-100px symbol-lg-150px symbol-fixed position-relative">
                            <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="image" />

                        </div>
                    </div>
                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1">

                        <!--begin::Title-->
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <!--begin::User-->
                            <div class="d-flex flex-column">
                                <!--begin::Name-->
                                <div class="d-flex align-items-center mb-2 mt-5">
                                    <a class="text-gray-900 text-hover-primary fs-1 fw-bold me-1">{{ $hotel->name }}</a>

                                </div>
                                <!--end::Name-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-1 pe-1">
                                    <a class="d-flex align-items-center text-gray-600 text-hover-primary me-5 mb-2">

                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        </i>{{ $hotel->address }}</a>

                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::User-->
                            <!--begin::Actions-->

                            <!--end::Actions-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Stats-->
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-column flex-grow-1 pe-8 ">
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap">
                                    <!--begin::Stat-->
                                    <a href="#"
                                        class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">{{ $hotel->description }}</a>

                                    <!--end::Stat-->
                                </div>
                                <div class="d-flex flex-wrap">

                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Wrapper-->
                            <!--begin::Progress-->


                            <!--end::Progress-->
                        </div>
                        <!--end::Stats-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--end:: Body-->
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-4 col-md-4">
            <div class="card  card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="fw-bold text-dark">Check IN</td>
                                <td class="text-center text-success fw-bold">{{ date('H:i', strtotime($hotel->checkin)) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark">Check Out</td>
                                <td class="text-center text-danger fw-bold">{{ date('H:i', strtotime($hotel->checkout)) }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark">Rating</td>
                                <td class="text-center text-danger fw-bold">{{ number_format($avg_rate, 1) }} (
                                    {{ $total_review ?? 0 }} Rating)
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-dark">Status</td>
                                <td class="text-center text-danger fw-bold"><span
                                        class="badge {{ $hotel->is_active == 1 ? 'badge-success' : 'badge-danger' }} ">{{ $hotel->is_active == 1 ? 'live' : 'off' }}</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--end:: Body-->
            </div>
        </div>
        <!--end::Col-->
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">Daftar Ruangan
                                ({{ $hotel->hotelroom->count() }}) </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">Photo Hotel
                                ({{ $hotel->hotelimage->count() }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_3">Riwayat Booking
                                ({{ $hotel->hotelbookDate->count() }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_4">Fasilitas Hotel
                                ({{ $hotel->hotelroomFacility->count() }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_5">Aturan Hotel
                                ({{ $hotel->hotelRule->count() }})</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                            <div class="row">
                                <div class="card-toolbar">
                                    <a class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                                        data-bs-target="#create-room">
                                        <i class="ki-duotone ki-plus fs-2"></i>Tambah Room</a>
                                </div>
                                <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle"
                                    id="kt_datatable_zero_configuration">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800 ">
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Nama Room</th>
                                            <th class="text-center">Room Rate</th>
                                            <th class="text-center">Fix Rate</th>
                                            <th class="text-center">Jumlah Ruangan</th>
                                            <th class="text-center">Batas Penghuni</th>

                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hotel->hotelRoom as $room)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $room->name }}</td>
                                                <td class="text-center">@currency($room->price)
                                                </td>
                                                <td class="text-center">@currency($room->sellingprice)</td>
                                                <td class="text-center">{{ $room->totalroom ?? 0 }} Kamar</td>
                                                <td class="text-center">{{ $room->guest ?? 0 }} Orang</td>




                                                <td class="text-center">
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true" style="">

                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0)" class="menu-link px-3 text-warning"
                                                                id="tombol-edit" data-id="{{ $hotel->id }}"
                                                                data-bs-toggle="modal">
                                                                Edit
                                                            </a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3 text-danger"
                                                                data-bs-toggle="modal" {{-- data-kt-customer-table-filter="delete_row" --}}
                                                                data-bs-target="#kt_modal_delete_room{{ $room->id }}">
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
                                            <div class="modal fade" id="kt_modal_delete_room{{ $room->id }}"
                                                tabindex="-1" aria-hidden="true">
                                                <!-- Konten modal penghapusan -->
                                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{ route('partner.management.hotel.destroyroom', $room->id) }}"
                                                            method="POST" id="kt_modal_delete_room_form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-header">
                                                                <h2 class="fw-bold">Delete Room</h2>
                                                                <button type="button"
                                                                    class="btn btn-icon btn-sm btn-active-icon-primary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="ki-duotone ki-cross fs-1"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body py-10 px-lg-17">
                                                                <p>Anda yakin ingin menghapus data Ruangan Dengan Nama
                                                                    {{ $room->name }}?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button type="button" class="btn btn-light me-3"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </div>
                                                            <!--end::Menu-->
                                                        </form>
                                                        <!--end::Menu-->
                                                        </td>
                                                        </tr>
                                                        
                                                        </td>
                                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @include('ekstranet.management-hotel.create-room')
                                {{-- MODAL DELETE --}}

                                {{-- <div class="col-4">
                                            <div class="card border border-light-subtle">
                                                <div class="card-body">
                                                    <img src="{{ $room->image_1 }}" style="width: 100%; height: 150px;"
                                                        alt="image">
                                                    <div class="row my-3 gy-2">
                                                        <div class="col-6">
                                                            <h3 class="card-title fw-bolder">{{ $room->name }}</h3>
                                                        </div>
                                                        <div class="col-6 d-flex justify-content-end">
                                                            <span class="badge badge-info">Room {{ $room->totalroom }}</span>
                                                        </div>
                                                        <div class="col-12">
                                                            <h5 class="fw-bold text-primary">{{ General::rp($room->price) }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer py-2">
                                                    <button class="btn btn-primary mb-3 w-100 btn-sm">Detail Room</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach --}}

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
                                        @foreach ($hotel->hotelImage as $image)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-center">
                                                    <img src="{{ asset($image->image) }}" class="rounded"
                                                        style="width: 150px">
                                                </td>
                                                <td class="text-center">
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true" style="">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0)"
                                                                class="menu-link px-3 text-warning" id="tombol-edit"
                                                                data-id="{{ $hotel->id }}" data-bs-toggle="modal">
                                                                Edit
                                                            </a>
                                                        </div>
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3 text-danger"
                                                                data-bs-toggle="modal" {{-- data-kt-customer-table-filter="delete_row" --}}
                                                                data-bs-target="#kt_modal_delete_image{{ $image->id }}">
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
                                            <div class="modal fade" id="kt_modal_delete_image{{ $image->id }}"
                                                tabindex="-1" aria-hidden="true">
                                                <!-- Konten modal penghapusan -->
                                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{ route('partner.management.hotel.destroyimage', $image->id) }}"
                                                            method="POST" id="kt_modal_delete_image_form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-header">
                                                                <h2 class="fw-bold">Delete image</h2>
                                                                <button type="button"
                                                                    class="btn btn-icon btn-sm btn-active-icon-primary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="ki-duotone ki-cross fs-1"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body py-10 px-lg-17">
                                                                <p>Anda yakin ingin menghapus data Photo?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button type="button" class="btn btn-light me-3"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </div>
                                                            <!--end::Menu-->
                                                        </form>
                                                        </td>
                                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>



                            </div>
                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                            <div class="row">
                                <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle"
                                    id="kt_datatable_zero_configuration_2">
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
                                        @foreach ($hotel->hotelbookDate as $booking)
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
                                                <td class="text-center">{{ $booking->hotelroom->name     }}</td>
                                                <td class="text-center">1 Kamar | 8 Malam</td>



                                                <td class="text-center">
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true" style="">

                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0)"
                                                                class="menu-link px-3 text-warning" id=""
                                                                data-id="" data-bs-toggle="modal">
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
                        <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">

                            @foreach ($hotel->hotelRoom as $room)
                                <div class="d-flex flex-wrap flex-sm-nowrap border border-secondary p-3 m-18 mt-2"
                                    style="border-radius: 20px;" >

                                    <div class="container">
                                        <!-- Header -->
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="text-start">
                                                <h4 class="m-1">{{ $room->name }}</h4>
                                            </div>
                                            <div class="text-end">
                                                <h5 class="m-1">Terdapat {{ $room->hotelroomFacility->count() }}
                                                    Fasilitas</h5>
                                            </div>
                                        </div>
                                        <!-- Garis -->
                                        <hr class="mb-4">
                                        <!--begin: Pic-->
                                        <div class="row">
                                            @foreach ($room->hotelroomFacility as $facilityhotel)
                                                @if ($facilityhotel->facility)
                                                    <div class="col-md-1 mb-1 text-center">
                                                        <div
                                                            class="symbol symbol-100px symbol-lg-70px symbol-fixed position-relative">
                                                            <img src="{{ asset($facilityhotel->facility->icon) }}"
                                                                alt="image" />
                                                        </div>
                                                        <div class="mt-2">
                                                            {{ $facilityhotel->facility->name }}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach


                                        </div>
                                        <!--end::Pic-->
                                        <!--begin::Info-->

                                        <!--end::Info-->
                                    </div>

                                </div>
                            @endforeach

                        </div>
                        <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                            <div class="row">
                                <div class="card-toolbar">
                                    <a class="btn btn-sm btn-light-primary" data-bs-toggle="modal"
                                        data-bs-target="#create-rule">
                                        <i class="ki-duotone ki-plus fs-2"></i>Tambah Peraturan</a>
                                </div>

                                <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle"
                                    id="kt_datatable_zero_configuration_3">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800 ">
                                            <th class="text-center">No.</th>
                                            <th class="text-center">Peraturan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hotel->hotelRule as $rule)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $rule->description }}</td>
                                                <td class="text-center">
                                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                        data-kt-menu="true" style="">
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="javascript:void(0)"
                                                                class="menu-link px-3 text-warning" id="btn-edit-rule"
                                                                data-id="{{ $rule->id }}" data-bs-toggle="modal"
                                                                data-bs-target="#modal-edit-rule">
                                                                Edit
                                                            </a>
                                                        </div>
                                                        <div class="menu-item px-3">
                                                            <a href="#" class="menu-link px-3 text-danger"
                                                                data-bs-toggle="modal" {{-- data-kt-customer-table-filter="delete_row" --}}
                                                                data-bs-target="#kt_modal_delete_rule{{ $rule->id }}">
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
                                            <div class="modal fade" id="kt_modal_delete_rule{{ $rule->id }}"
                                                tabindex="-1" aria-hidden="true">
                                                <!-- Konten modal penghapusan -->
                                                <div class="modal-dialog modal-dialog-centered mw-550px modal-lg">
                                                    <div class="modal-content">
                                                        <form
                                                            action="{{ route('partner.management.hotel.destroyrule', $rule->id) }}"
                                                            method="POST" id="kt_modal_delete_rule_form">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-header d-flex justify-content-center">
                                                                <h2 class="fw-bold text-center mt-2">Delete rule</h2>
                                                                <button type="button"
                                                                    class="btn btn-icon btn-sm btn-active-icon-primary"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="ki-duotone ki-cross fs-1"></i>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body py-10 px-lg-17">
                                                                <p class="text-center">Anda yakin ingin menghapus data Peraturan
                                                                    {{ $rule->name }}?
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer d-flex justify-content-center">
                                                                <button type="button" class="btn btn-light me-3"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <button type="submit"
                                                                    class="btn btn-danger">Delete</button>
                                                            </div>
                                                            <!--end::Menu-->
                                                        </form>
                                                        </td>
                                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @include('ekstranet.management-hotel.edit-rules')


                                {{-- Modal Create RUles --}}
                                <div class="modal fade" id="create-rule" tabindex="-1" aria-hidden="true">
                                    <!--begin::Modal dialog-->
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <!--begin::Modal content-->
                                        <div class="modal-content rounded">
                                            <!--begin::Modal header-->
                                            <div class="modal-header pb-0 border-0 justify-content-end">
                                                <!--begin::Close-->
                                                <div class="btn btn-sm btn-icon btn-active-color-primary"
                                                    data-bs-dismiss="modal">
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
                                                    action="{{ route('partner.management.hotel.storerule') }}">
                                                    @csrf
                                                    <!--begin::Heading-->
                                                    <div class="mb-13 text-center">
                                                        <!--begin::Title-->
                                                        <h1 class="mb-3">Create Hotel Rules </h1>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Heading-->
                                                    <!--begin::Input group-->
                                                    <input type="hidden" name="hotel_id" id="hotel_id" value="{{ $hotel->id }}">

                                                    <div class="row g-9 mb-8">
                                                        <div class="col-md-12">
                                                            <label class="required fs-6 fw-semibold mb-2">Nama</label>
                                                            <input class="form-control form-control-lg" id="name"
                                                                placeholder="Masukan nama aturan" name="description"
                                                                required />

                                                            @error('name')
                                                                <span class="text-danger mt-1" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
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
                                                                <button type="submit" id="kt_modal_new_target_submit"
                                                                    class="btn btn-primary">
                                                                    <span class="indicator-label">Submit</span>
                                                                    <span class="indicator-progress">Please wait...
                                                                        <span
                                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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

                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>
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

            $('#kt_datatable_zero_configuration_1').DataTable({
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

            $('#kt_datatable_zero_configuration_2').DataTable({
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

            $('#kt_datatable_zero_configuration_3').DataTable({
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
