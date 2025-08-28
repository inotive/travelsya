@extends('ekstranet.layout', ['title' => 'Riwayat Booking Car Rental', 'url' => '#'])

@section('content-admin')
<form action="#" method="get">
    <div class="card mb-2">
        <div class="card-body">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Tahun</label>
                    <select class="form-select" name="year">
                        <option value="">Pilih Tahun</option>
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
                <div class="col-md-4">
                    <label class="form-label">Dari Tanggal</label>
                    <input type="date" class="form-control" name="start" value="{{ request()->get('start') }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Sampai Tanggal</label>
                    <input type="date" class="form-control" name="end" value="{{ request()->get('end') }}">
                </div>
            </div>
        </div>
    </div>

              <div class="card">
        <div class="card-body">
            <div class="row g-3 align-items-end mb-5">
                <div class="col-md-10">
                    <label class="form-label">Kata Kunci</label>
                    <input type="text" class="form-control" name="keyword" placeholder="Cari Customer, Kode Booking, Paket" value="{{ request()->get('keyword') }}">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
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
                                                        <a href="#" class="menu-link px-3 text-success" data-bs-toggle="modal" data-bs-target="#verificationModalCarRental{{ $booking->id }}">
                                                            Verifikasi
                                                        </a>
                                                    </div>
                                                @elseif($status == 'verified')
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3 text-danger" data-bs-toggle="modal" data-bs-target="#cancellationModalCarRental{{ $booking->id }}">
                                                            Batal Verifikasi
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('partner.riwayat-booking.cetak-invoice-car-rental', $booking->id) }}"
                                                            class="menu-link px-3 text-primary" target="_blank">
                                                            Invoice
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
                                                        <a href="#" class="menu-link px-3 text-danger" data-bs-toggle="modal" data-bs-target="#cancellationModalCarRental{{ $booking->id }}">
                                                            Batal Verifikasi
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('partner.riwayat-booking.cetak-invoice-car-rental', $booking->id) }}"
                                                            class="menu-link px-3 text-primary" target="_blank">
                                                            Invoice
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
                                                        <a href="#" class="menu-link px-3 text-success" data-bs-toggle="modal" data-bs-target="#verificationModalCarRental{{ $booking->id }}">
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

    @foreach ($carrentalbookdates as $booking)
        @php
            $isExpired = \Carbon\Carbon::parse($booking->end)->isPast();
            $status = $booking->status ?? 'pending';
        @endphp
        
        {{-- Modal for verification --}}
        @if($status != 'verified' && !$isExpired)
            <div class="modal fade" id="verificationModalCarRental{{ $booking->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi Verifikasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin memverifikasi booking ini?</p>
                            <div class="text-center">
                                <iframe src="{{ route('partner.riwayat-booking.cetak-invoice-car-rental', $booking->id) }}" width="100%" height="800px" style="border:none;"></iframe>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <a href="{{ route('partner.riwayat-booking.verifikasi-car-rental', $booking->id) }}" class="btn btn-success">Verifikasi</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        {{-- Modal for cancellation verification --}}
        @if($status == 'verified')
            <div class="modal fade" id="cancellationModalCarRental{{ $booking->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi Pembatalan Verifikasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin membatalkan verifikasi booking ini?</p>
                            <div class="text-center">
                                <iframe src="{{ route('partner.riwayat-booking.cetak-invoice-car-rental', $booking->id) }}" width="100%" height="800px" style="border:none;"></iframe>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <a href="{{ route('partner.riwayat-booking.batal-verifikasi-car-rental', $booking->id) }}" class="btn btn-danger">Ya, Batalkan Verifikasi</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach
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
