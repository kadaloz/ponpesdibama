@extends('layouts.admin')

@section('title', 'Manajemen Data Santri')
@section('header_admin', 'Manajemen Data Santri')

@section('admin_content')
<div class="bg-white shadow-sm rounded-xl overflow-hidden">
    <div class="p-6 text-gray-900 space-y-6">

        {{-- Header & Action Buttons --}}
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
            <h3 class="text-2xl font-bold text-teal-700">Daftar Santri</h3>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.students.create') }}" class="btn-primary">
                    <x-heroicon-o-plus class="w-5 h-5 mr-1" /> Tambah Santri
                </a>
                <a href="{{ route('admin.students.export') }}" class="btn-green">
                    <x-heroicon-o-arrow-down-tray class="w-5 h-5 mr-1" /> Export Excel
                </a>
                <form action="{{ route('admin.students.import') }}" method="POST" enctype="multipart/form-data" class="relative">
                    @csrf
                    <label for="import_file" class="btn-blue cursor-pointer">
                        <x-heroicon-o-arrow-up-tray class="w-5 h-5 mr-1" /> Import Excel
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
                <button type="submit" class="btn-primary w-full md:w-auto">Filter</button>
                @if ($search || $genderFilter || request('status_filter'))
                    <a href="{{ route('admin.students.index') }}" class="btn-secondary w-full md:w-auto">Reset</a>
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
                                <span class="badge-status {{ $student->status }}">
                                    {{ ucfirst(str_replace('-', ' ', $student->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center space-x-1">
                                <a href="{{ route('admin.students.show', $student) }}" class="btn-sm bg-gray-200 text-gray-800 hover:bg-gray-300">Lihat</a>
                                <a href="{{ route('admin.students.edit', $student) }}" class="btn-sm bg-indigo-600 text-white hover:bg-indigo-700">Edit</a>
                                <form action="{{ route('admin.students.destroy', $student) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm bg-red-600 text-white hover:bg-red-700">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-10 text-gray-500 text-sm italic">
                                Tidak ada data santri ditemukan.
                            </td>
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
