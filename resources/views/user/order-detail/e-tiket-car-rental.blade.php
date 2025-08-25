<!DOCTYPE html>
<html lang="en">
<head>
    <title>Travelsya E-Ticket</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Minimal styling, assuming basic Bootstrap or similar is available for container/card -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #c02425;
            margin: 0;
            font-size: 2.5em;
        }
        .header p {
            color: #666;
            font-size: 1.1em;
        }
        .section-title {
            color: #c02425;
            font-size: 1.5em;
            margin-top: 30px;
            margin-bottom: 15px;
            border-bottom: 2px solid #c02425;
            padding-bottom: 5px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #eee;
        }
        .info-row:last-child {
            border-bottom: none;
        }
        .info-label {
            font-weight: bold;
            color: #555;
        }
        .info-value {
            color: #333;
        }
        .notes ul {
            list-style-type: disc;
            padding-left: 20px;
        }
        .notes li {
            margin-bottom: 8px;
        }
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #888;
            font-size: 0.9em;
        }
        .footer a {
            color: #c02425;
            text-decoration: none;
        }
        .logo {
            max-width: 150px; /* Adjust as needed */
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('assets/media/logos/logo.png') }}" alt="Travelsya Logo" class="logo">
            <h1>Travelsya Wisata Indonesia</h1>
            <p>Car Rental e-Booking Itinerary / Receipt</p>
        </div>

        <div class="main-info">
            <h2 style="color: #212121; font-size: 2em; margin-bottom: 5px;">{{ $data->car->brand->name ?? '' }} {{ $data->car->carModel->name ?? 'Car Model' }}</h2>
            <p style="color: #666; font-size: 1.1em; margin-bottom: 20px;">{{ $data->carRental->address ?? 'Car Rental Address' }}</p>

            <div style="display: flex; justify-content: space-around; text-align: center; margin-bottom: 30px;">
                <div>
                    <div style="font-size: 1.2em; font-weight: bold; color: #c02425;">Waktu Rental</div>
                    <div style="font-size: 1.1em; color: #c02425;">{{ \Carbon\Carbon::parse($data->start)->translatedFormat('d F Y H:i') }}</div>
                </div>
                <div>
                    <div style="font-size: 1.2em; font-weight: bold; color: #c02425;">Waktu Kembali</div>
                    <div style="font-size: 1.1em; color: #c02425;">{{ \Carbon\Carbon::parse($data->end)->translatedFormat('d F Y H:i') }}</div>
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
                <span class="info-label">Durasi Rental</span>
                <span class="info-value">{{ $data->duration }} Hari</span>
            </div>
        </div>

        <div class="section-title">Informasi Kendaraan</div>
        <div class="info-block">
            <div class="info-row">
                <span class="info-label">Jenis Mobil</span>
                <span class="info-value">{{ $data->car->brand->name ?? '' }} {{ $data->car->carModel->name ?? '' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tahun Mobil</span>
                <span class="info-value">{{ $data->car->year ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Nomor Polisi</span>
                <span class="info-value">{{ $data->car->license_plate ?? '-' }}</span>
            </div>
        </div>

        <div class="section-title">Informasi Tamu</div>
        <div class="info-block">
            <div class="info-row">
                <span class="info-label">Nama Penyewa</span>
                <span class="info-value">{{ $data->customer_name ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Nomor Telepon</span>
                <span class="info-value">{{ $data->customer_phone ?? '-' }}</span>
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
                <span class="info-value">{{ $data->transaction->payment_method }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Biaya Rental</span>
                <span class="info-value">Rp. {{ number_format($data->rent_price, 0, ',', '.') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Biaya Admin</span>
                <span class="info-value">Rp. {{ number_format($data->fee_admin, 0, ',', '.') }}</span>
            </div>
            <div class="info-row" style="font-size: 1.1em; font-weight: bold; color: #c02425;">
                <span class="info-label">Total Pembayaran</span>
                <span class="info-value">Rp. {{ number_format($data->rent_price + $data->fee_admin, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="section-title notes">Catatan Penting</div>
        <ul>
            <li>Pastikan membawa SIM dan KTP yang masih berlaku saat pengambilan kendaraan.</li>
            <li>Periksa kondisi kendaraan sebelum dan sesudah rental. Laporkan segera jika ada kerusakan.</li>
            <li>Keterlambatan pengembalian kendaraan akan dikenakan denda sesuai ketentuan yang berlaku.</li>
            <li>Bahan bakar saat pengembalian harus sama dengan saat pengambilan.</li>
            <li>Pembatalan sewa dapat dikenakan biaya pembatalan.</li>
        </ul>

        <div class="footer">
            <p>Contact Us: <a href="https://wa.me/6285247213909">085247213909</a> | <a href="mailto:travelsyawisataindonesia@gmail.com">travelsyawisataindonesia@gmail.com</a> | <a href="www.travelsya.com">www.travelsya.com</a></p>
            <p>&copy; {{ date('Y') }} Travelsya. All rights reserved.</p>
        </div>
    </div>
</body>
</html>