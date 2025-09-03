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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1"
                                transform="rotate(45 17.0365 15.1223)" fill="black" />
                            <path
                                d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                fill="black" />
                        </svg>
                    </span>
                    <input type="text" id="searchInput" class="form-control form-control-solid w-250px ps-14"
                        placeholder="Cari Jadwal" />
                </div>
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

        <div class="card-body pt-0">
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
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="departuresTable">
                <thead>
                    <tr class="text-start text-muted fw-bolder fs-7 text-uppercase gs-0">
                        <th class="min-w-50px">No</th>
                        <th class="min-w-125px">Dari</th>
                        <th class="min-w-125px">Tujuan</th>
                        <th class="min-w-125px">Waktu Berangkat</th>
                        <th class="min-w-125px">Durasi (Jam)</th>
                        <th class="min-w-125px">Harga</th>
                        <th class="text-end min-w-100px">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                    @foreach ($departures as $key => $departure)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $departure->from->name ?? 'N/A' }}</td>
                            <td>{{ $departure->to->name ?? 'N/A' }}</td>
                            <td>{{ $departure->departure_time }}</td>
                            <td>{{ $departure->duration }}</td>
                            <td>Rp {{ number_format($departure->price, 0, ',', '.') }}</td>
                            <td class="text-end">
                                <button type="button"
                                    class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1"
                                    data-bs-toggle="modal" data-bs-target="#editDepartureModal"
                                    data-id="{{ $departure->id }}" data-bus="{{ $departure->bus_travel_has_bus_id }}"
                                    data-from="{{ $departure->from_route_id }}" data-to="{{ $departure->to_route_id }}"
                                    data-time="{{ $departure->departure_time }}"
                                    data-duration="{{ $departure->duration }}" data-price="{{ $departure->price }}"
                                    data-days="{{ $departure->days }}">
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
                                    data-id="{{ $departure->id }}">
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
        @include('ekstranet.bus-travel.departures.modals')
@endsection



@section('scripts')
    <script>
        //dikomen karena dipindah menjadi inline di modals.blade.php
        // // Edit modal data population
        // $('#editDepartureModal').on('show.bs.modal', function(event) {
        //     var button = $(event.relatedTarget);
        //     var id = button.data('id');
        //     var from = button.data('from');
        //     var to = button.data('to');
        //     var datetime = button.data('time');
        //     var duration = button.data('duration');
        //     var price = button.data('price');
        //     var days = button.data('days');

        //     // Split datetime into date and time parts
        //     var datetimeParts = datetime.split(' ');
        //     var datePart = '';
        //     var timePart = '';

        //     if (datetimeParts.length > 1) {
        //         datePart = datetimeParts[0]; // YYYY-MM-DD
        //         timePart = datetimeParts[1]; // HH:MM:SS
        //     } else {
        //         // If only time is available (legacy data)
        //         timePart = datetime;
        //         // Set today's date as default
        //         var today = new Date();
        //         datePart = today.getFullYear() + '-' +
        //                 String(today.getMonth() + 1).padStart(2, '0') + '-' +
        //                 String(today.getDate()).padStart(2, '0');
        //     }

        //     var modal = $(this);
        //     modal.find('#edit_departure_id').val(id);
        //     modal.find('#edit_from_route_id').val(from);
        //     modal.find('#edit_to_route_id').val(to);
        //     modal.find('#edit_departure_date').val(datePart);
        //     modal.find('#edit_departure_time').val(timePart);
        //     modal.find('#edit_duration').val(duration);
        //     modal.find('#edit_price').val(price);

        //     // Reset all checkboxes first
        //     modal.find('.edit-day').prop('checked', false);

        //     // Check the appropriate day checkboxes
        //     if (days) {
        //         var daysArray = days.split(',');
        //         daysArray.forEach(function(day) {
        //             modal.find('#edit_day' + day).prop('checked', true);
        //         });
        //     }
        // });

        // Delete modal data population
        $('#deleteDepartureModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var modal = $(this);
            modal.find('#delete_departure_id').val(id);
        });
    </script>
@endsection
