@extends('admin.layout',['title' => 'Dashboard'])

@section('content-admin')
<!--begin::Row-->
<div class="row gy-5 g-xl-10">
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <i class="ki-duotone ki-compass fs-2hx text-gray-600">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">327</span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-400">Projects</span>
                    </div>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->
                <!--begin::Badge-->
                <span class="badge badge-light-success fs-base">
                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>2.1%</span>
                <!--end::Badge-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <i class="ki-duotone ki-chart-simple fs-2hx text-gray-600">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">27,5M</span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-400">Stock Qty</span>
                    </div>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->
                <!--begin::Badge-->
                <span class="badge badge-light-success fs-base">
                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>2.1%</span>
                <!--end::Badge-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <i class="ki-duotone ki-abstract-39 fs-2hx text-gray-600">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">149M</span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-400">Stock Value</span>
                    </div>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->
                <!--begin::Badge-->
                <span class="badge badge-light-danger fs-base">
                <i class="ki-duotone ki-arrow-down fs-5 text-danger ms-n1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>0.47%</span>
                <!--end::Badge-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
    <!--begin::Col-->
    <div class="col-sm-6 col-xl-3 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">
                <!--begin::Icon-->
                <div class="m-0">
                    <i class="ki-duotone ki-map fs-2hx text-gray-600">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                </div>
                <!--end::Icon-->
                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2">89M</span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-400">C APEX</span>
                    </div>
                    <!--end::Follower-->
                </div>
                <!--end::Section-->
                <!--begin::Badge-->
                <span class="badge badge-light-success fs-base">
                <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>2.1%</span>
                <!--end::Badge-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
    <!--end::Col-->
    
</div>
<!--end::Row-->
@endsection