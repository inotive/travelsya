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
                      <select class="form-select form-select-solid is_active-edit" name="is-active-edit" id="is_active-edit">
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
                    <select class="js-example-basic-single form-control form-control-lg city-edit" name="city" id="city-edit">
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

                  <div class="col-12">
                      <label for="" class="form-label">Alamat</label>
                      <textarea id="address-edit" cols="30" rows="5" class="form-control address-edit"></textarea>
                      <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-address-edit"></div>
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

$(document).ready(function() {
    $('body').on('click', '#btn-edit-rental', function() {
        let rental_id = $(this).data('id');
    
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

                $('#city-edit').val(response.data.city);
                $('#city-edit').trigger('change');

                $('#phone-edit').val(response.data.phone);
            
                $('#modal-edit').modal('show');

            }
        });
    });

    $('#update').click(function(e) {

    e.preventDefault();

    
    //define variable
    let rental_id = $('#rental_id').val();
    let user_id = $('#user_id-edit').val();
    let name = $('#name-edit').val();
    let is_active = $('#is_active-edit').val();
    let address = $('#address-edit').val();
    let city = $('#city-edit').val();
    let phone = $('#phone-edit').val();
    let token   = $("meta[name='csrf-token']").attr("content");
    


    //ajax
    $.ajax({
        url: `/admin/management-mitra/rental-mobil/${rental_id}`,
        type: "PUT",
        cache: false,
        data: {
            "name": name,
            "user_id": user_id,
            "is_active": is_active,
            "address": address,
            "city": city,
            "phone": phone,
            "_token": token
        },
        success: function(response) {
            $('#modal-edit').modal('hide');
            location.reload();
        },
        error: function(error) {

            console.log(`berikut errornya`, error);

            // if (error.responseJSON.name[0]) {

            //     //show alert
            //     $('#alert-name-edit').removeClass('d-none');
            //     $('#alert-name-edit').addClass('d-block');
            //     $('#alert-user_id-edit').removeClass('d-none');
            //     $('#alert-user_id-edit').addClass('d-block');
            //     $('#alert-website-edit').removeClass('d-none');
            //     $('#alert-website-edit').addClass('d-block');
            //     $('#alert-star-edit').removeClass('d-none');
            //     $('#alert-star-edit').addClass('d-block');
            //     $('#alert-is_active-edit').removeClass('d-none');
            //     $('#alert-is_active-edit').addClass('d-block');
            //     $('#alert-address-edit').removeClass('d-none');
            //     $('#alert-address-edit').addClass('d-block');
            //     $('#alert-city-edit').removeClass('d-none');
            //     $('#alert-city-edit').addClass('d-block');


            //     //add message to alert
            //     $('#alert-name-edit').html(error.responseJSON.name[0]);
            //     $('#alert-user_id-edit').html(error.responseJSON.name[0]);
            //     $('#alert-website-edit').html(error.responseJSON.name[0]);
            //     $('#alert-star-edit').html(error.responseJSON.name[0]);
            //     $('#alert-is_active-edit').html(error.responseJSON.name[0]);
            //     $('#alert-address-edit').html(error.responseJSON.name[0]);
            //     $('#alert-city-edit').html(error.responseJSON.name[0]);
            // }

        }

    });
    });



})


</script>
