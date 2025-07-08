<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran - {{ $applicant->registration_number }}</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .barcode { text-align: center; margin-top: 20px; }
        .section { margin-bottom: 15px; }
        .label { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Bukti Pendaftaran</h2>
        <p>Ponpes Diniyah Baitul Makmur Aikmel</p>
    </div>

    <div class="section">
        <p><span class="label">Nomor Pendaftaran:</span> {{ $applicant->registration_number }}</p>
        <p><span class="label">Nama Lengkap:</span> {{ $applicant->full_name }}</p>
        <p><span class="label">Tempat, Tanggal Lahir:</span> {{ $applicant->place_of_birth }}, {{ $applicant->date_of_birth->format('d M Y') }}</p>
        <p><span class="label">Alamat:</span> {{ $applicant->address }}, {{ $applicant->village }}, {{ $applicant->district }}, {{ $applicant->city }}, {{ $applicant->province }}</p>
        <p><span class="label">Tipe Santri:</span> {{ $applicant->ppdb_type }}</p>
    </div>

    <div class="barcode">
        {!! DNS1D::getBarcodeHTML($applicant->registration_number, 'C128', 2, 60) !!}
        <p>{{ $applicant->registration_number }}</p>
    </div>

    <p style="margin-top: 30px;">Silakan simpan dan cetak bukti ini untuk proses daftar ulang.</p>
</body>
</html>
