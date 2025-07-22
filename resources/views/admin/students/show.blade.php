{{-- resources/views/admin/students/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Detail Data Santri')

@section('header_admin', 'Detail Data Santri')

@section('admin_content')
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8"> {{-- Container utama dengan padding dan max-width --}}
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            {{-- Header --}}
            <div class="bg-teal-600 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center">
                    <x-heroicon-o-eye class="h-8 w-8 text-white mr-3" /> {{-- Ikon untuk detail --}}
                    <h1 class="text-2xl font-bold text-white">Detail Data Santri: <span class="text-teal-200">{{ $student->name }}</span></h1>
                </div>
                <a href="{{ route('admin.students.index') }}"
                   class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-teal-500 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                    <x-heroicon-o-arrow-left class="h-5 w-5 mr-2" />
                    Kembali ke Daftar
                </a>
            </div>

            <div class="p-6 text-gray-900">
                <h3 class="text-3xl font-extrabold text-teal-700 mb-8 text-center border-b pb-4">Informasi Lengkap Santri</h3>

                {{-- Ringkasan Santri --}}
                <div class="mb-8 p-6 bg-teal-50 rounded-xl shadow-inner border border-teal-200">
                    <h4 class="font-bold text-xl text-teal-700 mb-4 flex items-center">
                        <x-heroicon-o-clipboard-document-list class="h-6 w-6 text-teal-600 mr-2" />
                        Ringkasan Santri
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-800 text-lg">
                        <div>
                            <p class="font-medium">NIS:</p>
                            <p class="block text-xl font-bold text-teal-800">{{ $student->nis ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium">Nama Lengkap:</p>
                            <p class="block">{{ $student->name }}</p>
                        </div>
                        <div>
                            <p class="font-medium">Kategori:</p>
                            <p class="block">{{ $student->category ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="font-medium">Tipe Santri:</p>
                            <p class="block">{{ $student->type ?? '-' }}</p>
                        </div>
                        @if ($student->type == 'Pulang-Pergi')
                            <div>
                                <p class="font-medium">Periode Ngaji:</p>
                                <p class="block">{{ $student->halaqoh_period ?? '-' }}</p>
                            </div>
                        @endif
                        <div>
                            <p class="font-medium">Status Santri:</p>
                            <p class="block text-xl font-bold px-3 py-1 rounded-full inline-block {{
                                $student->status == 'aktif' ? 'bg-green-100 text-green-800' :
                                ($student->status == 'non-aktif' ? 'bg-yellow-100 text-yellow-800' :
                                ($student->status == 'lulus' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'))
                            }}">
                                {{ ucfirst(str_replace('-', ' ', $student->status)) }}
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Foto Santri --}}
                <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200 text-center">
                    <h4 class="font-semibold text-xl text-gray-800 mb-4 border-b pb-2 flex items-center justify-center">
                        <x-heroicon-o-camera class="h-6 w-6 text-gray-600 mr-2" />
                        Foto Santri
                    </h4>
                    @if ($student->photo_path)
                        <img src="{{ asset('storage/' . $student->photo_path) }}" alt="Foto Santri {{ $student->name }}" class="mx-auto max-w-xs h-auto object-cover rounded-md shadow-lg border border-gray-300">
                    @else
                        <p class="text-gray-600 italic">Tidak ada foto santri.</p>
                    @endif
                </div>

                {{-- Data Pribadi --}}
                <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
                    <h4 class="font-semibold text-xl text-gray-800 mb-4 border-b pb-2 flex items-center">
                        <x-heroicon-o-identification class="h-6 w-6 text-gray-600 mr-2" />
                        Data Pribadi Santri
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-700 text-base">
                        <div><span class="font-medium">Jenis Kelamin:</span> {{ $student->gender ?? '-' }}</div>
                        <div><span class="font-medium">Tempat, Tanggal Lahir:</span> {{ $student->place_of_birth ?? '-' }}, {{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('d F Y') : '-' }}</div>
                        <div><span class="font-medium">NISN:</span> {{ $student->nisn ?? '-' }}</div>
                        <div><span class="font-medium">Pendidikan Terakhir:</span> {{ $student->last_education ?? '-' }}</div>
                        <div><span class="font-medium">Asal Sekolah:</span> {{ $student->school_origin ?? '-' }}</div>
                        <div><span class="font-medium">Tahun Masuk:</span> {{ $student->admission_year ?? '-' }}</div>
                    </div>
                </div>

                {{-- Data Orang Tua/Wali --}}
                <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
                    <h4 class="font-semibold text-xl text-gray-800 mb-4 border-b pb-2 flex items-center">
                        <x-heroicon-o-users class="h-6 w-6 text-gray-600 mr-2" />
                        Data Orang Tua / Wali
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-700 text-base">
                        <div><span class="font-medium">Nama Ayah / Wali:</span> {{ $student->parent_name ?? '-' }}</div>
                        <div><span class="font-medium">Nomor HP / WA:</span> {{ $student->parent_phone ?? '-' }}</div>
                        <div><span class="font-medium">Email:</span> {{ $student->parent_email ?? '-' }}</div>
                        <div><span class="font-medium">Pekerjaan:</span> {{ $student->parent_occupation ?? '-' }}</div>
                    </div>
                </div>

                {{-- Informasi Alamat --}}
                <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
                    <h4 class="font-semibold text-xl text-gray-800 mb-4 border-b pb-2 flex items-center">
                        <x-heroicon-o-map-pin class="h-6 w-6 text-gray-600 mr-2" />
                        Informasi Alamat Santri
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-700 text-base">
                        <div class="col-span-full"><span class="font-medium">Alamat Lengkap:</span> {{ $student->address ?? '-' }}</div>
                        <div><span class="font-medium">Provinsi:</span> {{ $student->province ?? '-' }}</div>
                        <div><span class="font-medium">Kabupaten/Kota:</span> {{ $student->city ?? '-' }}</div>
                        <div><span class="font-medium">Kecamatan:</span> {{ $student->district ?? '-' }}</div> {{-- DITAMBAHKAN --}}
                        <div><span class="font-medium">Kelurahan/Desa:</span> {{ $student->village ?? '-' }}</div> {{-- DITAMBAHKAN --}}
                    </div>
                </div>

                {{-- Dokumen Santri --}}
                <div class="mt-8 p-6 bg-teal-50 rounded-xl shadow-sm border border-teal-200">
                    <h4 class="font-semibold text-xl text-teal-800 mb-4 border-b pb-2 flex items-center">
                        <x-heroicon-o-document-text class="h-6 w-6 text-teal-600 mr-2" />
                        Dokumen Santri
                    </h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @php
                            $documentFields = [
                                'document_akta_path' => 'Akta Kelahiran',
                                'document_kk_path' => 'Kartu Keluarga (KK)',
                                'document_ijazah_path' => 'Ijazah Terakhir',
                                'document_photo_path' => 'Pas Foto Dokumen',
                            ];
                        @endphp
                        @foreach ($documentFields as $pathColumn => $name)
                            <div class="p-4 border rounded-lg bg-white flex items-center justify-between shadow-sm">
                                <span class="font-medium text-gray-700">{{ $name }}:</span>
                                @if ($student->{$pathColumn})
                                    <a href="{{ asset('storage/' . $student->{$pathColumn}) }}" target="_blank" class="text-blue-600 hover:underline flex items-center">
                                        Lihat Dokumen
                                        <x-heroicon-c-link class="w-4 h-4 ml-1" />
                                    </a>
                                @else
                                    <span class="text-gray-500 italic">Tidak ada</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Asal Pendaftar (jika terhubung dari PPDB) --}}
                @if ($student->applicant)
                    <div class="mt-8 p-6 bg-blue-50 rounded-xl shadow-sm border border-blue-200">
                        <h4 class="font-semibold text-xl text-blue-700 mb-4 border-b pb-2 flex items-center">
                            <x-heroicon-o-users class="h-6 w-6 text-blue-600 mr-2" />
                            Asal Data Pendaftar PPDB
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-blue-700 text-base">
                            <div><span class="font-medium">No. Pendaftaran PPDB:</span> <span class="font-bold">{{ $student->applicant->registration_number ?? '-' }}</span></div>
                            <div><span class="font-medium">Email Orang Tua Pendaftar:</span> {{ $student->applicant->parent_email ?? '-' }}</div>
                            <div><span class="font-medium">Asal Sekolah Pendaftar:</span> {{ $student->applicant->school_origin ?? '-' }}</div>
                            <div><span class="font-medium">Status PPDB Terakhir:</span> {{ ucfirst(str_replace('_', ' ', $student->applicant->status ?? '-')) }}</div>
                            <div class="col-span-full">
                                <a href="{{ route('admin.applicants.show', $student->applicant->id) }}" class="inline-flex items-center text-sm px-4 py-2 bg-blue-600 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md mt-4">
                                    <x-heroicon-o-eye class="w-4 h-4 mr-2" />
                                    Lihat Detail Pendaftar
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

{{-- Tombol Aksi --}}
<div class="mt-10 text-center border-t pt-6 flex justify-end space-x-4">
    <a href="{{ route('admin.students.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-full font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
        <x-heroicon-o-arrow-left class="w-4 h-4 mr-2 -ml-1" />
        Kembali ke Daftar
    </a>

    @can('edit students')
    <a href="{{ route('admin.students.edit', $student) }}" class="inline-flex items-center text-sm px-4 py-2 bg-teal-600 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
        <x-heroicon-o-pencil-square class="w-4 h-4 mr-2 -ml-1" />
        Edit Santri
    </a>
    @endcan
</div>

            </div>
        </div>
    </div>
@endsection