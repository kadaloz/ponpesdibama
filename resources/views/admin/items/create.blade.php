{{-- resources/views/admin/items/create.blade.php --}}

@extends('layouts.admin')

@section('title', 'Tambah Inventaris Baru')
@section('header_admin', 'Tambah Inventaris Baru')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900">
            <h3 class="text-3xl font-extrabold text-teal-700 mb-8 text-center border-b pb-4">Form Tambah Inventaris</h3>

            <form action="{{ route('admin.items.store') }}" method="POST">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 p-6 bg-blue-50 rounded-lg border border-blue-200">
                    <div>
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Barang:</label>
                        <input type="text" name="name" id="name" class="form-input mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('name') }}" required>
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="serial_number" class="block text-gray-700 text-sm font-bold mb-2">Nomor Seri (Opsional):</label>
                        <input type="text" name="serial_number" id="serial_number" class="form-input mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('serial_number') }}">
                        @error('serial_number')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Deskripsi / Keterangan:</label>
                        <textarea name="description" id="description" rows="3" class="form-textarea mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="condition" class="block text-gray-700 text-sm font-bold mb-2">Kondisi Barang:</label>
                        <select name="condition" id="condition" class="form-select mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            <option value="">Pilih Kondisi</option>
                            <option value="Baik" {{ old('condition') == 'Baik' ? 'selected' : '' }}>Baik</option>
                            <option value="Rusak Ringan" {{ old('condition') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                            <option value="Rusak Berat" {{ old('condition') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                        </select>
                        @error('condition')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status" class="block text-gray-700 text-sm font-bold mb-2">Status Ketersediaan:</label>
                        <select name="status" id="status" class="form-select mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            <option value="">Pilih Status</option>
                            <option value="Tersedia" {{ old('status') == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                            <option value="Dipinjam" {{ old('status') == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                            <option value="Rusak" {{ old('status') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                            <option value="Hilang" {{ old('status') == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="acquisition_date" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Perolehan (Opsional):</label>
                        <input type="date" name="acquisition_date" id="acquisition_date" class="form-input mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('acquisition_date') }}">
                        @error('acquisition_date')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="room_id" class="block text-gray-700 text-sm font-bold mb-2">Lokasi Kamar (Opsional):</label>
                        <select name="room_id" id="room_id" class="form-select mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Tidak Ditentukan</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" {{ old('room_id', $selectedRoomId) == $room->id ? 'selected' : '' }}>
                                    {{ $room->room_number }}
                                </option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- NEW: Dropdown for assigning to student --}}
                    <div>
                        <label for="assigned_to_student_id" class="block text-gray-700 text-sm font-bold mb-2">Ditugaskan ke Santri (Opsional):</label>
                        <select name="assigned_to_student_id" id="assigned_to_student_id" class="form-select mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <option value="">Tidak Ditugaskan</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}" {{ old('assigned_to_student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }} ({{ $student->nis }})
                                </option>
                            @endforeach
                        </select>
                        @error('assigned_to_student_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex justify-end space-x-4 mt-8 border-t pt-6">
                    <a href="{{ url()->previous() }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-full font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                        <x-heroicon-o-arrow-left class="w-4 h-4 mr-2 -ml-1" />
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                        <x-heroicon-o-check class="w-4 h-4 mr-2 -ml-1" />
                        Simpan Barang
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection