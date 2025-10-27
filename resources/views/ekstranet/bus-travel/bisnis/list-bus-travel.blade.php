@extends('ekstranet.layout', ['title' => 'Daftar Bisnis Bus Travel', 'url' => '#'])

@section('content-admin')
    <div class="card">
        <div class="card-header pt-5">
            <div class="card-toolbar">
                <a class="btn btn-sm btn-light-primary" href="{{ route('partner.bisnis.bus-travel.create') }}">
                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Bisnis Bus & Travel
                </a>
            </div>
        </div>
        <div class="card-body py-3">
            <div class="table-responsive">
                <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle"
                    id="kt_datatable_zero_configuration">
                    <thead class="fw-bold">
                        <tr>
                            <th style="width: 50px">No</th>
                            <th style="width: 150px">Logo</th>
                            <th style="width: 150px">Nama Bisnis</th>
                            <th style="width: 150px">Kota</th>
                            <th style="width: 100px">Telepon</th>
                            <th style="width: 250px">Alamat</th>
                            <th style="width: 70px">Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody id="table-posts">
                        @foreach ($bus_travels as $travel)
                            <tr id="index_{{ $travel->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ $travel->image ? asset('storage/bus-travel-images/' . $travel->image) : '' }}"
                                        style="width: 130px; height: 100px; object-fit: contain;">
                                </td>
                                <td>{{ $travel->business_name ?? '' }}</td>
                                <td>{{ $travel->cityDetail->city_name ?? '' }}</td>
                                <td>{{ $travel->phone ?? '' }}</td>
                                <td class="text-truncate" style="max-width: 250px">{{ $travel->address ?? '' }}</td>
                                <td class="text-center">
                                    @if ($travel->is_active == '1')
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('partner.bisnis.bus-travel.edit', $travel->id) }}" class="btn btn-sm btn-light-warning btn-icon">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        <a type="button" class="btn btn-sm btn-light-danger btn-icon" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $travel->id }}">
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
@endsection

@push('add-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('[data-bs-target="#deleteModal"][data-id]');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const travelId = this.getAttribute('data-id');
                    const form = document.getElementById('form-delete');
                    form.action = '{{ route('partner.bisnis.bus-travel.destroy', '__id') }}'.replace('__id', travelId);
                });
            });
        });
    </script>
@endpush
