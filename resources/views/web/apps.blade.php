<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> {{-- Pastikan selalu ada --}}

    {{-- SEO: Title dan Meta --}}
    <title>@yield('title', 'Pondok Pesantren Dibama - Pendidikan Islam Unggul')</title>
    <meta name="description" content="@yield('meta_description', 'Website resmi Pondok Pesantren Diniyah Baitul Makmur Aikmel, lembaga pendidikan Islam yang mencetak generasi Qur’ani dan berakhlak mulia.')">
    <meta name="keywords" content="@yield('meta_keywords', 'pondok pesantren, dibama, pesantren aikmel, pendidikan islam, ppdb online, tahfidz, bahasa arab')">
    <meta name="author" content="Pondok Pesantren DIBAMA">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}"/>

    {{-- Open Graph (Facebook / WhatsApp) --}}
    <meta property="og:title" content="@yield('title', 'Pondok Pesantren Dibama - Pendidikan Islam Unggul')"/>
    <meta property="og:description" content="@yield('meta_description')"/>
    {{-- Pastikan `og-default.jpg` ada di `public/storage/images/` atau ubah path sesuai lokasi --}}
    <meta property="og:image" content="@yield('meta_image', asset('storage/images/og-default.jpg'))"/> 
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:type" content="website"/>

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="@yield('title')"/>
    <meta name="twitter:description" content="@yield('meta_description')"/>
    <meta name="twitter:image" content="@yield('meta_image', asset('storage/images/og-default.jpg'))"/>

    {{-- Favicon --}}
    {{-- Pastikan `dibama.ico` dan `dibama.png` ada di `public/storage/images/logo/` --}}
    <link rel="icon" href="{{ asset('storage/images/logo/dibama.ico') }}" sizes="32x32">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('storage/images/logo/dibama.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/logo/dibama.png') }}">

    {{-- Structured Data (Perbarui alamat sesuai data aktual) --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "Pondok Pesantren Diniyah Baitul Makmur Aikmel",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('storage/images/logo/dibama.png') }}",
        "description": "Website resmi Pondok Pesantren DIBAMA Aikmel, lembaga pendidikan Islam unggul membina generasi Qur'ani dan berakhlak mulia.",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+6281916577540", {{-- Format tanpa spasi atau tanda hubung untuk telepon --}}
            "contactType": "Customer Support"
        },
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Jl. Raya Aikmel - Terara, Kec. Aikmel", {{-- Contoh: Perbarui ini --}}
            "addressLocality": "Aikmel",
            "addressRegion": "Nusa Tenggara Barat",
            "postalCode": "83653",
            "addressCountry": "ID"
        },
        "hasMap": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.381239871545!2d116.4841643147841!3d-8.683050993510507!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dcc3941a5f6e80b%3A0xc6c4d7e2c9e7e7e!2sPondok%20Pesantren%20Diniyah%20Baitul%20Makmur%20Aikmel!5e0!3m2!1sen!2sid!4v1678888888888!5m2!1sen!2sid" {{-- Ganti dengan URL peta aktual Anda --}}
    }
    </script>

    {{-- Styles & Fonts --}}
    {{-- Pastikan Vite terinstal dan berjalan (npm run dev/build) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            scroll-behavior: smooth; /* Untuk smooth scrolling bawaan browser */
        }

        /* Kelas font tambahan untuk teks Arab */
        .font-amiri { font-family: 'Amiri', serif; }
        .font-noto-urdu { font-family: 'Noto Nastaliq Urdu', serif; }

        /* Custom styles for section titles */
        .section-title {
            @apply text-4xl md:text-5xl lg:text-6xl font-extrabold text-center mb-12;
            @apply bg-clip-text text-transparent bg-gradient-to-r from-teal-700 to-blue-700 drop-shadow-xl;
        }

        /* Apply rounded corners to images (Global, bisa di-override dengan kelas spesifik) */
        img {
            @apply rounded-lg shadow-md;
        }

        /* Basic animations */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
        .animate-fade-in-down { animation: fadeInDown 1s ease-out forwards; }
        .animate-fade-in-up { animation: fadeInUp 1s ease-out forwards 0.5s; }
        .animate-bounce { animation: bounce 1s infinite alternate; }

        /* Modal specific styles */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border-radius: 0.5rem;
            width: 80%;
            max-width: 500px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            position: relative;
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Scroll-margin-top untuk semua section yang memiliki ID */
        section[id] {
            scroll-margin-top: 150px; /* Sesuaikan nilai ini jika masih terpotong setelah sticky header */
        }

        .nav-link {
             @apply block px-4 py-2 rounded-full transition-colors duration-200 
             hover:bg-teal-100 hover:text-teal-900 
             focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-teal-400;
        }
        
        /* Gaya untuk link navigasi yang sedang aktif */
        .nav-link.active {
             @apply bg-yellow-600 text-white shadow-md;
        }

        /* Alpine.js x-cloak untuk menyembunyikan elemen sebelum Alpine diinisialisasi */
        [x-cloak] {
            display: none !important;
        }
    </style>
    @stack('styles') {{-- Untuk CSS tambahan per halaman --}}
    @stack('head') {{-- Untuk elemen tambahan di dalam <head> --}}
</head>
<body class="bg-gray-50 text-gray-800">
    {{-- Header Section (Berisi navigasi utama) --}}
    @include('web.header') 

    {{-- Main Content Section --}}
    <main>
        @yield('main_content') {{-- Ini adalah tempat konten spesifik halaman akan dimasukkan --}}
    </main>

    {{-- Modal (Jika Anda punya modal global) --}}
    @include('web.modal') 

    {{-- Footer Section --}}
    @include('web.footer') 

    {{-- Scripts per halaman yang ditambahkan via @push('scripts') --}}
    @stack('scripts')

    {{-- Floating WhatsApp Button with Delay & Animation (Membutuhkan Alpine.js) --}}
    {{-- Pastikan Alpine.js sudah dimuat (biasanya via app.js yang di-vite) --}}
    <div
        x-data="{ show: false }"
        x-init="setTimeout(() => show = true, 3000)" {{-- Tampilkan setelah 3 detik --}}
        x-show="show"
        x-transition:enter="transition ease-out duration-700"
        x-transition:enter-start="opacity-0 translate-y-10 scale-90"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-10 scale-90"
        class="fixed bottom-6 right-6 z-50 flex items-center gap-3 bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-full shadow-xl backdrop-blur-md transition-all duration-300 cursor-pointer"
        x-cloak {{-- Sembunyikan sampai Alpine.js siap --}}
    >
        {{-- WhatsApp Icon + Text --}}
        <a href="https://wa.me/6281916577540?text=Assalamu'alaikum%20saya%20ingin%20bertanya%20tentang%20PPDB%20PonpesDIBAMA"
           target="_blank" rel="noopener noreferrer" class="flex items-center gap-2">
            <svg class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 32 32">
                <path fill="#FFFFFF" d="M16 .5C7.438.5.5 7.438.5 16c0 2.798.73 5.434 2.074 7.735L.5 31.5l7.916-2.057A15.412 15.412 0 0016 31.5c8.562 0 15.5-6.938 15.5-15.5S24.562.5 16 .5zm0 28.375c-2.488 0-4.93-.662-7.074-1.914l-.51-.294-4.688 1.22 1.25-4.6-.324-.523A13.181 13.181 0 012.812 16C2.812 8.895 8.895 2.812 16 2.812S29.188 8.895 29.188 16 23.105 28.875 16 28.875z"/>
                <path fill="#FFFFFF" d="M23.292 19.69l-2.583-.734a1.074 1.074 0 00-1.034.279l-.845.865a11.072 11.072 0 01-5.154-5.155l.865-.845c.286-.286.385-.703.28-1.034l-.735-2.584a1.074 1.074 0 00-1.005-.748c-.057 0-.115.005-.173.017l-2.72.575a1.074 1.074 0 00-.796.796c-.223.98-.34 2.005-.34 3.064 0 5.662 4.61 10.272 10.272 10.272 1.059 0 2.085-.117 3.064-.34a1.074 1.074 0 00.796-.796l.575-2.72a1.074 1.074 0 00-.748-1.006z"/>
            </svg>
            <span class="hidden sm:inline text-sm font-medium">Hubungi Admin</span>
        </a>

        {{-- Close Button --}}
        <button @click="show = false" title="Tutup"
                class="ml-2 text-white hover:text-gray-200 transition-all duration-300 focus:outline-none">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

</body>
</html>