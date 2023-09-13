<div class="modal fade" id="modal-edit" tabindex="-1" aria-hidden="true">
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
                        <span aria-hidden="true">&times;</span>

                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <form id="updateForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="facility_id">

                    <!--begin:Form-->
                    {{-- @csrf
                @method('PUT')
                <form id="edit-form" class="form" method="post"
                    action="{{ route('admin.hostel.update', $hostel->id) }}">
                    @csrf --}}

                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Edit Fasilitas</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Icon</label>
                            <img id="image-preview" src="" alt="Preview Gambar"
                                style="max-width: 200px; display: none;">
                            <input type="file" name="image" class="form-control image-file" id="image-file"
                                accept="image/*">
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-edit-image"></div>
                            @error('image')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="required fs-6 fw-semibold mb-2">Nama</label>
                            <input class="form-control form-control-lg edit-name" id="edit-name"
                                placeholder="Masukan nama hostel" name="name" required />
                            <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-edit-name"></div>

                            @error('name')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- <input type="hidden" name="category" value="Harian"> --}}

                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="text-center">
                        <div class="row">
                            <div class="col-6">
                                <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel
                                </button>
                            </div>
                            <div class="col-6">
                                <button type="submit" id="update" id="kt_modal_new_target_submit"
                                    class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                    <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                            </div>
                        </div>


                    </div>
                    <!--end::Actions-->
                    {{-- </form> --}}
                    <!--end:Form-->
                </form>
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $('body').on('click', '#btn-edit-post', function() {


        let facility_id = $(this).data('id');

        $.ajax({
            url: `/admin/facility/${facility_id}`,
            type: "GET",
            cache: false,
            success: function(response) {
                $('#facility_id').val(response.data.id);
                $('#image-preview').attr('src', response.data.icon);
                $('#image-preview').show();
                $('#edit-name').val(response.data.name);


                $('#modal-edit').modal('show');
            }
        });
    });
    $('#update').click(function(e) {
        e.preventDefault();

        //define variable
        let facility_id = $('#facility_id').val();
        let icon = $('#image-file')[0].files[0];
        let name = $('#edit-name').val();
        let token = $("meta[name='csrf-token']").attr("content");

        let formData = new FormData($('#updateForm')[0]);

        //ajax
        $.ajax({

            url: `/admin/facility/${facility_id}`,
            type: "POST",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,

            success: function(response) {

                $('#modal-edit').modal('hide');
                location.reload();




            },
            error: function(error) {

                if (error.responseJSON.name[0]) {

                    //show alert
                    $('#alert-edit-icon').removeClass('d-none');
                    $('#alert-edit-icon').addClass('d-block');
                    $('#alert-edit-name').removeClass('d-none');
                    $('#alert-edit-name').addClass('d-block');




                    //add message to alert
                    $('#alert-edit-icon').html(error.responseJSON.name[0]);
                    $('#alert-edit-name').html(error.responseJSON.name[0]);


                }

            }

        });

    });
</script>
