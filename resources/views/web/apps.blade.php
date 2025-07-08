{{-- resources/views/web/apps.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pondok Pesantren Dibama - Pendidikan Islam Unggul')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) {{-- Pastikan Alpine.js diimpor melalui app.js --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Custom styles for section titles */
        .section-title {
            @apply text-4xl md:text-5xl lg:text-6xl font-extrabold text-center mb-12 {{-- Margin bawah ditingkatkan --}}
                   bg-clip-text text-transparent bg-gradient-to-r from-teal-700 to-blue-700
                   drop-shadow-xl; {{-- Efek bayangan ditingkatkan --}}
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
             @apply bg-teal-600 text-white shadow-md;
        }
    </style>
    @stack('styles') {{-- Untuk CSS tambahan per halaman --}}
</head>
<body class="bg-gray-50 text-gray-800"> {{-- Menggunakan kelas Tailwind untuk warna latar belakang dan teks dasar --}}
    @include('web.header') {{-- Menyertakan header dari file terpisah --}}

    <main> {{-- Konten utama sekarang langsung di dalam body --}}
        @yield('main_content') {{-- Ini adalah tempat konten halaman akan dimasukkan --}}
    </main>

    @include('web.modal') {{-- Menyertakan modal dari file terpisah --}}
    @include('web.footer') {{-- Menyertakan footer dari file terpisah --}}

    @stack('scripts') {{-- Untuk JavaScript tambahan per halaman --}}

    {{-- Floating WA Button --}}
    <a href="https://wa.me/6281916577540?text=Assalamu'alaikum%20saya%20ingin%20bertanya%20tentang%20PPDB%20PonpesDIBAMA"
   class="fixed bottom-6 right-6 z-50 bg-green-500 hover:bg-green-600 text-white p-4 rounded-full shadow-lg transition-transform transform hover:scale-110 animate-bounce"
   target="_blank" rel="noopener noreferrer" title="Hubungi Admin WhatsApp">
    {{-- WA Icon --}}
    <svg class="w-6 h-6" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
    <path fill="#FFFFFF" d="M16 .5C7.438.5.5 7.438.5 16c0 2.798.73 5.434 2.074 7.735L.5 31.5l7.916-2.057A15.412 15.412 0 0016 31.5c8.562 0 15.5-6.938 15.5-15.5S24.562.5 16 .5zm0 28.375c-2.488 0-4.93-.662-7.074-1.914l-.51-.294-4.688 1.22 1.25-4.6-.324-.523A13.181 13.181 0 012.812 16C2.812 8.895 8.895 2.812 16 2.812S29.188 8.895 29.188 16 23.105 28.875 16 28.875z"/>
    <path fill="#FFFFFF" d="M23.292 19.69l-2.583-.734a1.074 1.074 0 00-1.034.279l-.845.865a11.072 11.072 0 01-5.154-5.155l.865-.845c.286-.286.385-.703.28-1.034l-.735-2.584a1.074 1.074 0 00-1.005-.748c-.057 0-.115.005-.173.017l-2.72.575a1.074 1.074 0 00-.796.796c-.223.98-.34 2.005-.34 3.064 0 5.662 4.61 10.272 10.272 10.272 1.059 0 2.085-.117 3.064-.34a1.074 1.074 0 00.796-.796l.575-2.72a1.074 1.074 0 00-.748-1.006z"/>
</svg>

</a>

</body>
</html>
