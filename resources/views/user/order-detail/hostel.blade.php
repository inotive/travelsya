@extends('layouts.user')

@section('content-user')

    <style>
        .bg-gradient-merah {
            background: rgb(255, 238, 241);
            background: linear-gradient(270deg, rgba(255, 238, 241, 1) 0%, rgba(255, 255, 255, 1) 50%);

        }
        .rating-label i {
        font-size: 38px;
    }
    </style>

    {{-- Container --}}
    <div class="container">
        {{-- Row --}}
        <div class="row">
            {{-- Kolom Kiri (Menu)--}}
            @include('user.user-navigation')
            {{-- End Kolom Kiri --}}

            {{-- Kolom Kanan (Form Detail PEsanan) --}}
            <div class="col-12 col-lg-7">
                <div class="card">
                    {{-- Card Head --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{-- <div class="card-title"> --}}
                        <div class="d-flex align-items-center">
                            <div class="image-back">
                                <img src="{{ asset('assets/media/svg/profile-account/order-history/down-2.svg') }}"
                                     alt="down" style="margin-right: 16px; margin-bottom: 8px;">
                            </div>
                            <div class="bungkus">
                                <div class="h1 fw-bold mb-0">
                                    Rincian Pesanan
                                </div>
                                <div class="text mt-0">
                                    {{ $transactionHostel->transaction->no_inv ?? 'Tidak ada' }}
                                </div>
                            </div>
                        </div>
                        @php
                        $reviewCount = DB::table('hostel_ratings')
                            ->where('hostel_ratings.transaction_id', $transactionHostel->transaction->id)
                            ->count();
                    @endphp
                    @if ($reviewCount == 0)
                        <a href="#" data-bs-toggle="modal" data-bs-target="#review"
                            class="btn btn-outline btn-outline-danger border border-danger fw-bold"
                            style="padding: 12px 16px 12px 16px; border: 1px;">
                            Berikan Review
                        </a>
                    @endif
                        {{-- </div> --}}
                    </div>
                    {{-- Card Body --}}
                    <div class="card-body">
                        {{-- Row --}}
                        <div class="row">
                            {{-- kolom batas form --}}
                            <div class="col-12">

                                {{-- Bagian checkin checkout --}}
                                <div class="row">
                                    <div class="col-12 col-lg-6 col-md-6 mb-4 mb-lg-0">
                                        <div class="card border border-1 text-center" style="background: #f4f4f4;">
                                            <div class="info-wrapper-grup" style="padding: 10px 16px 10px 16px;">
                                                <span class="text-gray-400 fs-8"
                                                      style="margin-bottom: 6px">Checkin</span><br>
                                                <span class="text fs-6 fw-bold"
                                                      style="margin-bottom: 6px">{{ \Carbon\Carbon::parse($transactionHostel?->reservation_start)->format('d M Y') }}</span><br>
                                                <span class="text fs-8"
                                                      style="margin-bottom: 6px">{{ \Carbon\Carbon::parse($transactionHostel?->reservation_start)->format('H:i') }}</span><br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-6 col-md-6">
                                        <div class="card border border-1 text-center" style="background: #f4f4f4;">
                                            <div class="info-wrapper-grup" style="padding: 10px 16px 10px 16px;">
                                                <span class="text-gray-400 fs-8"
                                                      style="margin-bottom: 6px">Checkout</span><br>
                                                <span class="text fs-6 fw-bold"
                                                      style="margin-bottom: 6px">{{ \Carbon\Carbon::parse($transactionHostel->reservation_end)->format('d M Y') }}</span><br>
                                                <span class="text fs-8"
                                                      style="margin-bottom: 6px">{{ \Carbon\Carbon::parse($transactionHostel->reservation_end)->format('H:i') }}</span><br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 m-0">
                                        {{-- Card-Hostel --}}
                                        <div class="card border border-1 mt-5 mb-5">
                                            @php
                                            $hostelImage = optional($hostelPict)->image; // Pastikan $hostelPict tidak null
                                            $imagePath = $hostelImage !== null ? 'storage/media/hostel/'.$hostelImage : 'assets/media/logos/logo-square.png';
                                            @endphp

                                            <div
                                                style="height: 250px; background: url('{{ asset($imagePath) }}') center/cover no-repeat; border-top-left-radius: 8px; border-top-right-radius: 8px;"></div>
                                            <div class="fw-bold fs-4 m-5">
                                                {{ $transactionHostel->hostel->name }}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Kolom Kiri --}}
                                    <div class="col-12 mb-5">
                                        {{-- Informasi Ruangan --}}
                                        <div class="card border border-1 mb-5">
                                            <div class="fs-4 fw-bold m-5 mb-0">
                                                Informasi Ruangan
                                            </div>
                                            <div class="m-5 d-flex align-items-center">
                                                @php
                                        $RoomPict = optional($roomPict)->image;
                                        $imagePath = $RoomPict !== null ? 'storage/'.$RoomPict : 'assets/media/logos/logo-square.png';
                                        @endphp
                                                <div class="symbol symbol-75px"
                                                     style="background:url('{{ asset($imagePath) }}')">
                                                    <img src="{{ asset($imagePath) }}"
                                                         alt="hostel-main">
                                                </div>
                                                <div class="text" style="margin-left: 16px">
                                                    <div class="fs-6 fw-bold mb-2">
                                                        {{ $transactionHostel->hostelRoom->name }}
                                                    </div>
                                                    <div class="fs-8 text-gray-400">
                                                        @php
                                                            $startdate = \Carbon\Carbon::parse($transactionHostel->reservation_start);
                                                           $enddate = \Carbon\Carbon::parse($transactionHostel->reservation_end);
                                                           $startdates = $startdate->Format('d F Y');
                                                           $enddates = $enddate->Format('d F Y');
                                                           $diffInDays = $startdate->diffInDays($enddate);
                                                        @endphp
                                                        {{ $diffInDays }} Malam
                                                        | {{ $transactionHostel->room }} Room
                                                        || {{ $transactionHostel->hostelRoom->roomsize }}m²
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="separator border border-1"></div>
                                            <div class="fs-8 text-gray-400 m-5 mb-2">
                                                Benefits
                                            </div>
                                            <div class="fs-6 m-5 mt-0 d-flex flex-wrap">
                                                @forelse ($roomFacilities as $facility)
                                                    <div class="text-bold"
                                                         style="margin-right: 8px">{{ ucfirst($facility->facility_name) , }}</div>
                                                @empty
                                                    Tidak ada fasilitas
                                                @endforelse
                                            </div>
                                        </div>
                                        {{-- Informasi Tamu --}}
                                        <div class="card border border-1 mb-5">
                                            <div class="fs-4 fw-bold m-5 mb-0">
                                                Informasi Tamu
                                            </div>
                                            <div class="m-5">
                                                <div class="d-flex mb-1 justify-content-between">
                                                    <div class="fs-8">Kepala Tamu</div>
                                                    <div class="fs-8 fw-bold">{{ $transactionHostel->guest_name }}</div>
                                                </div>
                                                <div class="d-flex mb-1 justify-content-between">
                                                    <div class="fs-8">Total Tamu</div>
                                                    <div class="fs-8 fw-bold">{{ $transactionHostel->guest }} Tamu</div>
                                                </div>
                                                <div class="d-flex mb-1 justify-content-between">
                                                    <div class="fs-8">Nomor Telepon</div>
                                                    <div class="fs-8 fw-bold">{{ $transactionHostel->guest_handphone }}</div>
                                                </div>
                                                <div class="d-flex mb-1 justify-content-between">
                                                    <div class="fs-8">Alamat Email</div>
                                                    <div class="fs-8 fw-bold">{{ $transactionHostel->guest_email }}</div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- Lokasi Hostel --}}
                                        <div class="card border border-1 mb-5">
                                            {{-- Judul/header --}}
                                            <div class="d-flex justify-content-between m-5">
                                                <h3 class="fw-bold">
                                                    Lokasi
                                                </h3>
                                                <a href="https://maps.app.goo.gl/W6jC3hgz8v7ocsi16" target="_blank"
                                                   class="text-danger fw-bold block">
                                                    Buka di Map
                                                </a>
                                            </div>
                                            <div class="d-flex m-5">
                                                <img
                                                    src="{{ asset('assets/media/svg/profile-account/order-history/map.svg') }}"
                                                    style="width: 20px; height:20px; margin-right: 16px;"/>
                                                <div class="text-gray-400 fs-8">
                                                    {{ $transactionHostel->hostel->address }}
                                                </div>
                                            </div>
                                        </div>
                                                                                {{-- Ulasan Review --}}
                                                                                @php
                                                                                $transaction_id = $transactionHostel->transaction_id;
                                                                                $rating_data = DB::table('hostel_ratings')
                                                                                    ->where('hostel_ratings.transaction_id', '=', $transaction_id)
                                                                                    ->select('hostel_ratings.created_at', 'hostel_ratings.comment', 'hostel_ratings.rate')
                                                                                    ->first();
                                                                                use Carbon\Carbon;
                                                                                Carbon::setLocale('id');
                                                                                $formatted_created_at = null;
                                                                                if ($rating_data) {
                                                                                    $formatted_created_at = \Carbon\Carbon::parse($rating_data->created_at)->diffForHumans();
                                                                                }
                                                                            @endphp
                                                                            <div class="card border border-1 mb-5">
                                                                                <div class="fs-4 fw-bold m-5 mb-0">
                                                                                    Ulasan Review
                                                                                </div>
                                                                                @if (isset($rating_data))
                                                                                    <div class="m-5">
                                                                                        <div class="m-5 row">
                                                                                            <div class="btn btn-icon btn-active-light-primary btn-custom w-30px h-30px w-md-40px h-md-40px"
                                                                                                data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                                                                                data-kt-menu-placement="bottom-end">
                                                                                                <div class="symbol symbol-50px">
                                                                                                    <div
                                                                                                        class="symbol-label fs-2 fw-bold bg-grey text-danger">
                                                                                                        {{ substr(Auth::user()->name, 0, 1) }}
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col ms-2">
                                                                                                <div class="fs-6 fw-bold">
                                                                                                    {{ Auth::user()->name }}
                                                                                                </div>
                                                                                                <div class="fs-6 fw-light-grey-700">
                                                                                                    Ulasan
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="row ms-0">
                                                                                            <div class="col-4">
                                                                                                <div class="rating">
                                                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                                                        <div
                                                                                                            class="rating-label {{ $i <= $rating_data->rate ? 'checked' : '' }} m-1">
                                                                                                            <i class="ki-duotone ki-star fs-1"></i>
                                                                                                        </div>
                                                                                                    @endfor
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6">
                                                                                                <div class="fs-6 fw-light-grey-500">
                                                                                                    {{ $formatted_created_at ?? 'Data Tidak Ditemukan' }}
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="col-6 ms-1 mt-2">
                                                                                                <div class="fs-6 fw-light-grey-800">
                                                                                                    {{ $rating_data->comment }}
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @else
                                                                                    <div class="m-5 text-center">
                                                                                        <p class="fs-6 fw-light-grey-500">Data Tidak Ditemukan</p>
                                                                                    </div>
                                                                                @endif
                                                                            </div>
                                        {{-- Rincian Pembaayaran --}}
                                        <div class="card border border-1 mb-5">
                                            <div class="fs-4 fw-bold m-5 mb-0">
                                                Rincian Pembayaran
                                            </div>
                                            <div class="m-5">
                                                <div class="d-flex mb-1 justify-content-between">
                                                    <div class="fs-8">Status Transaksi</div>
                                                    @if ($transactionHostel->transaction->status === 'EXPIRED')
                                                        <div
                                                            class="fs-8 fw-bold text-danger">Kadaluarsa</div>
                                                    @elseif ($transactionHostel->transaction->status === 'PENDING')
                                                        <div
                                                            class="fs-8 fw-bold text-warning">Menunggu Pembayaran</div>
                                                    @elseif ($transactionHostel->transaction->status === 'PAID')
                                                        <div
                                                            class="fs-8 fw-bold text-success">Lunas</div>
                                                    @else
                                                        <div
                                                            class="fs-8 fw-bold text-success">Transaksi Gagal</div>
                                                    @endif

                                                </div>
                                                <div class="d-flex mb-1 justify-content-between">
                                                    <div class="fs-8">Tanggal Transaksi</div>
                                                    <div
                                                        class="fs-8 fw-bold">{{ \Carbon\Carbon::parse($transactionHostel->reservation_start)->format('d M Y H:i') }}</div>
                                                </div>
                                                <div class="d-flex mb-1 justify-content-between">
                                                    <div class="fs-8">Metode Pembayaran</div>
                                                    <div
                                                        class="fs-8 fw-bold">{{ str_replace('_', ' ', $transactionHostel->transaction->payment_method) }}</div>
                                                </div>
                                                <div class="d-flex mb-1 justify-content-between">
                                                    <div class="fs-8">Biaya Hostel</div>
                                                    <div
                                                        class="fs-8 fw-bold">{{ number_format($transactionHostel->rent_price, 0, ',', '.') }}</div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    {{-- Kolom Kanan --}}
                                    {{--                        <div class="col-12 col-lg-3 col-md-3">--}}
                                    {{--                            <div class="card border border-1">--}}
                                    {{--                                <div class="text-center" style="margin-top: 24px; margin-bottom: 24px;">--}}
                                    {{--                                    <div class="pembungkus mx-sm-10" style="margin-bottom: 24px;">--}}
                                    {{--                                        <img src="{{ asset('assets/media/svg/profile-account/order-history/frame-1.svg') }}" style="width: 48px; height:48px; margin-bottom: 8px;"/>--}}
                                    {{--                                        <div class="text fs-8">E-tiket</div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="pembungkus mx-sm-10" style="margin-bottom: 24px;">--}}
                                    {{--                                        <img src="{{ asset('assets/media/svg/profile-account/order-history/frame-2.svg') }}" style="width: 48px; height:48px; margin-bottom: 8px;"/>--}}
                                    {{--                                        <div class="text fs-8">Bukti Pembayaran</div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                    <div class="pembungkus mx-sm-10">--}}
                                    {{--                                        <img src="{{ asset('assets/media/svg/profile-account/order-history/frame-3.svg') }}" style="width: 48px; height:48px; margin-bottom: 8px;"/>--}}
                                    {{--                                        <div class="text fs-8">Hapus Riwayat</div>--}}
                                    {{--                                    </div>--}}
                                    {{--                                </div>--}}
                                    {{--                            </div>--}}
                                    {{--                        </div>--}}
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        {{-- Total BIaya --}}
                                        <div class="card" style="background: #FFEEF1">
                                            <div class="pembungkus d-flex justify-content-between">
                                                <div class="text fs-4 fw-semibold" style="margin: 16px;">
                                                    Total Biaya
                                                </div>
                                                <div class="text fs-4 fw-bold" style="margin: 16px">
                                                    RP {{ number_format($transactionHostel->hostelRoom->sellingprice, 0, ',', '.') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Kolom Kanan --}}
        </div>
        {{-- End Row --}}
    </div>
    {{-- End Container --}}
    <div class="modal fade" tabindex="-1" id="review" aria-hidden="true">
        <<div class="modal-dialog modal-dialog-centered mw-550px">
            <!-- Tambahkan kelas justify-content-center di sini -->
            <div class="modal-content">
                <div class="modal-header text-center">
                    <div class="fs-4 fw-bold m-3">{{ $transactionHostel->hostel->name }} -
                        {{ $transactionHostel->hostelroom->name }}
                    </div>
                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                class="path2"></span></i>
                    </div>
                    <!--end::Close-->
                </div>
                <form action="{{ route('profile.order-detail.hostel.rating') }}" method="POST">
                    @csrf
                    <input type="hidden" name="hostel_rooms_id" value="{{ $transactionHostel->hostelRoom->id }}" />
                    <input type="hidden" name="transaction_id" value="{{ $transactionHostel->transaction_id }}" />
                    <input type="hidden" name="hostel_id" value="{{ $transactionHostel->hostel->id }}" />
                    <div class="modal-body text-center">
                        <div>
                            <div class="fs-4 fw-bold m-3 mb-5">Berikan Nilai Pada
                                {{ $transactionHostel->hostel->name }}
                            </div>
                        </div>
                        <div class="rating text-center justify-content-center d-block">
                            <input class="rating-input" name="rating" value="0" checked type="radio"
                                id="kt_rating_input_0" />
                            <!--begin::Star 1-->
                            <label class="rating-label mb-2" for="kt_rating_input_1">
                                <i class="ki-duotone ki-star"></i>
                            </label>
                            <input class="rating-input" name="rating" value="1" type="radio"
                                id="kt_rating_input_1" />
                            <!--end::Star 1-->
                            <!--begin::Star 2-->
                            <label class="rating-label mb-2" for="kt_rating_input_2">
                                <i class="ki-duotone ki-star"></i>
                            </label>
                            <input class="rating-input" name="rating" value="2" type="radio"
                                id="kt_rating_input_2" />
                            <!--end::Star 2-->
                            <!--begin::Star 3-->
                            <label class="rating-label mb-2" for="kt_rating_input_3">
                                <i class="ki-duotone ki-star"></i>
                            </label>
                            <input class="rating-input" name="rating" value="3" type="radio"
                                id="kt_rating_input_3" />
                            <!--end::Star 3-->
                            <!--begin::Star 4-->
                            <label class="rating-label mb-2" for="kt_rating_input_4">
                                <i class="ki-duotone ki-star"></i>
                            </label>
                            <input class="rating-input" name="rating" value="4" type="radio"
                                id="kt_rating_input_4" />
                            <!--end::Star 4-->
                            <!--begin::Star 5-->
                            <label class="rating-label mb-2" for="kt_rating_input_5">
                                <i class="ki-duotone ki-star"></i>
                            </label>
                            <input class="rating-input" name="rating" value="5" type="radio"
                                id="kt_rating_input_5" />
                            <!--end::Star 5-->
                            <!--begin::Reset rating-->
                            <!--end::Reset rating-->
                        </div>
                        <span id="ratingText" class="fw-bold fs-5 mt-3"></span>
                        <div class="rounded d-flex flex-column p-3 mt-4">
                            <label for="" class="fs-5 fw-semibold m-3 mb-5">Comment</label>
                            <textarea class="form-control" name="comment" data-kt-autosize="true" rows="4"></textarea>
                        </div>
                        <!--end::basic autosize textarea-->
                    </div>
                    <div class="modal-footer">
                        <button type="button justify-content-center" class="btn btn-light"
                            data-bs-dismiss="modal">Close</button>
                        <button type="button justify-content-center" class="btn btn-primary">Submit</button>
                    </div>
            </div>
            </form>
    </div>
@endsection
