-- resources/views/web/news/show.blade.php --
@extends('web.apps')

@section('title', $news->title . ' - Berita PonpesDIBAMA')

@section('main_content')
    <!-- Hero Section -->
    <section class="py-20 md:py-28 bg-gradient-to-r from-teal-700 to-green-600 text-white text-center rounded-b-3xl shadow-xl">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4 drop-shadow-lg">{{ $news->title }}</h1>
            <p class="text-sm md:text-base text-white opacity-80 italic">
                Dipublikasi pada {{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->translatedFormat('d F Y H:i') : 'Tanggal Tidak Tersedia' }} WIB
            </p>
        </div>
    </section>

    <!-- News Content -->
    <section class="py-16 bg-white px-6 md:px-0 mx-auto max-w-5xl animate-fade-in-up">
        <div class="px-4 md:px-8">
            @if ($news->image)
                <div class="mb-10">
                    <img src="{{ asset('storage/' . $news->image) }}" alt="{{ $news->title }}" class="w-full max-h-[450px] object-cover rounded-xl shadow-md border border-gray-100">
                </div>
            @endif

            <article class="prose prose-lg lg:prose-xl max-w-none text-gray-800 leading-relaxed text-justify">
                {!! $news->content !!}
            </article>

            <div class="mt-12 text-center border-t pt-6">
                <a href="{{ route('news.index_public') }}" class="inline-flex items-center px-6 py-3 bg-teal-600 text-white text-sm font-semibold rounded-full shadow-md hover:bg-teal-700 transition-all hover:scale-105">
                    <x-heroicon-o-arrow-left class="w-5 h-5 mr-2" /> Kembali ke Daftar Berita
                </a>
            </div>
        </div>
    </section>
@endsection
