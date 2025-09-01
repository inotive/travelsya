<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bus Travel Invoice - {{ $data->booking_id }}</title>
    <meta charset="utf-8" />
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            background: linear-gradient(135deg, #c02425 0%, #e74c3c 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header .subtitle {
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            overflow: hidden;
        }
        .card-header {
            background: #f8f9fa;
            padding: 10px 15px;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
        }
        .card-body {
            padding: 15px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .info-label {
            color: #666;
            font-size: 12px;
        }
        .info-value {
            font-weight: bold;
        }
        .total-amount {
            font-size: 20px;
            font-weight: bold;
            color: #28a745;
            text-align: right;
        }
        .notes {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin-top: 20px;
        }
        .notes h4 {
            margin: 0 0 10px 0;
            color: #856404;
        }
        .notes ul {
            margin: 0;
            padding-left: 20px;
        }
        .notes li {
            margin-bottom: 5px;
        }
        .footer {
            background: linear-gradient(135deg, #c02425 0%, #e74c3c 100%);
            color: white;
            padding: 15px;
            border-radius: 10px;
            margin-top: 20px;
            text-align: center;
        }
        .contact-info {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
        }
        .contact-item {
            margin: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>TRAVELSYA WISATA INDONESIA</h1>
        <div class="subtitle">Bus Travel e-Ticket - Invoice #{{ $data->booking_id }}</div>
    </div>

    <!-- Bus Travel Info -->
    <div class="card">
        <div class="card-header">Informasi Bus Travel</div>
        <div class="card-body">
            <div class="info-row">
                <span class="info-label">Nama Perusahaan:</span>
                <span class="info-value">{{ $data->busTravel->business_name ?? 'Bus Travel' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Alamat:</span>
                <span class="info-value">{{ $data->busTravel->address ?? '' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Waktu Keberangkatan:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($data->departure_time)->translatedFormat('d F Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Durasi Perjalanan:</span>
                <span class="info-value">{{ $data->duration ?? '-' }}</span>
            </div>
        </div>
    </div>

    <!-- Booking Information -->
    <div class="card">
        <div class="card-header">Informasi Booking</div>
        <div class="card-body">
            <div class="info-row">
                <span class="info-label">Kode Booking:</span>
                <span class="info-value">{{ $data->booking_id }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal Booking:</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($data->transaction->created_at)->translatedFormat('d F Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Rute Perjalanan:</span>
                <span class="info-value">{{ $data->from ?? '-' }} - {{ $data->to ?? '-' }}</span>
            </div>
        </div>
    </div>

    <!-- Bus Information -->
    <div class="card">
        <div class="card-header">Informasi Bus</div>
        <div class="card-body">
            <div class="info-row">
                <span class="info-label">Nama Bus:</span>
                <span class="info-value">{{ $data->busTravelHasBus->name ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Kelas Bus:</span>
                <span class="info-value">{{ $data->busTravelHasBus->class ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Jumlah Kursi:</span>
                <span class="info-value">{{ $data->busTravelHasBus->number_seats ?? '-' }} Kursi</span>
            </div>
        </div>
    </div>

    <!-- Passenger Information -->
    <div class="card">
        <div class="card-header">Informasi Penumpang</div>
        <div class="card-body">
            <div class="info-row">
                <span class="info-label">Nama Penumpang:</span>
                <span class="info-value">{{ $data->customer_name ?? $data->transaction->user->name ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Nomor Telepon:</span>
                <span class="info-value">{{ $data->customer_phone ?? $data->transaction->user->phone ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Email:</span>
                <span class="info-value">{{ $data->customer_email ?? $data->transaction->user->email ?? '-' }}</span>
            </div>
        </div>
    </div>

    <!-- Payment Details -->
    <div class="card">
        <div class="card-header">Rincian Pembayaran</div>
        <div class="card-body">
            <table>
                <tr>
                    <td>Status Transaksi</td>
                    <td><strong>{{ $data->transaction->status }}</strong></td>
                </tr>
                <tr>
                    <td>Tanggal Transaksi</td>
                    <td><strong>{{ \Carbon\Carbon::parse($data->transaction->created_at)->translatedFormat('d F Y H:i') }}</strong></td>
                </tr>
                <tr>
                    <td>Metode Pembayaran</td>
                    <td><strong>{{ $data->transaction->payment_method }}</strong></td>
                </tr>
                <tr>
                    <td>Biaya Tiket</td>
                    <td><strong>Rp {{ number_format($data->price, 0, ',', '.') }}</strong></td>
                </tr>
                <tr>
                    <td>Biaya Admin</td>
                    <td><strong>Rp {{ number_format($data->fee_admin, 0, ',', '.') }}</strong></td>
                </tr>
                <tr style="border-top: 2px solid #333;">
                    <td><strong>Total Pembayaran</strong></td>
                    <td class="total-amount">Rp {{ number_format($data->price + $data->fee_admin, 0, ',', '.') }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Important Notes -->
    <div class="notes">
        <h4>Catatan Penting</h4>
        <ul>
            <li>Harap datang 30 menit sebelum waktu keberangkatan.</li>
            <li>Bawa identitas diri (KTP/SIM) yang masih berlaku.</li>
            <li>Tiket tidak dapat dikembalikan atau ditukar dengan uang.</li>
            <li>Pastikan kondisi kesehatan fit untuk perjalanan jauh.</li>
            <li>Barang bawaan menjadi tanggung jawab penumpang.</li>
            <li>Patuhi protokol kesehatan yang berlaku selama perjalanan.</li>
        </ul>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="contact-info">
            <div class="contact-item">
                <strong>WhatsApp:</strong> 085247213909
            </div>
            <div class="contact-item">
                <strong>Email:</strong> travelsyawisataindonesia@gmail.com
            </div>
            <div class="contact-item">
                <strong>Website:</strong> www.travelsya.com
            </div>
        </div>
    </div>
</body>
</html>
