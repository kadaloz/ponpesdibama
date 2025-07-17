@extends('layouts.admin')

@section('title', 'Manajemen Halaqoh')
@section('header_admin', 'Daftar Halaqoh')

@section('admin_content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-2xl font-bold text-teal-700">Daftar Halaqoh</h3>
            <a href="{{ route('admin.halaqohs.create') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 shadow">
                <x-heroicon-o-plus class="w-5 h-5 mr-2" />
                Tambah Halaqoh
            </a>
        </div>

        {{-- Filter Periode --}}
        <form method="GET" class="mb-4 flex items-center space-x-3">
            <label for="period" class="font-semibold text-sm">Filter Periode:</label>
            <select name="period" id="period" onchange="this.form.submit()" class="border border-gray-300 rounded px-6 py-1">
                <option value="">Semua</option>
                <option value="Sore" {{ request('period') == 'Sore' ? 'selected' : '' }}>Sore</option>
                <option value="Malam" {{ request('period') == 'Malam' ? 'selected' : '' }}>Malam</option>
            </select>
        </form>

        @if($halaqohs->isEmpty())
            <p class="text-gray-600 text-center py-10 bg-gray-50 rounded-lg border border-gray-200">
                Belum ada data halaqoh.
            </p>
        @else
            <div class="overflow-x-auto rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama Halaqoh</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Pengajar</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Periode</th>
                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Santri</th>
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($halaqohs as $halaqoh)
                            <tr class="{{ $halaqoh->student_limit && $halaqoh->students_count >= $halaqoh->student_limit ? 'bg-red-50' : 'hover:bg-gray-50' }}">
                                <td class="px-4 py-2 font-medium text-teal-800">{{ $halaqoh->name }}</td>
                                <td class="px-4 py-2">{{ $halaqoh->teacher->full_name ?? '-' }}</td>
                                <td class="px-4 py-2">{{ ucfirst($halaqoh->period ?? '-') }}</td>
                                <td class="px-4 py-2 text-center font-bold">
                                    {{ $halaqoh->students_count }} / {{ $halaqoh->student_limit ?? '-' }}
                                        @if($halaqoh->student_limit && $halaqoh->students_count >= $halaqoh->student_limit)
                                            <span class="ml-2 inline-block px-2 py-1 text-xs bg-red-600 text-white rounded-full font-semibold">
                                            Penuh </span> 
                                        @endif
                                </td>
                                <td class="px-4 py-2">
                                    @if($halaqoh->status === 'active')
                                        <span class="inline-block px-3 py-1 text-xs bg-green-100 text-green-700 rounded-full">Aktif</span>
                                    @elseif($halaqoh->status === 'completed')
                                        <span class="inline-block px-3 py-1 text-xs bg-blue-100 text-blue-700 rounded-full">Selesai</span>
                                    @else
                                        <span class="inline-block px-3 py-1 text-xs bg-gray-200 text-gray-600 rounded-full">Non-aktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-right space-x-2">
                                    <a href="{{ route('admin.halaqohs.edit', $halaqoh) }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                                    <a href="{{ route('admin.halaqohs.manage_students', $halaqoh) }}" class="text-teal-600 hover:text-teal-800 font-medium">Kelola Santri</a>
                                    <form action="{{ route('admin.halaqohs.destroy', $halaqoh) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 font-medium" onclick="return confirm('Yakin ingin menghapus halaqoh ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{-- Informasi jumlah data --}}
            <div class="mt-6">
                <p class="text-sm text-gray-500">
                    Menampilkan {{ $halaqohs->firstItem() }} - {{ $halaqohs->lastItem() }} dari {{ $halaqohs->total() }} halaqoh
                </p>
            </div>

            {{-- Navigasi pagination --}}
            <div class="mt-4">
                {{ $halaqohs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
