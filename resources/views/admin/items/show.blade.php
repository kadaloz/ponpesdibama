@extends('layouts.admin')

@section('title', 'Detail Inventaris')
@section('admin_content')
    <h1 class="text-2xl font-bold mb-4">Detail Inventaris</h1>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <p><strong>Nama Barang:</strong> {{ $item->name }}</p>
        <p><strong>Kondisi:</strong> {{ $item->condition }}</p>
        <p><strong>Status:</strong> {{ $item->status }}</p>
        <p><strong>Nomor Seri:</strong> {{ $item->serial_number ?? '-' }}</p>
        <p><strong>Deskripsi:</strong> {{ $item->description ?? '-' }}</p>
    </div>

    <div class="mt-6">
        <a href="{{ route('admin.rooms.show', $item->room_id) }}" class="inline-block px-4 py-2 bg-gray-200 rounded-full text-sm font-semibold hover:bg-gray-300">
            ← Kembali ke Detail Kamar
        </a>
    </div>
@endsection
