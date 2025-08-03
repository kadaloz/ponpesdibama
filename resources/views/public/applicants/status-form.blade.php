@extends('web.apps')
@section('title', 'Cek Status Pendaftaran - PonpesDIBAMA')
@section('meta_description', 'Cek status pendaftaran Anda di PonpesDIBAMA. Masukkan nomor pendaftaran untuk melihat status.')
@section('meta_keywords', 'ppdb online, cek status pendaftaran, pondok pesantren, pendidikan islam')
@section('meta_image', asset('storage/images/logo/pondok.png'))
@section('main_content')
<section class="py-24 md:py-40 bg-teal-600 text-white flex items-center justify-center min-h-[80vh] rounded-b-lg shadow-xl">
    <div class="container mx-auto text-center px-4">
        <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4 drop-shadow-md">
            Cek Status Pendaftaran
        </h2>
        <p class="text-xl md:text-2xl mb-8 opacity-90">
            Masukkan nomor pendaftaran Anda untuk melihat status.
        </p>

        @if (session('status'))
            <p class="text-lg md:text-xl font-semibold mb-8 bg-white text-teal-800 p-4 rounded-lg shadow-md mx-auto max-w-lg">
                {{ session('status') }}
            </p>
        @endif

        <form action="{{ route('ppdb.applicants.status') }}" method="GET" class="max-w-md mx-auto bg-white p-6 rounded-xl shadow-lg">
            @csrf
            <div class="mb-6">
                <label for="registration_number" class="block text-sm font-medium text-gray-700 mb-2">Nomor Pendaftaran</label>
                <input type="text" name="registration_number" id="registration_number" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-teal-500"
                       placeholder="Masukkan nomor pendaftaran Anda">
            </div>
            <button type="submit"
                    class="w-full px-6 py-3 bg-teal-600 text-white rounded-full text-md font-semibold shadow-md hover:bg-teal-700 transition-all duration-300">
                Cek Status
            </button>
        </form>

        <div class="mt-8">
            <a href="{{ url('/') }}" class="inline-flex items-center px-8 py-4 bg-white text-teal-700 rounded-full text-lg font-semibold shadow-lg transition-all duration-300 transform hover:scale-105">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>
@endsection
