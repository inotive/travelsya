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

                <input type="hidden" id="hostel_id">
                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Update Mitra</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <!--begin::Input group-->
                <div class="g-9 mb-8 row">
                    <div class="col-md-12">
                        <label class="required fs-6 fw-semibold mb-2">Nama</label>
                        <input type="text" class="form-control form-control-lg name-edit" id="name-edit" required />
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>
                    <div class="col-md-12">
                        <label class="required fs-6 fw-semibold mb-2">Mitra</label>
                        <select class="form-select form-select-solid user_id-edit" id="user_id-edit">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>
                    <div class="col-md-12">
                        <label class="required fs-6 fw-semibold mb-2">Active</label>
                        <select class="form-select form-select-solid is_active-edit" name="is-active-edit" id="is_active-edit">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>
                    <div class="col-12">
                        <label for="" class="form-label">Alamat</label>
                        <textarea id="address-edit" cols="30" rows="5" class="form-control address-edit"></textarea>
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="website" class="form-label">Website</label>
                        <input type="text" id="website-edit" class="form-control website-edit"
                            placeholder="Masukan website">
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>

                    <div class="col-md-12">
                        <label class="required fs-6 fw-semibold mb-2">City</label>
                        <select name="city-edit" id="city-edit" class="form-control city-edit">
                            <option value="Balikpapan">Balikpapan</option>
                            <option value="Samarinda">Samarinda</option>
                            <option value="Banjarmasin">Banjarmasin</option>
                        </select>
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>

                    <!--begin::Input group for image upload-->
                    <div class="col-md-12">
                        <label class="fs-6 fw-semibold mb-2">Logo/ Gambar Hostel</label>
                        <input class="form-control form-control-lg" type="file" id="image-edit" name="image" accept="image/*" />
                        <div class="form-text">Pilih gambar logo atau gambar utama hostel (opsional)</div>
                    </div>
                    <!--end::Input group for image upload-->

                    <div class="col-md-12">
                        <label class="required fs-6 fw-semibold mb-2">Bintang</label>

                        <!--begin::Radio group-->
                        <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                            <!--begin::Radio-->
                            <label class="btn btn-outline btn-color-muted btn-active-success input-star-1"
                            data-kt-button="true">
                            <!--begin::Input-->
                            <input class="btn-check input-star-1" type="radio" name="star-edit" id="star-edit-1"
                                checked="checked" value="1" />
                            <!--end::Input-->
                            1
                        </label>
                            <!--end::Radio-->

                            <!--begin::Radio-->
                            <label class="btn btn-outline btn-color-muted btn-active-success input-star-2"
                                data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check input-star-2" type="radio" name="star-edit" id="star-edit-2"
                                    checked="checked" value="2" />
                                <!--end::Input-->
                                2
                            </label>
                            <!--end::Radio-->

                            <!--begin::Radio-->
                            <label class="btn btn-outline btn-color-muted btn-active-success input-star-3"
                                data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check input-star-3" type="radio" name="star-edit" id="star-edit-3"
                                    value="3" />
                                <!--end::Input-->
                                3
                            </label>
                            <!--end::Radio-->

                            <!--begin::Radio-->
                            <label class="btn btn-outline btn-color-muted btn-active-success input-star-4"
                                data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check input-star-4" type="radio" name="star-edit" id="star-edit-4"
                                    value="4" />
                                <!--end::Input-->
                                4
                            </label>
                            <!--end::Radio-->
                            <!--begin::Radio-->
                            <label class="btn btn-outline btn-color-muted btn-active-success input-star-5"
                                data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check input-star-5" type="radio" name="star-edit" id="star-edit-5"
                                    value="5" />
                                <!--end::Input-->
                                5
                            </label>
                            <!--end::Radio-->
                        </div>
                        <!--end::Radio group-->
                    </div>
                </div>
                <!--end::Input group-->
                <!--begin::Actions-->
                <div class="text-center">
                    <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel
                    </button>
                    <button type="submit" id="update" class="btn btn-primary update">
                        <span class="indicator-label">Update</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
<!--end::Modal - New Target-->
<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js') }}"></script>
<script src="{{ url('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js') }}"></script>
<script src="{{ url('//cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    // function EditData(id) {

    //     alert(id);

    // //     if (!id) {
    // //     console.error("Invalid id parameter");
    // //     return;
    // // }

    //     .ajax({
    //     url: '{{ route('admin.hostel.show', ['hostel' => 'id']) }}/' ,
    //     type: "GET",
    //     cache: false,
    //     success:function(response){
    //         $('#hostel_id').val(response.data.id);
    //         $('.name-edit').val(response.data.name);
    //         $('.user_id-edit').val(response.data.user_id);
    //         $('.is_active-edit').val(response.data.is_active);
    //         $('.address-edit').val(response.data.address);
    //         $('.city-edit').val(response.data.city);
    //         $('.website-edit').val(response.data.website);
    //         $('#star-edit').val(response.data.star);
    //         var star = response.data.star;
    //         if (star == 1){
    //             $(".input-star-1").addClass("active");
    //         }else if(star == 2){
    //             $(".input-star-2").addClass("active");
    //         }else if(star == 3){
    //             $(".input-star-3").addClass("active");
    //         }else if(star == 4){
    //             $(".input-star-4").addClass("active");
    //         }else if(star == 5){
    //             $(".input-star-5").addClass("active");
    //         }


    //         $('#modal-edit').modal('show');
    //     }
    // });
    // };
    //     $("#btn-edit-post").click(function(){
    //   alert("The paragraph was clicked.");
    // });
    $('body').on('click', '#btn-edit-post', function() {


        let hostel_id = $(this).data('id');
        $(`.is-invalid`).removeClass('is-invalid').next().empty().addClass('d-none')

        $.ajax({
            url: `/admin/management-mitra/hostel/${hostel_id}`,
            type: "GET",
            cache: false,
            success: function(response) {
                $('#hostel_id').val(response.data.id);
                $('#name-edit').val(response.data.name);
                $('#user_id-edit').val(response.data.user_id);
                $('#is_active-edit').val(response.data.is_active);
                $('#address-edit').val(response.data.address);
                $('#city-edit').val(response.data.city);
                $('#website-edit').val(response.data.website);
                $('#star-edit').val(response.data.star);
                var star = response.data.star;
                if (star == 1) {
                    $(".input-star-1").addClass("active");
                } else if (star == 2) {
                    $(".input-star-2").addClass("active");
                } else if (star == 3) {
                    $(".input-star-3").addClass("active");
                } else if (star == 4) {
                    $(".input-star-4").addClass("active");
                } else if (star == 5) {
                    $(".input-star-5").addClass("active");
                }


                $('#modal-edit').modal('show');
            }
        });
    });
    $('#update').click(function(e) {
        e.preventDefault();

        //define variable
        let hostel_id = $('#hostel_id').val();
        let user_id = $('#user_id-edit').val();
        let name = $('.name-edit').val();
        let is_active = $('#is_active-edit').val();
        let address = $('#address-edit').val();
        let website = $('#website-edit').val();
        let star = $('input[name=star-edit]:checked').val();
        let city = $('#city-edit').val();
        let image = document.getElementById('image-edit').files[0];
        let token = $("meta[name='csrf-token']").attr("content");

        // Create FormData object to handle file upload
        let formData = new FormData();
        formData.append('name', name);
        formData.append('user_id', user_id);
        formData.append('is_active', is_active);
        formData.append('address', address);
        formData.append('website', website);
        formData.append('star', star);
        formData.append('city', city);
        if(image) {
            formData.append('image', image);
        }
        formData.append('_token', token);
        formData.append('_method', 'PUT');

        //ajax
        $.ajax({
            url: `/admin/management-mitra/hostel/${hostel_id}`,
            type: "POST", // Use POST method since we're using _method to simulate PUT
            cache: false,
            contentType: false,
            processData: false,
            data: formData,
            success: function(response) {
                $('#modal-edit').modal('hide');
                location.reload();
            },
            error: function(errors) {
                console.error(errors.responseJSON);
                $(`.is-invalid`).removeClass('is-invalid').next().empty().addClass('d-none')
                const messages = errors.responseJSON;

                if(messages) {
                    for (const key in messages) {
                        $(`#${key}-edit`).addClass('is-invalid').next().removeClass('d-none').html(messages[key]);
                    }
                }
            }
        });
    });
</script>
