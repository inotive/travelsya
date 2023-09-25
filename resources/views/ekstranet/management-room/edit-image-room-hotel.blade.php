<div class="modal fade" id="modal-edit-image" tabindex="-1" aria-hidden="true">
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
                    <input type="hidden" id="hotel_room_images_id" name="hotel_room_images_id">
                    <input type="hidden" id="hotel_room_id" name="hotel_room_id">
                    <input type="hidden" id="hotel_id" name="hotel_id">



                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Edit Room Hotel Image</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->

                    <div class="row g-9 mb-8">


                        {{-- IMAGE --}}

                        <div class="col-md-12 ">
                            <label class="required fs-6 fw-semibold mb-2">Gambar</label>
                            <img id="image-preview" src="" alt="Preview Gambar"
                                style="max-width: 200px; display: none;">
                            <input type="file" name="image" class="form-control image-file" id="image"
                                accept="image/*">
                            @error('image')
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
                </form>
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


@push('add-script')
    <script>
        $('body').on('click', '#btn-edit-image', function() {
            let hotel_room_images_id = $(this).data('id');

            $.ajax({
                url: `showimage/${hotel_room_images_id}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    $('#hotel_room_images_id').val(response.data[0].id);
                    $('#hotel_room_id').val(response.data[0].hotel_room_id);
                    $('#hotel_id').val(response.data[0].hotel_id);
                    $('#image-preview').attr('src', '{{ asset('') }}' + response
                        .data[0].image);
                    $('#image-preview').show();

                    $('#modal-edit-image').modal('show');
                }
            });
        });

        $('#update').click(function(e) {
            e.preventDefault();

            // Define variables
            let hotel_room_images_id = $('#hotel_room_images_id').val();
            let hotel_room_id = $('#hotel_room_id').val();
            let hotel_id = $('#hotel_id').val();
            let image = $('.image-file')[0].files[0];
            let token = $("meta[name='csrf-token']").attr("content");

            // Create FormData object
            let formdata = new FormData($('#updateForm')[0]);
            

            // Ajax request
            $.ajax({
                url: `updateimage/${hotel_room_images_id}`,
                type: "POST",
                cache: false,
                data: formdata, // Change this to POST if your server handles updates with POST requests
                processData: false,
                contentType: false,


                success: function(response) {
                    $('#modal-edit-image').modal('hide');
                    location.reload();
                },
                error: function(error) {
                    if (error.responseJSON && error.responseJSON.name && error.responseJSON.name[0]) {
                        // Show alert

                        $('#alert-edit-image').removeClass('d-none').addClass('d-block');



                        // Add message to alert
                        $('#alert-edit-image').html(error.responseJSON.name[0]);

                    }
                }
            });
        });
    </script>
@endpush
