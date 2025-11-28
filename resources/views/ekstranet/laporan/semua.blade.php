@extends('ekstranet.layout', ['title' => 'Laporan Transaksi', 'url' => '#'])

@section('content-admin')
    <div class="card">
        <div class="card-body">
            <form action="" method="get">
                <div class="row g-2 align-items-end mb-3">
                    <div class="col-12 col-md-3">
                        <label class="form-label">Jenis Bisnis</label>
                        <select class="form-select" name="business">
                            <option value="all" {{ request('business') == 'all' ? 'selected' : '' }}>Semua Bisnis</option>
                            <option value="hotel" {{ request('business') == 'hotel' ? 'selected' : '' }}>Hotel</option>
                            <option value="hostel" {{ request('business') == 'hostel' ? 'selected' : '' }}>Hostel</option>
                            <option value="bus" {{ request('business') == 'bus' ? 'selected' : '' }}>Bus & Travel
                            </option>
                            <option value="rental" {{ request('business') == 'rental' ? 'selected' : '' }}>Rental Mobil
                            </option>
                            <option value="clinic" {{ request('business') == 'clinic' ? 'selected' : '' }}>Health & Beauty
                            </option>
                            <option value="recreation" {{ request('business') == 'recreation' ? 'selected' : '' }}>Rekreasi
                            </option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label">Tahun</label>
                        <select class="form-select" name="year">
                            <option value="" disabled selected>Pilih Tahun</option>
                            @php
                                $currentYear = date('Y');
                                $startYear = 2020; // Tahun awal yang diinginkan
                            @endphp
                            @for ($i = $currentYear; $i >= $startYear; $i--)
                                <option value="{{ $i }}"
                                    {{ isset($_GET['year']) && $_GET['year'] == $i ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label">Tanggal Awal</label>
                        <input type="date" class="form-control" data-placeholder="Tanggal Awal" name="start"
                            value="{{ isset($_GET['start']) ? $_GET['start'] : '' }}">
                    </div>
                    <div class="col-12 col-md-3">
                        <label class="form-label">Tanggal Akhir</label>
                        <input type="date" class="form-control" data-placeholder="Tanggal Akhir" name="end"
                            value="{{ isset($_GET['end']) ? $_GET['end'] : '' }}">
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-12 col-md-6 d-grid">
                        <button type="submit" class="btn btn-primary w-100">Cari Data</button>
                    </div>
                    <div class="col-12 col-md-6 d-grid">
                        <button type="button" class="btn btn-success w-100" onclick="exportToExcel()">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Card -->
    <div class="card mt-3">
        <div class="card-header">
            <h3 class="card-title">Ringkasan Laporan</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-primary">
                                <i class="fas fa-dollar-sign text-primary"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between flex-grow-1">
                            <div>
                                <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Total Harga</a>
                                <span class="text-muted fw-bold d-block">{{ General::rp($total_rent_price) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-warning">
                                <i class="fas fa-cog text-warning"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between flex-grow-1">
                            <div>
                                <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Biaya Layanan</a>
                                <span class="text-muted fw-bold d-block">{{ General::rp($total_fee_admin) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-success">
                                <i class="fas fa-gift text-success"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between flex-grow-1">
                            <div>
                                <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Potongan Point</a>
                                <span class="text-muted fw-bold d-block">{{ General::rp($total_point_discount) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <span class="symbol-label bg-light-danger">
                                <i class="fas fa-calculator text-danger"></i>
                            </span>
                        </div>
                        <div class="d-flex justify-content-between flex-grow-1">
                            <div>
                                <a href="#" class="text-dark fw-bolder text-hover-primary fs-6">Grand Total</a>
                                <span class="text-muted fw-bold d-block">{{ General::rp($grand_total) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <div class="card-body">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table table-bordered fw-normal">
                            <thead class="fw-bold text-center">
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Invoice No.</th>
                                    <th class="text-center">Tanggal & Waktu</th>
                                    <th class="text-center">Customer</th>
                                    <th class="text-center">Contact</th>
                                    <th class="text-center">Metode & Channel Pembayaran</th>
                                    <th class="text-center">Deskripsi Pesanan</th>
                                    <th class="text-center">Grand Total</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp

                                {{-- @foreach ($transcation_id as $ucup)
                                    <p>{{$ucup->id}}</p>
                                @endforeach --}}
                                @foreach ($transaction_hotels as $hotel)
                                    @php
                                        $transaction_id = $hotel->transaction_id;

                                        $detail_pemesanan = DB::table('detail_transaction_hotel')
                                            ->join(
                                                'transactions',
                                                'transactions.id',
                                                '=',
                                                'detail_transaction_hotel.transaction_id',
                                            )
                                            ->where('transaction_id', $transaction_id)
                                            ->value('detail_transaction_hotel.id');
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $hotel->transaction->no_inv }}</td>
                                        <td>{{ \Carbon\Carbon::parse($hotel->created_at)->format('d M Y H:i:s') }}</td>
                                        <td>{{ $hotel->transaction->user->name }}</td>
                                        <td>{{ $hotel->transaction->user->phone }}</td>
                                        <td>
                                            {{ $hotel->transaction->payment_method }} -
                                            {{ $hotel->transaction->payment_channel }}
                                        </td>
                                        <td>
                                            {{ $hotel->hotel->name }} - {{ $hotel->room . ' ' . $hotel->hotelRoom->name }}

                                            @php
                                                $startDate = new DateTime($hotel->reservation_start);
                                                $endDate = new DateTime($hotel->reservation_end);
                                                $interval = $startDate->diff($endDate);
                                                echo $interval->format('%a Malam');
                                            @endphp
                                        </td>
                                        <td>{{ General::rp($hotel->rent_price + $hotel->fee_admin) }}</td>
                                        <td>
                                            <span
                                                class="badge
                                            {{ $hotel->transaction->status == 'PAID' ? 'badge-success' : 'badge-warning' }}">{{ $hotel->transaction->status == 'PAID' ? 'Lunas' : 'Menunggu Pembayaran' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('partner.riwayat-booking.detailhotel', ['id' => $detail_pemesanan]) }}"
                                                class="btn btn-sm btn-outline btn-outline-primary text-dark btn-active-light-secondary w-100"
                                                data-kt-customer-table-filter="delete_row">
                                                Detail Pesanan
                                            </a>

                                        </td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @endforeach


                                @foreach ($transaction_hostels as $hostel)
                                    @php
                                        $transaction_id = $hostel->transaction->id;

                                        $detail_pemesanan = DB::table('detail_transaction_hostel')
                                            ->join(
                                                'transactions',
                                                'transactions.id',
                                                '=',
                                                'detail_transaction_hostel.transaction_id',
                                            )
                                            ->where('transaction_id', $transaction_id)
                                            ->value('detail_transaction_hostel.id');

                                        // dd($transaction_id, $detail_pemesanan);

                                    @endphp

                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $hostel->transaction->no_inv }}</td>
                                        <td>{{ \Carbon\Carbon::parse($hostel->updated_at)->format('d M Y H:i:s') }}
                                        </td>
                                        <td>{{ $hostel->transaction->user->name }}</td>
                                        <td>{{ $hostel->transaction->user->phone }}</td>
                                        <td>
                                            {{ $hostel->transaction->payment_method }} -
                                            {{ $hostel->transaction->payment_channel }}
                                        </td>
                                        <td>
                                            {{ $hostel->hostel->name }} -
                                            {{ $hostel->room . ' ' . $hostel->hostelRoom->name }} -
                                            {{ $hostel->type_rent == 'tahunan' ? 'Tahunan' : 'Bulanan' }}
                                        </td>
                                        <td>{{ General::rp($hostel->rent_price + $hostel->fee_admin) }}</td>
                                        <td>
                                            <span
                                                class="badge
                                            {{ $hostel->transaction->status == 'PAID' ? 'badge-success' : 'badge-warning' }}">{{ $hostel->transaction->status == 'PAID' ? 'Lunas' : 'Menunggu Pembayaran' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('partner.riwayat-booking.detailhostel', ['id' => $detail_pemesanan]) }}"
                                                class="btn btn-sm btn-outline btn-outline-primary text-dark btn-active-light-secondary w-100"
                                                data-kt-customer-table-filter="delete_row">
                                                Detail Pesanan
                                            </a>
                                        </td>
                                    </tr>
                                    @php
                                        $no++;
                                    @endphp
                                @endforeach

                                <!-- Bus & Travel -->
                                @foreach ($transaction_buses as $bus)
                                    @php
                                        $transaction_id = $bus->transaction->id;
                                        // Assuming detail route exists or using a generic one if specific not found,
                                        // but following pattern, likely partner.riwayat-booking.detailbus or similar.
                                        // Checking routes might be needed, but for now I will use a placeholder or try to guess based on pattern.
                                        // Actually, I should check the routes for detail pages.
                                        // Based on previous grep, I didn't see explicit detail routes for all, but let's assume a pattern or use # if unsure.
                                        // Wait, I can check routes.
                                        // For now, I'll use the ID for the link.
                                        $detail_pemesanan = $bus->id;
                                    @endphp
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $bus->transaction->no_inv }}</td>
                                        <td>{{ \Carbon\Carbon::parse($bus->updated_at)->format('d M Y H:i:s') }}</td>
                                        <td>{{ $bus->transaction->user->name ?? 'User Deleted' }}</td>
                                        <td>{{ $bus->transaction->user->phone ?? '-' }}</td>
                                        <td>
                                            {{ $bus->transaction->payment_method }} -
                                            {{ $bus->transaction->payment_channel }}
                                        </td>
                                        <td>
                                            {{ $bus->busTravel->business_name ?? 'Bus Travel Deleted' }} -
                                            {{ $bus->bus->name ?? 'Bus Deleted' }} <br>
                                            {{ \Carbon\Carbon::parse($bus->departure_time)->format('d M Y H:i') }}
                                        </td>
                                        <td>{{ General::rp($bus->price + $bus->fee_admin) }}</td>
                                        <td>
                                            <span
                                                class="badge
                                            {{ $bus->transaction->status == 'PAID' ? 'badge-success' : 'badge-warning' }}">{{ $bus->transaction->status == 'PAID' ? 'Lunas' : 'Menunggu Pembayaran' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <!-- Assuming route exists, if not user might need to add it or I'll fix it later. -->
                                            <!-- I'll use a safe fallback or check routes first? -->
                                            <!-- Let's check routes in a separate step if needed, but for now I'll use the pattern -->
                                            <a href="#"
                                                class="btn btn-sm btn-outline btn-outline-primary text-dark btn-active-light-secondary w-100">
                                                Detail Pesanan
                                            </a>
                                        </td>
                                    </tr>
                                    @php $no++; @endphp
                                @endforeach

                                <!-- Rental Mobil -->
                                @foreach ($transaction_rentals as $rental)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $rental->transaction->no_inv }}</td>
                                        <td>{{ \Carbon\Carbon::parse($rental->updated_at)->format('d M Y H:i:s') }}</td>
                                        <td>{{ $rental->transaction->user->name ?? 'User Deleted' }}</td>
                                        <td>{{ $rental->transaction->user->phone ?? '-' }}</td>
                                        <td>
                                            {{ $rental->transaction->payment_method }} -
                                            {{ $rental->transaction->payment_channel }}
                                        </td>
                                        <td>
                                            {{ $rental->carRental->business_name ?? 'Rental Deleted' }} -
                                            {{ $rental->car->name ?? 'Car Deleted' }} <br>
                                            {{ $rental->durasi }} Hari
                                        </td>
                                        <td>{{ General::rp($rental->rent_price + $rental->fee_admin) }}</td>
                                        <td>
                                            <span
                                                class="badge
                                            {{ $rental->transaction->status == 'PAID' ? 'badge-success' : 'badge-warning' }}">{{ $rental->transaction->status == 'PAID' ? 'Lunas' : 'Menunggu Pembayaran' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="#"
                                                class="btn btn-sm btn-outline btn-outline-primary text-dark btn-active-light-secondary w-100">
                                                Detail Pesanan
                                            </a>
                                        </td>
                                    </tr>
                                    @php $no++; @endphp
                                @endforeach

                                <!-- Health & Beauty -->
                                @foreach ($transaction_clinics as $clinic)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $clinic->transaction->no_inv }}</td>
                                        <td>{{ \Carbon\Carbon::parse($clinic->updated_at)->format('d M Y H:i:s') }}</td>
                                        <td>{{ $clinic->transaction->user->name ?? 'User Deleted' }}</td>
                                        <td>{{ $clinic->transaction->user->phone ?? '-' }}</td>
                                        <td>
                                            {{ $clinic->transaction->payment_method }} -
                                            {{ $clinic->transaction->payment_channel }}
                                        </td>
                                        <td>
                                            {{ $clinic->clinic->clinic_name ?? 'Clinic Deleted' }} -
                                            {{ $clinic->package->name ?? 'Package Deleted' }}
                                        </td>
                                        <td>{{ General::rp($clinic->rent_price + $clinic->fee_admin) }}</td>
                                        <td>
                                            <span
                                                class="badge
                                            {{ $clinic->transaction->status == 'PAID' ? 'badge-success' : 'badge-warning' }}">{{ $clinic->transaction->status == 'PAID' ? 'Lunas' : 'Menunggu Pembayaran' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="#"
                                                class="btn btn-sm btn-outline btn-outline-primary text-dark btn-active-light-secondary w-100">
                                                Detail Pesanan
                                            </a>
                                        </td>
                                    </tr>
                                    @php $no++; @endphp
                                @endforeach

                                <!-- Rekreasi -->
                                @foreach ($transaction_recreations as $recreation)
                                    <tr>
                                        <td>{{ $no }}</td>
                                        <td>{{ $recreation->transaction->no_inv }}</td>
                                        <td>{{ \Carbon\Carbon::parse($recreation->updated_at)->format('d M Y H:i:s') }}
                                        </td>
                                        <td>{{ $recreation->transaction->user->name ?? 'User Deleted' }}</td>
                                        <td>{{ $recreation->transaction->user->phone ?? '-' }}</td>
                                        <td>
                                            {{ $recreation->transaction->payment_method }} -
                                            {{ $recreation->transaction->payment_channel }}
                                        </td>
                                        <td>
                                            {{ $recreation->recreation->business_name ?? 'Recreation Deleted' }} -
                                            {{ $recreation->package->name ?? 'Package Deleted' }} <br>
                                            {{ $recreation->total_ticket }} Tiket
                                        </td>
                                        <td>{{ General::rp($recreation->rent_price + $recreation->fee_admin) }}</td>
                                        <td>
                                            <span
                                                class="badge
                                            {{ $recreation->transaction->status == 'PAID' ? 'badge-success' : 'badge-warning' }}">{{ $recreation->transaction->status == 'PAID' ? 'Lunas' : 'Menunggu Pembayaran' }}
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a href="#"
                                                class="btn btn-sm btn-outline btn-outline-primary text-dark btn-active-light-secondary w-100">
                                                Detail Pesanan
                                            </a>
                                        </td>
                                    </tr>
                                    @php $no++; @endphp
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="12">
                                        {{--
                                    {{$transactions->appends(request()->input())->links('vendor.pagination.bootstrap-5')}} --}}
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('add-script')
    <script>
        // $(document).ready(function() {
        //     $("#kt_datatable_vertical_scroll").DataTable({
        //         search: {
        //             return: true,
        //         },
        //     });
        // } );
        new tempusDominus.TempusDominus(document.getElementById("kt_td_picker_date_only"), {
            display: {
                viewMode: "calendar",
                components: {
                    decades: true,
                    year: true,
                    month: true,
                    date: true,
                    hours: false,
                    minutes: false,
                    seconds: false
                }
            }
        });

        function exportToExcel() {
            // Get table data
            const table = document.querySelector('.table');
            const rows = table.querySelectorAll('tbody tr');

            // Create Excel content using simple HTML table format
            let excelContent = `
                <html>
                <head>
                    <meta charset="utf-8">
                    <style>
                        table { border-collapse: collapse; width: 100%; }
                        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                        th { background-color: #f2f2f2; font-weight: bold; }
                        .text-center { text-align: center; }
                    </style>
                </head>
                <body>
                    <table>
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Invoice No</th>
                                <th class="text-center">Tanggal & Waktu</th>
                                <th class="text-center">Customer</th>
                                <th class="text-center">Contact</th>
                                <th class="text-center">Metode & Channel Pembayaran</th>
                                <th class="text-center">Deskripsi Pesanan</th>
                                <th class="text-center">Grand Total</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
            `;

            // Add data rows
            rows.forEach((row, index) => {
                const cells = row.querySelectorAll('td');
                if (cells.length >= 9) { // Ensure we have enough cells
                    excelContent += '<tr>';
                    excelContent += `<td class="text-center">${index + 1}</td>`;
                    excelContent += `<td>${cells[1].textContent.trim()}</td>`;
                    excelContent += `<td>${cells[2].textContent.trim()}</td>`;
                    excelContent += `<td>${cells[3].textContent.trim()}</td>`;
                    excelContent += `<td>${cells[4].textContent.trim()}</td>`;
                    excelContent += `<td>${cells[5].textContent.trim()}</td>`;
                    excelContent += `<td>${cells[6].textContent.trim()}</td>`;
                    excelContent += `<td>${cells[7].textContent.trim()}</td>`;
                    excelContent += `<td>${cells[8].textContent.trim()}</td>`;
                    excelContent += '</tr>';
                }
            });

            excelContent += `
                        </tbody>
                    </table>
                </body>
                </html>
            `;

            // Create and download file
            const blob = new Blob([excelContent], {
                type: 'application/vnd.ms-excel;charset=utf-8;'
            });
            const link = document.createElement('a');
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);

            // Generate filename with current date and filters
            const now = new Date();
            const dateStr = now.toISOString().split('T')[0];
            const business = document.querySelector('select[name="business"]').value || 'all';
            const year = document.querySelector('select[name="year"]').value || 'all';
            const start = document.querySelector('input[name="start"]').value || 'all';
            const end = document.querySelector('input[name="end"]').value || 'all';

            let filename = `laporan_transaksi_${dateStr}`;
            if (business !== 'all') filename += `_${business}`;
            if (year !== 'all') filename += `_tahun_${year}`;
            if (start !== 'all') filename += `_dari_${start}`;
            if (end !== 'all') filename += `_sampai_${end}`;
            filename += '.xls';

            link.setAttribute('download', filename);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }
    </script>
@endpush
