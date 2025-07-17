@extends('layouts.admin')

@section('title', 'Edit Kamar Asrama')
@section('header_admin', 'Edit Kamar Asrama')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-2xl font-bold text-teal-700 mb-6">Form Edit Kamar: {{ $room->room_number }}</h3>

            <form action="{{ route('admin.rooms.update', $room) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="room_number" class="block text-sm font-medium text-gray-700">Nomor / Nama Kamar <span class="text-red-500">*</span></label>
                        <input type="text" name="room_number" id="room_number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-teal-500 focus:border-teal-500 @error('room_number') border-red-500 @enderror" value="{{ old('room_number', $room->room_number) }}" required>
                        @error('room_number')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="capacity" class="block text-sm font-medium text-gray-700">Kapasitas Santri <span class="text-red-500">*</span></label>
                        <input type="number" name="capacity" id="capacity" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-teal-500 focus:border-teal-500 @error('capacity') border-red-500 @enderror" value="{{ old('capacity', $room->capacity) }}" min="1" required>
                        @error('capacity')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="gender_type" class="block text-sm font-medium text-gray-700">Jenis Kelamin Penghuni <span class="text-red-500">*</span></label>
                        <select name="gender_type" id="gender_type" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-teal-500 focus:border-teal-500 @error('gender_type') border-red-500 @enderror" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="banin" {{ old('gender_type', $room->gender_type) == 'banin' ? 'selected' : '' }}>Banin (Laki-laki)</option>
                            <option value="banat" {{ old('gender_type', $room->gender_type) == 'banat' ? 'selected' : '' }}>Banat (Perempuan)</option>
                        </select>
                        @error('gender_type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status Kamar <span class="text-red-500">*</span></label>
                        <select name="status" id="status" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-teal-500 focus:border-teal-500 @error('status') border-red-500 @enderror" required>
                            <option value="">Pilih Status</option>
                            <option value="available" {{ old('status', $room->status) == 'available' ? 'selected' : '' }}>Tersedia</option>
                            <option value="full" {{ old('status', $room->status) == 'full' ? 'selected' : '' }}>Penuh</option>
                            <option value="renovation" {{ old('status', $room->status) == 'renovation' ? 'selected' : '' }}>Renovasi</option>
                            <option value="inactive" {{ old('status', $room->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi / Fasilitas Tambahan</label>
                        <textarea name="description" id="description" rows="3" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-teal-500 focus:border-teal-500 @error('description') border-red-500 @enderror">{{ old('description', $room->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('admin.rooms.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <x-heroicon-o-arrow-path class="w-4 h-4 mr-2" /> Perbarui Kamar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection