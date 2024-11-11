<!--begin::Modal - New Target-->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <div class="mb-13 text-center">
                    <h1 class="mb-3">Update Mitra</h1>
                </div>
                <div class="g-9 mb-8 row">
                    <input type="hidden" id="clinic_id" value="">
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
                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Mitra</label>
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

                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Nomor Telepon</label>
                        <input type="text" class="form-control form-control-lg phone-edit" id="phone-edit" required />
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-phone-edit"></div>
                        @error('phone')
                        <span class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="required fs-6 fw-semibold mb-2">Active</label>
                        <select class="form-select form-select-solid is_active-edit" name="is-active-edit"
                            id="is_active-edit">
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

                    <div class="col-md-12">
                        <label class="required fs-6 fw-semibold mb-2">Kota</label>
                        <select class="js-example-basic-single form-control form-control-lg city-edit" name="city"
                            id="city-edit">
                            @foreach ($cities as $city)
                            <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                            @endforeach
                        </select>
                        @error('city')
                        <span class="text-danger mt-1" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="required fs-6 fw-semibold mb-2">Kategori</label>
                        <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                            <label class="btn btn-outline btn-danger" data-kt-button="true">
                                <input class="btn-check category-edit" type="radio" name="category"
                                    id="update-category-kesehatan" value="kesehatan" required />
                                Kesehatan
                            </label>
                            <label class="btn btn-outline btn-danger" data-kt-button="true">
                                <input class="btn-check category-edit" type="radio" name="category"
                                    id="update-category-kecantikan" value="kecantikan" required />
                                Kecantikan
                            </label>
                        </div>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-category-edit"></div>
                        @error('category')
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
                </div>
                <!--end::Input group-->
                <!--begin::Actions-->
                <div class="text-center">
                    <button type="button" id="kt_modal_new_target_cancel" class="btn btn-light me-3"
                        data-bs-dismiss="modal">Cancel</button>
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
    $(document).ready(function() {
        // Handle click event for editing clinic
        $('body').on('click', '#btn-edit-clinic', function() {
            let clinic_id = $(this).data('id');

            $.ajax({
                url: `/admin/management-mitra/klinik-kecantikan/${clinic_id}`,
                type: "GET",
                cache: false,
                success: function(response) {
                    // Populate fields with the received data
                    $('#clinic_id').val(response.data.id);
                    $('#name-edit').val(response.data.clinic_name);
                    $('#user_id-edit').val(response.data.user_id);
                    $('#is_active-edit').val(response.data.is_active);
                    $('#address-edit').val(response.data.address);
                    $('#city-edit').val(response.data.city);
                    $('#city-edit').trigger('change');
                    $('#phone-edit').val(response.data.phone);
                    $(`input[name="category"][value="${response.data.category}"]`).prop('checked', true);
                    $('#image-edit').val(response.data.image);
                    // Show the modal
                    $('#modal-edit').modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(`Error fetching clinic data: ${error}`);
                }
            });
        });

        // Handle update button click
        $('#update').click(function(e) {
            e.preventDefault();

            // Define variables
            let clinic_id = $('#clinic_id').val();
            let user_id = $('#user_id-edit').val();
            let name = $('#name-edit').val();
            let is_active = $('#is_active-edit').val();
            let address = $('#address-edit').val();
            let city = $('#city-edit').val();
            let phone = $('#phone-edit').val();
            let token = $("meta[name='csrf-token']").attr("content");
            let category = $('input[name="category"]:checked').val();
            let image = $('#image-edit').val();
            // Clear previous alerts
            $('.alert').addClass('d-none').html('');

            console.log({
                clinic_id, user_id, name, is_active, address, city, phone, token, category
            });

            // AJAX request to update clinic data
            $.ajax({
                url: `/admin/management-mitra/klinik-kecantikan/${clinic_id}`,
                type: "PUT",
                cache: false,
                data: {
                    "name": name,
                    "user_id": user_id,
                    "is_active": is_active,
                    "address": address,
                    "city": city,
                    "phone": phone,
                    "_token": token,
                    "category": category,
                    "image": image
                },
                success: function(response) {
                    console.log('Update successful:', response);
                    $('#modal-edit').modal('hide');
                    location.reload(); // Reload the page after successful update
                },
                error: function(error) {
                    console.log('Update error:', error);

                    // Check for specific error messages and display them
                    if (error.responseJSON) {
                        if (error.responseJSON.name) {
                            $('#alert-name-edit').removeClass('d-none').html(error.responseJSON.name[0]);
                        }
                        if (error.responseJSON.user_id) {
                            $('#alert-user_id-edit').removeClass('d-none').html(error.responseJSON.user_id[0]);
                        }
                        if (error.responseJSON.phone) {
                            $('#alert-phone-edit').removeClass('d-none').html(error.responseJSON.phone[0]);
                        }
                        if (error.responseJSON.address) {
                            $('#alert-address-edit').removeClass('d-none').html(error.responseJSON.address[0]);
                        }
                        if (error.responseJSON.city) {
                            $('#alert-city-edit').removeClass('d-none').html(error.responseJSON.city[0]);
                        }
                        if (error.responseJSON.category) {
                            $('#alert-category-edit').removeClass('d-none').html(error.responseJSON.category[0]);
                        }
                        if (error.responseJSON.image) {
                            $('#alert-image-edit').removeClass('d-none').html(error.responseJSON.image[0]);
                        }
                    }
                }
            });
        });
    });
</script>