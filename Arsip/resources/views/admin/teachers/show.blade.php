@extends('layouts.admin')

@section('title', 'Detail Pengajar: ' . $teacher->full_name)
@section('header_admin', 'Detail Data Pengajar')

@section('admin_content')
<div class="bg-white shadow sm:rounded-lg p-8">
    <h2 class="text-2xl font-bold text-teal-700 mb-6 border-b pb-3">Profil Lengkap Pengajar</h2>

    {{-- Ringkasan --}}
    <div class="bg-teal-50 border border-teal-200 rounded-lg p-6 mb-8">
        <h3 class="text-lg font-semibold text-teal-800 mb-4">Informasi Umum</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-700">
            <div>
                <p class="text-sm font-medium text-gray-600">NIP</p>
                <p class="text-lg font-semibold">{{ $teacher->nip ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600">Nama Lengkap</p>
                <p class="text-lg font-semibold">{{ $teacher->full_name }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600">Spesialisasi</p>
                <p class="text-base">{{ $teacher->specialization ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600">Status</p>
                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold {{
                    $teacher->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                }}">
                    {{ ucfirst($teacher->status) }}
                </span>
            </div>
            <div class="sm:col-span-2">
                <p class="text-sm font-medium text-gray-600">Akun Pengguna</p>
                @if ($teacher->user)
                    <p class="text-base">{{ $teacher->user->name }} ({{ $teacher->user->email }})</p>
                @else
                    <p class="text-base italic text-gray-500">Belum terhubung dengan akun pengguna.</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Detail Pribadi --}}
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pribadi</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-700">
            <div>
                <p class="text-sm font-medium text-gray-600">Jenis Kelamin</p>
                <p class="text-base">{{ $teacher->gender ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600">Tempat, Tanggal Lahir</p>
                <p class="text-base">
                    {{ $teacher->place_of_birth ?? '-' }},
                    {{ $teacher->date_of_birth ? \Carbon\Carbon::parse($teacher->date_of_birth)->translatedFormat('d F Y') : '-' }}
                </p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600">No. Telepon</p>
                <p class="text-base">{{ $teacher->phone_number ?? '-' }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-600">Tanggal Bergabung</p>
                <p class="text-base">
                    {{ $teacher->join_date ? \Carbon\Carbon::parse($teacher->join_date)->translatedFormat('d F Y') : '-' }}
                </p>
            </div>
        </div>
    </div>

    {{-- Tombol --}}
    <div class="mt-8 flex justify-end gap-3 border-t pt-6">
        <a href="{{ route('admin.teachers.index') }}"
           class="inline-flex items-center px-5 py-2 rounded-full bg-gray-200 hover:bg-gray-300 text-sm font-medium text-gray-700 transition">
            <x-heroicon-o-arrow-left class="w-4 h-4"/>
            Kembali
        </a>
        <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
           class="inline-flex items-center px-5 py-2 rounded-full bg-indigo-600 hover:bg-indigo-700 text-sm font-medium text-white transition">
           <x-heroicon-o-pencil class="w-4 h-4 mr-2" />
            Edit
        </a>
    </div>
</div>
@endsection
