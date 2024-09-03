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

            <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle"
                id="kt_datatable_zero_configuration">
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
                <tbody>
                  {{-- foreach --}}
                    @foreach ($data as $item)
                        <td>1</td>
                        <td>{{ $item->category_recreation_id }}</td>
                        <td></td>
                        <td>{{ $item->duration }}</td>
                        <td>{{ $item->price }}</td>
                        <td></td>
                    @endforeach
                  {{-- end foreach --}}
              </tbody>
            </table>

        </div>
        <!--end::Table container-->
    </div>

    <!--begin::Body-->
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
