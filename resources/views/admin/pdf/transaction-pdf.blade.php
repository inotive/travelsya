<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $transaction->no_inv }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
                background-color: white;
                padding: 0;
            }

            .container {
                box-shadow: none;
                border-radius: 0;
                padding: 20px;
            }

            .no-print {
                display: none !important;
            }

            .print-break {
                page-break-before: always;
            }
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 30px;
            border-bottom: 3px solid #c02425;
            position: relative;
        }

        .header::before {
            content: '';
            position: absolute;
            bottom: -3px;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(90deg, #c02425, #e74c3c);
        }

        .header h1 {
            color: #c02425;
            margin: 0 0 10px 0;
            font-size: 32px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .header .subtitle {
            color: #666;
            font-size: 16px;
            margin: 5px 0;
            font-weight: 500;
        }

        .header .date {
            color: #888;
            font-size: 14px;
            margin: 10px 0 0 0;
        }

        .invoice-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .info-card {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            border-left: 4px solid #c02425;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .info-card h3 {
            color: #c02425;
            margin: 0 0 20px 0;
            font-size: 18px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
            margin-bottom: 0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            font-size: 14px;
            min-width: 140px;
        }

        .info-value {
            color: #333;
            font-size: 14px;
            text-align: right;
            flex: 1;
        }

        .status {
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
        }

        .status.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status.pending {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .status.failed {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .financial-summary {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 30px;
            border-radius: 12px;
            margin: 40px 0;
            border: 1px solid #dee2e6;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }

        .financial-summary h3 {
            color: #c02425;
            margin: 0 0 25px 0;
            font-size: 20px;
            font-weight: 700;
            text-align: center;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: 3px solid #c02425;
            padding-bottom: 15px;
        }

        .financial-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 0;
        }

        .financial-row:last-child {
            border-bottom: none;
        }

        .financial-label {
            font-weight: 600;
            color: #555;
            font-size: 16px;
        }

        .financial-value {
            font-weight: 700;
            font-size: 16px;
            text-align: right;
        }

        .financial-value.primary {
            color: #c02425;
            font-size: 18px;
        }

        .financial-value.success {
            color: #28a745;
        }

        .financial-value.danger {
            color: #dc3545;
        }

        .financial-value.info {
            color: #c02425;
            font-size: 20px;
            font-weight: 800;
        }

        .total-row {
            background: linear-gradient(135deg, #c02425, #e74c3c);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
            box-shadow: 0 4px 12px rgba(192, 36, 37, 0.3);
        }

        .total-row .financial-label,
        .total-row .financial-value {
            color: white;
            font-size: 18px;
        }

        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 2px solid #c02425;
            padding-top: 30px;
            background: #f8f9fa;
            padding: 30px;
            border-radius: 8px;
        }

        .footer p {
            margin: 5px 0;
        }

        .footer strong {
            color: #c02425;
            font-weight: 700;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>INVOICE</h1>
            <p class="subtitle">Travelsya - Travel & Tourism Services</p>
            <p class="date">Generated on: {{ date('d M Y H:i') }}</p>
            <div class="no-print" style="margin-top: 20px;">
                <button onclick="window.print()" style="background-color: #c02425; color: white; border: none; padding: 12px 24px; border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: 600; margin-right: 10px;">
                    🖨️ Print Invoice
                </button>
                <button onclick="window.close()" style="background-color: #6c757d; color: white; border: none; padding: 12px 24px; border-radius: 6px; cursor: pointer; font-size: 14px; font-weight: 600;">
                    ✕ Close
                </button>
            </div>
        </div>

        <div class="invoice-info">
            <div class="info-card">
                <h3>Transaction Details</h3>
                <div class="info-row">
                    <span class="info-label">Invoice No:</span>
                    <span class="info-value">{{ $transaction->no_inv }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Date & Time:</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('d F Y H:i') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Service:</span>
                    <span class="info-value">{{ strtoupper($transaction->service ?? '-') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Payment Method:</span>
                    <span class="info-value">{{ $transaction->payment_method . " - " . $transaction->payment_channel }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status:</span>
                    <span class="info-value">
                        <span class="status {{ $transaction->status == 'PAID' ? 'success' : ($transaction->status == 'PENDING' ? 'pending' : 'failed') }}">
                            {{ $transaction->status }}
                        </span>
                    </span>
                </div>
            </div>

            <div class="info-card">
                <h3>Customer Information</h3>
                <div class="info-row">
                    <span class="info-label">Name:</span>
                    <span class="info-value">{{ $transaction->user->name ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email:</span>
                    <span class="info-value">{{ $transaction->user->email ?? '-' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Phone:</span>
                    <span class="info-value">{{ $transaction->user->phone ?? '-' }}</span>
                </div>
            </div>
        </div>

    <div class="financial-summary">
        <h3>Financial Summary</h3>

        <div class="financial-row">
            <span class="financial-label">Harga:</span>
            <span class="financial-value primary">Rp. {{ number_format($harga, 0, ',', '.') }}</span>
        </div>

        <div class="financial-row">
            <span class="financial-label">Biaya Layanan:</span>
            <span class="financial-value success">Rp. {{ number_format($biayaLayanan, 0, ',', '.') }}</span>
        </div>

        <div class="financial-row">
            <span class="financial-label">Potongan Point:</span>
            <span class="financial-value danger">Rp. {{ number_format($potonganPoint, 0, ',', '.') }}</span>
        </div>

        <div class="financial-row total-row">
            <span class="financial-label">Grand Total:</span>
            <span class="financial-value">Rp. {{ number_format($grandTotal, 0, ',', '.') }}</span>
        </div>
    </div>

        <div class="footer">
            <p><strong>Travelsya</strong> - Your Trusted Travel Partner</p>
            <p>This is a computer-generated invoice. No signature required.</p>
            <p>For inquiries, please contact our customer service.</p>
        </div>
    </div>

    <script>
        // Auto-print when page loads
        window.onload = function() {
            // Small delay to ensure content is fully loaded
            setTimeout(function() {
                window.print();
            }, 500);
        };
    </script>
</body>
</html>
