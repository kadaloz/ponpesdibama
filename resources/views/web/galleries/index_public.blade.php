{{-- resources/views/web/galleries/index_public.blade.php --}}
@extends('web.apps')

@section('title', 'Galeri Kegiatan Pondok - PonpesDIBAMA')

@section('main_content')
    <!-- Hero Section -->
    <section class="py-20 md:py-28 bg-gradient-to-r from-teal-700 to-green-600 text-white rounded-b-3xl shadow-xl">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-6 drop-shadow-lg">Galeri Kegiatan Ponpes DIBAMA</h1>
            <p class="text-xl md:text-2xl opacity-90 max-w-2xl mx-auto">
                Lihat berbagai kegiatan dan momen berharga santri Ponpes DIBAMA.
            </p>
            <a href="{{ url('/') }}" class="mt-10 inline-flex items-center px-8 py-4 bg-white text-teal-700 text-lg font-semibold rounded-full shadow-lg hover:bg-teal-100 transition transform hover:scale-105">
                <x-heroicon-o-arrow-left class="w-5 h-5 mr-2" /> Kembali ke Beranda
            </a>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-16 md:py-24 bg-white rounded-3xl shadow-xl mx-4 md:mx-auto max-w-7xl my-16 animate-fade-in-up">
        <div class="container mx-auto px-4">
            @if ($galleries->isEmpty())
                <p class="text-gray-600 text-center py-8">Belum ada album galeri yang dipublikasi.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($galleries as $gallery)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-transform duration-300 hover:scale-105 hover:shadow-xl border border-gray-200">
                            @if ($gallery->cover_image)
                                <img src="{{ asset('storage/' . $gallery->cover_image) }}" alt="{{ $gallery->title }}" class="w-full h-48 object-cover">
                            @else
                                <img src="https://placehold.co/600x400/D5F5E3/000000?text=No+Cover" alt="No Cover" class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6 text-center">
                                <h3 class="text-xl font-bold text-teal-700 mb-2">{{ $gallery->title }}</h3>
                                <p class="text-gray-700 text-base mb-4">
                                    {{ Str::limit($gallery->description, 70) }}
                                </p>
                                <a href="{{ route('public.galleries.show', $gallery->slug) }}" class="inline-flex items-center text-teal-600 hover:text-teal-800 font-semibold group transition-colors duration-200">
                                    Lihat Album ({{ $gallery->images->count() }} Foto)
                                    <svg class="w-4 h-4 ml-2 transform transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection
