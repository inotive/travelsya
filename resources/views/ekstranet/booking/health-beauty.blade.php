@extends('ekstranet.layout', ['title' => 'Health & Beauty', 'url' => '#'])

@section('content-admin')
    <div class="card mb-2">
        <div class="card-body">
            <form action="#" method="get">
                <div class="row">
    <div class="col-2">
        <select class="form-select" name="year">
            <option value="" disabled selected>Pilih Tahun</option>
            @for ($i = date('Y'); $i >= 2020; $i--)
                <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
            @endfor
        </select>
    </div>
    <div class="col-2">
        <input type="date" class="form-control" name="start" value="{{ request('start') }}">
    </div>
    <div class="col-2">
        <input type="date" class="form-control" name="end" value="{{ request('end') }}">
    </div>
    <div class="col-3">
        <input type="text" class="form-control" name="keyword" placeholder="Cari Nama, Kode Booking, atau Paket"
            value="{{ request('keyword') }}">
    </div>
    <div class="col-3">
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
                                    
                                    if ($booking->transaction->payment_status == 'paid') {
                                        if ($expiryDate->gt($now)) {
                                            // Check if package is used or not (you may need to add logic here)
                                            // Assuming you have a field to track usage, for now using active status
                                            $status = 'Aktif';
                                            $statusClass = 'badge-success';
                                            $statusKey = 'unused'; // or 'used' based on your usage tracking
                                        } else {
                                            $status = 'Kedaluwarsa';
                                            $statusClass = 'badge-danger';
                                            $statusKey = 'expired';
                                        }
                                    } else {
                                        $status = 'Menunggu Pembayaran';
                                        $statusClass = 'badge-warning';
                                        $statusKey = 'pending';
                                    }
                                @endphp
                                
                                @if (true)
                                <tr>
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
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true" style="">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="{{ route('partner.riwayat-booking.detailhealthbeauty', $booking->id) }}"
                                                    class="menu-link px-3 text-warning" id="" data-id="">
                                                    Detail Booking
                                                </a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="{{ route('e-tiket.health-beauty', $booking->id) }}"
                                                    class="menu-link px-3 text-warning" id="" data-id="">
                                                    Cetak
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--begin::Menu-->
                                        <a href="#"
                                            class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                        </a>
                                        <!--end::Menu-->
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
    </style>
    
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#kt_datatable_zero_configuration').DataTable({
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
            });

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
        });
    </script>
@endpush