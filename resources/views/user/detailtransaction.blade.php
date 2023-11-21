@extends('layouts.web')

@section('content-web')

<div id="kt_content_container" class="container-xxl">
    <div class="row mb-20">
        <div class="col-md-4">
            @include('layouts.include.menu-user')
        </div>
        <div class="col-md-8">
            <!--begin::details View-->
            <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                <!--begin::Card header-->
                <div class="card-header cursor-pointer">
                    <!--begin::Card title-->
                    <div class="card-title m-0 ">
                        <a href="{{route('user.transaction')}}">
                            <i class="fa fa-chevron-left me-10 text-dark"></i>
                        </a>
                        <h2 class="fw-bold m-0 fs-1">{{($transaction['service']!='hostel')?$transaction['detail_transaction'][0]['product']['description']:'hostel'}}</h2>
                    </div>
                    <button class="fw-semibold fs-5 btn-review px-5 my-5">Berikan Review</button>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->

                <!--begin::Card body-->
                <div class="card-body p-9">
                    <div class="d-flex justify-content-center text-center gap-4">
                        <div class="bg-secondary py-4 rounded-2 w-100">
                            <div class="fw-bold text-gray-500">Check in</div>
                            <div class="fw-bold fs-6 my-1">19 Feb 2023</div>
                            <div class="">10:00 AM</div>

                        </div>
                        <div class="bg-secondary py-4 rounded-2 w-100">
                            <div class="fw-bold text-gray-500">Check out</div>
                            <div class="fw-bold fs-6 my-1">19 Feb 2023</div>
                            <div class="">12:00 AM</div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between gap-5 mt-5">
                        <div class="card card-bordered w-60">
                            <div class="card-body">
                                <div class="row mb-5">
                                    <div class="fs-3 fw-bold w-50 col-md-6">Lokasi</div>
                                    <a href="#" class="text-danger fs-5 fw-semibold col-md-6 text-end">Buka di Map</a>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3944.1617484544986!2d115.15555671478411!3d-8.676163693766112!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd24713a8605849%3A0x7cadc72d02106b03!2sMaca%20Villas%20%26%20Spa!5e0!3m2!1sen!2sid!4v1684094657861!5m2!1sen!2sid" width="550" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                                        <div class="text-gray-500 d-flex">
                                            <i class="far fa-map me-4"></i>
                                            Jl. Lb. Sari Jl. Petitenget No.7, Seminyak, Kec. Kuta Utara, Kabupaten Badung, Bali 80361
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

{{--                        <div class="card card-bordered px-5">--}}
{{--                            <div class="my-3 text-center">--}}
{{--                                <div class="my-5">--}}
{{--                                    <img alt="" src="{{asset('assets/media/products-categories/icon-hostel.png')}}" class="w-55px p-3 bg-danger rounded-circle bg-opacity-15 my-5" />--}}
{{--                                    <p>E-tiket</p>--}}
{{--                                </div>--}}

{{--                                <div class="my-5">--}}
{{--                                    <img alt="" src="{{asset('assets/media/products-categories/icon-hostel.png')}}" class="w-55px p-3 bg-danger rounded-circle bg-opacity-15 my-5" />--}}
{{--                                    <p>Bukti Pembayaran</p>--}}
{{--                                </div>--}}

{{--                                <div class="my-5">--}}
{{--                                    <img alt="" src="{{asset('assets/media/products-categories/icon-hostel.png')}}" class="w-55px p-3 bg-danger rounded-circle bg-opacity-15 my-5" />--}}
{{--                                    <p>Hapus Riwayat</p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                    <div class="d-flex justify-content-between text-center mt-5 gap-4 bg-danger py-4 rounded-2  bg-opacity-15">
                        <div class="fw-bold fs-5 px-5">Total Biaya</div>
                        <div class="fw-bold fs-5 px-5">Rp. 218,999</div>
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::details View-->
        </div>
    </div>
</div>
@endsection

@push('add-style')
<style>
    body {
        background-size: 100% 80px !important;
    }

    .btn-review {
        border: 2px solid #C02425;
        background-color: white;
        border-radius: 5px;
        color: #C02425;
    }

    .btn-review:hover {
        background-color: #C02425;
        color: white;
    }
</style>
@endpush
