@extends('admin.layout', ['title' => 'Profile', 'url' => '#'])

@section('content-admin')
    <div class="card">
        <div class="card-header">
            <h3 class="mt-5">Update Profile</h3>

        </div>
        <form id="kt_modal_new_target_form" class="form" method="post"
            action="{{ route('admin.update-profile', $data->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Foto Profile</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline m-5" data-kt-image-input="true">
                            <!--begin::Image preview wrapper-->
                            <div class="image-input-wrapper w-125px h-125px"
                                style="background-image: url('{{ $data->image != null ? asset('storage/profile/' . $data->image) : asset('assets/media/avatars/300-1.jpg') }}')">
                            </div>
                            <!--end::Image preview wrapper-->

                            <!--begin::Edit button-->
                            <label
                                class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                title="Change image">
                                <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span
                                        class="path2"></span></i>

                                <!--begin::Inputs-->
                                <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="image_remove" />
                                <!--end::Inputs-->
                            </label>
                            <!--end::Edit button-->

                            <!--begin::Cancel button-->
                            <span
                                class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                title="Cancel image">
                                <i class="ki-outline ki-cross fs-3"></i>
                            </span>
                            <!--end::Cancel button-->

                            <!--begin::Remove button-->
                            <span
                                class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
                                title="Remove image">
                                <i class="ki-outline ki-cross fs-3"></i>
                            </span>
                            <!--end::Remove button-->
                        </div>
                        <!--end::Image input-->
                        <!--begin::Hint-->
                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Col-->
                </div>
                <div class="row g-9 mb-8">
                    <div class="col-md-12">
                        <label class=" required fs-6 fw-semibold mb-2">Nama</label>
                        <input class="form-control form-control-lg" id="name" name="name"
                            placeholder="Masukan nama perusahaan" required value="{{ old('name', $data->name) }}" />
                    </div>
                    <div class="col-md-6">
                        <label class=" required fs-6 fw-semibold mb-2">Email</label>
                        <input class="form-control form-control-lg" id="email" name="email"
                            placeholder="Masukan nama email" required value="{{ old('email', $data->email) }}" />
                    </div>
                    <div class="col-md-6">
                        <label class=" required fs-6 fw-semibold mb-2">Password</label>
                        <input class="form-control form-control-lg" id="password" name="password" type="password"
                            placeholder="Masukan nama email" />
                        <span style="color: red">Kosongkan Jika Tidak Ingin Merubah Password</span>

                    </div>
                    <div class="col-md-12">
                        <label class=" required fs-6 fw-semibold mb-2">Nomor Telphone</label>
                        <input class="form-control form-control-lg" id="phone" name="phone"
                            placeholder="Masukan nomor telfon" required value="{{ old('phone', $data->phone) }}" />
                    </div>
                </div>


            </div>
            <div class="card-footer text-end">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline text-dark w-100 me-2">Kembali</a>
                    <button class="btn btn-primary submit-btn w-100 me-3" type="submit">Update</button>
                </div>
            </div>
        </form>

    </div>
@endsection
@push('add-script')
@endpush
