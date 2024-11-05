    <!--begin::Modal - New Target-->
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
                        </i>
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form id="kt_modal_new_target_form" class="form" method="post" enctype="multipart/form-data">
                        @csrf
                        {{-- @method('PUT') --}}
                        {{-- <input type="hidden" name="id" id="id"> --}}
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Edit Image</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <div class="form-group">
                                <label class="font-weight-bold">Gambar Kota</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image-edit">
                                <input type="hidden" name="" id="city_id-edit">
                                <!-- error message untuk title -->
                                @error('image')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>


                            {{-- <input type="hidden" name="category" value="Harian"> --}}


                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <div class="row">
                                <div class="col-6">
                                    <button type="reset" id="kt_modal_new_target_cancel"
                                        class="btn btn-light me-3">Cancel
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" id="update" class="btn btn-primary">
                                        Perbarui
                                    </button>
                                </div>
                            </div>


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

<script>
    $('body').on('click', '#btn-edit-post', function() {
        let city_id = $(this).data('city_id');

        // Fetch detail post with ajax
        $.ajax({
            url: `/admin/management-city/edit/${city_id}`, // Sesuaikan dengan rute yang benar
            type: "GET",
            data: { city_id: city_id }, // Mengirim parameter city_id
            cache: false,
            success: function(response) {
                //fill data to form
                $('#city_id-edit').val(response[0][0].city_id);
                $('#image-edit').attr('src', response[0][0].image);

                // Buka modal
                $('#modal-edit').modal('show');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

$('#update').click(function(e) {
    e.preventDefault();
    let city_id = $('#city_id-edit').val();
    let image_edit = $('#image-edit')[0].files[0]; // Mengambil file gambar

    let formData = new FormData();
    formData.append('image', image_edit); // Mengirim file gambar sebagai FormData

    // Mendapatkan token CSRF dari elemen meta
    let csrfToken = $("meta[name='csrf-token']").attr("content");
    formData.append("_token", csrfToken); // Menambahkan token CSRF ke FormData

    $.ajax({
        url: `/admin/management-city/update/${city_id}`,
        type: "POST", // Ubah ke POST untuk mengirim FormData
        cache: false,
        data: formData, // Mengirim FormData
        contentType: false, // Tetapkan contentType dan processData ke false
        processData: false,
        success: function(response) {
            $('#modal-edit').modal('hide');
            location.reload();
        },
    });
});


</script>
