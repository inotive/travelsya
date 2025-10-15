@extends('ekstranet.layout', ['title' => 'Riwayat Booking Bus Travel', 'url' => '#'])

@section('content-admin')
<form action="{{ route('partner.riwayat-booking.bus-travel') }}" method="get">
    <div class="card mb-2">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                {{-- <div class="col-12 col-md-2 mb-2 mb-md-0">
                    <label class="form-label">Filter Berdasarkan</label>
                    <select class="form-select" name="filter_type">
                        <option value="booking" {{ request()->get('filter_type') == 'booking' || !request()->get('filter_type') ? 'selected' : '' }}>
                            Tanggal Pemesanan
                        </option>
                        <option value="departure" {{ request()->get('filter_type') == 'departure' ? 'selected' : '' }}>
                            Tanggal Keberangkatan
                        </option>
                    </select>
                </div> --}}
                <input type="hidden" name="filter_type" value="departure">
                <div class="col-12 col-md-3 mb-2 mb-md-0">
                    <label class="form-label">Tahun</label>
                    <select class="form-select" name="year">
                        <option value="">Semua Tahun</option>
                        @php
                            $currentYear = date('Y');
                            $startYear = 2020;
                        @endphp
                        @for ($i = $currentYear; $i >= $startYear; $i--)
                            <option value="{{ $i }}"
                                {{ request()->get('year') == $i ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-12 col-md-3 mb-2 mb-md-0">
                    <label class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control" name="start" value="{{ request()->get('start') }}">
                </div>
                <div class="col-12 col-md-3 mb-2 mb-md-0">
                    <label class="form-label">Tanggal Akhir</label>
                    <input type="date" class="form-control" name="end" value="{{ request()->get('end') }}">
                </div>
                <div class="col-12 col-md-3 mb-2 mb-md-0">
                    <label class="form-label d-block">&nbsp;</label>
                    <div class="btn-group w-100" role="group">
                        <button type="submit" class="btn btn-primary" style="width: 75%;">
                            <i class="bi bi-search me-1"></i>Cari
                        </button>
                        <a href="{{ route('partner.riwayat-booking.bus-travel') }}"
                        class="btn btn-secondary"
                        style="width: 25%;"
                        title="Reset Filter">
                            <i class="bi bi-arrow-clockwise"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            {{-- <div class="row g-3 align-items-end mb-5">
                <div class="col-md-10">
                    <label class="form-label">Kata Kunci</label>
                    <input type="text" class="form-control" name="keyword" placeholder="Cari Customer, Kode Booking, Nama Travel" value="{{ request()->get('keyword') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
            </div> --}}

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
            <div class="tab-content" id="bus-travel-tab-content">
                <div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="semua-tab">
                    <div class="table-responsive">
                        <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                            id="kt_datatable_semua">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Bus Travel</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Bus</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Tanggal Pemesanan</th>
                                    <th class="text-center">Waktu Keberangkatan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($busbookings as $booking)
                                    <tr>
                                        <td class="text-center"></td>
                                        <td class="text-center">{{ $booking->busTravel->business_name ?? '' }}</td>
                                        <td class="text-center">
                                            {{ $booking->transaction->user->name ?? $booking->customer_name }} -
                                            {{ $booking->transaction->user->phone ?? $booking->customer_phone }}
                                        </td>
                                        <td class="text-center">
                                            {{ $booking->busTravelHasBus->name ?? '-' }}
                                        </td>
                                        <td class="text-center">{{ $booking->booking_id }}</td>
                                        <td class="text-center">{{ General::rp($booking->price + $booking->fee_admin) }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y') }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($booking->departure_time)->format('d F Y H:i') }}</td>
                                        <td class="text-center">
                                            @php
                                                $isDeparted = \Carbon\Carbon::parse($booking->departure_time)->isPast();
                                                $status = $booking->status ?? 'pending';
                                            @endphp
                                            @if($isDeparted && $status != 'verified')
                                                <span class="badge badge-danger">Kadaluarsa</span>
                                            @elseif($status == 'verified')
                                                <span class="badge badge-success">Verified</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    Actions
                                                    <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @if($status != 'verified' && !$isDeparted)
                                                        <li>
                                                            <button type="button" class="dropdown-item text-success btn-verify-modal"
                                                                data-booking-id="{{ $booking->id }}"
                                                                data-customer-name="{{ $booking->transaction->user->name ?? $booking->customer_name }}"
                                                                data-booking-code="{{ $booking->booking_id }}">
                                                                Verifikasi
                                                            </button>
                                                        </li>
                                                    @elseif($status == 'verified')
                                                        <li>
                                                            <button type="button" class="dropdown-item text-danger btn-cancel-verify-modal"
                                                                data-booking-id="{{ $booking->id }}"
                                                                data-customer-name="{{ $booking->transaction->user->name ?? $booking->customer_name }}"
                                                                data-booking-code="{{ $booking->booking_id }}">
                                                                Batal Verifikasi
                                                            </button>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <button type="button" class="dropdown-item text-primary btn-invoice-modal"
                                                            data-booking-id="{{ $booking->id }}">
                                                            Invoice
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
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
                                    <th class="text-left">No</th>
                                    <th class="text-center">Bus Travel</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Bus</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Tanggal Pemesanan</th>
                                    <th class="text-center">Waktu Keberangkatan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($busbookings as $booking)
                                    @if(($booking->status ?? 'pending') == 'verified')
                                        <tr>
                                            <td class="text-center"></td>
                                            <td class="text-center">{{ $booking->busTravel->business_name ?? '' }}</td>
                                            <td class="text-center">
                                                {{ $booking->transaction->user->name ?? $booking->customer_name }} -
                                                {{ $booking->transaction->user->phone ?? $booking->customer_phone }}
                                            </td>
                                            <td class="text-center">{{ $booking->busTravel->business_name ?? '' }}</td>
                                            <td class="text-center">{{ $booking->booking_id }}</td>
                                            <td class="text-center">{{ General::rp($booking->price + $booking->fee_admin) }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y') }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->departure_time)->format('d F Y H:i') }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-success">Verified</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <button type="button" class="dropdown-item text-danger btn-cancel-verify-modal"
                                                                data-booking-id="{{ $booking->id }}"
                                                                data-customer-name="{{ $booking->transaction->user->name ?? $booking->customer_name }}"
                                                                data-booking-code="{{ $booking->booking_id }}">
                                                                Batal Verifikasi
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button type="button" class="dropdown-item text-primary btn-invoice-modal"
                                                                data-booking-id="{{ $booking->id }}">
                                                                Invoice
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
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
                                    <th class="text-center">Bus Travel</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Bus</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Tanggal Pemesanan</th>
                                    <th class="text-center">Waktu Keberangkatan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($busbookings as $booking)
                                    @php
                                        $isDeparted = \Carbon\Carbon::parse($booking->departure_time)->isPast();
                                        $status = $booking->status ?? 'pending';
                                    @endphp
                                    @if($status != 'verified' && !$isDeparted)
                                        <tr>
                                            <td class="text-center"></td>
                                            <td class="text-center">{{ $booking->busTravel->business_name ?? '' }}</td>
                                            <td class="text-center">
                                                {{ $booking->transaction->user->name ?? $booking->customer_name }} -
                                                {{ $booking->transaction->user->phone ?? $booking->customer_phone }}
                                            </td>
                                            <td class="text-center">
                                                {{ $booking->busTravelHasBus->name ?? '-' }}
                                            </td>
                                            <td class="text-center">{{ $booking->booking_id }}</td>
                                            <td class="text-center">{{ General::rp($booking->price + $booking->fee_admin) }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y') }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->departure_time)->format('d F Y H:i') }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-warning">Pending</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <button type="button" class="dropdown-item text-success btn-verify-modal"
                                                                data-booking-id="{{ $booking->id }}"
                                                                data-customer-name="{{ $booking->transaction->user->name ?? $booking->customer_name }}"
                                                                data-booking-code="{{ $booking->booking_id }}">
                                                                Verifikasi
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button type="button" class="dropdown-item text-primary btn-invoice-modal"
                                                                data-booking-id="{{ $booking->id }}">
                                                                Invoice
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
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
                                    <th class="text-center">Bus Travel</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Bus</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Tanggal Pemesanan</th>
                                    <th class="text-center">Waktu Keberangkatan</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($busbookings as $booking)
                                    @php
                                        $isDeparted = \Carbon\Carbon::parse($booking->departure_time)->isPast();
                                        $status = $booking->status ?? 'pending';
                                    @endphp
                                    @if($isDeparted && $status != 'verified')
                                        <tr>
                                            <td class="text-center"></td>
                                            <td class="text-center">{{ $booking->busTravel->business_name ?? '' }}</td>
                                            <td class="text-center">
                                                {{ $booking->transaction->user->name ?? $booking->customer_name }} -
                                                {{ $booking->transaction->user->phone ?? $booking->customer_phone }}
                                            </td>
                                            <td class="text-center">
                                                {{ $booking->busTravelHasBus->name ?? '-' }}
                                            </td>
                                            <td class="text-center">{{ $booking->booking_id }}</td>
                                            <td class="text-center">{{ General::rp($booking->price + $booking->fee_admin) }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y') }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->departure_time)->format('d F Y H:i') }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-danger">Kadaluarsa</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Actions
                                                        <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li>
                                                            <button type="button" class="dropdown-item text-primary btn-invoice-modal"
                                                                data-booking-id="{{ $booking->id }}">
                                                                Invoice
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
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
</form>

    <!-- Verification Modal -->
    <div class="modal fade" id="verifyModal" tabindex="-1" aria-labelledby="verifyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="border-radius: 15px;">
                <div class="modal-header border-0 pb-0">
                    <h4 class="fw-bold mb-2">Verifikasi Tiket</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5 pb-5">
                    <p class="text-muted mb-4 text-center">Apakah kamu yakin ingin melakukan verifikasi tiket di bawah ini?</p>

                    <div id="verify-invoice-content">
                        <!-- Invoice content will be loaded here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light flex-fill" data-bs-dismiss="modal">Tidak jadi</button>
                    <button type="button" class="btn btn-success flex-fill" id="confirmVerifyBtn">Ya Verifikasi</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Cancel Verification Modal -->
    <div class="modal fade" id="cancelVerifyModal" tabindex="-1" aria-labelledby="cancelVerifyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content" style="border-radius: 15px;">
                <div class="modal-header border-0 pb-0">
                     <h4 class="fw-bold mb-2">Batalkan Verifikasi</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-5 pb-5">
                    <p class="text-muted mb-4 text-center">Apakah kamu yakin ingin membatalkan verifikasi tiket di bawah ini?</p>

                     <div id="cancel-invoice-content">
                        <!-- Invoice content will be loaded here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light flex-fill" data-bs-dismiss="modal">Tidak jadi</button>
                    <button type="button" class="btn btn-danger flex-fill" id="confirmCancelVerifyBtn">Ya Batalkan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice Modal -->
    <div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModalLabel">Invoice Bus Travel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div id="invoice-content">
                        <!-- Invoice content will be loaded here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="downloadInvoiceBtn">
                        <i class="fas fa-download me-2"></i>Download PDF
                    </button>
                    <button type="button" class="btn btn-info" id="printInvoiceBtn">
                        <i class="fas fa-print me-2"></i>Print
                    </button>
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

        .modal-content {
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
        }

        /* Hide DataTable sorting arrows */
        table.dataTable thead .sorting:before,
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting_asc:before,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_desc:before,
        table.dataTable thead .sorting_desc:after {
            display: none !important;
        }

        /* Fix table layout and scrolling */
        .table-responsive {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .dataTables_wrapper .dataTables_scroll {
            width: 100%;
        }

        .dataTables_wrapper .dataTables_scrollBody {
            overflow-x: auto !important;
        }

        /* Ensure table columns align properly */
        table.dataTable {
            width: 100% !important;
            table-layout: auto !important;
        }

        table.dataTable thead th,
        table.dataTable tbody td {
            white-space: nowrap;
        }

        /* Center align No column */
        table.dataTable thead th:first-child,
        table.dataTable tbody td:first-child {
            text-align: center !important;
            vertical-align: middle !important;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Konfigurasi DataTable untuk semua tab
            const dataTableConfig = {
                "scrollX": true,
                "scrollY": "500px",
                "scrollCollapse": true,
                "autoWidth": false,
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom":
                    "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                    "<'row'<'col-sm-12't>>" +
                    "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "columnDefs": [
                    {
                        "searchable": false,
                        "orderable": false,
                        "targets": 0
                    }
                ],

                "order": [[1, 'desc']]
            };

            // Initialize DataTables untuk setiap tab
            var table1 = $('#kt_datatable_semua').DataTable(dataTableConfig);
            var table2 = $('#kt_datatable_verified').DataTable(dataTableConfig);
            var table3 = $('#kt_datatable_pending').DataTable(dataTableConfig);
            var table4 = $('#kt_datatable_expired').DataTable(dataTableConfig);

            // Auto numbering untuk semua tabel
            [table1, table2, table3, table4].forEach(function(table) {
                table.on('order.dt search.dt', function () {
                    let i = 1;
                    table.cells(null, 0, { search: 'applied', order: 'applied' }).every(function (cell) {
                        this.data(i++);
                    });
                }).draw();
            });

            // Custom tab functionality
            $('.nav-tab-simple').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

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

            // Verification Modal
            $('.btn-verify-modal').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const bookingId = $(this).data('booking-id');
                $('#confirmVerifyBtn').data('booking-id', bookingId);

                // Show loading
                $('#verify-invoice-content').html(`
                    <div class="text-center p-5">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Memuat invoice...</p>
                    </div>
                `);

                $('#verifyModal').modal('show');

                // Load invoice content
                $.ajax({
                    url: `{{ route('partner.riwayat-booking.cetak-invoice-bus', ['id' => ':id']) }}`.replace(':id', bookingId),
                    method: 'GET',
                    success: function(response) {
                        $('#verify-invoice-content').html(response);
                    },
                    error: function() {
                        $('#verify-invoice-content').html(`
                            <div class="text-center p-5">
                                <div class="text-danger">
                                    <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                                    <p>Gagal memuat invoice. Silakan coba lagi.</p>
                                </div>
                            </div>
                        `);
                    }
                });
            });

            // Cancel Verification Modal
            $('.btn-cancel-verify-modal').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const bookingId = $(this).data('booking-id');
                $('#confirmCancelVerifyBtn').data('booking-id', bookingId);

                // Show loading
                $('#cancel-invoice-content').html(`
                    <div class="text-center p-5">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Memuat invoice...</p>
                    </div>
                `);

                $('#cancelVerifyModal').modal('show');

                // Load invoice content
                $.ajax({
                    url: `{{ route('partner.riwayat-booking.cetak-invoice-bus', ['id' => ':id']) }}`.replace(':id', bookingId),
                    method: 'GET',
                    success: function(response) {
                        $('#cancel-invoice-content').html(response);
                    },
                    error: function() {
                        $('#cancel-invoice-content').html(`
                            <div class="text-center p-5">
                                <div class="text-danger">
                                    <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                                    <p>Gagal memuat invoice. Silakan coba lagi.</p>
                                </div>
                            </div>
                        `);
                    }
                });
            });

            // Confirm Verify
            $('#confirmVerifyBtn').on('click', function() {
                const bookingId = $(this).data('booking-id');
                window.location.href = `{{ route('partner.riwayat-booking.verifikasi-bus', ['id' => ':id']) }}`.replace(':id', bookingId);
            });

            // Confirm Cancel Verify
            $('#confirmCancelVerifyBtn').on('click', function() {
                const bookingId = $(this).data('booking-id');
                window.location.href = `{{ route('partner.riwayat-booking.batal-verifikasi-bus', ['id' => ':id']) }}`.replace(':id', bookingId);
            });

            // Invoice Modal
            $('.btn-invoice-modal').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const bookingId = $(this).data('booking-id');

                // Show loading
                $('#invoice-content').html(`
                    <div class="text-center p-5">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Memuat invoice...</p>
                    </div>
                `);

                $('#invoiceModal').modal('show');

                // Load invoice content
                $.ajax({
                    url: `{{ route('partner.riwayat-booking.cetak-invoice-bus', ['id' => ':id']) }}`.replace(':id', bookingId),
                    method: 'GET',
                    success: function(response) {
                        $('#invoice-content').html(response);
                        $('#downloadInvoiceBtn').data('booking-id', bookingId);
                        $('#printInvoiceBtn').data('booking-id', bookingId);
                    },
                    error: function() {
                        $('#invoice-content').html(`
                            <div class="text-center p-5">
                                <div class="text-danger">
                                    <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                                    <p>Gagal memuat invoice. Silakan coba lagi.</p>
                                </div>
                            </div>
                        `);
                    }
                });
            });

            // Print Invoice
            $('#printInvoiceBtn').on('click', function() {
                const invoiceContent = document.getElementById('invoice-content').innerHTML;
                const printWindow = window.open('', '_blank');
                printWindow.document.write(`
                    <!DOCTYPE html>
                    <html>
                    <head>
                        <title>Invoice Bus Travel</title>
                        <link href="/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
                        <link href="/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
                        <style>
                            @media print {
                                body { margin: 0; }
                                .no-print { display: none !important; }
                            }
                        </style>
                    </head>
                    <body>
                        ${invoiceContent}
                    </body>
                    </html>
                `);
                printWindow.document.close();
                printWindow.focus();

                setTimeout(() => {
                    printWindow.print();
                    printWindow.close();
                }, 500);
            });

            // Download Invoice as PDF
            $('#downloadInvoiceBtn').on('click', function() {
                const bookingId = $(this).data('booking-id');
                // Create a temporary form to download PDF
                const form = document.createElement('form');
                form.method = 'GET';
                form.action = `{{ route('partner.riwayat-booking.cetak-invoice-bus', ['id' => ':id']) }}`.replace(':id', bookingId) + '?download=pdf';
                form.target = '_blank';
                document.body.appendChild(form);
                form.submit();
                document.body.removeChild(form);
            });

            // Prevent dropdown from closing when clicking inside
            $(document).on('click', '.dropdown-menu', function(e) {
                e.stopPropagation();
            });

            // Ensure modals don't interfere with tabs
            $('.modal').on('show.bs.modal', function() {
                $('body').addClass('modal-open');
            }).on('hidden.bs.modal', function() {
                $('body').removeClass('modal-open');
            });
        });
    </script>
@endpush
