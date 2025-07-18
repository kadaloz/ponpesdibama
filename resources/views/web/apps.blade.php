<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    {{-- SEO Meta Tags --}}
    <title>@yield('title', 'Default Title')</title>
    <meta name="description" content="@yield('meta_description', 'Default meta description.')">
    <meta name="keywords" content="@yield('meta_keywords', 'default, keywords')">
    <meta property="og:image" content="@yield('meta_image', asset('images/default-social.png'))"> {{-- Pastikan path ini benar --}}

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">

    {{-- Global CSS (misalnya Tailwind CSS) --}}
    @vite('resources/css/app.css') {{-- Gunakan @vite untuk Tailwind/Vite --}}
    {{-- Atau jika pakai Mix/Webpack lama: <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}

    {{-- Styles dari Stack Khusus Halaman --}}
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">

    {{-- Header Section (Opsional, tergantung desain Anda) --}}
    <header class="bg-teal-700 text-white p-4 shadow-md sticky top-0 z-50">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-2xl font-bold">Pondok Pesantren DIBAMA</a>
            <nav>
                {{-- Navigasi utama, bisa diisi di sini atau di komponen terpisah --}}
                <ul class="flex space-x-4">
                    <li><a href="/" class="hover:text-yellow-300">Beranda</a></li>
                    <li><a href="#tentang" class="hover:text-yellow-300">Tentang Kami</a></li>
                    {{-- Tambahkan link navigasi lainnya --}}
                </ul>
            </nav>
        </div>
    </header>

    {{-- Main Content Section --}}
    <main>
        @yield('main_content')
    </main>

    {{-- Footer Section --}}
    <footer class="bg-gray-800 text-white py-10 mt-20">
        <div class="container mx-auto text-center">
            <p>&copy; {{ date('Y') }} Pondok Pesantren Diniyah Baitul Makmur Aikmel. All rights reserved.</p>
            {{-- Tambahkan link footer, alamat, dll. --}}
        </div>
    </footer>

    {{-- Global JavaScript (misalnya app.js) --}}
    @vite('resources/js/app.js') {{-- Gunakan @vite untuk JavaScript Anda --}}
    {{-- Atau jika pakai Mix/Webpack lama: <script src="{{ asset('js/app.js') }}"></script> --}}

    {{-- Scripts dari Stack Khusus Halaman --}}
    @stack('scripts')
</body>
</html>