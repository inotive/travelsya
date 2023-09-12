@extends('layouts.auth')

@section('content-auth')
<!--begin::Body-->
<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
    <!--begin::Wrapper-->
    <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-475px">
            <!--begin::Wrapper-->
            <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">

                <!--begin::Form-->
                <form class="form w-100" method="post" novalidate="novalidate" id="kt_sign_in_form"  action="{{route('register')}}">
                    <!--begin::Heading-->
                    @csrf
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-dark fw-bolder mb-3">
                            Daftar Akun
                        </h1>
                        <!--end::Title-->
                    </div>
                    <!--begin::Heading-->

                    <!--begin::Input group--->
                    <div class="fv-row mb-8">
                        <label for="" class="form-label">Nama</label>
                        <!--begin::Name-->
                        <input type="text" placeholder="Masukan nama" name="name" autocomplete="off" class="form-control form-control-lg p-5 bg-transparent @error('name') is-invalid @enderror" />
                        <!--end::Name-->
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <!--begin::Input group--->
                    <div class="fv-row mb-8">

                        <label for="email" class="form-label">Email</label>
                        <!--begin::Email-->
                        <input type="text" placeholder="Masukan email anda" name="email" autocomplete="off" class="form-control form-control-lg p-5 bg-transparent  @error('email') is-invalid @enderror" />
                        <!--end::Email-->
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <!--end::Input group--->
                    <div class="fv-row mb-3">

                        <label for="email" class="form-label">Password</label>
                        <!--begin::Password-->
                        <input type="password" placeholder="Masukan password anda" name="password" autocomplete="off" class="form-control form-control-lg p-5 bg-transparent @error('password') is-invalid @enderror" />
                        <!--end::Password-->
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <!--end::Input group--->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                        <div></div>

                        <!--begin::Link-->
                        <a href="{{route('password.request')}}" class="link-primary">
                            Lupa Password ?
                        </a>
                        <!--end::Link-->
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Submit button-->
                    <div class="d-grid mb-10">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary">

                            <!--begin::Indicator label-->
                            <span class="indicator-label">
                                Daftar </span>
                            <!--end::Indicator label-->

                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                            <!--end::Indicator progress--> </button>
                    </div>
                    <!--end::Submit button-->

                    <!--begin::Sign up-->
                    <div class="text-gray-500 text-center fw-semibold fs-6">
                        Have a Member?

                        <a href="{{route('login')}}" class="link-primary">
                            Sign In
                        </a>
                    </div>
                    <!--end::Sign up-->
                </form>
                <!--end::Form-->

            </div>
            <!--end::Wrapper-->

            <!--begin::Footer-->
            <div class=" d-flex flex-stack">
                <!--begin::Languages-->
                <div class="me-10">
                </div>
                <!--end::Languages-->

                <!--begin::Links-->
                <div class="d-flex fw-semibold text-primary fs-base gap-5">
                    <a href="../../../pages/team.html" target="_blank">Terms</a>

                    <a href="../../../pages/pricing/column.html" target="_blank">Plans</a>

                    <a href="../../../pages/contact.html" target="_blank">Contact Us</a>
                </div>
                <!--end::Links-->
            </div>
            <!--end::Footer-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Body-->
@endsection
