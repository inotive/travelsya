@extends('ekstranet.layout', ['title' => 'Daftar Kendaraan', 'url' => '#'])

@section('content-admin')
    <div class="card">
        <div class="card-header pt-5">
            <div class="card-toolbar">
                <a class="btn btn-sm btn-light-primary" href="{{ route('partner.halaman.create') }}">
                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Data Mobil</a>
            </div>
        </div>
        <div class="card-body py-3">
            <div class="table-responsive">
                <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle"
                       id="kt_datatable_zero_configuration">
                    <thead class="fw-bold">
                    <tr>
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Brand</th>
                        <th>Model</th>
                        <th>Tahun</th>
                        <th class="text-center px-2">Tipe</th>
                        <th>Jumlah Seat</th>
                        <th>Kategori Rental</th>
                        <th>Biaya Rental</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>

                    <tbody id="table-posts">
                    @php
                        $no = 1;
                    @endphp

                    @foreach ($cars as $car)
                        <tr id="index_{{ $car->id }}">
                            <td>{{ $no++ }}</td>
                            <td>
                                @if ($car->image_url)
                                    <img src="{{ Storage::url($car->image_url) }}"
                                         style="width: 130px; height: 100px; object-fit: contain;">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>{{ $car->brand->name ?? '' }}</td>
                            <td>{{ $car->carModel->name ?? '' }}</td>
                            {{-- <td>{{ $car->policy->id }}</td> --}}
                            <td>{{ $car->years }}</td>
                            <td class="text-center"><span class="badge badge-primary">{{ ucwords($car->category) }}</span></td>
                            <td class="text-center">{{ $car->number_seats }}</td>
                            <td>{{ $car->category_rent }}</td>
                            <td>Rp. {{ number_format($car->rental_price_per_day, 0,',','.') }}</td>
                            <td class="text-center">
                                @if ($car->status == '1')
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                @endif
                            </td>

                            <td>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('partner.show.kendaraan', $car->id) }}" class="btn btn-sm btn-light-warning btn-icon">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </a>
                                    <button class="btn btn-sm btn-light-danger btn-icon" onclick="deleteCar({{ $car->id }})">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- Toast Container for Success -->
    <div aria-live="polite" aria-atomic="true" style="position: relative; z-index: 1050;">
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="toast-success" class="toast align-items-center text-white bg-success border-0 rounded-3 shadow-lg" role="alert"
                aria-live="assertive" aria-atomic="true" style="min-width: 350px; font-size: 1.1rem;">
                <div class="d-flex">
                    <div class="toast-icon me-2">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="toast-body">
                        Data berhasil ditambahkan!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>


    <!-- Toast Container for Delete -->
    <div aria-live="polite" aria-atomic="true" style="position: relative; z-index: 1050;">
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="toast-delete" class="toast align-items-center text-white bg-success border-0 rounded-3 shadow-lg" role="alert"
                aria-live="assertive" aria-atomic="true" style="min-width: 350px; font-size: 1.1rem;">
                <div class="d-flex">
                    <div class="toast-icon me-2">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="toast-body">
                        Data berhasil dihapus!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>


    <!-- Toast Container for update -->
    <div aria-live="polite" aria-atomic="true" style="position: relative; z-index: 1050;">
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="toast-update" class="toast align-items-center text-white bg-success border-0 rounded-3 shadow-lg" role="alert"
                aria-live="assertive" aria-atomic="true" style="min-width: 350px; font-size: 1.1rem;">
                <div class="d-flex">
                    <div class="toast-icon me-2">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="toast-body">
                        Data berhasil diupdate!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

@push('add-script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success_add'))
                var toastElSuccess = document.getElementById('toast-success');
                if (toastElSuccess) {
                    var toastSuccess = new bootstrap.Toast(toastElSuccess);
                    toastSuccess.show();
                }
            @endif

            @if (session('delete'))
                var toastElDelete = document.getElementById('toast-delete');
                if (toastElDelete) {
                    var toastDelete = new bootstrap.Toast(toastElDelete);
                    toastDelete.show();
                }
            @endif

            @if (session('update'))
                var toastElUpdate = document.getElementById('toast-update');
                if (toastElUpdate) {
                    var toastUpdate = new bootstrap.Toast(toastElUpdate);
                    toastUpdate.show();
                }
            @endif
        });

        function deleteCar(id) {
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak dapat dikembalikan.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus",
                cancelButtonText: "Tidak, Batal",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = "{{ route('partner.kendaraan.delete', ':id') }}";
                    url = url.replace(':id', id);

                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' 
                        },
                        success: function(response) {
                            swalWithBootstrapButtons.fire(
                                'Terhapus!',
                                response.success || 'Data mobil berhasil dihapus.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        },
                        error: function(xhr) {
                            let errorMessage = 'Terjadi kesalahan saat menghapus data.';
                            if (xhr.responseJSON && xhr.responseJSON.error) {
                                errorMessage = xhr.responseJSON.error;
                            }
                            swalWithBootstrapButtons.fire(
                                'Gagal Dihapus!',
                                errorMessage,
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>
@endpush
