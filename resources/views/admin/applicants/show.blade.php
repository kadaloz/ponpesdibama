{{-- resources/views/admin/applicants/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Detail Pendaftar PPDB')
@section('header_admin', 'Detail Pendaftar PPDB')

@section('admin_content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-8 text-gray-900">
        <h3 class="text-3xl font-extrabold text-teal-700 mb-8 text-center border-b pb-4">Informasi Lengkap Pendaftar</h3>

        {{-- Ringkasan Pendaftar --}}
        <div class="mb-8 p-6 bg-blue-50 rounded-xl shadow-inner border border-blue-200">
            <h4 class="font-bold text-2xl text-blue-800 mb-5">Ringkasan Pendaftar</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-4 gap-x-8 text-gray-800 text-lg">
                <div>
                    <dt class="font-semibold text-gray-600">No. Pendaftaran:</dt>
                    <dd class="text-2xl font-bold text-teal-800 mt-1">{{ $applicant->registration_number }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-600">Nama Lengkap:</dt>
                    <dd class="text-xl mt-1">{{ $applicant->full_name }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-600">Program Dipilih:</dt>
                    <dd class="text-xl mt-1">{{ $applicant->chosen_program ?? '-' }}</dd>
                </div>
                <div>
                    <dt class="font-semibold text-gray-600">Tipe Pendaftaran:</dt>
                    <dd class="text-xl mt-1">{{ $applicant->ppdb_type ?? '-' }}</dd>
                </div>
                @if ($applicant->ppdb_type == 'Pulang-Pergi')
                <div>
                    <dt class="font-semibold text-gray-600">Periode Ngaji:</dt>
                    <dd class="text-xl mt-1">{{ $applicant->halaqoh_period ?? '-' }}</dd>
                </div>
                @endif
                <div>
                    <dt class="font-semibold text-gray-600">Status Pendaftaran:</dt>
                    <dd class="mt-1">
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800',
                                'submitted' => 'bg-blue-100 text-blue-800',
                                'under_review' => 'bg-purple-100 text-purple-800',
                                'verified' => 'bg-indigo-100 text-indigo-800',
                                'accepted' => 'bg-green-100 text-green-800',
                                're-registered' => 'bg-teal-100 text-teal-800',
                                'rejected' => 'bg-red-100 text-red-800',
                            ];
                            $statusClass = $statusColors[$applicant->status] ?? 'bg-gray-100 text-gray-800';
                        @endphp
                        <span class="px-4 py-2 rounded-full text-lg font-bold inline-block {{ $statusClass }}">
                            {{ ucfirst(str_replace('_', ' ', $applicant->status)) }}
                        </span>
                    </dd>
                </div>
            </div>
        </div>

        {{-- Data Calon Santri --}}
        <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
            <h4 class="font-bold text-xl text-gray-800 mb-4 border-b pb-2">Informasi Pribadi</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-700 text-base">
                <div><span class="font-medium">Jenis Kelamin:</span> {{ $applicant->gender ?? '-' }}</div>
                <div><span class="font-medium">Tempat, Tanggal Lahir:</span> {{ $applicant->place_of_birth ?? '-' }}, {{ $applicant->date_of_birth ? \Carbon\Carbon::parse($applicant->date_of_birth)->format('d F Y') : '-' }}</div>
                <div><span class="font-medium">NISN:</span> {{ $applicant->nisn ?? '-' }}</div>
                <div><span class="font-medium">Pendidikan Terakhir:</span> {{ $applicant->last_education ?? '-' }}</div>
                <div><span class="font-medium">Asal Sekolah:</span> {{ $applicant->school_origin ?? '-' }}</div>
            </div>
        </div>

        {{-- Data Orang Tua / Wali --}}
        <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
            <h4 class="font-bold text-xl text-gray-800 mb-4 border-b pb-2">Informasi Kontak & Pekerjaan</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-700 text-base">
                <div><span class="font-medium">Nama Ayah / Wali:</span> {{ $applicant->parent_name ?? '-' }}</div>
                <div><span class="font-medium">Nomor HP / WA:</span> {{ $applicant->parent_phone ?? '-' }}</div>
                <div><span class="font-medium">Email:</span> {{ $applicant->parent_email ?? '-' }}</div>
                <div><span class="font-medium">Pekerjaan:</span> {{ $applicant->parent_occupation ?? '-' }}</div>
            </div>
        </div>

        {{-- Informasi Alamat --}}
        <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
            <h4 class="font-bold text-xl text-gray-800 mb-4 border-b pb-2">Detail Lokasi</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-700 text-base">
                <div class="col-span-full"><span class="font-medium">Alamat Lengkap:</span> {{ $applicant->address ?? '-' }}</div>
                <div><span class="font-medium">Kota:</span> {{ $applicant->city ?? '-' }}</div>
                <div><span class="font-medium">Kecamatan:</span> {{ $applicant->district ?? '-' }}</div>
                <div><span class="font-medium">Kelurahan:</span> {{ $applicant->village ?? '-' }}</div>
                <div><span class="font-medium">Provinsi:</span> {{ $applicant->province ?? '-' }}</div>
            </div>
        </div>

        {{-- Dokumen Terunggah --}}
        <div class="mt-8 p-6 bg-teal-50 rounded-xl shadow-sm border border-teal-200">
            <h4 class="font-bold text-xl text-teal-800 mb-4 border-b pb-2">Berkas Pendaftar</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @php
                    $documentFields = [
                        'document_akta_path' => 'Akta Kelahiran',
                        'document_kk_path' => 'Kartu Keluarga (KK)',
                        'document_ijazah_path' => 'Ijazah Terakhir',
                        'document_photo_path' => 'Pas Foto',
                    ];
                @endphp
                @foreach ($documentFields as $pathColumn => $name)
                    <div class="p-4 border rounded-lg bg-white flex items-center justify-between shadow-sm hover:shadow-md transition-shadow duration-200">
                        <span class="font-medium text-gray-700">{{ $name }}:</span>
                        @if ($applicant->{$pathColumn})
                            <a href="{{ asset('storage/' . $applicant->{$pathColumn}) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center group">
                                Lihat Dokumen
                                <svg class="w-5 h-5 ml-2 -mr-1 text-blue-500 group-hover:text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0l-10 10M14 4H9" />
                                </svg>
                            </a>
                        @else
                            <span class="text-gray-500 italic">Tidak ada</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Catatan Admin --}}
        <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
            <h4 class="font-bold text-xl text-gray-800 mb-4 border-b pb-2">Catatan Internal</h4>
            <p class="italic text-gray-600 leading-relaxed">{{ $applicant->admin_notes ?? 'Belum ada catatan.' }}</p>
        </div>

        {{-- Aksi Navigasi --}}
        <div class="mt-10 text-center border-t pt-6 flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4">
            <a href="{{ route('admin.applicants.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 rounded-full font-semibold text-sm text-gray-700 hover:bg-gray-300 focus:ring-2 focus:ring-gray-300 shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Daftar
            </a>
            <a href="{{ route('admin.applicants.edit', $applicant) }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-full font-semibold text-sm hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-400 shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
                Edit Pendaftar
            </a>
        </div>
    </div>
</div>
@endsection
