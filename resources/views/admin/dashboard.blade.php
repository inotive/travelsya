@extends('admin.layout', ['title' => 'Dashboard', 'url' => '#'])

@section('content-admin')
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-sm-6 col-xl-3 ">
            <div class="card bg-light-success card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <h3 class="card-title fw-bold text-success fs-5  d-block">Mitra (Hotel & Hostel)</h3>
                    <div class="py-1">
                        <span class=" fw-bold text-dark fs-8  d-block">Keseluruhan</span>
                        <div class="py-1">
                            {{-- <span class="text-dark fs-1 fw-bold me-2">10 Partner</span> --}}
                            <span class="text-dark fs-1 fw-bold me-2">{{ $card['partner'] }}</span>

                            {{--                        <span class="text-dark fs-1 fw-bold me-2">{{$card['guest']}}</span> --}}

                            <span class="fw-semibold text-muted fs-7">Partner</span>
                        </div>
                        {{--                        <span class="text-dark fs-1 fw-bold me-2">{{$card['partner']}}</span> --}}
                    </div>
                </div>
                <!--end:: Body-->
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-sm-6 col-xl-3 ">
            <div class="card bg-light-success card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <h3 class="card-title fw-bold text-success fs-5  d-block">Jumlah Transaksi</h3>
                    <span class=" fw-bold text-dark fs-8  d-block">Hari Ini</span>

                    <div class="py-1">
                        {{-- <span class="text-dark fs-1 fw-bold me-2">103123</span> --}}

                        <span class="text-dark fs-1 fw-bold me-2">{{ $card['transactionToday'] }}</span>

                        <span class="fw-semibold text-muted fs-7">Transaksi</span>
                    </div>
                </div>
                <!--end:: Body-->
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-sm-6 col-xl-3 ">
            <div class="card bg-light-success card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <h3 class="card-title fw-bold text-success fs-5  d-block">Pendapatan Transaksi</h3>
                    <span class=" fw-bold text-dark fs-8  d-block">Hari Ini</span>

                    <div class="py-1">
                        {{-- <span class="text-dark fs-1 fw-bold me-2">103123</span> --}}
                        <span class="text-dark fs-2 fw-bold me-2">{{ $card['sumDayTransaction'] }}</span>

                        {{--                        <span class="text-dark fs-1 fw-bold me-2">{{$card['transactionToday']}}</span> --}}

                        {{--                        <span class="text-dark fs-5 fw-bold me-2">{{General::rp((int)$card['sumDayTransaction'])}}</span> --}}
                    </div>
                </div>
                <!--end:: Body-->
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-sm-6 col-xl-3 ">
            <div class="card bg-light-success card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <h3 class="card-title fw-bold text-success fs-5  d-block">Pendapatan Transaksi</h3>
                    <span class=" fw-bold text-dark fs-8  d-block">Bulan Ini</span>

                    <div class="py-1">
                        <span class="text-dark fs-2 fw-bold me-2">{{ $card['sumMonthTransaction'] }}</span>

                        {{--                        <span class="text-dark fs-1 fw-bold me-2">{{$card['transactionToday']}}</span> --}}
                        {{--                        <span class="text-dark fs-5 fw-bold me-2">{{General::rp((int)$card['sumMonthTransaction'])}}</span> --}}
                    </div>
                </div>
                <!--end:: Body-->
            </div>
        </div>
        <!--end::Col-->

    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x my-5 fs-6 fw-bold text-dark">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_all">Semua Transaksi
                                ({{ count($semuaTransaksi) }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_penginapan">Penginapan
                                ({{ count($transaksiHotel) + count($transaksiHostel) }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_ppob">PPOB Tagihan
                                ({{ count($transaksiPPOB) }})</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_top_up">Top UP
                                ({{ count($transaksiTopUp) }})</a>
                        </li>
                        {{--                        @foreach ($services as $key => $service) --}}
                        {{--                        <li class="nav-item"> --}}
                        {{--                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_{{$key}}">{{ucfirst($service->name)}}</a> --}}
                        {{--                        </li> --}}
                        {{--                        @endforeach --}}
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="kt_tab_pane_all" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table-row-dashed display fs-6 gy-5 table-bordered table align-middle"
                                    id="kt_datatable_zero_configuration">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <th>Tanggal</th>
                                            <th>Invoice</th>
                                            <th>Produk</th>
                                            <th>Customer</th>
                                            <th>Deskripsi</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Fee Admin</th>
                                            <th>Potongan Point</th>
                                            <th>Grand Total</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($transactions as $key => $transaction) --}}
                                        @foreach ($semuaTransaksi as $all)
                                            <tr>
                                                <td>{{ $all->created_at }}</td>
                                                <td>{{ $all->no_inv }}</td>
                                                <td>
                                                    <span class="badge badge-rounded badge-primary">
                                                        {{ strtoupper($all->services->name) }}
                                                    </span>
                                                </td>
                                                <td>{{ $all->user->name }}</td>
                                                <td>
                                                    @if (in_array($all->service_id, [3, 4, 5, 6, 9, 10]))
                                                        Pembayaran
                                                        Tagihan {{ strtoupper($all->services->name ?? '-') }}
                                                        Ke Nomor
                                                        Pelanggan
                                                        {{ $all->detailTransactionPPOB->first()->nomor_pelanggan ?? '-' }}
                                                    @elseif(in_array($all->service_id, [1, 2, 11, 12]))
                                                        Pembelian
                                                        {{ strtoupper($all->detailTransactionTopUp->first()->product->description ?? '-') }}
                                                        Ke
                                                        Nomor
                                                        {{ $all->detailTransactionTopUp->first()->nomor_telfon ?? '-' }}
                                                    @elseif($all->service_id == 8)
                                                        Reservasi Hostel
                                                        {{ $all->detailTransactionHotel->first()->hotel->name ?? '-' }}
                                                        Pada Kamar
                                                        {{ $all->detailTransactionHotel->first()->hotelRoom?->name ?? '-' }}
                                                    @elseif($all->service_id == 7)
                                                        Reservasi Hostel
                                                        {{ $all->detailTransactionHostel->first()->hostel->name ?? '-' }}
                                                        Pada Kamar
                                                        {{ $all->detailTransactionHostel->first()->hostelRoom?->name ?? '-' }}
                                                    @endif
                                                </td>
                                                <td>{!! $all->payment_method ? str_replace('_', ' ', $all->payment_method) : '-' !!}</td>
                                                <td class="text-success fw-bold">
                                                    @if (in_array($all->service_id, [3, 4, 5, 6, 9, 10]))
                                                        @currency(($all->detailTransactionPPOB->first()->fee_travelsya ?? 0) + ($all->detailTransactionPPOB->first()->kode_unik ?? 0))
                                                    @elseif(in_array($all->service_id, [1, 2, 11, 12]))
                                                        @currency(($all->detailTransactionTopUp->first()->fee_travelsya ?? 0) + ($all->detailTransactionTopUp->first()->kode_unik ?? 0))
                                                    @elseif($all->service_id == 8)
                                                        @currency(($all->detailTransactionHotel->first()->fee_admin ?? 0) + ($all->detailTransactionHotel->first()->kode_unik ?? 0))
                                                    @elseif($all->service_id == 7)
                                                        @currency(($all->detailTransactionHostel->first()->fee_admin ?? 0) + ($all->detailTransactionHostel->first()->kode_unik ?? 0))
                                                    @endif
                                                </td>
                                                <td class="text-danger fw-bold">
                                                    @currency($all->historyPointOut->first()->point ?? 0)
                                                </td>
                                                <td>@currency($all->total)</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="kt_tab_pane_penginapan" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table-row-dashed display fs-6 gy-5 table-bordered table align-middle"
                                    id="kt_datatable_zero_configuration">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <th>Tanggal</th>
                                            <th>Invoice</th>
                                            <th>Produk</th>
                                            <th>Customer</th>
                                            <th>Nama Ruangan</th>
                                            <th>Jumlah Ruangan</th>
                                            <th>jumlah Malam</th>
                                            {{-- <th>Fee Admin (15% + Layanan + Kode Unik)</th>
                                            <th>Total Client Terima</th>
                                            <th>Grand Total</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($transactions as $key => $transaction) --}}
                                        @foreach ($transaksiHotel as $hotel)
                                            <tr>
                                                <td>{{ $hotel['created_at'] }}</td>
                                                <td>{{ $hotel['no_inv'] }}</td>
                                                <td>
                                                    <span class="badge badge-rounded badge-primary">
                                                        {{ strtoupper($hotel->services->name ?? '-') }}
                                                    </span>
                                                </td>
                                                <td>{{ $hotel->user->name ?? '-' }}</td>
                                                @foreach ($hotel->detailTransactionHotel as $itemHotel)
                                                    <td>{{ $itemHotel->hotelRoom->name ?? '-' }}</td>
                                                    <td>{{ $itemHotel->room ?? '-' }}</td>
                                                    @php
                                                          
                                                          $reservasi_start = \Carbon\Carbon::createFromFormat('Y-m-d', $itemHotel->reservation_start);
                                                        $reservasi_end = \Carbon\Carbon::createFromFormat('Y-m-d', $itemHotel->reservation_end);

                                                        $durationInDays = $reservasi_start->diffInDays($reservasi_end);
                                                    @endphp
                                                    <td>{{ $durationInDays }} Hari</td>
                                                @endforeach
                                                {{-- <td class="text-success text-center">
                                                    Rp.
                                                    {{ number_format(($hotel['transaction_price'] * 15) / 100 + $hotel['fee'], 0, ',', '.') }}
                                                </td>
                                                <td class=" text-center">@currency($hotel['transaction_price'] - ($hotel['transaction_price'] * 15) / 100)</td>
                                                <td class=" text-center">@currency($hotel['transaction_price'])</td> --}}
                                            </tr>
                                        @endforeach

                                        @foreach ($transaksiHostel as $hostel)
                                            <tr>
                                                <td>{{ $hostel['created_at'] }}</td>
                                                <td>{{ $hostel['no_inv'] }}</td>
                                                <td>
                                                    <span class="badge badge-rounded badge-primary">
                                                        {{ strtoupper($hotel->services->name ?? '-') }}
                                                    </span>
                                                </td>

                                                <td>{{ $hostel->user->name ?? '-' }}</td>
                                                @foreach ($hostel->detailTransactionHostel as $itemHostel)
                                                    <td>{{ $itemHostel->hostelRoom->name ?? '-' }}</td>
                                                    <td>{{ $itemHostel->room ?? '-' }}</td>
                                                    @php
                                                      
                                                        $reservasi_start = \Carbon\Carbon::createFromFormat('Y-m-d', $itemHostel->reservation_start);
                                                        $reservasi_end = \Carbon\Carbon::createFromFormat('Y-m-d', $itemHostel->reservation_end);

                                                        $durationInDays = $reservasi_start->diffInMonths($reservasi_end);
                                                    @endphp
                                                    <td>{{ $durationInDays }} Bulan</td>
                                                @endforeach

                                                {{-- <td class="text-success text-center">
                                                    Rp.
                                                    {{ number_format(($hostel['transaction_price'] * 15) / 100 + $hostel['fee'], 0, ',', '.') }}
                                                </td>
                                                <td class=" text-center">@currency($hostel['transaction_price'] - ($hostel['transaction_price'] * 15) / 100)</td>
                                                <td class=" text-center">@currency($hostel['transaction_price'])</td> --}}
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="kt_tab_pane_ppob" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table-row-dashed display fs-6 gy-5 table-bordered table align-middle"
                                    id="kt_datatable_zero_configuration">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <th>Transaksi Dibuat</th>
                                            <th>Invoice</th>
                                            <th>Produk</th>
                                            <th>Customer</th>
                                            <th>Deskripsi</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Point Digunakan Customer</th>
                                            <th>Fee Admin</th>
                                            <th>Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($transactions as $key => $transaction) --}}
                                        @foreach ($transaksiPPOB as $transaction)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y h:i') }}
                                                </td>
                                                <td>{{ $transaction->no_inv }}</td>
                                                <td>
                                                    <span class="badge badge-rounded badge-primary">
                                                        {{ strtoupper($transaction->services->name ?? '-') }}
                                                    </span>
                                                </td>
                                                <td>{{ $transaction->user->name }}</td>
                                                <td>Pembayaran Tagihan
                                                    {{ strtoupper($transaction->services->name ?? '-') }}
                                                    Ke Nomor
                                                    Pelanggan
                                                    {{ $transaction->detailTransactionPPOB->first()->nomor_pelanggan ?? '-' }}
                                                    {{ $transaction['transaction_desc'] }}</td>

                                                <td>{{ $transaction->payment_method . ' - ' . $transaction->payment_channel }}
                                                </td>
                                                <td class="text-danger fw-bold">
                                                    @currency($transaction->historyPointOut->first()->point ?? 0)
                                                </td>
                                                <td>
                                                    @currency(($transaction->detailTransactionPPOB->first()->fee_travelsya ?? 0) + ($transaction->detailTransactionPPOB->first()->kode_unik ?? 0))
                                                </td>
                                                <td>@currency($transaction->total)</td>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="kt_tab_pane_top_up" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table-row-dashed display fs-6 gy-5 table-bordered table align-middle"
                                    id="kt_datatable_zero_configuration">
                                    <thead>
                                        <tr class="fw-bold fs-6 text-gray-800">
                                            <th>Tanggal</th>
                                            <th>Invoice</th>
                                            <th>Produk</th>
                                            <th>Customer</th>
                                            <th>Deskripsi</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Point Digunakan Customer</th>
                                            <th>Fee Admin</th>
                                            <th>Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- @foreach ($transactions as $key => $transaction) --}}
                                        @foreach ($transaksiTopUp as $transaction)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($transaction->created_at)->format('d M Y h:i') }}
                                                </td>
                                                <td>{{ $transaction->no_inv }}</td>
                                                <td>
                                                    <span class="badge badge-rounded badge-primary">
                                                        {{ strtoupper($transaction->services->name ?? '-') }}
                                                    </span>
                                                </td>
                                                <td>{{ $transaction->user->name }}</td>
                                                <td>
                                                    Pembelian
                                                    {{ strtoupper($transaction->detailTransactionTopUp->first()->product->description ?? '-') }}
                                                    Ke
                                                    Nomor
                                                    {{ $transaction->detailTransactionTopUp->first()->nomor_telfon ?? '-' }}
                                                    {{ $transaction['transaction_desc'] }}</td>
                                                <td>{{ $transaction->payment_method . ' - ' . $transaction->payment_channel }}
                                                </td>
                                                <td class="text-danger fw-bold">
                                                    @currency($hotel->historyPointOut->first()->point ?? 0)
                                                </td>
                                                <td>
                                                    @currency(($all->detailTransactionTopUp->first()->fee_travelsya ?? 0) + ($all->detailTransactionTopUp->first()->kode_unik ?? 0))
                                                </td>
                                                <td>@currency($transaction->total)</td>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('add-script')
    <script>
        $(document).ready(function() {
            new DataTable('table.display', {
                order: [
                    [1, 'desc']
                ],
            });
            // $('.display').DataTable({
            //     "scrollY": "500px",
            //     "scrollCollapse": true,
            //     order: [[0, 'desc']],
            //     // "language": {
            //     //     "lengthMenu": "Show _MENU_",
            //     // },
            //     "dom":
            //         "<'row'" +
            //         "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            //         "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            //         ">" +
            //
            //         "<'table-responsive'tr>" +
            //
            //         "<'row'" +
            //         "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            //         "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            //         ">"
            // });
            // $('#kt_datatable_penginapan').DataTable({
            //     "scrollY": "500px",
            //     "scrollCollapse": true,
            //     "language": {
            //         "lengthMenu": "Show _MENU_",
            //     },
            //     "dom":
            //         "<'row'" +
            //         "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            //         "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            //         ">" +
            //
            //         "<'table-responsive'tr>" +
            //
            //         "<'row'" +
            //         "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            //         "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            //         ">"
            // });
            // $('#kt_datatable_ppob').DataTable({
            //     "scrollY": "500px",
            //     "scrollCollapse": true,
            //     "language": {
            //         "lengthMenu": "Show _MENU_",
            //     },
            //     "dom":
            //         "<'row'" +
            //         "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            //         "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            //         ">" +
            //
            //         "<'table-responsive'tr>" +
            //
            //         "<'row'" +
            //         "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            //         "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            //         ">"
            // });
            // $('#kt_tab_pane_pulsa').DataTable({
            //     "scrollY": "500px",
            //     "scrollCollapse": true,
            //     "language": {
            //         "lengthMenu": "Show _MENU_",
            //     },
            //     "dom":
            //         "<'row'" +
            //         "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
            //         "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
            //         ">" +
            //
            //         "<'table-responsive'tr>" +
            //
            //         "<'row'" +
            //         "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
            //         "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
            //         ">"
            // });
        });
    </script>
@endpush
