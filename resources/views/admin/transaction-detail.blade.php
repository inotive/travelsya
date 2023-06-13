@extends('admin.layout',['title' => 'Transaction','url' =>route('admin.transaction'),'breadcrumb'=>['Detail']])

@section('content-admin')

@if($transaction->service == 'hostel')
<div class="row">
    <div class="col-md-4">
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Customer Detail</span>
                </h3>
                 <!--begin::Table container-->
                 <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-125px rounded-start">Name</th>
                                <th class="min-w-125px">KTP/NPWP</th>
                                <th class="min-w-125px">Identity</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach($transaction->guest as $tr)
                            <tr>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$tr->name}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$tr->type_id}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$tr->identity}}</div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <div class="col-md-4">
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Room List</span>
                </h3>
                 <!--begin::Table container-->
                 <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-125px rounded-start">Name</th>
                                <th class="min-w-125px">Bed Type</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach($transaction->detailTransaction as $tr)
                            <tr>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$tr->hostelRoom->name}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$tr->hostelRoom->bed_type}}</div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
    <div class="col-md-4">
        <!--begin::Card-->
        <div class="card mb-7">
            <!--begin::Card body-->
            <div class="card-body">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Book Date</span>
                </h3>
                 <!--begin::Table container-->
                 <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle gs-0 gy-4">
                        <!--begin::Table head-->
                        <thead>
                            <tr class="fw-bold text-muted bg-light">
                                <th class="ps-4 min-w-125px rounded-start">Start</th>
                                <th class="min-w-125px">End</th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach($transaction->bookDate as $tr)
                            <tr>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$tr->start}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$tr->end}}</div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
</div>
@endif
<!--begin::Tab Content-->
<div class="tab-content">
    <!--begin::Tab pane-->
    <div id="kt_project_users_table_pane" class="tab-pane fade show active">
        <!--begin::Tables Widget 11-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label fw-bold fs-3 mb-1">Detail</span>
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
                                <th class="min-w-125px">Product</th>
                                @if(str_contains($transaction->service,'ppob'))
                                <th class="min-w-125px">No Pelanggan</th>
                                <th class="min-w-125px">Category</th>
                                @endif
                                <th class="min-w-125px">Price</th>
                                <th class="min-w-125px">Status</th>
                                <th class="min-w-200px text-end rounded-end"></th>
                            </tr>
                        </thead>
                        <!--end::Table head-->
                        <!--begin::Table body-->
                        <tbody>
                            @foreach($transaction->detailTransaction as $tr)
                            <tr>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$tr->created_at}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$tr->product != null ? $tr->product->name : $tr->hostelRoom->hostel->name}}</div>
                                </td>
                                @if(str_contains($transaction->service,'ppob'))
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$tr->no_hp}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$tr->product->category}}</div>
                                </td>
                                @endif
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$tr->price}}</div>
                                </td>
                                <td>
                                    <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{$tr->status}}
                                    </div>
                                </td>
                                <td class="text-end">
                                    <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit" data-idtr="{{$transaction->id}}" data-id="{{$tr->id}}" data-status="{{$tr->status}}" data-bs-toggle="modal" data-bs-target="#updateStatus">
                                        <i class="ki-duotone ki-switch fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
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

<!--begin::Modal - New Target-->
<div class="modal fade" id="updateStatus" tabindex="-1" aria-hidden="true">
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
                <form id="kt_modal_new_target_form" class="form" method="post" action="{{route('admin.transaction.detail.update')}}">
                    @method('put')
                    @csrf
                    <input type="hidden" name="id" id="id">
                    <input type="hidden" name="idtr" id="idtr">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Update Status</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-semibold mb-2">Status</label>
                            <select class="form-select form-select-solid" id="status" name="status">
                                <option value="SUCCESS">SUCCESS</option>
                                <option value="FAILED">FAILED</option>
                                <option value="EXPIRED">EXPIRED</option>
                            </select>
                        </div>
                        <!--end::Col-->
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
 $(function() {
    $('#updateStatus').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var status = button.data('status') != ?:"";
        var id = button.data('id');
        var idtr = button.data('idtr');
        var modal = $(this);
        $(`#status option[value=${status}]`).attr('selected','selected');
        modal.find('#id').val(id);
        modal.find('#idtr').val(idtr);
    });
});
</script>
@endpush