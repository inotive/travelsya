@extends('admin.layout', ['title' => 'Daftar Iklan', 'url' => ''])

@section('content-admin')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                            <th class="text-center">Nama Kota</th>
                            <th class="text-center">Photo</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cities as $city)
                            <tr>
                                <td class="text-center" style='width:10%;'>{{ $loop->iteration }}</td>
                                <td class="text-center" style='width:20%;'>{{ $city->city_name }}</td>
                                <td class="text-center" style='width:40%;'><img width="100px" src="{{ asset('storage/media/kota/'. $city->image) }}" alt="{{ $city->image }}"></td>
                                <td class="text-center" style='width:30%;'>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="javascript:void(0)" id="btn-edit-post" data-city_id="{{ $city->city_id }}" class="btn btn-sm btn-warning w-100">Edit Foto</a>
                                        </div>
                                        <div class="col-6">
                                            <form action="{{ route('admin.city-management.updateLanding', $city->city_id) }}" method="POST">
                                                @csrf
                                                @method('put')
                                                <input type="hidden" name="status" value="{{ $city->status == 0 ? 1 : 0 }}">
                                                <button type="submit" class="btn  {{ $city->status == 0 ? 'btn-primary' : 'btn-outline-danger' }} btn-sm border-0 text-white w-100">
                                                    {{ $city->status == 0 ? 'Tampilkan Di Home' : 'Sembunyikan' }}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!--end::Table-->
            </div>
        </div>
    </div>
    <!--end::Tables Widget 11-->

    @include('admin.management-city.edit')

    @push('add-script')


</script>
{{-- Datatables --}}
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
