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

    <script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "EducationalOrganization",
    "name": "Pondok Pesantren Diniyah Baitul Makmur Aikmel",
    "url": "https://ponpesdibama.com",
    "logo": "{{ asset('storage/images/logo/dibama.png') }}",  {{-- Use asset() helper for dynamic path --}}
    "description": "Website resmi Pondok Pesantren DIBAMA Aikmel, lembaga pendidikan Islam unggul membina generasi Qur'ani dan berakhlak mulia.",
    "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+6281916577540",
        "contactType": "Customer Support"
    },
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "Jl. Raya Aikmel - Terara, Kec. Aikmel, Kab. Lombok Timur",
        "addressLocality": "Aikmel",
        "addressRegion": "Nusa Tenggara Barat",
        "postalCode": "83653",
        "addressCountry": "ID"
    },
    "hasMap": "https://www.google.com/maps/embed?..." {{-- REMEMBER TO REPLACE WITH YOUR ACTUAL GOOGLE MAPS EMBED URL --}}
}
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
    {{-- This uses standard HTML/CSS animations and does not require Alpine.js for its animation --}}
    <a href="https://wa.me/6281916577540?text=Assalamu'alaikum%20saya%20ingin%20bertanya%20tentang%20PPDB%20PonpesDIBAMA"
       class="fixed bottom-6 right-6 z-50 bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg transition-transform transform hover:scale-110 animate-bounce"
       target="_blank" rel="noopener noreferrer" title="Hubungi Admin WhatsApp">
        {{-- WhatsApp Icon --}}
        <svg class="w-6 h-6" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
            <path fill="#FFFFFF" d="M16 .5C7.438.5.5 7.438.5 16c0 2.798.73 5.434 2.074 7.735L.5 31.5l7.916-2.057A15.412 15.412 0 0016 31.5c8.562 0 15.5-6.938 15.5-15.5S24.562.5 16 .5zm0 28.375c-2.488 0-4.93-.662-7.074-1.914l-.51-.294-4.688 1.22 1.25-4.6-.324-.523A13.181 13.181 0 012.812 16C2.812 8.895 8.895 2.812 16 2.812S29.188 8.895 29.188 16 23.105 28.875 16 28.875z"/>
            <path fill="#FFFFFF" d="M23.292 19.69l-2.583-.734a1.074 1.074 0 00-1.034.279l-.845.865a11.072 11.072 0 01-5.154-5.155l.865-.845c.286-.286.385-.703.28-1.034l-.735-2.584a1.074 1.074 0 00-1.005-.748c-.057 0-.115.005-.173.017l-2.72.575a1.074 1.074 0 00-.796.796c-.223.98-.34 2.005-.34 3.064 0 5.662 4.61 10.272 10.272 10.272 1.059 0 2.085-.117 3.064-.34a1.074 1.074 0 00.796-.796l.575-2.72a1.074 10.74 0 00-.748-1.006z"/>
        </svg>
    </a>

</body>
</html>