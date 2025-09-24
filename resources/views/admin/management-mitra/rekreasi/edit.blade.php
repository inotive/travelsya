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

                <!--begin::Heading-->
                <div class="mb-13 text-center">
                    <!--begin::Title-->
                    <h1 class="mb-3">Update Mitra</h1>
                    <!--end::Title-->
                </div>
                <!--end::Heading-->
                <!--begin::Input group-->
                <div class="g-9 mb-8 row">
                    <input type="hidden" id="recreation_id" value="">
                    <div class="col-md-12">
                        <label class="required fs-6 fw-semibold mb-2">Nama Bisnis</label>
                        <input type="text" class="form-control form-control-lg name-edit" id="name-edit" required />
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Mitra</label>
                        <select class="form-select form-select-solid user_id-edit" id="user_id-edit">
                            @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>

                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Nomor Telepon</label>
                        <input type="number" class="form-control form-control-lg phone-edit" id="phone-edit" required />
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>

                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Kota</label>
                        <select class="js-example-basic-single form-control form-control-lg city-edit" name="city" id="city-edit">
                            @foreach ($cities as $city)
                            <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>

                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Kategori</label>
                        <select name="category_recreation_id" class="form-select" id="category-edit" aria-label="Default select example" required>
                            @foreach ($category as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                            @endforeach
                        </select>
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>

                    <div class="col-md-6">
                        <label class="fs-6 fw-semibold mb-2">Latitude</label>
                        <input class="form-control form-control-lg" id="lat-edit" type="number" step="any" name="lat" />
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>

                    <div class="col-md-6">
                        <label class="fs-6 fw-semibold mb-2">Longitude</label>
                        <input class="form-control form-control-lg" id="ltd-edit" type="number" step="any" name="ltd" />
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>

                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Active</label>
                        <select class="form-select form-select-solid is_active-edit" name="is-active-edit" id="is_active-edit">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>

                    <div class="col-12">
                        <label for="" class="required form-label">Alamat</label>
                        <textarea id="address-edit" cols="30" rows="5" class="form-control address-edit" required></textarea>
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>

                    <div class="col-12">
                        <label for="" class="required form-label">Deskripsi</label>
                        <textarea id="description-edit" cols="30" rows="5" class="form-control description-edit" required></textarea>
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>

                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Waktu Buka</label>
                        <input type="time" class="form-control form-control-lg open-edit" id="open-edit" required />
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>

                    <div class="col-md-6">
                        <label class="required fs-6 fw-semibold mb-2">Waktu Tutup</label>
                        <input type="time" class="form-control form-control-lg close-edit" id="close-edit" required />
                        <div class="alert alert-danger mt-1 d-none"></div>
                    </div>

                    <div class="col-12">
                        <label class="fs-6 fw-semibold mb-2">Gambar</label>
                        <div id="current-image-preview" class="mb-2" style="display: none;">
                            <img id="current-image" src="" alt="Current Image" style="max-width: 200px; max-height: 150px; border-radius: 5px;">
                            <p class="text-muted small mt-1">Gambar saat ini</p>
                        </div>
                        <div id="new-image-preview" class="mb-2" style="display: none;">
                            <img id="new-preview-img" src="" alt="New Image Preview" style="max-width: 200px; max-height: 150px; border-radius: 5px; border: 1px solid #ddd;">
                            <p class="text-muted small mt-1">Preview gambar baru</p>
                        </div>
                        <input type="file" class="form-control image-edit" id="image-edit" name="image" accept="image/*">
                        <div class="alert alert-danger mt-1 d-none"></div>
                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar</small>
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
<script>
    $(document).ready(function() {
        $('body').on('click', '#btn-edit-rental', function() {
            let recreation_id = $(this).data('id');
            $(`.is-invalid`).removeClass('is-invalid').next().empty().addClass('d-none');

            $.ajax({
                url: `/admin/management-mitra/rekreasi/${recreation_id}`
                , type: "GET"
                , cache: false
                , success: function(response) {
                    $('#recreation_id').val(response.data.id);
                    $('#name-edit').val(response.data.business_name);
                    $('#user_id-edit').val(response.data.user_id);
                    $('#is_active-edit').val(response.data.is_active);
                    $('#address-edit').val(response.data.address);
                    $('#description-edit').val(response.data.description);
                    $('#open-edit').val(response.data.open);
                    $('#close-edit').val(response.data.close);
                    $('#city-edit').val(response.data.city);
                    $('#city-edit').trigger('change');
                    $('#phone-edit').val(response.data.phone);
                    $('#lat-edit').val(response.data.lat);
                    $('#ltd-edit').val(response.data.ltd);
                    $('#category-edit').val(response.data.category_recreation_id);

                    // Show current image if exists
                    if(response.data.image && response.data.image.image) {
                        $('#current-image').attr('src', '/storage/' + response.data.image.image);
                        $('#current-image-preview').show();
                    } else {
                        $('#current-image-preview').hide();
                    }

                    // Reset new image preview
                    $('#new-image-preview').hide();
                    $('#image-edit').val('');

                    $('#modal-edit').modal('show');
                }
            });
        });

        $('#update').click(function(e) {
            e.preventDefault();

            // Define variable
            let recreation_id = $('#recreation_id').val();
            let user_id = $('#user_id-edit').val();
            let name = $('#name-edit').val();
            let is_active = $('#is_active-edit').val();
            let address = $('#address-edit').val();
            let description = $('#description-edit').val();
            let open = $('#open-edit').val();
            let close = $('#close-edit').val();
            let city = $('#city-edit').val();
            let phone = $('#phone-edit').val();
            let lat = $('#lat-edit').val();
            let ltd = $('#ltd-edit').val();
            let category_recreation_id = $('#category-edit').val();
            let token = $("meta[name='csrf-token']").attr("content");

            // Create FormData for file upload
            let formData = new FormData();
            formData.append('name', name);
            formData.append('user_id', user_id);
            formData.append('is_active', is_active);
            formData.append('address', address);
            formData.append('description', description);
            formData.append('open', open);
            formData.append('close', close);
            formData.append('city', city);
            formData.append('lat', lat);
            formData.append('ltd', ltd);
            formData.append('phone', phone);
            formData.append('category_recreation_id', category_recreation_id);
            formData.append('_token', token);
            formData.append('_method', 'PUT');

            // Add image file if selected
            let imageFile = $('#image-edit')[0].files[0];
            if (imageFile) {
                formData.append('image', imageFile);
            }

            // AJAX
            $.ajax({
                url: `/admin/management-mitra/rekreasi/${recreation_id}`
                , type: "POST"
                , cache: false
                , data: formData
                , processData: false
                , contentType: false
                , success: function(response) {
                    $('#modal-edit').modal('hide');
                    location.reload();
                }
                , error: function(errors) {
                    const messages = errors.responseJSON;
                    $(`.is-invalid`).removeClass('is-invalid').next().empty().addClass('d-none');

                    if(messages) {
                        for (const key in messages) {
                            $(`#${key}-edit`).addClass('is-invalid').next().removeClass('d-none').html(messages[key]);
                        }
                    }
                }
            });
        });

        // Image preview functionality for edit form
        $('#image-edit').on('change', function(e) {
            const file = e.target.files[0];
            const previewDiv = $('#new-image-preview');
            const previewImg = $('#new-preview-img');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.attr('src', e.target.result);
                    previewDiv.show();
                };
                reader.readAsDataURL(file);
            } else {
                previewDiv.hide();
            }
        });
    });

</script>
