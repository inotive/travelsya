@extends('ekstranet.layout', ['title' => 'Setting Photo - Hotel A', 'url' => '#'])

@section('content-admin')
    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-4">
            <form id="kt_modal_new_target_form " class="form " method="post" enctype="multipart/form-data"
                action="
            {{ route('partner.management.hostel.storePhotoHostel', $hostel->id) }}">
                <div class="card mb-xl-8">
                    <!--begin::Body-->
                    <div class="card-body my-3">
                        <div class="row">
                            <!--begin::Form-->
                            @csrf
                            <input type="hidden" name="id" value="{{ $hostel->id }}">
                            <!--begin::Input group-->
                            <div class="fv-row">
                                <div class="col-12">
                                    <label class="col-sm-3 col-form-label">Foto Hotel</label>
                                    <input type="file" class="form-control" name="image"
                                        @error('image') is-invalid
                                           @enderror
                                        id="selectImage">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-12">
                                    <img id="preview" src="#" alt="your image" class="mt-3 w-100"
                                        style="display:none; height : 250px;" />
                                </div>
                            </div>
                            {{-- <div class="fv-row">
                                <!--begin::Dropzone-->
                                <input type="file" name="image[]" id="file-upload" class="form-control form-control-solid file-upload " multiple="true" hidden>
                                <div class="dropzone" id="kt_dropzonejs_example_1">
                                    <!--begin::Message-->
                                    <div class="dz-message needsclick">
                                        <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span class="path2"></span></i>

                                        <!--begin::Info-->
                                        <div class="ms-4">
                                            <h3 class="fs-5 fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                            <span class="fs-7 fw-semibold text-gray-400">Upload up to 5 Photo</span>
                                        </div>
                                        <!--end::Info-->
                                        @error('image')
                                        <span class="text-danger mt-1" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <!--end::Dropzone-->
                            </div> --}}
                            <!--end::Input group-->
                            {{-- </form> --}}
                            <!--end::Form-->
                        </div>
                    </div>
                    <!--end:: Body-->
                    <div class="card-footer p-4">
                        <button type="submit" class="btn btn-primary w-100 mb-3">Upload Photo</button>
                        <a href="{{ route('partner.management.hostel') }}"
                            class="btn btn-outline btn-outline btn-outline-secondary me-3 text-dark btn-active-light-secondary w-100">Kembali</a>
                    </div>
            </form>
        </div>
    </div>
    <!--end::Col-->
    <div class="col-8">
        <div class="card card-xl-stretch mb-xl-8">
            <!--begin::Body-->
            <div class="card-body my-3">
                <div class="row">
                    @foreach ($hostel->hostelImage as $image)
                        <div class="col-6">
                            <div class="card border border-light-subtle">
                                <div class="card-body">
                                    <img src="{{ asset('media/hostel/' . $image->image) }}"
                                        style="width: 100%; height: 150px; bac" alt="image">
                                </div>
                                <div class="card-footer py-2">
                                    <form
                                        action="{{ route('partner.management.hostel.mainphotoHostel', ['id' => $image->id]) }}"
                                        method="post" class="d-flex flex-column">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="id" value="{{ $image->id }}">
                                        <input type="hidden" name="hostel_id" value="{{ $hostel->id }}">
                                        <button class="btn btn-primary mb-3 w-100 btn-sm">Jadikan Foto Utama</button>

                                    </form>
                                    <form
                                        action="{{ route('partner.management.hostel.destroyphotoHostel', ['id' => $image->id]) }}"
                                        method="post" class="d-flex flex-column">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="id" value="{{ $image->id }}">
                                        <button
                                            class="btn btn-outline btn-outline btn-sm btn-outline-danger text-dark  w-100">Delete
                                            Photo</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!--end:: Body-->
        </div>
    </div>
    </div>
@endsection
@push('add-script')
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>

    <script>
        // $('#kt_dropzonejs_example_1').on('click',function(e){
        //     e.preventDefault()
        //     // console.log('oke');
        //     $('.file-upload').trigger('click');
        // });


        $('#kt_dropzonejs_example_1').on('click', function(e) {
            e.preventDefault()
            // console.log('oke');
            $('.file-upload').trigger('click');
        });
        selectImage.onchange = evt => {
            preview = document.getElementById('preview');
            preview.style.display = 'block';
            const [file] = selectImage.files
            if (file) {
                preview.src = URL.createObjectURL(file)
            }
        }

        // var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
        //     url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
        //     paramName: "file", // The name that will be used to transfer the file
        //     maxFiles: 10,
        //     maxFilesize: 10, // MB
        //     addRemoveLinks: true,
        //     accept: function(file, done) {
        //         if (file.name == "wow.jpg") {
        //             done("Naha, you don't.");
        //         } else {
        //             done();
        //         }
        //     }
        // });
        $('body').on('click', '#tombol-delete', function() {

            let hotel_id = $(this).data('id');
            let token = $("meta[name='csrf-token']").attr("content");

            Swal.fire({
                title: 'Konfirmasi Hapus',
                text: "Apakah anda yakin ingin menghapus data ini?",
                icon: 'error',
                showCancelButton: true,
                cancelButtonText: 'Kembali',
                confirmButtonText: 'Ya, Hapus!',
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: 'btn btn-secondary text-white'
                }
            }).then((result) => {
                if (result.isConfirmed) {

                    console.log('test');

                    $.ajax({
                        url: `/admin/management-mitra/hotel/${hotel_id}`,
                        type: "DELETE",
                        cache: false,
                        data: {
                            "_token": token
                        },
                        success: function(response) {

                            //remove post on table
                            $(`#index_${hotel_id}`).remove();
                            location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endpush
