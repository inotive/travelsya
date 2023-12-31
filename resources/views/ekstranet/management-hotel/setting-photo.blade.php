@extends('admin.layout',['title' => 'Setting Photo - Hotel A',"url" => "#"])

@section('content-admin')
    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-4">
            <form id="kt_modal_new_target_form " class="form " method="post" enctype="multipart/form-data" action="{{route('admin.hostel.store-image',$hostel->id)}}">
            <div class="card mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <div class="row">
                        <!--begin::Form-->
                                @csrf
                                <input type="hidden" name="id" value="{{$hostel->id}}">
                            <!--begin::Input group-->
                            <div class="fv-row">
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
                            </div>
                            <!--end::Input group-->
                        </form>
                        <!--end::Form-->
                    </div>
                </div>
                <!--end:: Body-->
                <div class="card-footer p-4">
                    <button type="submit" class="btn btn-primary w-100 mb-3">Upload Photo</button>
                    <a href="{{route('partner.management.hotel')}}" class="btn btn-outline btn-outline btn-outline-secondary me-3 text-dark btn-active-light-secondary w-100">Kembali</a>
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
                        @foreach($hostel->hostelImage as $image)

                        <div class="col-6">
                            <div class="card border border-light-subtle">
                                <div class="card-body">
                                    <img src="{{$image->image}}"  style="width: 100%; height: 150px; bac" alt="image">
                                </div>
                                <div class="card-footer py-2">
                                    <form action="{{route('admin.hostel.main-image')}}" method="post" class="d-flex flex-column">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$image->id}}">
                                        <input type="hidden" name="hostelid" value="{{$hostel->id}}">
                                    <button class="btn btn-primary mb-3 w-100 btn-sm">Jadikan Foto Utama</button>

                                    </form>
                                    <form action="{{route('admin.hostel.delete-image')}}" method="post" class="d-flex flex-column">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name="id" value="{{$image->id}}">
                                        <button class="btn btn-outline btn-outline btn-sm btn-outline-danger text-dark  w-100">Delete Photo</button>
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
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>

    <script>
        $('#kt_dropzonejs_example_1').on('click',function(e){
            e.preventDefault()
            // console.log('oke');
            $('.file-upload').trigger('click');
        });
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


    </script>
@endpush
