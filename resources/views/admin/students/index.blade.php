@extends('layouts.admin')

@section('title', 'Manajemen Data Santri')
@section('header_admin', 'Manajemen Data Santri')

@section('admin_content')
<div class="bg-white shadow-sm rounded-xl overflow-hidden">
    <div class="p-6 text-gray-900 space-y-6">

        {{-- Header & Tombol Aksi --}}
        <div class="mb-8 space-y-4 md:space-y-0 md:flex md:items-center md:justify-between">
            <h3 class="text-2xl md:text-3xl font-bold text-teal-700">Daftar Santri</h3>

            <div class="flex flex-col sm:flex-row flex-wrap gap-3">
                <a href="{{ route('admin.students.create') }}" class="flex items-center px-4 py-2 bg-teal-600 text-white text-sm font-semibold rounded-md shadow hover:bg-teal-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Santri
                </a>

                <a href="{{ route('admin.students.export') }}" class="flex items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-md shadow hover:bg-green-700 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H5a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Export Excel
                </a>

                <form action="{{ route('admin.students.import') }}" method="POST" enctype="multipart/form-data" class="relative">
                    @csrf
                    <label for="import_file" class="flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-md shadow cursor-pointer hover:bg-blue-700 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                        </svg>
                        Import Excel
                    </label>
                    <input type="file" name="file" id="import_file" class="absolute inset-0 opacity-0 cursor-pointer" onchange="this.form.submit()">
                </form>
            </div>
        </div>

        {{-- Flash Message --}}
        @if (session('success') || session('error'))
            <div class="p-4 rounded-md {{ session('success') ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ session('success') ?? session('error') }}
            </div>
        @endif

        {{-- Filter Form --}}
        <form action="{{ route('admin.students.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama atau NIS"
                class="form-input w-full" />

            <select name="gender_filter" class="form-select w-full">
                <option value="">Jenis Kelamin</option>
                <option value="Laki-laki" {{ $genderFilter == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="Perempuan" {{ $genderFilter == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>

            <select name="status_filter" class="form-select w-full">
                <option value="">Status</option>
                <option value="aktif" {{ request('status_filter') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="non-aktif" {{ request('status_filter') == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                <option value="lulus" {{ request('status_filter') == 'lulus' ? 'selected' : '' }}>Lulus</option>
            </select>

            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-teal-600 text-white text-sm rounded-md hover:bg-teal-700 shadow-sm">Filter</button>
                @if ($search || $genderFilter || request('status_filter'))
                    <a href="{{ route('admin.students.index') }}" class="px-3 py-2 bg-red-100 text-red-700 text-sm rounded-md hover:bg-red-200 shadow-sm">Reset</a>
                @endif
            </div>
        </form>

        {{-- Tabel Santri --}}
        <div class="overflow-x-auto border border-gray-200 rounded-lg">
            <table class="w-full text-sm text-left divide-y divide-gray-200">
                <thead class="bg-gray-50 text-gray-700 font-semibold">
                    <tr>
                        <th class="px-6 py-3">NIS</th>
                        <th class="px-6 py-3">Nama</th>
                        <th class="px-6 py-3">Jenis Kelamin</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($allStudents as $student)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $student->nis ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $student->name }}</td>
                            <td class="px-6 py-4">{{ $student->gender ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-2 py-1 text-xs font-medium rounded-full {{
                                    $student->status == 'aktif' ? 'bg-green-100 text-green-800' :
                                    ($student->status == 'non-aktif' ? 'bg-yellow-100 text-yellow-800' :
                                    ($student->status == 'lulus' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'))
                                }}">
                                    {{ ucfirst(str_replace('-', ' ', $student->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center space-x-1">
                                <a href="{{ route('admin.students.show', $student) }}" class="text-sm px-3 py-1 bg-gray-200 text-gray-800 rounded-full hover:bg-gray-300">Lihat</a>
                                <a href="{{ route('admin.students.edit', $student) }}" class="text-sm px-3 py-1 bg-indigo-600 text-white rounded-full hover:bg-indigo-700">Edit</a>
                                <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm px-3 py-1 bg-red-600 text-white rounded-full hover:bg-red-700">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-500 text-sm italic">Tidak ada data santri ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="pt-6">
            {{ $allStudents->onEachSide(1)->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>
@endsection
