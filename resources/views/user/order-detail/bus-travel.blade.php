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

    @media print {
        body * {
            visibility: hidden;
        }
        .invoice-container, .invoice-container * {
            visibility: visible;
        }
        .invoice-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
        }
        .no-print {
            display: none !important;
        }
    }
</style>

{{-- Container --}}
<div class="container invoice-container">
    {{-- Row --}}
    <div class="row">
        {{-- Kolom Kiri (Menu) --}}
        @include('user.user-navigation')
        {{-- End Kolom Kiri --}}

        <div class="col-12 col-lg-7">
            <div class="card">
                {{-- Card Head --}}
                <div class="card-header d-flex justify-content-between align-items-center">
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
                                {{ $mainData->transaction->no_inv ?? 'Tidak ada' }}
                            </div>
                            <div class="text mt-1">
                                <span class="badge badge-primary">Booking ID: {{ $mainData->booking_id }}</span>
                                <span class="badge badge-success">{{ $ticketCount }} Tiket</span>
                            </div>
                        </div>
                    </div>
                    @php
                        $reviewCount = $mainData->transaction->commentBusTravel;
                    @endphp
                    @if (!isset($reviewCount) && $mainData->transaction->status == 'PAID')
                        <a href="#" data-bs-toggle="modal" data-bs-target="#review"
                            class="btn btn-outline btn-outline-danger border border-danger fw-bold no-print"
                            style="padding: 12px 16px 12px 16px; border: 1px;">
                            Berikan Review
                        </a>
                    @endif
                </div>
                {{-- Card Body --}}
                <div class="card-body">
                    {{-- Row --}}
                    <div class="row">
                        {{-- kolom batas form --}}
                        <div class="col-12">
                            {{-- Bagian Tanggal Keberangkatan --}}
                            <div class="row">
                                <div class="col-12 col-lg-6 col-md-6 mb-4 mb-lg-0">
                                    <div class="card mt-3 border border-1 text-center" style="background: #f4f4f4;">
                                        <div class="info-wrapper-grup" style="padding: 10px 16px 10px 16px;">
                                            <span class="text-gray-400 fs-8" style="margin-bottom: 6px">Tanggal Keberangkatan</span><br>
                                            <span class="text fs-6 fw-bold" style="margin-bottom: 6px">
                                                {{ \Carbon\Carbon::parse($mainData->departure_time)->format('d M Y') }}
                                            </span><br>
                                            <span class="text fs-8" style="margin-bottom: 6px">
                                                {{ \Carbon\Carbon::parse($mainData->departure_time)->format('H:i') }}
                                            </span><br>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 col-md-6">
                                    <div class="card mt-3 border border-1 text-center" style="background: #f4f4f4;">
                                        <div class="info-wrapper-grup" style="padding: 10px 16px 10px 16px;">
                                            <span class="text-gray-400 fs-8" style="margin-bottom: 6px">Status Verifikasi</span><br>
                                            <span class="text fs-6 fw-bold" style="margin-bottom: 6px">
                                                @if(($mainData->status ?? 'pending') == 'verified')
                                                    <span class="badge badge-success">Terverifikasi</span>
                                                @else
                                                    <span class="badge badge-warning">Belum Diverifikasi</span>
                                                @endif
                                            </span><br>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @php
                                    $busImages = is_array($mainData->busTravel->image) ? $mainData->busTravel->image : json_decode($mainData->busTravel->image, true);
                                    $firstImage = !empty($busImages) ? $busImages[0] : null;
                                    $imagePath = $firstImage ? '/storage/buses/' . $firstImage : 'https://images.unsplash.com/photo-1618805154647-7d89ac05926b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D';
                                @endphp
                                <div class="col-12 m-0">
                                    {{-- Card-Bus --}}
                                    <div class="card border border-1 mt-5 mb-5">
                                        <div style="height: 250px; background: url('{{ $imagePath }}') center/cover no-repeat; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                                        </div>
                                        <div class="fw-bold fs-4 m-5">
                                            {{ $mainData->busTravel->business_name }}
                                        </div>
                                    </div>
                                </div>

                                {{-- Informasi Bus --}}
                                <div class="col-12 mb-5">
                                    <div class="card border border-1 mb-5">
                                        <div class="fs-4 fw-bold m-5 mb-0">
                                            Informasi Bus
                                        </div>
                                        <div class="m-5 d-flex align-items-center">
                                            <img src="{{ $imagePath }}" alt="bus-travel-main"
                                                style="width: 75px; height: 75px; object-fit: cover; border-radius: .475rem;">
                                            <div class="text" style="margin-left: 16px">
                                                <div class="fs-6 fw-bold mb-2">
                                                    {{ $mainData->busTravel->business_name }} - {{ $mainData->busTravelHasBus->name ?? '-' }}
                                                </div>
                                                <div class="fs-8 text-gray-400">
                                                    {{ $mainData->from ?? '-' }} → {{ $mainData->to ?? '-' }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Informasi Semua Penumpang --}}
                                    @foreach ($allBookings as $k => $ticket)
                                    <div class="card border border-1 mb-5">
                                        <div class="fs-4 fw-bold m-5 mb-0">
                                            Informasi Penumpang {{ $k + 1 }}
                                            <span class="badge badge-light-primary ms-2">Kursi: {{ $ticket->seat_number ?? '-' }}</span>
                                        </div>
                                        <div class="m-5">
                                            <div class="d-flex mb-1 justify-content-between">
                                                <div class="fs-8">Nama Penumpang</div>
                                                <div class="fs-8 fw-bold">{{ $ticket->customer_name }}</div>
                                            </div>
                                            <div class="d-flex mb-1 justify-content-between">
                                                <div class="fs-8">Nomor Telepon</div>
                                                <div class="fs-8 fw-bold">{{ $ticket->customer_phone }}</div>
                                            </div>
                                            <div class="d-flex mb-1 justify-content-between">
                                                <div class="fs-8">Alamat Email</div>
                                                <div class="fs-8 fw-bold">{{ $ticket->customer_email }}</div>
                                            </div>
                                            <div class="d-flex mb-1 justify-content-between">
                                                <div class="fs-8">Kewarganegaraan</div>
                                                <div class="fs-8 fw-bold">{{ $ticket->customer_country }}</div>
                                            </div>
                                            <div class="d-flex mb-1 justify-content-between">
                                                <div class="fs-8">Status Verifikasi</div>
                                                <div class="fs-8 fw-bold">
                                                    @if(($ticket->status ?? 'pending') == 'verified')
                                                        <span class="badge badge-success">Terverifikasi</span>
                                                    @else
                                                        <span class="badge badge-warning">Pending</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    {{-- Lokasi Bus Travel --}}
                                    <div class="card border border-1 mb-5">
                                        <div class="d-flex m-5">
                                            <img src="{{ asset('assets/media/svg/profile-account/order-history/map.svg') }}"
                                                style="width: 20px; height:20px; margin-right: 16px;" />
                                            <div class="text-gray-400 fs-8">
                                                {{ $mainData->busTravel->address }}
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Ulasan Review --}}
                                    @php
                                        $rating_data = $mainData->transaction->commentBusTravel;
                                        use Carbon\Carbon;
                                        Carbon::setLocale('id');
                                        $formatted_created_at = null;
                                        if ($rating_data) {
                                            $commentTime = Carbon::parse($rating_data->book_date);
                                            $formatted_created_at = $commentTime->diffForHumans();
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
                                                            <div class="symbol-label fs-2 fw-bold bg-grey text-danger">
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
                                                                <div class="rating-label {{ $i <= $rating_data->rate ? 'checked' : '' }} m-1">
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

                                    {{-- Rincian Pembayaran --}}
                                    <div class="card border border-1 mb-5">
                                        <div class="fs-4 fw-bold m-5 mb-0">
                                            Rincian Pembayaran
                                        </div>
                                        <div class="m-5">
                                            <div class="d-flex mb-1 justify-content-between">
                                                <div class="fs-8">Status Transaksi</div>
                                                @if ($mainData->transaction->status === 'EXPIRED')
                                                    <div class="fs-8 fw-bold text-danger">Kadaluarsa</div>
                                                @elseif ($mainData->transaction->status === 'PENDING')
                                                    <div class="fs-8 fw-bold text-warning">Menunggu Pembayaran</div>
                                                @elseif ($mainData->transaction->status === 'PAID')
                                                    <div class="fs-8 fw-bold text-success">Lunas</div>
                                                @else
                                                    <div class="fs-8 fw-bold text-danger">Transaksi Gagal</div>
                                                @endif
                                            </div>
                                            <div class="d-flex mb-1 justify-content-between">
                                                <div class="fs-8">Tanggal Transaksi</div>
                                                <div class="fs-8 fw-bold">
                                                    {{ \Carbon\Carbon::parse($mainData->transaction->created_at)->format('d M Y H:i') }}
                                                </div>
                                            </div>
                                            <div class="d-flex mb-1 justify-content-between">
                                                <div class="fs-8">Metode Pembayaran</div>
                                                <div class="fs-8 fw-bold">
                                                    {{ str_replace('_', ' ', $mainData->transaction->payment_method ?? '-') }}
                                                </div>
                                            </div>
                                            <div class="d-flex mb-1 justify-content-between">
                                                <div class="fs-8">Harga Per Tiket</div>
                                                <div class="fs-8 fw-bold">
                                                    Rp {{ number_format($mainData->price, 0, ',', '.') }}
                                                </div>
                                            </div>
                                            <div class="d-flex mb-1 justify-content-between">
                                                <div class="fs-8">Jumlah Tiket</div>
                                                <div class="fs-8 fw-bold">
                                                    {{ $ticketCount }}
                                                </div>
                                            </div>
                                            <div class="d-flex mb-1 justify-content-between">
                                                <div class="fs-8">Subtotal Tiket</div>
                                                <div class="fs-8 fw-bold">
                                                    Rp {{ number_format($mainData->price * $ticketCount, 0, ',', '.') }}
                                                </div>
                                            </div>
                                            <div class="d-flex mb-1 justify-content-between">
                                                <div class="fs-8">Biaya Penanganan</div>
                                                <div class="fs-8 fw-bold">
                                                    Rp {{ number_format(($mainData->fee_admin ?? 0) * $ticketCount + ($mainData->kode_unik ?? 0), 0, ',', '.') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    {{-- Total Biaya --}}
                                    <div class="card" style="background: #FFEEF1">
                                        <div class="pembungkus d-flex justify-content-between">
                                            <div class="text fs-4 fw-semibold" style="margin: 16px;">
                                                Total Biaya
                                            </div>
                                            <div class="text fs-4 fw-bold" style="margin: 16px">
                                                Rp {{ number_format($mainData->transaction->total, 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($mainData->transaction->status === 'PENDING')
                                    <div class="col-12 mt-4">
                                        <div class="row">
                                            <a href="{{ $mainData->transaction->link }}"
                                                class="btn btn-danger btn-block no-print">Bayar</a>
                                        </div>
                                    </div>
                                @endif
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

{{-- Review Modal --}}
<div class="modal fade" tabindex="-1" id="review" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-550px">
        <div class="modal-content">
            <div class="modal-header text-center">
                <div class="fs-4 fw-bold m-3">{{ $mainData->busTravel->business_name }} -
                    {{ $mainData->busTravelHasBus->name ?? '-' }}
                </div>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                    aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>
            <form action="{{ route('profile.order-detail.bus-travel.rating') }}" method="POST">
                @csrf
                <input type="hidden" name="package_id" value="{{ $mainData->bus_travel_has_bus_id }}" />
                <input type="hidden" name="transaction_id" value="{{ $mainData->transaction_id }}" />
                <input type="hidden" name="bus_travel_id" value="{{ $mainData->bus_travel_id }}" />
                <div class="modal-body text-center">
                    <div>
                        <div class="fs-4 fw-bold m-3 mb-5">Berikan Nilai Pada
                            {{ $mainData->busTravel->business_name }} -
                            {{ $mainData->busTravelHasBus->name ?? '-' }}
                        </div>
                    </div>
                    <div class="rating text-center justify-content-center d-block">
                        <input class="rating-input" name="rating" value="0" checked type="radio"
                            id="kt_rating_input_0" />
                        @for ($i = 1; $i <= 5; $i++)
                        <label class="rating-label mb-2" for="kt_rating_input_{{ $i }}">
                            <i class="ki-duotone ki-star"></i>
                        </label>
                        <input class="rating-input" name="rating" value="{{ $i }}" type="radio"
                            id="kt_rating_input_{{ $i }}" />
                        @endfor
                    </div>
                    <span id="ratingText" class="fw-bold fs-5 mt-3"></span>
                    <div class="rounded d-flex flex-column p-3 mt-4">
                        <label for="" class="fs-5 fw-semibold m-3 mb-5">Comment</label>
                        <textarea class="form-control" name="comment" data-kt-autosize="true" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
