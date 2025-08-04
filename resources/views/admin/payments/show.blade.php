@extends('layouts.admin')

@section('title', 'Detail Pembayaran')

@section('header_admin', 'Detail Pembayaran')

@section('admin_content')
<div class="bg-white rounded shadow p-6">
    <div class="mb-6 text-sm text-gray-700">
        <strong>Nomor Induk Santri:</strong> {{ $payment->student->nis }} <br>
        <strong>Nama Santri:</strong> {{ $payment->student->name }} <br>
        <strong>Tanggal Bayar:</strong> {{ \Carbon\Carbon::parse($payment->paid_at)->format('d F Y') }} <br>
        <strong>Kategori:</strong> {{ $payment->category->name }} <br>
        <strong>Bulan:</strong> {{ $payment->month ?? '-' }} <br>
        <strong>Jumlah:</strong> Rp {{ number_format($payment->amount, 0, ',', '.') }} <br>
        <strong>Metode:</strong> {{ $payment->method }} <br>
        <strong>Catatan:</strong> {{ $payment->note ?? '-' }} <br>
        <strong>Ditambahkan oleh:</strong> {{ $payment->user->name ?? '-' }}
    </div>

    <div class="flex gap-2">
        <a href="{{ route('admin.payments.index') }}" class="btn btn-secondary">← Kembali</a>
        <a href="{{ route('admin.payments.print', $payment) }}" target="_blank" class="btn btn-primary">🧾 Cetak Struk</a>
    </div>
</div>
@endsection
