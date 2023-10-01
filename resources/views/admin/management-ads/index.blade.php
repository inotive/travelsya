@extends('admin.layout', ['title' => 'Daftar Iklan', 'url' => ''])

@section('content-admin')
    <!--begin::Tables Widget 11-->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header pt-5">
            <div class="card-toolbar">
                <a class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#create">
                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Iklan</a>
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
                            <th class="text-center">Nama</th>
                            <th class="text-center">Link</th>
                            <th class="text-center">Gambar Iklan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ads as $ad)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $ad->name }}</td>
                                <td class="text-center">{{ $ad->url }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('media/ads/' . $ad->image) }}" class="rounded" style="width: 150px">
                                </td>
                                <td class="text-center">
                                    @if ($ad->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                    @else
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>



                                <td class="text-center">
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                        data-kt-menu="true" style="">
                                        <!--begin::Menu item-->
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="" data-bs-toggle="modal" data-bs-target="#modal-edit"
                                                class="menu-link px-3 text-warning" id="btn-edit-post"
                                                data-id="{{ $ad->id }}">
                                                Edit
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 text-danger" data-bs-toggle="modal"
                                                data-kt-customer-table-filter="delete_row"
                                                data-bs-target="#kt_modal_delete_customer{{ $ad->id }}">
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
                            <div class="modal fade" id="kt_modal_delete_customer{{ $ad->id }}" tabindex="-1"
                                aria-hidden="true">
                                <!-- Konten modal penghapusan -->
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.ads.destroy', $ad->id) }}" method="POST"
                                            id="kt_modal_delete_customer_form">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-header">
                                                <h2 class="fw-bold">DELETE Iklan</h2>
                                                <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary"
                                                    data-bs-dismiss="modal">
                                                    <i class="ki-duotone ki-cross fs-1"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body py-10 px-lg-17">
                                                <p>Anda yakin ingin menghapus data Iklan dengan nama {{ $ad->name }}?
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
                        @include('admin.management-ads.edit')
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
                        action="{{ route('admin.ads.store') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- <input type="hidden" name="id" id="id"> --}}
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Create Ads</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="form-group">
                                <label class="font-weight-bold">Gambar Iklan</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">

                                <!-- error message untuk title -->
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-12">

                                <label class="required fs-6 fw-semibold mb-2">Nama</label>
                                <input class="form-control form-control-lg" id="name"
                                    placeholder="Masukan nama Iklan" name="name" required />

                                @error('name')
                                    <span class="text-danger mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Link</label>
                                <input type="text" name="url" class="form-control" placeholder="Masukan website" required>
                            </div>
                            <div class="col-md-12">
                                <label class="required fs-6 fw-semibold mb-2">Active</label>
                                <select class="form-select form-select-solid is_active-edit" name="is_active" id="is_active-edit">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-is_active-edit"></div>
                                @error('is_active')
                                    <span class="text-danger mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            {{-- <input type="hidden" name="category" value="Harian"> --}}


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
