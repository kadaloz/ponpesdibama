{{-- resources/views/admin/teachers/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Tambah Pengajar Baru')
@section('header_admin', 'Tambah Data Pengajar Baru')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form action="{{ route('admin.teachers.store') }}" method="POST" class="space-y-6">
                @csrf

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Informasi Pengajar</h3>

                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="full_name" id="full_name" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm" value="{{ old('full_name') }}" required>
                    @error('full_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="nip" class="block text-sm font-medium text-gray-700">NIP (Opsional)</label>
                    <input type="text" name="nip" id="nip" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm" value="{{ old('nip') }}">
                    @error('nip')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Tempat Lahir (Opsional)</label>
                        <input type="text" name="place_of_birth" id="place_of_birth" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm" value="{{ old('place_of_birth') }}">
                        @error('place_of_birth')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm" value="{{ old('date_of_birth') }}">
                        @error('date_of_birth')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="phone_number" class="block text-sm font-medium text-gray-700">No. HP (Opsional)</label>
                        <input type="text" name="phone_number" id="phone_number" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm" value="{{ old('phone_number') }}">
                        @error('phone_number')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label for="specialization" class="block text-sm font-medium text-gray-700">Spesialisasi (Opsional)</label>
                    <input type="text" name="specialization" id="specialization" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm" value="{{ old('specialization') }}">
                    @error('specialization')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="join_date" class="block text-sm font-medium text-gray-700">Tanggal Bergabung</label>
                        <input type="date" name="join_date" id="join_date" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm" value="{{ old('join_date') }}">
                        @error('join_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm" required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Non-Aktif</option>
                        </select>
                        @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div class="pt-4 border-t border-gray-200">
                    <label for="user_id" class="block text-sm font-medium text-gray-700">Hubungkan Akun Pengguna (Opsional)</label>
                    <p class="text-sm text-gray-600 mb-2">Hanya akun dengan peran 'mudabbir' yang belum digunakan.</p>
                    <select name="user_id" id="user_id" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm">
                        <option value="">Tidak Dihubungkan</option>
                        @foreach ($unassignedUsers ?? [] as $user)
                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('admin.teachers.index') }}" class="px-4 py-2 bg-gray-200 rounded-md text-sm">Batal</a>
                    <button type="submit" class="ml-2 px-4 py-2 bg-teal-500 text-white rounded-md text-sm hover:bg-teal-600">
                        Simpan Pengajar
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
