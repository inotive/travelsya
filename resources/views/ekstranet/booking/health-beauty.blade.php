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

    <!-- Status Tabs -->
    <div class="card mb-2">
        <div class="card-body py-3">
            <div class="d-flex flex-wrap gap-4">
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
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                        id="kt_datatable_zero_configuration">
                        <thead>
                            <tr class="fw-bold fs-6 text-gray-800 ">
                                <th class="text-center">No</th>
                                <th class="text-center">Customer</th>
                                <th class="text-center">Code Booking</th>
                                <th class="text-center">Jenis Paket</th>
                                <th class="text-center">Total Harga</th>
                                <th class="text-center">Tanggal Pemesanan</th>
                                <th class="text-center">Tanggal Kedaluwarsa</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $booking)
                                @php
                                    $orderDate = \Carbon\Carbon::parse($booking->created_at);
                                    $expiryDate = \Carbon\Carbon::parse($booking->expiry_date);
                                    $orderDates = $orderDate->Format('d F Y');
                                    $expiryDates = $expiryDate->Format('d F Y');
                                    $now = \Carbon\Carbon::now();
                                    
                                    // Determine status based on expiry date and payment status
                                    $status = '';
                                    $statusClass = '';
                                    $statusKey = '';
                                    $isUsed = $booking->is_used ?? false;
                                    
                                    if ($booking->transaction->payment_status == 'paid') {
                                        // Cek apakah paket sudah melewati tanggal kedaluwarsa
                                        if ($now->gt($expiryDate)) {
                                            $status = 'Kedaluwarsa';
                                            $statusClass = 'badge-danger';
                                            $statusKey = 'expired';
                                        } else {
                                            // Jika belum kedaluwarsa, cek status penggunaan
                                            if ($isUsed) {
                                                $status = 'Sudah Dipakai';
                                                $statusClass = 'badge-success';
                                                $statusKey = 'used';
                                            } else {
                                                $status = 'Belum Dipakai';
                                                $statusClass = 'badge-warning';
                                                $statusKey = 'unused';
                                            }
                                        }
                                    } else {
                                        $status = 'Menunggu Pembayaran';
                                        $statusClass = 'badge-warning';
                                        $statusKey = 'pending';
                                    }
                                @endphp
                                
                                @if (true)
                                <tr data-booking-id="{{ $booking->id }}" data-status="{{ $statusKey }}">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">
                                        {{ $booking->transaction->user->name ?? '' }} -
                                        {{ $booking->transaction->user->phone ?? '' }}
                                    </td>
                                    <td class="text-center">{{ $booking->booking_id }}</td>
                                    <td class="text-center">{{ $booking->package->name }}</td>
                                    <td class="text-center">{{ General::rp($booking->transaction->total) }}</td>
                                    <td class="text-center">{{ $orderDates }}</td>
                                    <td class="text-center">{{ $expiryDates }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $statusClass }}">{{ $status }}</span>
                                    </td>
                                    <td class="text-center">
                                        <!--begin::Menu-->
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                        </a>
                                        <!--end::Menu-->
                                        
                                        <!--begin::Menu dropdown-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('partner.riwayat-booking.detailhealthbeauty', $booking->id) }}"
                                                    class="menu-link px-3" id="" data-id="">
                                                    Detail Booking
                                                </a>
                                            </div>
                                            
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 info-btn" 
                                                   data-booking-id="{{ $booking->id }}" 
                                                   data-invoice-url="{{ route('e-tiket.health-beauty', $booking->id) }}"
                                                   data-status="{{ $statusKey }}">
                                                    Informasi
                                                </a>
                                            </div>
                                            @if($statusKey === 'unused')
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 verify-btn" 
                                                   data-booking-id="{{ $booking->id }}" data-invoice-url="{{ route('e-tiket.health-beauty', $booking->id) }}">
                                                    Verifikasi
                                                </a>
                                            </div>
                                            @elseif($statusKey === 'used')
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3 cancel-verify-btn" 
                                                   data-booking-id="{{ $booking->id }}" data-invoice-url="{{ route('e-tiket.health-beauty', $booking->id) }}">
                                                    Batal Verifikasi
                                                </a>
                                            </div>
                                            @endif
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu dropdown-->
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
                <h5 class="modal-title" id="infoModalLabel">Informasi Transaksi</h5>
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
    </style>
    
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#kt_datatable_zero_configuration').DataTable({
                "scrollY": "500px",
                "scrollCollapse": true,
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
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">",
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
                
                // Update hidden input
                $('#tab_input').val(tabValue);
                
                // Update active state
                $('.status-tab').removeClass('active');
                $(this).addClass('active');
                
                // Submit the form to filter results
                $('form').submit();
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
                } else {
                    // For expired or other statuses, only show close button
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
                
                // Send AJAX request to verify transaction
                $.ajax({
                    url: '/ekstranet/booking/health-beauty/' + bookingId + '/verify',
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
                
                // Send AJAX request to cancel verify transaction
                $.ajax({
                    url: '/ekstranet/booking/health-beauty/' + bookingId + '/cancel-verify',
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
                
                // Send AJAX request to verify transaction
                $.ajax({
                    url: '/ekstranet/booking/health-beauty/' + bookingId + '/verify',
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
                
                // Send AJAX request to cancel verify transaction
                $.ajax({
                    url: '/ekstranet/booking/health-beauty/' + bookingId + '/cancel-verify',
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