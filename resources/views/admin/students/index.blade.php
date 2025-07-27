@extends('layouts.admin')

@section('title', 'Manajemen Data Santri')
@section('header_admin', 'Manajemen Data Santri')

@section('admin_content')
@php
    use App\Models\Program;
    $programOptions = \App\Models\Program::orderBy('name')->get();
    $periodOptions = ['Sore', 'Malam'];
@endphp

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-8 text-gray-900">
        <div class="flex flex-col md:flex-row justify-between items-center mb-8">
            <h3 class="text-3xl font-extrabold text-teal-700 mb-4 md:mb-0">Daftar Santri</h3>
        </div>

        {{-- Tombol Import & Export di kanan atas --}}
<div class="flex justify-end mb-4">
    <div class="flex gap-2">
        <a href="{{ route('admin.students.import') }}"
           class="inline-flex items-center px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-lg hover:bg-yellow-600 transition">
            <x-heroicon-o-arrow-up-tray class="w-5 h-5 mr-2" /> Import
        </a>

        <a href="{{ route('admin.students.export', request()->query()) }}"
           class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition">
            <x-heroicon-o-arrow-down-tray class="w-5 h-5 mr-2" /> Export
        </a>
    </div>
</div>


        {{-- Form Filter dan Tombol --}}
        <form method="GET" action="{{ route('admin.students.index') }}" class="mb-6">
            <div class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                <div class="md:col-span-2">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Nama / NIS / Alamat / Ortu</label>
                    <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Contoh: Ahmad / 1023" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 text-sm">
                </div>
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 text-sm">
                        <option value="">Semua</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="non-aktif" {{ request('status') == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        <option value="lulus" {{ request('status') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                    </select>
                </div>
                <div>
                    <label for="gender_filter" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                    <select name="gender_filter" id="gender_filter" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 text-sm">
                        <option value="">Semua</option>
                        <option value="Laki-laki" {{ request('gender_filter') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ request('gender_filter') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Kategori Santri</label>
                    <select name="type" id="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 text-sm" onchange="document.getElementById('period-group').classList.toggle('hidden', this.value !== 'Pulang-Pergi')">
                        <option value="">Semua</option>
                        <option value="Asrama" {{ request('type') == 'Asrama' ? 'selected' : '' }}>Asrama</option>
                        <option value="Pulang-Pergi" {{ request('type') == 'Pulang-Pergi' ? 'selected' : '' }}>Pulang-Pergi</option>
                    </select>
                </div>
                <div id="period-group" class="{{ request('type') !== 'Pulang-Pergi' ? 'hidden' : '' }}">
                    <label for="period" class="block text-sm font-medium text-gray-700 mb-1">Periode</label>
                    <select name="period" id="period" class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 text-sm">
                        <option value="">Semua</option>
                        @foreach ($periodOptions as $period)
                            <option value="{{ $period }}" {{ request('period') == $period ? 'selected' : '' }}>{{ $period }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        {{-- Tabel --}}
        <div class="overflow-x-auto bg-white rounded-lg shadow-xl border border-gray-200">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left font-medium text-gray-700">NIS</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700">Nama</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700">Jenis Kelamin</th>
                        <th class="px-6 py-3 text-left font-medium text-gray-700">Status</th>
                        <th class="px-6 py-3 text-center font-medium text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($allStudents as $student)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $student->nis ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $student->name }}</td>
                            <td class="px-6 py-4">{{ $student->gender ? ucwords(strtolower($student->gender)) : '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{
                                    $student->status == 'aktif' ? 'bg-green-100 text-green-800' :
                                    ($student->status == 'non-aktif' ? 'bg-yellow-100 text-yellow-800' :
                                    ($student->status == 'lulus' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'))
                                }}">
                                    {{ ucfirst(str_replace('-', ' ', $student->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center flex-wrap gap-2">
                                    @can('view students')
                                        <a href="{{ route('admin.students.show', $student) }}" class="text-sm px-3 py-1 bg-gray-200 text-gray-800 rounded-full hover:bg-gray-300">Lihat</a>
                                    @endcan
                                    @can('edit students')
                                        <a href="{{ route('admin.students.edit', $student) }}" class="text-sm px-3 py-1 bg-indigo-600 text-white rounded-full hover:bg-indigo-700">Edit</a>
                                    @endcan
                                    @can('delete students')
                                        <form action="{{ route('admin.students.destroy', $student) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm px-3 py-1 bg-red-600 text-white rounded-full hover:bg-red-700">Hapus</button>
                                        </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12">
                                <div class="flex flex-col items-center">
                                    <svg class="w-16 h-16 text-gray-300 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c.456 0 .907.05 1.342.144a3.375 3.375 0 11-5.23 2.902 3.376 3.376 0 013.888-3.046zM12 12c1.657 0 3-1.343 3-3S13.657 6 12 6s-3 1.343-3 3 1.343 3 3 3z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 18a8 8 0 0116 0v.25A2.75 2.75 0 0117.25 21H6.75A2.75 2.75 0 014 18.25V18z"/>
                                    </svg>
                                    <p class="text-gray-500 italic text-sm">Tidak ada data santri ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $allStudents->onEachSide(1)->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>
@endsection
