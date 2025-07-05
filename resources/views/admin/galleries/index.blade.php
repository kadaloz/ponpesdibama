{{-- resources/views/admin/galleries/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manajemen Galeri')

@section('header_admin', 'Manajemen Galeri Kegiatan Pondok')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <h3 class="text-2xl md:text-3xl font-bold text-teal-700 mb-4 md:mb-0">Daftar Album Galeri</h3>
                @can('create galleries') {{-- Tombol Tambah hanya jika memiliki izin create --}}
                    <a href="{{ route('admin.galleries.create') }}" class="inline-flex items-center px-5 py-2.5 bg-teal-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg transform hover:scale-105">
                        <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Album Baru
                    </a>
                @endcan
            </div>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg relative mb-4 shadow-sm" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if ($allGalleries->isEmpty())
                <p class="text-gray-600 text-center py-8 bg-gray-50 rounded-lg border border-gray-200">Belum ada album galeri yang terdaftar.</p>
            @else
                <div class="overflow-x-auto bg-white rounded-lg shadow-xl">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Cover</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Judul Album</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Jumlah Gambar</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="py-3 px-6 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($allGalleries as $gallery)
                                <tr class="even:bg-gray-50 hover:bg-gray-100 transition-colors duration-150">
                                    <td class="py-4 px-6">
                                        @if ($gallery->cover_image)
                                            <img src="{{ asset('storage/' . $gallery->cover_image) }}" alt="{{ $gallery->title }}" class="h-16 w-16 object-cover rounded-md border border-gray-200 shadow-sm">
                                        @else
                                            <span class="text-gray-400 text-sm italic">Tidak ada</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ $gallery->title }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-600">{{ $gallery->images->count() }}</td>
                                    <td class="py-4 px-6 text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $gallery->is_published ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $gallery->is_published ? 'Publik' : 'Draft' }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-center text-sm font-medium whitespace-nowrap">
                                        @can('view galleries') {{-- Tombol Lihat ke detail admin --}}
                                            <a href="{{ route('admin.galleries.show', $gallery) }}" class="inline-flex items-center text-sm px-4 py-2 bg-gray-200 border border-transparent rounded-full font-semibold text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                                <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z"></path></svg>
                                                Lihat
                                            </a>
                                        @endcan
                                        @can('edit galleries') {{-- Tombol Edit --}}
                                            <a href="{{ route('admin.galleries.edit', $gallery) }}" class="inline-flex items-center text-sm px-4 py-2 bg-indigo-600 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md ml-3">
                                                <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                Edit
                                            </a>
                                        @endcan
                                        @can('delete galleries') {{-- Tombol Hapus --}}
                                            <form action="{{ route('admin.galleries.destroy', $gallery) }}" method="POST" class="inline-block ml-3" onsubmit="return confirm('Apakah Anda yakin ingin menghapus album ini beserta semua gambarnya? Aksi ini tidak dapat dibatalkan.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center text-sm px-4 py-2 bg-red-600 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                                    <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10H4a1 1 0 01-1-1V5a1 1 0 011-1h16a1 1 0 011 1v1a1 1 0 01-1 1z"></path></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection