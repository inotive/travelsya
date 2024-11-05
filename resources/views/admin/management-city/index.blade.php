@extends('admin.layout', ['title' => 'Daftar Iklan', 'url' => ''])

@section('content-admin')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!--begin::Tables Widget 11-->
<div class="card mb-5 mb-xl-8">
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
                        <th class="min-w-300px text-center">Photo</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $key => $city)
                    <tr>
                        {{-- <<<<<<< HEAD <td class="text-center" style='width:10%;'>{{ $loop->iteration }}</td>
                            <td class="text-center" style='width:20%;'>{{ $city->city_name }}</td>
                            <td class="text-center" style='width:40%;'><img width="100px"
                                    src="{{ asset('storage/media/kota/'. $city->image) }}" alt="{{ $city->image }}">
                            </td>
                            <td class="text-center" style='width:30%;'>
                                <div class="row">
                                    <div class="col-6">
                                        <a href="javascript:void(0)" id="btn-edit-post"
                                            data-city_id="{{ $city->city_id }}"
                                            class="btn btn-sm btn-warning w-100">Edit Foto</a>
                                    </div>
                                    <div class="col-6">
                                        <form
                                            action="{{ route('admin.city-management.updateLanding', $city->city_id) }}"
                                            method="POST">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="status" value="{{ $city->status == 0 ? 1 : 0 }}">
                                            <button type="submit"
                                                class="btn  {{ $city->status == 0 ? 'btn-primary' : 'btn-outline-danger' }} btn-sm border-0 text-white w-100">
                                                {{ $city->status == 0 ? 'Tampilkan Di Home' : 'Sembunyikan' }}
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                ======= --}}
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $city->city_name }}</td>
                            <td><img width="150" src="{{ asset('storage/media/kota/'. $city->image) }}"
                                    alt="{{ $city->image }}" class="mx-auto"></td>
                            <td>
                                <div class="badge {{ $city->status == 1 ? 'bg-success' : 'bg-danger' }} text-white">
                                    {{ $city->status == 1 ? 'Aktif' : 'Tidak Aktif' }}
                                </div>
                            </td>
                            <td>
                                <div class="text-center d-flex">
                                    <form id="statusForm_{{ $city->city_id }}"
                                        action="{{ route('admin.city-management.updateLanding', $city->city_id) }}"
                                        method="POST" class="me-2">
                                        @csrf
                                        @method('put')
{{--                                        <input type="hidden" id="field_status" name="status" value="{{ $city->status == 0 ? 1 : 0 }}">--}}
                                        <button  type="button" onclick="confirm({{ $city->city_id }}, {{ $city->status ?? 0 }})"
                                            class="btn btn-sm {{ $city->status == 0 ? 'btn-success' : 'btn-danger' }} border-0 text-white">
                                            {{ $city->status == 0 ? 'Aktifkan' : 'Nonaktifkan' }}
                                        </button>
                                    </form>
                                    <a href="javascript:void(0)" id="btn-edit-post" data-city_id="{{ $city->city_id }}"
                                        class="btn btn-sm btn-warning border-0 text-white mb-5">EDIT</a>
                                </div>
                                @php
                                $cityStatus = $city->status;
                                $kunci = $city->city_id;
                                @endphp

{{--                                @if ($cityStatus == 0)--}}
{{--                                <script>--}}
{{--                                    document.getElementById('statusButton_{{ $kunci }}').addEventListener('click', function() {--}}
{{--                                                Swal.fire({--}}
{{--                                                    title: 'Konfirmasi Tampilkan Kota',--}}
{{--                                                    text: 'Apakah Anda ingin menampilkan kota ini ke landing page?',--}}
{{--                                                    icon: 'question',--}}
{{--                                                    showCancelButton: true,--}}
{{--                                                    confirmButtonColor: '#3085d6',--}}
{{--                                                    cancelButtonColor: '#d33',--}}
{{--                                                    confirmButtonText: 'Ya, Tampilkan!',--}}
{{--                                                    cancelButtonText: 'Batal'--}}
{{--                                                }).then((result) => {--}}
{{--                                                    if (result.isConfirmed) {--}}
{{--                                                        // Jika pengguna mengonfirmasi, kirim formulir--}}
{{--                                                        document.getElementById('statusForm_{{ $kunci }}').submit();--}}
{{--                                                    }--}}
{{--                                                });--}}
{{--                                            });--}}
{{--                                </script>--}}
{{--                                @elseif ($cityStatus == 1)--}}
{{--                                <script>--}}
{{--                                    document.getElementById('statusButton_{{ $kunci }}').addEventListener('click', function() {--}}
{{--                                                Swal.fire({--}}
{{--                                                    title: 'Konfirmasi Sembunyikan Kota',--}}
{{--                                                    text: 'Apakah Anda ingin menyembunyikan kota ini dari landing page?',--}}
{{--                                                    icon: 'question',--}}
{{--                                                    showCancelButton: true,--}}
{{--                                                    confirmButtonColor: '#3085d6',--}}
{{--                                                    cancelButtonColor: '#d33',--}}
{{--                                                    confirmButtonText: 'Ya, Sembunyikan!',--}}
{{--                                                    cancelButtonText: 'Batal'--}}
{{--                                                }).then((result) => {--}}
{{--                                                    if (result.isConfirmed) {--}}
{{--                                                        // Jika pengguna mengonfirmasi, kirim formulir--}}
{{--                                                        document.getElementById('statusForm_{{ $kunci }}').submit();--}}
{{--                                                    }--}}
{{--                                                });--}}
{{--                                            });--}}
{{--                                </script>--}}
{{--                                @endif--}}
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
    function confirm(id, status){
        if(status == 0)
        {
            Swal.fire({
                title: 'Konfirmasi Tampilkan Kota',
                text: 'Apakah Anda ingin menampilkan kota ini ke landing page?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Tampilkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi, kirim formulir
                    document.getElementById('statusForm_' + id).submit();
                }
            });
        }
        else{
            Swal.fire({
                title: 'Konfirmasi Sembunyikan Kota',
                text: 'Apakah Anda ingin menyembunyikan kota ini dari landing page?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Sembunyikan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengonfirmasi, kirim formulir
                    document.getElementById('statusForm_' + id).submit();
                }
            });
        }
    }
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
