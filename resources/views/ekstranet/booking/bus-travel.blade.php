@extends('ekstranet.layout', ['title' => 'Riwayat Booking Bus Travel', 'url' => '#'])

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
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-striped gy-7 gs-7 table-bordered table align-middle"
                        id="kt_datatable_zero_configuration">
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
                                        {{ $booking->customer_name ?? $booking->transaction->user->name ?? '' }} -
                                        {{ $booking->customer_phone ?? $booking->transaction->user->phone ?? '' }}
                                    </td>
                                    <td class="text-center">{{ $booking->booking_id }}</td>
                                    <td class="text-center">{{ $booking->busTravel->business_name ?? '' }}</td>
                                    <td class="text-center">{{ General::rp($booking->price + $booking->fee_admin) }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($booking->created_at)->format('d F Y') }}</td>
                                    <td class="text-center">{{ \Carbon\Carbon::parse($booking->departure_time)->format('d F Y H:i') }}</td>
                                    <td class="text-center">
                                        <span class="badge {{ $booking->transaction->status == 'verified' ? 'badge-success' : 'badge-warning' }}">
                                            {{ ucfirst($booking->transaction->status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                            data-kt-menu="true" style="">
                                            @if($booking->transaction->status != 'verified')
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('partner.riwayat-booking.verifikasi-bus', $booking->id) }}"
                                                        class="menu-link px-3 text-success">
                                                        Verifikasi
                                                    </a>
                                                </div>
                                            @else
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('partner.riwayat-booking.batal-verifikasi-bus', $booking->id) }}"
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
        </div>
    </div>
@endsection

@push('add-script')
    <script>
        $(document).ready(function() {
            $('#kt_datatable_zero_configuration').DataTable({
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
        });
    </script>
@endpush
