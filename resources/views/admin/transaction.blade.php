@extends('admin.layout', ['title' => 'Transaction', 'url' => route('admin.transaction')])

@section('content-admin')
    <!--begin::Form-->
    <form action="#" method="get">
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Compact form-->
                <!--begin::Row-->
                <div class="row">
                    <!--begin::Col-->

                    {{-- ERROR --}}

                    {{-- @if (isset($services) && auth()->user()->role == 0) --}}
                    <div class="col-4">
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


                    <div class="col-3">
                        <!--begin::Label-->
                        <label for="start" class="form-label">Tanggal Awal</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="date" class="form-control" id="start" name="start"
                            value="{{ isset($_GET['start']) ? $_GET['start'] : '' }}">
                        <!--end::Input-->
                    </div>
                    <div class="col-3">
                        <!--begin::Label-->
                        <label for="end" class="form-label">Tanggal Akhir</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="date" class="form-control" id="end" name="end"
                            value="{{ isset($_GET['end']) ? $_GET['end'] : '' }}">
                        <!--end::Input-->
                    </div>
                    {{-- <div class="col-lg-3">
                        <!--begin::Input-->
                        <input type="date" class="form-control" data-placeholder="Tanggal Awal" name="end" value="{{isset($_GET['end']) ? $_GET['end'] : ''}}">
                        <!--end::Input-->
                    </div> --}}
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-2">
                        <label class="form-label" style="width: 100%; display: inline-block;">&nbsp;</label>

                        <button type="submit" id="cari" class="btn btn-primary">Cari Data</button>

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
    <!--begin::Toolbar-->
    <div class="d-flex flex-wrap flex-stack pb-7">
        <!--begin::Title-->
        <div class="d-flex flex-wrap align-items-center my-1">
            <h3 class="fw-bold me-5 my-1">{{ $transactions->count() }} Transaction Found
                <span class="text-gray-400 fs-6">by Recent Updates ↓</span>
            </h3>
        </div>
        <!--end::Title-->
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
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-bordered gs-0 gy-4 text-center" style="font-size: 11px;">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bold text-center text-gray-800">
                                    <th style="width:15%">Waktu</th>
                                    <th style="width:15%">Invoice</th>
                                    <th style="width:10%">Service</th>
                                    <th style="width:10%">Metode Pembayaran</th>
                                    <th style="width:15%">Harga</th>
                                    <th style="width:15%">Biaya Layanan</th>
                                    <th style="width:15%">Potongan Point</th>
                                    <th style="width:15%">Grand Total</th>
                                    <th style="width:10%">Status</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @foreach ($transactions as $transaction)
                                    @php
                                        $biayaAdmin = $transaction->hotel_fee ?? ($transaction->hostel_fee ?? ($transaction->ppob_fee ?? $transaction->topup_fee));
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="text-dark mb-1 ">
                                                {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M y h:m') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-dark mb-1 ">{{ $transaction->no_inv }}</div>
                                        </td>
                                        <td>
                                            <span class="badge badge-rounded badge-primary">
                                                {{ strtoupper($transaction->service) ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="text-dark d-block mb-1 ">
                                                {{ $transaction->payment_method ." - ". $transaction->payment_channel?? '-' }}
                                            </div>
                                        </td>
                                        <td>
                                            @if (in_array($transaction->service_id, [3, 4, 5, 6, 9, 10]))
                                                @currency($transaction->total - ($transaction->detailTransactionPPOB->first()->fee_travelsya ?? 0) - ($transaction->detailTransactionPPOB->first()->kode_unik ?? 0) )
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
                                            Rp. {{ number_format($transaction->historyPoint->first()->point ?? 0, 0, ',', '.') }}
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

@endsection
@push('add-script')
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "scrollY": "500px",
                "scrollCollapse": true,
                "order" : [],
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
