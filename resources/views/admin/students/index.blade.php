@extends('layouts.admin')

@section('title', 'Manajemen Data Santri')
@section('header_admin', 'Manajemen Data Santri')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <h3 class="text-3xl font-extrabold text-teal-700 mb-4 md:mb-0">Daftar Santri</h3>
                <div class="flex flex-col sm:flex-row flex-wrap gap-2 sm:gap-4">
                    <a href="{{ route('admin.students.create') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-teal-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-400 shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Tambah Santri Baru
                    </a>
                    <a href="{{ route('admin.students.export') }}" class="inline-flex items-center justify-center px-5 py-2.5 bg-green-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H5a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        Export Excel
                    </a>
                    <form action="{{ route('admin.students.import') }}" method="POST" enctype="multipart/form-data" class="inline-flex items-center">
                        @csrf
                        <label for="import_file" class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 border border-transparent rounded-lg font-semibold text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-md cursor-pointer">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                            Import Excel
                        </label>
                        <input type="file" name="file" id="import_file" class="hidden" onchange="this.form.submit()">
                    </form>
                </div>
            </div>

            {{-- Flash messages --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-5 py-3 rounded-lg relative mb-6 shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-5 py-3 rounded-lg relative mb-6 shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            {{-- Filter --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <form action="{{ route('admin.students.index') }}" method="GET" class="flex flex-col gap-2 md:flex-row md:items-center md:gap-4">
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari santri..." class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-sm">
                    <select name="gender_filter" class="px-7 py-2 border border-gray-300 rounded-md shadow-sm text-sm">
                        <option value="">Jenis Kelamin</option>
                        <option value="Laki-laki" {{ $genderFilter == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ $genderFilter == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    <select name="status_filter" class="px-7 py-2 border border-gray-300 rounded-md shadow-sm text-sm">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status_filter') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="non-aktif" {{ request('status_filter') == 'non-aktif' ? 'selected' : '' }}>Non-Aktif</option>
                        <option value="lulus" {{ request('status_filter') == 'lulus' ? 'selected' : '' }}>Lulus</option>
                    </select>
                    <div class="flex flex-col sm:flex-row gap-2">
                        <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 shadow-sm text-sm">Filter</button>
                        @if ($search || $genderFilter || request('status_filter'))
                            <a href="{{ route('admin.students.index') }}" class="px-3 py-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 shadow-sm text-sm">Reset</a>
                        @endif
                    </div>
                </form>
            </div>

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
                                <td class="px-6 py-4">{{ $student->gender ?? '-' }}</td>
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
                                        <a href="{{ route('admin.students.show', $student) }}" class="text-sm px-3 py-1 bg-gray-200 text-gray-800 rounded-full hover:bg-gray-300">Lihat</a>
                                        <a href="{{ route('admin.students.edit', $student) }}" class="text-sm px-3 py-1 bg-indigo-600 text-white rounded-full hover:bg-indigo-700">Edit</a>
                                        <form action="{{ route('admin.students.destroy', $student) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm px-3 py-1 bg-red-600 text-white rounded-full hover:bg-red-700">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-12">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-300 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c.456 0 .907.05 1.342.144a3.375 3.375 0 11-5.23 2.902 3.376 3.376 0 013.888-3.046zM12 12c1.657 0 3-1.343 3-3S13.657 6 12 6s-3 1.343-3 3 1.343 3 3 3z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 18a8 8 0 0116 0v.25A2.75 2.75 0 0117.25 21H6.75A2.75 2.75 0 014 18.25V18z" />
                                        </svg>
                                        <p class="text-gray-500 italic text-sm">Tidak ada data santri ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $allStudents->onEachSide(1)->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
@endsection
