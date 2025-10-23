<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Isolated styles for modal content */
        .invoice-container {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #212529;
            background: #f8f9fa;
            padding: 20px;
            margin: 0;
        }

        .invoice-container * {
            box-sizing: border-box;
        }

        /* Print Styles */
        @media print {
            .invoice-container {
                background: white !important;
                padding: 0 !important;
            }

            .no-print {
                display: none !important;
            }

            .gradient-header,
            .gradient-footer {
                background: #c02425 !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .info-section {
                page-break-inside: avoid;
            }

            @page {
                size: A4;
                margin: 15mm;
            }
        }

        /* Header */
        .gradient-header {
            background: linear-gradient(135deg, #c02425 0%, #e74c3c 100%);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            color: white;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .header-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-box {
            background: white;
            border-radius: 6px;
            padding: 10px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .logo-icon {
            font-size: 50px;
            color: #c02425 !important;
        }

        .company-info h4 {
            margin: 0 0 5px 0;
            font-size: 22px;
            font-weight: 700;
        }

        .company-info small {
            font-size: 13px;
            opacity: 0.9;
        }

        .header-right {
            text-align: right;
        }

        .header-date {
            font-weight: 600;
            margin-bottom: 3px;
            font-size: 14px;
        }

        .invoice-number {
            font-size: 12px;
            opacity: 0.9;
        }

        /* Info Sections */
        .info-section {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }

        .info-item {
            margin-bottom: 0;
        }

        .info-label {
            font-size: 11px;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .info-value {
            font-weight: 600;
            font-size: 14px;
            color: #212529;
        }

        /* Route Section */
        .route-section {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            align-items: start;
        }

        .route-display {
            font-size: 24px;
            font-weight: 700;
            color: #c02425;
            margin-bottom: 15px;
        }

        /* Price Box */
        .price-box {
            background: #f8f9fa;
            border: 2px solid #28a745;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }

        .price-label {
            font-size: 12px;
            color: #6c757d;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .price-amount {
            font-size: 28px;
            font-weight: 700;
            color: #28a745;
        }

        /* Payment Table */
        .payment-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .payment-table td {
            padding: 10px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .payment-table td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .payment-table tr:last-child td {
            border-bottom: 2px solid #dee2e6;
            padding-top: 15px;
            font-weight: 700;
            font-size: 18px;
            color: #28a745;
        }

        /* Status Badge */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 13px;
        }

        .status-success {
            background: #d4edda;
            color: #155724;
        }

        /* Barcode Section */
        .barcode-section {
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 30px;
            text-align: center;
            margin: 20px 0;
        }

        .barcode-icon {
            font-size: 60px;
            color: #adb5bd;
            margin-bottom: 10px;
        }

        .barcode-text {
            color: #6c757d;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .barcode-code {
            font-weight: 700;
            font-size: 16px;
            color: #212529;
            letter-spacing: 2px;
        }

        /* Warning Box */
        .warning-box {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            border-radius: 6px;
            margin-bottom: 15px;
            padding: 20px;
        }

        .warning-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 15px;
            margin-bottom: 15px;
            color: #856404;
        }

        .notes-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 10px;
        }

        .note-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 13px;
            line-height: 1.5;
        }

        .note-icon {
            color: #c02425;
            margin-top: 2px;
            flex-shrink: 0;
        }

        /* Footer */
        .gradient-footer {
            background: linear-gradient(135deg, #c02425 0%, #e74c3c 100%);
            border-radius: 8px;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 15px;
        }

        .footer-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .footer-icon {
            font-size: 24px;
        }

        .footer-text {
            font-size: 13px;
        }

        .footer-note {
            font-size: 12px;
            opacity: 0.9;
            margin-top: 10px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .route-section {
                grid-template-columns: 1fr;
            }

            .header-flex {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-right {
                text-align: left;
            }

            .route-display {
                font-size: 20px;
            }

            .price-amount {
                font-size: 24px;
            }
        }

        .header-top {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .header-logo {
            max-height: 70px;      /* adjust as needed */
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="gradient-header">
            <div class="header-top text-center mb-3">
                <img src="/assets/media/logos/logobaru.png" alt="Logo" class="header-logo">
            </div>
            <div class="header-flex">
                <div class="header-left">
                    <div class="logo-box">
                        <i class="fas fa-bus logo-icon"></i>
                    </div>
                    <div class="company-info">
                        <h4 style="color: white">E-Ticket Bus Travel</h4>
                        <small>E-ticket untuk Bus Travel</small>
                    </div>
                </div>
                <div class="header-right">
                    <div class="header-date">{{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</div>
                    <div class="invoice-number">Invoice #{{ $data->booking_id }}</div>
                </div>
            </div>
        </div>

        <!-- Route & Price Overview -->
        <div class="info-section">
            <div class="route-section">
                <div>
                    <div class="info-label">Rute Perjalanan</div>
                    <div class="route-display">{{ $data->from ?? '-' }} → {{ $data->to ?? '-' }}</div>

                    <div class="info-item">
                        <div class="info-label">Operator Bus</div>
                        <div class="info-value">{{ $data->busTravel->business_name ?? 'Bus Travel' }}</div>
                    </div>

                    <div class="info-item" style="margin-top: 15px;">
                        <div class="info-label">Waktu Keberangkatan</div>
                        <div class="info-value">{{ \Carbon\Carbon::parse($data->departure_time)->translatedFormat('d F Y, H:i') }}</div>
                    </div>

                    <div class="info-item" style="margin-top: 15px;">
                        <div class="info-label">Estimasi Durasi</div>
                        <div class="info-value">{{ $data->duration ?? '-' }}</div>
                    </div>
                </div>
                <div>
                    <div class="price-box">
                        <div class="price-label">Total Pembayaran</div>
                        <div class="price-amount">Rp {{ number_format($data->price + $data->fee_admin, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Booking Information -->
        <div class="info-section">
            <div class="section-title">
                <i class="fas fa-ticket-alt"></i>
                <span>Informasi Booking</span>
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Kode Booking</div>
                    <div class="info-value">{{ $data->booking_id }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tanggal Booking</div>
                    <div class="info-value">{{ \Carbon\Carbon::parse($data->transaction->created_at)->translatedFormat('d F Y, H:i') }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Status Pembayaran</div>
                    <div class="info-value">
                        <span class="status-badge status-success">
                            <i class="fas fa-check-circle"></i>
                            {{ $data->transaction->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bus Information -->
        <div class="info-section">
            <div class="section-title">
                <i class="fas fa-bus"></i>
                <span>Informasi Bus</span>
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Nama Bus</div>
                    <div class="info-value">{{ $data->busTravelHasBus->name ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Kelas</div>
                    <div class="info-value">{{ $data->busTravelHasBus->class ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Kapasitas</div>
                    <div class="info-value">{{ $data->busTravelHasBus->number_seats ?? '-' }} Kursi</div>
                </div>
            </div>
        </div>

        <!-- Passenger Information -->
        <div class="info-section">
            <div class="section-title">
                <i class="fas fa-user"></i>
                <span>Informasi Penumpang</span>
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Nama Lengkap</div>
                    <div class="info-value">{{ $data->customer_name ?? $data->transaction->user->name ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">No. Telepon</div>
                    <div class="info-value">{{ $data->customer_phone ?? $data->transaction->user->phone ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Email</div>
                    <div class="info-value">{{ $data->customer_email ?? $data->transaction->user->email ?? '-' }}</div>
                </div>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="info-section">
            <div class="section-title">
                <i class="fas fa-receipt"></i>
                <span>Rincian Pembayaran</span>
            </div>
            <div class="route-section">
                <div>
                    <table class="payment-table">
                        <tr>
                            <td>Biaya Tiket</td>
                            <td>Rp {{ number_format($data->price, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Biaya Admin</td>
                            <td>Rp {{ number_format($data->fee_admin, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>Total Pembayaran</td>
                            <td>Rp {{ number_format($data->price + $data->fee_admin, 0, ',', '.') }}</td>
                        </tr>
                    </table>
                </div>
                <div>
                    <div class="info-item">
                        <div class="info-label">Metode Pembayaran</div>
                        <div class="info-value">{{ $data->transaction->payment_method }}</div>
                    </div>
                    <div class="info-item" style="margin-top: 15px;">
                        <div class="info-label">Status</div>
                        <div class="info-value status-badge status-success">
                            <i class="fas fa-check-circle"></i>
                            Pembayaran Berhasil
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barcode -->
        {{-- <div class="barcode-section">
            <div class="barcode-icon">
                <i class="fas fa-qrcode"></i>
            </div>
            <div class="barcode-text">Scan QR Code saat check-in</div>
            <div class="barcode-code">{{ $data->booking_id }}</div>
        </div> --}}

        <!-- Important Notes -->
        <div class="warning-box">
            <div class="warning-title">
                <i class="fas fa-exclamation-triangle"></i>
                <span>Catatan Penting</span>
            </div>
            <div class="notes-grid">
                <div class="note-item">
                    <i class="fas fa-clock note-icon"></i>
                    <span>Harap datang 30 menit sebelum keberangkatan</span>
                </div>
                <div class="note-item">
                    <i class="fas fa-id-card note-icon"></i>
                    <span>Bawa identitas diri (KTP/SIM) yang masih berlaku</span>
                </div>
                <div class="note-item">
                    <i class="fas fa-ban note-icon"></i>
                    <span>Tiket tidak dapat dikembalikan atau ditukar</span>
                </div>
                <div class="note-item">
                    <i class="fas fa-heart note-icon"></i>
                    <span>Pastikan kondisi kesehatan fit untuk perjalanan</span>
                </div>
                <div class="note-item">
                    <i class="fas fa-suitcase note-icon"></i>
                    <span>Barang bawaan menjadi tanggung jawab penumpang</span>
                </div>
                <div class="note-item">
                    <i class="fas fa-shield-alt note-icon"></i>
                    <span>Patuhi protokol kesehatan selama perjalanan</span>
                </div>
            </div>
        </div>

        <!-- Contact Info -->
        <div class="gradient-footer">
            <div class="footer-grid">
                <div class="footer-item">
                    <i class="fab fa-whatsapp footer-icon"></i>
                    <div class="footer-text">085247213909</div>
                </div>
                <div class="footer-item">
                    <i class="fas fa-envelope footer-icon"></i>
                    <div class="footer-text">travelsyawisataindonesia@gmail.com</div>
                </div>
                <div class="footer-item">
                    <i class="fas fa-globe footer-icon"></i>
                    <div class="footer-text">www.travelsya.com</div>
                </div>
            </div>
            <div class="footer-note">
                Terima kasih telah menggunakan layanan TRAVELSYA
            </div>
        </div>
    </div>
</body>
</html>
