@extends('ekstranet.layout', ['title' => 'Health & Beauty', 'url' => '#', 'subTitle' => 'Pemesanan', 'breadcrumb' => ['Health & Beauty']])

@section('content-admin')
    <div class="card mb-2">
        <div class="card-body">
            <form action="#" method="get">
                <div class="row">
                    <div class="col-12 col-md-3 mb-2 mb-md-0">
                        <select class="form-select" name="year">
                            <option value="" disabled selected>Pilih Tahun</option>
                            @for ($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-2 mb-md-0">
                        <input type="date" class="form-control" name="start" value="{{ request('start') }}" placeholder="Tanggal Mulai">
                    </div>
                    <div class="col-12 col-md-3 mb-2 mb-md-0">
                        <input type="date" class="form-control" name="end" value="{{ request('end') }}" placeholder="Tanggal Akhir">
                    </div>
                    <div class="col-12 col-md-3">
                        <button type="submit" class="btn btn-primary w-100">Cari Data</button>
                    </div>
                </div>
                <!-- Hidden input for tab status -->
                <input type="hidden" name="tab" id="tab_input" value="{{ request('tab', 'all') }}">
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <!-- Status Tabs -->
            <div class="d-flex flex-wrap gap-4 mb-5">
                <button type="button" class="status-tab {{ request('tab', 'all') === 'all' ? 'active' : '' }}"
                        data-tab="all">
                    Semua Pemesanan
                </button>
                <button type="button" class="status-tab {{ request('tab') === 'unused' ? 'active' : '' }}"
                        data-tab="unused">
                    Belum Dipakai
                </button>
                <button type="button" class="status-tab {{ request('tab') === 'used' ? 'active' : '' }}"
                        data-tab="used">
                    Sudah Dipakai
                </button>
                <button type="button" class="status-tab {{ request('tab') === 'expired' ? 'active' : '' }}"
                        data-tab="expired">
                    Kedaluwarsa
                </button>
            </div>

            <div class="table-responsive-wrapper">
                <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                    id="kt_datatable_zero_configuration">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800 ">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Bisnis</th>
                            <th class="text-center">Customer</th>
                            <th class="text-center">Nomor Invoice</th>
                            <th class="text-center">Code Booking</th>
                            <th class="text-center">Jenis Paket</th>
                            <th class="text-center">Jumlah Tiket/Paket</th>
                            <th class="text-center">Total Harga</th>
                            <th class="text-center">Metode Pembayaran</th>
                            <th class="text-center">Jenis Pembayaran</th>
                            <th class="text-center">Tanggal Pemesanan</th>
                            <th class="text-center">Tanggal Kedaluwarsa</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            @php
                                $booking = $transaction->booking; // Mengakses booking dari transaction
                                
                                // Cek apakah booking ada sebelum mengakses propertinya
                                if ($booking) {
                                    $orderDate = \Carbon\Carbon::parse($transaction->created_at);
                                    $expiryDate = \Carbon\Carbon::parse($booking->expiry_date ?? $transaction->created_at->addDays(30)); // Default expiry 30 days if not set
                                    $orderDates = $orderDate->Format('d F Y');
                                    $expiryDates = $expiryDate->Format('d F Y');
                                    $now = \Carbon\Carbon::now();

                                    // Determine status based on usage and expiry date
                                    $status = '';
                                    $statusClass = '';
                                    $statusKey = '';
                                    $isUsed = $booking->is_used ?? false;

                                    if ($transaction->payment_status == 'paid') {
                                        // Prioritize "Sudah Dipakai" over "Kadaluarsa"
                                        if ($isUsed) {
                                            $status = 'Sudah Dipakai';
                                            $statusClass = 'badge-success';
                                            $statusKey = 'used';
                                        } else if ($now->gt($expiryDate)) {
                                            $status = 'Kedaluwarsa';
                                            $statusClass = 'badge-danger';
                                            $statusKey = 'expired';
                                        } else {
                                            $status = 'Belum Dipakai';
                                            $statusClass = 'badge-warning';
                                            $statusKey = 'unused';
                                        }
                                    } else {
                                        $status = 'Menunggu Pembayaran';
                                        $statusClass = 'badge-warning';
                                        $statusKey = 'pending';
                                    }
                                } else {
                                    // Jika tidak ada booking, gunakan data default
                                    $orderDates = $transaction->created_at->format('d F Y');
                                    $expiryDates = $transaction->created_at->addDays(30)->format('d F Y');
                                    $status = 'Data Booking Tidak Ditemukan';
                                    $statusClass = 'badge-secondary';
                                    $statusKey = 'error';
                                }
                            @endphp

                            <tr data-booking-id="{{ $booking ? $booking->id : '0' }}" data-status="{{ $statusKey }}">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $booking->clinic->clinic_name ?? 'Klinik tidak ditemukan' }}</td>
                                <td class="text-center">
                                    {{ $transaction->user->name ?? 'User tidak ditemukan' }} -
                                    {{ $transaction->user->phone ?? 'No HP tidak ditemukan' }}
                                </td>
                                <td class="text-center">{{ $transaction->no_inv ?? 'N/A' }}</td>
                                <td class="text-center">{{ $booking->booking_id ?? 'N/A' }}</td>
                                <td class="text-center">{{ $booking->package->name ?? 'Paket tidak ditemukan' }}</td>
                                <td class="text-center">{{ $booking->quantity ?? 1 }}</td>
                                <td class="text-center">{{ General::rp($transaction->total ?? 0) }}</td>
                                <td class="text-center">{{ $transaction->payment_method ?? 'N/A' }}</td>
                                <td class="text-center">{{ $transaction->payment_channel ?? 'N/A' }}</td>
                                <td class="text-center">{{ $orderDates }}</td>
                                <td class="text-center">{{ $expiryDates }}</td>
                                <td class="text-center">
                                    <span class="badge {{ $statusClass }}">{{ $status }}</span>
                                </td>
                                <td class="text-center">
                                    @if($booking && $statusKey === 'unused')
                                        <a href="#" class="btn btn-sm action-btn verify-btn"
                                           data-booking-id="{{ $booking->id }}"
                                           data-invoice-url="{{ route('e-tiket.health-beauty', $booking->id) }}">
                                            Verifikasi
                                        </a>
                                        <button class="btn btn-sm action-btn info-btn"
                                           data-booking-id="{{ $booking->id }}"
                                           data-invoice-url="{{ route('e-tiket.health-beauty', $booking->id) }}"
                                           data-status="{{ $statusKey }}">
                                            Detail
                                        </button>
                                    @elseif($booking && $statusKey === 'used')
                                        <a href="#" class="btn btn-sm action-btn cancel-verify-btn"
                                           data-booking-id="{{ $booking->id }}"
                                           data-invoice-url="{{ route('e-tiket.health-beauty', $booking->id) }}">
                                            Batal Verifikasi
                                        </a>
                                        <button class="btn btn-sm action-btn info-btn"
                                           data-booking-id="{{ $booking->id }}"
                                           data-invoice-url="{{ route('e-tiket.health-beauty', $booking->id) }}"
                                           data-status="{{ $statusKey }}">
                                            Detail
                                        </button>
                                    @elseif($booking && $statusKey === 'expired')
                                        <button class="btn btn-sm action-btn expired-btn info-btn"
                                           data-booking-id="{{ $booking->id }}"
                                           data-invoice-url="{{ route('e-tiket.health-beauty', $booking->id) }}"
                                           data-status="{{ $statusKey }}">
                                            Detail
                                        </button>
                                    @else
                                        <button class="btn btn-sm action-btn info-btn"
                                           data-booking-id="{{ $booking->id ?? '0' }}"
                                           data-invoice-url="{{ route('e-tiket.health-beauty', $booking->id ?? 0) }}"
                                           data-status="{{ $statusKey }}">
                                            Detail
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Verification Modal -->
<div class="modal fade" id="verificationModal" tabindex="-1" aria-labelledby="verificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verificationModalLabel">Verifikasi Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <iframe id="invoiceFrame" src="" width="100%" height="500px"></iframe>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="confirmVerifyBtn">Ya, Verifikasi</button>
            </div>
        </div>
    </div>
</div>

<!-- Cancel Verification Modal -->
<div class="modal fade" id="cancelVerificationModal" tabindex="-1" aria-labelledby="cancelVerificationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelVerificationModalLabel">Batal Verifikasi Transaksi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <iframe id="cancelInvoiceFrame" src="" width="100%" height="500px"></iframe>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-danger" id="confirmCancelVerifyBtn">Ya, Batalkan Verifikasi</button>
            </div>
        </div>
    </div>
</div>

<!-- Information Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Detail Booking</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <iframe id="infoInvoiceFrame" src="" width="100%" height="500px"></iframe>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="infoModalFooter">
                <!-- Tombol verifikasi akan ditambahkan secara dinamis berdasarkan status -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('add-script')
    <style>
        .status-tab {
            background: none;
            border: none;
            padding: 8px 0;
            margin: 0;
            font-size: 14px;
            font-weight: 500;
            color: #6c757d;
            cursor: pointer;
            position: relative;
            transition: color 0.3s ease;
        }

        .status-tab:hover {
            color: #495057;
        }

        .status-tab.active::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: #ff0000;
            border-radius: 2px;
        }

        /* Dropdown menu styles */
        .menu-link {
            color: #7e8299;
            font-weight: 500;
            font-size: 14px;
        }

        .menu-link:hover {
            color: #009ef7;
            background-color: #f1faff;
        }

        .menu-link.text-warning:hover {
            color: #ffc107 !important;
            background-color: #fff8dd;
        }

        .menu-link.text-info:hover {
            color: #0dcaf0 !important;
            background-color: #e8f6fa;
        }

        .menu-link.text-primary:hover {
            color: #009ef7 !important;
            background-color: #f1faff;
        }

        .menu-link.text-danger:hover {
            color: #dc3545 !important;
            background-color: #fff5f8;
        }

        /* Table scrolling styles */
        .table-responsive-wrapper {
            overflow-x: auto;
        }

        #kt_datatable_zero_configuration {
            width: 100% !important;
        }

        /* Ensure table header scrolls with content */
        .dataTables_scrollHead table {
            margin: 0 !important;
        }

        .dataTables_scrollBody table {
            margin: 0 !important;
        }

        /* Custom style untuk tombol aksi yang menarik */
        .action-btn {
            border-radius: 8px;
            font-weight: 600;
            padding: 6px 12px;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: 0 2px;
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

        /* Tombol Batal Verifikasi - Merah */
        .cancel-verify-btn {
            background-color: #dc3545;
            color: white;
        }

        .cancel-verify-btn:hover {
            background-color: #c82333;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        /* Tombol Informasi - Biru */
        .info-btn {
            background-color: #007bff;
            color: white;
        }

        .info-btn:hover {
            background-color: #0069d9;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }

        /* Tombol Detail - Abu-abu */
        .detail-btn {
            background-color: #6c757d;
            color: white;
        }

        .detail-btn:hover {
            background-color: #5a6268;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(108, 117, 125, 0.3);
        }

        /* Tombol Kadaluwarsa - Abu-abu */
        .expired-btn {
            background-color: #6c757d;
            color: white;
        }
    </style>

    <script>
        // Route templates
        const VERIFY_ROUTE = '{{ route('partner.health-beauty.verify', ['id' => 'REPLACE_ID']) }}';
        const CANCEL_VERIFY_ROUTE = '{{ route('partner.health-beauty.cancel-verify', ['id' => 'REPLACE_ID']) }}';

        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#kt_datatable_zero_configuration').DataTable({
                "scrollX": true,  // Enable horizontal scrolling
                "scrollCollapse": true,
                "paging": true,
                "language": {
                    "lengthMenu": "Tampilkan _MENU_ entri",
                    "search": "Cari:",
                    "zeroRecords": "Tidak ada data yang cocok",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                    "infoFiltered": "(difilter dari _MAX_ total entri)",
                    "paginate": {
                        "first": "Pertama",
                        "last": "Terakhir",
                        "next": "Selanjutnya",
                        "previous": "Sebelumnya"
                    }
                },
                "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
                       "<'table-responsive-wrapper'tr>" +
                       "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "searching": true // Enable default search box
            });

            // Custom search based on URL parameter
            var urlParams = new URLSearchParams(window.location.search);
            var searchValue = urlParams.get('search');
            if (searchValue) {
                table.search(searchValue).draw();
            }

            // Handle status tab clicks
            $('.status-tab').on('click', function() {
                var tabValue = $(this).data('tab');

                // Get current URL and update tab parameter
                var url = new URL(window.location);
                url.searchParams.set('tab', tabValue);

                // Update the browser URL and reload the page
                window.location = url.toString();
            });

            // Handle verify button click
            $(document).on('click', '.verify-btn', function(e) {
                e.preventDefault();
                var bookingId = $(this).data('booking-id');
                var invoiceUrl = $(this).data('invoice-url');

                // Set invoice URL in modal iframe
                $('#invoiceFrame').attr('src', invoiceUrl);

                // Show modal
                $('#verificationModal').modal('show');

                // Set booking ID in confirm button
                $('#confirmVerifyBtn').data('booking-id', bookingId);
            });

            // Handle cancel verify button click
            $(document).on('click', '.cancel-verify-btn', function(e) {
                e.preventDefault();
                var bookingId = $(this).data('booking-id');
                var invoiceUrl = $(this).data('invoice-url');

                // Set invoice URL in modal iframe
                $('#cancelInvoiceFrame').attr('src', invoiceUrl);

                // Show modal
                $('#cancelVerificationModal').modal('show');

                // Set booking ID in confirm button
                $('#confirmCancelVerifyBtn').data('booking-id', bookingId);
            });

            // Handle info button click
            $(document).on('click', '.info-btn', function(e) {
                e.preventDefault();
                var bookingId = $(this).data('booking-id');
                var invoiceUrl = $(this).data('invoice-url');
                var status = $(this).data('status');

                // Set invoice URL in modal iframe
                $('#infoInvoiceFrame').attr('src', invoiceUrl);

                // Clear modal footer
                $('#infoModalFooter').empty();

                // Add buttons based on status
                if (status === 'unused') {
                    $('#infoModalFooter').append(
                        '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>' +
                        '<button type="button" class="btn btn-primary verify-btn-modal" data-booking-id="' + bookingId + '">Ya, Verifikasi</button>'
                    );
                } else if (status === 'used') {
                    $('#infoModalFooter').append(
                        '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>' +
                        '<button type="button" class="btn btn-danger cancel-verify-btn-modal" data-booking-id="' + bookingId + '">Ya, Batalkan Verifikasi</button>'
                    );
                } else if (status === 'expired') {
                    // For expired status, only show close button - no verification buttons
                    $('#infoModalFooter').append(
                        '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>'
                    );
                } else {
                    // For other statuses (pending, etc.), only show close button
                    $('#infoModalFooter').append(
                        '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>'
                    );
                }

                // Show modal
                $('#infoModal').modal('show');
            });



            // Handle verify button click in info modal
            $(document).on('click', '.verify-btn-modal', function() {
                var bookingId = $(this).data('booking-id');
                var url = VERIFY_ROUTE.replace('REPLACE_ID', bookingId);

                // Send AJAX request to verify transaction
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Close modal
                        $('#infoModal').modal('hide');

                        // Show success message
                        alert('Transaksi berhasil diverifikasi');

                        // Reload page to update status
                        location.reload();
                    },
                    error: function(xhr) {
                        // Show error message
                        alert('Terjadi kesalahan saat memverifikasi transaksi');
                    }
                });
            });

            // Handle cancel verify button click in info modal
            $(document).on('click', '.cancel-verify-btn-modal', function() {
                var bookingId = $(this).data('booking-id');
                var url = CANCEL_VERIFY_ROUTE.replace('REPLACE_ID', bookingId);

                // Send AJAX request to cancel verify transaction
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Close modal
                        $('#infoModal').modal('hide');

                        // Show success message
                        alert('Verifikasi transaksi berhasil dibatalkan');

                        // Reload page to update status
                        location.reload();
                    },
                    error: function(xhr) {
                        // Show error message
                        alert('Terjadi kesalahan saat membatalkan verifikasi transaksi');
                    }
                });
            });

            // Handle confirm verify button click
            $('#confirmVerifyBtn').on('click', function() {
                var bookingId = $(this).data('booking-id');
                var url = VERIFY_ROUTE.replace('REPLACE_ID', bookingId);

                // Send AJAX request to verify transaction
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Close modal
                        $('#verificationModal').modal('hide');

                        // Show success message
                        alert('Transaksi berhasil diverifikasi');

                        // Reload page to update status
                        location.reload();
                    },
                    error: function(xhr) {
                        // Show error message
                        alert('Terjadi kesalahan saat memverifikasi transaksi');
                    }
                });
            });

            // Handle confirm cancel verify button click
            $('#confirmCancelVerifyBtn').on('click', function() {
                var bookingId = $(this).data('booking-id');
                var url = CANCEL_VERIFY_ROUTE.replace('REPLACE_ID', bookingId);

                // Send AJAX request to cancel verify transaction
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Close modal
                        $('#cancelVerificationModal').modal('hide');

                        // Show success message
                        alert('Verifikasi transaksi berhasil dibatalkan');

                        // Reload page to update status
                        location.reload();
                    },
                    error: function(xhr) {
                        // Show error message
                        alert('Terjadi kesalahan saat membatalkan verifikasi transaksi');
                    }
                });
            });
        });
    </script>
@endpush