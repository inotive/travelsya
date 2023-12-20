@extends('admin.layout', ['title' => 'Fee', 'url' => '#'])

@section('content-admin')
    <!--begin::Tables Widget 11-->
    <div class="card mb-5 mb-xl-8">
        <!--begin::Header-->
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">List Fee Admin</span>
            </h3>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body py-3">
            <!--begin::Table container-->
            <div class="table-responsive">
                <table class="table-row-dashed fs-6 gy-5 table-bordered table align-middle"
                    id="kt_datatable_zero_configuration">
                    <thead>
                        <tr class="fw-bold fs-6 text-gray-800">
                            <th class="text-center">No.</th>
                            <th class="text-center">Layanan</th>
                            <th class="text-center">Tipe Biaya Admin</th>
                            <th class="text-center">Besaran Biaya Admin</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fees as $fee)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ strtoupper($fee->service->name) }}</td>
                                <td class="text-center">{{ $fee->percent == 1 ? 'Presentase' : 'Rupiah' }}</td>
                                <td class="text-center">
                                    @if ($fee->percent == 1)
                                        {{ $fee->value }} %
                                    @else
                                        Rp. {{ number_format($fee->value, 0, ',', '.') }}
                                    @endif

                                </td>
                                <td class="text-center"><button class="btn btn-sm btn-primary" data-id="{{ $fee->id }}"
                                        data-bs-toggle="modal" data-bs-target="#edit"
                                        id="btn-edit-post">Edit Biaya</button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{--                <!--begin::Table--> --}}
                {{--                <table class="table align-middle gs-0 gy-4"> --}}
                {{--                    <!--begin::Table head--> --}}
                {{--                    <thead> --}}
                {{--                        <tr class="fw-bold text-muted bg-light"> --}}
                {{--                            <th class="min-w-75px ps-4 rounded-start">Category</th> --}}
                {{--                            <th class="min-w-125px">Layanan</th> --}}
                {{--                            <th class="min-w-125px">Value</th> --}}
                {{--                            <th class="min-w-125px">Percent</th> --}}
                {{--                            <th class="min-w-150px text-end rounded-end"></th> --}}
                {{--                        </tr> --}}
                {{--                    </thead> --}}
                {{--                    <!--end::Table head--> --}}
                {{--                    <!--begin::Table body--> --}}
                {{--                    <tbody> --}}

                {{--                        @foreach ($fees as $managementfee) --}}
                {{--                        <tr> --}}
                {{--                            <td> --}}
                {{--                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$management-fee->category}}</div> --}}
                {{--                            </td> --}}
                {{--                            <td> --}}
                {{--                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$management-fee->name}}</div> --}}
                {{--                            </td> --}}
                {{--                            <td> --}}
                {{--                                <div class="text-dark fw-bold text-hover-primary mb-1 fs-6">{{$management-fee->value}}</div> --}}
                {{--                            </td> --}}
                {{--                            <td> --}}
                {{--                                <div class="text-dark fw-bold text-hover-primary d-block mb-1 fs-6">{{($management-fee->is_percent) ? "Yes" : "No"}} --}}
                {{--                                </div> --}}
                {{--                            </td> --}}
                {{--                            <td class="text-end"> --}}
                {{--                                <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1 btn-edit" --}}
                {{--                                    data-id="{{$management-fee->id}}" data-category="{{$management-fee->category}}" data-name="{{$management-fee->name}}" data-value="{{$management-fee->value}}" data-is_percent="{{$management-fee->is_percent}}" data-bs-toggle="modal" data-bs-target="#edit"> --}}
                {{--                                    <i class="ki-duotone ki-pencil fs-2"> --}}
                {{--                                        <span class="path1"></span> --}}
                {{--                                        <span class="path2"></span> --}}
                {{--                                    </i> --}}
                {{--                                </a> --}}
                {{--                            </td> --}}
                {{--                        </tr> --}}
                {{--                        @endforeach --}}
                {{--                    </tbody> --}}
                {{--                    <tfoot> --}}
                {{--                        <tr> --}}
                {{--                            <td> --}}
                {{--                                {{$fees->appends(request()->input())->links('vendor.pagination.bootstrap-5')}} --}}
                {{--                            </td> --}}
                {{--                        </tr> --}}
                {{--                        </tfoot> --}}
                {{--                    <!--end::Table body--> --}}
                {{--                </table> --}}
                {{--                <!--end::Table--> --}}
            </div>
            <!--end::Table container-->
        </div>
        <!--begin::Body-->
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
                    <form id="kt_modal_new_target_form" class="form" method="post"
                        action="{{ route('admin.management-fee.store') }}">
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
                            <div class="col-md-12 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Category</label>
                                <select class="form-select form-select-solid" name="service_id">
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                                    @endforeach
                                </select>
                                @error('service_id')
                                    <span class="text-danger mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Type</label>
                                <select class="form-select form-select-solid" name="percent">
                                    <option value="0">Rupiah</option>
                                    <option value="1">Presentase</option>
                                </select>
                                @error('percent')
                                    <span class="text-danger mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Value</label>
                                <input type="text" name="value" class="form-control form-control-solid"
                                    placeholder="Value">
                                @error('value')
                                    <span class="text-danger mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3">Cancel</button>
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
                    {{-- <form id="kt_modal_new_target_form" class="form" method="post"
                        action="{{ route('admin.management-fee.update') }}">
                        @method('put')
                        @csrf --}}
                        <input type="hidden" name="id" id="id">
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Ubah Biaya Admin</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Layanan</label>
                                <select class="form-select" id="service_id" disabled>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}">{{ strtoupper($service->name) }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" id="service_id" name="service_id">
                                @error('service_id')
                                    <span class="text-danger mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-semibold mb-2">Tipe Biaya Admin</label>
                                <select class="form-select" id="percent" name="percent">
                                    <option value="0">Rupiah</option>
                                    <option value="1">Presentase</option>
                                </select>
                                @error('percent')
                                    <span class="text-danger mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6 fv-row">
                                <label class="form-label required">Besaran Biaya Admin</label>

                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">Rp. </span>
                                    <input type="text" name="value" class="form-control"
                                           id="value" placeholder="Value">
                                </div>
                                @error('value')
                                    <span class="text-danger mt-1" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="d-flex justify-content-between">

                            <button type="reset" id="kt_modal_new_target_cancel"
                                class="btn btn-light me-3 w-100">Cancel</button>
                            <button type="submit" id="update" class="btn btn-primary w-100">
                                <span class="indicator-label">Simpan Perubahan</span>
                                <span class="indicator-progress">Please wait...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
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
    <!--end::Modal - New Target-->
@endsection

@push('add-script')
    <script>
        //  $(function() {
        //     $('#edit').on('show.bs.modal', function(event) {
        //         var button = $(event.relatedTarget);
        //         var id = button.data('id');
        //         var category = button.data('category');
        //         var name = button.data('name');
        //         var value = button.data('value');
        //         var is_percent = button.data('is_percent');

        //         var modal = $(this);
        //         modal.find('#id').val(id);
        //         modal.find('#category').val(category);
        //         modal.find('#name').val(name);
        //         modal.find('#value').val(value);
        //         $(`#percent option[value=${is_percent}]`).attr('selected','selected');

        //     });
        // });



        $('body').on('click', '#btn-edit-post', function() {
            let fee_id = $(this).data('id');

            $.ajax({
                url: `/admin/management-fee/${fee_id}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    $('#id').val(response.data.id);
                    $('#service_id').val(response.data.service_id);
                    $('#percent').val(response.data.percent);
                    $('#value').val(response.data.value);


                    $('#edit').modal('show');
                }
            });
        });

        $('#update').click(function(e) {
            e.preventDefault();

            let fee_id = $('#id').val();
            let service_id = $('#service_id').val();
            let percent = $('#percent').val();
            let value = $('#value').val();
            let token = $("meta[name='csrf-token']").attr("content");

            //ajax
            // alert(fee_id);
            $.ajax({

                url: `/admin/management-fee/edit/${fee_id}`,
                type: "PUT",
                cache: false,
                data: {
                    "service_id": service_id,
                    "value": value,
                    "percent": percent,
                    "_token": token
                },


                success: function(response) {
                    $('#edit').modal('hide');
                    location.reload();
                },
                error: function(error) {
                    $('#edit').modal('hide');
                    location.reload();
                }
            });
        });


        $(document).ready(function() {
            $('#kt_datatable_zero_configuration').DataTable({
                "scrollY": "500px",
                "scrollCollapse": true,
                "language": {
                    "lengthMenu": "Show _MENU_",
                },
                "dom": "<'row'" +
                    "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
                    "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
                    ">" +

                    "<'table-responsive'tr>" +

                    "<'row'" +
                    "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
                    "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
                    ">"
            });
        });
    </script>
@endpush
