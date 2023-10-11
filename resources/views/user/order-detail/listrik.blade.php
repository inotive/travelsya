@extends('layouts.user')

@section('content-user')

<style>
.bg-gradient-merah{
background: rgb(255,238,241);
background: linear-gradient(270deg, rgba(255,238,241,1) 0%, rgba(255,255,255,1) 50%);

}

</style>

{{-- Container --}}
<div class="container">
    {{-- Row --}}
    <div class="row">
        {{-- Kolom Kiri (Menu)--}}
        <div class="col-12 col-lg-3 offset-lg-1 mb-10">
            <div class="card">
                {{-- Card Bagian Body --}}
                <div class="card-body">
                    {{-- Nama User --}}
                    <div class="card-title mb-5">
                        <h3>
                        <b>
                        John Doe
                        </b>
                        </h3>
                    </div>
                    {{-- end Nama User --}}

                    {{-- Menu Item Start --}}

                    {{-- Bagian Poin --}}
                    <div class="group-point-ini-guys d-flex">
                        <div class="menu-item">
                    <div class="menu-link">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/coin.svg') }}" class="h-24px me-10"/>
                    </span>

                    <div class="ini-pemersatu">
                    <div class="text-gray-500 fs-8">Points Anda</div>
                    <span class=" fw-medium fs-4 menu-title">
                            <b>
                                1.384
                            </b>
                    </span>
                    </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Bagian Poin --}}

                    {{-- Start Bagian e-Wallet --}}
                    <div class="group-wallet-ini-guys d-flex">
                        <div class="menu-item">
                    <div class="menu-link">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/wallet.svg') }}" class="h-24px me-10"/>
                    </span>
                    <div class="ini-pemersatu">
                    <div class="text-gray-500 fs-8">e-Wallet</div>
                    <span class=" fw-medium fs-4 menu-title">
                            <b>
                                56.500
                            </b>
                    </span>
                    </div>
                            </div>
                        </div>
                    </div>

                    {{-- Separator --}}
                <div class="separator mb-3 border"></div>

                {{-- Menu Item Profil Saya --}}
                <div class="menu-item">
                    <a class="menu-link text-gray" href="{{ route('user.profile') }}">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/user-nonactive.svg') }}" class="h-24px me-10"/>
                    </span>
                    <span class="menu-title text-gray-900">
                        Profil Saya
                    </span>
                    </a>
                </div>

                {{-- Menu Item Riwayat Pesanan --}}
                <div class="menu-item">
                    <a class="menu-link text-gray-900" href="{{ route('user.orderHistory') }}">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/clipboard-active.svg') }}" class="h-24px me-10"/>
                    </span>
                    <span class="menu-title fw-bold text-danger">
                        Riwayat Pesanan</b>
                    </span>
                    </div>
                </a>
                {{-- Menu Item Refund Dan Pembatalan --}}
                <div class="menu-item">
                    <a class="menu-link text-gray-900" href="#">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/credit-card.svg') }}" class="h-24px me-10"/>
                    </span>
                    <span class="menu-title">
                        Refund & Pembatalan
                    </span>
                    </a>
                </div>
                {{-- Menu Item Pusat Bantuan --}}
                <div class="menu-item" >
                    <a class="menu-link text-gray-900" href="{{ route('user.help') }}">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/headphones.svg') }}" class="h-24px me-10"/>
                    </span>
                    <span class="menu-title">
                        Pusat Bantuan
                    </span>
                    </a>
                </div>
                {{-- SEPARATOR --}}
                <div class="separator my-3 border"></div>
                {{-- Menu ITEm Logout --}}
                <div class="menu-item" >
                    <a class="menu-link text-gray-900" id="kt_docs_sweetalert_basic" href="#">
                    <span class="menu-icon">
                        <img src="{{ asset('assets/media/svg/profile-account/log-out.svg') }}" class="h-24px me-10"/>
                    </span>
                        Log out
                        @include('user.logout')
                    </a>
                </div>
                </div>
            </div>
        </div>
        {{-- End Kolom Kiri --}}

        {{-- Kolom Kanan (Form Detail PEsanan) --}}
        <div class="col-12 col-lg-7">
            <div class="card">
                {{-- Card Head --}}
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{-- <div class="card-title"> --}}
                    <div class="d-flex align-items-center">
                    <div class="image-back">
                    <img src="{{ asset('assets/media/svg/profile-account/order-history/down-2.svg') }}" alt="down" style="margin-right: 16px; margin-bottom: 8px;">
                    </div>
                    <div class="bungkus">
                    <div class="h1 fw-bold mb-0">
                        Rincian Pesanan
                    </div>
                    <div class="text mt-0">
                        {{ $transactionPPOB->inv_num ?? 'Tidak ada' }}
                    </div>
                    </div>
                    </div>
                    {{-- </div> --}}
                </div>
                {{-- Card Body --}}
                <div class="card-body">
                    {{-- Row --}}
                    <div class="row">
                        {{-- kolom batas form --}}
                        <div class="col-12">
                    <div class="row">
                        {{-- Kolom Kiri --}}
                        <div class="col-12">
                            {{-- Detail Produk --}}
                            <div class="card border border-1 mb-5">
                                <div class="fs-4 fw-bold m-5 mb-0">
                                    Detail Produk
                                </div>
                                    <div class="m-5">
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Layanan</div>
                                            <div class="fs-8 fw-bold">{{ $transactionPPOB->service ?? 'Missing'}}</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Produk</div>
                                            <div class="fs-8 fw-bold">{{ $transactionPPOB->product_name ?? 'Missing'}}</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">No. Meter/IdPel</div>
                                            <div class="fs-8 fw-bold">{{ $transactionPPOB->nomor_pelanggan ?? 'Missing'}}</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Nama</div>
                                            <div class="fs-8 fw-bold">{{ $transactionPPOB->user_name ?? 'Nama Pengguna Tidak Tersedia'  }}</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Total Tagihan</div>
                                            <div class="fs-8 fw-bold">{{ number_format($transactionPPOB->total_tagihan, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                            </div>
                            {{-- Rincian Pembaayaran --}}
                            <div class="card border border-1 mb-5">
                                <div class="fs-4 fw-bold m-5 mb-0">
                                    Rincian Pembayaran
                                </div>
                                    <div class="m-5">
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Status Transaksi</div>
                                                @if ($transactionPPOB->status == 'EXPIRED')
                                                <div class="fs-8 fw-bold text-danger">
                                                    EXPIRED
                                                </div>
                                                @elseif ($transactionPPOB->status == 'PENDING')
                                                <div class="fs-8 fw-bold text-warning">
                                                    PENDING
                                                </div>
                                                @elseif ($transactionPPOB->status == 'PAID')
                                                <div class="fs-8 fw-bold text-success">
                                                    PAID
                                                </div>
                                                @endif
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Tanggal Transaksi</div>
                                            <div class="fs-8 fw-bold">{{ \Carbon\Carbon::parse($transactionPPOB->created_transaction)->format('d M Y H:i') }}</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Metode Pembayaran</div>
                                            <div class="fs-8 fw-bold">{{ str_replace('_', ' ', $transactionPPOB->payment_method) }}</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Biaya Admin</div>
                                            <div class="fs-8 fw-bold">{{ number_format($transactionPPOB->fee_travelsya, 0, ',', '.') }}</div>
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Point Digunakan</div>
                                            @if ($pengeluaran->jumlah_point == 0)
                                            <div class="fs-8 fw-bold">Tidak ada</div>
                                            @else
                                            <div class="fs-8 fw-bold text-danger">- {{ number_format($pengeluaran->jumlah_point, 0, ',', '.') }} Point</div>
                                            @endif
                                        </div>
                                        <div class="d-flex mb-1 justify-content-between">
                                            <div class="fs-8">Total Bayar</div>
                                            <div class="fs-8 fw-bold">Rp. {{ number_format($transactionPPOB->total_after_fee, 0, ',', '.') }}</div>
                                        </div>
                                    </div>
                            </div>
                        </div>

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
                                    Rp. {{ number_format($transactionPPOB->total_after_fee, 0, ',', '.') }}
                                </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-12 d-grid">
                                <div class="badge bg-light-success border-success border border-1 mt-5 ">
                                    <div class="mx-auto my-5 fs-4">
                                        Kamu Dapat <b>{{ number_format($pemasukan->jumlah_point, 0, ',', '.') }} Poin</b>  dari transaksi ini
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

@endsection
