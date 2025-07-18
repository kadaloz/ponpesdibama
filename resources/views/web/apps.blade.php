
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO: Title dan Meta --}}
    <title>@yield('title', 'Pondok Pesantren Dibama - Pendidikan Islam Unggul')</title>
    <meta name="description" content="@yield('meta_description', 'Website resmi Pondok Pesantren Diniyah Baitul Makmur Aikmel, lembaga pendidikan Islam yang mencetak generasi Qur’ani dan berakhlak.')">
    <meta name="keywords" content="@yield('meta_keywords', 'pondok pesantren, dibama, pesantren aikmel, pendidikan islam, ppdb online')">
    <meta name="author" content="Pondok Pesantren DIBAMA">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ url()->current() }}"/>

    {{-- Open Graph (Facebook / WhatsApp) --}}
    <meta property="og:title" content="@yield('title', 'Pondok Pesantren Dibama - Pendidikan Islam Unggul')"/>
    <meta property="og:description" content="@yield('meta_description')"/>
    <meta property="og:image" content="@yield('meta_image', asset('storage/images/og-default.jpg'))"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:type" content="website"/>

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="@yield('title')"/>
    <meta name="twitter:description" content="@yield('meta_description')"/>
    <meta name="twitter:image" content="@yield('meta_image', asset('storage/images/og-default.jpg'))"/>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('storage/images/logo/dibama.ico') }}" sizes="32x32">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('storage/images/logo/dibama.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/logo/dibama.png') }}">

    {{-- Structured Data --}}
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "Pondok Pesantren Diniyah Baitul Makmur Aikmel",
        "url": "{{ url('/') }}",
        "logo": "{{ asset('storage/images/logo/dibama.png') }}",
        "description": "Website resmi Pondok Pesantren DIBAMA Aikmel, lembaga pendidikan Islam unggul membina generasi Qur'ani.",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+62 819-1657-7540",
            "contactType": "Customer Support"
        },
        "address": {
            "@type": "PostalAddress",
            "streetAddress": "Alamat lengkap pondok",
            "addressLocality": "Aikmel",
            "addressRegion": "Nusa Tenggara Barat",
            "postalCode": "83653",
            "addressCountry": "ID"
        }
    }
    </script>

    {{-- Styles & Fonts --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Custom styles for section titles */
        .section-title {
            @apply text-4xl md:text-5xl lg:text-6xl font-extrabold text-center mb-12;
            /* Margin bawah ditingkatkan */
            @apply bg-clip-text text-transparent bg-gradient-to-r from-teal-700 to-blue-700 drop-shadow-xl;
            /* Efek bayangan ditingkatkan */
        }
        /* Apply rounded corners to images */
        img {
            @apply rounded-lg shadow-md;
        }
        /* Basic animation for hero section */
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

        /* Menambahkan scroll-margin-top untuk semua section yang memiliki ID */
        section[id] {
            scroll-margin-top: 150px; /* Sesuaikan nilai ini jika masih terpotong */
        }

        .nav-link {
             @apply block px-4 py-2 rounded-full transition-colors duration-200 
             hover:bg-teal-100 hover:text-teal-900 
             focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-teal-400;
        }
        
        .nav-link.active {
             @apply bg-yellow-600 text-white shadow-md;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    @stack('styles') {{-- Untuk CSS tambahan per halaman --}}
    @stack('head')
</head>
<body class="bg-gray-50 text-gray-800"> {{-- Menggunakan kelas Tailwind untuk warna latar belakang dan teks dasar --}}
    @include('web.header') {{-- Menyertakan header dari file terpisah --}}

    <main> {{-- Konten utama sekarang langsung di dalam body --}}
        @yield('main_content') {{-- Ini adalah tempat konten halaman akan dimasukkan --}}
    </main>

    @include('web.modal') {{-- Menyertakan modal dari file terpisah --}}
    @include('web.footer') {{-- Menyertakan footer dari file terpisah --}}

    @stack('scripts') {{-- Untuk JavaScript tambahan per halaman --}}

{{-- Floating WhatsApp Button with Delay & Animation --}}
<div
    x-data="{ show: false }"
    x-init="setTimeout(() => show = true, 3000)"
    x-show="show"
    x-transition:enter="transition ease-out duration-700"
    x-transition:enter-start="opacity-0 translate-y-10 scale-90"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-500"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 translate-y-10 scale-90"
    class="fixed bottom-6 right-6 z-50 flex items-center gap-3 bg-green-500 hover:bg-green-600 text-white px-4 py-3 rounded-full shadow-xl backdrop-blur-md transition-all duration-300"
    style="display: none;" 
>
 


</div>



</body>
</html>
