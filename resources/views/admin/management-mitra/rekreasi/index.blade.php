@extends('admin.layout', ['title' => 'Daftar Rekreasi', 'url' => ''])

@section('content-admin')
<!--begin::Tables Widget 11-->
<div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header pt-5">
        <div class="card-toolbar">
            <a class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#create">
                <i class="ki-duotone ki-plus fs-2"></i>Tambah Data Rekreasi</a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->

            <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle" id="kt_datatable_zero_configuration">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800 ">
                        <th class="text-center">No.</th>
                        <th class="text-center">Mitra</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Nama Bisnis</th>
                        <th class="text-center">Kota/Kabupaten</th>
                        <th class="text-center">Alamat</th>
                        <th class="text-center">Nomor Telepon</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($recreations as $recreation)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td class="text-center">
                            <img src="{{ $recreation->image != null && $recreation->image != "-" ? asset('storage/' . $recreation->image) : 'https://static.vecteezy.com/system/resources/previews/000/627/584/non_2x/vector-hotel-icon-symbol-sign.jpg' }}" alt="" style="width: 25px; height: 25px;">
                            {{ $recreation->name }}
                        </td>

                        <td>
                            {{ $recreation->category_name }}
                        </td>

                        <td class="text-center">
                            {{ $recreation->business_name }}
                        </td>

                        <td class="text-center">
                            {{ $recreation->city_name }}
                        </td>

                        <td class="text-center">
                            {{ $recreation->address }}
                        </td>

                        <td class="text-center">
                            {{ $recreation->recreation_phone }}
                        </td>

                        <td class="text-center">
                            @if ($recreation->recreation_status === 1)
                            <span class="badge badge-success">Aktif</span>
                            @elseif ($recreation->recreation_status === 0)
                            <span class="badge badge-danger">Tidak Aktif</span>
                            @endif
                        </td>

                        <td class="text-center">
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true" style="">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="" data-bs-toggle="modal" data-bs-target="#modal-edit" class="menu-link px-3 text-warning" id="btn-edit-rental" data-id="{{ $recreation->recreation_id }}">
                                        Edit
                                    </a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3 text-danger" data-bs-toggle="modal" data-kt-customer-table-filter="delete_row" data-bs-target="#kt_modal_delete_customer{{ $recreation->recreation_id }}">
                                        Delete
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--begin::Menu-->
                            <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                Aksi
                                <i class="ki-duotone ki-down fs-5 ms-1"></i>
                            </a>
                            <!--end::Menu-->
                        </td>
                    </tr>
                    <div class="modal fade" id="kt_modal_delete_customer{{ $recreation->recreation_id }}" tabindex="-1" aria-hidden="true">
                        <!-- Konten modal penghapusan -->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <div class="modal-content">
                                <form action="{{ route('admin.rekreasi.destroy', $recreation->recreation_id) }}" method="POST" id="kt_modal_delete_customer_form">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-header">
                                        <h2 class="fw-bold">DELETE RENTAL MOBIL</h2>
                                        <button type="button" class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                                            <i class="ki-duotone ki-cross fs-1"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body py-10 px-lg-17">
                                        <p>Anda yakin ingin menghapus data klinik dengan nama {{ $recreation->business_name }}?
                                        </p>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @include('admin.management-mitra.rekreasi.edit')


                </tbody>
            </table>

        </div>
        <!--end::Table container-->
    </div>

    <!--begin::Body-->
</div>
<!--end::Tables Widget 11-->




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
                <form id="kt_modal_new_target_form" class="form" method="post" action="{{ route('admin.rekreasi.store') }}">
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
                            <input class="form-control form-control-lg" id="name" placeholder="Masukan nama usaha" name="name" required />

                            @error('name')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Mitra</label>
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
                            <label class="required fs-6 fw-semibold mb-2">Nomor Telpon</label>
                            <input class="form-control form-control-lg" id="phone" placeholder="Masukan nomor telepon... " name="phone" required />

                            @error('phone')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                <div class="col-md-6">
                    <label class="fs-6 fw-semibold mb-2">Latitude.</label>
                    <input class="form-control form-control-lg" placeholder="lat" type="number" step="any" name="lat" />
                    @error('lat')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="col-md-6">
                    <label class="fs-6 fw-semibold mb-2">Longitude.</label>
                    <input class="form-control form-control-lg" placeholder="ltd" type="number" step="any" name="ltd" />
                    @error('ltd')
                    <span class="text-danger mt-1" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Kota / Kabupaten</label>

                            <select class="js-example-basic-single form-control form-control-lg" name="city" id="city">
                                @foreach ($cities as $city)
                                <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                                @endforeach
                            </select>


                            @error('city')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="required fs-6 fw-semibold mb-2">Kategori</label>
                            <select name="category_recreation_id" class="form-select" aria-label="Default select example" required>
                                @foreach ($category as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="" class="form-label">Alamat</label>
                            <textarea name="address" id="address" cols="30" rows="5" class="form-control" required></textarea>
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
                                    <span class="indicator-label">Simpan</span>
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



@push('add-script')
<script>
    $(document).ready(function() {
        $('#kt_datatable_zero_configuration').DataTable({
            "scrollY": "500px"
            , "scrollCollapse": true
            , "language": {
                "lengthMenu": "Show _MENU_"
            , }
            , "dom": "<'row'" +
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
