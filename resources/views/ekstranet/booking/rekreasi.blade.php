@extends('ekstranet.layout', ['title' => 'Riwayat Booking Rekreasi', 'url' => '#'])

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

            <!-- Navigasi Tab Simple -->
            <div class="mb-4">
                <div class="d-flex gap-4 border-bottom">
                    <button class="nav-tab-simple active" data-bs-toggle="pill" data-bs-target="#semua"
                            type="button" role="tab" aria-controls="semua" aria-selected="true">
                        Semua Pesanan
                    </button>
                    <button class="nav-tab-simple" data-bs-toggle="pill" data-bs-target="#dipakai"
                            type="button" role="tab" aria-controls="dipakai" aria-selected="false">
                        Sudah Dipakai
                    </button>
                    <button class="nav-tab-simple" data-bs-toggle="pill" data-bs-target="#belum-dipakai"
                            type="button" role="tab" aria-controls="belum-dipakai" aria-selected="false">
                        Belum Dipakai
                    </button>
                    <button class="nav-tab-simple" data-bs-toggle="pill" data-bs-target="#kadaluarsa"
                            type="button" role="tab" aria-controls="kadaluarsa" aria-selected="false">
                        Kadaluarsa
                    </button>
                </div>
            </div>

            <!-- Konten Tab -->
            <div class="tab-content" id="booking-tab-content">
                <div class="tab-pane fade show active" id="semua" role="tabpanel" aria-labelledby="semua-tab">
                    <div class="table-responsive">
                        <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                            id="kt_datatable_semua">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Paket Rekreasi</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Tanggal Pemesanan</th>
                                    <th class="text-center">Tanggal Kadaluarsa</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rekreasibookdates as $booking)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">
                                            {{ $booking->transaction->user->name ?? '' }} -
                                            {{ $booking->transaction->user->phone ?? '' }}
                                        </td>
                                        <td class="text-center">{{ $booking->booking_id }}</td>
                                        <td class="text-center">{{ $booking->package->name ?? 'Paket tidak ditemukan' }}</td>
                                        <td class="text-center">{{ General::rp($booking->rent_price + $booking->fee_admin) }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($booking->transaction->created_at)->format('d F Y') }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($booking->expire_on)->format('d F Y') }}</td>
                                        <td class="text-center">
                                            @php
                                                $isExpired = \Carbon\Carbon::parse($booking->expire_on)->isPast();
                                            @endphp
                                            @if($isExpired)
                                                <span class="badge badge-danger">Kadaluarsa</span>
                                            @elseif($booking->is_used)
                                                <span class="badge badge-success">Sudah Dipakai</span>
                                            @else
                                                <span class="badge badge-warning">Belum Dipakai</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true" style="">
                                                @if(!$booking->is_used && !$isExpired)
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3 text-success" data-bs-toggle="modal" data-bs-target="#verificationModalRekreasi{{ $booking->id }}">
                                                            Verifikasi
                                                        </a>
                                                    </div>
                                                @elseif($booking->is_used)
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3 text-danger" data-bs-toggle="modal" data-bs-target="#cancellationModalRekreasi{{ $booking->id }}">
                                                            Batal Verifikasi
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('partner.riwayat-booking.cetak-invoice-rekreasi', $booking->id) }}"
                                                            class="menu-link px-3 text-primary d-flex justify-content-center" target="_blank">
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

                <div class="tab-pane fade" id="dipakai" role="tabpanel" aria-labelledby="dipakai-tab">
                    <div class="table-responsive">
                        <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                            id="kt_datatable_dipakai">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Paket Rekreasi</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Tanggal Pemesanan</th>
                                    <th class="text-center">Tanggal Kadaluarsa</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($rekreasibookdates as $booking)
                                    @if($booking->is_used)
                                        <tr>
                                            <td class="text-center">{{ $counter++ }}</td>
                                            <td class="text-center">
                                                {{ $booking->transaction->user->name ?? '' }} -
                                                {{ $booking->transaction->user->phone ?? '' }}
                                            </td>
                                            <td class="text-center">{{ $booking->booking_id }}</td>
                                            <td class="text-center">{{ $booking->package->name ?? 'Paket tidak ditemukan' }}</td>
                                            <td class="text-center">{{ General::rp($booking->rent_price + $booking->fee_admin) }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->transaction->created_at)->format('d F Y') }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->expire_on)->format('d F Y') }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-success">Sudah Dipakai</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true" style="">
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3 text-danger" data-bs-toggle="modal" data-bs-target="#cancellationModalRekreasi{{ $booking->id }}">
                                                            Batal Verifikasi
                                                        </a>
                                                    </div>
                                                    <div class="menu-item px-3">
                                                        <a href="{{ route('partner.riwayat-booking.cetak-invoice-rekreasi', $booking->id) }}"
                                                            class="menu-link px-3 text-primary d-flex justify-content-center" target="_blank">
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

                <div class="tab-pane fade" id="belum-dipakai" role="tabpanel" aria-labelledby="belum-dipakai-tab">
                    <div class="table-responsive">
                        <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                            id="kt_datatable_belum_dipakai">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Paket Rekreasi</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Tanggal Pemesanan</th>
                                    <th class="text-center">Tanggal Kadaluarsa</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($rekreasibookdates as $booking)
                                    @php $isExpired = \Carbon\Carbon::parse($booking->expire_on)->isPast(); @endphp
                                    @if(!$booking->is_used && !$isExpired)
                                        <tr>
                                            <td class="text-center">{{ $counter++ }}</td>
                                            <td class="text-center">
                                                {{ $booking->transaction->user->name ?? '' }} -
                                                {{ $booking->transaction->user->phone ?? '' }}
                                            </td>
                                            <td class="text-center">{{ $booking->booking_id }}</td>
                                            <td class="text-center">{{ $booking->package->name ?? 'Paket tidak ditemukan' }}</td>
                                            <td class="text-center">{{ General::rp($booking->rent_price + $booking->fee_admin) }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->transaction->created_at)->format('d F Y') }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->expire_on)->format('d F Y') }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-warning">Belum Dipakai</span>
                                            </td>
                                            <td class="text-center">
                                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                    data-kt-menu="true" style="">
                                                    <div class="menu-item px-3">
                                                        <a href="#" class="menu-link px-3 text-success" data-bs-toggle="modal" data-bs-target="#verificationModalRekreasi{{ $booking->id }}">
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

                <div class="tab-pane fade" id="kadaluarsa" role="tabpanel" aria-labelledby="kadaluarsa-tab">
                    <div class="table-responsive">
                        <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                            id="kt_datatable_kadaluarsa">
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th class="text-center">No</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Code Booking</th>
                                    <th class="text-center">Paket Rekreasi</th>
                                    <th class="text-center">Total Harga</th>
                                    <th class="text-center">Tanggal Pemesanan</th>
                                    <th class="text-center">Tanggal Kadaluarsa</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $counter = 1; @endphp
                                @foreach ($rekreasibookdates as $booking)
                                    @php $isExpired = \Carbon\Carbon::parse($booking->expire_on)->isPast(); @endphp
                                    @if($isExpired)
                                        <tr>
                                            <td class="text-center">{{ $counter++ }}</td>
                                            <td class="text-center">
                                                {{ $booking->transaction->user->name ?? '' }} -
                                                {{ $booking->transaction->user->phone ?? '' }}
                                            </td>
                                            <td class="text-center">{{ $booking->booking_id }}</td>
                                            <td class="text-center">{{ $booking->package->name ?? 'Paket tidak ditemukan' }}</td>
                                            <td class="text-center">{{ General::rp($booking->rent_price + $booking->fee_admin) }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->transaction->created_at)->format('d F Y') }}</td>
                                            <td class="text-center">{{ \Carbon\Carbon::parse($booking->expire_on)->format('d F Y') }}</td>
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
</form>

    @foreach ($rekreasibookdates as $booking)
        @php
            $isExpired = \Carbon\Carbon::parse($booking->expire_on)->isPast();
        @endphp
        @if(!$booking->is_used && !$isExpired)
            <div class="modal fade" id="verificationModalRekreasi{{ $booking->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi Penggunaan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menandai tiket ini sebagai sudah digunakan?</p>
                            <div class="text-center">
                                <iframe src="{{ route('partner.riwayat-booking.cetak-invoice-rekreasi', $booking->id) }}" width="100%" height="800px" style="border:none;"></iframe>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <a href="{{ route('partner.riwayat-booking.verifikasi-rekreasi', $booking->id) }}" class="btn btn-success">Sudah Dipakai</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
        @if($booking->is_used)
            <div class="modal fade" id="cancellationModalRekreasi{{ $booking->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi Pembatalan Penggunaan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin membatalkan tanda sudah digunakan untuk tiket ini?</p>
                            <div class="text-center">
                                <iframe src="{{ route('partner.riwayat-booking.cetak-invoice-rekreasi', $booking->id) }}" width="100%" height="800px" style="border:none;"></iframe>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <a href="{{ route('partner.riwayat-booking.batal-verifikasi-rekreasi', $booking->id) }}" class="btn btn-danger">Ya, Belum Dipakai</a>
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
            $('#kt_datatable_dipakai').DataTable(dataTableConfig);
            $('#kt_datatable_belum_dipakai').DataTable(dataTableConfig);
            $('#kt_datatable_kadaluarsa').DataTable(dataTableConfig);

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
