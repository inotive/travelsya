<!DOCTYPE html>
<html lang="en">
<head>
    <title>Travelsya E-Ticket</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f8f8; /* Lighter background */
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px; /* Slightly more rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); /* More prominent shadow */
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        .header .logo {
            max-width: 180px; /* Larger logo */
            margin-bottom: 15px;
        }
        .header h1 {
            color: #c02425;
            margin: 0;
            font-size: 2.8em; /* Larger title */
            font-weight: 700;
        }
        .header p {
            color: #666;
            font-size: 1.2em; /* Larger subtitle */
            margin-top: 5px;
        }
        .main-info {
            background-color: #fdfdfd; /* Light background for main info */
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 30px;
            border: 1px solid #eee;
        }
        .main-info h2 {
            color: #212121;
            font-size: 2.2em; /* Larger name */
            margin-bottom: 8px;
            font-weight: 600;
        }
        .main-info p {
            color: #666;
            font-size: 1.1em;
            margin-bottom: 25px;
        }
        .date-block {
            display: flex;
            justify-content: space-around;
            text-align: center;
            margin-top: 20px;
        }
        .date-item {
            flex: 1;
            padding: 15px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin: 0 10px;
        }
        .date-item:first-child { margin-left: 0; }
        .date-item:last-child { margin-right: 0; }
        .date-item .label {
            font-size: 1.1em;
            font-weight: bold;
            color: #c02425;
            margin-bottom: 5px;
        }
        .date-item .value {
            font-size: 1.05em;
            color: #c02425;
        }

        .section-title {
            color: #c02425;
            font-size: 1.6em; /* Slightly larger title */
            margin-top: 35px;
            margin-bottom: 20px;
            border-bottom: 3px solid #c02425; /* Thicker border */
            padding-bottom: 8px;
            font-weight: 600;
        }
        .info-block {
            background-color: #fdfdfd; /* Light background for info blocks */
            border-radius: 8px;
            padding: 15px 25px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px dashed #eee;
            align-items: center;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: 600;
            color: #555;
            flex-basis: 45%;
        }
        .info-value {
            color: #333;
            text-align: right;
            flex-basis: 50%;
        }
        .info-row.total .info-label,
        .info-row.total .info-value {
            font-size: 1.2em;
            font-weight: 700;
            color: #c02425;
        }
        .notes {
            background-color: #fff3f3;
            border-left: 5px solid #c02425;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
        }
        .notes h3 {
            color: #c02425;
            margin-top: 0;
            font-size: 1.4em;
            font-weight: 600;
        }
        .notes ul {
            list-style-type: disc;
            padding-left: 25px;
            margin-top: 15px;
        }
        .notes li {
            margin-bottom: 10px;
            color: #555;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 25px;
            border-top: 1px solid #eee;
            color: #888;
            font-size: 0.95em;
        }
        .footer a {
            color: #c02425;
            text-decoration: none;
            font-weight: 600;
            margin: 0 8px;
        }
        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('assets/media/logos/logo.png') }}" alt="Travelsya Logo" class="logo">
            <h1>Travelsya Wisata Indonesia</h1>
            <p>Health & Beauty e-Booking Itinerary / Receipt</p>
        </div>

        <div class="main-info">
            <h2>{{ $data->clinic->clinic_name ?? 'Clinic Name' }}</h2>
            <p>{{ $data->clinic->address ?? 'Clinic Address' }}</p>

            <div class="date-block">
                <div class="date-item">
                    <div class="label">Tanggal Pemesanan</div>
                    <div class="value">{{ \Carbon\Carbon::parse($data->transaction->created_at)->translatedFormat('d F Y') }}</div>
                </div>
                <div class="date-item">
                    <div class="label">Tanggal Kadaluarsa</div>
                    <div class="value">{{ \Carbon\Carbon::parse($data->expire_on)->translatedFormat('d F Y') }}</div>
                </div>
            </div>
        </div>

        <div class="section-title">Informasi Booking</div>
        <div class="info-block">
            <div class="info-row">
                <span class="info-label">Kode Booking</span>
                <span class="info-value">{{ $data->booking_id }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Booking Dilakukan Pada</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($data->transaction->created_at)->translatedFormat('d F Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Nama Paket</span>
                <span class="info-value">{{ $data->package->name ?? 'Paket tidak ditemukan' }}</span>
            </div>
        </div>

        <div class="section-title">Informasi Tamu</div>
        <div class="info-block">
            <div class="info-row">
                <span class="info-label">Nama Pemesan</span>
                <span class="info-value">{{ $data->transaction->user->name ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Nomor Telepon</span>
                <span class="info-value">{{ $data->transaction->user->phone ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Alamat Email</span>
                <span class="info-value">{{ $data->transaction->user->email ?? '-' }}</span>
            </div>
        </div>

        <div class="section-title">Rincian Pembayaran</div>
        <div class="info-block">
            <div class="info-row">
                <span class="info-label">Status Transaksi</span>
                <span class="info-value" style="color: {{ $data->transaction->status == 'PAID' ? 'green' : 'red' }};">{{ $data->transaction->status }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal Transaksi</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($data->transaction->created_at)->translatedFormat('d F Y H:m') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Metode Pembayaran</span>
                <span class="info-value">{{ $data->transaction->payment }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Biaya Paket</span>
                <span class="info-value">Rp. {{ number_format($data->rent_price, 0, ',', '.') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Biaya Admin</span>
                <span class="info-value">Rp. {{ number_format($data->fee_admin, 0, ',', '.') }}</span>
            </div>
            <div class="info-row total">
                <span class="info-label">Total Pembayaran</span>
                <span class="info-value">Rp. {{ number_format($data->transaction->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="section-title">Catatan Penting</div>
        <div class="notes">
            <ul>
                <li>Tiket ini berlaku untuk satu kali pemakaian sesuai tanggal yang tertera.</li>
                <li>Harap tunjukkan e-tiket ini beserta identitas diri yang sah saat di klinik.</li>
                <li>Tiket yang sudah dibeli tidak dapat dikembalikan atau ditukar.</li>
                <li>Pihak penyelenggara berhak menolak jika e-tiket tidak valid atau ada pelanggaran aturan.</li>
                <li>Pastikan Anda membaca dan memahami semua syarat dan ketentuan yang berlaku.</li>
            </ul>
        </div>

        <div class="footer">
            <p>Contact Us:
                <a href="https://wa.me/6285247213909">085247213909</a> |
                <a href="mailto:travelsyawisataindonesia@gmail.com">travelsyawisataindonesia@gmail.com</a> |
                <a href="www.travelsya.com">www.travelsya.com</a>
            </p>
            <p>&copy; {{ date('Y') }} Travelsya. All rights reserved.</p>
        </div>
    </div>
</body>
</html>