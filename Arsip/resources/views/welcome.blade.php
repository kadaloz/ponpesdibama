<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pondok Pesantren Dinikah Baitulmal Makmur Aikmel</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    {{-- Navbar --}}
    <nav class="bg-white shadow-md p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center space-x-2">
                {{-- Ganti dengan logo pondok Anda --}}
                <img src="https://via.placeholder.com/40" alt="Logo Pondok" class="h-10 w-10 rounded-full">
                <span class="text-xl font-bold text-gray-800">Pondok Pesantren Dinikah Baitulmal Makmur</span>
            </a>
            <div class="space-x-4">
                <a href="#" class="text-gray-600 hover:text-blue-700">Beranda</a>
                <a href="#" class="text-gray-600 hover:text-blue-700">Profil</a>
                <a href="#" class="text-gray-600 hover:text-blue-700">Program</a>
                <a href="#" class="text-gray-600 hover:text-blue-700">Pendaftaran</a>
                <a href="#" class="text-gray-600 hover:text-blue-700">Kontak</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="ml-4 text-sm text-gray-700 underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="ml-4 text-sm text-gray-700 underline">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-r from-blue-700 to-indigo-800 text-white py-20 px-4 text-center">
        {{-- Ganti dengan gambar pondok Anda --}}
        <img src="https://via.placeholder.com/1200x500?text=Gambar+Pondok+Pesantren" alt="Pondok Pesantren" class="absolute inset-0 w-full h-full object-cover opacity-30">
        <div class="relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4">
                Membangun Generasi Unggul Berakhlak Mulia
            </h1>
            <p class="text-xl md:text-2xl mb-8">
                Pondok Pesantren Dinikah Baitulmal Makmur Aikmel
            </p>
            <a href="#" class="inline-block bg-white text-blue-700 hover:bg-gray-200 font-bold py-3 px-8 rounded-full shadow-lg transition duration-300 ease-in-out">
                Daftar Sekarang
            </a>
        </div>
    </section>

    {{-- Section: Tentang Kami --}}
    <section class="py-16 px-4 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Tentang Pondok Kami</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Pondok Pesantren Dinikah Baitulmal Makmur Aikmel adalah lembaga pendidikan Islam yang berkomitmen membentuk santri berilmu, beramal, dan berakhlakul karimah. Kami mengintegrasikan kurikulum salaf dan modern untuk menciptakan generasi yang siap menghadapi tantangan zaman.
            </p>
            <a href="#" class="mt-8 inline-block text-blue-600 hover:underline">Baca Selengkapnya &rarr;</a>
        </div>
    </section>

    {{-- Section: Program Unggulan --}}
    <section class="py-16 px-4 bg-gray-50">
        <div class="container mx-auto">
            <h2 class="text-3xl font-bold text-gray-800 text-center mb-10">Program Unggulan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Program 1 --}}
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="text-blue-600 mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Tahfidzul Qur'an</h3>
                    <p class="text-gray-600">Fokus pada hafalan Al-Qur'an dengan metode talaqqi dan muraja'ah intensif.</p>
                </div>
                {{-- Program 2 --}}
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="text-blue-600 mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3 .895 3 2s-1.343 2-3 2-3-.895-3-2 1.343-2 3-2zM12 18s-2.5-2-4-3.5c-1.5-1.5-3-2.5-3-4.5 0-3.313 2.687-6 6-6s6 2.687 6 6c0 2-1.5 3-3 4.5-1.5 1.5-4 3.5-4 3.5z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Kajian Kitab Kuning</h3>
                    <p class="text-gray-600">Pembelajaran mendalam kitab-kitab klasik Islam dari berbagai disiplin ilmu.</p>
                </div>
                {{-- Program 3 --}}
                <div class="bg-white p-6 rounded-lg shadow-md text-center">
                    <div class="text-blue-600 mb-4">
                        <svg class="w-12 h-12 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17L12 20L15 17M9 7L12 4L15 7M6 10H18M6 14H18"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-3">Pengembangan Bahasa</h3>
                    <p class="text-gray-600">Program intensif Bahasa Arab dan Bahasa Inggris untuk komunikasi aktif.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-white py-8 px-4">
        <div class="container mx-auto text-center md:flex md:justify-between md:items-center">
            <div class="mb-4 md:mb-0">
                <p>&copy; {{ date('Y') }} Pondok Pesantren Dinikah Baitulmal Makmur. All rights reserved.</p>
            </div>
            <div class="space-x-4">
                <a href="#" class="text-gray-400 hover:text-white">Kebijakan Privasi</a>
                <a href="#" class="text-gray-400 hover:text-white">Syarat & Ketentuan</a>
                {{-- Tambahkan ikon media sosial di sini jika diinginkan --}}
            </div>
        </div>
    </footer>

</body>
</html>