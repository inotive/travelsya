@extends('ekstranet.layout', ['title' => 'Daftar Bus & Travel', 'url' => '#'])

@section('content-admin')
    <div class="card">
        <div class="card-header pt-5">
            <div class="card-title">
                @if(request('business_id'))
                    @php
                        $selectedBusiness = \App\Models\BusTravels::find(request('business_id'));
                    @endphp
                    <h3 class="fw-bold">
                        Daftar Bus & Travel - {{ $selectedBusiness->business_name ?? 'Semua' }}
                    </h3>
                @else
                    <h3 class="fw-bold">Semua Bus & Travel</h3>
                @endif
            </div>
            <div class="card-toolbar">
                <a class="btn btn-sm btn-light-primary" href="{{ route('partner.create.bus-travel') }}">
                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Bus & Travel
                </a>
            </div>
        </div>
        <div class="card-body py-3">
            <div class="table-responsive">
                <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle" id="kt_datatable_zero_configuration">
                    <thead class="fw-bold">
                        <tr>
                            <th style="width: 50px">No</th>
                            <th style="width: 150px">Gambar</th>
                            <th style="width: 150px">Nama Bisnis</th>
                            <th style="width: 150px">Nama Bus/Travel</th>
                            <th style="width: 100px">Kategori</th>
                            <th style="width: 100px">Kelas</th>
                            <th style="width: 70px">Kursi</th>
                            <th style="width: 70px">Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-posts">
                        @foreach ($buses as $bus)
                            <tr id="index_{{ $bus->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if ($bus->main_image)
                                        <img src="{{ asset('storage/buses/main/' . $bus->main_image) }}"
                                            style="max-width: 130px; max-height: 100px; width: auto; height: auto; display: block;">
                                    @else
                                        @php
                                            $images = is_array($bus->image) ? $bus->image : json_decode($bus->image, true);
                                        @endphp
                                        @if (!empty($images) && is_array($images))
                                            <img src="{{ asset('storage/buses/' . $images[0]) }}"
                                                style="max-width: 130px; max-height: 100px; width: auto; height: auto; display: block;">
                                        @else
                                            <span class="text-muted">Tidak Ada Gambar</span>
                                        @endif
                                    @endif
                                </td>
                                <td>{{ $bus->busTravel->business_name ?? '' }}</td>
                                <td>{{ $bus->name ?? '' }}</td>
                                <td>
                                    <span class="badge badge-light-info">{{ ucfirst($bus->kategori ?? '') }}</span>
                                </td>
                                <td>{{ $bus->class ?? '' }}</td>
                                <td class="text-center">{{ $bus->number_seats ?? 0 }}</td>
                                <td class="text-center">
                                    @if ($bus->is_active == '1')
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('partner.show.bus-travel', $bus->id) }}"
                                           class="btn btn-sm btn-light-warning btn-icon">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        <a type="button" class="btn btn-sm btn-light-danger btn-icon"
                                           data-bs-toggle="modal" data-bs-target="#deleteModal"
                                           data-id="{{ $bus->id }}">
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
                    const busId = this.getAttribute('data-id');
                    const form = document.getElementById('form-delete');
                    form.action = '{{ route('partner.destroy.bus-travel', '__id') }}'.replace('__id', busId);
                });
            });
        });
    </script>
@endpush
