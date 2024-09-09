@extends('ekstranet.layout', ['title' => 'Daftar Rekreasi', 'url' => '#'])

@section('content-admin')

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
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Paket</th>
                        <th class="text-center">Durasi</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                @foreach ($data as $item)
                <tbody class="fw-semibold text-gray-600 text-center">

                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->category_name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->duration }}</td>
                        <td>{{ $item->price }}</td>
                        <td>
                            @if ($item->is_active === 1)
                                      <span class="badge badge-success">Aktif</span>
                                  @elseif ($item->is_active === 0)
                                      <span class="badge badge-danger">Tidak Aktif</span>
                                  @endif
                        </td>
                        <td>
                            <a href="#">Detail</a> |
                            <a href="#">Update</a> |
                            <a href="#">Delete</a>
                        </td>
                </tbody>
                @endforeach
            </table>

        </div>
        <!--end::Table container-->
    </div>

    <!--begin::Body-->
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
                <form id="kt_modal_new_target_form" class="form" method="post" action="">
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Tambah Rekreasi</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-4">
                            <label class="required fs-6 fw-semibold mb-2">Kategori</label>
                            <select class="form-select" aria-label="Default select example">
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
                        <div class="col-md-8">
                            <label class="required fs-6 fw-semibold mb-2">Nama Peket</label>
                            <input type="text" class="form-control form-control-lg" placeholder="Nama Paket" name="" id="" value="" required>
                            @error('user_id')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <input type="hidden" value="1">
                        </div>

                        <div class="col-md-4">
                            <label class="required fs-6 fw-semibold mb-2">Durasi</label>
                            <input class="form-control form-control-lg" type="text" id="" placeholder="Menit" name="" value="" required/>

                            @error('phone')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-8">
                            <label class="required fs-6 fw-semibold mb-2">Harga</label>
                            <input class="form-control form-control-lg" type="number" id="" placeholder="Rp." name="" required />

                            @error('city')
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
