@extends('layouts.user')

@section('content-user')
    <div class="container">
        {{-- Row --}}
        <div class="row">
            {{-- Kolom Kiri (Menu) --}}
            @include('user.user-navigation')
            {{-- End Kolom Kiri --}}

            {{-- Kolom Kanan (Form Riwayat PEsanan) --}}
            <div class="col-12 col-lg-7">
                <div class="card">
                    {{-- Card Head --}}
                    <div class="card-header">
                        <div class="card-title">
                            <h1>
                                <b>
                                    Points
                                </b>
                            </h1>

                        </div>
                        <div class="card-title">
                            <a href="/"
                            class="btn btn-outline btn-outline-danger border border-danger fw-bold t"
                            style="padding: 12px 16px 12px 16px; border: 1px;">
                           Redeem Point
                        </a>
                        </div>
                    </div>
                    {{-- Card Body --}}
                    <div class="card-body">
                        {{-- Row --}}
                        <div class="row">
                            {{-- kolom batas form --}}
                            <div class="col-12">
                                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a id="pills-semua-tab" data-bs-toggle="pill" data-bs-target="#pills-semua"
                                            role="tab" aria-controls="pills-semua" aria-selected="true"
                                            class="nav-link btn btn-light-danger py-1 text-bold px-4 border border-1 rounded-pill fw-bold border-danger active">
                                            Riwayat
                                        </a>
                                    </li>
                            </div>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade pills-semua active show" id="pills-semua" role="tabpanel"
                                aria-labelledby="pills-semua-tab" tabindex="0">

                                @foreach ($historyPoints as $point)
                                    <div class="card border border-3 mt-2 bg-gradient-merah cursor-pointer" style="">
                                        <div class="d-flex justify-content-between align-items-center m-5">
                                            <div class="kiri d-flex">

                                                @if ($point->transaction->service_id == 8)
                                                    <div class="symbol symbol-40px">
                                                        <img src="{{ asset('assets/media/products-categories/icon-hotel.png') }}"
                                                            alt="frame5">
                                                    </div>
                                                @elseif($point->transaction->service_id == 7)
                                                    <div class="symbol symbol-40px">
                                                        <img src="{{ asset('assets/media/products-categories/icon-hostel.png') }}"
                                                            alt="frame5">
                                                    </div>
                                                @elseif($point->transaction->service_id == 3)
                                                    <div class="symbol symbol-40px">
                                                        <img src="{{ asset('assets/media/products-categories/icon-pln.png') }}"
                                                            alt="frame5">
                                                    </div>
                                                @elseif ($point->transaction->service_id == 1 || $point->transaction->service_id == 2)
                                                    <div class="symbol symbol-40px">
                                                        <img src="{{ asset('assets/media/products-categories/icon-pulsa.png') }}"
                                                            alt="frame5">
                                                    </div>
                                                @elseif ($point->transaction->service_id == 11)
                                                    <div class="symbol symbol-40px">
                                                        <img src="{{ asset('assets/media/products-categories/icon-wallet.png') }}"
                                                            alt="frame5">
                                                    </div>
                                                @else
                                                    <div class="symbol symbol-40px">
                                                        <img src="{{ asset('assets/media/products-categories/icon-bpjs.png') }}"
                                                            alt="frame5">
                                                    </div>
                                                @endif
                                                <div class="row ms-5">
                                                    <div class="fs-7 fw-semibold">
                                                        {{ \Carbon\Carbon::parse($point->created_at)->format('d M Y H:i:s') }}
                                                    </div>
                                                    <div class="fs-7 text-gray-500 fw-semibold mt-1 mb-1">
                                                        {{ $point->transaction->no_inv }}
                                                    </div>
                                                    <div class="fs-4 fw-bold">
                                                        {{ Str::ucfirst($point->transaction->service) }}
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column" style=" margin-left: 16px">
                                                    <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold"
                                                        style="margin-bottom: 8px">
                                                    </a>
                                                    <span class="text-gray-400" style="margin-bottom: 6px">
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="kanan">
                                                <div class="d-flex align-items-center waduh">
                                                    <svg width="20" height="21" viewBox="0 0 20 21" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <g clip-path="url(#clip0_3_29068)">
                                                            <path
                                                                d="M17.6396 14.4767C18.735 13.0485 19.3301 11.2998 19.333 9.5V11.5C19.3298 13.2842 18.7446 15.0186 17.6663 16.4399V14.5L17.6396 14.4767Z"
                                                                fill="#CE893D" />
                                                            <path
                                                                d="M17.6667 14.4998V16.4398C17.1903 17.078 16.6296 17.6488 16 18.1366V16.1665L15.9834 16.1465C16.6076 15.6662 17.1647 15.1045 17.64 14.4766L17.6667 14.4998Z"
                                                                fill="#E6A71E" />
                                                            <path
                                                                d="M10.0003 0.833496C15.1536 0.833496 19.3337 4.71354 19.3337 9.50016C19.3307 11.3 18.7357 13.0487 17.6403 14.4769C17.165 15.1048 16.6079 15.6665 15.9837 16.1468C15.4723 16.5487 14.9191 16.894 14.3337 17.1768C13.6952 17.4881 13.0246 17.7285 12.3337 17.8936C10.7995 18.258 9.20117 18.258 7.66699 17.8936C6.97607 17.7285 6.3055 17.4881 5.66699 17.1768C5.08154 16.894 4.52832 16.5487 4.01693 16.1468C3.39274 15.6665 2.83561 15.1048 2.36035 14.4769C1.26497 13.0487 0.669922 11.3 0.666992 9.50016C0.666992 4.71354 4.84701 0.833496 10.0003 0.833496Z"
                                                                fill="#FFCB5A" />
                                                            <path
                                                                d="M15.9997 16.1665V18.1366C15.4844 18.5413 14.9268 18.8888 14.3363 19.1732L14.333 19.1665V17.1764C14.9185 16.8937 15.4717 16.5483 15.9831 16.1465L15.9997 16.1665Z"
                                                                fill="#CE893D" />
                                                            <path
                                                                d="M14.333 19.1668L14.3363 19.1735C13.7013 19.4849 13.034 19.7251 12.3464 19.8901L12.333 19.8335V17.8936C13.0239 17.7285 13.6945 17.4881 14.333 17.1768V19.1668Z"
                                                                fill="#E6A71E" />
                                                            <path
                                                                d="M12.3467 19.8901C11.578 20.0744 10.7904 20.1672 10 20.1668V18.1668C10.7858 18.1683 11.5692 18.0765 12.3333 17.8936V19.8335L12.3467 19.8901Z"
                                                                fill="#CE893D" />
                                                            <path
                                                                d="M10 18.1668V20.1668C9.20964 20.1672 8.42204 20.0744 7.65332 19.8901L7.66667 19.8335V17.8936C8.43083 18.0765 9.21419 18.1683 10 18.1668Z"
                                                                fill="#E6A71E" />
                                                            <path
                                                                d="M7.66634 17.8936V19.8335L7.65299 19.8901C6.96533 19.7251 6.29801 19.4849 5.66309 19.1735L5.66634 19.1668V17.1768C6.30485 17.4881 6.97542 17.7285 7.66634 17.8936Z"
                                                                fill="#CE893D" />
                                                            <path
                                                                d="M4.0166 16.1465C4.52799 16.5483 5.08122 16.8937 5.66667 17.1764V19.1665L5.66341 19.1732C5.07373 18.8877 4.51611 18.5402 4 18.1366V16.1665L4.0166 16.1465Z"
                                                                fill="#E6A71E" />
                                                            <path
                                                                d="M2.3597 14.4766C2.83496 15.1045 3.39209 15.6662 4.01628 16.1465L3.99967 16.1665V18.1366C3.37012 17.6488 2.80941 17.078 2.33301 16.4398V14.4998L2.3597 14.4766Z"
                                                                fill="#CE893D" />
                                                            <path
                                                                d="M0.666992 9.5C0.669922 11.2998 1.26497 13.0485 2.36035 14.4767L2.33366 14.5V16.4399C1.25537 15.0186 0.670247 13.2842 0.666992 11.5V9.5Z"
                                                                fill="#E6A71E" />
                                                            <path
                                                                d="M17.3337 9.50016C17.3337 5.8182 14.0505 2.8335 10.0003 2.8335C5.9502 2.8335 2.66699 5.8182 2.66699 9.50016C2.66699 13.1821 5.9502 16.1668 10.0003 16.1668C14.0505 16.1668 17.3337 13.1821 17.3337 9.50016Z"
                                                                fill="#E6A71E" />
                                                            <path
                                                                d="M14.5807 13.4095L14.125 12.9235C14.5145 12.5605 14.8446 12.1385 15.1027 11.6729L15.6867 11.9935C15.3952 12.521 15.0218 12.999 14.5807 13.4095Z"
                                                                fill="#FFCB5A" />
                                                            <path
                                                                d="M10.0003 15.1668C6.50798 15.1668 3.66699 12.6248 3.66699 9.50016C3.66699 6.37549 6.50798 3.8335 10.0003 3.8335C13.4927 3.8335 16.3337 6.37549 16.3337 9.50016H15.667C15.667 6.74316 13.125 4.50016 10.0003 4.50016C6.87565 4.50016 4.33366 6.74316 4.33366 9.50016C4.33366 12.2572 6.87565 14.5002 10.0003 14.5002C11.1123 14.5055 12.2049 14.2106 13.1629 13.6462L13.5044 14.2192C12.443 14.8449 11.2324 15.1724 10.0003 15.1668Z"
                                                                fill="#FFCB5A" />
                                                        </g>
                                                        <defs>
                                                            <clipPath id="clip0_3_29068">
                                                                <rect width="20" height="20" fill="white"
                                                                    transform="translate(0 0.5)" />
                                                            </clipPath>
                                                        </defs>
                                                    </svg>
                                                    <div class="fs-4 fw-bold ms-2">
                                                        @if ($point->flow === 'debit')
                                                            <span class="text-success">+ {{ $point->point }}</span>
                                                        @elseif($point->flow === 'credit')
                                                            <span class="text-danger">- {{ $point->point }}</span>
                                                        @endif
                                                    </div>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    {{-- End Kolom Kanan --}}
                </div>
                {{-- End Row --}}
            </div>
        @endsection
