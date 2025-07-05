{{-- resources/views/web/galleries/show.blade.php --}}
@extends('web.apps')

@section('title', $gallery->title . ' - Galeri PonpesDIBAMA')

@section('main_content')
    <!-- Hero Section -->
    <section class="py-20 md:py-28 bg-gradient-to-r from-teal-700 to-green-600 text-white rounded-b-3xl shadow-xl">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-lg">{{ $gallery->title }}</h1>
            <p class="text-xl md:text-2xl opacity-90 mb-4 max-w-2xl mx-auto">{{ $gallery->description ?? 'Tidak ada deskripsi.' }}</p>
            <p class="text-sm opacity-80">Terakhir diperbarui: {{ $gallery->updated_at->format('d F Y') }}</p>
            <a href="{{ route('public.galleries.index') }}" class="mt-8 inline-flex items-center px-8 py-3 bg-white text-teal-700 text-base font-semibold rounded-full shadow-md hover:bg-teal-100 transition transform hover:scale-105">
                <x-heroicon-o-arrow-left class="w-5 h-5 mr-2" /> Kembali ke Semua Galeri
            </a>
        </div>
    </section>

    <!-- Gallery Images -->
    <section class="py-16 md:py-24 bg-white rounded-3xl shadow-xl mx-4 md:mx-auto max-w-7xl my-16 animate-fade-in-up">
        <div class="container mx-auto px-4">
            @if ($gallery->images->isEmpty())
                <p class="text-gray-600 text-center py-8">Belum ada gambar dalam album ini.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($gallery->images->sortBy('order') as $image)
                        <div class="relative group overflow-hidden rounded-xl shadow-lg border border-gray-200">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->caption }}" class="w-full h-64 object-cover transform transition-transform duration-300 group-hover:scale-110">
                            <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-xl p-4">
                                <p class="text-white text-lg font-semibold text-center">{{ $image->caption ?? 'Tanpa Keterangan' }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
