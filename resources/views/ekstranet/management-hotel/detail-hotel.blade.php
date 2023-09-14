@extends('ekstranet.layout', ['title' => 'Detail Hotel - A', 'url' => '#'])

@section('content-admin')
    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-xl-8 col-md-8">
            <div class="card ">
                <!--begin::Body-->
                        
                <div class="d-flex flex-wrap flex-sm-nowrap p-3 m-5 mt-4"
                    >
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
                                    <a 
                                        class="text-gray-900 text-hover-primary fs-1 fw-bold me-1">{{ $hotel->name}}</a>

                                </div>
                                <!--end::Name-->
                                <!--begin::Info-->
                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-1 pe-1">
                                    <a
                                        class="d-flex align-items-center text-gray-600 text-hover-primary me-5 mb-2">

                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        </i>{{ $hotel->address}}</a>

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
                                    <a href="#" class="text-gray-900 text-hover-primary fs-5 fw-bold me-1">{{ $hotel->description}}</a>

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
                                <td class="text-center text-danger fw-bold">{{ number_format($avg_rate, 1) }} ( {{ $total_review ?? 0 }} Rating)
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
                            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">Daftar Ruangan ({{$hotel->hotelroom->count()}}) </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">Photo Hotel ({{$hotel->hotelimage->count()}})</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                            <div class="row">
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
                                            <td class="text-center">Rp. {{ number_format($room->price, 0, ',', '.') }}</td>
                                            <td class="text-center">Rp. {{ number_format($room->sellingprice, 0, ',', '.') }}</td>
                                            <td class="text-center">{{ $room->totalroom ?? 0 }} Kamar</td>
                                            <td class="text-center">{{ $room->guest ?? 0 }} Orang</td>

                                            
            
            
                                            <td class="text-center">
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true" style="">

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0)" class="menu-link px-3 text-warning" id="tombol-edit" data-id="{{ $hotel->id }}" data-bs-toggle="modal">
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
                                                <a href="#"
                                                    class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    Actions
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                </a>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                        {{-- <div class="modal fade" id="kt_modal_delete_room{{ $room->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <!-- Konten modal penghapusan -->
                                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                                <div class="modal-content">
                                                    <form action="{{ route('partner.management.hotel.destroyroom', $room->id) }}" method="POST"
                                                        id="kt_modal_delete_room_form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header">
                                                            <h2 class="fw-bold">Delete Room</h2>
                                                            <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary"
                                                                data-bs-dismiss="modal">
                                                                <i class="ki-duotone ki-cross fs-1"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body py-10 px-lg-17">
                                                            <p>Anda yakin ingin menghapus data Ruangan dengan nama {{ $room->name }}?
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer d-flex justify-content-center">
                                                            <button type="button" class="btn btn-light me-3"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div> --}}
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @include('ekstranet.management-hotel.delete-room')

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
                                id="kt_datatable_zero_configuration">
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
                                                <img src="{{ asset($image->image) }}" class="rounded" style="width: 150px">
                                            </td>
                                            <td class="text-center">
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true" style="">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0)" class="menu-link px-3 text-warning" id="tombol-edit" data-id="{{ $hotel->id }}" data-bs-toggle="modal">
                                                            Edit
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3 text-danger" data-bs-toggle="modal"
                                                            {{-- data-kt-customer-table-filter="delete_row" --}}
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
                                        <div class="modal fade" id="kt_modal_delete_image{{ $image->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <!-- Konten modal penghapusan -->
                                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                                <div class="modal-content">
                                                    <form action="{{ route('partner.management.hotel.destroyimage', $image->id) }}" method="POST"
                                                        id="kt_modal_delete_image_form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-header">
                                                            <h2 class="fw-bold">Delete image</h2>
                                                            <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary"
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
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </div>
                                                <!--end::Menu-->
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>    

                                
                                {{-- <div class="col-4">
                                        <div class="card border border-light-subtle">
                                            <div class="card-body">
                                                <img src="{{ $image->image }}" style="width: 100%; height: 150px;"
                                                    alt="image">
                                            </div>
                                            <div class="card-footer py-2">
                                                <form action="{{ route('admin.hostel.main-image') }}" method="post"
                                                    class="d-flex flex-column">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $image->id }}">
                                                    <input type="hidden" name="hotelid" value="{{ $hotel->id }}">

                                                    <button class="btn btn-primary mb-3 w-100 btn-sm">Jadikan Foto
                                                        Utama</button>

                                                </form>
                                                <form action="{{ route('admin.hostel.delete-image') }}" method="post"
                                                    class="d-flex flex-column">
                                                    @csrf
                                                    @method('delete')
                                                    <input type="hidden" name="id" value="{{ $image->id }}">
                                                    <button
                                                        class="btn btn-outline btn-outline btn-sm btn-outline-danger text-dark  w-100">Delete
                                                        Photo</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div> --}}
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
