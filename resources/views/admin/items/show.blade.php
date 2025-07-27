@extends('layouts.admin')

@section('title', 'Detail Inventaris')
@section('header_admin', 'Detail Inventaris')

@section('admin_content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-lg p-8">
    <h2 class="text-3xl font-extrabold text-teal-700 mb-6 border-b pb-3 flex items-center">
        <x-heroicon-o-clipboard-document-list class="w-6 h-6 mr-2 text-teal-600" />
        Detail Barang: {{ $item->name }}
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-5 text-gray-800 text-sm">
        <div>
            <p class="font-semibold text-gray-600">Nama Barang</p>
            <p class="text-base text-gray-900">{{ $item->name }}</p>
        </div>

        <div>
            <p class="font-semibold text-gray-600">Nomor Seri</p>
            <p class="text-base text-gray-900">{{ $item->serial_number ?? '-' }}</p>
        </div>

        <div>
            <p class="font-semibold text-gray-600">Kondisi</p>
            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                {{ $item->condition }}
            </span>
        </div>

        <div>
            <p class="font-semibold text-gray-600">Status</p>
            <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{
                ['Tersedia' => 'bg-green-100 text-green-800', 'Dipinjam' => 'bg-yellow-100 text-yellow-800', 'Rusak' => 'bg-red-100 text-red-800', 'Hilang' => 'bg-gray-100 text-gray-800'][$item->status] ?? 'bg-blue-100 text-blue-800'
            }}">
                {{ $item->status }}
            </span>
        </div>

        <div>
            <p class="font-semibold text-gray-600">Ditugaskan kepada Santri</p>
            @if($item->assignedToStudent)
                <p class="text-gray-700">
                    {{ $item->assignedToStudent->name }}  
                    (NIS: {{ $item->assignedToStudent->nis ?? '-' }})
                </p>
            @else
                <p class="text-gray-500 italic">Belum ditugaskan</p>
            @endif
        </div>

        <div class="md:col-span-2">
            <p class="font-semibold text-gray-600">Deskripsi</p>
            <p class="text-gray-700">{{ $item->description ?? '-' }}</p>
        </div>
    </div>

    <div class="mt-8 flex justify-between items-center border-t pt-6">
        <a href="{{ route('admin.rooms.show', $item->room_id) }}" class="inline-flex items-center px-5 py-2 bg-gray-100 rounded-full text-sm font-semibold text-gray-700 hover:bg-gray-200 transition">
            <x-heroicon-o-arrow-left class="w-4 h-4 mr-2" />
            Kembali ke Detail Kamar
        </a>

        @can('edit items')
        <a href="{{ route('admin.items.edit', $item) }}" class="inline-flex items-center px-5 py-2 bg-indigo-600 text-white rounded-full text-sm font-semibold hover:bg-indigo-700 transition">
            <x-heroicon-o-pencil-square class="w-4 h-4 mr-2" />
            Edit Barang
        </a>
        @endcan
    </div>
</div>
@endsection
