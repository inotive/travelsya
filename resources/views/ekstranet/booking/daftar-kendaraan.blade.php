@extends('ekstranet.layout', ['title' => 'Riwayat Booking Car Rental', 'url' => '#'])

@section('content-admin')
    <div class="card mb-2">
        <div class="card-body">
            <form action="#" method="get">
                <div class="row">
                    <div class="col-3">
                        <select class="form-select" name="year">
                            <option value="" disabled selected>Pilih Tahun</option>
                            @php
                                $currentYear = date('Y');
                                $startYear = 2020;
                            @endphp
                            @for ($i = $currentYear; $i >= $startYear; $i--)
                                <option value="{{ $i }}"
                                    {{ isset($_GET['year']) && $_GET['year'] == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-3">
                        <input type="date" class="form-control" name="start" placeholder="Tanggal Mulai"
                            value="{{ isset($_GET['start']) ? $_GET['start'] : '' }}">
                    </div>
                    <div class="col-3">
                        <input type="date" class="form-control" name="end" placeholder="Tanggal Selesai"
                            value="{{ isset($_GET['end']) ? $_GET['end'] : '' }}">
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary w-100">Cari Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <!-- Navigasi Tab Simple -->
            <div class="mb-4">
                <div class="d-flex gap-4 border-bottom">
                    <button class="nav-tab-simple active" data-bs-toggle="pill" data-bs-target="#semua"
                            type="button" role="tab" aria-controls="semua" aria-selected="true">
                        Semua Pesanan
                    </button>
                    <button class="nav-tab-simple" data-bs-toggle="pill" data-bs-target="#verified"
                            type="button" role="tab" aria-controls="verified" aria-selected="false">
                        Sudah Diverifikasi
                    </button>
                    <button class="nav-tab-simple" data-bs-toggle="pill" data-bs-target="#pending"
                            type="button" role="tab" aria-controls="pending" aria-selected="false">
                        Belum Diverifikasi
                    </button>
                    <button class="nav-tab-simple" data-bs-toggle="pill" data-bs-target="#expired"
                            type="button" role="tab" aria-controls="expired" aria-selected="false">
                        Kadaluarsa
                    </button>
                </div>
            </div>

            <!-- Konten Tab -->
            <div class="tab-content" id="car-rental-tab-content">
                <div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="semua-tab">
                    <div class="table-responsive">
                        <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                            id="kt_datatable_semua">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Jenis Mobil</th>
                                    <th class="text-center">Durasi Rental</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Waktu Rental</th>
                                    <th class="text-center">Waktu Kembali</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carrentalbookdates as $booking)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            {{ $booking->transaction->user->name ?? $booking->customer_name }} -
                                            {{ $booking->transaction->user->phone ?? $booking->customer_phone }}
                                        </td>
                                        <td class="text-center">{{ $booking->booking_id }}</td>
                                        <td class="text-center">
                                            {{ $booking->car->brand->name ?? '' }} {{ $booking->car->carModel->name ?? '' }}
                                        </td>
                                        <td class="text-center">{{ $booking->duration }}</td>
                                        <td class="text-center">{{ General::rp($booking->rent_price + $booking->fee_admin) }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($booking->start)->format('d F Y H:i') }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($booking->end)->format('d F Y H:i') }}</td>
                                        <td class="text-center">
                                            @php
                                                $isExpired = \Carbon\Carbon::parse($booking->end)->isPast();
                                                $status = $booking->status ?? 'pending';
                                            @endphp
                                            @if($isExpired && $status != 'verified')
                                                <span class="badge badge-danger">Kadaluarsa</span>
                                            @elseif($status == 'verified')
                                                <span class="badge badge-success">Verified</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true" style="">
                                                @if($status != 'verified' && !$isExpired)
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('partner.riwayat-booking.verifikasi-car-rental', $booking->id) }}"
                                                            class="menu-link px-3 text-success">
                                                            Verifikasi
                                                        </a>
                                                    </div>
                                                @elseif($status == 'verified')
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('partner.riwayat-booking.batal-verifikasi-car-rental', $booking->id) }}"
                                                            class="menu-link px-3 text-danger">
                                                            Batal Verifikasi
                                                        </a>
                                                    </div>
                                                @endif
                                            </div>
                                            <a href="#"
                                                class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                Actions
                                                <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="verified" role="tabpanel" aria-labelledby="verified-tab">
                    <div class="table-responsive">
                        <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                            id="kt_datatable_verified">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Jenis Mobil</th>
                                    <th class="text-center">Durasi Rental</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Waktu Rental</th>
                                    <th class="text-center">Waktu Kembali</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($carrentalbookdates as $booking)
                                    @if(($booking->status ?? 'pending') == 'verified')
                                        <tr>
                                            <td class="text-center">{{ $counter++ }}</td>
                                            <td class="text-center">
                                                {{ $booking->transaction->user->name ?? $booking->customer_name }} -
                                                {{ $booking->transaction->user->phone ?? $booking->customer_phone }}
                                            </td>
                                            <td class="text-center">{{ $booking->booking_id }}</td>
                                            <td class="text-center">
                                                {{ $booking->car->brand->name ?? '' }} {{ $booking->car->carModel->name ?? '' }}
                                            </td>
                                            <td class="text-center">{{ $booking->duration }}</td>
                                            <td class="text-center">{{ General::rp($booking->rent_price + $booking->fee_admin) }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->start)->format('d F Y H:i') }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->end)->format('d F Y H:i') }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-success">Verified</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true" style="">
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('partner.riwayat-booking.batal-verifikasi-car-rental', $booking->id) }}"
                                                            class="menu-link px-3 text-danger">
                                                            Batal Verifikasi
                                                        </a>
                                                    </div>
                                                </div>
                                                <a href="#"
                                                    class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    Actions
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                    <div class="table-responsive">
                        <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                            id="kt_datatable_pending">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Jenis Mobil</th>
                                    <th class="text-center">Durasi Rental</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Waktu Rental</th>
                                    <th class="text-center">Waktu Kembali</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($carrentalbookdates as $booking)
                                    @php
                                        $isExpired = \Carbon\Carbon::parse($booking->end)->isPast();
                                        $status = $booking->status ?? 'pending';
                                    @endphp
                                    @if($status != 'verified' && !$isExpired)
                                        <tr>
                                            <td class="text-center">{{ $counter++ }}</td>
                                            <td class="text-center">
                                                {{ $booking->transaction->user->name ?? $booking->customer_name }} -
                                                {{ $booking->transaction->user->phone ?? $booking->customer_phone }}
                                            </td>
                                            <td class="text-center">{{ $booking->booking_id }}</td>
                                            <td class="text-center">
                                                {{ $booking->car->brand->name ?? '' }} {{ $booking->car->carModel->name ?? '' }}
                                            </td>
                                            <td class="text-center">{{ $booking->duration }}</td>
                                            <td class="text-center">{{ General::rp($booking->rent_price + $booking->fee_admin) }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->start)->format('d F Y H:i') }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->end)->format('d F Y H:i') }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-warning">Pending</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true" style="">
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('partner.riwayat-booking.verifikasi-car-rental', $booking->id) }}"
                                                            class="menu-link px-3 text-success">
                                                            Verifikasi
                                                        </a>
                                                    </div>
                                                </div>
                                                <a href="#"
                                                    class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    Actions
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="expired" role="tabpanel" aria-labelledby="expired-tab">
                    <div class="table-responsive">
                        <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                            id="kt_datatable_expired">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Jenis Mobil</th>
                                    <th class="text-center">Durasi Rental</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Waktu Rental</th>
                                    <th class="text-center">Waktu Kembali</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($carrentalbookdates as $booking)
                                    @php
                                        $isExpired = \Carbon\Carbon::parse($booking->end)->isPast();
                                        $status = $booking->status ?? 'pending';
                                    @endphp
                                    @if($isExpired && $status != 'verified')
                                        <tr>
                                            <td class="text-center">{{ $counter++ }}</td>
                                            <td class="text-center">
                                                {{ $booking->transaction->user->name ?? $booking->customer_name }} -
                                                {{ $booking->transaction->user->phone ?? $booking->customer_phone }}
                                            </td>
                                            <td class="text-center">{{ $booking->booking_id }}</td>
                                            <td class="text-center">
                                                {{ $booking->car->brand->name ?? '' }} {{ $booking->car->carModel->name ?? '' }}
                                            </td>
                                            <td class="text-center">{{ $booking->duration }}</td>
                                            <td class="text-center">{{ General::rp($booking->rent_price + $booking->fee_admin) }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->start)->format('d F Y H:i') }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->end)->format('d F Y H:i') }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-danger">Kadaluarsa</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true" style="">
                                                    <div class="menu-item px-3">
                                                        <span class="menu-link px-3 text-muted">Tidak ada aksi</span>
                                                    </div>
                                                </div>
                                                <a href="#"
                                                    class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                    Actions
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('add-script')
    <style>
        .nav-tab-simple {
            background: none;
            border: none;
            color: #6c757d;
            font-size: 14px;
            padding: 10px 0;
            margin-bottom: -1px;
            border-bottom: 2px solid transparent;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .nav-tab-simple:hover {
            color: #495057;
        }

        .nav-tab-simple.active {
            color: #dc3545;
            border-bottom-color: #dc3545;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Konfigurasi DataTable untuk semua tab
            const dataTableConfig = {
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
            };

            // Initialize DataTables untuk setiap tab
            $('#kt_datatable_semua').DataTable(dataTableConfig);
            $('#kt_datatable_verified').DataTable(dataTableConfig);
            $('#kt_datatable_pending').DataTable(dataTableConfig);
            $('#kt_datatable_expired').DataTable(dataTableConfig);

            // Custom tab functionality
            $('.nav-tab-simple').on('click', function() {
                // Remove active class from all tabs
                $('.nav-tab-simple').removeClass('active');

                // Add active class to clicked tab
                $(this).addClass('active');

                // Hide all tab panes
                $('.tab-pane').removeClass('show active');

                // Show target tab pane
                const target = $(this).data('bs-target');
                $(target).addClass('show active');

                // Redraw DataTable ketika tab aktif
                setTimeout(function() {
                    $.fn.dataTable.tables({ visible: true, api: true }).columns.adjust();
                }, 100);
            });
        });
    </script>
@endpush
