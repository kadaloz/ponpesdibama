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

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Data Calon Santri</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="registration_number" class="block text-sm font-medium text-gray-700">No. Pendaftaran</label>
                        <input type="text" name="registration_number" id="registration_number" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-100 cursor-not-allowed" value="{{ $applicant->registration_number }}" disabled>
                    </div>
                    <div>
                        <label for="full_name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="full_name" id="full_name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('full_name', $applicant->full_name) }}" required>
                        @error('full_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select name="gender" id="gender" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" {{ old('gender', $applicant->gender) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('gender', $applicant->gender) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                        <input type="text" name="place_of_birth" id="place_of_birth" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('place_of_birth', $applicant->place_of_birth) }}">
                        @error('place_of_birth')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('date_of_birth', $applicant->date_of_birth?->format('Y-m-d')) }}">
                        @error('date_of_birth')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label for="nisn" class="block text-sm font-medium text-gray-700">NISN (Nomor Induk Siswa Nasional)</label>
                    <input type="text" name="nisn" id="nisn" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('nisn', $applicant->nisn) }}">
                    @error('nisn')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="last_education" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir</label>
                        <input type="text" name="last_education" id="last_education" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('last_education', $applicant->last_education) }}">
                        @error('last_education')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="school_origin" class="block text-sm font-medium text-gray-700">Asal Sekolah</label>
                        <input type="text" name="school_origin" id="school_origin" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('school_origin', $applicant->school_origin) }}">
                        @error('school_origin')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Data Orang Tua / Wali</h3>
                <div>
                    <label for="parent_name" class="block text-sm font-medium text-gray-700">Nama Ayah / Wali</label>
                    <input type="text" name="parent_name" id="parent_name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('parent_name', $applicant->parent_name) }}" required>
                    @error('parent_name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="parent_phone" class="block text-sm font-medium text-gray-700">Nomor HP / WhatsApp Orang Tua / Wali</label>
                    <input type="text" name="parent_phone" id="parent_phone" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('parent_phone', $applicant->parent_phone) }}" required>
                    @error('parent_phone')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="parent_email" class="block text-sm font-medium text-gray-700">Email Orang Tua / Wali (Opsional)</label>
                    <input type="email" name="parent_email" id="parent_email" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('parent_email', $applicant->parent_email) }}">
                    @error('parent_email')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="parent_occupation" class="block text-sm font-medium text-gray-700">Pekerjaan Orang Tua / Wali (Opsional)</label>
                    <input type="text" name="parent_occupation" id="parent_occupation" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('parent_occupation', $applicant->parent_occupation) }}">
                    @error('parent_occupation')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Informasi Alamat</h3>

{{-- Alamat Lengkap --}}
<div class="mb-4">
    <label for="address" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
    <textarea name="address" id="address" rows="3" required
        class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: Jl. Merpati No. 45, Desa Aikmel">{{ old('address', $applicant->address ?? '') }}</textarea>
    @error('address')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Wilayah --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    {{-- Provinsi --}}
    <div>
        <label for="province" class="block text-sm font-semibold text-gray-700 mb-1">Provinsi</label>
        <select name="province" id="province" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">Pilih Provinsi</option>
        </select>
        @error('province')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Kota/Kabupaten --}}
    <div>
        <label for="city" class="block text-sm font-semibold text-gray-700 mb-1">Kabupaten/Kota</label>
        <select name="city" id="city" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">Pilih Kabupaten/Kota</option>
        </select>
        @error('city')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Kecamatan --}}
    <div>
        <label for="district" class="block text-sm font-semibold text-gray-700 mb-1">Kecamatan</label>
        <select name="district" id="district" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">Pilih Kecamatan</option>
        </select>
        @error('district')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>

    {{-- Kelurahan --}}
    <div>
        <label for="village" class="block text-sm font-semibold text-gray-700 mb-1">Kelurahan/Desa</label>
        <select name="village" id="village" required
            class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">Pilih Kelurahan/Desa</option>
        </select>
        @error('village')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
    </div>
</div>

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Pilihan Program & Tipe Santri</h3>
                <div>
                    <label for="chosen_program" class="block text-sm font-medium text-gray-700">Pilih Program Diminati</label>
                    <select name="chosen_program" id="chosen_program" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Pilih Program</option>
                        @foreach ($programs as $program)
                            <option value="{{ $program->name }}" {{ old('chosen_program', $applicant->chosen_program) == $program->name ? 'selected' : '' }}>{{ $program->name }}</option>
                        @endforeach
                    </select>
                    @error('chosen_program')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Pilihan Tipe PPDB (Asrama/Pulang-Pergi) --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Pendaftaran Santri</label>
                    <div class="mt-2 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                        <div>
                            <input type="radio" name="ppdb_type" id="type_asrama" value="Asrama"
                                   class="focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300"
                                   {{ old('ppdb_type', $applicant->ppdb_type) == 'Asrama' ? 'checked' : '' }} required onchange="toggleHalaqohPeriod()">
                            <label for="type_asrama" class="ml-2 text-sm text-gray-900">Program Santri Asrama</label>
                        </div>
                        <div>
                            <input type="radio" name="ppdb_type" id="type_pulang_pergi" value="Pulang-Pergi"
                                   class="focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300"
                                   {{ old('ppdb_type', $applicant->ppdb_type) == 'Pulang-Pergi' ? 'checked' : '' }} required onchange="toggleHalaqohPeriod()">
                            <label for="type_pulang_pergi" class="ml-2 text-sm text-gray-900">Program Santri Pulang Pergi</label>
                        </div>
                    </div>
                    @error('ppdb_type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                {{-- Pilihan Periode Ngaji (Halaqoh Sore/Malam) - Hanya untuk Pulang-Pergi --}}
                <div id="halaqoh-period-group" class="hidden"> {{-- Default hidden --}}
                    <label for="halaqoh_period" class="block text-sm font-medium text-gray-700">Periode Ngaji</label>
                    <select name="halaqoh_period" id="halaqoh_period" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Pilih Periode Ngaji</option>
                        @foreach ($halaqohPeriods as $period)
                            <option value="{{ $period }}" {{ old('halaqoh_period', $applicant->halaqoh_period) == $period ? 'selected' : '' }}>Halaqoh {{ $period }}</option>
                        @endforeach
                    </select>
                    @error('halaqoh_period')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="space-y-4 pt-4">
                    <p class="text-md font-semibold text-gray-700">Unggah Dokumen (Maks. 2MB per file, format PDF/JPG/PNG):</p>
                    @php
                        $documentFields = [
                            'document_akta' => 'Akta Kelahiran',
                            'document_kk' => 'Kartu Keluarga (KK)',
                            'document_ijazah' => 'Ijazah Terakhir',
                            'document_photo' => 'Pas Foto (Maks. 1MB, format JPG/PNG)',
                        ];
                    @endphp

                    @foreach ($documentFields as $fileInputName => $label)
                        <div class="mb-4">
                            <label for="{{ $fileInputName }}" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
                            <input type="file" name="{{ $fileInputName }}" id="{{ $fileInputName }}" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            @if ($applicant->{$fileInputName . '_path'})
                                <div class="mt-2 flex items-center space-x-2">
                                    <p class="text-sm text-gray-600">Dokumen saat ini:</p>
                                    <a href="{{ asset('storage/' . $applicant->{$fileInputName . '_path'}) }}" target="_blank" class="text-blue-600 hover:underline flex items-center">
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

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Status Pendaftaran & Catatan Admin</h3>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status Pendaftaran</label>
                    <select name="status" id="status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        @foreach ($statuses as $s)
                            <option value="{{ $s }}" {{ old('status', $applicant->status) == $s ? 'selected' : '' }}>{{ ucfirst(str_replace('_', ' ', $s)) }}</option>
                        @endforeach
                    </select>
                    @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="admin_notes" class="block text-sm font-medium text-gray-700">Catatan Admin (Opsional)</label>
                    <textarea name="admin_notes" id="admin_notes" rows="3" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ old('admin_notes', $applicant->admin_notes) }}</textarea>
                    @error('admin_notes')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="flex items-center justify-end mt-6">
                    <a href="{{ route('admin.applicants.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-full font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm mr-2">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-teal-700 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-teal-800 focus:bg-teal-800 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg">
                        Perbarui Pendaftar
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        function toggleHalaqohPeriod() {
            const ppdbTypeRadio = document.querySelector('input[name="ppdb_type"]:checked');
            const halaqohPeriodGroup = document.getElementById('halaqoh-period-group');
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
            toggleHalaqohPeriod(); // Panggil fungsi saat DOMContentLoaded
        });

        // Fungsi untuk mengisi dropdown wilayah
        document.addEventListener('DOMContentLoaded', function () {
    const provinsiSelect = document.getElementById('province');
    const kabupatenSelect = document.getElementById('city');
    const kecamatanSelect = document.getElementById('district');
    const kelurahanSelect = document.getElementById('village');

    const selectedProv = "{{ old('province', $applicant->province ?? '') }}";
    const selectedKab = "{{ old('city', $applicant->city ?? '') }}";
    const selectedKec = "{{ old('district', $applicant->district ?? '') }}";
    const selectedKel = "{{ old('village', $applicant->village ?? '') }}";

    // Load provinsi
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
})
    </script>
    @endpush
@endsection