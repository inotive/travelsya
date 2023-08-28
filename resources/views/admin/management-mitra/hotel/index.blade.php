@extends('admin.layout',['title' => 'Daftar Hotel', 'url' => ''])

@section('content-admin')
    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js') }}"></script>
    <script src="{{ url('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('//cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>
    <!--begin::Tables Widget 11-->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header pt-5">
            <div class="card-toolbar">
                <a class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#create">
                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Hotel</a>
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
                        <th class="text-center">Vendor</th>
                        <th class="text-center">Hotel</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Website</th>
                        <th class="text-center">Bintang</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($hotels as $hotel)
                        <tr id="index_{{ $hotel->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $hotel->user_name }}</td>
                            <td class="text-center">{{ $hotel->name }}</td>
                            <td class="text-center">{{ $hotel->address }}</td>
                            <td class="text-center"><a href="{{ $hotel->website }}">Link Website</a></td>
                            <td class="text-center"><span class="badge badge-warning">{{ $hotel->star }} Bintang</span></td>
                            <td class="text-center">

                                @if ($hotel->is_active)
                                <span class="badge badge-success">Aktif</span>
                                @else
                                <span class="badge badge-danger">Tidak Aktif</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true" style="">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="/metronic8/demo1/../demo1/apps/customers/view.html" class="menu-link px-3">
                                            Daftar Room
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">
                                            Detail Hotel
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="javascript:void(0)" class="menu-link px-3 text-warning" id="tombol-edit" data-id="{{ $hotel->id }}" data-bs-toggle="modal">
                                            Edit
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="javascript:void(0)" id="tombol-delete" data-id="{{ $hotel->id }}" data-bs-toggle="modal" class="menu-link px-3 text-danger">
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
    @include('admin.management-mitra.hotel.edit')
    @include('admin.management-mitra.hotel.delete')

    <!--begin::Modal - New Target-->
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
                          action="{{route('admin.hotel.store')}}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Create Mitra</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-12">
                                <label class="required fs-6 fw-semibold mb-2">Nama</label>
                                <input class="form-control form-control-lg" id="name" placeholder="Masukan nama hotel" name="name" required/>

                                @error('name')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="required fs-6 fw-semibold mb-2">Vendor User</label>
                                <select class="form-control" id="user_id" name="user_id">
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                <input type="hidden" value="1">
                            </div>
                            <div class="col-md-6">
                                <label class="required fs-6 fw-semibold mb-2" >City</label>
                                <select name="city" id="" class="form-control">
                                    <option value="Balikpapan">Balikpapan</option>
                                    <option value="Samarinda">Samarinda</option>
                                    <option value="Banjarmasin">Banjarmasin</option>
                                </select>
                                @error('city')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Alamat</label>
                                <textarea name="address" id="address" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="website" class="form-label">Website</label>
                                <input type="text" id="website" name="website" class="form-control" placeholder="Masukan website">
                            </div>
                            <div class="col-md-12">
                                <label class="required fs-6 fw-semibold mb-2">Bintang</label>

                                <!--begin::Radio group-->
                                <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="star" id="star" value="1"/>
                                        <!--end::Input-->
                                        1
                                    </label>
                                    <!--end::Radio-->

                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success active" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="star" id="star" checked="checked" value="2"/>
                                        <!--end::Input-->
                                        2
                                    </label>
                                    <!--end::Radio-->

                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="star" id="star" value="3" />
                                        <!--end::Input-->
                                        3
                                    </label>
                                    <!--end::Radio-->

                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="star" id="star" value="4"  />
                                        <!--end::Input-->
                                        4
                                    </label>
                                    <!--end::Radio-->
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="star" id="star" value="5"  />
                                        <!--end::Input-->
                                        5
                                    </label>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Radio group-->
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <div class="row">
                                <div class="col-6">
                                    <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel
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
    <!--end::Modal - New Target-->

@endsection
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
