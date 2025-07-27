@extends('layouts.admin')

@section('title', 'Edit Inventaris')
@section('header_admin', 'Edit Inventaris')

@section('admin_content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8">
    <h2 class="text-2xl font-bold text-teal-700 mb-6 border-b pb-2">Edit Barang: {{ $item->name }}</h2>

    <form action="{{ route('items.edit', $item) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Nama Barang --}}
        <div class="mb-4">
            <label for="name" class="block text-sm font-semibold text-gray-700">Nama Barang</label>
            <input type="text" name="name" id="name" value="{{ old('name', $item->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500">
        </div>

        {{-- Nomor Seri --}}
        <div class="mb-4">
            <label for="serial_number" class="block text-sm font-semibold text-gray-700">Nomor Seri</label>
            <input type="text" name="serial_number" id="serial_number" value="{{ old('serial_number', $item->serial_number) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500">
        </div>

        {{-- Kondisi --}}
        <div class="mb-4">
            <label for="condition" class="block text-sm font-semibold text-gray-700">Kondisi</label>
            <select name="condition" id="condition" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500">
                <option value="Baik" {{ $item->condition === 'Baik' ? 'selected' : '' }}>Baik</option>
                <option value="Rusak" {{ $item->condition === 'Rusak' ? 'selected' : '' }}>Rusak</option>
            </select>
        </div>

        {{-- Status --}}
        <div class="mb-4">
            <label for="status" class="block text-sm font-semibold text-gray-700">Status</label>
            <select name="status" id="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500">
                @foreach (['Tersedia', 'Dipinjam', 'Rusak', 'Hilang'] as $status)
                    <option value="{{ $status }}" {{ $item->status === $status ? 'selected' : '' }}>{{ $status }}</option>
                @endforeach
            </select>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label for="description" class="block text-sm font-semibold text-gray-700">Deskripsi</label>
            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ old('description', $item->description) }}</textarea>
        </div>

        {{-- Pilih Kamar --}}
        <div class="mb-4">
            <label for="room_id" class="block text-sm font-semibold text-gray-700">Kamar</label>
            <select name="room_id" id="room_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500">
                <option value="">-- Pilih Kamar --</option>
                @foreach ($rooms as $room)
                    <option value="{{ $room->id }}" {{ $item->room_id == $room->id ? 'selected' : '' }}>
                        Kamar {{ $room->room_number }} ({{ ucfirst($room->gender_type) }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Pilih Santri --}}
        <div class="mb-6">
            <label for="assigned_to_student_id" class="block text-sm font-semibold text-gray-700">Santri Pemegang Barang</label>
            <select name="assigned_to_student_id" id="assigned_to_student_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500">
                <option value="">-- Tidak ada --</option>
                @foreach ($students as $student)
                    <option value="{{ $student->id }}" {{ $item->assigned_to_student_id == $student->id ? 'selected' : '' }}>
                        {{ $student->name }} ({{ $student->nis }})
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tombol Submit --}}
        <div class="text-right">
            <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-full font-semibold hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 transition">
                Simpan Perubahan
            </button>
        </div>
    </form>
</div>
@endsection
