<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- Best practice for older IE compatibility --}}
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 

    {{-- SEO: Title, Meta Description, Keywords, Author --}}
    <title>@yield('title', 'Pondok Pesantren Dibama - Pendidikan Islam Unggul')</title>
    <meta name="description" content="@yield('meta_description', 'Website resmi Pondok Pesantren Diniyah Baitul Makmur Aikmel, lembaga pendidikan Islam yang mencetak generasi Qur’ani dan berakhlak mulia.')">
    <meta name="keywords" content="@yield('meta_keywords', 'pondok pesantren, dibama, pesantren aikmel, pendidikan islam, ppdb online, tahfidz, bahasa arab')">
    <meta name="author" content="Pondok Pesantren DIBAMA">

    {{-- Canonical URL: Helps prevent duplicate content issues --}}
    <link rel="canonical" href="{{ url()->current() }}"/>

    {{-- Open Graph (for Facebook, WhatsApp, etc.) --}}
    <meta property="og:title" content="@yield('title', 'Pondok Pesantren Dibama - Pendidikan Islam Unggul')"/>
    <meta property="og:description" content="@yield('meta_description')"/>
    {{-- Ensure 'og-default.jpg' exists in public/storage/images/ --}}
    <meta property="og:image" content="@yield('meta_image', asset('storage/images/og-default.jpg'))"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta property="og:type" content="website"/>

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="@yield('title')"/>
    <meta name="twitter:description" content="@yield('meta_description')"/>
    <meta name="twitter:image" content="@yield('meta_image', asset('storage/images/og-default.jpg'))"/>

    {{-- Favicon: Provide multiple sizes for better compatibility --}}
    {{-- Ensure 'dibama.ico' and 'dibama.png' exist in public/storage/images/logo/ --}}
    <link rel="icon" href="{{ asset('storage/images/logo/dibama.ico') }}" sizes="32x32">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('storage/images/logo/dibama.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/images/logo/dibama.png') }}">

{{-- Structured Data: JSON-LD with @graph --}}
<script type="application/ld+json">
{!! json_encode([
    '@context' => 'https://schema.org',
    '@graph' => [
        [
            '@type' => 'EducationalOrganization',
            'name' => 'Pondok Pesantren Diniyah Baitul Makmur Aikmel',
            'url' => url('/'),
            'logo' => asset('storage/images/logo/dibama.png'),
            'description' => 'Website resmi Pondok Pesantren DIBAMA Aikmel, lembaga pendidikan Islam unggul membina generasi Qur\'ani dan berakhlak mulia.',
            'contactPoint' => [
                '@type' => 'ContactPoint',
                'telephone' => '+6281916577540',
                'contactType' => 'Customer Support',
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Jl. Raya Aikmel - Terara, Kec. Aikmel, Kab. Lombok Timur',
                'addressLocality' => 'Aikmel',
                'addressRegion' => 'Nusa Tenggara Barat',
                'postalCode' => '83653',
                'addressCountry' => 'ID',
            ],
            'hasMap' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3945.7410000000005!2d116.480000!3d-8.625000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2z4bm84bm84bm84bm8!5e0!3m2!1sid!2sid!4v1678888888888!5m2!1sid!2sid'
        ],
        [
            '@type' => 'WebSite',
            'name' => 'Official Website of Ponpes DIBAMA',
            'url' => url('/'),
        ]
    ]
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>





    {{-- Styles & Fonts --}}
    {{-- Ensure Vite is running (npm run dev or npm run build) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    {{-- Optional: Add other specific fonts if you use them for Arabic text etc. --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Noto+Nastaliq+Urdu:wght@400;700&display=swap" rel="stylesheet"> --}}

    <style>
        body { 
            font-family: 'Inter', sans-serif; 
            scroll-behavior: smooth; /* Enables smooth scrolling for #links */
        }

        /* Custom styles for section titles */
        .section-title {
            @apply text-4xl md:text-5xl lg:text-6xl font-extrabold text-center mb-12
                   bg-clip-text text-transparent bg-gradient-to-r from-teal-700 to-blue-700
                   drop-shadow-xl;
        }

        /* Apply rounded corners and shadow to all images by default */
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
        /* Note: The WhatsApp button directly applies animate-bounce */

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
            cursor: pointer; /* Added for better UX */
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
        }

        /* Adds scroll-margin-top to all sections with an ID, useful for sticky headers */
        section[id] {
            scroll-margin-top: 150px; /* Adjust this value if your sticky header height changes */
        }

        /* Alpine.js x-cloak: Hides elements until Alpine.js is initialized */
        [x-cloak] {
            display: none !important;
        }
    </style>
    @stack('styles') {{-- For page-specific CSS --}}
    @stack('head') {{-- For any extra elements in the <head> from child views --}}
</head>
<body class="bg-gray-50 text-gray-800">

    {{-- Header Section (Contains main navigation) --}}
    {{-- Ensure this file exists: resources/views/web/header.blade.php --}}
    @include('web.header')

    {{-- Main Content Section --}}
    <main>
        @yield('main_content') {{-- This is where the page-specific content will be inserted --}}
    </main>

    {{-- Modal (If you have a global modal structure) --}}
    {{-- Ensure this file exists: resources/views/web/modal.blade.php --}}
    @include('web.modal')

    {{-- Footer Section --}}
    {{-- Ensure this file exists: resources/views/web/footer.blade.php --}}
    @include('web.footer')

    {{-- Page-specific JavaScript that's pushed via @push('scripts') --}}
    @stack('scripts')

    {{-- Floating WhatsApp Button --}}
    {{-- Floating WhatsApp Button --}}
<div id="whatsapp-floating" class="fixed bottom-6 right-6 z-50 flex items-center gap-3 bg-green-500 text-white px-4 py-2 rounded-full shadow-lg transition-opacity duration-500 opacity-0 pointer-events-none">
    <a href="https://wa.me/6281916577540?text=Assalamu'alaikum%20saya%20ingin%20bertanya%20tentang%20PPDB%20PonpesDIBAMA"
       target="_blank" rel="noopener noreferrer" title="Hubungi Admin WhatsApp"
       class="flex items-center gap-2 hover:text-white">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 .5C7.438.5.5 7.438.5 16c0 2.798.73 5.434 2.074 7.735L.5 31.5l7.916-2.057A15.412 15.412 0 0016 31.5c8.562 0 15.5-6.938 15.5-15.5S24.562.5 16 .5z"/>
            <path d="M23.292 19.69l-2.583-.734a1.074 1.074 0 00-1.034.279l-.845.865a11.072 11.072 0 01-5.154-5.155l.865-.845c.286-.286.385-.703.28-1.034l-.735-2.584a1.074 1.074 0 00-1.005-.748l-2.72.575a1.074 1.074 0 00-.796.796c-.223.98-.34 2.005-.34 3.064 0 5.662 4.61 10.272 10.272 10.272 1.059 0 2.085-.117 3.064-.34a1.074 1.074 0 00.796-.796l.575-2.72a1.074 1.074 0 00-.748-1.006z"/>
        </svg>
        <span class="text-sm font-medium">Tanya via WhatsApp</span>
    </a>
    <button onclick="closeWhatsappFloating()" class="text-white hover:text-gray-200 focus:outline-none ml-2">
        &times;
    </button>
</div>
<script>
    function showWhatsappFloating() {
        const el = document.getElementById("whatsapp-floating");
        if (el) {
            el.classList.remove("opacity-0", "pointer-events-none");
            el.classList.add("opacity-100");
        }
    }

    function closeWhatsappFloating() {
        const el = document.getElementById("whatsapp-floating");
        if (el) {
            el.classList.add("opacity-0", "pointer-events-none");
        }
    }

    window.addEventListener("DOMContentLoaded", () => {
        setTimeout(showWhatsappFloating, 5000); // ⏱ Muncul setelah 5 detik
    });
</script>


</body>
</html>