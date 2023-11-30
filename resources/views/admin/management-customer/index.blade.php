@extends('admin.layout', ['title' => 'Customer', 'url' => route('admin.customer')])

@section('content-admin')
    <!--begin::Tables Widget 11-->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">List Customer</span>
            </h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <!--begin::Table-->
                <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle" id="kt_datatable_zero_configuration">
                    <!--begin::Table head-->
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th class="ps-4 rounded-start">No</th>
                            <th class="min-w-125px">Email</th>
                            <th class="min-w-125px">Nama</th>
                            <th class="min-w-125px">Nomor Telfon</th>
                            <th class="min-w-80px">Point</th>
                            <th class="min-w-125px">Jumlah Transaksi</th>
                            <th class="min-w-150px">Total Transaksi</th>
                            <th class="min-w-125px">Aksi</th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody>
                        @foreach ($customers as $customer)
                            @php

                                // $detailTransactionPPOB = DB::table('detail_transaction_ppob')
                                //     ->join('transactions', 'transactions.id', '=', 'detail_transaction_ppob.transaction_id')
                                //     ->whereIn('transactions.id', $customer->transaction->pluck('id'))
                                //     ->where('detail_transaction_ppob.status', 'SUCCESS')
                                //     ->sum('total_tagihan');

                                // $detailTransactionTopUp = DB::table('detail_transaction_top_up')
                                //     ->join('transactions', 'transactions.id', '=', 'detail_transaction_top_up.transaction_id')
                                //     ->whereIn('transactions.id', $customer->transaction->pluck('id'))
                                //     ->where('detail_transaction_top_up.status', 'SUCCESS')
                                //     ->sum('total_tagihan');

                                // $detailTransactionhotel = DB::table('detail_transaction_hotel')
                                //     ->join('transactions', 'transactions.id', '=', 'detail_transaction_hotel.transaction_id')
                                //     ->whereIn('transactions.id', $customer->transaction->pluck('id'))
                                //     ->sum('rent_price');

                                // $detailTransactionhostel = DB::table('detail_transaction_hostel')
                                //     ->join('transactions', 'transactions.id', '=', 'detail_transaction_hostel.transaction_id')
                                //     ->whereIn('transactions.id', $customer->transaction->pluck('id'))
                                //     ->sum('rent_price');
                                //     $totaltr =  $detailTransactionPPOB + $detailTransactionTopUp + $detailTransactionhotel + $detailTransactionhostel;

                                $totalTransaction = DB::table('transactions')
                                ->where('transactions.user_id', $customer->id)
                                ->sum('total');
                            @endphp
                            <tr>
                                <td>
                                    <div class=" mb-1 fs-6">{{ $loop->iteration }}</div>
                                </td>
                                <td>
                                    <div class=" mb-1 fs-6">{{ $customer->email }}</div>
                                </td>
                                <td>
                                    <div class=" d-block mb-1 fs-6">{{ $customer->name }}</div>
                                </td>
                                <td>
                                    <div class=" d-block mb-1 fs-6">
                                        {{ $customer->phone ?? 'TIDAK ADA NO TELP' }}</div>
                                </td>
                                <td>
                                    <div class=" d-block mb-1 fs-6">{{ $customer->point }}</div>
                                </td>
                                <td>
                                    <div class=" d-block mb-1 fs-6">{{ $customer->transaction->count() }}
                                    </div>
                                </td>
                                <td>
                                    <div class=" d-block mb-1 fs-6">@currency($totalTransaction)</div>
                                </td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#history"
                                        onclick="showDetailTransactions({{ $customer->id }})">History Transaksi</button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    <!--end::Table body-->
                </table>
                {{ $customers->appends(request()->input())->links('vendor.pagination.bootstrap-5') }}
                <!--end::Table-->
            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
    </div>
    <!--end::Tables Widget 11-->
    @include('admin.management-customer.show')


    {{-- modal --}}
    <!--begin::Modal - New Target-->

    <!--end::Modal - New Target-->


    <!--begin::Modal - New Target-->
    <div class="modal fade" id="edit" tabindex="-1" aria-hidden="true">
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
                    <form id="kt_modal_new_target_form" class="form" action="#">
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Edit Form</h1>
                            <!--end::Title-->
                            <!--begin::Description-->
                            <div class="text-muted fw-semibold fs-5">If you need more info, please check
                                <a href="#" class="fw-bold link-primary">Project Guidelines</a>.
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Target Title</span>
                                <span class="ms-1" data-bs-toggle="tooltip"
                                    title="Specify a target name for future usage and reference">
                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid" placeholder="Enter Target Title"
                                name="target_title" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Assign</label>
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                    data-placeholder="Select a Team Member" name="target_assign">
                                    <option value="">Select user...</option>
                                    <option value="1">Karina Clark</option>
                                    <option value="2">Robert Doe</option>
                                    <option value="3">Niel Owen</option>
                                    <option value="4">Olivia Wild</option>
                                    <option value="5">Sean Bean</option>
                                </select>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Due Date</label>
                                <!--begin::Input-->
                                <div class="position-relative d-flex align-items-center">
                                    <!--begin::Icon-->
                                    <i class="ki-duotone ki-calendar-8 fs-2 position-absolute mx-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                    </i>
                                    <!--end::Icon-->
                                    <!--begin::Datepicker-->
                                    <input class="form-control form-control-solid ps-12" placeholder="Select a date"
                                        name="due_date" />
                                    <!--end::Datepicker-->
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8">
                            <label class="fs-6 fw-semibold mb-2">Target Details</label>
                            <textarea class="form-control form-control-solid" rows="3" name="target_details"
                                placeholder="Type Target Details"></textarea>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Tags</span>
                                <span class="ms-1" data-bs-toggle="tooltip" title="Specify a target priorty">
                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <input class="form-control form-control-solid" value="Important, Urgent" name="tags" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-stack mb-8">
                            <!--begin::Label-->
                            <div class="me-5">
                                <label class="fs-6 fw-semibold">Adding Users by Team Members</label>
                                <div class="fs-7 fw-semibold text-muted">If you need more info, please check budget
                                    planning
                                </div>
                            </div>
                            <!--end::Label-->
                            <!--begin::Switch-->
                            <label class="form-check form-switch form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="1" checked="checked" />
                                <span class="form-check-label fw-semibold text-muted">Allowed</span>
                            </label>
                            <!--end::Switch-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="mb-15 fv-row">
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack">
                                <!--begin::Label-->
                                <div class="fw-semibold me-5">
                                    <label class="fs-6">Notifications</label>
                                    <div class="fs-7 text-muted">Allow Notifications by Phone or Email</div>
                                </div>
                                <!--end::Label-->
                                <!--begin::Checkboxes-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid me-10">
                                        <input class="form-check-input h-20px w-20px" type="checkbox"
                                            name="communication[]" value="email" checked="checked" />
                                        <span class="form-check-label fw-semibold">Email</span>
                                    </label>
                                    <!--end::Checkbox-->
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid">
                                        <input class="form-check-input h-20px w-20px" type="checkbox"
                                            name="communication[]" value="phone" />
                                        <span class="form-check-label fw-semibold">Phone</span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Checkboxes-->
                            </div>
                            <!--end::Wrapper-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel
                            </button>
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
    </div>
    <!--end::Modal - New Target-->
@endsection
@push('add-script')
    <script>
        $(document).ready( function () {
            $('.table').DataTable({
                "scrollY": "500px",
                "scrollCollapse": true,
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom":
                    "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">"
            });
        } );
    </script>
@endpush
