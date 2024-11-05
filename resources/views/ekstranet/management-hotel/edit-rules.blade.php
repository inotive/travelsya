<div class="modal fade" id="modal-edit-rule" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary"
                    data-bs-dismiss="modal">
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

                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Update Peraturan</h1>
                    <!--end::Title-->
                </div>
                <input type="hidden" id="rule_id">
                <input type="hidden" id="hotel_id">


                <!--end::Heading-->
                <!--begin::Input group-->
                <div class="g-9 mb-8 row">
                    <div class="col-md-12">
                        <label class="required fs-6 fw-semibold mb-2">Nama</label>
                        <input type="text"
                            class="form-control form-control-lg name-edit" id="description-edit"
                            required />
                        <div class="alert alert-danger mt-2 d-none" role="alert"
                            id="alert-description-edit"></div>

                        @error('description')
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
                        class="btn btn-light me-3">Cancel
                    </button>
                    <button type="submit" id="update" class="btn btn-primary">
                        <span class="indicator-label">Update</span>
                        <span class="indicator-progress">Please wait...
                            <span
                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
                <!--end::Actions-->


            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
@push('add-script')

<script>

$('body').on('click', '#btn-edit-rule', function() {
    let rule_id = $(this).data('id');
    // alert(rule_id);
    $.ajax({
        url: `show/rules/${rule_id}`,
        type: "GET",
        cache: false,

        success: function(response) {
            $('#rule_id').val(response.data[0].id);
            $('#hotel_id').val(response.data[0].hotel_id);
            $('#description-edit').val(response.data[0].description);

            $('#modal-edit-rule').modal('show');
        }
    });
});
$('#update').click(function(e) {
    e.preventDefault();

    //define variable
    let rule_id = $('#rule_id').val();
    let hotel_id = $('#hotel_id').val();
    let description = $('#description-edit').val();
    let token = $("meta[name='csrf-token']").attr("content");

    //ajax
    $.ajax({

        url: `${rule_id}`,
        type: "PUT",
        cache: false,
        data: {
            "hotel_id": hotel_id,
            "description": description,
            "_token": token
        },
        success: function(response) {

            $('#modal-edit-rule').modal('hide');
            location.reload();


        },
        error: function(error) {

            if (error.responseJSON.name[0]) {

                //show alert
                $('#alert-name-edit').removeClass('d-none');
                $('#alert-name-edit').addClass('d-block');


                //add message to alert
                $('#alert-name-edit').html(error.responseJSON.name[0]);

            }

        }

    });

});
</script>
@endpush 