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
                <input type="hidden" id="rental_id" value="">
                  <div class="col-md-12">
                      <label class="required fs-6 fw-semibold mb-2">Nama</label>
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

                  <div class="col-md-12">
                      <label class="required fs-6 fw-semibold mb-2">Active</label>
                      <select class="form-select form-select-solid is_active-edit" name="is-active-edit" id="is_active-edit">
                          <option value="1">Yes</option>
                          <option value="0">No</option>
                      </select>
                      <div class="alert alert-danger mt-1 d-none"></div>
                  </div>

                  <div class="col-md-12">
                    <label class="required fs-6 fw-semibold mb-2">Kota</label>
                    <select class="js-example-basic-single form-control form-control-lg city-edit" name="city" id="city-edit">
                        @foreach ($cities as $city)
                        <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
                        @endforeach
                    </select>
                    <div class="alert alert-danger mt-1 d-none"></div>
                </div>

                  <div class="col-12">
                      <label for="" class="required form-label">Alamat</label>
                      <textarea id="address-edit" cols="30" rows="5" class="form-control address-edit"></textarea>
                      <div class="alert alert-danger mt-1 d-none"></div>
                  </div>

                  <div class="col-12">
                      <label for="" class="required form-label">Kebijakan Rental Mobil</label>
                      <textarea id="kebijakan_rental_mobil-edit" cols="30" rows="5" class="form-control kebijakan_rental_mobil-edit" placeholder="Masukkan kebijakan rental mobil..."></textarea>
                      <div class="alert alert-danger mt-1 d-none"></div>
                  </div>

                  <div class="col-12">
                      <div class="mb-2">
                          <img id="current-image" src="" alt="Gambar Rental Mobil" style="max-width: 200px; max-height: 200px;" onerror="this.src='{{ asset('assets/media/avatars/blank.png') }}'; this.onerror=null;">
                      </div>
                      <label class="fs-6 fw-semibold mb-2">Ganti Gambar Rental Mobil</label>
                      <input class="form-control form-control-lg" type="file" id="image-edit" name="image" accept="image/*" />
                      <div class="form-text">Pilih gambar logo atau gambar utama rental mobil (kosongkan jika tidak ingin mengganti)</div>
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
// Menambahkan enctype="multipart/form-data" secara dinamis ke form
$('#modal-edit form').attr('enctype', 'multipart/form-data');

$(document).ready(function() {
    $('body').on('click', '#btn-edit-rental', function() {
        let rental_id = $(this).data('id');
        $(`.is-invalid`).removeClass('is-invalid').next().empty().addClass('d-none');

        $.ajax({
            url: `/admin/management-mitra/rental-mobil/${rental_id}`,
            type: "GET",
            cache: false,
            success: function(response) {
                $('#rental_id').val(response.data.id);
                $('#name-edit').val(response.data.business_name);
                $('#user_id-edit').val(response.data.user_id);
                $('#is_active-edit').val(response.data.is_active);
                $('#address-edit').val(response.data.address);
                $('#kebijakan_rental_mobil-edit').val(response.data.kebijakan_rental_mobil);

                $('#city-edit').val(response.data.city);
                $('#city-edit').trigger('change');

                $('#phone-edit').val(response.data.phone);

                // Menampilkan gambar saat ini
                if(response.data.image) {
                    $('#current-image').attr('src', `{{ asset("storage/") }}${response.data.image}`);
                } else {
                    $('#current-image').attr('src', '{{ asset("assets/media/avatars/blank.png") }}');
                }

                $('#modal-edit').modal('show');

            }
        });
    });

    $('#update').click(function(e) {

        e.preventDefault();

        // Membuat FormData untuk mengirim file
        let formData = new FormData();
        formData.append('name', $('#name-edit').val());
        formData.append('user_id', $('#user_id-edit').val());
        formData.append('is_active', $('#is_active-edit').val());
        formData.append('address', $('#address-edit').val());
        formData.append('kebijakan_rental_mobil', $('#kebijakan_rental_mobil-edit').val());
        formData.append('city', $('#city-edit').val());
        formData.append('phone', $('#phone-edit').val());
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('_method', 'PUT'); // Tambahkan ini untuk metode PUT

        // Tambahkan file gambar jika dipilih
        if ($('#image-edit')[0].files[0]) {
            formData.append('image', $('#image-edit')[0].files[0]);
        }

        let rental_id = $('#rental_id').val();

        // Tambahkan CSRF token ke formData sebagai hidden field
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('_method', 'PUT');  // Menentukan bahwa ini adalah permintaan PUT

        $.ajax({
            url: `/admin/management-mitra/rental-mobil/${rental_id}`,
            type: "POST",  // Tetap gunakan POST karena kita menambahkan _method PUT
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function(response) {
                $('#modal-edit').modal('hide');
                location.reload();
            },
            error: function(errors) {

                // console.log(`berikut errornya`, errors);

                const messages = errors.responseJSON;
                $(`.is-invalid`).removeClass('is-invalid').next().empty().addClass('d-none');

                if(messages) {
                    for (const key in messages) {
                        if(key !== 'image') {
                            $(`.${key}-edit`).addClass('is-invalid').next().removeClass('d-none').html(messages[key]);
                        } else {
                            // Untuk error image khusus
                            $('#image-edit').addClass('is-invalid').next().removeClass('d-none').html(messages[key]);
                        }
                    }
                }
            }

        });
    });



});


</script>
