@extends('layouts.user')

@section('content-user')
<!--begin::Toolbar-->
<div class="toolbar py-5 pb-lg-15" id="kt_toolbar">
    <!--begin::Container-->
    <div id="kt_toolbar_container" class=" container-xxl  d-flex flex-stack flex-wrap">


        <!--begin::Page title-->
        <div class="page-title d-flex flex-column me-3">
            <!--begin::Title-->
            <h1 class="d-flex text-white fw-bold my-1 fs-3">
                Account Overview
            </h1>
            <!--end::Title-->

        </div>
        <!--end::Page title-->
    </div>
    <!--end::Container-->
</div>
<!--end::Toolbar-->
<div id="kt_content_container" class="container-xxl ">
    <!--begin::Post-->
    <div class="content flex-row-fluid" id="kt_content">

        <!--begin::Navbar-->
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap">
                    <!--begin: Pic-->
                    <div class="me-7 mb-4">
                        <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                            <img src="../assets/media/avatars/300-1.jpg" alt="image" />
                            <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                            </div>
                        </div>
                    </div>
                    <!--end::Pic-->

                    <!--begin::Info-->
                    <div class="flex-grow-1">
                        <!--begin::Title-->
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <!--begin::User-->
                            <div class="d-flex flex-column">
                                <!--begin::Name-->
                                <div class="d-flex align-items-center mb-2">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">
                                        {{session()->get('user')['data']['name']}}
                                    </a>
                                    <a href="#"><i class="ki-duotone ki-verify fs-1 text-primary"><span class="path1"></span><span class="path2"></span></i></a>
                                </div>
                                <!--end::Name-->

                                <!--begin::Info-->
                                <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                    <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                        <i class="ki-duotone ki-profile-circle fs-4 me-1"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> Verified
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                        <i class="ki-duotone ki-phone fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>
                                        {{(session()->get('user')['data']['phone']) ?: "null"}}
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                        <i class="ki-duotone ki-sms fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>
                                        {{session()->get('user')['data']['email']}}
                                    </a>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::User-->

                        </div>
                        <!--end::Title-->

                    </div>
                    <!--end::Info-->
                </div>
                <!--end::Details-->

                <!--begin::Navs-->
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
                    <!--begin::Nav item-->
                    <li class="nav-item mt-2">
                        <a class="nav-link text-active-primary ms-0 me-10 py-5 active" href="overview.html">
                            Transaksi </a>
                    </li>
                    <!--end::Nav item-->
                </ul>
                <!--begin::Navs-->
            </div>
        </div>
        <!--end::Navbar-->
        <!--begin::details View-->
        <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
            <!--begin::Card header-->
            <div class="card-header cursor-pointer">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">List</h3>
                </div>
                <!--end::Card title-->

            </div>
            <!--begin::Card header-->

            <!--begin::Card body-->
            <div class="card-body p-9">
                <!--begin::Products-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4"><span class="path1"></span><span class="path2"></span></i> <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Search Order" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->

                        <!--begin::Card toolbar-->
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <!--begin::Flatpickr-->
                            <div class="input-group w-250px">
                                <input class="form-control form-control-solid rounded rounded-end-0" placeholder="Pick date range" id="kt_ecommerce_sales_flatpickr" />
                                <button class="btn btn-icon btn-light" id="kt_ecommerce_sales_flatpickr_clear">
                                    <i class="ki-duotone ki-cross fs-2"><span class="path1"></span><span class="path2"></span></i> </button>
                            </div>
                            <!--end::Flatpickr-->

                            <div class="w-100 mw-150px">
                                <!--begin::Select2-->
                                <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Status" data-kt-ecommerce-order-filter="status">
                                    <option></option>
                                    <option value="all">All</option>
                                    <option value="Cancelled">Cancelled</option>
                                    <option value="Completed">Completed</option>
                                    <option value="Denied">Denied</option>
                                    <option value="Expired">Expired</option>
                                    <option value="Failed">Failed</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Processing">Processing</option>
                                    <option value="Refunded">Refunded</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Delivering">Delivering</option>
                                </select>
                                <!--end::Select2-->
                            </div>

                            <!--begin::Add product-->
                            <a href="../catalog/add-product.html" class="btn btn-primary">
                                Add Order
                            </a>
                            <!--end::Add product-->
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">

                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_sales_table .form-check-input" value="1" />
                                        </div>
                                    </th>
                                    <th class="min-w-100px">Order ID</th>
                                    <th class="min-w-175px">Customer</th>
                                    <th class="text-end min-w-70px">Status</th>
                                    <th class="text-end min-w-100px">Total</th>
                                    <th class="text-end min-w-100px">Date Added</th>
                                    <th class="text-end min-w-100px">Date Modified</th>
                                    <th class="text-end min-w-100px">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14496 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-23.jpg" alt="Dan Wilson" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Dan
                                                    Wilson</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Refunded">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-info">Refunded</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$466.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-25">
                                        <span class="fw-bold">25/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-26">
                                        <span class="fw-bold">26/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14497 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-21.jpg" alt="Ethan Wilder" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Ethan
                                                    Wilder</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$415.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-20">
                                        <span class="fw-bold">20/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-25">
                                        <span class="fw-bold">25/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14498 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-13.jpg" alt="John Miller" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">John
                                                    Miller</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$61.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-21">
                                        <span class="fw-bold">21/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-24">
                                        <span class="fw-bold">24/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14499 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-danger text-danger">
                                                        O </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Olivia
                                                    Wild</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Delivering">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-primary">Delivering</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$424.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-17">
                                        <span class="fw-bold">17/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-23">
                                        <span class="fw-bold">23/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14500 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-13.jpg" alt="John Miller" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">John
                                                    Miller</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Expired">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-danger">Expired</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$77.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-17">
                                        <span class="fw-bold">17/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-22">
                                        <span class="fw-bold">22/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14501 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-danger text-danger">
                                                        E </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Emma
                                                    Bold</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$411.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-19">
                                        <span class="fw-bold">19/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-21">
                                        <span class="fw-bold">21/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14502 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-5.jpg" alt="Sean Bean" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Sean
                                                    Bean</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$438.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-19">
                                        <span class="fw-bold">19/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-20">
                                        <span class="fw-bold">20/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14503 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-success text-success">
                                                        L </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Lucy
                                                    Kunic</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Delivering">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-primary">Delivering</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$442.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-18">
                                        <span class="fw-bold">18/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-19">
                                        <span class="fw-bold">19/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14504 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-6.jpg" alt="Emma Smith" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Emma
                                                    Smith</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Expired">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-danger">Expired</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$339.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-11">
                                        <span class="fw-bold">11/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-18">
                                        <span class="fw-bold">18/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14505 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-info text-info">
                                                        A </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Robert
                                                    Doe</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$428.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-11">
                                        <span class="fw-bold">11/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-17">
                                        <span class="fw-bold">17/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14506 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-danger text-danger">
                                                        O </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Olivia
                                                    Wild</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$410.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-15">
                                        <span class="fw-bold">15/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-16">
                                        <span class="fw-bold">16/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14507 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-5.jpg" alt="Sean Bean" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Sean
                                                    Bean</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Refunded">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-info">Refunded</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$216.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-14">
                                        <span class="fw-bold">14/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-15">
                                        <span class="fw-bold">15/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14508 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-1.jpg" alt="Max Smith" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Max
                                                    Smith</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$324.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-13">
                                        <span class="fw-bold">13/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-14">
                                        <span class="fw-bold">14/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14509 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-primary text-primary">
                                                        N </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Neil
                                                    Owen</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Failed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-danger">Failed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$378.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-10">
                                        <span class="fw-bold">10/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-13">
                                        <span class="fw-bold">13/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14510 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-21.jpg" alt="Ethan Wilder" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Ethan
                                                    Wilder</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$292.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-07">
                                        <span class="fw-bold">07/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-12">
                                        <span class="fw-bold">12/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14511 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-5.jpg" alt="Sean Bean" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Sean
                                                    Bean</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$235.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-06">
                                        <span class="fw-bold">06/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-11">
                                        <span class="fw-bold">11/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14512 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-5.jpg" alt="Sean Bean" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Sean
                                                    Bean</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$122.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-07">
                                        <span class="fw-bold">07/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-10">
                                        <span class="fw-bold">10/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14513 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-5.jpg" alt="Sean Bean" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Sean
                                                    Bean</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Failed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-danger">Failed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$272.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-07">
                                        <span class="fw-bold">07/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-09">
                                        <span class="fw-bold">09/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14514 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-23.jpg" alt="Dan Wilson" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Dan
                                                    Wilson</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Pending">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-warning">Pending</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$317.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-03">
                                        <span class="fw-bold">03/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-08">
                                        <span class="fw-bold">08/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14515 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-13.jpg" alt="John Miller" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">John
                                                    Miller</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Expired">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-danger">Expired</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$166.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-04">
                                        <span class="fw-bold">04/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-07">
                                        <span class="fw-bold">07/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14516 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-danger text-danger">
                                                        E </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Emma
                                                    Bold</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Expired">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-danger">Expired</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$368.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-02">
                                        <span class="fw-bold">02/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-06">
                                        <span class="fw-bold">06/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14517 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-12.jpg" alt="Ana Crown" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Ana
                                                    Crown</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$495.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-01">
                                        <span class="fw-bold">01/03/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-05">
                                        <span class="fw-bold">05/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14518 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-info text-info">
                                                        A </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Robert
                                                    Doe</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$186.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-25">
                                        <span class="fw-bold">25/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-04">
                                        <span class="fw-bold">04/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14519 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-12.jpg" alt="Ana Crown" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Ana
                                                    Crown</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Cancelled">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-danger">Cancelled</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$147.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-28">
                                        <span class="fw-bold">28/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-03">
                                        <span class="fw-bold">03/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14520 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-warning text-warning">
                                                        C </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Mikaela
                                                    Collins</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$470.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-23">
                                        <span class="fw-bold">23/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-02">
                                        <span class="fw-bold">02/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14521 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-warning text-warning">
                                                        C </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Mikaela
                                                    Collins</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$324.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-22">
                                        <span class="fw-bold">22/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-01">
                                        <span class="fw-bold">01/03/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14522 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-primary text-primary">
                                                        N </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Neil
                                                    Owen</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$338.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-21">
                                        <span class="fw-bold">21/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-28">
                                        <span class="fw-bold">28/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14523 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-1.jpg" alt="Max Smith" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Max
                                                    Smith</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Expired">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-danger">Expired</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$162.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-22">
                                        <span class="fw-bold">22/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-27">
                                        <span class="fw-bold">27/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14524 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-warning text-warning">
                                                        C </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Mikaela
                                                    Collins</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Failed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-danger">Failed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$308.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-19">
                                        <span class="fw-bold">19/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-26">
                                        <span class="fw-bold">26/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14525 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-info text-info">
                                                        A </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Robert
                                                    Doe</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$185.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-22">
                                        <span class="fw-bold">22/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-25">
                                        <span class="fw-bold">25/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14526 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-12.jpg" alt="Ana Crown" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Ana
                                                    Crown</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$112.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-19">
                                        <span class="fw-bold">19/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-24">
                                        <span class="fw-bold">24/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14527 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-1.jpg" alt="Max Smith" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Max
                                                    Smith</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$272.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-18">
                                        <span class="fw-bold">18/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-23">
                                        <span class="fw-bold">23/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14528 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-danger text-danger">
                                                        O </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Olivia
                                                    Wild</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$424.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-18">
                                        <span class="fw-bold">18/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-22">
                                        <span class="fw-bold">22/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14529 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-danger text-danger">
                                                        E </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Emma
                                                    Bold</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Cancelled">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-danger">Cancelled</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$70.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-20">
                                        <span class="fw-bold">20/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-21">
                                        <span class="fw-bold">21/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14530 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-25.jpg" alt="Brian Cox" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Brian
                                                    Cox</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$13.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-17">
                                        <span class="fw-bold">17/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-20">
                                        <span class="fw-bold">20/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14531 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-info text-info">
                                                        A </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Robert
                                                    Doe</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Delivered">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Delivered</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$186.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-16">
                                        <span class="fw-bold">16/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-19">
                                        <span class="fw-bold">19/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14532 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-9.jpg" alt="Francis Mitcham" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Francis
                                                    Mitcham</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$10.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-16">
                                        <span class="fw-bold">16/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-18">
                                        <span class="fw-bold">18/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14533 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-6.jpg" alt="Emma Smith" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Emma
                                                    Smith</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Cancelled">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-danger">Cancelled</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$283.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-11">
                                        <span class="fw-bold">11/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-17">
                                        <span class="fw-bold">17/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14534 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-danger text-danger">
                                                        M </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Melody
                                                    Macy</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Cancelled">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-danger">Cancelled</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$282.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-09">
                                        <span class="fw-bold">09/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-16">
                                        <span class="fw-bold">16/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14535 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-primary text-primary">
                                                        N </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Neil
                                                    Owen</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Delivered">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Delivered</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$248.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-12">
                                        <span class="fw-bold">12/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-15">
                                        <span class="fw-bold">15/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14536 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-13.jpg" alt="John Miller" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">John
                                                    Miller</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Cancelled">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-danger">Cancelled</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$495.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-07">
                                        <span class="fw-bold">07/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-14">
                                        <span class="fw-bold">14/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14537 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-5.jpg" alt="Sean Bean" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Sean
                                                    Bean</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$152.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-06">
                                        <span class="fw-bold">06/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-13">
                                        <span class="fw-bold">13/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14538 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-9.jpg" alt="Francis Mitcham" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Francis
                                                    Mitcham</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$420.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-11">
                                        <span class="fw-bold">11/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-12">
                                        <span class="fw-bold">12/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14539 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-9.jpg" alt="Francis Mitcham" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Francis
                                                    Mitcham</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Cancelled">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-danger">Cancelled</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$426.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-06">
                                        <span class="fw-bold">06/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-11">
                                        <span class="fw-bold">11/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14540 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-info text-info">
                                                        A </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Robert
                                                    Doe</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Delivering">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-primary">Delivering</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$409.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-09">
                                        <span class="fw-bold">09/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-10">
                                        <span class="fw-bold">10/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14541 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-info text-info">
                                                        A </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Robert
                                                    Doe</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Processing">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-primary">Processing</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$484.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-08">
                                        <span class="fw-bold">08/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-09">
                                        <span class="fw-bold">09/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14542 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label">
                                                        <img src="../../../assets/media/avatars/300-21.jpg" alt="Ethan Wilder" class="w-100" />
                                                    </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Ethan
                                                    Wilder</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Completed">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-success">Completed</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$478.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-03">
                                        <span class="fw-bold">03/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-08">
                                        <span class="fw-bold">08/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14543 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-danger text-danger">
                                                        O </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Olivia
                                                    Wild</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Delivering">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-primary">Delivering</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$441.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-04">
                                        <span class="fw-bold">04/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-07">
                                        <span class="fw-bold">07/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14544 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-danger text-danger">
                                                        O </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Olivia
                                                    Wild</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Pending">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-warning">Pending</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$413.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-02">
                                        <span class="fw-bold">02/02/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-06">
                                        <span class="fw-bold">06/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />
                                        </div>
                                    </td>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="details.html" class="text-gray-800 text-hover-primary fw-bold">
                                            14545 </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                <a href="../../user-management/users/view.html">
                                                    <div class="symbol-label fs-3 bg-light-success text-success">
                                                        L </div>
                                                </a>
                                            </div>
                                            <!--end::Avatar-->

                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="../../user-management/users/view.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">Lucy
                                                    Kunic</a>
                                                <!--end::Title-->
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-end pe-0" data-order="Cancelled">
                                        <!--begin::Badges-->
                                        <div class="badge badge-light-danger">Cancelled</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">$319.00</span>
                                    </td>
                                    <td class="text-end" data-order="2023-01-29">
                                        <span class="fw-bold">29/01/2023</span>
                                    </td>
                                    <td class="text-end" data-order="2023-02-05">
                                        <span class="fw-bold">05/02/2023</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="#" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Actions
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                        <!--begin::Menu-->
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4" data-kt-menu="true">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="details.html" class="menu-link px-3">
                                                    View
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="edit-order.html" class="menu-link px-3">
                                                    Edit
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">
                                                    Delete
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Products-->

                <!--begin::Notice-->
                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed  p-6">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-information fs-2tx text-warning me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> <!--end::Icon-->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1 ">
                        <!--begin::Content-->
                        <div class=" fw-semibold">
                            <h4 class="text-gray-900 fw-bold">We need your attention!</h4>

                            <div class="fs-6 text-gray-700 ">Your payment was declined. To start using
                                tools, please <a class="fw-bold" href="billing.html">Add Payment
                                    Method</a>.</div>
                        </div>
                        <!--end::Content-->

                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Notice-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::details View-->

    </div>
    <!--end::Post-->
</div>
<!--end::Row-->
@endsection