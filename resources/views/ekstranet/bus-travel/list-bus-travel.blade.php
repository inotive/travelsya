@extends('ekstranet.layout', ['title' => 'Daftar Bus Travel', 'url' => '#'])

@section('content-admin')
    <div class="card">
        <div class="card-header pt-5">
            <div class="card-toolbar">
                <a class="btn btn-sm btn-light-primary" href="create-bus">
                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Data Bus & Travel</a>
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
                            <th>Nama</th>
                            {{-- <th class="text-center px-2">Class</th> --}}
                            <th>Jumlah Seat</th>
                            <th>Fasilitas</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="table-posts">
                        @php
                            $no = 1;
                        @endphp

                        @foreach ($buses as $bus)
                            <tr id="index_{{ $bus->id }}">
                                <td>{{ $no++ }}</td>
                                <td>
                                    @if ($bus->image)
                                        <img src="{{ asset('storage/buses/' . $bus->image) }}"
                                            style="width: 130px; height: 100px; object-fit: contain;">
                                    @else
                                        Tidak Ada Gambar
                                    @endif
                                </td>
                                <td>{{ $bus->name ?? '' }}</td>
                                <td>{{ $bus->number_seats ?? '0' }}</td>
                                <td style="max-width: 200px">
                                    @foreach ($bus->facilities as $facility)
                                        <span class="badge badge-info">{{ $facility->facility->name }}</span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @if ($bus->is_active == '1')
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>

                                <td>

                                    <div class="d-flex gap-1">
                                        <a href="{{ route('partner.bus.departures.bus', $bus->id) }}" class="btn btn-sm btn-light-info btn-icon">
                                            <i class="fa fa-clock" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('partner.show.bus-travel', $bus->id) }}" class="btn btn-sm btn-light-warning btn-icon">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        <a type="button" class="btn btn-sm btn-light-danger btn-icon" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $bus->id }}">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- MODAL DELETE DATA -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="" method="POST" id="form-delete">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Container for Success -->
    <div aria-live="polite" aria-atomic="true" style="position: relative; z-index: 1050;">
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="toast-success" class="toast align-items-center text-white bg-success border-0 rounded-3 shadow-lg"
                role="alert" aria-live="assertive" aria-atomic="true" style="min-width: 350px; font-size: 1.1rem;">
                <div class="d-flex">
                    <div class="toast-icon me-2">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="toast-body">
                        Data berhasil ditambahkan!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>


    <!-- Toast Container for Delete -->
    <div aria-live="polite" aria-atomic="true" style="position: relative; z-index: 1050;">
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="toast-delete" class="toast align-items-center text-white bg-success border-0 rounded-3 shadow-lg"
                role="alert" aria-live="assertive" aria-atomic="true" style="min-width: 350px; font-size: 1.1rem;">
                <div class="d-flex">
                    <div class="toast-icon me-2">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="toast-body">
                        Data berhasil dihapus!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>


    <!-- Toast Container for update -->
    <div aria-live="polite" aria-atomic="true" style="position: relative; z-index: 1050;">
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="toast-update" class="toast align-items-center text-white bg-success border-0 rounded-3 shadow-lg"
                role="alert" aria-live="assertive" aria-atomic="true" style="min-width: 350px; font-size: 1.1rem;">
                <div class="d-flex">
                    <div class="toast-icon me-2">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <div class="toast-body">
                        Data berhasil diupdate!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
@endsection

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

        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
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
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.menu-item .text-danger');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const busId = this.getAttribute('data-id');
                    const form = document.getElementById('form-delete');
                    form.action = '{{ route('partner.delete.bus-travel', '__id') }}'.replace(
                        '__id',
                        busId);
                });
            });
        });
    </script>

    <style>
        .toast {
            font-size: 1.1rem;
            width: 300px;
            height: 60px;
            display: flex;
            background-color: #28a745;
            /* Success color */
            color: white;
        }

        .toast-icon {
            font-size: 2rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: white;
            color: #28a745;
            margin-right: 10px;
            margin-left: 10px;
            padding: 10px;
            border: 2px solid #28a745;
            border-radius: 50%;
            width: 3rem;
            height: 3rem;
            box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
        }

        .toast-icon i {
            color: #28a745;
            /* Icon color matching the toast background */
        }

        .toast-body {
            flex: 1;
            font-size: 1.1rem;
        }

        .btn-close {
            background: transparent;
            border: none;
        }
    </style>
@endpush
