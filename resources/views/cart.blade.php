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
                Detail Transaksi
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
        <!--begin::Form-->
        <form id="kt_ecommerce_edit_order_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="listing.html" method="POST" action="{{route('request.ppob')}}">
            <!--begin::Aside column-->
            @csrf
            <input type="text" name="kode" value="{{$product['description']}}" hidden>
            <input type="text" name="id" value="{{$product['id']}}" hidden>
            <input type="text" name="notelp" value="{{$no_hp}}" hidden>
            <input type="text" name="service" value="{{$service}}" hidden>
            <div class="w-100 flex-lg-row-auto w-lg-300px mb-7 me-7 me-lg-10">

                <!--begin::Order details-->
                <div class="card card-flush py-4">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>Order Details</h2>
                        </div>
                    </div>
                    <!--end::Card header-->

                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="d-flex flex-column gap-10">

                            <!--begin::Input group-->
                            <div class="fv-row">
                                <!--begin::Label-->
                                <label class="required form-label">Payment Method</label>
                                <!--end::Label-->

                                <!--begin::Select2-->
                                <select class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" name="payment_method" id="kt_ecommerce_edit_order_payment" required>
                                    <option></option>
                                    <option value="xendit">Xendit</option>
                                    <option value="finpay">Finpay</option>
                                </select>
                                <!--end::Select2-->


                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            @if((session()->get('user')['data']['point']))

                            <div class="fv-row form-switch form-switch-sm form-check-custom form-check-solid">

                                <!--begin::Editor-->
                                <input type="checkbox" class="form-check-input" name="point" id="point" value="{{session()->get('user')['data']['point']}}">
                                <!--end::Editor-->
                                <!--begin::Label-->
                                <label class="form-check-label">Point {{session()->get('user')['data']['point']}}</label>
                                <!--end::Label-->

                            </div>
                            <!--end::Input group-->
                            @endif
                        </div>
                    </div>
                    <!--end::Card header-->
                </div>
                <!--end::Order details-->
            </div>
            <!--end::Aside column-->

            <!--begin::Main column-->
            <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">

                <!--begin::Order details-->
                <div class="card card-flush py-4">

                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="d-flex flex-column gap-10">
                            <!--begin::Input group-->
                            <div>
                                <!--begin::Total price-->
                                <div class="fw-bold fs-4">
                                    Total : Rp
                                    <span id="kt_ecommerce_edit_order_total_price">
                                        {{$product['price']}}
                                    </span>
                                </div>
                                <!--end::Total price-->
                            </div>
                            <!--end::Input group-->

                            <!--begin::Separator-->
                            <div class="separator"></div>
                            <!--end::Separator-->

                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_edit_order_product_table">
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-200px">Product</th>
                                        <th class="min-w-100px pe-5">Qty</th>
                                        <th class="min-w-100px pe-5">Harga</th>
                                        <th class="min-w-100px text-end pe-5">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center" data-kt-ecommerce-edit-order-filter="product" data-kt-ecommerce-edit-order-id="product_1">
                                                <div class="ms-5">
                                                    <!--begin::Title-->
                                                    <a href="../catalog/edit-product.html" class="text-gray-800 text-hover-primary fs-5 fw-bold">{{$no_hp}}</a>
                                                    <!--end::Title-->

                                                    <!--begin::Price-->
                                                    <div class="fw-semibold fs-7"><span data-kt-ecommerce-edit-order-filter="price">{{$product['description']}}</span>
                                                    </div>
                                                    <!--end::Price-->

                                                </div>
                                            </div>
                                        </td>
                                        <td class="pe-5" data-order="18">
                                            <span class="fw-bold ms-3">1</span>
                                        </td>
                                        <td class="pe-5" data-order="18">
                                            <span class="fw-bold ms-3">{{$product['price']}}</span>
                                        </td>
                                        <td class="text-end pe-5" data-order="18">
                                            <span class="fw-bold ms-3">{{1*$product['price']}}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Card header-->
                </div>
                <!--end::Order details-->

                <div class="d-flex justify-content-end">
                    <!--begin::Button-->
                    <a href="../catalog/products.html" id="kt_ecommerce_edit_order_cancel" class="btn btn-light me-5">
                        Cancel
                    </a>
                    <!--end::Button-->

                    <!--begin::Button-->
                    <button type="submit" id="kt_ecommerce_edit_order_submit" class="btn btn-primary">
                        <span class="indicator-label">
                            Checkout
                        </span>
                        <span class="indicator-progress">
                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </button>
                    <!--end::Button-->
                </div>
            </div>
            <!--end::Main column-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Post-->
</div>
<!--end::Row-->

@endsection