@extends('layouts.admin')

@section('title', 'Manajemen Kamar Asrama')
@section('header_admin', 'Daftar Kamar Asrama')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-teal-700">Daftar Kamar Asrama</h3>
                <a href="{{ route('admin.rooms.create') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <x-heroicon-o-plus class="w-4 h-4 mr-2" /> Tambah Kamar
                </a>
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

            @if ($rooms->isEmpty())
                <p class="text-gray-600 text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
                    Belum ada kamar yang terdaftar. Silakan tambahkan kamar baru.
                </p>
            @else
                <div class="overflow-x-auto rounded-lg shadow">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nomor Kamar</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kapasitas</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenis Kelamin</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="py-3 px-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($rooms as $room)
                                <tr class="hover:bg-gray-50">
                                    <td class="py-2 px-4 text-sm font-medium text-teal-700">{{ $room->room_number }}</td>
                                    <td class="py-2 px-4 text-sm text-gray-800">{{ $room->capacity }}</td>
                                    <td class="py-2 px-4 text-sm text-gray-700 capitalize">{{ $room->gender_type }}</td>
                                    <td class="py-2 px-4 text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                            @if ($room->status == 'available') bg-green-100 text-green-800
                                            @elseif ($room->status == 'full') bg-red-100 text-red-800
                                            @elseif ($room->status == 'renovation') bg-blue-100 text-blue-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $room->status)) }}
                                        </span>
                                    </td>
                                    <td class="py-2 px-4 text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.rooms.show', $room) }}" class="text-blue-600 hover:text-blue-900" title="Detail">
                                                <x-heroicon-o-eye class="w-5 h-5" />
                                            </a>
                                            <a href="{{ route('admin.rooms.edit', $room) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                                <x-heroicon-o-pencil-square class="w-5 h-5" />
                                            </a>
                                            <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini? Aksi ini tidak dapat dibatalkan.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                                    <x-heroicon-o-trash class="w-5 h-5" />
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $rooms->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection