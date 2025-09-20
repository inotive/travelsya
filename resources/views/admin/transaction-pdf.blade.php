<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $transaction->no_inv }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
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
            margin-bottom: 30px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 20px;
        }

        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 24px;
        }

        .header p {
            margin: 5px 0;
            color: #666;
        }

        .invoice-info {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }

        .invoice-info .left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .invoice-info .right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            text-align: right;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .info-section h3 {
            color: #007bff;
            margin: 0 0 10px 0;
            font-size: 14px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .info-row {
            margin-bottom: 5px;
        }

        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 120px;
        }

        .info-value {
            display: inline-block;
        }

        .status {
            padding: 5px 10px;
            border-radius: 3px;
            font-weight: bold;
            font-size: 11px;
        }

        .status.success {
            background-color: #d4edda;
            color: #155724;
        }

        .status.pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status.failed {
            background-color: #f8d7da;
            color: #721c24;
        }

        .financial-summary {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .financial-summary h3 {
            color: #007bff;
            margin: 0 0 15px 0;
            font-size: 16px;
        }

        .financial-row {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }

        .financial-label {
            display: table-cell;
            width: 60%;
            font-weight: bold;
        }

        .financial-value {
            display: table-cell;
            width: 40%;
            text-align: right;
            font-weight: bold;
        }

        .financial-value.primary {
            color: #007bff;
        }

        .financial-value.success {
            color: #28a745;
        }

        .financial-value.danger {
            color: #dc3545;
        }

        .financial-value.info {
            color: #17a2b8;
        }

        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        .user-info {
            background-color: #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }

        .user-info h3 {
            color: #007bff;
            margin: 0 0 10px 0;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>INVOICE</h1>
        <p>Travelsya - Travel & Tourism Services</p>
        <p>Generated on: {{ date('d M Y H:i') }}</p>
        <div class="no-print" style="margin-top: 20px;">
            <button onclick="window.print()" style="background-color: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 14px;">
                🖨️ Print Invoice
            </button>
            <button onclick="window.close()" style="background-color: #6c757d; color: white; border: none; padding: 10px 20px; border-radius: 5px; cursor: pointer; font-size: 14px; margin-left: 10px;">
                ✕ Close
            </button>
        </div>
    </div>

    <div class="invoice-info">
        <div class="left">
            <div class="info-section">
                <h3>Transaction Details</h3>
                <div class="info-row">
                    <span class="info-label">Invoice No:</span>
                    <span class="info-value">{{ $transaction->no_inv }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Date & Time:</span>
                    <span class="info-value">{{ $waktu }}</span>
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
                            {{ $statusText }}
                        </span>
                    </span>
                </div>
            </div>
        </div>

        <div class="right">
            <div class="info-section">
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

        <div class="financial-row" style="border-top: 2px solid #007bff; padding-top: 8px; margin-top: 10px;">
            <span class="financial-label" style="font-size: 14px;">Grand Total:</span>
            <span class="financial-value info" style="font-size: 16px;">Rp. {{ number_format($grandTotal, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="footer">
        <p><strong>Travelsya</strong> - Your Trusted Travel Partner</p>
        <p>This is a computer-generated invoice. No signature required.</p>
        <p>For inquiries, please contact our customer service.</p>
    </div>
</body>
</html>
