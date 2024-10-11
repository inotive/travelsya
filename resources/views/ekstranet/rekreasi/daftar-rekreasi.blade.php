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
            <table id="kt_datatable" class="table-row-dashed fs-6 gy-5 table-bordered table align-middle">
                <thead>
                    <tr class="fw-bold fs-6 text-gray-800">
                        <th class="text-center">No.</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-center">Paket</th>
                        <th class="text-center">Durasi</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="fw-semibold text-gray-600 text-center">
                    @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->category_name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->duration }} {{ $item->unit_price }}</td>
                        <td>{{ 'Rp '.number_format($item->price) ?? '' }}</td>
                        <td>
                            @if ($item->is_active === 1)
                                <span class="badge badge-success">Aktif</span>
                            @else
                                <span class="badge badge-danger">Tidak Aktif</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-light-primary btn-icon" data-bs-toggle="modal" data-bs-target="#detailModal" onclick="showDetail({{ $item->id }})">
                                <i class="fa fa-info-circle" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-sm btn-light-warning btn-icon">
                                <a href="{{ route('recreation.edit', $item->id) }}">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                            </button>
                            <button class="btn btn-sm btn-light-danger btn-icon" onclick="deleteRecreation({{ $item->id }})">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
                <div id="package-details"></div>
            </div>
        </div>
    </div>
</div>

<!-- SweetAlert -->
@if (session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Data berhasil ditambahkan.',
        toast: true,
        showConfirmButton: false,
        timer: 2000
    });
</script>
@elseif(session('success_update'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Data berhasil Diubah.',
        toast: true,
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

@push('add-script')
<script>
    // Countdown
    function startCountdown(expiryDate) {
        let countdownElement = document.getElementById('countdown');

        setInterval(function() {
            let now = Math.floor(Date.now() / 1000);
            let remainingSeconds = expiryDate - now;

            if (remainingSeconds < 0) {
                countdownElement.innerHTML = 'Waktu habis';
                clearInterval(this);
                return;
            }

            let days = Math.floor(remainingSeconds / 86400);
            remainingSeconds %= 86400;
            let hours = Math.floor(remainingSeconds / 3600);
            remainingSeconds %= 3600;
            let minutes = Math.floor(remainingSeconds / 60);
            let seconds = remainingSeconds % 60;

            countdownElement.innerHTML = `${days} Hari, ${hours} Jam, ${minutes} Menit, ${seconds} Detik`;
        }, 1000);
    }

    // Memanggil fungsi dengan waktu kedaluwarsa
    document.addEventListener("DOMContentLoaded", function() {
        startCountdown({{ $item->expiry_date }});
    });

    // DataTable
    $(document).ready(function() {
        $('#kt_datatable').DataTable({
            "scrollY": "500px",
            "scrollCollapse": true,
            "language": {
                "lengthMenu": "_MENU_",
            },
            "dom": "<'row'" +
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
            url: 'recreation/' + id,
            type: 'GET',
            success: function(response) {
                $('#package-details').html(`
                    <p><strong>Nama Paket:</strong> ${response.name || '-'}</p>
                    <p><strong>Kategori:</strong> ${response.category_name || '-'}</p>
                    <p><strong>Durasi:</strong> ${response.duration || '-'} ${response.unit_price || '-'}</p>
                    <p><strong>Kadaluarsa Dalam:</strong> ${response.expiry_date || '-'} ${response.expiry_type || '-'}</p>
                    <p><strong>Harga:</strong> Rp ${response.price || '-'}</p>
                    <p><strong>Deskripsi:</strong> ${response.description || '-'}</p>
                    <p><strong>Peraturan:</strong> ${response.rules || '-'}</p>
                    <p><strong>Status:</strong> ${(response.is_active == 1 ? 'Aktif' : 'Tidak Aktif')}</p>
                `);
            },
            error: function() {
                alert('Gagal mengambil data!');
            }
        });
    }

    // delete
    function deleteRecreation(id) {
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });

        swalWithBootstrapButtons.fire({
            title: "Apakah kamu yakin ingin menghapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Tidak jadi",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'recreation/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        swalWithBootstrapButtons.fire(
                            'Terhapus!',
                            'Data ini berhasil dihapus.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    },
                    error: function(response) {
                        swalWithBootstrapButtons.fire(
                            'Error!',
                            'Terjadi error saat menghapus data.',
                            'error'
                        );
                    }
                });
            }
        });
    }
</script>
@endpush
@endsection
