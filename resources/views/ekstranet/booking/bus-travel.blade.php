@extends('ekstranet.layout', ['title' => 'Riwayat Booking Bus Travel', 'url' => '#'])

@section('content-admin')
<form action="{{ route('partner.riwayat-booking.bus-travel') }}" method="get">
    <div class="card mb-2">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-3 mb-2 mb-md-0">
                    <select class="form-select" name="year">
                        <option value="" disabled selected>Pilih Tahun</option>
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
                    <input type="date" class="form-control" name="start" value="{{ request()->get('start') }}" placeholder="Tanggal Mulai">
                </div>
                <div class="col-12 col-md-3 mb-2 mb-md-0">
                    <input type="date" class="form-control" name="end" value="{{ request()->get('end') }}" placeholder="Tanggal Akhir">
                </div>
                <div class="col-12 col-md-3">
                    <button type="submit" class="btn btn-primary w-100">Cari Data</button>
                </div>
            </div>
            <!-- Hidden input for tab status -->
            <input type="hidden" name="tab" id="tab_input" value="{{ request('tab', 'all') }}">
        </div>
    </div>

    <!-- Card untuk navigasi dan tabel -->
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
                        Kadaluwarsa
                    </button>
                </div>
            </div>

            <!-- Konten Tab -->
            <div class="tab-content" id="bus-travel-tab-content">
                <div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="semua-tab">
                    <div class="table-responsive bg-white p-4 rounded">
                        <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                            id="kt_datatable_semua">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Bus Travel</th>
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
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            {{ $booking->transaction->user->name ?? $booking->customer_name }} -
                                            {{ $booking->transaction->user->phone ?? $booking->customer_phone }}
                                        </td>
                                        <td class="text-center">{{ $booking->booking_id }}</td>
                                        <td class="text-center">{{ $booking->busTravel->business_name ?? '' }}</td>
                                        <td class="text-center">{{ General::rp($booking->price + $booking->fee_admin) }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y') }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($booking->departure_time)->format('d F Y H:i') }}</td>
                                        <td class="text-center">
                                            @php
                                                $isDeparted = \Carbon\Carbon::parse($booking->departure_time)->isPast();
                                                $status = $booking->status ?? 'pending';
                                            @endphp
                                            @if($isDeparted && $status != 'verified')
                                                <span class="badge badge-danger">Kadaluwarsa</span>
                                            @elseif($status == 'verified')
                                                <span class="badge badge-success">Verified</span>
                                            @else
                                                <span class="badge badge-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if($status != 'verified' && !$isDeparted)
                                                <a href="#" class="btn btn-sm action-btn verify-btn" data-bs-toggle="modal" data-bs-target="#verificationModalBus{{ $booking->id }}">
                                                    Verifikasi
                                                </a>
                                            @elseif($status == 'verified')
                                                <a href="#" class="btn btn-sm action-btn manage-btn" data-bs-toggle="modal" data-bs-target="#cancellationModalBus{{ $booking->id }}">
                                                    Kelola Invoice
                                                </a>
                                            @else
                                                <button class="btn btn-sm action-btn expired-btn" data-bs-toggle="modal" data-bs-target="#infoModalExpiredBus{{ $booking->id }}">
                                                    Informasi
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="verified" role="tabpanel" aria-labelledby="verified-tab">
                    <div class="table-responsive bg-white p-4 rounded">
                        <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                            id="kt_datatable_verified">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Bus Travel</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Tanggal Pemesanan</th>
                                    <th class="text-center">Waktu Keberangkatan</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($busbookings as $booking)
                                    @if(($booking->status ?? 'pending') == 'verified')
                                        <tr>
                                            <td class="text-center">{{ $counter++ }}</td>
                                            <td class="text-center">
                                                {{ $booking->transaction->user->name ?? $booking->customer_name }} -
                                                {{ $booking->transaction->user->phone ?? $booking->customer_phone }}
                                            </td>
                                            <td class="text-center">{{ $booking->booking_id }}</td>
                                            <td class="text-center">{{ $booking->busTravel->business_name ?? '' }}</td>
                                            <td class="text-center">{{ General::rp($booking->price + $booking->fee_admin) }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y') }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->departure_time)->format('d F Y H:i') }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm action-btn manage-btn" data-bs-toggle="modal" data-bs-target="#cancellationModalBus{{ $booking->id }}">
                                                    Kelola Invoice
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
                    <div class="table-responsive bg-white p-4 rounded">
                        <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                            id="kt_datatable_pending">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Bus Travel</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Tanggal Pemesanan</th>
                                    <th class="text-center">Waktu Keberangkatan</th>
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
                                            <td class="text-center">{{ $counter++ }}</td>
                                            <td class="text-center">
                                                {{ $booking->transaction->user->name ?? $booking->customer_name }} -
                                                {{ $booking->transaction->user->phone ?? $booking->customer_phone }}
                                            </td>
                                            <td class="text-center">{{ $booking->booking_id }}</td>
                                            <td class="text-center">{{ $booking->busTravel->business_name ?? '' }}</td>
                                            <td class="text-center">{{ General::rp($booking->price + $booking->fee_admin) }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y') }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->departure_time)->format('d F Y H:i') }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-sm action-btn verify-btn" data-bs-toggle="modal" data-bs-target="#verificationModalBus{{ $booking->id }}">
                                                    Verifikasi
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
                    <div class="table-responsive bg-white p-4 rounded">
                        <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                            id="kt_datatable_expired">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Bus Travel</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Tanggal Pemesanan</th>
                                    <th class="text-center">Waktu Keberangkatan</th>
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
                                            <td class="text-center">{{ $counter++ }}</td>
                                            <td class="text-center">
                                                {{ $booking->transaction->user->name ?? $booking->customer_name }} -
                                                {{ $booking->transaction->user->phone ?? $booking->customer_phone }}
                                            </td>
                                            <td class="text-center">{{ $booking->booking_id }}</td>
                                            <td class="text-center">{{ $booking->busTravel->business_name ?? '' }}</td>
                                            <td class="text-center">{{ General::rp($booking->price + $booking->fee_admin) }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y') }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->departure_time)->format('d F Y H:i') }}</td>
                                            <td class="text-center">
                                                <button class="btn btn-sm action-btn expired-btn" data-bs-toggle="modal" data-bs-target="#infoModalExpiredBus{{ $booking->id }}">
                                                    Informasi
                                                </button>
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

    @foreach ($busbookings as $booking)
        @php
            $isDeparted = \Carbon\Carbon::parse($booking->departure_time)->isPast();
            $status = $booking->status ?? 'pending';
        @endphp
        @if($status != 'verified' && !$isDeparted)
            <div class="modal fade" id="verificationModalBus{{ $booking->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Verifikasi Booking</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin memverifikasi booking ini?</p>
                            <div class="text-center">
                                <iframe src="{{ route('partner.riwayat-booking.cetak-invoice-bus', $booking->id) }}" width="100%" height="800px" style="border:none;"></iframe>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <a href="{{ route('partner.riwayat-booking.verifikasi-bus', $booking->id) }}" class="btn btn-success">Verifikasi</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if($status == 'verified')
            <div class="modal fade" id="cancellationModalBus{{ $booking->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Kelola Invoice</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <iframe src="{{ route('partner.riwayat-booking.cetak-invoice-bus', $booking->id) }}" width="100%" height="800px" style="border:none;"></iframe>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                            <button type="button" class="btn btn-primary" onclick="printInvoice('{{ route('partner.riwayat-booking.cetak-invoice-bus', $booking->id) }}')">
                                <i class="fas fa-print"></i> Print
                            </button>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmCancelModalBus{{ $booking->id }}">Batal Verifikasi</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal Konfirmasi Pembatalan -->
            <div class="modal fade" id="confirmCancelModalBus{{ $booking->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi Pembatalan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Yakin, ingin membatalkan Verifikasi?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <a href="{{ route('partner.riwayat-booking.batal-verifikasi-bus', $booking->id) }}" class="btn btn-danger">Ya, Batalkan Verifikasi</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        @if($isDeparted && $status != 'verified')
            <div class="modal fade" id="infoModalExpiredBus{{ $booking->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Informasi Booking</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-center">
                                <iframe src="{{ route('partner.riwayat-booking.cetak-invoice-bus', $booking->id) }}" width="100%" height="800px" style="border:none;"></iframe>
                            </div>
                        </div>
                        <!-- Tidak ada tombol footer untuk booking kadaluwarsa -->
                    </div>
                </div>
            </div>
        @endif
    @endforeach
@endsection

@push('add-script')
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
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
        
        /* Custom style untuk tombol aksi yang menarik */
        .action-btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 6px 12px;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        /* Tombol Verifikasi - Hijau yang tidak terlalu terang */
        .verify-btn {
            background-color: #28a745;
            color: white;
        }
        
        .verify-btn:hover {
            background-color: #218838;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
        }
        
        /* Tombol Kelola Invoice - Biru yang tidak terlalu terang */
        .manage-btn {
            background-color: #007bff;
            color: white;
        }
        
        .manage-btn:hover {
            background-color: #0069d9;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }
        
        /* Tombol Kadaluwarsa - Abu-abu */
        .expired-btn {
            background-color: #6c757d;
            color: white;
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
        
        // Fungsi untuk mencetak invoice
        function printInvoice(url) {
            var printWindow = window.open(url, '_blank');
            printWindow.onload = function() {
                printWindow.print();
            };
        }
    </script>
@endpush