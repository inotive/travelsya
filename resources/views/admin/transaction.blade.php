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
                            <select class="form-select form-select-solid" data-control="select2" data-placeholder="Layanan" data-hide-search="true">
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
                        <input type="text" class="form-control form-control form-control-solid" name="tags" value="products, users, events" />
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
                                <select class="form-select form-select-solid" data-control="select2" data-placeholder="In Progress" data-hide-search="true">
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
                                        <input type="radio" class="btn-check" name="type" value="has" checked="checked" />
                                        <span class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bold px-4">All</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label>
                                        <input type="radio" class="btn-check" name="type" value="users" />
                                        <span class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bold px-4">Users</span>
                                    </label>
                                    <!--end::Option-->
                                    <!--begin::Option-->
                                    <label>
                                        <input type="radio" class="btn-check" name="type" value="orders" />
                                        <span class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bold px-4">Orders</span>
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
                                <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="1000" data-kt-dialer-max="50000" data-kt-dialer-step="1000" data-kt-dialer-prefix="$" data-kt-dialer-decimals="2">
                                    <!--begin::Decrease control-->
                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                        <i class="ki-duotone ki-minus-circle fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                    <!--end::Decrease control-->
                                    <!--begin::Input control-->
                                    <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="manageBudget" readonly="readonly" value="$50" />
                                    <!--end::Input control-->
                                    <!--begin::Increase control-->
                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
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
                                <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="1000" data-kt-dialer-max="50000" data-kt-dialer-step="1000" data-kt-dialer-prefix="$" data-kt-dialer-decimals="2">
                                    <!--begin::Decrease control-->
                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0" data-kt-dialer-control="decrease">
                                        <i class="ki-duotone ki-minus-circle fs-1">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                    <!--end::Decrease control-->
                                    <!--begin::Input control-->
                                    <input type="text" class="form-control form-control-solid border-0 ps-12" data-kt-dialer-control="input" placeholder="Amount" name="manageBudget" readonly="readonly" value="$100" />
                                    <!--end::Input control-->
                                    <!--begin::Increase control-->
                                    <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0" data-kt-dialer-control="increase">
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
                                <select class="form-select form-select-solid" data-control="select2" data-placeholder="In Progress" data-hide-search="true">
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
                                    <input class="form-check-input" type="checkbox" value="" id="flexSwitchChecked" checked="checked" />
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
                <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary me-3 " data-bs-toggle="tab" href="#kt_project_users_card_pane">
                    <i class="ki-duotone ki-element-plus fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                    </i>
                </a>
            </li>
            <li class="nav-item m-0">
                <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary active" data-bs-toggle="tab" href="#kt_project_users_table_pane">
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
            <select name="status" data-control="select2" data-hide-search="true" data-placeholder="Filter" class="form-select form-select-sm border-body bg-body w-150px me-5">
                <option value="1">Recently Updated</option>
                <option value="2">Last Month</option>
                <option value="3">Last Quarter</option>
                <option value="4">Last Year</option>
            </select>
            <!--end::Select-->
            <!--begin::Select-->
            <select name="status" data-control="select2" data-hide-search="true" data-placeholder="Export" class="form-select form-select-sm border-body bg-body w-100px">
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
    <div id="kt_project_users_card_pane" class="tab-pane fade ">
        <!--begin::Row-->
        <div class="row g-6 g-xl-9">
            <!--begin::Col-->
            <div class="col-md-6 col-xxl-4">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-65px symbol-circle mb-5">
                            <img src="assets/media//avatars/300-2.jpg" alt="image" />
                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Karina Clark</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="fw-semibold text-gray-400 mb-6">Art Director at Novica Co.</div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        <div class="d-flex flex-center flex-wrap">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                <div class="fw-semibold text-gray-400">Earnings</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">23</div>
                                <div class="fw-semibold text-gray-400">Tasks</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                <div class="fw-semibold text-gray-400">Sales</div>
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 col-xxl-4">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-65px symbol-circle mb-5">
                            <span class="symbol-label fs-2x fw-semibold text-primary bg-light-primary">S</span>
                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Sean Bean</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="fw-semibold text-gray-400 mb-6">Developer at Loop Inc</div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        <div class="d-flex flex-center flex-wrap">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                <div class="fw-semibold text-gray-400">Earnings</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">23</div>
                                <div class="fw-semibold text-gray-400">Tasks</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                <div class="fw-semibold text-gray-400">Sales</div>
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 col-xxl-4">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-65px symbol-circle mb-5">
                            <img src="assets/media//avatars/300-1.jpg" alt="image" />
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Alan Johnson</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="fw-semibold text-gray-400 mb-6">Web Designer at Nextop Ltd.</div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        <div class="d-flex flex-center flex-wrap">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                <div class="fw-semibold text-gray-400">Earnings</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">23</div>
                                <div class="fw-semibold text-gray-400">Tasks</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                <div class="fw-semibold text-gray-400">Sales</div>
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 col-xxl-4">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-65px symbol-circle mb-5">
                            <img src="assets/media//avatars/300-14.jpg" alt="image" />
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Robert Doe</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="fw-semibold text-gray-400 mb-6">Marketing Analytic at Avito Ltd.</div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        <div class="d-flex flex-center flex-wrap">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                <div class="fw-semibold text-gray-400">Earnings</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">23</div>
                                <div class="fw-semibold text-gray-400">Tasks</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                <div class="fw-semibold text-gray-400">Sales</div>
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 col-xxl-4">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-65px symbol-circle mb-5">
                            <img src="assets/media//avatars/300-6.jpg" alt="image" />
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Olivia Wild</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="fw-semibold text-gray-400 mb-6">Art Director at Seal Inc.</div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        <div class="d-flex flex-center flex-wrap">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                <div class="fw-semibold text-gray-400">Earnings</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">23</div>
                                <div class="fw-semibold text-gray-400">Tasks</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                <div class="fw-semibold text-gray-400">Sales</div>
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 col-xxl-4">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-65px symbol-circle mb-5">
                            <span class="symbol-label fs-2x fw-semibold text-warning bg-light-warning">A</span>
                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Adam Williams</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="fw-semibold text-gray-400 mb-6">System Arcitect at Wolto Co.</div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        <div class="d-flex flex-center flex-wrap">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                <div class="fw-semibold text-gray-400">Earnings</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">23</div>
                                <div class="fw-semibold text-gray-400">Tasks</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                <div class="fw-semibold text-gray-400">Sales</div>
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 col-xxl-4">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-65px symbol-circle mb-5">
                            <span class="symbol-label fs-2x fw-semibold text-info bg-light-info">P</span>
                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n3 mt-n3"></div>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Peter Marcus</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="fw-semibold text-gray-400 mb-6">Art Director at Novica Co.</div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        <div class="d-flex flex-center flex-wrap">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                <div class="fw-semibold text-gray-400">Earnings</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">23</div>
                                <div class="fw-semibold text-gray-400">Tasks</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                <div class="fw-semibold text-gray-400">Sales</div>
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 col-xxl-4">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-65px symbol-circle mb-5">
                            <span class="symbol-label fs-2x fw-semibold text-success bg-light-success">N</span>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Neil Owen</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="fw-semibold text-gray-400 mb-6">Accountant at Numbers Co.</div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        <div class="d-flex flex-center flex-wrap">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                <div class="fw-semibold text-gray-400">Earnings</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">23</div>
                                <div class="fw-semibold text-gray-400">Tasks</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                <div class="fw-semibold text-gray-400">Sales</div>
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-md-6 col-xxl-4">
                <!--begin::Card-->
                <div class="card">
                    <!--begin::Card body-->
                    <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                        <!--begin::Avatar-->
                        <div class="symbol symbol-65px symbol-circle mb-5">
                            <img src="assets/media//avatars/300-12.jpg" alt="image" />
                        </div>
                        <!--end::Avatar-->
                        <!--begin::Name-->
                        <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0">Benjamin Jacob</a>
                        <!--end::Name-->
                        <!--begin::Position-->
                        <div class="fw-semibold text-gray-400 mb-6">Art Director at Novica Co.</div>
                        <!--end::Position-->
                        <!--begin::Info-->
                        <div class="d-flex flex-center flex-wrap">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$14,560</div>
                                <div class="fw-semibold text-gray-400">Earnings</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">23</div>
                                <div class="fw-semibold text-gray-400">Tasks</div>
                            </div>
                            <!--end::Stats-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bold text-gray-700">$236,400</div>
                                <div class="fw-semibold text-gray-400">Sales</div>
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
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
    <!--end::Tab pane-->
    <!--begin::Tab pane-->
    <div id="kt_project_users_table_pane" class="tab-pane fade show active">
        <!--begin::Card-->
        <div class="card card-flush">
            <!--begin::Card body-->
            <div class="card-body pt-0">
                <!--begin::Table container-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table id="kt_project_users_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bold">
                        <thead class="fs-7 text-gray-400 text-uppercase">
                            <tr>
                                <th class="min-w-250px">Manager</th>
                                <th class="min-w-150px">Date</th>
                                <th class="min-w-90px">Amount</th>
                                <th class="min-w-90px">Status</th>
                                <th class="min-w-50px text-end">Details</th>
                            </tr>
                        </thead>
                        <tbody class="fs-6">
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-6.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Emma Smith</a>
                                            <div class="fw-semibold fs-6 text-gray-400">smith@kpmg.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Dec 20, 2023</td>
                                <td>$764.00</td>
                                <td>
                                    <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-light-danger text-danger fw-semibold">M</span>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Online-->
                                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                            <!--end::Online-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Melody Macy</a>
                                            <div class="fw-semibold fs-6 text-gray-400">melody@altbox.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Jun 24, 2023</td>
                                <td>$735.00</td>
                                <td>
                                    <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-1.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Max Smith</a>
                                            <div class="fw-semibold fs-6 text-gray-400">max@kt.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Apr 15, 2023</td>
                                <td>$559.00</td>
                                <td>
                                    <span class="badge badge-light-info fw-bold px-4 py-3">In progress</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-5.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Sean Bean</a>
                                            <div class="fw-semibold fs-6 text-gray-400">sean@dellito.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Aug 19, 2023</td>
                                <td>$843.00</td>
                                <td>
                                    <span class="badge badge-light-danger fw-bold px-4 py-3">Rejected</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-25.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Brian Cox</a>
                                            <div class="fw-semibold fs-6 text-gray-400">brian@exchange.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Mar 10, 2023</td>
                                <td>$563.00</td>
                                <td>
                                    <span class="badge badge-light-danger fw-bold px-4 py-3">Rejected</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-light-warning text-warning fw-semibold">C</span>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Online-->
                                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                            <!--end::Online-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Mikaela Collins</a>
                                            <div class="fw-semibold fs-6 text-gray-400">mik@pex.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Mar 10, 2023</td>
                                <td>$518.00</td>
                                <td>
                                    <span class="badge badge-light-warning fw-bold px-4 py-3">Pending</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-9.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Francis Mitcham</a>
                                            <div class="fw-semibold fs-6 text-gray-400">f.mit@kpmg.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Jun 20, 2023</td>
                                <td>$406.00</td>
                                <td>
                                    <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-light-danger text-danger fw-semibold">O</span>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Online-->
                                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                            <!--end::Online-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Olivia Wild</a>
                                            <div class="fw-semibold fs-6 text-gray-400">olivia@corpmail.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Feb 21, 2023</td>
                                <td>$961.00</td>
                                <td>
                                    <span class="badge badge-light-warning fw-bold px-4 py-3">Pending</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-light-primary text-primary fw-semibold">N</span>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Online-->
                                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                            <!--end::Online-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Neil Owen</a>
                                            <div class="fw-semibold fs-6 text-gray-400">owen.neil@gmail.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Oct 25, 2023</td>
                                <td>$403.00</td>
                                <td>
                                    <span class="badge badge-light-warning fw-bold px-4 py-3">Pending</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-23.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Dan Wilson</a>
                                            <div class="fw-semibold fs-6 text-gray-400">dam@consilting.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>May 05, 2023</td>
                                <td>$577.00</td>
                                <td>
                                    <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-light-danger text-danger fw-semibold">E</span>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Online-->
                                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                            <!--end::Online-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Emma Bold</a>
                                            <div class="fw-semibold fs-6 text-gray-400">emma@intenso.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Dec 20, 2023</td>
                                <td>$558.00</td>
                                <td>
                                    <span class="badge badge-light-warning fw-bold px-4 py-3">Pending</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-12.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Ana Crown</a>
                                            <div class="fw-semibold fs-6 text-gray-400">ana.cf@limtel.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Feb 21, 2023</td>
                                <td>$472.00</td>
                                <td>
                                    <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-light-info text-info fw-semibold">A</span>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Online-->
                                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                            <!--end::Online-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Robert Doe</a>
                                            <div class="fw-semibold fs-6 text-gray-400">robert@benko.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Nov 10, 2023</td>
                                <td>$673.00</td>
                                <td>
                                    <span class="badge badge-light-warning fw-bold px-4 py-3">Pending</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-13.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">John Miller</a>
                                            <div class="fw-semibold fs-6 text-gray-400">miller@mapple.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Nov 10, 2023</td>
                                <td>$783.00</td>
                                <td>
                                    <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-light-success text-success fw-semibold">L</span>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Online-->
                                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                            <!--end::Online-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Lucy Kunic</a>
                                            <div class="fw-semibold fs-6 text-gray-400">lucy.m@fentech.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Feb 21, 2023</td>
                                <td>$430.00</td>
                                <td>
                                    <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-21.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Online-->
                                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                            <!--end::Online-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Ethan Wilder</a>
                                            <div class="fw-semibold fs-6 text-gray-400">ethan@loop.com.au</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Apr 15, 2023</td>
                                <td>$867.00</td>
                                <td>
                                    <span class="badge badge-light-danger fw-bold px-4 py-3">Rejected</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-6.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Emma Smith</a>
                                            <div class="fw-semibold fs-6 text-gray-400">smith@kpmg.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Apr 15, 2023</td>
                                <td>$941.00</td>
                                <td>
                                    <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-13.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">John Miller</a>
                                            <div class="fw-semibold fs-6 text-gray-400">miller@mapple.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Jul 25, 2023</td>
                                <td>$958.00</td>
                                <td>
                                    <span class="badge badge-light-danger fw-bold px-4 py-3">Rejected</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-light-info text-info fw-semibold">A</span>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Online-->
                                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                            <!--end::Online-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Robert Doe</a>
                                            <div class="fw-semibold fs-6 text-gray-400">robert@benko.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Aug 19, 2023</td>
                                <td>$706.00</td>
                                <td>
                                    <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-25.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Brian Cox</a>
                                            <div class="fw-semibold fs-6 text-gray-400">brian@exchange.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Jul 25, 2023</td>
                                <td>$921.00</td>
                                <td>
                                    <span class="badge badge-light-danger fw-bold px-4 py-3">Rejected</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-light-info text-info fw-semibold">A</span>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Online-->
                                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                            <!--end::Online-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Robert Doe</a>
                                            <div class="fw-semibold fs-6 text-gray-400">robert@benko.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Nov 10, 2023</td>
                                <td>$718.00</td>
                                <td>
                                    <span class="badge badge-light-danger fw-bold px-4 py-3">Rejected</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-12.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Ana Crown</a>
                                            <div class="fw-semibold fs-6 text-gray-400">ana.cf@limtel.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Jun 20, 2023</td>
                                <td>$783.00</td>
                                <td>
                                    <span class="badge badge-light-danger fw-bold px-4 py-3">Rejected</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-13.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">John Miller</a>
                                            <div class="fw-semibold fs-6 text-gray-400">miller@mapple.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Mar 10, 2023</td>
                                <td>$689.00</td>
                                <td>
                                    <span class="badge badge-light-warning fw-bold px-4 py-3">Pending</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-light-info text-info fw-semibold">A</span>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Online-->
                                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                            <!--end::Online-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Robert Doe</a>
                                            <div class="fw-semibold fs-6 text-gray-400">robert@benko.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Sep 22, 2023</td>
                                <td>$419.00</td>
                                <td>
                                    <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-5.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Sean Bean</a>
                                            <div class="fw-semibold fs-6 text-gray-400">sean@dellito.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Oct 25, 2023</td>
                                <td>$600.00</td>
                                <td>
                                    <span class="badge badge-light-danger fw-bold px-4 py-3">Rejected</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-light-primary text-primary fw-semibold">N</span>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Online-->
                                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                            <!--end::Online-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Neil Owen</a>
                                            <div class="fw-semibold fs-6 text-gray-400">owen.neil@gmail.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Oct 25, 2023</td>
                                <td>$929.00</td>
                                <td>
                                    <span class="badge badge-light-info fw-bold px-4 py-3">In progress</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <span class="symbol-label bg-light-info text-info fw-semibold">A</span>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Online-->
                                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                            <!--end::Online-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Robert Doe</a>
                                            <div class="fw-semibold fs-6 text-gray-400">robert@benko.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Dec 20, 2023</td>
                                <td>$684.00</td>
                                <td>
                                    <span class="badge badge-light-info fw-bold px-4 py-3">In progress</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-21.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Online-->
                                            <div class="bg-success position-absolute border border-4 border-body h-15px w-15px rounded-circle translate-middle start-100 top-100 ms-n1 mt-n1"></div>
                                            <!--end::Online-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Ethan Wilder</a>
                                            <div class="fw-semibold fs-6 text-gray-400">ethan@loop.com.au</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Aug 19, 2023</td>
                                <td>$810.00</td>
                                <td>
                                    <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-13.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">John Miller</a>
                                            <div class="fw-semibold fs-6 text-gray-400">miller@mapple.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Nov 10, 2023</td>
                                <td>$678.00</td>
                                <td>
                                    <span class="badge badge-light-danger fw-bold px-4 py-3">Rejected</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!--begin::User-->
                                    <div class="d-flex align-items-center">
                                        <!--begin::Wrapper-->
                                        <div class="me-5 position-relative">
                                            <!--begin::Avatar-->
                                            <div class="symbol symbol-35px symbol-circle">
                                                <img alt="Pic" src="assets/media/avatars/300-9.jpg" />
                                            </div>
                                            <!--end::Avatar-->
                                        </div>
                                        <!--end::Wrapper-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-column justify-content-center">
                                            <a href="" class="mb-1 text-gray-800 text-hover-primary">Francis Mitcham</a>
                                            <div class="fw-semibold fs-6 text-gray-400">f.mit@kpmg.com</div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->
                                </td>
                                <td>Aug 19, 2023</td>
                                <td>$1000.00</td>
                                <td>
                                    <span class="badge badge-light-success fw-bold px-4 py-3">Approved</span>
                                </td>
                                <td class="text-end">
                                    <a href="#" class="btn btn-light btn-sm">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <!--end::Tab pane-->
</div>
<!--end::Tab Content-->
@endsection