@extends('layouts.user')

@section('content-user')
    <style>
        .bg-gradient-merah {
            background: rgb(255, 238, 241);
            background: linear-gradient(270deg, rgba(255, 238, 241, 1) 0%, rgba(255, 255, 255, 1) 50%);

        }
    </style>
    <script>
        function reloadPage() {
            location.reload();
        }
    </script>

    {{-- Container --}}
    <div class="container">
        {{-- Row --}}
        <div class="row">
            {{-- Kolom Kiri (Menu) --}}
            @include('user.user-navigation')
            {{-- End Kolom Kiri --}}

            {{-- Kolom Kanan (Form Detail PEsanan) --}}
            <div class="col-12 col-lg-7">
                <div class="card">
                    {{-- Card Head --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{-- <div class="card-title"> --}}
                        <div class="d-flex align-items-center">
                            <div class="image-back cursor-pointer">
                                <a href="/profile/order-history">
                                    <img src="{{ asset('assets/media/svg/profile-account/order-history/down-2.svg') }}"
                                        alt="down" style="margin-right: 16px; margin-bottom: 8px;">

                                </a>
                            </div>
                            <div class="bungkus">
                                <div class="h1 fw-bold mb-0">
                                    Rincian Pesanan
                                </div>
                                <div class="text mt-0">
                                    {{ $transactionPPOB->inv_num }}
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
                                    @if ($transactionPPOB->status == 'Transaksi Gagal')
                                        <div class="col">
                                            <div class="alert alert-danger" role="alert">
                                                Nomor yang anda masukan kemungkinan tidak kami temukan. <a
                                                    href="https://api.whatsapp.com/send?phone=628115417708&text=Halo%20min%2C%20transaksi%20saya%20gagal%20mohon%20bantuan%20refund%20pada%20nomor%20transaksi%20{{ $transactionPPOB->inv_num }}"
                                                    class="alert-link">Klik disini</a> Untuk menghubungi CS agar transaksi
                                                kamu bisa direfund.
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-12">
                                        {{-- Detail Produk --}}
                                        <div class="card border border-1 mb-5">
                                            <div class="fs-4 fw-bold m-5 mb-0">
                                                Detail Produk
                                            </div>
                                            <div class="m-5">
                                                <div class="d-flex mb-1 justify-content-between">
                                                    <div class="fs-8">Layanan</div>
                                                    <div class="fs-8 fw-bold">
                                                        {{ ucfirst($transactionPPOB->product_category) }}</div>
                                                </div>
                                                <div class="d-flex mb-1 justify-content-between">
                                                    <div class="fs-8">Produk</div>
                                                    <div class="fs-8 fw-bold">{{ $transactionPPOB->product_name }}</div>
                                                </div>
                                                <div class="d-flex mb-4 justify-content-between">
                                                    <div class="fs-8">
                                                        {{ $transactionPPOB->product_category != 'pulsa' ? 'No. Meter/IdPel' : 'Nomor Telfon' }}
                                                    </div>
                                                    <div class="fs-8 fw-bold">{{ $transactionPPOB->nomor_telfon }}</div>
                                                </div>
                                                @if ($transactionPPOB->product_category == 'listrik-token')
                                                    <div class="card text-center" style="background: #F2F4FF;">
                                                        <div class="text-center" style="margin:24px;">
                                                            <div class="fs-4 fw-bold">Kode Voucher</div>
                                                            <div class="fs-6">{{ $transactionPPOB->kode_voucher }}</div>
                                                        </div>
                                                    </div>
                                                @endif
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
                                                            Transaksi Expired
                                                        </div>
                                                    @elseif ($transactionPPOB->status == 'PENDING')
                                                        <div class="fs-8 fw-bold text-warning">
                                                            Menunggu Pembayaran
                                                        </div>
                                                    @elseif ($transactionPPOB->status == 'PAID')
                                                        <div class="fs-8 fw-bold text-success">
                                                            Transaksi Berhasil
                                                        </div>
                                                    @else
                                                        <div class="fs-8 fw-bold text-danger">
                                                            Transaksi Gagal
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="d-flex mb-1 justify-content-between">
                                                    <div class="fs-8">Tanggal Transaksi</div>
                                                    <div class="fs-8 fw-bold">
                                                        {{ \Carbon\Carbon::parse($transactionPPOB->created_transaction)->format('d M Y H:i') }}
                                                    </div>
                                                </div>
                                                <div class="d-flex mb-1 justify-content-between">
                                                    <div class="fs-8">Metode Pembayaran</div>
                                                    <div class="fs-8 fw-bold">
                                                        {{ str_replace('_', ' ', $transactionPPOB->payment_method) }}</div>
                                                </div>
                                                <div class="d-flex mb-1 justify-content-between">
                                                    <div class="fs-8">Biaya Admin</div>
                                                    <div class="fs-8 fw-bold">Rp.
                                                        {{ number_format($transactionPPOB->fee_travelsya, 0, ',', '.') }}
                                                    </div>
                                                </div>
                                                <div class="d-flex mb-1 justify-content-between">
                                                    <div class="fs-8">Point Digunakan</div>
                                                    @if ($pengeluaran?->jumlah_point == 0)
                                                        <div class="fs-8 fw-bold">Tidak Ada</div>
                                                    @else
                                                        <div class="fs-8 fw-bold text-danger">-
                                                            {{ number_format($pengeluaran?->jumlah_point, 0, ',', '.') }}
                                                            Point</div>
                                                    @endif
                                                </div>
                                                <div class="d-flex mb-1 justify-content-between">
                                                    <div class="fs-8">Total Bayar</div>
                                                    <div class="fs-8 fw-bold">Rp.
                                                        {{ number_format($transactionPPOB->total_after_fee, 0, ',', '.') }}
                                                    </div>
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
                                    @if ($transactionPPOB->status == 'PAID')
                                        <div class="col-12 d-grid">
                                            <div class="badge bg-light-success border-success border border-1 mt-5 ">
                                                <div class="mx-auto my-5 fs-4">
                                                    Kamu Dapat
                                                    <b>{{ number_format($pemasukan?->jumlah_point, 0, ',', '.') }} Poin</b>
                                                    dari transaksi ini
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                @if ($transactionPPOB->status != 'PAID')
                                    <div class="col-12 mt-4">
                                        <div class="row">
                                            <button class="btn btn-danger btn-block" onclick="reloadPage()">Refresh
                                                Pesanan</button>
                                        </div>
                                    </div>
                                @endif

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
