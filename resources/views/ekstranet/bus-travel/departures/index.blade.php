@extends('ekstranet.layout', [
    'title' => 'Kelola Jadwal Keberangkatan',
    'url' => '#',
    'subTitle' => 'Jadwal',
])

@section('content-admin')
    <div class="card">
        <form action="{{ url()->current() }}" method="GET">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                    transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path
                                    d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                    fill="black" />
                            </svg>
                        </span>
                        <input type="text" id="searchInput" name="search" class="form-control form-control-solid w-250px ps-14"
                            placeholder="Cari Jadwal" value="{{ $search ?? '' }}" />
                    </div>
                    {{-- <div class="d-flex align-items-center position-relative my-1 ms-5">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div> --}}
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createDepartureModal">
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                        transform="rotate(-90 11.364 20.364)" fill="black" />
                                    <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black" />
                                </svg>
                            </span>
                            Tambah Jadwal Baru
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <div class="card-body pt-0">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Table wrapper with horizontal scroll -->
            <div class="table-responsive">
                <table class="table align-middle table-row-dashed fs-6 gy-5 table-fixed" id="departuresTable">
                    <thead class="sticky-top bg-light">
                        <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                            <th class="col-no">No</th>
                            <th class="col-from">Dari</th>
                            <th class="col-to">Tujuan</th>
                            <th class="col-pickup">Titik Naik</th>
                            <th class="col-dropoff">Titik Turun</th>
                            <th class="col-date">Tanggal Keberangkatan</th>
                            <th class="col-time">Waktu Berangkat</th>
                            <th class="col-duration">Durasi (Jam)</th>
                            <th class="col-price">Harga</th>
                            <th class="col-actions">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 fw-bold">
                        @foreach ($departures as $key => $departure)
                            <tr>
                                <td class="col-no">{{ $key + 1 }}</td>
                                <td class="col-from" title="{{ $departure->from->city_name ?? 'N/A' }}">
                                    <div class="text-truncate">{{ $departure->from->city_name ?? 'N/A' }}</div>
                                </td>
                                <td class="col-to" title="{{ $departure->to->city_name ?? 'N/A' }}">
                                    <div class="text-truncate">{{ $departure->to->city_name ?? 'N/A' }}</div>
                                </td>
                                <td class="col-pickup" title="{{ $departure->titik_naik }}">
                                    <div class="text-truncate" style="max-width: 100px">{{ $departure->titik_naik }}</div>
                                </td>
                                <td class="col-dropoff" title="{{ $departure->titik_turun }}">
                                    <div class="text-truncate" style="max-width: 100px">{{ $departure->titik_turun }}</div>
                                </td>
                                <td class="col-date">
                                    <div class="text-nowrap">{{ $departure->departure_date ?? 'N/A' }}</div>
                                </td>
                                <td class="col-time">
                                    <div class="text-nowrap">{{ $departure->departure_time }}</div>
                                </td>
                                <td class="col-duration text-center">{{ $departure->duration }}</td>
                                <td class="col-price">
                                    <div class="text-nowrap">Rp {{ number_format($departure->price, 0, ',', '.') }}</div>
                                </td>
                                <td class="col-actions">
                                    <div class="d-flex gap-1">
                                        <button type="button"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#editDepartureModal"
                                            data-id="{{ $departure->id }}" data-bus="{{ $departure->bus_travel_has_bus_id }}"
                                            data-from="{{ $departure->from_city_id }}" data-to="{{ $departure->to_city_id }}"
                                            data-titik-naik="{{ $departure->titik_naik }}" data-titik-turun="{{ $departure->titik_turun }}"
                                            data-tanggal="{{ $departure->departure_date}}"
                                            data-time="{{ $departure->departure_time }}"
                                            data-duration="{{ $departure->duration }}" data-price="{{ $departure->price }}"
                                            data-days="{{ $departure->days }}"
                                            title="Edit">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3"
                                                        d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z"
                                                        fill="black" />
                                                    <path
                                                        d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z"
                                                        fill="black" />
                                                </svg>
                                            </span>
                                        </button>
                                        <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm"
                                            data-bs-toggle="modal" data-bs-target="#deleteDepartureModal"
                                            data-id="{{ $departure->id }}"
                                            title="Hapus">
                                            <span class="svg-icon svg-icon-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    viewBox="0 0 24 24" fill="none">
                                                    <path
                                                        d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                                        fill="black" />
                                                    <path opacity="0.5"
                                                        d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                                        fill="black" />
                                                    <path opacity="0.5"
                                                        d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                                        fill="black" />
                                                </svg>
                                            </span>
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
        @include('ekstranet.bus-travel.departures.modals')
@endsection

@section('styles')
<style>
/* Fixed table layout with specific column widths */
.table-fixed {
    table-layout: fixed;
    min-width: 1200px; /* Minimum width to trigger horizontal scroll */
}

/* Column width definitions */
.table-fixed .col-no {
    width: 60px;
}

.table-fixed .col-from {
    width: 120px;
}

.table-fixed .col-to {
    width: 120px;
}

.table-fixed .col-pickup {
    width: 100px;
}

.table-fixed .col-dropoff {
    width: 100px;
}

.table-fixed .col-time {
    width: 140px;
}

.table-fixed .col-duration {
    width: 100px;
}

.table-fixed .col-price {
    width: 120px;
}

.table-fixed .col-actions {
    width: 100px;
}

/* Text truncation for long content */
.text-truncate {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 100%;
}

/* Sticky header */
.sticky-top {
    position: sticky;
    top: 0;
    z-index: 10;
}

/* Table responsive wrapper */
.table-responsive {
    max-height: 70vh; /* Limit vertical height */
    overflow: auto;
    border: 1px solid #e1e5e9;
    border-radius: 0.475rem;
}

/* Improve scrollbar appearance */
.table-responsive::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}

/* Action buttons layout */
.col-actions .d-flex {
    justify-content: center;
}

/* Ensure text doesn't break in time and price columns */
.text-nowrap {
    white-space: nowrap;
}

/* Hover effect for table rows */
.table tbody tr:hover {
    background-color: rgba(0, 0, 0, 0.025);
}

/* Header background to distinguish from body */
.table thead th {
    background-color: #f8f9fa !important;
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
}

/* Responsive adjustments for smaller screens */
@media (max-width: 768px) {
    .table-responsive {
        max-height: 60vh;
    }

    .table-fixed {
        min-width: 900px;
    }
}
</style>
@endsection

@section('scripts')
    <script>
        @if($errors->any())
            var createModal = new bootstrap.Modal(document.getElementById('createDepartureModal'), {});
            createModal.show();
        @endif

        // Delete modal data population
        $('#deleteDepartureModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('#delete_departure_id').val(id);
        });

        // Add tooltip functionality for truncated text
        $(document).ready(function() {
            // Initialize tooltips for truncated content
            $('[title]').tooltip({
                placement: 'top',
                trigger: 'hover'
            });
        });
    </script>
@endsection
