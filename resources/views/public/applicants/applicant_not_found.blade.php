@extends('web.apps')
@section('title', 'Pendaftar Tidak Ditemukan - PonpesDIBAMA')
@section('meta_description', 'Halaman ini menampilkan pesan bahwa pendaftar tidak ditemukan. Pastikan nomor registrasi yang dimasukkan benar.')
@section('meta_keywords', 'pendaftar tidak ditemukan, ppdb online, pondok pesantren, pendidikan islam')
@section('meta_image', asset('storage/images/logo/pondok.png'))
@section('main_content')
<section class="py-24 md:py-40 bg-gray-100 text-gray-800 flex items-center justify-center min-h-[80vh] rounded-b-lg shadow-xl">
    <div class="container mx-auto text-center px-4">
        <h2 class="text-3xl md:text-4xl font-extrabold leading-tight mb-4">
            Pendaftar Tidak Ditemukan
        </h2>
        <p class="text-lg md:text-xl mb-8">
            Pastikan nomor registrasi yang kamu masukkan sudah benar.
        </p>
        <a href="{{ url('/') }}" class="inline-flex items-center px-8 py-4 bg-teal-600 text-white rounded-full text-lg font-semibold shadow-lg transition-all duration-300 transform hover:scale-105">
            Kembali ke Beranda
        </a>
    </div>
</section>
@endsection
