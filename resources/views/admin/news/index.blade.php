{{-- resources/views/admin/news/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manajemen Berita')

@section('header_admin', 'Manajemen Berita & Pengumuman')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <h3 class="text-2xl md:text-3xl font-bold text-teal-700 mb-4 md:mb-0">Daftar Berita & Pengumuman</h3>
                <a href="{{ route('admin.news.create') }}" class="inline-flex items-center px-5 py-2.5 bg-teal-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg transform hover:scale-105">
                    <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Berita Baru
                </a>
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

            @if ($allNews->isEmpty())
                <p class="text-gray-600 text-center py-8 bg-gray-50 rounded-lg border border-gray-200">Belum ada berita atau pengumuman. Klik "Tambah Berita Baru" untuk memulai!</p>
            @else
                <div class="overflow-x-auto bg-white rounded-lg shadow-xl">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Judul</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Kategori</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Gambar</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Tanggal Publikasi</th>
                                <th class="py-3 px-6 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($allNews as $newsItem)
                                <tr class="even:bg-gray-50 hover:bg-gray-100 transition-colors duration-150">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ $newsItem->title }}</td>
                                    <td class="py-4 px-6 text-sm text-gray-700">{{ $newsItem->category?->name ?? 'Umum' }}</td>
                                    <td class="py-4 px-6">
                                        @if ($newsItem->image)
                                            <img src="{{ asset('storage/' . $newsItem->image) }}" alt="{{ $newsItem->title }}" class="h-16 w-16 object-cover rounded-md border border-gray-200 shadow-sm">
                                        @else
                                            <span class="text-gray-400 text-sm italic">Tidak ada gambar</span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-600">
                                        {{ $newsItem->published_at ? \Carbon\Carbon::parse($newsItem->published_at)->format('d M Y') : 'Belum Dipublikasi' }}
                                    </td>
                                    <td class="py-4 px-6 text-center text-sm font-medium whitespace-nowrap">
                                        <a href="{{ route('admin.news.edit', $newsItem) }}" class="inline-flex items-center text-sm px-4 py-2 bg-indigo-600 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                            <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.news.destroy', $newsItem) }}" method="POST" class="inline-block ml-3" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini? Aksi ini tidak dapat dibatalkan.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="inline-flex items-center text-sm px-4 py-2 bg-red-600 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                                <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10H4a1 1 0 01-1-1V5a1 1 0 011-1h16a1 1 0 011 1v1a1 1 0 01-1 1z"></path></svg>
                                                Hapus
                                            </button>
                                        </form>
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
