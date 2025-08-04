@extends('layouts.admin')

@section('title', 'Data Pembayaran')

@section('admin_content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Data Pembayaran Santri</h1>
    <p class="text-gray-500 mt-1">Kelola dan lihat riwayat semua transaksi pembayaran santri.</p>
</div>

@if (session('success'))
    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg shadow-sm" role="alert">
        {{ session('success') }}
    </div>
@endif

<div class="flex flex-col md:flex-row md:justify-between items-start md:items-center mb-6 gap-4">
    @can('create payments')
        <a href="{{ route('admin.payments.create') }}"
           class="w-full md:w-auto px-6 py-3 bg-teal-600 text-white font-semibold rounded-lg shadow-md hover:bg-teal-700 transition-colors flex items-center justify-center gap-2">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd" />
            </svg>
            Tambah Pembayaran
        </a>
    @endcan
    
    <div class="w-full md:w-auto">
        <form method="GET" class="flex flex-wrap items-center gap-4">
            <select name="category_id" class="form-select border-gray-300 rounded-lg shadow-sm w-full md:w-auto">
                <option value="">Semua Kategori</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        
            <input type="text" name="student_name" value="{{ request('student_name') }}"
                   class="form-input border-gray-300 rounded-lg shadow-sm w-full md:w-auto" placeholder="Cari nama santri...">
        
            <input type="text" name="month" id="month_filter"
                   value="{{ request('month') }}"
                   class="form-input border-gray-300 rounded-lg shadow-sm w-full md:w-auto" placeholder="Bulan (cth: Januari 2025)">
        
            <div class="flex gap-2 w-full md:w-auto">
                <button type="submit"
                        class="px-5 py-2 bg-teal-600 text-white rounded-lg font-semibold hover:bg-teal-700 transition-colors w-1/2 md:w-auto">
                    Filter
                </button>
                <a href="{{ route('admin.payments.index') }}"
                   class="px-5 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition-colors w-1/2 md:w-auto">
                    Reset
                </a>
            </div>
        </form>
    </div>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-50 text-left text-sm font-semibold text-gray-600">
                <tr>
                    <th class="p-4">#</th>
                    <th class="p-4">Nama Santri</th>
                    <th class="p-4">Kategori</th>
                    <th class="p-4">Bulan</th>
                    <th class="p-4">Nominal</th>
                    <th class="p-4">Tanggal</th>
                    <th class="p-4">Metode</th>
                    <th class="p-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm text-gray-800 divide-y divide-gray-200">
                @forelse ($payments as $payment)
                    <tr class="hover:bg-gray-50">
                        <td class="p-4">{{ $loop->iteration + ($payments->firstItem() - 1) }}</td>
                        <td class="p-4 font-medium text-gray-900">{{ $payment->student->name }}</td>
                        <td class="p-4">{{ $payment->category->name }}</td>
                        <td class="p-4">{{ $payment->month ?? '-' }}</td>
                        <td class="p-4 font-semibold text-teal-600">Rp {{ number_format($payment->amount, 0, ',', '.') }}</td>
                        <td class="p-4">{{ $payment->paid_at->format('d M Y') }}</td>
                        <td class="p-4">{{ $payment->method ?? '-' }}</td>
                        <td class="p-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.payments.show', $payment->id) }}"
                                   class="text-blue-600 hover:text-blue-800 transition-colors" title="Detail">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                      <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                      <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                @can('edit payments')
                                    <a href="{{ route('admin.payments.edit', $payment) }}"
                                       class="text-green-600 hover:text-green-800 transition-colors" title="Edit">
                                       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                          <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </a>
                                @endcan
                                @can('delete payments')
                                    <form method="POST" action="{{ route('admin.payments.destroy', $payment) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition-colors" title="Hapus">
                                           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                              <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                @endcan
                                <a href="{{ route('admin.payments.receipt', $payment->id) }}"
                                   class="text-gray-600 hover:text-gray-800 transition-colors" title="Cetak Struk" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                       <path fill-rule="evenodd" d="M5 2a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V4a2 2 0 00-2-2H5zm0 2h10v12H5V4z" clip-rule="evenodd" />
                                       <path fill-rule="evenodd" d="M6 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm0 3a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 4a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                    </svg>
                                </a>
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
</div>

<div class="flex justify-between items-center mt-6">
    @if ($payments->count())
        <div class="text-lg font-semibold text-gray-700">
            Total Seluruhnya: <span class="text-teal-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>
    @endif
    {{ $payments->withQueryString()->links() }}
</div>

@endsection