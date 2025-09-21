@extends('admin.layout', ['title' => 'Transaction', 'url' => route('admin.transaction')])
@push('add-style')
    <style>

.select2-container .select2-selection--single {
    box-sizing: border-box;
    cursor: pointer;
    display: block;
    height: 46px;
    user-select: none;
    -webkit-user-select: none;
}
    </style>
@endpush
@section('content-admin')
    <!--begin::Form-->
    <form action="#" method="get">
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Compact form-->
                <!--begin::Row-->
                <div class="row g-3">
                    <!--begin::Col-->
                    {{-- ERROR --}}
                    {{-- @if (isset($services) && auth()->user()->role == 0) --}}
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <!--begin::Select-->
                        <label for="service" class="form-label">Layanan</label>
                        <select class="form-select form-select-solid" data-control="select2" id="service"
                            data-placeholder="Layanan" data-hide-search="true" name="service">
                            <option value=""></option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ isset($_GET['service']) && $service->id == $_GET['service'] ? 'selected' : '' }}>
                                    {{ ucfirst($service->name) }}</option>
                            @endforeach
                        </select>
                        <!--end::Select-->
                    </div>
                    {{-- @endif --}}

                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <!--begin::Label-->
                        <label for="start" class="form-label">Tanggal Awal</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="date" class="form-control" id="start" name="start"
                            value="{{ isset($_GET['start']) ? $_GET['start'] : '' }}">
                        <!--end::Input-->
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <!--begin::Label-->
                        <label for="end" class="form-label">Tanggal Akhir</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="date" class="form-control" id="end" name="end"
                            value="{{ isset($_GET['end']) ? $_GET['end'] : '' }}">
                        <!--end::Input-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-12 col-sm-6 col-md-12 col-lg-3 d-flex align-items-end">
                        <button type="submit" id="cari" class="btn btn-primary w-100">Cari Data</button>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </form>
    <!--end::Form-->

    <!--begin::Summary Card-->
    <div class="card mb-7">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card bg-light-primary">
                        <div class="card-body text-center">
                            <div class="text-primary fs-2 fw-bold" id="totalHarga">
                                @php
                                    $totalHarga = 0;
                                    foreach ($transactions as $transaction) {
                                        if (in_array($transaction->service_id, [3, 4, 5, 6, 9, 10])) {
                                            $totalHarga +=
                                                $transaction->total -
                                                ($transaction->detailTransactionPPOB->first()->fee_travelsya ?? 0) -
                                                ($transaction->detailTransactionPPOB->first()->kode_unik ?? 0);
                                        } elseif (in_array($transaction->service_id, [1, 2, 11, 12])) {
                                            $totalHarga +=
                                                $transaction->total -
                                                ($transaction->detailTransactionTopUp->first()->fee_travelsya ?? 0) -
                                                ($transaction->detailTransactionTopUp->first()->kode_unik ?? 0);
                                        } elseif ($transaction->service_id == 8) {
                                            $totalHarga +=
                                                $transaction->total -
                                                ($transaction->detailTransactionHotel->first()->fee_admin ?? 0) -
                                                ($transaction->detailTransactionHotel->first()->kode_unik ?? 0);
                                        } elseif ($transaction->service_id == 7) {
                                            $totalHarga +=
                                                $transaction->total -
                                                ($transaction->detailTransactionHostel->first()->fee_admin ?? 0) -
                                                ($transaction->detailTransactionHostel->first()->kode_unik ?? 0);
                                        }
                                    }
                                @endphp
                                Rp. {{ number_format($totalHarga, 0, ',', '.') }}
                            </div>
                            <div class="text-primary fs-6 fw-semibold">Total Harga</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card bg-light-success">
                        <div class="card-body text-center">
                            <div class="text-success fs-2 fw-bold" id="totalBiayaLayanan">
                                @php
                                    $totalBiayaLayanan = 0;
                                    foreach ($transactions as $transaction) {
                                        if (in_array($transaction->service_id, [3, 4, 5, 6, 9, 10])) {
                                            $totalBiayaLayanan +=
                                                ($transaction->detailTransactionPPOB->first()->fee_travelsya ?? 0) +
                                                ($transaction->detailTransactionPPOB->first()->kode_unik ?? 0);
                                        } elseif (in_array($transaction->service_id, [1, 2, 11, 12])) {
                                            $totalBiayaLayanan +=
                                                ($transaction->detailTransactionTopUp->first()->fee_travelsya ?? 0) +
                                                ($transaction->detailTransactionTopUp->first()->kode_unik ?? 0);
                                        } elseif ($transaction->service_id == 8) {
                                            $totalBiayaLayanan +=
                                                ($transaction->detailTransactionHotel->first()->fee_admin ?? 0) +
                                                ($transaction->detailTransactionHotel->first()->kode_unik ?? 0);
                                        } elseif ($transaction->service_id == 7) {
                                            $totalBiayaLayanan +=
                                                ($transaction->detailTransactionHostel->first()->fee_admin ?? 0) +
                                                ($transaction->detailTransactionHostel->first()->kode_unik ?? 0);
                                        }
                                    }
                                @endphp
                                Rp. {{ number_format($totalBiayaLayanan, 0, ',', '.') }}
                            </div>
                            <div class="text-success fs-6 fw-semibold">Total Biaya Layanan</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card bg-light-danger">
                        <div class="card-body text-center">
                            <div class="text-danger fs-2 fw-bold" id="totalPotonganPoint">
                                @php
                                    $totalPotonganPoint = 0;
                                    foreach ($transactions as $transaction) {
                                        $totalPotonganPoint += $transaction->historyPoint->first()->point ?? 0;
                                    }
                                @endphp
                                Rp. {{ number_format($totalPotonganPoint, 0, ',', '.') }}
                            </div>
                            <div class="text-danger fs-6 fw-semibold">Total Potongan Point</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card bg-light-info">
                        <div class="card-body text-center">
                            <div class="text-info fs-2 fw-bold" id="totalGrandTotal">
                                @php
                                    $totalGrandTotal = 0;
                                    foreach ($transactions as $transaction) {
                                        $totalGrandTotal += $transaction->total;
                                    }
                                @endphp
                                Rp. {{ number_format($totalGrandTotal, 0, ',', '.') }}
                            </div>
                            <div class="text-info fs-6 fw-semibold">Grand Total</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Summary Card-->

    <!--begin::Toolbar-->
    <div class="d-flex flex-wrap flex-stack pb-7">
        <!--begin::Title-->
        <div class="d-flex flex-wrap align-items-center my-1">
            <h3 class="fw-bold me-5 my-1">{{ $transactions->count() }} Transaction Found
                <span class="text-gray-400 fs-6">by Recent Updates ↓</span>
            </h3>
        </div>
        <!--end::Title-->
        <!--begin::Controls-->
        <div class="d-flex flex-wrap my-1">
            <!--begin::Export Buttons-->
            <div id="exportButtons" class="d-flex my-0"></div>
            <!--end::Export Buttons-->
        </div>
        <!--end::Controls-->
        {{-- <!--begin::Controls-->
        <div class="d-flex flex-wrap my-1">
            <!--begin::Tab nav-->
            <ul class="nav nav-pills me-6 mb-2 mb-sm-0">

                <li class="nav-item m-0">
                    <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary active" data-bs-toggle="tab"
                        href="#kt_project_users_table_pane">
                        <i class="ki-duotone ki-row-horizontal fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </a>
                </li>
            </ul>
            <!--end::Tab nav-->
            <!--begin::Actions-->
            <div class="d-flex my-0">
                <!--begin::Select-->
                <select name="status" data-control="select2" data-hide-search="true" data-placeholder="Filter"
                    class="form-select form-select-sm border-body bg-body w-150px me-5">
                    <option value="1">Recently Updated</option>
                    <option value="2">Last Month</option>
                    <option value="3">Last Quarter</option>
                    <option value="4">Last Year</option>
                </select>
                <!--end::Select-->
                <!--begin::Select-->
                <select name="status" data-control="select2" data-hide-search="true" data-placeholder="Export"
                    class="form-select form-select-sm border-body bg-body w-100px">
                    <option value="1">Excel</option>
                    <option value="1">PDF</option>
                    <option value="2">Print</option>
                </select>
                <!--end::Select-->
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Controls--> --}}
    </div>
    <!--end::Toolbar-->
    <!--begin::Tab Content-->
    <div class="tab-content">
        <!--begin::Tab pane-->
        <div id="kt_project_users_table_pane" class="tab-pane fade show active">
            <!--begin::Tables Widget 11-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">List Transaction</span>
                    </h3>
                    {{-- <div class="card-toolbar">
                        <a class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#create">
                        <i class="ki-duotone ki-plus fs-2"></i>New Transaction</a>
                    </div> --}}
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive" style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
                        <!--begin::Table-->
                        <table class="table table-bordered gs-0 gy-4 text-center"
                            style="font-size: 11px; min-width: 1200px;">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bold text-center text-gray-800">
                                    <th style="min-width: 120px; text-align: center;">Waktu</th>
                                    <th style="min-width: 120px; text-align: center;">Invoice</th>
                                    <th style="min-width: 80px; text-align: center;">Service</th>
                                    <th style="min-width: 100px; text-align: center;">Metode Pembayaran</th>
                                    <th style="min-width: 120px; text-align: center;">Harga</th>
                                    <th style="min-width: 120px; text-align: center;">Biaya Layanan</th>
                                    <th style="min-width: 120px; text-align: center;">Potongan Point</th>
                                    <th style="min-width: 120px; text-align: center;">Grand Total</th>
                                    <th style="min-width: 80px; text-align: center;">Status</th>
                                    <th style="min-width: 100px; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    @php
                                        $biayaAdmin =
                                            $transaction->hotel_fee ??
                                            ($transaction->hostel_fee ??
                                                ($transaction->ppob_fee ?? $transaction->topup_fee));
                                    @endphp
                                    <tr>
                                        <td style="white-space: nowrap;">
                                            <div class="text-dark mb-1">
                                                {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M y h:m') }}
                                            </div>
                                        </td>
                                        <td style="white-space: nowrap;">
                                            <div class="text-dark mb-1">{{ $transaction->no_inv }}</div>
                                        </td>
                                        <td>
                                            <span class="badge badge-rounded badge-primary" style="font-size: 10px;">
                                                {{ strtoupper($transaction->service) ?? '-' }}
                                            </span>
                                        </td>
                                        <td style="white-space: nowrap;">
                                            <div class="text-dark d-block mb-1">
                                                {{ $transaction->payment_method . ' - ' . $transaction->payment_channel ?? '-' }}
                                            </div>
                                        </td>
                                        <td>
                                            @if (in_array($transaction->service_id, [3, 4, 5, 6, 9, 10]))
                                                @currency($transaction->total - ($transaction->detailTransactionPPOB->first()->fee_travelsya ?? 0) - ($transaction->detailTransactionPPOB->first()->kode_unik ?? 0))
                                            @elseif(in_array($transaction->service_id, [1, 2, 11, 12]))
                                                @currency($transaction->total - ($transaction->detailTransactionTopUp->first()->fee_travelsya ?? 0) - ($transaction->detailTransactionTopUp->first()->kode_unik ?? 0))
                                            @elseif($transaction->service_id == 8)
                                                @currency($transaction->total - ($transaction->detailTransactionHotel->first()->fee_admin ?? 0) - ($transaction->detailTransactionHotel->first()->kode_unik ?? 0))
                                            @elseif($transaction->service_id == 7)
                                                @currency($transaction->total - ($transaction->detailTransactionHostel->first()->fee_admin ?? 0) - ($transaction->detailTransactionHostel->first()->kode_unik ?? 0))
                                            @endif
                                        </td>
                                        <td class="text-success fw-bold">
                                            @if (in_array($transaction->service_id, [3, 4, 5, 6, 9, 10]))
                                                @currency(($transaction->detailTransactionPPOB->first()->fee_travelsya ?? 0) + ($transaction->detailTransactionPPOB->first()->kode_unik ?? 0))
                                            @elseif(in_array($transaction->service_id, [1, 2, 11, 12]))
                                                @currency(($transaction->detailTransactionTopUp->first()->fee_travelsya ?? 0) + ($transaction->detailTransactionTopUp->first()->kode_unik ?? 0))
                                            @elseif($transaction->service_id == 8)
                                                @currency(($transaction->detailTransactionHotel->first()->fee_admin ?? 0) + ($transaction->detailTransactionHotel->first()->kode_unik ?? 0))
                                            @elseif($transaction->service_id == 7)
                                                @currency(($transaction->detailTransactionHostel->first()->fee_admin ?? 0) + ($transaction->detailTransactionHostel->first()->kode_unik ?? 0))
                                            @endif
                                        </td>
                                        <td class="text-danger fw-bold">
                                            Rp.
                                            {{ number_format($transaction->historyPoint->first()->point ?? 0, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            Rp. {{ number_format($transaction->total, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <div class="text-dark d-block mb-1 ">

                                                @if ($transaction->status == 'PAID')
                                                    <span class="badge badge-rounded badge-success">Sukses</span>
                                                @elseif($transaction->status == 'PENDING')
                                                    <span class="badge badge-rounded badge-warning">Pending</span>
                                                @else
                                                    <span class="badge badge-rounded badge-danger">Gagal</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#transactionDetailModal"
                                                onclick="viewTransactionDetail({{ $transaction->id }})">
                                                <i class="ki-duotone ki-eye fs-5">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                                Detail
                                            </button>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        {{--                        {{$transactions->appends(request()->input())->links('vendor.pagination.bootstrap-5')}} --}}
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>
            <!--end::Tables Widget 11-->

        </div>
        <!--end::Tab pane-->
    </div>
    <!--end::Tab Content-->

    <!--begin::Transaction Detail Modal-->
    <div class="modal fade" id="transactionDetailModal" tabindex="-1" aria-labelledby="transactionDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="transactionDetailModalLabel">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card bg-light-primary">
                                <div class="card-body">
                                    <h6 class="card-title text-primary">Informasi Transaksi</h6>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Waktu:</label>
                                        <p class="mb-0" id="modal-waktu">-</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Invoice:</label>
                                        <p class="mb-0" id="modal-invoice">-</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Service:</label>
                                        <p class="mb-0" id="modal-service">-</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Metode Pembayaran:</label>
                                        <p class="mb-0" id="modal-payment">-</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Status:</label>
                                        <p class="mb-0" id="modal-status">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card bg-light-info">
                                <div class="card-body">
                                    <h6 class="card-title text-info">Informasi Customer</h6>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Nama:</label>
                                        <p class="mb-0" id="modal-user-name">-</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Email:</label>
                                        <p class="mb-0" id="modal-user-email">-</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Phone:</label>
                                        <p class="mb-0" id="modal-user-phone">-</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card bg-light-success">
                                <div class="card-body">
                                    <h6 class="card-title text-success">Rincian Keuangan</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Harga:</label>
                                                <p class="mb-0 text-primary" id="modal-harga">-</p>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Biaya Layanan:</label>
                                                <p class="mb-0 text-success" id="modal-biaya-layanan">-</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Potongan Point:</label>
                                                <p class="mb-0 text-danger" id="modal-potongan-point">-</p>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Grand Total:</label>
                                                <p class="mb-0 text-info fw-bold fs-5" id="modal-grand-total">-</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="downloadPdfBtn" onclick="downloadPdf()">
                        <i class="ki-duotone ki-file-down fs-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        Download PDF
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Transaction Detail Modal-->
@endsection
@push('add-script')
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <!-- DataTables Buttons JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('.table').DataTable({
                "scrollY": "500px",
                "scrollCollapse": true,
                "order": [],
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
                    ">",
                "buttons": [{
                    extend: 'excel',
                    text: 'Export Excel',
                    className: 'btn btn-success btn-sm',
                    title: 'Transaction Data'
                }]
            });

            // Add export buttons to the toolbar
            table.buttons().container().appendTo('#exportButtons');

            // Function to update summary totals based on visible rows
            function updateSummaryTotals() {
                var totalHarga = 0;
                var totalBiayaLayanan = 0;
                var totalPotonganPoint = 0;
                var totalGrandTotal = 0;

                // Get all visible rows (after filtering)
                table.rows({
                    page: 'current'
                }).every(function() {
                    var data = this.data();

                    // Extract values from the table row data
                    // Assuming the data structure matches the table columns
                    var hargaText = $(data[4]).text().replace(/[^\d]/g, '');
                    var biayaLayananText = $(data[5]).text().replace(/[^\d]/g, '');
                    var potonganPointText = $(data[6]).text().replace(/[^\d]/g, '');
                    var grandTotalText = $(data[7]).text().replace(/[^\d]/g, '');

                    totalHarga += parseInt(hargaText) || 0;
                    totalBiayaLayanan += parseInt(biayaLayananText) || 0;
                    totalPotonganPoint += parseInt(potonganPointText) || 0;
                    totalGrandTotal += parseInt(grandTotalText) || 0;
                });

                // Update the summary cards
                $('#totalHarga').text('Rp. ' + totalHarga.toLocaleString('id-ID'));
                $('#totalBiayaLayanan').text('Rp. ' + totalBiayaLayanan.toLocaleString('id-ID'));
                $('#totalPotonganPoint').text('Rp. ' + totalPotonganPoint.toLocaleString('id-ID'));
                $('#totalGrandTotal').text('Rp. ' + totalGrandTotal.toLocaleString('id-ID'));
            }

            // Update totals when table is drawn (after filtering, searching, etc.)
            table.on('draw', function() {
                updateSummaryTotals();
            });

            // Update totals when search is performed
            table.on('search.dt', function() {
                setTimeout(updateSummaryTotals, 100);
            });

            // Update totals when page changes
            table.on('page.dt', function() {
                setTimeout(updateSummaryTotals, 100);
            });

            // Initial update
            updateSummaryTotals();

            // Update totals when form is submitted (filter applied)
            $('form').on('submit', function() {
                setTimeout(function() {
                    // Wait for page reload and then update totals
                    setTimeout(updateSummaryTotals, 500);
                }, 100);
            });
        });

        // Global variable to store current transaction ID
        let currentTransactionId = null;

        // Function to view transaction detail
        function viewTransactionDetail(transactionId) {
            currentTransactionId = transactionId;

            // Show loading state
            $('#transactionDetailModal .modal-body').html(
                '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                );

            // Fetch transaction detail via AJAX
            $.ajax({
                url: '/admin/transaction/detail/' + transactionId,
                method: 'GET',
                success: function(response) {
                    // Parse the response and populate modal
                    populateModal(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching transaction detail:', error);
                    $('#transactionDetailModal .modal-body').html(
                        '<div class="alert alert-danger">Error loading transaction details.</div>');
                }
            });
        }

        // Function to populate modal with transaction data
        function populateModal(transaction) {
            // Restore modal body content
            $('#transactionDetailModal .modal-body').html(`
                <div class="row">
                    <div class="col-md-6">
                        <div class="card bg-light-primary">
                            <div class="card-body">
                                <h6 class="card-title text-primary">Informasi Transaksi</h6>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Waktu:</label>
                                    <p class="mb-0" id="modal-waktu">-</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Invoice:</label>
                                    <p class="mb-0" id="modal-invoice">-</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Service:</label>
                                    <p class="mb-0" id="modal-service">-</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Metode Pembayaran:</label>
                                    <p class="mb-0" id="modal-payment">-</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Status:</label>
                                    <p class="mb-0" id="modal-status">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-light-info">
                            <div class="card-body">
                                <h6 class="card-title text-info">Informasi Customer</h6>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Nama:</label>
                                    <p class="mb-0" id="modal-user-name">-</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Email:</label>
                                    <p class="mb-0" id="modal-user-email">-</p>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Phone:</label>
                                    <p class="mb-0" id="modal-user-phone">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card bg-light-success">
                            <div class="card-body">
                                <h6 class="card-title text-success">Rincian Keuangan</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Harga:</label>
                                            <p class="mb-0 text-primary" id="modal-harga">-</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Biaya Layanan:</label>
                                            <p class="mb-0 text-success" id="modal-biaya-layanan">-</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Potongan Point:</label>
                                            <p class="mb-0 text-danger" id="modal-potongan-point">-</p>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Grand Total:</label>
                                            <p class="mb-0 text-info fw-bold fs-5" id="modal-grand-total">-</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `);

            // Populate the data
            $('#modal-waktu').text(transaction.waktu || '-');
            $('#modal-invoice').text(transaction.invoice || '-');
            $('#modal-service').text(transaction.service || '-');
            $('#modal-payment').text(transaction.payment || '-');
            $('#modal-status').html(transaction.status || '-');
            $('#modal-user-name').text(transaction.user_name || '-');
            $('#modal-user-email').text(transaction.user_email || '-');
            $('#modal-user-phone').text(transaction.user_phone || '-');
            $('#modal-harga').text(transaction.harga || '-');
            $('#modal-biaya-layanan').text(transaction.biaya_layanan || '-');
            $('#modal-potongan-point').text(transaction.potongan_point || '-');
            $('#modal-grand-total').text(transaction.grand_total || '-');
        }

        // Function to download PDF
        function downloadPdf() {
            if (currentTransactionId) {
                // Open PDF in new window and trigger print
                const printWindow = window.open('/admin/transaction/pdf/' + currentTransactionId, '_blank');

                // Wait for the window to load then trigger print
                printWindow.onload = function() {
                    setTimeout(() => {
                        printWindow.print();
                        // Close the window after printing (optional)
                        // printWindow.close();
                    }, 1000);
                };

                // Fallback: if onload doesn't work, try after a delay
                setTimeout(() => {
                    try {
                        printWindow.print();
                    } catch (e) {
                        console.log('Print dialog could not be opened automatically');
                    }
                }, 2000);
            }
        }
    </script>
@endpush
