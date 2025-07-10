{{-- resources/views/admin/applicants/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Pendaftar PPDB')
@section('header_admin', 'Edit Data Pendaftar PPDB')

@section('admin_content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <form action="{{ route('admin.applicants.update', $applicant) }}" method="POST" enctype="multipart/form-data" class="space-y-6 text-left">
            @csrf
            @method('PUT')

            {{-- Informasi Santri --}}
            <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Data Calon Santri</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="registration_number" class="block text-sm font-medium text-gray-700">No. Pendaftaran</label>
                    <input type="text" id="registration_number" disabled class="mt-1 block w-full px-4 py-2 border bg-gray-100 rounded-md shadow-sm cursor-not-allowed" value="{{ $applicant->registration_number }}">
                </div>
                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $applicant->full_name) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                    @error('full_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Jenis Kelamin --}}
            <div>
                <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                <select name="gender" id="gender" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="Laki-laki" {{ old('gender', $applicant->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('gender', $applicant->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('gender')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Tempat dan Tanggal Lahir --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                    <input type="text" name="place_of_birth" id="place_of_birth" value="{{ old('place_of_birth', $applicant->place_of_birth) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    @error('place_of_birth')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                    <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $applicant->date_of_birth?->format('Y-m-d')) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    @error('date_of_birth')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- NISN, Pendidikan, Sekolah --}}
            <div>
                <label for="nisn" class="block text-sm font-medium text-gray-700">NISN</label>
                <input type="text" name="nisn" id="nisn" value="{{ old('nisn', $applicant->nisn) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                @error('nisn')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="last_education" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir</label>
                    <input type="text" name="last_education" id="last_education" value="{{ old('last_education', $applicant->last_education) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    @error('last_education')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="school_origin" class="block text-sm font-medium text-gray-700">Asal Sekolah</label>
                    <input type="text" name="school_origin" id="school_origin" value="{{ old('school_origin', $applicant->school_origin) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    @error('school_origin')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Data Orang Tua --}}
            <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Data Orang Tua / Wali</h3>
            <div>
                <label for="parent_name" class="block text-sm font-medium text-gray-700">Nama Ayah / Wali</label>
                <input type="text" name="parent_name" id="parent_name" value="{{ old('parent_name', $applicant->parent_name) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                @error('parent_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="parent_phone" class="block text-sm font-medium text-gray-700">No HP / WA</label>
                <input type="text" name="parent_phone" id="parent_phone" value="{{ old('parent_phone', $applicant->parent_phone) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                @error('parent_phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="parent_email" class="block text-sm font-medium text-gray-700">Email (Opsional)</label>
                <input type="email" name="parent_email" id="parent_email" value="{{ old('parent_email', $applicant->parent_email) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                @error('parent_email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="parent_occupation" class="block text-sm font-medium text-gray-700">Pekerjaan (Opsional)</label>
                <input type="text" name="parent_occupation" id="parent_occupation" value="{{ old('parent_occupation', $applicant->parent_occupation) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                @error('parent_occupation')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Alamat --}}
            <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Informasi Alamat</h3>
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                <textarea name="address" id="address" rows="3" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ old('address', $applicant->address) }}</textarea>
                @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="province" class="block text-sm font-medium text-gray-700">Provinsi</label>
                    <select id="province" name="province" required data-selected="{{ old('province', $applicant->province) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Pilih Provinsi</option>
                    </select>
                    @error('province')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700">Kabupaten/Kota</label>
                    <select id="city" name="city" required data-selected="{{ old('city', $applicant->city) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Pilih Kabupaten/Kota</option>
                    </select>
                    @error('city')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="district" class="block text-sm font-medium text-gray-700">Kecamatan</label>
                    <select id="district" name="district" required data-selected="{{ old('district', $applicant->district) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Pilih Kecamatan</option>
                    </select>
                    @error('district')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="village" class="block text-sm font-medium text-gray-700">Kelurahan/Desa</label>
                    <select id="village" name="village" required data-selected="{{ old('village', $applicant->village) }}" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Pilih Kelurahan/Desa</option>
                    </select>
                    @error('village')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Program dan Tipe PPDB --}}
            @include('admin.applicants.partials.program_ppdb_type')

            {{-- Dokumen --}}
            <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Unggah Dokumen</h3>
            @php
                $documentFields = [
                    'document_akta' => 'Akta Kelahiran',
                    'document_kk' => 'Kartu Keluarga',
                    'document_ijazah' => 'Ijazah Terakhir',
                    'document_photo' => 'Pas Foto',
                ];
            @endphp

            @foreach ($documentFields as $fileInput => $label)
                @php $pathField = $fileInput . '_path'; @endphp
                <div class="mb-4">
                    <label for="{{ $fileInput }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                    <input type="file" name="{{ $fileInput }}" id="{{ $fileInput }}" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                    @if ($applicant->{$pathField})
                        <div class="mt-2 flex items-center gap-2 text-sm text-gray-600">
                            Dokumen saat ini:
                            <a href="{{ asset('storage/' . $applicant->{$pathField}) }}" target="_blank" class="text-blue-600 hover:underline">Lihat</a>
                            <label class="inline-flex items-center gap-1 text-red-600">
                                <input type="checkbox" name="remove_{{ $fileInput }}" value="1" class="h-4 w-4 text-red-600 border-gray-300 rounded">
                                <span>Hapus</span>
                            </label>
                        </div>
                    @endif
                    @error($fileInput)<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>
            @endforeach

            {{-- Status dan Catatan --}}
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">Status Pendaftaran</label>
                <select name="status" id="status" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                    @foreach ($statuses as $status)
                        <option value="{{ $status }}" {{ old('status', $applicant->status) == $status ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>
                    @endforeach
                </select>
                @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="admin_notes" class="block text-sm font-medium text-gray-700">Catatan Admin</label>
                <textarea name="admin_notes" id="admin_notes" rows="3" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ old('admin_notes', $applicant->admin_notes) }}</textarea>
                @error('admin_notes')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Tombol --}}
            <div class="flex items-center justify-end mt-6">
                <a href="{{ route('admin.applicants.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 text-sm rounded-full font-semibold text-gray-700 hover:bg-gray-300">Batal</a>
                <button type="submit" class="ml-4 inline-flex items-center px-6 py-3 bg-teal-700 text-sm rounded-full font-semibold text-white hover:bg-teal-800">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@endsection