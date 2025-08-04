<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            color: #000;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 6px 8px;
            border: 1px solid #ddd;
            text-align: left;
        }
        .center {
            text-align: center;
        }
        .logo {
            height: 70px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

    {{-- Header dan Logo --}}
<div class="center">
    <img src="{{ public_path('storage/images/logo/pondok.jpg') }}" alt="Logo Pondok" class="logo">
    <h2>Struk Pembayaran</h2>
    <p><strong>Pondok Pesantren DIBAMA</strong></p>
</div>
    <hr>

    {{-- Tabel Info Pembayaran --}}
    <table>
        <tr>
            <th>Nomor Induk Santri</th>
            <td>{{ $payment->student->nis }}</td>
        <tr>
            <th>Nama Santri</th>
            <td>{{ $payment->student->name }}</td>
        </tr>
        <tr>
            <th>Tanggal Bayar</th>
            <td>{{ \Carbon\Carbon::parse($payment->paid_at)->format('d F Y') }}</td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td>{{ $payment->category->name }}</td>
        </tr>
        <tr>
            <th>Bulan</th>
            <td>{{ $payment->month ?? '-' }}</td>
        </tr>
        <tr>
            <th>Jumlah</th>
            <td>Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <th>Metode</th>
            <td>{{ $payment->method }}</td>
        </tr>
        <tr>
            <th>Catatan</th>
            <td>{{ $payment->note ?? '-' }}</td>
        </tr>
    </table>

    {{-- Petugas --}}
    <p style="text-align:right; margin-top:30px;">Petugas: {{ auth()->user()->name }}</p>

    {{-- QR Code --}}
<div class="center" style="margin-top: 30px;">
    <p>Scan untuk verifikasi pembayaran:</p>
    <img src="data:image/png;base64,{{ $qr }}" alt="QR Code" style="margin-top: 10px;">
</div>

</body>
</html>
