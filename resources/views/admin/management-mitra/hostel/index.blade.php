@extends('admin.layout', ['title' => 'Daftar Hostel', 'url' => ''])

@section('content-admin')
    <!--begin::Tables Widget 11-->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header pt-5">
            <div class="card-toolbar">
                <a class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#create">
                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Hostel</a>
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
                            <th class="text-center">Hostel</th>
                            <th class="text-center">Kota</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Website</th>
                            <th class="text-center">Bintang</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($hostels as $hostel)
                        {{-- @foreach ($ratings as $rating ) --}}
                            
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $hostel->user_name }}</td>
                                <td class="text-center">{{ $hostel->name }}</td>
                                <td class="text-center">{{ $hostel->city }}</td>
                                <td class="text-center">{{ $hostel->address }}</td>
                                <td class="text-center"><a href="{{ $hostel->website }}" target="_blank">LINK WEBSITE</a>
                                </td>
                                <td class="text-center"><span class="badge badge-warning">{{ $hostel->star }} Bintang</span>
                                </td>

                                

                                <td class="text-center">
                                    @if ($hostel->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                    @else
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                        data-kt-menu="true" style="">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="/metronic8/demo1/../demo1/apps/customers/view.html"
                                                class="menu-link px-3">
                                                Daftar Room
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="{{ route('admin.hostel.review', $hostel->id) }}" class="menu-link px-3"
                                                data-kt-customer-table-filter="delete_row">
                                                Detail Hostel
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#modal-edit"
                                                class="menu-link px-3 text-warning" id="btn-edit-post"
                                                data-id="{{ $hostel->id }}">
                                                Edit
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 text-danger" data-bs-toggle="modal"
                                                data-kt-customer-table-filter="delete_row"
                                                data-bs-target="#kt_modal_delete_customer{{ $hostel->id }}">
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
                            <div class="modal fade" id="kt_modal_delete_customer{{ $hostel->id }}" tabindex="-1"
                                aria-hidden="true">
                                <!-- Konten modal penghapusan -->
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.hostel.destroy', $hostel->id) }}" method="POST"
                                            id="kt_modal_delete_customer_form">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h2 class="fw-bold">DELETE HOSTEL</h2>
                                                <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary"
                                                    data-bs-dismiss="modal">
                                                    <i class="ki-duotone ki-cross fs-1"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body py-10 px-lg-17">
                                                <p>Anda yakin ingin menghapus data HOSTEL dengan nama {{ $hostel->name }}?
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
                        {{-- @endforeach --}}
                        @include('admin.management-mitra.hostel.edit')
                        {{-- @include('admin.management-mitra.rating.index') --}}

                        {{--                    @foreach ($vendors as $vendor) --}}
                        {{--                        <tr> --}}
                        {{--                            <td class="text-center">{{$loop->iteration}}</td> --}}
                        {{--                            <td> --}}
                        {{--                                <p>{{$vendor->user->name}}</p> --}}
                        {{--                                <p style="font-size : 9px;">{{$vendor->user->email}}</p> --}}
                        {{--                            </td> --}}
                        {{--                            <td class="text-center"><span class="badge badge-info">{{$vendor->name}}</span></td> --}}
                        {{--                            <td class="text-center">{{$vendor->user->phone ?? 'Belum Ada'}}</td> --}}
                        {{--                            <td class="text-center"> --}}
                        {{--                                @if ($vendor->is_active == 1) --}}
                        {{--                                    <span class="badge badge-success">Aktif</span> --}}
                        {{--                                @else --}}
                        {{--                                    <span class="badge badge-danger">Tidak Aktif</span> --}}
                        {{--                                @endif --}}
                        {{--                            </td> --}}
                        {{--                            <td class="text-center"> --}}
                        {{--                                <button class="btn btn-warning btn-sm p-2" data-id="{{$vendor->id}}" --}}
                        {{--                                        data-active="{{$vendor->is_active}}" data-bs-toggle="modal" --}}
                        {{--                                        data-bs-target="#edit">Edit --}}
                        {{--                                </button> --}}
                        {{--                                <button class="btn btn-danger btn-sm p-2" data-id="{{$vendor->id}}" --}}
                        {{--                                        data-active="{{$vendor->is_active}}" data-bs-toggle="modal" --}}
                        {{--                                        data-bs-target="#edit">Delete --}}
                        {{--                                </button> --}}
                        {{--                            </td> --}}
                        {{--                        </tr> --}}
                        {{--                    @endforeach --}}
                    </tbody>
                </table>

                {{-- <table class="table align-middle gs-0 gy-4">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="rounded-start">No</th>
                            <th class="w-75px rounded-start">Image</th>
                            <th class="min-w-75px rounded-start">Mitra</th>
                            <th class="min-w-75px rounded-start">Phone</th>
                            <th class="min-w-125px">Alamat</th>
                            <th class="min-w-125px">Email Login</th>
                            <th class="min-w-150px text-end rounded-end"></th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($vendors as $vendor)
                        <tr>
                            <td>
                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$loop->iteration}}</div>
                            </td>
                            <td>
                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6"><img class="img-thumbnail" src="{{count($vendor->hostelImage) >0 ? $vendor->hostelImage[0]->image : 'not found'}}" alt="">{{count($vendor->hostelImage) >0 ? '': 'not found'}}</div>
                            </td>
                            <td>
                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$vendor->user->name}}</div>
                            </td>
                            <td>
                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$vendor->user->phone}}</div>
                            </td>
                            <td>
                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{substr($vendor->address,0,24)}}</div>
                            </td>
                            <td>
                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$vendor->user->email}}</div>
                            </td>
                            <td class="text-end">
                                <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm btn-edit"
                                    data-id="{{$vendor->id}}" data-active="{{$vendor->is_active}}" data-bs-toggle="modal" data-bs-target="#edit">
                                    <i class="ki-duotone ki-pencil fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>
                            </td>
                            <td class="text-end">
                                <form action="{{route('admin.mitra.destroy')}}" method="post">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="id" value="{{$vendor->id}}">
                                <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit">
                                    <i class="ki-duotone ki-trash fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </button >
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td>
                              {{$vendors->appends(request()->input())->links('vendor.pagination.bootstrap-5')}}
                          </td>
                        </tr>
                      </tfoot>
                    <!--end::Table body-->
                </table> --}}
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>

        <!--begin::Body-->
    </div>
    <!--end::Tables Widget 11-->


    {{-- modal --}}
    <!--begin::Modal - New Target-->
    <div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
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
                        action="{{ route('admin.hostel.store') }}">
                        @method('put')
                        @csrf
                        <input type="hidden" name="id" id="id">
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Update Mitra</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Vendor User</label>
                                <select class="form-select form-select-solid" id="user_id" name="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="text-danger mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Active</label>
                                <select class="form-select form-select-solid" id="active" name="active">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                @error('active')
                                    <span class="text-danger mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel
                            </button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label" id="update">Submit</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
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
                        action="{{ route('admin.mitra.store') }}">
                        @csrf
                        <input type="hidden" name="id" id="id">
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
                                <input class="form-control form-control-lg" id="name"
                                    placeholder="Masukan nama hostel" name="name" required />

                                @error('name')
                                    <span class="text-danger mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="required fs-6 fw-semibold mb-2">Vendor User</label>
                                <select class="form-control" id="user_id" name="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_id')
                                    <span class="text-danger mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="hidden" value="1">
                            </div>
                            <div class="col-md-6">
                                <label class="required fs-6 fw-semibold mb-2">City</label>
                                <select name="city" id="" class="form-control">
                                    <option value="Balikpapan">Balikpapan</option>
                                    <option value="Samarinda">Samarinda</option>
                                    <option value="Banjarmasin">Banjarmasin</option>
                                </select>
                                @error('city')
                                    <span class="text-danger mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Alamat</label>
                                <textarea name="alamat" id="" cols="30" rows="5" class="form-control"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Website</label>
                                <input type="text" name="website" class="form-control" placeholder="Masukan website">
                            </div>


                            {{-- <input type="hidden" name="category" value="Harian"> --}}

                            <div class="col-md-12">
                                <label class="required fs-6 fw-semibold mb-2">Bintang</label>

                                <!--begin::Radio group-->
                                <div class="btn-group w-100" data-kt-buttons="true"
                                    data-kt-buttons-target="[data-kt-button]">
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success"
                                        data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="star" value="1" />
                                        <!--end::Input-->
                                        1
                                    </label>
                                    <!--end::Radio-->

                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success active"
                                        data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="star" checked="checked"
                                            value="2" />
                                        <!--end::Input-->
                                        2
                                    </label>
                                    <!--end::Radio-->

                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success"
                                        data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="star" value="3" />
                                        <!--end::Input-->
                                        3
                                    </label>
                                    <!--end::Radio-->

                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success"
                                        data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="star" value="4" />
                                        <!--end::Input-->
                                        4
                                    </label>
                                    <!--end::Radio-->
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline btn-color-muted btn-active-success"
                                        data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="star" value="5" />
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
    <!--end::Modal - New Target-->

    {{-- MODAL EDIT --}}

    <div class="modal fade" id="edit_mitra" tabindex="-1" aria-hidden="true">
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
                            <span aria-hidden="true">&times;</span>

                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <input type="hidden" id="hostel_id">

                    <!--begin:Form-->
                    {{-- @csrf
                    @method('PUT')
                    <form id="edit-form" class="form" method="post"
                        action="{{ route('admin.hostel.update', $hostel->id) }}">
                        @csrf --}}

                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">EDIT Mitra</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Nama</label>
                            <input class="form-control form-control-lg edit-name" id="edit-name"
                                placeholder="Masukan nama hostel" name="name" required />
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name-edit"></div>

                            @error('name')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Vendor User</label>
                            <select class="form-control edit-user-id" id="edit-user-id" name="user-id">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input type="hidden" value="1">
                        </div>
                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2 edit-city">City</label>
                            <select name="city" id="edit-city" class="form-control">
                                <option value="Balikpapan">Balikpapan</option>
                                <option value="Samarinda">Samarinda</option>
                                <option value="Banjarmasin">Banjarmasin</option>
                            </select>
                            @error('city')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">Alamat</label>
                            <textarea name="alamat" id="edit-alamat" cols="30" rows="5" class="form-control edit-alamat"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="" class="form-label">Website</label>
                            <input type="text" name="website" id="edit-website" class="form-control edit-website"
                                placeholder="Masukan website">
                        </div>


                        {{-- <input type="hidden" name="category" value="Harian"> --}}

                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2 edit-bintang">Bintang</label>

                            <!--begin::Radio group-->
                            <div class="btn-group w-100" data-kt-buttons="true"
                                data-kt-buttons-target="[data-kt-button]">
                                <!--begin::Radio-->
                                <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                                    <!--begin::Input-->
                                    <input class="btn-check" type="radio" name="star" value="1" />
                                    <!--end::Input-->
                                    1
                                </label>
                                <!--end::Radio-->

                                <!--begin::Radio-->
                                <label class="btn btn-outline btn-color-muted btn-active-success active"
                                    data-kt-button="true">
                                    <!--begin::Input-->
                                    <input class="btn-check" type="radio" name="star" checked="checked"
                                        value="2" />
                                    <!--end::Input-->
                                    2
                                </label>
                                <!--end::Radio-->

                                <!--begin::Radio-->
                                <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                                    <!--begin::Input-->
                                    <input class="btn-check" type="radio" name="star" value="3" />
                                    <!--end::Input-->
                                    3
                                </label>
                                <!--end::Radio-->

                                <!--begin::Radio-->
                                <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                                    <!--begin::Input-->
                                    <input class="btn-check" type="radio" name="star" value="4" />
                                    <!--end::Input-->
                                    4
                                </label>
                                <!--end::Radio-->
                                <!--begin::Radio-->
                                <label class="btn btn-outline btn-color-muted btn-active-success" data-kt-button="true">
                                    <!--begin::Input-->
                                    <input class="btn-check" type="radio" name="star" value="5" />
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
                    {{-- </form> --}}
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

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
        </script>
    @endpush
@endsection
