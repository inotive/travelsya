@extends('admin.layout',['title' => 'Hostel','url'=> route('admin.hostel'),'breadcrumb'=>['Update Hostel']])

@section('content-admin')
<!--begin::Tables Widget 11-->
<div class="card mb-5 mb-xl-8">

    <!--begin::List widget 10-->
    <div class="card card-flush">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Update Hostel</span>
            </h3>
            <div class="card-toolbar">
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body">
            <!--begin::Nav-->
            <ul class="nav nav-pills nav-pills-custom row position-relative mx-0 mb-9">
                <!--begin::Item-->
                <li class="nav-item col-4 mx-0 p-0">
                    <!--begin::Link-->
                    <a class="nav-link active d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#kt_list_widget_10_tab_1">
                        <!--begin::Subtitle-->
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">Notable</span>
                        <!--end::Subtitle-->
                        <!--begin::Bullet-->
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                        <!--end::Bullet-->
                    </a>
                    <!--end::Link-->
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item col-4 mx-0 px-0">
                    <!--begin::Link-->
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#kt_list_widget_10_tab_2">
                        <!--begin::Subtitle-->
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">Delivered</span>
                        <!--end::Subtitle-->
                        <!--begin::Bullet-->
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                        <!--end::Bullet-->
                    </a>
                    <!--end::Link-->
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="nav-item col-4 mx-0 px-0">
                    <!--begin::Link-->
                    <a class="nav-link d-flex justify-content-center w-100 border-0 h-100" data-bs-toggle="pill"
                        href="#kt_list_widget_10_tab_3">
                        <!--begin::Subtitle-->
                        <span class="nav-text text-gray-800 fw-bold fs-6 mb-3">Shipping</span>
                        <!--end::Subtitle-->
                        <!--begin::Bullet-->
                        <span
                            class="bullet-custom position-absolute z-index-2 bottom-0 w-100 h-4px bg-primary rounded"></span>
                        <!--end::Bullet-->
                    </a>
                    <!--end::Link-->
                </li>
                <!--end::Item-->
                <!--begin::Bullet-->
                <span class="position-absolute z-index-1 bottom-0 w-100 h-4px bg-light rounded"></span>
                <!--end::Bullet-->
            </ul>
            <!--end::Nav-->
            <!--begin::Tab Content-->
            <div class="tab-content">
                <!--begin::Tap pane-->
                <div class="tab-pane fade show active" id="kt_list_widget_10_tab_1">
                    <!--begin::Item-->
                    <div class="m-0">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-sm-center mb-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-primary">
                                    <i class="ki-duotone ki-ship text-inverse-primary fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                <div class="flex-grow-1 me-2">
                                    <a href="#" class="text-gray-400 fs-6 fw-semibold">Ship Freight</a>
                                    <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>
                                </div>
                                <span class="badge badge-lg badge-light-success fw-bold my-2">Delivered</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Timeline-->
                        <div class="timeline">
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center mb-7">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px mt-6 mb-n12"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-cd fs-2 text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Messina Harbor</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Sicily, Italy</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-geolocation fs-2 text-info">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Hektor Container Hotel</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Tallin, EST</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="m-0">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-sm-center mb-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-primary">
                                    <i class="ki-duotone ki-truck text-inverse-primary fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                <div class="flex-grow-1 me-2">
                                    <a href="#" class="text-gray-400 fs-6 fw-semibold">Truck Freight</a>
                                    <span class="text-gray-800 fw-bold d-block fs-4">#0066-954784</span>
                                </div>
                                <span class="badge badge-lg badge-light-primary fw-bold my-2">Shipping</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Timeline-->
                        <div class="timeline">
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center mb-7">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px mt-6 mb-n12"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-cd fs-2 text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Haven van Rotterdam</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Rotterdam, Netherlands</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-geolocation fs-2 text-info">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Forest-Midi</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Brussels, Belgium</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="m-0">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-sm-center mb-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-primary">
                                    <i class="ki-duotone ki-delivery text-inverse-primary fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                <div class="flex-grow-1 me-2">
                                    <a href="#" class="text-gray-400 fs-6 fw-semibold">Delivery Freight</a>
                                    <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>
                                </div>
                                <span class="badge badge-lg badge-light-success fw-bold my-2">Delivered</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Timeline-->
                        <div class="timeline">
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center mb-7">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px mt-6 mb-n12"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-cd fs-2 text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Mina St - Zayed Port</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Abu Dhabi, UAE</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-geolocation fs-2 text-info">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">27 Drydock Boston</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Boston, USA</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="m-0">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-sm-center mb-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-primary">
                                    <i class="ki-duotone ki-airplane-square text-inverse-primary fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                <div class="flex-grow-1 me-2">
                                    <a href="#" class="text-gray-400 fs-6 fw-semibold">Plane Freight</a>
                                    <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>
                                </div>
                                <span class="badge badge-lg badge-light-danger fw-bold my-2">Delayed</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Timeline-->
                        <div class="timeline">
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center mb-7">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px mt-6 mb-n12"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-cd fs-2 text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">KLM Cargo</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Schipol Airport, Amsterdam</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-geolocation fs-2 text-info">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Singapore Cargo</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Changi Airport, Singapore</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end::Item-->
                </div>
                <!--end::Tap pane-->
                <!--begin::Tap pane-->
                <div class="tab-pane fade" id="kt_list_widget_10_tab_2">
                    <!--begin::Item-->
                    <div class="m-0">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-sm-center mb-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-primary">
                                    <i class="ki-duotone ki-airplane-square text-inverse-primary fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                <div class="flex-grow-1 me-2">
                                    <a href="#" class="text-gray-400 fs-6 fw-semibold">Plane Freight</a>
                                    <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>
                                </div>
                                <span class="badge badge-lg badge-light-success fw-bold my-2">Delivered</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Timeline-->
                        <div class="timeline">
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center mb-7">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px mt-6 mb-n12"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-cd fs-2 text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">KLM Cargo</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Schipol Airport, Amsterdam</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-geolocation fs-2 text-info">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Singapore Cargo</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Changi Airport, Singapore</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="m-0">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-sm-center mb-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-primary">
                                    <i class="ki-duotone ki-truck text-inverse-primary fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                <div class="flex-grow-1 me-2">
                                    <a href="#" class="text-gray-400 fs-6 fw-semibold">Truck Freight</a>
                                    <span class="text-gray-800 fw-bold d-block fs-4">#0066-954784</span>
                                </div>
                                <span class="badge badge-lg badge-light-success fw-bold my-2">Delivered</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Timeline-->
                        <div class="timeline">
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center mb-7">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px mt-6 mb-n12"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-cd fs-2 text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Haven van Rotterdam</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Rotterdam, Netherlands</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-geolocation fs-2 text-info">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Forest-Midi</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Brussels, Belgium</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="m-0">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-sm-center mb-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-primary">
                                    <i class="ki-duotone ki-ship text-inverse-primary fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                <div class="flex-grow-1 me-2">
                                    <a href="#" class="text-gray-400 fs-6 fw-semibold">Ship Freight</a>
                                    <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>
                                </div>
                                <span class="badge badge-lg badge-light-success fw-bold my-2">Delivered</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Timeline-->
                        <div class="timeline">
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center mb-7">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px mt-6 mb-n12"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-cd fs-2 text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Mina St - Zayed Port</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Abu Dhabi, UAE</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-geolocation fs-2 text-info">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">27 Drydock Boston</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Boston, USA</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="m-0">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-sm-center mb-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-primary">
                                    <i class="ki-duotone ki-ship text-inverse-primary fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                <div class="flex-grow-1 me-2">
                                    <a href="#" class="text-gray-400 fs-6 fw-semibold">Ship Freight</a>
                                    <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>
                                </div>
                                <span class="badge badge-lg badge-light-success fw-bold my-2">Delivered</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Timeline-->
                        <div class="timeline">
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center mb-7">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px mt-6 mb-n12"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-cd fs-2 text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Messina Harbor</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Sicily, Italy</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-geolocation fs-2 text-info">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Hektor Container Hotel</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Tallin, EST</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end::Item-->
                </div>
                <!--end::Tap pane-->
                <!--begin::Tap pane-->
                <div class="tab-pane fade" id="kt_list_widget_10_tab_3">
                    <!--begin::Item-->
                    <div class="m-0">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-sm-center mb-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-primary">
                                    <i class="ki-duotone ki-ship text-inverse-primary fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                <div class="flex-grow-1 me-2">
                                    <a href="#" class="text-gray-400 fs-6 fw-semibold">Ship Freight</a>
                                    <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>
                                </div>
                                <span class="badge badge-lg badge-light-primary fw-bold my-2">Shipping</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Timeline-->
                        <div class="timeline">
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center mb-7">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px mt-6 mb-n12"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-cd fs-2 text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Mina St - Zayed Port</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Abu Dhabi, UAE</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-geolocation fs-2 text-info">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">27 Drydock Boston</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Boston, USA</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="m-0">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-sm-center mb-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-primary">
                                    <i class="ki-duotone ki-airplane-square text-inverse-primary fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                <div class="flex-grow-1 me-2">
                                    <a href="#" class="text-gray-400 fs-6 fw-semibold">Plane Freight</a>
                                    <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>
                                </div>
                                <span class="badge badge-lg badge-light-primary fw-bold my-2">Shipping</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Timeline-->
                        <div class="timeline">
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center mb-7">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px mt-6 mb-n12"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-cd fs-2 text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">KLM Cargo</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Schipol Airport, Amsterdam</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-geolocation fs-2 text-info">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Singapore Cargo</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Changi Airport, Singapore</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="m-0">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-sm-center mb-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-primary">
                                    <i class="ki-duotone ki-ship text-inverse-primary fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                <div class="flex-grow-1 me-2">
                                    <a href="#" class="text-gray-400 fs-6 fw-semibold">Ship Freight</a>
                                    <span class="text-gray-800 fw-bold d-block fs-4">#5635-342808</span>
                                </div>
                                <span class="badge badge-lg badge-light-primary fw-bold my-2">Shipping</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Timeline-->
                        <div class="timeline">
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center mb-7">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px mt-6 mb-n12"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-cd fs-2 text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Messina Harbor</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Sicily, Italy</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-geolocation fs-2 text-info">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Hektor Container Hotel</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Tallin, EST</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end::Item-->
                    <!--begin::Separator-->
                    <div class="separator separator-dashed my-6"></div>
                    <!--end::Separator-->
                    <!--begin::Item-->
                    <div class="m-0">
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-sm-center mb-5">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-primary">
                                    <i class="ki-duotone ki-truck text-inverse-primary fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Section-->
                            <div class="d-flex align-items-center flex-row-fluid flex-wrap">
                                <div class="flex-grow-1 me-2">
                                    <a href="#" class="text-gray-400 fs-6 fw-semibold">Truck Freight</a>
                                    <span class="text-gray-800 fw-bold d-block fs-4">#0066-954784</span>
                                </div>
                                <span class="badge badge-lg badge-light-primary fw-bold my-2">Shipping</span>
                            </div>
                            <!--end::Section-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Timeline-->
                        <div class="timeline">
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center mb-7">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px mt-6 mb-n12"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-cd fs-2 text-danger">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Haven van Rotterdam</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Rotterdam, Netherlands</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                            <!--begin::Timeline item-->
                            <div class="timeline-item align-items-center">
                                <!--begin::Timeline line-->
                                <div class="timeline-line w-40px"></div>
                                <!--end::Timeline line-->
                                <!--begin::Timeline icon-->
                                <div class="timeline-icon" style="margin-left: 11px">
                                    <i class="ki-duotone ki-geolocation fs-2 text-info">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                                <!--end::Timeline icon-->
                                <!--begin::Timeline content-->
                                <div class="timeline-content m-0">
                                    <!--begin::Title-->
                                    <span class="fs-6 text-gray-400 fw-semibold d-block">Forest-Midi</span>
                                    <!--end::Title-->
                                    <!--begin::Title-->
                                    <span class="fs-6 fw-bold text-gray-800">Brussels, Belgium</span>
                                    <!--end::Title-->
                                </div>
                                <!--end::Timeline content-->
                            </div>
                            <!--end::Timeline item-->
                        </div>
                        <!--end::Timeline-->
                    </div>
                    <!--end::Item-->
                </div>
                <!--end::Tap pane-->
            </div>
            <!--end::Tab Content-->
        </div>
        <!--end: Card Body-->
    </div>
    <!--end::List widget 10-->
</div>
<!--end::Tables Widget 11-->


{{-- modal --}}
<!--begin::Modal - New Target-->
<div class="modal fade" id="create" tabindex="-1" aria-hidden="true">
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
                <form id="kt_modal_new_target_form" class="form" method="post" action="{{route('admin.fee.store')}}">
                    @csrf
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Create Fee Admin</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Category</label>
                            <input type="text" name="category" class="form-control form-control-solid"
                                placeholder="Category">
                            @error('category')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Name</label>
                            <input type="text" name="name" class="form-control form-control-solid" placeholder="Name">
                            @error('name')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Value</label>
                            <input type="text" name="value" class="form-control form-control-solid" placeholder="Value">
                            @error('value')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Percent ?</label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Percent" name="is_percent" id="is_percent">
                                <option value="">Select percent...</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('is_percent')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
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
</div>
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
                <form id="kt_modal_new_target_form" class="form" method="post" action="{{route('admin.fee.update')}}">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Update Fee Admin</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Category</label>
                            <input type="text" name="category" id="category" class="form-control form-control-solid"
                                placeholder="Category">
                            @error('category')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Name</label>
                            <input type="text" name="name" id="name" class="form-control form-control-solid"
                                placeholder="Name">
                            @error('name')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Value</label>
                            <input type="text" name="value" id="value" class="form-control form-control-solid"
                                placeholder="Value">
                            @error('value')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Percent ?</label>
                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                                data-placeholder="Percent" name="is_percent" id="percent">
                                <option value="">Select percent...</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            @error('is_percent')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
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
</div>
<!--end::Modal - New Target-->
@endsection

@push('add-script')
<script>
    $(function () {
        $('#edit').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var category = button.data('category');
            var name = button.data('name');
            var value = button.data('value');
            var is_percent = button.data('is_percent');

            var modal = $(this);
            modal.find('#id').val(id);
            modal.find('#category').val(category);
            modal.find('#name').val(name);
            modal.find('#value').val(value);
            $(`#percent option[value=${is_percent}]`).attr('selected', 'selected');

        });
    });

</script>
@endpush
