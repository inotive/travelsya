@extends('admin.layout',['title' => 'Transaction'])

@section('content-admin')

<!--begin::Form-->
<form action="#">
    <!--begin::Card-->
    <div class="card mb-7">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Compact form-->
            <div class="d-flex align-items-center">
                <!--begin::Input group-->
                <!--begin::Col-->
                <div class="col-xxl-8">
                    <!--begin::Row-->
                    <div class="row g-8">
                        <!--begin::Col-->
                        <div class="col-lg-3">
                            <!--begin::Select-->
                            <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Layanan" data-hide-search="true">
                                <option value=""></option>
                                <option value="1">Pulsa</option>
                                <option value="2">Data</option>
                                <option value="3">PLN</option>
                            </select>
                            <!--end::Select-->

                        </div>
                        <div class="col-lg-3">
                            <!--begin::Input-->
                            <input type="date" class="form-control" data-placeholder="Tanggal Awal" name="start">
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                        <div class="col-lg-3">
                            <!--begin::Input-->
                            <input type="date" class="form-control" data-placeholder="Tanggal Awal" name="end">
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-lg-3">
                            <button type="submit" class="btn btn-primary">Cari Data</button>

                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Compact form-->
            <!--begin::Advance form-->
            <div class="collapse" id="kt_advanced_search_form">
                <!--begin::Separator-->
                <div class="separator separator-dashed mt-9 mb-6"></div>
                <!--end::Separator-->
                <!--begin::Row-->
                <div class="row g-8 mb-8">
                    <!--begin::Col-->
                    <div class="col-xxl-7">
                        <label class="fs-6 form-label fw-bold text-dark">Tags</label>
                        <input type="text" class="form-control form-control form-control-solid" name="tags"
                            value="products, users, events" />
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xxl-5">
                        <!--begin::Row-->
                        <div class="row g-8">
                            <!--begin::Col-->
                            <div class="col-lg-6">
                                <label class="fs-6 form-label fw-bold text-dark">Team Type</label>
                                <!--begin::Select-->
                                <select class="form-select form-select-solid" data-control="select2"
                                    data-placeholder="In Progress" data-hide-search="true">
                                    <option value=""></option>
                                    <option value="1">Not started</option>
                                    <option value="2" selected="selected">In Progress</option>
                                    <option value="3">Done</option>
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-6">
                                <label class="fs-6 form-label fw-bold text-dark">Select Group</label>
                                <!--begin::Radio group-->
                                <div class="nav-group nav-group-fluid">
                                    <!--begin::Option-->
                                    <label>
                                        <input type="radio" class="btn-check" name="type" value="has"
                                            checked="checked" />
                                        <span
                                            class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bold px-4">All</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label>
                                        <input type="radio" class="btn-check" name="type" value="users" />
                                        <span
                                            class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bold px-4">Users</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label>
                                        <input type="radio" class="btn-check" name="type" value="orders" />
                                        <span
                                            class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bold px-4">Orders</span>
                                    </label>
                                    <!--end::Option-->
                                </div>
                                <!--end::Radio group-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row g-8">
                    <!--begin::Col-->
                    <div class="col-xxl-7">
                        <!--begin::Row-->
                        <div class="row g-8">
                            <!--begin::Col-->
                            <div class="col-lg-4">
                                <label class="fs-6 form-label fw-bold text-dark">Min. Amount</label>
                                <!--begin::Dialer-->
                                <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="1000"
                                    data-kt-dialer-max="50000" data-kt-dialer-step="1000" data-kt-dialer-prefix="$"
                                    data-kt-dialer-decimals="2">
                                    <!--begin::Decrease control-->
                                    <button type="button"
                                        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                        data-kt-dialer-control="decrease">
                                        <i class="ki-duotone ki-minus-circle fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                    <!--end::Decrease control-->
                                    <!--begin::Input control-->
                                    <input type="text" class="form-control form-control-solid border-0 ps-12"
                                        data-kt-dialer-control="input" placeholder="Amount" name="manageBudget"
                                        readonly="readonly" value="$50" />
                                    <!--end::Input control-->
                                    <!--begin::Increase control-->
                                    <button type="button"
                                        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                        data-kt-dialer-control="increase">
                                        <i class="ki-duotone ki-plus-circle fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                    <!--end::Increase control-->
                                </div>
                                <!--end::Dialer-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-4">
                                <label class="fs-6 form-label fw-bold text-dark">Max. Amount</label>
                                <!--begin::Dialer-->
                                <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="1000"
                                    data-kt-dialer-max="50000" data-kt-dialer-step="1000" data-kt-dialer-prefix="$"
                                    data-kt-dialer-decimals="2">
                                    <!--begin::Decrease control-->
                                    <button type="button"
                                        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0"
                                        data-kt-dialer-control="decrease">
                                        <i class="ki-duotone ki-minus-circle fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                    <!--end::Decrease control-->
                                    <!--begin::Input control-->
                                    <input type="text" class="form-control form-control-solid border-0 ps-12"
                                        data-kt-dialer-control="input" placeholder="Amount" name="manageBudget"
                                        readonly="readonly" value="$100" />
                                    <!--end::Input control-->
                                    <!--begin::Increase control-->
                                    <button type="button"
                                        class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0"
                                        data-kt-dialer-control="increase">
                                        <i class="ki-duotone ki-plus-circle fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                    <!--end::Increase control-->
                                </div>
                                <!--end::Dialer-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-4">
                                <label class="fs-6 form-label fw-bold text-dark">Team Size</label>
                                <input type="text" class="form-control form-control form-control-solid" name="city" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xxl-5">
                        <!--begin::Row-->
                        <div class="row g-8">
                            <!--begin::Col-->
                            <div class="col-lg-6">
                                <label class="fs-6 form-label fw-bold text-dark">Category</label>
                                <!--begin::Select-->
                                <select class="form-select form-select-solid" data-control="select2"
                                    data-placeholder="In Progress" data-hide-search="true">
                                    <option value=""></option>
                                    <option value="1">Not started</option>
                                    <option value="2" selected="selected">Select</option>
                                    <option value="3">Done</option>
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-lg-6">
                                <label class="fs-6 form-label fw-bold text-dark">Status</label>
                                <div class="form-check form-switch form-check-custom form-check-solid mt-1">
                                    <input class="form-check-input" type="checkbox" value="" id="flexSwitchChecked"
                                        checked="checked" />
                                    <label class="form-check-label" for="flexSwitchChecked">Active</label>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Advance form-->
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
        <h3 class="fw-bold me-5 my-1">57 Items Found
            <span class="text-gray-400 fs-6">by Recent Updates ↓</span></h3>
    </div>
    <!--end::Title-->
    <!--begin::Controls-->
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
    <!--end::Controls-->
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
                    <span class="card-label fw-bold fs-3 mb-1">List User</span>
                </h3>
                <div class="card-toolbar">
                    <a class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#create">
                        <i class="ki-duotone ki-plus fs-2"></i>New Member</a>
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            <div class="card-body py-3">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-125px rounded-start">Created</th>
                                <th class="min-w-125px">No Invoice</th>
                                <th class="min-w-125px">Service</th>
                                <th class="min-w-125px">Payment</th>
                                <th class="min-w-125px">Stats</th>
                                <th class="min-w-200px text-end rounded-end"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$transaction->created_at}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$transaction->user->email}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$transaction->no_iv}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{$transaction->service}}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">
                                        {{$transaction->payment }}
                                    </div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">
                                        {{$transaction->status }}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a onclick="return confirm('are you sure?')"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="ki-duotone ki-switch fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit"
                                        data-id="{{$transaction->id}}" data-bs-toggle="modal" data-bs-target="#edit">
                                        <i class="ki-duotone ki-pencil fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <a href="{{route('admin.delete',$transaction->id)}}"
                                        onclick="return confirm('are you sure?')"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                        <i class="ki-duotone ki-trash fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        {{$transactions->links()}}
                        
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
                <!--begin::Pagination-->
                <div class="d-flex flex-stack flex-wrap pt-10">
                    <div class="fs-6 fw-semibold text-gray-700">Showing 1 to 10 of 50 entries</div>
                    <!--begin::Pages-->
                    <ul class="pagination">
                        <li class="page-item previous">
                            <a href="#" class="page-link">
                                <i class="previous"></i>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a href="#" class="page-link">1</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">2</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">3</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">4</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">5</a>
                        </li>
                        <li class="page-item">
                            <a href="#" class="page-link">6</a>
                        </li>
                        <li class="page-item next">
                            <a href="#" class="page-link">
                                <i class="next"></i>
                            </a>
                        </li>
                    </ul>
                    <!--end::Pages-->
                </div>
                <!--end::Pagination-->
            </div>
            <!--begin::Body-->
        </div>
        <!--end::Tables Widget 11-->
        
    </div>
    <!--end::Tab pane-->
</div>
<!--end::Tab Content-->
@endsection
