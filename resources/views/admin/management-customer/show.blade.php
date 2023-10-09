<div class="modal fade" id="history" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-1000px">
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
                {{-- <form id="kt_modal_new_target_form" class="form" action="#"> --}}
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">History Transaksi - Pelanggan X</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        {{-- <div class="text-muted fw-semibold fs-5">If you need more info, please check
                            <a href="#" class="fw-bold link-primary">Project Guidelines</a>.
                        </div> --}}
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <div class="card-body py-3">
                        <!--begin::Table container-->
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-bordered gs-0 gy-4 text-center">
                                <!--begin::Table head-->
                                <thead>
                                <tr class="fw-bold text-muted bg-light">
                                    {{-- <th class="ps-4 rounded-start">No</th> --}}
                                    <th class="min-w-125px">Tanggal</th>
                                    <th class="min-w-125px">Invoice</th>
                                    <th class="min-w-50px">Layanan</th>
                                    <th class="min-w-50px">Custom</th>
                                    <th class="min-w-125px">Deskripsi</th>
                                    <th class="min-w-125px">Metode</th>
                                    <th class="min-w-125px">Grand</th>
                                    <th class="min-w-125px">Point</th>
                                </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody>
                                {{-- @foreach($customers as $customer) --}}
                                    <tr>
                                        <td>
                                            <div class="text-dark fw-bold  mb-1 fs-6">12 A 123</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold  d-block mb-1 fs-6">INV-20230622-HOSTEL-1687467039</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold  d-block mb-1 fs-6">Pulsa</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold  d-block mb-1 fs-6">Custom</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold  d-block mb-1 fs-6">HOTEL GRAND - SAS</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold  d-block mb-1 fs-6">Bank</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold  d-block mb-1 fs-6">Rp</div>
                                        </td>
                                        <td>
                                            <div class="text-dark fw-bold  d-block mb-1 fs-6">25 Point</div>
                                        </td>
                                    </tr>
                                {{-- @endforeach --}}
            
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            {{-- {{$customers->appends(request()->input())->links('vendor.pagination.bootstrap-5')}} --}}
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--begin::Input group-->
                    <!--end::Actions-->
                {{-- </form> --}}
                <!--end:Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>