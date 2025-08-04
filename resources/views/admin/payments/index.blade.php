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

{{-- Wrapper untuk Tombol Aksi dan Filter --}}
<div class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">

    {{-- Grup Tombol Aksi --}}
    <div class="flex gap-4 w-full md:w-auto">
        @can('create payments')
            <a href="{{ route('admin.payments.create') }}"
               class="w-full md:w-auto px-3 py-2 bg-teal-600 text-white font-semibold rounded-lg shadow-md hover:bg-teal-700 transition-colors flex items-center justify-center gap-2">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                 <path d="M12 5v14M5 12h14"/>
               </svg>
                Tambah Pembayaran
            </a>
        @endcan

        {{-- Tombol Export Excel --}}
        <a href="{{ route('admin.payments.export', request()->query()) }}"
           class="w-full md:w-auto px-3 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition-colors flex items-center justify-center gap-2">
           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
             <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M7 10l5 5 5-5M12 15V3"/>
           </svg>
           Export Excel
        </a>
    </div>
    
    {{-- Form Filter --}}
    <div class="w-full md:w-auto mt-4 md:mt-0">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                      <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                      <circle cx="12" cy="12" r="3"/>
                                    </svg>
                                </a>
                                @can('edit payments')
                                    <a href="{{ route('admin.payments.edit', $payment) }}"
                                       class="text-green-600 hover:text-green-800 transition-colors" title="Edit">
                                       <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                         <path d="M17 3a2.828 2.828 0 114 4L7.5 20.5 2 22l1.5-5.5L17 3z"/>
                                       </svg>
                                    </a>
                                @endcan
                                @can('delete payments')
                                    <form method="POST" action="{{ route('admin.payments.destroy', $payment) }}"
                                          onsubmit="return confirm('Yakin ingin menghapus pembayaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 transition-colors" title="Hapus">
                                           <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                             <path d="M3 6h18M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a2 2 0 012-2h4a2 2 0 012 2v2M10 11v6M14 11v6"/>
                                           </svg>
                                        </button>
                                    </form>
                                @endcan
                                <a href="{{ route('admin.payments.receipt', $payment->id) }}"
                                   class="text-gray-600 hover:text-gray-800 transition-colors" title="Cetak Struk" target="_blank">
                                   <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                      <path d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12M6 22h12v-5H6v5z"/>
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
        <div class="flex items-center text-lg font-semibold text-gray-700">
            Total Seluruhnya:
            <span id="totalAmount" class="text-teal-600 font-bold ml-2 blur-sm transition-all duration-300">
                Rp {{ number_format($total, 0, ',', '.') }}
            </span>
            <button id="toggleTotal" class="ml-2 text-gray-400 hover:text-gray-600 focus:outline-none transition-colors">
                <svg id="eyeOpenIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                  <circle cx="12" cy="12" r="3"/>
                </svg>
                <svg id="eyeClosedIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M17.94 17.94A10.07 10.07 0 0112 20c-7 0-11-8-11-8a18.45 18.45 0 015.06-5.94M9.9 4.24A1.9 1.9 0 0112 4c7 0 11 8 11 8a18.45 18.45 0 01-2.92 5.06M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                  <line x1="1" y1="1" x2="23" y2="23"/>
                </svg>
            </button>
        </div>
    @endif
    {{ $payments->withQueryString()->links() }}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggleTotal');
        const totalAmountSpan = document.getElementById('totalAmount');
        const eyeOpenIcon = document.getElementById('eyeOpenIcon');
        const eyeClosedIcon = document.getElementById('eyeClosedIcon');

        if (toggleButton && totalAmountSpan && eyeOpenIcon && eyeClosedIcon) {
            toggleButton.addEventListener('click', function() {
                // Mengganti kelas blur pada teks total
                totalAmountSpan.classList.toggle('blur-sm');

                // Mengganti ikon mata
                eyeOpenIcon.classList.toggle('hidden');
                eyeClosedIcon.classList.toggle('hidden');
            });
        }
    });
</script>
@endsection