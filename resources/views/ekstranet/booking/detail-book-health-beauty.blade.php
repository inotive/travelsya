@extends('ekstranet.layout', ['title' => 'Riwayat Booking', 'url' => '#'])

@section('content-admin')
<style>
    .e-ticket-container {
        max-width: 800px;
        margin: 20px auto;
        background: #fff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }
    .e-ticket-header {
        text-align: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }
    .e-ticket-header h1 {
        color: #c02425;
        margin: 0;
        font-size: 2.8em;
        font-weight: 700;
    }
    .e-ticket-header p {
        color: #666;
        font-size: 1.2em;
        margin-top: 5px;
    }
    .e-ticket-main-info {
        background-color: #fdfdfd;
        padding: 25px;
        border-radius: 8px;
        margin-bottom: 30px;
        border: 1px solid #eee;
    }
    .e-ticket-main-info h2 {
        color: #212121;
        font-size: 2.2em;
        margin-bottom: 8px;
        font-weight: 600;
    }
    .e-ticket-main-info p {
        color: #666;
        font-size: 1.1em;
        margin-bottom: 25px;
    }
    .e-ticket-date-block {
        display: flex;
        justify-content: space-around;
        text-align: center;
        margin-top: 20px;
    }
    .e-ticket-date-item {
        flex: 1;
        padding: 15px;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        margin: 0 10px;
    }
    .e-ticket-date-item:first-child { margin-left: 0; }
    .e-ticket-date-item:last-child { margin-right: 0; }
    .e-ticket-date-item .label {
        font-size: 1.1em;
        font-weight: bold;
        color: #c02425;
        margin-bottom: 5px;
    }
    .e-ticket-date-item .value {
        font-size: 1.05em;
        color: #c02425;
    }
    .e-ticket-section-title {
        color: #c02425;
        font-size: 1.6em;
        margin-top: 35px;
        margin-bottom: 20px;
        border-bottom: 3px solid #c02425;
        padding-bottom: 8px;
        font-weight: 600;
    }
    .e-ticket-info-block {
        background-color: #fdfdfd;
        border-radius: 8px;
        padding: 15px 25px;
        margin-bottom: 20px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
    }
    .e-ticket-info-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px dashed #eee;
        align-items: center;
    }
    .e-ticket-info-row:last-child {
        border-bottom: none;
    }
    .e-ticket-info-label {
        font-weight: 600;
        color: #555;
        flex-basis: 45%;
    }
    .e-ticket-info-value {
        color: #333;
        text-align: right;
        flex-basis: 50%;
    }
    .e-ticket-info-row.total .e-ticket-info-label,
    .e-ticket-info-row.total .e-ticket-info-value {
        font-size: 1.2em;
        font-weight: 700;
        color: #c02425;
    }
</style>

<div class="e-ticket-container">
    <div class="e-ticket-header">
        <h1>Travelsya Wisata Indonesia</h1>
        <p>Health & Beauty Booking Detail</p>
    </div>

    <div class="e-ticket-main-info">
        <h2>{{ $healthbeautybookdates->clinic->clinic_name ?? 'Clinic Name' }}</h2>
        <p>{{ $healthbeautybookdates->clinic->address ?? 'Clinic Address' }}</p>

        @php
        $orderDate = \Carbon\Carbon::parse($healthbeautybookdates->created_at);
        $expireDate = \Carbon\Carbon::parse($healthbeautybookdates->expire_on);
        $orderDates = $orderDate->Format('d F Y');
        $expireDates = $expireDate->Format('d F Y');
        @endphp

        <div class="e-ticket-date-block">
            <div class="e-ticket-date-item">
                <div class="label">Tanggal Pemesanan</div>
                <div class="value">{{ $orderDates }}</div>
            </div>
            <div class="e-ticket-date-item">
                <div class="label">Tanggal Kadaluarsa</div>
                <div class="value">{{ $expireDates }}</div>
            </div>
        </div>
    </div>

    <div class="e-ticket-section-title">Informasi Booking</div>
    <div class="e-ticket-info-block">
        <div class="e-ticket-info-row">
            <span class="e-ticket-info-label">Kode Booking</span>
            <span class="e-ticket-info-value">{{ $healthbeautybookdates->booking_id }}</span>
        </div>
        <div class="e-ticket-info-row">
            <span class="e-ticket-info-label">Booking Dilakukan Pada</span>
            <span class="e-ticket-info-value">{{ $orderDate->translatedFormat('d F Y H:i') }}</span>
        </div>
        <div class="e-ticket-info-row">
            <span class="e-ticket-info-label">Nama Paket</span>
            <span class="e-ticket-info-value">{{ $healthbeautybookdates->package->name ?? 'Paket tidak ditemukan' }}</span>
        </div>
        <div class="e-ticket-info-row">
            <span class="e-ticket-info-label">Jumlah Tiket</span>
            <span class="e-ticket-info-value">{{ $healthbeautybookdates->total_ticket }} Tiket</span>
        </div>
    </div>

    <div class="e-ticket-section-title">Informasi Tamu</div>
    <div class="e-ticket-info-block">
        <div class="e-ticket-info-row">
            <span class="e-ticket-info-label">Nama Pemesan</span>
            <span class="e-ticket-info-value">{{ $healthbeautybookdates->transaction->user->name ?? '-' }}</span>
        </div>
        <div class="e-ticket-info-row">
            <span class="e-ticket-info-label">Nomor Telepon</span>
            <span class="e-ticket-info-value">{{ $healthbeautybookdates->transaction->user->phone ?? '-' }}</span>
        </div>
        <div class="e-ticket-info-row">
            <span class="e-ticket-info-label">Alamat Email</span>
            <span class="e-ticket-info-value">{{ $healthbeautybookdates->transaction->user->email ?? '-' }}</span>
        </div>
    </div>

    <div class="e-ticket-section-title">Rincian Pembayaran</div>
    <div class="e-ticket-info-block">
        <div class="e-ticket-info-row">
            <span class="e-ticket-info-label">Status Transaksi</span>
            <span class="e-ticket-info-value" style="color: {{ $healthbeautybookdates->transaction->status == 'PAID' ? 'green' : 'red' }};">
                {{ $healthbeautybookdates->transaction->status }}
            </span>
        </div>
        <div class="e-ticket-info-row">
            <span class="e-ticket-info-label">Tanggal Transaksi</span>
            <span class="e-ticket-info-value">{{ $orderDate->translatedFormat('d F Y H:i') }}</span>
        </div>
        <div class="e-ticket-info-row">
            <span class="e-ticket-info-label">Metode Pembayaran</span>
            <span class="e-ticket-info-value">{{ $healthbeautybookdates->transaction->payment }}</span>
        </div>
        <div class="e-ticket-info-row">
            <span class="e-ticket-info-label">Biaya Paket</span>
            <span class="e-ticket-info-value">{{ General::rp($healthbeautybookdates->rent_price) }}</span>
        </div>
        <div class="e-ticket-info-row">
            <span class="e-ticket-info-label">Biaya Admin</span>
            <span class="e-ticket-info-value">{{ General::rp($healthbeautybookdates->fee_admin) }}</span>
        </div>
        <div class="e-ticket-info-row total">
            <span class="e-ticket-info-label">Total Pembayaran</span>
            <span class="e-ticket-info-value">{{ General::rp($healthbeautybookdates->transaction->total) }}</span>
        </div>
    </div>
    
    <div class="mt-4">
        <a href="{{ route('e-tiket.health-beauty', $healthbeautybookdates->id) }}" target="_blank" class="btn btn-primary">
            <i class="fas fa-print"></i> Cetak E-Tiket
        </a>
    </div>
</div>
@endsection