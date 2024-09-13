@extends('ekstranet.layout', ['title' => 'Daftar Rekreasi', 'url' => '#'])

@section('content-admin')
<div class="card mb-5 mb-xl-8">
    <!--begin::Header-->
    <div class="card-header pt-5">
        <div class="card-toolbar">
            <a class="btn btn-sm btn-light-primary" href="{{ route('recreation.create') }}">
                <i class="ki-duotone ki-plus fs-2"></i>Tambah Data Rekreasi</a>
        </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->

            <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle">
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
                    <td>{{ 'Rp '.number_format($item->price) ?? '' }}</td>
                    <td>
                        @if ($item->is_active === 1)
                        <span class="badge badge-success">Aktif</span>
                        @elseif ($item->is_active === 0)
                        <span class="badge badge-danger">Tidak Aktif</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-sm btn-light-primary btn-icon" data-bs-toggle="modal" data-bs-target="#detailModal" onclick="showDetail({{ $item->id }})">
                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                        </button>

                        <!-- Edit Button -->
                        <button class="btn btn-sm btn-light-warning btn-icon" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editRecreation({{ $item->id }})">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </button>

                        <!-- Delete Button (optional) -->
                        <button class="btn btn-sm btn-light-danger btn-icon" onclick="deleteRecreation({{ $item->id }})">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </button>
                    </td>
                </tbody>
                @endforeach
            </table>
            {{ $data->appends(request()->input())->links('vendor.pagination.bootstrap-5') }}

        </div>
        <!--end::Table container-->
    </div>

    <!--begin::Body-->
</div>

{{-- Modal Detail --}}
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content rounded">
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span><span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <h5 class="text-center">Detail Paket Rekreasi</h5>
                <div id="package-details">

                </div>
            </div>
        </div>
    </div>
</div>

{{-- Edit Modal --}}
<div class="modal fade" id="editRecreationModal" tabindex="-1" role="dialog" aria-labelledby="editRecreationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="editRecreationForm">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRecreationModalLabel">Edit Recreation</h5>
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span><span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="editRecreationId">

                    <div class="form-group">
                        <label for="editName">Nama Paket</label>
                        <input type="text" class="form-control" id="editName" name="name">
                    </div>

                    <div class="form-group mt-3">
                        <label for="editCategory">Kategori</label>
                        <select class="form-control" id="editCategory" name="category_recreation_id">
                            @foreach($category as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group mt-3">
                        <label for="editDuration">Durasi</label>
                        <input type="text" class="form-control" id="editDuration" name="duration">
                    </div>

                    <div class="form-group mt-3">
                        <label for="editPrice">Harga</label>
                        <input type="number" class="form-control" id="editPrice" name="price">
                    </div>

                    <div class="form-group mt-3">
                        <label for="editStatus">Status</label>
                        <select id="editStatus" name="is_active" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- SweetAlert -->
@if (session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        position: 'top-end'
        , icon: 'success'
        , title: 'Data berhasil ditambahkan.'
        , toast: true
        , showConfirmButton: false
        , timer: 2000
    })

</script>
@endif
@push('add-script')
<script>
    $(document).ready(function() {
        $('#kt_datatable_zero_configuration').DataTable({
            "scrollY": "500px"
            , "scrollCollapse": true
            , "language": {
                "lengthMenu": "Show _MENU_"
            }
            , "dom": "<'row'" +
                "<'col-sm-6 d-flex align-items-center justify-content-start'l>" +
                "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                ">" +
                "<'table-responsive'tr>" +
                "<'row'" +
                "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                ">"
        });
    });

    // detail
    function showDetail(id) {
        $.ajax({
            url: 'recreation/' + id
            , type: 'GET'
            , success: function(response) {
                $('#package-details').html(`
                <p><strong>Nama Paket:</strong> ${response.name}</p>
                <p><strong>Kategori:</strong> ${response.category_name}</p>
                <p><strong>Durasi:</strong> ${response.duration}</p>
                <p><strong>Latitude:</strong> ${response.lat}</p>
                <p><strong>Longitude:</strong> ${response.ltd}</p>
                <p><strong>Tanggal Kadaluarsa:</strong> ${response.expiry_date}</p>
                <p><strong>Harga:</strong> Rp ${response.price}</p>
                <p><strong>Status:</strong> ${(response.is_active == 1 ? 'Aktif' : 'Tidak Aktif')}</p>
            `);
            }
            , error: function() {
                alert('Gagal mengambil data!');
            }
        });
    }

    // add

    document.getElementById('kt_modal_new_target_submit').addEventListener('click', function(event) {
        var durationInput = document.getElementById('duration').value;
        var durationType = document.getElementById('durationType').value;

        var combinedDuration = durationInput + ' ' + durationType;

        document.getElementById('combinedDuration').value = combinedDuration;
    });

    document.getElementById('kt_modal_new_target_submit').addEventListener('click', function(event) {
        var expiryInput = document.getElementById('expiry').value;
        var expiryType = document.getElementById('expiryType').value;

        var combinedExpiry = expiryInput + ' ' + expiryType;

        document.getElementById('combinedExpiry').value = combinedExpiry;
    });


    // edit
    function editRecreation(id) {
        $.ajax({
            url: 'recreation/' + id
            , type: 'GET'
            , success: function(response) {
                $('#editRecreationId').val(response.id);
                $('#editName').val(response.name);
                $('#editCategory').val(response.category_recreation_id);
                $('#editDuration').val(response.duration);
                $('#editPrice').val(response.price);
                $('#editStatus').val(response.is_active);
                $('#editRecreationModal').modal('show');
            }
            , error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    $('#editRecreationForm').on('submit', function(e) {
        e.preventDefault();

        const id = $('#editRecreationId').val();
        const formData = {
            name: $('#editName').val()
            , category_recreation_id: $('#editCategory').val()
            , duration: $('#editDuration').val()
            , price: $('#editPrice').val()
            , is_active: $('#editStatus').val()
            , _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: 'recreation/' + id
            , type: 'PUT'
            , data: formData
            , success: function(response) {
                $('#editRecreationModal').modal('hide');
                Swal.fire({
                    icon: 'success'
                    , title: 'Success'
                    , text: 'Data berhasil diupdate!'
                , }).then(() => {
                    location.reload();
                });
            }
            , error: function(xhr) {
                Swal.fire({
                    icon: 'error'
                    , title: 'Error'
                    , text: 'Gagal mengupdate data!'
                , });
                console.log(xhr.responseText);
            }
        });
    });

    // delete
    function deleteRecreation(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success"
                , cancelButton: "btn btn-danger"
            }
            , buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: "Apakah kamu yakin?"
            , text: "Anda tidak akan dapat mengembalikan ini!"
            , icon: "warning"
            , showCancelButton: true
            , confirmButtonText: "Ya, Hapus!"
            , cancelButtonText: "Tidak jadi!"
            , reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: 'recreation/' + id
                    , type: 'DELETE'
                    , headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                    , success: function(response) {
                        swalWithBootstrapButtons.fire(
                            'Terhapus!'
                            , 'Data ini berhasil dihapus.'
                            , 'success'
                        ).then(() => {
                            location.reload();
                        });
                    }
                    , error: function(response) {
                        swalWithBootstrapButtons.fire(
                            'Error!'
                            , 'There was a problem deleting the file.'
                            , 'error'
                        );
                    }
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                swalWithBootstrapButtons.fire(
                    'Dibatalkan'
                    , 'Data tidak jadi dihapus.'
                    , 'error'
                );
            }
        });
    }

</script>
@endpush
@endsection
