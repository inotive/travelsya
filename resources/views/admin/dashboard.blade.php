@extends('admin.layout', ['title' => 'Dashboard', 'url' => '#'])

@section('content-admin')
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-sm-6 col-xl-3 ">
            <div class="card bg-light-success card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <h3 class="card-title fw-bold text-success fs-5  d-block">Jumlah Partner</h3>
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
                            <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_all">Semua Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_penginapan">Penginapan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_ppob">PPOB</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_pulsa">Pulsa & Data</a>
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
                                        <th>Grand Total</th>
                                        <th>Fee Admin</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{-- @foreach ($transactions as $key => $transaction) --}}
                                    @foreach ($detailTransactions as $transaction)
                                        <tr>
                                            <td>{{ $transaction['created_at'] }}</td>
                                            <td>{{ $transaction['no_inv'] }}</td>
                                            <td>
                                                    <span class="badge badge-rounded badge-primary">
                                                        {{ strtoupper($transaction['service_name']) }}
                                                    </span>
                                            </td>
                                            <td>{{ $transaction['user'] }}</td>
                                            <td>{{ $transaction['transaction_name'] }} -
                                                {{ $transaction['transaction_desc'] }}</td>
                                            <td>{!! $transaction['payment_method'] ? str_replace('_', ' ', $transaction['payment_method']) : '-' !!}</td>
                                            <td>@currency($transaction['transaction_price'])</td>
                                            <td>@currency($transaction['fee'])</td>
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
                                        <th>Deskripsi</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Grand Total</th>
                                        <th>Fee Admin</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{-- @foreach ($transactions as $key => $transaction) --}}
                                    @foreach ($detailTransactionHotel as $transaction)
                                        <tr>
                                            <td>{{ $transaction['created_at'] }}</td>
                                            <td>{{ $transaction['no_inv'] }}</td>
                                            <td>
                                                    <span class="badge badge-rounded badge-primary">
                                                        {{ strtoupper($transaction['service_name']) }}
                                                    </span>
                                            </td>
                                            <td>{{ $transaction['user'] }}</td>
                                            <td>{{ $transaction['transaction_name'] }} -
                                                {{ $transaction['transaction_desc'] }}</td>
                                            <td>{!! $transaction['payment_method'] ? str_replace('_', ' ', $transaction['payment_method']) : '-' !!}</td>
                                            <td>@currency($transaction['transaction_price'])</td>
                                            <td>@currency($transaction['fee'])</td>
                                    @endforeach

                                    @foreach ($detailTransactionHostel as $transaction)
                                        <tr>
                                            <td>{{ $transaction['created_at'] }}</td>
                                            <td>{{ $transaction['no_inv'] }}</td>
                                            <td>
                                                    <span class="badge badge-rounded badge-primary">
                                                        {{ strtoupper($transaction['service_name']) }}
                                                    </span>
                                            </td>
                                            <td>{{ $transaction['user'] }}</td>
                                            <td>{{ $transaction['transaction_name'] }} -
                                                {{ $transaction['transaction_desc'] }}</td>
                                            <td>{!! $transaction['payment_method'] ? str_replace('_', ' ', $transaction['payment_method']) : '-' !!}</td>
                                            <td>@currency($transaction['transaction_price'])</td>
                                            <td>@currency($transaction['fee'])</td>
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
                                        <th>Tanggal</th>
                                        <th>Invoice</th>
                                        <th>Produk</th>
                                        <th>Customer</th>
                                        <th>Deskripsi</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Grand Total</th>
                                        <th>Fee Admin</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{-- @foreach ($transactions as $key => $transaction) --}}
                                    @foreach ($detailTransactionPPOB as $transaction)
                                        <tr>
                                            <td>{{ $transaction['created_at'] }}</td>
                                            <td>{{ $transaction['no_inv'] }}</td>
                                            <td>
                                                    <span class="badge badge-rounded badge-primary">
                                                        {{ strtoupper($transaction['service_name']) }}
                                                    </span>
                                            </td>
                                            <td>{{ $transaction['user'] }}</td>
                                            <td>{{ $transaction['transaction_name'] }} -
                                                {{ $transaction['transaction_desc'] }}</td>
                                            <td>{!! $transaction['payment_method'] ? str_replace('_', ' ', $transaction['payment_method']) : '-' !!}</td>
                                            <td>@currency($transaction['transaction_price'])</td>
                                            <td>@currency($transaction['fee'])</td>
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade" id="kt_tab_pane_pulsa" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table-row-dashed display fs-6 gy-5 table-bordered table align-middle">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th>Tanggal</th>
                                        <th>Invoice</th>
                                        <th>Produk</th>
                                        <th>Customer</th>
                                        <th>Deskripsi</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Grand Total</th>
                                        <th>Fee Admin</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{-- @foreach ($transactions as $key => $transaction) --}}
                                    @foreach ($detailTransactionPulsa as $transaction)
                                        <tr>
                                            <td>{{ $transaction['created_at'] }}</td>
                                            <td>{{ $transaction['no_inv'] }}</td>
                                            <td>
                                                    <span class="badge badge-rounded badge-primary">
                                                        {{ strtoupper($transaction['service_name']) }}
                                                    </span>
                                            </td>
                                            <td>{{ $transaction['user'] }}</td>
                                            <td>{{ $transaction['transaction_name'] }} -
                                                {{ $transaction['transaction_desc'] }}</td>
                                            <td>{!! $transaction['payment_method'] ? str_replace('_', ' ', $transaction['payment_method']) : '-' !!}</td>
                                            <td>@currency($transaction['transaction_price'])</td>
                                            <td>@currency($transaction['fee'])</td>
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
        $(document).ready(function () {
            new DataTable('table.display', {
                order: [[1, 'desc']],
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
