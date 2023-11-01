@extends('layouts.web')

@section('content-web')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="card my-10">
                <div class="card-header">
                    <div class="card-title">
                        Syarat Dan Ketentuan
                    </div>
                </div>
                <div class="card-body">
                    <b>Tata Cara melakukan pengembalian dana/refund Hotel</b> <br>
                    1. mengirimkan email ke cs@travelsya.com <br>
                    2. Isi email harus sesuai format. berikut formatnya : <br>
                    <ul style="list-style-type: square">
                        <li>Judul email berisi Pengajuan Refund (Pembatalan)-nama_pemesan-kode_pemesan </li>
                        <li>Email: (alamat email yang digunakan untuk pemesanan) </li>
                        <li>Kode Pemesanan: (kode pesanan atau kode booking) </li>
                        <li>No telepon: (no telepon yang didaftarkan ketika booking)</li>
                        <li>Tanggal check IN: (tanggal check IN)</li>
                        <li>Tanggal check Out: (tanggal check Out)</li>
                        <li>alasan: (alasan melakukan pembatalan/refund)</li>
                        <li>metode pembayaran: (metode pembayaran yang dilakukan saat pemesanan)</li>
                        <li>Nomor Rekening: (nomor rekening bank)</li>
                        <li>Nama Pemilik rekening: (nama pemilik rekening bank)</li>
                        <li>Nama Bank: (nama pemilik bank)</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
