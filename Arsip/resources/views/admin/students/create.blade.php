{{-- resources/views/admin/students/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Tambah Santri Baru')

@section('header_admin', 'Tambah Santri Baru')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Data Santri</h3>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('name') }}" required>
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nis" class="block text-sm font-medium text-gray-700">Nomor Induk Santri (NIS) (Opsional, akan dibuat otomatis)</label>
                    <input type="text" name="nis" id="nis" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('nis') }}">
                    @error('nis')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select name="gender" id="gender" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('gender') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                        <input type="text" name="place_of_birth" id="place_of_birth" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('place_of_birth') }}">
                        @error('place_of_birth')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('date_of_birth') }}">
                        @error('date_of_birth')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="nisn" class="block text-sm font-medium text-gray-700">NISN (Nomor Induk Siswa Nasional) (Opsional)</label>
                    <input type="text" name="nisn" id="nisn" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('nisn') }}">
                    @error('nisn')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="last_education" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir (Opsional)</label>
                        <input type="text" name="last_education" id="last_education" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('last_education') }}">
                        @error('last_education')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="school_origin" class="block text-sm font-medium text-gray-700">Asal Sekolah (Opsional)</label>
                        <input type="text" name="school_origin" id="school_origin" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('school_origin') }}">
                        @error('school_origin')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Data Orang Tua / Wali</h3>
                <div>
                    <label for="parent_name" class="block text-sm font-medium text-gray-700">Nama Ayah / Wali (Opsional)</label>
                    <input type="text" name="parent_name" id="parent_name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('parent_name') }}">
                    @error('parent_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="parent_phone" class="block text-sm font-medium text-gray-700">Nomor HP / WhatsApp Orang Tua / Wali (Opsional)</label>
                    <input type="text" name="parent_phone" id="parent_phone" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('parent_phone') }}">
                    @error('parent_phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="parent_email" class="block text-sm font-medium text-gray-700">Email Orang Tua / Wali (Opsional)</label>
                    <input type="email" name="parent_email" id="parent_email" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('parent_email') }}">
                    @error('parent_email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="parent_occupation" class="block text-sm font-medium text-gray-700">Pekerjaan Orang Tua / Wali (Opsional)</label>
                    <input type="text" name="parent_occupation" id="parent_occupation" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('parent_occupation') }}">
                    @error('parent_occupation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Informasi Alamat Santri</h3>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                    <textarea name="address" id="address" rows="3" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ old('address') }}</textarea>
                    @error('address')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">Kota (Opsional)</label>
                        <input type="text" name="city" id="city" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('city') }}">
                        @error('city')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="province" class="block text-sm font-medium text-gray-700">Provinsi (Opsional)</label>
                        <input type="text" name="province" id="province" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('province') }}">
                        @error('province')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Foto Santri --}}
                <div class="pt-4 border-t border-gray-200">
                    <label for="photo" class="block text-sm font-medium text-gray-700">Foto Santri (Opsional, Maks. 2MB)</label>
                    <input type="file" name="photo" id="photo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" accept="image/*">
                    @error('photo')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Data Akademik & Status Santri</h3>
                <div>
                    <label for="admission_year" class="block text-sm font-medium text-gray-700">Tahun Masuk</label>
                    <input type="number" name="admission_year" id="admission_year" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('admission_year', date('Y')) }}">
                    @error('admission_year')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700">Kategori Santri</label>
                    <select name="category" id="category" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Pilih Kategori</option>
                        <option value="Tahfidz" {{ old('category') == 'Tahfidz' ? 'selected' : '' }}>Tahfidz</option>
                        <option value="Kitab Kuning" {{ old('category') == 'Kitab Kuning' ? 'selected' : '' }}>Kitab Kuning</option>
                        <option value="Umum" {{ old('category') == 'Umum' ? 'selected' : '' }}>Umum</option>
                    </select>
                    @error('category')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Tipe Santri</label>
                    <select name="type" id="type" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Pilih Tipe</option>
                        <option value="Asrama" {{ old('type') == 'Asrama' ? 'selected' : '' }}>Asrama</option>
                        <option value="Pulang-Pergi" {{ old('type') == 'Pulang-Pergi' ? 'selected' : '' }}>Pulang-Pergi</option>
                    </select>
                    @error('type')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status Santri</label>
                    <select name="status" id="status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="non-aktif" {{ old('status') == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        <option value="lulus" {{ old('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a href="{{ route('admin.students.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-teal-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-600 focus:bg-teal-600 active:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Simpan Santri
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
