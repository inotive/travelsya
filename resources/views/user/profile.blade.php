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
{{--                                        {{\Illuminate\Support\Facades\Auth::user()->name}}--}}
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
{{--                                        {{(session()->get('user')['data']['phone']) ?: "null"}}--}}
                                    </a>
                                    <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                        <i class="ki-duotone ki-sms fs-4 me-1"><span class="path1"></span><span class="path2"></span></i>
{{--                                        {{session()->get('user')['data']['email']}}--}}
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
                                    <th class="min-w-100px">Invoice</th>
                                    <th class="text-end min-w-70px">Metode Pembayaran</th>
                                    <th class="text-end min-w-70px">Status Transaksi</th>
                                    <th class="text-end min-w-100px">Total Transaksi</th>
                                    <th class="text-end min-w-100px">Tanggal Transaksi</th>
                                    <th class="text-end min-w-100px">Kategori Produk</th>
                                    <th class="text-end min-w-100px">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach($transactions as $transaction)
                                <tr>
                                    <td data-kt-ecommerce-order-filter="order_id">
                                        <a href="{{route('user.transaction.detail',$transaction->no_inv)}}" class="text-gray-800 text-hover-primary fw-bold">
                                            {{$transaction->no_inv}} </a>
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">{{$transaction->payment_channel}}</span>
                                    </td>
                                    <td class="text-end pe-0" data-order="Refunded">
                                        <!--begin::Badges-->
                                        @php
                                        $badge= '';
                                        if($transaction->status == 'PENDING'){
                                        $badge = 'info';
                                        }elseif($transaction->status == 'PAID'){
                                        $badge = 'success';
                                        }else{
                                        $badge = 'danger';
                                        }
                                        @endphp
                                        <div class="badge badge-light-{{$badge}}">{{$transaction->status}}</div>
                                        <!--end::Badges-->
                                    </td>
                                    <td class="text-end pe-0">
                                        <span class="fw-bold">Rp. {{number_format($transaction->total)}}</span>
                                    </td>
                                    <td class="text-end" data-order="2023-03-25">
                                        <span class="fw-bold">{{date("d M y h:m",strtotime($transaction->created_at))}}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{route('user.transaction.detail',$transaction->no_inv)}}" class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Lihat Detail Transaksi
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i> </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Products-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::details View-->

    </div>
    <!--end::Post-->
</div>
<!--end::Row-->
@endsection
