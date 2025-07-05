{{-- resources/views/admin/galleries/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Detail Album: ' . $gallery->title)
@section('header_admin', 'Detail Album Galeri')

@section('admin_content')
<div class="bg-white max-w-6xl mx-auto p-8 rounded-3xl shadow-xl text-gray-900 space-y-12">

    {{-- Judul --}}
    <div class="text-center">
        <h1 class="text-3xl font-extrabold text-teal-700">Detail Album Galeri</h1>
        <p class="mt-2 text-xl font-semibold text-gray-800">{{ $gallery->title }}</p>
    </div>

    {{-- Informasi Album --}}
    <section class="bg-teal-50 border border-teal-200 rounded-xl shadow-inner p-6">
        <h2 class="text-xl font-bold text-teal-700 mb-4">Informasi Album</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-12 text-base text-gray-800">
            <div>
                <span class="font-medium">Status:</span>
                <span class="ml-2 inline-block px-3 py-1 rounded-full text-sm font-semibold 
                    {{ $gallery->is_published ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                    {{ $gallery->is_published ? 'Publik' : 'Draft' }}
                </span>
            </div>
            <div>
                <span class="font-medium">Tanggal Dibuat:</span>
                <p class="mt-1 text-gray-700">{{ $gallery->created_at->format('d F Y, H:i') }}</p>
            </div>
            <div>
                <span class="font-medium">Terakhir Diperbarui:</span>
                <p class="mt-1 text-gray-700">{{ $gallery->updated_at->format('d F Y, H:i') }}</p>
            </div>
            <div class="md:col-span-2">
                <span class="font-medium">Deskripsi:</span>
                <p class="mt-2 text-gray-700 italic">{{ $gallery->description ?? 'Tidak ada deskripsi.' }}</p>
            </div>
        </div>
    </section>

    {{-- Gambar Cover --}}
    <section>
        <h2 class="text-xl font-bold text-gray-800 mb-4">Gambar Cover</h2>
        @if ($gallery->cover_image)
            <div class="flex justify-center">
                <img src="{{ asset('storage/' . $gallery->cover_image) }}" alt="Cover Album"
                    class="rounded-2xl max-w-xs w-full shadow-lg border border-gray-300">
            </div>
        @else
            <p class="text-gray-500 italic">Tidak ada gambar cover.</p>
        @endif
    </section>

    {{-- Gambar di dalam Album --}}
    <section>
        <h2 class="text-xl font-bold text-gray-800 mb-4">
            Gambar dalam Album <span class="text-sm font-normal text-gray-500">({{ $gallery->images->count() }})</span>
        </h2>
        @if ($gallery->images->isEmpty())
            <p class="text-gray-500 italic">Belum ada gambar yang ditambahkan ke dalam album ini.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($gallery->images->sortBy('order') as $image)
                    <div class="relative group overflow-hidden rounded-xl shadow-md border border-gray-200">
                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->caption ?? 'Tanpa Keterangan' }}"
                            class="w-full h-48 object-cover transition-transform duration-300 transform group-hover:scale-105">
                        <div class="absolute inset-0 bg-black bg-opacity-60 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                            <div class="text-center text-white px-2 text-sm">
                                <p>{{ $image->caption ?? 'Tanpa Keterangan' }}</p>
                                <span class="text-xs text-gray-300">Urutan: {{ $image->order }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>

    {{-- Tombol Navigasi --}}
    <div class="flex justify-end gap-4 pt-8 border-t">
        <a href="{{ route('admin.galleries.index') }}"
           class="inline-flex items-center px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-full shadow text-sm font-semibold transition">
            ← Kembali
        </a>
        <a href="{{ route('admin.galleries.edit', $gallery) }}"
           class="inline-flex items-center px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-full shadow text-sm font-semibold transition">
            ✎ Edit Album
        </a>
    </div>
</div>
@endsection
