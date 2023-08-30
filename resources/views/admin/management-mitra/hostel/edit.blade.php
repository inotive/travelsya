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
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name-edit"></div>

                        @error('name')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="required fs-6 fw-semibold mb-2">Vendor User</label>
                        <select class="form-select form-select-solid user_id-edit" id="user_id-edit">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-user_id-edit"></div>
                        @error('user_id')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="required fs-6 fw-semibold mb-2">Active</label>
                        <select class="form-select form-select-solid is_active-edit" id="is_active-edit">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-is_active-edit"></div>
                        @error('is_active')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12">
                        <label for="" class="form-label">Alamat</label>
                        <textarea id="address-edit" cols="30" rows="5" class="form-control address-edit"></textarea>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-address-edit"></div>
                    </div>
                    <div class="col-md-12">
                        <label for="website" class="form-label">Website</label>
                        <input type="text" id="website-edit" class="form-control website-edit"
                            placeholder="Masukan website">
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-website-edit"></div>
                    </div>

                    <div class="col-md-12">
                        <label class="required fs-6 fw-semibold mb-2">City</label>
                        <select name="city-edit" id="city-edit" class="form-control city-edit">
                            <option value="Balikpapan">Balikpapan</option>
                            <option value="Samarinda">Samarinda</option>
                            <option value="Banjarmasin">Banjarmasin</option>
                        </select>
                        @error('city')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="required fs-6 fw-semibold mb-2">Bintang</label>

                        <!--begin::Radio group-->
                        <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                            <!--begin::Radio-->
                            <label class="btn btn-outline btn-color-muted btn-active-success input-star-1"
                                data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check input-star-1" type="radio" name="star-edit" id="star-edit"
                                    value="1" />
                                <!--end::Input-->
                                1
                            </label>
                            <!--end::Radio-->

                            <!--begin::Radio-->
                            <label class="btn btn-outline btn-color-muted btn-active-success input-star-2"
                                data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check input-star-2" type="radio" name="star-edit" id="star-edit"
                                    checked="checked" value="2" />
                                <!--end::Input-->
                                2
                            </label>
                            <!--end::Radio-->

                            <!--begin::Radio-->
                            <label class="btn btn-outline btn-color-muted btn-active-success input-star-3"
                                data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check input-star-3" type="radio" name="star-edit" id="star-edit"
                                    value="3" />
                                <!--end::Input-->
                                3
                            </label>
                            <!--end::Radio-->

                            <!--begin::Radio-->
                            <label class="btn btn-outline btn-color-muted btn-active-success input-star-4"
                                data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check input-star-4" type="radio" name="star-edit" id="star-edit"
                                    value="4" />
                                <!--end::Input-->
                                4
                            </label>
                            <!--end::Radio-->
                            <!--begin::Radio-->
                            <label class="btn btn-outline btn-color-muted btn-active-success input-star-5"
                                data-kt-button="true">
                                <!--begin::Input-->
                                <input class="btn-check input-star-5" type="radio" name="star-edit" id="star-edit"
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
        let token = $("meta[name='csrf-token']").attr("content");

        //ajax
        $.ajax({

            url: `/admin/management-mitra/hostel/${hostel_id}`,
            type: "PUT",
            cache: false,
            data: {
                "name": name,
                "user_id": user_id,
                "is_active": is_active,
                "address": address,
                "website": website,
                "star": star,
                "city": city,
                "_token": token
            },
            success: function(response) {

                $('#modal-edit').modal('hide');
                location.reload();

                //data post
                // let hotel = `
                //     <tr id="index_${response.data.id}">
                //         <td>${response.data.user_id}</td>
                //         <td>${response.data.name}</td>
                //         <td>${response.data.address}</td>
                //         <td>${response.data.website}</td>
                //         <td>${response.data.star}</td>
                //         <td>${response.data.is_active}</td>
                //         <td>${response.data.city}</td>
                //         <td class="text-center">
                //             <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                //             <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                //         </td>
                //     </tr>
                // `;
                // $(`#index_${response.data.id}`).replaceWith(hotel);
                // $('#modal-edit').modal('hide');
                // location.reload();


            },
            error: function(error) {

                if (error.responseJSON.name[0]) {

                    //show alert
                    $('#alert-name-edit').removeClass('d-none');
                    $('#alert-name-edit').addClass('d-block');
                    $('#alert-user_id-edit').removeClass('d-none');
                    $('#alert-user_id-edit').addClass('d-block');
                    $('#alert-website-edit').removeClass('d-none');
                    $('#alert-website-edit').addClass('d-block');
                    $('#alert-star-edit').removeClass('d-none');
                    $('#alert-star-edit').addClass('d-block');
                    $('#alert-is_active-edit').removeClass('d-none');
                    $('#alert-is_active-edit').addClass('d-block');
                    $('#alert-address-edit').removeClass('d-none');
                    $('#alert-address-edit').addClass('d-block');
                    $('#alert-city-edit').removeClass('d-none');
                    $('#alert-city-edit').addClass('d-block');


                    //add message to alert
                    $('#alert-name-edit').html(error.responseJSON.name[0]);
                    $('#alert-user_id-edit').html(error.responseJSON.name[0]);
                    $('#alert-website-edit').html(error.responseJSON.name[0]);
                    $('#alert-star-edit').html(error.responseJSON.name[0]);
                    $('#alert-is_active-edit').html(error.responseJSON.name[0]);
                    $('#alert-address-edit').html(error.responseJSON.name[0]);
                    $('#alert-city-edit').html(error.responseJSON.name[0]);
                }

            }

        });

    });
</script>
{{-- <script>
    // $(document).ready(function() {
        $('body').on('click', '#btn-edit-post', function() {
                        let hostel_id = $(this).data('id');

                        $.ajax({
                            url: `admin/management-mitra/hostel/${hostel_id}`,
                            type: "GET",
                            cache: false,
                            success: function(response) {
                                $('#hostel_id').val(response.data.id);
                                $('#edit-name').val(response.data.name);
                                $('#edit-user-id').val(response.data.user_id);
                                $('#edit-city').val(response.data.city);
                                $('#edit-alamat').val(response.data.address);
                                $('#edit-bintang').val(response.data.star);

                                $('#edit_mitra').modal('show');
                            }
                        });
                    });

                    $('#update').click(function(e) {
                        e.preventDefault();

                        // Define variables
                        let hostel_id = $('#hostel_id').val();
                        let name = $('#edit-name').val();
                        let user_id = $('#edit-user-id').val();
                        let city = $('#edit-city').val();
                        let address = $('#edit-alamat').val();
                        let star = $('#edit-bintang').val();
                        let token = $("meta[name='csrf-token']").attr("content");

                        // AJAX for update
                        $.ajax({
                            url: `admin/management-mitra/hostel/${hostel_id}`, // Change to correct URL
                            type: "PUT",
                            cache: false,
                            data: {
                                "name": name,
                                "user_id": user_id,
                                "city": city,
                                "address": alamat,
                                "website": website,
                                "star": method,
                                "_token": token,
                            },
                            success: function(response) {
                                Swal.fire({
                                    type: 'success',
                                    icon: 'success',
                                    title: `${response.message}`,
                                    showConfirmButton: false,
                                    timer: 3000
                                });
                                // Update row in table
                                let hostel = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.name}</td>
                        <td>${response.data.user_id}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-post" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-post" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;

                                $(`#index_${response.data.id}`).replaceWith(hostel);

                                // Close modal
                                $('#edit_mitra').modal('hide');

                                // Show success message

                            },
                            error: function(error) {
                                if (error.responseJSON.title[0]) {

                                    //show alert
                                    $('#alert-name-edit').removeClass('d-none');
                                    $('#alert-name-edit').addClass('d-block');

                                    //add message to alert
                                    $('#alert-name-edit').html(error.responseJSON.name[
                                        0]);
                                }
                                // if (error.responseJSON.content[0]) {

                                //     //show alert
                                //     $('#alert-content-edit').removeClass('d-none');
                                //     $('#alert-content-edit').addClass('d-block');

                                //     //add message to alert
                                //     $('#alert-content-edit').html(error.responseJSON
                                //         .content[0]);
                                // }
                                // Handle validation errors or other errors here
                            }
                        });
                    });
                

            
        
</script> --}}
