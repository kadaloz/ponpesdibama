@extends('layouts.admin')

@section('title', 'Detail Inventaris')
@section('header_admin', 'Detail Inventaris')

@section('admin_content')
<div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-2xl shadow-md p-6 sm:p-8 transition-all">
    <h2 class="text-2xl sm:text-3xl font-bold text-teal-700 dark:text-teal-400 flex items-center border-b border-gray-200 dark:border-gray-600 pb-4 mb-6">
        <x-heroicon-o-clipboard-document-list class="w-6 h-6 mr-2" />
        Detail Barang: {{ $item->name }}
    </h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm sm:text-base text-gray-800 dark:text-gray-100">
        <div>
            <p class="font-medium text-gray-500 dark:text-gray-300">Nama Barang</p>
            <p class="font-semibold">{{ $item->name }}</p>
        </div>

        <div>
            <p class="font-medium text-gray-500 dark:text-gray-300">Nomor Seri</p>
            <p class="font-semibold">{{ $item->serial_number ?? '-' }}</p>
        </div>

        <div>
            <p class="font-medium text-gray-500 dark:text-gray-300">Kondisi</p>
            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-100">
                {{ $item->condition }}
            </span>
        </div>

        <div>
            <p class="font-medium text-gray-500 dark:text-gray-300">Status</p>
            @php
                $statusColors = [
                    'Tersedia' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100',
                    'Dipinjam' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-100',
                    'Rusak'    => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-100',
                    'Hilang'   => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200',
                ];
            @endphp
            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $statusColors[$item->status] ?? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-100' }}">
                {{ $item->status }}
            </span>
        </div>

        <div class="sm:col-span-2">
            <p class="font-medium text-gray-500 dark:text-gray-300">Ditugaskan kepada Santri</p>
            @if($item->assignedToStudent)
                <p class="font-semibold">
                    {{ $item->assignedToStudent->name }}  
                    (NIS: {{ $item->assignedToStudent->nis ?? '-' }})
                </p>
            @else
                <p class="italic text-gray-400 dark:text-gray-500">Belum ditugaskan</p>
            @endif
        </div>

        <div class="sm:col-span-2">
            <p class="font-medium text-gray-500 dark:text-gray-300">Deskripsi</p>
            <p class="text-gray-700 dark:text-gray-200">{{ $item->description ?? '-' }}</p>
        </div>
    </div>

    <div class="mt-8 flex flex-col sm:flex-row sm:justify-between items-stretch sm:items-center gap-3 border-t border-gray-200 dark:border-gray-700 pt-6">
        <a href="{{ route('admin.rooms.show', $item->room_id) }}"
           class="inline-flex items-center justify-center px-5 py-2 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 dark:text-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 transition-all">
            <x-heroicon-o-arrow-left class="w-4 h-4 mr-2" />
            Kembali ke Detail Kamar
        </a>

        @can('edit items')
        <a href="{{ route('admin.items.edit', $item) }}"
           class="inline-flex items-center justify-center px-5 py-2 rounded-lg text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none dark:bg-indigo-500 dark:hover:bg-indigo-600 transition-all">
            <x-heroicon-o-pencil-square class="w-4 h-4 mr-2" />
            Edit Barang
        </a>
        @endcan
    </div>
</div>
@endsection
