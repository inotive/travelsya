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
                        <label class="fs-6 fw-semibold mb-2">Nomor Telepon</label>
                        <input type="number" class="form-control form-control-lg phone-edit" id="phone-edit" />
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-phone-edit"></div>
                        @error('phone')
                            <span class="text-danger mt-1" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-12">
                        <label class="fs-6 fw-semibold mb-2">Active</label>
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
                        <label class="fs-6 fw-semibold mb-2">Kota</label>
                        <select class="js-example-basic-single form-control form-control-lg city-edit" name="city"
                            id="city-edit">
                            <option value="">--Pilih Kota/Kabupaten--</option>
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
                        <label class="fs-6 fw-semibold mb-2">Kategori</label>
                        <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">

                            @foreach (App\Models\Clinic::CATEGORY as $key => $value)
                                <label class="btn btn-outline btn-danger {{ (isset($clinic) && $clinic->category == $key) ? 'active' : '' }}" data-kt-button="true">
                                    <input class="btn-check" type="radio" name="category" value="{{ $key }}"
                                        {{ (isset($clinic) && $clinic->category == $key) ? 'checked' : '' }} />
                                    {{ $value }}
                                </label>
                            @endforeach
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

                    <div class="col-md-6">
                        <label class="fs-6 fw-semibold mb-2">Waktu Buka</label>
                        <input type="time" class="form-control form-control-lg open-edit" id="open-edit" />
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-open-edit"></div>
                    </div>

                    <div class="col-md-6">
                        <label class="fs-6 fw-semibold mb-2">Waktu Tutup</label>
                        <input type="time" class="form-control form-control-lg close-edit" id="close-edit" />
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-close-edit"></div>
                    </div>

                    <div class="col-12">
                        <label for="" class="form-label">Deskripsi</label>
                        <textarea id="description-edit" cols="30" rows="5" class="form-control description-edit"></textarea>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-description-edit"></div>
                    </div>

                    <div class="col-12">
                        <label for="" class="form-label">Highlight</label>
                        <textarea id="highlight-edit" cols="30" rows="3" class="form-control highlight-edit"></textarea>
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-highlight-edit"></div>
                    </div>

                    <div class="col-md-6">
                        <label class="fs-6 fw-semibold mb-2">Latitude</label>
                        <input type="text" class="form-control form-control-lg lat-edit" id="lat-edit"
                            placeholder="Masukan latitude (contoh: -6.200000)"
                            pattern="^-?([1-8]?[0-9](\.[0-9]+)?|90(\.0+)?)$"
                            title="Masukkan latitude yang valid (-90 sampai 90)" />
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-lat-edit"></div>
                    </div>

                    <div class="col-md-6">
                        <label class="fs-6 fw-semibold mb-2">Longitude</label>
                        <input type="text" class="form-control form-control-lg ltd-edit" id="ltd-edit"
                            placeholder="Masukan longitude (contoh: 106.816666)"
                            pattern="^-?((1[0-7][0-9])|([1-9]?[0-9]))(\.[0-9]+)?$"
                            title="Masukkan longitude yang valid (-180 sampai 180)" />
                        <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-ltd-edit"></div>
                    </div>

                    <!--begin::Input group for image upload-->
                    <div class="col-md-12">
                        <label class="fs-6 fw-semibold mb-2">Logo/ Gambar Klinik</label>
                        <input class="form-control form-control-lg" type="file" id="image-edit" name="image" accept="image/*" />
                        <div class="form-text">Pilih gambar logo atau gambar utama klinik (opsional)</div>
                    </div>
                    <!--end::Input group for image upload-->
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
                    $('#open-edit').val(response.data.open);
                    $('#close-edit').val(response.data.close);
                    $('#description-edit').val(response.data.description);
                    $('#highlight-edit').val(response.data.highlight);
                    $('#lat-edit').val(response.data.lat);
                    $('#ltd-edit').val(response.data.ltd);
                    $(`input[name="category"][value="${response.data.category}"]`).prop(
                        'checked', true);

                    const isKecantikan = response.data.category === 'kecantikan';
                    $('.label-kecantikan').toggleClass('active', isKecantikan);
                    $('.label-kesehatan').toggleClass('active', !isKecantikan);

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
            let open = $('#open-edit').val();
            let close = $('#close-edit').val();
            let description = $('#description-edit').val();
            let highlight = $('#highlight-edit').val();
            let lat = $('#lat-edit').val();
            let ltd = $('#ltd-edit').val();
            let token = $("meta[name='csrf-token']").attr("content");
            let category = $('input[name="category"]:checked').val();
            let image = document.getElementById('image-edit').files[0]; // Get the file object

            // Create FormData object to handle file upload
            let formData = new FormData();
            formData.append('name', name);
            formData.append('user_id', user_id);
            formData.append('is_active', is_active);
            formData.append('address', address);
            formData.append('city', city);
            formData.append('phone', phone);
            formData.append('open', open);
            formData.append('close', close);
            formData.append('description', description);
            formData.append('highlight', highlight);
            formData.append('lat', lat);
            formData.append('ltd', ltd);
            formData.append('category', category);
            if(image) {
                formData.append('image', image);
            }
            formData.append('_token', token);
            formData.append('_method', 'PUT');

            // Clear previous alerts
            $('.alert').addClass('d-none').html('');

            // AJAX request to update clinic data
            $.ajax({
                url: `/admin/management-mitra/klinik-kecantikan/${clinic_id}`,
                type: "POST", // Use POST method since we're using _method to simulate PUT
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
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
                            $('#alert-name-edit').removeClass('d-none').html(error
                                .responseJSON.name[0]);
                        }
                        if (error.responseJSON.user_id) {
                            $('#alert-user_id-edit').removeClass('d-none').html(error
                                .responseJSON.user_id[0]);
                        }
                        if (error.responseJSON.phone) {
                            $('#alert-phone-edit').removeClass('d-none').html(error
                                .responseJSON.phone[0]);
                        }
                        if (error.responseJSON.address) {
                            $('#alert-address-edit').removeClass('d-none').html(error
                                .responseJSON.address[0]);
                        }
                        if (error.responseJSON.city) {
                            $('#alert-city-edit').removeClass('d-none').html(error
                                .responseJSON.city[0]);
                        }
                        if (error.responseJSON.category) {
                            $('#alert-category-edit').removeClass('d-none').html(error
                                .responseJSON.category[0]);
                        }
                        if (error.responseJSON.image) {
                            $('#alert-image-edit').removeClass('d-none').html(error
                                .responseJSON.image[0]);
                        }
                        if (error.responseJSON.open) {
                            $('#alert-open-edit').removeClass('d-none').html(error
                                .responseJSON.open[0]);
                        }
                        if (error.responseJSON.close) {
                            $('#alert-close-edit').removeClass('d-none').html(error
                                .responseJSON.close[0]);
                        }
                        if (error.responseJSON.description) {
                            $('#alert-description-edit').removeClass('d-none').html(error
                                .responseJSON.description[0]);
                        }
                        if (error.responseJSON.highlight) {
                            $('#alert-highlight-edit').removeClass('d-none').html(error
                                .responseJSON.highlight[0]);
                        }
                        if (error.responseJSON.lat) {
                            $('#alert-lat-edit').removeClass('d-none').html(error
                                .responseJSON.lat[0]);
                        }
                        if (error.responseJSON.ltd) {
                            $('#alert-ltd-edit').removeClass('d-none').html(error
                                .responseJSON.ltd[0]);
                        }
                    }
                }
            });
        });
    });
</script>
