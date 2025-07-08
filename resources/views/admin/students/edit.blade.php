{{-- resources/views/admin/students/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Data Santri')

@section('header_admin', 'Edit Data Santri')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900"> {{-- Padding ditingkatkan --}}
            <h3 class="text-3xl font-extrabold text-teal-700 mb-8 text-center border-b pb-4">Edit Data Santri: <span class="text-indigo-700">{{ $student->name }}</span></h3> {{-- Judul lebih besar dan rata tengah --}}

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-5 py-3 rounded-lg relative mb-6 shadow-sm" role="alert"> {{-- Padding dan margin ditingkatkan --}}
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-5 py-3 rounded-lg relative mb-6 shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.students.update', $student) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Bagian Informasi Utama Santri --}}
                <div class="p-6 bg-teal-50 rounded-xl shadow-inner border border-teal-200">
                    <h4 class="font-bold text-xl text-teal-700 mb-4 border-b pb-2">Informasi Utama Santri</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('name', $student->name) }}" required>
                            @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="nis" class="block text-sm font-medium text-gray-700">Nomor Induk Santri (NIS)</label>
                            <input type="text" name="nis" id="nis" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('nis', $student->nis) }}">
                            @error('nis')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Bagian Detail Pribadi --}}
                <div class="pt-6 border-t border-gray-200 p-6 bg-gray-50 rounded-xl shadow-sm border">
                    <h4 class="font-bold text-xl text-gray-800 mb-4 border-b pb-2">Detail Pribadi</h4>
                    <div>
                        <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                        <select name="gender" id="gender" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Laki-laki" {{ old('gender', $student->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="Perempuan" {{ old('gender', $student->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('gender')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4"> {{-- Margin top untuk grid --}}
                        <div>
                            <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                            <input type="text" name="place_of_birth" id="place_of_birth" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('place_of_birth', $student->place_of_birth) }}">
                            @error('place_of_birth')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('date_of_birth', $student->date_of_birth?->format('Y-m-d')) }}">
                            @error('date_of_birth')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="mt-4"> {{-- Margin top --}}
                        <label for="nisn" class="block text-sm font-medium text-gray-700">NISN (Nomor Induk Siswa Nasional) (Opsional)</label>
                        <input type="text" name="nisn" id="nisn" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('nisn', $student->nisn) }}">
                        @error('nisn')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4"> {{-- Margin top --}}
                        <div>
                            <label for="last_education" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir (Opsional)</label>
                            <input type="text" name="last_education" id="last_education" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('last_education', $student->last_education) }}">
                            @error('last_education')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="school_origin" class="block text-sm font-medium text-gray-700">Asal Sekolah (Opsional)</label>
                            <input type="text" name="school_origin" id="school_origin" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('school_origin', $student->school_origin) }}">
                            @error('school_origin')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Bagian Data Orang Tua / Wali --}}
                <div class="pt-6 border-t border-gray-200 p-6 bg-gray-50 rounded-xl shadow-sm border">
                    <h4 class="font-bold text-xl text-gray-800 mb-4 border-b pb-2">Data Orang Tua / Wali</h4>
                    <div>
                        <label for="parent_name" class="block text-sm font-medium text-gray-700">Nama Ayah / Wali (Opsional)</label>
                        <input type="text" name="parent_name" id="parent_name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('parent_name', $student->parent_name) }}">
                        @error('parent_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4"> {{-- Margin top --}}
                        <div>
                            <label for="parent_phone" class="block text-sm font-medium text-gray-700">Nomor HP / WhatsApp Orang Tua / Wali (Opsional)</label>
                            <input type="text" name="parent_phone" id="parent_phone" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('parent_phone', $student->parent_phone) }}">
                            @error('parent_phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="parent_email" class="block text-sm font-medium text-gray-700">Email Orang Tua / Wali (Opsional)</label>
                            <input type="email" name="parent_email" id="parent_email" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('parent_email', $student->parent_email) }}">
                            @error('parent_email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                    <div class="mt-4"> {{-- Margin top --}}
                        <label for="parent_occupation" class="block text-sm font-medium text-gray-700">Pekerjaan Orang Tua / Wali (Opsional)</label>
                        <input type="text" name="parent_occupation" id="parent_occupation" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('parent_occupation', $student->parent_occupation) }}">
                        @error('parent_occupation')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Informasi Alamat Santri</h3>

{{-- Alamat Lengkap --}}
<div class="mb-4">
    <label for="address" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
    <textarea name="address" id="address" rows="3"
        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: Jl. Merpati No. 45, Desa Aikmel">{{ old('address') }}</textarea>
    @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Wilayah --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    {{-- Provinsi --}}
    <div>
        <label for="province" class="block text-sm font-semibold text-gray-700 mb-1">Provinsi (Opsional)</label>
        <select name="province" id="province"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">Pilih Provinsi</option>
        </select>
        @error('province')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Kabupaten/Kota --}}
    <div>
        <label for="city" class="block text-sm font-semibold text-gray-700 mb-1">Kabupaten/Kota (Opsional)</label>
        <select name="city" id="city"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">Pilih Kabupaten/Kota</option>
        </select>
        @error('city')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Kecamatan --}}
    <div>
        <label for="district" class="block text-sm font-semibold text-gray-700 mb-1">Kecamatan (Opsional)</label>
        <select name="district" id="district"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">Pilih Kecamatan</option>
        </select>
        @error('district')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Kelurahan --}}
    <div>
        <label for="village" class="block text-sm font-semibold text-gray-700 mb-1">Kelurahan/Desa (Opsional)</label>
        <select name="village" id="village"
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">Pilih Kelurahan/Desa</option>
        </select>
        @error('village')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
</div>


                {{-- Bagian Foto Santri --}}
                <div class="pt-6 border-t border-gray-200 p-6 bg-gray-50 rounded-xl shadow-sm border">
                    <h4 class="font-bold text-xl text-gray-800 mb-4 border-b pb-2">Foto Santri</h4>
                    <div>
                        <label for="photo" class="block text-sm font-medium text-gray-700">Unggah Foto Santri Baru (Opsional, Maks. 2MB)</label>
                        <input type="file" name="photo" id="photo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" accept="image/*">
                        @error('photo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    @if ($student->photo_path)
                        <div class="mt-4 flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-4">
                            <p class="text-sm text-gray-600 flex-shrink-0">Foto saat ini:</p>
                            <img src="{{ asset('storage/' . $student->photo_path) }}" alt="Foto Santri {{ $student->name }}" class="h-24 w-auto object-cover rounded-md shadow-sm flex-shrink-0">
                            <div class="flex items-center ml-auto sm:ml-0">
                                <input type="checkbox" name="remove_photo" id="remove_photo" value="1" class="focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300 rounded">
                                <label for="remove_photo" class="ml-2 text-sm text-red-600">Hapus Foto ini</label>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- Bagian Dokumen Santri --}}
                <div class="pt-6 border-t border-gray-200 p-6 bg-gray-50 rounded-xl shadow-sm border">
                    <h4 class="font-bold text-xl text-teal-700 mb-4 border-b pb-2">Dokumen Santri</h4>
                    <p class="text-sm text-gray-600 mb-4">Unggah dokumen santri (Maks. 2MB per file, format PDF/JPG/PNG).</p>
                    @php
                        $documentFields = [
                            'document_akta' => 'Akta Kelahiran',
                            'document_kk' => 'Kartu Keluarga (KK)',
                            'document_ijazah' => 'Ijazah Terakhir',
                            'document_photo' => 'Pas Foto Dokumen (jika ada)',
                        ];
                    @endphp

                    @foreach ($documentFields as $fileInputName => $label)
                        <div class="mb-4">
                            <label for="{{ $fileInputName }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                            <input type="file" name="{{ $fileInputName }}" id="{{ $fileInputName }}" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            @if ($student->{$fileInputName . '_path'})
                                <div class="mt-2 flex items-center space-x-2">
                                    <p class="text-sm text-gray-600">Dokumen saat ini:</p>
                                    <a href="{{ asset('storage/' . $student->{$fileInputName . '_path'}) }}" target="_blank" class="text-blue-600 hover:underline flex items-center">
                                        Lihat Dokumen
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0l-10 10M14 4H9"></path></svg>
                                    </a>
                                    <input type="checkbox" name="remove_{{ $fileInputName }}" id="remove_{{ $fileInputName }}" value="1" class="ml-4 focus:ring-red-500 h-4 w-4 text-red-600 border-gray-300 rounded">
                                    <label for="remove_{{ $fileInputName }}" class="ml-2 text-sm text-red-600">Hapus Dokumen</label>
                                </div>
                            @endif
                            @error($fileInputName)<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                        </div>
                    @endforeach
                </div>
                
                {{-- Bagian Data Akademik & Status Santri --}}
                <div class="pt-6 border-t border-gray-200 p-6 bg-gray-50 rounded-xl shadow-sm border">
                    <h4 class="font-bold text-xl text-gray-800 mb-4 border-b pb-2">Data Akademik & Status Santri</h4>
                    <div>
                        <label for="admission_year" class="block text-sm font-medium text-gray-700">Tahun Masuk</label>
                        <input type="number" name="admission_year" id="admission_year" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('admission_year', $student->admission_year) }}">
                        @error('admission_year')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-4"> {{-- Margin top --}}
                        <label for="category" class="block text-sm font-medium text-gray-700">Kategori Santri</label>
                        <select name="category" id="category" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                            <option value="">Pilih Kategori</option>
                            <option value="Tahfidz" {{ old('category', $student->category) == 'Tahfidz' ? 'selected' : '' }}>Tahfidz</option>
                            <option value="Kitab Kuning" {{ old('category', $student->category) == 'Kitab Kuning' ? 'selected' : '' }}>Kitab Kuning</option>
                            <option value="Umum" {{ old('category', $student->category) == 'Umum' ? 'selected' : '' }}>Umum</option>
                        </select>
                        @error('category')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-4"> {{-- Margin top --}}
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Santri</label>
                        <div class="mt-2 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                            <div>
                                <input type="radio" name="type" id="type_asrama" value="Asrama"
                                       class="focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300"
                                       {{ old('type', $student->type) == 'Asrama' ? 'checked' : '' }} required onchange="toggleHalaqohPeriodStudent()">
                                <label for="type_asrama" class="ml-2 text-sm text-gray-900">Asrama</label>
                            </div>
                            <div>
                                <input type="radio" name="type" id="type_pulang_pergi" value="Pulang-Pergi"
                                       class="focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300"
                                       {{ old('type', $student->type) == 'Pulang-Pergi' ? 'checked' : '' }} required onchange="toggleHalaqohPeriodStudent()">
                                <label for="type_pulang_pergi" class="ml-2 text-sm text-gray-900">Pulang-Pergi</label>
                            </div>
                        </div>
                        @error('type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    {{-- Pilihan Periode Ngaji (Halaqoh Sore/Malam) - Hanya untuk Pulang-Pergi --}}
                    <div id="halaqoh-period-group-student" class="hidden mt-4"> {{-- Default hidden, margin top --}}
                        <label for="halaqoh_period" class="block text-sm font-medium text-gray-700">Periode Ngaji</label>
                        <select name="halaqoh_period" id="halaqoh_period" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                            <option value="">Pilih Periode Ngaji</option>
                            @foreach ($halaqohPeriods as $period)
                                <option value="{{ $period }}" {{ old('halaqoh_period', $student->halaqoh_period) == $period ? 'selected' : '' }}>Halaqoh {{ $period }}</option>
                            @endforeach
                        </select>
                        @error('halaqoh_period')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="mt-4"> {{-- Margin top --}}
                        <label for="status" class="block text-sm font-medium text-gray-700">Status Santri</label>
                        <select name="status" id="status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                            <option value="aktif" {{ old('status', $student->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="non-aktif" {{ old('status', $student->status) == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                            <option value="lulus" {{ old('status', $student->status) == 'lulus' ? 'selected' : '' }}>Lulus</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>


                <div class="flex items-center justify-end mt-6 pt-6 border-t border-gray-200"> {{-- Margin top, padding top, border top --}}
                    <a href="{{ route('admin.students.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-full font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md mr-2">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-teal-700 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-teal-800 focus:bg-teal-800 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg">
                        Perbarui Santri
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        
document.addEventListener('DOMContentLoaded', function () {
    const provinsiSelect = document.getElementById('province');
    const kabupatenSelect = document.getElementById('city');
    const kecamatanSelect = document.getElementById('district');
    const kelurahanSelect = document.getElementById('village');

    const selectedProv = "{{ old('province') }}";
    const selectedKab = "{{ old('city') }}";
    const selectedKec = "{{ old('district') }}";
    const selectedKel = "{{ old('village') }}";

    fetch('/api/provinces')
        .then(res => res.json())
        .then(provinces => {
            provinces.forEach(prov => {
                const option = new Option(prov, prov, false, prov === selectedProv);
                provinsiSelect.appendChild(option);
            });
            if (selectedProv) updateCities(selectedProv);
        })
        .catch(() => alert('❌ Gagal memuat data provinsi.'));

    provinsiSelect.addEventListener('change', function () {
        updateCities(this.value);
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
    });

    kabupatenSelect.addEventListener('change', function () {
        updateDistricts(provinsiSelect.value, this.value);
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
    });

    kecamatanSelect.addEventListener('change', function () {
        updateVillages(provinsiSelect.value, kabupatenSelect.value, this.value);
    });

    function updateCities(provinsi) {
        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
        fetch(`/api/cities?province=${encodeURIComponent(provinsi)}`)
            .then(res => res.json())
            .then(cities => {
                cities.forEach(kab => {
                    const option = new Option(kab, kab, false, kab === selectedKab);
                    kabupatenSelect.appendChild(option);
                });
                if (selectedKab) updateDistricts(provinsi, selectedKab);
            })
            .catch(() => alert('❌ Gagal memuat data kota/kabupaten.'));
    }

    function updateDistricts(provinsi, kota) {
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        fetch(`/api/districts?province=${encodeURIComponent(provinsi)}&city=${encodeURIComponent(kota)}`)
            .then(res => res.json())
            .then(districts => {
                districts.forEach(kec => {
                    const option = new Option(kec, kec, false, kec === selectedKec);
                    kecamatanSelect.appendChild(option);
                });
                if (selectedKec) updateVillages(provinsi, kota, selectedKec);
            })
            .catch(() => alert('❌ Gagal memuat data kecamatan.'));
    }

    function updateVillages(provinsi, kota, kecamatan) {
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
        fetch(`/api/villages?province=${encodeURIComponent(provinsi)}&city=${encodeURIComponent(kota)}&district=${encodeURIComponent(kecamatan)}`)
            .then(res => res.json())
            .then(villages => {
                villages.forEach(kel => {
                    const option = new Option(kel, kel, false, kel === selectedKel);
                    kelurahanSelect.appendChild(option);
                });
            })
            .catch(() => alert('❌ Gagal memuat data kelurahan.'));
    }
});
        
        function toggleHalaqohPeriodStudent() {
            const ppdbTypeRadio = document.querySelector('input[name="type"]:checked'); // Perhatikan name="type"
            const halaqohPeriodGroup = document.getElementById('halaqoh-period-group-student');
            const halaqohPeriodSelect = document.getElementById('halaqoh_period');

            if (ppdbTypeRadio && ppdbTypeRadio.value === 'Pulang-Pergi') {
                halaqohPeriodGroup.classList.remove('hidden');
                halaqohPeriodSelect.setAttribute('required', 'required');
            } else {
                halaqohPeriodGroup.classList.add('hidden');
                halaqohPeriodSelect.removeAttribute('required');
                halaqohPeriodSelect.value = ''; // Reset pilihan jika disembunyikan
            }
        }

        // Jalankan saat halaman dimuat untuk mengatur status awal
        document.addEventListener('DOMContentLoaded', function() {
            toggleHalaqohPeriodStudent(); // Panggil fungsi saat DOMContentLoaded
        });
    </script>
    @endpush
@endsection
