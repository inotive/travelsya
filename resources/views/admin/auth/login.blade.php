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
                @if($errors->all())
                <div class="font-medium text-red-600">
                    Whoops! Something went wrong.
                </div>
                @endif
                <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    @if($message)
                    <li>{{ $message }}</li>
                    @endif
                    @if(isset($_GET['message']))
                    <li>{{ $_GET['message'] }}</li>
                    @endif
                </ul>
                <!--begin::Form-->
                <form class="form w-100" method="post" novalidate="novalidate" id="kt_sign_in_form"  action="{{route('admin.login.post')}}">
                    <!--begin::Heading-->
                    @csrf
                    <div class="text-center mb-11">
                        <!--begin::Title-->
                        <h1 class="text-dark fw-bolder mb-3">
                            Ekstranet Travelsya
                        </h1>
                        <!--end::Title-->

                        <!--begin::Subtitle-->
                        <div class="text-gray-500 fw-semibold fs-6">
                            Masukan email dan password untuk login
                        </div>
                        <!--end::Subtitle--->
                    </div>
                    <!--begin::Heading-->

                    <!--begin::Input group--->
                    <div class="fv-row mb-8">
                        <label for="email" class="form-label">Eamil</label>
                        <!--begin::Email-->
                        <input type="text" placeholder="Masukan email anda" name="email" autocomplete="off" class="form-control form-control-lg p-5 " />
                        <!--end::Email-->
                    </div>

                    <!--end::Input group--->
                    <div class="fv-row mb-3">
                        <label for="email" class="form-label">Password</label>
                        <!--begin::Password-->

                        <input type="password" placeholder="Masukan password" name="password" autocomplete="off" class="form-control form-control-lg p-5 " />
                        <!--end::Password-->
                    </div>
                    <!--end::Input group--->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                        <div></div>

{{--                        <!--begin::Link-->--}}
{{--                        <a href="{{route('password.reset')}}" class="link-primary">--}}
{{--                            Forgot Password ?--}}
{{--                        </a>--}}
{{--                        <!--end::Link-->--}}
                    </div>
                    <!--end::Wrapper-->

                    <!--begin::Submit button-->
                    <div class="d-grid mb-10">
                        <button type="submit" id="kt_sign_in_submit" class="btn btn-primary py-5">

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

                </form>
                    <a href="" type="role" id="kt_sign_in_submit" class="btn btn-primary py-5">

                        <!--begin::Indicator label-->
                        <span class="indicator-label">Masuk</span>
                        <!--end::Indicator label-->

                        <!--begin::Indicator progress-->
                        <span class="indicator-progress">
                                Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        <!--end::Indicator progress--> </a>
                <!--end::Form-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Wrapper-->
</div>
<!--end::Body-->
@endsection
