@extends('layouts.web-remake')

@section('content-web')
<!-- Import Google Fonts: Roboto -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container py-6">
    <!-- Detail Pemesanan -->
    <div class="row">
        <div class="col-md-8">
            <p class="fs-3 fw-semibold mb-0">Detail Pemesanan</p>
            <p class="text-muted">Isi formulir ini dengan benar karena e-tiket akan dikirim ke alamat email sesuai data pemesan.</p>
            <div class="card p-4 mb-4 mt-4 shadow card-border-0 rounded-4">
                <div class="card-title">
                    <div class="radio-group mb-3 d-flex">
                        <input type="radio" id="tuan" name="title" checked>
                        <label class="radio-label fw-medium" for="tuan">Tuan</label>

                        <input type="radio" id="nyonya" name="title">
                        <label class="radio-label fw-medium ms-3" for="nyonya">Nyonya</label>

                        <input type="radio" id="nona" name="title">
                        <label class="radio-label fw-medium ms-3" for="nona">Nona</label>
                    </div>
                </div>
                <form>
                    <div class="mb-4">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="name" placeholder="Nama">
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="form-label">Nomor Ponsel</label>
                        <input type="text" class="form-control" id="phone" placeholder="08xxxxxxxx">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Email">
                    </div>
                    <div class="mb-4">
                        <label for="nationality" class="form-label">Kewarganegaraan</label>
                        <select class="form-select" id="nationality">
                            <option selected>Indonesia</option>
                            <option>Malaysia</option>
                            <option>Singapura</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- Tambah Perlindungan Extra -->
            <p class="mt-5 fs-3 fw-semibold mb-0">Tambah Perlindungan Extra</p>
            <p class="text-muted mb-4">Pilih satu opsi untuk melanjutkan pesanan.</p>
            <div class="card-group">
                <div class="card p-4 shadow card-border-0 rounded-4">
                    <div class="alert alert-primary" role="alert">
                        Lindungi liburanmu dari yang gak pasti.
                    </div>
                    <form id="refund-form">
                        <div class="custom-radio-card" onclick="selectCard(this)">
                            <input type="radio" name="refund-option" id="100-refund" value="100-refund">
                            <label for="100-refund">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-cash fs-3" style="color: #52d641"></i>
                                    <strong class="ms-2">100% Refund</strong>
                                    <i class="bi bi-exclamation-circle-fill ms-2 text-primary fs-5"></i>
                                </div>
                                <p>Berubah pikiran di H-1 sebelum kunjungan? Dapatkan uangmu kembali 100%!</p>
                            </label>
                            <span class="radio-indicator"></span>
                        </div>

                        <div class="custom-radio-card" onclick="selectCard(this)">
                            <input type="radio" name="refund-option" id="85-refund" value="85-refund">
                            <label for="85-refund">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-cash fs-3" style="color: #52d641; opacity: 0.5"></i>
                                    <strong class="ms-2">85% Refund</strong>
                                    <i class="bi bi-exclamation-circle-fill ms-2 text-primary fs-5"></i>
                                </div>
                                <p>Menjamin refund hingga 85% harga tiket untuk pembatalan dengan alasan apa pun.</p>
                            </label>
                            <span class="radio-indicator"></span>
                        </div>

                        <div class="custom-radio-card selected-card" onclick="selectCard(this)">
                            <input type="radio" name="refund-option" id="no-refund" value="no-refund" checked>
                            <label for="no-refund">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-shield-x fs-3 text-dark"></i>
                                    <strong class="ms-2">Lanjutkan tanpa perlindungan</strong>
                                </div>
                            </label>
                            <span class="radio-indicator"></span>
                        </div>
                    </form>
                </div>
            </div>

            <p class="mt-4 text-muted">Dengan memilih asuransi, kamu telah menyetujui <strong style="color: #C02425">Syarat dan Ketentuan</strong> yang berlaku. Biaya tambahan terkait asuransi tertera di detail harga.</p>
        </div>

        <!-- Detail Pembayaran -->
        <div class="col-md-4">
            <div class="card rounded-4 shadow card-border-0 p-4 mb-4" style="width: 100%; max-width: 400px">
                <div style="display: flex; align-items: center;">
                    <img src="{{ asset('storage/images/transstudio.png') }}" class="img-fluid rounded" alt="" style="width: 60px; height: auto; object-fit: contain;">
                    <h6 class="ms-3 mb-0 fw-medium">Jakarta Aquarium Safari</h6>
                    <h6 style="margin-left: auto;" class="mb-0 fw-medium">
                        <a href="#" style="color: #C02425; text-decoration: none;">Detail Paket</a>
                    </h6>
                </div>
                <hr>
                <p class="mb-1">Tiket Regular Weekday</p>
                <p class="mb-0">2 tiket • 1 Adult, 1 Child</p>
                <hr>
                <p class="mb-1">Masa Berlaku:</p>
                <p class="mb-0">Sen, 22 November 2024 - Sel, 30 November 2024</p>
                <hr>
                <div class="d-flex align-items-center">
                    <i class="bi bi-cash fs-3" style="color: #52d641"></i>
                    <p class="fs-5 fw-medium ms-2 mb-0" style="color: #52d641">Bisa 100% Refund dengan asuransi</p>
                </div>
                <p style="margin-left: 30px" class="mt-1">Asuransi tersedia dengan biaya tambahan</p>
                <div class="d-flex align-items-center">
                    <i class="bi bi-clock-fill fs-3"></i>
                    <p class="fs-6 ms-2 mb-0">Berlaku <strong>7 hari</strong> sejak tanggal terpilih</p>
                </div>

                <hr style="border: none; border-top: 2px dashed #414141;" class="mt-4">

                <div class="d-flex justify-content-between align-items-center fs-5 mt-3">
                    <span>Total Pembayaran</span>
                    <span class="fs-5 fw-semibold ms-auto">IDR 230.000
                        <i class="bi bi-chevron-down ms-2 text-dark" style="font-size: 1em; font-weight: 600;"></i>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-5">
            <div class="card card-border-0 rounded-4 shadow">
                <div class="card-body">
                    <div class="d-flex">
                        <p class="fs-5 fw-medium">Total Pembayaran</p>
                        <p class="fs-5 fw-semibold ms-auto">IDR 230.000
                            <i class="bi bi-chevron-down ms-2 text-dark" style="font-size: 1em; font-weight: 600;"></i>
                        </p>
                    </div>
                    <hr style="border: none; border-top: 2px dashed #414141;" class="mt-4">

                    <div class="d-flex align-items-center">
                        <i class="bi bi-gem fs-5" style="color: #C02425"></i>
                        <p class="ms-2 mb-0 text-muted">Bisa 100% Refund dengan asuransi</p>
                        <a href="#" class="btn ms-auto text-white" style="background-color: #C02425; border-color: #C02425;">Lanjutkan Pembayaran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@push('add-style')
<style>
    body {
        background-size: 100% 80px !important;
        background-color: #ffffff;
        font-family: 'Roboto', sans-serif;
    }

    .card-hostel:hover {
        border: 1px solid #D9214E;
        cursor: pointer;
    }

    .header-logo {
        font-weight: bold;
        color: #d9534f;
    }

    .radio-group input {
        margin-right: 10px;
    }

    .highlight-box {
        background-color: #f1f9ff;
        border: 1px solid #00bfff;
        border-radius: 10px;
        padding: 15px;
    }

    .total-box {
        font-size: 1.2rem;
        color: #d9534f;
        font-weight: bold;
    }

    .btn-primary {
        background-color: #d9534f;
        border-color: #d9534f;
    }

    .btn-primary:hover {
        background-color: #c9302c;
    }

    .points-info {
        font-size: 0.9rem;
        color: #6c757d;
        display: flex;
        align-items: center;
    }

    .points-info img {
        width: 16px;
        margin-right: 5px;
    }

    .custom-radio-card {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 8px;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .custom-radio-card input[type="radio"] {
        display: none;
    }

    .custom-radio-card.selected-card {
        background-color: #f0f8ff;
        border-color: #007bff;
    }

    .radio-indicator {
        position: relative;
        width: 18px;
        height: 18px;
        border: 2px solid #ddd;
        border-radius: 50%;
        background-color: transparent;
        transition: background-color 0.3s, border-color 0.3s;
    }

    .custom-radio-card.selected-card .radio-indicator {
        border-color: #007bff;
        background-color: #007bff;
    }

    .radio-indicator::after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 8px;
        height: 8px;
        background-color: white;
        border-radius: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .custom-radio-card.selected-card .radio-indicator::after {
        opacity: 1;
    }

    input[type="radio"] {
        display: none;
    }

    .radio-label {
        position: relative;
        padding-left: 25px;
        cursor: pointer;
    }

    .radio-label::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 15px;
        height: 15px;
        border: 2px solid #ccc;
        border-radius: 50%;
        background-color: white;
    }

    input[type="radio"]:checked+.radio-label::before {
        border-color: #C02425;
        background-color: white;
    }

    .radio-label::after {
        content: '';
        position: absolute;
        left: 4px;
        top: 50%;
        transform: translateY(-50%);
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background-color: transparent;
        transition: background-color 0.2s;
    }

    input[type="radio"]:checked+.radio-label::after {
        background-color: #C02425;
    }

</style>
@endpush
@push('add-script')
<script>
    function selectCard(card) {
        const cards = document.querySelectorAll('.custom-radio-card');
        cards.forEach(item => {
            item.classList.remove('selected-card');
        });
        card.classList.add('selected-card');
    }

</script>
@endpush
