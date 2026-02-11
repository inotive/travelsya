<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelsya Bus Travel E-Ticket</title>
    <style>
        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        /* Print Styles */
        @media print {
            body {
                background: white !important;
                padding: 0 !important;
            }
            .container {
                box-shadow: none;
                padding: 20px;
            }
            .no-print {
                display: none !important;
            }
            @page {
                size: A4;
                margin: 15mm;
            }
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }

        .header .logo {
            max-width: 180px;
            margin-bottom: 15px;
        }

        .header h1 {
            color: #c02425;
            margin: 0;
            font-size: 2.8em;
            font-weight: 700;
        }

        .header p {
            color: #666;
            font-size: 1.2em;
            margin-top: 5px;
        }

        /* Main Info Section */
        .main-info {
            background-color: #fdfdfd;
            padding: 25px;
            border-radius: 8px;
            margin-bottom: 30px;
            border: 1px solid #eee;
        }

        .main-info h2 {
            color: #212121;
            font-size: 2.2em;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .main-info p {
            color: #666;
            font-size: 1.1em;
            margin-bottom: 25px;
        }

        .route-display {
            font-size: 2em;
            font-weight: 700;
            color: #c02425;
            margin-bottom: 15px;
            text-align: center;
        }

        /* Date Block */
        .date-block {
            display: flex;
            justify-content: space-around;
            text-align: center;
            margin-top: 20px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .date-item {
            flex: 1;
            min-width: 200px;
            padding: 15px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

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

        /* Section Title */
        .section-title {
            color: #c02425;
            font-size: 1.6em;
            margin-top: 35px;
            margin-bottom: 20px;
            border-bottom: 3px solid #c02425;
            padding-bottom: 8px;
            font-weight: 600;
        }

        /* Info Block */
        .info-block {
            background-color: #fdfdfd;
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

        .info-row.harga .info-label,
        .info-row.harga .info-value {
            font-size: 1.1em;
            font-weight: 700;
            color: #c02425;
        }

        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9em;
        }

        .status-success {
            background: #d4edda;
            color: #155724;
        }

        .status-paid {
            background: #d4edda;
            color: #155724;
        }

        /* Passenger Section */
        .passenger-item {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            border-left: 4px solid #c02425;
        }

        .passenger-item h4 {
            color: #c02425;
            margin-top: 0;
            margin-bottom: 10px;
            font-size: 1.1em;
        }

        /* Notes Section */
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

        /* Footer */
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

        /* Responsive */
        @media (max-width: 768px) {
            .header h1 {
                font-size: 2em;
            }

            .main-info h2 {
                font-size: 1.6em;
            }

            .route-display {
                font-size: 1.5em;
            }

            .date-block {
                flex-direction: column;
            }

            .date-item {
                margin: 5px 0;
            }

            .info-row {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-value {
                text-align: left;
                margin-top: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ asset('assets/media/logos/logobaru.png') }}" alt="Travelsya Logo" class="logo">
            <h1>Travelsya Wisata Indonesia</h1>
            <p>Bus Travel E-Ticket / E-Booking Itinerary</p>
        </div>

        <!-- Main Info with Route -->
        <div class="main-info">
            <div class="route-display">{{ $data->from ?? '-' }} → {{ $data->to ?? '-' }}</div>
            <p style="text-align: center;">{{ $data->busTravel->business_name ?? 'Bus Travel' }}</p>

            <div class="date-block">
                <div class="date-item">
                    <div class="label">Tanggal Pemesanan</div>
                    <div class="value">{{ \Carbon\Carbon::parse($data->transaction->created_at)->translatedFormat('d F Y') }}</div>
                </div>
                <div class="date-item">
                    <div class="label">Waktu Keberangkatan</div>
                    <div class="value">{{ \Carbon\Carbon::parse($data->departure_time)->translatedFormat('d F Y, H:i') }}</div>
                </div>
                <div class="date-item">
                    <div class="label">Estimasi Durasi</div>
                    <div class="value">{{ $data->duration ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Booking Information -->
        <div class="section-title">Informasi Booking</div>
        <div class="info-block">
            <div class="info-row">
                <span class="info-label">Nomor Invoice</span>
                <span class="info-value">{{ $data->transaction->no_inv ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Kode Booking</span>
                <span class="info-value">{{ $data->booking_id }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Booking Dilakukan Pada</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($data->transaction->created_at)->translatedFormat('d F Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status Pembayaran</span>
                <span class="info-value">
                    <span class="status-badge status-{{ strtolower($data->transaction->status) }}">{{ $data->transaction->status }}</span>
                </span>
            </div>
        </div>

        <!-- Bus Information -->
        <div class="section-title">Informasi Bus</div>
        <div class="info-block">
            <div class="info-row">
                <span class="info-label">Nama Bus</span>
                <span class="info-value">{{ $data->busTravelHasBus->name ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Kelas</span>
                <span class="info-value">{{ $data->busTravelHasBus->class ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Kapasitas</span>
                <span class="info-value">{{ $data->busTravelHasBus->number_seats ?? '-' }} Kursi</span>
            </div>
        </div>

        <!-- Passenger Information -->
        <div class="section-title">Informasi Penumpang ({{ $ticketCount }} Tiket)</div>
        @foreach($tickets as $index => $ticket)
        <div class="passenger-item">
            <h4>Penumpang {{ $index + 1 }}</h4>
            <div class="info-block" style="box-shadow: none; padding: 10px 0;">
                <div class="info-row">
                    <span class="info-label">Nama Penumpang</span>
                    <span class="info-value">{{ $ticket->customer_name ?? $ticket->transaction->user->name ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">No. Telepon</span>
                    <span class="info-value">{{ $ticket->customer_phone ?? $ticket->transaction->user->phone ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Nomor Kursi</span>
                    <span class="info-value">{{ $ticket->seat_number ?? 'N/A' }}</span>
                </div>
                <div class="info-row harga">
                    <span class="info-label">Harga Tiket</span>
                    <span class="info-value">Rp {{ number_format($ticket->price, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        @endforeach
        <div class="info-block">
            <div class="info-row">
                <span class="info-label">Email</span>
                <span class="info-value">{{ $data->customer_email ?? $data->transaction->user->email ?? '-' }}</span>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="section-title">Rincian Pembayaran</div>
        <div class="info-block">
            <div class="info-row">
                <span class="info-label">Status Transaksi</span>
                <span class="info-value" style="color: {{ $data->transaction->status == 'PAID' ? 'green' : 'red' }};">{{ $data->transaction->status }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal Transaksi</span>
                <span class="info-value">{{ \Carbon\Carbon::parse($data->transaction->created_at)->translatedFormat('d F Y H:i') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Metode Pembayaran</span>
                <span class="info-value">{{ $data->transaction->payment_method }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Biaya Tiket ({{ $ticketCount }}x)</span>
                <span class="info-value">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Biaya Admin</span>
                <span class="info-value">Rp {{ number_format($totalAdminFee, 0, ',', '.') }}</span>
            </div>
            <div class="info-row total">
                <span class="info-label">Total Pembayaran</span>
                <span class="info-value">Rp {{ number_format($totalPrice + $totalAdminFee, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Important Notes -->
        <div class="section-title">Catatan Penting</div>
        <div class="notes">
            <ul>
                <li>Harap datang 30 menit sebelum waktu keberangkatan.</li>
                <li>Bawa identitas diri (KTP/SIM) yang masih berlaku saat check-in.</li>
                <li>Tiket yang sudah dibeli tidak dapat dikembalikan atau ditukar.</li>
                <li>Pastikan kondisi kesehatan Anda fit untuk perjalanan.</li>
                <li>Barang bawaan menjadi tanggung jawab penumpang sepenuhnya.</li>
                <li>Patuhi protokol kesehatan selama perjalanan.</li>
                <li>Pihak penyelenggara berhak menolak keberangkatan jika e-tiket tidak valid atau ada pelanggaran aturan.</li>
            </ul>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Contact Us:
                <a href="https://wa.me/6285247213909">085247213909</a> |
                <a href="mailto:travelsyawisataindonesia@gmail.com">travelsyawisataindonesia@gmail.com</a> |
                <a href="http://www.travelsya.com">www.travelsya.com</a>
            </p>
            <p>&copy; {{ date('Y') }} Travelsya. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
