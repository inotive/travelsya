@extends('ekstranet.layout', ['title' => 'Daftar Review', 'url' => '#'])

@section('content-admin')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Navbar-->
        <div class="card mb-5 mb-xl-10">
            <div class="card-body pt-9 pb-0">
                <!--begin::Details-->
                <div class="d-flex flex-wrap flex-sm-nowrap">
                    <!--begin: Pic-->

                    <!--end::Pic-->
                    <!--begin::Info-->
                    <div class="flex-grow-1 d-flex flex-column"> <!-- Tambahkan kelas "flex-column" di sini -->
                        <!--begin::Title-->
                        <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                            <!--begin::User-->
                            <div class="d-flex flex-column">
                                <!--begin::Name-->
                                <div class="d-flex align-items-center mb-2">
                                    <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">Rating
                                        Hunian Anda</a>
                                </div>
                                <!--end::Name-->
                                <!--begin::Info-->

                                <!--end::Info-->
                            </div>
                            <!--end::User-->
                            <!--begin::Actions-->
                            <div class="d-flex my-4 flex-column mt-0 m-5">
                                <a href="#"
                                    class="text-gray-900 text-hover-primary fs-1 fw-bold me-1">{{ number_format($data['avg_rate'], 1) }}
                                    / 5</a>
                                <span class="fw-semibold fs-7 text-gray-700">Dari {{ $data['total_review'] }} Review</span>
                                <!--begin::Menu-->

                                <!--end::Menu-->
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Title-->
                        <!--begin::Stats-->

                        <!--end::Stats-->
                    </div>
                    <!--end::Info-->
                </div>

                <!--end::Details-->
                <!--begin::Navs-->

                <!--begin::Navs-->
            </div>
        </div>
        <!--end::Navbar-->
        <!--begin::details View-->
        <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
            <!--begin::Card header-->
            <div class="card-header cursor-pointer">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Details Ratings</h3>
                </div>
                <!--end::Card title-->
                <!--begin::Action-->
                <!--end::Action-->
            </div>

            <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6 mb-xl-10 mb-5 mt-3 fs-5 fw-bold m-10">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#kt_tab_pane_1">Sangat Baik
                        ({{$data['ratings_5']->count()}}) </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_2">Baik
                        ({{$data['ratings_4']->count()}})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_3">Biasa
                        ({{$data['ratings_3']->count()}})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_4">Jelek
                        ({{$data['ratings_2']->count()}})</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#kt_tab_pane_5">Sangat Jelek
                        ({{$data['ratings_1']->count()}})</a>
                </li>
            </ul>

            <!--begin::Card header-->
            <!--begin::Card body-->
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                    @foreach ($data['ratings_5'] as $rating)
                        <div class="d-flex flex-wrap flex-sm-nowrap border border-secondary p-3 m-18 mt-1"
                            style="border-radius: 20px;">
                            <!--begin: Pic-->
                            <div class="me-15 mb-1">
                                <div class="symbol symbol-100px symbol-lg-150px symbol-fixed position-relative">
                                    <img src="{{ asset($rating->foto_user ?? 'assets/media/avatars/300-1.jpg') }}" alt="image" />
                                </div>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <div class="d-flex align-items-center mb-2 mt-5">
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $rating->user_name }}</a>
                                        </div>
                                        <!--end::Name-->
                                    </div>
                                    <!--end::User-->
                                    <!--begin::Actions-->
                                    <div class="d-flex align-items-center w-200px w-sm-200px flex-column mt-3">
                                        <a href="#" class="text-gray-700 text-hover-primary fs-6  me-0">Booking Id :
                                            {{ $rating->transaction_id }}</a>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Title-->
                                <!--begin::Stats-->
                                <div class="d-flex flex-wrap flex-stack">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column flex-grow-1 pe-8">
                                        <!--begin::Stats-->
                                        <div class="d-flex flex-    wrap">
                                            <!--begin::Stat-->
                                            <a href="#"
                                                class="text-gray-900 text-hover-primary fs-1 fw-bold me-1">"{{ $rating->comment }}"</a>
                                        </div>
                                        <div class="d-flex flex-wrap">
                                            <!--begin::Stat-->
                                            <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold me-1">Ada
                                                2 Foto
                                                Yang dilampirkan Customer</a>
                                        </div>
                                        <div class="d-flex flex-wrap">
                                            @for ($i = 0; $i < $rating->rate; $i++)
                                                <i class="fas fa-star text-warning m-1 mt-2" style="font-size: 25px;"></i>
                                            @endfor

                                            @php
                                                $createdAt = \Carbon\Carbon::parse($rating->createdat);
                                                $formattedDate = $createdAt->Format('d F Y');
                                            @endphp
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Progress-->
                                    <div class="d-flex align-items-center w-300px w-sm-220px flex-column mt-20">
                                        <div class="d-flex justify-content-between w-20 mt-auto mb-3">
                                            <span class="fw-semibold fs-6 fw-bold text-gray-900">Di Review Pada
                                                {{ $formattedDate }}
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Progress-->
                                </div>
                                <!--end::Stats-->
                            </div>
                            <!--end::Info-->
                        </div>
                    @endforeach
                    <!--end::Card body-->
                </div>
                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                    @foreach ($data['ratings_4'] as $rating)
                    <div class="d-flex flex-wrap flex-sm-nowrap border border-secondary p-3 m-18 mt-1"
                        style="border-radius: 20px;">
                        <!--begin: Pic-->
                        <div class="me-15 mb-1">
                            <div class="symbol symbol-100px symbol-lg-150px symbol-fixed position-relative">
                                <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="image" />
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2 mt-5">
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $rating->user_name }}</a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-semibold fs-5 mb-1 pe-1">
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-600 text-hover-primary me-5 mb-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            </i>Contoh Fasilitas</a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center w-200px w-sm-200px flex-column mt-3">
                                    <a href="#" class="text-gray-700 text-hover-primary fs-6  me-0">Booking Id :
                                        {{ $rating->transaction_id }}</a>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Title-->
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <!--begin::Stats-->
                                    <div class="d-flex flex-    wrap">
                                        <!--begin::Stat-->
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-1 fw-bold me-1">"{{ $rating->comment }}"</a>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <!--begin::Stat-->
                                        <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold me-1">Ada
                                            2 Foto
                                            Yang dilampirkan Customer</a>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        @for ($i = 0; $i < $rating->rate; $i++)
                                            <i class="fas fa-star text-warning m-1 mt-2" style="font-size: 25px;"></i>
                                        @endfor

                                        @php
                                            $createdAt = \Carbon\Carbon::parse($rating->createdat);
                                            $formattedDate = $createdAt->Format('d F Y');
                                        @endphp
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Progress-->
                                <div class="d-flex align-items-center w-300px w-sm-220px flex-column mt-20">
                                    <div class="d-flex justify-content-between w-20 mt-auto mb-3">
                                        <span class="fw-semibold fs-6 fw-bold text-gray-900">Di Review Pada
                                            {{ $formattedDate }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Progress-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                @endforeach
                </div>
                <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                    @foreach ($data['ratings_3'] as $rating)
                    <div class="d-flex flex-wrap flex-sm-nowrap border border-secondary p-3 m-18 mt-1"
                        style="border-radius: 20px;">
                        <!--begin: Pic-->
                        <div class="me-15 mb-1">
                            <div class="symbol symbol-100px symbol-lg-150px symbol-fixed position-relative">
                                <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="image" />
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2 mt-5">
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $rating->user_name }}</a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-semibold fs-5 mb-1 pe-1">
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-600 text-hover-primary me-5 mb-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            </i>Contoh Fasilitas</a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center w-200px w-sm-200px flex-column mt-3">
                                    <a href="#" class="text-gray-700 text-hover-primary fs-6  me-0">Booking Id :
                                        {{ $rating->transaction_id }}</a>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Title-->
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <!--begin::Stats-->
                                    <div class="d-flex flex-    wrap">
                                        <!--begin::Stat-->
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-1 fw-bold me-1">"{{ $rating->comment }}"</a>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <!--begin::Stat-->
                                        <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold me-1">Ada
                                            2 Foto
                                            Yang dilampirkan Customer</a>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        @for ($i = 0; $i < $rating->rate; $i++)
                                            <i class="fas fa-star text-warning m-1 mt-2" style="font-size: 25px;"></i>
                                        @endfor

                                        @php
                                            $createdAt = \Carbon\Carbon::parse($rating->createdat);
                                            $formattedDate = $createdAt->Format('d F Y');
                                        @endphp
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Progress-->
                                <div class="d-flex align-items-center w-300px w-sm-220px flex-column mt-20">
                                    <div class="d-flex justify-content-between w-20 mt-auto mb-3">
                                        <span class="fw-semibold fs-6 fw-bold text-gray-900">Di Review Pada
                                            {{ $formattedDate }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Progress-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                @endforeach
                </div>
                <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                    @foreach ($data['ratings_2'] as $rating)
                    <div class="d-flex flex-wrap flex-sm-nowrap border border-secondary p-3 m-18 mt-1"
                        style="border-radius: 20px;">
                        <!--begin: Pic-->
                        <div class="me-15 mb-1">
                            <div class="symbol symbol-100px symbol-lg-150px symbol-fixed position-relative">
                                <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="image" />
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2 mt-5">
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $rating->user_name }}</a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-semibold fs-5 mb-1 pe-1">
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-600 text-hover-primary me-5 mb-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            </i>Contoh Fasilitas</a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center w-200px w-sm-200px flex-column mt-3">
                                    <a href="#" class="text-gray-700 text-hover-primary fs-6  me-0">Booking Id :
                                        {{ $rating->transaction_id }}</a>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Title-->
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <!--begin::Stats-->
                                    <div class="d-flex flex-    wrap">
                                        <!--begin::Stat-->
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-1 fw-bold me-1">"{{ $rating->comment }}"</a>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <!--begin::Stat-->
                                        <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold me-1">Ada
                                            2 Foto
                                            Yang dilampirkan Customer</a>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        @for ($i = 0; $i < $rating->rate; $i++)
                                            <i class="fas fa-star text-warning m-1 mt-2" style="font-size: 25px;"></i>
                                        @endfor

                                        @php
                                            $createdAt = \Carbon\Carbon::parse($rating->createdat);
                                            $formattedDate = $createdAt->Format('d F Y');
                                        @endphp
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Progress-->
                                <div class="d-flex align-items-center w-300px w-sm-220px flex-column mt-20">
                                    <div class="d-flex justify-content-between w-20 mt-auto mb-3">
                                        <span class="fw-semibold fs-6 fw-bold text-gray-900">Di Review Pada
                                            {{ $formattedDate }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Progress-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                @endforeach
                </div>
                <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                    @foreach ($data['ratings_1'] as $rating)
                    <div class="d-flex flex-wrap flex-sm-nowrap border border-secondary p-3 m-18 mt-1"
                        style="border-radius: 20px;">
                        <!--begin: Pic-->
                        <div class="me-15 mb-1">
                            <div class="symbol symbol-100px symbol-lg-150px symbol-fixed position-relative">
                                <img src="{{ asset('assets/media/avatars/300-1.jpg') }}" alt="image" />
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2 mt-5">
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ $rating->user_name }}</a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-semibold fs-5 mb-1 pe-1">
                                        <a href="#"
                                            class="d-flex align-items-center text-gray-600 text-hover-primary me-5 mb-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            </i>Contoh Fasilitas</a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center w-200px w-sm-200px flex-column mt-3">
                                    <a href="#" class="text-gray-700 text-hover-primary fs-6  me-0">Booking Id :
                                        {{ $rating->transaction_id }}</a>
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Title-->
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <!--begin::Stats-->
                                    <div class="d-flex flex-    wrap">
                                        <!--begin::Stat-->
                                        <a href="#"
                                            class="text-gray-900 text-hover-primary fs-1 fw-bold me-1">"{{ $rating->comment }}"</a>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <!--begin::Stat-->
                                        <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold me-1">Ada
                                            2 Foto
                                            Yang dilampirkan Customer</a>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        @for ($i = 0; $i < $rating->rate; $i++)
                                            <i class="fas fa-star text-warning m-1 mt-2" style="font-size: 25px;"></i>
                                        @endfor

                                        @php
                                            $createdAt = \Carbon\Carbon::parse($rating->createdat);
                                            $formattedDate = $createdAt->Format('d F Y');
                                        @endphp
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Progress-->
                                <div class="d-flex align-items-center w-300px w-sm-220px flex-column mt-20">
                                    <div class="d-flex justify-content-between w-20 mt-auto mb-3">
                                        <span class="fw-semibold fs-6 fw-bold text-gray-900">Di Review Pada
                                            {{ $formattedDate }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Progress-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                @endforeach
                </div>
            </div>
        </div>
        <!--end::details View-->
        <!--begin::Row-->
    </div>
@endsection
