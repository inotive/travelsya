@extends('admin.layout',['title' => 'Transaction','url' => route('admin.transaction')])

@section('content-admin')

<!--begin::Form-->
<form action="#" method="get">
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
                        @if(auth()->user()->role == 0)
                        <div class="col-lg-3">
                            <!--begin::Select-->
                            <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Layanan" data-hide-search="true" name="service">
                                <option value=""></option>
                                <option value="pulsa">Pulsa</option>
                                <option value="data">Data</option>
                                <option value="pln">PLN</option>
                                <option value="hostel">Hostel</option>
                            </select>
                            <!--end::Select-->

                        </div>
                        @endif
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
        <h3 class="fw-bold me-5 my-1">{{$transactions->count()}} Items Found
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
                    <span class="card-label fw-bold fs-3 mb-1">List Transaction</span>
                </h3>
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
                                <th class="min-w-125px">Status</th>
                                <th class="min-w-150px text-end rounded-end"></th>
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
                                    <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit"
                                    data-id="{{$transaction->id}}" data-bs-toggle="modal" data-bs-target="#editstatus">
                                        <i class="ki-duotone ki-switch fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <a href="{{route('admin.transaction.detail',$transaction->id)}}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit"
                                        data-id="{{$transaction->id}}">
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
                        <tfoot>
                            <tr>
                                <td>
                                  {{$transactions->appends(request()->input())->links('vendor.pagination.bootstrap-5')}}
                              </td>
                            </tr>
                          </tfoot>
                        <!--end::Table body-->
                    </table>
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
