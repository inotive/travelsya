<script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js') }}"></script>
<script src="{{ url('https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js') }}"></script>
<script src="{{ url('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>
<script src="{{ url('https://code.jquery.com/jquery-3.6.0.min.js') }}"></script>
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
                <form id="updateForm" method="POST" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Update Room</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="row">
                            <div class="col-12">
                        <!--begin::Alert-->
                                <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                            <!--begin::Wrapper-->
                                    <div class="d-flex flex-column pe-0 pe-sm-10">
                                <!--begin::Title-->
                                        <h4 class="fw-bold">Room Information</h4>
                                <!--end::Title-->
                                    </div>
                            <!--end::Wrapper-->
                                </div>
                        <!--end::Alert-->
                            </div>
                        </div>

                        <input type="hidden" name="hotel_id" id="hotel_id">
                        <input type="hidden" name="room_id" id="room_id">
                        <div class="g-9 mb-8 row">
                            <div class="col-12">
                                <label class="required fs-6 fw-semibold mb-2">Room Name</label>
                                <input type="text" class="form-control" id="name-edit" name="name" required/>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-name-edit"></div>

                                @error('name')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="required fs-6 fw-semibold mb-2">Room Price</label>
                                <input class="form-control " type="number" id="price-edit" name="price" required>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-price-edit"></div>
                                @error('price')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label class="required fs-6 fw-semibold mb-2">Room Selling Price</label>
                                <input type="number" class="form-control" id="sellingprice-edit" name="sellingprice" required>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-sellingprice-edit"></div>
                                @error('sellingprice')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="" class="form-label">Room Type</label>
                                <select id="bed_type-edit" class="form-control" name="bed_type" required>
                                    <option value="studio">Studio</option>
                                    <option value="1br">1BR</option>
                                    <option value="2br">2BR</option>
                                    <option value="3br+">3BR+</option>
                                </select>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-bed_type-edit"></div>
                            </div>
                                @error('bed_type')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            <div class="col-12 mb-10">
                                <label for="totalroom" class="form-label">Number of Rooms</label>
                                <input type="text" id="totalroom-edit" class="form-control" name="totalroom" required>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-totalroom-edit"></div>
                            </div>
                                @error('totalroom')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                        <div class="col-12">
                            <!--begin::Alert-->
                            <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <!--begin::Title-->
                                    <h4 class="fw-bold">Room Size</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->
                        </div>
                        <div class="col-12 mb-10">
                                <label for="roomsize" class="form-label">Size (m2)</label>
                                <input type="text" id="roomsize-edit" class="form-control" name="roomsize" required>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-roomsize-edit"></div>
                        </div>
                            @error('roomsize')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        <div class="col-12">
                            <!--begin::Alert-->
                            <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <!--begin::Title-->
                                    <h4 class="fw-bold">Room Occupancy Policyze</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->
                        </div>
                        <div class="row mb-10">
                        <div class="col-md-6">
                                <label for="guest" class="form-label">Max Occupancy</label>
                                <input type="text" id="guest-edit" class="form-control" name="guest" required>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-guest-edit"></div>
                        </div>
                            @error('guest')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        <div class="col-md-6">
                                <label for="" class="form-label">Max Extra Bed</label>
                                <input type="text" id="maxextrabed-edit" class="form-control" name="maxextrabed" required>
                                <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-maxextrabed-edit"></div>
                        </div>
                            @error('maxextrabed')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <!--begin::Alert-->
                            <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <!--begin::Title-->
                                    <h4 class="fw-bold">Image</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->
                        </div>
                        <div class="col-6 mb-10">
                            <label class="form-label">Image</label>
                            <input type="file" id="image_1-edit" class="form-control" name="image_1">
                        </div>
                                @error('image_1')
                                <span class="text-danger mt-1" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                        <div class="col-12">
                            <!--begin::Alert-->
                            <div class="alert bg-light d-flex flex-column flex-sm-row p-3">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column pe-0 pe-sm-10">
                                    <!--begin::Title-->
                                    <h4 class="fw-bold">Room Additional Information</h4>
                                    <!--end::Title-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Alert-->
                        </div>
                        <div class="col-6 d-flex justify-content-around">
                            @foreach ($facilities as $facility)
                            <div class="form-check mx-3">
                                <input class="form-check-input"  type="checkbox" name="facility_id[]" value="{{ $facility->id }}" id="checkbox_{{ $facility->id }}"/>
                                <label class="form-check-label">
                                    {{ $facility->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        </div>
                        <!--end::Input group-->
                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel
                            </button>
                            <button type="submit" id="update" class="btn btn-primary">
                                <span class="indicator-label">Update</span>
                                <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                        <!--end::Actions-->


                </div>
                </form>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - New Target-->

    <script>
$(document).ready(function() {
    $('body').on('click', '#tombol-edit', function () {
    let room_id = $(this).data('id');
    let hotel_id = $(this).data('hotel-id');

    //ajax untung nangkap data dari json dari settingRoomShow
    $.ajax({
        url: `/partner/management-hotel/setting-hotel-room/hotel-room/${hotel_id}/${room_id}`,
        type: "GET",
        cache: false,
        success: function (response) {
            //ini untuk menempatkan value dari json ke form
            $('#modal-edit').modal('show');
            var facilities = response.data.facilities;
            facilities.forEach(function(facility) {
                var facilityId = facility.facility_id;
                $('#checkbox_' + facilityId).prop('checked', true);
                console.log(facilityId);
            });
            let data = response.data;
            $('#room_id').val(data.hotel_room.id);
            $('#hotel_id').val(data.hotel_room.hotel_id);
            $('#name-edit').val(data.hotel_room.name);
            $('#price-edit').val(data.hotel_room.price);
            $('#sellingprice-edit').val(data.hotel_room.sellingprice);
            $('#bed_type-edit').val(data.hotel_room.bed_type);
            $('#totalroom-edit').val(data.hotel_room.totalroom);
            $('#roomsize-edit').val(data.hotel_room.roomsize);
            $('#guest-edit').val(data.hotel_room.guest);
            $('#maxextrabed-edit').val(data.hotel_room.maxextrabed);
            $('#image_1-edit').val(data.hotel_room.image_1);
            console.log(data.hotel_room.name);
        }
    });
});
    //untuk update data, settingRoomUpdate
    $('#update').click(function(e) {
        e.preventDefault();
        let room_id = $('#room_id').val();
        let hotel_id = $('#hotel_id').val();
        let name = $('#name-edit').val();
        let price = $('#price-edit').val();
        let sellingprice = $('#sellingprice-edit').val();
        let bed_type = $('#bed_type-edit').val();
        let totalroom = $('#totalroom-edit').val();
        let roomsize = $('#roomsize-edit').val();
        let guest = $('#guest-edit').val();
        let maxextrabed = $('#maxextrabed-edit').val();
        let image_1 = $('#image_1-edit').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        // ini untuk emngambil facility_id dari checkbox yang dicentang
        var facilityIds = [];
        // ini untuk nghandle array checkbox
        $('input[name="facility_id[]"]:checked').each(function() {
        var facilityId = $(this).val();
        var individualFacilities = facilityId.split(',');
        facilityIds = facilityIds.concat(individualFacilities);
        });

        // ini untuk menambahkan facility_ids ke formData
        var formData = new FormData($('#updateForm')[0]);

        //ajax
        $.ajax({
            url: `/partner/management-hotel/setting-hotel-room/hotel-room/update/${hotel_id}/${room_id}`,
            type: "POST",
            cache: false,
            data: formData,
            processData: false,
            contentType: false,
            success:function(response){
                console.log(response);
                $('#modal-edit').modal('hide');
                location.reload();
            },
            error:function(error){
                if(error.responseJSON.name[0]) {
                    //show alert
                    $('#alert-name-edit').removeClass('d-none');
                    $('#alert-name-edit').addClass('d-block');
                    $('#alert-name-edit').html(error.responseJSON.name[0]);
                }
            }
        });
    });
        });
</script>
