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
                        <table class="table table-bordered gs-0 gy-4 text-center">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th style="width:15%">Created</th>
                                    <th style="width:20%">No Invoice</th>
                                    <th style="width:10%">Service</th>
                                    <th style="width:15%">Metode Pembayaran</th>
                                    <th style="width:15%">Channel Pembayaran</th>
                                    <th style="width:15%">Biaya Admin</th>
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
                                            <div class="text-dark   mb-1 fs-6">
                                                {{ \Carbon\Carbon::parse($transaction->created_at)->format('d M y h:m') }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-dark   mb-1 fs-6">{{ $transaction->no_inv }}</div>
                                        </td>
                                        <td>
                                            <span class="badge badge-rounded badge-primary">
                                                {{ strtoupper($transaction->service) }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="text-dark   d-block mb-1 fs-6">
                                                {{ $transaction->payment_method ?? '-' }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="text-dark   d-block mb-1 fs-6">
                                                {{ $transaction->payment_channel ?? '-' }}
                                            </div>
                                        </td>
                                        <td>
                                            Rp. {{ number_format($biayaAdmin, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            Rp. {{ number_format($transaction->total, 0, ',', '.') }}
                                        </td>
                                        <td>
                                            <div class="text-dark   d-block mb-1 fs-6">

                                                @if ($transaction->status == 'PAID')
                                                    <span class="badge badge-rounded badge-success">Sukses</span>
                                                @elseif($transaction->status == 'PENDING')
                                                    <span class="badge badge-rounded badge-warning">Pending</span>
                                                @else
                                                    <span class="badge badge-rounded badge-danger">Gagal</span>
                                                @endif
                                            </div>
                                        </td>
                                        {{--                                <td class="text-end"> --}}
                                        {{--                                    <a href="{{route('admin.transaction.detail',$transaction->id)}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit" --}}
                                        {{--                                        data-id="{{$transaction->id}}"> --}}
                                        {{--                                        <i class="ki-duotone ki-pencil fs-2"> --}}
                                        {{--                                            <span class="path1"></span> --}}
                                        {{--                                            <span class="path2"></span> --}}
                                        {{--                                        </i> --}}
                                        {{--                                    </a> --}}
                                        {{--                                </td> --}}
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

    {{-- modal --}}
    <!--begin::Modal - New Target-->
    {{-- <div class="modal fade" id="create" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content rounded">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form id="kt_modal_new_target_form" method="post" action="{{route('admin.transaction.store')}}">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Create Transaction</h1>
                            <!--end::Title-->
                            <!--begin::Description-->
                            <div class="text-muted fw-semibold fs-5">Create Transaction Hostel</div>
                            <!--end::Description-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Hostel</label>
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Hostel" name="hostel_id" id="hostel_id">
                                    <option value="">Select hostel...</option>
                                    @foreach ($hostels as $hostel)
                                    <option value="{{$hostel->id}}">{{$hostel->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Room</label>
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Room" name="hostel_room_id" id="hostel_room_id">
                                    <option id="hostel_room_0" value="">Select hostel...</option>

                                </select>
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Payment</label>
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Payment" name="payment_method">
                                    <option value="">Select user...</option>
                                    <option value="CASH">Cash</option>
                                    <option value="EWALLET">E-Wallet</option>
                                    <option value="DEBIT">Debit</option>
                                    <option value="BANK_TRANSFER">Transfer</option>
                                </select>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="fs-6 fw-semibold mb-2">Channel</label>
                                <!--begin::Input-->
                                    <!--begin::Text-->
                                    <input type="text" class="form-control form-control-solid" placeholder="Channel" name="payment_channel"/>
                                    <!--end::Text-->
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Date</label>
                                <!--begin::Input-->
                                    <!--begin::Text-->
                                    <input type="text" name="date" class="form-control form-control-solid js-daterangepicker">
                                    <!--end::Text-->
                                <!--end::Input-->
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Guest</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <!--begin::Input-->
                                            <input type="text" name="name" class="form-control form-control-solid" placeholder="Name Guest">
                                        <!--end::Input-->
                                        @error('name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <!--begin::Input-->
                                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Select Identity" name="type_id">
                                            <option value="">Select user...</option>
                                            <option value="KTP">KTP</option>
                                            <option value="SIM">SIM</option>
                                            <option value="NPWP">NPWP</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <div class="col-md-4">
                                        <!--begin::Input-->
                                        <input type="text" name="identity" class="form-control form-control-solid"  placeholder="No. id">
                                        <!--end::Input-->
                                        @error('identity')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end:Form-->
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div> --}}
    <!--end::Modal - New Target-->
@endsection
@push('add-script')
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
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
