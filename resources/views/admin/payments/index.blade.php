@extends('layouts.admin')

@section('title', 'Data Pembayaran')

@section('admin_content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Data Pembayaran Santri</h1>
    <p class="text-gray-600 text-sm">Riwayat semua transaksi pembayaran santri.</p>
</div>

{{-- Flash Message --}}
@if (session('success'))
    <div class="mb-4 bg-green-100 text-green-800 px-4 py-2 rounded shadow">
        {{ session('success') }}
    </div>
@endif

{{-- Tombol Tambah --}}
@can('create payments')
    <div class="mb-4">
        <a href="{{ route('admin.payments.create') }}"
           class="inline-block px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">
            + Tambah Pembayaran
        </a>
    </div>
@endcan

{{-- Filter --}}
<form method="GET" class="mb-6 bg-white p-4 rounded shadow-md flex flex-wrap gap-4">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
        <select name="category_id" class="form-select border-gray-300 rounded w-full">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nama Santri</label>
        <input type="text" name="student_name" value="{{ request('student_name') }}"
               class="form-input border-gray-300 rounded w-full" placeholder="Cari nama santri...">
    </div>

        {{-- Filter Bulan --}}
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
        <input type="text" name="month" id="month_filter"
               value="{{ request('month') }}"
               class="form-input border-gray-300 rounded w-full" placeholder="Contoh: Januari 2025">
    </div>

    <div class="self-end">
        <button type="submit"
                class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">
            Filter
        </button>
        <a href="{{ route('admin.payments.index') }}"
           class="ml-2 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">
            Reset
        </a>
    </div>
</form>


{{-- Tabel Pembayaran --}}
<div class="overflow-x-auto bg-white rounded shadow">
    <table class="min-w-full table-auto border-collapse">
        <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
            <tr>
                <th class="p-3 border-b">#</th>
                <th class="p-3 border-b">Nama Santri</th>
                <th class="p-3 border-b">Kategori</th>
                <th class="p-3 border-b">Bulan</th>
                <th class="p-3 border-b">Nominal</th>
                <th class="p-3 border-b">Metode</th>
                <th class="p-3 border-b">Tanggal</th>
                <th class="p-3 border-b text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="text-sm text-gray-800 divide-y divide-gray-100">
            @forelse ($payments as $payment)
                <tr>
                    <td class="p-3">{{ $loop->iteration + ($payments->firstItem() - 1) }}</td>
                    <td class="p-3">{{ $payment->student->name }}</td>
                    <td class="p-3">{{ $payment->category->name }}</td>
                    <td class="p-3">{{ $payment->month ?? '-' }}</td>
                    <td class="p-3">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                    <td class="p-3">{{ $payment->method ?? '-' }}</td>
                    <td class="p-3">{{ $payment->paid_at->format('d M Y') }}</td>
                    <td class="p-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            {{-- Tombol Cetak --}}
                            <a href="{{ route('admin.payments.receipt', $payment->id) }}"
                                class="text-sm text-teal-600 hover:underline" target="_blank">🧾 Cetak Struk
                            </a>

                            @can('edit payments')
                                <a href="{{ route('admin.payments.edit', $payment) }}"
                                   class="text-blue-600 hover:underline text-sm">Edit</a>
                            @endcan

                            @can('delete payments')
                                <form method="POST" action="{{ route('admin.payments.destroy', $payment) }}"
                                      onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline text-sm">
                                        Hapus
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="p-4 text-center text-gray-500">Belum ada data pembayaran.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

{{-- Pagination --}}
<div class="mt-6">
    {{ $payments->withQueryString()->links() }}
</div>

{{-- Total Pembayaran --}}
@if ($payments->count())
    <div class="mt-4 text-right text-gray-700 font-semibold">
        Total Seluruhnya: Rp {{ number_format($total, 0, ',', '.') }}
    </div>
@endif
@endsection
