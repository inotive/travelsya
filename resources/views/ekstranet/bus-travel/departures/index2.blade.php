@extends('ekstranet.layout', [
    'title' => 'Kelola Jadwal Keberangkatan',
    'url' => '#',
    'subTitle' => 'Jadwal',
])

@section('content-admin')
<div class="card">
    <div class="card-header border-0 pt-6">
        <div class="card-title">
            <div class="d-flex align-items-center position-relative my-1">
                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                    {{-- Search Icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                            transform="rotate(45 17.0365 15.1223)" fill="black" />
                        <path
                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                            fill="black" />
                    </svg>
                </span>
                <input type="text" id="searchInput" class="form-control form-control-solid w-250px ps-14"
                    placeholder="Cari Jadwal..." />
            </div>
        </div>

        <div class="card-toolbar">
            {{-- Removed bus filter dropdown completely --}}
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#createDepartureModal">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                            transform="rotate(-90 11.364 20.364)" fill="black" />
                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                    </svg>
                </span>
                Tambah Jadwal Baru
            </button>
        </div>
    </div>

    <div class="card-body pt-0">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if($departures->isEmpty())
            <div class="text-center text-muted py-10">
                <i class="ki-duotone ki-information-5 fs-3x mb-3"></i>
                <h4>Tidak ada jadwal keberangkatan.</h4>
            </div>
        @else
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="departuresTable">
                <thead>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th>No</th>
                        <th>Bus</th>
                        <th>Dari</th>
                        <th>Tujuan</th>
                        <th>Waktu Berangkat</th>
                        <th>Durasi (Jam)</th>
                        <th>Harga</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                    @foreach ($departures as $key => $departure)
                        <tr data-search="{{ strtolower($departure->from->name ?? '') }} {{ strtolower($departure->to->name ?? '') }}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $departure->busTravel->name ?? 'N/A' }}</td>
                            <td>{{ $departure->from->name ?? 'N/A' }}</td>
                            <td>{{ $departure->to->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($departure->departure_time)->format('d M Y H:i') }}</td>
                            <td>{{ $departure->duration }}</td>
                            <td>Rp {{ number_format($departure->price, 0, ',', '.') }}</td>
                            <td class="text-end">
                                {{-- Edit & Delete Buttons --}}
                                <button type="button"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    data-bs-toggle="modal" data-bs-target="#editDepartureModal"
                                    data-id="{{ $departure->id }}"
                                    data-bus="{{ $departure->bus_travel_has_bus_id }}"
                                    data-from="{{ $departure->from_route_id }}"
                                    data-to="{{ $departure->to_route_id }}"
                                    data-time="{{ $departure->departure_time }}"
                                    data-duration="{{ $departure->duration }}"
                                    data-price="{{ $departure->price }}"
                                    data-days="{{ $departure->days }}">
                                    ✏️
                                </button>

                                <button type="button"
                                    class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm"
                                    data-bs-toggle="modal" data-bs-target="#deleteDepartureModal"
                                    data-id="{{ $departure->id }}">
                                    🗑️
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@include('ekstranet.bus-travel.departures.modals')
@endsection

@section('scripts')
<script>
    // Filter search on keyup
    document.getElementById('searchInput').addEventListener('keyup', function () {
        let search = this.value.toLowerCase();
        document.querySelectorAll('#departuresTable tbody tr').forEach(row => {
            row.style.display = row.dataset.search.includes(search) ? '' : 'none';
        });
    });

    // Populate delete modal
    $('#deleteDepartureModal').on('show.bs.modal', function(event) {
        $(this).find('#delete_departure_id').val($(event.relatedTarget).data('id'));
    });
</script>
@endsection
