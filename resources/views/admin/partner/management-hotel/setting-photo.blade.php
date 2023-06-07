@extends('admin.layout',['title' => 'Setting Photo - Hotel A',"url" => "#"])

@section('content-admin')
    <!--begin::Row-->
    <div class="row gy-5 g-xl-10">
        <!--begin::Col-->
        <div class="col-4">
            <div class="card mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <div class="row">
                        <!--begin::Form-->
                        <form class="form" action="#" method="post">
                            <!--begin::Input group-->
                            <div class="fv-row">
                                <!--begin::Dropzone-->
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
                    <button class="btn btn-primary w-100 mb-3">Upload Photo</button>
                    <button class="btn btn-outline btn-outline btn-outline-secondary me-3 text-dark btn-active-light-secondary w-100">Kembali</button>
                </div>
            </div>
        </div>
        <!--end::Col-->
        <div class="col-8">
            <div class="card card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body my-3">
                    <div class="row">
                        <div class="col-6">
                            <div class="card border border-light-subtle">
                                <div class="card-body">
                                    <img src="{{asset('admin/assets/media/Rooms.jpg')}}" style="width: 100%; height: 150px;" alt="image">
                                </div>
                                <div class="card-footer py-2">
                                    <button class="btn btn-primary mb-3 w-100 btn-sm">Jadikan Foto Utama</button>
                                    <button class="btn btn-outline btn-outline btn-sm btn-outline-danger text-dark  w-100">Delete Photo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end:: Body-->
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>
        var myDropzone = new Dropzone("#kt_dropzonejs_example_1", {
            url: "https://keenthemes.com/scripts/void.php", // Set the url for your upload script location
            paramName: "file", // The name that will be used to transfer the file
            maxFiles: 10,
            maxFilesize: 10, // MB
            addRemoveLinks: true,
            accept: function(file, done) {
                if (file.name == "wow.jpg") {
                    done("Naha, you don't.");
                } else {
                    done();
                }
            }
        });
    </script>
@endsection
