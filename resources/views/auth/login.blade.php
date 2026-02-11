@extends('layouts.auth')

@section('content-auth')
<!--begin::Body-->
<div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
    <!--begin::Wrapper-->
    <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-500px p-10">
        <!--begin::Content-->
        <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
            <!--begin::Wrapper-->
            <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
{{--                @if($errors->all())--}}
{{--                <div class="font-medium text-red-600">--}}
{{--                    Whoops! Something went wrong.--}}
{{--                </div>--}}
{{--                @endif--}}
{{--                <ul class="mt-3 list-disc list-inside text-sm text-red-600">--}}
{{--                    @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                    @endforeach--}}
{{--                    @if($message)--}}
{{--                    <li>{{ $message }}</li>--}}
{{--                    @endif--}}
{{--                    @if(isset($_GET['message']))--}}
{{--                    <li>{{ $_GET['message'] }}</li>--}}
{{--                    @endif--}}
{{--                </ul>--}}
{{--                <!--begin::Form-->--}}
                <form class="form w-100" method="POST" action="{{route('login')}}" novalidate="novalidate" id="kt_sign_in_form"  >
                    <!--begin::Heading-->
                    @csrf
                    <div class="mb-7">
                        <!--begin::Title-->
                        <h1 class="text-dark  fw-bolder mb-3">
                            Masuk
                        </h1>
                        <!--end::Title-->

                        <!--begin::Subtitle-->
                        <div class="text-gray-500 fw-semibold fs-6">
                            Login dengan email dan password
                        </div>
                        <!--end::Subtitle--->
                    </div>
                    <!--begin::Heading-->

                    <!--begin::Input group--->
                    <div class="fv-row mb-8">
                        <label for="email" class="form-label">Email</label>
                        <input
                            name="email"
                            type="email"
                            class="form-control form-control-lg p-5 bg-transparent @error('email') is-invalid @enderror"
                            id="email"
                            placeholder="Masukan email anda"
                            aria-describedby="emailHelp"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus
                        />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
{{--                        <!--begin::Email-->--}}
{{--                        <input type="text" placeholder="Email" name="email" autocomplete="off" class="form-control form-control-lg p-5 bg-transparent" />--}}
{{--                        <!--end::Email-->--}}
                    </div>

                    <!--end::Input group--->
                    <div class="fv-row mb-3">
                        <label for="email" class="form-label">Password</label>
                        <input id="password" type="password"
                               PLACEHOLDER="Masukan Password"
                               class="form-control  form-control-lg p-5 @error('password') is-invalid @enderror" name="password"
                               required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
{{--                        <!--begin::Password-->--}}
{{--                        <input type="password" placeholder="Password" name="password" autocomplete="off" class="form-control form-control-lg p-5 bg-transparent" />--}}
{{--                        <!--end::Password-->--}}
                    </div>
                    <!--end::Input group--->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                        <div></div>

                        <!--begin::Link-->
                        <a href="{{route('password.request')}}" class="link-primary">
                            Forgot Password ?
                        </a>
                        <!--end::Link-->
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Submit button-->
                    <div class="d-grid">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-danger btn-lg">

                            <!--begin::Indicator label-->
                            <span class="indicator-label">Masuk</span>
                            <!--end::Indicator label-->

                            <!--begin::Indicator progress-->
                            <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                            <!--end::Indicator progress--> </button>
                    </div>
                    <!--end::Submit button-->
                    <a href="/" type="button" id="kt_sign_in_submit" class="btn btn-outline p-4 btn-outline btn-outline-secondary text-dark btn-active-light-secondary btn-lg w-100 mt-5 mb-10">
                        Kembali Ke Home
                    </a>

                    <!--begin::Sign up-->
                    <div class="text-gray-500 text-center fw-semibold fs-6">
                        Belum memiliki akun ?

                        <a href="{{route('register')}}" class="link-primary">
                            Registrasi
                        </a>
                    </div>
                    <!--end::Sign up-->
                </form>
                <!--end::Form-->
                    <div class="separator separator-content my-14">
                        <span class="w-125px text-gray-500 fw-semibold fs-7">Login Ekstranet</span>
                    </div>
                    <a href="{{route('admin.login')}}" type="button" id="kt_sign_in_submit" class="btn btn-primary btn-outline-primary btn-lg w-100">
                        Masuk Sebagai Partner
                    </a>
            </div>
            <!--end::Wrapper-->


        </div>
        <!--end::Content-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Body-->
@endsection
