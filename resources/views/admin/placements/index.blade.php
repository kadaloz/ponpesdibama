@extends('layouts.admin')

@section('title', 'Manajemen Penempatan Santri')
@section('header_admin', 'Daftar Penempatan Santri Aktif')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-teal-700">Penempatan Santri Aktif</h3>
                @can('create placements')
                    <button type="button" class="inline-flex items-center px-4 py-2 bg-teal-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest opacity-50 cursor-not-allowed" disabled>
                        <x-heroicon-o-lock-closed class="w-4 h-4 mr-2" /> Tempatkan Santri
                    </button>
                @endcan
            </div>

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

            @if ($activePlacements->isEmpty())
                <p class="text-gray-600 text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
                    Tidak ada santri yang sedang ditempatkan di kamar asrama.
                </p>
            @else
                <div class="overflow-x-auto rounded-lg shadow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Santri</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nomor Kamar</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Mulai Menempati</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($activePlacements as $placement)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-2 px-4 text-sm font-medium text-teal-700">
                                        <a href="{{ route('admin.students.show', $placement->student->id) }}" class="hover:underline">{{ $placement->student->name }}</a>
                                    </td>
                                    <td class="py-2 px-4 text-sm text-gray-800">
                                        <a href="{{ route('admin.rooms.show', $placement->room->id) }}" class="hover:underline">{{ $placement->room->room_number }}</a>
                                    </td>
                                    <td class="py-2 px-4 text-sm text-gray-700">{{ $placement->start_date->format('d M Y') }}</td>
                                    <td class="py-2 px-4 text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            @can('edit placements')
                                                <a href="{{ route('admin.placements.edit', $placement) }}" class="text-indigo-600 hover:text-indigo-900" title="Pindah/Akhiri Penempatan">
                                                    <x-heroicon-o-arrow-path class="w-5 h-5" />
                                                </a>
                                            @endcan
                                                @can('delete placements')
                                                <form action="{{ route('admin.placements.remove', $placement) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus penempatan ini? Ini harusnya hanya untuk koreksi data, bukan mengakhiri penempatan.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus Penempatan (Darurat)">
                                                        <x-heroicon-o-trash class="w-5 h-5" />
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $activePlacements->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection