<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Invoice - GOR Jimmy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #1e3c72;
            --primary-dark: #152b52;
            --accent: #ff6b6b;
            --success: #16a34a;
            --pending: #facc15;
            --danger: #dc2626;
            --bg: #f1f5f9;
            --text-dark: #1e293b;
            --text-muted: #64748b;
            --white: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            color: var(--text-dark);
            line-height: 1.6;
            padding: 40px 20px;
        }

        .invoice-card {
            max-width: 800px;
            margin: 0 auto;
            background: var(--white);
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(30, 60, 114, 0.1);
            overflow: hidden;
            position: relative;
        }

        .invoice-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: var(--white);
            padding: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: relative;
        }

        .invoice-header::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 100%;
            background: linear-gradient(to left, rgba(255,255,255,0.05), transparent);
        }

        .brand h1 {
            font-family: 'Poppins', sans-serif;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand h1 i {
            color: var(--accent);
        }

        .brand p {
            font-size: 14px;
            opacity: 0.8;
            letter-spacing: 0.5px;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 14px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .status-booked { color: #86efac; }
        .status-pending { color: #fef08a; }
        .status-selesai { color: #93c5fd; }
        .status-dibatalkan { color: #fca5a5; }

        .invoice-body {
            padding: 40px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
            margin-bottom: 40px;
        }

        .info-section h3 {
            font-size: 12px;
            text-transform: uppercase;
            color: var(--text-muted);
            letter-spacing: 1px;
            margin-bottom: 10px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
        }

        .info-content {
            font-size: 16px;
            font-weight: 600;
            color: var(--text-dark);
        }

        .info-content i {
            width: 20px;
            color: var(--primary);
            margin-right: 8px;
        }

        .table-responsive {
            margin-bottom: 30px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        th {
            background-color: #f8fafc;
            color: var(--text-muted);
            text-align: left;
            padding: 15px 20px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 1px;
        }

        td {
            padding: 15px 20px;
            border-top: 1px solid #e2e8f0;
            color: var(--text-dark);
            font-weight: 500;
        }

        .summary-section {
            background-color: #f8fafc;
            padding: 30px;
            border-radius: 15px;
            margin-top: 10px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            font-size: 15px;
        }

        .summary-row.total {
            margin-top: 15px;
            padding-top: 15px;
            border-top: 2px dashed #cbd5e1;
            font-size: 20px;
            font-weight: 700;
            color: var(--primary);
        }

        .invoice-footer {
            padding: 30px 40px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            background-color: #fcfcfc;
        }

        .footer-note {
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 25px;
        }

        .actions {
            display: flex;
            gap: 15px;
            justify-content: center;
        }

        .btn {
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-home {
            background-color: #e2e8f0;
            color: var(--text-dark);
        }

        .btn-home:hover {
            background-color: #cbd5e1;
            transform: translateY(-2px);
        }

        .btn-print {
            background-color: var(--primary);
            color: var(--white);
        }

        .btn-print:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30, 60, 114, 0.2);
        }

        @media (max-width: 640px) {
            .invoice-header {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media print {
            body {
                padding: 0;
                background: white;
            }

            .invoice-card {
                box-shadow: none;
                border-radius: 0;
                max-width: 100%;
            }

            .actions {
                display: none;
            }

            .invoice-header {
                background: white !important;
                color: black !important;
                border-bottom: 2px solid #000;
            }

            .brand h1 i {
                color: black !important;
            }

            .status-badge {
                border: 1px solid #000;
                color: black !important;
                background: none;
            }
        }
    </style>
</head>

<body>

    <div class="invoice-card">
        <div class="invoice-header">
            <div class="brand">
                <h1><i class="fas fa-shuttlecock"></i> GOR JIMMY</h1>
                <p>INVOICE #{{ $orderId }}</p>
            </div>
            <div class="status-badge status-{{ strtolower($booking->status) }}">
                {{ $booking->status }}
            </div>
        </div>

        <div class="invoice-body">
            <div class="info-grid">
                <div class="info-section">
                    <h3>Detail Pelanggan</h3>
                    <div class="info-content">
                        <p><i class="fas fa-user"></i> {{ $booking->nama }}</p>
                        <p><i class="fab fa-whatsapp"></i> {{ $booking->whatsapp }}</p>
                    </div>
                </div>
                <div class="info-section">
                    <h3>Informasi Lapangan</h3>
                    <div class="info-content">
                        <p><i class="fas fa-th-large"></i> {{ $booking->lap->nama }}</p>
                        <p><i class="fas fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('l, d F Y') }}</p>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>JADWAL WAKTU</th>
                            <th style="text-align: right;">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jadwal as $j)
                            <tr>
                                <td><i class="far fa-clock"></i> {{ $j->jad->waktu }}</td>
                                <td style="text-align: right;">
                                    <span style="font-weight: 700; color: {{ $j->status == 'Booked' ? 'var(--success)' : 'var(--text-muted)' }}">
                                        {{ $j->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="summary-section">
                <div class="summary-row">
                    <span style="color: var(--text-muted);">Uang Muka (DP)</span>
                    <span style="font-weight: 600;">Rp {{ number_format($booking->dp, 0, ',', '.') }}</span>
                </div>
                <div class="summary-row total">
                    <span>Total Pembayaran</span>
                    <span>Rp {{ number_format($booking->total_bayar, 0, ',', '.') }}</span>
                </div>
                <p style="margin-top: 10px; font-size: 13px; color: var(--text-muted); font-style: italic;">
                    Sisa pembayaran dilakukan di tempat saat kunjungan.
                </p>
            </div>
        </div>

        <div class="invoice-footer">
            <p class="footer-note">
                <i class="fas fa-heart" style="color: var(--accent);"></i> Terima kasih telah memilih <strong>GOR Jimmy</strong> untuk permainan Anda!
                <br>Harap tunjukkan invoice digital ini kepada petugas saat tiba di lokasi.
            </p>

            <div class="actions">
                <a href="{{ url('/') }}" class="btn btn-home">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
                <button onclick="window.print()" class="btn btn-print">
                    <i class="fas fa-print"></i> Cetak Invoice
                </button>
            </div>
        </div>
    </div>

</body>

</html>
