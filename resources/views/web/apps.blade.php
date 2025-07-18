<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> {{-- Pastikan selalu ada --}}

    {{-- SEO: Title dan Meta --}}
    <title>@yield('title', 'Pondok Pesantren Dibama - Pendidikan Islam Unggul')</title>




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
</head>
<body class="bg-gray-50 text-gray-800">


</body>
</html>