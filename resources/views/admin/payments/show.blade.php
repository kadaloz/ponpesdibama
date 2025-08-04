@extends('layouts.admin')

@section('title', 'Detail Pembayaran')

@section('header_admin', 'Detail Pembayaran')

@section('admin_content')
<div class="bg-white rounded-xl shadow-lg p-6 md:p-8">
    <div class="border-b pb-4 mb-6">
        <h3 class="text-2xl font-bold text-gray-800">Detail Pembayaran</h3>
        <p class="text-sm text-gray-500">Informasi lengkap transaksi pembayaran santri.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 text-gray-700 mb-8">
        {{-- Kolom Kiri --}}
        <div>
            <div class="mb-4">
                <p class="text-sm font-semibold text-gray-600">Nomor Induk Santri</p>
                <p class="text-lg font-medium">{{ $payment->student->nis }}</p>
            </div>
            <div class="mb-4">
                <p class="text-sm font-semibold text-gray-600">Nama Santri</p>
                <p class="text-lg font-medium">{{ $payment->student->name }}</p>
            </div>
            <div class="mb-4">
                <p class="text-sm font-semibold text-gray-600">Tanggal Bayar</p>
                <p class="text-lg font-medium">{{ \Carbon\Carbon::parse($payment->paid_at)->isoFormat('dddd, D MMMM Y') }}</p>
            </div>
            <div class="mb-4">
                <p class="text-sm font-semibold text-gray-600">Jumlah Pembayaran</p>
                <p class="text-xl font-bold text-teal-600">Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
            </div>
        </div>

        {{-- Kolom Kanan --}}
        <div>
            <div class="mb-4">
                <p class="text-sm font-semibold text-gray-600">Kategori Pembayaran</p>
                <p class="text-lg font-medium">{{ $payment->category->name }}</p>
            </div>
            <div class="mb-4">
                <p class="text-sm font-semibold text-gray-600">Bulan</p>
                <p class="text-lg font-medium">{{ $payment->month ?? '-' }}</p>
            </div>
            <div class="mb-4">
                <p class="text-sm font-semibold text-gray-600">Metode Pembayaran</p>
                <p class="text-lg font-medium">{{ $payment->method }}</p>
            </div>
            <div class="mb-4">
                <p class="text-sm font-semibold text-gray-600">Catatan</p>
                <p class="text-lg font-medium">{{ $payment->note ?? '-' }}</p>
            </div>
            <div class="mb-4">
                <p class="text-sm font-semibold text-gray-600">Ditambahkan oleh</p>
                <p class="text-lg font-medium">{{ $payment->user->name ?? '-' }}</p>
            </div>
        </div>
    </div>

    <hr class="my-6">

    <div class="flex flex-col md:flex-row gap-2 mt-6">
        <a href="{{ route('admin.payments.index') }}" class="w-full md:w-auto px-6 py-2 border border-gray-300 rounded-lg text-gray-700 font-semibold text-center hover:bg-gray-100 transition-colors">
            ← Kembali
        </a>
        <a href="{{ route('admin.payments.receipt', $payment) }}" target="_blank" class="w-full md:w-auto px-6 py-2 bg-teal-600 text-white rounded-lg font-semibold text-center hover:bg-teal-700 transition-colors flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M5 2a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2H5zm0 2h10v12H5V4zm0 2a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm0 3a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1zm1 4a1 1 0 100 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
            </svg>
            Cetak Struk
        </a>
    </div>
</div>
@endsection