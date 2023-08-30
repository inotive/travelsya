@extends('layouts.web')

@section('content-web')
    <!--begin::Container-->
    <div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">

        <!--begin::Post-->
        <div class="content flex-row-fluid" id="kt_content">
            <!--begin::Contact-->
            <div class="card mb-4">
                <!--begin::Body-->
                <div class="card-body p-lg-17">
                    <!--begin::Row-->
                    <div class="row mb-3">
                        <!--begin::Col-->
                        <div class="col-md-12 pe-lg-10">
                            <!--begin::Form-->
                            <form action="#" class="form mb-15" method="post" id="kt_contact_form">
                                <!--begin::Input group-->
                                <div class="row mb-5">

                                    <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-5 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Kota</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <select class="form-control form-control-solid" name="durasi" id="durasi">
                                            <option value="Jakarta">Jakarta</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Check-in</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <input type="date" class="form-control form-control-solid" placeholder=""
                                            name="start_date" />
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Durasi</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <select class="form-control form-control-solid" name="durasi" id="durasi">
                                            @for ($i = 1; $i <= 30; $i++)
                                                <option value="$i">{{ $i }} Malam</option>
                                            @endfor
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <!--end::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Check-out</label>
                                        <!--end::Label-->

                                        <!--end::Input-->
                                        <span type="date" class="form-control form-control-solid" placeholder=""
                                            name="end_date"> dummydate </span>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Kamar</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <select class="form-control form-control-solid" name="durasi" id="durasi">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="$i">{{ $i }} Kamar</option>
                                            @endfor
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->

                                    <!--begin::Col-->
                                    <div class="col-md-4 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-5 fw-semibold mb-2">Tamu</label>
                                        <!--end::Label-->

                                        <!--begin::Input-->
                                        <select class="form-control form-control-solid" name="durasi" id="durasi">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="$i">{{ $i }} Tamu</option>
                                            @endfor
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Col-->

                                </div>
                                <!--end::Input group-->


                                <!--begin::Submit-->
                                <button type="submit" class="btn btn-primary" id="kt_contact_submit_button">

                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">
                                        Search</span>
                                    <!--end::Indicator label-->

                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">
                                        Please wait... <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                    <!--end::Indicator progress--> </button>
                                <!--end::Submit-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Contact-->

            <!--begin::Table widget 2-->
            <div class="h-md-100 mt-15">
                <!--begin::Header-->
                <div class="align-items-center border-0">
                    <!--begin::Title-->
                    <h3 class="fw-bold text-gray-900 m-0">Yang Paling Populer</h3>
                    <!--end::Title-->
                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div class="pt-2">
                    <!--begin::Nav-->
                    <ul class="nav nav-pills nav-pills-custom mb-3">
                        <!--begin::Item-->
                        @foreach ($cities as $key => $city)
                            <li class="nav-item mb-3 me-3 me-lg-6">
                                <!--begin::Link-->
                                <a class="nav-link d-flex justify-content-between flex-column flex-center {{ $key == 0 ? 'active' : '' }} overflow-hidden py-4"
                                    data-bs-toggle="pill" href="#kt_stats_widget_2_tab_{{ $city }}">

                                    <!--begin::Subtitle-->
                                    <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                        {{ $city }}
                                    </span>
                                    <!--end::Subtitle-->

                                    <!--begin::Bullet-->
                                    <span class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                    <!--end::Bullet-->
                                </a>
                        @endforeach
                        <!--end::Link-->
                        </li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Nav-->
                </div>
                <!--end: Card Body-->
            </div>
            <!--end::Table widget 2-->
            <!--begin::Tab Content-->
            <div class="tab-content ">
                <!--begin::Tap pane-->

                @foreach ($cities as $key => $city)
                    @php
                        $filterHostel = array_filter($hostelPopulers, function ($val) use ($city) {
                            return $val['city'] == $city;
                        });
                    @endphp
                    @foreach ($filterHostel as $key2 => $hostelPopuler)
                        <div class="tab-pane fade  {{ $key2 == 0 ? 'show active' : '' }}"
                            id="kt_stats_widget_2_tab_{{ $city }}">

                            <div class="tns tns-default" style="direction: ltr">
                                <!--begin::Slider-->
                                <div data-tns="true" data-tns-loop="false" data-tns-autoPlay="false"
                                    data-tns-responsive='{"350":{"items": 1},"500":{"items": @php echo (count($filterHostel)-2 < 0) ? count($filterHostel)-2 : 1 @endphp},"970":{"items": @php echo count($filterHostel) @endphp}}'
                                    data-tns-rewind="true" data-tns-swipe-angle="true" data-tns-speed="1000"
                                    data-tns-controls="true" data-tns-nav="false" data-tns-items="4" data-tns-center="false"
                                    data-tns-dots="false" data-tns-prev-button="#kt_team_slider_prev{{ $city }}"
                                    data-tns-next-button="#kt_team_slider_next{{ $city }}">
                                    @for ($i = 1; $i < 10; $i++)
                                        <!--begin::Item-->
                                        <div class="text-center px-5 py-5">
                                            <img src="{{ $hostelPopuler['hostel_image'][0]['image'] }}"
                                                class="rounded-3 mb-4 w-200px h-200px w-xxl-200px h-xxl-200px"
                                                alt="" />
                                            <!--begin::Info-->
                                            <div class="mb-2">
                                                <!--begin::Title-->
                                                <div class="text-center">
                                                    <span
                                                        class="fw-bold text-gray-800 cursor-pointer text-hover-primary fs-3 fs-xl-1">
                                                        {{ $hostelPopuler['name'] }}
                                                    </span>
                                                    <span class="text-gray-600 cursor-pointer d-block">
                                                        @for ($j = 0; $j < $hostelPopuler['rating_avg']; $j++)
                                                            <span class="fa fa-star" style="color: orange;"></span>
                                                        @endfor
                                                        ({{ $hostelPopuler['rating_count'] }})
                                                    </span>

                                                    <span class="text-gray-400 fw-semibold d-block fs-6 mt-n1">
                                                        {{ 'Rp ' . number_format($hostelPopuler['price_avg'], 0, ',', '.') }}
                                                    </span>
                                                </div>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                        <!--end::Item-->
                                    @endfor
                                    ...
                                </div>
                                <!--end::Slider-->

                                <!--begin::Slider button-->
                                <button class="btn btn-icon btn-active-color-primary "
                                    id="kt_team_slider_prev{{ $city }}">
                                    <span class="svg-icon fs-3x">
                                        < </span>
                                </button>
                                <!--end::Slider button-->

                                <!--begin::Slider button-->
                                <button class="btn btn-icon btn-active-color-primary"
                                    id="kt_team_slider_next{{ $city }}">
                                    <span class="svg-icon fs-3x">
                                        > </span>
                                </button>
                                <!--end::Slider button-->
                            </div>
                        </div>
                    @endforeach
                @endforeach
                <!--end::Tap pane-->
            </div>
            <!--end::Tab Content-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Container-->
@endsection
