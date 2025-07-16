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
                            <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($halaqohs as $halaqoh)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm font-medium text-teal-800">{{ $halaqoh->name }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $halaqoh->teacher->full_name ?? '-' }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ ucfirst($halaqoh->halaqoh_period ?? '-') }}</td>
                                <td class="px-4 py-2 text-sm">
                                    @if($halaqoh->status === 'active')
                                        <span class="inline-block px-3 py-1 text-xs font-semibold bg-green-100 text-green-700 rounded-full">Aktif</span>
                                    @elseif($halaqoh->status === 'completed')
                                        <span class="inline-block px-3 py-1 text-xs font-semibold bg-blue-100 text-blue-700 rounded-full">Selesai</span>
                                    @else
                                        <span class="inline-block px-3 py-1 text-xs font-semibold bg-gray-200 text-gray-600 rounded-full">Non-aktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-sm text-right space-x-2">
                                    <a href="{{ route('admin.halaqohs.edit', $halaqoh) }}" class="inline-block text-indigo-600 hover:text-indigo-900 font-medium">Edit</a>
                                    <a href="{{ route('admin.halaqohs.show', $halaqoh) }}" class="inline-block text-teal-600 hover:text-teal-800 font-medium">Detail</a>
                                    <a href="{{ route('admin.halaqohs.manage_students', $halaqoh) }}" class="inline-block text-blue-600 hover:text-blue-800 font-medium">Kelola Santri</a>
            
                                    <form action="{{ route('admin.halaqohs.destroy', $halaqoh) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus halaqoh ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 font-medium">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $halaqohs->links() }} {{-- Pagination --}}
            </div>
        @endif
    </div>
</div>
@endsection
